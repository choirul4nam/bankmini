<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=".$kelas->kelas."-".date('d-m-Y').".xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/bootstrap.min.css" media="screen" >
 <table class="table table-bordered" border="1">
    <thead>
        <tr>
            <th colspan="12">
                <center>
                    Data Siswa Kelas <?= $kelas->kelas; ?>
                </center>
            </th>
        </tr>
        <tr>
            <th colspan="12">
                <center>
                    SMA NEGERI 1 WRINGIN ANOM
                </center>
            </th>
        </tr>
        <tr>
            <th colspan="12">
            
            </th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th>No</th>
            <th>NIS</th>  
            <th>RFID</th>  
            <th>Nama Lengkap</th>  
            <th>Kelas</th>  
            <th>Jenis Kelamin</th>  
            <th>Tempat, Tanggal Lahir</th>  
            <th>Alamat Lengkap</th>  
            <th>Provinsi</th>  
            <th>Kota</th>  
            <th>Kecamatan</th>  
            <th>Status</th>                  
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach($data as $siswa): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $siswa['nis']; ?></td>
                <td><?= $siswa['rfid']; ?></td>
                <td><?= $siswa['namasiswa']; ?></td>
                <td><?= $this->db->get_where('tb_kelas', ['id_kelas' => $siswa['id_kelas']])->row()->kelas; ?></td>
                <td><?= $siswa['jk']; ?></td>
                <td><?php if(!empty($siswa['tempat_lahir']) && !empty($siswa['tgl_lahir'])){ echo $siswa['tempat_lahir'].', '.$siswa['tgl_lahir']; }else if(empty($siswa['tempat_lahir']) && empty($siswa['tgl_lahir'])){echo ''; }else{echo $siswa['tempat_lahir'].', '.$siswa['tgl_lahir'];} ?></td>
                <td><?= $siswa['alamat']; ?></td>
                <td><?php if(!empty($siswa['provinsi'])){echo $this->db->get_where('tb_provinsi',['id_provinsi' => $siswa['provinsi']])->row()->name_prov;} ?></td>
                <td><?php if(!empty($siswa['kota'])){echo $this->db->get_where('tb_kota',['id_kota' => $siswa['kota']])->row()->name_kota;} ?></td>
                <td><?php if(!empty($siswa['kecamatan'])){echo $this->db->get_where('tb_kecamatan', ['id_kecamatan' => $siswa['kecamatan']])->row()->kecamatan;} ?></td>                
                <td><?= $siswa['status']; ?></td>                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>