import csv
import os
import pyphen
import random
import chardet
from collections import defaultdict

numerology_meanings = {
    1: ['Leader', 'Independent', 'Innovative', 'Courageous', 'Original', 'Assertive', 'Pioneering', 'Ambitious',
        'Creative', 'Determined'],
    2: ['Cooperative', 'Diplomatic', 'Sensitive', 'Peaceful', 'Harmonious', 'Understanding', 'Kind', 'Considerate',
        'Gentle', 'Empathetic'],
    3: ['Creative', 'Social', 'Expressive', 'Optimistic', 'Enthusiastic', 'Artistic', 'Inspiring', 'Communicative',
        'Friendly', 'Vibrant'],
    4: ['Organized', 'Practical', 'Reliable', 'Disciplined', 'Stable', 'Hardworking', 'Loyal', 'Trustworthy',
        'Determined', 'Steadfast'],
    5: ['Adventurous', 'Energetic', 'Curious', 'Flexible', 'Versatile', 'Dynamic', 'Exciting', 'Fearless',
        'Progressive', 'Inquisitive'],
    6: ['Caring', 'Responsible', 'Protective', 'Nurturing', 'Sympathetic', 'Compassionate', 'Fair', 'Family-Oriented',
        'Community-Minded', 'Supportive'],
    7: ['Intellectual', 'Analytical', 'Thoughtful', 'Intuitive', 'Mystical', 'Philosophical', 'Contemplative',
        'Reflective', 'Insightful', 'Perceptive'],
    8: ['Ambitious', 'Efficient', 'Powerful', 'Confident', 'Realistic', 'Authoritative', 'Decisive', 'Professional',
        'Goal-Oriented', 'Resourceful'],
    9: ['Humanitarian', 'Generous', 'Altruistic', 'Compassionate', 'Idealistic', 'Global', 'Charitable', 'Empathetic',
        'Healing', 'Benevolent'],
    11: ['Master Intuition', 'Spiritual Messenger', 'Inspiration', 'Enlightenment', 'Idealism', 'Visionary',
         'Charisma'],
    22: ['Master Builder', 'Large Endeavors', 'Powerful Force', 'Leadership', 'Achievement', 'Manifestation',
         'Innovation'],
    33: ['Master Teacher', 'Compassion', 'Blessing', 'Inspiration', 'Enlightenment', 'Humanitarian', 'Understanding']
}

def detect_encoding(file_path):
    with open(file_path, 'rb') as file:
        result = chardet.detect(file.read())
        print(f"Detected encoding: {result['encoding']} with confidence: {result['confidence']}")
        return result['encoding']

def try_read_csv(file_path, encoding):
    with open(file_path, 'r', encoding=encoding) as file:
        return list(csv.DictReader(file, delimiter=','))

def clean_string(s):
    """Remove line breaks and extra spaces from a string."""
    return ' '.join(s.replace('\n', ' ').replace('\r', ' ').strip().split())

def calculate_numerology(name):
    values = {'A': 1, 'B': 2, 'C': 3, 'D': 4, 'E': 5, 'F': 6, 'G': 7, 'H': 8, 'I': 9, 'J': 10, 'K': 11, 'L': 12,
              'M': 13,
              'N': 14, 'O': 15, 'P': 16, 'Q': 17, 'R': 18, 'S': 19, 'T': 20, 'U': 21, 'V': 22, 'W': 23, 'X': 24,
              'Y': 25,
              'Z': 26}
    name_sum = sum(values.get(char.upper(), 0) for char in name if char.isalpha())

    # Adjusting for master numbers
    if name_sum in [11, 22, 33]:
        return name_sum
    while name_sum > 9:
        name_sum = sum(int(digit) for digit in str(name_sum))
    return name_sum


def get_numerology_meaning(name, numerology_dict):
    if not name.strip():
        return ''
    num_value = calculate_numerology(name)
    meanings = numerology_dict.get(num_value, [])
    if meanings:
        num_characteristics = random.randint(1, min(5, len(meanings)))
        return ', '.join(random.sample(meanings, num_characteristics))
    return ''


# Function to create a directory if it doesn't exist
def create_directory(directory_name):
    if not os.path.exists(directory_name):
        os.makedirs(directory_name)


# Function to count syllables using pyphen
def count_syllables(name):
    dic = pyphen.Pyphen(lang='en')
    hyphenated = dic.inserted(name)
    return hyphenated.count('-') + 1


