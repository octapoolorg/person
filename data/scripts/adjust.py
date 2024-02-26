import dask.dataframe as dd
import pandas as pd

# Specify the data types of the columns
dtypes = {
    'pronunciation': 'object',
    'popularity': 'object'
}

# Load the dataframe
df = dd.read_csv('names.csv', encoding='utf-8', dtype=dtypes)

# Replace empty strings with '0' in 'popularity' column
df['popularity'] = df['popularity'].replace('', '0')

# Convert the 'popularity' column to a numeric type, replacing non-numeric values with NaN
df['popularity'] = df['popularity'].map_partitions(pd.to_numeric, errors='coerce')

# Replace NaN values with 0 (not '0') in 'popularity' column
df['popularity'] = df['popularity'].fillna(0)

# Replace non-string values with '' in 'pronunciation' column
df['pronunciation'] = df['pronunciation'].apply(lambda x: x if isinstance(x, str) else '', meta=('pronunciation', 'object'))

# Convert Dask DataFrame to Pandas DataFrame
df = df.compute()

# Write the dataframe back to the CSV file
df.to_csv('names.csv', index=False, encoding='utf-8')
print("Done!")