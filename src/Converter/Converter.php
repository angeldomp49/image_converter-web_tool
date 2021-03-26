<?php
namespace MakechTec\ImageConverter\Converter;

use MakechTec\ImageConverter\{GFile, GDirectory};

abstract class Converter{
    public abstract function convert( GFile $imgFile, String $pathName );
    public static abstract function convertAll( GDirectory $fileContainer, String $destinationDirectory );
}