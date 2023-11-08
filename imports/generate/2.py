import json
import csv
import logging

# Setup logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

input_json_file = "../temp/names_root.json"  # JSON input file path
output_csv_file = "../temp/names_converted.csv"  # CSV output file path

def json_to_csv(json_filepath, csv_filepath):
    try:
        # Read the JSON file
        with open(json_filepath, 'r', encoding='utf-8') as jsonfile:
            data = json.load(jsonfile)

        # Collect all unique fieldnames from the details dictionaries
        fieldnames = set()
        for entry in data:
            fieldnames.update(entry['details'].keys())
        fieldnames = ['name'] + list(fieldnames)

        # Open the CSV file for writing
        with open(csv_filepath, 'w', newline='', encoding='utf-8') as csvfile:
            csvwriter = csv.DictWriter(csvfile, fieldnames=fieldnames)
            csvwriter.writeheader()

            # Write the rows
            for entry in data:
                row = {'name': entry['name']}
                row.update(entry['details'])  # Flatten the nested 'details' dictionary
                # Fill in missing keys with None or an empty string
                for key in fieldnames:
                    row.setdefault(key, None)
                csvwriter.writerow(row)
                
        logging.info(f"CSV file created successfully at {csv_filepath}")

    except FileNotFoundError as e:
        logging.error(f"File not found: {e}")
    except json.JSONDecodeError as e:
        logging.error(f"Error decoding JSON: {e}")
    except csv.Error as e:
        logging.error(f"Error writing CSV: {e}")
    except Exception as e:
        logging.error(f"An unexpected error occurred: {e}")

if __name__ == "__main__":
    json_to_csv(input_json_file, output_csv_file)
