import csv
import logging

# Setup logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

names_meaning_file = "../temp/names_meaning.csv"  # Input CSV file path
names_root_file = "../temp/names_root.csv"  # Input CSV file path
output_db_file = "../temp/names_db.csv"  # Output CSV file path

def combine_csv_files(meaning_file, root_file, output_file):
    try:
        # Read the names_meaning.csv file into a dictionary with name as the key
        with open(meaning_file, mode='r', encoding='utf-8') as infile:
            reader = csv.DictReader(infile)
            names_meaning_dict = {row['name'].lower(): row for row in reader}

        # Read the names_root.csv file and merge it with names_meaning.csv
        with open(root_file, mode='r', encoding='utf-8') as infile, \
                open(output_file, mode='w', newline='', encoding='utf-8') as outfile:

            reader = csv.DictReader(infile)
            fieldnames = reader.fieldnames + ['meanings', 'origin']  # add the extra fields from names_meaning.csv
            writer = csv.DictWriter(outfile, fieldnames=fieldnames)
            writer.writeheader()

            for row in reader:
                name_key = row['Name'].lower()
                meaning_row = names_meaning_dict.get(name_key, {})

                # If 'gender' is missing or 'unknown' in meaning_row, keep the value from root_row
                root_gender = row.get('Gender', '')
                meaning_gender = meaning_row.get('gender', '').lower()
                gender = root_gender if not meaning_gender or meaning_gender == 'unknown' else meaning_gender

                combined_row = {
                    'Name': row['Name'],
                    'Gender': gender,
                    'Meaning': ', '.join(filter(None, set(row.get('Meaning', '').split(', ') + meaning_row.get('meanings', '').split(', ')))),
                    'Origin': ', '.join(filter(None, set(row.get('Origin', '').split(', ') + meaning_row.get('origin', '').split(', '))))
                }

                # Update with any additional fields from the root file
                for key in row:
                    if key not in combined_row:
                        combined_row[key] = row[key]

                writer.writerow(combined_row)

        logging.info(f"Combined CSV file created successfully at {output_file}")

    except FileNotFoundError as e:
        logging.error(f"File not found: {e}")
    except csv.Error as e:
        logging.error(f"Error reading or writing CSV: {e}")
    except Exception as e:
        logging.error(f"An unexpected error occurred: {e}")

if __name__ == "__main__":
    combine_csv_files(names_meaning_file, names_root_file, output_db_file)
