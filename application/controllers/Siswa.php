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
		$this->load->model('M_TahunAkademik');
		$this->load->model('M_Kota');
		$this->load->model('M_Kecamatan');
		$this->load->model('M_Transaksi');
		$this->load->model('M_Kelas');
		$this->load->model('M_Akses');
			
		cek_login_user();
	}

	public function index()
	{
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);				
		$data['datasiswa'] = $this->M_Siswa->getsiswa();		
		$data['datalulus'] = $this->M_Siswa->getLulus();		
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'siswa'])->row()->id_menus;

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa', $data);
		$this->load->view('template/footer');
	}

	public function siswa_detail($nis)
	{
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['datasiswa'] = $this->M_Siswa->getsiswadetail($nis);
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPathDet(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'siswa'])->row()->id_menus;

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-detail', $data);
		$this->load->view('template/footer');
		// print_r($this->M_Siswa->getsiswadetail($nis));
	}

	public function siswa_add()
	{
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['prov'] = $this->M_Provinsi->getprovinsi();
		$data['tahunaka'] = $this->M_TahunAkademik->getAll();
		$data['kelas'] = $this->M_Kelas->getkelas();
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'siswa'])->row()->id_menus;

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
		// $this->db->where();
		echo json_encode($this->db->query("SELECT tb_siswa.*, tb_kelas.kelas, tb_tahunakademik.tglawal, tb_tahunakademik.tglakhir FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas JOIN tb_tahunakademik ON tb_siswa.id_tahunakademik = tb_tahunakademik.id_tahunakademik WHERE tb_siswa.id_kelas = $idKelas AND tb_siswa.status = 'aktif'")->result());
	}

	public function getKecamatan($idkota)
	{
		$data = $this->M_Kecamatan->getkecadetail($idkota);

		echo json_encode($data);
	}
	
	public function add_process()
	{
		$id_tipeuser = $this->db->get_where('tb_tipeuser', ['tipeuser' => 'siswa'])->row_array();
		$cekNis = $this->M_Siswa->cekNis($this->input->post('nis', true));
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
		$tahunakademik = $this->input->post('tahun_akademik', true);
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
			'rfid' => $rfid,
			'id_tahunakademik' => $tahunakademik
		);

		if ($cekNis == 'kosong') {
			if ($this->M_Siswa->cekRfid($this->input->post('rfid', true))) {								
				if(count($id_tipeuser) === 1 || $id_tipeuser !== null){					
	
					$this->M_Siswa->addSiswa($data);
					$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
																<strong>Sukses!</strong> Berhasil Menambahkan Data Siswa.
															</div>');
					redirect(base_url('siswa/'));
				}else{
					$this->session->set_flashdata('alert', '<div class="alert alert-danger left-icon-alert" role="alert">
		                                            		<strong>Gagal!</strong> Mohon tambahkan Tipe User siswa terlebih dulu.
		                                        		</div>');
					redirect(base_url('siswa/'));
				}
			} else {
				$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
		                                            		<strong>Perhatian!</strong> RFID sudah ada, Coba lagi.
		                                        		</div>');
				redirect(base_url('siswa/'));
			}
		}else if($cekNis == 'lulus'){
			$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
														<strong>Perhatian!</strong> Sudah Ada Alumni yang mempunyai NIS yang sama.
													</div>');
			redirect(base_url('siswa/'));
		}else if($cekNis == 'update'){
			if ($this->M_Siswa->cekRfid($this->input->post('rfid', true))) {								
				if(count($id_tipeuser) === 1 || $id_tipeuser !== null){						
					$this->db->where('nis', $this->input->post('nis', true));
					$this->db->update('tb_siswa',$data);
					$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
																<strong>Sukses!</strong> Berhasil Menambahkan Data Siswa.
															</div>');
					redirect(base_url('siswa/'));
				}else{
					$this->session->set_flashdata('alert', '<div class="alert alert-danger left-icon-alert" role="alert">
		                                            		<strong>Gagal!</strong> Mohon tambahkan Tipe User siswa terlebih dulu.
		                                        		</div>');
					redirect(base_url('siswa/'));
				}
			} else {
				$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
		                                            		<strong>Perhatian!</strong> RFID sudah ada, Coba lagi.
		                                        		</div>');
				redirect(base_url('siswa/'));
			}
		}else {
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
		$id = $this->session->userdata('tipeuser');
		$data['datasiswa'] = $this->M_Siswa->getsiswadetail($nis);
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['prov'] = $this->M_Provinsi->getprovinsi();
		$data['tahunaka'] = $this->M_TahunAkademik->getAll();
		$data['kelas'] = $this->M_Kelas->getkelas();
		$data['kota'] = $this->M_Kota->getkotadetail($this->M_Siswa->getsiswadetail($nis)['provinsi']);
		$data['keca'] = $this->M_Kecamatan->getkecadetail($this->M_Siswa->getsiswadetail($nis)['kota']);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'siswa'])->row()->id_menus;

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-edit', $data);
		$this->load->view('template/footer');
	}

	public function edt_process()
	{
		// echo $this->input->post('alumni');

		// if ($this->input->post('alumni') == 1) {
		// 	$status = 'alumni';
		// } else {
		// 	if ($this->input->post('status') === 'alumni') {
		// 		$status = 'aktif';
		// 	} else {
		// 		$status = 'aktif';
		// 	}
		// }

		$date = date_create($this->input->post('tanggal_lahir', true));

		$data = array(
			// 'nis' => $this->input->post('nis', true),
			'namasiswa' => $this->input->post('nama', true),
			'alamat' => $this->input->post('alamat', true),
			'tempat_lahir' => $this->input->post('tempat_lahir', true),
			'tgl_lahir' => date_format($date,"d-m-Y"),
			'provinsi' => $this->input->post('prov', true),
			'kota' => $this->input->post('kota', true),
			'kecamatan' => $this->input->post('kecamatan', true),
			'jk' => $this->input->post('jk', true),
			'id_kelas' => $this->input->post('kelas', true),
			'tgl_update' => date("Y-m-d h:i:sa"),
			// 'status' => $status,
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
				if ($this->db->get_where('tb_siswa', ['rfid' => $this->input->post('rfid')])->num_rows() == 0) {
					$data['rfid'] = $this->input->post('rfid', true);
					$this->M_Siswa->editSiswa($data, $this->input->post('nisOld'));
					$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                        		<strong>Sukses!</strong> Berhasil Mengubah Data Siswa.
                                    		</div>');
					redirect(base_url('siswa/'));
				} else {
					$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
                                        		<strong>Perhatian!</strong> RFID sudah ada 2.
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
					if ($this->db->get_where('tb_siswa', ['rfid' => $this->input->post('rfid')])->num_rows() != 0) {
						$data['rfid'] = $this->input->post('rfid', true);
						$this->M_Siswa->editSiswa($data, $this->input->post('nisOld'));
						$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
                                            		<strong>Sukses!</strong> Berhasil Mengubah Data Siswa.
                                        		</div>');
						redirect(base_url('siswa/'));
					} else {
						$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
                                            		<strong>Perhatian!</strong> RFID sudah ada 1.
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
		$id = $this->session->userdata('tipeuser');
		$data['datalulus'] = $this->M_Siswa->getLulus();
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['kelas'] = $this->M_Kelas->getkelas();
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'siswa lulus'])->row()->id_menus;
		
		
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-graduate', $data);
		$this->load->view('template/footer');
	}
	
	public function grad_process($id)
	{
		$data = ['status' => 'alumni'];
		$this->db->where('id_kelas', $id);		
		if($this->db->update('tb_siswa', $data)){
			echo 'berhasil';
		}else{
			echo 'salah';
		}
	}
	
	public function siswa_export()
	{
		$id = $this->session->userdata('tipeuser');		
		$data['datasiswa'] = $this->M_Siswa->getsiswa();
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['kelas'] = $this->M_Kelas->getkelas();
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'siswa'])->row()->id_menus;
		
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-export', $data);
		$this->load->view('template/footer');
	}
	
	public function export_process($id)
	{
		$siswa = $this->db->get_where('tb_siswa', ['id_kelas' => $id])->result();
		$name = $this->db->get_where('tb_kelas', ['id_kelas' => $id])->row()->kelas;

		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("HOSTERWEB");
		$objPHPExcel->getProperties()->setLastModifiedBy("HOSTERWEB");
		$objPHPExcel->getProperties()->setTitle("Download Tamplate excel");
		$objPHPExcel->getProperties()->setSubject("");
		$objPHPExcel->getProperties()->setDescription("");

		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'DATA KELAS '.$name);
		$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');

		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'SMA NEGERI 1 WRINGIN ANOM ');
		$objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
				
		$objPHPExcel->getActiveSheet()->setCellValue('A3', ' ');
		$objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
		
		$objPHPExcel->getActiveSheet()->setCellValue('A4', ' ');
		$objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
		
		$objPHPExcel->getActiveSheet()->setCellValue('A5', 'No');
		$objPHPExcel->getActiveSheet()->setCellValue('B5', 'NIS');
		$objPHPExcel->getActiveSheet()->setCellValue('C5', 'Nama Lengkap');
		$objPHPExcel->getActiveSheet()->setCellValue('D5', 'Jenis Kelamin');
		$objPHPExcel->getActiveSheet()->setCellValue('E5', 'Kelas');
		$objPHPExcel->getActiveSheet()->setCellValue('F5', 'Tempat, Tanggal Lahir');
		$objPHPExcel->getActiveSheet()->setCellValue('G5', 'Alamat');
		
		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),			
		);
	
		$objPHPExcel->getDefaultStyle()->applyFromArray($style);		
		$styleArray = array(
			'borders' => array(
			  'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			  )
			)
		);
		  
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('A5:G5')->applyFromArray($styleArray);	

		$nr = 6;
		$no = 1;
		foreach($siswa as $row){
			$kelas = $this->db->get_where('tb_kelas', ['id_kelas' => $row->id_kelas])->row()->kelas;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$nr, $no);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$nr, $row->nis);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$nr, $row->namasiswa);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$nr, $row->jk);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$nr, $kelas);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$nr, $row->tempat_lahir.','.$row->tempat_lahir);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$nr, $row->alamat);	

			$nr++;
			$no++;
		}		  		  

		$fileName = $name.date('dmY').'.xlsx';

		$objPHPExcel->getActiveSheet()->setTitle('Data Siswa');

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. $fileName .'"');
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$write->save('php://output');
		
		exit;

	}
	
	public function siswa_import()
	{
		$id = $this->session->userdata('tipeuser');
		
		// $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['datasiswa'] = $this->M_Siswa->getsiswa();
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['kelas'] = $this->M_Kelas->getkelas();
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'siswa'])->row()->id_menus;

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-import', $data);
		$this->load->view('template/footer');
	}

	public function upload()
	{
		// var_dump($_FILES['file']);				
		$this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
		$fileName = time() . $_FILES['file']['name'];
		$config['upload_path'] = './assets/excel/'; //buat folder dengan nama assets di root folder
		$config['file_name'] = str_replace(" ", "", $fileName);
		$config['allowed_types'] = 'xls|xlsx|csv';
		$config['max_size'] = 10000;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if($this->upload->do_upload('file')){ 			
		}else{ 
			$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
														<strong>Perhatian!</strong> <br>
														<ul>															
															<li>'.$this->upload->display_errors().'</li>															
														</ul>						
													</div>');
			redirect(base_url('siswa-import/'));
		} 
		
		$media = $this->upload->data('file');
		$inputFileName = './assets/excel/' . $config['file_name'];

		try {			
			$inputFileType = IOFactory::identify($inputFileName);
			$objReader = IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch (Exception $e) {
			// redirect('siswa-import');
			// $this->session->set_flashdata('alert', '<div class="alert alert-danger left-icon-alert" role="alert">
			// 											<strong>Perhatian!</strong> '.$e.'.
			// 										</div>');
			// redirect(base_url('siswa-import/'));
			var_dump($e);
		}

		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();		
		$data = [];
		$dataKosong = [];
		$no = 0;
		$kosong = 0;
		$id_tipeuser = $this->db->get_where('tb_tipeuser', ['tipeuser' => 'siswa'])->row_array();
		// var_dump($id_tipeuser);
		if($highestRow >= 6){
			if(!empty($id_tipeuser)){
				for ($row = 6; $row <= $highestRow; $row++) {                  //  Read a row of data into an array                 
					$rowData = $sheet->rangeToArray(
						'A' . $row . ':' . $highestColumn . $row,
						NULL,
						TRUE,
						FALSE
					);
	
					//Sesuaikan sama nama kolom tabel di database     
					if( empty($rowData[0][1]) || empty($rowData[0][2]) || empty($rowData[0][3]) || empty($rowData[0][4])){
						if(empty($rowData[0][1]) && empty($rowData[0][2]) && empty($rowData[0][3]) && empty($rowData[0][4])){
							// 			
						}else{
							$dataKosong[$no++] = array(
								"nis" => $rowData[0][1],
								"namasiswa" => $rowData[0][2],
								'jk' => $rowData[0][3],
								'id_kelas' => $rowData[0][4],
								'tempat_tgl_lahir' => $rowData[0][5],								
								'alamat' => $rowData[0][6],
								// 'id_kelas' => $rowData[0][10],
								// 'tgl_update' => date("Y-m-d h:i:sa"),
								// 'id_user' => $this->session->userdata('id_user'),
								// 'status' => 'aktif',
								// 'id_tipeuser' => $id_tipeuser['id_tipeuser'],
								// 'password' => 'siswa123',
							);
						}
															
					}else{						
						// (!empty(explode(',',$rowData[0][5])[1]) ? $date = strtotime(PHPExcel_Style_NumberFormat::toFormattedString(explode(',',$rowData[0][5])[1] , 'YYYY-MM-DD')) : '');						
						// $tgl = explode(',',$rowData[0][5])[1];
						// $date = strtotime(PHPExcel_Style_NumberFormat::toFormattedString($tgl , 'YYYY-MM-DD'));
						// $newDate = date('Y-m-d',$date);
						// echo $newDate;
						// die();
						if($this->db->get_where('tb_kelas', ['kelas LIKE' => '%'. $rowData[0][4].'%' ])->num_rows() != 0){
							$data[$no++] = array(
								"nis" => $rowData[0][1],
								"namasiswa" => $rowData[0][2],
								'jk' => $this->M_Siswa->getJK($rowData[0][3]),
								'id_kelas' => $this->db->get_where('tb_kelas', ['kelas LIKE' => '%'. $rowData[0][4].'%' ])->row()->id_kelas,
								'tempat_tgl_lahir' => $rowData[0][5],
								'alamat' => $rowData[0][6],
								'tgl_lahir' => (!empty(explode(',',$rowData[0][5])[1]) ? explode(',', $rowData[0][5])[1] : '' ),
								'tempat_lahir' => (!empty(explode(',',$rowData[0][5])[0]) ? explode(',', $rowData[0][5])[0] : '' ),
								// 'kecamatan' => $this->db->get_where('tb_kecamatan', ['kecamatan LIKE' => '%'.$rowData[0][6].'%' ])->row()->id_kecamatan,
								// 'kota' => $this->db->get_where('tb_kota', ['name_kota LIKE' => '%' . $rowData[0][7] . '%'])->row()->id_kota,
								// 'provinsi' => $this->db->get_where('tb_provinsi', ['name_prov LIKE' => '%' . $rowData[0][8] . '%'])->row()->id_provinsi,
								// 'id_kelas' => $rowData[0][10],
								'tgl_update' => date("Y-m-d h:i:sa"),
								'id_user' => $this->session->userdata('id_user'),
								'status' => 'aktif',
								'id_tipeuser' => $id_tipeuser['id_tipeuser'],
								'password' => 'siswa123',
							);
						}else{
							$this->session->set_flashdata('alert', '<div class="alert alert-danger left-icon-alert" role="alert">
														<strong>Gagal!</strong> Kelas '.$rowData[0][4].' Tambah kan Terlebih dulu
													</div>');
							redirect(base_url('siswa/'));
						}
					}
				
				}
			}else{
				$this->session->set_flashdata('alert', '<div class="alert alert-danger left-icon-alert" role="alert">
														<strong>Gagal!</strong> Mohon tambahkan Tipe User siswa terlebih dulu.
													</div>');
				redirect(base_url('siswa/'));
			}
		}else{
			$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
														<strong>Perhatian!</strong> File excel anda kosong.
													</div>');
			redirect(base_url('siswa-import/'));
		}
		$id = $this->session->userdata('tipeuser');
		$this->session->dataImport = $data;
		$this->session->dataKosongImport = $data;

		if(count($dataKosong) !== 0){
			$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
													<strong>Perhatian!</strong> Ada data anda yang kosong, Tolong cek kembali dan Upload Kembali.
												</div>');
					redirect(base_url('siswa-import/'));
		}else{
			$datas['datasiswa'] = $this->session->dataImport;
			$datas['countSiswa'] = count($this->session->dataImport);
			$datas['menu'] = $this->M_Setting->getmenu1($id);
			$datas['kelas'] = $this->M_Kelas->getkelas();
			$datas['tahun'] = $this->db->query('SELECT id_tahunakademik AS id, YEAR(tglawal) AS tahunawal, YEAR(tglakhir) AS tahunakhir FROM `tb_tahunakademik`')->result_array();
			$datas['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'siswa'])->row()->id_menus;

			$this->load->view('template/header');
			$this->load->view('template/sidebar', $datas);
			$this->load->view('v_siswa/v_siswa-import_page', $datas);
			$this->load->view('template/footer');
		}		
	}

	public function import()
	{
		// echo $this->input->get('id_tahunakademik');	
		$id_tahunakademik = $this->input->get('id_tahunakademik');	
		$data = $this->session->dataImport;
		$dataRow = 0;
		for ($i = 0; $i < count($data); $i++) {
			unset($data[$i]['tempat_tgl_lahir']);
			$data[$i]['id_tahunakademik'] = $id_tahunakademik;
			if($this->db->get_where('tb_siswa',['nis' => $data[$i]['nis']])->num_rows() === 0){
				$this->db->insert('tb_siswa', $data[$i]);
				$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
				<strong>Sukses!</strong> Berhasil Import Data Siswa.
				</div>');
			}else{
				$dataRow = $dataRow + 1;
				$this->session->set_flashdata('alert', '<div class="alert alert-warning left-icon-alert" role="alert">
				<strong>Perhatian!</strong> Ada '.$dataRow.' Data Siswa Yang Sudah Ada Dalam Database.
				</div>');
			}
		}
		// $this->session->unset_tempdata('dataImport');		
		redirect('siswa');
	}

	public function getSiswa(){
		echo json_encode($this->M_Siswa->getsiswa());
	}

	public function downloadTMP($idkelas){
		// $data['kelas'] = $this->db->get_where('tb_kelas', ['id_kelas' => $kelas])->row()->kelas;
		// $this->load->view('v_siswa/v_siswa-download-tmp', $data);
		$kelas = $this->db->get_where('tb_kelas', ['id_kelas' => $idkelas])->row()->kelas;

		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("HOSTERWEB");
		$objPHPExcel->getProperties()->setLastModifiedBy("HOSTERWEB");
		$objPHPExcel->getProperties()->setTitle("Download Tamplate excel");
		$objPHPExcel->getProperties()->setSubject("");
		$objPHPExcel->getProperties()->setDescription("");

		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'DATA KELAS '.$kelas);
		$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');

		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'SMA NEGERI 1 WRINGIN ANOM ');
		$objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
				
		$objPHPExcel->getActiveSheet()->setCellValue('A3', ' ');
		$objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
		
		$objPHPExcel->getActiveSheet()->setCellValue('A4', ' ');
		$objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
		
		$objPHPExcel->getActiveSheet()->setCellValue('A5', 'No');
		$objPHPExcel->getActiveSheet()->setCellValue('B5', 'NIS');
		$objPHPExcel->getActiveSheet()->setCellValue('C5', 'Nama Lengkap');
		$objPHPExcel->getActiveSheet()->setCellValue('D5', 'Jenis Kelamin');
		$objPHPExcel->getActiveSheet()->setCellValue('E5', 'Kelas');
		$objPHPExcel->getActiveSheet()->setCellValue('F5', 'Tempat, Tanggal Lahir');
		$objPHPExcel->getActiveSheet()->setCellValue('G5', 'Alamat');
		
		$objPHPExcel->getActiveSheet()->setCellValue('A6', ' ');
		$objPHPExcel->getActiveSheet()->setCellValue('B6', ' ');
		$objPHPExcel->getActiveSheet()->setCellValue('C6', ' ');
		$objPHPExcel->getActiveSheet()->setCellValue('D6', ' ');
		$objPHPExcel->getActiveSheet()->setCellValue('E6', $kelas);
		$objPHPExcel->getActiveSheet()->setCellValue('F6', ' ');
		$objPHPExcel->getActiveSheet()->setCellValue('G6', ' ');
		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),			
		);
	
		$objPHPExcel->getDefaultStyle()->applyFromArray($style);		
		$styleArray = array(
			'borders' => array(
			  'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			  )
			)
		);	
		  
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('A4:G4')->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->getStyle('A5:G5')->applyFromArray($styleArray);	

		$fileName = $kelas.date('dmY').'.xlsx';

		$objPHPExcel->getActiveSheet()->setTitle('Data Siswa');

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'. $fileName .'"');
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$write->save('php://output');
		
		exit;
	}
	
	public function graduate_page(){
		$id = $this->session->userdata('tipeuser');
		// $data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['kelas'] = $this->db->get_where('tb_kelas', ['kelas LIKE' => '%XII%'])->result_array();
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'siswa lulus'])->row()->id_menus;

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_siswa/v_siswa-graduate-page', $data);
		$this->load->view('template/footer');
	}

	public function getSiswaSrch($key){
		echo json_encode($this->db->query("SELECT tb_siswa.*, tb_kelas.kelas, tb_tahunakademik.tglawal, tb_tahunakademik.tglakhir FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas JOIN tb_tahunakademik ON tb_siswa.id_tahunakademik = tb_tahunakademik.id_tahunakademik WHERE nis LIKE '%$key%' OR namasiswa LIKE '%$key%' AND tb_siswa.status = 'aktif' AND tb_kelas.kelas LIKE '%XII%'")->result());
	}

	public function gradByOne($id)
	{
		if($this->M_Siswa->siswaGraduate($id)){
			echo 'berhasil';
		}else{
			echo 'gagal';
		}
		
	}

	public function getSiswaDetail($nis){
		echo json_encode($this->db->query("SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE tb_siswa.nis = $nis")->row());
	}

	public function naikKelas(){
	
		$newKelas 	= $this->input->get("newKelas");
		$oldKelas 	= $this->input->get("oldKelas");
		$TA 	= $this->input->get("tahun_akademik");
		$data = [
			'id_kelas' => $newKelas,
			'id_tahunakademik' => $TA
		];
		$this->db->where("id_kelas", $oldKelas);
		$this->db->update("tb_siswa", $data);

		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
														<strong>Berhasil!</strong> Menaikan kan Kelas Siswa .
													</div>');
		redirect(base_url('naikkelas/'));
			
	}
}
