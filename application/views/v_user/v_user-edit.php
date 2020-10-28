<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Pengguna</h2>
                <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>
            </div>         
        </div>
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Data Master</li>
                    <li class="active">Pengguna</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <div class="row ">

                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Tambah Tipe User</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                        <i>( * ) Wajib di Isi</i>
                            <form action="<?= base_url('users/adt_process/').$users->id ?>" method="POST">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Nama*</label>
                                            <input type="text" class="form-control" name="nama" value="<?= $users->nama ?>" placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="">User Name*</label>
                                            <input type="text" class="form-control" name="username" value="<?= $users->username ?>" placeholder="User Name">
                                        </div>
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Password*</label>
                                            <input type="password" class="form-control" name="password"  placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Ulangi Password*</label>
                                            <input type="password" class="form-control" name="repassword" placeholder="Ulangi Password">
                                        </div>
                                    </div>
                                </div>                                
                                <a href="<?= base_url('users') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button class="btn btn-warning"><i class="fa fa-pencil"></i> Ubah</button>
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