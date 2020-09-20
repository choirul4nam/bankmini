

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
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
                                                <a href="<?= base_url('siswa-grad/')  ?>" class="btn btn-info mb-20">
                                                    <i class="fa fa-check text-white"></i>
                                                    Siswa Lulus
                                                </a>
                                                <table id="dataTableSiswa" class="display table table-striped table-bordered" cellspacing="0" width="100%">
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
                                                    	<?php $no = 1;  foreach ($datasiswa as $data): ?>
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
                                <!-- /.row -->
                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->
                    </div>
                    <!-- /.main-page -->
                    <!-- /.right-sidebar -->                                               
                </div>
                <!-- /.content-container -->
            </div>
