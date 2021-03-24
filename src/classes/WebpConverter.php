<?php
namespace Pixelsiete\Towebp;
use Logger;

class WebpConverter {
    public const FILE_EXTENSION = '.webp';

    public function convert( $imageFile, $source, $dist ){
        $this->isValidImgFile( $imageFile );

        $fileExtension = '.' . $imageFile->generalFile->fileInfo->getExtension();

        $filenameDist = str_replace( $source, $dist, $imageFile->generalFile->fileInfo->getPathname() );
        $filePathDist = str_replace( $imageFile->generalFile->fileInfo->getFilename(), "", $filenameDist );

        $filenameDistNewExtension = str_replace( $fileExtension, self::FILE_EXTENSION, $filenameDist );

        Logger::log( "File to create: " . $filenameDistNewExtension );
        Logger::log( "path destination: " . $filePathDist );
        mkdir( $filePathDist, 0777, true );
        /////////////////at this time we dont use the export function because it do this.//////////////////////
        imagewebp( $imageFile->handler, $filenameDistNewExtension );
    }

    public function isValidImgFile( $imageFile ){
        //TO DO CODE
    }
}