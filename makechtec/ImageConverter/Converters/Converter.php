<?php 
namespace MakechTec\ImageConverter\Converters;

use MakechTec\ImageConverter\ImgFile;

abstract class Converter{
    public ImgFile $imgFile;
    public String $tempFilename;

    public function convert(String $raw) : String {
        return $this->loadFileInMemory( $raw )
            ->transform()
            ->readTempFile()
            ->deleteTempFile()
            ->getImgContent();
    }

    public function loadFileInMemory( String $raw ) : Converter { 
        $this->imgFile = ImgFile::createInMemory( $raw );
        return $this;
    }

    public function readTempFile() : Converter {
        $this->imgFile = new ImgFile( $this->tempFilename );
        return $this;
    }

    public function deleteTempFile() : Converter {
        unlink($this->tempFilename);
        return $this;
    }

    public function getImgContent() : String {
        return $this->imgFile->readContent();
    }


    public function isSupportedExtension ( String $extension ) : bool {
        return in_array( $extension, $this->supportedExtension() );
    }

    public abstract function transform() : Converter ;
    public abstract function supportedExtension() : Array;
    public abstract function finalExtension() : String ;

}