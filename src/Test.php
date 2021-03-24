<?php

use Pixelsiete\Towebp\{WebpContainer, WebpConverter, FileGenerator};

class Test {
    public static function main(){
        $source = "images/src";
        $dist = "images/dist";

        $fileGenerator = new FileGenerator();

        $source = rightPath( $source );
        $dist = rightPath( $dist );

        $webpContainer = new WebpContainer();
        $webpContainer->setFileGenerator( $fileGenerator );
        $webpContainer->importImgFiles( $source );
        
        $webpConverter = new WebpConverter();
        $webpContainer->transformImgFiles( $webpConverter, $source, $dist );
        
    }
}