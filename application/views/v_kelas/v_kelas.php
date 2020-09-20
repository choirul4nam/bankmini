

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <p class="sub-title">SMA NEGERI 1 WRINGIN ANOM !</p>
                                     <label>                                                          
                                </div>                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-sm-6">
                                    <ul class="breadcrumb">
            							<li><a href="<?php echo base_url('/') ?>"><i class="fa fa-home"></i>Home</a></li>
                                          <li>Data Master</li>
            							<li class="active">Kelas</li>
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
                                    <div class="col-lg-7">
                                        <?= $this->session->flashdata('alert'); ?>                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Kelas</h5>                                                    
                                                </div>
                                                <a href="<?= base_url('kelas-add/')  ?>" class="btn btn-primary ml-15">
                                                	<i class="fa fa-plus text-white"></i>
                                                	Tambah Kelas
                                                </a> 
                                             <!--    <a href="<?= base_url('kelas/delete_all/') ?>" class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus semua kelas?')">
                                                    <i class="fa fa-trash text-white"></i>
                                                    Hapus Semua Kelas
                                                </a>  -->
                                            </div>
                                            <div class="panel-body p-20">                                            	
                                                <table id="dataTableSiswa" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Kelas</th>                                                            
                                                            <th width="200px"><center>Aksi</center></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php $no = 1;  foreach ($kelas as $data): ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $data['kelas']; ?></td>                                                                                         
                                                            <td>
                                                            	<center>
                                                                 <div class="btn-group">
                                                                    <a href="<?= base_url('kelas-edt/'). $data['id_kelas'];  ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                                    <a href="<?= base_url('kelas-hps/'). $data['id_kelas'];  ?>" class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus?')"><i class="fa fa-trash"></i></a>
                                                                </div>   
                                                                </center>
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
