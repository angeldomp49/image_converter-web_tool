<?php
namespace App\MakechTec\Converters;

use App\MakechTec\Converters\Converter;
use App\MakechTec\ImgFile;
use Illuminate\Support\Facades\Storage;

class Webp extends Converter{
    public const FILE_EXTENSION = '.webp';

    public function convertAll( Array $imgFiles, String $destinationDirectory ){
        foreach ($imgFileContainer->imgFiles as $imgFile ) {
            $newFileName = $this->createNewName( $imgFile, $imgFileContainer->sourceDirectory, $destinationDirectory, self::FILE_EXTENSION );
            $this->convert( $imgFile, $newFileName );
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