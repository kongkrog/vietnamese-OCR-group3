import cv2

image_path = "OCR_project/data/for_testing_code/0036_samples.png"
print(image_path)
image = cv2.imread(image_path)
cv2.imshow('testing', image)
cv2.waitKey(0)
cv2.destroyAllWindows()