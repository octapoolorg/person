import pandas as pd
import logging
from tqdm import tqdm

# Set up logging
logging.basicConfig(filename='app.log', filemode='w', format='%(name)s - %(levelname)s - %(message)s', level=logging.INFO)

# Load the data from the two CSV files with 'utf-8' encoding
logging.info('Loading data...')

df1 = pd.read_csv('transformed_names-updated.csv', encoding='utf-8')
df2 = pd.read_csv('names_old-updated.csv', encoding='utf-8')

logging.info('Data loaded.')

# Concatenate the two dataframes one after the other
logging.info('Concatenating data...')
df = pd.concat([df1, df2])

logging.info('Data concatenated.')

# Function to remove duplicates from a comma-separated string
def remove_duplicates(s):
    if isinstance(s, str):
        # split string into list, remove empty strings, convert to set to remove duplicates, convert back to list
        unique_values = list(set(filter(None, s.lower().strip().split(','))))
        # join unique values back into a comma-separated string
        return ','.join(sorted(unique_values)).title()
    else:
        logging.warning(f'Invalid type: {type(s)}')

# Convert the relevant columns to strings
df['meanings'] = df['meanings'].astype(str)
df['categories'] = df['categories'].astype(str)
df['origins'] = df['origins'].astype(str)

# Apply remove_duplicates function
df['meanings'] = df['meanings'].apply(remove_duplicates)
df['categories'] = df['categories'].apply(remove_duplicates)
df['origins'] = df['origins'].apply(remove_duplicates)

#fill NaN values with empty string in all complete dataframe
df.fillna('', inplace=True)

# trim leading and trailing spaces in complete dataframe
df = df.applymap(lambda x: x.strip() if isinstance(x, str) else x)

# remove duplicates on name
logging.info('Removing duplicates...')
df = df.drop_duplicates(subset='name')

# regenerate the id column with auto-increment
logging.info('Regenerating ID...')
df['id'] = range(1, 1+len(df))

# Save the result to a new CSV file
logging.info('Saving result...')
df.to_csv('final_names.csv', index=False, encoding='utf-8')

logging.info('Done.')