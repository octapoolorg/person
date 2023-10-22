import csv

# Initialize containers for new tables
names_table = []
genders_table = set()
origins_table = set()
categories_table = set()
category_name_table = []

name_id = 1  # Initialize name_id

# Read and normalize the data from the parent CSV
with open('names_root.csv', 'r', encoding='utf-8') as csvfile:
    csvreader = csv.reader(csvfile)
    header = next(csvreader)

    for row in csvreader:
        name, meaning, gender, origin, syllables, categories = row

        # Populate the Names table
        names_table.append([name_id, name, meaning, syllables])

        # Populate the Genders table
        genders_table.add(gender)

        # Populate the Origins table
        origins_table.add(origin)

        # Populate the Categories table and Name_Categories table
        for category in categories.split(","):
            category = category.strip()
            categories_table.add(category)
            category_name_table.append([name_id, category])

        name_id += 1

# Convert sets to lists with an ID field
genders_table = [[idx+1, gender] for idx, gender in enumerate(genders_table)]
origins_table = [[idx+1, origin] for idx, origin in enumerate(origins_table)]
categories_table = [[idx+1, category] for idx, category in enumerate(categories_table)]
category_to_id = {category: idx+1 for idx, (id_, category) in enumerate(categories_table)}
category_name_table = [[name_id, category_to_id[category]] for name_id, category in category_name_table]

# Create mappings for gender and origin to their respective IDs
gender_to_id = {gender: idx+1 for idx, (id_, gender) in enumerate(genders_table)}
origin_to_id = {origin: idx+1 for idx, (id_, origin) in enumerate(origins_table)}

# Update Names table with foreign keys
for row in names_table:
    name_id, name, meaning, syllables = row
    gender_id = gender_to_id[gender]
    origin_id = origin_to_id[origin]
    row.extend([gender_id, origin_id])

# Write the new tables to individual CSV files

# Names table
with open('names.csv', 'w', newline='', encoding='utf-8') as csvfile:
    csvwriter = csv.writer(csvfile)
    csvwriter.writerow(['id', 'name', 'meaning', 'syllables', 'gender_id', 'origin_id'])
    csvwriter.writerows(names_table)

# Genders table
with open('genders.csv', 'w', newline='', encoding='utf-8') as csvfile:
    csvwriter = csv.writer(csvfile)
    csvwriter.writerow(['id', 'gender'])
    csvwriter.writerows(genders_table)

# Origins table
with open('origins.csv', 'w', newline='', encoding='utf-8') as csvfile:
    csvwriter = csv.writer(csvfile)
    csvwriter.writerow(['id', 'origin'])
    csvwriter.writerows(origins_table)

# Categories table
with open('categories.csv', 'w', newline='', encoding='utf-8') as csvfile:
    csvwriter = csv.writer(csvfile)
    csvwriter.writerow(['id', 'category'])
    csvwriter.writerows(categories_table)

# Name_Categories table
with open('category_name.csv', 'w', newline='', encoding='utf-8') as csvfile:
    csvwriter = csv.writer(csvfile)
    csvwriter.writerow(['name_id', 'category_id'])
    csvwriter.writerows(category_name_table)

print("CSV files created.")
