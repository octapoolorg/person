import pandas as pd
import os

# Read existing CSV files and handle encoding issues
names_df = pd.read_csv("names.csv", encoding='utf-8')
genders_df = pd.read_csv("genders.csv", encoding='utf-8')

# Initialize lists to collect rows to update and append
to_update = []
to_append = []

# Column names for .txt files
txt_columns = ['name', 'gender', 'usage']

# Traverse 'data-source' directory and read each .txt file
for filename in os.listdir('data-source'):
    if filename.endswith('.txt'):
        txt_data = pd.read_csv(os.path.join('data-source', filename), header=None, names=txt_columns, encoding='utf-8')

        for index, row in txt_data.iterrows():
            name = row['name']
            gender = row['gender']

            # Debug print
            print(f"Processing name: {name}, gender: {gender}")

            # Find matching rows in names_df
            matching_rows = names_df[names_df['name'] == name]

            if not matching_rows.empty:
                # Update the gender if it differs
                for _, match in matching_rows.iterrows():
                    existing_gender_id = match['gender_id']
                    existing_gender = genders_df[genders_df['id'] == existing_gender_id]['gender'].values[0]

                    if gender != existing_gender:
                        try:
                            new_gender_id = genders_df[genders_df['gender'] == gender]['id'].values[0]
                        except IndexError:
                            print(f"Gender {gender} not found in genders.csv")
                            continue
                        to_update.append((match['id'], new_gender_id))
            else:
                # Append new row if the name doesn't exist
                try:
                    new_gender_id = genders_df[genders_df['gender'] == gender]['id'].values[0]
                except IndexError:
                    print(f"Gender {gender} not found in genders.csv")
                    continue
                new_row = {'id': names_df['id'].max() + 1, 'name': name, 'meaning': None, 'syllables': None, 'gender_id': new_gender_id, 'origin_id': None}
                to_append.append(new_row)

# Apply updates and appends to names_df
for id_val, new_gender_id in to_update:
    names_df.loc[names_df['id'] == id_val, 'gender_id'] = new_gender_id

if to_append:
    names_df = names_df.append(pd.DataFrame(to_append), ignore_index=True)

# Write updated DataFrame back to disk
names_df.to_csv("names.csv", index=False, encoding='utf-8')
