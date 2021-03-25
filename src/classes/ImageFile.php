<?php
namespace Pixelsiete\Towebp;

class ImgFile{
    public GeneralFile $generalFile;
    public $handler;

    public function __construct( GeneralFile $generalFile ){
        $this->generalFile = $generalFile;
    }

    public function openHandler(){
        $this->generalFile->openFileObject();

        $this->fileIsReadable( $this->generalFile );
        $fileStream = $this->generalFile->fileObject->fread( $this->generalFile->fileInfo->getSize() );

        $this->isImageable();
        $this->handler = imagecreatefromstring( $fileStream );

        $fileStream = null;
        $this->generalFile->closeFileObject();
    }

    public function fileIsReadable( GeneralFile $generalFile ){
        if( !($generalFile->fileObject->fread( $generalFile->fileInfo->getSize()) ) ){
            throw new Exception( 'Failed read file: ' . $this->generalFile->fileInfo->getPathname() );
        }
    }

    public function isImageable( $fileStream, GeneralFile $generalFile ){
        if( imagecreatefromstring( $fileStream ) == false ){
            Throw new Exception( 'Failed to create image handler from file stream: ' . $generalFile->fileInfo->getPathname() );
        }
    }

    public function closeHandler(){
        $this->handler = null;
    }

    public static function toImgFile( GeneralFile $generalFile ){
        if( self::isImage() ){
            return new ImgFile( $generalFile );
        }
    }

    public static function isImage(){
        // TO DO CODE
        return true;
    }

}