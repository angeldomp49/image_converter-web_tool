<?php
namespace Pixelsiete\Towebp;

use Pixelsiete\Towebp\Interfaces\File;
use MakechTec\Nanokit\Url\Parser;
use Logger;

class FileGenerator{
    private Array $files;

    public function importFiles( String $directory ){
        if( !is_dir( $directory ) ){
            throw new Exception( "Directory not exists: " . $directory );
        }

        $fileNames = $this->importFileNamesRecursively( $directory );
        $fileObjects = [];

        foreach ($fileNames as $fileName) {
            $fileObjects[] = new GeneralFile( $fileName );
        }
        
        return $fileObjects;
    }

    public function importFileNamesRecursively( $dir, &$results = array() ) {
        $directory = Parser::removeEndChar( $dir, '/\\\\$/' );
        $directory = Parser::removeEndChar( $directory, '/\/$/' );

        $this->attemptScandir( $directory );
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

    public function attemptScandir( $dir ){
        $result = null;

        try{
            $result = scandir( $dir );
        }
        catch( Exception $e ){
            throw new Exception( "Error it's not a directory: " . $dir );
        }

        if( $result == false ){
            throw new Exception( "Error reading file names in directory: " . $dir );
        }
    }

    public function removeDots( Array $arr ){
        $cleaned = [];
        foreach ($arr as $value) {
            if( $value != '.' && $value != '..' ){
                $cleaned[] = $value;
            }
        }

        return $cleaned;
    }
}