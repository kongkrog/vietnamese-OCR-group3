from Model import *
import numpy as np 
import cv2

def preprocess_image(raw_image): 
  """
  Argument:
      def preprocess_image
          - input 'raw_image': image's path
          - return 'normalized': image after processing
  """
  # Load an image
  img = cv2.cvtColor(cv2.imread(raw_image), cv2.COLOR_BGR2GRAY)
  # in this dataset, we don't need to do any resize at all here.
  img = cv2.resize(img,(int(118/118*2122),118))
  img = np.pad(img, ((0,0),(0, 2167-2122)), 'median')
    
  # YOUR PART: Blur it
  img = cv2.GaussianBlur(img, (5,5), 0)

  # YOUR PART: Threshold the image using adapative threshold
  img = cv2.adaptiveThreshold(img, 255, cv2.ADAPTIVE_THRESH_GAUSSIAN_C, cv2.THRESH_BINARY_INV, 11, 4)
    
  # add channel dimension
  img = np.expand_dims(img , axis = 2)
    
  #normalized image
  normalized = img/255
    
  return normalized

def prediction(crnn_model, image_path):
  # Load the trained weights
  crnn_model.model.load_weights('weight\checkpoint_weights.hdf5')
  print(image_path)
  list_image = np.array([preprocess_image(image_path)])
  
  test_pred = crnn_model.predict(list_image)

  out = K.get_value(K.ctc_decode(test_pred, input_length=np.ones(test_pred.shape[0])*test_pred.shape[1],greedy=True)[0][0])

  final_pred = "".join([char_list[int(number)] if int(number) != -1 else "" for number in out[0]])
  return final_pred
# Path to the image for prediction
# image_path = r'data/for_training_model/data/0001_samples.png'
# print(prediction(crnn_model,image_path))
