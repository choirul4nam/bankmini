<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Kelas extends CI_Model {
    public function getkelas(){
        $this->db->where('status', 'aktif');
	    $query = $this->db->get('tb_kelas'); 
        return $query->result_array();
    }

    public function getkelasDetail($id){
    	$this->db->where('id_kelas', $id);
	    $query = $this->db->get('tb_kelas'); 
        return $query->row_array();
    }    

    public function getSiswaByKelas($idKelas){
        $query = $this->db->get_where('v_siswa', ['id_kelas' => $idKelas, 'status' => 'aktif'])->result_array(); 
        return $query;
    } 

    public function addKelas($data){
    	$this->db->insert('tb_kelas', $data);
    }

    public function delKelas($id){
    	$this->db->where('id_kelas', $id);
    	$this->db->update('tb_kelas', ['status' => 'tidak aktif']);
    }

    public function deleteSemuaKelas(){
        $this->db->update('tb_kelas', ['status' => 'tidak aktif']);
    }   

    public function editKelas($data, $id){
    	$this->db->where('id_kelas', $id);
    	$this->db->update('tb_kelas', $data);
    }
}