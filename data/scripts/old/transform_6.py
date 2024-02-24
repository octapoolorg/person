import dask
from dask.diagnostics import ProgressBar

dask.config.set({'dataframe.query-planning': True})
import dask.dataframe as dd
import pandas as pd
import logging

logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

# Load the data from the input CSV file
df = dd.read_csv('finalnames.csv', dtype=str, low_memory=False)

# Convert 'name' column to string type
df['name'] = df['name'].astype(str)

# Apply a lambda function to the 'origins' column
def check_length(y):
    values = str(y).split(',')
    for s in values:
        stripped = s.strip()
        if len(stripped) < 2:
            return True
    return False

logging.info("Applying checks to the data... origins")
length_check = df['origins'].map_partitions(lambda x: x.apply(check_length), meta=('origins', 'bool'))

# New function to check 'name' column
def check_name(name):
    # Count the number of spaces in the name
    num_spaces = name.count(' ')

    # Check if the name has more than 2 spaces
    has_many_spaces = num_spaces > 2

    # Create a list of single-word names in the name that are alphabets
    single_chars = [c for c in name.split() if c.isalpha() and len(c) == 1]

    # Count the number of single-word alphabetic names
    num_single_chars = len(single_chars)

    # Check if the name has more than 1 single-word alphabetic names
    has_many_single_chars = num_single_chars > 1

    # If the name has more than 3 spaces or more than 2 single-word alphabetic names, return True
    if has_many_spaces or has_many_single_chars:
        logging.info(f"Invalid name: {name}")
        return True

    # If none of the above conditions are met, return False
    return False

logging.info("Applying checks to the data... name")
name_check = df['name'].map_partitions(lambda x: x.apply(check_name), meta=('name', 'bool'))

# Combine the checks
combined_check = length_check | name_check

# Filter rows where the 'origins' value contains a string with less than 2 characters or 'name' column conditions are met
df_invalid = df[combined_check]

# Filter rows where all 'origins' values have 2 or more characters and 'name' column conditions are not met
df_valid = df[~combined_check]

# remove duplicates on name column
logging.info("Removing duplicates...")
df_valid = df_valid.drop_duplicates(subset='name')

logging.info("Processing completed. Saving output...")

# Register the progress bar
with ProgressBar():
    # Write the filtered data to new CSV files
    df_valid.compute().to_csv('final_valid.csv', index=False)
    df_invalid.compute().to_csv('final_invalid.csv', index=False)

logging.info("Processing completed. Output saved to final_valid.csv and final_invalid.csv")