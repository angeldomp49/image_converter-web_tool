<?php
namespace MakechTec\ImageConverter\Converter;

use MakechTec\ImageConverter\Img\{ImgFile, ImgContainer};

abstract class Converter{
    public abstract function convert( ImgFile $imgFile, String $pathName );
    public abstract function convertAll( ImgContainer $fileContainer, String $destinationDirectory );
}