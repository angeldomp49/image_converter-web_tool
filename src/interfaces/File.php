<?php
namespace Pixelsiete\Towebp\Interfaces;

use \SplFileInfo;
use \SplFileObject;

interface File{
    public function __construct( String $filePath );

    public function getFileInfo();

    public function setFileInfo( SplFileInfo $fileInfo);

    public function getFileObject();

    public function setFileObject( SplFileObject $fileObject);
}