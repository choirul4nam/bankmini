<?php

 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=".$kelas."-".date('d-m-Y').".xls");
 
 ?>
 <table border="1">
    <tr>
    <th colspan="7">
            <center>
                Data Siswa Kelas <?= $kelas; ?>
            </center>
        </th>
    </tr>
    <tr>
        <th colspan="7">
            <center>
                SMA NEGERI 1 WRINGIN ANOM
            </center>
        </th>
    </tr>
    <tr>
        <th colspan="7">
        
        </th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>    
    </tr>
    <tr>
        <th>No</th>
        <th>NIS</th>  
        <th>Nama Lengkap</th>  
        <th>Jenis Kelamin</th>  
        <th>Kelas</th>  
        <th>Tempat,Tanggal Lahir</th>          
        <th>Alamat Lengkap</th>  

    </tr>    
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?= $kelas; ?></td>
        <td></td>
        <td></td>
    </tr>
</table>
