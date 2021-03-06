<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
class CI_Smarty extends Smarty {
    var $debug = false;

    function __construct()
    {
        parent::__construct();

        $this->template_dir = APPPATH . "views/templates";
        $this->compile_dir = APPPATH . "cache/smarty/templates_c";
        if ( ! is_writable( $this->compile_dir ) )
        {
            // make sure the compile directory can be written to
            @chmod( $this->compile_dir, 0777 );
        } 
        $this->left_delimiter = '{{';
        $this->right_delimiter = '}}';
        $this->assign( 'FCPATH', FCPATH );     // path to website
        $this->assign( 'APPPATH', APPPATH );   // path to application directory
        $this->assign( 'BASEPATH', BASEPATH ); // path to system directory

        log_message('debug', "Smarty Class Initialized");
    }
    function setTemplate_dir($path){
        $this->template_dir = APPPATH . $path;
    }
    function setDebug( $debug=true )
    {
        $this->debug = $debug;
    }
 /**
     *  Parse a template using the Smarty engine
     *
     * This is a convenience method that combines assign() and
     * display() into one step. 
     *
     * Values to assign are passed in an associative array of
     * name => value pairs.
     *
     * If the output is to be returned as a string to the caller
     * instead of being output, pass true as the third parameter.
     *
     * @access    public
     * @param    string
     * @param    array
     * @param    bool
     * @return    string
     */
    function publish_to_tpl($arr){
        foreach ($arr as $key => $val)
        {
            $this->assign($key, $val);
        }
    }
    function view($template, $data = array(), $return = FALSE)
    {
        $this->assign("base_url", HTTP_HOST . DIRECTORY_SEPARATOR);
        if ( ! $this->debug )
        {
            $this->error_reporting = false;
        }
        $this->error_unassigned = false;

        foreach ($data as $key => $val)
        {
            $this->assign($key, $val);
        }
        
        if ($return == FALSE)
        {
            $CI =& get_instance();
            if (method_exists( $CI->output, 'set_output' ))
            {
                $CI->output->set_output( $this->display($template) );
            }
            else
            {
                $CI->output->final_output = $this->display($template);
            }
            return;
        }
        else
        {
            return $this->display($template);
        }
    }
}