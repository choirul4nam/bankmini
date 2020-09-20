<?php

date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('session');
        $this->load->model('M_Setting');
        $this->load->model('M_Siswa');
        $this->load->model('M_Provinsi');
        $this->load->model('M_Kota');
        $this->load->model('M_Kecamatan');
        $this->load->model('M_Kelas');
        cek_login_user();
    }

	public function index()
	{
		$this->load->view('template/header');
        $data['menu'] = $this->M_Setting->getmenu1();
		$this->load->view('template/sidebar', $data);
        $data['datasiswa'] = $this->M_Siswa->getsiswa();
		$this->load->view('v_siswa/v_siswa', $data);
		$this->load->view('template/footer');
	}

	public function siswa_detail($nis){
		$this->load->view('template/header');
        $data['menu'] = $this->M_Setting->getmenu1();
		$this->load->view('template/sidebar', $data);
        $data['datasiswa'] = $this->M_Siswa->getsiswadetail($nis);
		$this->load->view('v_siswa/v_siswa-detail', $data);
		$this->load->view('template/footer');
		// print_r($this->M_Siswa->getsiswadetail($nis));
	}

	public function siswa_add(){
        // $data['datasiswa'] = $this->M_Siswa->getsiswadetail($nis);
        $data['menu'] = $this->M_Setting->getmenu1();
        $data['prov'] = $this->M_Provinsi->getprovinsi();
        $data['kelas'] = $this->M_Kelas->getkelas();
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-add', $data);
		$this->load->view('template/footer');
	}

	public function getKota($idProv){
		$data = $this->M_Kota->getkotadetail($idProv);

		echo json_encode($data);
	}

	public function getSiswaByKelas($idKelas){
		$data = $this->M_Kelas->getSiswaByKelas($idKelas);

		echo json_encode($data);
	}

	public function getKecamatan($idkota){
		$data = $this->M_Kecamatan->getkecadetail($idkota);

		echo json_encode($data);
	}

	public function add_process(){
		$nis = $this->input->post('nis', true);
		$nama = $this->input->post('nama', true);
		$alamat = $this->input->post('alamat', true);
		$jk = $this->input->post('jk', true);
		$kelas = $this->input->post('kelas', true);
		$prov = $this->input->post('prov', true);
		$kota = $this->input->post('kota', true);
		$kecamatan = $this->input->post('kecamatan', true);
		$rfid = $this->input->post('rfid', true);	

		$id_tipeuser = $this->db->get_where('tb_tipeuser', ['tipeuser' => 'siswa'])->row_array();

		$data = array(
				'nis' => $nis,
				'namasiswa' => $nama,
				'alamat' => $alamat,
				'provinsi' => $prov,
				'kota' => $kota,
				'kecamatan' => $kecamatan,
				'jk' => $jk,
				'id_kelas' => $kelas,
				'tgl_update' => date("Y-m-d h:i:sa"),				
				'id_user' => $this->session->userdata('id_user'),
				'status' => 'aktif',
				'id_tipeuser' => $id_tipeuser['id_tipeuser'],
				'password' => 'siswa123',
				'rfid' => $rfid
			);

		$this->M_Siswa->addSiswa($data);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                            		<strong>Sukses!</strong> Berhasil Menambahkan Data Siswa.
                                        		</div>');
		redirect(base_url('siswa/'));
	}

	public function siswa_delete($nis){
		$this->M_Siswa->delSiswa($nis);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                            		<strong>Sukses!</strong> Berhasil Menghapus Data Siswa.
                                        		</div>');
		redirect(base_url('siswa/'));
	}

	public function siswa_edit($nis){
        $data['datasiswa'] = $this->M_Siswa->getsiswadetail($nis);
        $data['menu'] = $this->M_Setting->getmenu1();
		$data['prov'] = $this->M_Provinsi->getprovinsi();
        $data['kelas'] = $this->M_Kelas->getkelas();
        $data['kota'] = $this->M_Kota->getkotadetail($this->M_Siswa->getsiswadetail($nis)['id_provinsi']);
        $data['keca'] = $this->M_Kecamatan->getkecadetail($this->M_Siswa->getsiswadetail($nis)['id_kota']);
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-edit', $data);
		$this->load->view('template/footer');

	}

	public function edt_process(){
		echo $this->input->post('alumni');
		$nis = $this->input->post('nis', true);
		$nama = $this->input->post('nama', true);
		$alamat = $this->input->post('alamat', true);
		$jk = $this->input->post('jk', true);
		$kelas = $this->input->post('kelas', true);
		$prov = $this->input->post('prov', true);
		$kota = $this->input->post('kota', true);
		$kecamatan = $this->input->post('kecamatan', true);
		$rfid = $this->input->post('rfid', true);	

		$status = '';

		if($this->input->post('alumni') == 1){
			$status = 'alumni';
		}else{
			if($this->input->post('status') === 'alumni'){
				$status = 'aktif';
			}else{
				$status = 'aktif';
			}
		}			

		$data = array(
				'nis' => $nis,
				'namasiswa' => $nama,
				'alamat' => $alamat,
				'provinsi' => $prov,
				'kota' => $kota,
				'kecamatan' => $kecamatan,
				'jk' => $jk,
				'id_kelas' => $kelas,
				'tgl_update' => date("Y-m-d h:i:sa"),				
				'id_user' => 1,
				'status' => $status,
				'id_tipeuser' => 2,
				'password' => 'siswa123',
				'rfid' => $rfid
			);

		$this->M_Siswa->editSiswa($data, $nis);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                            		<strong>Sukses!</strong> Berhasil Mengubahkan Data Siswa.
                                        		</div>');
		redirect(base_url('siswa/'));
	}

	public function siswa_graduate(){
        $data['datasiswa'] = $this->M_Siswa->getsiswa();
        $data['menu'] = $this->M_Setting->getmenu1();
        $data['kelas'] = $this->M_Kelas->getkelas();

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-graduate', $data);
		$this->load->view('template/footer');
	}

	public function grad_process($id){
		$this->M_Siswa->siswaGraduate($id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                            		<strong>Sukses!</strong> Siswa Berhasil Lulus.
                                        		</div>');
		redirect(base_url('siswa/'));
	}

}
