<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Kota extends CI_Model {
    public function getkotadetail($idprov){
    	$this->db->where('id_provinsi', $idprov);
	    $query = $this->db->get('tb_kota'); 
        return $query->result_array();
    }        
}