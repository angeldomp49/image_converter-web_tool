<?php 
namespace MakechTec\Nanokit\Http;

use MakechTec\Nanokit\Interfaces\{Event, EventListener};

class RequestEvent implements Event{
    private $listeners;
    private $realRequest;
    private $virtualRequest;

    public function launch(){
        $this->realRequest = new HttpRequest();
        $this->virtualRequest = $this->realRequest;
        $this->notifyEvent();
    }

    public function register( $listener ){
        $this->isListener( $listener );
        $this->listeners[ $listener->getListenerId() ] = $listener;
    }

    public function unRegister( $listenerId ){
        unset( $this->listeners[ $listenerId ] );
    }

    public function notifyEvent(){
        if( empty( $this->listeners ) ){
            return;
        }
        foreach ($this->listeners as $key => $value) {
            $value->handleEvent( $this->virtualRequest );
        }
    }

    public function isListener( $listener ){
        if(! $listener instanceof EventListener ){
            throw new \Exception( 'must implements EventListener' );
        }
    }

    public function getListeners(){
        return $this->listeners;
    }

    public function setListeners($listeners){
        $this->listeners = $listeners;

        return $this;
    }

    public function getRealRequest(){
        return $this->realRequest;
    }

    public function setRealRequest($realRequest){
        $this->realRequest = $realRequest;

        return $this;
    }

    public function getVirtualRequest(){
        return $this->virtualRequest;
    }

    public function setVirtualRequest($virtualRequest){
        $this->virtualRequest = $virtualRequest;

        return $this;
    }
}