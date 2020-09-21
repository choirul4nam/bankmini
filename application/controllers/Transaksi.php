<?php

date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url', 'h_rand_string'));
        $this->load->library('session');
        $this->load->model('M_Setting');        
        $this->load->model('M_Transaksi');
        cek_login_user();
    }

	public function index()
	{
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['transaksi'] = $this->M_Transaksi->getTransaksi();
		// $id = $this->session->userdata('tipeuser');
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_transaksi/v_transaksi', $data);
		$this->load->view('template/footer');
	}

	public function transaksi_add(){
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_transaksi/v_transaksi-add', $data);
		$this->load->view('template/footer');
	}

	public function add_process(){
		$string = $this->input->post('nominal');
		$result = preg_replace("/[^0-9]/", "", $string);
		$debet = $this->input->post('debet', true);
		$kredit = $this->input->post('kredit', true);
		$kategori = $this->input->post('kategori', true);
		$deskripsi = $this->input->post('deskripsi', true);		
		$kode = 'TR'.date("Ymd").''.getRandomString(5);
		if($this->M_Transaksi->cekKodeTransaksi($kode)){
			$data = array(
				'id_mastertransaksi' => '',
				'kodetransaksi' => $kode,
				'debet ' => $debet,
				'kredit' => $kredit,
				'kategori' => $kategori,
				'deskripsi' => $deskripsi,
				'nominal' => $result,					
				'id_user' => $this->session->userdata('id_user'),
				'status' => 'aktif',
				'tgl_update' => date("Y-m-d h:i:sa"),
			);
			$this->M_Transaksi->addTransaksi($data);
			$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
	                                            		<strong>Sukses!</strong> Transaksi Berhasil.
	                                        		</div>');
			redirect(base_url('transaksi/'));
		}else{
			$kodeBaru = 'TR'.date("Ymd").''.getRandomString(5);
			if($kodeBaru !== $kode){
				$data = array(
					'id_mastertransaksi' => '',
					'kodetransaksi' => $kodeBaru,
					'debet ' => $debet,
					'kredit' => $kredit,
					'kategori' => $kategori,
					'deskripsi' => $deskripsi,
					'nominal' => $result,					
					'id_user' => 1,
					'status' => 'aktif',
					'tgl_update' => date("Y-m-d h:i:sa"),
				);
				$this->M_Transaksi->addTransaksi($data);
				$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
		                                            		<strong>Sukses!</strong> Transaksi Berhasil.
		                                        		</div>');
				redirect(base_url('transaksi/'));
			}
		}
	}

	public function transaksi_delete($id){
		$this->M_Transaksi->deleteTransaksi($id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
	                                            		<strong>Sukses!</strong> Berhasil Di hapus.
	                                        		</div>');
		redirect(base_url('transaksi/'));
	}

	public function transaksi_edit($id){
		$data['menu'] = $this->M_Setting->getmenu1();
		$data['transaksi'] = $this->M_Transaksi->detailTransaksi($id);
		// $id = $this->session->userdata('tipeuser');
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_transaksi/v_transaksi-edt', $data);
		$this->load->view('template/footer');
	}

	public function edit_process(){
		$string = $this->input->post('nominal');
		$result = preg_replace("/[^0-9]/", "", $string);
		$id = $this->input->post('id_transaksi', true);
		$debet = $this->input->post('debet', true);
		$kredit = $this->input->post('kredit', true);
		$kategori = $this->input->post('kategori', true);
		$deskripsi = $this->input->post('deskripsi', true);
		$data = array(
				'debet ' => $debet,
				'kredit' => $kredit,
				'kategori' => $kategori,
				'deskripsi' => $deskripsi,
				'nominal' => $result,					
				'tgl_update' => date("Y-m-d h:i:sa"),
			);

		$this->M_Transaksi->editTransaksi($data, $id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                            		<strong>Sukses!</strong> Berhasil Ubah Data Transaksi.
                                        		</div>');
		redirect(base_url('transaksi/'));
	}


}
