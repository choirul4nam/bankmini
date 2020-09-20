

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">Detail Siswa</h2>
                                    <p class="sub-title">SMA NEGERI 1 WRINGIN ANOM !</p>
                                </div>
                                <!-- /.col-sm-6 -->
                                <!-- <div class="col-sm-6 right-side">
                                    <a class="btn bg-black toggle-code-handle tour-four" role="button">Toggle Code!</a>
                                </div> -->
                                <!-- /.col-sm-6 text-right -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">                                            
                                            <div class="panel-body p-20">                                            	
                                                <table class="table">
                                                    <tr>
                                                        <td>RFID</td>
                                                        <td>:</td>
                                                        <td><?= $datasiswa['rfid']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>NIS</td>
                                                        <td>:</td>
                                                        <td><?= $datasiswa['nis']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>:</td>
                                                        <td><?= $datasiswa['namasiswa']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kelas</td>
                                                        <td>:</td>
                                                        <td><?= $datasiswa['kelas']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jenis Kelamin</td>
                                                        <td>:</td>
                                                        <td><?= $datasiswa['jk']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Username</td>
                                                        <td>:</td>
                                                        <td><?= $datasiswa['nis']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Password</td>
                                                        <td>:</td>
                                                        <td><?= $datasiswa['password']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>:</td>
                                                        <td><?= $datasiswa['alamat']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kecamatan/Kota/Provinsi</td>
                                                        <td>:</td>
                                                        <td><?= $datasiswa['kecamatan'].'/'.$datasiswa['name_kota'].'/'.$datasiswa['name_prov']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>status</td>
                                                        <td>:</td>
                                                        <td><?= $datasiswa['status']; ?></td>
                                                    </tr>
                                                 <!--    <tr>
                                                        <td>Terakhir Di Update</td>
                                                        <td>:</td>
                                                        <td><?= $datasiswa['tglupdate']; ?></td>
                                                    </tr> -->
                                                </table>
                                                <a href="<?= base_url('siswa/') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Kembali</a>
                                                <a href="<?= base_url('siswa-edt/').$datasiswa['nis'] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i>Ubah</a>
                                                <a href="<?= base_url('siswa-hps/').$datasiswa['nis'] ?>" class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus?')"><i class="fa fa-trash"></i>Hapus</a>
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
