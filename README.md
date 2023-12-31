<p align="center">
    <img src="imgs/groupIcon.webp">
</p>

<h1 align="center"> Group 3 Project </h1>

# vietnamese-handwriting-OCR
Convert vietnamese handwriting into digital texts for easy editing

* [Website Sample (in alpha)](https://raw.githack.com/kongkrog/vietnamese-OCR-group3/main/web_files/main.html)
* [Description](#description)
* [Installation](#installation)
* [Training Samples](#training_sample)
* [To-do](#to-do)
* [Bugs](#bugs)
* [FAQ](#faq)
* [Copyright](#copyright)

<p align="center">
    <img src="https://github.com/kongkrog/vietnamese-OCR-group3/blob/main/imgs/coverImage.png">
</p> 

# Description

### General
vietnamese-handwriting-OCR is a program to convert image that contains handwriting (especially in Vietnamese) into digital texts. It requries the Python interpreter, version 3.2+, and it's not specific to one platform. This program is open-source, meaning you can check it for bugs/glitches and redistribute/modify however you like. This program should works on Linux, Windows or MacOS.

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

# Training Samples
All the samples used for training is seperated into two folder for each model.
Samples used for training in OCR are in OCR_dataset.
Inside each folder would contains three additional folders: train, valid and test. In which contains samples for that set and a .json file for label.

```
vietnamese-OCR-group3
    ├── OCR_dataset
    │   ├── test
    │   │   ├── sample_1.jpg
    │   │   ├── sample_2.jpg
    │   │   ├── ...
    │   │   └── label.json
    │   ├── train
    │   └── valid
    ├── etc
    │   ├── user-config.conf
    │   └── config.conf
    ├── main.py
    └── ...
```

# Model Performance
Here is the graph after training our model with 1500 image samples.

#### (Insert_image_here)
> **Note**
> This is just a placeholder text, we have no model yet.
# To-do
The program is in it's very early alpha stage, stuff might break or not works well.
To-do list:
- [x] Data Collection
- [x] Preprocess Image
- [x] Preprocess Sample
- [x] Build OCR
- [ ] Fine-tuning OCR
- [x] Bulid Webpage/UI
- [x] Build Backend
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
