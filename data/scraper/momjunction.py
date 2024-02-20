import warnings
warnings.filterwarnings("ignore")
import csv
import pickle
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import NoSuchElementException
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options

# Add options for Chrome
chrome_options = Options()
chrome_options.add_argument("--ignore-ssl-errors=yes")
chrome_options.add_argument("--ignore-certificate-errors")

chrome_options.add_argument("--disable-gpu")  # Disable GPU hardware acceleration
chrome_options.add_argument("--disable-images")  # Disable images
chrome_options.page_load_strategy = 'eager'  # 'normal', 'eager', or 'none'

# Set up Selenium driver with added options
service = Service()  # Specify the path to your WebDriver executable if needed
driver = webdriver.Chrome(service=service, options=chrome_options)

# Load the last page visited, if it exists
try:
    with open('momjunction_last.pkl', 'rb') as f:
        last_page = pickle.load(f)
except FileNotFoundError:
    last_page = {'gender': 'girl', 'letter': 'a', 'page': 1}

# Write the header to the CSV file
with open('momjunction.csv', 'w', newline='') as file:
    writer = csv.writer(file)
    writer.writerow(["name"])

# Loop through each gender
for gender in ['girl', 'boy', 'unisex']:
    if gender < last_page['gender']:
        continue

    # Loop through each letter
    for letter in 'abcdefghijklmnopqrstuvwxyz':
        if gender == last_page['gender'] and letter < last_page['letter']:
            continue

        page = last_page['page'] if gender == last_page['gender'] and letter == last_page['letter'] else 1

        while True:
            try:
                if page == 1:
                    driver.get(f"https://www.momjunction.com/baby-names/{gender}/starting-with-{letter}/")
                else:
                    driver.get(f"https://www.momjunction.com/baby-names/{gender}/starting-with-{letter}/page/{page}/")

                # Check if the page is a 404
                if "404" in driver.title or "Not Found" in driver.title:
                    break

                # Wait for the names to load
                WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.CLASS_NAME, 'baby-name-link')))

                # Get the names using the updated method
                names = driver.find_elements(By.CLASS_NAME, 'baby-name-link')

                # Loop through each name and save it
                for name in names:
                    with open('momjunction.csv', 'a', newline='') as file:
                        writer = csv.writer(file)
                        writer.writerow([name.text])

                page += 1

                # Save the last page visited
                with open('momjunction_last.pkl', 'wb') as f:
                    pickle.dump({'gender': gender, 'letter': letter, 'page': page}, f)
            except NoSuchElementException:
                # If the page does not exist, break the loop and move on to the next letter or gender
                break

# Close the driver
driver.quit()