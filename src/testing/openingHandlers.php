<?php
use Pixelsiete\Towebp\{ImgFileContainer, WebpConverter, FileGenerator, GeneralFile};
use MakechTec\Nanokit\Util\Logger;

$trueSource = "images/src";
$trueDest = "";

$trueSource = rightPath( $trueSource );

try{
    $imgContainer = new ImgFileContainer( $trueSource );
    $imgFiles = $imgContainer->imgFiles;
    $handlersNum = 0;
    $handlersOpened = 0;

    foreach ($imgFiles as $imgFile ) {
        Logger::log( 'current imgFile: ' . $imgFile->generalFile->fileInfo->getPathname() );
        $imgFile->openHandler();
        $handlersNum++;
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