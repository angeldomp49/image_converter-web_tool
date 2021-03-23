<?php
namespace Tests;

interface Testable{
    function getTestId();
    function setTestId( $id );

    function run();
}