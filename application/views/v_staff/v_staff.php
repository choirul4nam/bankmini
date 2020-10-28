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
                <div class="col-md-15">

                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Data Guru dan Anggota</h5>
                            </div>

                            <?php if ($akses['add'] == 1) { ?>
                                <a href="<?= base_url('staff-add') ?>" class="btn btn-primary ml-15"><i class="fa fa-plus"></i> Tambah Guru dan Anggota</a>
                            <?php } ?>
                        </div>
                        <div class="panel-body p-20">
                            <table id="dataTableSiswa" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. Anggota</th>
                                        <th>Nama</th>
                                        <!-- <th>Alamat</th> -->
                                        <!-- <th>Provinsi</th> -->
                                        <!-- <th>Kota</th> -->
                                        <!-- <th>Kecamatan</th> -->
                                        <th>No. Telp</th>
                                        <!-- <th>Tipe User</th> -->
                                        <!-- <th>Status</th> -->
                                        <!-- <th>Tgl. Update</th> -->
                                        <!-- <th>Password</th> -->
                                        <th><center>Aksi</center></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($staff as $data) :
                                        if ($data['status'] == 'aktif') {
                                    ?>

                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $data['nopegawai'] ?></td>
                                                <td><?= $data['nama'] ?></td>
                                                <!-- <td><?= $data['alamat'] ?></td> -->
                                                <td><?= $data['tlp'] ?></td>
                                                <?php $tipeuser = $this->db->get_where('tb_tipeuser', ['id_tipeuser' => $data['id_tipeuser']])->row_array(); ?>
                                                <!-- <td><?= $tipeuser['tipeuser'] ?></td> -->
                                                <!-- <td><?= $data['status'] ?></td> -->
                                                <!-- td><?php
                                                        $date = date_create($data['tgl_upddate']);
                                                        echo date_format($date, "d-m-Y");

                                                        ?></td> -->
                                                <!-- <td><?= $data['password'] ?></td> -->
                                                <td style="min-width: 175px;">
                                                    <center>
                                                        <div class="btn btn-group">
                                                            <?php if ($akses['view'] == 1) { ?>
                                                                <a href="<?= base_url('staff-det/') . $data['id_staf'] ?>" class="btn btn-success"><i class="fa fa-search"></i></a>
                                                            <?php } ?>
                                                            <?php if ($akses['edit'] == 1) { ?>
                                                                <a href="<?= base_url('staff-ubah/') . $data['id_staf'] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                            <?php } ?>
                                                            <?php if ($akses['delete'] == 1) { ?>
                                                                <a href="<?= base_url('staff/hapus/') . $data['id_staf'] ?>" class="btn btn-danger" onclick="return confirm('Yakin Mau Dihapus ?')"><i class="fa fa-trash"></i></a>
                                                            <?php } ?>
                                                        </div>
                                                    </center>
                                                </td>

                                            </tr>
                                    <?php
                                        }
                                    endforeach;
                                    ?>
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