<?php
$dbet = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND MONTH(tgltransaksi) = " . date('m') . " AND YEAR(tgltransaksi) = " . date('Y'))->row_array();
$kreddi = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND MONTH(tgltransaksi) = " . date('m') . " AND YEAR(tgltransaksi) = " . date('Y'))->row_array();
$sa = $dbet['nominal'] - $kreddi['nominal'];
?>
<?php
$dbett = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' AND MONTH(tgltransaksi) != " . intval(date('m')) . " AND YEAR(tgltransaksi) = " . date('Y'))->row_array();
$kreddii = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' AND MONTH(tgltransaksi) = " . intval(date('m')) . " AND YEAR(tgltransaksi) = " . date('Y'))->row_array();
$saa = $dbett['nominal'] - $kreddii['nominal'];
?>
<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Kas Umum</h2>
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
                    <li>Accounting</li>
                    <li class="active">Kas Umum</li>
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
                        <div class="panel-heading mt-10 ml-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <table>
                                        <tr>
                                            <td style="min-width: 120px;">Tanggal Awal </td>
                                            <td colspan=><input type="date" class="form-control" id="tglawall" value="<?= date('Y-m-d') ?>"></td>
                                            <?php
                                            $dbett1 = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas masuk' ")->row_array();
                                            $kredii2 = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_historikas WHERE jenis = 'kas keluar' ")->row_array();
                                            $hh = $dbett1['nominal'] - $kredii2['nominal'];
                                            ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="3">
                                                <p id="tt" style="font-weight: bold; font-size: 30px; margin-top: 30px">TOTAL : <?= number_format($hh) ?></p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="min-width: 120px;">Tanggal Akhir </td>
                                            <td><input type="date" class="form-control" id="tglakhiree" value="<?= date('Y-m-d') ?>"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><button class="btn btn-success" id="lporanhri">Laporan Hari Ini</button> </td>
                                            <td> <button class="btn btn-success" id="lporanbln">laporan Bulanan Ini</button></td>
                                            <td><button class="btn btn-success" id="lporanthn">Laporan Tahunan Ini</button></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="right"><button class="btn btn-success" id="btnCaridata"><i class="fa fa-search"></i>Cari</button></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body p-20">
                            <table id="dataTableKasUmum" class="table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Tanggal</th>
                                        <th>Kode</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="dataKas">

                                    <?php
                                    $no = 0;
                                    foreach ($recap as $data) {
                                        $no++;
                                        $kode = $data[3];
                                        $ketkode = substr($kode, 0, 2);
                                        $debet = 0;
                                        $kredit = 0;
                                        $ket = "";
                                        $saldo = $data[4];
                                        if ($ketkode == 'KK') {
                                            $kredit = $data[2];
                                            $ket = "kas keluar";
                                        } else if ($ketkode == 'KM') {
                                            $debet = $data[2];
                                            $ket = "kas masuk";
                                        }
                                    ?>

                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= date('d-m-Y', strtotime($data[0])) ?></td>
                                            <td><?= $kode ?> </td>
                                            <td><?= 'Rp. ' . number_format($debet) ?></td>
                                            <td><?= 'Rp. ' . number_format($kredit) ?></td>
                                            <td>
                                                <?= $ket; ?> : <br>
                                                <?= $data[1] ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td></td>
                                        <td style="font-size: 15px;font-weight: bold">TOTAL</td>
                                        <td></td>
                                        <td style="font-size: 15px;font-weight: bold"><?= 'Rp. ' . number_format($dbett1['nominal']) ?></td>
                                        <td style="font-size: 15px;font-weight: bold"><?= 'Rp. ' . number_format($kredii2['nominal']) ?></td>
                                        <td style="font-size: 15px;font-weight: bold">Saldo : <?= 'Rp. ' . number_format($hh) ?></td>
                                    </tr>
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