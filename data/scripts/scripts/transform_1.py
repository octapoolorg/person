import pandas as pd
import unicodedata
import re  # Import the regex module
from tqdm import tqdm
import logging
from multiprocessing import Pool, cpu_count

# Set up basic configuration for logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

def unique_concat(series):
    valid_items = [str(item) for item in series if pd.notnull(item)]
    unique_items = set(valid_items)
    concatenated = ','.join(sorted(unique_items))
    return concatenated if concatenated else ''

def normalize_and_trim(name):
    # Trim leading and trailing spaces and replace multiple spaces with a single space
    trimmed = re.sub(r'\s+', ' ', str(name).strip())
    # Normalize using NFC and convert to lowercase
    return unicodedata.normalize('NFC', trimmed).lower()

def trim_and_preserve_case(series):
    # Drop NA values and strip spaces from non-null items
    non_null_series = series.dropna().apply(lambda x: x.strip())
    # Check if the series is empty after dropping NA values
    if not non_null_series.empty:
        # If not empty, trim and substitute spaces, then return the first item
        trimmed = re.sub(r'\s+', ' ', str(non_null_series.iloc[0]))
        return trimmed
    else:
        return ''

def process_chunk(chunk_data):
    chunk, _ = chunk_data
    # Apply normalization and trimming to the name column for internal grouping
    chunk['name_normalized'] = chunk['name'].apply(lambda x: normalize_and_trim(x) if pd.notnull(x) else "missing_name")

    aggregation_methods = {
        'name': trim_and_preserve_case,
        'categories': unique_concat,
        'pronunciations': unique_concat,
        'gender': unique_concat,
        'language': unique_concat,
        'meanings': unique_concat,
        'origins': unique_concat,
        'root_name_id': unique_concat
    }
    
    grouped_chunk = chunk.groupby('name_normalized', as_index=False).agg(aggregation_methods)
    
    return grouped_chunk.drop(columns=['name_normalized'])

def init_worker():
    import signal
    signal.signal(signal.SIGINT, signal.SIG_IGN)

def final_deduplication(combined_df):
    combined_df['name_normalized'] = combined_df['name'].apply(lambda x: normalize_and_trim(x) if pd.notnull(x) else "missing_name")

    aggregation_methods = {
        'name': trim_and_preserve_case,
        'categories': unique_concat,
        'pronunciations': unique_concat,
        'gender': unique_concat,
        'language': unique_concat,
        'meanings': unique_concat,
        'origins': unique_concat,
        'root_name_id': unique_concat
    }

    final_df = combined_df.groupby('name_normalized', as_index=False).agg(aggregation_methods)
    final_df.drop(columns=['name_normalized'], inplace=True)

    return final_df

def process_csv_in_parallel(input_csv, output_csv, chunksize=10000):
    logging.info(f'Starting to process {input_csv}')
    
    reader = pd.read_csv(input_csv, chunksize=chunksize)
    pool = Pool(processes=cpu_count(), initializer=init_worker)
    
    try:
        results = list(tqdm(pool.imap_unordered(process_chunk, ((chunk, i) for i, chunk in enumerate(reader))),
                            desc="Processing Chunks"))
    except KeyboardInterrupt:
        pool.terminate()
        pool.join()
        logging.error('Multiprocessing interrupted.')
        return
    else:
        pool.close()
        pool.join()


    logging.info('Combining chunks')
    combined_df = pd.concat(results)

    logging.info('Final deduplication across the entire dataset')
    final_df = final_deduplication(combined_df)
    
    logging.info('Writing the processed data to ' + output_csv)
    final_df.to_csv(output_csv, index=False)
    
    logging.info('Processing completed.')

input_csv = 'names.csv'
output_csv = 'transformed_names_1.csv'

# Process the CSV file
process_csv_in_parallel(input_csv, output_csv)