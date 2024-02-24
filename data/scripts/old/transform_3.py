import pandas as pd
import logging
from tqdm import tqdm
import re

# Set up logging
logging.basicConfig(filename='app.log', filemode='w', format='%(name)s - %(levelname)s - %(message)s', level=logging.INFO)

# Load the data
logging.info('Loading data...')
df = pd.read_csv('transformed_names.csv')

# Dictionary of columns to add with default values
columns_to_add = {'is_active': 0, 'ugc': 0}

# Add the columns
df = df.assign(**columns_to_add)

logging.info('Columns added.')

# Sort by name
logging.info('Sorting by name...')
df = df.sort_values(by='name')

# Save the result back to old.csv
logging.info('Saving result...')
df.to_csv('transformed_names-updated.csv', index=False)

logging.info('Done.')