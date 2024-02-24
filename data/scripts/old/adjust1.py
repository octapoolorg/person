import pandas as pd

# Load the data
df_large = pd.read_csv('../imports/names.csv')
df_small = pd.read_csv('update/db/names.csv')

# Add 'is_popular' column to the small DataFrame
df_small['is_popular'] = 1

# Add unique 'id' column to the large DataFrame
start_id = df_small['id'].max() + 1
df_large['id'] = range(start_id, start_id + len(df_large))

# Check if 'is_popular' column exists in the large DataFrame
if 'is_popular' not in df_large.columns:
    # If not, add 'is_popular' column to the large DataFrame with default value 0
    df_large['is_popular'] = 0

# Reorder the columns to match the small DataFrame
df_large = df_large[df_small.columns]

# Concatenate the two DataFrames
df_combined = pd.concat([df_small, df_large], ignore_index=True)

# fill `popularity` column non float values with 0
df_combined['popularity'] = df_combined['popularity'].apply(lambda x: 0 if not isinstance(x, float) else x)

# fill all NaN values with empty string
df_combined = df_combined.fillna('')

# Save the data
df_combined.to_csv('../imports/combined.csv', index=False)