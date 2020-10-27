<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Kenaikan Kelas</h2>
                <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url('/') ?>"><i class="fa fa-home"></i>Home</a></li>
                    <li>Data Master</li>
                    <li class="active">Naik Kelas</li>
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
                                <h5>Kenaikan Kelas</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Dari kelas</label>
                                        <select id="fromClass" class="form-control js-states" id="js-state">
                                            <option value="salah">Pilih Kelas</option>
                                            <?php foreach($kelas as $row): ?>                                            
                                                <option value="<?= $row['id_kelas']; ?>"><?= $row['kelas']; ?></option>
                                            <?php endforeach ; ?>
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Ke kelas</label>
                                        <select id="toClass" class="form-control js-states" id="js-state" disabled>
                                            <option value="salah">Pilih Kelas</option>
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Tahun Akademik</label>
                                        <select id="upClassTA" class="form-control js-states" id="js-state" disabled>
                                            <option value="salah">Pilih Tahun Akademik</option>
                                        </select>
                                    </div>                                    
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button class="btn btn-primary btn-block" id="naikkelas" disabled>
                                        Naikan Kelas
                                    </button>
                                </div>
                            </div>   
                            <div class="row mt-20">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <table class="table" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIS</th>
                                                <th>Nama Lengkap</th>
                                                <!-- <th>Alamat</th> -->
                                                <th>Jenis Kelamin</th>
                                                <th>Kelas</th>
                                                <th>Tahun Akademik</th>
                                            </tr>
                                        </thead>
                                        <tbody id="upClass">
                                            
                                        </tbody>
                                    </table> 
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
    </div>
</div>

