from fastapi import FastAPI, UploadFile, File
from main import *
import cv2
import numpy as np
import shutil

api = FastAPI()

# Define route for prediction   
@api.post('/predict')
async def predict_text(image: UploadFile = File(...)):
    # Save the image temporarily
    image_path = "temp_image.jpg"
    with open(image_path, 'wb') as file:
        shutil.copyfileobj(image.file, file)

    # Make prediction
    predicted_text = prediction(crnn_model, image_path)
    
    # Remove the temporary image file
    os.remove(image_path)
    
    # Return the predicted text
    return {'predicted_text': predicted_text}

