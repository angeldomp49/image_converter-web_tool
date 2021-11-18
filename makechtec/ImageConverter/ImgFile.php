<?php 
namespace MakechTec\ImageConverter;

use MakechTec\ImageConverter\GFile;
use \GdImage;
use SplFileObject;

class ImgFile extends SplFileObject {

    use GFile;

    public function getGDImage() : GdImage {
        $fileStream = $this->readContent();
        return imagecreatefromstring( $fileStream );
    }

    public static function createInMemory( String $content = '' ) : ImgFile {
        $imgFile = new self( 'php://memory', 'w+' );
        $imgFile->fwrite($content);
        return $imgFile;
    }
}