<?php
namespace Pixelsiete\Towebp;

use \SplFileInfo;
use \SplFileObject;

class ImgFile{
    public SplFileInfo $fileInfo;
    public SplFileObject $fileObject;
    public $imageFile;

    public function __construct( String $filePath ){
        $this->createFileInfo( $filePath );
        $this->createFileObject();
        $this->createImageFile();
    }

    public function createFileInfo( String $filePath ){
        $this->fileInfo = new SplFileInfo( $filePath );
    }
    public function createFileObject(){
        $this->fileObject = $this->fileInfo->openFile();
    }
    public function createImageFile(){
        $fileStream = $this->fileObject->fread( $this->fileInfo->getSize() );
        $this->imageFile = imagecreatefromstring( $fileStream );
    }
    
}