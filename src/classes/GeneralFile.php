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

    public function attemptOpenFileObject(){
        try{
            $this->openFileObject();
        }
        catch( \RuntimeException $re ){
            Throw new Exception( 'Failed to open FileObject with current permissions of: ' . $this->fileInfo->getPathname(), 1, $re );
        }
        catch( Exception $e ){
            Throw new Exception( 'Failed to open FileObject of : ' . $this->fileInfo->getPathname() );
        }
    }

    public function openFileObject(){
        $this->fileObject = $this->fileInfo->openFile();
    }

    public function closeFileObject(){
        $this->fileObject = null;
    }
}