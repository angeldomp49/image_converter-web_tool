<?php
namespace MakechTec\ImageConverter\GFile;

use \SplFileInfo;
use \SplFileObject;
use \Exception;

abstract class GFile{
    public $fileInfo;
    public $fileObject;

    public function __construct( String $filePath ){
        if( !file_exists( $filePath ) ){
            throw new Exception( "File not exists: " . $filePath );
        }
        $this->fileInfo = new SplFileInfo( $filePath );
    }

    public function read(){
        $fileObject = $this->fileInfo->openFile();
        return $fileObject->fread( $fileObject->getSize() );
    }

    public function fileCanBeOpened(){
        try{
            $this->fileObject = $this->fileInfo->openFile();
        }
        catch( \RuntimeException $re ){
            throw new Exception( 'Failed to open FileObject with current permissions of: ' . $this->fileInfo->getPathname(), 1, $re );
        }
        catch( Exception $e ){
            throw new Exception( 'Failed to open FileObject of : ' . $this->fileInfo->getPathname() );
        }
        unset($this->fileObject);
    }

    public function fileIsReadable(){
        if( ($this->fileObject->fread( $this->fileInfo->getSize())) == false ){
            throw new Exception( 'Failed read file: ' . $this->fileInfo->getPathname() );
        }
    }

    public function closeFileObject(){
        unset($this->fileObject);
    }
}