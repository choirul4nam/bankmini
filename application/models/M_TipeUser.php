<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class M_TipeUser extends CI_Model
{
    function getAll()
    {
        $query = $this->db->get('tb_tipeuser');
        return $query->result_array();
    }

    function hapus($id_tipeuser)
    {
        $this->db->where('id_tipeuser', $id_tipeuser);
        $this->db->delete('tb_tipeuser');
    }

    function getById($id_tipeuser)
    {
        $query = $this->db->get_where('tb_tipeuser', ['id_tipeuser' => $id_tipeuser])->row_array();
        return $query;
    }

    function tambah($data)
    {
        $this->db->insert('tb_tipeuser', $data);
    }

    function ubah($data)
    {
        $this->db->where('id_tipeuser', $data['id_tipeuser']);
        $this->db->update('tb_tipeuser', ['tipeuser' => $data['tipeuser']]);
    }

    function cekData($tipeuser)
    {
        return $this->db->query("SELECT * FROM tb_tipeuser WHERE tipeuser ='" . $tipeuser . "'")->num_rows();
    }
}
