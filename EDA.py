#!/usr/bin/env python
# coding: utf-8

# In[1]:


import json
import pathlib
import cv2
import os


# In[3]:


#file path to label 
Json_file = "/Users/truonghoangphi/Users/truonghoangphi/vn_handwritten_images/labels.json"
with open(Json_file, 'r', encoding='utf8') as f:
    labels = json.load(f)
labels


# In[4]:


#find all characters in labels (so we don't blindly add chacters not even existed in our dataset)
char_list= set()
for label in labels.values():
    char_list.update(set(label))
char_list=sorted(char_list)

"".join(char_list)


# In[5]:


# convert the words to array of indexs based on the char_list
def encode_to_labels(txt):
    # encoding each output word into digits of indexes
    dig_lst = []
    for index, char in enumerate(txt):
        try:
            dig_lst.append(char_list.index(char))
        except:
            print("No found in char_list :", char)
        
    return dig_lst


# In[6]:


dataset = "/Users/truonghoangphi/Users/truonghoangphi/vn_handwritten_images/data"

train_image_path = []

for item in pathlib.Path(dataset).glob('**/*'):
    if item.suffix not in [".json"]:
        train_image_path.append(str(item))

dict_filepath_label={}
raw_data_path = pathlib.Path(os.path.join(dataset))
for item in raw_data_path.glob('**/*.*'):
    file_name=str(os.path.basename(item))
    if file_name != "labels.json":
      label = labels[file_name]
      dict_filepath_label[str(item)]=label

label_lens= []
for label in dict_filepath_label.values():
    label_lens.append(len(label))
max_label_len = max(label_lens)

all_image_paths = list(dict_filepath_label.keys())

widths = []
heights = []
for image_path in all_image_paths:
    img = cv2.imread(image_path)
    (height, width, _) = img.shape
    heights.append(height)
    widths.append(width)

min_height = min(heights)
max_height = max(heights)
min_width = min(widths)
max_width = max(widths)

(min_height, max_height, min_width, max_width)


# In[ ]:




