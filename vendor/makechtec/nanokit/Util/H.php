<?php
namespace MakechTec\Nanokit\Util;

class H{

    public static function divideString( $str, $divider ){
        $firstPart   = strstr( $str, $divider, true );
        $secondPart     = strstr( $str, $divider );
        $secondPart  = substr( $secondPart, 1, strlen( $secondPart ) );

        return [
            "first"  => $firstPart,
            "second" => $secondPart
        ];
    }

}