	

                    <div class="main-page">
                        <div class="container-fluid bg-white">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">Transaksi</h2>
                                    <p class="sub-title">SMA NEGERI 1 WRINGIN ANOM !</p>                                    
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
                                        <div class="col-md-8">
                                            <div class="form-group has-feedback">
		                                        <div class="row">
		                                        	<div class="col-lg-6">
		                                        		<label for="exampleInputPassword5">Debet</label>                                     
		                                        		<label class="debet-siswa">
		                                        			<input type="radio" name="debet" value="siswa" class="blue-style"> 
		                                        			Siswa
		                                        		</label>
		                                                <label class="debet-sekolah">
		                                                	<input type="radio" name="debet" value="sekolah"  class="blue-style"> 
                                                            Sekolah                                           
		                                                </label>  
		                                        	</div>
		                                        	<div class="col-lg-6">                                            		   
	                                                	<label for="exampleInputPassword5">Kredit</label>
		                                                <label>
		                                                	<input type="radio" name="kredit" value="siswa"  class="blue-style" id="kredit-siswa"> 
		                                                	Siswa
		                                                </label>
		                                                <label class="kredit-sekolah" id="kredit-sekolah">
		                                                	<input type="radio" name="kredit" value="sekolah"  class="blue-style"> 
                                                            Sekolah                                           
		                                                </label>     
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
