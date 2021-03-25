<?php
namespace Pixelsiete\Towebp;
use Pixelsiete\Towebp\Converter;

class ImgFileContainer{
    public Array $imgFiles;
    public FileGenerator $fileGenerator;
    public String $sourceDirectory;

    public function __construct( String $sourceDirectory ){
        $this->fileGenerator = new FileGenerator();
        $this->sourceDirectory = $sourceDirectory;
        $this->importImgFiles( $this->sourceDirectory );
    }

    public function importImgFiles( String $directory ){
        $files = $this->fileGenerator->importFiles( $directory );
        $imgFiles = [];

        foreach ($files as $file ) {
            $imgFiles[] = ImgFile::ToImgFile( $file );
        }

        $this->imgFiles = $imgFiles;
    }
}