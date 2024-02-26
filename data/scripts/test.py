import csv
import requests
import concurrent.futures

def check_url(url):
    try:
        response = requests.get(url, verify=False)
        if response.status_code == 404:
            return f"{url} is 404"
    except requests.exceptions.RequestException as e:
        return f"Error checking {url}: {e}"

def check_urls(filename):
    with open(filename, 'r') as file:
        reader = csv.reader(file)
        next(reader)  # Skip the header
        urls = [row[0] for row in reader]

    with concurrent.futures.ThreadPoolExecutor() as executor:
        results = executor.map(check_url, urls)

    for result in results:
        print(result)

# Replace 'urls.csv' with your actual CSV file name
check_urls('urls.csv')