

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <p class="sub-title">SMA NEGERI 1 WRINGIN ANOM !</p>
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
            							<li class="active">Transaksi</li>
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
                                                    <h5>Data Transaksi</h5>                                                    
                                                </div>
                                                <a href="<?= base_url('transaksi-add/')  ?>" class="btn btn-primary ml-15">
                                                	<i class="fa fa-plus text-white"></i>
                                                	Tambah Transaksi
                                                </a>                                                 
                                            </div>
                                            <!-- <input id="inputNominal" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></input> -->
                                            <div class="panel-body p-20">                                            	
                                                <table id="dataTableSiswa" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Kode Transaksi</th>
                                                            <th>Debet</th>
                                                            <th>Kredit</th>
                                                            <th>Kategori</th>
                                                            <th>Deskripsi</th>
                                                            <th>Nominal</th>
                                                            <th width="100px">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php $no = 1;  foreach ($transaksi as $data): ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $data->kodetransaksi; ?></td>
                                                            <td><?= $data->debet; ?></td>
                                                            <td><?= $data->kredit; ?></td>
                                                            <td><?= $data->kategori; ?></td>
                                                            <td><?= $data->deskripsi; ?></td>
                                                            <td><?= 'Rp.'.number_format($data->nominal); ?></td>
                                                            <td>
                                                            	<div class="btn-group">                                                            		
                                                            		<a href="<?= base_url('transaksi-edt/'). $data->id_mastertransaksi;  ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                            		<a href="<?= base_url('transaksi-hps/'). $data->id_mastertransaksi;  ?>" class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus?')"><i class="fa fa-trash"></i></a>
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
