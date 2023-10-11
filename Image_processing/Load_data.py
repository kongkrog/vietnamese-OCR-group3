import pathlib
import zipfile
import tensorflow as tf

device_name = tf.test.gpu_device_name()
if device_name != '/device:GPU:0':
    # RIP Training time
    raise SystemError('GPU device not found')
    print('Found GPU at: {}'.format(device_name))
    
TRAIN_DATA_ZIP_PATH = "/data/Train_Data.zip"
    
with zipfile.ZipFile(TRAIN_DATA_ZIP_PATH, 'r') as zip_ref:
    zip_ref.extractall("vietnamese_hcr/raw")
    
current_directory_path = pathlib.Path("./vietnamese_hcr").absolute()
current_directory_path