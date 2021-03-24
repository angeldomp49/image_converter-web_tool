<?php
namespace Pixelsiete\Towebp;

class ImgFile{
    public GeneralFile $generalFile;
    public $handler;

    public function __construct( GeneralFile $generalFile ){
        $this->generalFile = $generalFile;
        $fileStream = $this->generalFile->fileObject->fread( $this->generalFile->fileInfo->getSize() );
        $this->handler = imagecreatefromstring( $fileStream );
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