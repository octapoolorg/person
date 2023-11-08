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

def create_temp_csv(input_file, names_get_path):
    os.makedirs(os.path.dirname(names_get_path), exist_ok=True)
    with open(input_file, 'r', encoding='utf-8') as csvfile, open(names_get_path, 'w', newline='', encoding='utf-8') as names_get_file:
        csvreader = csv.DictReader(csvfile)
        fieldnames = csvreader.fieldnames
        if 'Meaning' in fieldnames:
            csvwriter = csv.DictWriter(names_get_file, fieldnames=fieldnames)
            csvwriter.writeheader()
            for row in csvreader:
                name = row['Name'].strip()
                if name.isalpha() and not row['Meaning'].strip():
                    csvwriter.writerow({'Name': name, 'Meaning': ''})
        else:
            logging.error("The 'Meaning' column does not exist in the CSV file.")

def append_to_json_file(file_path, data):
    with open(file_path, 'r+', encoding='utf-8') as jsonfile:
        try:
            name_details_list = json.load(jsonfile)
        except json.JSONDecodeError:
            name_details_list = []
        name_details_list.extend(data)
        jsonfile.seek(0)
        json.dump(name_details_list, jsonfile, ensure_ascii=False, indent=4)
        jsonfile.truncate()

def main():
    create_temp_csv(input_file, names_get_path)

    # Ensure the output file exists and is a valid JSON
    if not os.path.exists(output_file) or os.stat(output_file).st_size == 0:
        with open(output_file, 'w', encoding='utf-8') as jsonfile:
            json.dump([], jsonfile)

    with open(names_get_path, 'r', encoding='utf-8') as names_get_file, \
         open(output_file, 'r+', encoding='utf-8') as jsonfile:
        csvreader = csv.DictReader(names_get_file)
        names_list = [row['Name'].strip() for row in csvreader if row['Name'].strip().isalpha()]

        # Load existing data
        try:
            name_details_list = json.load(jsonfile)
        except json.JSONDecodeError:
            name_details_list = []

        with ThreadPoolExecutor(max_workers=5) as executor:
            futures = [executor.submit(fetch_name_details, name) for name in names_list]
            for future in as_completed(futures):
                details = future.result()
                if details:
                    name_details_list.append(details)
                    # Move the file pointer to the start
                    jsonfile.seek(0)
                    # Write the updated list back to the file
                    json.dump(name_details_list, jsonfile, ensure_ascii=False, indent=4)
                    # Truncate the file in case the new data is smaller than the old data
                    jsonfile.truncate()

if __name__ == "__main__":
    main()
