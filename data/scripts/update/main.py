import json
import csv

# Define paths for the input and output files
jsonl_input_path = 'data.jsonl'
output_paths = {
    'names': 'names.csv',
    'origins': 'origins.csv',
    'name_origins': 'name_origins.csv',
    'meanings': 'meanings.csv',
    'quotes': 'quotes.csv',
    'sibling_names': 'sibling_names.csv',
    'nicknames': 'nicknames.csv',
    'similar_names': 'similar_names.csv',
}

# Initialize storage for CSV data
data_storage = {key: [] for key in output_paths.keys()}
headers = {
    'names': ['id', 'name', 'meanings', 'gender', 'pronunciation', 'popularity'],
    'origins': ['id', 'origin'],
    'name_origins': ['id', 'name_id', 'origin_id'],
    'meanings': ['origin_id', 'meaning', 'description'],
    'quotes': ['id', 'name_id', 'quote'],
    'sibling_names': ['id', 'name_id', 'sibling_name_id'],
    'nicknames': ['id', 'name_id', 'nickname'],
    'similar_names': ['id', 'name_id', 'similar_name_id'],
}

# Additional mappings
name_to_id = {}
unique_origins = set()
origin_to_id = {}
data_lines = []

def clean_string(s):
    if not isinstance(s, str):
        return s
    # Check if the string is wrapped in double quotes
    if s.startswith('"') and s.endswith('"'):
        # Remove the outer double quotes temporarily
        temp_s = s[1:-1]
        # Replace internal double quotes with single quotes
        temp_s = temp_s.replace('""', "'")
        # Determine if we need to re-add outer double quotes
        # This is a simplified condition, you might need to expand it
        if ',' in temp_s or "'" in temp_s:
            return '"' + temp_s + '"'
        else:
            return temp_s
    else:
        # For strings not starting and ending with double quotes, just replace "" with '
        return s.replace('""', "'")

def populate_origins_and_mappings():
    origin_id = 1
    for data in data_lines:
        for origin in data.get('origins', []):
            origin_name = clean_string(origin['origin'])
            if origin_name not in unique_origins:
                unique_origins.add(origin_name)
                origin_to_id[origin_name] = origin_id
                data_storage['origins'].append([origin_id, origin_name])
                origin_id += 1

def first_pass():
    with open(jsonl_input_path, 'r') as file:
        for line in file:
            data = json.loads(line)
            data_lines.append(data)
            name_to_id[clean_string(data['name'])] = data['id']
    populate_origins_and_mappings()

def process_list(name_id, data, key, process_func):
    items = data.get(key, [])
    if items:
        process_func(name_id, items)

def process_items(name_id, items, category):
    if category == 'origins':
        for item in items:
            origin_name = clean_string(item['origin'])
            origin_id = origin_to_id[origin_name]
            no_id = len(data_storage['name_origins']) + 1
            data_storage['name_origins'].append([no_id, name_id, origin_id])
            if item.get('meanings') is not None:  # Ensure there are meanings to process
                item['meanings'] = filter_meanings(item['meanings'].split(', '))
                # convert meanings to a string
                item['meanings'] = ', '.join(item['meanings'])
                data_storage['meanings'].append([origin_id, clean_string(item['meanings']), clean_string(item.get('description', ''))])
    elif category in ['sibling_names', 'similar_names']:
        for related_name in items:
            if isinstance(related_name, list):
                related_name = ' '.join(related_name)  # Join list elements into a string
            related_name_id = name_to_id.get(clean_string(related_name))
            if related_name_id:
                rel_id = len(data_storage[category]) + 1
                data_storage[category].append([rel_id, name_id, related_name_id])
    elif category == 'quotes':
        for quote in items:
            quote_id = len(data_storage['quotes']) + 1
            data_storage['quotes'].append([quote_id, name_id, clean_string(quote)])
    elif category == 'nicknames':
        for nickname in items:
            nickname_id = len(data_storage['nicknames']) + 1
            data_storage['nicknames'].append([nickname_id, name_id, clean_string(nickname)])

def filter_meanings(meanings_list):
    cleaned_meanings = [meaning.strip() for meaning in meanings_list if meaning.strip()]

    # Filter out meanings that are contained in others
    filtered_meanings = []
    for meaning in cleaned_meanings:
        if not any(meaning != other and meaning in other for other in cleaned_meanings):
            filtered_meanings.append(meaning)

    # Deduplicate while preserving order
    final_meanings = []
    for meaning in filtered_meanings:
        if meaning not in final_meanings:
            final_meanings.append(meaning)

    # convert to title case
    final_meanings = [meaning.title() for meaning in final_meanings]

    return final_meanings

def second_pass():
    for data in data_lines:
        name_id = data['id']
        all_meanings = []

        # Collect meanings for filtering
        for origin in data.get('origins', []):
            if 'meanings' in origin and origin['meanings'] is not None:  # Ensure there are meanings to process
                if isinstance(origin['meanings'], list):
                    origin['meanings'] = ', '.join(origin['meanings'])  # Join list elements into a string
                all_meanings.extend([meaning.strip() for meaning in origin['meanings'].split(', ')])

        # Filter meanings using the standalone function
        filtered_meanings = filter_meanings(all_meanings)

        # Convert the list of filtered meanings to a string, taking up to the top 3
        top_meanings = ', '.join(filtered_meanings[:3])

        data_storage['names'].append([
            name_id,
            clean_string(data.get('name')),
            top_meanings,
            clean_string(data.get('gender')),
            clean_string(data.get('pronunciation')),
            clean_string(data.get('popularity'))
        ])
        for key in ['origins', 'quotes', 'sibling_names', 'nicknames', 'similar_names']:
            process_list(name_id, data, key, lambda id, items: process_items(id, items, key))

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
