<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardSiswa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('M_Setting');	
	}

	public function getSiswaDetail($nis){
		echo json_encode($this->db->query("SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE tb_siswa.nis = $nis")->row());
	}
	
	public function getSiswaDetailRFID($rfid){
		echo json_encode($this->db->query("SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE tb_siswa.rfid = $rfid")->row());
	}

	public function detailTransaksi(){
		$tipe = $this->input->get('tipe');
		$id = $this->input->get('id');
		$data = [];

        if($tipe == 'siswa'){
            $querySiswa = $this->db->query("SELECT tb_transaksi.*, tb_siswa.nis, tb_siswa.namasiswa, tb_siswa.id_kelas, tb_mastertransaksi.debet, tb_mastertransaksi.kredit, tb_mastertransaksi.deskripsi FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_siswa.nis = $id")->result(); 
            foreach($querySiswa as $row){
                $date = date_create($row->tgl_update);
                $row->tgl_update = date_format($date,"d-m-Y H:i:s");
                array_push($data, $row);
            }
        }		
		echo json_encode($data);
		
	}

	public function getSaldoSiswa($nis){
		$saldo = 0;
		$kredit = $this->db->query("SELECT tb_transaksi.nominal FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_siswa.nis = $nis AND tb_mastertransaksi.kredit = 'siswa'")->result_array(); 
		$debet = $this->db->query("SELECT tb_transaksi.nominal FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_siswa.nis = $nis AND tb_mastertransaksi.debet = 'siswa'")->result_array(); 
		foreach($kredit as $row){
			$saldo += $row['nominal'];
		}
		foreach($debet as $row){
			$saldo -= $row['nominal'];
		}
        echo $saldo;
	}
}
