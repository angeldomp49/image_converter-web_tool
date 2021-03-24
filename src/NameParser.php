<?php 
namespace Pixelsiete\Towebp;

use MakechTec\Nanokit\Url\Parser;

class NameParser{
    public const ALL_IMAGES_IN_ALL_SUB_DIRECTORIES = "**/*.{jpg,JPG,jpeg,JPEG,png}";
    public String $inputDir;
    public String $outputDir;
    public Array $files;

    public function __construct( String $inputDir, String $outputDir ){
        $this->inputDir = $inputDir;
        $this->outputDir = $outputDir;
    }

    public function getDirContents( $dir, &$results = array() ) {
        $directory = Parser::removeEndChar( $dir, '/\\\\$/' );
        $directory = Parser::removeEndChar( $directory, '/\/$/' );

        $files = scandir($directory);
        $files = $this->removeDots( $files );
    
        foreach ($files as $file ) {

            $absFilename = $directory . Parser::SLASH . $file;
            $absFilename = Parser::equalSlashes( $directory, $absFilename );


            if( is_dir( $absFilename ) ){
                $this->getDirContents( $absFilename,  $results);
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
        

    public function readFiles(){
        
        echo( var_dump( scandir( $this->inputDir ) ) );
    }

    public function changeExtension( String $name, String $oldExtension, String $newExtension ){
        return str_replace( $oldExtension, $newExtension, $name );
    }
    public function changeDir( String $name, String $oldDir, String $newDir ){
        return str_replace( $oldDir, $newDir, $name );
    }

}