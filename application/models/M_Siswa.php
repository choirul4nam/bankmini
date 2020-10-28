<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Siswa extends CI_Model {

    function getsiswa(){
        $this->db->select('*');
	    $this->db->from('tb_siswa'); 
	    // $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas');	    
	    // $this->db->where('tb_siswa.status', 'aktif')->or_where('tb_siswa.status', 'alumni');
        $this->db->where('tb_siswa.status', 'aktif');
	    $this->db->order_by('namasiswa', 'asc');
	    $query = $this->db->get(); 
        return $query->result();
    }

    function getLulus(){
        $this->db->select('*');
        $this->db->from('tb_siswa'); 
        // $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas');       
        // $this->db->where('tb_siswa.status', 'aktif')->or_where('tb_siswa.status', 'alumni');
        $this->db->where('tb_siswa.status', 'alumni');
        $this->db->order_by('tgl_update', 'desc');
        $query = $this->db->get(); 
        return $query->result();
    }

    function getsiswadetail($nis){        
	    // $this->db->where('nis', $nis)
	    $query = $this->db->get_where('tb_siswa',['nis' => $nis])->row_array(); 
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
        $this->db->where('nis', $id);
        if($this->db->update('tb_siswa', $data)){
            return true;
        }else{
            return false;
        } 
    }

    function cekNis($nis){
        $query = $this->db->get_where('tb_siswa',['nis' => $nis])->row(); 
        if(empty($query)){
            return 'kosong';
        }else{
            if($query->status == "aktif"){
                return 'ada';
            }else if($query->status == 'tidak aktif'){
                return 'update';
            }else if($query->status == 'alumni'){
                return 'lulus';
            }
        }
    }

    function cekRfid($rfid){
        $query = $this->db->get_where('tb_siswa',['rfid' => $rfid])->row(); 
        if(empty($query)){
            return true;
        }else{
            return false;
        }
    }
    
    function getJK($jk){
        if($jk === 'L' || $jk === 'l'){
            return 'Laki-laki';
        }else if($jk === 'P' || $jk === 'p'){
            return 'Perempuan';
        }else if($jk == 'Laki-laki'){
            return 'Laki-laki';
        }else if($jk == 'Perempuan'){
            return 'Perempuan';
        }
    }
}