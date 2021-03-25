<?php
namespace Pixelsiete\Towebp;
use MakechTec\Nanokit\Url\Parser;

class WebpConverter {
    public const FILE_EXTENSION = '.webp';

    public static function convertAll( ImgFileContainer $imgFileContainer, String $destinationDirectory ){
        $instance = new WebpConverter();


        foreach ($imgFileContainer->imgFiles as $imgFile ) {
            $newFileName = $instance->createNewName( $imgFile, $imgFileContainer->sourceDirectory, $destinationDirectory, self::FILE_EXTENSION );
            $instance->convert( $imgFile, $newFileName );
        }
    }
/*
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
    */

    public function convert( ImgFile $imageFile, String $pathName ){
        $this->createContainerDir( $pathName );
        $imageFile->openHandler();

        imagewebp( $imageFile->handler, $pathName );

        $imageFile->closeHandler();
    }

    public function createNewName( ImgFile $imgFile, String $sourceDir, String $destDir, String $newExtension){
        $oldExtension = '.' . $imgFile->generalFile->fileInfo->getExtension();
        $newFileName = str_replace( $sourceDir, $destDir, $imgFile->generalFile->fileInfo->getPathname() );
        $newFileName = str_replace( $oldExtension, $newExtension, $newFileName );
        return $newFileName;
    }

    public function createContainerDir( $pathName ){
        $path = $this->removeFinalSlug( $pathName );
        $this->createDirIfNotExists( $path );
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

}