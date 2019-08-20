<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {



public function validate($username, $password,$hash)
{
        if((sha1($username._SALT) == sha1("admin"._SALT)) && (sha1($password._SALT) == sha1("admin"._SALT)) ){
              return true;  
        }
        return false;
}

}