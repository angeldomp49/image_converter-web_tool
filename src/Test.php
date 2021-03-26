<?php

use MakechTec\ImageConverter\Img\ImgContainer;
use MakechTec\ImageConverter\Converter\Webp;
use MakechTec\Nanokit\Util\Logger;

class Test {
    public static function main1(){
        $source = "images/src";
        $dist = "images/dist";
        $source = rightPath( $source );
        $dist = rightPath( $dist );

        $webpContainer = new ImgFileContainer( $source );
        WebpConverter::convertAll( $webpContainer, $dist );
        
    }

    public static function mai3(){
        $trueSource = "images";
        $trueDest = "";
        
        $trueSource = rightPath( $trueSource );
        
        try{
            $imgContainer = new ImgFileContainer( $trueSource );
            $imgFiles = $imgContainer->imgFiles;
            $handlersNum = 0;
            $handlersOpened = 0;
        
            foreach ($imgFiles as $imgFile ) {
                Logger::log( 'current imgFile: ' . $imgFile->generalFile->fileInfo->getPathname() );
                $isOpenedHandler = $imgFile->openHandler();
                if( $isOpenedHandler ){
                    $handlersNum++;
                    Logger::logDump( $imgFile->handler );
                }
                $imgFile->closeHandler();
                if( $imgFile->handler != null ){
                    $handlersOpened++;
                }
            }
            Logger::log('handlersOpenedAndClosed: ' . $handlersNum);
            Logger::log('handlersNotClosed: ' . $handlersOpened);
        }
        catch( Exception $e ){
            Logger::log( $e->getMessage() );
        }
    }

    public static function main2(){
        $a = new SplFileInfo( 'C:\Users\PixelSiete\Desktop\angel\codigo\toWebp\images\src\otro\dos.jpg' );
        Logger::logDump($a);
        $f = $a->openFile();
        Logger::logDump($f);
        $stream = $f->fread( $f->getSize() );
        Logger::log($stream);

        $b = new GeneralFile( 'C:\Users\PixelSiete\Desktop\angel\codigo\toWebp\images\src\otro\dos.jpg' );
        Logger::logDump($b->fileInfo);
        //$g = $b->openFileObject();
        //Logger::logDump($g);
        //$stream2 = $g->fread( $g->getSize() );
        $stream2 = $b->read();
        Logger::log($stream2);
    }

    public static function main4(){
        try{
            $source = "images\apple-touch-icon-114x114.png";
            $source = rightPath( $source );

            $destination = "images-dist\uno-nuevo.webp";
            $destination = rightPath( $destination );

            $img = new ImgFile( $source );
            $webp = new WebpConverter();
        
            $webp->convert( $img, $destination );
        }
        catch( Exception $e ){
            Logger::log( $e->getMessage() );
        }
    }

    public static function main(){
        $source = "images";
        $destination = "destination";

        $source = rightPath( $source );
        $destination = rightPath( $destination );

        try{
            $container = new ImgContainer( $source );
            $converter = new Webp();
            $converter->convertAll( $container, $destination );
        }
        catch( Exception $e ){
            Logger::log( $e->getMessage() );
        }
    }
}