<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class M_MasterCOA extends CI_Model
{
    function getAll()
    {           
        $this->db->order_by('tglupdate', 'DESC');
        $query = $this->db->get('tb_mastercoa');
        return $query->result_array();
    }

    function tambah($data)
    {
        $this->db->insert('tb_mastercoa', $data);
    }

    function hapus($id)
    {
        $this->db->where('id_coa', $id);
        $this->db->delete('tb_mastercoa');
    }

    function getById($id_coa)
    {
        return $this->db->get_where('tb_mastercoa', ['id_coa' => $id_coa])->row_array();
    }
    function ubah($data, $id_coa)
    {
        $this->db->where('id_coa', $id_coa);
        $this->db->update('tb_mastercoa', $data);
    }
}
