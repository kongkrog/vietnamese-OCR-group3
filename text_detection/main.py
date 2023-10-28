import cv2
import pytesseract


pytesseract.pytesseract.tesseract_cmd = "Tesseract-OCR\\tesseract.exe"
custom_config = r'--tessdata-dir "C:\\Program Files\\Tesseract-OCR\\tessdata" -l Vietnamese'
img = cv2.imread('donviettay.jpg')
img = cv2.cvtColor(img,cv2.COLOR_BGR2RGB)
#print(pytesseract.image_to_string(img))


# detect
hImg, wImg, _ = img.shape
boxes = pytesseract.image_to_data(img)
print(boxes)
for x,b in enumerate(boxes.splitlines()):
    if x!=0:
        b = b.split()
        print(b)
        if len(b)==12:
            x, y, w, h = int(b[6]), int(b[7]), int(b[8]), int(b[9])
            cv2.rectangle(img, (x, y), (w+x, h+y), (0, 0, 255), 1)
            #cv2.putText(img, b[11], (x, y), cv2.FONT_HERSHEY_COMPLEX, 1, (50, 50, 255), 2)
cv2.imshow('Result', img)
cv2.waitKey()





# import pytesseract
# import cv2
#
# # Set the path to the Tesseract OCR executable
# pytesseract.pytesseract.tesseract_cmd = "Tesseract-OCR\\tesseract.exe"
# custom_config = r'--tessdata-dir "C:\\Program Files\\Tesseract-OCR\\tessdata" -l Vietnamese'
#
# # Read the image
# img = cv2.imread('donviettay.jpg')
# img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
#
# # Detect and recognize text (similar to your code)
# hImg, wImg, _ = img.shape
# boxes = pytesseract.image_to_data(img, output_type=pytesseract.Output.DICT)
#
# # Create a list to store detected lines
# lines = []
#
# # Process text boxes and group them into lines
# current_line = []
# for i in range(len(boxes['text'])):
#     if boxes['conf'][i] > 0:
#         x, y, w, h = boxes['left'][i], boxes['top'][i], boxes['width'][i], boxes['height'][i]
#         current_line.append((boxes['text'][i], x, y, x + w, y + h))
#     else:
#         if current_line:
#             lines.append(current_line)
#         current_line = []
#
# # Add the last line (if any) to the list of lines
# if current_line:
#     lines.append(current_line)
#
# # Create a list to store the cropped regions
# cropped_regions = []
#
# # Loop through the detected lines, crop, and store in the list
# for line in lines:
#     x1, y1, x2, y2 = min([word[1] for word in line]), min([word[2] for word in line]), max(
#         [word[3] for word in line]), max([word[4] for word in line])
#
#     # Crop the region from the original image
#     cropped_region = img[y1:y2, x1:x2]
#     cropped_regions.append(cropped_region)
#
# # Now 'cropped_regions' contains the cropped regions of the detected lines
#
# # Display each cropped region
# for i, region in enumerate(cropped_regions):
#     cv2.imshow(f'Region {i}', region)
#
# # Wait for a key event to close the windows
# cv2.waitKey(0)
# cv2.destroyAllWindows()








# import cv2
# import pytesseract
#
# pytesseract.pytesseract.tesseract_cmd = "Tesseract-OCR\\tesseract.exe"
# custom_config = r'--tessdata-dir "C:\\Program Files\\Tesseract-OCR\\tessdata" -l Vietnamese'
# img = cv2.imread('donviettay.jpg')
# img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
#
# # Nhận diện văn bản và lấy thông tin bounding box
# hImg, wImg, _ = img.shape
# boxes = pytesseract.image_to_data(img)
# print(boxes)
#
# # Xác định khoảng cách ngang tối đa để xem xét là trùng hàng
# max_x_distance = 20  # Điều chỉnh giá trị này dựa trên kích thước ảnh của bạn
#
# # Tạo danh sách để lưu bounding box của từng hàng
# lines = []
#
# # Khởi tạo biến để theo dõi hàng hiện tại
# current_line = []
#
# for x, b in enumerate(boxes.splitlines()):
#     if x != 0:
#         b = b.split()
#         if len(b) == 12:
#             x, y, w, h = int(b[6]), int(b[7]), int(b[8]), int(b[9])
#
#             # Tìm bounding box cuối cùng trong hàng hiện tại (nếu có)
#             last_x2 = current_line[-1][0] if current_line else None
#
#             # Nếu không có bounding box trong hàng hoặc bounding box hiện tại nằm trên cùng một hàng với bounding box cuối cùng
#             if not current_line or x - last_x2 <= max_x_distance:
#                 current_line.append((x, y, x + w, y + h))
#             else:
#                 # Nếu bounding box hiện tại không nằm trên cùng một hàng, thêm hàng hiện tại vào danh sách
#                 lines.append(current_line)
#                 current_line = [(x, y, x + w, y + h)]
#
# # Thêm hàng cuối cùng vào danh sách
# if current_line:
#     lines.append(current_line)
#
# # Vẽ các bounding box kết hợp lại trên ảnh gốc
# for line in lines:
#     x1 = min(box[0] for box in line)
#     y1 = min(box[1] for box in line)
#     x2 = max(box[2] for box in line)
#     y2 = max(box[3] for box in line)
#     cv2.rectangle(img, (x1, y1), (x2, y2), (0, 0, 255), 1)
#
# cv2.imshow('Result', img)
# cv2.waitKey()





