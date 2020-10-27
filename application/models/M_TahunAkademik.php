<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class M_TahunAkademik extends CI_Model
{
    function getAll()
    {
        $query = $this->db->query("SELECT * FROM tb_tahunakademik ORDER BY YEAR(tglawal), MONTH(tglawal), DAY(tglawal)
");
        return $query->result_array();
    }

    function getBYId($id_tahunakademik)
    {
        $query = $this->db->get_where('tb_tahunakademik', ['id_tahunakademik' => $id_tahunakademik]);
        return $query->row_array();
    }

    function hapus($id_tahunakademik)
    {
        $this->db->where('id_tahunakademik', $id_tahunakademik);
        $this->db->delete('tb_tahunakademik');
    }

    function tambah($data)
    {
        $this->db->insert('tb_tahunakademik', $data);
    }

    function ubah($id, $data)
    {
        $this->db->where('id_tahunakademik', $id);
        $this->db->update('tb_tahunakademik', $data);
    }
}
