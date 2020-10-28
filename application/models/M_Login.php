<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model{

  public function get($username){
    $where = array('username' => $username);
    $result = $this->db->get_where('tb_users', $where)->row();
    return $result;
}

  // public function get($username){

	 //  // $this->db->join('tb_tipeuser', 'tb_tipeuser.id_tipeuser = tb_staf.id_tipeuser');
  // 	$this->db->where('nopegawai',$username);
  // 	$result = $this->db->get('tb_staf')->row();

  // 	return $result;
  // }

  public function getsiswa($username){

    $this->db->join('tb_tipeuser', 'tb_tipeuser.id_tipeuser = tb_siswa.id_tipeuser');
    $this->db->where('nis',$username);
    $result = $this->db->get('tb_siswa')->row();

    return $result;
  }

  function userlog(){
   		date_default_timezone_set('Asia/jakarta');  
   		$waktu = date('Y-m-d H:i:s');
        $userlog = array(
            'id_user' => $this->session->userdata('id_user'),
            'waktu' => $waktu,
            'ket' => 'Login',
        );

        $this->db->insert('tb_userlog', $userlog);
    }

    function logout(){
   		date_default_timezone_set('Asia/jakarta');  
   		$waktu = date('Y-m-d H:i:s');
        $userlog = array(
            'id_user' => $this->session->userdata('id_user'),
            'waktu' => $waktu,
            'ket' => 'Logout',
        );

        $this->db->insert('tb_userlog', $userlog);
    }
}
?>