import pandas as pd

# Load the first 500 rows of the CSV file
df = pd.read_csv('final_names-updated.csv')

# Remove extra spaces from 'categories' and 'origins' columns
df['categories'] = df['categories'].apply(lambda x: ','.join(map(str.strip, x.split(','))) if isinstance(x, str) else x)
df['origins'] = df['origins'].apply(lambda x: ','.join(map(str.strip, x.split(','))) if isinstance(x, str) else x)

# Save the cleaned CSV file
df.to_csv('final_names-ready.csv', index=False)