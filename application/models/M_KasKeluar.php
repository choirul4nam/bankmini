<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class M_Kaskeluar extends CI_Model
{
    function getAll()
    {
        $query = $this->db->get('tb_kaskeluar');
        return $query->result_array();
    }
    function getById($kode)
    {
        return $this->db->get_where('tb_kaskeluar', ['kode_kas_keluar' => $kode])->row_array();
    }
    function kodekaskeluar()
    {

        $awal = 'KK';
        $hariini = date('dmY');
        $tglawal = '01';
        $kasklrfirst = $this->db->query('SELECT * FROM tb_kaskeluar')->num_rows();

        if (date('d') == $tglawal || $kasklrfirst == 0) {
            $angka = "0001";
            $kaskeluarretrunone = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar ='" . $awal . $hariini . "0001'")->num_rows();
            if ($kaskeluarretrunone >= 1) {
                $dataterbaru = $this->db->query("SELECT * FROM tb_kaskeluar ORDER BY kode_kas_keluar DESC LIMIT 1")->row_array();
                $kode = $dataterbaru['kode_kas_keluar'];
                $subKal = intval(substr($kode, 10));
                if ($subKal < 9) {
                    $angka = "000" . $subKal += 1;
                } else if ($subKal >= 9 && $subKal < 99) {
                    $angka = "00" . $subKal += 1;
                } else if ($subKal >= 99 && $subKal < 999) {
                    $angka = "0" . $subKal += 1;
                } else {
                    $angka = $subKal += 1;
                }
            }
        } else {
            $dataterbaru = $this->db->query("SELECT * FROM tb_kaskeluar ORDER BY kode_kas_keluar DESC LIMIT 1")->row_array();
            $kode = $dataterbaru['kode_kas_keluar'];
            $subKal = intval(substr($kode, 10));
            if ($subKal < 9) {
                $angka = "000" . $subKal += 1;
            } else if ($subKal >= 9 && $subKal < 99) {
                $angka = "00" . $subKal += 1;
            } else if ($subKal >= 99 && $subKal < 999) {
                $angka = "0" . $subKal += 1;
            } else {
                $angka = $subKal += 1;
            }
        }
        return $awal . $hariini . $angka;
    }
    function tambah($data)
    {
        $this->db->insert('tb_kaskeluar', $data);
    }
    function tambahHisto($data)
    {
        $this->db->insert('tb_historikas', $data);
    }
    function hapus($kode)
    {
        $this->db->where('kode_kas_keluar', $kode);
        $this->db->delete('tb_kaskeluar');
    }
    function ubah($data, $kode)
    {
        $this->db->where('kode_kas_keluar', $kode);
        $this->db->update('tb_kaskeluar', $data);
    }
    function ubahHisto($data, $kode)
    {
        $this->db->where('kode_kas', $kode);
        $this->db->update('tb_historikas', $data);
    }
}
