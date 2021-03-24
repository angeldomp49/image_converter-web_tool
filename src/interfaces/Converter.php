<?php
namespace Pixelsiete\Towebp\Interfaces;

interface Converter{
    public function convert( $imgFile, $pathName );
}