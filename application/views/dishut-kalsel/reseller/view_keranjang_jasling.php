<?php 
$proses = '<i class="text-danger">Pending</i>'; 
?>
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="<?php echo base_url()."produk"; ?>">Produk</a></li>
            <li><?php echo $title; ?></li>
        </ul>
    </div>
</div>
<div class="ps-section--shopping ps-shopping-cart">
    <div class="container">
      <?php 
          echo $this->session->flashdata('message'); 
          $this->session->unset_userdata('message');
      ?>
        <div class="ps-section__content">
            <div class="table-responsive">
            <div class='keranjang-all'>
                <div class="row">
                <?php 
				
				
                  if ($this->session->idp == ''){
                    echo "<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 '>
                    <div style='padding:5%; text-align:center'>
                            <div><img style='width:160px' src='".base_url()."asset/images/shopping-empty.png'></div><br>
                            <span class='text-danger'>Maaf, Keranjang belanja anda saat ini masih kosong,...</span><br>
                            <a href='".base_url()."produk'>Klik Disini Untuk mulai Belanja!</a></div></div>";
                  }else{
                    echo "<div class='col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 '>
                      <form action='".base_url()."produk/keranjang_jasling' method='POST'>
                      
                        <div class='show_cart_detail'></div>
						<br>
                        <button type='submit' name='update' style='padding:10px 25px' class='ps-btn float-right'>Lanjut ke Pembayaran <i class='icon-arrow-right'></i></button>
                        
					</form>";
                    ?>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block--shopping-total">
                        <div class='keranjang-page'>
                            <div class="ps-block__header">
                                <p style='margin-bottom:0px'><b>Status Order<span> <?php echo $proses; ?></span></b></p><hr>
                                <p style='margin-bottom:0px'>Berat<span> <?php echo "$total[total_berat] Gram"; ?></span></p>
                                <?php 
                                  $ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
                                  $fv = explode('|',$ref['keterangan']);
                                  if ($fv[0]>'0'){
                                    $fee_admin = $fv[0];
                                    echo "<p style='margin-bottom:0px'>Fee Admin <span>Rp ".rupiah($fv[0])."</span></p>";
                                  }else{
                                    $fee_admin = 0;
                                  }
                                ?>
                                <p>Subtotal <span> <?php echo "Rp ".rupiah($total['total']-$total['diskon_total']); ?></span></p>
                            </div>
                            <div class="ps-block__content">
                                <ul class="ps-block__product">

                                    <?php
                                    if ($this->session->idp != ''){
                                      $penjual = $this->db->query("SELECT a.*, e.nama_reseller, e.alamat_lengkap, e.keterangan, b.id_reseller, c.nama_kota, d.nama_provinsi, e.kecamatan_id, e.kota_id FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk 
                                      JOIN rb_reseller e ON b.id_reseller=e.id_reseller
                                      JOIN rb_kota c ON e.kota_id=c.kota_id 
                                      JOIN rb_provinsi d ON c.provinsi_id=d.provinsi_id where a.session='".$this->session->idp."' GROUP BY b.id_reseller");
                                      foreach ($penjual->result_array() as $pen) {
                                        $ber = $this->db->query("SELECT sum(c.berat) as berat FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan 
                                        JOIN rb_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='$kode' AND a.id_penjual='$pen[id_penjual]'")->row_array();
                                        echo "<li><b>$pen[nama_reseller]</b> (Jualan) <br>
                                                  Pengiriman dari : <i style='color:green'>".kecamatan($pen['kecamatan_id'],$pen['kota_id'])."</i></li>";
                                      }
                                    }
                                    ?>
                                    
                                </ul>
                                <h3>Total <span><?php echo "Rp ".rupiah(($total['total']-$total['diskon_total'])+$total['ongkir']+$fee_admin); ?></span></h3>
                            </div>
                        </div>
                        </div>
                        <!--<a class="ps-btn ps-btn--fullwidth" href="<?php // echo base_url()."produk/checkouts"; ?>">Lanjut ke Pembayaran</a>-->
                    </div>
              <?php } ?>
                </div>
                </div>
                </div>
        </div>
        <hr>

    </div>
</div>
