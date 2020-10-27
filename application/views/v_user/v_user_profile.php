<div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h4 class="title"><?= $this->session->userdata('nama') ?> <small class="ml-10">(Administrasi)</small></h4>
                                    <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>
                                </div>
                            </div>
                            <!-- /.row -->
                             <div class="row">
                                    <div class="col-lg-9 mt-20">
                                        <?= $this->session->flashdata('message'); ?>                                        
                                    </div>
                                </div>
                            <div class="row mt-10">
                                <div class="col-md-12">
                                    <div class="panel border-primary no-border border-3-top">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h5>Profile</h5>
                                            </div>                                           
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <img src="<?= base_url() ?>assets/Theme/images/avatar-1.svg" alt="User Avatar" class="img-responsive">
                                                    <a href="<?= base_url('ubah-profile') ?>" class="btn btn-info pull-right mr-5 mt-20 mb-20">
                                                        <i class="fa fa-edit"></i>
                                                        Ubah Profil
                                                    </a>
                                                </div>
                                                <div class="col-md-8">
                                                <div class="row">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th>Nama</th>
                                                            <td>
                                                                <?= $staf['nama'] ?>
                                                            </td>
                                                        </tr>
                                                         <tr>
                                                            <th>Alamat</th>
                                                            <td>
                                                                <?= $staf['alamat'] ?>
                                                            </td>
                                                        </tr>
                                                         <tr>
                                                            <th>No Tlp</th>
                                                            <td>
                                                                <?= $staf['tlp'] ?>
                                                            </td>
                                                        </tr>
                                                         <tr>
                                                            <th>Provinsi</th>
                                                            <td>
                                                                <?php
                                                                $provinsi = $this->db->query("SELECT * FROM tb_provinsi WHERE id_provinsi ='" . $staf['provinsi'] . "'")->row_array();
                                                                echo $provinsi['name_prov'];
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Kota</th>
                                                            <td><?php
                                                                $kota = $this->db->query("SELECT * FROM tb_kota WHERE id_kota ='" . $staf['kota'] . "'")->row_array();
                                                                echo $kota['name_kota'];
                                                                ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Kecamatan</th>
                                                            <td><?php
                                                                $kecamatan = $this->db->query("SELECT * FROM tb_kecamatan WHERE id_kecamatan = '" . $staf['kecamatan'] . "'")->row_array();
                                                                echo $kecamatan['kecamatan'];
                                                                ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Password</th>
                                                            <td><?=
                                                                    $staf['password'] ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                
                                </div>
                                <!-- /.panel -->
                            </div>
                            <!-- /.col-md-3 -->

                            
                            <!-- /.col-md-9 -->
                        </div>
                        <!-- /.row -->
                    </div>