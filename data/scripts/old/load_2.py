import pandas as pd
from tqdm import tqdm
import logging
import numpy as np
import re

# Configure logging
logging.basicConfig(filename='nohup.out', filemode='w', level=logging.INFO, format='%(asctime)s - %(message)s')

# Step 1: Read CSV files into pandas DataFrames
df_big = pd.read_csv('database/names.csv')
df_popular = pd.read_csv('names-popular.csv')

# Step 2: Convert popular names to set for faster lookup
popular_names_set = set(df_popular['name'])

# Step 2.1: Convert big names to set for faster lookup
big_names_set = set(df_big['name'])

# Initialize progress bar
total_records = len(df_big)
with tqdm(total=total_records, desc='Processing') as pbar:
    try:
        # Step 3: Check if name is popular and simple, and add corresponding columns
        df_big['is_popular'] = df_big['name'].apply(lambda x: 1 if x in popular_names_set else 0)
        df_big['is_simple']  = df_big['name'].apply(lambda x: 1 if isinstance(x, str) and len(x) < 10 else 0)
    except Exception as e:
        logging.error(f"Error occurred: {str(e)}")
        df_big['is_simple'] = 0
    finally:
        pbar.update(total_records)

# Log progress
logging.info(f'Processed {total_records} records.')

# Step 4: Find popular names not found in big names
not_found_names = popular_names_set - big_names_set

# Step 5: Write not found names to a new CSV file
df_not_found = pd.DataFrame(list(not_found_names), columns=['name'])
df_not_found.to_csv('not-found.csv', index=False)

# Step 6: Overwrite original CSV file with updated DataFrame
df_big.to_csv('database/names.csv', index=False)

# Log completion
logging.info('Task completed successfully.')