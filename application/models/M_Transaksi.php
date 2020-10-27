<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Transaksi extends CI_Model {

    public function getTransaksi(){
	    $querySiswa = $this->db->query('SELECT tb_transaksi.*, tb_siswa.namasiswa, tb_siswa.nis, tb_mastertransaksi.kategori FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_transaksi.status = "aktif" ORDER BY tb_transaksi.tgl_update DESC')->result_array(); 
	    $queryStaf = $this->db->query('SELECT tb_transaksi.*, tb_staf.nama, tb_staf.nopegawai, tb_mastertransaksi.kategori FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_transaksi.status = "aktif" ORDER BY tb_transaksi.tgl_update DESC')->result_array(); 
        $data = [];
        foreach($querySiswa as $row){
            $row['nama'] = '';
            $row['namaTransaksi'] = $row['namasiswa'];
            $row['noIden'] = $row['nis'];
            $row['type'] = 'siswa';
            array_push($data, $row);
        }
        foreach($queryStaf as $row){
            $row['namasiswa'] = '';
            $row['namaTransaksi'] = $row['nama'];
            $row['noIden'] = $row['nopegawai'];
            $row['type'] = 'staf';
            array_push($data, $row);        
        }

        return $data;
    }

    public function getTransaksiJurnal(){
	    $querySiswa = $this->db->query('SELECT * FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_transaksi.status = "aktif" AND tb_transaksi.status_jurnal = "0"')->result_array(); 
	    $queryStaf = $this->db->query('SELECT * FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_transaksi.status = "aktif" AND tb_transaksi.status_jurnal = "0"')->result_array(); 
        $data = [];
        foreach($querySiswa as $row){
            $row['nama'] = '';
            $row['namaTransaksi'] = $row['namasiswa'];
            $row['noIden'] = $row['nis'];
            $row['type'] = 'siswa';
            array_push($data, $row);
        }
        foreach($queryStaf as $row){
            $row['namasiswa'] = '';
            $row['namaTransaksi'] = $row['nama'];
            $row['noIden'] = $row['nopegawai'];
            $row['type'] = 'staf';
            array_push($data, $row);        
        }

        return $data;
    }

    public function getTransaksiDetail($tipe, $nama){        	    
        $data = [];    
        $dataUser = $this->db->get_where('tb_tipeuser', ['id_tipeuser' => $tipe])->row_array();
        if($dataUser['tipeuser'] == 'siswa'){
            $querySiswa = $this->db->query("SELECT tb_transaksi.*, tb_siswa.nis, tb_siswa.namasiswa, tb_siswa.id_kelas, tb_mastertransaksi.debet, tb_mastertransaksi.kredit, tb_mastertransaksi.deskripsi FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_siswa.nis = $nama")->result_array(); 
            foreach($querySiswa as $row){
                $date = date_create($row['tgl_update']);
                $row['tgl_update'] = date_format($date,"d-m-Y H:i:s");
                $row['nama'] = '';
                $row['namaTransaksi'] = $row['namasiswa'];
                $row['kosong'] = false;
                array_push($data, $row);
            }
        }else if($dataUser['tipeuser'] == 'staf'){
            $queryStaf = $this->db->query("SELECT tb_transaksi.*, tb_staf.nopegawai, tb_staf.nama, tb_mastertransaksi.debet, tb_mastertransaksi.kredit, tb_mastertransaksi.deskripsi FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_staf.id_staf = $nama")->result_array(); 
            foreach($queryStaf as $row){
                $date = date_create($row['tgl_update']);
                $row['tgl_update'] = date_format($date,"d-m-Y H:i:s");
                $row['namasiswa'] = '';
                $row['namaTransaksi'] = $row['nama'];
                $row['kosong'] = false;
                array_push($data, $row);        
            }
        }

        return $data;
    }

    // public function cekKodeTransaksi($kode){
    //     $this->db->where('kodetransaksi', $kode);   
    //     $query = $this->db->get('tb_mastertransaksi'); 
    //     if($query->num_rows() === 1){
    //         return false;
    //     }else{
    //         return true;
    //     }
    // }    

    public function addTransaksi($data){
        $this->db->insert('tb_transaksi', $data);
        return $this->db->insert_id();
    }

    public function deleteTransaksi($id){
        $data = ['status' => 'tidak aktif'];
    	$this->db->where('id_transaksi', $id);
    	$this->db->update('tb_transaksi', $data);
    }

    // public function detailTransaksi($id){
    //     $this->db->where('id_mastertransaksi', $id);   
    //     return $this->db->get('tb_mastertransaksi')->row(); 
    // }   

    public function editTransaksi($data, $id){
    	$this->db->where('id_transaksi', $id);
        $this->db->update('tb_transaksi', $data);
    }
}