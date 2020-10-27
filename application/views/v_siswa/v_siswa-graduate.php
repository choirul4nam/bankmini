
<div class="main-page" style="height: 100%;">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2>Siswa Lulus</h2>
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
                    <li class="active">Siswa Lulus</li>
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
                                <h5>Data Siswa Lulus</h5>                                                       
                            </div>                                              
                        </div>
                        <div class="panel-body p-20">    
                        <?php if ($akses['add'] == 1) { ?>
                                <a href="<?= base_url('siswa-gradpage/')  ?>" class="btn btn-primary mb-20">
                                    <i class="fa fa-plus text-white"></i>
                                    Tambah Siswa Lulus
                                </a>
                            <?php  } ?>                                                                      
                        <table class="display table table-striped table-bordered" id="tableLulus" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIS</th>
                                                <th>Nama Siswa</th>
                                                <th>Alamat</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Kelas</th>
                                                <th>Tahun Akademik</th>
                                                <th>RFID</th>
                                                <!-- <th>Status</th> -->
                                                <th width="115px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                                foreach ($datalulus as $data) :
                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $data->nis; ?></td>
                                                    <td><?= $data->namasiswa; ?></td>
                                                    <td><?= $data->alamat; ?></td>
                                                    <td><?= $data->jk; ?></td>
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
                                                    <td><?= $data->rfid; ?></td>
                                                    <!-- <td><?= $data->status; ?></td> -->
                                                    <td style="min-width: 175px;">
                                                        <div class="btn-group">
                                                            <?php if ($akses['view'] == 1) { ?>
                                                                <a href="<?= base_url('siswa-det/') . $data->nis;  ?>" class="btn btn-success"><i class="fa fa-search"></i></a>
                                                            <?php  } ?>                                                           
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
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
</div>
</div>




<!-- .prop('checked', this.checked) -->