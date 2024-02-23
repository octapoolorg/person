import json
from collections import Counter

class JSONLProcessor:
    def __init__(self, input_file, output_file):
        self.input_file = input_file
        self.output_file = output_file

    def read_jsonl(self):
        data = []
        origin_counter = Counter()
        try:
            with open(self.input_file, 'r') as f:
                for line in f:
                    json_obj = json.loads(line)
                    origins = json_obj.get('origins')
                    if origins:
                        for origin in origins:
                            origin_value = origin.get('origin')
                            if origin_value:
                                origin_counter[origin_value] += 1
                    data.append(json_obj)
        except FileNotFoundError:
            print(f"Error: {self.input_file} not found.")
            return []
        return data, origin_counter

    def filter_json_obj(self, json_obj, origin_counter):
        origins = json_obj.get('origins')
        if origins:
            for origin in origins:
                origin_value = origin.get('origin')
                meanings = origin.get('meanings')
                if not (origin_value and len(origin_value) <= 15 and meanings and
                        all(isinstance(meaning, str) and meaning for meaning in meanings) and
                        'N/A' not in meanings and origin_counter[origin_value] >= 500):
                    return False
            return True
        return False

    def write_jsonl(self, data):
        try:
            with open(self.output_file, 'w') as f:
                for item in data:
                    f.write(json.dumps(item) + "\n")
        except IOError:
            print(f"Error: Unable to write to {self.output_file}.")

if __name__ == "__main__":
    processor = JSONLProcessor('data-fix.jsonl', 'data.jsonl')
    data, origin_counter = processor.read_jsonl()
    data = [json_obj for json_obj in data if processor.filter_json_obj(json_obj, origin_counter)]
    processor.write_jsonl(data)