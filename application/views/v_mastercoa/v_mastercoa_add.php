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
                                <h5>Tambah Code Of Accounting</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                        <i>( * ) Wajib di Isi</i>
                            <form action="<?= base_url('mastercoa/tambahdata') ?>" method="POST">
                                <table class="table">
                                    <tr>
                                        <td>
                                            Code Of Accounting*
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td colspan="4"><input type="text" class="form-control" name="coa" id="coa" required></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Akun*
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td colspan="4"><input type="text" class="form-control" name="akun" id="akun" required value="<?= set_value('akun'); ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Keterangan*
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td colspan="4">
                                            <textarea name="keterangan" id="keterangan" class="form-control" cols="50" rows="5"></textarea>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            Neraca
                                        </td>
                                        <td>:</td>
                                        <td colspan="4">
                                            <input type="checkbox" class="icheckbox_flat-green" name="neraca" id="neraca">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Perubahan Modal</td>
                                        <td>:</td>
                                        <td>
                                            <input type="checkbox" class="icheckbox_flat-green" name="pm" id="pm">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Laba Rugi</td>
                                        <td>:</td>
                                        <td>
                                            <input type="checkbox" class="icheckbox_flat-green" name="lr" id="lr">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="6"></td>
                                    </tr>
                                </table>
                                <a href="<?= base_url('mastercoa') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button class="btn btn-success"><i class="fa fa-plus"></i>Tambah</button>
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