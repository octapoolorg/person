import csv
import os
from collections import defaultdict

# Create a directory if it doesn't exist
def create_directory(directory_name):
    if not os.path.exists(directory_name):
        os.makedirs(directory_name)

# Read CSV and populate tables and mapping dictionaries
def read_csv_to_populate_tables(filepath, tables, mappings, unique_genders, unique_origins, gender_to_id=None, origin_to_id=None):
    with open(filepath, 'r', encoding='utf-8') as csvfile:
        csvreader = csv.reader(csvfile)
        next(csvreader)  # skip header
        for row in csvreader:
            name, meaning, gender, origin, categories, syllables = row
            unique_genders.add(gender)
            unique_origins.add(origin)
            name_id = len(tables['names']) + 1
            gender_id = gender_to_id.get(gender) if gender_to_id else None
            origin_id = origin_to_id.get(origin) if origin_to_id else None
            tables['names'].append([name_id, name, meaning, gender_id, origin_id, syllables])

            for category in categories.split(","):
                category = category.strip()
                mappings['category_name'].append([name_id, category])

# Write a table to a CSV file
def write_table_to_csv(filepath, header, table):
    with open(filepath, 'w', newline='', encoding='utf-8') as csvfile:
        csvwriter = csv.writer(csvfile)
        csvwriter.writerow(header)
        csvwriter.writerows(table)

# Main function
def main():
    # Initialize
    data_directory = 'database'
    create_directory(data_directory)
    tables = defaultdict(list)
    unique_genders = set()
    unique_origins = set()
    mappings = defaultdict(list)

    # First pass to populate tables
    input_file = 'temp/names_root.csv'
    read_csv_to_populate_tables(input_file, tables, mappings, unique_genders, unique_origins)

    # Create a category to ID mapping based on first pass
    category_to_id = {category: idx+1 for idx, category in enumerate(sorted(set(category for _, category in mappings['category_name'])))}
    tables['categories'] = [[idx, category] for category, idx in category_to_id.items()]

    # Convert unique sets to tables with ID
    tables['genders'] = [[idx+1, item] for idx, item in enumerate(sorted(unique_genders))]
    tables['origins'] = [[idx+1, item] for idx, item in enumerate(sorted(unique_origins))]

    # Create gender and origin ID mappings
    gender_to_id = {item[1]: item[0] for item in tables['genders']}
    origin_to_id = {item[1]: item[0] for item in tables['origins']}

    # Second pass to populate names with IDs for genders and origins
    tables['names'].clear()
    mappings['category_name'].clear()
    read_csv_to_populate_tables(input_file, tables, mappings, unique_genders, unique_origins, gender_to_id, origin_to_id)

    # Write tables to CSV
    output_files = {
        'names': ['id', 'name', 'meaning', 'gender_id', 'origin_id', 'syllables'],
        'genders': ['id', 'name'],
        'origins': ['id', 'name'],
        'categories': ['id', 'name']
    }

    for table_name, header in output_files.items():
        output_file = os.path.join(data_directory, f"{table_name}.csv")
        write_table_to_csv(output_file, header, tables[table_name])

    # Correct the category_name mapping based on category_to_id
    mappings['category_name'] = [[name_id, category_to_id.get(category, "Unknown")] for name_id, category in mappings['category_name']]

    # Handle mappings
    output_file = os.path.join(data_directory, 'category_name.csv')
    write_table_to_csv(output_file, ['name_id', 'category_id'], mappings['category_name'])

    print("CSV files created.")

if __name__ == '__main__':
    main()
