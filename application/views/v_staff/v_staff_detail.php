<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Staf</h2>
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
                    <li class="active">Staf</li>
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
                                <h5>Detail Staff</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <table class="table">
                                <tr>
                                    <td>No Pegawai</td>
                                    <td>:</td>
                                    <td><?= $staf['nopegawai'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><?= $staf['nama'] ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><?= $staf['alamat'] ?></td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td>:</td>
                                    <td>
                                        <?php
                                        $provinsi = $this->db->query("SELECT * FROM tb_provinsi WHERE id_provinsi ='" . $staf['provinsi'] . "'")->row_array();
                                        echo $provinsi['name_prov'];
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kota</td>
                                    <td>:</td>
                                    <td><?php
                                        $kota = $this->db->query("SELECT * FROM tb_kota WHERE id_kota ='" . $staf['kota'] . "'")->row_array();
                                        echo $kota['name_kota'];
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>Kecamatan</td>
                                    <td>:</td>
                                    <td><?php
                                        $kecamatan = $this->db->query("SELECT * FROM tb_kecamatan WHERE id_kecamatan = '" . $staf['kecamatan'] . "'")->row_array();
                                        echo $kecamatan['kecamatan'];
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>Telp</td>
                                    <td>:</td>
                                    <td><?= $staf['tlp'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tipe User</td>
                                    <td>:</td>
                                    <td><?php
                                        $tipeuser = $this->db->query("SELECT * FROM tb_tipeuser WHERE id_tipeuser = '" . $staf['id_tipeuser'] . "'")->row_array();
                                        echo $tipeuser['tipeuser'];
                                        ?></td>
                                </tr>
                                <!-- <tr>
                                    <td>Tgl Update</td>
                                    <td>:</td>
                                    <td><?php
                                        $date = date_create($staf['tgl_upddate']);
                                        echo date_format($date, "d-m-Y");
                                        ?></td>
                                </tr> -->
                                <tr>
                                    <td>Password</td>
                                    <td>:</td>
                                    <td><?=
                                            $staf['password'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                </tr>
                            </table>
                            <a href="<?= base_url('staff') ?> " class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <a href="<?= base_url('staff-ubah/') . $staf['id_staf'] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="<?= base_url('staff/hapus/') . $staf['id_staf'] ?>" class="btn btn-danger" onclick="return confirm('Yakin Mau Dihapus ?')"><i class="fa fa-trash"> Hapus</i></a>
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