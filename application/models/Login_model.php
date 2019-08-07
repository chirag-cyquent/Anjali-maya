<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

public function get_last_ten_entries()
{
        $query = $this->db->get('entries', 10);
        return $query->result();
}

public function validate($username, $password,$hash)
{
        if((sha1($username.$hash) == sha1("Maya".$hash)) && (sha1($password.$hash) == sha1("BIRetail@@33".$hash)) ){
              return true;  
        }
        return false;
}

public function update_entry()
{
        $this->title    = $_POST['title'];
        $this->content  = $_POST['content'];
        $this->date     = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
}

}