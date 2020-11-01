

                    <div class="main-page">
                        <div class="container-fluid bg-white">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">Tambah Data Siswa</h2>
                                    <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>                                    
                                </div>
                                <!-- /.col-sm-6 -->
                                <!-- <div class="col-sm-6 right-side">
                                    <a class="btn bg-black toggle-code-handle tour-four" role="button">Toggle Code!</a>
                                </div> -->
                                <!-- /.col-sm-6 text-right -->
                            </div>
                            <form method="post" action="<?= base_url('siswa/add_process')  ?>">
                                <div class="row panel">                            
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                        <i>( * ) Wajib di Isi</i>
                                            <div class="form-group has-feedback">
                                                <label for="username5">NIS*</label>
                                                <input type="text" class="form-control" maxlength="4" minlength="4" id="username5" name="nis" required 
                                                    onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                    >
                                                <span class="fa fa-graduation-cap form-control-feedback"></span>
                                                <span class="help-block">Masukkan NIS siswa</span>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="name5">RFID*</label>
                                                <input type="text" class="form-control" id="name5" name="rfid" required>
                                                <span class="fa fa-pencil form-control-feedback"></span>
                                                <span class="help-block">Masukkan RFID</span>
                                            </div>  
                                            <div class="form-group has-feedback">
                                                <label for="name5">Nama Lengkap*</label>
                                                <input type="text" class="form-control" id="name5" name="nama" required>
                                                <span class="fa fa-pencil form-control-feedback"></span>
                                                <span class="help-block">Masukkan nama siswa</span>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputPassword5">Jenis Kelamin*</label>
                                                <select class="form-control js-states" name="jk" required>
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                            </div>   
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputPassword5">Kelas*</label>
                                                <select class="form-control js-states" name="kelas" required>
                                                    <option value="">Pilih Kelas</option>
                                                    <?php foreach ($kelas as $dataKelas): ?>
                                                        <option value="<?= $dataKelas['id_kelas']; ?>"><?= $dataKelas['kelas']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="fa fa-building-o form-control-feedback"></span>
                                            </div>                              
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputPassword5">Tahun Akademik*</label>
                                                <select class="form-control js-states" name="tahun_akademik" required>
                                                    <option value="">Pilih Tahun Akademik</option>
                                                    <?php foreach ($tahunaka as $row): ?>
                                                        <option value="<?= $row['id_tahunakademik']; ?>"> ( <?php $tglawal = date_create($row['tglawal']); echo date_format($tglawal,"Y"); ?> ) - ( <?php $tglakhir = date_create($row['tglakhir']); echo date_format($tglakhir,"Y"); ?> )</option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="fa fa-building-o form-control-feedback"></span>
                                            </div>                              
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="exampleInputEmail5">Tempat Lahir*</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail5" name="tempat_lahir" required>
                                                        <span class="fa fa-map-marker form-control-feedback mr-10"></span>
                                                        <span class="help-block">Masukkan Tempat Lahir Siswa</span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="exampleInputEmail5">Tanggal Lahir*</label>
                                                        <input type="date" class="form-control" id="exampleInputEmail5" name="tanggal_lahir" required>                                                        
                                                        <span class="help-block">Masukkan Tanggal Lahir Siswa</span>
                                                    </div>   
                                                </div>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputEmail5">Alamat lengkap*</label>
                                                <textarea class="form-control" id="exampleInputEmail5" name="alamat" required></textarea>
                                                <span class="fa fa-map-marker form-control-feedback"></span>
                                                <span class="help-block">Masukkan Alamat Siswa</span>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="js-states">Provinsi*</label>
                                                <select class="form-control s_provinsi js-states" id="provinsi" required name="prov">
                                                    <option value="">Pilih Provinsi</option>
                                                    <?php foreach ($prov as $dataProv): ?>
                                                        <option value="<?= $dataProv['id_provinsi']; ?>"><?= $dataProv['name_prov']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <!-- <span class="fa fa-map form-control-feedback"></span> -->
                                            </div>                                                                                
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputPassword5">Kota*</label>
                                                <select class="form-control s_kota js-states" name="kota" disabled id="selectKota" required >
                                                                                                    
                                                </select>
                                                <!-- <span class="fa fa-map form-control-feedback"></span> -->
                                            </div>                                                                                
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputPassword5">Kecamatan*</label>
                                                <select class="form-control s_kecamatan js-states" name="kecamatan" disabled id="selectKeca" required>
                                                                                                    
                                                </select>
                                                <!-- <span class="fa fa-map form-control-feedback"></span> -->
                                            </div>                                                                                
                                            <div class="form-group has-feedback">
                                                <a href="<?= base_url('siswa/') ?>" class="btn btn-primary btn-labeled"><i class="fa fa-arrow-left"></i>Kembali</a>
                                                <button type="Submit" class="btn btn-success btn-labeled">
                                                     <i class="fa fa-plus"></i> Tambah Data Siswa
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
