<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_demo extends CI_Model {

        private $table =  "tbl_demo";


        public function save_entry($data , $id)
        {
                unset($data['hash_id']);
                if($id){
                      return  $this->db->update($this->table, $data, array('hash_id' => $id));
                }else{
                        $this->db->insert($this->table, $data);    
                       $iId = $this->db->insert_id();
                        $this->db->update($this->table, ['hash_id'=>sha1($iId._SALT)], array('id' => $iId));
                   return ($iId > 0);
                }
                
        }

        public function delete_entry($id)
        {
                if($id){
                      return  $this->db->delete($this->table, array('hash_id' => $id));
                }
                return false;
        }

        public function get_demo($id)
        {
                if($id)
                {
                        $results = $this->db->select("*")->from($this->table)->where("hash_id" ,$id )->get();
                        return $results->row_array();
                }else{
                        $results = $this->db->select("*")->from($this->table)->order_by("order_no","ASC")->get();
                }
                
                if ( $results->num_rows() > 0 )
                {
                  return $results->result_array();
                }
                return [];
        }

}