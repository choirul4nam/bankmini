

                    <div class="main-page">
                        <div class="container-fluid bg-white">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">Ubah Data Siswa</h2>
                                    <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>                                    
                                </div>
                                <!-- /.col-sm-6 -->
                                <!-- <div class="col-sm-6 right-side">
                                    <a class="btn bg-black toggle-code-handle tour-four" role="button">Toggle Code!</a>
                                </div> -->
                                <!-- /.col-sm-6 text-right -->
                            </div>
                            <form method="post" action="<?= base_url('siswa/edt_process')  ?>">
                                <input type="hidden" name="nisOld" value="<?= $datasiswa['nis']; ?>">
                                <input type="hidden" name="rfidOld" value="<?= $datasiswa['rfid']; ?>">
                                <div class="row panel">                            
                                    <div class="panel-body">
                                        <div class="col-md-12">                                            
                                            <div class="form-group has-feedback">
                                                <label for="username5">NIS</label>
                                                <input type="text" class="form-control" maxlength="4" minlength="4" id="username5" name="nis" onkeypress='return event.charCode >= 48 && event.charCode <= 57' <?php if(!empty($datasiswa['nis'])){echo 'value="'.$datasiswa['nis'].'"';}else{echo '';} ?> require>
                                                <span class="fa fa-graduation-cap form-control-feedback"></span>
                                                <span class="help-block">Masukkan NIS siswa</span>
                                            </div>
                                              <div class="form-group has-feedback">
                                                <label for="name5">RFID</label>
                                                <input type="text" class="form-control" id="name5" require name="rfid" <?php if(!empty($datasiswa['rfid'])){echo 'value="'.$datasiswa['rfid'].'"';}else{echo '';} ?> >
                                                <span class="fa fa-pencil form-control-feedback"></span>
                                                <span class="help-block">Masukkan RFID</span>
                                            </div>  
                                            <div class="form-group has-feedback">
                                                <label for="name5">Nama Panjang</label>
                                                <input type="text" class="form-control" id="name5" name="nama" <?php if(!empty($datasiswa['namasiswa'])){echo 'value="'.$datasiswa['namasiswa'].'"';}else{echo '';} ?> require>
                                                <span class="fa fa-pencil form-control-feedback"></span>
                                                <span class="help-block">Masukkan nama siswa</span>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputPassword5">Jenis Kelamin</label>
                                                <select class="form-control" name="jk">
                                                    <?php if($datasiswa['jk'] === 'Laki-laki'): ?>
                                                        <option value="Laki-laki">Laki-Laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    <?php else: ?>
                                                        <option value="Perempuan">Perempuan</option>
                                                        <option value="Laki-laki">Laki-Laki</option>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                            </div>  
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputPassword5">Kelas</label>
                                                <select class="form-control" name="kelas">
                                                    <option>Pilih Kelas</option>
                                                    <?php foreach ($kelas as $dataKelas): ?>
                                                        <option value="<?= $dataKelas['id_kelas']; ?>" <?php if($dataKelas['id_kelas'] === $datasiswa['id_kelas']){echo "selected";} ?>><?= $dataKelas['kelas']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="fa fa-building-o form-control-feedback"></span>
                                            </div> 
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputPassword5">Tahun Akademik</label>
                                                <select class="form-control" name="tahun_akademik" required>
                                                    <?php foreach ($tahunaka as $row): ?>
                                                        <option value="<?= $row['id_tahunakademik']; ?>" <?php if($row['id_tahunakademik'] === $datasiswa['id_tahunakademik']){echo "selected";} ?>><?= $row['tglawal']; ?> - <?= $row['tglakhir']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="fa fa-building-o form-control-feedback"></span>
                                            </div> 
                                            <div class="form-group has-feedback">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="exampleInputEmail5">Tempat Lahir</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail5" name="tempat_lahir" <?php if(!empty($datasiswa['tempat_lahir'])){echo 'value="'.$datasiswa['tempat_lahir'].'"';}else{echo '';} ?> require>
                                                        <span class="fa fa-map-marker form-control-feedback mr-10"></span>
                                                        <span class="help-block">Masukkan Tempat Lahir Siswa</span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="exampleInputEmail5">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" id="exampleInputEmail5" name="tanggal_lahir" <?php 
                                                        $time = strtotime($datasiswa['tgl_lahir']); $newformat = date('Y-m-d',$time);if(!empty($datasiswa['tgl_lahir'])){echo 'value="'.$newformat.'"';}else{echo '';} ?> require>
                                                        <!-- <span class="fa fa-map-marker form-control-feedback mr-10"></span> -->
                                                        <span class="help-block">Masukkan Tanggal Lahir Siswa</span>
                                                    </div>   
                                                </div>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputEmail5">Alamat Lengkap</label>
                                                <textarea class="form-control" name="alamat"><?php if(!empty($datasiswa['alamat'])){echo $datasiswa['alamat'];}else{echo '';} ?></textarea>
                                                <span class="fa fa-map-marker form-control-feedback"></span>
                                                <span class="help-block">Masukkan Alamat Siswa</span>
                                            </div>                             
                                            <div class="form-group has-feedback">
                                                <label for="js-states">Provinsi</label>
                                                <select class="form-control s_provinsi" id="provinsi" name="prov">
                                                    <option value="">Pilih Provinsi</option>
                                                    <?php foreach ($prov as $dataProv): ?>
                                                        <option value="<?= $dataProv['id_provinsi']; ?>" <?php if($dataProv['id_provinsi'] === $datasiswa['provinsi']){echo "selected";} ?>><?= $dataProv['name_prov']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <!-- <span class="fa fa-map form-control-feedback"></span> -->
                                            </div>                                                                                
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputPassword5">Kota</label>
                                                <select class="form-control s_kota" name="kota" id="selectKota">
                                                    <option value="">Pilih Kota</option>
                                                    <?php foreach ($kota as $dataKota): ?>
                                                        <option value="<?= $dataKota['id_kota']; ?>" <?php if($dataKota['id_kota'] === $datasiswa['kota']){echo "selected";} ?>><?= $dataKota['name_kota']; ?></option>
                                                    <?php endforeach; ?>                                                   
                                                </select>
                                                <!-- <span class="fa fa-map form-control-feedback"></span> -->
                                            </div>                                                                                
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputPassword5">Kecamatan</label>
                                                <select class="form-control s_kecamatan" name="kecamatan" id="selectKeca">
                                                    <option value="">Pilih Kecamatan</option> 
                                                    <?php foreach ($keca as $dataKeca): ?>
                                                        <option value="<?= $dataKeca['id_kecamatan']; ?>" <?php if($dataKeca['id_kecamatan'] === $datasiswa['kecamatan']){echo "selected";} ?>><?= $dataKeca['kecamatan']; ?></option>
                                                    <?php endforeach; ?>                                                     
                                                </select>
                                                <!-- <span class="fa fa-map form-control-feedback"></span> -->
                                            </div>                                                                                                                           
                                            <!-- <div class="form-group has-feedback">
                                                  <label>
                                                      <input type="checkbox" name="alumni" class="blue-style" value="1" <?php if($datasiswa['status'] === 'alumni'){echo "checked";} ?>>
                                                      Alumni
                                                    </label>
                                                <span class="fa fa-pencil form-control-feedback"></span>
                                                <span class="help-block">Centang jika siswa ini menjadi Alumni</span>
                                            </div>   -->
                                            <input type="hidden" name="status" value="<?= $datasiswa['status']; ?>">
                                            <div class="form-group has-feedback">
                                                  <a href="<?= base_url('siswa/') ?>" class="btn btn-primary btn-labeled"><i class="fa fa-arrow-left"></i>Kembali</a>
                                                <button type="Submit" class="btn btn-warning btn-labeled">
                                                     <i class="fa fa-plus"></i> Ubah Data Siswa
                                                </button>
                                            </div>                                             
                                        </div>
                                    </div>
                                </div>                                
                            </form>
                            <!-- /.row -->                            
                        </div>                    
                    </div>
                    <!-- /.main-page -->
                    <!-- /.right-sidebar -->
                </div>
                <!-- /.content-container -->
            </div>
