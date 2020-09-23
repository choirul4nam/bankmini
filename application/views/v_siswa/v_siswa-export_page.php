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
            <th colspan="11">
                <center>
                    Data Siswa Kelas <?= $kelas->kelas; ?>
                </center>
            </th>
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
                <td><?= $siswa['kelas']; ?></td>
                <td><?= $siswa['jk']; ?></td>
                <td><?= $siswa['tempat_lahir'].', '.$siswa['tgl_lahir']; ?></td>
                <td><?= $siswa['alamat']; ?></td>
                <td><?= $siswa['name_prov']; ?></td>
                <td><?= $siswa['name_kota']; ?></td>
                <td><?= $siswa['kecamatan']; ?></td>                
                <td><?= $siswa['status']; ?></td>                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>