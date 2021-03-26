<?php
namespace MakechTec\ImageConverter\Img;

use \Exception;
use MakechTec\Nanokit\Util\Logger;
use MakechTec\ImageConverter\GFile\GFile;

class Img extends GFile{
    public $handler;

    public function __construct( String $file ){
        super( $file );
        $this->handler = null;
    }

    public function openHandler(){
        $fileStream = $this->read();

        if( $this->isImageable( $fileStream ) ){
            $this->handler = imagecreatefromstring( $fileStream );

            $fileStream = null;
            $this->closeFileObject();
            return true;
        }
        else{
            return false;
        }
    }

    public function isImageable( String $fileStream){
        if( imagecreatefromstring( $fileStream ) == false ){
            Logger::warning( 'Failed to create image handler from file stream: ' . $this->fileInfo->getPathname() );
            return false;
        }
        else{
            return true;
        }
    }

    public function closeHandler(){
        $this->handler = null;
    }
}