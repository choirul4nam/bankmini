<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Kelas extends CI_Model {
    public function getkelas(){
        $this->db->where('status', 'aktif');        
        $this->db->order_by('kelas', 'ASC');
	    $query = $this->db->get('tb_kelas'); 
        return $query->result_array();
    }

    public function getkelasDetail($id){
    	$this->db->where('id_kelas', $id);
	    $query = $this->db->get('tb_kelas'); 
        return $query->row_array();
    }    

    public function getSiswaByKelas($idKelas){
        $this->db->where(['id_kelas' => $idKelas]);
        $this->db->where(['status' => 'aktif']);
        $this->db->order_by('namasiswa', 'ASC');
        $query = $this->db->get('tb_siswa')->result_array(); 
        return $query;
    }  

    public function addKelas($data){
    	$this->db->insert('tb_kelas', $data);
    }

    public function delKelas($id){
    	$this->db->where('id_kelas', $id);
        $this->db->delete('tb_kelas');
        
        $data = ['id_kelas' => ''];
        $this->db->where('id_kelas', $id);
        $this->db->update('tb_siswa', $data);
    }

    public function deleteSemuaKelas(){
        $this->db->update('tb_kelas', ['status' => 'tidak aktif']);
    }   

    public function editKelas($data, $id){
    	$this->db->where('id_kelas', $id);
    	$this->db->update('tb_kelas', $data);
    }

    public function cekKelas($kelas){
        $this->db->where('kelas', $kelas);
        $this->db->where('status', 'aktif');
        $cek = $this->db->get('tb_kelas')->row();
        if(empty($cek)){
            return true;
        }else{
            return false;
        }
    }   
}