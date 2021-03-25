<?php

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
