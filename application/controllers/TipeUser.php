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
        $this->load->model('M_Akses');

        cek_login_user();
    }
    public function index()
    {
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        // echo $id;
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['tipeuser'] = $this->M_TipeUser->getAll();
        $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath());

        $this->load->view('template/sidebar', $data);
        $this->load->view('v_tipeuser/v_tipeuser.php', $data);
        $this->load->view('template/footer');
    }

    public function hapus($id_tipeuser)
    {
        $this->M_TipeUser->hapus($id_tipeuser);
        $this->M_TipeUser->hapusakses($id_tipeuser);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"><strong>Sukses!</strong> Data Berhasil Dihapus</div>');
        redirect('TipeUser');
    }

    public function detail($id_tipeuser)
    {
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['tipeuser'] = $this->M_TipeUser->getById($id_tipeuser);
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_tipeuser/v_tipeuser_detail.php', $data);
        $this->load->view('template/footer');
    }

    public function akses($id_tipeuser)
    {
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['tipeuser'] = $this->M_TipeUser->getById($id_tipeuser);
        $data['akses'] = $this->M_TipeUser->getakses($id_tipeuser);
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_tipeuser/v_akses.php', $data);
        $this->load->view('template/footer');
    }

    public function tambahData()
    {
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);

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
            $data = $this->M_TipeUser->cekkodetipeuser();
            foreach ($data as $id) {
                $id = $id;
                $this->M_TipeUser->tambahakses($id);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"><strong>Sukses!</strong> Data Berhasil Ditambahkan</div>');
            redirect('TipeUser');
        }
    }

    public function ubahData($id_tipeuser)
    {
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
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

    public function editakses()
    {
        if (isset($_POST['save'])) {

            $iduser = $this->input->post('id');
            $this->M_TipeUser->refresh($iduser); //Call the modal

            $submenu = $this->input->post('submenu'); //Pass the userid here
            $checkbox = $this->input->post('view');
            for ($i = 0; $i < count($checkbox); $i++) {
                $sub = $submenu[$i];
                $view = $checkbox[$i];
                $this->M_TipeUser->editv($iduser, $sub, $view); //Call the modal

            }

            $addbox = $this->input->post('add');
            for ($i = 0; $i < count($addbox); $i++) {
                $sub = $submenu[$i];
                $add = $addbox[$i];
                $this->M_TipeUser->edita($iduser, $sub, $add); //Call the modal

            }

            $editbox = $this->input->post('edit');
            for ($i = 0; $i < count($editbox); $i++) {
                $sub = $submenu[$i];
                $edit = $editbox[$i];
                $this->M_TipeUser->edite($iduser, $sub, $edit); //Call the modal

            }

            $deletebox = $this->input->post('delete');
            for ($i = 0; $i < count($deletebox); $i++) {
                $sub = $submenu[$i];
                $delete = $deletebox[$i];
                $this->M_TipeUser->editd($iduser, $sub, $delete); //Call the modal

            }
            $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil DiUbah</div>');
            redirect('Tipeuser');
        }
    }
}
