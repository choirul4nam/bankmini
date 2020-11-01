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
        $this->M_KasUmum->saldo();
        $id = $this->session->userdata('tipeuser');
        $data['menu'] = $this->M_Setting->getmenu1($id);
        $data['activeMenu'] = $this->db->get_where('tb_submenu', ['submenu' => 'kas masuk'])->row()->id_menus;


        $data['recap'] = $this->M_KasUmum->dataBlnIni();

        
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
        $sa = $dbet['nominal'] - $kreddi['nominal'];

        if ($dbet['nominal'] != 0) {
            $dbett = $dbet['nominal'];
        }
        if ($kreddi['nominal'] != 0) {
            $kr = $kreddi['nominal'];
        }


        $data = [
            'dbet' => $dbett,
            'krdi' => $kr,
            'sldo' => $sa
        ];

        echo json_encode($data);
    }

    public function hariini()
    {
        //sldo awal
        $hariini = date('Y-m-d');
        // $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND tgltransaksi != '$hariini' ")->row_array();
        // $kreddii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND tgltransaksi != '$hariini'")->row_array();

        // $sldoawal = $dbett['nominal'] - $kreddii['nominal'];

        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND tgltransaksi = '$hariini' ")->row_array();
        $kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND tgltransaksi = '$hariini'")->row_array();

        $dbt = 0 + $dbet['nominal'];
        $krd = 0 + $kreddi['nominal'];
        $sldoo = $dbt - $krd;
        $a = [$dbt, $krd, $sldoo];
        //isi
        $hari = date("Y-m-d");
        $datahariini = $this->db->query("SELECT * FROM tb_historikas WHERE tgltransaksi = '" . $hari . "'")->result_array();
        $data = array();
        foreach ($datahariini as $datahistoo) {
            if ($datahistoo['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $datahistoo['saldo']));
            } else if ($datahistoo['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $datahistoo['saldo']));
            }
        }
        $dataaa = [
            'data1' => $data,
            'data2' => $a
        ];
        echo json_encode($dataaa);
    }
    public function bulaniniBy($id, $akhir, $awal)
    {
        $thnini = intval(date('Y'));
        $blnini = intval(date('m'));

        //sldo bkn thn ini
        $dbettt = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();
        $krediii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();
        $sldobknthnini = $dbettt['nominal'] - $krediii['nominal'];

        //sldo thn ini bkuan bln ini
        $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) != " . date('m'))->row_array();
        $kredii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) != " . date('m'))->row_array();
        $sldothninibknblnini = $dbett['nominal'] - $kredii['nominal'];

        //sldo bln ini thn ini
        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) = " . date('m') . " AND DAY(tgltransaksi) >= $awal AND  DAY(tgltransaksi) <= $akhir")->row_array();
        $kredi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) = " . date('m') . " AND DAY(tgltransaksi) >= $awal AND  DAY(tgltransaksi) <= $akhir")->row_array();
        $sldblnini = $dbet['nominal'] - $kredi['nominal'];

        $sldoawal = $sldobknthnini + $sldothninibknblnini;
        $dbt = $sldoawal + $dbet['nominal'];
        $krd = $kredi['nominal'];
        $sdo = $sldoawal + $sldblnini;

        $a = [$sldoawal, $dbt, $krd, $sdo];

        //dta bln ini
        $datablnini = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $blnini . " AND DAY(tgltransaksi) = " . $id . " AND YEAR(tgltransaksi) = " . $thnini . " ORDER BY tgltransaksi ASC")->result_array();
        $data = array();
        foreach ($datablnini as $datahistoo) {
            if ($datahistoo['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $datahistoo['saldo']));
            } else if ($datahistoo['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $datahistoo['saldo']));
            }
        }

        $dataa = [
            'data1' => $data,
            'data2' => $a
        ];
        echo json_encode($dataa);
    }

    public function blnini()
    {
        $thnini = intval(date('Y'));
        $blnini = intval(date('m'));


        //sldo bkn thn ini
        $dbettt = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();
        $krediii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();
        $sldobknthnini = $dbettt['nominal'] - $krediii['nominal'];

        //sldo thn ini bkuan bln ini
        $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) != " . date('m'))->row_array();
        $kredii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) != " . date('m'))->row_array();
        $sldothninibknblnini = $dbett['nominal'] - $kredii['nominal'];

        //sldo bln ini thn ini
        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) = " . date('m'))->row_array();
        $kredi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) = " . date('Y') . " AND MONTH(tgltransaksi) = " . date('m'))->row_array();
        $sldblnini = $dbet['nominal'] - $kredi['nominal'];


        $sldoawal = $sldobknthnini + $sldothninibknblnini;
        $dbt = $sldoawal + $dbet['nominal'];
        // $dbt = $dbet['nominal'];
        $krd = 0+$kredi['nominal'];
        $sdo = $sldoawal + $sldblnini;

        $a = [$sldoawal,$dbt, $krd, $sdo];


        $datablnini = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $blnini . " AND YEAR(tgltransaksi) = " . $thnini)->result_array();
        
        $data = array();
        foreach ($datablnini as $datahistoo) {
            if ($datahistoo['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $datahistoo['saldo']));
            } else if ($datahistoo['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $datahistoo['saldo']));
            }
        }

        $dataa = [
            'data1' => $data,
            'data2' => $a
        ];
        echo json_encode($dataa);
    }
    public function thnini()
    {
        $thnini = intval(date('Y'));

        // sldobkn thn ini 
        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();
        $kredi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();


        //sldo thn ini
        $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) = " . date('Y'))->row_array();
        $kredii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) = " . date('Y'))->row_array();
        $sldoskrng = $dbett['nominal'] - $kredii['nominal'];

        $sldoawal = $dbet['nominal'] - $kredi['nominal'];
        $dbt = $sldoawal + $dbett['nominal'];
        // $dbt = $dbett['nominal'];
        $krdi = $kredii['nominal'];
        $sdo = $sldoawal + $sldoskrng;

        $a = [$sldoawal,$dbt, $krdi, $sdo];

        $datathnini = $this->db->query("SELECT * FROM tb_historikas WHERE YEAR(tgltransaksi) = " . $thnini . " ORDER BY tgltransaksi")->result_array();
        $data = array();
        foreach ($datathnini as $datahistoo) {
            if ($datahistoo['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $datahistoo['saldo']));
            } else if ($datahistoo['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $datahistoo['kode_kas'] . "'")->row_array();
                array_push($data, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $datahistoo['saldo']));
            }
        }
        $dataa = [
            'data1' => $data,
            'data2' => $a
        ];
        echo json_encode($dataa);
    }

    public function sldothniini()
    {

        $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();
        $kreddii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) != " . date('Y'))->row_array();

        $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND YEAR(tgltransaksi) = " . date('Y'))->row_array();
        $kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND YEAR(tgltransaksi) = " . date('Y'))->row_array();
        $saa = $dbett['nominal'] - $kreddii['nominal'];
        $sa = $dbet['nominal'] - $kreddi['nominal'];

        $data = [
            'dbt' => intval($dbet['nominal']),
            'krdi' => intval($kreddi['nominal']),
            'sldothnkmrin' => intval(($saa)),
            'sldothn' => intval($sa),
            'jumlah' => intval($saa + $sa)
        ];

        echo json_encode($data);
    }

    public function sldohriiini()
    {
        $hariini = date('Y-m-d');
        $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND tgltransaksi != '$hariini' ")->row_array();
        $kreddii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND tgltransaksi != '$hariini'")->row_array();


        $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND tgltransaksi = '$hariini' ")->row_array();
        $kreddii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND tgltransaksi = '$hariini'")->row_array();

        $saa =  $dbett['nominal'] - $kreddii['nominal'];
        $data = [
            'dbetkmarin' => $saa,
        ];

        echo json_encode($data);
    }

    // public function sldohriiini()
    // {

    //     $harini = date('Y-m-d');
    //     $dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND tgltransaksi != '$harini'")->row_array();
    //     $kreddii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND tgltransaksi != '$harini'")->row_array();

    //     $dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk'  AND tgltransaksi = '$harini'")->row_array();
    //     $kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND tgltransaksi = '$harini'")->row_array();

    //     $saa = $dbett['nominal'] - $kreddii['nominal'];
    //     $sa = $dbet['nominal'] - $kreddi['nominal'];

    //     $data = [
    //         'dbt' => intval($dbet['nominal']),
    //         'krdi' => intval($kreddi['nominal']),
    //         'sldothnkmrin' => intval(($saa)),
    //         'sldothn' => intval($sa),
    //         'jumlah' => intval($saa + $sa)
    //     ];

    //     echo json_encode($data);
    // }

    public function bnn($bln, $hri)
    {
        $thnini =  date('Y');
        $dHistori = $this->db->query("SELECT * FROM tb_historikas WHERE MONTH(tgltransaksi) = " . $bln . " AND DAY(tgltransaksi) = " . $hri . " AND YEAR(tgltransaksi) = " . $thnini . " ORDER BY tgltransaksi")->result_array();
        $dataa = array();
        foreach ($dHistori as $data) {
            if ($data['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $data['kode_kas'] . "'")->row_array();
                array_push($dataa, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $data['saldo']));
            } else if ($data['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $data['kode_kas'] . "'")->row_array();
                array_push($dataa, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $data['saldo']));
            }
        }
        
        echo json_encode($dataa);
    }

    public function bnnn($awal,$akhir)
    {

        //sldo != saat ini
        $dbett = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi < CAST('$awal' AS DATE)  AND jenis = 'kas masuk'")->row_array();
        $kreddii = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi < CAST('$awal' AS DATE)  AND jenis = 'kas keluar'")->row_array();
        

        //sldo saat ini
        $dbet = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi >= CAST('$awal' AS DATE) AND tgltransaksi <= CAST('$akhir' AS DATE)  AND jenis = 'kas masuk'")->row_array();
        $kreddi = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi >= CAST('$awal' AS DATE) AND tgltransaksi <= CAST('$akhir' AS DATE)  AND jenis = 'kas keluar'")->row_array();
        $sldosaatini = $dbet['nominal'] - $kreddi['nominal'];



        $sldoawal = $dbett['nominal'] - $kreddii['nominal'];
        $dbt = $sldoawal + $dbet['nominal'];
        // $dbt = $dbett['nominal'];
        $krdi = $kreddi['nominal'];
        $sdo = $sldoawal + $sldosaatini;

        $a = [$sldoawal, $dbt, $krdi, $sdo ];
        echo json_encode($a);

    }
    public function thnn($awal,$akhir)
    {

        //sldo != 
        $dbett = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi < CAST('$awal' AS DATE)  AND jenis = 'kas masuk'")->row_array();
        $kreddii = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi < CAST('$awal' AS DATE)  AND jenis = 'kas keluar'")->row_array();


        //sldo ==
        $dbet = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi >= CAST('$awal' AS DATE) AND tgltransaksi <= CAST('$akhir' AS DATE)  AND jenis = 'kas masuk'")->row_array();
        $kreddi = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_historikas WHERE tgltransaksi >= CAST('$awal' AS DATE) AND tgltransaksi <= CAST('$akhir' AS DATE)  AND jenis = 'kas keluar'")->row_array();
        $sldosaatini = $dbet['nominal'] - $kreddi['nominal'];



        $sldoawal = $dbett['nominal'] - $kreddii['nominal'];
        $dbt = $sldoawal + $dbet['nominal'];
        // $dbt = $dbett['nominal'];
        $krdi = 0+$kreddi['nominal'];
        $sdo = $sldoawal + $sldosaatini;

        $a = [$sldoawal, $dbt, $krdi, $sdo];

        $dHistori = $this->db->query("SELECT * FROM tb_historikas WHERE tgltransaksi >= CAST('$awal' AS DATE) AND tgltransaksi <= CAST('$akhir' AS DATE) ORDER BY tgltransaksi")->result_array();
        $dataa = array();
        foreach ($dHistori as $data) {
            if ($data['jenis'] == 'kas masuk') {
                $b = $this->db->query("SELECT * FROM tb_kasmasuk WHERE kode_kas_masuk ='" . $data['kode_kas'] . "'")->row_array();
                array_push($dataa, array($b['tgltransaksi'], $b['keterangan'], $b['nominal'], $b['kode_kas_masuk'], $data['saldo']));
            } else if ($data['jenis'] == 'kas keluar') {
                $d = $this->db->query("SELECT * FROM tb_kaskeluar WHERE kode_kas_keluar = '" . $data['kode_kas'] . "'")->row_array();
                array_push($dataa, array($d['tgltransaksi'], $d['keterangan'], $d['nominal'], $d['kode_kas_keluar'], $data['saldo']));
            }
        }

        $data = [
            'data1' => $dataa,
            'data2' => $a
        ];
        echo json_encode($data);
    }


    
}
