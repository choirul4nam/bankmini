<div class="main-page" style="width:100vw;">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Siswa</h2>
                <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>
            </div>
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
                                            <td>Tahun Akademik</td>
                                            <td>:</td>
                                        <?php if($datasiswa['id_tahunakademik'] != 0): ?>
                                            <?php $ta = $this->db->get_where('tb_tahunakademik', ['id_tahunakademik' => $datasiswa['id_tahunakademik']])->row(); ?>
                                            <td><?= $ta->tglawal; ?> - <?= $ta->tglakhir; ?></td>
                                            <?php else: ?>
                                            <td></td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px;">Tempat, Tanggal Lahir</td>
                                            <td>:</td>
                                            <td><?= $datasiswa['tempat_lahir']; ?>, <?= $datasiswa['tgl_lahir']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td><?= $datasiswa['alamat']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td>:</td>
                                            <td><?= (!empty($datasiswa['kecamatan']) ? $this->db->get_where('tb_kecamatan', ['id_kecamatan' => $datasiswa['kecamatan']])->row()->kecamatan : '') ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Kota</td>
                                            <td>:</td>
                                            <td><?= (!empty($datasiswa['kota']) ? $this->db->get_where('tb_kota', ['id_kota' => $datasiswa['kota']])->row()->name_kota : ' ') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Provinsi</td>
                                            <td>:</td>
                                            <td><?= (!empty($datasiswa['provinsi']) ? $this->db->get_where('tb_provinsi', ['id_provinsi' => $datasiswa['provinsi']])->row()->name_prov : '' ) ?></td>
                                        </tr>                                                                             
                                    </table>
                                    <button onclick="history.go(-1);" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Kembali</button>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.section -->
</div>
</div>
</div>