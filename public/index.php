<?php
include( '../vendor/autoload.php' );
include('../vendor/makechtec/nanokit/Util/functions.php');

use Pixelsiete\Towebp\{Towebp, ImgFile, NameParser};
use MakechTec\Nanokit\Url\Parser;

$input = "images/src/";
$output = "images/dist/";

$m = new NameParser( rightPath($input), $output );
$results = $m->getDirContents( rightPath($input));

echo( var_dump( $results ) );

