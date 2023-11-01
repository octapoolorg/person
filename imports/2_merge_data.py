import os
import pandas as pd

# Read the dedup_names_root.csv file into a DataFrame
cnames_df = pd.read_csv('temp/dedup_names_root.csv', low_memory=False)

# Initialize an empty DataFrame to store all data from .txt files
all_txt_data = pd.DataFrame(columns=['Name', 'Gender'])

# Path to the source directory containing .txt files
source_dir = 'source/gender'

# Loop through each .txt file in the source directory and append to all_txt_data
for txt_file in os.listdir(source_dir):
    if txt_file.endswith('.txt'):
        temp_df = pd.read_csv(os.path.join(source_dir, txt_file), header=None, usecols=[0, 1], names=['Name', 'Gender'])
        all_txt_data = pd.concat([all_txt_data, temp_df])

# Drop duplicates in the all_txt_data DataFrame
all_txt_data.drop_duplicates(subset='Name', keep='last', inplace=True)

# Merge the temporary DataFrame with the main DataFrame
cnames_df = pd.merge(cnames_df, all_txt_data, on='Name', how='outer', suffixes=('', '_new'))

# Update the 'Gender' column with the new values
cnames_df['Gender'] = cnames_df['Gender_new'].combine_first(cnames_df['Gender'])

# Drop the temporary column
cnames_df.drop('Gender_new', axis=1, inplace=True)

# Convert 'Syllables' to integer, assuming 'Syllables' exists in your DataFrame
if 'Syllables' in cnames_df.columns:
    cnames_df['Syllables'] = cnames_df['Syllables'].fillna(0).astype(int)

# Write the final DataFrame back to names_root.csv
cnames_df.to_csv('temp/names_root.csv', index=False)
