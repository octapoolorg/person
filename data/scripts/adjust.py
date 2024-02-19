import dask
dask.config.set({'dataframe.query-planning': True})
import dask.dataframe as dd
from dask.diagnostics import ProgressBar

# Load the CSV file into a Dask DataFrame
df = dd.read_csv('../imports/names1.csv')

def check_name(name):
    # Constraints
    min_word_length = 3
    max_word_length = 10
    max_spaces = 1

    # Split the name into words
    words = name.split(' ')

    # Check if the name has more spaces than allowed or if it's empty
    if len(words) - 1 > max_spaces or not name:
        return 0

    # Check each word's length constraints
    for word in words:
        if not (min_word_length <= len(word) <= max_word_length):
            return 0

    # If all checks passed, the name is considered valid
    return 1

# Ensure 'name' column is of string type for consistent processing
df['name'] = df['name'].astype(str)

with ProgressBar():
    df['is_simple'] = df.map_partitions(lambda df: df['name'].apply(check_name), meta=('is_simple', 'int64'))

with ProgressBar():
    df.to_csv('../imports/names.csv', single_file=True, index=False)
