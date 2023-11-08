import csv
import os
import pyphen
from collections import defaultdict

# Function to create a directory if it doesn't exist
def create_directory(directory_name):
    if not os.path.exists(directory_name):
        os.makedirs(directory_name)

# Function to count syllables using pyphen
def count_syllables(name):
    dic = pyphen.Pyphen(lang='en')
    hyphenated = dic.inserted(name)
    return hyphenated.count('-') + 1

# Function to read CSV and populate tables and mapping dictionaries
def read_csv_to_populate_tables(filepath, tables, mappings, unique_genders, unique_origins, unique_categories, gender_to_id, origin_to_id, category_to_id):
    with open(filepath, 'r', encoding='utf-8') as csvfile:
        csvreader = csv.DictReader(csvfile)
        for row in csvreader:
            name = row['Name']
            meaning = row.get('Meaning', '')
            gender = row.get('Gender', '')
            origin = row.get('Origin', '')
            categories = row.get('Categories', '')
            syllables = row.get('Syllables', '')

            # Check if syllables is "0" or empty, and calculate if needed
            if not syllables or syllables == "0":
                syllables = str(count_syllables(name))

            # Add gender to unique list if not empty
            if gender:
                unique_genders.add(gender)

            # Split and clean origin data
            origins_list = [o.strip() for o in origin.split(',') if o.strip()]
            for origin_name in origins_list:
                unique_origins.add(origin_name)

            # Split and clean categories data
            categories_list = [c.strip() for c in categories.split(',') if c.strip()]
            for category_name in categories_list:
                unique_categories.add(category_name)

            name_id = len(tables['names']) + 1
            gender_id = gender_to_id.get(gender, None)
            name_data = [name_id, name, meaning, syllables]

            # Add gender_id if available
            if gender_id is not None:
                name_data.append(gender_id)

            # Populate names table
            tables['names'].append(name_data)

            # Populate the category_name mapping
            for category in categories_list:
                category_id = category_to_id.get(category)
                if category_id:
                    mappings['category_name'].add((name_id, category_id))

            # Populate the name_origin mapping
            for origin_name in origins_list:
                origin_id = origin_to_id.get(origin_name)
                if origin_id:
                    mappings['name_origin'].add((name_id, origin_id))

# Function to write a table to a CSV file
def write_table_to_csv(filepath, header, table):
    with open(filepath, 'w', newline='', encoding='utf-8') as csvfile:
        csvwriter = csv.writer(csvfile)
        csvwriter.writerow(header)
        csvwriter.writerows(table)

# Main function to execute the script
def main():
    data_directory = 'database'
    create_directory(data_directory)

    tables = {
        'names': [],
        'genders': [],
        'origins': [],
        'categories': []
    }

    # Sets to ensure uniqueness
    unique_genders = set()
    unique_origins = set()
    unique_categories = set()
    mappings = {
        'category_name': set(),
        'name_origin': set()
    }

    # First pass to collect unique genders, origins, and categories
    input_file = 'temp/names_db.csv'
    read_csv_to_populate_tables(input_file, tables, mappings, unique_genders, unique_origins, unique_categories, {}, {}, {})

    # Create ID mappings
    gender_to_id = {gender: idx + 1 for idx, gender in enumerate(sorted(unique_genders))}
    origin_to_id = {origin: idx + 1 for idx, origin in enumerate(sorted(unique_origins))}
    category_to_id = {category: idx + 1 for idx, category in enumerate(sorted(unique_categories))}

    # Create gender, origin, and category tables
    tables['genders'] = [[idx + 1, gender] for idx, gender in enumerate(sorted(unique_genders))]
    tables['origins'] = [[idx + 1, origin] for idx, origin in enumerate(sorted(unique_origins))]
    tables['categories'] = [[idx + 1, category] for idx, category in enumerate(sorted(unique_categories))]

    # Clear previous tables to avoid duplicating entries
    tables['names'].clear()
    mappings['category_name'].clear()
    mappings['name_origin'].clear()

    # Second pass to update names table with correct gender_ids and origin_ids
    read_csv_to_populate_tables(input_file, tables, mappings, unique_genders, unique_origins, unique_categories, gender_to_id, origin_to_id, category_to_id)

    # Write tables to CSV
    output_files = {
        'names': ['id', 'name', 'meaning', 'syllables', 'gender_id'],
        'genders': ['id', 'name'],
        'origins': ['id', 'name'],
        'categories': ['id', 'name']
    }

    for table_name, data in tables.items():
        output_file = os.path.join(data_directory, f"{table_name}.csv")
        header = output_files[table_name]
        write_table_to_csv(output_file, header, data)

    # Write mappings to CSV
    mapping_files = {
        'category_name': ['name_id', 'category_id'],
        'name_origin': ['name_id', 'origin_id']
    }

    for mapping_name, data in mappings.items():
        output_file = os.path.join(data_directory, f"{mapping_name}.csv")
        header = mapping_files[mapping_name]
        write_table_to_csv(output_file, header, list(data))  # Convert set to list before writing

    print("Corrected CSV files created.")

if __name__ == '__main__':
    main()
