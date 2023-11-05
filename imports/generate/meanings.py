import openai
import json
import csv
import os

openai.api_key = "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"
model_engine = "gpt-3.5-turbo"

input_file = "../temp/names_root.csv"
output_file = "../temp/names_root.json"
names_get_path = '../temp/names_get.csv'

def fetch_name_details(name):
    try:
        response = openai.ChatCompletion.create(
            model=model_engine,
            messages=[
                {"role": "system", "content": "You are an intelligent assistant capable of providing detailed information about names."},
                {"role": "user", "content": f'''What are the meanings of the name {name}? Provide multiple meanings (should be as array element, all meanings as comma separated string, if there are multiple origins use multiple array elements) if available, in valid JSON format including the name. if meaning isnt available, just left it empty.'''}
            ]
        )

        # Check if the message_content is in the expected JSON format
        message_content = response.choices[0].get('message', {}).get('content', '')
        if message_content.startswith('{') and message_content.endswith('}'):
            # Parse the JSON content
            api_data = json.loads(message_content)
            api_data['name'] = name  # Add the name to the JSON data
            return api_data
        else:
            # Handle non-JSON response (or implement a more robust check)
            print(f"Received non-JSON response: {message_content}")
            return None
    except json.JSONDecodeError as e:
        print(f"Error parsing JSON response: {e}")
        return None
    except Exception as e:
        print(f"An error occurred: {e}")
        return None

def create_temp_csv(input_file, names_get_path):
    # Check if ../temp/ directory exists and create if not
    os.makedirs(os.path.dirname(names_get_path), exist_ok=True)

    with open(input_file, 'r', encoding='utf-8') as csvfile, open(names_get_path, 'w', newline='', encoding='utf-8') as names_get_file:
        csvreader = csv.DictReader(csvfile)
        fieldnames = csvreader.fieldnames

        if 'Meaning' in fieldnames:
            csvwriter = csv.DictWriter(names_get_file, fieldnames=fieldnames)
            csvwriter.writeheader()

            for row in csvreader:
                # Strip out any whitespace and check if the name is alphabetic
                name = row['Name'].strip().replace(" ", "")
                if name.isalpha() and not row['Meaning'].strip():  # Check if 'Meaning' is empty and name is alphabetic
                    csvwriter.writerow({'Name': row['Name'], 'Meaning': row['Meaning']})
        else:
            print("The 'Meaning' column does not exist in the CSV file.")

def main():
    create_temp_csv(input_file, names_get_path)

    processed_count = 0

    # Open the JSON file and load existing data or initialize an empty list
    if not os.path.exists(output_file) or os.stat(output_file).st_size == 0:
        with open(output_file, 'w', encoding='utf-8') as jsonfile:
            json.dump([], jsonfile)

    with open(names_get_path, 'r', encoding='utf-8') as names_get_file:
        csvreader = csv.DictReader(names_get_file)

        for row in csvreader:
            if processed_count >= 20:  # Stop after processing 2 names
                break

            name = row['Name'].strip()
            details = fetch_name_details(name)
            if details:
                # Open the JSON file and read the current list of names
                with open(output_file, 'r+', encoding='utf-8') as jsonfile:
                    try:
                        name_details_list = json.load(jsonfile)
                    except json.JSONDecodeError:
                        # If the file is empty, initialize with an empty list
                        name_details_list = []

                    name_details_list.append(details)

                    # Rewind to the beginning of the file to overwrite it
                    jsonfile.seek(0)
                    json.dump(name_details_list, jsonfile, ensure_ascii=False, indent=4)
                    # Truncate the file to the new size
                    jsonfile.truncate()

                processed_count += 1

if __name__ == "__main__":
    main()
