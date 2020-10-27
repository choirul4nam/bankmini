<?php date_default_timezone_set("Asia/Jakarta");  ?>
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
                    <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Accounting</li>
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
            <div class="row ">

                <div class="col-lg-12">

                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Ubah Code Of Accounting</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <form action="<?= base_url('mastercoa/ubahdata') ?>" method="POST">
                                <input type="hidden" name="id_coa" value="<?= $coa['id_coa'] ?>">
                                <table class="table">
                                    <tr>
                                        <td>
                                            Code Of Accounting
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td colspan="4"><input type="text" class="form-control" name="coa" id="coa" value="<?= $coa['kode_coa'] ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Akun
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td colspan="4"><input type="text" class="form-control" name="akun" id="akun" value="<?= $coa['akun'] ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Keterangan
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td colspan="4">
                                            <textarea name="keterangan" id="keterangan" class="form-control" cols="50" rows="5"><?= $coa['keterangan'] ?> </textarea>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            Neraca
                                        </td>
                                        <td>:</td>
                                        <td colspan="4">
                                            <?php if ($coa['neraca'] == 1) { ?>
                                                <input type="checkbox" class="icheckbox_flat-green" name="neraca" id="neraca" checked>
                                            <?php } else { ?>
                                                <input type="checkbox" class="icheckbox_flat-green" name="neraca" id="neraca">
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Perubahan Modal</td>
                                        <td>:</td>
                                        <td colspan="4">
                                            <?php if ($coa['perubahan_modal'] == 1) { ?>
                                                <input type="checkbox" class="icheckbox_flat-green" name="pm" id="pm" checked>
                                            <?php } else { ?>
                                                <input type="checkbox" class="icheckbox_flat-green" name="pm" id="pm">
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Laba Rugi</td>
                                        <td>:</td>
                                        <td colspan="4">
                                            <?php if ($coa['laba_rugi'] == 1) { ?>
                                                <input type="checkbox" class="icheckbox_flat-green" name="lr" id="lr" checked>
                                            <?php } else { ?>
                                                <input type="checkbox" class="icheckbox_flat-green" name="lr" id="lr">
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="6"></td>
                                    </tr>
                                </table>
                                <a href="<?= base_url('mastercoa') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
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