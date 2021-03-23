<?php
namespace MakechTec\PageManager\Page;

class Breadcrumb{
    private $title;
    private $url;


    ///////////constructors

    public function __construct( $title = '', $url = '' ){
        $this->title = $title;
        $this->url = $url;
    }

    ////////////getters

    public function getTitle(){
        return $this->title;
    }
    public function getUrl(){
        return $this->url;
    }

    ////////////setters

    public function setTitle( $title ){
        $this->title = $title;
    }

    public function setUrl( $url ){
        $this->url = $url;
    }

}