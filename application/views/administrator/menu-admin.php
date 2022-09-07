        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
            <?php $usr = $this->model_app->view_where('users', array('username'=> $this->session->username))->row_array();
                  if (trim($usr['foto'])==''){ $foto = 'blank.png'; }else{ $foto = $usr['foto']; } ?>
            <img src="<?php echo base_url(); ?>/asset/foto_user/<?php echo $foto; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <?php echo "<p>$usr[nama_lengkap]</p>"; ?>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header" style='text-transform:uppercase;'>MENU <span class='uppercase'><?php echo $this->session->level; ?></span></li>
            <li><a href="<?php echo base_url().$this->uri->segment(1); ?>/home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-th-list"></i> <span>Menu Utama</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("identitaswebsite",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/identitaswebsite'><i class='fa fa-circle-o'></i> Identitas Website</a></li>";
                }

                $cek=$this->model_app->umenu_akses("logowebsite",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/logowebsite'><i class='fa fa-circle-o'></i> Logo Website</a></li>";
                }

                $cek=$this->model_app->umenu_akses("templatewebsite",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/templatewebsite'><i class='fa fa-circle-o'></i> Template Website</a></li>";
                }

                $cek=$this->model_app->umenu_akses("background",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/background'><i class='fa fa-circle-o'></i> Background Website</a></li>";
                }

                $cek=$this->model_app->umenu_akses("menuwebsite",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/menuwebsite'><i class='fa fa-circle-o'></i> Menu Website</a></li>";
                }

                $cek=$this->model_app->umenu_akses("album",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/album'><i class='fa fa-circle-o'></i> Gallery</a></li>";
                }

                $cek=$this->model_app->umenu_akses("halamanbaru",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/halamanbaru'><i class='fa fa-circle-o'></i> Halaman Baru</a></li>";
                }

                /* $cek=$this->model_app->umenu_akses("donasi",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/donasi'><i class='fa fa-circle-o'></i> Data Donasi</a></li>";
                } */
               
		$cek=$this->model_app->umenu_akses("download",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/download'><i class='fa fa-circle-o'></i> Download Area</a></li>";
                }


		


                $cek=$this->model_app->umenu_akses("subscribe",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/subscribe'><i class='fa fa-circle-o'></i> E-mail Subscribe</a></li>";
                }
              ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-th-large"></i> <span>Master Market</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?php 
                  $cek=$this->model_app->umenu_akses("konsumen",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/konsumen'><i class='fa fa-circle-o'></i> Konsumen</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("reseller",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/reseller'><i class='fa fa-circle-o'></i> Penjual / Pelapak</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("sopir",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/sopir'><i class='fa fa-circle-o'></i> Sopir / Kurir Internal</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("paket",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/paket'><i class='fa fa-circle-o'></i> Paket Penjual</a></li>";
                  }

                  /* $cek=$this->model_app->umenu_akses("supplier",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/supplier'><i class='fa fa-circle-o'></i> Supplier</a></li>";
                  } */

                  $cek=$this->model_app->umenu_akses("kategori_produk",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/kategori_produk'><i class='fa fa-circle-o'></i> Kategori Produk</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("kategori_produk",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/kategori_produk_sub'><i class='fa fa-circle-o'></i> Sub-Kategori Produk</a></li>";
                  }

                  //$cek=$this->model_app->umenu_akses("tagpro",$this->session->id_session);
                  //if($cek==1 OR $this->session->level=='admin'){
                    //echo "<li><a href='".base_url().$this->uri->segment(1)."/tagpro'><i class='fa fa-circle-o'></i> Merek Produk</a></li>";
                  //}

                  $cek=$this->model_app->umenu_akses("produk",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/produk'><i class='fa fa-circle-o'></i> Produk</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("rekening",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/rekening'><i class='fa fa-circle-o'></i> Rekening Perusahaan</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("imagesslider",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/imagesslider'><i class='fa fa-circle-o'></i> Image Slider</a></li>";
                  }

                  //$cek=$this->model_app->umenu_akses("ppob_margin",$this->session->id_session);
                  //if($cek==1 OR $this->session->level=='admin'){
                    //echo "<li><a href='".base_url().$this->uri->segment(1)."/ppob_margin'><i class='fa fa-circle-o'></i> Margin PPOB</a></li>";
                  //}

                  $cek=$this->model_app->umenu_akses("ongkir_driver",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/ongkir_driver'><i class='fa fa-circle-o'></i> Ongkir Kurir Internal</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("kurir_rajaongkir",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/kurir_rajaongkir'><i class='fa fa-circle-o'></i> Kurir Rajaongkir</a></li>";
                  }

                ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-shopping-cart"></i> <span>Transaksi Market</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?php 
                  /* $cek=$this->model_app->umenu_akses("penawaran",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/penawaran'><i class='fa fa-circle-o'></i> Flash Deal / Penawaran</a></li>";
                  } */
                  
                  /* $cek=$this->model_app->umenu_akses("pembelian",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/pembelian'><i class='fa fa-circle-o'></i> Perusahaan ke Supplier</a></li>";
                  } */

                  /* $cek=$this->model_app->umenu_akses("penjualan",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/penjualan'><i class='fa fa-circle-o'></i> Penjualan ke Penjual</a></li>";
                  } */

                  $cek=$this->model_app->umenu_akses("pembayaran_reseller",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/pembayaran_reseller'><i class='fa fa-circle-o'></i> Pembayaran Penjual</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("penjualan_konsumen",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/penjualan_konsumen'><i class='fa fa-circle-o'></i> Penjualan ke Konsumen</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("komplain",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/komplain'><i class='fa fa-circle-o'></i> Komplain Orders</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("pembayaran_konsumen",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/pembayaran_konsumen'><i class='fa fa-circle-o'></i> Konf. Order Konsumen</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("mutasi",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/mutasi'><i class='fa fa-circle-o'></i> Data Mutasi Bank</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("withdraw",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/withdraw'><i class='fa fa-circle-o'></i> Trans. Withdraw</a></li>";
                  }

                  /* $cek=$this->model_app->umenu_akses("reseller_paket",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/reseller_paket'><i class='fa fa-circle-o'></i> Trans. Paket Penjual</a></li>";
                  } */

                ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-book"></i> <span>Report Market</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?php 
                  $cek=$this->model_app->umenu_akses("reseller_transaksi",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/reseller_transaksi'><i class='fa fa-circle-o'></i> Rekap Transaksi</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("testimoni",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/testimoni'><i class='fa fa-circle-o'></i> Testimoni Konsumen</a></li>";
                  }
                ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-pencil"></i> <span>Modul Berita</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("listberita",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/listberita'><i class='fa fa-circle-o'></i> Berita</a></li>";
                }

                $cek=$this->model_app->umenu_akses("listopini",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/listopini'><i class='fa fa-circle-o'></i> Opini Publik</a></li>";
                }

                $cek=$this->model_app->umenu_akses("kategoriberita",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/kategoriberita'><i class='fa fa-circle-o'></i> Kategori Berita</a></li>";
                }

                $cek=$this->model_app->umenu_akses("tagberita",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/tagberita'><i class='fa fa-circle-o'></i> Tag Berita</a></li>";
                }

                $cek=$this->model_app->umenu_akses("komentarberita",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/komentarberita'><i class='fa fa-circle-o'></i> Komentar Berita</a></li>";
                }
              ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-blackboard"></i> <span>Modul Iklan</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("iklanatas",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/edit_iklanatas'><i class='fa fa-circle-o'></i> Iklan Popup</a></li>";
                }

                $cek=$this->model_app->umenu_akses("iklanhome",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/iklanhome'><i class='fa fa-circle-o'></i> Iklan Home</a></li>";
                }

                $cek=$this->model_app->umenu_akses("iklansidebar",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/iklansidebar'><i class='fa fa-circle-o'></i> Iklan Sidebar</a></li>";
                }

                $cek=$this->model_app->umenu_akses("banner",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/banner'><i class='fa fa-circle-o'></i> Iklan Link</a></li>";
                }
              ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-users"></i> <span>Modul Users</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("manajemenuser",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/manajemenuser'><i class='fa fa-circle-o'></i> Manajemen User</a></li>";
                }

                $cek=$this->model_app->umenu_akses("manajemenmodul",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/manajemenmodul'><i class='fa fa-circle-o'></i> Manajemen Modul</a></li>";
                }
              ?>
              </ul>
            </li>
            
            <li><a href="<?php echo base_url().$this->uri->segment(1); ?>/edit_manajemenuser/<?php echo $this->session->username; ?>"><i class="fa fa-edit"></i> <span>Edit Profile</span></a></li>
            <li><a href="<?php echo base_url().$this->uri->segment(1); ?>/logout"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
          </ul>
        </section>