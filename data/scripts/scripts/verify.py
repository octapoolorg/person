import pandas as pd

def print_duplicates(filename):
    df = pd.read_csv(filename)

    duplicates = df[df.duplicated(keep=False)]

    for _, row in duplicates.iterrows():
        print(f'Duplicate row: {row.tolist()}')

print_duplicates('database/name_origin.csv')