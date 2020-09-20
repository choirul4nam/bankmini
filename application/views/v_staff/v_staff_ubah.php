<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Staff</h2>
                <p class="sub-title">SMA NEGERI 1 WRINGIN ANOM !</p>
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
                    <li class="active">Staff</li>
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

                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Ubah Data Staff</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <form action="<?= base_url('staff/ubah') ?>" method="POST">
                                <input type="hidden" value="<?= $staf['id_staf'] ?>" id="id_staf" name="id_staf" />
                                <table class="table">
                                    <tr>
                                        <td>no pegawai</td>
                                        <td>:</td>
                                        <td><input type="text" maxlength="12" class="form-control" id="nopegawai" name="nopegawai" value="<?= $staf['nopegawai']  ?> " required></td>
                                    </tr>
                                    <tr>
                                        <td>nama</td>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" id="nama" name="nama" value="<?= $staf['nama'] ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td>alamat</td>
                                        <td>:</td>
                                        <td><textarea class="form-control" id="alamat" name="alamat" required><?= $staf['alamat'] ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>telp</td>
                                        <td>:</td>
                                        <td><input type="text" maxlength="12" minlength="11" class="form-control" id="telp" min="0" value="<?= $staf['tlp'] ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="telp" required></td>
                                    </tr>
                                    <tr>
                                        <td>tipe user</td>
                                        <td>:</td>
                                        <td>
                                            <select class="js-states form-control" id="js-states tipeuser" name="tipeuser">
                                                <?php
                                                $dataTipeUser = $this->db->query('SELECT * FROM tb_tipeuser')->result_array();
                                                foreach ($dataTipeUser as $data) :
                                                    if ($data['id_tipeuser'] == $staf['id_tipeuser']) {
                                                ?>
                                                        <option value="<?= $data['id_tipeuser'] ?>" selected><?= $data['tipeuser'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?= $data['id_tipeuser'] ?>"><?= $data['tipeuser'] ?></option>
                                                <?php
                                                    }
                                                endforeach;
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>password</td>
                                        <td>:</td>

                                        <td>
                                            <!-- <input type="hidden" id="pass" name="pass" value="pegawai123"> -->
                                            <input type="text" class="form-control" id="pass" name="pass" value="<?= $staf['password'] ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td>provinsi</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                            $query = $this->db->query('select * from tb_provinsi order by name_prov asc')->result_array();
                                            ?>
                                            <select class="js-states form-control s_provinsi" id="js-states s_provinsi" name="s_provinsi">

                                                <option value="">Pilih Provinsi</option>
                                                <?php foreach ($query as $data) :
                                                    if ($data['id_provinsi'] == $staf['provinsi']) {
                                                ?>
                                                        <option value="<?= $data['id_provinsi'] ?>" selected><?= $data['name_prov'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?= $data['id_provinsi'] ?>"><?= $data['name_prov'] ?></option>
                                                <?php }
                                                endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>kota</td>
                                        <td>:</td>
                                        <td>
                                            <?php $kotaa = $this->db->query("SELECT * FROM tb_kota WHERE id_provinsi = '" . $staf['provinsi'] . "'")->result_array() ?>
                                            <select class="js-states form-control s_kota" id="js-states s_kota" name="s_kota">
                                                <?php foreach ($kotaa as $data) :
                                                    if ($data['id_kota'] == $staf['kota']) {
                                                ?>
                                                        <option value="<?= $data['id_kota'] ?>" selected><?= $data['name_kota'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?= $data['id_kota'] ?>"><?= $data['name_kota'] ?></option>
                                                <?php }
                                                endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>kecamatan</td>
                                        <td>:</td>
                                        <td>
                                            <?php $kecamatann = $this->db->query("SELECT * FROM tb_kecamatan WHERE id_kota = '" . $staf['kota'] . "'")->result_array() ?>
                                            <select class="js-states form-control s_kecamatan" id="js-states s_kecamatan" name="s_kecamatan">
                                                <?php foreach ($kecamatann as $data) :
                                                    if ($data['id_kecamatan'] == $staf['kecamatan']) {
                                                ?>
                                                        <option value="<?= $data['id_kecamatan'] ?>" selected><?= $data['kecamatan'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?= $data['id_kecamatan'] ?>"><?= $data['kecamatan'] ?></option>
                                                <?php }
                                                endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                    </tr>
                                </table>
                                <a href="<?= base_url('staff') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
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