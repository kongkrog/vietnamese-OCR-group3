import cv2

def check_image_format(img_path):
    """Checks the format of the image (grayscale or BGR).

    Args:
        img_path: The path to the input image.

    Returns:
        The image format: "grayscale" or "BGR".
    """
    # Read the input image
    img = cv2.imread(img_path)

    # Check the number of channels in the image
    num_channels = img.shape[2] if len(img.shape) == 3 else 1

    if num_channels == 1:
        return "grayscale"
    else:
        return "BGR"

# Check the format of an image
image_path = "img_denoised_after_enhanced.jpg"
format = check_image_format(image_path)
print("Image format:", format)