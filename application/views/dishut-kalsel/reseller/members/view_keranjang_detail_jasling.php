<!DOCTYPE html>
<html lang="en" dir="ltr">

<body onload="window.print()">
<?php 
if ($rows['proses']=='0'){ $col = 6; }else{ $col = 12; } 
$detail = $this->db->query("SELECT * FROM rb_penjualan where id_penjualan='".$this->uri->segment(3)."'")->row_array();
$total = $this->db->query("SELECT c.proses, sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk 
                            JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where a.id_penjualan='".$this->uri->segment(3)."'")->row_array();
$res = $this->db->query("SELECT * FROM rb_reseller where id_reseller='$rows[id_reseller]'")->row_array();
$usr = $this->db->query("SELECT * FROM rb_konsumen where id_konsumen='$rows[id_pembeli]'")->row_array();
$angka_acak = substr($judul,-3);
?>
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
		<!--
            <li><a href="index.html">Home</a></li>
            <li><a href="< ?php echo base_url()."konfirmasi/tiket"; ?>">Tracking</a></li>
            <li>< ?php echo $rows['kode_transaksi'].'/'.$rows['id_reseller']; ?></li>
        -->
		</ul>
    </div>
</div>
<div class="ps-section--shopping ps-shopping-cart">
    <div class="container">
        <div class="ps-section__content">
            <div class="table-responsive">
                <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 ">
<!--
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="true">Detail Pesanan</a>
                        </li>
                        < ?php if($rows['kode_kurir']!='0' AND $rows['kode_kurir']!='1'){ ?>
                        <li class="nav-item">
                            <a class="nav-link blink_me" id="resi-tab" data-toggle="tab" href="#resi" role="tab" aria-controls="resi" aria-selected="false">Cek Resi Pengiriman</a>
                        </li>
                        < ?php } ?>
                    </ul>
-->
                    <div class="tab-content" id="myTabContent"><br>
                        <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                            <?php 
                                echo "<table class='table table-sm'>
                                <tbody>
                                <tr><td style='width:150px'><strong>No. Invoice</strong></td>  <td class='text-success'><b>$rows[kode_transaksi]/$rows[id_reseller]</b></td></tr>
                                    <tr><td><strong>Dikirim kepada</strong></td>  <td>$usr[nama_lengkap]</td></tr>
                                    <tr><td><strong>No Hp/Telpon</strong></td>      <td>".substr($usr['no_hp'], 0, -2)."xx</td></tr>
                                    <tr><td><strong>Alamat Pengiriman</strong></td> <td>".alamat($rows['kode_transaksi'])."</td></tr>
                                </tbody>
                                </table><hr><br>
                                
                                <div style='padding:5px; font-size:16px; font-weight:bold; background:#f4f4f4; border-bottom:1px solid #ab0534; margin-bottom:10px;'>Data Produk</div>";
                                $no = 1;
                                foreach ($record as $row){
                                $sub_total = (($row['harga_jual']-$row['diskon'])*$row['jumlah']);
                                $ex = explode(';', $row['gambar']);
                                if ($row['preorder']!='' AND $row['preorder']>0){
                                    $pre_order = "<span class='badge badge-secondary'>Pre-Order $row[preorder] Hari</span> <br>";
                                  }else{
                                    $pre_order = "";
                                  }
                                if (trim($ex[0])=='' OR !file_exists("asset/foto_produk/".$ex[0])){ $foto_produk = 'no-image.png'; }else{ $foto_produk = $ex[0]; }
                                echo "<a style='font-size:17px; display:block; border-bottom:1px dotted' href='".base_url()."produk/detail/$row[produk_seo]'>$row[nama_produk]</a>
                                <div class='ps-product--cart'>
                                    <div class='ps-product__thumbnail'>
                                        <div style='height:60px; overflow:hidden'><a href='".base_url()."produk/detail/$row[produk_seo]'><img style='padding-right:10px' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a></div>
                                    </div>
                                    
                                    <div class='ps-product__content' style='text-align:left; padding-left:0px'>
                                    $pre_order Qty. $row[jumlah] x ".rupiah($row['harga_jual']-$row['diskon'])." = <b>".rupiah($sub_total)."</b><br>";
                                        
                                        $catatan = explode('||',$row['keterangan_order']);
                                        
                                        if (trim($catatan[1])!=''){
                                            echo "<b>Variasi</b> : ".$catatan[1].'<br>';
                                          }
                                        if (trim($catatan[0])!=''){
                                        echo "<b>Catatan</b> : ".$catatan[0];
                                        }
                                    echo "</div>
                                </div><br>";
                                    $no++;
                                }
                                
                                echo "<br><br>";
                            ?>
                        </div>
                        <div class="tab-pane fade" id="resi" role="tabpanel" aria-labelledby="resi-tab">
                        <?php 
                            if ($rows['no_resi']==''){
                                echo "<center style='color:red; margin:10% 0px'>
                                <img src='".base_url()."asset/images/no-data.png'>
                                <p>Data Resi untuk pesanan Tidak ditemukan, <br>No. Resi Belum di Input, silahkan Hubungi Seller/Penjual.</p></center>";
                            }else{
                                $obj = cek_resi($rows['no_resi'],$rows['kode_kurir']);
                                if(config('api_resi_aktif')=='rajaongkir'){
                                    $search_array = explode(',',config('api_resi_off'));
                                    if (in_array($rows['kode_kurir'], $search_array)) {  // Jika resi Off di Rajaongkir maka cek dengan https://binderbyte.com/
                                        if ($obj['status']!='200'){
                                            echo "<center style='color:red; margin:10% 0px'><img src='".base_url()."asset/images/no-data.png'>
                                            <p>Data Resi untuk pesanan Tidak ditemukan, <br>Sepertinya No Resi yang di input oleh penjual bermasalah.<br>
                                            <a class='ps-btn' style='padding:10px 40px' target='_BLANK' href='https://cekresi.com/?noresi=$rows[no_resi]'>Link Alternatif - Lacak via cekresi.com</a></p></center>";
                                        }else{
                                        echo "<table class='table table-sm table-borderless'>
                                                <tbody>
                                                <tr>
                                                    <tr><td width='160'>No Resi</td>        <td>:</td><td><b>".$obj['data']['summary']['awb']."</b></td></tr>
                                                    <tr><td>Status</td>                     <td>:</td><td><b style='color:blue'>".$obj['data']['summary']['status']."</b></td></tr>
                                                    <tr><td>Dikirim tanggal</td>            <td>:</td><td>".jam_tgl_indo($obj['data']['summary']['date'])."</td></tr>
                                                    <tr><td valign='top'>Pengirim / Dari</td>  <td valign='top'>:</td><td valign='top'><b>".$obj['data']['detail']['shipper']."</b> / ".$obj['data']['detail']['origin']."</td></tr>
                                                    <tr><td valign='top'>Penerima / Tujuan</td>    <td valign='top'>:</td><td valign='top'><b>".$obj['data']['detail']['receiver']."</b> /  ".$obj['data']['detail']['destination']."</td></tr>
                                                </tbody>
                                            </table><br>
                                            
                                            <table class='table table-sm'>
                                            <thead>
                                            <tr>
                                                <th width='180px'><b>Tanggal</b></th>
                                                <th><b>Keterangan</b></th>
                                            </tr>
                                            </thead>
                                            <tbody>";
                                            for($i=0; $i < count($obj['data']['history']); $i++){
                                                echo "<tr>
                                                        <td class='text-success'>".jam_tgl_indo($obj['data']['history'][$i]['date'])."</td>
                                                        <td>".$obj['data']['history'][$i]['desc']."</td>
                                                    </tr>";
                                            }
                                            echo "</tbody></table>";
                                        }
                                    }else{
                                        if ($obj['rajaongkir']['result']['details']['waybill_number']==''){
                                            echo "<center style='color:red; margin:10% 0px'><img src='".base_url()."asset/images/no-data.png'>
                                                <p>Data Resi untuk pesanan Tidak ditemukan, <br>Silahkan untuk memeriksa kembali No Resi Pengiriman anda.</p></center>";
                                        }else{
                                            echo "<table class='table table-sm table-borderless'>
                                                <tbody>
                                                <tr>
                                                    <tr><td width='160'>No Resi</td>        <td>:</td><td><b>".$obj['rajaongkir']['result']['details']['waybill_number']."</b></td></tr>
                                                    <tr><td>Status</td>                     <td>:</td><td><b>".$obj['rajaongkir']['result']['summary']['status']."</b></td></tr>
                                                    <tr><td>Dikirim tanggal</td>            <td>:</td><td>".$obj['rajaongkir']['result']['details']['waybill_date']." ".$obj['rajaongkir']['result']['details']['waybill_time']."</td></tr>
                                                    <tr><td valign='top'>Dikirim oleh</td>  <td valign='top'>:</td><td valign='top'>".$obj['rajaongkir']['result']['details']['shippper_name']."<br>".$obj['rajaongkir']['result']['details']['origin']."</td></tr>
                                                    <tr><td valign='top'>Dikirim ke</td>    <td valign='top'>:</td><td valign='top'>".$obj['rajaongkir']['result']['details']['receiver_name']."<br> ".$obj['rajaongkir']['result']['details']['receiver_address1']." ".$obj['rajaongkir']['result']['details']['receiver_address2']." ".$obj['rajaongkir']['result']['details']['receiver_address3']." ".$obj['rajaongkir']['result']['details']['receiver_city']."</td></tr>
                                                    <tr><td>Kurir Status</td>                 <td>:</td><td>".$obj['rajaongkir']['result']['delivery_status']['status']."</td></tr>
                                                </tbody>
                                            </table><br>
                                            
                                            <table class='table table-sm'>
                                            <thead>
                                            <tr>
                                                <th width='180px'><b>Tanggal</b></th>
                                                <th><b>Keterangan</b></th>
                                            </tr>
                                            </thead>
                                            <tbody>";
                                            for($i=0; $i < count($obj['rajaongkir']['result']['manifest']); $i++){
                                                echo "<tr>
                                                        <td class='text-success'>".tgl_indo($obj['rajaongkir']['result']['manifest'][$i]['manifest_date'])." ".$obj['rajaongkir']['result']['manifest'][$i]['manifest_time']."</td>
                                                        <td>".$obj['rajaongkir']['result']['manifest'][$i]['manifest_description']."</td>
                                                    </tr>";
                                            }
                                            echo "</tbody></table>";
                                        }
                                    }
                                }else{
                                    if ($obj['status']!='200'){
                                        echo "<center style='color:red; margin:10% 0px'><img src='".base_url()."asset/images/no-data.png'>
                                        <p>Data Resi untuk pesanan Tidak ditemukan, <br>Silahkan untuk memeriksa kembali No Resi Pengiriman anda.</p></center>";
                                    }else{
                                    echo "<table class='table table-sm table-borderless'>
                                            <tbody>
                                            <tr>
                                                <tr><td width='160'>No Resi</td>        <td>:</td><td><b>".$obj['data']['summary']['awb']."</b></td></tr>
                                                <tr><td>Status</td>                     <td>:</td><td><b style='color:blue'>".$obj['data']['summary']['status']."</b></td></tr>
                                                <tr><td>Dikirim tanggal</td>            <td>:</td><td>".jam_tgl_indo($obj['data']['summary']['date'])."</td></tr>
                                                <tr><td valign='top'>Pengirim / Dari</td>  <td valign='top'>:</td><td valign='top'><b>".$obj['data']['detail']['shipper']."</b> / ".$obj['data']['detail']['origin']."</td></tr>
                                                <tr><td valign='top'>Penerima / Tujuan</td>    <td valign='top'>:</td><td valign='top'><b>".$obj['data']['detail']['receiver']."</b> /  ".$obj['data']['detail']['destination']."</td></tr>
                                            </tbody>
                                        </table><br>
                                        
                                        <table class='table table-sm'>
                                        <thead>
                                        <tr>
                                            <th width='180px'><b>Tanggal</b></th>
                                            <th><b>Keterangan</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>";
                                        for($i=0; $i < count($obj['data']['history']); $i++){
                                            echo "<tr>
                                                    <td class='text-success'>".jam_tgl_indo($obj['data']['history'][$i]['date'])."</td>
                                                    <td>".$obj['data']['history'][$i]['desc']."</td>
                                                </tr>";
                                        }
                                        echo "</tbody></table>";
                                    }
                                }
                            }
                        ?>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                    <div class="ps-block--shopping-total">
                        <div class="ps-block__header">
                            <p style='margin-bottom:0px'><b>Status Order<span> <?php echo status($total['proses']); ?></span></b></p><hr>
                            
                            <p>Subtotal <span> <?php echo "Rp ".rupiah($total['total']-$total['diskon_total']); ?></span></p>
                            <hr>
                            <?php 
                                $kupon = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
                                JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
                                    where b.id_penjualan='".cetak($this->uri->segment(3))."'")->row_array();

                                $data_kupon = $this->db->query("SELECT c.* FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
                                JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
                                where b.id_penjualan='".cetak($this->uri->segment(3))."'");
                                foreach ($data_kupon->result_array() as $kup) {
                                    echo "<p style='margin-bottom:0px'>
                                         <b style='color:green'>$kup[kode]</b>
                                         <span>Rp -".rupiah($kup['nilai'])."</span></p>";
                                }
                            ?>
                        </div>
                        <div class="ps-block__content">
                            <ul class="ps-block__product">
                                <?php
                                  $penjual = $this->db->query("SELECT a.id_penjual, a.ongkir, a.kurir, a.service, b.id_reseller, b.nama_reseller, b.alamat_lengkap, b.kecamatan_id, b.kota_id, c.nama_kota FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_penjualan='".cetak($this->uri->segment(3))."'");
                                  foreach ($penjual->result_array() as $pen) {
                                    $ber = $this->db->query("SELECT sum(c.berat) as berat FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan 
                                    JOIN rb_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='$kode' AND a.id_penjual='$pen[id_penjual]'")->row_array();
                                    echo "<li><a href='".base_url()."u/".user_reseller($pen['id_reseller'])."'><u><b>$pen[nama_reseller]</b></u></a>";
                                              
                                              echo "<br><b>Dikirim oleh</b> : $pen[alamat_lengkap], ".kecamatan($pen['kecamatan_id'],$pen['kota_id'])."</li>";
                                  }
                                ?>
                                
                            </ul>
                            <h3>Total <span><?php echo "Rp ".rupiah((($total['total']-$total['diskon_total'])+$detail['ongkir']+$angka_acak)-$kupon['diskon']); ?></span></h3>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <hr>

    </div>
</div>
	
<body>
</html>