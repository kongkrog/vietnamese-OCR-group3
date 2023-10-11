#DPL302M/OCR project/__init__.py

from Image_processing.Image_Processing import preprocess_image
from Image_processing.Image_Display import display_processed_image

if __name__ == "__main__":
    image_path = 'data//for_testing_code//0036_samples.png'
    img = preprocess_image(image_path)
    display_processed_image(img)