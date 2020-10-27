<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('M_Setting');

		$this->load->model('M_Siswa');
		$this->load->model('M_Kelas');
		cek_login_user();
	}

	public function index()
	{
		$thisM = date('m');
		$id = $this->session->userdata('tipeuser');
		$nominalKredit = 0;
		$nominalDebet = 0;
		$debet = $this->db->query("SELECT tb_transaksi.nominal FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi WHERE tb_mastertransaksi.debet != ' ' AND MONTH(tb_transaksi.tgl_update) = $thisM")->result(); 
		foreach($debet as $row){
			$nominalDebet = $row->nominal + $nominalDebet;
		}
		$kredit = $this->db->query("SELECT tb_transaksi.nominal FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi WHERE tb_mastertransaksi.kredit != ' ' AND MONTH(tb_transaksi.tgl_update) = $thisM")->result(); 
		foreach($kredit as $row){
			$nominalKredit = $row->nominal + $nominalKredit;
		}

		$siswa = $this->db->get('tb_siswa')->num_rows();
		$staff = $this->db->get('tb_staf')->num_rows();

		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['dataAnggota'] = $siswa + $staff;
		$data['kredit'] = $nominalKredit;
		$data['debet'] = $nominalDebet;
		$data['saldo'] = $nominalKredit - $nominalDebet;
		$data['kelas'] = $this->M_Kelas->getkelas();
		$data['activeMenu'] = '';

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/index', $data);
		$this->load->view('template/footer');
	}
}
