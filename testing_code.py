
from Image_processing.Image_Processing import preprocess_image
from Image_processing.Image_Processing import display_processed_image

image_path = 'data/for_testing_code/0260_samples.png'

img = preprocess_image(image_path)
display_processed_image(img)
    