<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Setting extends CI_Model {
    function getmenu1(){
        $this->db->order_by('id_menu', 'ASC');
        $query = $this->db->get('tb_menu');
        return $query->result();
    }
}