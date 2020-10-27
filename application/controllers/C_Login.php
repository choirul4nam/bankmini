<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Login extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('M_login');
		$this->load->model('M_Siswa');
		$this->load->library('session');		
		$this->load->model('M_Kelas');		
	}

	function index()
	{
		if ($this->session->userdata('login') === true) {			
			redirect('welcome');
		}else if ($this->session->userdata('login-siswa')) {
			redirect('dashboard');
		}
		$this->load->view('v_login');
		
	}
	
	function siswa()
	{
		// echo 'Login Siswa';
		if ($this->session->userdata('login-siswa') === true) {			
			redirect('dashboard');
		}
		$this->load->view('v_siswa/v_siswa-login.php');		
	}

	// public function siswa_login(){
	// 	// var_dump();
	// 	if(!empty($this->input->post('nis'))){
	// 		$nis = $this->input->post('nis');
	// 		$dataSiswa = $this->M_Siswa->getsiswadetail($nis);
	// 		if(!empty($dataSiswa)){
	// 			$session = array(
	// 				'authenticated' => 	true, // Buat session authenticated dengan value true					
	// 				'nama'			=> 	$dataSiswa['namasiswa'],
	// 				'id_user'		=>	$dataSiswa['nis'],
	// 				'rfid'			=>	$dataSiswa['rfid'],
	// 				'jk'			=>	$dataSiswa['jk'],	
	// 				'alamat'		=>	$dataSiswa['alamat'],
	// 				'status'		=>	$dataSiswa['status'],
	// 				'tipeuser'		=> $dataSiswa['id_tipeuser'],
	// 				'login-siswa' 	=> 	true
	// 			  );
	// 			  $this->session->set_userdata($session); // Buat session sesuai $session
	// 			  $this->M_login->userlog();
	// 			  redirect('dashboard/');
	// 		}else{
	// 			echo "<script>alert('Data yang anda masukkan salah');history.go(-1);</script>";				
	// 		}
	// 	}else if(!empty($this->input->post('rfid'))){
	// 		$rfid = $this->input->post('rfid');
	// 		$dataSiswa = $this->db->get_where('tb_siswa', ['rfid' => $rfid])->row();
	// 		if(!empty($dataSiswa)){
	// 			$session = array(
	// 				'authenticated' => 	true, // Buat session authenticated dengan value true					
	// 				'nama'			=> 	$dataSiswa->namasiswa,
	// 				'id_user'		=>	$dataSiswa->nis, // Buat session authenticated
	// 				'rfid'			=>	$dataSiswa->rfid,
	// 				'jk'			=>	$dataSiswa->jk,					
	// 				'alamat'		=>	$dataSiswa->alamat,
	// 				'status'		=>	$dataSiswa->status,
	// 				'tipeuser'		=> $dataSiswa->id_tipeuser,
	// 				'login-siswa' 	=> 	true
	// 			  );
	// 			  $this->session->set_userdata($session); // Buat session sesuai $session
	// 			  $this->M_login->userlog();
	// 			  echo 'berhasil';
	// 		}else{
	// 			echo "<script>alert('Kartu pelajar anda tidak terdaftar di database');history.go(-1);</script>";				
	// 		}
	// 	}
	// }

	function cek_login(){

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->M_login->get($username);

		if(empty($user)){
			echo "<script>alert('Data yang anda masukkan salah');history.go(-1);</script>";			
		} else {
		    if($password == $user->password){ // Jika password yang diinput sama dengan password yang didatabase
        		$session = array(
		          'authenticated'=>true, // Buat session authenticated dengan value true
		          'nopegawai'=> $username,  // Buat session nip
		          'nama'=> $user->nama,
		          'id_user'=>$user->id_staf, // Buat session authenticated
		          'tipeuser'=>$user->id_tipeuser,
		          'login' => true
		        );
		        $this->session->set_userdata($session); // Buat session sesuai $session
		        $this->M_login->userlog();
		        redirect('Welcome'); // Redirect ke halaman welcome
		    }else{
		        // $this->session->set_flashdata('message', 'Password salah'); // Buat session flashdata
		        echo "<script>
					alert('Password salah');history.go(-1);
				</script>";
		        // redirect('C_Login'); 
		        // Redirect ke halaman login
		    }
   		}
   	}

	public function logout(){
		$this->M_login->logout();
	    $this->session->sess_destroy(); // Hapus semua session
	    redirect('login'); // Redirect ke halaman login
	}
}
