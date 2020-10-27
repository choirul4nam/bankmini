<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SIBMS (Sistem Informasi Bank Mini Sekolah)</title>

        <link rel="shortcut icon" href="<?php echo base_url() ?>assets/Favicon/favicon.ico">
        <!-- ========== COMMON STYLES ========== -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/animate-css/animate.min.css" media="screen" >

        <!-- ========== PAGE STYLES ========== -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->

        <!-- ========== THEME CSS ========== -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/Theme/css/main.css" media="screen" >

        <!-- ========== MODERNIZR ========== -->
        <script src="<?php echo base_url() ?>assets/Theme/js/modernizr/modernizr.min.js"></script>
        <script>
            let dataNull = false;
        </script>
        <style>
            @media only screen and (min-width: 768px){                
                .srhBox {
                    margin-left: 0px;
                }
                .dataBox {
                    margin-left: 0px;
                }                
            }
            @media only screen and (min-width: 992px){                
                .srhBox {
                    margin-left: 220px;
                }
                .dataBox {
                    margin-left: 0px;
                }
            }
            @media only screen and  (min-width: 1000px){                
                .srhBox {
                    margin-left: 382px;
                }
                .dataBox {
                    margin-left: 4px;
                }
            }
            @media only screen and  (min-width: 1200px){                
                .srhBox {
                    margin-left: 382px;
                }
                .dataBox {
                    margin-left: 215px;
                }
            }
        </style>
    </head>
    <body>
        <div class="main-wrapper">
           <div class="container-fluid">
                <div class="row">                
                    <div class="col-lg-5 col-md-7 col-sm-12 srhBox">
                        <div class="panel mt-50">
                            <div class="panel-heading">
                                <div class="panel-title text-center" style="padding-left: 0px;">
                                    <h4>HALAMAN SISWA</h4>
                                    <p><strong>SIMBMS (Sistem Informasi Bank Mini Sekolah)</strong></p>
                                    <img src="<?= base_url()?>assets/logo.png" style="width: 40%; height: 179px;">
                                </div>
                            </div>
                            <div class="panel-body p-20">                                                                  
                                <input placeholder="Masukkan NIS / Kartu Pelajar anda" class="form-control" type="text" id="nis" style="height: 36px;" maxlength="10" minlength="4" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'>                            
                                <div id="show">
                                    <br>
                                    <p class="text-muted text-center"><small>Development By &copy; 2020 <a href="https://hosterweb.co.id">HOSTERWEB INDONESIA</a></small></p>                          
                                </div>
                            </div>
                        </div>
                    </div>              
                </div>
                <div class="row" id="hide" style="display: none;">
                    <div class="col-lg-8 col-md-12 col-sm-12 dataBox">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="container-fluid dataNotNull" style="display: none;">
                                    <div class="row">
                                        <div class="col-lg-10 col-md-10 col-sm-12" style="margin-left: 130px; margin-top: 25px;">
                                            <table width="100%">
                                                <tr>
                                                    <td rowspan="4" width="300px">
                                                        <div class="panel border-primary no-border border-3-top" style="width: 100%; height: 135px;padding: 0px;margin-bottom: 0px;">
                                                            <div class="panel-body" style="padding: 0px;">
                                                                <center>
                                                                    <img src="<?= base_url('')?>assets/avatar.png" alt="avatar" style="width: 63%;height: 119px;margin-top: 11px;">                                                                                                                                                        
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>                                                    
                                                    <td width="35px">Nama</td>
                                                    <td width="600px" id="siswaNama"></td>
                                                </tr>
                                                <tr>                                                    
                                                    <td width="35px">NIS </td>
                                                    <td width="150px" id="siswaNis"></td>
                                                </tr>
                                                <tr>                                                    
                                                    <td width="35px">Kelas </td>
                                                    <td width="150px" id="siswaKelas"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>                                   
                                </div>
                            </div>
                            <div class="panel-body p-20">                                                                  
                                <div class="container-fluid dataNotNull" style="displat: none'">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="pull-right">
                                                <table class="bg-primary">
                                                    <tr style="font-size: 25px;">
                                                        <td>Sisa Saldo</td>
                                                        <td>:</td>
                                                        <td id="saldoSiswa">Rp. <?= number_format(0); ?></td>
                                                    </tr>
                                                </table>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">                                            
                                            <table id="dataTableSiswa" class="table" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 43px;">No</th>
                                                        <th style="width: 145px;">Tanggal Transaksi</th>
                                                        <th >Keterangan</th>
                                                        <th>Debet</th>
                                                        <th>Kredit</th>
                                                        <th>Saldo</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableBP">
                                                    
                                                </tbody>
                                                <tfoot class="tfoot">
                                                
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid dataNull" style="display: none;">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <center>
                                                <h4 id="pesan"></h4>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <p class="text-muted text-center"><small>Development By &copy; 2020 <a href="https://hosterweb.co.id">HOSTERWEB INDONESIA</a></small></p>                          
                            </div>
                        </div>
                    </div>              
                </div>                
           </div>
        </div>        

        <!-- ========== COMMON JS FILES ========== -->
        <script src="<?php echo base_url() ?>assets/Theme/js/jquery/jquery-2.2.4.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/jquery-ui/jquery-ui.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/bootstrap/bootstrap.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/pace/pace.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/lobipanel/lobipanel.min.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/iscroll/iscroll.js">j</script>
        <script src="<?php echo base_url() ?>assets/Theme/js/DataTables/DataTables-1.10.13/js/jquery.dataTables.js"></script> 
        <script src="<?php echo base_url() ?>assets/Theme/js/DataTables/DataTables-1.10.13/js/dataTables.bootstrap.js"></script> 
        <script src="<?php echo base_url() ?>assets/Theme/js/main.js"></script>
        <script src="<?php echo base_url() ?>assets/Theme/js/script.js"></script>
        <script>
            let menit
            $(function(){
                $('#dataTableSiswa').DataTable({
                    "scrollY": "170px",
                    "scrollX": true,            
                    "scrollCollapse": true, 
                    "searching": false, 
                    "paging": false,
                    "info" : false, 
                    "sort" : false          
                });
                // $('#hide').hide()
                // $('.dataNotNull').hide()
                // $('.dataNull').hide()
                $('.dataTables_scrollHeadInner').css('width', '100%')
                $('#nis').keyup(function(){
                    if($(this).val().length == 4){                       
                        setTimeout(()=>{
                            // $(this).blur()
                            $.get('http://localhost/bmssekolah/dashboardsiswa/getSiswaDetail/'+$(this).val(), function(hasil){
                                if(hasil != 'null'){
                                    $('.table').css('width', '100%')
                                    setTimeout(()=>{
                                        $('#hide').hide()
                                        $('.dataNotNull').hide()
                                        $('.dataNull').hide()
                                        $('#siswaNama').html('')
                                        $('#siswaNis').html('')
                                        $('#siswaKelas').html('')                                    
                                        $('#siswaNama').html('')
                                        $('#siswaNis').html('')
                                        $('#siswaKelas').html('')                                        
                                        $('#pesan').html('')                                        
                                        $('#nis').val('')                                        
                                    },90000)
                                    let data = JSON.parse(hasil)
                                    // console.log(data)
                                    $('.dataNotNull').show()                                    
                                    $('#hide').show()
                                    $('#show').hide()
                                    $('#siswaNama').html(': '+data.namasiswa)
                                    $('#siswaNis').html(': '+data.nis)
                                    $('#siswaKelas').html(': '+data.kelas)
                                    $.get('http://localhost/bmssekolah/dashboardsiswa/getSaldoSiswa/'+data.nis, function(res){
                                        $('#saldoSiswa').html( formatRupiah(res, "Rp. ") )                
                                    })        
                                    $.get('http://localhost/bmssekolah/dashboardsiswa/detailTransaksi?id='+data.nis+'&tipe=siswa', function (result) {
                                        let transaksi = JSON.parse(result)
                                        // console.log(transaksi)
                                        $('#tableBP').html('')
                                        if(transaksi.length != 0){
                                            let saldo = 0;
                                            let no = 1;
                                            let koperasiK = '';
                                            let koperasiD = '';
                                            let saldoView = 0;
                                            transaksi.forEach(function(res){                        
                                                if('siswa' == res.kredit){
                                                    saldo = parseInt(saldo) + parseInt(res.nominal)
                                                }else if('siswa' == res.debet){
                                                    saldo = parseInt(saldo) - parseInt(res.nominal)
                                                }
                                                if(res.tipeuser == res.debet){
                                                    saldoView = saldoView - parseInt(res.nominal)
                                                    $('#tableBP').append('<tr><td>'+ no++ +'</td><td style="width: 145px;">'+ res.tgl_update +'</td><td>'+ res.keterangan +'</td><td>'+ formatRupiah(res.nominal, 'Rp. ') +'</td><td> </td><td>'+ formatRupiah(saldoView.toString(), "Rp. ") +'</td></tr>')
                                                }else{
                                                    saldoView = saldoView + parseInt(res.nominal)
                                                    $('#tableBP').append('<tr><td>'+ no++ +'</td><td style="width: 145px;">'+ res.tgl_update +'</td><td>'+ res.keterangan +'</td><td></td><td>'+ formatRupiah(res.nominal, 'Rp. ') +'</td><td>'+ formatRupiah(saldoView.toString(), "Rp. ") +'</td></tr>')
                                                }                        
                                            })
                                            // console.log(saldo)                    
                                            $('.tfoot').html(` <tr>                                                
                                                                    <th style="font-weigth: 600; text-align: right;" align="right">Sisa Saldo : </th>
                                                                    <th style="min-width: 119px;width: 124px;max-width: 129px;">` + formatRupiah( saldo.toString() , "Rp. " )+`</th>
                                                                </tr>`)
                                        }
                                    });                                    
                                }else{
                                    // console.log(res)
                                    // console.log('tidak ada')                                         
                                    $('#hide').show()                               
                                    $('#show').hide()
                                    $('.dataNotNull').hide()
                                    let nis = $("#nis").val()
                                    $('#pesan').html('Tidak ada Siswa yang mempunyai NIS '+nis)
                                    $('.dataNull').show()
                                }
                            });
                        }, 500)
                    }else if($(this).val().length == 10){
                        setTimeout(()=>{                            
                            $(this).blur()
                            $.get('http://localhost/bmssekolah/dashboardsiswa/getSiswaDetailRFID/'+$(this).val(), function(hasil){
                                if(hasil != 'null'){
                                    setTimeout(()=>{
                                        $('#hide').hide()
                                        $('.dataNotNull').hide()
                                        $('.dataNull').hide()
                                        $('#siswaNama').html('')
                                        $('#siswaNis').html('')
                                        $('#siswaKelas').html('')                                    
                                        $('#siswaNama').html('')
                                        $('#siswaNis').html('')
                                        $('#siswaKelas').html('')                                        
                                        $('#pesan').html('')                                        
                                        $('#nis').val('')                                        
                                    },90000)
                                    let data = JSON.parse(hasil)
                                    // console.log(data)
                                    $('.dataNotNull').show()
                                    $('#show').hide()
                                    $('#hide').show()
                                    $('#siswaNama').html(': '+data.namasiswa)
                                    $('#siswaNis').html(': '+data.nis)
                                    $('#siswaKelas').html(': '+data.kelas)
                                    $.get('http://localhost/bmssekolah/dashboardsiswa/getSaldoSiswa/'+data.nis, function(res){
                                        $('#saldoSiswa').html( formatRupiah(res, "Rp. ") )                
                                    })        
                                    $.get('http://localhost/bmssekolah/dashboardsiswa/detailTransaksi?id='+data.nis+'&tipe=siswa', function (result) {
                                        let transaksi = JSON.parse(result)
                                        // console.log(transaksi)
                                        $('#tableBP').html('')
                                        if(transaksi.length != 0){
                                            let saldo = 0;
                                            let no = 1;
                                            let koperasiK = '';
                                            let koperasiD = '';
                                            let saldoView = 0;
                                            transaksi.forEach(function(res){                        
                                                if('siswa' == res.kredit){
                                                    saldo = parseInt(saldo) + parseInt(res.nominal)
                                                }else if('siswa' == res.debet){
                                                    saldo = parseInt(saldo) - parseInt(res.nominal)
                                                }
                                                if(res.tipeuser == res.debet){
                                                    saldoView = saldoView - parseInt(res.nominal)
                                                    $('#tableBP').append('<tr><td>'+ no++ +'</td><td style="width: 145px;">'+ res.tgl_update +'</td><td>'+ res.keterangan +'</td><td>'+ formatRupiah(res.nominal, 'Rp. ') +'</td><td> </td><td>'+ formatRupiah(saldoView.toString(), "Rp. ") +'</td></tr>')
                                                }else{
                                                    saldoView = saldoView + parseInt(res.nominal)
                                                    $('#tableBP').append('<tr><td>'+ no++ +'</td><td style="width: 145px;">'+ res.tgl_update +'</td><td>'+ res.keterangan +'</td><td></td><td>'+ formatRupiah(res.nominal, 'Rp. ') +'</td><td>'+ formatRupiah(saldoView.toString(), "Rp. ") +'</td></tr>')
                                                }                        
                                            })
                                            // console.log(saldo)                    
                                            $('.tfoot').html(` <tr>                                                
                                                                    <th style="font-weigth: 600; text-align: right;" align="right">Sisa Saldo : </th>
                                                                    <th style="min-width: 119px;width: 124px;max-width: 129px;">` + formatRupiah( saldo.toString() , "Rp. " )+`</th>
                                                                </tr>`)
                                        }
                                    });                                    
                                }else{
                                    // console.log(res)
                                    // console.log('tidak ada')     
                                    $('#hide').show()                               
                                    $('#show').hide()
                                    $('.dataNotNull').hide()
                                    let nis = $("#nis").val()
                                    $('#pesan').html('Tidak ada Siswa yang mempunyai RFID '+nis)
                                    $('.dataNull').show()
                                }
                            });
                        }, 500)
                    }else{
                        $('#hide').hide()
                        $('#show').show()
                        $('.dataNotNull').hide()
                        $('.dataNull').hide()
                        $('#siswaNama').html('')
                        $('#siswaNis').html('')
                        $('#siswaKelas').html('')
                    }
                })
            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
