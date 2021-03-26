<?php
namespace MakechTec\Nanokit\Util;

class Logger{
    public static function log( String $message ){
        ?>
        <p><?php echo( $message ); ?></p>
        <?php
    }

    public static function logDump( $message ){
        ?>
        <p><?php echo( var_dump( $message )  ); ?></p>
        <?php
    }
    public static function warning( $message ){
        trigger_error( $message, E_USER_WARNING );
    }
}