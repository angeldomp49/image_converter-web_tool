<?php
namespace Pixelsiete\Towebp;

use Pixelsiete\Towebp\Interfaces\File;
use MakechTec\Nanokit\Url\Parser;

class FileGenerator{
    private Array $files;

    public function importFiles( String $directory ){
        $fileNames = $this->importFileNamesRecursively( $directory );
        $fileObjects = [];

        foreach ($fileNames as $fileName) {
            $fileObjects[] = new GeneralFile( $fileName );
        }
        
        return $fileObjects;
    }

    public function exportFiles( String $directory, Array $files ){
        foreach ($files as $file ) {
            $this->exportFile( $file );
        }
    }

    public function exportFile(){
        //TODO CODE
    }

    public function isValidFile( $file ){
        if(  !($file instanceof File) ){
            throw new Exception( "invalid file in " . __CLASS__ . " at function " . __FUNCTION__ );
        }
    }

    public function importFileNamesRecursively( $dir, &$results = array() ) {
        $directory = Parser::removeEndChar( $dir, '/\\\\$/' );
        $directory = Parser::removeEndChar( $directory, '/\/$/' );

        $files = scandir($directory);
        $files = $this->removeDots( $files );
    
        foreach ($files as $file ) {

            $absFilename = $directory . Parser::SLASH . $file;
            $absFilename = Parser::equalSlashes( $directory, $absFilename );


            if( is_dir( $absFilename ) ){
                $this->importFileNamesRecursively( $absFilename,  $results);
            }
            else{
                $results[] = $absFilename;
            }
        }
    
        return $results;
    }

    public function removeDots( Array $arr ){
        $cleaned = [];
        foreach ($arr as $key => $value) {
            if( $value != '.' && $value != '..' ){
                $cleaned[] = $value;
            }
        }

        return $cleaned;
    }
}