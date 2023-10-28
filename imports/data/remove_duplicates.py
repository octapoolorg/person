import pandas as pd

# Read the CSV file into a Pandas DataFrame
df = pd.read_csv("names_root.csv")

# Initialize an empty DataFrame to store the cleaned data
cleaned_df = pd.DataFrame()

# Group the data by the 'Name' column
grouped = df.groupby('Name')

# Iterate over each group (each unique name)
for name, group in grouped:
    # If the group has only one row, no merging is required
    if len(group) == 1:
        cleaned_df = cleaned_df.append(group)
        continue

    # Initialize dictionaries to hold the merged data
    merged_data = {'Name': name}

    # Iterate over each column (excluding 'Name')
    for col in group.columns[1:]:
        # Combine the data, split by comma, convert to set (to remove duplicates), and then join back
        merged_values = ', '.join(set(', '.join(group[col].astype(str)).split(', ')))
        merged_data[col] = merged_values

    # Append the merged row to the cleaned DataFrame
    cleaned_df = cleaned_df.append(merged_data, ignore_index=True)

# Write the cleaned DataFrame back to a CSV file
cleaned_df.to_csv("cleaned_file.csv", index=False)
