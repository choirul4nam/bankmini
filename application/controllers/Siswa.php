<?php

date_default_timezone_set('Asia/Jakarta');

defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('M_Setting');
		$this->load->model('M_Siswa');
		$this->load->model('M_Provinsi');
		$this->load->model('M_Kota');
		$this->load->model('M_Kecamatan');
		$this->load->model('M_Kelas');
		$this->load->model('M_Akses');

		$this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
		// $this->load->library('ImportExcel'); //load librari excel
		cek_login_user();
	}

	public function index()
	{
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['datasiswa'] = $this->M_Siswa->getsiswa();
		$data['datalulus'] = $this->M_Siswa->getLulus();
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath());


		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa', $data);
		$this->load->view('template/footer');
	}

	public function siswa_detail($nis)
	{
		$this->load->view('template/header');
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$this->load->view('template/sidebar', $data);
		$data['datasiswa'] = $this->M_Siswa->getsiswadetail($nis);
		$this->load->view('v_siswa/v_siswa-detail', $data);
		$this->load->view('template/footer');
		// print_r($this->M_Siswa->getsiswadetail($nis));
	}

	public function siswa_add()
	{
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['prov'] = $this->M_Provinsi->getprovinsi();
		$data['kelas'] = $this->M_Kelas->getkelas();
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-add', $data);
		$this->load->view('template/footer');
	}

	public function getKota($idProv)
	{
		$data = $this->M_Kota->getkotadetail($idProv);

		echo json_encode($data);
	}

	public function getSiswaByKelas($idKelas)
	{
		$data = $this->M_Kelas->getSiswaByKelas($idKelas);

		echo json_encode($data);
	}

	public function getKecamatan($idkota)
	{
		$data = $this->M_Kecamatan->getkecadetail($idkota);

		echo json_encode($data);
	}

	public function add_process()
	{
		if ($this->M_Siswa->cekNis($this->input->post('nis', true))) {
			if ($this->M_Siswa->cekRfid($this->input->post('rfid', true))) {
				$nis = $this->input->post('nis', true);
				$nama = $this->input->post('nama', true);
				$alamat = $this->input->post('alamat', true);
				$jk = $this->input->post('jk', true);
				$kelas = $this->input->post('kelas', true);
				$prov = $this->input->post('prov', true);
				$kota = $this->input->post('kota', true);
				$kecamatan = $this->input->post('kecamatan', true);
				$rfid = $this->input->post('rfid', true);
				$tmp_lahir = $this->input->post('tempat_lahir', true);
				$tgl_lahir = $this->input->post('tanggal_lahir', true);

				$id_tipeuser = $this->db->get_where('tb_tipeuser', ['tipeuser' => 'siswa'])->row_array();

				$data = array(
					'nis' => $nis,
					'namasiswa' => $nama,
					'alamat' => $alamat,
					'tempat_lahir' => $tmp_lahir,
					'tgl_lahir' => $tgl_lahir,
					'provinsi' => $prov,
					'kota' => $kota,
					'kecamatan' => $kecamatan,
					'jk' => $jk,
					'id_kelas' => $kelas,
					'tgl_update' => date("Y-m-d h:i:sa"),
					'id_user' => $this->session->userdata('id_user'),
					'status' => 'aktif',
					'id_tipeuser' => $id_tipeuser['id_tipeuser'],
					'password' => 'siswa123',
					'rfid' => $rfid
				);

				$this->M_Siswa->addSiswa($data);
				$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
		                                            		<strong>Sukses!</strong> Berhasil Menambahkan Data Siswa.
		                                        		</div>');
				redirect(base_url('siswa/'));
			} else {
				$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
		                                            		<strong>Perhatian!</strong> RFID sudah ada, Coba lagi.
		                                        		</div>');
				redirect(base_url('siswa/'));
			}
		} else {
			$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
	                                            		<strong>Perhatian!</strong> NIS sudah ada, Coba lagi.
	                                        		</div>');
			redirect(base_url('siswa/'));
		}
	}

	public function siswa_delete($nis)
	{
		$this->M_Siswa->delSiswa($nis);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                            		<strong>Sukses!</strong> Berhasil Menghapus Data Siswa.
                                        		</div>');
		redirect(base_url('siswa/'));
	}

	public function siswa_edit($nis)
	{
		$data['datasiswa'] = $this->M_Siswa->getsiswadetail($nis);
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['prov'] = $this->M_Provinsi->getprovinsi();
		$data['kelas'] = $this->M_Kelas->getkelas();
		$data['kota'] = $this->M_Kota->getkotadetail($this->M_Siswa->getsiswadetail($nis)['id_provinsi']);
		$data['keca'] = $this->M_Kecamatan->getkecadetail($this->M_Siswa->getsiswadetail($nis)['id_kota']);
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-edit', $data);
		$this->load->view('template/footer');
	}

	public function edt_process()
	{
		// echo $this->input->post('alumni');

		if ($this->input->post('alumni') == 1) {
			$status = 'alumni';
		} else {
			if ($this->input->post('status') === 'alumni') {
				$status = 'aktif';
			} else {
				$status = 'aktif';
			}
		}

		$data = array(
			// 'nis' => $this->input->post('nis', true),
			'namasiswa' => $this->input->post('nama', true),
			'alamat' => $this->input->post('alamat', true),
			'provinsi' => $this->input->post('prov', true),
			'kota' => $this->input->post('kota', true),
			'kecamatan' => $this->input->post('kecamatan', true),
			'jk' => $this->input->post('jk', true),
			'id_kelas' => $this->input->post('kelas', true),
			'tgl_update' => date("Y-m-d h:i:sa"),
			'status' => $status,
			'password' => $this->input->post('password', true),
			// 'rfid' => $this->input->post('rfid', true)
		);

		if ($this->input->post('nisOld') === $this->input->post('nis')) {
			$data['nis'] = $this->input->post('nis', true);
			if ($this->input->post('rfidOld') === $this->input->post('rfid')) {
				$data['rfid'] = $this->input->post('rfid', true);
				$this->M_Siswa->editSiswa($data, $this->input->post('nisOld'));
				$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                    		<strong>Sukses!</strong> Berhasil Mengubah Data Siswa.
                                		</div>');
				redirect(base_url('siswa/'));
			} else {
				if ($this->M_Siswa->cekNis($this->input->post('nis'))) {
					$data['rfid'] = $this->input->post('rfid', true);
					$this->M_Siswa->editSiswa($data, $this->input->post('nisOld'));
					$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                        		<strong>Sukses!</strong> Berhasil Mengubah Data Siswa.
                                    		</div>');
					redirect(base_url('siswa/'));
				} else {
					$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
                                        		<strong>Perhatian!</strong> RFID sudah ada.
                                    		</div>');
					redirect(base_url('siswa/'));
				}
			}
		} else {
			if ($this->M_Siswa->cekNis($this->input->post('nis'))) {
				$data['nis'] = $this->input->post('nis', true);
				if ($this->input->post('rfidOld') === $this->input->post('rfid')) {
					$data['rfid'] = $this->input->post('rfid', true);
					$this->M_Siswa->editSiswa($data, $this->input->post('nisOld'));
					$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                        		<strong>Sukses!</strong> Berhasil Mengubah Data Siswa.
                                    		</div>');
					redirect(base_url('siswa/'));
				} else {
					if ($this->M_Siswa->cekNis($this->input->post('nis'))) {
						$data['rfid'] = $this->input->post('rfid', true);
						$this->M_Siswa->editSiswa($data, $this->input->post('nisOld'));
						$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                            		<strong>Sukses!</strong> Berhasil Mengubah Data Siswa.
                                        		</div>');
						redirect(base_url('siswa/'));
					} else {
						$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
                                            		<strong>Perhatian!</strong> RFID sudah ada.
                                        		</div>');
						redirect(base_url('siswa/'));
					}
				}
			} else {
				$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
                                            		<strong>Perhatian!</strong> NIS sudah ada.
                                        		</div>');
				redirect(base_url('siswa/'));
			}
		}
	}

	public function siswa_graduate()
	{
		$data['datasiswa'] = $this->M_Siswa->getsiswa();
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['kelas'] = $this->M_Kelas->getkelas();

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-graduate', $data);
		$this->load->view('template/footer');
	}

	public function grad_process($id)
	{
		$this->M_Siswa->siswaGraduate($id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
		<strong>Sukses!</strong> Siswa Berhasil Lulus.
		</div>');
		redirect(base_url('siswa/'));
	}

	public function siswa_export()
	{
		$id = $this->session->userdata('tipeuser');

		$data['datasiswa'] = $this->M_Siswa->getsiswa();
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['kelas'] = $this->M_Kelas->getkelas();

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-export', $data);
		$this->load->view('template/footer');
	}

	public function export_process($idKelas)
	{
		$data['data'] = $this->M_Kelas->getSiswaByKelas($idKelas);
		$data['kelas'] = $this->db->get_where('tb_kelas', ['id_kelas' => $idKelas])->row();
		$this->load->view('v_siswa/v_siswa-export_page', $data);
	}

	public function siswa_import()
	{
		$id = $this->session->userdata('tipeuser');

		$data['datasiswa'] = $this->M_Siswa->getsiswa();
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['kelas'] = $this->M_Kelas->getkelas();

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-import', $data);
		$this->load->view('template/footer');
	}

	public function upload()
	{
		$fileName = time() . $_FILES['file']['name'];

		$config['upload_path'] = './assets/excel/'; //buat folder dengan nama assets di root folder
		$config['file_name'] = str_replace(" ", "", $fileName);
		$config['allowed_types'] = 'xls|xlsx|csv';
		$config['max_size'] = 10000;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('file'))
			$this->upload->display_errors();

		$media = $this->upload->data('file');
		$inputFileName = './assets/excel/' . $config['file_name'];

		try {
			$inputFileType = IOFactory::identify($inputFileName);
			$objReader = IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch (Exception $e) {
			redirect('siswa-import');
		}

		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		$data = [];
		$no = 0;
		$id_tipeuser = $this->db->get_where('tb_tipeuser', ['tipeuser' => 'siswa'])->row_array();
		for ($row = 2; $row <= $highestRow; $row++) {                  //  Read a row of data into an array                 
			$rowData = $sheet->rangeToArray(
				'A' . $row . ':' . $highestColumn . $row,
				NULL,
				TRUE,
				FALSE
			);

			//Sesuaikan sama nama kolom tabel di database     
			$date = strtotime(PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][5], 'YYYY-MM-DD'));
			$data[$no++] = array(
				"nis" => $rowData[0][1],
				"namasiswa" => $rowData[0][2],
				'alamat' => $rowData[0][3],
				'tempat_lahir' => strtoupper($rowData[0][4]),
				'tgl_lahir' => date('Y-m-d', $date),
				'kecamatan' => $this->db->get_where('tb_kecamatan', ['kecamatan' => $rowData[0][6]])->row()->id_kecamatan,
				'kota' => $this->db->get_where('tb_kota', ['name_kota LIKE' => '%' . $rowData[0][7] . '%'])->row()->id_kota,
				'provinsi' => $this->db->get_where('tb_provinsi', ['name_prov LIKE' => '%' . $rowData[0][8] . '%'])->row()->id_provinsi,
				'jk' => $this->M_Siswa->getJK($rowData[0][9]),
				// 'id_kelas' => $rowData[0][10],
				'id_kelas' => $this->db->get_where('tb_kelas', ['kelas' => $rowData[0][10]])->row()->id_kelas,
				'tgl_update' => date("Y-m-d h:i:sa"),
				'id_user' => $this->session->userdata('id_user'),
				'status' => 'aktif',
				'id_tipeuser' => $id_tipeuser['id_tipeuser'],
				'password' => 'siswa123',
				'rfid' => $rowData[0][11]
			);

			// sesuaikan nama dengan nama tabel
			// $insert = $this->db->insert("eimport",$data);
			// delete_files($media['file_path']);
		}
		// var_dump($highestRow);
		// print_r($data);
		// // redirect('excel/');
		$id = $this->session->userdata('tipeuser');
		$this->session->dataImport = $data;

		$datas['datasiswa'] = $this->session->dataImport;
		$datas['menu'] = $this->M_Setting->getmenu1($id);
		$datas['kelas'] = $this->M_Kelas->getkelas();

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $datas);
		$this->load->view('v_siswa/v_siswa-import_page', $data);
		$this->load->view('template/footer');
	}

	public function import()
	{
		$data = $this->session->dataImport;
		for ($i = 0; $i < count($data); $i++) {
			$this->db->insert('tb_siswa', $data[$i]);
		}
		// $this->session->unset_tempdata('dataImport');
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
		<strong>Sukses!</strong> Berhasil Import Data Siswa.
		</div>');
		redirect('siswa');
	}
}
