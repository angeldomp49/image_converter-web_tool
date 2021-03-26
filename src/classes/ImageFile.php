<?php
namespace Pixelsiete\Towebp;

use \Exception;
use MakechTec\Nanokit\Util\Logger;

class ImgFile{
    public GeneralFile $generalFile;
    public $handler;

    public function __construct( $file ){
        if( is_string( $file ) ){
            $this->generalFile = new GeneralFile( $file );
        }
        else if( $file instanceof GeneralFile ){
            $this->generalFile = $file;
        }
        else{
            trigger_error( "ImgFile not created because param is not GeneralFile or String instance" );
            $this->generalFile = null;
        }
        $this->handler = null;
    }

    public function openHandler(){
        $fileStream = $this->generalFile->read();

        if( $this->isImageable( $fileStream, $this->generalFile) ){
            $this->handler = imagecreatefromstring( $fileStream );

            $fileStream = null;
            $this->generalFile->closeFileObject();
            return true;
        }
        else{
            return false;
        }
    }

    public function isImageable( $fileStream, GeneralFile $generalFile ){
        if( imagecreatefromstring( $fileStream ) == false ){
            trigger_error( 'Failed to create image handler from file stream: ' . $generalFile->fileInfo->getPathname(), E_USER_WARNING );
            return false;
        }
        else{
            return true;
        }
    }

    public function closeHandler(){
        $this->handler = null;
    }

    public static function toImgFile( GeneralFile $generalFile ){
        return new ImgFile( $generalFile );
    }

}