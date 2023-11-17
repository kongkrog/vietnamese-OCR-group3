#DPL302M/OCR project/Image_Processing.py

import cv2
import numpy as np


def preprocess_image(raw_image): 
    """
    Argument:
        def preprocess_image
            - input 'raw_image': image's path
            - return 'normalized': image after processing
    """
    # Load an image
    image = cv2.imread(raw_image)
    height = image.shape[0]
    width = image.shape[1]
    
    image = cv2.resize(image,(int(118/height*width),118))
    
    #convert Grayscale
    gray_img = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    
    #Apply blur
    blurred  = cv2.GaussianBlur(gray_img, (5,5), 0)
    
    # Perform thresholding to create a binary image
    _, thresh = cv2.threshold(blurred, 0, 255, cv2.THRESH_BINARY + cv2.THRESH_OTSU)
    
    # Optionally, perform morphological operations to further clean the image
    kernel = np.ones((3, 3), np.uint8)
    morphed = cv2.morphologyEx(thresh, cv2.MORPH_CLOSE, kernel)
    
    #normalized image
    normalized = morphed/255
    
    return normalized


def display_processed_image(image):
    """
    Argument:
        def display_processed_image: 
            - input 'image': image that read from cv2
            - return: display processed image
    """

    # Display the processed image
    cv2.imshow('Processed Image', image)
    cv2.waitKey(0)
    cv2.destroyAllWindows()