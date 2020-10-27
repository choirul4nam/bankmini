<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BukuPembantu extends CI_Controller
{      
    public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form', 'url', 'h_rand_string'));
		$this->load->library('session');
		$this->load->model('M_Setting');
		$this->load->model('M_Akses');
		$this->load->model('M_TipeUser');

		cek_login_user();
    }

    public function index(){
        $id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);	
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'Buku Pembantu'])->row()->id_menus;
		$data['tipeuser'] = $this->M_TipeUser->getAll();

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_bukupembantu/index', $data);
		$this->load->view('template/footer');
    }
}