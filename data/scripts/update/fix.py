import json

# Load data from JSONL file
with open('data.jsonl', 'r', encoding='utf-8') as file:
    data = [json.loads(line) for line in file]

# Remove objects that have 'scrollPane' key, 'gender' is 'Unknown', or 'origins' is empty
data = [obj for obj in data if 'scrollPane' not in obj and (obj.get('gender') or '').lower() != 'unknown' and obj.get('origins', [])]

# Save data to JSONL file
with open('data-fix.jsonl', 'w', encoding='utf-8') as file:
    for obj in data:
        file.write(json.dumps(obj) + '\n')