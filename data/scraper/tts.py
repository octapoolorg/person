import csv
from gtts import gTTS
import os


def read_csv_data(filename):
    with open(filename, "r") as csvfile:
        reader = csv.DictReader(csvfile)
        return list(reader)


def generate_pronunciation(word):
    return gTTS(text=word, lang="hi")


def save_pronunciation(tts, output_dir, filename):
    os.makedirs(output_dir, exist_ok=True)
    full_path = os.path.join(output_dir, filename)
    tts.save(full_path)


def main():
    input_file = "test.csv"
    output_dir = "pronounced_words"

    try:
        data = read_csv_data(input_file)

        for row in data:
            word = row["name"]
            slug = row["slug"]

            tts = generate_pronunciation(word)
            filename = f"{slug}.mp3"
            save_pronunciation(tts, output_dir, filename)

            print(f"Pronounced '{word}' and saved as {filename}")

    except Exception as e:
        print(f"An unexpected error occurred: {e}")

    print("Finished processing the CSV file.")


if __name__ == "__main__":
    main()