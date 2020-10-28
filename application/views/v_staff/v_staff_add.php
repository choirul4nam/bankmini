<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Guru & Anggota</h2>
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
                    <li class="active">Guru dan Anggota</li>
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

                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Tambah Data Guru dan Anggota</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <i>( * ) Wajib di Isi</i>
                            <form action="<?= base_url('staff/tambah') ?>" method="POST">
                                <table class="table">
                                    <tr>
                                        <td>No Anggota*</td>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" id="nopegawai" name="nopegawai" required></td>
                                    </tr>
                                    <tr>
                                        <td>Nama*</td>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" id="nama" name="nama" required></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat*</td>
                                        <td>:</td>
                                        <td><textarea class="form-control" id="alamat" name="alamat" required></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>Telp*</td>
                                        <td>:</td>
                                        <td><input type="text" maxlength="12" minlength="11" class="form-control" id="telp" min="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="telp" required></td>
                                    </tr>
                                    <!-- <tr>
                                        <td>Password*</td>
                                        <td>:</td>

                                        <td>
                                            <input type="hidden" id="pass" name="pass" value="pegawai123">
                                            <input type="text" class="form-control" value="pegawai123" disabled></td>
                                    </tr> -->
                                    <tr>
                                        <td>Provinsi*</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                            $query = $this->db->query('select * from tb_provinsi order by name_prov asc')->result_array();
                                            ?>
                                            <select class="js-states form-control s_provinsi" id="js-states s_provinsi" name="s_provinsi">

                                                <option value="">Pilih Provinsi</option>
                                                <?php foreach ($query as $data) : ?>
                                                    <option value="<?= $data['id_provinsi'] ?>"><?= $data['name_prov'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kota*</td>
                                        <td>:</td>
                                        <td>
                                            <select class="js-states form-control s_kota" id="js-states s_kota" name="s_kota" disabled>
                                                <!-- <option></option> -->
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan*</td>
                                        <td>:</td>
                                        <td>
                                            <select class="js-states form-control s_kecamatan" id="js-states s_kecamatan" name="s_kecamatan" disabled>
                                                <!-- <option></option> -->
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                    </tr>
                                </table>
                                <a href="<?= base_url('staff') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
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