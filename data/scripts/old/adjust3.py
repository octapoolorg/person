import pandas as pd
from collections import defaultdict
from slugify import slugify

# Load the data
slug_storage = defaultdict(lambda: defaultdict(int))

def generate_unique_slug(name, type):
    base_slug = slugify(str(name))

    # Check if the slug already exists for the given type and adjust the slug if necessary
    if slug_storage[type][base_slug] == 0:
        # If the slug does not exist, use it as is
        slug_storage[type][base_slug] = 1
        slug = base_slug
    else:
        # If the slug exists, increment the stored count and append it to the slug
        slug_storage[type][base_slug] += 1
        slug = f"{base_slug}-{slug_storage[type][base_slug]}"

    return slug

df = pd.read_csv('../imports/names.csv')

# create a temporary column with lowercased names
df['lower_name'] = df['name'].str.lower()

# remove duplicate rows on lower_name column, keep the is_popular =1 row
df = df.sort_values('is_popular', ascending=False).drop_duplicates('lower_name').sort_index()

# remove the temporary column
df = df.drop(columns='lower_name')

# Generate unique slug on the basis of name column
df['slug'] = df['name'].apply(lambda name: generate_unique_slug(name, 'name'))

# conver name column to title case
df['name'] = df['name'].str.title()

# sort by name column
df = df.sort_values('name')

# Save the data
df.to_csv('../imports/names.csv', index=False)