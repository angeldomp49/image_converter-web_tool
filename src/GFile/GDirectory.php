<?php
namespace MakechTec\ImageConverter\GFile;

use \Exception;
use MakechTec\Nanokit\Url\Parser;
use MakechTec\Nanokit\Util\Logger;
use MakechTec\ImageConverter\GFile\GFile;

abstract class GDirectory{
    private Array $files;
    public String $sourceDirectory;

    public abstract function importFiles( String $directory );

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

    public static function createDirIfNotExists( $absPath ){
        if( !is_dir( $absPath ) ){
            
            if( !mkdir( $absPath, 0777, true ) ){
                throw new Exception( 'Failed creating directory: ' . $absPath );
            }
        }
    }
}