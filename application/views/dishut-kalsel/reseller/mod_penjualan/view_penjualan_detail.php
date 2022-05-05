<?php $detail = $this->db->query("SELECT * FROM rb_penjualan where id_penjualan='".$this->uri->segment(3)."'")->row_array(); ?>
<div class="ps-page--single">
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="#">Members</a></li>
            <li><?php echo $title; ?></li>
        </ul>
    </div>
</div>
</div>
<div class="ps-vendor-dashboard pro" style='margin-top:10px'>
    <div class="container">
      <div class="ps-section__content">
        <?php 
          echo $this->session->flashdata('message'); 
          $this->session->unset_userdata('message');
          if($rows['kode_kurir']!='0'){
            $kolom = 6;
          }else{
            $kolom = 12;
          }
        ?><br>
        <div class="row">
          <?php echo "<div class='col-xl-$kolom col-lg-$kolom col-md-$kolom col-sm-12 col-12'>"; ?>
            <div class='table-responsive'>
                <table class="table table-sm iconset">
                  <tbody>
                    <tr><th width='140px' scope='row'><b>No. Invoice</b></th>  <td style='font-weight:bold; color:green'><?php echo "$rows[kode_transaksi]"; ?></td></tr>
                    <tr><th scope='row'><b>Dikirim kepada</b></th>                 <td><?php echo "<a href='".base_url().$this->uri->segment(1)."/detail_konsumen/$rows[id_konsumen]'>$rows[nama_lengkap]</a> <i style='color:red'>(Hp : $rows[no_hp])</i>"; ?></td></tr>
                    <tr><th scope='row'><b>Alamat Kirim</b></th>               <td><?php echo alamat($rows['kode_transaksi']); ?></td></tr>
                    <?php 
                      if($rows['kode_kurir']=='0'){ 
                        echo "<tr><th scope='row'><b>Kurir</b></th>   <td><span style='text-transform:uppercase'>$detail[kurir]</span> - $detail[service]</td></tr>
                              <tr><th scope='row'><b>Status Order</b></th>          <td>".status($rows['proses'])."</td></tr>";
                      }
                    ?>
                  </tbody>
                  </table>
                  
                  <?php 
                    echo "<div style='padding:5px; font-size:16px; font-weight:bold; background:#f4f4f4; border-bottom:1px solid #ab0534; margin-bottom:10px;'>Data Produk</div>";
                    $no = 1;
                    foreach ($record as $row){
                    $cku = $this->db->query("SELECT * FROM rb_penjualan_kupon where id_penjualan_detail='$row[id_penjualan_detail]'")->row_array();
                    $sub_total = (($row['harga_jual']-$row['diskon'])*$row['jumlah']);
                    $ext = explode(';', $row['gambar']);
                    if (trim($ext[0])=='' OR !file_exists("asset/foto_produk/".$ext[0])){ $foto_produk = 'no-image.png'; }else{ if (!file_exists("asset/foto_produk/thumb_".$ext[0])){ $foto_produk = $ext[0]; }else{ $foto_produk = "thumb_".$ext[0]; }}
                    echo "<a style='font-size:17px; display:block; border-bottom:1px dotted' href='".base_url()."produk/detail/$row[produk_seo]'>$row[nama_produk]</a>
                          <div class='ps-product--cart'>
                              <div class='ps-product__thumbnail'>
                                  <div style='height:60px; overflow:hidden'><a href='".base_url()."produk/detail/$row[produk_seo]'><img style='padding-right:10px' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a></div>
                              </div>
                              
                              <div class='ps-product__content' style='text-align:left; padding-left:0px'>
                              <b>Qty.</b> $row[jumlah] x ".rupiah($row['harga_jual']-$row['diskon'])." = ";
                              if ($cku['nilai']>0){
                                echo "<del style='color:#8a8a8a'><b>".rupiah($sub_total)."</b></del> <b>".rupiah($sub_total-$cku['nilai'])."</b>";
                              }else{
                                echo "<b>".rupiah($sub_total)."</b>";
                              }
                              echo "<br>";
                                  
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
                  ?>
                  <table class="table table-striped table-sm iconset">
                    <tbody>
                  <?php 
                    $total = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(a.fee_produk_end*a.jumlah) as fee_produk FROM `rb_penjualan_detail` a where a.id_penjualan='".$this->uri->segment(3)."'")->row_array();
                    $kupon = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
											JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
												where b.id_penjualan='".$this->uri->segment(3)."'")->row_array();
                    echo "<tr class='warning'>
                            <td colspan='2'><b>Ongkir</b></td>
                            <td width='120px'><b>Rp ".rupiah($detail['ongkir'])."</b></td>
                          </tr>
                          <tr class='warning'>
                            <td colspan='2'><b>Subtotal</b></td>
                            <td><b>Rp ".rupiah($total['total'])."</b></td>
                          </tr>";

                          if ($kupon['diskon']>0){
                            echo "<tr class='warning'>
                              <td colspan='2'><b>Kupon / Voucher</b></td>
                              <td><b>Rp - ".rupiah($kupon['diskon'])."</b></td>
                            </tr>";
                          }

                          if (($rows['fee']/100*$total['total'])>0){
                            echo "<tr class='warning'>
                              <td colspan='2'><b>Fee Referral</b></td>
                              <td><b>Rp ".rupiah($rows['fee']/100*$total['total'])."</b></td>
                            </tr>";
                          }

                          if ($total['fee_produk']>0){
                            $fee_produk = $total['fee_produk'];
                            echo "<tr class='danger'>
                              <td colspan='2'><b>Fee Produk</b></td>
                              <td><b style='color:red'>Rp - ".rupiah($total['fee_produk'])."</b></td>
                            </tr>";
                          }else{
                            $fee_produk = 0;
                          }

                          echo "<tr class='success'>
                            <td colspan='2'><b>Total</b></td>
                            <td><b>Rp ".rupiah(($total['total']+$detail['ongkir'])-($rows['fee']/100*$total['total'])-$kupon['diskon']-$fee_produk)."</b></td>
                          </tr>";

                          
                    ?>
                    </tbody>
                  </table>
                  <div class='ps-section__cart-actions'>
                      <a class='ps-btn ps-btn--outline margin-btn' href='<?= base_url(); ?>members/penjualan'><i class='icon-arrow-left'></i> Kembali ke List Order</a>
                  </div>
                </div>
              </div>

              <?php 
                if($rows['kode_kurir']!='0'){ // Jika Transaksi Bukan COD 
              ?>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class='table-responsive'>
                  <table class="table table-sm table-condensed iconset">
                    <tbody>
                    <?php 
                      if ($rows['dropshipper']!=''){
                        $drp = explode('||',$rows['dropshipper']);
                        echo "<tr style='color:red'><th scope='row' colspan='2'>Kirim Sebagai Dropshipper :</th></tr>
                              <tr><th scope='row'>Nama Pengirim</th>                        <td>".$drp[0]."</td></tr>
                              <tr><th scope='row'>Telp. Pengirim</th>                        <td>".$drp[1]."</td></tr>
                              <tr><th scope='row' colspan='2'><br></th></tr>";
                      }
                      if ($rows['group_order']!=''){
                        $ex = explode('.',$rows['group_order']);
                        $total_group = $this->db->query("SELECT * FROM rb_penjualan where group_order='$rows[group_order]' AND proses!='0'");
                        if ($total_group->num_rows()>=$ex[1]){
                          $total_menunggu = "<i style='color:green'>(Kuota Group Order telah Terpenuhi!)</i>";
                        }else{
                          $total_menunggu = "<i style='color:red'>(Menunggu ".($ex[1]-$total_group->num_rows())." Orderan Lagi)</i>";
                        }
                        echo "<tr><th width='140px' scope='row'><b>Group Order</b></th>   <td>
                          <div style='background:bisque; padding:2px 10px'>
                            <span>Kode : <b>$rows[group_order]</b><br>Beli Ber-$ex[1] $total_menunggu</span>
                          </div></td></tr>";
                      }
                    ?>
                      <tr><th width='140px' scope='row'><b>Kurir</b></th>   <td><?php echo kurir($rows['kode_kurir'],$rows['kurir'],$rows['service']); ?></td></tr>
                      <tr><th scope='row'><b>Status Order</b></th>          <td><?php echo status($rows['proses']);?></td></tr>
                      
                      <tr><th scope='row'><b>Input No. Resi</b></th>        <td>
                        <form action='<?php echo base_url().$this->uri->segment(1)."/detail_penjualan/".$this->uri->segment(3); ?>' method='POST'>
                        <input style='color:red; width:75%; display:inline-block' type='text' value='<?php echo "$rows[no_resi]"; ?>' class='form-control form-mini' name='no_resi' placeholder='- - - - - - - - -' required>
                        <button class='ps-btn margin-btn' style='padding: 4px 15px;' type='submit' name='submit'><span class='fa fa-check'></span></button>
                        </form>
                      </td></tr>
                      
                    </tbody>
                  </table>

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
                                    <p>Data Resi untuk pesanan Tidak ditemukan, <br>Sepertinya No Resi yang anda input bermasalah.<br>
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
              <?php } ?>
          </div>
        </div>
      </div>
    </div>