import pandas as pd
from multiprocessing import Pool, cpu_count

# Function to merge unique non-null strings, while ignoring nulls and duplicates.
def merge_unique_str(x):
    # Filter out NaN values and convert to string only non-null unique values
    unique_non_null = set(filter(pd.notna, x))
    if not unique_non_null:
        return ''
    return ', '.join(map(str, unique_non_null))

# Define aggregation functions for each column
agg_funcs = {
    "Meaning": merge_unique_str,
    "Gender": merge_unique_str,
    "Origin": merge_unique_str,
    "Name Categories": merge_unique_str,
    "Syllables": 'max'
}

def process_chunk(chunk):
    return chunk

def handle_non_utf8(chunk, non_utf8_file):
    for row in chunk.itertuples(index=False):
        try:
            row_str = ','.join(map(str, row))
            row_str.encode('utf-8')
        except UnicodeDecodeError:
            non_utf8_file.write(row_str + '\n')

if __name__ == '__main__':
    num_cores = cpu_count()
    pool = Pool(num_cores)

    dtype_spec = {
        "Meaning": str,
        "Gender": str,
        "Origin": str,
        "Syllables": 'Int64',
        "Name Categories": str
    }

    chunk_size = 100000
    file_path = "temp/names_db.csv"
    non_utf8_path = "temp/non_utf8_records.csv"

    with open(non_utf8_path, 'w') as non_utf8_file:
        combined_chunks = []

        try:
            chunk_iter = pd.read_csv(file_path, chunksize=chunk_size, dtype=dtype_spec, encoding='utf-8')
            for chunk in chunk_iter:
                combined_chunks.append(process_chunk(chunk))

        except UnicodeDecodeError:
            # Re-read file with a permissive encoding and check each row
            chunk_iter = pd.read_csv(file_path, chunksize=chunk_size, dtype=dtype_spec, encoding='ISO-8859-1')
            for chunk in chunk_iter:
                handle_non_utf8(chunk, non_utf8_file)
                chunk = chunk.applymap(lambda x: x.encode('ISO-8859-1').decode('utf-8', 'ignore') if pd.notna(x) else x)
                combined_chunks.append(process_chunk(chunk))

        combined_df = pd.concat(combined_chunks, ignore_index=True)
        final_df = combined_df.groupby('Name', as_index=False).agg(agg_funcs)
        final_df.to_csv("temp/names_db.csv", index=False)

    pool.close()
    pool.join()
