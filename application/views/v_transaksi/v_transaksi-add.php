	

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
                            <form method="post" action="<?= base_url('transaksi/add_process')  ?>" id="frm">
                                <div class="row panel">                            
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <div class="form-group has-feedback">
		                                        <div class="row">
		                                        	<div class="col-lg-6">
		                                        		<label for="exampleInputPassword5">Debet</label>                                     
                                                        <select class="form-control" name="debet" id="debet">
                                                            <option value=" ">Pilih</option>   
                                                            <option value="siswa">Siswa</option>
                                                            <option value="sekolah">Sekolah</option>
                                                        </select>	                                        
		                                        	</div>
		                                        	<div class="col-lg-6">                                            		   
	                                                	<label for="exampleInputPassword5">Kredit</label>
		                                                 <select class="form-control" name="kredit" id="kredit">
                                                            <option value=" ">Pilih</option>      
                                                            <option value="siswa">Siswa</option>
                                                            <option value="sekolah">Sekolah</option>
                                                         </select>
		                                            </div>
                                            	</div>
                                            </div>    

                                            <div class="form-group has-feedback">
                                                <label for="exampleInputEmail5">Kategori</label>
                                                <input type="text" class="form-control" id="exampleInputEmail5" name="kategori" required>
                                                <span class="fa fa-map-marker form-control-feedback"></span>
                                                <span class="help-block">Masukkan Kategori</span>
                                            </div>                                                                            
                                            <div class="form-group has-feedback">
                                                <label for="name5">Deskripsi</label>
                                                <input type="text" class="form-control" id="name5" name="deskripsi" required>
                                                <span class="fa fa-pencil form-control-feedback"></span>
                                                <span class="help-block">Masukkan Deskripsi</span>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="name5">Nominal</label>
                                                <input type="text" class="form-control" id="inputNominal" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required name="no">
                                                <input type="hidden" name="nominal" id="nominal">                                                
                                                <span class="fa fa-pencil form-control-feedback"></span>
                                                <span class="help-block">Masukkan Nominal</span>
                                            </div>  
                                            <div class="form-group has-feedback">
                                                <a href="<?= base_url('transaksi/') ?>" class="btn btn-primary btn-labeled"><i class="fa fa-arrow-left"></i>Kembali</a>
                                                <button type="Submit" class="btn btn-success btn-labeled">
                                                     <i class="fa fa-plus"></i> Lanjut Transaksi
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
