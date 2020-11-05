<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('M_Setting');
        $this->load->model('M_TahunAkademik');
        $this->load->model('M_TipeUser');
        $this->load->model('M_Akses');
        cek_login_user();
    }

    public function index()
    {
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);        
        $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
        $data['user'] = $this->db->query("SELECT tb_users.*, tb_userlevel.userlevel FROM tb_users JOIN tb_userlevel ON tb_users.user_level = tb_userlevel.id")->result();
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'pengguna'])->row()->id_menus;
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_user/v_user.php', $data);
        $this->load->view('template/footer');
    }

    public function users_add(){
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);        
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'pengguna'])->row()->id_menus;
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_user/v_user-add.php', $data);
        $this->load->view('template/footer');
    }

    public function add_process(){
        // var_dump($this->input->post());
        if($this->input->post('password') === $this->input->post('repassword')){
            $userlevel = $this->input->post('usrlevel', true);
            $data = [
                'nama' => $this->input->post('nama', true),
                'username' => $this->input->post('username', true),
                'password' => md5($this->input->post('password', true)),
                'user_level' => $userlevel,
            ];
            $this->db->insert('tb_users',$data);         
            $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Berhasil!</strong> Berhasil Menambah Kan Pengguna</div>');
            redirect('users');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"> <strong>Perhatian!</strong> Password Tidak sama</div>');
            redirect('users-add');
        }
    }

    public function users_edit($is){
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);        
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'pengguna'])->row()->id_menus;
        $data['users'] = $this->db->get_where('tb_users', ['id' => $is])->row();

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_user/v_user-edit.php', $data);
        $this->load->view('template/footer');
    }

    public function adt_process($id){    
        $data = [
            'nama' => $this->input->post('nama', true),
            'username' => $this->input->post('username', true),
        ];

        if( !empty($this->input->post('password', true)) && !empty($this->input->post('repassword', true))){
            if($this->input->post('password', true) === $this->input->post('repassword', true)){
                $data['password'] = md5($this->input->post('password', true));
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"> <strong>Perhatian!</strong> Password Tidak sama</div>');
                redirect('users-edit/'.$id); 
            }
        }

        $this->db->where('id', $id);
        $this->db->update('tb_users', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Berhasil!</strong> Berhasil Menambah Kan Pengguna</div>');
        redirect('users');
    }

    public function users_delete($id){
        $this->db->where("id", $id);
        $this->db->delete("tb_users");
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Berhasil!</strong> Berhasil Menghapus Pengguna</div>');
        redirect('users');
    }

    public function profile()
    {
        $id = $this->session->userdata('tipeuser');
        $idusers = $this->session->userdata('id_user');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['users'] = $this->db->get_where('tb_users', ['id' => $idusers])->row();
        $data['activeMenu'] = ' ';

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_user/v_user_profile.php', $data);
        $this->load->view('template/footer');
    }

    public function profile_ubah()
    {
        $id = $this->session->userdata('tipeuser');
        $idusers = $this->session->userdata('id_user');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['users'] = $this->db->get_where('tb_users', ['id' => $idusers])->row();
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kelas'])->row()->id_menus;

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_user/v_user_edit.php', $data);
        $this->load->view('template/footer');
    }

    public function ubah_profile_process($id){
        // var_dump($this->input->post());
        $idusers = $this->session->userdata('id_user');
        $data = [
            'username' => $this->input->post('username', true),
            'nama' =>  $this->input->post('nama', true),         
        ];
        if(!empty($this->input->post('passwordlama', true))){
            $pl = $this->db->get_where("tb_users", ['id' => $idusers,'password' => md5($this->input->post('passwordlama', true))])->result();
            if(count($pl) > 0){
                if($this->input->post('passwordbaru', true) === $this->input->post('repassword', true)){
                    $data['password'] = md5($this->input->post('passwordbaru', true));                    
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"> <strong>Perhatian!</strong> Password Baru tidak sama</div>');
                    redirect('ubah-profile');
                }
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-warning left-icon-alert" role="alert"> <strong>Perhatian!</strong> Password Lama salah</div>');
                redirect('ubah-profile');
            }            
        }
        $session = array(
            'authenticated' => true, // Buat session authenticated dengan value true
            'username' => $data['username'],  // Buat session nip
            'nama' => $data['nama'],
            'id_user' => $id, // Buat session authenticated
            'login' => true
        );
        
        $this->session->set_userdata($session);
        $this->db->where('id', $id);
        $this->db->update('tb_users', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success left-icon-alert" role="alert"> <strong>Berhasil!</strong> Ubah Profile</div>');
        redirect('profile');       
    }
    public function akses($userlevel)
    {
        // $datasubmenu = $this->db->query("SELECT * FROM tb_submenu WHERE submenu != 'Tipe User'")->result_array();
        // $dataakses = $this->db->query("SELECT * FROM tb_akses WHERE id_tipeuser = $userlevel")->num_rows();
        // if ($dataakses == 0) {
        //     foreach ($datasubmenu as $daa) {
        //         $this->db->insert('tb_akses', ['id_submenu' => $daa['id_submenu'], 'id_tipeuser' => $userlevel]);
        //     }
        // }
        // die;
        $this->load->view('template/header');
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['tipeuser'] = $this->db->get_where('tb_users', ['user_level' => $userlevel])->row_array();
        $data['akses'] = $this->db->query("SELECT * FROM tb_submenu a
                                        JOIN tb_akses b ON a.id_submenu = b.id_submenu 
                                        WHERE b.id_tipeuser = $userlevel")->result_array();
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'transaksi'])->row()->id_menus;
        


        $this->load->view('template/sidebar', $data);
        $this->load->view('v_user/v_akses.php', $data);
        $this->load->view('template/footer');
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
            redirect('users');
        }
    }
}
