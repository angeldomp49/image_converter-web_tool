<?php
namespace MakechTec\Nanokit\Core;

use MakechTec\Nanokit\Http\HttpRequest;

class Site{
    public static $site;

    public $virtualRequest;
    private $realRequest;
    public $locale;

    public static function createSite( HttpRequest $request ){
        $site = new Site();
        $site->virtualRequest = $request;
        $site->realRequest = $request;

        self::$site = $site;
        return self::$site;
    }

    public function setVirtualRequest( HttpRequest $request ){
        $this->virtualRequest = $request;
    }

    public function updateLocale(){
        setlocale( $this->locale );
        putenv( 'E_LOCAL=' . $this->locale );
    }
}