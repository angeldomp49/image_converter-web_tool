<?php
namespace MakechTec\ImageConverter\Img;

use MakechTec\ImageConverter\GFile\GDirectory;

class ImgContainer extends GDirectory{

    public function __construct( String $sourceDirectory ){
        $this->sourceDirectory = $sourceDirectory;
        $this->importImgFiles( $this->sourceDirectory );
    }

    public function importFiles( String $directory ){

        if( !is_dir( $directory ) ){
            throw new Exception( "Directory not exists: " . $directory );
        }

        $fileNames = $this->importFileNamesRecursively( $directory );
        $fileObjects = [];

        foreach ($fileNames as $fileName) {
            $fileObjects[] = new ImgFile( $fileName );
        }

        $this->imgFiles = $fileObjects;
    }
}