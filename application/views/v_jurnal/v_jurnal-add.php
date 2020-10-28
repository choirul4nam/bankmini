<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Tambah Jurnal</h2>
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
                        </div>
                        <div class="panel-body p-20">
                        <i>( * ) Wajib di Isi</i>
                            <div class="container-fluid">                        
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-12 mb-30" style="margin-left: -23px; margin-right: 23px;">
                                                    <label for="">Pilih Tipe Transaksi*</label>	
                                                    <select class="form-control js-states" id="jurnalTs">
                                                        <option value="pilih">Pilih Tipe Transaksi</option>
                                                        <option value="transaksi">Transaksi</option>
                                                        <option value="kaskeluar">Kas keluar</option>
                                                        <option value="kasmasuk">Kas masuk</option>    
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-7 col-md-7 col-sm-12 mb-30" style="margin-left: -23px; margin-right: 23px;">
                                                    <label for="">Cari Transaksi*</label>	
                                                    <select class="form-control js-states transaksiField" disabled id="js-states">
                                                        <option value="">Pilih Transaksi</option>
                                                    </select>                                               
                                                </div>
                                            </div>                                            
                                                <div class="row">
                                                    <div class="form-group col-lg-5 col-md-5 col-sm-12" style="margin-left: -23px; margin-right: 23px;">
                                                        <label for="">Nominal</label>
                                                        <input type="text" placeholder="Nominal" name="nominal" class="form-control nominalJurnal" disabled>
                                                    </div>
                                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 radioOne" style="margin-left: -23px; margin-right: 23px;">
                                                        <label for="one">Debet</label>
                                                        <input type="radio" id="one" class="blue-style" name="jenis" value="debet" disabled>
                                                    </div>
                                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 radioTwo" style="margin-left: -23px;">
                                                        <label for="two">Kredit</label>
                                                        <input type="radio" id="two" class="blue-style" name="jenis" value="kredit" disabled>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-left: -23px;">
                                                        <button class="btn btn-primary btnGenerate" disabled>
                                                            Generate
                                                        </button>
                                                    </div>
                                                </div>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Kode COA</th>                                                   
                                                    <th>Keterangan</th>                                                   
                                                    <th>Debet</th>                                                   
                                                    <th>Kredit</th>                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="confirmTable">
                                                    <td>
                                                        <select class='form-control mb-10' id="kodeCOA1">
                                                            <option value="salah">Pilih Kode COA Debet</option>
                                                            <?php foreach($coa as $row): ?>
                                                                <option data-id="<?= $row['kode_coa']; ?>" value="<?= $row['kode_coa']; ?>"><?= $row['kode_coa']; ?> - <?= $row['akun']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>                                                        
                                                        <select class='form-control' id="kodeCOA2" disabled>                                                            
                                                            
                                                        </select>
                                                    </td>
                                                    <td class="jurnalKeterangan"></td>
                                                    <td class="jurnalDebet"></td>
                                                    <td class="jurnalKredit"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <form action="<?= base_url('jurnal/add_process') ?>" method="post" id="formJurnal">
                                            <input type="hidden" name="jurnal_id_transaksi">
                                            <input type="hidden" name="jurnal_tipe_transaksi">
                                            <input type="hidden" name="kode_coa_debet">
                                            <input type="hidden" name="kode_coa_kredit">
                                            <input type="hidden" name="nominal_debet">
                                            <input type="hidden" name="nominal_kredit">
                                            <input type="hidden" name="transaksi_debet">
                                            <input type="hidden" name="transaksi_kredit">
                                            <button type="submit" class="btn btn-info btn-saveJurnal" disabled>
                                                Simpan
                                            </button>
                                        </form>
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