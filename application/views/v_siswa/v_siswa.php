<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Siswa</h2>
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
                    <li class="active">Siswa</li>
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
                                <h5>Data Siswa</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                        <?php if ($akses['add'] == 1) { ?>
                            <?php if ($akses['add'] == 1) { ?>
                                <a href="<?= base_url('siswa-add/')  ?>" class="btn btn-primary mb-20">
                                    <i class="fa fa-plus text-white"></i>
                                    Tambah Data Siswa
                                </a>                                                        
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Opsi Data <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right mt-5" style="box-shadow: 0 0 5px 0px #000;">
                                    <li><a href="<?= base_url('siswa-export/')  ?>">Export Data Siswa</a></li>
                                    <li><a href="<?= base_url('siswa-import/')  ?>">Import Data Siswa</a></li>
                                </ul>
                            </div>
                            <?php  } ?>
                            <!--     <a href="<?= base_url('siswa-grad/')  ?>" class="btn btn-info mb-20">
                                <i class="fa fa-check text-white"></i>
                                Siswa Lulus
                            </a> -->
                            <table id="dataTableSiswa" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <!-- <th>RFID</th> -->
                                        <th>Nama Siswa</th>
                                        <!-- <th>Alamat</th> -->
                                        <!-- <th>Jenis Kelamin</th> -->
                                        <th>Kelas</th>
                                        <th>Tahun Akademik</th>
                                        <!-- <th>Status</th> -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($datasiswa as $data) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data->nis; ?></td>
                                            <!-- <td><?= $data->rfid; ?></td> -->
                                            <td><?= $data->namasiswa; ?></td>
                                            <!-- <td><?= $data->alamat; ?></td> -->
                                            <!-- <td><?= $data->jk; ?></td> -->
                                            <?php if($data->id_kelas != 0): ?>
                                            <?php $kelas = $this->db->get_where('tb_kelas', ['id_kelas' => $data->id_kelas])->row()->kelas; ?>
                                            <td><?= $kelas; ?></td>
                                            <?php else: ?>
                                            <td>Belum Punya Kelas</td>
                                            <?php endif; ?>
                                            <?php if($data->id_tahunakademik != 0): ?>
                                            <?php $ta = $this->db->get_where('tb_tahunakademik', ['id_tahunakademik' => $data->id_tahunakademik])->row(); ?>
                                            <td><?= $ta->tglawal; ?> - <?= $ta->tglakhir; ?></td>
                                            <?php else: ?>
                                            <td></td>
                                            <?php endif; ?>
                                            <!-- <td><?= $data->status; ?></td> -->
                                            <td style="min-width: 175px;">
                                                <div class="btn-group">
                                                    <?php if ($akses['view'] == 1) { ?>
                                                        <a href="<?= base_url('siswa-det/') . $data->nis;  ?>" class="btn btn-success"><i class="fa fa-search"></i></a>
                                                    <?php  } ?>
                                                    <?php if ($akses['edit'] == 1) { ?>
                                                        <a href="<?= base_url('siswa-edt/') . $data->nis;  ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                    <?php  } ?>
                                                    <?php if ($akses['delete'] == 1) { ?>
                                                        <a href="<?= base_url('siswa-hps/') . $data->nis;  ?>" class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus?')"><i class="fa fa-trash"></i></a>
                                                    <?php  } ?>                                                        
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>                             
                            <?php  }else{ ?>
                                <table class="table">
                                        <tr>
                                            <td>NIS</td>
                                            <td>:</td>
                                            <td><?= $datasiswa['nis']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>RFID</td>
                                            <td>:</td>
                                            <td><?= $datasiswa['rfid']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td><?= $datasiswa['namasiswa']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>:</td>
                                            <td><?= $datasiswa['jk']; ?></td>
                                        </tr> 
                                        <tr>
                                            <td>Kelas</td>
                                            <td>:</td>
                                            <?php if($datasiswa['id_kelas'] != 0): ?>
                                            <?php $kelas = $this->db->get_where('tb_kelas', ['id_kelas' => $datasiswa['id_kelas']])->row()->kelas; ?>
                                            <td><?= $kelas; ?></td>
                                            <?php else: ?>
                                            <td>Belum Punya Kelas</td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <td>Tempat, Tanggal Lahir</td>
                                            <td>:</td>
                                            <td><?= $datasiswa['tempat_lahir']; ?>, <?= $datasiswa['tgl_lahir']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td><?= $datasiswa['alamat']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan/Kota/Provinsi</td>
                                            <td>:</td>
                                            <td><?= (!empty($datasiswa['kecamatan']) ? $this->db->get_where('tb_kecamatan', ['id_kecamatan' => $datasiswa['kecamatan']])->row()->kecamatan : '').'/'.(!empty($datasiswa['kota']) ? $this->db->get_where('tb_kota', ['id_kota' => $datasiswa['kota']])->row()->name_kota : ' ').'/'.(!empty($datasiswa['provinsi']) ? $this->db->get_where('tb_provinsi', ['id_provinsi' => $datasiswa['provinsi']])->row()->name_prov : '' ) ?></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Username</td>
                                            <td>:</td>
                                            <td><?= $datasiswa['nis']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Password</td>
                                            <td>:</td>
                                            <td><?= $datasiswa['password']; ?></td>
                                        </tr> -->
                                        <!-- <tr>
                                            <td>status</td>
                                            <td>:</td>
                                            <td><?= $datasiswa['status']; ?></td>
                                        </tr> -->
                                        <!--    <tr>
                                            <td>Terakhir Di Update</td>
                                            <td>:</td>
                                            <td><?= $datasiswa['tglupdate']; ?></td>
                                        </tr> -->
                                    </table>                                    
                                </div>
                            <?php } ?>
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
</div>
</div>