import dask
from dask.diagnostics import ProgressBar
dask.config.set({'dataframe.query-planning': True})
import dask.dataframe as dd
import logging
import pandas as pd
import marisa_trie
import time
import threading

def clear_nohup():
    while True:
        open('nohup.out', 'w').close()
        time.sleep(120)

# Start the file clearing function in a separate thread
clearing_thread = threading.Thread(target=clear_nohup, daemon=True)
clearing_thread.start()

logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

def compute_frequent_values(df, column_name, min_frequency=5000):
    exploded = df[column_name].dropna().str.split(',').explode().map(str.strip)
    with ProgressBar():
        value_counts = exploded.value_counts().compute()
    frequent_values = value_counts[value_counts >= min_frequency].index
    return set(frequent_values)

def filter_values(row, frequent_values):
    if pd.isnull(row):
        return ''
    filtered_values = [val for val in row.split(',') if val.strip() in frequent_values]
    return ', '.join(filtered_values)

def process_column_for_prefixes(df, column_name, frequent_values):
    trie = marisa_trie.Trie(frequent_values)
    prefixes = {value: trie.prefixes(value)[0] for value in trie.iterkeys()}

    def apply_prefixes(row):
        if pd.isnull(row):
            return ''
        return ', '.join(sorted({prefixes.get(val.strip(), val.strip()) for val in row.split(',')}))

    df[column_name] = df[column_name].map_partitions(lambda part: part.apply(apply_prefixes), meta=('column_name', 'object'))
    return df

def update_meanings(meanings):
    if pd.isnull(meanings):
        return ''
    meanings_list = sorted(set(meanings.split(',')), key=len, reverse=True)
    final_meanings = []
    for meaning in meanings_list:
        if all(meaning not in m or meaning == m for m in final_meanings):
            final_meanings.append(meaning)
    return ', '.join(final_meanings)

def clean_and_title_case(column):
    return column.str.replace('\s+', ' ', regex=True).str.strip().str.title()

logging.info("Loading data with Dask...")
df = dd.read_csv('names.csv', dtype=str)

df['name'] = df['name'].str.strip()

logging.info("Dropping duplicates based on name...")
df = df.drop_duplicates(subset=['name'], keep='first')

# also drop rows with missing names
df = df.dropna(subset=['name'])

# remove those names equal to nan or empty string - case insensitive
df = df.map_partitions(lambda part: part[~part['name'].str.lower().isin(['nan', ''])])

columns_to_process = ['origins']
for column in columns_to_process:
    logging.info(f"Identifying frequent values in {column}...")
    frequent_values = compute_frequent_values(df, column)
    logging.info(f"Filtering {column} based on occurrence frequency...")
    df[column] = df[column].map_partitions(lambda part: part.apply(filter_values, args=(frequent_values,)), meta=('column', 'object'))
    logging.info(f"Processing {column} for shortest unique full-word prefixes...")
    df = process_column_for_prefixes(df, column, frequent_values)

logging.info("Updating Meanings...")
df['meanings'] = df['meanings'].map_partitions(lambda part: part.apply(update_meanings), meta=('meanings', 'object'))

# Apply cleaning and title casing
logging.info("Cleaning and converting to title case...")
for col in ['meanings', 'origins']:
    df[col] = clean_and_title_case(df[col]).map_partitions(lambda part: part, meta=('col', 'object'))

logging.info("Processing completed. Saving output...")
with ProgressBar():
    df.compute().to_csv('names.csv', index=False)

logging.info("Output saved to names.csv.")