import json
from collections import Counter, defaultdict

class JSONLProcessor:
    def __init__(self, input_file, output_file):
        self.input_file = input_file
        self.output_file = output_file

    def read_jsonl(self):
        data = defaultdict(lambda: {'origins': []})
        origin_counter = Counter()
        try:
            with open(self.input_file, 'r') as f:
                for line in f:
                    json_obj = json.loads(line)
                    name = json_obj.get('name')
                    origins = json_obj.get('origins')
                    if name and origins:
                        for origin in origins:
                            origin_value = origin.get('origin')
                            if origin_value:
                                origin_counter[origin_value] += 1
                                existing_origin = next((o for o in data[name]['origins'] if o.get('origin') == origin_value), None)
                                if existing_origin:
                                    if origin.get('meanings'):
                                        existing_origin['meanings'] = existing_origin.get('meanings', '') + ', ' + origin.get('meanings')
                                    if origin.get('description'):
                                        existing_origin['description'] = (existing_origin.get('description') or '') + ', ' + origin.get('description')
                                else:
                                    data[name]['origins'].append(origin)
                        for key, value in json_obj.items():
                            if key != 'origins':
                                data[name][key] = value
        except FileNotFoundError:
            print(f"Error: {self.input_file} not found.")
            return {}
        return data, origin_counter

    def filter_json_obj(self, json_obj, origin_counter):
        origins = json_obj.get('origins')
        if origins:
            for origin in origins:
                origin_value = origin.get('origin')
                if not (origin_value and len(origin_value) <= 15 and origin_counter[origin_value] >= 500):
                    return False
            return True
        return False

    def write_jsonl(self, data):
        try:
            with open(self.output_file, 'w') as f:
                for json_obj in data.values():
                    f.write(json.dumps(json_obj) + "\n")
        except IOError:
            print(f"Error: Unable to write to {self.output_file}.")

if __name__ == "__main__":
    processor = JSONLProcessor('data.jsonl', 'data-fix.jsonl')
    data, origin_counter = processor.read_jsonl()
    data = {name: json_obj for name, json_obj in data.items() if processor.filter_json_obj(json_obj, origin_counter)}
    processor.write_jsonl(data)