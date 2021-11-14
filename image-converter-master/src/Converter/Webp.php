<?php
namespace MakechTec\ImageConverter\Converter;

use \Exception;
use \Throwable;
use \Error;
use MakechTec\Nanokit\Url\Parser;
use MakechTec\Nanokit\Util\Logger;
use MakechTec\ImageConverter\GFile\GDirectory;
use MakechTec\ImageConverter\Converter\Converter;
use MakechTec\ImageConverter\Img\{ImgFile,ImgContainer};


class Webp extends Converter{
    public const FILE_EXTENSION = '.webp';
    public const NOT_SUPPORTED_EXTENSIONS = [ 'ico', 'gif' ];

    public function convertAll( ImgContainer $imgFileContainer, String $destinationDirectory ){
        foreach ($imgFileContainer->imgFiles as $imgFile ) {
            $newFileName = $this->createNewName( $imgFile, $imgFileContainer->sourceDirectory, $destinationDirectory, self::FILE_EXTENSION );
            $this->convert( $imgFile, $newFileName );
        }
    }

    public function convert( ImgFile $imageFile, String $pathName ){
        $this->createContainerDir( $pathName );
        $imageFile->openHandler();
            $imgTrueColor = $imageFile->handler;
            imagepalettetotruecolor( $imgTrueColor );
            
            if( $this->isSupportedExtension( $imageFile ) ){
                imagewebp( $imgTrueColor, $pathName );
            }
            else{
                Logger::warning( 'Image cannot be webp' . $imageFile->fileInfo->getPathname() );
            }

        $imageFile->closeHandler();
    }

    public function createNewName( ImgFile $imgFile, String $sourceDir, String $destDir, String $newExtension){
        $oldExtension = '.' . $imgFile->fileInfo->getExtension();
        $newFileName = str_replace( $sourceDir, $destDir, $imgFile->fileInfo->getPathname() );
        $newFileName = str_replace( $oldExtension, $newExtension, $newFileName );
        return $newFileName;
    }

    public function createContainerDir( $fileAbsPath ){
        $dirAbsPath = Parser::removeFinalSlug( $fileAbsPath );
        GDirectory::createDirIfNotExists( $dirAbsPath );
    }

    public function isSupportedExtension( $imgFile ){
        foreach ( self::NOT_SUPPORTED_EXTENSIONS as $notSupportedExtension ) {
            if(strtolower( $notSupportedExtension ) == $imgFile->fileInfo->getExtension()){
                return false;
            }
        }
        return true;
    }

}