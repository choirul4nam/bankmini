<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Kas Masuk</h2>
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
                    <li class="active">Kas Masuk</li>
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
                    <div class="row">
                        <div class="col-lg-9">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Kas Masuk</h5>
                            </div>
                            <?php if ($akses['add'] == 1) { ?>
                                <a href="<?= base_url('kas-masuk-add/')  ?>" class="btn btn-primary ml-15">
                                    <i class="fa fa-plus text-white"></i>
                                    Tambah Kas Masuk
                                </a>
                            <?php  } ?>
                        </div>
                        <div class="panel-body p-20">
                            <table id="dataTableSiswa" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Kode Kas Masuk</th>
                                        <th>Keterangan</th>
                                        <th>Nominal</th>
                                        <th>Tgl. Transaksi</th>
                                        <!-- <th>Status Jurnal</th> -->
                                        <th width="200px">
                                            <center>Aksi</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($km as $data) : ?>
                                        <tr>
                                            <td><?= $data['kode_kas_masuk'] ?></td>
                                            <td><?= $data['keterangan'] ?></td>
                                            <td>Rp. <?= number_format($data['nominal'], 0, '', '.') ?></td>
                                            <td><?= date('d-m-Y', strtotime($data['tgltransaksi'])) ?></td>
                                            <td style="min-width: 175px;">
                                                <center>
                                                    <div class="btn-group">
                                                        <!-- <a href="" class="btn btn-success"><i class="fa fa-search"></i></!-->
                                                        <?php if ($akses['edit'] == 1) { ?>
                                                            <a href="<?= base_url('kas-masuk-edt/') . $data['kode_kas_masuk'] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                        <?php  } ?>
                                                        <?php if ($akses['delete'] == 1) { ?>
                                                            <a href="<?= base_url('kasmasuk/hapus/') . $data['kode_kas_masuk'] ?>" class="btn btn-danger" onclick="return confirm('Yakin Mau Dihapus ?')"><i class="fa fa-trash"></i></a>
                                                        <?php  } ?>
                                                    </div>
                                                </center>
                                            </td>
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