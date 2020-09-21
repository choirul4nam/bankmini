<?php
defined('BASEPATH') or exit('No direct script access allowed');


class TipeUser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('M_Setting');
        $this->load->model('M_TipeUser');
        cek_login_user();
    }
    public function index()
    {
        $this->load->view('template/header');
        // $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1();
        $data['tipeuser'] = $this->M_TipeUser->getAll();
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_tipeuser/v_tipeuser.php', $data);
        $this->load->view('template/footer');
    }

    public function hapus($id_tipeuser)
    {
        $this->M_TipeUser->hapus($id_tipeuser);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"><strong>Sukses!</strong> Data Berhasil Dihapus</div>');
        redirect('TipeUser');
    }

    public function detail($id_tipeuser)
    {
        $this->load->view('template/header');
        // $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1();
        $data['tipeuser'] = $this->M_TipeUser->getById($id_tipeuser);
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_tipeuser/v_tipeuser_detail.php', $data);
        $this->load->view('template/footer');
    }

    public function tambahData()
    {
        $this->load->view('template/header');
        // $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1();

        $this->load->view('template/sidebar', $data);
        $this->load->view('v_tipeuser/v_tipeuser_add.php', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        $tipeuser = $this->input->post('tipeuser');
        $data = [
            'tipeuser' => $tipeuser
        ];
        if ($this->M_TipeUser->cekData($tipeuser) >= 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger left-icon-alert" role="alert"><strong>Gagal!</strong> Data Sudah Ada</div>');
            redirect('TipeUser/tambahdata');
        } else {
            $this->M_TipeUser->tambah($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"><strong>Sukses!</strong> Data Berhasil Ditambahkan</div>');
            redirect('TipeUser');
        }
    }

    public function ubahData($id_tipeuser)
    {
        $this->load->view('template/header');
        // $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1();
        $data['tipeuser'] = $this->M_TipeUser->getById($id_tipeuser);
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_tipeuser/v_tipeuser_ubah.php', $data);
        $this->load->view('template/footer');
    }

    public function ubah()
    {
        $data = [
            'id_tipeuser' => $this->input->post('id_tipeuser'),
            'tipeuser' => $this->input->post('tipeuser')
        ];
        $this->M_TipeUser->ubah($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiUbah</div>');
        redirect('Tipeuser');
    }
}
