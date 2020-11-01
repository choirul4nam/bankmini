	

  <div class="main-page">
      <div class="container-fluid bg-white">
          <div class="row page-title-div">
              <div class="col-sm-6">
                  <h2 class="title">Transaksi</h2>
                  <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>                                    
              </div>
              <!-- /.col-sm-6 -->
              <!-- <div class="col-sm-6 right-side">
                  <a class="btn bg-black toggle-code-handle tour-four" role="button">Toggle Code!</a>
              </div> -->
              <!-- /.col-sm-6 text-right -->
          </div>
              <div class="panel">                            
                  <div class="panel-body"> 
                    <div class="row">
                        <div class="col-lg-9">
                            <?= $this->session->flashdata('alert'); ?>
                            <div class="alert alert-danger left-icon-alert" id="warning" role="alert" style="display: none;">
                                <strong>Perhatian!</strong> Saldo Tidak Cukup.
                            </div>
                        </div>
                    </div>
                    <div class="row">                                      
                      <div class="col-md-6 col-md-6 col-sm-12">   
                        <i>( * ) Wajib di Isi</i>
                          <div class="form-group">
                            <label for="exampleInputPassword5" style="font-size: 15px;">Pilih Tipe Transaksi*</label>                                     
                            <select class="form-control js-states tipeuserAdd inpCus" id="js-states" name="tipeuser" required > 
                                <option value="salah">Pilih Tipe User</option>
                                <?php foreach ($tipeuser as $tipeuser) { ?>
                                    <?php if($tipeuser['tipeuser'] != 'koperasi'): ?>
                                      <option value="<?=$tipeuser['id_tipeuser'];?>"><?= ucwords($tipeuser['tipeuser']); ?></option>
                                    <?php endif; ?>
                                <?php } ?>                                                          
                            </select>	
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword5" style="font-size: 15px;">Cari Nama*</label>
                            <select class="form-control inpt selectJS js-states cusName inpCus" id="js-states" disabled required>
                            
                            </select>      
                          </div>   

                          <div class="form-group has-feedback">
                              <label for="exampleInputEmail5" style="font-size: 15px;">Transaksi*</label>
                              <select class="form-control inpt js-states kategori inpCus" id="js-states" disabled required>
                                  
                              </select>	  
                          </div>       

                          <div class="form-group has-feedback">                     
                          <form method="post" action="<?= base_url('transaksi/add_process')  ?>" id="frm">        
                              <input type="hidden" name="id_jenistransaksi" id="id_jenistransaksi">                                                             		   
                              <input type="hidden" name="usertipe" id="usertipe">                                                              		   
                              <input type="hidden" name="id_customer" id="id_customer">                                                        	                             
                              <input type="hidden" name="sisasaldo" id="sisasaldo">                                                                                        
                              <input type="hidden" name="tipeTransaksi" id="tipeTransaksi">                                                        
                              </div>                                                                                                                    
                              <div class="form-group has-feedback">
                                  <label for="name5" style="font-size: 15px;">Kode Transaksi*</label>
                                  <input type="hidden" name="kode_transaksi" id="kode_transaksi">                                                              		   
                                  <input type="text" class="form-control inpCus" disabled id="kode" style="font-size: 18px; font-weight: 500;">
                              <span class="fa fa-pencil form-control-feedback"></span>
                              <span class="help-block">Kode Transaksi</span>
                          </div>

                          <div class="form-group has-feedback">
                              <label for="name5" style="font-size: 15px;">Keterangan*</label>
                              <textarea class="form-control inpt inpCus" disabled id="keterangan" name="keterangan" required style="font-size: 18px; font-weight: 500;" cols="30" rows="3"></textarea>
                              <span class="fa fa-pencil form-control-feedback"></span>
                              <span class="help-block">Masukkan Keterangan</span>
                          </div> 

                          <div class="form-group has-feedback">
                              <a href="<?= base_url('transaksi/') ?>" class="btn btn-primary btn-labeled"><i class="fa fa-arrow-left"></i>Kembali</a>
                              <button name="action" type="submit" class="btn btn-success btn-labeled btnAdd" value="cetak" disabled>
                                <i class="fa fa-plus"></i> Cetak Dan Simpan
                              </button>
	                            <button name="action" type="submit" class="btn btn-danger btn-labeled btnAdd" value="simpan" disabled>
                                <i class="fa fa-plus"></i> Simpan
                              </button>
                          </div>                                             
                      </div>

                      <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="cotainer-fluid" style="margin: 0px; padding: 0px;">                      
                              <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12 mt-25">
                                    <div class="form-group has-feedback">
                                        <label for="name5" style="font-size: 15px;">Nominal*</label>
                                        <input type="text" class="form-control nominalInp inpt inpCus" id="" style="font-size: 60px; text-align: right; font-weight: 600; height: 80px; background: #f7f774; color: #000;" disabled onkeypress='return event.charCode >= 48 && event.charCode <= 57' required name="no">
                                        <input type="hidden" name="nominal" id="nominal">                                                
                                        <span class="fa fa-pencil form-control-feedback"></span>                                        
                                    </div>  
                                  </div>
                              </div>                          
                              <div class="row">
                                <div class="col-lg-12 col-md-12 co-sm-12">
                                    <div class="row">
                                      <div class="col-lg-12 col-md-12 sm-12">
                                        <div class="pull-right w-100">
                                          <table class="bg-danger">
                                              <tr style="font-size: 25px;">
                                                <td style="width: 180px;">Sisa Saldo</td>
                                                <td style="width: 2px;">:</td>
                                                <td id="saldoBox" style="text-align: right;">Rp. <?= number_format(0); ?></td>
                                              </tr>
                                          </table>
                                        </div>                        
                                      </div>
                                    </div>                                                   
                                    <!-- <div class="table-responsive"> -->
                                    <h4 style="margin: 0; padding: 0; display: inline;">Histori Transaksi</h4>
                                    <!-- <div class="border-danger no-border border-3-top"> -->
                                      <table id="tb_histori" class="display table nowrap" style="max-width:none !important;">
                                        <thead>
                                          <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Nominal</th>
                                            <th><center>Tipe Transaksi</center></th>
                                          </tr>
                                        </thead>
                                        <tbody id="box-transaksi">      
                                                                          
                                        </tbody>
                                      </table>                                      
                                      <!-- </div> -->
                                </div>
                              </div>
                          </div>
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
<script>
transaksi = true;
</script>
