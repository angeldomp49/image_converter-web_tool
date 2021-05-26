# Image Converter #


## Converter ##

This project use the Strategy Pattern because there is a "Converter" abstract class and you can create a new converter for another image format 
extend it. An example is the Webp converter class.

## GDirectory ##
The GDirectory abstract class provide some functions for scan an specified directory and read its files.

## GFile ##
This class provide an interface to handle files and its content.

## ImgContainer and ImgFile ##
Same functionality for GDirectory and GFile but more specific for image files


## Usage ##
Inside the testing directory is the main function and another testing codes. 
The goal of this project is create a library to convert image files from one or more extensions to a specified extension