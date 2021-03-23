<?php 
namespace MakechTec\PageManager\Mail;
use MakechTec\PageManager\Site;
use MakechTec\PageManager\Template\Template;

class MailSender{
    private $to;
    private $from;
    private $subject;
    private $headers;
    private $error;
    private $success;
    private $template;

    public static $RN   = "\r\n";
    public static $BCC_EMAILS                     = "";
    public static $BCC                            = "Bcc: \r\n";
    public static $REPLY_TO                       = "Reply To: \r\n";
    public static $MIME_V1                        = "MIME-Version: 1.0 \r\n";
    public static $CONTENT_TYPE_TEXT_HTML         = "Content-type:text/html;charset=UTF-8 \r\n";
    public static $CONTENT_TYPE_TEXT_PLAIN        = "Content-type:text/plain;charset=UTF-8 \r\n";
    public static $CONTENT_TYPE_APPLICATION_JSON  = "Content-type:aplication/json;charset=UTF-8 \r\n";
    public static $CONTENT_TYPE_APPLICATION_PDF   = "Content-type:aplication/pdf;charset=UTF-8 \r\n";



    public function  __construct( $to, $subject = "", $template_path = "", $template_data = [], $headersArray = [], $successMsg = null, $errorMsg = null){
        $this->to        = $to;
        $this->subject   = $subject;
        $this->headers   = $this->concatHeaders( $headersArray );
        $this->template  = $this->createTemplate( $template_path, $template_data );
        $this->setMessages($successMsg, $errorMsg);
    }

    public function setMessages( $success = "Success!", $error = "Error!" ){
        
        if( empty( $success ) ){
            $this->success = "Success!";
        }
        else{
            $this->success = $success;
        }

        if( empty( $error ) ){
            $this->error = "Error!";
        }
        else{
            $this->error = $error;
        }
    }

    public function send(){

        if( $this->template->errorFlag ){
            return $this->template->getError();
        }
        $sendMailCorrect = mail($this->to, $this->subject, $this->template->getContent(), $this->headers);
        return ( $sendMailCorrect ) ? $this->success : $this->error; 
    }

    public function concatHeaders( $headersArray ){
        $inlineHeaders = "";

        foreach( $headersArray as $header ){
            $inlineHeaders .= $header;
        }
        if(empty( $headersArray ) && empty( $inlineHeaders ) )
            return self::$CONTENT_TYPE_TEXT_PLAIN;
        else
            return $inlineHeaders;
    }

    public function createTemplate( $template_path, $template_data ){
        return new Template( $template_path, $template_data );
    }
}