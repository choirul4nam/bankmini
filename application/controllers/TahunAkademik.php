<?php
defined('BASEPATH') or exit('No direct script access allowed');


class TahunAkademik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('M_Setting');
        $this->load->model('M_TahunAkademik');
        $this->load->model('M_Akses');
        cek_login_user();
    }

    public function index()
    {
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['tahunakademik'] = $this->M_TahunAkademik->getAll();
        $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'tahun akademik'])->row()->id_menus;

        $this->load->view('template/sidebar', $data);
        $this->load->view('v_tahunakademik/v_tahunakademik.php', $data);
        $this->load->view('template/footer');
    }

    public function detail($id_tahunakademik)
    {
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['tahunakademik'] = $this->M_TahunAkademik->getBYId($id_tahunakademik);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'tahun akademik'])->row()->id_menus;
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_tahunakademik/v_tahunakademik_detail.php', $data);
        $this->load->view('template/footer');
    }
    public function hapus($id_tahunakademik)
    {
        $this->M_TahunAkademik->hapus($id_tahunakademik);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil Dihapus</div>');
        redirect('tahunakademik');
    }

    public function tambahData()
    {
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'tahun akademik'])->row()->id_menus;
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_tahunakademik/v_tahunakademik_add.php', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        // $id_user = $this->session-
        $data = [
            'tglawal' => $this->input->post('tglawal'),
            'tglakhir' => $this->input->post('tglakhir'),
            'id_user' => $this->session->userdata('id_user'),
            'tglupdate' =>  date('Y-m-d  h:i:s')
        ];
        $cekData = $this->db->get_where('tb_tahunakademik', ['tglawal' =>  $data['tglawal'], 'tglakhir' => $data['tglakhir']])->result();
        if(count($cekData) > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"> <strong>Perhatian!</strong> Data Sudah ada</div>');
            redirect('tahunakademik-add');
        }else{
            $this->M_TahunAkademik->tambah($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Sukses!</strong> Data Berhasil Ditambahkan</div>');
            redirect('tahunakademik');
        }        
    }

    public function ubahdata($id_tahunakademik)
    {
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['tahunakademik'] = $this->M_TahunAkademik->getBYId($id_tahunakademik);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'tahun akademik'])->row()->id_menus;
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_tahunakademik/v_tahunakademik_ubah.php', $data);
        $this->load->view('template/footer');
    }

    public function ubah()
    {
        $id = $this->input->post('id_tahunakademik');
        $data = [
            'tglawal' => $this->input->post('tglawal'),
            'tglakhir' => $this->input->post('tglakhir'),
            'id_user' => '01',
            'tglupdate' =>  date('Y-m-d  h:i:s')
        ];
        $cekData = $this->db->get_where('tb_tahunakademik', ['id_tahunakademik !=' => $id ,'tglawal' =>  $data['tglawal'], 'tglakhir' => $data['tglakhir']])->result();
        if(count($cekData) > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"> <strong>Perhatian!</strong> Data Sudah ada</div>');
            redirect('tahunakademik-ubah/'.$id);
        }else{
            $this->M_TahunAkademik->ubah($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"><strong>Sukses!</strong> Data Berhasil Diubah</div>');
            redirect('tahunakademik');
        } 
    }

    public function getTAList($id){
        $ta = $this->db->get_where("tb_tahunakademik", ['id_tahunakademik' => $id])->row();        
        $tawal = $ta->tglawal;
        // date_create($row['tglakhir']); echo date_format($tglakhir,"Y");
        $query = $this->db->query("SELECT * FROM tb_tahunakademik WHERE tglawal >= '$tawal' AND id_tahunakademik != $id")->result();
        echo json_encode($query);
    }
}
