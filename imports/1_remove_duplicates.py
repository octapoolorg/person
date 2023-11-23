import pandas as pd
from multiprocessing import Pool, cpu_count

# Function to merge unique non-null strings, while ignoring nulls and duplicates.
def merge_unique_str(x):
    # Ensure that NaNs are not converted to the string 'nan'
    return ', '.join(set(filter(pd.notna, x.astype(str).unique())))

# Define aggregation functions for each column
agg_funcs = {
    "Meaning": merge_unique_str,
    "Gender": merge_unique_str,
    "Origin": merge_unique_str,
    "Name Categories": merge_unique_str,
    "Syllables": 'max'
}

# Function to process each chunk
def process_chunk(chunk):
    # If there's any processing to be done on the chunk, add it here.
    return chunk

if __name__ == '__main__':
    num_cores = cpu_count()
    pool = Pool(num_cores)

    # Define the data types for the CSV columns
    dtype_spec = {
        "Meaning": str,
        "Gender": str,
        "Origin": str,
        "Syllables": 'Int64',  # Nullable integer type
        "Name Categories": str
    }

    # Read and process chunks of the CSV file with specified encoding
    chunk_iter = pd.read_csv("names_root.csv", chunksize=100000, dtype=dtype_spec, encoding='ISO-8859-1')

    # Process each chunk in parallel (if there's any processing to be done)
    # Since in the original code chunk is just returned, we could actually skip this step.
    # But it's kept here as a placeholder for any potential future processing.
    # chunk_list = pool.map(process_chunk, chunk_iter)

    # Directly combine chunks if no processing is necessary
    combined_df = pd.concat(chunk_iter, ignore_index=True)

    # Perform final aggregation on the combined DataFrame
    final_df = combined_df.groupby('Name', as_index=False).agg(agg_funcs)

    # 'Syllables' is already 'Int64' from the dtype specification, so we can skip this part if NaNs should be preserved
    # If you want to convert NaNs to 0 in 'Syllables', uncomment the next line
    # final_df['Syllables'] = final_df['Syllables'].fillna(0)

    # Write the final DataFrame to a CSV file
    final_df.to_csv("temp/names_db.csv", index=False)

    # Close the multiprocessing pool
    pool.close()
    pool.join()
