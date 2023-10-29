import pandas as pd

# Read the CSV file into a Pandas DataFrame
df = pd.read_csv("names_root.csv")

# Create a function to merge unique values
def merge_unique(x):
    return ', '.join(set(', '.join(x.astype(str)).split(', ')))

# Group the data by the 'Name' column and aggregate using our custom function
cleaned_df = df.groupby('Name').agg(merge_unique).reset_index()

# Write the cleaned DataFrame back to a CSV file
cleaned_df.to_csv("cleaned_names_root.csv", index=False)
