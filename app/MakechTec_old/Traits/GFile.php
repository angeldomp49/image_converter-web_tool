<?php 
namespace App\MakechTec;

trait GFile {
    public static function generateName( $extension ){
        return 'file_' . (new \DateTime())->getTimestamp() . '.' . $extension;
    }

    public function base64Content(){
        return base64_encode( $this->fread($this->getSize()) );
    }

    public abstract function fread( int $size);
    public abstract function getSize();
}