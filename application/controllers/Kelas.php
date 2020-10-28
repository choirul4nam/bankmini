<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('M_Setting');
		$this->load->model('M_Kelas');
		$this->load->model('M_Akses');
		cek_login_user();
	}

	public function index()
	{
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['kelas'] = $this->M_Kelas->getkelas();
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kelas'])->row()->id_menus;


		// $id = $this->session->userdata('tipeuser');
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);

		$this->load->view('v_kelas/v_kelas', $data);
		$this->load->view('template/footer');
	}

	public function kelas_add()
	{
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kelas'])->row()->id_menus;

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_kelas/v_kelas-add');
		$this->load->view('template/footer');
	}

	public function add_process()
	{
		if ($this->M_Kelas->cekKelas($this->input->post('kelas', true))) {
			$dataKelas = $this->input->post('kelas', true);
			$this->db->where("kelas LIKE", "%$dataKelas%");
			$this->db->where("status", "tidak aktif");
			$kelas = $this->db->get('tb_kelas')->result();
			if(count($kelas) <= 0){
				// echo "1";
				$data = array(
					'id_kelas' => '',
					'kelas' => $this->input->post('kelas', true),
					'status' => 'aktif',
					'id_user' => $this->session->userdata('id_user'),
					'tglupdate' => date("Y-m-d h:i:sa")
				);
	
				$this->M_Kelas->addKelas($data);
				$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
															<strong>Sukses!</strong> Berhasil Menambahkan Kelas Baru.
														</div>');
				redirect(base_url('kelas/'));
			}else{
				// echo "2";
				$data = array(
					'status' => 'aktif',
					'id_user' => $this->session->userdata('id_user'),
					'tglupdate' => date("Y-m-d h:i:sa")
				);
				$this->db->where("kelas ",$dataKelas);
				$this->db->update('tb_kelas', $data);
				$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
															<strong>Sukses!</strong> Berhasil Menambahkan Kelas Baru.
														</div>');
				redirect(base_url('kelas/'));
			}			
		} else {
			$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
	                                            		<strong>Perhatian!</strong> Data Sudah Ada.
	                                        		</div>');
			redirect(base_url('kelas-add/'));
		}
	}

	public function kelas_delete($id)
	{
		$this->M_Kelas->delKelas($id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                            		<strong>Sukses!</strong> Berhasil Menghapus Kelas.
                                        		</div>');
		redirect(base_url('kelas/'));
	}

	public function kelas_edit($id)
	{
		$ida = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($ida);
		$data['kelas'] = $this->M_Kelas->getkelasDetail($id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kelas'])->row()->id_menus;
		// print_r(expression)
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_kelas/v_kelas-edit', $data);
		$this->load->view('template/footer');
	}

	public function edt_process()
	{
		$id = $this->input->post('idKelas', true);
		$data = array(
			'kelas' => $this->input->post('kelas', true),
			'id_user' => 1,
			'tglupdate' => date("Y-m-d h:i:sa")
		);

		$kelas = $this->db->get_where("tb_kelas", ['id_kelas !=' => $id, 'kelas' => $data['kelas']])->result();

		if (count($kelas) > 0){			
			$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
	                                            		<strong>Perhatian!</strong> Data Sudah Ada.
	                                        		</div>');
			redirect(base_url('kelas-edt/'.$id));
		} else {
			$this->M_Kelas->editKelas($data, $id);
			$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
	                                            		<strong>Sukses!</strong> Berhasil Mengubah Kelas.
	                                        		</div>');
			redirect(base_url('kelas/'));			
		}
	}

	public function delete_all()
	{
		$this->M_Kelas->deleteSemuaKelas();
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                            		<strong>Sukses!</strong> Berhasil Menghapus Semua Kelas.
                                        		</div>');
		redirect(base_url('kelas/'));
	}

	public function getKelasList(){
        $kelas = $this->input->get('kelas');
        $jurusan = $this->input->get('jurusan');
        $nourut = $this->input->get('nourut');

		$kelassiswa = $kelas.' '.$jurusan.' '.$nourut;

		$query = $this->db->query("SELECT * FROM tb_kelas WHERE kelas LIKE '%$jurusan%' AND `status` = 'aktif'")->result();

		$data = [];
		foreach($query as $row){
			if($row->kelas != $kelassiswa){
				//strlen(explode(' ', $row->kelas)[0])				
				$asd = strlen($kelas) + 1;
				if($asd == strlen(explode(' ', $row->kelas)[0]) && $nourut == explode(' ', $row->kelas)[2]){
					// echo $row->kelas.'<br>';
					array_push($data, $row);
				}
			}
		}

        echo json_encode($data); 
    }

}
