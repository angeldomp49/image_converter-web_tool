<?php
namespace MakechTec\PageManager\Template;

class Template{

    private $bagData;
    private $content;
    private $error;
    public  $errorFlag;


    
    /**
     * convert a file content in a string and return its
     * 
     * call and execute a php file with the $template_data passed, then the ouput is stocked in a variable,
     * the variables passed like an array are inserted into $bagData
     * 
     * @param       $path                    string          file path
     * @param       $template_data           array           an array with the template data
     * @return      string                   processed php file content
     */

    public function __construct( $file_path = "", $template_data = null ){

        $this->setError("");
        $this->erroFlag = false;

        if( $template_data !== null ){
            foreach( $template_data as $key => $value ){
                $template_data[$key] = ( isset( $value ) ) ? $value : ""; 
            }
        }
        else{
            //do nothing
        }
        
        $params = $template_data;

        if( !file_exists( $file_path ) ){
            $this->setError("template not found: ".$file_path);
            $this->errorFlag = true;
            $this->setContent( "" );
        }
        else{
            ob_start();
            include( $file_path );
            $this->setContent( ob_get_contents() );
            ob_end_clean();
        }
    }

/**
 * Getter for Error
 *
 * @return [type]
 */
public function getError()
{
    return $this->error;
}

/**
 * Setter for Error
 * @var [type] error
 *
 * @return self
 */
public function setError($error)
{
    $this->error = $error;
    return $this;
}


/**
 * Getter for BagData
 *
 * @return [type]
 */
public function getBagData()
{
    return $this->bagData;
}

/**
 * Setter for BagData
 * @var [type] bagData
 *
 * @return self
 */
public function setBagData($bagData)
{
    $this->bagData = $bagData;
    return $this;
}


    /**
     * Getter for Content
     *
     * @return [type]
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Setter for Content
     * @var [type] content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

}