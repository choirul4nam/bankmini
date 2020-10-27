<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Histori Transaksi</h2>
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
                    <li>Data Master</li>
                    <li class="active">Histori Transaksi</li>
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
                                <h5>Histori Transaksi</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <div class="pull-right">
                                <table>
                                    <tr style="font-size: 25px;">
                                        <td>Saldo</td>
                                        <td>:</td>
                                        <td>Rp. 800.000</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table id="dataTableSiswa" class="table" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Kode Transaksi</th>
                                                    <th>Keterangan</th>
                                                    <th>Nominal</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; foreach($dataTransaksi as $row): ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row['tgl_update']; ?></td>
                                                        <td><?= $row['kodetransaksi']; ?></td>
                                                        <td><?= $row['keterangan']; ?></td>
                                                        <td><?= $row['nominal']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</div>