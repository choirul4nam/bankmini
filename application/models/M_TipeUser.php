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

        $this->db->query("ALTER TABLE tb_tipeuser AUTO_INCREMENT 1");
    }

    function hapusakses($id_tipeuser)
    {
        $this->db->where('id_tipeuser', $id_tipeuser);
        $this->db->delete('tb_akses');
        
        $this->db->query("ALTER TABLE tb_akses AUTO_INCREMENT 1");
    }

    function getById($id_tipeuser)
    {
        $query = $this->db->get_where('tb_tipeuser', ['id_tipeuser' => $id_tipeuser])->row_array();
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
        $this->db->insert('tb_tipeuser', $data);    
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
        $this->db->where('id_tipeuser', $data['id_tipeuser']);
        $this->db->update('tb_tipeuser', ['tipeuser' => $data['tipeuser']]);
    }

    function cekData($tipeuser)
    {
        return $this->db->query("SELECT * FROM tb_tipeuser WHERE tipeuser ='" . $tipeuser . "'")->num_rows();
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
