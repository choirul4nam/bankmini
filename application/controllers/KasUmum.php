<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');


class KasUmum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('M_Setting');

        $this->load->model('M_KasUmum');

        cek_login_user();
    }
    public function index()
    {

        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas masuk'])->row()->id_menus;



        // $tglakhir = $this->M_KasUmum->tglakhirbulan(date('Y'), intval(date('m')));
        $data['recap'] =  array();
        $tgl = date('m');
        // $tglakhir = $this->M_KasUmum->tglakhirbulan(date('Y'), intval($tgl));
        $dataHisto = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $tgl . " AND YEAR(tgltransaksi) = " . date('Y') . " ORDER BY tgltransaksi ASC")->result_array();


        $kasmasuk = 0;
        $kaskeluar = 0;
        $saldo = 0;
        $i = 0;
        $hasil = 0;
        foreach ($dataHisto as $datahistoo) {
            $this->db->where('kode_kas', $datahistoo['kode_kas']);
            $this->db->update('tb_historikas', ['saldo' => 0]);
            $i++;
            $awal = $i;
            if ($awal == 1) {
                $saldo = 0;
                $kasmasuk = $datahistoo['nominal'];
                $hasil = intval($saldo) + intval($kasmasuk);
                $this->db->where('kode_kas', $datahistoo['kode_kas']);
                $this->db->update('tb_historikas', ['saldo' => $hasil]);
            } else if ($awal > 1) {

                if ($awal == 2) {
                    $zz = $this->db->query("SELECT * FROM tb_historikas  ORDER BY tgltransaksi  LIMIT 0 ,1")->row_array();
                    $saldo = $zz['saldo'];
                    if ($datahistoo['jenis'] == 'kas masuk') {
                        $kasmasuk = $datahistoo['nominal'];
                        $hasil = intval($saldo) + intval($kasmasuk);
                        $this->db->where('kode_kas', $datahistoo['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    } else if ($datahistoo['jenis'] == 'kas keluar') {
                        $kaskeluar = $datahistoo['nominal'];
                        $hasil = intval($saldo) - intval($kaskeluar);
                        $this->db->where('kode_kas', $datahistoo['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    }
                } else if ($awal != 2) {
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

                    // var_dump($saldo);
                    if ($datahistoo['jenis'] == 'kas masuk') {
                        $kasmasuk = $datahistoo['nominal'];
                        $hasil = intval($saldo) + intval($kasmasuk);
                        $this->db->where('kode_kas', $datahistoo['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    } else if ($datahistoo['jenis'] == 'kas keluar') {
                        $kaskeluar = $datahistoo['nominal'];
                        $hasil = intval($saldo) - intval($kaskeluar);
                        $this->db->where('kode_kas', $datahistoo['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    }
                }
                // var_dump($saldo);
            }
            // print_r($hasil);
            // var_dump($hasil);
            if ($datahistoo['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data['recap'], array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $hasil));
            } else if ($datahistoo['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data['recap'], array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $hasil));
            }
        }

        // print_r($data['recap']);

        // $dataHisto = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . intval(date('m')) . " ORDER BY tgltransaksi")->result_array();

        // foreach ($dataHisto as $datahistoo) {
        //     if ($datahistoo['jenis'] == 'kas masuk') {
        //         $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $datahistoo['kode_kas'] . "'")->row_array();
        //         array_push($data['recap'], array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $datahistoo['saldo']));
        //     } else if ($datahistoo['jenis'] == 'kas keluar') {
        //         $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $datahistoo['kode_kas'] . "'")->row_array();
        //         array_push($data['recap'], array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $datahistoo['saldo']));
        //     }
        // }



        // for ($i = 1; $i <= intVal($tglakhir); $i++) {
        //     $a = $this->db->query("SELECT * FROM tb_kasmasuk WHERE MONTH(tgltransaksi) = " . intval(date('m')) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->num_rows();
        //     if ($a != 0) {
        //         $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE MONTH(tgltransaksi) = " . intval(date('m')) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->row_array();

        //         array_push($data['recap'], array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk']));
        //     }
        // }
        // for ($i = 1; $i < intVal($tglakhir); $i++) {
        //     $c = $this->db->query("SELECT * FROM tb_kaskeluar WHERE MONTH(tgltransaksi) = " . intval(date('m')) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->num_rows();
        //     if ($c != 0) {
        //         $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE MONTH(tgltransaksi) = " . intval(date('m')) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->row_array();

        //         array_push($data['recap'], array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar']));
        //     }
        // }

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('v_kasumum/v_kasumum', $data);
        $this->load->view('template/footer');
    }
    public function recapKas($tgl)
    {

        // $tglakhir = $this->M_KasUmum->tglakhirbulan(date('Y'), intval($tgl));
        $dataHisto = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $tgl . " AND YEAR(tgltransaksi) = " . date('Y') . " ORDER BY tgltransaksi")->result_array();
        $data =  array();
        $j = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $tgl . " AND YEAR(tgltransaksi) = " . date('Y') . " ORDER BY tgltransaksi")->num_rows();

        $kasmasuk = 0;
        $kaskeluar = 0;
        $saldo = 0;
        $i = 0;
        $hasil = 0;
        foreach ($dataHisto as $datahistoo) {
            $this->db->where('kode_kas', $datahistoo['kode_kas']);
            $this->db->update('tb_historikas', ['saldo' => 0]);
            $i++;
            $awal = $i;
            if ($awal == 1) {
                $saldo = 0;
                $kasmasuk = $datahistoo['nominal'];
                $hasil = intval($saldo) + intval($kasmasuk);
                $this->db->where('kode_kas', $datahistoo['kode_kas']);
                $this->db->update('tb_historikas', ['saldo' => $hasil]);
            } else if ($awal > 1) {

                if ($awal == 2) {
                    $zz = $this->db->query("SELECT * FROM tb_historikas  ORDER BY tgltransaksi  LIMIT 0 ,1")->row_array();
                    $saldo = $zz['saldo'];
                    if ($datahistoo['jenis'] == 'kas masuk') {
                        $kasmasuk = $datahistoo['nominal'];
                        $hasil = intval($saldo) + intval($kasmasuk);
                        $this->db->where('kode_kas', $datahistoo['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    } else if ($datahistoo['jenis'] == 'kas keluar') {
                        $kaskeluar = $datahistoo['nominal'];
                        $hasil = intval($saldo) - intval($kaskeluar);
                        $this->db->where('kode_kas', $datahistoo['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    }
                } else if ($awal != 2) {
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

                    // var_dump($saldo);
                    if ($datahistoo['jenis'] == 'kas masuk') {
                        $kasmasuk = $datahistoo['nominal'];
                        $hasil = intval($saldo) + intval($kasmasuk);
                        $this->db->where('kode_kas', $datahistoo['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    } else if ($datahistoo['jenis'] == 'kas keluar') {
                        $kaskeluar = $datahistoo['nominal'];
                        $hasil = intval($saldo) - intval($kaskeluar);
                        $this->db->where('kode_kas', $datahistoo['kode_kas']);
                        $this->db->update('tb_historikas', ['saldo' => $hasil]);
                    }
                }
                // var_dump($saldo);
            }

            // var_dump($hasil);
            if ($datahistoo['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $hasil));
            } else if ($datahistoo['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $hasil));
            }
        }

        // for ($i = 1; $i <= intVal($tglakhir); $i++) {
        //     $a = $this->db->query("SELECT * FROM tb_kasmasuk WHERE MONTH(tgltransaksi) = " . intval($tgl) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->num_rows();
        //     if ($a != 0) {

        //         $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE MONTH(tgltransaksi) = " . intval($tgl) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->row_array();

        //         array_push($data, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk']));
        //     }
        // }
        // for ($i = 1; $i < intVal($tglakhir); $i++) {
        //     $c = $this->db->query("SELECT * FROM tb_kaskeluar WHERE MONTH(tgltransaksi) = " . intval($tgl) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->num_rows();
        //     if ($c != 0) {
        //         $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE MONTH(tgltransaksi) = " . intval($tgl) . " AND DAY(tgltransaksi) = $i ORDER BY tgltransaksi ASC")->row_array();

        //         array_push($data, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar']));
        //     }
        // }
        echo json_encode($data);
    }
    public function saldoo($month)
    {
        $aaa = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . intval($month) . " ORDER BY id_histori_kas DESC LIMIT 1")->row_array();
        echo json_encode($aaa);
    }
    public function dkkkk($month)
    {
        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND MONTH(tgltransaksi) = " . intval($month) . " ")->row_array();
        $kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND MONTH(tgltransaksi) = " . intval($month) . "")->row_array();

        $dbett = 0;
        $kr = 0;
        $sa = intval($dbet['nominal']) - intval($kreddi['nominal']);

        if ($dbet['nominal'] != 0) {
            $dbett = $dbet['nominal'];
        }
        if ($kreddi['nominal'] != 0) {
            $kr = $kreddi['nominal'];
        }


        $data = [
            'dbet' => intval($dbett),
            'krdi' => intval($kr),
            'sldo' => intval($sa)
        ];

        echo json_encode($data);
    }
}
