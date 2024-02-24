import pandas as pd
from slugify import slugify

df = pd.read_csv('names.csv')

# generate slug from name
df['slug'] = df['name'].apply(slugify)

# only save id, name, and slug
df = df[['id', 'name', 'slug']]

df.to_csv('words.csv', index=False)