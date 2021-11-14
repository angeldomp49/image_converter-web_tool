<?php
namespace App\MakechTec\Converters;

use App\MakechTec\ImgFile;

abstract class Converter{
    public abstract function convert( ImgFile $imgFile, String $destinationDirectory );
    public abstract function convertAll( Array $imgFiles, String $targetName );
    public abstract function notSupportedExtensions() : Array;

    public function isSupportedExtension( String $extension ){
        foreach ( $this->notSupportedExtensions() as $notSupportedExtension ) {
            if(strtolower( $notSupportedExtension ) == $extension){
                return false;
            }
        }
        return true;
    }
}