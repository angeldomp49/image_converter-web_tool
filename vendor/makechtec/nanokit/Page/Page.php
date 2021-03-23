<?php
namespace MakechTec\PageManager\Page;

class Page{

    public static $pages = [];

    private $title;
    private $url;
    private $id;
    private $breadcrumbs;

    /**
     * add a new page to the stock
     * @param           Page       $page        page to stock
     * @return          void
     */

    public static function addPage( Page $page ){
        array_push( self::$pages, $page );
    }

    /**
     * same as addPage but with an array
     * @param            Array           $pages        pages to stock
     * @return           void
     */

    public static function addPages( $pages ){

        if( is_array( $pages[0] ) ){
            foreach( $pages as $page ){
                $title = $page['title'];
                $url   = $page['url'];
                $id    = $page['id'];
                $page  = new Page( $title, $url, $id );
                self::addPage( $page );
            }
        }
        else{
            foreach( $pages as $page ){
                self::addPage( $page );
            }
        }
        
    }

    /**
     * get the specified Page object by her id if it's not exists return null
     * @param          int               $id 
     * @return         Page | null
     */

    public static function getPageById( $id ){
        foreach( self::$pages as $page ){
            if( $page->getId() == $id ){
                return $page;
            }
            else{
                //do nothing
            }
        }
        return null;
    }

    public function __construct( $title = '', $url = '', $id = -1, $breadcrumbs = null ){
        $this->title       = $title;
        $this->url         = $url;
        $this->id          = $id;
        $this->breadcrumbs = $breadcrumbs;
    }


    /************************statics******************* */

    /**
     * add a specified class after existent classes
     * 
     * return or show a specified class if its true or nothing if false
     * 
     * @param    boolean  $expression   if should add the class
     * @param    string   $classes      actual classes added
     * @param    string   $new_class    new class to add
     * @param    boolean  $show         if true echo else return
     * @return   string       all classes or only before classes 
     */

    public static function addClassName( $expression, $classes = "", $newClass = "", $show = true ){

        if( $expression ){
            $allClasses = $classes . ' ' . $newClass;
        }
        else {
            $allClasses = $classes . '';
        }
        
        if( $show ){
            echo( addslashes( $allClasses ) );
        }
        else{
            return( addslashes() );
        }
    }

    ////////getters

    public function getTitle(){
        return $this->title;
    }

    public function getUrl(){
        return $this->url;
    }

    public function getId(){
        return $this->id;
    }

    public function getBreadcrumbs(){
        return $this->breadcrumbs;
    }

    ///////setters

    public function setBreadcrumbs( $breadcrumbs ){
        $this->breadcrumbs = $breadcrumbs;
    }

    public function setTitle( $title ){
        $this->title = $title;
    }

    public function setUrl( $url ){
        $this->url = $url;
    }

    public function setId( $id ){
        $this->id = $id;
    }

}