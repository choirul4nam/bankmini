<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                    <h2 class="title">Siswa</h2>
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
                    <li class="active">Siswa</li>
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
                                <h5>Data Siswa</h5>                                                    
                            </div>
                        </div>
                        <div class="panel-body p-20">                                            	
                            <a href="<?= base_url('siswa-add/')  ?>" class="btn btn-primary mb-20">
                                <i class="fa fa-plus text-white"></i>
                                Tambah Data Siswa
                            </a> 
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Opsi Data <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right mt-5" style="box-shadow: 0 0 5px 0px #000;">
                                    <li><a href="<?= base_url('siswa-export/')  ?>">Export Data Siswa</a></li>
                                    <li><a href="<?= base_url('siswa-import/')  ?>">Import Data Siswa</a></li>
                                </ul>
                            </div>
                        <!--     <a href="<?= base_url('siswa-grad/')  ?>" class="btn btn-info mb-20">
                                <i class="fa fa-check text-white"></i>
                                Siswa Lulus
                            </a> -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#datasiswa" aria-controls="datasiswa" role="tab" data-toggle="tab">Data Siswa</a></li>
                                <li role="presentation"><a href="#siswalulus" aria-controls="siswalulus" role="tab" data-toggle="tab">Data Siswa Lulus</a></li>
                            </ul>
                            <div class="tab-content bg-white p-15">
                                <div role="tabpanel" class="tab-pane active" id="datasiswa">
                                <table id="dataTableSiswa" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>RFID</th>
                                            <th>Nama Siswa</th>
                                            <th>Alamat</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Kelas</th>
                                            <!-- <th>Status</th> -->
                                            <th width="115px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;  foreach ($datasiswa as $data): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data->nis; ?></td>
                                            <td><?= $data->rfid; ?></td>
                                            <td><?= $data->namasiswa; ?></td>
                                            <td><?= $data->alamat; ?></td>
                                            <td><?= $data->jk; ?></td>
                                            <td><?= $data->kelas; ?></td>
                                            <!-- <td><?= $data->status; ?></td> -->
                                            <td>
                                                <div class="btn-group">
                                                    <a href="<?= base_url('siswa-det/'). $data->nis;  ?>" class="btn btn-success"><i class="fa fa-search"></i></a>
                                                    <a href="<?= base_url('siswa-edt/'). $data->nis;  ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                    <a href="<?= base_url('siswa-hps/'). $data->nis;  ?>" class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus?')"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="siswalulus">
                                    <table class="display table table-striped table-bordered" id="tableLulus" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            <th>Alamat</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Kelas</th>
                                            <th>RFID</th>
                                            <!-- <th>Status</th> -->
                                            <th width="115px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;  foreach ($datalulus as $data): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data->nis; ?></td>
                                            <td><?= $data->namasiswa; ?></td>
                                            <td><?= $data->alamat; ?></td>
                                            <td><?= $data->jk; ?></td>
                                            <td><?= $data->kelas; ?></td>
                                            <td><?= $data->rfid; ?></td>
                                            <!-- <td><?= $data->status; ?></td> -->
                                            <td>
                                                <div class="btn-group">
                                                    <a href="<?= base_url('siswa-det/'). $data->nis;  ?>" class="btn btn-success"><i class="fa fa-search"></i></a>
                                                    <a href="<?= base_url('siswa-edt/'). $data->nis;  ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                    <a href="<?= base_url('siswa-hps/'). $data->nis;  ?>" class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus?')"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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