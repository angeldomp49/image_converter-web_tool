<?php
namespace Pixelsiete\Towebp\Interfaces;

interface ImgFileContainer{
    public function importImgFiles( String $directory );

    public function exportImgFiles( String $directory );

    public function transformImgFiles( $converter, $source,$dist );

    public function isValidConverter( $converter );
}