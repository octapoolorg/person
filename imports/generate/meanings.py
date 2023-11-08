import json
import csv
import os
import logging
from concurrent.futures import ThreadPoolExecutor, as_completed
from openai import OpenAI

# Setup logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

# API and file configuration
api_key = "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"
model_engine = "gpt-3.5-turbo-1106"
input_file = "../temp/names_root.csv"
output_file = "../temp/names_root.json"
names_get_path = '../temp/names_get.csv'
names_pending_path = '../temp/names_pending.csv'  # The new file for names pending processing

# Initialize the OpenAI client
client = OpenAI(api_key=api_key)

def fetch_name_details(name):
    try:
        response = client.chat.completions.create(
            model=model_engine,
            messages=[
                {"role": "system", "content": "You are an intelligent assistant capable of providing detailed information about names."},
                {"role": "user", "content": f"Write meanings(comma-separated list), origin and gender(m/f) of the name {name} in JSON, don't include name. leave blank if you don't know."},
            ],
            response_format={"type": "json_object"},
        )
        message_content = response.choices[0].message.content
        details = json.loads(message_content)  # Parse the JSON string into a Python dictionary
        logging.info(f"Received response for {name}: {details}")
        return {'name': name, 'details': details}
    except Exception as e:
        logging.error(f"An error occurred while fetching details for {name}: {e}")
        return None

def read_processed_names(output_file):
    processed_names = set()
    if os.path.exists(output_file) and os.path.getsize(output_file) > 0:
        with open(output_file, 'r', encoding='utf-8') as jsonfile:
            logging.info(f"Reading processed names from {output_file}...")
            processed_data = json.load(jsonfile)
            for entry in processed_data:
                logging.info(f"Adding {entry['name']} to the processed names set...")
                processed_names.add(entry['name'])
    return processed_names

def create_names_pending_csv(input_file, processed_names, names_pending_path):
    with open(input_file, 'r', encoding='utf-8') as infile, open(names_pending_path, 'w', newline='', encoding='utf-8') as outfile:
        reader = csv.DictReader(infile)
        fieldnames = reader.fieldnames
        writer = csv.DictWriter(outfile, fieldnames=fieldnames)
        writer.writeheader()
        for row in reader:
            if row['Name'] not in processed_names:
                writer.writerow(row)

def append_to_json_file(output_file, details):
    with open(output_file, 'r+', encoding='utf-8') as file:
        data = json.load(file)
        data.append(details)
        file.seek(0)
        json.dump(data, file, ensure_ascii=False, indent=4)
        file.truncate()

def main():
    logging.info("Starting the name details generation process...")
    processed_names = read_processed_names(output_file)
    create_names_pending_csv(names_get_path, processed_names, names_pending_path)

    with open(names_pending_path, 'r', encoding='utf-8') as csvfile:
        reader = csv.DictReader(csvfile)
        with ThreadPoolExecutor(max_workers=5) as executor:
            futures = {executor.submit(fetch_name_details, row['Name']): row for row in reader}
            for future in as_completed(futures):
                details = future.result()
                if details:
                    append_to_json_file(output_file, details)
                    logging.info(f"Added details for {details['name']} to the JSON file.")

if __name__ == "__main__":
    main()
