<?php
namespace Pixelsiete\Towebp;

use Pixelsiete\Towebp\Interfaces\File;
use \SplFileInfo;
use \SplFileObject;

class GeneralFile implements File{
    public SplFileInfo $fileInfo;
    public SplFileObject $fileObject;

    public function __construct( String $filePath ){
        $this->fileInfo = new SplFileInfo( $filePath );
        $this->fileObject = $this->fileInfo->openFile();
    }

    public function getFileInfo(){

    }

    public function setFileInfo( SplFileInfo $fileInfo){

    }

    public function getFileObject(){

    }

    public function setFileObject( SplFileObject $fileObject){

    }
}