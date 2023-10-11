#DPL302M/OCR project/Image_Processing.py

import cv2
import numpy as np

def preprocess_image(raw_image): 
    resize_max_width =0
    
    # Load the image
    image = cv2.cvtColor(cv2.imread(raw_image), cv2.IMREAD_GRAYSCALE)
    height, width = image.shape

    # resize the image
    image = cv2.resize(image,(int(118/height*width),118))
    height, width = image.shape
    
    if image.shape[1] > resize_max_width:
        resize_max_width = image.shape[1]

    image = np.pad(image, ((0,0),(0, 2167-width)), 'median')
    
    # Thresholding
    binary_image = cv2.adaptiveThreshold(image, 255, cv2.ADAPTIVE_THRESH_GAUSSIAN_C, cv2.THRESH_BINARY_INV, 11, 4)

    # Noise Reduction
    blurred_image = cv2.GaussianBlur(binary_image, (5,5), 0)

    # add channel dimension
    image = np.expand_dims(image , axis = 2)
    
    # Normalize each image
    image = image/255.
    
    return image

def display_processed_image(image):
    # Display the processed image
    cv2.imshow('Processed Image', image)
    cv2.waitKey(0)
    cv2.destroyAllWindows()


