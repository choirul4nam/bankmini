<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Login extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('M_login');
		$this->load->library('session');		
	}

	function index()
	{
		if ($this->session->userdata('login') === true) {			
			redirect('welcome');
		}
		$this->load->view('v_login');
		
	}

	function cek_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// echo $username.$password;
		$user = $this->M_login->get($username);
		// echo $user;
		if(empty($user)){
			// $siswa = $this->M_login->getsiswa($username);
			// if(empty($siswa)){
			// echo $username;
			echo "<script>alert('Data yang anda masukkan salah');history.go(-1);</script>";
			// }else{
			// 	if($password == $siswa->password){
		 //    		$session = array(
			//           'authenticated'=>true, 
			//           'nis'=> $username, 
			//           'nama'=> $siswa->namasiswa,			          
			//           'id_user'=> $username,
			//           'tipeuser'=>$siswa->id_tipeuser,
			//           'login' => true
			//         );
			//         $this->session->set_userdata($session);
			//         $this->M_login->userlog();
			//         redirect('Welcome'); 
			// 		// echo  'siswa login';
			//     }else{
			//         // $this->session->set_flashdata('message', 'Password salah'); // Buat session flashdata
			//         echo "<script>
			// 			alert('Password salah');history.go(-1);
			// 		</script>";
			//         // redirect('C_Login'); 
			//         // Redirect ke halaman login
			//     }	
			// }	
			
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
