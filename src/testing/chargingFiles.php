<?php
use Pixelsiete\Towebp\{ImgFileContainer, WebpConverter, FileGenerator, GeneralFile};
use MakechTec\Nanokit\Util\Logger;

$fakeSource = "test/src";
$fakeDest = "test/dist";

$trueSource = "images/src";
$trueDest = "";

$trueSource = rightPath( $trueSource );

try{
    $imgContainer = new ImgFileContainer( $fakeSource );
}
catch( Exception $e ){
    Logger::log( 'Exception successful launched with the next message: ' );
    Logger::log( $e->getMessage() );
}

try{
    $imgContainer = new ImgFileContainer( $trueSource );
    Logger::log( 'Successful readed source: ' . $trueSource );
    $imgFiles = $imgContainer->imgFiles;

    foreach ($imgFiles as $file ) {
        Logger::log('Files charged: ');
        Logger::log( $file->generalFile->fileInfo->getPathname() );
    }
}
catch( Exception $e ){
    Logger::log( $e->getMessage() );
}
