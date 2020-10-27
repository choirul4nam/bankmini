<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Buku Pembantu</h2>
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
                    <li class="active">Buku Pembantu</li>
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
                                <h5>Buku Pembantu</h5>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                       <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12" style="margin-left: -23px;">
                                                <label for="">Tipe User</label>	
                                                    <select class="form-control" id="bpTipeuser">
                                                        <option value="">Pilih Tipe User</option>
                                                        <?php  foreach($tipeuser as $row): ?>
                                                            <option value="<?= $row['tipeuser'] ; ?>"><?= ucwords($row['tipeuser']) ; ?></option>
                                                        <?php  endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-7 col-md-7 col-sm-12">
                                                    <label for="">Cari Nama</label>	
                                                    <select class="form-control js-states nameMember" disabled id="js-states" name="" id="">
                                                        <option value="">Pilih Nama</option>
                                                    </select>                                               
                                                </div>
                                                <div class="col-lg-1 col-md-1 col-sm-12" style="padding: 0;">
                                                    <button class="btn btn-primary btn-mem" style="margin-left: 0; margin-top: 24px;" disabled>
                                                        Cari Nama
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <table id="tb_bp" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal Transaksi</th>
                                                    <th>Keterangan</th>
                                                    <th>Debet</th>
                                                    <th>Kredit</th>
                                                    <th>Saldo</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBP">
                                                
                                            </tbody>
                                            <tfoot class="tfoot">
                                            
                                            </tfoot>
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