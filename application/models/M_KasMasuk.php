<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class M_KasMasuk extends CI_Model
{
    function getAll()
    {
        $query = $this->db->query("SELECT * FROM tb_kasmasuk ORDER BY tgltransaksi ASC");
        return $query->result_array();
    }

    function getById($kode)
    {
        return $this->db->get_where('tb_kasmasuk', ['kode_kas_masuk' => $kode])->row_array();
    }

    function kasMasuk()
    {
        $awal = 'KM';
        $hariini = date('dmY');
        $tglawal = '01';
        $kasmsukfirst = $this->db->query('SELECT * FROM tb_kasmasuk')->num_rows();

        if (date('d') == $tglawal || $kasmsukfirst == 0) {
            $angka = "0001";
            $kasmasukretrunone = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $awal . $hariini . "0001'")->num_rows();
            if ($kasmasukretrunone >= 1) {
                $dataterbaru = $this->db->query("SELECT * FROM tb_kasmasuk ORDER BY kode_kas_masuk DESC LIMIT 1")->row_array();
                $kode = $dataterbaru['kode_kas_masuk'];
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
            $dataterbaru = $this->db->query("SELECT * FROM tb_kasmasuk ORDER BY kode_kas_masuk DESC LIMIT 1")->row_array();
            $kode = $dataterbaru['kode_kas_masuk'];
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
        $this->db->insert('tb_kasmasuk', $data);
    }
    function tambahHisto($data)
    {
        $this->db->insert('tb_historikas', $data);
    }

    function hapus($kode)
    {
        $this->db->where('kode_kas_masuk', $kode);
        $this->db->delete('tb_kasmasuk');
    }
    function ubah($data, $kode)
    {
        $this->db->where('kode_kas_masuk', $kode);
        $this->db->update('tb_kasmasuk', $data);
    }
}
