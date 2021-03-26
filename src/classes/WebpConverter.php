<?php
namespace Pixelsiete\Towebp;
use MakechTec\Nanokit\Url\Parser;
use MakechTec\Nanokit\Util\Logger;
use \Exception;
use \Throwable;
use \Error;

class WebpConverter {
    public const FILE_EXTENSION = '.webp';
    public const NOT_SUPPORTED_EXTENSIONS = [ 'ico', 'gif' ];

    public static function convertAll( ImgFileContainer $imgFileContainer, String $destinationDirectory ){
        $instance = new WebpConverter();

        foreach ($imgFileContainer->imgFiles as $imgFile ) {
            $newFileName = $instance->createNewName( $imgFile, $imgFileContainer->sourceDirectory, $destinationDirectory, self::FILE_EXTENSION );
            $instance->convert( $imgFile, $newFileName );
        }
    }

    public function convert( ImgFile $imageFile, String $pathName ){
        $this->createContainerDir( $pathName );
        $imageFile->openHandler();
            Logger::log( "current file: " . $imageFile->generalFile->fileInfo->getPathname() );
            $imgTrueColor = $imageFile->handler;
            imagepalettetotruecolor( $imgTrueColor );
            
            if( $this->isSupportedExtension( $imageFile ) ){
                imagewebp( $imgTrueColor, $pathName );
            }
            else{
                Logger::warning( 'Image cannot be webp' . $imageFile->generalFile->fileInfo->getPathname() );
            }

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

    public function removeFinalSlug( $uri ){
        if( !is_string( $uri ) ){
            throw new Exception( "uri is not a string" );
        }

        $uriSlashes = Parser::equalSlashes( '/', $uri );
        $slugs = Parser::slugsFromUri( $uriSlashes );
        array_pop( $slugs );
        $newUri = Parser::uriFromSlugs( $slugs );
        $newUri = Parser::equalSlashes( '\\', $newUri );
        return $newUri;
    }

    public function createDirIfNotExists( $path ){
        if( !is_dir( $path ) ){
            
            if( !mkdir( $path, 0777, true ) ){
                throw new Exception( 'Failed creating directory: ' . $path );
            }
        }
    }

    public function isSupportedExtension( $imgFile ){
        foreach ( self::NOT_SUPPORTED_EXTENSIONS as $notSupportedExtension ) {
            if(strtolower( $notSupportedExtension ) == $imgFile->generalFile->fileInfo->getExtension()){
                return false;
            }
        }
        return true;
    }

}