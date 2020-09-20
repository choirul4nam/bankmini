<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Transaksi extends CI_Model {

    public function getTransaksi(){
        $this->db->where('status', 'aktif');  
        $this->db->order_by("tgl_update", "desc");
	    $query = $this->db->get('tb_mastertransaksi'); 
        return $query->result();
    }

    public function cekKodeTransaksi($kode){
        $this->db->where('kodetransaksi', $kode);   
        $query = $this->db->get('tb_mastertransaksi'); 
        if($query->num_rows() === 1){
            return false;
        }else{
            return true;
        }
    }    

    public function addTransaksi($data){
    	$this->db->insert('tb_mastertransaksi', $data);
    }

    public function deleteTransaksi($id){
        $data = ['status' => 'tidak aktif'];
    	$this->db->where('id_mastertransaksi', $id);
    	$this->db->update('tb_mastertransaksi', $data);
    }

    public function detailTransaksi($id){
        $this->db->where('id_mastertransaksi', $id);   
        return $this->db->get('tb_mastertransaksi')->row(); 
    }   

    public function editTransaksi($data, $id){
    	$this->db->where('id_mastertransaksi', $id);
    	$this->db->update('tb_mastertransaksi', $data);
    }
}