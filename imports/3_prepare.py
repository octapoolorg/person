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

            # Split and clean origin data
            origins_list = [o.strip() for o in origin.split(',') if o.strip()]
            for origin_name in origins_list:
                unique_origins[origin_name] = unique_origins.get(origin_name, set())

            name_id = len(tables['names']) + 1
            gender_id = gender_to_id.get(gender) if gender_to_id else None

            # Populate names table
            tables['names'].append([name_id, name, meaning, gender_id, syllables])

            # Populate the category_name mapping
            for category in categories.split(","):
                category = category.strip()
                mappings['category_name'].append([name_id, category])

            # Populate the origin_name mapping
            for origin_name in origins_list:
                unique_origins[origin_name].add(name_id)

# Write a table to a CSV file
def write_table_to_csv(filepath, header, table):
    with open(filepath, 'w', newline='', encoding='utf-8') as csvfile:
        csvwriter = csv.writer(csvfile)
        csvwriter.writerow(header)
        csvwriter.writerows(table)

# Handle origins to create a unique list and mapping table
def handle_origins(unique_origins, tables, mappings):
    origin_to_id = {}
    origin_id = 1
    for origin_name, name_ids in unique_origins.items():
        origin_to_id[origin_name] = origin_id
        tables['origins'].append([origin_id, origin_name])
        for name_id in name_ids:
            mappings['name_origin'].append([name_id, origin_id])
        origin_id += 1
    return origin_to_id

# Main function
def main():
    # Initialize
    data_directory = 'database'
    create_directory(data_directory)
    tables = defaultdict(list)
    unique_genders = set()
    unique_origins = defaultdict(set)
    mappings = defaultdict(list)

    # First pass to populate tables
    input_file = 'temp/names_db.csv'
    read_csv_to_populate_tables(input_file, tables, mappings, unique_genders, unique_origins)

    # Convert unique genders to table with ID
    gender_to_id = {gender: idx + 1 for idx, gender in enumerate(sorted(unique_genders))}
    tables['genders'] = [[idx + 1, gender] for idx, gender in enumerate(sorted(unique_genders))]

    # Handle origins and create a mapping
    origin_to_id = handle_origins(unique_origins, tables, mappings)

    # Create a category to ID mapping based on first pass
    category_to_id = {category: idx+1 for idx, category in enumerate(sorted(set(category for _, category in mappings['category_name'])))}
    tables['categories'] = [[idx, category] for category, idx in category_to_id.items()]

    # Second pass to populate names with IDs for genders and origins
    tables['names'].clear()
    mappings['category_name'].clear()
    read_csv_to_populate_tables(input_file, tables, mappings, unique_genders, unique_origins, gender_to_id, origin_to_id)

    # Write tables to CSV
    output_files = {
        'names': ['id', 'name', 'meaning', 'gender_id', 'syllables'],
        'genders': ['id', 'gender'],
        'origins': ['id', 'origin'],
        'categories': ['id', 'category']
    }

    for table_name, header in output_files.items():
        output_file = os.path.join(data_directory, f"{table_name}.csv")
        write_table_to_csv(output_file, header, tables[table_name])

    # Correct the category_name mapping based on category_to_id
    mappings['category_name'] = [[name_id, category_to_id.get(category, "Unknown")] for name_id, category in mappings['category_name']]

    # Write mappings to CSV
    mapping_files = {
        'category_name': ['name_id', 'category_id'],
        'name_origin': ['name_id', 'origin_id']
    }

    for table_name, header in mapping_files.items():
        output_file = os.path.join(data_directory, f"{table_name}.csv")
        write_table_to_csv(output_file, header, mappings[table_name])

    print("CSV files created.")

if __name__ == '__main__':
    main()
