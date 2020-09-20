<?php date_default_timezone_set("Asia/Jakarta");  ?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('M_Setting');
        $this->load->model('M_Staff');
        cek_login_user();
    }

    public function index()
    {
        $this->load->view('template/header');
        // $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1();
        $data['staff'] = $this->M_Staff->getAll();
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_staff/v_staff.php', $data);
        $this->load->view('template/footer');
    }
    public function hapus($id_staf)
    {
        $this->M_Staff->hapus($id_staf);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Berhasil Dihapus</div>');
        redirect('Staff');
    }

    public function tambahdata()
    {
        $this->load->view('template/header');
        // $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1();
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_staff/v_staff_add.php', $data);
        $this->load->view('template/footer');
    }

    public function getkota($id_provinsi)
    {
        $query = $this->db->query("SELECT * FROM tb_kota WHERE id_provinsi ='" . $id_provinsi . "'")->result_array();
        echo json_encode($query);
    }
    public function getkecamatan($id_kota)
    {
        $query = $this->db->query("SELECT * FROM tb_kecamatan WHERE id_kota ='" . $id_kota . "'")->result_array();
        echo json_encode($query);
    }

    public function tambah()
    {
        $data = [
            'nopegawai' => $this->input->post('nopegawai'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'provinsi' => $this->input->post('s_provinsi'),
            'kota' => $this->input->post('s_kota'),
            'kecamatan' => $this->input->post('s_kecamatan'),
            'tlp' => $this->input->post('telp'),
            'id_tipeuser' => $this->input->post('tipeuser'),
            'status' => 'aktif',
            'tgl_upddate' => date('Y-m-d h:i:s'),
            'id_user' => $this->session->userdata('id_user'),
            'password' => $this->input->post('pass')
        ];
        $this->M_Staff->tambah($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Ditambah</div>');
        redirect('staff');
    }

    public function detail($id_staf)
    {
        $this->load->view('template/header');
        // $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1();
        $data['staf'] = $this->M_Staff->getById($id_staf);
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_staff/v_staff_detail.php', $data);
        $this->load->view('template/footer');
    }

    public function ubahdata($id_staf)
    {
        $this->load->view('template/header');
        // $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1();
        $data['staf'] = $this->M_Staff->getById($id_staf);
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_staff/v_staff_ubah.php', $data);
        $this->load->view('template/footer');
    }

    public function ubah()
    {
        $id_staf = $this->input->post('id_staf');
        $data = [
            'nopegawai' => $this->input->post('nopegawai'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'provinsi' => $this->input->post('s_provinsi'),
            'kota' => $this->input->post('s_kota'),
            'kecamatan' => $this->input->post('s_kecamatan'),
            'tlp' => $this->input->post('telp'),
            'id_tipeuser' => $this->input->post('tipeuser'),
            'status' => 'aktif',
            'tgl_upddate' => date('Y-m-d h:i:s'),
            'id_user' => '001',
            'password' => $this->input->post('pass')
        ];
        $this->M_Staff->ubah($data, $id_staf);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diubah</div>');
        redirect('staff');
    }
}
