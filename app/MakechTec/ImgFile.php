<?php
namespace App\MakechTec;

use \GdImage;
use \SplFileObject;

class ImgFile extends SplFileObject{

    public function getGDImage() : GdImage {
        $fileStream = $this->fread($this->getSize());
        return imagecreatefromstring( $fileStream );
    }
}