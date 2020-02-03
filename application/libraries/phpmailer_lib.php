<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Loader Class
 *
 * Loads framework components.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Loader
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/loader.html
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class phpmailer_lib{

    function __construct()
    {
        
    }

    function load(){
        require APPPATH."third_party/PHPMailer/Exception.php";
        require APPPATH."third_party/PHPMailer/PHPMailer.php";
        require APPPATH."third_party/PHPMailer/SMTP.php";
        return new PHPMailer;
    }
}