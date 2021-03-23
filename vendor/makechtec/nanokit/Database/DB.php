<?php
namespace MakechTec\Nanokit\Database;

use MakechTec\Nanokit\Interfaces\EventListener;
use Illuminate\Database\Capsule\Manager as Capsule;

class DB implements EventListener{
    private $listenerId;
    private $DB;

    public function handleEvent( &$request ){
        $DB = new Capsule();

        $DB->addConnection([
            "driver" => DBDRIVER,
            "host" => DBHOST,
            "database" => DBNAME,
            "username" => DBUSER,
            "password" => DBPASSWORD
        ]);
        
        $DB->setAsGlobal();
        $DB->bootEloquent();
        $this->DB = $DB;
    }

    public function __construct( $listenerId ){
        $this->listenerId = $listenerId;
    }

    public function getListenerId(){
        return $this->listenerId;
    }

    public function setListenerId($listenerId){
        $this->listenerId = $listenerId;

        return $this;
    }
}