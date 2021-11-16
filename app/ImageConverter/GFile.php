<?php
namespace MakechTec\ImageConverter;

trait GFile {
    public function readContent() : String {
        return $this->fread($this->getSize());
    }

    public function base64Content(){
        return base64_encode( $this->readContent() );
    }

    public function uniqueName( String $basename = '', String $extension = ''){
        return $basename . '_' . (new \DateTime())->getTimestamp() . '.' . $extension;
    }

    public abstract function fread(int $size) : String;
    public abstract function getSize() : int;
}