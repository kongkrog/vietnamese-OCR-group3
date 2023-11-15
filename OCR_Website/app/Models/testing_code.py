import os
import torch

# def check_file_availability(file_path):
#     return os.path.exists(file_path)

# # Example usage:
# file_path = "C:/xampp/htdocs/OCR_Website/app/Models/__init__.py"
# # app\Models\text_detection\Tesseract-OCR\tesseract.exe
# # file_path = "OCR_WEBSITE/app/Models/text_detection/Tesseract-OCR/tesseract.exe"

# if check_file_availability(file_path):
#     print(f"The file at {file_path} is available.")
# else:
#     print(f"The file at {file_path} is not available.")

print(torch.cuda.is_available())

