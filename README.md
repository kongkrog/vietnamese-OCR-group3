<p align="center">
    <img src="https://github.com/kongkrog/vietnamese-OCR-group3/blob/main/imgs/groupIcon.webp">
    <h1> Group 3 Project </h1>
</p>

# vietnamese-handwriting-OCR
Convert vietnamese handwriting into digital texts for easy editing

* [Description](#description)
* [Installation](#installation)
* [Configuration](#configuration)
* [To-do](#to-do)
* [Bugs](#bugs)
* [FAQ](#faq)
* [Copyright](#copyright)

[!image] https://github.com/kongkrog/vietnamese-OCR-group3/blob/main/imgs/coverImage.png

# Description

### General
vietnamese-handwriting-OCR is a program to convert image that contains handwriting (especially in Vietnamese) and convert them into digital texts. It requries the Python interpreter, version 3.2+, and it's not specific to one platform. This is open-source, meaning you can check it for bugs/glitches and redistribute/modify however you like. This program should works on Linux, Windows or MacOS.

### Usage
To use the program, you can type this command in the command prompt.
```
(path_to_program_folder)./main.py
```
or, if the command prompt is CD to the folder itself:
```
./main.py
```

# Installation

### Install Guide
To install and use the program, use git clone:
```
git clone https://github.com/kongkrog/vietnamese-OCR-group3/tree/main
cd /vietnamese-OCR-group3
```
or download .zip file manually and extract it into a folder.

### Dependencies

This program needs some Python libraries for it to works. The lastest version of each should be fine.
#### Windows, MacOS and most Linux OS
```
pip3 install pandas numpy matplotlib
```

#### OpenSUSE
```
sudo zypper install python311-pandas python311-numpy python311-matplotlib
```

# Configuration

### Config File
You can configure this program by either editing the config.conf or edit the main.py file directly.
The user config.conf file should be located in the /etc/user-config.conf. Else the default config.conf
will be used. Beware that the user-config.conf may not exist by default and you need to create it yourself.

For example, you can change the hyperparamater of the model by using this user-config.conf:
```python
# Lines starting with # are comments

# Changing a few hyperparameters in RNN
RNN_layer = [5, 4, 3, 2, 1]
RNN_learningRate = 1e-6
RNN_momentumValue = 0.8
RNN_iterations = 3000
RNN_epochs = 5
```
Remember, you need to retrain the model afterward for the hyperparamater change to takes effect

### Training Samples
All the samples used for training is seperated into two folder for each model.
Samples used in CNN are in CNN_dataset and the others are in RNN_dataset.
Inside each folder would contains three additional folders: train, valid and test. In which contains samples for that set and a .json file for label.

```
vietnamese-OCR-group3
    ├── CNN_dataset
    │   ├── test
    │   │   ├── sample_1.jpg
    │   │   ├── sample_2.jpg
    │   │   ├── ...
    │   │   └── label.json
    │   ├── train
    │   └── valid
    ├── RNN_dataset
    │   ├── test
    │   ├── train
    │   └── valid
    ├── etc
    │   ├── user-config.conf
    │   └── config.conf
    ├── main.py
    └── ...
```

# Model Performance
Here is the graph after training our model with 1500 image samples.

#### (Insert_image_here)

# To-do
The program is in it's very early alpha stage, stuff might break or not works well.
To-do list:
- [ ] Preprocess Image
- [ ] Preprocess Sample
- [ ] Build CNN
- [ ] Build RNN
- [ ] Bulid Webpage/UI
- [ ] Integrate model into webpage
   - [ ] (Optional) Read out loud text
- [ ] Deploy webpage and model

# Bugs
We haven't found any bugs yet. If you find one, please create an Issue post on our github page. Thank you!

# FAQ
### How do I update vietnamese-OCR-group3?
You can git clone our github page again to update, remember to keep your dataset files and configuration before updating.

# Copyright
vietnamese-OCR-group3 is released into the public domain by the copyright holders.
The README file was written by Nguyen Tan Kiet and is likewise released into the public domain.
