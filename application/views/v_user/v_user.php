<div class="main-page" style="height: 100%;">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-md-6">
                <h4 class="title">Pengguna</h4>
                <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>
            </div>
        </div>
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url('/') ?>"><i class="fa fa-home"></i>Home</a></li>
                    <li class="active">Pengguna</li>
                </ul>
            </div>
            <!-- /.col-sm-6 -->
        </div>
        <!-- /.row -->
            <div class="row">
                <div class="col-lg-9 mt-20">
                    <?= $this->session->flashdata('message'); ?>                                        
                </div>
            </div>
        <div class="row mt-10">
            <div class="col-md-12">
                <div class="panel border-primary no-border border-3-top">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h5>Pengguna</h5>
                            <?php// md5("admin") ; ?>
                            <?php if ($akses['add'] == 1) { ?>
                                <a href="<?= base_url('users-add/')  ?>" class="btn btn-primary" style="color: white;">
                                    <i class="fa fa-plus text-white"></i>
                                    Tambah Penggunaan
                                </a>
                            <?php } ?>
                        </div>                                           
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">                            
                            <table class="table table-bordered table-hover" id="table-user">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>User Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($user as $row): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row->nama; ?></td>
                                            <td><?= $row->username; ?></td>
                                            <td><?= $row->password; ?></td>
                                            <td><?= $row->userlevel; ?></td>                                          
                                            <td>
                                                <div class="btn-group">
                                                    <a href="<?= base_url('users-edit/').$row->id ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                    <a href="<?= base_url('users-hps/').$row->id ?>" onclick="return confirm('Yakin Hapus Pengguna?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
            <!-- /.panel -->
        </div>
        <!-- /.col-md-3 -->

        
        <!-- /.col-md-9 -->
    </div>
    <!-- /.row -->
</div>