<?php
namespace Pixelsiete\Towebp;

use Pixelsiete\Towebp\Interfaces\File;
use \SplFileInfo;
use \SplFileObject;
use \Exception;

class GeneralFile{
    public SplFileInfo $fileInfo;
    public SplFileObject $fileObject;

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
            Throw new Exception( 'Failed to open FileObject with current permissions of: ' . $this->fileInfo->getPathname(), 1, $re );
        }
        catch( Exception $e ){
            Throw new Exception( 'Failed to open FileObject of : ' . $this->fileInfo->getPathname() );
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