import warnings
warnings.filterwarnings("ignore")
import csv
import pickle  # Import pickle for saving/loading progress
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options

# Chrome options
chrome_options = Options()
chrome_options.add_argument("--ignore-ssl-errors=yes")
chrome_options.add_argument("--ignore-certificate-errors")
# Removed headless mode
chrome_options.add_argument("--disable-gpu")  # Disable GPU hardware acceleration
chrome_options.add_argument("--disable-images")  # Disable images
chrome_options.add_argument("--disable-javascript")  # Disable JavaScript
chrome_options.page_load_strategy = 'eager'

# Initialize Selenium WebDriver
service = Service()  # Specify the WebDriver executable path if necessary
driver = webdriver.Chrome(service=service, options=chrome_options)

# CSV file setup
csv_file_path = 'prokerala.csv'
with open(csv_file_path, 'w', newline='', encoding='utf-8') as file:
    writer = csv.writer(file)
    writer.writerow(["name"])

# Load the last page visited, if it exists
try:
    with open('prokerala_last_page.pkl', 'rb') as f:
        last_page_number = pickle.load(f)
except FileNotFoundError:
    last_page_number = 1

# Scraping loop
page_number = last_page_number
try:
    while True:
        url = f"https://www.prokerala.com/kids/baby-names/?process=2&page={page_number}"
        driver.get(url)

        WebDriverWait(driver, 10).until(EC.presence_of_all_elements_located((By.CSS_SELECTOR, '.name-details a')))
        names_elements = driver.find_elements(By.CSS_SELECTOR, '.name-details a')

        if not names_elements:
            break  # Break the loop if no names are found

        with open(csv_file_path, 'a', newline='', encoding='utf-8') as file:
            writer = csv.writer(file)
            for name_element in names_elements:
                writer.writerow([name_element.text])

        # Save the current page as the last successfully scraped page
        with open('prokerala_last_page.pkl', 'wb') as f:
            pickle.dump(page_number, f)

        page_number += 1

finally:
    driver.quit()
