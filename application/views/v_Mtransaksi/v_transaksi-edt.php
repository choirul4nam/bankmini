	

                    <div class="main-page">
                        <div class="container-fluid bg-white">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">Ubah Master Transaksi</h2>
                                    <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>                                    
                                </div>
                                <!-- /.col-sm-6 -->
                                <!-- <div class="col-sm-6 right-side">
                                    <a class="btn bg-black toggle-code-handle tour-four" role="button">Toggle Code!</a>
                                </div> -->
                                <!-- /.col-sm-6 text-right -->
                            </div>
                            <form method="post" action="<?= base_url('mtransaksi/edit_process')  ?>" id="frm">
                                <input type="hidden" name="id_transaksi" value="<?= $transaksi->id_mastertransaksi;  ?>">
                                <div class="row panel">                            
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                                <label for="name5" style="font-size: 14px;">Kode Transaksi</label>
                                                <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" name="kodetransaksi" id="kodetransaksi" value="<?= $transaksi->kodetransaksi;?>" placeholder="Kode Transaksi" readonly required>
                                                <span class="input-group-btn">
                                                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalkorwil">
                                                    Tambah
                                                  </button>
                                                </span>
                                            </div>
                                                <span class="help-block">Masukkan Data</span>
                                            </div>
                                            <div class="form-group has-feedback">
		                                        <div class="row">
		                                        	<div class="col-lg-6">
                                                        <label for="exampleInputPassword5">Debet</label>                                     
                                                        <select class="form-control js-states" name="debet" id="debet">
                                                            <option value=" ">Pilih</option>   
                                                            <option value="siswa" <?php if ($transaksi->debet == 'siswa'){echo "selected";} ?>>Siswa</option>
                                                            <option value="koperasi" <?php if ($transaksi->debet == 'koperasi'){echo "selected";} ?>>Koperasi</option>
                                                        </select>                                           
                                                    </div>
                                                    <div class="col-lg-6">                                                     
                                                        <label for="exampleInputPassword5">Kredit</label>
                                                         <select class="form-control js-states" name="kredit" id="kredit">
                                                            <option value=" ">Pilih</option>      
                                                            <option value="siswa" <?php if ($transaksi->kredit == 'siswa'){echo "selected";} ?>>Siswa</option>
                                                            <option value="koperasi" <?php if ($transaksi->kredit == 'koperasi'){echo "selected";} ?>>Koperasi</option>
                                                         </select>
                                                    </div>
                                            	</div>
                                            </div>    

                                            <div class="form-group has-feedback">
                                                <label for="exampleInputEmail5">Kategori</label>
                                                <input type="text" class="form-control" id="exampleInputEmail5" name="kategori" value="<?= $transaksi->kategori;  ?>">
                                                <span class="fa fa-map-marker form-control-feedback"></span>
                                                <span class="help-block">Masukkan Kategori</span>
                                            </div>                                                                            
                                            <div class="form-group has-feedback">
                                                <label for="name5">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" cols="30" rows="5"><?= $transaksi->deskripsi;  ?></textarea>
                                                <span class="fa fa-pencil form-control-feedback"></span>
                                                <span class="help-block">Masukkan Deskripsi</span>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="name5">Nominal</label>
                                                <input type="text" class="form-control inputEdtNominal" id="inputNominal" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required name="no" value="<?= $transaksi->nominal;  ?>">
                                                <input type="hidden" name="nominal" id="nominal" value="<?= $transaksi->nominal;  ?>">                                      <span class="fa fa-pencil form-control-feedback"></span>
                                                <span class="help-block">Masukkan Nominal</span>
                                            </div>  
                                            <div class="form-group has-feedback">
                                                <a href="<?= base_url('mtransaksi/') ?>" class="btn btn-primary btn-labeled"><i class="fa fa-arrow-left"></i>Kembali</a>
                                                <button type="Submit" class="btn btn-warning btn-labeled">
                                                     <i class="fa fa-plus"></i> Ubah Data Transaksi
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
            <div class="modal fade" id="modalkorwil">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Format Kode Transaksi</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Format 1</label>
          <div class="col-sm-9">
            <div class="input-group">
              <div class="input-group-btn">
                <select class="form-control select2" id="kodeformat1" name="format1" class="btn btn-warning dropdown-toggle" onchange="embuh()">
                <option value=''>Pilih</option>
                  <option value='huruf'>Huruf</option>
                </select>

                <input type="text" class="form-control" id="texthuruf1" name="texthuruf" style="visibility:hidden">
              </div>
              <!-- /btn-group -->
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Format 2</label>
          <div class="col-sm-9">
            <div class="input-group">
              <div class="input-group-btn">
                <select class="form-control select2" id="format2" name="format2" class="btn btn-warning dropdown-toggle" onchange="embuhb()">
                <option value=''>Pilih</option>
                  <option value='tanggal'>Tanggal</option>
                </select>

                <input type="text" class="form-control" id="texthuruf2" name="texthuruf" style="visibility:hidden">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Format 3</label>
          <div class="col-sm-9">
            <div class="input-group">
              <div class="input-group-btn">
                <select class="form-control select2" id="format3" name="kota" class="btn btn-warning dropdown-toggle"  onchange="embuhc()">
                <option value=''>Pilih</option>
                  <option value='no'>No Urut</option>
                </select>

                <input type="text" class="form-control" id="texthuruf3" name="texthuruf" style="visibility:hidden">
              </div>
              <!-- /btn-group -->
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Penghubung</label>
          <div class="col-sm-9">
            <select class="form-control select2" id="penghubung" name="penghubung" style="width: 100%;" onchange="embuhhub()">
              <option value=''>Pilih</option>
              <option value='-'>-</option>
            </select>
          </div>
        </div>         
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Kode</label>
          <div class="col-sm-9">
            <div id ="kodefinal"></div>
            <input type="text" class="form-control" id="final" name="final" readonly >
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnsimpankodekorwil">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
            <script>
                mtransaksiEdit = true;
            </script>
