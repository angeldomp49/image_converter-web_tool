<?php
use MakechTec\Nanokit\Url\Parser;

function view( $name, $params ){
    extract( $params );
    include( rightPath( 'src/Views/' . $name . '.php' ) );
}



function rightPath( $resource = "" ){
    $resourceRightSlashes = Parser::equalSlashes( Parser::rootPath(), $resource );
    return Parser::rootPath() . $resourceRightSlashes;
}