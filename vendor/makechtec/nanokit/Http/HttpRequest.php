<?php 
namespace MakechTec\Nanokit\Http;

class HttpRequest {

    private $serverAddress       ;
    private $serverName          ;
    private $serverSoftware      ;
    private $serverProtocol      ;
    private $serverAdmin         ;
    private $serverPort          ;
    private $httpAccept          ;
    private $httpCharset         ;
    private $httpLang            ;
    private $httpConnection      ;
    private $httpHost            ;
    private $httpUserAg          ;
    private $remoteHost          ;
    private $remotePort          ;
    private $remoteUser          ;
    private $redirectRemoteUser  ;
    private $phpSelf             ;
    private $phpAuthDigest       ;
    private $phpAuthUser         ;
    private $phpAuthPw           ;
    private $scriptFilename      ;
    private $scriptName          ;
    private $authType            ;
    private $pathTranslated      ;
    private $pathInfo            ;
    private $origPathInfo        ;
    private $uri                 ;
    private $ssl                 ;
    private $method              ;
    private $time                ;
    private $queryString         ;

    public function __construct(){

        $this->serverAddress       = ( array_key_exists( 'SERVER_ADDR', $_SERVER  )      && $_SERVER['SERVER_ADDR'] ) ? $_SERVER['SERVER_ADDR'] : null;
        $this->serverName          = ( array_key_exists( 'SERVER_NAME', $_SERVER  )      && $_SERVER['SERVER_NAME'] ) ? $_SERVER['SERVER_NAME'] : null;
        $this->serverSoftware      = ( array_key_exists( 'SERVER_SOFTWARE', $_SERVER  )  && $_SERVER['SERVER_SOFTWARE'] ) ? $_SERVER['SERVER_SOFTWARE'] : null;  
        $this->serverProtocol      = ( array_key_exists( 'SERVER_PROTOCOL', $_SERVER  )  && $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : null; 
        $this->serverAdmin         = ( array_key_exists( 'SERVER_ADMIN', $_SERVER  )     && $_SERVER['SERVER_ADMIN'] ) ? $_SERVER['SERVER_ADMIN'] : null; 
        $this->serverPort          = ( array_key_exists( 'SERVER_PORT', $_SERVER  )      && $_SERVER['SERVER_PORT'] ) ? $_SERVER['SERVER_PORT'] : null; 

        $this->httpAccept          = ( array_key_exists( 'HTTP_ACCEPT', $_SERVER  )           && $_SERVER['HTTP_ACCEPT'] ) ? $_SERVER['HTTP_ACCEPT'] : null; 
        $this->httpCharset         = ( array_key_exists( 'HTTP_ACCEPT_CHARSET', $_SERVER  )   && $_SERVER['HTTP_ACCEPT_CHARSET'] ) ? $_SERVER['HTTP_ACCEPT_CHARSET'] : null; 
        $this->httpLang            = ( array_key_exists( 'HTTP_ACCEPT_LANGUAGE', $_SERVER  )  && $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : null; 
        $this->httpConnection      = ( array_key_exists( 'HTTP_CONNECTION', $_SERVER  )       && $_SERVER['HTTP_CONNECTION'] ) ? $_SERVER['HTTP_CONNECTION'] : null; 
        $this->httpHost            = ( array_key_exists( 'HTTP_HOST', $_SERVER  )             && $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : null; 
        $this->httpUserAg          = ( array_key_exists( 'HTTP_USER_AGENT', $_SERVER  )       && $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : null; 

        $this->remoteHost          = ( array_key_exists( 'REMOTE_HOST', $_SERVER  )           && $_SERVER['REMOTE_HOST'] ) ? $_SERVER['REMOTE_HOST'] : null; 
        $this->remotePort          = ( array_key_exists( 'REMOTE_PORT', $_SERVER  )           && $_SERVER['REMOTE_PORT'] ) ? $_SERVER['REMOTE_PORT'] : null; 
        $this->remoteUser          = ( array_key_exists( 'REMOTE_USER', $_SERVER  )           && $_SERVER['REMOTE_USER'] ) ? $_SERVER['REMOTE_USER'] : null; 
        $this->redirectRemoteUser  = ( array_key_exists( 'REDIRECT_REMOTE_USER', $_SERVER  )  && $_SERVER['REDIRECT_REMOTE_USER'] ) ? $_SERVER['REDIRECT_REMOTE_USER'] : null; 

        $this->phpSelf             = ( array_key_exists( 'PHP_SELF', $_SERVER  )         && $_SERVER['PHP_SELF'] ) ? $_SERVER['PHP_SELF'] : null; 
        $this->phpAuthDigest       = ( array_key_exists( 'PHP_AUTH_DIGEST', $_SERVER  )  && $_SERVER['PHP_AUTH_DIGEST'] ) ? $_SERVER['PHP_AUTH_DIGEST'] : null; 
        $this->phpAuthUser         = ( array_key_exists( 'PHP_AUTH_USER', $_SERVER  )    && $_SERVER['PHP_AUTH_USER'] ) ? $_SERVER['PHP_AUTH_USER'] : null; 
        $this->phpAuthPw           = ( array_key_exists( 'PHP_AUTH_PW', $_SERVER  )      && $_SERVER['PHP_AUTH_PW'] ) ? $_SERVER['PHP_AUTH_PW'] : null; 

        $this->scriptFilename      = ( array_key_exists( 'SCRIPT_FILENAME', $_SERVER  )  && $_SERVER['SCRIPT_FILENAME'] ) ? $_SERVER['SCRIPT_FILENAME'] : null; 
        $this->scriptName          = ( array_key_exists( 'SCRIPT_NAME', $_SERVER  )      && $_SERVER['SCRIPT_NAME'] ) ? $_SERVER['SCRIPT_NAME'] : null; 
        $this->authType            = ( array_key_exists( 'AUTH_TYPE', $_SERVER  )        && $_SERVER['AUTH_TYPE'] ) ? $_SERVER['AUTH_TYPE'] : null; 
        $this->pathTranslated      = ( array_key_exists( 'PATH_TRANSLATED', $_SERVER  )  && $_SERVER['PATH_TRANSLATED'] ) ? $_SERVER['PATH_TRANSLATED'] : null; 
        $this->pathInfo            = ( array_key_exists( 'PATH_INFO', $_SERVER  )        && $_SERVER['PATH_INFO'] ) ? $_SERVER['PATH_INFO'] : null; 
        $this->origPathInfo        = ( array_key_exists( 'ORIG_PATH_INFO', $_SERVER  )   && $_SERVER['ORIG_PATH_INFO'] ) ? $_SERVER['ORIG_PATH_INFO'] : null; 
        $this->uri                 = ( array_key_exists( 'REQUEST_URI', $_SERVER  )      && $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : null;
        $this->ssl                 = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === true );
        $this->method              = ( array_key_exists( 'REQUEST_METHOD', $_SERVER  )   && $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : null; 
        $this->time                = ( array_key_exists( 'REQUEST_TIME', $_SERVER  )     && $_SERVER['REQUEST_TIME'] ) ? $_SERVER['REQUEST_TIME'] : null; 
        $this->queryString         = ( array_key_exists( 'QUERY_STRING', $_SERVER  )     && $_SERVER['QUERY_STRING'] ) ? $_SERVER['QUERY_STRING'] : null; 

    }

    public function getUrl(){
        $url = ($this->getSsl()) ? 'https' : 'http';
        $url = $url . "://" . $this->getServerName();
        $url = $url . $this->getUri();
        
        return $url;
    }

    /**
     * Getter for ServerAddress
     *
     * @return [type]
     */
    public function getServerAddress()
    {
        return $this->serverAddress;
    }

    /**
     * Setter for ServerAddress
     * @var [type] serverAddress
     *
     * @return self
     */
    public function setServerAddress($serverAddress)
    {
        $this->serverAddress = $serverAddress;
        return $this;
    }


    /**
     * Getter for ServerName
     *
     * @return [type]
     */
    public function getServerName()
    {
        return $this->serverName;
    }

    /**
     * Setter for ServerName
     * @var [type] serverName
     *
     * @return self
     */
    public function setServerName($serverName)
    {
        $this->serverName = $serverName;
        return $this;
    }


    /**
     * Getter for ServerSoftware
     *
     * @return [type]
     */
    public function getServerSoftware()
    {
        return $this->serverSoftware;
    }

    /**
     * Setter for ServerSoftware
     * @var [type] serverSoftware
     *
     * @return self
     */
    public function setServerSoftware($serverSoftware)
    {
        $this->serverSoftware = $serverSoftware;
        return $this;
    }


    /**
     * Getter for ServerProtocol
     *
     * @return [type]
     */
    public function getServerProtocol()
    {
        return $this->serverProtocol;
    }

    /**
     * Setter for ServerProtocol
     * @var [type] serverProtocol
     *
     * @return self
     */
    public function setServerProtocol($serverProtocol)
    {
        $this->serverProtocol = $serverProtocol;
        return $this;
    }


    /**
     * Getter for ServerAdmin
     *
     * @return [type]
     */
    public function getServerAdmin()
    {
        return $this->serverAdmin;
    }

    /**
     * Setter for ServerAdmin
     * @var [type] serverAdmin
     *
     * @return self
     */
    public function setServerAdmin($serverAdmin)
    {
        $this->serverAdmin = $serverAdmin;
        return $this;
    }


    /**
     * Getter for ServerPort
     *
     * @return [type]
     */
    public function getServerPort()
    {
        return $this->serverPort;
    }

    /**
     * Setter for ServerPort
     * @var [type] serverPort
     *
     * @return self
     */
    public function setServerPort($serverPort)
    {
        $this->serverPort = $serverPort;
        return $this;
    }


    /**
     * Getter for HttpAccept
     *
     * @return [type]
     */
    public function getHttpAccept()
    {
        return $this->httpAccept;
    }

    /**
     * Setter for HttpAccept
     * @var [type] httpAccept
     *
     * @return self
     */
    public function setHttpAccept($httpAccept)
    {
        $this->httpAccept = $httpAccept;
        return $this;
    }


    /**
     * Getter for HttpCharset
     *
     * @return [type]
     */
    public function getHttpCharset()
    {
        return $this->httpCharset;
    }

    /**
     * Setter for HttpCharset
     * @var [type] httpCharset
     *
     * @return self
     */
    public function setHttpCharset($httpCharset)
    {
        $this->httpCharset = $httpCharset;
        return $this;
    }


    /**
     * Getter for HttpLang
     *
     * @return [type]
     */
    public function getHttpLang()
    {
        return $this->httpLang;
    }

    /**
     * Setter for HttpLang
     * @var [type] httpLang
     *
     * @return self
     */
    public function setHttpLang($httpLang)
    {
        $this->httpLang = $httpLang;
        return $this;
    }


    /**
     * Getter for HttpConnection
     *
     * @return [type]
     */
    public function getHttpConnection()
    {
        return $this->httpConnection;
    }

    /**
     * Setter for HttpConnection
     * @var [type] httpConnection
     *
     * @return self
     */
    public function setHttpConnection($httpConnection)
    {
        $this->httpConnection = $httpConnection;
        return $this;
    }


    /**
     * Getter for HttpHost
     *
     * @return [type]
     */
    public function getHttpHost()
    {
        return $this->httpHost;
    }

    /**
     * Setter for HttpHost
     * @var [type] httpHost
     *
     * @return self
     */
    public function setHttpHost($httpHost)
    {
        $this->httpHost = $httpHost;
        return $this;
    }


    /**
     * Getter for HttpUserAg
     *
     * @return [type]
     */
    public function getHttpUserAg()
    {
        return $this->httpUserAg;
    }

    /**
     * Setter for HttpUserAg
     * @var [type] httpUserAg
     *
     * @return self
     */
    public function setHttpUserAg($httpUserAg)
    {
        $this->httpUserAg = $httpUserAg;
        return $this;
    }


    /**
     * Getter for RemoteHost
     *
     * @return [type]
     */
    public function getRemoteHost()
    {
        return $this->remoteHost;
    }

    /**
     * Setter for RemoteHost
     * @var [type] remoteHost
     *
     * @return self
     */
    public function setRemoteHost($remoteHost)
    {
        $this->remoteHost = $remoteHost;
        return $this;
    }


    /**
     * Getter for RemotePort
     *
     * @return [type]
     */
    public function getRemotePort()
    {
        return $this->remotePort;
    }

    /**
     * Setter for RemotePort
     * @var [type] remotePort
     *
     * @return self
     */
    public function setRemotePort($remotePort)
    {
        $this->remotePort = $remotePort;
        return $this;
    }


    /**
     * Getter for RemoteUser
     *
     * @return [type]
     */
    public function getRemoteUser()
    {
        return $this->remoteUser;
    }

    /**
     * Setter for RemoteUser
     * @var [type] remoteUser
     *
     * @return self
     */
    public function setRemoteUser($remoteUser)
    {
        $this->remoteUser = $remoteUser;
        return $this;
    }


    /**
     * Getter for RedirectRemoteUser
     *
     * @return [type]
     */
    public function getRedirectRemoteUser()
    {
        return $this->redirectRemoteUser;
    }

    /**
     * Setter for RedirectRemoteUser
     * @var [type] redirectRemoteUser
     *
     * @return self
     */
    public function setRedirectRemoteUser($redirectRemoteUser)
    {
        $this->redirectRemoteUser = $redirectRemoteUser;
        return $this;
    }


    /**
     * Getter for PhpSelf
     *
     * @return [type]
     */
    public function getPhpSelf()
    {
        return $this->phpSelf;
    }

    /**
     * Setter for PhpSelf
     * @var [type] phpSelf
     *
     * @return self
     */
    public function setPhpSelf($phpSelf)
    {
        $this->phpSelf = $phpSelf;
        return $this;
    }


    /**
     * Getter for PhpAuthDigest
     *
     * @return [type]
     */
    public function getPhpAuthDigest()
    {
        return $this->phpAuthDigest;
    }

    /**
     * Setter for PhpAuthDigest
     * @var [type] phpAuthDigest
     *
     * @return self
     */
    public function setPhpAuthDigest($phpAuthDigest)
    {
        $this->phpAuthDigest = $phpAuthDigest;
        return $this;
    }


    /**
     * Getter for PhpAuthUser
     *
     * @return [type]
     */
    public function getPhpAuthUser()
    {
        return $this->phpAuthUser;
    }

    /**
     * Setter for PhpAuthUser
     * @var [type] phpAuthUser
     *
     * @return self
     */
    public function setPhpAuthUser($phpAuthUser)
    {
        $this->phpAuthUser = $phpAuthUser;
        return $this;
    }


    /**
     * Getter for PhpAuthPw
     *
     * @return [type]
     */
    public function getPhpAuthPw()
    {
        return $this->phpAuthPw;
    }

    /**
     * Setter for PhpAuthPw
     * @var [type] phpAuthPw
     *
     * @return self
     */
    public function setPhpAuthPw($phpAuthPw)
    {
        $this->phpAuthPw = $phpAuthPw;
        return $this;
    }


    /**
     * Getter for ScriptFilename
     *
     * @return [type]
     */
    public function getScriptFilename()
    {
        return $this->scriptFilename;
    }

    /**
     * Setter for ScriptFilename
     * @var [type] scriptFilename
     *
     * @return self
     */
    public function setScriptFilename($scriptFilename)
    {
        $this->scriptFilename = $scriptFilename;
        return $this;
    }


    /**
     * Getter for ScriptName
     *
     * @return [type]
     */
    public function getScriptName()
    {
        return $this->scriptName;
    }

    /**
     * Setter for ScriptName
     * @var [type] scriptName
     *
     * @return self
     */
    public function setScriptName($scriptName)
    {
        $this->scriptName = $scriptName;
        return $this;
    }


    /**
     * Getter for AuthType
     *
     * @return [type]
     */
    public function getAuthType()
    {
        return $this->authType;
    }

    /**
     * Setter for AuthType
     * @var [type] authType
     *
     * @return self
     */
    public function setAuthType($authType)
    {
        $this->authType = $authType;
        return $this;
    }


    /**
     * Getter for PathTranslated
     *
     * @return [type]
     */
    public function getPathTranslated()
    {
        return $this->pathTranslated;
    }

    /**
     * Setter for PathTranslated
     * @var [type] pathTranslated
     *
     * @return self
     */
    public function setPathTranslated($pathTranslated)
    {
        $this->pathTranslated = $pathTranslated;
        return $this;
    }


    /**
     * Getter for PathInfo
     *
     * @return [type]
     */
    public function getPathInfo()
    {
        return $this->pathInfo;
    }

    /**
     * Setter for PathInfo
     * @var [type] pathInfo
     *
     * @return self
     */
    public function setPathInfo($pathInfo)
    {
        $this->pathInfo = $pathInfo;
        return $this;
    }


    /**
     * Getter for OrigPathInfo
     *
     * @return [type]
     */
    public function getOrigPathInfo()
    {
        return $this->origPathInfo;
    }

    /**
     * Setter for OrigPathInfo
     * @var [type] origPathInfo
     *
     * @return self
     */
    public function setOrigPathInfo($origPathInfo)
    {
        $this->origPathInfo = $origPathInfo;
        return $this;
    }


    /**
     * Getter for Uri
     *
     * @return [type]
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Setter for Uri
     * @var [type] uri
     *
     * @return self
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }


    /**
     * Getter for Ssl
     *
     * @return [type]
     */
    public function getSsl()
    {
        return $this->ssl;
    }

    /**
     * Setter for Ssl
     * @var [type] ssl
     *
     * @return self
     */
    public function setSsl($ssl)
    {
        $this->ssl = $ssl;
        return $this;
    }


    /**
     * Getter for Method
     *
     * @return [type]
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Setter for Method
     * @var [type] method
     *
     * @return self
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }


    /**
     * Getter for Time
     *
     * @return [type]
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Setter for Time
     * @var [type] time
     *
     * @return self
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }


    /**
     * Getter for QueryString
     *
     * @return [type]
     */
    public function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * Setter for QueryString
     * @var [type] queryString
     *
     * @return self
     */
    public function setQueryString($queryString)
    {
        $this->queryString = $queryString;
        return $this;
    }

}