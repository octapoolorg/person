import pandas as pd
import logging
from tqdm import tqdm

# Set up logging
logging.basicConfig(filename='app.log', filemode='w', format='%(name)s - %(levelname)s - %(message)s', level=logging.INFO)

# Custom function to trim spaces around commas and spaces in strings
def trim_spaces_around_commas(s):
    if isinstance(s, str):
        # Trim leading and trailing spaces
        s = s.strip()
        # Remove spaces before and after commas
        s = ','.join([x.strip() for x in s.split(',')])
    return s

logging.info('Reading CSV file...')
# Read the CSV file
df = pd.read_csv('final_names-updated.csv', encoding='utf-8', low_memory=False, dtype=str)

# Fill NaN values with empty string in all complete dataframe
df.fillna('', inplace=True)

# Replace 'Nan' strings with empty string in all complete dataframe
df = df.replace('Nan', '')

# Trim leading and trailing spaces and remove spaces before and after commas in complete dataframe
df = df.applymap(trim_spaces_around_commas)

logging.info('Removing duplicates...')
# Remove duplicates on name
df = df.drop_duplicates(subset='name')

logging.info('Saving result...')
# Save the result to a new CSV file
df.to_csv('final_names-updated.csv', index=False, encoding='utf-8')

logging.info('Done.')