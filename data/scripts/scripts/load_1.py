import pandas as pd
from tqdm.auto import tqdm
import logging
from collections import defaultdict
from slugify import slugify
import locale

# Set up logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

# Path to your CSV file
CSV_FILE_PATH = 'final_names-ready.csv'

open('nohup.out', 'w').close()

# Initialize counters and storage structures
category_counts, origin_counts, gender_counts = defaultdict(int), defaultdict(int), defaultdict(int)
slug_storage = defaultdict(lambda: defaultdict(int))

def generate_unique_slug(name, type):
    base_slug = slugify(str(name))

    # Check if the slug already exists for the given type and adjust the slug if necessary
    if slug_storage[type][base_slug] == 0:
        # If the slug does not exist, use it as is
        slug_storage[type][base_slug] = 1
        slug = base_slug
    else:
        # If the slug exists, increment the stored count and append it to the slug
        slug_storage[type][base_slug] += 1
        slug = f"{base_slug}-{slug_storage[type][base_slug]}"

    return slug

# First pass: Count categories, origins, and genders
def count_data(chunk):
    for categories, origins, gender in zip(chunk['categories'], chunk['origins'], chunk['gender']):
        if pd.notnull(categories):
            for category in categories.split(','):
                category_counts[category] += 1
        if pd.notnull(origins):
            for origin in origins.split(','):
                origin_counts[origin] += 1
        if pd.notnull(gender):
            gender_counts[gender] += 1

# Read CSV in chunks to count categories, origins, and genders
chunksize = 10000
for chunk in tqdm(pd.read_csv(CSV_FILE_PATH, chunksize=chunksize, usecols=['categories', 'origins', 'gender']), desc='Counting Data'):
    count_data(chunk)

# Filter categories, origins with less than 500 names
valid_categories = {k for k, v in category_counts.items() if v >= 500}
valid_origins = {k for k, v in origin_counts.items() if v >= 500}
valid_genders = {k for k, v in gender_counts.items() if v >= 1} 

# Identify and remove duplicates between categories and origins
duplicates = valid_categories.intersection(valid_origins)
valid_categories = valid_categories - duplicates

# Reset counters and dictionaries for processing, considering the removal of duplicates
categories = {k: idx + 1 for idx, k in enumerate(valid_categories)}
origins = {k: idx + 1 for idx, k in enumerate(valid_origins)}
genders = {k: idx + 1 for idx, k in enumerate(valid_genders)}

# Update categories, origins, genders with slugs, after removing duplicates
categories_with_slugs = {k: generate_unique_slug(k, 'category') for k in valid_categories}
origins_with_slugs = {k: generate_unique_slug(k, 'origin') for k in valid_origins}
genders_with_slugs = {k: generate_unique_slug(k, 'gender') for k in valid_genders}

# Initialize name_id for tracking unique names
name_id = 1

# Second pass: Process and filter data, keeping rows but removing invalid categories and origins
def process_filtered_data(chunk):
    global name_id
    names_info, name_category, name_origin = [], [], []
    for _, row in chunk.iterrows():
        
        # Convert name to string and strip spaces
        row['name'] = str(row['name']).strip()

        # Filter by gender
        if row['gender'] not in valid_genders:
            continue

        # Filter and map categories and origins, remove invalid values instead of skipping the whole row
        row_categories = [cat for cat in row['categories'].split(',') if cat in valid_categories] if pd.notnull(row['categories']) else []
        row_origins = [orig for orig in row['origins'].split(',') if orig in valid_origins] if pd.notnull(row['origins']) else []

        # Generate a unique slug for the name
        slug = generate_unique_slug(row['name'], 'name')

        # Append the processed data to the lists even if there are no valid categories or origins
        names_info.append([name_id, row['name'], row['meanings'], genders[row['gender']], slug])
        for c in row_categories:
            name_category.append([name_id, categories[c]])
        for o in row_origins:
            name_origin.append([name_id, origins[o]])
       
        name_id += 1

    return names_info, name_category, name_origin

# Combine all chunks' processed data
all_names_info, all_name_category, all_name_origin = [], [], []
for chunk in tqdm(pd.read_csv(CSV_FILE_PATH, chunksize=chunksize), desc='Processing filtered data'):
    names_info, name_category, name_origin = process_filtered_data(chunk)
    all_names_info.extend(names_info)
    all_name_category.extend(name_category)
    all_name_origin.extend(name_origin)

# Save processed data to CSVs
def save_csvs(names_info, name_category, name_origin):
    try:
        locale.setlocale(locale.LC_COLLATE, 'en_US.UTF-8')
    except locale.Error:
        logging.warning("Locale setting failed. The sorting might not respect accent ordering.")

    names_info_sorted = sorted(names_info, key=lambda x: locale.strxfrm(str(x[1])))
    
    df = pd.DataFrame(names_info_sorted, columns=['id', 'name', 'meanings', 'gender_id', 'slug'])
    df.rename(columns={'meanings': 'meaning'}, inplace=True)
    df.to_csv('database/names.csv', index=False)
    
    categories_sorted = sorted([(v, k, categories_with_slugs[k]) for k, v in categories.items()], key=lambda x: locale.strxfrm(str(x[1])))
    origins_sorted = sorted([(v, k, origins_with_slugs[k]) for k, v in origins.items()], key=lambda x: locale.strxfrm(str(x[1])))
    genders_sorted = sorted([(v, k, genders_with_slugs[k]) for k, v in genders.items()], key=lambda x: locale.strxfrm(str(x[1])))

    pd.DataFrame(categories_sorted, columns=['id', 'name', 'slug']).to_csv('database/categories.csv', index=False)
    pd.DataFrame(origins_sorted, columns=['id', 'name', 'slug']).to_csv('database/origins.csv', index=False)
    pd.DataFrame(genders_sorted, columns=['id', 'name', 'slug']).to_csv('database/genders.csv', index=False)
    pd.DataFrame(name_category, columns=['name_id', 'category_id']).to_csv('database/category_name.csv', index=False)
    pd.DataFrame(name_origin, columns=['name_id', 'origin_id']).to_csv('database/name_origin.csv', index=False)

    logging.info("CSV files have been saved.")

save_csvs(all_names_info, all_name_category, all_name_origin)
logging.info("CSV processing complete.")
