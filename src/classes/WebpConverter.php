<?php
namespace Pixelsiete\Towebp;

class WebpConverter {
    public const FILE_EXTENSION = '.webp';

    public function convert( $imageFile, $filename ){
        $this->isValidImgFile( $imageFile );

        $fileExtension = '.' . $imageFile->generalFile->fileInfo->getExtension();

        $filename = str_replace( $fileExtension, self::FILE_EXTENSION, $filename );

        /////////////////at this time we dont use the export function because it do this.//////////////////////
        imagewebp( $imageFile->handler, $filename );
    }

    public function isValidImgFile( $imageFile ){
        //TO DO CODE
    }
}