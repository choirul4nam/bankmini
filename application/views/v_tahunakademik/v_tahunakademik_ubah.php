<?php date_default_timezone_set("Asia/Jakarta");  ?>
<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Tahun Akademik</h2>
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
                    <li class="active">Data Master</li>
                    <li class="active">Tahun Akademik</li>
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

                <div class="col-md-5">

                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Ubah Tahun Akademik</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <form action="<?= base_url('tahunakademik/ubah') ?>" method="POST">

                                <input type="hidden" id="id_tahunakademik" name="id_tahunakademik" value="<?= $tahunakademik['id_tahunakademik'] ?>">
                                <table class="table">
                                    <tr>
                                        <td>
                                            Tanggal Awal
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td><input type="date" class="form-control" id="tglawal" name="tglawal" value="<?= $tahunakademik['tglawal'] ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Tanggal Akhir
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td><input type="date" class="form-control" id="tglakhir" name="tglakhir" value="<?= $tahunakademik['tglakhir'] ?>" required></td>
                                    </tr>
                                   <!--  <tr>
                                        <td>
                                            Tanggal Update
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            <input type="hidden" value="<?= date('Y-m-d  h:i:s') ?> " id="tglupdate" name="tglupdate">
                                            <input type="text" class="form-control" value="<?= date('d-m-Y') ?> " disabled required>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td colspan="3"></td>
                                    </tr>
                                </table>
                                <a href="<?= base_url('tahunakademik') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
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