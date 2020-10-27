<?php date_default_timezone_set("Asia/Jakarta");  ?>
<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Kas Keluar</h2>
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
                    <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Accounting</li>
                    <li class="active">Kas Keluar</li>
                </ul>
            </div>
            <!-- /.col-sm-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <section class="section">
        <div class="container-fluid">
            <div class="row ">

                <div class="col-lg-12">

                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Tambah Kas Keluar</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <form action="<?= base_url('kaskeluar/ubahdata') ?>" method="POST">
                                <input type="hidden" name="kode" value="<?= $kk['kode_kas_keluar'] ?>">
                                <table class="table">

                                    <tr>
                                        <td>
                                            Tanggal Transaksi
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <?php $date = date('Y-m-d', strtotime($kk['tgltransaksi'])) ?>
                                        <td colspan="4"><input type="date" name="tglTransaksi" id="tglTransaksi" class="form-control" value="<?= $date ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Keterangan
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td colspan="4"><textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control" required><?= $kk['keterangan'] ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Nominal
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td colspan="4">
                                            <!-- <input type="text" name="nominal" id="nominal" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> -->
                                            <input type="text" class="form-control" id="inputNominal" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required name="no" value="Rp. <?= number_format($kk['nominal']) ?>">
                                            <input type="hidden" name="nominal" id="nominal" value="<?= $kk['nominal'] ?>">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan=" 4"></td>
                                    </tr>
                                </table>
                                <a href="<?= base_url('kaskeluar') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button class="btn btn-warning"><i class="fa fa-pencil"></i>Ubah</button>
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