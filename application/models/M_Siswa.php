<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Siswa extends CI_Model {

    function getsiswa(){
        $this->db->select('*');
	    $this->db->from('tb_siswa'); 
	    $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas');	    
	    // $this->db->where('tb_siswa.status', 'aktif')->or_where('tb_siswa.status', 'alumni');
        $this->db->where('tb_siswa.status', 'aktif');
	    $this->db->order_by('namasiswa', 'desc');
	    $query = $this->db->get(); 
        return $query->result();
    }

    function getsiswadetail($nis){        
	    // $this->db->where('nis', $nis)
	    $query = $this->db->get_where('v_siswa',['nis' => $nis])->row_array(); 
        return $query;
    }

    function addSiswa($data){
    	$this->db->insert('tb_siswa', $data);
    }

    function delSiswa($nis){
    	$data = array('status' => 'tidak aktif');
    	$this->db->where('nis', $nis);
    	$this->db->update('tb_siswa', $data);
    }

    function editSiswa($data, $nis){
    	$this->db->where('nis', $nis);
    	$this->db->update('tb_siswa', $data);
    }

    function siswaGraduate($id){
        $data = ['status' => 'alumni'];
        $this->db->where('id_kelas', $id);
        $this->db->update('tb_siswa', $data);   
    }

}