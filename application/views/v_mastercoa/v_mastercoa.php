<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Master Code Of Accounting</h2>
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
                    <li>Accounting</li>
                    <li class="active">Master Code Of Accounting</li>
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
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h5>Master Code Of Accounting</h5>
                    </div>
                    <?php if ($akses['add'] == 1) { ?>
                        <a href="<?= base_url('mastercoa-add') ?> " class="btn btn-primary ml-15">
                            <i class="fa fa-plus text-white"></i>
                            Tambah Code Of Accounting
                        </a>
                    <?php } ?>
                </div>
                <div class="panel-body p-20">
                    <table id="dataTableSiswa" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Code Of Accounting</th>
                                <th>Akun</th>
                                <th>Keterangan</th>
                                
                                <th width="200px">
                                    <center>Aksi</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($coa as $data) : ?>
                                <tr>
                                    <td><?= $data['kode_coa'] ?></td>
                                    <td><?= $data['akun'] ?></td>
                                    <!-- <?php if ($data['neraca'] == 1) { ?>
                                        <td><?= $data['keterangan'] ?> - Neraca</td>
                                    <?php } ?>
                                    <?php if ($data['perubahan_modal'] == 1) { ?>
                                        <td><?= $data['keterangan'] ?> - Perubahan Modal</td>
                                    <?php } ?>
                                    <?php if ($data['laba_rugi'] == 1) { ?>
                                        <td><?= $data['keterangan'] ?> - Laba Rugi</td>
                                    <?php } ?> -->
                                    <td><?= $data['keterangan'] ?></td>
                                    <td style="min-width: 140px;">
                                        <center>
                                            <div class="btn-group">
                                                <?php if ($akses['edit'] == 1) { ?>
                                                <a href="<?= base_url('mastercoa-edt/') . $data['id_coa'] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                <?php } ?>
                                                <?php if ($akses['delete'] == 1) { ?>
                                                <a href="<?= base_url('mastercoa/hapus/') . $data['id_coa'] ?>" class="btn btn-danger" onclick="return confirm('Yakin Mau Dihapus ?')"><i class="fa fa-trash"></i></a>
                                                <?php } ?>
                                                <!-- <a href="<?= base_url('mastercoa-det/') . $data['id_coa'] ?>" class="btn btn-success"><i class="fa fa-search"></i></a> -->
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

</div>
<!-- /.container-fluid -->
</section>
<!-- /.section -->
</div>