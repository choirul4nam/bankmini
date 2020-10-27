<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Jurnal</h2>
                <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>
                <label>
            </div>
        </div>
        <!-- /.row -->
        <div class="row breadcrumb-div">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url('/') ?>"><i class="fa fa-home"></i>Home</a></li>
                    <li>Accounting</li>
                    <li class="active">Jurnal</li>
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
                <div class="col-lg-7">
                    <?= $this->session->flashdata('alert'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Jurnal</h5>
                            </div>
                            <?php if ($akses['add'] == 1) { ?>
                                <a href="<?= base_url('jurnal-add/')  ?>" class="btn btn-primary ml-15">
                                    <i class="fa fa-plus text-white"></i>
                                    Tambah Jurnal
                                </a>
                            <?php } ?>
                        </div>
                        <div class="panel-body p-20">
                            <div class="container-fluid">                        
                                <div class="row mt-20">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table id="dataTableSiswa" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode COA Debet</th>                                                   
                                                    <th>Kode COA Kredit</th>                                                   
                                                    <th>Nominal Debet</th>                                                   
                                                    <th>Nominal Kredit</th>                                                   
                                                    <th>Transaksi Debet</th>                                                   
                                                    <th>Transaksi Kredit</th>                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php $no = 1; foreach($jurnal as $row): ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <?php $kcd = $this->db->get_where('tb_mastercoa', ['kode_coa' => $row['kode_coa_debet']])->row(); ?>
                                                        <td width="100px"><?= $kcd->kode_coa; ?></td>
                                                        <?php $kck = $this->db->get_where('tb_mastercoa', ['kode_coa' => $row['kode_coa_kredit']])->row(); ?>
                                                        <td width="100px"><?= $kck->kode_coa; ?></td>
                                                        <td><?= ($row['nominal_debet'] != 0 ? 'Rp. '.number_format($row['nominal_debet']) : ''); ?></td>
                                                        <td><?= ($row['nominal_kredit'] != 0 ? 'Rp. '.number_format($row['nominal_kredit']) : ''); ?></td>
                                                        <td>
                                                            <?php 
                                                                if($row['tipe_transaksi'] == 'transaksi' && !empty($row['transaksi_debet'])){
                                                                    echo $this->db->get_where('tb_transaksi', ['id_transaksi' => $row['transaksi_debet']])->row()->keterangan;
                                                                    echo $this->db->get_where('tb_transaksi', ['id_transaksi' => $row['transaksi_debet']])->row()->kodetransaksi;
                                                                }else if($row['tipe_transaksi'] == 'kk' && !empty($row['transaksi_debet'])){
                                                                    echo $this->db->get_where('tb_kaskeluar', ['id_kk' => $row['transaksi_debet']])->row()->keterangan;
                                                                    echo $this->db->get_where('tb_kaskeluar', ['id_kk' => $row['transaksi_debet']])->row()->kode_kas_keluar;
                                                                }else if($row['tipe_transaksi'] == 'km' && !empty($row['transaksi_debet'])){
                                                                    echo $this->db->get_where('tb_kasmasuk', ['id_km' => $row['transaksi_debet']])->row()->keterangan;
                                                                    echo $this->db->get_where('tb_kasmasuk', ['id_km' => $row['transaksi_debet']])->row()->kode_kas_masuk;
                                                                }                                                         
                                                            ?> 
                                                        </td>                                                      
                                                        <td>
                                                            <?php 
                                                                if($row['tipe_transaksi'] == 'transaksi' && !empty($row['transaksi_kredit'])){
                                                                    echo $this->db->get_where('tb_transaksi', ['id_transaksi' => $row['transaksi_kredit']])->row()->keterangan;
                                                                    echo $this->db->get_where('tb_transaksi', ['id_transaksi' => $row['transaksi_kredit']])->row()->kodetransaksi;
                                                                }else if($row['tipe_transaksi'] == 'kk' && !empty($row['transaksi_kredit'])){
                                                                    echo $this->db->get_where('tb_kaskeluar', ['id_kk' => $row['transaksi_kredit']])->row()->keterangan;
                                                                    echo $this->db->get_where('tb_kaskeluar', ['id_kk' => $row['transaksi_kredit']])->row()->kode_kas_keluar;
                                                                }else if($row['tipe_transaksi'] == 'km' && !empty($row['transaksi_kredit'])){
                                                                    echo $this->db->get_where('tb_kasmasuk', ['id_km' => $row['transaksi_kredit']])->row()->keterangan;
                                                                    echo $this->db->get_where('tb_kasmasuk', ['id_km' => $row['transaksi_kredit']])->row()->kode_kas_masuk;
                                                                }                                                         
                                                            ?> 
                                                        </td>                                                                                                                                                 
                                                    </tr>
                                               <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
