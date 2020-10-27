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
}
