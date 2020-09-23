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
        $this->db->where(['id_kelas' => $idKelas]);
        $this->db->order_by('namasiswa', 'asc');
        $query = $this->db->get('v_siswa')->result_array(); 
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

    public function cekKelas($kelas){
        // $this->db->where('kelas', $kelas);
        $cek = $this->db->get_where('tb_kelas', ['kelas' => $kelas])->row();
        if(empty($cek)){
            return true;
        }else{
            return false;
        }
    }
}