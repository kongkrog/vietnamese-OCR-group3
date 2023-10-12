#DPL302M/OCR project/__init__.py

from Image_processing.Image_Processing import preprocess_image
from Image_processing.Image_Processing import display_processed_image

if __name__ == "__main__":
<<<<<<< HEAD
    all_image_paths = list(['vietnamese-OCR-group3-OCR_model/data/for_testing_code/0043_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0093_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0138_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0188_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0193_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0207_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0242_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0260_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0272_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0342_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0355_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0366_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0425_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0431_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0435_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0446_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0508_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0513_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0518_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0523_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0528_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0555_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0566_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0569_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0573_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0614_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0628_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0635_samples.png',
                            'vietnamese-OCR-group3-OCR_model/data/for_testing_code/0639_samples.png'])
    for image_path in all_image_paths:
        img = preprocess_image(image_path)
        display_processed_image(img)
        
