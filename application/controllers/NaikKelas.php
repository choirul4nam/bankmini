<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NaikKelas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('M_Setting');
		$this->load->model('M_Akses');
		$this->load->model('M_Siswa');
		$this->load->model('M_Kelas');
		cek_login_user();
	}

	public function index()
	{			
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'naik kelas'])->row()->id_menus;
				$this->db->order_by('kelas', "asc");
		$query = $this->db->get('tb_kelas')->result_array();		
		$index = 0;
		foreach($query as $row){
			if(strlen(explode(' ', $row['kelas'])[0]) == 3){
				unset($query[$index]);				
			}
			$index++;
		}
		$data['kelas'] = $query;

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_naikkelas/v_naikkelas', $data);
		$this->load->view('template/footer');
	}
}
