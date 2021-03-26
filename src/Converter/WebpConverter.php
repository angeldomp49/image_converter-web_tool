<?php
namespace MakechTec\ImageConverter\Converter;

use \Exception;
use \Throwable;
use \Error;
use MakechTec\Nanokit\Url\Parser;
use MakechTec\Nanokit\Util\Logger;
use MakechTec\ImageConverter\GFile\GDirectory;
use MakechTec\ImageConverter\Converter\Converter;

class WebpConverter extends Converter{
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

    public function createContainerDir( $fileAbsPath ){
        $dirAbsPath = Parser::removeFinalSlug( $fileAbsPath );
        GDirectory::createDirIfNotExists( $dirAbsPath );
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