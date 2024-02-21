import pandas as pd

df = pd.read_csv('popular_names.csv')

# drop names with less than 3 characters

df = df[df['name'].str.len() > 2]

# drop names with spaces

df = df[~df['name'].str.contains(' ')]

# drop names with non-alphabetic characters like hyphens, apostrophes, etc. but allow accented characters

df = df[df['name'].str.contains('^[a-zA-ZÀ-ÿ]*$')]

# remove duplicates on the 'name' column

df = df.drop_duplicates(subset='name')

# title case the names

df['name'] = df['name'].str.title()

# sort by name

df = df.sort_values(by='name')

# save to a new file

df.to_csv('popular_names.csv', index=False)