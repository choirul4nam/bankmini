<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurnal extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('M_Setting');
		$this->load->model('M_Jurnal');
		$this->load->model('M_MasterCOA');
		$this->load->model('M_Akses');
		cek_login_user();
    }

    public function index(){
        $id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'jurnal'])->row()->id_menus;
		$data['jurnal'] = $this->M_Jurnal->getJurnal();
		$data['transaksi'] = $this->M_Jurnal->getTransaksi();


		// $id = $this->session->userdata('tipeuser');
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_jurnal/v_jurnal', $data);
		$this->load->view('template/footer');
	}
	
	public function jurnal_add(){
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		// $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'jurnal'])->row()->id_menus;
		$data['jurnal'] = $this->M_Jurnal->getJurnal();
		$data['coa'] = $this->M_MasterCOA->getAll();
		$data['transaksi'] = $this->M_Jurnal->getTransaksi();

		// $id = $this->session->userdata('tipeuser');
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_jurnal/v_jurnal-add', $data);
		$this->load->view('template/footer');
	}

	public function add_process(){
			print_r($this->input->post());
		$data = [
			'id_jurnal' => '',
			'tipe_transaksi' => $this->input->post('jurnal_tipe_transaksi'),
			'kode_coa_debet' => $this->input->post('kode_coa_debet'),
			'kode_coa_kredit' => $this->input->post('kode_coa_kredit'),
			'nominal_debet' => $this->input->post('nominal_debet'),
			'nominal_kredit' => $this->input->post('nominal_kredit'),
			'transaksi_debet' => $this->input->post('transaksi_debet'),
			'transaksi_kredit' => $this->input->post('transaksi_kredit'),
			'id_user' => $this->session->userdata('id_user'),
			'tgl_update' => date("Y-m-d h:i:sa")
		];
		$this->M_Jurnal->updateTransaksi($this->input->post('jurnal_id_transaksi'), $this->input->post('jurnal_tipe_transaksi'));
		$this->M_Jurnal->insertJurnal($data);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
													<strong>Sukses!</strong> Berhasil Menambah Jurnal
												</div>');
        redirect('jurnal/');
	}
}