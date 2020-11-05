<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-sm-6">
                <h2 class="title">Akses Penggunaan</h2>
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
                    <li class="active">Akses Penggunaan</li>
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
                <div class="col-md-20 col-md-offset-0">

                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h5>Akses Penggunaan</h5>
                            </div>
                        </div>

                        <div class="panel-body p-8">

                            <table class="table">
                                <tr>
                                    <td style="width: 200px">
                                        Nama
                                    </td>
                                    <td width="">
                                        :
                                    </td>

                                    <td><?= $tipeuser['nama'] ?></td>
                                </tr>
                            </table>
                            <br>

                            <form action="<?= base_url('users/editakses') ?>" method="POST">
                                <table class="table">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th> Menu &nbsp; <input type="checkbox" onClick='toggle(this)'> Pilih Semua</th>
                                            <th style="text-align: center;"> View </th>
                                            <th style="text-align: center;"> Add </th>
                                            <th style="text-align: center;"> Edit </th>
                                            <th style="text-align: center;"> Delete </th>
                                        </tr>
                                    </thead>

                                    <?php
                                    foreach ($akses as $akses) { ?>
                                        <tr>
                                            <td width="200px">
                                                <input type="hidden" name="id" value=" <?= $akses['id_tipeuser'] ?>">
                                                <input type="hidden" name="submenu[]" value=" <?= $akses['id_submenu'] ?>">
                                                <?= $akses['submenu'] ?></td>
                                            <td style="text-align: center"><input type="checkbox" class="icheckbox_flat-green" name="view[]" value="<?= $akses['id_submenu'] ?>" <?php if ($akses['view'] == '1') {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?>> </td>
                                            <td style="text-align: center"><input type="checkbox" class="icheckbox_flat-green" name="add[]" value="<?= $akses['id_submenu'] ?>" <?php if ($akses['add'] == '1') {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>></td>
                                            <td style="text-align: center"><input type="checkbox" class="icheckbox_flat-green" name="edit[]" value="<?= $akses['id_submenu'] ?>" <?php if ($akses['edit'] == '1') {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?>></td>
                                            <td style="text-align: center"><input type="checkbox" class="icheckbox_flat-green" name="delete[]" value="<?= $akses['id_submenu'] ?>" <?php if ($akses['delete'] == '1') {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?>></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                                <a href="<?= base_url('users') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-warning" name="save"><i class="fa fa-pencil"></i> Simpan</button>

                            </form>
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