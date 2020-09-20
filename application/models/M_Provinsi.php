<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Provinsi extends CI_Model {
    public function getprovinsi(){
	    $query = $this->db->get('tb_provinsi'); 
        return $query->result_array();
    }    
}