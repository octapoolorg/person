import csv
from unicodedata import normalize
from tqdm import tqdm
from unidecode import unidecode

negative_words = [
    'sur', 'last', 'family', 'boy', 'unisex', 'Feminine', 'Gender', 'Male',
    'mascui','Masculi' ' Of ', 'start', ' end ', 'First', 'Last', ' In ',
    'Unknown', 'People', 'Mean',
    '"','Name','Baby','Given',
    'from','Origin','Mean','Language',
    'Org', 'Other', ' Related', 'Under', 'Unknown', 'Virgin', 'War', 'Weapon','Right', 'Word', 'common', 'Del', 
    'Mean','Monkey', 'Non','Nuclear', 'Programming', 'Admin', 'Division',
    ' A ', ' By ', '\'', 'ized'
]

#unique removal values - case sensitive
negative_words = list(dict.fromkeys(negative_words))

# File paths
input_csv_path = 'transformed_names_1.csv'
output_csv_path = 'transformed_names.csv'

def clean_and_merge(categories):
    combined = set(categories)
    
    # remove categories that contain negative words
    for word in negative_words:
        combined = [x for x in combined if word not in x]
    
    # trim and remove empty strings
    combined = [x.strip() for x in combined if x.strip()]
    
    # Remove category if it contains non-ascii characters
    combined = [x for x in combined if x.isascii()]
    
    # Remove category if it does not contain a space and length is more than 13
    combined = [x for x in combined if ' ' in x or len(x) <= 13]

    # Remove category if its length is less than 5 or more than 30
    combined = [x for x in combined if 5 <= len(x) < 30]
    
    # Remove category if it have 2 capital letters without space - like 'UnitedStates'
    combined = [x for x in combined if not any(x[i].isupper() and x[i+1].isupper() for i in range(len(x)-1))]
   
    cleaned_combined = sorted(combined, key=lambda x:unidecode(x))
    
    # Remove category if it contains a special character or a digit, but keep the ones that contain a space
    cleaned_combined = [x for x in cleaned_combined if x.isalpha() or ' ' in x]
        
    # capitalize the first letter of each word
    cleaned_combined = [x.title() for x in cleaned_combined]

    # remove category if it doesn't have complete set of parenthesis
    cleaned_combined = [x for x in cleaned_combined if x.count('(') == x.count(')')]
    
    # trim and remove empty strings
    cleaned_combined = [x.strip() for x in cleaned_combined if x.strip()]
    
    # Remove category if it contains more than 2 spaces
    cleaned_combined = [x for x in cleaned_combined if x.count(' ') <= 2]
    
    # Remove category if is starts with 2 or consecutive letters - case insensitive and length is less than 5
    cleaned_combined = [x for x in cleaned_combined if not any(x[i].lower() == x[i+1].lower() for i in range(len(x)-1)) and len(x) >= 5]
    
    # Remove category if it contains a number
    cleaned_combined = [x for x in cleaned_combined if not any(c.isdigit() for c in x)]
    
    # remove duplicates, trim spaces, and make case insensitive
    cleaned_combined = [x.strip().lower() for x in cleaned_combined]
    cleaned_combined = list(set(cleaned_combined))
    cleaned_combined = [x.title() for x in cleaned_combined]
    
    return ','.join(cleaned_combined)

def clean_origins(origins):
    origins = set(origins)
    
    # remove origins that contain negative words
    for word in negative_words:
        origins = [x for x in origins if word not in x]
        
    # Remove origins that contain non-ascii characters
    origins = [x for x in origins if x.isascii()]
    
    # Remove origin if it does not contain a space and length is more than 13
    origins = [x for x in origins if ' ' in x or len(x) <= 13]

    # Remove origin if its length is less than 5 or more than 30
    origins = [x for x in origins if 5 <= len(x) < 30]
    
    # Remove origin if it have 2 capital letters without space - like 'UnitedStates'
    origins = [x for x in origins if not any(x[i].isupper() and x[i+1].isupper() for i in range(len(x)-1))]
    
    # Remove origin if it contains a special character or a digit, but keep the ones that contain a space
    origins = [x for x in origins if x.isalpha() or ' ' in x]
    
    cleaned_origins = set(origins)
    
    cleaned_origins = sorted(cleaned_origins, key=lambda x:unidecode(x))

    # capitalize the first letter of each word
    cleaned_origins = [x.title() for x in cleaned_origins]
    
    # Remove origin if it contains a special character or a digit, but keep the ones that contain a space
    cleaned_origins = [x for x in cleaned_origins if x.isalpha() or ' ' in x]
    
    # remove origin if it doesn't have complete set of parenthesis
    cleaned_origins = [x for x in cleaned_origins if x.count('(') == x.count(')')]
    
    # trim and remove empty strings
    cleaned_origins = [x.strip() for x in cleaned_origins if x.strip()]
    
    # Remove origin if it contains more than 2 spaces
    cleaned_origins = [x for x in cleaned_origins if x.count(' ') <= 2]
    
    # Remove origin if is starts with 2 or consecutive letters - case insensitive and length is less than 5
    cleaned_origins = [x for x in cleaned_origins if not any(x[i].lower() == x[i+1].lower() for i in range(len(x)-1)) and len(x) >= 5]

    # Remove origin if it contains a number
    cleaned_origins = [x for x in cleaned_origins if not any(c.isdigit() for c in x)]

    # Remove duplicates
    cleaned_origins = [x.strip().lower() for x in cleaned_origins]
    cleaned_origins = list(set(cleaned_origins))
    cleaned_origins = [x.title() for x in cleaned_origins]
   

    return ','.join(cleaned_origins)

