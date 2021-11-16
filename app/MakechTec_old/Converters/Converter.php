<?php
namespace App\MakechTec\Converters;

use App\MakechTec\ImgFile;
use SplFileObject;

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

    public function changeNameExtension( SplFileObject $file) : String {

        $regexExtension = '/\.'. $file->getExtension() .'$/';
        $newExtensionDot = '.' . $this->targetExtension();

        return preg_replace( $regexExtension, $newExtensionDot, $file->getBasename() );
    }

    public function targetExtension(){
        return ( new (get_called_class()))->extension ?? null;
    }

    
}