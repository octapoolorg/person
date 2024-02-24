import pandas as pd

# Read the CSV file
df = pd.read_csv('../imports/names.csv')

# Function to change gender
def clean_gender(gender):
    if isinstance(gender, str):
        firstreplace = {
            'fem' : 'Feminine',
            'fém' : 'Feminine',
            'masc' : 'Masculine',
            'male' : 'Masculine',
            'boy' : 'Masculine',
            'neutral' : 'Unisex',
            'uni': 'Unisex',
            'neu': 'Unisex',
        }

        cleaned_gender = set()
        for g in gender.split(','):
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
    else:
        return 'Unknown'

# Apply the function to the 'gender' column
df['gender'] = df['gender'].apply(clean_gender)

# Print unique gender values
print(df['gender'].unique())

# Write the DataFrame back to CSV
df.to_csv('names.csv', index=False)