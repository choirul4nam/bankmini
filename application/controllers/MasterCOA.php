<?php
defined('BASEPATH') or exit('No direct script access allowed');


class MasterCOA extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('M_Setting');
        $this->load->model('M_Akses');
        $this->load->model('M_MasterCOA');

        cek_login_user();
    }
    public function index()
    {

        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'master coa'])->row()->id_menus;
        $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
        $data['coa'] = $this->M_MasterCOA->getAll();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_mastercoa/v_mastercoa', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        $id = $this->session->userdata('tipeuser');
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'master coa'])->row()->id_menus;
        $data['menu'] = $this->M_Setting->getmenu1($id);


        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_mastercoa/v_mastercoa_add', $data);
        $this->load->view('template/footer');
    }

    public function tambahData()
    {
        $kode_coa = $this->input->post('coa');
        $akun = $this->input->post('akun');
        $a = $this->db->query("SELECT * FROM tb_mastercoa WHERE kode_coa = '" . $kode_coa . "'")->num_rows();
        $b = $this->db->query("SELECT * FROM tb_mastercoa WHERE akun ='" . $akun . "'")->num_rows();
        if ($a >= 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"><strong>Warning!</strong> Code Of Accounting Tidak Boleh Sama</div>');
            redirect('mastercoa/tambah');
        } else if ($b >= 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"><strong>Warning!</strong>Akun Tidak Boleh Sama</div>');
            redirect('mastercoa/tambah');
        } else {

            $neraca = "0";
            $pm = "0";
            $lr = "0";
            if ($this->input->post('neraca') == 'on') {
                $neraca = 1;
            }
            if ($this->input->post('pm') == 'on') {
                $pm = 1;
            }
            if ($this->input->post('lr') == 'on') {
                $lr = 1;
            }

            $data = [
                'kode_coa' => $kode_coa,
                'akun' => $akun,
                'keterangan' => $this->input->post('keterangan'),
                'neraca' => $neraca,
                'perubahan_modal' => $pm,
                'laba_rugi' => $lr,
                'id_user' => $this->session->userdata('tipeuser'),
                'tglupdate' => date('Y-m-d h:i:s')
            ];
            $this->M_MasterCOA->tambah($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiTambahkan</div>');
            redirect('mastercoa');
        }
    }

    public function hapus($id)
    {
        $this->M_MasterCOA->hapus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiHapus</div>');
        redirect('mastercoa');
    }

    public function ubah($id_coa)
    {
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'master coa'])->row()->id_menus;
        $data['coa'] = $this->M_MasterCOA->getById($id_coa);

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_mastercoa/v_mastercoa_ubah', $data);
        $this->load->view('template/footer');
    }

    public function ubahdata()
    {
        $id_coa = $this->input->post('id_coa');
        $kode_coa = $this->input->post('coa');
        $akun = $this->input->post('akun');

        $neraca = "0";
        $pm = "0";
        $lr = "0";
        if ($this->input->post('neraca') == 'on') {
            $neraca = 1;
        }
        if ($this->input->post('pm') == 'on') {
            $pm = 1;
        }
        if ($this->input->post('lr') == 'on') {
            $lr = 1;
        }

        $data = [
            'kode_coa' => $kode_coa,
            'akun' => $akun,
            'keterangan' => $this->input->post('keterangan'),
            'neraca' => $neraca,
            'perubahan_modal' => $pm,
            'laba_rugi' => $lr,
            'id_user' => $this->session->userdata('tipeuser'),
            'tglupdate' => date('Y-m-d h:i:s')
        ];


        $a = $this->db->query("SELECT * FROM tb_mastercoa WHERE kode_coa ='" . $kode_coa . "' AND akun ='" . $akun . "'")->num_rows();
        $d = $this->db->query("SELECT * FROM tb_mastercoa WHERE kode_coa ='" . $kode_coa . "' AND akun ='" . $akun . "'")->row_array();
        if ($a == 1) {
            $this->M_MasterCOA->ubah($data, $id_coa);
            $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiUbah</div>');
            redirect('mastercoa');
        } else {
            $q1 = "SELECT * FROM tb_mastercoa WHERE kode_coa = '" . $kode_coa . "' AND id_coa != '" . $id_coa . "'";
            $q2 = "SELECT * FROM tb_mastercoa WHERE akun ='" . $akun . "' AND id_coa != '" . $id_coa . "'";
            $b = $this->db->query($q1)->num_rows();
            $b1 = $this->db->query($q1)->row_array();
            $c = $this->db->query($q2)->num_rows();
            $c1 = $this->db->query($q2)->row_array();

            if ($b >= 1) {
                // echo 'hallo kode';
                $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"><strong>Warning!</strong> Code Of Accounting  Tidak Boleh Sama</div>');
                redirect('mastercoa-edt/' . $id_coa);
            } else if ($c >= 1 && $c1['akun'] != $akun) {
                // echo 'hallo akun';
                $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"><strong>Warning!</strong> Akun Tidak Boleh Sama</div>');
                redirect('mastercoa-edt/' . $id_coa);
            } else {
                // echo 'aman';
                $this->M_MasterCOA->ubah($data, $id_coa);
                $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiUbah</div>');
                redirect('mastercoa');
            }
            // if ($b > 1) {
            //     $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"><strong>Warning!</strong> Code Of Accounting  Tidak Boleh Sama</div>');
            //     redirect('mastercoa-edt/' . $id_coa);
            // } else if ($c > 1) {
            //     $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"><strong>Warning!</strong> Akun Tidak Boleh Sama</div>');
            //     redirect('mastercoa-edt/' . $id_coa);
            // } else {
            //     $this->M_MasterCOA->ubah($data, $id_coa);
            //     $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiUbah</div>');
            //     redirect('mastercoa');
            // }
        }
    }
    public function detail($id_coa)
    {
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'master coa'])->row()->id_menus;
        $data['coa'] = $this->M_MasterCOA->getById($id_coa);

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_mastercoa/v_mastercoa_detail', $data);
        $this->load->view('template/footer');
    }

    public function getKode($id){
        $kode = $this->db->get_where('tb_mastercoa', ['kode_coa !=' => $id])->result();
        echo json_encode($kode);
	}
}
