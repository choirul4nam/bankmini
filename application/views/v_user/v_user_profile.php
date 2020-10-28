<div class="main-page" style="height: 100%;">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-md-6">
                <h4 class="title"><?= $this->session->userdata('nama') ?> <small class="ml-10">(Administrator)</small></h4>
                <p class="sub-title">SIMBMS (Sistem Informasi Bank Mini Sekolah)</p>
            </div>
        </div>
        <!-- /.row -->
            <div class="row">
                <div class="col-lg-9 mt-20">
                    <?= $this->session->flashdata('message'); ?>                                        
                </div>
            </div>
        <div class="row mt-10">
            <div class="col-md-12">
                <div class="panel border-primary no-border border-3-top">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h5>Profile</h5>
                        </div>                                           
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="<?= base_url() ?>assets/Theme/images/avatar-1.svg" alt="User Avatar" class="img-responsive">
                                <a href="<?= base_url('ubah-profile') ?>" class="btn btn-info pull-right mr-5 mt-20 mb-20">
                                    <i class="fa fa-edit"></i>
                                    Ubah Profil
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="list-group">
                                    <div class="list-group-item">
                                        Nama : <?= $users->nama ?>
                                    </div>
                                    <div class="list-group-item">
                                        Username : <?= $users->username ?>
                                    </div>
                                </div>                                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.panel -->
    </div>
        <!-- /.col-md-3 -->

        
        <!-- /.col-md-9 -->
    </div>
    <!-- /.row -->
</div>