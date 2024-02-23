import pandas as pd

# Read the CSV file
df = pd.read_csv('database/names.csv')

# Find duplicate rows based on the 'slug' column
dup_df = df[df.duplicated('slug', keep=False)]

# Write the duplicate rows to a new CSV file
dup_df.to_csv('dup_rows.csv', index=False)