import csv
import os
from collections import defaultdict

def create_directory(directory_name):
    """Creates a directory if it doesn't exist."""
    if not os.path.exists(directory_name):
        os.makedirs(directory_name)

def read_csv_to_populate_tables(filepath, tables, mappings):
    """Read CSV and populate tables and mapping dictionaries."""
    categories_set = set()  # Hold unique categories
    with open(filepath, 'r', encoding='utf-8') as csvfile:
        csvreader = csv.reader(csvfile)
        next(csvreader)  # skip header
        for row in csvreader:
            name, meaning, gender, origin, syllables, categories = row
            tables['genders'].add(gender)
            tables['origins'].add(origin)

            # IDs start from 1 and are unique within each table
            name_id = len(tables['names']) + 1
            tables['names'].append([name_id, name, meaning, syllables])

            # populate the mapping table and categories_set
            for category in categories.split(","):
                category = category.strip()
                mappings['category_name'].append([name_id, category])
                categories_set.add(category)

    tables['categories'] = [[idx+1, category] for idx, category in enumerate(categories_set)]

def write_table_to_csv(filepath, header, table):
    """Write a table to a CSV file."""
    with open(filepath, 'w', newline='', encoding='utf-8') as csvfile:
        csvwriter = csv.writer(csvfile)
        csvwriter.writerow(header)
        csvwriter.writerows(table)

def main():
    # Initialize
    data_directory = 'database'
    create_directory(data_directory)
    tables = defaultdict(list)
    tables['genders'] = set()
    tables['origins'] = set()
    mappings = defaultdict(list)

    # Populate tables
    input_file = 'processed_names_root.csv'
    read_csv_to_populate_tables(input_file, tables, mappings)

    # Convert sets to lists with ID
    for table_name in ['genders', 'origins']:
        tables[table_name] = [[idx+1, item] for idx, item in enumerate(tables[table_name])]

    # Write tables to CSV
    output_files = {
        'names': ['id', 'name', 'meaning', 'syllables'],
        'genders': ['id', 'gender'],
        'origins': ['id', 'origin'],
        'categories': ['id', 'category']
    }

    for table_name, header in output_files.items():
        output_file = os.path.join(data_directory, f"{table_name}.csv")
        write_table_to_csv(output_file, header, tables[table_name])

    # Handle special cases like mappings
    category_to_id = {item[1]: item[0] for item in tables['categories']}
    mappings['category_name'] = [[name_id, category_to_id[category]] for name_id, category in mappings['category_name']]
    output_file = os.path.join(data_directory, 'category_name.csv')
    write_table_to_csv(output_file, ['name_id', 'category_id'], mappings['category_name'])

    print("CSV files created.")

if __name__ == '__main__':
    main()
