<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Transaksi</h2>
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
                    <li>Transaksi</li>
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
                            <?php if ($akses['add'] == 1) { ?>
                                <a href="<?= base_url('transaksi-add/')  ?>" class="btn btn-primary ml-15">
                                    <i class="fa fa-plus text-white"></i>
                                    Tambah Transaksi
                                </a>
                            <?php } ?>
                        </div>                        
                        <div class="panel-body p-20">
                        <table id="dataTableTransaksi" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><center>No</center></th>
                                        <th><center>Tanggal Transaksi</center></th>
                                        <th><center>Nama</center></th>
                                        <th><center>Transaksi</center></th>
                                        <th><center>Keterangan</center></th>
                                        <th><center>Nominal</center></th>
                                        <th width="140px"><center>Aksi</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($transaksi as $row): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['tgl_update']; ?></td>
                                            <td><?= $row['namaTransaksi']?></td>
                                            <td><?= $row['kategori']; ?></td>
                                            <td><?= $row['keterangan']; ?></td>
                                            <td><?= 'Rp.' . number_format($row['nominal']); ?></td>
                                            <td style="min-width: 140px;">
                                                <center>
                                                <div class="btn-group">
                                                    <?php if ($akses['edit'] == 1) { ?>
                                                        <a href="<?= base_url('transaksi-edt/') . $row['id_transaksi'];  ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                    <?php } ?>
                                                    <?php if ($akses['delete'] == 1) { ?>
                                                        <a href="<?= base_url('transaksi-hps/') . $row['id_transaksi'];  ?>" class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus?')"><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                    <a target="_blank" href="<?= base_url('transaksi/printOutTransaksi?id_transaksi='.$row['id_transaksi'].'&tipe=').$row['tipeuser'];  ?>" class="btn btn-info" onclick="return confirm('Yakin untuk Print Transaksi?')"><i class="fa fa-print"></i></a>
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