import csv
import os
from unicodedata import normalize

def sort_key_custom(item):
    # Cache the normalized sort key to avoid recomputing
    item['_sort_key'] = normalize('NFKD', item['name']).encode('ASCII', 'ignore'), item['name']
    return item['_sort_key']

def clean_and_read_csv(file_path):
    # Stream file content and yield cleaned lines
    with open(file_path, 'r', encoding='utf-8', errors='ignore') as file:
        for line in file:
            yield line.replace('\0', '')

def write_sorted_csv(data, output_file_path, fieldnames):
    with open(output_file_path, mode='w', newline='', encoding='utf-8') as csvfile:
        writer = csv.DictWriter(csvfile, fieldnames=fieldnames, quoting=csv.QUOTE_ALL)
        writer.writeheader()
        for row in data:
            # Remove temporary sort key before writing
            row.pop('_sort_key', None)
            writer.writerow(row)

def sort_and_rename_csv(input_file_path, output_file_path):
    # First, read and clean the CSV on the fly
    cleaned_lines = clean_and_read_csv(input_file_path)
    reader = csv.DictReader(cleaned_lines)

    # Convert reader to list to sort, with renaming 'root_name_id' to 'id' on the fly
    data = []
    for row in reader:
        if 'root_name_id' in row:
            row['id'] = row.pop('root_name_id')
        data.append(row)

    # Precompute sort keys
    for row in data:
        sort_key_custom(row)

    # Sort using precomputed sort keys
    sorted_data = sorted(data, key=lambda x: x['_sort_key'])

    # Determine fieldnames, ensuring 'id' is included and '_sort_key' is excluded
    fieldnames = [key if key != 'root_name_id' else 'id' for key in reader.fieldnames if key != 'root_name_id'] + ['id']
    fieldnames = [fn for fn in fieldnames if fn != '_sort_key']

    write_sorted_csv(sorted_data, output_file_path, fieldnames)

input_csv_path = '../imports/names.csv'
output_csv_path = '../imports/transformed_names.csv'

sort_and_rename_csv(input_csv_path, output_csv_path)
