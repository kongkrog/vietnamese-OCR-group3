from config_model import *
from Model import *

# ready for training data
training_img = np.array(training_img)
train_input_length = np.array(train_input_length)  # all must be equal length to T timesteps
train_label_length = np.array(train_label_length)  # different length (only the same in Captcha dataset)

# ready our validating data
valid_img = np.array(valid_img)
valid_input_length = np.array(valid_input_length) # all must be equal length to T timesteps
valid_label_length = np.array(valid_label_length) # different length (only the same in Captcha dataset)

#hyperparameter
batch_size = 16
epochs = 100

crnn_model.model.fit(x=[training_img, train_padded_txt, train_input_length, train_label_length], 
                     y=np.zeros(len(training_img)),
                     batch_size=batch_size, 
                     epochs=epochs,
                     validation_data=([valid_img, valid_padded_txt, valid_input_length, valid_label_length], [np.zeros(len(valid_img))]),
                     verbose=1)