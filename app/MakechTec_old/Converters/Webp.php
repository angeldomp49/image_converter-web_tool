<?php
namespace App\MakechTec\Converters;

use App\MakechTec\Converters\Converter;
use App\MakechTec\ImgFile;

class Webp extends Converter{
    public $extension = 'webp';

    public function convertAll( Array $imgFiles, String $destinationDirectory ){
        foreach ($imgFiles as $imgFile ) {
            $targetName = $destinationDirectory . '/' . $this->changeNameExtension($imgFile);
            $this->convert( $imgFile, $targetName );
        }
    }

    public function convert( ImgFile $imageFile, String $targetName ){
        imagepalettetotruecolor( $imageFile->getGDImage());
        imagewebp( $imageFile->getGDImage(), $targetName );
    }

    public function notSupportedExtensions(): Array{
        return [ 'ico', 'gif' ];
    }

}