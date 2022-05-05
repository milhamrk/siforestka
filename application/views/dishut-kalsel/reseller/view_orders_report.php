<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="#">Members</a></li>
                <li>Profile</li>
            </ul>
        </div>
    </div>
</div>

<div class="ps-vendor-dashboard pro" style='margin-top:10px'>
    <div class="container">
        <div class="ps-section__content">
            <?php include "menu-members.php"; ?>
            
            <?php 
                echo $this->session->flashdata('message'); 
                $this->session->unset_userdata('message');

                if ($dikirim->num_rows()>=1){
                  $blink = 'blink_me';
                }
            ?>
            <div class="row">
                
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 ">
                    <?php
                      include "sidebar-members.php";
                    ?><div style='clear:both'><br></div>
                </div>
                
                <div class='col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 biodata notif'>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Menunggu Pembayaran <span class="badge badge-secondary"><?php echo total_order('0',$this->session->id_konsumen); ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="proses-tab" data-toggle="tab" href="#proses" role="tab" aria-controls="proses" aria-selected="false">Pesanan Diproses <span class="badge badge-secondary"><?php echo total_order('1',$this->session->id_konsumen); ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  id="dikirim-tab" data-toggle="tab" href="#dikirim" role="tab" aria-controls="dikirim" aria-selected="false">Sedang Dikirim <span class="badge badge-secondary"><?php echo total_order('3',$this->session->id_konsumen); ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab" aria-controls="selesai" aria-selected="false">Sampai Tujuan <span class="badge badge-secondary"><?php echo total_order('4',$this->session->id_konsumen); ?></span></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent"><br>
                      <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <?php 
						  
                          if ($pending->num_rows()<=0){
                            echo "<div class='alert alert-info'><strong>INFORMASI</strong> - Halo kak, Saat ini Belum ada orderan status Pending. <br> Yuk Lihat-lihat dulu produk yang mungkin dibutuhkan <a href='".base_url()."produk' style='color:#000'><b>disini</b></a>.</div>";
                          }
						  
                          $no = 1;
                          foreach ($pending->result_array() as $row){
						  $kode=$row['kode_transaksi'];
						  $hasil=substr($kode,0,5);
						  
                          $total = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                          $produk = $this->db->query("SELECT * FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->num_rows();
                          $kupon = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
                                JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
                                    where b.id_penjualan='$row[id_penjualan]'")->row_array();

                          echo "<div class='form-group row' style='margin-bottom:5px; background: #efefef;'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Waktu Transaksi</label>
                            
							
							<div class='col-sm-10'>
                              ".jam_tgl_indo($row['waktu_transaksi'])."
                              <span class='pull-right'>";
							  if ($hasil=='TIKET'){
								  echo "
								  <a href='".base_url()."konfirmasi/tiket/$row[kode_transaksi]'>Tagihan</a> |
								  <a class='text-info' title='Detail data pesanan' href='".base_url()."members/keranjang_detail/$row[id_penjualan]'>Detail</a>"; 
							  }else{
								  echo "
                              <a href='".base_url()."konfirmasi/tracking/$row[kode_transaksi]'>Tagihan</a> | 
                              <a class='text-info' title='Detail data pesanan' href='".base_url()."members/keranjang_detail/$row[id_penjualan]'>Detail</a> | 
                              <a class='text-danger' title='Detail data pesanan' href='".base_url()."konfirmasi/index?kode=$row[kode_transaksi]'>Konfirmasi Bayar</a>";
							  }
							  echo "
							  
                              </span>
                              </div>
                          </div>

                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Invoice / Penjual</label>
                            <div class='col-sm-10'>
                              <a href='".base_url()."konfirmasi/tracking/$row[kode_transaksi]'>$row[kode_transaksi]</a> / 
                              <a href='".base_url()."u/$row[user_reseller]'><span class='text-success text-uppercase'>$row[nama_reseller]</span></a><br>
                            </div>
                          </div>

                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Status</b></label>
                            <div class='col-sm-10'>
                            ".status($row['proses']).' '.status_pembayaran($row['proses'],$row['kode_transaksi']);
                              if ($row['proses']=='3'){
                                  echo ",<br>Sudah Terima Barang? 
                                  <a style='color:#fff; padding:10px 25px; line-height:1px; font-weight:300' class='ps-btn' href='".base_url()."members/orders_report?sukses=$row[id_penjualan]' onclick=\"return confirm('Apa anda yakin sudah menerima Pesanan?')\">Sudah</a> 
                                  <a style='padding:10px 25px; line-height:1px; font-weight:300' class='ps-btn' href='".base_url()."members/keranjang_detail/$row[id_penjualan]' onclick=\"return confirm('Yuk Telusuri / Lacak Pesanan anda?')\">Belum</a>";
                              }
                            echo "</div>
                          </div>
                          
                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Total Belanja</b></label>
                            <div class='col-sm-10'>
                              <b class='text-danger'>Rp ".rupiah($total['total']+$row['ongkir']-$kupon['diskon'])." ($produk Produk)</b>
                            </div>
                          </div>";
                            if ($row['group_order']!=''){
                              $ex = explode('.',$row['group_order']);
                              $total_group = $this->db->query("SELECT * FROM rb_penjualan where group_order='$row[group_order]' AND proses!='0'");
                              if ($total_group->num_rows()>=$ex[1]){
                                $total_menunggu = "<i style='color:green'>(Kuota Group Order telah Terpenuhi!)</i>";
                              }else{
                                $total_menunggu = "<i style='color:red'>(Menunggu ".($ex[1]-$total_group->num_rows())." Orderan Lagi)</i>";
                              }
                              echo "<div class='form-group row' style='margin-bottom:5px'>
                              <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Group Order</b></label>
                                <div class='col-sm-10' style='background:bisque'>
                                  <span>Kode : <b>$row[group_order]</b><br>Beli Ber-$ex[1] $total_menunggu</span>
                                </div>
                              </div>";
                            }
                          echo "<br>";
                            $no++;
                          }
                        ?>
                      </div>

                      <div class="tab-pane fade" id="proses" role="tabpanel" aria-labelledby="proses-tab">
                      <?php 
                          if ($proses->num_rows()<=0){
                            echo "<div class='alert alert-info'><strong>INFORMASI</strong> - Halo kak, Saat ini Belum ada orderan dengan status Proses. <br> Yuk Lihat-lihat dulu produk yang mungkin dibutuhkan <a href='".base_url()."produk' style='color:#000'><b>disini</b></a>.</div>";
                          }

                          $no = 1;
                          foreach ($proses->result_array() as $row){
                          $total = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                          $produk = $this->db->query("SELECT * FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->num_rows();
                          $kupon = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
                                JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
                                    where b.id_penjualan='$row[id_penjualan]'")->row_array();
                          echo "<div class='form-group row' style='margin-bottom:5px; background: #efefef;'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Waktu Transaksi</label>
                            <div class='col-sm-10'>
                              ".jam_tgl_indo($row['waktu_transaksi'])."
                              <a class='text-info pull-right' title='Detail data pesanan' href='".base_url()."members/keranjang_detail/$row[id_penjualan]'>Lihat Pesanan / Pengiriman</a> 
                          </div>
                          </div>

                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Invoice / Seller</label>
                            <div class='col-sm-10'>
                              <a href='".base_url()."konfirmasi/tracking/$row[kode_transaksi]'>$row[kode_transaksi]</a> / 
                              <a href='".base_url()."u/$row[user_reseller]'><span class='text-success text-uppercase'>$row[nama_reseller]</span></a><br>
                            </div>
                          </div>

                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Status</b></label>
                            <div class='col-sm-10'>
                              ".status($row['proses'])."";
                              if ($row['proses']=='2'){
                                echo ",<br>Apa ada masalah?"; 
                                $cek_exist = $this->db->query("SELECT id_pusat_bantuan  FROM rb_pusat_bantuan where id_penjualan='$row[id_penjualan]'");
                                if ($cek_exist->num_rows()>=1){
                                  $room = $cek_exist->row_array();
                                  echo "<a style='padding:10px 25px; line-height:1px; font-weight:300; color:#fff' class='ps-btn red-btn' href='".base_url()."komplain/room/$room[id_pusat_bantuan]'>Komplain</a>";
                                }else{
                                  echo "<a style='padding:10px 25px; line-height:1px; font-weight:300; color:#fff' class='ps-btn red-btn resolusi' data-id='$row[id_penjualan]' href='#'>Komplain</a>";
                                }
                            }
                            echo "</div>
                          </div>
                          
                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Total Belanja</b></label>
                            <div class='col-sm-10'>
                              <b class='text-danger'>Rp ".rupiah($total['total']+$row['ongkir']-$kupon['diskon'])." ($produk Produk)</b>
                            </div>
                          </div>";
                          
                          if ($row['group_order']!=''){
                            $ex = explode('.',$row['group_order']);
                            $total_group = $this->db->query("SELECT * FROM rb_penjualan where group_order='$row[group_order]' AND proses!='0'");
                            if ($total_group->num_rows()>=$ex[1]){
                              $total_menunggu = "<i style='color:green'>(Kuota Group Order telah Terpenuhi!)</i>";
                            }else{
                              $total_menunggu = "<i style='color:red'>(Menunggu ".($ex[1]-$total_group->num_rows())." Orderan Lagi)</i>";
                            }
                            echo "<div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Group Order</b></label>
                              <div class='col-sm-10' style='background:bisque'>
                                <span>Kode : <b>$row[group_order]</b><br>Beli Ber-$ex[1] $total_menunggu</span>
                              </div>
                            </div>";
                          }
                        echo "<br>";
                            $no++;
                          }
                        ?>
                      </div>

                      <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim-tab">
                      <?php 
                          if ($dikirim->num_rows()<=0){
                            echo "<div class='alert alert-info'><strong>INFORMASI</strong> - Halo kak, Saat ini Belum ada orderan status Dikirim. <br> Yuk Lihat-lihat dulu produk yang mungkin dibutuhkan <a href='".base_url()."produk' style='color:#000'><b>disini</b></a>.</div>";
                          }

                          $no = 1;
                          foreach ($dikirim->result_array() as $row){
                          $total = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                          $produk = $this->db->query("SELECT * FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->num_rows();
                          $kupon = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
                                JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
                                    where b.id_penjualan='$row[id_penjualan]'")->row_array();
                          echo "<div class='form-group row' style='margin-bottom:5px; background: #efefef;'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Waktu Transaksi</label>
                            <div class='col-sm-10'>
                              ".jam_tgl_indo($row['waktu_transaksi'])."
                              <a class='text-info pull-right' title='Detail data pesanan' href='".base_url()."members/keranjang_detail/$row[id_penjualan]'>Lihat Pesanan / Pengiriman</a> 
                          </div>
                          </div>

                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Invoice / Seller</label>
                            <div class='col-sm-10'>
                              <a href='".base_url()."konfirmasi/tracking/$row[kode_transaksi]'>$row[kode_transaksi]</a> / 
                              <a href='".base_url()."u/$row[user_reseller]'><span class='text-success text-uppercase'>$row[nama_reseller]</span></a><br>
                            </div>
                          </div>

                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Status</b></label>
                            <div class='col-sm-10'>
                              ".status($row['proses'])."";
                              if ($row['proses']=='3'){
                                  echo ",<br>Sudah Terima Barang? 
                                  <a style='color:#fff; padding:10px 25px; line-height:1px; font-weight:300' class='ps-btn' href='".base_url()."members/orders_report?sukses=$row[id_penjualan]' onclick=\"return confirm('Apa anda yakin sudah menerima Pesanan?')\">Sudah</a> "; 
                                  /*$cek_exist = $this->db->query("SELECT id_pusat_bantuan  FROM rb_pusat_bantuan where id_penjualan='$row[id_penjualan]'");
				                          if ($cek_exist->num_rows()>=1){
                                    $room = $cek_exist->row_array();
                                    echo "<a style='padding:10px 25px; line-height:1px; font-weight:300; color:#fff' class='ps-btn red-btn' href='".base_url()."komplain/room/$room[id_pusat_bantuan]'>Komplain</a>";
                                  }else{
                                    echo "<a style='padding:10px 25px; line-height:1px; font-weight:300; color:#fff' class='ps-btn red-btn resolusi' data-id='$row[id_penjualan]' href='#'>Komplain</a>";
                                  }*/
                              }
                            echo "</div>
                          </div>
                          
                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Total Belanja</b></label>
                            <div class='col-sm-10'>
                              <b class='text-danger'>Rp ".rupiah($total['total']+$row['ongkir']-$kupon['diskon'])." ($produk Produk)</b>
                            </div>
                          </div>";
                          if ($row['group_order']!=''){
                            $ex = explode('.',$row['group_order']);
                            $total_group = $this->db->query("SELECT * FROM rb_penjualan where group_order='$row[group_order]' AND proses!='0'");
                            if ($total_group->num_rows()>=$ex[1]){
                              $total_menunggu = "<i style='color:green'>(Kuota Group Order telah Terpenuhi!)</i>";
                            }else{
                              $total_menunggu = "<i style='color:red'>(Menunggu ".($ex[1]-$total_group->num_rows())." Orderan Lagi)</i>";
                            }
                            echo "<div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Group Order</b></label>
                              <div class='col-sm-10' style='background:bisque'>
                                <span>Kode : <b>$row[group_order]</b><br>Beli Ber-$ex[1] $total_menunggu</span>
                              </div>
                            </div>";
                          }
                        echo "<br>";
                            $no++;
                          }
                        ?>
                      </div>

                      <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                      <?php 
                          if ($selesai->num_rows()<=0){
                              echo "<div class='alert alert-info'><strong>INFORMASI</strong> - Halo kak, Saat ini Belum ada orderan status Selesai. <br> Yuk Lihat-lihat dulu produk yang mungkin dibutuhkan <a href='".base_url()."produk' style='color:#000'><b>disini</b></a>.</div>";
                          }

                          $no = 1;
                          foreach ($selesai->result_array() as $row){
                          $total = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                          $produk = $this->db->query("SELECT * FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->num_rows();
                          $kupon = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
                                JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
                                    where b.id_penjualan='$row[id_penjualan]'")->row_array();
                          echo "<div class='form-group row' style='margin-bottom:5px; background: #efefef;'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Waktu Transaksi</label>
                            <div class='col-sm-10'>
                              ".jam_tgl_indo($row['waktu_transaksi'])."
                              <a class='text-info pull-right' title='Detail data pesanan' href='".base_url()."members/keranjang_detail/$row[id_penjualan]'>Lihat Pesanan / Pengiriman</a> 
                          </div>
                          </div>

                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Invoice / Seller</label>
                            <div class='col-sm-10'>
                              <a href='".base_url()."konfirmasi/tracking/$row[kode_transaksi]'>$row[kode_transaksi]</a> / 
                              <a href='".base_url()."u/$row[user_reseller]'><span class='text-success text-uppercase'>$row[nama_reseller]</span></a><br>
                            </div>
                          </div>

                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Status</b></label>
                            <div class='col-sm-10'>
                              ".status($row['proses'])."
                            </div>
                          </div>

                          <div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Total Belanja</b></label>
                            <div class='col-sm-10'>
                              <b class='text-danger'>Rp ".rupiah($total['total']+$row['ongkir']-$kupon['diskon'])." ($produk Produk)</b>
                            </div>
                          </div>";

                            if ($row['group_order']!=''){
                              $ex = explode('.',$row['group_order']);
                              $total_group = $this->db->query("SELECT * FROM rb_penjualan where group_order='$row[group_order]' AND proses!='0'");
                              if ($total_group->num_rows()>=$ex[1]){
                                $total_menunggu = "<i style='color:green'>(Kuota Group Order telah Terpenuhi!)</i>";
                              }else{
                                $total_menunggu = "<i style='color:red'>(Menunggu ".($ex[1]-$total_group->num_rows())." Orderan Lagi)</i>";
                              }
                              echo "<div class='form-group row' style='margin-bottom:5px'>
                              <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Group Order</b></label>
                                <div class='col-sm-10' style='background:bisque'>
                                  <span>Kode : <b>$row[group_order]</b><br>Beli Ber-$ex[1] $total_menunggu</span>
                                </div>
                              </div>";
                            }

                          echo "<div class='form-group row' style='margin-bottom:5px'>
                          <label class='col-sm-2 col-form-label' style='margin-bottom:1px'></b></label>
                            <div class='col-sm-10'>";
                            // echo "<a style='color:#fff; padding:10px 25px; line-height:1px; font-weight:300' class='ps-btn ulasan' data-id='$row[id_penjualan]' href='#'>Ulasan</a> ";
                              if ($row['proses']=='4'){
                                $cek_exist = $this->db->query("SELECT id_pusat_bantuan  FROM rb_pusat_bantuan where id_penjualan='$row[id_penjualan]'");
                                if ($cek_exist->num_rows()>=1){
                                  $room = $cek_exist->row_array();
                                  echo "<a style='padding:10px 25px; line-height:1px; font-weight:300; color:#fff' class='ps-btn red-btn' href='".base_url()."komplain/room/$room[id_pusat_bantuan]'>Komplain</a>";
                                }else{
                                  echo "<a style='padding:10px 25px; line-height:1px; font-weight:300; color:#fff' class='ps-btn red-btn resolusi' data-id='$row[id_penjualan]' href='#'>Komplain</a>";
                                }
                              }
                          echo "</div>
                            </div><br>";
                            $no++;
                          }
                        ?>
                      </div>
                    </div>
                    <div class="ps-pagination">
                        <?php // echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $(document).on('click','.resolusi',function(e){
            e.preventDefault();
            $("#myModal-view").modal('show');
            $.post("<?php echo site_url()?>komplain/resolusi",
                {id:$(this).attr('data-id')},
                function(html){
                    $(".content-body").html(html);
                }   
            );
        });
    });

    $(function(){
        $(document).on('click','.ulasan',function(e){
            e.preventDefault();
            $("#myModal-view").modal('show');
            $.post("<?php echo site_url()?>komplain/ulasan",
                {id:$(this).attr('data-id')},
                function(html){
                    $(".content-body").html(html);
                }   
            );
        });
    });
</script>
              
