import dask
dask.config.set({'dataframe.query-planning': True})
import dask.dataframe as dd
from dask.diagnostics import ProgressBar
import unidecode

# Load the CSV file into a Dask DataFrame
df = dd.read_csv('../imports/combined.csv')

# fill all NaN values with empty string
df = df.fillna('')

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

def is_accented(name):
    # Check if the name is the same when unaccented
    return name != unidecode.unidecode(name)

# Ensure 'name' column is of string type for consistent processing
df['name'] = df['name'].astype(str)

with ProgressBar():
    df['is_simple'] = df.map_partitions(lambda df: df['name'].apply(check_name), meta=('is_simple', 'int64'))

# Add a column for whether the name is accented
with ProgressBar():
    df['is_accented'] = df.map_partitions(lambda df: df['name'].apply(is_accented), meta=('is_accented', 'bool'))

# Sort by whether the name is accented, then by the name itself
df = df.sort_values(by=['is_accented', 'name'])

# Remove the 'is_accented' column
df = df.drop('is_accented', axis=1)

with ProgressBar():
    df.to_csv('../imports/combined.csv', single_file=True, index=False)