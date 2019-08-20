<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_biography extends CI_Model {

        private $table =  "tbl_bio";


        public function save_entry($data , $id)
        {
                return  $this->db->update($this->table, $data, array('id' =>1));
        }

       
        public function get_bio()
        {
                $results = $this->db->select("*")->from($this->table)->where("id" , 1 )->get();
                return $results->row_array();
        }

}