import pandas as pd

df = pd.read_csv('pop.csv')

# remove duplicates on the 'name' column

df = df.drop_duplicates(subset='name')

# only keep name column

df = df[['name']]

# sort by name

df = df.sort_values(by='name')

# save to a new file

df.to_csv('pop.csv', index=False)

