<?php

class Entry {
    public static function main(){
        $source = "images/src";
        $dist = "images/dist";

        $source = rightPath( $source );
        $dist = RightPath( $dist );

        $webpContainer = new WebpContainer();
        $webpContainer->importImgFiles( $source );
        
        $webpConverter = new WebpConverter();

        $webpContainer->transformImgFiles( $webpConverter );
        
    }
}