# Function to read CSV and populate tables and mapping dictionaries
def read_csv_to_populate_tables(filepath, tables, mappings, unique_genders, unique_origins, unique_categories, gender_to_id, origin_to_id, category_to_id, error_file_path):
    # Detect encoding
    encoding_guess = detect_encoding(filepath)

    # Fallback encodings if the first guess fails
    fallback_encodings = ['utf-8', 'latin1', 'windows-1252']
    if encoding_guess:
        fallback_encodings.insert(0, encoding_guess)

    for encoding in fallback_encodings:
        try:
            rows = try_read_csv(filepath, encoding)
            break
        except UnicodeDecodeError:
            continue
    else:
        raise ValueError(f"Failed to read file {filepath} with encodings: {fallback_encodings}")

    with open(error_file_path, 'w', newline='', encoding='utf-8') as errorfile:
        error_writer = csv.DictWriter(errorfile, fieldnames=rows[0].keys())
        error_writer.writeheader()

        for row in rows:
            try:
                name = clean_string(row['Name'])
                meaning = clean_string(row.get('Meaning', ''))
                gender = clean_string(row.get('Gender', ''))
                origin = clean_string(row.get('Origin', ''))
                categories = clean_string(row.get('Categories', ''))
                syllables = clean_string(row.get('Syllables', ''))
                generated = 0

                # Check if meaning is empty, and calculate if needed
                if not meaning.strip():
                    meaning = get_numerology_meaning(name, numerology_meanings)
                    generated = 1

                # Check if syllables is "0" or empty, and calculate if needed
                if not syllables or syllables == "0":
                    syllables = str(count_syllables(name))

                # Add gender to unique list if not empty
                if gender:
                    unique_genders.add(gender)

                # Split and clean origin data
                origins_list = [o.strip() for o in origin.split(',') if o.strip()]
                for origin_name in origins_list:
                    unique_origins.add(origin_name)

                # Split and clean categories data
                categories_list = [c.strip() for c in categories.split(',') if c.strip()]
                for category_name in categories_list:
                    unique_categories.add(category_name)

                name_id = len(tables['names']) + 1
                gender_id = gender_to_id.get(gender, None)
                name_data = [name_id, name, meaning, syllables]

                # Add gender_id if available
                if gender_id is not None:
                    name_data.append(gender_id)

                name_data.append(generated)

                # Populate names table
                tables['names'].append(name_data)

                # Populate the category_name mapping
                for category in categories_list:
                    category_id = category_to_id.get(category)
                    if category_id:
                        mappings['category_name'].add((name_id, category_id))

                # Populate the name_origin mapping
                for origin_name in origins_list:
                    origin_id = origin_to_id.get(origin_name)
                    if origin_id:
                        mappings['name_origin'].add((name_id, origin_id))

            except Exception as e:
                print(f"Error processing row: {e}")
                error_writer.writerow(row)

# Function to write a table to a CSV file
def write_table_to_csv(filepath, header, table):
    with open(filepath, 'w', newline='', encoding='utf-8') as csvfile:
        csvwriter = csv.writer(csvfile)
        csvwriter.writerow(header)
        csvwriter.writerows(table)


# Main function to execute the script
def main():
    data_directory = 'database'
    error_file_path = 'temp/non_utf8_entries.csv'
    create_directory(data_directory)

    tables = {
        'names': [],
        'genders': [],
        'origins': [],
        'categories': []
    }

    # Sets to ensure uniqueness
    unique_genders = set()
    unique_origins = set()
    unique_categories = set()
    mappings = {
        'category_name': set(),
        'name_origin': set()
    }

    # First pass to collect unique genders, origins, and categories
    input_file = 'temp/names_db.csv'
    read_csv_to_populate_tables(input_file, tables, mappings, unique_genders, unique_origins, unique_categories, {}, {}, {}, error_file_path)

    # Create ID mappings
    gender_to_id = {gender: idx + 1 for idx, gender in enumerate(sorted(unique_genders))}
    origin_to_id = {origin: idx + 1 for idx, origin in enumerate(sorted(unique_origins))}
    category_to_id = {category: idx + 1 for idx, category in enumerate(sorted(unique_categories))}

    # Create gender, origin, and category tables
    tables['genders'] = [[idx + 1, gender] for idx, gender in enumerate(sorted(unique_genders))]
    tables['origins'] = [[idx + 1, origin] for idx, origin in enumerate(sorted(unique_origins))]
    tables['categories'] = [[idx + 1, category] for idx, category in enumerate(sorted(unique_categories))]

    # Clear previous tables to avoid duplicating entries
    tables['names'].clear()
    mappings['category_name'].clear()
    mappings['name_origin'].clear()

    # Second pass to update names table with correct gender_ids and origin_ids
    read_csv_to_populate_tables(input_file, tables, mappings, unique_genders, unique_origins, unique_categories, gender_to_id, origin_to_id, category_to_id, error_file_path)

    # Write tables to CSV
    output_files = {
        'names': ['id', 'name', 'meaning', 'syllables', 'gender_id', 'generated'],
        'genders': ['id', 'name'],
        'origins': ['id', 'name'],
        'categories': ['id', 'name']
    }

    for table_name, data in tables.items():
        output_file = os.path.join(data_directory, f"{table_name}.csv")
        header = output_files[table_name]
        write_table_to_csv(output_file, header, data)

    # Write mappings to CSV
    mapping_files = {
        'category_name': ['name_id', 'category_id'],
        'name_origin': ['name_id', 'origin_id']
    }

    for mapping_name, data in mappings.items():
        output_file = os.path.join(data_directory, f"{mapping_name}.csv")
        header = mapping_files[mapping_name]
        write_table_to_csv(output_file, header, list(data))  # Convert set to list before writing

    print("Corrected CSV files created.")


if __name__ == '__main__':
    main()
