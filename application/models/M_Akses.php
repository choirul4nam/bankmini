<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class M_Akses extends CI_Model
{
    function getByLinkSubMenu($idsubmenu, $idtipeuser)
    {
        $submenu = $this->db->get_where('tb_submenu', ['linksubmenu' => $idsubmenu . '/'])->row_array();
        return $this->db->get_where('tb_akses', ['id_submenu' => $submenu['id_submenu'], 'id_tipeuser' => $idtipeuser])->row_array();
    }
}
