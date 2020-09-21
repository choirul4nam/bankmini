
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                    <div class="left-sidebar fixed-sidebar bg-black-300 box-shadow tour-three">
                        <div class="sidebar-content">
                            <div class="user-info closed">
                                <img src="http://placehold.it/90/c2c2c2?text=User" alt="John Doe" class="img-circle profile-img">
                                <h6 class="title">John Doe</h6>
                                <small class="info">PHP Developer</small>
                            </div>
                            <!-- /.user-info -->

                            <div class="sidebar-nav">
                                <ul class="side-nav color-gray">
                                    <li class="nav-header">
                                        <span class="">Menu Utama</span>
                                    </li>
                                    <li >
                                        <a href="<?= base_url('') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                                    </li>

                                    <li class="nav-header">
                                        <span class="">PILIHAN MENU</span>
                                    </li>
                                    <?php foreach ($menu as $menu) {
                                    $a = $menu->id_menu ?>
                                        
                                    <li class="has-children">
                                        <a href="#"><i class="fa fa-file-text"></i> <span><?php echo $menu->menu; ?></span> <i class="fa fa-angle-right arrow"></i></a>

                                        <ul class="child-nav">
                                         <?php 
                                         $idtipe = $this->session->userdata('tipeuser');
                                         $submenus = $this->db->query("select * from tb_akses INNER JOIN tb_submenu on tb_submenu.id_submenu = tb_akses.id_submenu where tb_submenu.id_menus = '$a' and tb_submenu.statusmenu = 'aktif' and tb_akses.view = '1' and tb_akses.id_tipeuser = '$idtipe' "); 
                                              foreach ($submenus->result() as $submenu) { ?>
                                              <li><a href="<?php echo site_url($submenu->linksubmenu); ?>"><i class="fa fa-circle-o"></i><span> <?php echo $submenu->submenu; ?></span></a></li>    
                                              <?php } ?>
                                        </ul>
                                    </li>

                                    <?php } ?>
                                </ul>
                            </div>
                            <!-- /.sidebar-nav -->
                        </div>
                        <!-- /.sidebar-content -->
                    </div>
                    <!-- /.left-sidebar -->