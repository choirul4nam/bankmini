
<div class="main-page" style="height: 100%;">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2>Tambah Siswa Lulus</h2>
                <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>
            </div>
            <!-- /.col-sm-6 -->
            <!-- <div class="col-sm-6 right-side">
                <a class="btn bg-black toggle-code-handle tour-four" role="button">Toggle Code!</a>
            </div> -->
            <!-- /.col-sm-6 text-right -->
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url('/') ?>"><i class="fa fa-home"></i>Home</a></li>
                    <li>Data Master</li>
                    <li class="active">Siswa Lulus</li>
                </ul>
            </div>
            <!-- /.col-sm-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->                        
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <?= $this->session->flashdata('alert'); ?>                                        
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Data Siswa Lulus</h5>                                                       
                            </div>                        
                            <a href="<?= base_url('siswa-grad/') ?>" class="btn btn-primary ml-15"><i class="fa fa-arrow-left"></i> Kembali</a>                      
                        </div>
                        <div class="panel-body p-20">     
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        Cari Siswa Per Kelas
                                        <select id="kelasGrad" class="form-control js-states">
                                            <option value="salah">Pilih Kelas</option>
                                            <?php foreach($kelas as $row): ?>
                                                <option value="<?=$row['id_kelas']?>">  <?= $row['kelas']; ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        Cari Siswa Dari Nama / NIS
                                        <input type="text" class="form-control" id="siswaGrad">                                       
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                       <table class="table" id="viewGrad">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIS</th>
                                                    <th>Nama Lengkap</th>
                                                    <!-- <th>Alamat</th> -->
                                                    <th>Jenis Kelamin</th>
                                                    <th>Kelas</th>
                                                    <th>Tahun Akademik</th>
                                                    <th id="lulusKanSemua">
                                                        
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="rowGrad">
                                                
                                            </tbody>
                                       </table>         
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.section -->
</div>



<!-- .prop('checked', this.checked) -->