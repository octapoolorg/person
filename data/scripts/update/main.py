import json
import csv

# Define paths for the input and output files
jsonl_input_path = 'data.jsonl'
output_paths = {
    'names': 'names.csv',
    'origins': 'origins.csv',
    'meanings': 'meanings.csv',
    'quotes': 'quotes.csv',
    'sibling_names': 'sibling_names.csv',
    'nicknames': 'nicknames.csv',
    'similar_names': 'similar_names.csv',
}

# Initialize storage for CSV data
data_storage = {key: [] for key in output_paths}
headers = {
    'names': ['id', 'name', 'gender', 'pronunciation', 'popularity'],
    'origins': ['id', 'name_id', 'origin'],
    'meanings': ['origin_id', 'meaning', 'description'],
    'quotes': ['name_id', 'quote'],
    'sibling_names': ['name_id', 'sibling_name_id'],
    'nicknames': ['name_id', 'nickname'],
    'similar_names': ['name_id', 'similar_name_id'],
}

# Function to clean strings: remove outer quotes and replace internal double quotes with single quotes
def clean_string(s):
    # Check if s is None or not a string, return s as-is if so
    if not isinstance(s, str):
        return s
    return s.strip('"').replace('""', "'")

# Populate name_to_id mapping
name_to_id = {}
data_lines = []

def first_pass():
    with open(jsonl_input_path, 'r') as file:
        for line in file:
            data = json.loads(line)
            data_lines.append(data)  # Save the data for the second pass
            name_to_id[data['name']] = data['id']

# Process list of items
def process_list(name_id, data, key, process_func):
    items = data.get(key, [])
    if items:
        process_func(name_id, items)

# Process items based on category
def process_items(name_id, items, category):
    for item in items:
        if category == 'origins':
            origin_id = len(data_storage['origins']) + 1
            data_storage['origins'].append([origin_id, name_id, clean_string(item['origin'])])
            data_storage['meanings'].append([origin_id, clean_string(item['meanings']), clean_string(item['description'])])
        elif category in ['sibling_names', 'similar_names']:
            related_name_id = name_to_id.get(clean_string(item))
            if related_name_id is not None:
                data_storage[category].append([name_id, related_name_id])
        else:
            data_storage[category].extend([[name_id, clean_string(item)]])

# Second pass: process relationships and other data
def second_pass():
    for data in data_lines:
        name_id = data['id']
        data_storage['names'].append([name_id, clean_string(data.get('name', '')), clean_string(data.get('gender', '')), clean_string(data.get('pronunciation', '')), clean_string(data.get('popularity', ''))])
        for key in output_paths.keys():
            if key != 'names':
                process_list(name_id, data, key, lambda id, items: process_items(id, items, key))

# Write data to CSV files
def write_csv():
    for category, path in output_paths.items():
        with open(path, mode='w', newline='', encoding='utf-8') as file:
            writer = csv.writer(file)
            writer.writerow(headers[category])
            for row in data_storage[category]:
                writer.writerow([clean_string(cell) if isinstance(cell, str) else cell for cell in row])

def main():
    first_pass()  # Populate name_to_id with all names
    second_pass()  # Process relationships and other data
    write_csv()  # Write data to CSV files
    print("CSV files have been generated successfully.")

if __name__ == "__main__":
    main()
