#DPL302M/OCR project/Image_Display.py

import cv2

"""
    Argument:
        def display_processed_image: 
            - input 'image': image that read from cv2
            - return: display processed image
"""

def display_processed_image(image):
    # Display the processed image
    cv2.imshow('Processed Image', image)
    cv2.waitKey(0)
    cv2.destroyAllWindows()