import csv
import glob
import json
import logging
import os
from collections import defaultdict

logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

class JSONLFilter:
    def __init__(self):
        self.filters = []

    def add_filter(self, field, filter_fn):
        self.filters.append((field, filter_fn))

    def should_include(self, obj):
        return all(filter_fn(obj.get(field)) for field, filter_fn in self.filters)

    def merge_jsonl_filtered(self, source_pattern, output_path):
        files = glob.glob(source_pattern)
        if not files:
            logging.warning("No files found.")
            return

        with open(output_path, 'w', buffering=1 << 16) as out_file:
            for file_path in files:
                logging.info(f"Processing: {file_path}")
                with open(file_path, 'r', buffering=1 << 16) as in_file:
                    for line_number, line in enumerate(in_file, start=1):
                        if line.strip():
                            try:
                                obj = json.loads(line.strip())
                                if self.should_include(obj):
                                    json.dump(obj, out_file)
                                    out_file.write('\n')
                            except json.JSONDecodeError as e:
                                logging.error(f"JSON decoding error in file {file_path}, line {line_number}: {e}")
                                continue

        logging.info("Merge complete.")

       
def filter_translations(translations):
    if translations is None or not isinstance(translations, list) or len(translations) == 0:
        return False

jsonl_filter = JSONLFilter()
jsonl_filter.add_filter('translations', filter_translations)

source_pattern = '../imports/generated/translations_*.jsonl'
intermediate_output_path = '../merged_translations_filtered.jsonl'
anomalies_path = '../anomalies.jsonl'

jsonl_filter.merge_jsonl_filtered(source_pattern, intermediate_output_path)