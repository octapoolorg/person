import glob
import json
import logging
import csv
from tqdm import tqdm
import string

# Configure logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

import re

def is_valid_name(obj):
    name = obj.get('name')

    filters = [
        # Filter 1: Check if the name is a string and not empty and not null
        lambda n: isinstance(n, str) and n != '' and n is not None,
        
        # must be at least 2 characters long
        lambda n: len(n) >= 2,        

        # Filter 2: Check if the name contains only English alphabets (including accented ones) and spaces - no numbers or special characters
        lambda n: re.match("^[A-Za-z \-’]*$", n) is not None and any(c.isalpha() for c in n),
    ]

    return all(f(name) for f in filters)

def is_valid_details(obj):
    try:
        # Check if obj is a dictionary
        if not isinstance(obj, dict):
            return False

        details = obj.get('details')

        # Check if details is a dictionary
        if not details or not isinstance(details, dict):
            return False

        meanings = details.get('meanings')

        # Check if meanings is a list and is not empty
        if not meanings or not isinstance(meanings, list) or len(meanings) == 0:
            return False

        # Filter out None values and non-string values
        meanings = [m for m in meanings if isinstance(m, str)]

        # Join all meanings into a single string
        all_meanings = ''.join(meanings)

        # Check if the total length of all meanings is less than 500
        return len(all_meanings) < 500

    except Exception as e:
        print(f"Error in is_valid_details: {e}")
        return False

def process_line(line):
    try:
        obj = json.loads(line.strip())
        if is_valid_name(obj) and is_valid_details(obj):
            return obj
    except json.JSONDecodeError as e:
        logging.error(f"Error decoding JSON: {e}")
    return None

def safe_join(items):
    """Join items ensuring all are strings and None values are handled."""
    # Check if items is None and return an empty string if true
    if items is None:
        return ''
    return ','.join(str(item) if item is not None else '' for item in items)

def handle_surrogates(s):
    """
    Attempt to encode the string using 'utf-8' and 'surrogatepass' to handle surrogates.
    If surrogates are present, they are replaced with a replacement character.
    """
    try:
        return s.encode('utf-8', 'surrogatepass').decode('utf-8', 'replace')
    except AttributeError:  # If s is not a string
        return s

def transform_details_to_csv_row(obj):
    details = obj.get('details', {}) or {}  # Ensure details is a dict even if missing or None
    # Process each key, ensuring we handle None values as empty lists
    return {
        'name': handle_surrogates(obj.get('name', '')),
        'categories': safe_join([handle_surrogates(item) for item in (details.get('categories') or [])]),
        'pronunciations': safe_join([handle_surrogates(item) for item in (details.get('pronunciations') or [])]),
        'gender': handle_surrogates(details.get('gender', '')),
        'language': safe_join([handle_surrogates(item) for item in (details.get('language') or [])]),
        'meanings': safe_join([handle_surrogates(item) for item in (details.get('meanings') or [])]),
        'origins': safe_join([handle_surrogates(item) for item in (details.get('origins') or [])]),
        'root_name_id': handle_surrogates(obj.get('root_name_id', ''))
    }


def process_jsonl_files_to_csv(source_pattern, csv_file_path):
    files = glob.glob(source_pattern)
    if not files:
        logging.warning("No files found.")
        return

    with open(csv_file_path, 'w', newline='', encoding='utf-8') as csvfile:
        fieldnames = ['name', 'categories', 'pronunciations', 'gender', 'language', 'meanings', 'origins', 'root_name_id']
        writer = csv.DictWriter(csvfile, fieldnames=fieldnames, quoting=csv.QUOTE_ALL, escapechar='\\')
        writer.writeheader()

        for file_path in tqdm(files, desc="Processing files"):
            logging.info(f"Processing: {file_path}")
            with open(file_path, 'r', buffering=1 << 16) as in_file:
                for line in in_file:
                    valid_obj = process_line(line)
                    if valid_obj:
                        csv_row = transform_details_to_csv_row(valid_obj)
                        writer.writerow(csv_row)

    logging.info(f"CSV file created: {csv_file_path}")

# Paths
source_pattern = '../data/generated/details_*.jsonl'
csv_file_path = 'names.csv'

# Process Files
process_jsonl_files_to_csv(source_pattern, csv_file_path)