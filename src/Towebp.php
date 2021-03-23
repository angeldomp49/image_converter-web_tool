<?php
namespace Pixelsiete\Towebp;

use Pixelsiete\Towebp\ImgFile;

class Towebp{
    public String $inputDir;
    public String $outputDir;
    public ImgFile $imgFile;

    public function __construct( String $inputDir, String $outputDir ){
        $this->inputDir = $inputDir;
        $this->outputDir = $outputDir;
    }

    public function convert(){

        $imgFile = new ImgFile( $this->inputDir );

        if( imagewebp( $imgFile->imageFile, $this->outputDir ) ){
            echo( "image webp successful created!" );
        }
        else{
            throw new Exception( "Error creating webp from ImgFile" );
        }
        
    }

    public function getInputDir(){
        return $this->inputDir;
    }

    public function setInputDir($inputDir){
        $this->inputDir = $inputDir;

        return $this;
    }

    public function getOutputDir(){
        return $this->outputDir;
    }

    public function setOutputDir($outputDir){
        $this->outputDir = $outputDir;

        return $this;
    }
}