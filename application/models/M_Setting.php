<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Setting extends CI_Model {
    // function getmenu1(){
    //     $this->db->order_by('id_menu', 'ASC');
    //     $query = $this->db->get('tb_menu');
    //     return $query->result();
    // }

    function getmenu1($id){
        $this->db->distinct();
        $this->db->select('id_menu, menu, icon');
        $this->db->order_by('id_menu', 'ASC');
        $this->db->join('tb_submenu', 'tb_submenu.id_menus = tb_menu.id_menu');
        $this->db->join('tb_akses', 'tb_akses.id_submenu = tb_submenu.id_submenu');
        $where = array(
            'tb_akses.id_tipeuser' => $id, 'tb_akses.view' => '1'
        );
        $query = $this->db->get_where('tb_menu', $where);
        return $query->result();
    }
}