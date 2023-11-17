import gradio as gr
from transformers import TrOCRProcessor, VisionEncoderDecoderModel
import requests
from PIL import Image
import pytesseract
import cv2

def process_image(image):
    # prepare image
    pixel_values = processor(image, return_tensors="pt").pixel_values

    # generate (no beam search)
    generated_ids = model.generate(pixel_values)

    # decode
    generated_text = processor.batch_decode(generated_ids, skip_special_tokens=True)[0]

    return generated_text

def prediction(image_path):
    global processor, model, custom_config
    processor = TrOCRProcessor.from_pretrained("microsoft/trocr-base-handwritten")
    model = VisionEncoderDecoderModel.from_pretrained("checkpoint-1000")
    # Set the path to the Tesseract OCR executable
    pytesseract.pytesseract.tesseract_cmd = "Tesseract-OCR\\tesseract.exe"
    img = cv2.imread(image_path)
    img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)

    hImg, wImg, _ = img.shape
    boxes = pytesseract.image_to_data(img)
    temp = ['1', '1', '0', '0', '0', '0', '0', '0', '644', '675', '-1']

    # List to store cropped regions
    cropped_regions = []
    expansion_factor = 5  # You can adjust this value based on your requirement

    for x, b in enumerate(boxes.splitlines()):
        if x != 0:
            b = b.split()
            if int(b[7]) < 5:
                continue

            if float(temp[10]) == -1 and float(b[10]) != -1:
                x1, y1 = max(0, int(b[6]) - expansion_factor), max(0, int(b[7]) - expansion_factor)

            if float(temp[10]) != -1 and float(b[10]) == -1:
                x2 = min(wImg, int(temp[6]) + int(temp[8]) + expansion_factor)
                y2 = min(hImg, int(temp[7]) + int(temp[9]) + expansion_factor)
                # cv2.rectangle(img, (x1, y1), (x2, y2), (0, 0, 255), 1)
                # Crop the region of interest
                cropped_region = img[y1:y2, x1:x2]
                cropped_regions.append(cropped_region)

            if len(b) == 12:
                x, y, w, h = int(b[6]), int(b[7]), int(b[8]), int(b[9])
            temp = b
        if x == 10:
            break

    # Display each cropped region
    for region in cropped_regions:
        image = Image.fromarray(region)
        image = image.convert("RGB")
        print(process_image(image))
    
prediction('Tesseract-OCR\image\donviettay.jpg')








