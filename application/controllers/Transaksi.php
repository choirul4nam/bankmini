<?php
date_default_timezone_set('Asia/Jakarta');
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{    
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'h_rand_string'));
		$this->load->library('session');
		$this->load->model('M_Setting');
		$this->load->model('M_Transaksi');
		$this->load->model('M_TipeUser');
		$this->load->model('M_Akses');

		cek_login_user();
	}

	public function index()
	{			
		// print_r($this->M_Transaksi->getTransaksi());
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($id);
		$data['transaksi'] = $this->M_Transaksi->getTransaksi();
		// echo json_encode();
		// $fruitArrayObject = new ArrayObject($data['transaksi']);
		// $fruitArrayObject->asort();
		// asort($data['transaksi']);
		// print_r($data['transaksi']);
		$data['akses'] = $this->M_Akses->getByLinkSubMenu(urlPath(), $id);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'transaksi'])->row()->id_menus;

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_transaksi/v_transaksi', $data);
		$this->load->view('template/footer');
    }

    public function transaksi_add()
	{
		$id = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1();
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'transaksi'])->row()->id_menus;
		$data['tipeuser'] = $this->M_TipeUser->getAll();
		// $data['transaksi'] = $this->db->get('tb_mastertransaksi')->result_array();
		
		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_transaksi/v_transaksi-add', $data);
		$this->load->view('template/footer');
	}

	public function getHistoriTransaksi(){		
		$getNama = $this->input->get('id');
		$getTipe = $this->input->get('tipe');
				
		
		if(!empty($getNama) && !empty($getTipe)){
			$data = $this->M_Transaksi->getTransaksiDetail($getTipe, $getNama);
			// echo json_encode($this->M_Transaksi->getTransaksiDetail($getTipe, $getNama));
		}else{
			// echo 'gak';
			$data = [['kosong' => true]];
		}	

		// echo $getNama;
		// echo $getTipe;
		// echo print_r($this->input->get());
		echo json_encode($data);
	}

	public function add_process()
	{
		// date_default_timezone_set('Asia/Jakarta');
		// var_dump($this->input->post());		
		$id_customer = $this->input->post('id_customer', true);
		$id_tipeuser = $this->db->get_where('tb_tipeuser',['id_tipeuser' => intval($this->input->post('usertipe')) ] )->row();		
		$data = array(
			'id_transaksi' => '',
			'tipeuser' => $id_tipeuser->tipeuser,
			'id_jenistransaksi ' => $this->input->post('id_jenistransaksi', true),
			'kodetransaksi' => $this->input->post('kode_transaksi'),
			'keterangan' => $this->input->post('keterangan', true),
			'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
			'id_user' => $this->session->userdata('id_user'),
			'tgl_update' => date("Y-m-d H:i:sa"),
			'status' => 'aktif',
		);

		// var_dump();

		if( $id_tipeuser->tipeuser == 'staf' ){
			$data['id_anggota'] = $id_customer;
			$data['id_siswa'] = null;
		
		}else if( $id_tipeuser->tipeuser == 'siswa' ){
			$data['id_siswa'] = $id_customer;
			$data['id_anggota'] = null;
			
		}
		$nominal = preg_replace("/[^0-9]/", "", $this->input->post('nominal'));
		$saldo = intval($this->input->post('sisasaldo'));
		$tipe = $this->input->post('tipeTransaksi');
		$sisasaldo = 0;
		if($tipe == 'debet'){
			$sisasaldo = $saldo - intval($nominal);
		}else if($tipe == 'kredit'){
			$sisasaldo = $saldo + intval($nominal);
		}	
		// var_dump($sisasaldo);	
		$baseurl = base_url();
			
		$id_transaksi = $this->M_Transaksi->addTransaksi($data);
		// $id_transaksi = 0;
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
	                                            		<strong>Sukses!</strong> Transaksi Berhasil.
													</div>');
		if($this->input->post('action') == 'cetak'){
				echo '<script>								
							window.onload = () => {  
								let move =  window.open("'.$baseurl.'transaksi/printOutTransaksi?id_transaksi='.$id_transaksi.'&tipe='.$id_tipeuser->tipeuser.'&ss='.$sisasaldo.'");
								setTimeout( () => {
									move.close();
									window.location.href = "'.$baseurl.'transaksi/"									
								}, 3000)
							};									
			  		</script>';		
			// header(base_url('transaksi/printOutTransaksi?id_transaksi='.$id_transaksi.'&tipe='.$id_tipeuser->tipeuser.'&ss='.$sisasaldo));
		}else if($this->input->post('action') == 'simpan'){
			redirect(base_url('transaksi/'));
		}			
		// redirect(base_url('transaksi/printOutTransaksi?id_transaksi='.$id_transaksi.'&tipe='.$id_tipeuser->tipeuser.'&ss='.$sisasaldo));
	}

	public function getNewKode($data){
		$kode = explode('-', $data);						
		$kodeC = $this->db->select('*')->like('kodetransaksi', $kode[0])->order_by('id_transaksi',"desc")->limit(1)->get('tb_transaksi')->row();
		if(!empty($kodeC)){
			$lastCode = explode('-', $kodeC->kodetransaksi);			
		}else{
			$lastCode = [$kode[0],date('Ymd'),'1'];
		}
		$one = '';
		$two = '';
		$tiga = '';

		if($kode[0] == $lastCode[0]){
			$one = $kode[0];
		}else{
			$one = $kode[0];
		}		
		if($kode[1] == 'tanggal'){
			$two = date('dmY');
		}			
		if($kode[2] == 'no'){
			if($two == $lastCode[1]){
				$tiga = $lastCode[2] + 1;
			}else{
				$tiga = 1;
			}
		}		

		echo $one.'-'.$two.'-'.$tiga;
		
	}

	public function printOutTransaksi(){
		// $id = $this->input->get('id_transaksi');
		// $tipe = $this->input->get('tipe');
		// // $saldo = intval($this->input->get('ss'));
		// $saldo = 0;
		// if($tipe == 'siswa'){
		// 	$query = $this->db->query("SELECT tb_transaksi.*, tb_siswa.namasiswa, tb_siswa.nis, tb_siswa.id_kelas FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_transaksi.id_transaksi = $id")->row(); 			
		// 	$query->nama = '';
		// 	$query->namaTransaksi = $query->namasiswa;
		// 	$query->kosong = false;
		// 	$saldo = 0;
		// 	$kelas = $this->db->get_where('tb_kelas',['id_kelas' => $query->id_kelas])->row()->kelas;
		// 	$kredit = $this->db->query("SELECT tb_transaksi.nominal FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_siswa.nis = $query->id_siswa AND tb_mastertransaksi.kredit = 'siswa'")->result_array(); 
		// 	$debet = $this->db->query("SELECT tb_transaksi.nominal FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_siswa.nis = $query->id_siswa AND tb_mastertransaksi.debet = 'siswa'")->result_array(); 
		// 	foreach($kredit as $row){
		// 		$saldo += $row['nominal'];
		// 	}
		// 	foreach($debet as $row){
		// 		$saldo -= $row['nominal'];
		// 	}			
		// }else if($tipe == 'staf'){
		// 	$query = $this->db->query("SELECT tb_transaksi.*, tb_staf.nama, tb_staf.nopegawai FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_transaksi.id_transaksi = $id")->row(); 			
		// 	$query->namasiswa = '';
		// 	$query->namaTransaksi = $query->nama;
		// 	$query->kosong = false;
		// 	$kredit = $this->db->query("SELECT tb_transaksi.nominal FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_staf.id_staf = $query->id_anggota AND tb_mastertransaksi.kredit = 'koperasi'")->result_array(); 
		// 	$debet = $this->db->query("SELECT tb_transaksi.nominal FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_staf.id_staf = $query->id_anggota AND tb_mastertransaksi.debet = 'koperasi'")->result_array(); 
		// 	foreach($kredit as $row){
		// 		$saldo += $row['nominal'];
		// 	}
		// 	foreach($debet as $row){
		// 		$saldo -= $row['nominal'];
		// 	}
		// 	// $kasmasuk = $this->db->query("SELECT SUM(nominal) as saldoKM FROM tb_kasmasuk")->row_array();
		// 	// $tnsksi = $this->db->query("SELECT SUM(nominal) as jumlah FROM tb_transaksi WHERE id_anggota = '" . $id_staf . "'")->row_array();

		// 	// $saldo = intval($kasmasuk['saldoKM'] - $tnsksi['jumlah']);		
		// }		
		// $idlogin = $this->session->userdata('id_user'); 
		// $staf = $this->db->get_where('tb_users', ['id' => $idlogin])->row()->nama;	
		// $date = date_format(date_create($query->tgl_update),"d-m-Y H:i:s");			
		// // $print_status = "none";			
		// // var_dump($query);	
		// // $data['query'] = $query;
		// // $data['staf'] = $staf;
		// // $data['sisasaldo'] = $saldo;
		// // $this->load->view('v_transaksi/v_transaksi-print', $data);
		// try{
		// 	$this->load->library('escpos');

		// 	$connector = new Escpos\PrintConnectors\WindowsPrintConnector("hoster_web");   
		// 	// var_dump($connector);
		// 	$printer = new Escpos\Printer($connector);
		// 	// var_dump($printer);
		// 	// $printer->E;
		// 	// die();				
		// 	// Membuat judul
		// 	$printer->initialize();
		// 	// $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
		// 	$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
		// 	$printer->text("Koperasi Siswa\n");
		// 	$printer->text("SMA NEGERI 1 WRINGIN ANOM\n");
		// 	$printer->text("\n");
		// 	$printer->text("JL. RAYA SEMBUNG WRINGINANOM, Sembung,\n Kec. Wringin Anom, Gresik\n");
		// 	$printer->text("(031) 7762 5226 - www.sman1wringinanom.sch.id\n");
		// 	// Data transaksi
		// 	$printer->initialize();
		// 	$printer->text("------------------------------------------------\n");
		// 	$printer->text("Tanggal,Waktu : ".$date."\n");
		// 	$printer->text("Kode Transaksi : ".$query->kodetransaksi."\n");
		// 	$printer->text("------------------------------------------------\n");
		// 	if($tipe == 'staf'){
		// 		$printer->text("No Anggota : ".$query->nopegawai."\n");
		// 		$printer->text("\n");
		// 	}
		// 	$printer->text("Nama : ".$query->namaTransaksi."\n");
		// 	$printer->text("\n");
		// 	if($tipe == 'siswa'){
		// 		$printer->text("NIS : ".$query->nis."\n");
		// 		$printer->text("\n");
		// 		$printer->text("Kelas : ".$kelas."\n");
		// 		$printer->text("\n");
		// 	}
		// 	$printer->text("------------------------------------------------\n");
		// 	$printer->text("Nominal : Rp. ".number_format($query->nominal)."\n");
		// 	$printer->text("Sisa Saldo : Rp. ".number_format($saldo)."\n");
		// 	$printer->text("------------------------------------------------\n");
		// 	$printer->text("\n");
		// 		// Pesan penutup
		// 	$printer->initialize();
		// 	$printer->setJustification(Escpos\Printer::JUSTIFY_RIGHT);
		// 	$printer->text("\n");
		// 	$printer->text("Petugas\n");
		// 	$printer->text($staf."\n");
		// 	$printer->feed(8); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)			
		// 	$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
		// 												<strong>Sukses!</strong> Berhasil.
		// 											</div>');
		// 	$printer->cut(); 
		// 	//   $printer->pulse();
		// 	$printer->close(); 
		// }catch(Exception $e){
		// 	echo "Ada Masalah: " . $e -> getMessage() . "\n";
		// }
	}

	public function transaksi_delete($id)
	{
		$this->M_Transaksi->deleteTransaksi($id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
	                                            		<strong>Sukses!</strong> Berhasil Di hapus.
	                                        		</div>');
		redirect(base_url('transaksi/'));
	}

	public function transaksi_edit($id)
	{
		$ida = $this->session->userdata('tipeuser');
		$data['menu'] = $this->M_Setting->getmenu1($ida);
		$data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'transaksi'])->row()->id_menus;
		$data['tipeuser'] = $this->M_TipeUser->getAll();
		$data['transaksi'] = $this->db->get('tb_mastertransaksi')->result_array();
		$data['data'] = $this->db->get_where('tb_transaksi',['id_transaksi' => $id])->row();

		$this->load->view('template/header');
		$this->load->view('template/sidebar', $data);
		$this->load->view('v_transaksi/v_transaksi-edit', $data);
		$this->load->view('template/footer');
		// print_r($this->db->get_where('tb_transaksi',['id_transaksi' => $id])->row());
	}

	public function edit_process()
	{
		// var_dump($this->input->post());		
		// $id_tipeuser = $this->db->get_where('tb_tipeuser',['id_tipeuser' => intval($this->input->post('usertipe')) ] )->row();	
		$id_customer = $this->input->post('id_customer', true);
		$id = $this->input->post('id_transaksi', true);
		if($this->input->post('usertipe') == 'siswa' || $this->input->post('usertipe') == 'administrator'){
			$id_tipeuser = $this->input->post('usertipe');
		}else{
			$id_tipeuser = $this->db->get_where('tb_tipeuser',['id_tipeuser' => intval($this->input->post('usertipe')) ] )->row()->tipeuser;
		}
		// $kode = 'TR'.date("Ymd").''.getRandomString(5);
		// if($this->M_Transaksi->cekKodeTransaksi($kode)){
		$data = array(
			'tipeuser' => $id_tipeuser,
			'id_jenistransaksi ' => $this->input->post('id_jenistransaksi', true),
			'kodetransaksi' => $this->input->post('kode_transaksi', true),
			'keterangan' => $this->input->post('keterangan', true),
			'nominal' => preg_replace("/[^0-9]/", "", $this->input->post('nominal')),
			'id_user' => $this->session->userdata('id_user'),
			'tgl_update' => date("Y-m-d h:i:sa")
			// 'status' => 'aktif',
		);

		if( $id_tipeuser == 'administrator' ){
			$data['id_anggota'] = $id_customer;
			$data['id_siswa'] = null;
		}else if( $id_tipeuser == 'siswa' ){
			$data['id_siswa'] = $id_customer;
			$data['id_anggota'] = null;
		}
		$nominal = preg_replace("/[^0-9]/", "", $this->input->post('nominal'));
		$saldo = intval($this->input->post('sisasaldo'));
		$tipe = $this->input->post('tipeTransaksi');
		$sisasaldo = 0;
		if($tipe == 'debet'){
			$sisasaldo = $saldo - $nominal;
		}else if($tipe == 'kredit'){
			$sisasaldo = $saldo + $nominal;
		}		
		$ts = $this->db->get_where('tb_tipeuser',['id_tipeuser' => intval($this->input->post('usertipe')) ] )->row();				
		$id_transaksi = $id;
		$this->M_Transaksi->editTransaksi($data, $id);
		$this->session->set_flashdata('alert', '<div class="alert alert-success left-icon-alert" role="alert">
	                                            		<strong>Sukses!</strong> Berhasil mengubah Transaksi. 
	                                        		</div>');
		if($this->input->post('action') == 'cetak'){
			echo '<script>
					let myWindow;
					window.onload = function(){ 
						myWindow = window.open("'.base_url('transaksi/printOutTransaksi?id_transaksi='.$id_transaksi.'&tipe='.$ts->tipeuser.'&ss='.$sisasaldo).'") 						
						setTimeout(()=>{
							myWindow.close();
							window.location.href = "http://localhost/bmssekolah/transaksi/"
						},950) 						
					}
			  </script>';		
		}else if($this->input->post('action') == 'simpan'){
			redirect(base_url('transaksi/'));
		}					
		// redirect(base_url('transaksi/'));
	}

	public function detailTransaksi(){
		$tipe = $this->input->get('tipe');
		$id = $this->input->get('id');

		if($tipe == 'siswa'){
			// $this->db->where('id_siswa', intval($id));
			$query = $this->db->query('SELECT tb_transaksi.keterangan, tb_transaksi.nominal, tb_siswa.nis, tb_siswa.namasiswa, tb_siswa.id_kelas, tb_mastertransaksi.debet, tb_mastertransaksi.kredit, tb_mastertransaksi.deskripsi, DATE_FORMAT(tb_transaksi.tgl_update,"%d-%m-%Y %H:%m:%s") AS tgl_update FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_transaksi.id_siswa = '.intval($id).' AND tb_transaksi.status = "aktif"')->result();
			echo  json_encode($query);
			// echo 'siswa';
		}else if($tipe == 'staf'){
			$query = $this->db->query('SELECT tb_transaksi.keterangan, tb_transaksi.nominal, tb_staf.nopegawai, tb_staf.nama, tb_mastertransaksi.debet, tb_mastertransaksi.kredit, tb_mastertransaksi.deskripsi, DATE_FORMAT(tb_transaksi.tgl_update,"%d-%m-%Y %H:%m:%s") AS tgl_update FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_transaksi.id_anggota = '.intval($id).' AND tb_transaksi.status = "aktif"')->result();
			echo  json_encode($query);
			// echo 'staf';
		}else{
			echo 'salah';
		}	
		
	}

	public function getTransaksi(){
		echo json_encode($this->M_Transaksi->getTransaksiJurnal());
	}

	public function getHistoriTransaksiByRfid(){		
		$getNama = $this->input->get('id');
		$getTipe = $this->input->get('tipe');
		$tipe = $this->db->get_where('tb_tipeuser', ['id_tipeuser' => $getTipe])->row()->tipeuser;
		if(!empty($getNama) && !empty($getTipe)){
			if($tipe == 'siswa'){
				$nis = $this->db->get_where('tb_siswa',['rfid' => $getNama])->row()->nis;
				$data = $this->M_Transaksi->getTransaksiDetail($getTipe, $nis);
				// echo json_encode();
			}else{
				$data = [['kosong' => true]];
			}
		}else{
			// echo 'gak';
			$data = [['kosong' => true]];
		}	

		// echo $getNama;
		// echo $getTipe;
		// echo print_r($this->input->get());
		echo json_encode($data);
	}

	public function getSaldoSiswa($nis){
		$saldo = 0;
		$kredit = $this->db->query("SELECT tb_transaksi.nominal FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_siswa.nis = $nis AND tb_mastertransaksi.kredit = 'siswa'")->result_array(); 
		$debet = $this->db->query("SELECT tb_transaksi.nominal FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_siswa.nis = $nis AND tb_mastertransaksi.debet = 'siswa'")->result_array(); 
		foreach($kredit as $row){
			$saldo += $row['nominal'];
		}
		foreach($debet as $row){
			$saldo -= $row['nominal'];
		}
        echo $saldo;
	}

	public function getTransaksiStafByid($id_staf)
	{
		$saldo = 0;
		$kredit = $this->db->query("SELECT tb_transaksi.nominal FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_staf.id_staf = $id_staf AND tb_mastertransaksi.kredit = 'koperasi'")->result_array();
		$debet = $this->db->query("SELECT tb_transaksi.nominal FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_staf.id_staf = $id_staf AND tb_mastertransaksi.debet = 'koperasi'")->result_array();

		foreach($kredit as $row){
			$saldo += $row['nominal'];
		}
		foreach($debet as $row){
			$saldo -= $row['nominal'];
		}

        echo $saldo;
	}

}
