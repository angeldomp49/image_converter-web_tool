<?php
namespace Pixelsiete\Towebp;
use MakechTec\Nanokit\Url\Parser;

class WebpConverter {
    public const FILE_EXTENSION = '.webp';

    public function convert( $imageFile, $source, $dist ){
        $this->isValidImgFile( $imageFile );

        $fileExtension = '.' . $imageFile->generalFile->fileInfo->getExtension();

        $filenameDist = str_replace( $source, $dist, $imageFile->generalFile->fileInfo->getPathname() );
        $filePathDist = str_replace( $imageFile->generalFile->fileInfo->getFilename(), "", $filenameDist );

        $filenameDistNewExtension = str_replace( $fileExtension, self::FILE_EXTENSION, $filenameDist );

        mkdir( $filePathDist, 0777, true );
        /////////////////at this time we dont use the export function because it do this.//////////////////////
        imagewebp( $imageFile->handler, $filenameDistNewExtension );
    }

    public function convert2( $imageFile, $pathName ){
        $path = $this->removeFinalSlug( $pathName );

        $this->isValidImgFile( $imageFile );
        $this->createDirIfNotExists( $path );
        imagewebp( $imageFile->handler, $pathName );
    }

    public function isValidImgFile( $imageFile ){
        //TO DO CODE
    }

    public function createDirIfNotExists( $path ){
        if( !is_dir( $path ) ){
            mkdir( $path, 0777, true );
        }
    }

    public function removeFinalSlug( $uri ){
        $uriSlashes = Parser::equalSlashes( '/', $uri );
        $slugs = Parser::slugsFromUri( $uri );
        array_pop( $slugs );
        $newUri = Parser::uriFromSlugs( $slugs );
        $newUri = Parser::equalSlashes( '\\', $newUri );
        return $newUri;
    }

    public function convertAll( ImgFileContainer $imgFileContainer, $destinationDirectory ){
        foreach ($imgFileContainer->imgFiles as $imgFile ) {
            $this->convert( $imgFile, $imgFileContainer->sourceDirectory );
        }
    }
}