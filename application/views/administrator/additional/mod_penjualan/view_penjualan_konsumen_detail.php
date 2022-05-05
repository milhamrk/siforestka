<?php 
$detail = $this->db->query("SELECT * FROM rb_penjualan where id_penjualan='".$this->uri->segment(3)."'")->row_array(); 
if ($detail['kode_kurir']!='0'){
  $kolom = 6;
}else{
  $kolom = 12;
}
?>

            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Detail Transaksi Penjualan</h3>
                  <a class='pull-right btn btn-default btn-sm' href='<?php echo base_url().$this->uri->segment(1); ?>/penjualan_konsumen'>Kembali</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php echo "<div class='col-sm-$kolom col-xs-12'>  "; ?>
                  <table class='table table-condensed'>
                  <tbody>
                    <tr><th width='140px' scope='row'>No. Invoice</th>  <td style='font-weight:bold; color:green'><a target='_BLANK' href='<?php echo base_url(); ?>konfirmasi/tracking/<?php echo "$rows[kode_transaksi]"; ?>'><?php echo "$rows[kode_transaksi]"; ?></a></td></tr>
                    <tr><th scope='row'>Seller (Penjual)</th>                 <td><?php echo "<a style='color:green' href='".base_url().$this->uri->segment(1)."/detail_reseller/$rows[id_penjual]'>$rows[nama_reseller]</a>"; ?></td></tr>
                    <tr><th scope='row'>Dikirim kepada</th>                 <td><?php echo "<a href='".base_url().$this->uri->segment(1)."/detail_konsumen/$rows[id_konsumen]'>$rows[nama_lengkap]</a>"; ?></td></tr>
                    <tr><th scope='row'>Alamat Pengiriman</th>               <td><?php echo alamat($rows['kode_transaksi']); ?></td></tr>
                  <?php 
                    if ($detail['kode_kurir']=='0'){ 
                      echo "<tr><th scope='row'>Kurir</th> <td>";
                      if ($detail['service']=='SOPIR'){
                        $ceks = $this->db->query("SELECT * FROM rb_sopir where id_sopir='".(int)$detail['kurir']."'")->row_array();
                        echo "$detail[service] - $ceks[merek] ($ceks[plat_nomor])";
                      }else{
                        echo "$detail[kurir], $detail[service]";
                      }
                      echo "</td></tr>
                      <tr><th scope='row'>Status Order</th>                        <td>".status($rows['proses'])."</td></tr>";
                    }
                  ?>
                  </tbody>
                  </table>

                  <table class="table table-bordered table-condensed">
                    <thead>
                      <tr bgcolor='#e3e3e3'>
                        <th style='width:40px'>No</th>
                        <th colspan='2'>Nama Produk</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                      $cku = $this->db->query("SELECT * FROM rb_penjualan_kupon where id_penjualan_detail='$row[id_penjualan_detail]'")->row_array();
                    $sub_total = ($row['harga_jual']-$row['diskon'])*$row['jumlah'];
                    if ($row['preorder']!='' AND $row['preorder']>0){
                      $pre_order = "<span class='badge bg-red'>Pre-Order $row[preorder] Hari</span><br>";
                    }else{
                      $pre_order = "";
                    }
                    echo "<tr><td>$no</td>
                              <td colspan='2'>$pre_order<a target='_BLANK' href='".base_url()."produk/detail/$row[produk_seo]' style='font-size:16px; color:green; font-weight:bold'>$row[nama_produk]</a><br>";
                              $catatan = explode('||',$row['keterangan_order']);
                              echo "<b>Qty.</b> $row[jumlah] x ".rupiah($row['harga_jual']-$row['diskon'])." = ";
                              if ($cku['nilai']>0){
                                echo "<del style='color:#8a8a8a'><b>".rupiah($sub_total)."</b></del> <b>".rupiah($sub_total-$cku['nilai'])."</b><br>";
                              }else{
                                echo "<b>".rupiah($sub_total)."</b><br>";
                              }
                              
                              if (trim($catatan[1])!=''){
                                echo "<b>Variasi</b> : ".$catatan[1].'<br>';
                              }
                              if (trim($catatan[0])!=''){
                                echo "<b>Catatan</b> : ".$catatan[0];
                              }
                              
                              echo "</td>
                          </tr>";
                      $no++;
                    }
                    $total = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(a.fee_produk_end*a.jumlah) as fee_produk FROM `rb_penjualan_detail` a where a.id_penjualan='".$this->uri->segment(3)."'")->row_array();
                    $kupon = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
											JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
												where b.id_penjualan='".$this->uri->segment(3)."'")->row_array();
                    echo "<tr class='warning'>
                            <td colspan='2'><b>Ongkir</b>
                            <b class='pull-right'>Rp ".rupiah($detail['ongkir'])."</b></td>
                          </tr>
                          <tr class='warning'>
                            <td colspan='2'><b>Subtotal</b>
                            <b class='pull-right'>Rp ".rupiah($total['total'])."</b></td>
                          </tr>";

                          if ($kupon['diskon']>0){
                            echo "<tr class='warning'>
                              <td colspan='2'><b>Kupon / Voucher</b>
                              <b class='pull-right'>Rp - ".rupiah($kupon['diskon'])."</b></td>
                            </tr>";
                          }
                          
                          if (($rows['fee']/100*$total['total'])>0){
                          echo "<tr class='warning'>
                                  <td colspan='2'><b>Fee Referral</b>
                                  <b class='pull-right'>Rp ".rupiah($rows['fee']/100*$total['total'])."</b></td>
                                </tr>";
                          }

                          if ($total['fee_produk']>0){
                            $fee_produk = $total['fee_produk'];
                            echo "<tr class='danger'>
                              <td colspan='2'><b>Fee Produk</b>
                              <b class='pull-right' style='color:red'>Rp - ".rupiah($total['fee_produk'])."</b></td>
                            </tr>";
                          }else{
                            $fee_produk = 0;
                          }

                          echo "<tr class='success'>
                            <td colspan='2'><b>Total</b>
                            <b class='pull-right'>Rp ".rupiah((($total['total']+$detail['ongkir'])-($rows['fee']/100*$total['total']))-$kupon['diskon']-$fee_produk)."</b></td>
                          </tr>";
                    ?>
                    </tbody>
                  </table>
                </div>

                <?php if ($detail['kode_kurir']!='0'){ ?>
                <div class="col-sm-6 col-xs-12">
                  <table class='table table-condensed'>
                  <tbody>
                    <?php 
                      if ($detail['dropshipper']!=''){
                        $drp = explode('||',$detail['dropshipper']);
                        echo "<tr style='color:red'><th scope='row' colspan='2'>Kirim Sebagai Dropshipper :</th></tr>
                              <tr><th scope='row'>Nama Pengirim</th>                        <td>".$drp[0]."</td></tr>
                              <tr><th scope='row'>Telp. Pengirim</th>                        <td>".$drp[1]."</td></tr>
                              <tr><th scope='row' colspan='2'><br></th></tr>";
                      }
                    ?>
                    <tr><th width='140px' scope='row'>Kurir</th>                         <td>
                    <?php 
                    if ($detail['service']=='SOPIR'){
                      $ceks = $this->db->query("SELECT * FROM rb_sopir where id_sopir='".(int)$detail['kurir']."'")->row_array();
                      echo "$detail[service] - $ceks[merek] ($ceks[plat_nomor])";
                    }else{
                      echo "$detail[kurir], $detail[service]";
                    }
                    ?></td></tr>
                    <tr><th scope='row'>Status Order</th>                        <td><?php echo status($rows['proses']);?></td></tr>
                    <tr><th scope='row'>Input No. Resi</th>                        <td>
                      <form action='<?php echo base_url()."administrator/detail_penjualan_konsumen/".$this->uri->segment(3); ?>' method='POST'>
                      <input style='color:red; width:75%; display:inline-block' type='text' value='<?php echo "$rows[no_resi]"; ?>' class='form-control' name='no_resi' required>
                      <button class='btn btn-primary' style='margin-top:-4px' type='submit' name='submit'>Proses</button>
                      </form>
                    </td></tr>
                  </tbody>
                  </table>

                  <?php 
                      if ($rows['no_resi']==''){
                        echo "<center style='color:red; margin:10% 0px'>
                        <img src='".base_url()."asset/images/no-data.png'>
                        <p>Data Resi untuk pesanan Tidak ditemukan, <br>Silahkan untuk input No Resi Pengiriman pada Kolom diatas.</p></center>";
                      }else{
                        $obj = cek_resi($rows['no_resi'],$rows['kode_kurir']);
                        if(config('api_resi_aktif')=='rajaongkir'){
                          $search_array = explode(',',config('api_resi_off'));
                          if (in_array($rows['kode_kurir'], $search_array)) { // Jika resi Off di Rajaongkir maka cek dengan https://binderbyte.com/
                            if ($obj['status']!='200'){
                                echo "<center style='color:red; margin:10% 0px'><img src='".base_url()."asset/images/no-data.png'>
                                <p>Data Resi untuk pesanan Tidak ditemukan, <br>Silahkan untuk memeriksa kembali No Resi Pengiriman anda.<br>
                                <a class='btn btn-primary btn-sm' target='_BLANK' href='https://cekresi.com/?noresi=$rows[no_resi]'>Link Alternatif - Lacak via cekresi.com</a></p></center>";
                            }else{
                              echo "<table class='table table-condensed'>
                                    <tbody>
                                    <tr>
                                        <tr><td width='130'>No Resi</td>        <td>:</td><td><b>".$obj['data']['summary']['awb']."</b></td></tr>
                                        <tr><td>Status</td>                     <td>:</td><td><b style='color:blue'>".$obj['data']['summary']['status']."</b></td></tr>
                                        <tr><td>Dikirim tanggal</td>            <td>:</td><td>".jam_tgl_indo($obj['data']['summary']['date'])."</td></tr>
                                        <tr><td valign='top'>Pengirim / Dari</td>  <td valign='top'>:</td><td valign='top'><b>".$obj['data']['detail']['shipper']."</b> / ".$obj['data']['detail']['origin']."</td></tr>
                                        <tr><td valign='top'>Penerima / Tujuan</td>    <td valign='top'>:</td><td valign='top'><b>".$obj['data']['detail']['receiver']."</b> / ".$obj['data']['detail']['destination']."</td></tr>
                                    </tbody>
                                </table><br>
                                
                                <table class='table table-condensed'>
                                <thead>
                                <tr>
                                    <th width='160px'><b>Tanggal</b></th>
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
                                echo "<table class='table table-condensed'>
                                    <tbody>
                                    <tr>
                                        <tr><td width='130'>No Resi</td>        <td>:</td><td><b>".$obj['rajaongkir']['result']['details']['waybill_number']."</b></td></tr>
                                        <tr><td>Status</td>                     <td>:</td><td><b>".$obj['rajaongkir']['result']['summary']['status']."</b></td></tr>
                                        <tr><td>Dikirim tanggal</td>            <td>:</td><td>".$obj['rajaongkir']['result']['details']['waybill_date']." ".$obj['rajaongkir']['result']['details']['waybill_time']."</td></tr>
                                        <tr><td valign='top'>Dikirim oleh</td>  <td valign='top'>:</td><td valign='top'>".$obj['rajaongkir']['result']['details']['shippper_name']."<br>".$obj['rajaongkir']['result']['details']['origin']."</td></tr>
                                        <tr><td valign='top'>Dikirim ke</td>    <td valign='top'>:</td><td valign='top'>".$obj['rajaongkir']['result']['details']['receiver_name']."<br> ".$obj['rajaongkir']['result']['details']['receiver_address1']." ".$obj['rajaongkir']['result']['details']['receiver_address2']." ".$obj['rajaongkir']['result']['details']['receiver_address3']." ".$obj['rajaongkir']['result']['details']['receiver_city']."</td></tr>
                                        <tr><td>Kurir Status</td>                 <td>:</td><td>".$obj['rajaongkir']['result']['delivery_status']['status']."</td></tr>
                                    </tbody>
                                </table><br>
                                
                                <table class='table table-condensed'>
                                <thead>
                                <tr>
                                    <th width='160px'><b>Tanggal</b></th>
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
                          echo "<table class='table table-condensed'>
                                  <tbody>
                                  <tr>
                                      <tr><td width='130'>No Resi</td>        <td>:</td><td><b>".$obj['data']['summary']['awb']."</b></td></tr>
                                      <tr><td>Status</td>                     <td>:</td><td><b style='color:blue'>".$obj['data']['summary']['status']."</b></td></tr>
                                      <tr><td>Dikirim tanggal</td>            <td>:</td><td>".jam_tgl_indo($obj['data']['summary']['date'])."</td></tr>
                                      <tr><td valign='top'>Pengirim / Dari</td>  <td valign='top'>:</td><td valign='top'><b>".$obj['data']['detail']['shipper']."</b> / ".$obj['data']['detail']['origin']."</td></tr>
                                      <tr><td valign='top'>Penerima / Tujuan</td>    <td valign='top'>:</td><td valign='top'><b>".$obj['data']['detail']['receiver']."</b> / ".$obj['data']['detail']['destination']."</td></tr>
                                  </tbody>
                              </table><br>
                              
                              <table class='table table-condensed'>
                              <thead>
                              <tr>
                                  <th width='160px'><b>Tanggal</b></th>
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
                <?php } ?>
              </div>