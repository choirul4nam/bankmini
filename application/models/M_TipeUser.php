<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class M_TipeUser extends CI_Model
{
    function getAll()
    {
        $query = $this->db->get('tb_userlevel');
        return $query->result_array();
    }

    function hapus($id_tipeuser)
    {
        $this->db->where('id', $id_tipeuser);
        $this->db->delete('tb_userlevel');

        $data = $this->db->query("SELECT * FROM tb_userlevel")->num_rows();
        if($data == 0) {
        $this->db->query("ALTER TABLE tb_userlevel AUTO_INCREMENT 1");
        }
    }

    function hapusakses($id_tipeuser)
    {
        $this->db->where('id_tipeuser', $id_tipeuser);
        $this->db->delete('tb_akses');

        $data = $this->db->query("SELECT * FROM tb_akses")->num_rows();
        if ($data == 0) {
            $this->db->query("ALTER TABLE tb_akses AUTO_INCREMENT 1");
        }
    }

    function getById($id_tipeuser)
    {
        $query = $this->db->get_where('tb_userlevel', ['id' => $id_tipeuser])->row_array();
        return $query;
    }

    function getakses($id_tipeuser)
    {

        $this->db->join('tb_submenu', 'tb_submenu.id_submenu = tb_akses.id_submenu');  
        $query = $this->db->get_where('tb_akses', ['id_tipeuser' => $id_tipeuser])->result_array();
        return $query;
    }

    function tambah($data)
    {
        $this->db->insert('tb_userlevel', $data);    
    }

     function cekkodetipeuser(){
        $this->db->select_max('id_tipeuser');
        $iduser = $this->db->get('tb_tipeuser');
        return $iduser->row();
    }

     function tambahakses($id){
        $total = $this->db->count_all_results('tb_submenu');

        for($i=0; $i<$total; $i++){
            $fungsi = array('id_submenu' => $i+1 , 
                'id_tipeuser' => $id);

            $this->db->insert('tb_akses', $fungsi);            
        }
    }


    function ubah($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tb_userlevel', ['userlevel' => $data['userlevel']]);
    }

    function cekData($tipeuser)
    {
        return $this->db->query("SELECT * FROM tb_userlevel WHERE userlevel ='" . $tipeuser . "'")->num_rows();
    }

    function refresh($iduser){
        $user = array(
            'view' => '0',
            'add' => '0',
            'edit' => '0',
            'delete' => '0'
        );

        $where = array(
            'id_tipeuser' =>  $iduser
        );

        $this->db->where($where);                                                            
        $this->db->update('tb_akses',$user);       
    }

    function editv($iduser,$submenu,$view){
            $where = array(
                'id_tipeuser' =>  $iduser,
                'id_submenu' => $view
            );

            $view = array(
                'view' =>  '1'
            );

            $this->db->where($where);
            $this->db->update('tb_akses',$view);         
        }

    function edita($iduser,$submenu,$add){
        $where = array(
            'id_tipeuser' =>  $iduser,
            'id_submenu' => $add
        );

        $add = array(
            'add' =>  '1'
        );

        $this->db->where($where);
        $this->db->update('tb_akses',$add);         
    }

    function edite($iduser,$submenu,$edit){
        $where = array(
            'id_tipeuser' =>  $iduser,
            'id_submenu' => $edit
        );

        $edit = array(
            'edit' =>  '1'
        );

        $this->db->where($where);
        $this->db->update('tb_akses',$edit);         
    }


    function editd($iduser,$submenu,$delete){
        $where = array(
            'id_tipeuser' =>  $iduser,
            'id_submenu' => $delete
        );

        $delete = array(
            'delete' =>  '1'
        );

        $this->db->where($where);
        $this->db->update('tb_akses',$delete);         
    }
}
