<?php

use Pixelsiete\Towebp\{ImgFileContainer, WebpConverter, FileGenerator, GeneralFile};
use \Exception;

class Test {
    public static function main2(){
        $source = "images/src";
        $dist = "images/dist";
        $source = rightPath( $source );
        $dist = rightPath( $dist );

        $webpContainer = new ImgFileContainer( $source );
        WebpConverter::convertAll( $webpContainer, $dist );
        
    }

    public static function main(){

        $fakeSource = "test/src";
        $fakeDest = "test/dist";
        
        try{
            $fileGen = new FileGenerator();
            
            $generalFile = new GeneralFile( 'test/src/test.png' );
            $generalFile->attemptOpenFileObject();
        
            $fileGen = new FileGenerator();
            $fileGen->importFiles();
        
            $imgFile = new ImgFile( $generalFile );
            $imgFile->openHandler();
        }
        catch( Exception $e ){
            echo( $e->getMessage() );
        }
        
    }
}