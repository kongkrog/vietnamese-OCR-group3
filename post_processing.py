import numpy as np 
import cv2 
# from cv2 import ximgproc

# Rotate Right Direction - So hardcore

# Brightness Ver4 - Balance
def increase_auto_brightness(image_path, factor=2.5):
    image = cv2.imread(image_path)
    # Check the brightness of the image
    gray_image = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    brightness = cv2.mean(gray_image)[0]
    # Convert the image to the LAB color space
    lab_image = cv2.cvtColor(image, cv2.COLOR_BGR2LAB)
    
    # Split the LAB image into L, A, and B channels
    l_channel, a_channel, b_channel = cv2.split(lab_image)
    
    # Apply CLAHE (Contrast Limited Adaptive Histogram Equalization) to the L channel
    clahe = cv2.createCLAHE(clipLimit=factor, tileGridSize=(8, 8))
    enhanced_l_channel = clahe.apply(l_channel)
    
    # Merge the enhanced L channel with the original A and B channels
    enhanced_lab_image = cv2.merge((enhanced_l_channel, a_channel, b_channel))
    
    # Convert the enhanced LAB image back to the BGR color space
    enhanced_image = cv2.cvtColor(enhanced_lab_image, cv2.COLOR_LAB2BGR)
    
    return enhanced_image

# Noise Removal - Balance

# Ver 2 - best 
def remove_noise(img, min_size=2):
    """Removes noise from an image by filtering small connected components.

    Args:
        img_path: The path to the input image.
        min_size: The minimum size of the connected components to preserve.

    Returns:
        The denoised image in BGR format.
    """
    # # Read the input image in color mode
    img = cv2.imread(img, cv2.IMREAD_COLOR)
    
    # Convert the image to grayscale
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    # Apply thresholding to binarize the image
    ret, bw = cv2.threshold(gray, 128, 255, cv2.THRESH_BINARY_INV)

    # Perform connected components analysis
    connectivity = 2
    nb_components, output, stats, centroids = cv2.connectedComponentsWithStats(bw, connectivity, cv2.CV_32S)

    # Extract component sizes
    sizes = stats[1:, -1]
    nb_components = nb_components - 1

    # Create an empty image to store the denoised components
    img2 = np.zeros(output.shape, np.uint8)

    # Iterate through connected components and retain only those above the minimum size
    for i in range(nb_components):
        if sizes[i] >= min_size:
            img2[output == i + 1] = 255

    # Invert the image to get the final denoised image
    res = cv2.bitwise_not(img2)

    return res

# def perform_erosion(image_path):
#     # Read the input image in grayscale
#     img = cv2.imread(image_path, 0)

#     # Define the kernel for erosion
#     kernel = np.ones((2, 2), np.uint8)

#     # Perform erosion operation
#     erosion = cv2.erode(img, kernel, iterations=1)

#     return erosion

# Increase the auto brightness by a factor of 1.5 (you can adjust the factor as needed)
original_image_path = "Image/Noise.png"
# original_image = cv2.imread(original_image_path)
# enhanced_image = increase_auto_brightness(original_image_path)
# # Display the images
# cv2.imshow("Before", original_image)
# cv2.imshow("After", enhanced_image)

# # Wait for a key press and close the OpenCV window
# cv2.waitKey(0)
# cv2.destroyAllWindows()
# cv2.imwrite("enhanced_image.jpg", enhanced_image)

# Remove noise using the function
denoised_img = remove_noise(original_image_path)
# # Save the denoised image
cv2.imwrite("img_denoised_after_enhanced.jpg", denoised_img)


# # Call the function with the input and output image paths
# erosion = perform_erosion('img_denoised_after_enhanced.jpg')
# cv2.imwrite('erosion.jpg', erosion)


# Skew Correction - BAD
# import scipy.ndimage as ndimage
# def correct_skew(image, delta=10, limit=0):
#     def determine_score(arr, angle):
#         data = ndimage.rotate(arr, angle, reshape=False, order=0)
#         histogram = np.sum(data, axis=1, dtype=float)
#         score = np.sum((histogram[1:] - histogram[:-1]) ** 2, dtype=float)
#         return histogram, score

#     gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
#     thresh = cv2.threshold(gray, 0, 255, cv2.THRESH_BINARY_INV + cv2.THRESH_OTSU)[1] 

#     scores = []
#     angles = np.arange(-limit, limit + delta, delta)
#     for angle in angles:
#         histogram, score = determine_score(thresh, angle)
#         scores.append(score)

#     best_angle = angles[scores.index(max(scores))]

#     (h, w) = image.shape[:2]
#     center = (w // 2, h // 2)
#     M = cv2.getRotationMatrix2D(center, best_angle, 1.0)
#     corrected = cv2.warpAffine(image, M, (w, h), flags=cv2.INTER_CUBIC, \
#             borderMode=cv2.BORDER_REPLICATE)

#     return best_angle, corrected

# if __name__ == '__main__':
#     image = cv2.imread('Image/scew3.PNG')
#     angle, corrected = correct_skew(image)
#     print('Skew angle:', angle)
#     cv2.imshow('corrected', corrected)
#     cv2.waitKey()