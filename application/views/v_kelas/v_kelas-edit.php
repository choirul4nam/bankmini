<?php date_default_timezone_set("Asia/Jakarta");  ?>
<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Kelas</h2>
                <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Data Master</li>
                    <li class="active">Kelas</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container-fluid">
        <div class="row">
                <div class="col-lg-9">
                    <?= $this->session->flashdata('alert'); ?>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Ubah Kelas</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                        <i>~Ubah kelas dengan format seperti berikut ( X IPA 1 )</i>                        
                        <form method="post" action="<?= base_url('kelas/edt_process')  ?>">
                        <input type="hidden" name="idKelas" value="<?= $kelas['id_kelas']; ?>">                          
                            <div class="form-group has-feedback">
                                    <label for="name5">Kelas*</label>
                                    <input type="text" class="form-control" id="name5" name="kelas" value="<?= $kelas['kelas']; ?>">
                                    <span class="fa fa-pencil form-control-feedback"></span>
                                    <span class="help-block">Masukkan Kelas</span>
                                </div>                                           
                                <div class="form-group has-feedback">
                                    <a href="<?= base_url('kelas/') ?>" class="btn btn-primary btn-labeled"><i class="fa fa-arrow-left"></i>Kembali</a>
                                    <button type="Submit" class="btn btn-warning btn-labeled">
                                            <i class="fa fa-plus"></i> Ubah Kelas
                                    </button>
                                </div>          
                            </form>
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