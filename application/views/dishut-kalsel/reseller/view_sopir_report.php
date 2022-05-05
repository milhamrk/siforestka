<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="#">Members</a></li>
                <li>Order Pengantaran Barang</li>
            </ul>
        </div>
    </div>
</div>
<div class="ps-vendor-dashboard pro" style='margin-top:10px'>
    <div class="container">
        <div class="ps-section__content">
            <?php include "menu-members.php"; ?>
            <!--<form class="ps-form--vendor-datetimepicker" action="index.html" method="get">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text" id="time-from">From</span></div>
                            <input class="form-control ps-datepicker" aria-label="Username" aria-describedby="time-from">
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text" id="time-form">To</span></div>
                            <input class="form-control ps-datepicker" aria-label="Username" aria-describedby="time-to">
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                        <button class="ps-btn"><i class="icon-sync2"></i> Update</button>
                    </div>
                </div>
            </form>-->
            <?php 
                echo $this->session->flashdata('message'); 
                $this->session->unset_userdata('message');
            ?>
            <div class="row">
                
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 ">
                    <?php
                      if (trim($row['foto'])=='' OR !file_exists("asset/foto_user/".$row['foto'])){
                        echo "<img class='img-thumbnail' style='width:100%' src='".base_url()."asset/foto_user/blank.png'>";
                      }else{
                        echo "<img class='img-thumbnail' style='width:100%' src='".base_url()."asset/foto_user/$row[foto]'>";
                      }
                    ?><div style='clear:both'><br></div>
                </div>
                
                <div class='col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 biodata notif'>
                          <?php 
                          if ($pending->num_rows()<=0){
                            echo "<div class='alert alert-info'><strong>INFORMASI</strong> - Halo kak, Saat ini Belum ada orderan untuk Kurir/Sopir. <br>Silahkan menunggu Orderan Jasa Sopirnya.</div>";
                          }

                          $no = 1;
                          foreach ($pending->result_array() as $row){
                          $total = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                          $produk = $this->db->query("SELECT * FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->num_rows();

                          echo "<div class='form-group row' style='margin-bottom:5px; background: #efefef;'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Waktu Transaksi</label>
                            <div class='col-sm-10'>
                              ".jam_tgl_indo($row['waktu_transaksi'])."
                          </div>
                          </div>

                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Invoice</label>
                            <div class='col-sm-10'>
                              <a href='".base_url()."konfirmasi/tracking/$row[kode_transaksi]'>$row[kode_transaksi]</a>
                            </div>
                          </div>

                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Alamat Jemput</b></label>
                            <div class='col-sm-10'>
                              <span>Pengirim : <b><a href='".base_url()."members/detail_reseller/$row[id_reseller]'><span class='text-primary text-uppercase'>$row[nama_reseller]</span></a></b> (+".format_telpon($row['no_telpon']).")<br> $row[alamat_lengkap], ".kecamatan($row['kecamatan_id_jual'],$row['kota_id_jual'])."</span>
                            </div>
                          </div>
                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Antar (Tujuan)</b></label>
                            <div class='col-sm-10'>
                              <span class='text-success'>Penerima : <b>$row[nama_lengkap]</b> (+".format_telpon($row['no_hp']).")<br> ".alamat($row['kode_transaksi'])."</span>
                            </div>
                          </div>
                          
                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Ongkir</b></label>
                            <div class='col-sm-10'>
                              <span class='text-danger'>Rp ".rupiah($row['ongkir'])." (Total $produk Produk)</span>
                            </div>
                          </div>
                          
                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Status</b></label>
                            <div class='col-sm-10'>
                              <b>".status($row['proses'])."</b>
                            </div>
                          </div><br>";
                            $no++;
                          }
                        ?>
                      
                    </div>
                    <div class="ps-pagination">
                        <?php // echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
              
