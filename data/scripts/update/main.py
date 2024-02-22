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

# Step 1: Populate name_to_id mapping
name_to_id = {}
data_lines = []

def first_pass():
    with open(jsonl_input_path, 'r') as file:
        for line in file:
            data = json.loads(line)
            data_lines.append(data)  # Save the data for the second pass
            name_to_id[data['name']] = data['id']

# Step 2: Process each line to populate data storage
def second_pass():
    for data in data_lines:
        name_id = data['id']
        data_storage['names'].append([name_id, data['name'], data['gender'], data['pronunciation'], data['popularity']])
        process_origins(name_id, data.get('origins', []))
        process_quotes(name_id, data.get('quotes', []))
        process_relationships(name_id, data.get('sibling_names', []), 'sibling_names')
        process_relationships(name_id, data.get('similar_names', []), 'similar_names')
        process_nicknames(name_id, data.get('nicknames', []))

def process_origins(name_id, origins):
    for origin in origins:
        origin_id = len(data_storage['origins']) + 1
        data_storage['origins'].append([origin_id, name_id, origin['origin']])
        data_storage['meanings'].append([origin_id, origin['meanings'], origin['description']])

def process_quotes(name_id, quotes):
    data_storage['quotes'].extend([[name_id, quote] for quote in quotes])

def process_relationships(name_id, names_list, category):
    for name in names_list:
        related_name_id = name_to_id.get(name)
        if related_name_id is not None:
            data_storage[category].append([name_id, related_name_id])

def process_nicknames(name_id, nicknames):
    data_storage['nicknames'].extend([[name_id, nickname] for nickname in nicknames])

def write_csv():
    for category, path in output_paths.items():
        with open(path, mode='w', newline='') as file:
            writer = csv.writer(file)
            writer.writerow(headers[category])
            writer.writerows(data_storage[category])

def main():
    first_pass()  # Populate name_to_id with all names
    second_pass()  # Process relationships and other data
    write_csv()  # Write data to CSV files
    print("CSV files have been generated successfully.")

if __name__ == "__main__":
    main()