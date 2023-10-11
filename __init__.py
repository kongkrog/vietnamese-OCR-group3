#DPL302M/OCR project/__init__.py

from Image_Processing import preprocess_image
from Image_Processing import display_processed_image

if __name__ == "__main__":
    image_path = "OCR_project/data/for_testing_code/0036_samples.png"     # Adjust the path as neede
    image = preprocess_image(image_path)
    display_processed_image(image)