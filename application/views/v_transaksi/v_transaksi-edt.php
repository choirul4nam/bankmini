	

                    <div class="main-page">
                        <div class="container-fluid bg-white">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">Ubah Transaksi</h2>
                                    <p class="sub-title">SMA NEGERI 1 WRINGIN ANOM !</p>                                    
                                </div>
                                <!-- /.col-sm-6 -->
                                <!-- <div class="col-sm-6 right-side">
                                    <a class="btn bg-black toggle-code-handle tour-four" role="button">Toggle Code!</a>
                                </div> -->
                                <!-- /.col-sm-6 text-right -->
                            </div>
                            <form method="post" action="<?= base_url('transaksi/edit_process')  ?>" id="frm">
                                <input type="hidden" name="id_transaksi" value="<?= $transaksi->id_mastertransaksi;  ?>">
                                <div class="row panel">                            
                                    <div class="panel-body">
                                        <div class="col-md-8">
                                            <div class="form-group has-feedback">
                                                <label for="exampleInputEmail5">Kode Transaksi</label>
                                                <input type="text" class="form-control" id="exampleInputEmail5" name="kategori" value="<?= $transaksi->kodetransaksi;?>" disabled>
                                                <span class="fa fa-map-marker form-control-feedback"></span>
                                            </div> 
                                            <div class="form-group has-feedback">
		                                        <div class="row">
		                                        	<div class="col-lg-6">
		                                        		<label for="exampleInputPassword5">Debet</label>                                     
		                                        		<label>
		                                        			<input type="radio" name="debet" class="blue-style" value="siswa" <?php if($transaksi->debet == 'siswa'){echo'checked';} ?>> 
		                                        			Siswa
		                                        		</label>
		                                                <label>
		                                                	<input type="radio" name="debet" class="blue-style" value="sekolah" <?php if($transaksi->debet == 'sekolah'){echo'checked';} ?>> Sekolah                                           
		                                                </label>  
		                                        	</div>
		                                        	<div class="col-lg-6">                                            		   
	                                                	<label for="exampleInputPassword5">Kredit</label>
		                                                <label>
		                                                	<input type="radio" name="kredit" class="blue-style" value="siswa" <?php if($transaksi->kredit == 'siswa'){echo'checked';} ?>> 
		                                                	Siswa
		                                                </label>
		                                                <label>
		                                                	<input type="radio" name="kredit" class="blue-style" value="sekolah" <?php if($transaksi->kredit == 'sekolah'){echo'checked';} ?>> Sekolah                                           
		                                                </label>     
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
                                                <input type="text" class="form-control" id="name5" name="deskripsi" value="<?= $transaksi->deskripsi;  ?>">
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
                                                <a href="<?= base_url('transaksi/') ?>" class="btn btn-primary btn-labeled"><i class="fa fa-arrow-left"></i>Kembali</a>
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
