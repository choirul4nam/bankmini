<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Kecamatan extends CI_Model {
    public function getkecadetail($idkota){
    	$this->db->where('id_kota', $idkota);
	    $query = $this->db->get('tb_kecamatan'); 
        return $query->result_array();
    }    
}