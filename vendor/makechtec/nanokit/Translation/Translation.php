<?php
namespace MakechTec\Nanokit\Translation;

use MakechTec\Nanokit\Interfaces\EventListener;
use MakechTec\Nanokit\Url\Parser;

class Translation implements EventListener{
    private $listenerId;
    private $lang;

    public function handleEvent( &$request ){
        $slugs = Parser::slugsFromUri( $request->getUri() );
        $lang = $slugs[0];

        setlocale( LC_ALL, $lang );

        $request->setUri( Parser::removeSlugOfUri( $request->getUri(), $lang ) );
    }

    public function getListenerId(){
        return $this->listenerId;
    }

    public function setListenerId($listenerId){
        $this->listenerId = $listenerId;

        return $this;
    }
}