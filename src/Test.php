<?php

use Pixelsiete\Towebp\{ImgFileContainer, WebpConverter, FileGenerator, GeneralFile};
use MakechTec\Nanokit\Util\Logger;

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

    public static function main4(){
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
}