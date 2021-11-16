<?php
namespace App\MakechTec;

use \GdImage;
use Illuminate\Http\UploadedFile;
use \SplFileObject;

class ImgFile extends SplFileObject{

    use GFile;

    public function getGDImage() : GdImage {
        $fileStream = $this->fread($this->getSize());
        return imagecreatefromstring( $fileStream );
    }

    public static function createInMemory() : ImgFile{
        return new self( 'php://memory', 'w+' );
    }

    public static function fromUploadedFile( UploadedFile $file ){

    }
}