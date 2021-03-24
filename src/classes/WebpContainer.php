<?php
namespace Pixelsiete\Towebp;
use Pixelsiete\Towebp\Interfaces\ImgFileContainer;
use Pixelsiete\Towebp\Converter;

class WebpContainer implements ImgFileContainer{
    public Array $imgFiles;
    public FileGenerator $fileGenerator;

    

    public function importImgFiles( String $directory ){
        $files = $this->fileGenerator->importFiles( $directory );
        $imgFiles = [];

        foreach ($files as $file ) {
            $imgFiles[] = ImgFile::ToImgFile( $file );
        }

        $this->imgFiles = $imgFiles;
    }

    public function exportImgFiles( String $directory ){
        $this->fileGenerator->exportFiles( $directory, $this->imgFiles );
    }

    public function transformImgFiles( $converter, $source, $dist ){
        $convertedImgFiles = [];

        foreach ($this->imgFiles as $imgFile ) {
            $newFilename = str_replace( $source, $dist, $imgFile->generalFile->fileInfo->getFilename() );
            $convertedImgFiles[] = $converter->convert( $imgFile, $newFilename );
        }

        $this->imgFiles = $convertedImgFiles;
    }

    public function isValidConverter( $converter ){
        if( !($converter instanceof Converter) ){
            throw new Exception( "Converter not valid in " . __CLASS__ . " at function " . __FUNCTION__ );
        }
    }


    public function getFileGenerator(){
        return $this->fileGenerator;
    }

    public function setFileGenerator($fileGenerator){
        $this->fileGenerator = $fileGenerator;

        return $this;
    }
}