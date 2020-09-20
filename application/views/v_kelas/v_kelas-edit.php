

                    <div class="main-page">
                        <div class="container-fluid bg-white">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">Ubah Kelas</h2>
                                    <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>                                    
                                </div>
                                <!-- /.col-sm-6 -->
                                <!-- <div class="col-sm-6 right-side">
                                    <a class="btn bg-black toggle-code-handle tour-four" role="button">Toggle Code!</a>
                                </div> -->
                                <!-- /.col-sm-6 text-right -->
                            </div>
                            <form method="post" action="<?= base_url('kelas/edt_process')  ?>">
                                <input type="hidden" name="idKelas" value="<?= $kelas['id_kelas']; ?>">
                                <div class="row panel">                            
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <div class="form-group has-feedback">
                                                <label for="name5">Kelas</label>
                                                <input type="text" class="form-control" id="name5" name="kelas" value="<?= $kelas['kelas']; ?>">
                                                <span class="fa fa-pencil form-control-feedback"></span>
                                                <span class="help-block">Masukkan Kelas Baru</span>
                                            </div>                                           
                                            <div class="form-group has-feedback">
                                                <a href="<?= base_url('kelas/') ?>" class="btn btn-primary btn-labeled"><i class="fa fa-arrow-left"></i>Kembali</a>
                                                <button type="Submit" class="btn btn-warning btn-labeled">
                                                     <i class="fa fa-plus"></i> Ubah Kelas
                                                </button>
                                            </div>                                             
                                        </div>
                                    </div>
                                </div>                                
                            </form>
                            <!-- /.row -->                            
                        </div>                    
                    </div>
                    <!-- /.main-page -->
                    <!-- /.right-sidebar -->
                </div>
                <!-- /.content-container -->
            </div>
