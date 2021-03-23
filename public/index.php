<?php
include( '../vendor/autoload.php' );
include('../vendor/makechtec/nanokit/Util/functions.php');

use Pixelsiete\Towebp\{Towebp, ImgFile};

$input = rightPath( "images/src/uno.jpg" );
$output = rightPath( "images/dist/uno.webp" );

$towebp = new Towebp( $input, $output );
$towebp->convert();
