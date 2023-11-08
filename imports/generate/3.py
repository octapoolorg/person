import csv
import logging

# Setup logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

input_csv_file = "../temp/names_converted.csv"  # Input CSV file path
output_csv_file = "../temp/names_meaning.csv"  # Output CSV file path

def filter_and_rename_csv_columns(input_csv_path, output_csv_path):
    try:
        with open(input_csv_path, mode='r', encoding='utf-8') as infile, \
                open(output_csv_path, mode='w', newline='', encoding='utf-8') as outfile:

            # Set up CSV reader and writer
            reader = csv.DictReader(infile)
            writer = csv.DictWriter(outfile, fieldnames=['name', 'gender', 'meanings', 'origin'])

            # Write the header
            writer.writeheader()

            for row in reader:
                # Prepare the new row with required columns and names
                new_row = {
                    'name': row.get('name'),
                    'gender': row.get('gender', ''),
                    'meanings': row.get('meanings', '') or row.get('Meanings', '') or row.get('meaning', ''),
                    'origin': row.get('origin', '') or row.get('origins', '') or row.get('Origin', '')
                }

                # Write the new row to the output file
                writer.writerow(new_row)
                
        logging.info(f"Filtered CSV file created successfully at {output_csv_path}")

    except FileNotFoundError as e:
        logging.error(f"File not found: {e}")
    except csv.Error as e:
        logging.error(f"Error reading or writing CSV: {e}")
    except Exception as e:
        logging.error(f"An unexpected error occurred: {e}")

if __name__ == "__main__":
    filter_and_rename_csv_columns(input_csv_file, output_csv_file)
