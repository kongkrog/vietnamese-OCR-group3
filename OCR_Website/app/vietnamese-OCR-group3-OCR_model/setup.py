from setuptools import setup, find_packages

setup(
    name='handwriting-ocr',
    version='1.0.0',
    packages=find_packages(),
    install_requires=[
        'opencv-python',
        # Other dependencies as needed
    ],
)