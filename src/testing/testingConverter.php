<?php
use Pixelsiete\Towebp\{ImgFileContainer, WebpConverter, FileGenerator, GeneralFile};
use MakechTec\Nanokit\Util\Logger;

try{
    $img = new ImgFile( "C:\Users\PixelSiete\Desktop\angel\codigo\toWebp\images\apple-touch-icon-114x114.png" );
    $webp = new WebpConverter();

    $webp->convert( $img );
}
catch( Exception $e ){
    Logger::log( $e->getMessage() );
}