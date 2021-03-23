<?php
namespace MakechTec\Nanokit\Interfaces;

interface EventListener{
    function getListenerId();
    function setListenerId( $listenerId );

    function handleEvent( &$objectToAnalyse );
}