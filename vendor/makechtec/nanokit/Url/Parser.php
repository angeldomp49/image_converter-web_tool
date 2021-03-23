<?php
namespace MakechTec\Nanokit\Url;
use MakechTec\Nanokit\Util\H;

class Parser{
    public const FROM_ROOT_DIRECTORY_PROJECT = 'vendor/makechtec/nanokit/Url';

    public const START_SLASH_REGEX = '/^\//';
    public const END_SLASH_REGEX = '/\/$/';
    public const SLASH_REGEX = '/\//';
    public const SLASH = '/';

    public const ANTI_SLASH_REGEX = '/\\\\/';
    public const ANTI_SLASH = '\\';

    public const CURLY_BRACKETS_REGEX = '/\{.*\}/';
    public const START_CURLY_BRACKET_REGEX = '/^\{/';
    public const END_CURLY_BRACKET_REGEX = '/\}$/';

    public const ROUTE_PARAM_NAME_REGEX = '/\{(.*?)\}/';

    public const ANY_CHAR_ANY_TIMES = '(.*)';
    public const SLASH_SCAPED = '\/';

    public const STRING_EMPTY = '';

    public static function paramsNamesFromSlugs( $slugs ){
        $paramsNamesWithCurlyBrackets = preg_grep( self::CURLY_BRACKETS_REGEX, $slugs );
        $paramsNames = [];

        foreach ($paramsNamesWithCurlyBrackets as $name ) {
            $paramsNames[] = self::removeAroundCurlyBrackets( $name );
        }

        return $paramsNames;
    }

    public static function slugsFromUri( $uri ){
        $result = [];
        
        $uri = self::removeAroundSlashes( $uri );

        while( strpos( $uri, self::SLASH ) ){

            $segments   = H::divideString( $uri, self::SLASH );
            $slugToSave = $segments['first'];
            $uri       = $segments['second'];
            array_push( $result, $slugToSave );
        }

        array_push( $result, $uri );

        return $result;
    }
    
    public static function rootPath(){
        $pathFromDisk    = __DIR__;
        $pathFromRootDirectoryProjectSameSlashes = self::equalSlashes( $pathFromDisk, self::FROM_ROOT_DIRECTORY_PROJECT);
    
        return str_replace( $pathFromRootDirectoryProjectSameSlashes, "", $pathFromDisk  );
    }

    public static function equalSlashes( $reference = "", $target = "" ){

        if( preg_match( self::SLASH_REGEX, $reference ) ){
            return preg_replace( self::ANTI_SLASH_REGEX, self::SLASH, $target );
        }
        else if ( preg_match( self::ANTI_SLASH_REGEX, $reference ) ){
            return preg_replace( self::SLASH_REGEX, self::ANTI_SLASH, $target );
        }
    }

    public static function removeSlugOfUri( $uri, $slug ){
        $uriSlugs = self::slugsFromUri( $uri );
        $arrSlug = [ self::removeAroundSlashes( $slug ) ];

        $uriWithoutSlug = array_diff( $uriSlugs, $arrSlug );
        $uriReformed = self::uriFromSlugs( $uriWithoutSlug );

        return self::checkIndex( $uriReformed );
    }

    public static function uriFromSlugs( $slugs ){
        $uri = '';

        foreach ($slugs as $slug) {
            $uri .= $slug . self::SLASH;
        }

        return self::removeAroundSlashes( $uri );
    }
    
    public static function createRegexFromRouteUri( $routeUri ){
        $anyValue = preg_replace( self::ROUTE_PARAM_NAME_REGEX, self::ANY_CHAR_ANY_TIMES, $routeUri );
        $anyValueAndScapedSlashes = preg_replace( self::SLASH_REGEX, self::SLASH_SCAPED, $anyValue );
        $routeUriRegex = self::SLASH . $anyValueAndScapedSlashes . self::SLASH;

        return $routeUriRegex;
    }

    public static function checkIndex( $uri = "" ){
        return ( 0 == strcmp( $uri, Parser::SLASH ) || 0 == strcmp( $uri, Parser::STRING_EMPTY ) ) ? Parser::SLASH : Parser::removeAroundSlashes( $uri );
    }

    public static function removeAroundSlashes( $str ){
        $newStr = "";

        $newStr = self::removeStartSlash( $str );
        $newStr = self::removeEndSlash( $newStr );

        return $newStr;
    }

    public static function removeStartSlash( $str ){
        if( self::isStartSlash( $str ) ){
            return substr( $str, 1, strlen( $str ) );
        }
        else{
            return $str;
        }
    }

    public static function isStartSlash( $str ){
        return ( preg_match( self::START_SLASH_REGEX, $str ) ) ? true : false; 
    }

    public static function removeEndSlash( $str ){
        if( self::isEndSlash( $str ) ){
            return substr( $str, 0, strlen( $str ) -1 );
        }
        else{
            return $str;
        }
    }

    public static function isEndSlash( $str ){
        return ( preg_match( self::END_SLASH_REGEX, $str ) ) ? true : false;
    }


    public static function removeAroundCurlyBrackets( $str ){
        $newStr = "";

        $newStr = self::removeStartCurlyBracket( $str );
        $newStr = self::removeEndCurlyBracket( $newStr );

        return $newStr;
    }

    public static function removeStartCurlyBracket( $str ){
        if( self::isStartCurlyBracket( $str ) ){
            return substr( $str, 1, strlen( $str ) );
        }
        else{
            return $str;
        }
    }

    public static function isStartCurlyBracket( $str ){
        return ( preg_match( self::START_CURLY_BRACKET_REGEX, $str ) ) ? true : false; 
    }

    public static function removeEndCurlyBracket( $str ){
        if( self::isEndCurlyBracket( $str ) ){
            return substr( $str, 0, strlen( $str ) -1 );
        }
        else{
            return $str;
        }
    }

    public static function isEndCurlyBracket( $str ){
        return ( preg_match( self::END_CURLY_BRACKET_REGEX, $str ) ) ? true : false;
    }

}