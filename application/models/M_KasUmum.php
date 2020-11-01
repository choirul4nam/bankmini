<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class M_KasUmum extends CI_Model
{
    function tglakhirbulan($thn, $bln)
    {
        $bulan[1] = '31';
        $bulan[2] = '28';
        $bulan[3] = '31';
        $bulan[4] = '30';
        $bulan[5] = '31';
        $bulan[6] = '30';
        $bulan[7] = '31';
        $bulan[8] = '31';
        $bulan[9] = '30';
        $bulan[10] = '31';
        $bulan[11] = '30';
        $bulan[12] = '31';
        if ($thn % 4 == 0) {
            $bulan[2] = '29';
        }

        return $bulan[$bln];
    }

    function saldo()
    {
        $blnini = intval(date('m'));
        $thnini = intval(date('Y'));
        $blnkmrin = intval(date('m', strtotime("-1 month")));
        $thnkmrin = intval(date('Y', strtotime("-1 year")));

        $datablnKMKEmarin = $this->db->query("SELECT SUM(nominal) AS kmkmrin FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $blnkmrin . " AND YEAR(tgltransaksi) = " . $thnini . " AND jenis = 'kas masuk' ")->row_array();
        $datablnKKKEmarin = $this->db->query("SELECT SUM(nominal) AS kkkmrin FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $blnkmrin . " AND YEAR(tgltransaksi) = " . $thnini . " AND jenis = 'kas keluar' ")->row_array();


        $datathnKMKEmarin = $this->db->query("SELECT SUM(nominal) AS kmkmrin FROM tb_historikas WHERE YEAR(tgltransaksi) = " . $thnkmrin . " AND jenis = 'kas masuk' ")->row_array();
        $datathnKKKEmarin = $this->db->query("SELECT SUM(nominal) AS kkkmrin FROM tb_historikas WHERE YEAR(tgltransaksi) = " . $thnkmrin . " AND jenis = 'kas keluar' ")->row_array();

        if ($blnini == 1) {
            $sldothnkmrin = $datathnKMKEmarin['kmkmrin'] - $datathnKKKEmarin['kkkmrin'];
            $saldoblnkmrin = 0 + $sldothnkmrin;
        } else {
            $saldoblnkmrin = $datablnKMKEmarin['kmkmrin'] - $datablnKKKEmarin['kkkmrin'];
        }

        $dHistori = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $blnini . " AND YEAR(tgltransaksi) = " . $thnini . " ORDER BY tgltransaksi ASC")->result_array();
        $i = 0;
        $dataPertama = "";
        foreach ($dHistori as $data) {
            $kodeKas = $data['kode_kas'];
            $this->db->where('kode_kas', $kodeKas);
            $this->db->update('tb_historikas', ['saldo' => 0]);
            $i++;
            $awal = $i;
            if ($awal == 1) {
                $dataPertama = $data['kode_kas'];
                $saldo =  $saldoblnkmrin + 0;
                $nominal = $data['nominal'];
                $hasil = $saldo + $nominal;
                $this->db->where('kode_kas', $kodeKas);
                $this->db->update('tb_historikas', ['saldo' => $hasil]);
            } else if ($awal > 1) {
                if ($awal == 2) {
                    $zz = $this->db->query("SELECT * FROM tb_historikas WHERE kode_kas = '$dataPertama'")->row_array();
                    $saldo = $zz['saldo'];

                    if ($data['jenis'] == 'kas masuk') {
                        $nominal = $data['nominal'];
                        $hasil = $saldo + $nominal;
                        $this->db->where('kode_kas', $data['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    } else if ($data['jenis'] == 'kas keluar') {
                        $nominal = $data['nominal'];
                        $hasil = $saldo - $nominal;
                        $this->db->where('kode_kas', $data['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    }
                } else if ($awal > 2) {
                    $tujuan = $awal + 1;
                    $zz = $this->db->query("SELECT * FROM tb_historikas  ORDER BY tgltransaksi LIMIT " . intval($awal - 2) . "," . intval($tujuan))->result_array();
                    $ii = 0;
                    foreach ($zz as $datazz) {
                        $ii++;
                        $awall = $ii;
                        if ($awall == 1) {
                            $saldo = $datazz['saldo'];
                        }
                    }
                    if ($data['jenis'] == 'kas masuk') {
                        $nominal = $data['nominal'];
                        $hasil = $saldo + $nominal;
                        $this->db->where('kode_kas', $data['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    } else if ($data['jenis'] == 'kas keluar') {
                        $nominal = $data['nominal'];
                        $hasil = $saldo - $nominal;
                        $this->db->where('kode_kas', $data['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    }
                }
            }
        }
    }

    public function dataBlnIni()
    {
      

        $dHistori = $this->db->query("SELECT * FROM tb_historikas ORDER BY tgltransaksi ASC")->result_array();
        $dataa = array();
        foreach ($dHistori as $data) {
            if ($data['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $data['kode_kas'] . "'")->row_array();
                array_push($dataa, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $data['saldo'],));
            } else if ($data['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $data['kode_kas'] . "'")->row_array();
                array_push($dataa, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $data['saldo']));
            }
        }
        return $dataa;
    }
}
