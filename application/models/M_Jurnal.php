<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class M_Jurnal extends CI_Model
{
    public function getJurnal(){
        return $this->db->query('SELECT * FROM `tb_jurnal` ORDER BY `tgl_update` DESC')->result_array();
    }

    public function getTransaksi(){
	    $querySiswa = $this->db->query('SELECT * FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_siswa ON tb_transaksi.id_siswa = tb_siswa.nis WHERE tb_transaksi.status = "aktif"')->result_array(); 
	    $queryStaf = $this->db->query('SELECT * FROM tb_transaksi JOIN tb_mastertransaksi ON tb_transaksi.id_jenistransaksi = tb_mastertransaksi.id_mastertransaksi JOIN tb_staf ON tb_transaksi.id_anggota = tb_staf.id_staf WHERE tb_transaksi.status = "aktif"')->result_array(); 
        $data = [];
        foreach($querySiswa as $row){
            $row['nama'] = '';
            array_push($data, $row);
        }
        foreach($queryStaf as $row){
            $row['namasiswa'] = '';
            array_push($data, $row);        
        }

        return $data;
    }

    public function insertJurnal($data){
        $this->db->insert('tb_jurnal', $data);        
    }

    public function updateTransaksi($id, $tipe){
        if($tipe == 'transaksi'){
            $this->db->where('id_transaksi', $id);
            $this->db->update('tb_transaksi', ['status_jurnal' => '1']);
        }else if($tipe == 'kk'){
            $this->db->where('id_kk', $id);
            $this->db->update('tb_kaskeluar', ['status_jurnal' => '1']);
        }else if($tipe == 'km'){
            $this->db->where('id_km', $id);
            $this->db->update('tb_kasmasuk', ['statusjurnal' => '1']);
        }       
    }
}
