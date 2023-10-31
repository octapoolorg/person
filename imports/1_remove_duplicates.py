import pandas as pd
from multiprocessing import Pool, cpu_count

def merge_unique_str(x):
    return ', '.join(set(', '.join(x.astype(str)).split(', ')))

agg_funcs = {col: merge_unique_str for col in ["Meaning", "Gender", "Origin", "Name Categories"]}
agg_funcs['Syllables'] = 'max'

# Modified this function to return chunk as-is
def process_chunk(chunk):
    return chunk

if __name__ == '__main__':
    num_cores = cpu_count()
    pool = Pool(num_cores)

    # Read and process chunks
    chunk_iter = pd.read_csv("names_root.csv", chunksize=100000)
    chunk_list = [chunk for chunk in chunk_iter]

    # Combine all chunks into one DataFrame
    combined_df = pd.concat(chunk_list, ignore_index=True)

    # Perform final aggregation on the combined DataFrame
    final_df = combined_df.groupby('Name', as_index=False).agg(agg_funcs)

    # Convert 'Syllables' back to integer type
    final_df['Syllables'] = final_df['Syllables'].fillna(0).astype(int)

    final_df.to_csv("temp/dedup_names_root.csv", index=False)
