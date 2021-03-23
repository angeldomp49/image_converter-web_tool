<?php
namespace MakechTec\Nanokit\Http;

use MakechTec\Nanokit\Url\Parser;

class Route{
    public const GET = 0;
    public const POST = 1;

    private static $routes;
    private static $currentRoute;

    private $uri;
    private $requestType;
    private $classController;
    private $methodController;
    private $parameters;
    private $request;

    public static function get( $uri, $controller ){
        $route = self::createRoute( self::GET, $uri, $controller );
        self::register( $route );
    }

    public static function post( $uri, $controller ){
        $route = self::createRoute( self::POST, $uri, $controller );
        self::register( $route );
    }

    public static function createRoute( $requestType, $uri, $controller ){
        $route = new Route();
        $route->setRequestType( $requestType );
        $route->setUri( $uri );
        $route->setClassController( $controller[0] );
        $route->setMethodController( $controller[1] );
        return $route;
    }

    public static function register( Route $route ){
        self::$routes[] = $route;
    }

    public static function currentRoute( HttpRequest $request ){

        foreach (self::$routes as $route){
            if( self::matchRequestRoute( $request, $route ) ){
                self::initCurrentRoute( $request, $route );
                return self::$currentRoute;
            }
        }

        throw new Exception( 'Route not found with uri = ' . $request->geturi() );
    }

    public static function initCurrentRoute( HttpRequest $request, Route $route ){
        self::$currentRoute = $route;
        self::$currentRoute->request = $request;
        self::$currentRoute->generateParameters();
    }

    public static function matchRequestRoute( HttpRequest $request, Route $route ){ 
        $requestUri = Parser::checkIndex( $request->getUri() );
        $routeUri = Parser::checkIndex( $route->getUri() );
        $routeRegex = Parser::createRegexFromRouteUri( $routeUri );
        $isEqual = preg_match( $routeRegex, $requestUri );
        return $isEqual;
    }

    public function generateParameters(){
        $routeSlugs = Parser::slugsFromUri( $this->getUri() );
        $paramsNames = Parser::paramsNamesFromSlugs( $routeSlugs );

        $requestSlugs = Parser::slugsFromUri( $this->request->getUri() );
        $paramsValues = array_diff( $requestSlugs, $routeSlugs );
        
        $parameters = array_combine( $paramsNames, $paramsValues );
        $this->setParameters( $parameters);
    }

    
    public function getUri(){
        return $this->uri;
    }

    public function setUri($uri){
        $this->uri = $uri;

        return $this;
    }

    public function getRequestType(){
        return $this->requestType;
    }

    public function setRequestType($requestType){
        $this->requestType = $requestType;

        return $this;
    }

    public function getClassController(){
        return $this->classController;
    }

    public function setClassController($classController){
        $this->classController = $classController;

        return $this;
    }

    public function getMethodController(){
        return $this->methodController;
    }

    public function setMethodController($methodController){
        $this->methodController = $methodController;

        return $this;
    }

    public function getParameters(){
        return $this->parameters;
    }

    public function setParameters($parameters){
        $this->parameters = $parameters;

        return $this;
    }

}