def clean_gender(genders):
    firstreplace = {
        'fem' : 'Feminine',
        'masc' : 'Masculine',
        'male' : 'Masculine',
        'boy' : 'Masculine',
        'neutral' : 'Unisex',
        'uni': 'Unisex',
        'neu': 'Unisex',
    }
    
    cleaned_gender = set()
    for g in genders:
        g = g.strip().lower()
        for key in firstreplace:
            if key in g:
                cleaned_gender.add(firstreplace[key])
                break
        else:  # This else corresponds to the for loop (not the if statement)
            cleaned_gender.add('Unknown') 

    if 'Masculine' in cleaned_gender and 'Feminine' in cleaned_gender:
        return 'Unisex'
    elif cleaned_gender:  # Check if cleaned_gender is not empty
        return next(iter(cleaned_gender))  # Return the first element in the set
    else:
        return 'Unknown'

def clean_meanings(meanings, name):
    # remove empty strings
    meanings = [x for x in meanings if x.strip()]

    # remove duplicates
    meanings = list(dict.fromkeys(meanings))

    # remove meanings that are equal to the name trimmed and case insensitive
    meanings = [x for x in meanings if x.lower().strip() != name.lower().strip()]

    # remove if first 4 words of multiple meanings are same, like 'The name means', 'The name means', 'The name means' - case insensitive
    start_phrase_to_meaning = {}
    for meaning in meanings:
        start_phrase = ' '.join(meaning.lower().split()[:4])
        if start_phrase not in start_phrase_to_meaning or len(meaning) > len(start_phrase_to_meaning[start_phrase]):
            start_phrase_to_meaning[start_phrase] = meaning

    cleaned_meanings = list(start_phrase_to_meaning.values())

    # keep a meaning if it contains any ascii characters, remove if it's completely non-ascii
    cleaned_meanings = [x for x in cleaned_meanings if x.isascii()]
    
    # sort the meanings by length from shortest to longest
    cleaned_meanings = sorted(cleaned_meanings, key=lambda x: len(x))
    
    # remove duplicates
    cleaned_meanings = [x.strip().lower() for x in cleaned_meanings]
    cleaned_meanings = list(set(cleaned_meanings))
    cleaned_meanings = [x.title() for x in cleaned_meanings]
           
    return ', '.join(cleaned_meanings)
    
def process_csv(input_file_path, output_file_path):
    with open(input_file_path, 'r', encoding='utf-8', errors='ignore') as infile:
        # Filter out null bytes on reading
        filtered_lines = (line.replace('\0', '') for line in infile)
        reader = csv.DictReader(filtered_lines)
        
        fieldnames = reader.fieldnames[:]
        if 'language' in fieldnames:
            fieldnames.remove('language')
        if 'root_name_id' in fieldnames:
            fieldnames[fieldnames.index('root_name_id')] = 'id'
        if 'categories' not in fieldnames:
            fieldnames.append('categories')

        with open(output_file_path, 'w', newline='', encoding='utf-8') as outfile:
            # reordering the columns
            writer = csv.DictWriter(outfile, fieldnames=fieldnames, quoting=csv.QUOTE_ALL)
            writer.writeheader()

            for row in tqdm(reader, desc="Processing rows"):
                languages = row.get('language', '').split(',') if row.get('language') else []
                categories = row.get('categories', '').split(',') if row.get('categories') else []
                origins = row.get('origins', '').split(',') if row.get('origins') else []
                genders = row.get('gender', '').split(',') if row.get('gender') else []
                meanings = row.get('meanings', '').split(',') if row.get('meanings') else []
                
                row['categories'] = clean_and_merge(categories + languages)
                
                # clean origins
                row['origins'] = clean_origins(origins)
                
                # clean gender
                row['gender'] = clean_gender(genders)
                
                # clean meanings
                row['meanings'] = clean_meanings(meanings, row['name'])
                
                row.pop('language', None)
                row.pop('pronunciations', None)
                
                if 'root_name_id' in row:
                    row['id'] = row.pop('root_name_id')

                writer.writerow({k: row.get(k, '') for k in fieldnames})

# Process the CSV
process_csv(input_csv_path, output_csv_path)

print('Done.')