<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');


class KasKeluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('M_Setting');
        $this->load->model('M_Akses');
        $this->load->model('M_KasKeluar');

        cek_login_user();
    }
    public function index()
    {
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas keluar'])->row()->id_menus;
        $data['kk'] = $this->M_KasKeluar->getAll();
        $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kaskeluar/v_kaskeluar', $data);
        $this->load->view('template/footer');
    }
    public function tambah()
    {
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas keluar'])->row()->id_menus;
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kaskeluar/v_kaskeluar_add', $data);
        $this->load->view('template/footer');
    }

    public function tambahdata()
    {
        $kodekaskeluar = $this->M_KasKeluar->kodekaskeluar();
        $id = $this->session->userdata('tipeuser');
        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk'")->row_array();
        $kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar'")->row_array();
        $saldo = $dbet['nominal'] - $kreddi['nominal'];
        $hasil = intval($saldo['saldo']) - intval(preg_replace("/[^0-9]/", "", $this->input->post('nominal')));
        $data = [
            'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'kode_kas_keluar' => $kodekaskeluar,
            'id_user' => $id,
        ];

        $dataHistori = [
            'kode_kas' => $kodekaskeluar,
            'jenis' => 'kas keluar',
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'saldo' => 0,
            'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
        ];

        if (preg_replace("/[^0-9]/", "", $this->input->post('nominal')) > $saldo) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"> <strong>Warning! </strong>Nominal Terlalu Besar Dari Saldo, Saldo tinggal Rp. ' . number_format($saldo) . '</div>');
            redirect('kas-keluar-add');
        } else {
            $this->M_KasKeluar->tambah($data);
            $this->M_KasKeluar->tambahHisto($dataHistori);
            $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiTambahkan</div>');
            redirect('kaskeluar');
        }
    }
    public function hapus($kode)
    {

        $this->db->where('kode_kas', $kode);
        $this->db->delete('tb_historikas');
        $this->M_KasKeluar->hapus($kode);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiHapus</div>');
        redirect('kaskeluar');
    }
    public function ubah($kode)
    {
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas keluar'])->row()->id_menus;
        $data['kk'] = $this->M_KasKeluar->getById($kode);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kaskeluar/v_kaskeluar_ubah', $data);
        $this->load->view('template/footer');
    }
    public function ubahdata()
    {
        $kodekaskeluar = $this->input->post('kode');
        $id = $this->session->userdata('tipeuser');
        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk'")->row_array();
        $kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar'")->row_array();
        $nominalSaya = $this->db->query("SELECT * FROM tb_historikas WHERE kode_kas = '". $kodekaskeluar ."'")->row_array();
        $saldo = $nominalSaya['nominal'] + $dbet['nominal'] - $kreddi['nominal'];
        // var_dump($saldo ,$nominalSaya['nominal'] , $dbet['nominal'] , $kreddi['nominal']);
        // die;
        // $hasil = intval($saldo['saldo']) - intval(preg_replace("/[^0-9]/", "", $this->input->post('nominal')));
        $data = [
            'tgltransaksi' => $this->input->post('tglTransaksi') . date(' h:i:s'),
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
            'kode_kas_keluar' => $kodekaskeluar,
            'id_user' => $id,
        ];
        if (preg_replace("/[^0-9]/", "", $this->input->post('nominal')) > $saldo) {
        
            $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"> <strong>Warning! </strong>Nominal Terlalu Besar Dari Saldo, Saldo tinggal Rp. ' . number_format($saldo) . '</div>');
            redirect('kas-keluar-edt/'.$kodekaskeluar);
        } else {
            $this->M_KasKeluar->ubah($data, $kodekaskeluar);
            $this->db->where('kode_kas', $kodekaskeluar);
            $this->db->delete('tb_historikas');
            $dataHistori = [
                'kode_kas' => $kodekaskeluar,
                'jenis' => 'kas keluar',
                'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
                'saldo' => 0,
                'tgltransaksi' => $this->input->post('tglTransaksi'),
            ];

            $this->M_KasKeluar->tambahHisto($dataHistori);
            $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiUbah</div>');
            redirect('kaskeluar');
        }
    }

    public function getKasKeluar()
    {
        echo json_encode($this->db->get_where('tb_kaskeluar', ['status_jurnal' => '0'])->result());
    }
}
