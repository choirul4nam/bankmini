<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Dashboard</h2>
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
                    <li><a href="<?php echo base_url() ?>assets/Theme/index.html"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Dashboard</li>
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
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat bg-primary" href="<?php echo base_url('siswa') ?>">
                        <span class="number counter"><?= $dataAnggota; ?></span>
                        <span class="name"><strong>Jumlah Anggota</strong></span>
                        <span class="bg-icon"><i class="fa fa-users"></i></span>
                    </a>
                </div>
                <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat bg-danger" href="<?php echo base_url('jurnal') ?>">
                        <span class="number counter">Rp. <?= number_format($debet); ?></span>
                        <span class="name"><strong>Total Debet</strong></span>
                        <span class="bg-icon"><i class="fa fa-credit-card"></i></span>
                    </a>
                </div>
                <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat bg-warning" href="<?php echo base_url('jurnal') ?>">
                        <span class="number counter">Rp. <?= number_format($kredit); ?></span>
                        <span class="name"><strong>Total Kredit</strong></span>
                        <span class="bg-icon"><i class="fa fa-credit-card"></i></span>
                    </a>
                </div>
                <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat bg-success" href="<?php echo base_url('jurnal') ?>">
                        <span class="number counter">Rp. <?= number_format($saldo); ?> </span>
                        <span class="name"><strong>Total Saldo</strong></span>
                        <span class="bg-icon"><i class="fa fa-bar-chart"></i></span>
                    </a>
                    <!-- /.src-code -->
                </div>
                <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.section -->
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5><i class="fa fa-list-alt"></i> List Kelas</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <ul class="list-group" style="height: 137px; overflow: auto;">
                                <?php foreach ($kelas as $data) : ?>
                                    <?php $jumlahsiswa = $this->db->query("SELECT * FROM tb_siswa WHERE id_kelas = " . $data['id_kelas'] . " AND status ='aktif'")->num_rows(); ?>
                                    <li class="list-group-item">Kelas <?= $data['kelas'] ?> <span class="badge badge-primary" style="font-size: 20px;"><?= $jumlahsiswa ?> Siswa </span></li>
                                <?php endforeach; ?>
                            </ul>
                            <a href="<?= base_url('siswa') ?>" class="btn btn-primary pull-right"><i class="fa fa-arrow-right"></i> Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
<!-- /.main-page -->
<!-- /.right-sidebar -->

</div>
<!-- /.content-container -->
</div>