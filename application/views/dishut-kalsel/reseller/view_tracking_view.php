<?php 
    $wp = $this->db->query("SELECT a.waktu_proses FROM `rb_penjualan_otomatis` a JOIN rb_penjualan b ON a.kode_transaksi=b.kode_transaksi where a.nominal='$unik[nominal]' AND b.proses='0' AND SUBSTR(timediff(now(), a.waktu_proses),1,2)<'24' GROUP BY b.kode_transaksi")->row_array();
    $date1 = str_replace('-', '/', $wp['waktu_proses']);
    $tomorrow = date('Y-m-d H:i:s',strtotime($date1 . "+1 days"));
    $ss = $this->db->query("SELECT a.*, b.proses, timediff('$tomorrow', now()) as sisa_waktu, SUBSTR(timediff(now(), a.waktu_proses),1,2) as durasi FROM `rb_penjualan_otomatis` a JOIN rb_penjualan b ON a.kode_transaksi=b.kode_transaksi where a.nominal='$unik[nominal]' AND b.proses='0' AND SUBSTR(timediff(now(), a.waktu_proses),1,2)<'24' GROUP BY b.kode_transaksi")->row_array();
?>
<script type="text/javascript">
     $(document).ready(function() {
         var detik   = <?php echo substr($ss['sisa_waktu'],6,2); ?>;
         var menit   = <?php echo substr($ss['sisa_waktu'],3,2); ?>;
         var jam     = <?php echo substr($ss['sisa_waktu'],0,2); ?>;
         var hari    = 0;
         var bulan   = 0;
         function hitung() {
             /** setTimout(hitung, 1000) digunakan untuk 
                 * mengulang atau merefresh halaman selama 1000 (1 detik) 
             */
             setTimeout(hitung,1000);

             /** Jika waktu kurang dari 10 menit maka Timer akan berubah menjadi warna merah */
             if(menit < 10 && jam == 0 && hari == 0 && bulan == 0){
                  var peringatan = 'style="color:red;"';
             };

             /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
             $('#timer').html(
                 '<div align="center"'+peringatan+'>Selesaikan Pembayaran pesanan dalam <br />' + jam + ' jam, ' + menit + ' menit, ' + detik + ' detik</h1><br><hr>'
             );

             /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
             detik --;

             /** Jika var detik < 0
                 * var detik akan dikembalikan ke 59
                 * Menit akan Berkurang 1
             */
             if(detik < 0) {
                 detik = 59;
                 menit --;

                 /** Jika menit < 0
                     * Maka menit akan dikembali ke 59
                     * Jam akan Berkurang 1
                 */
                 if(menit < 0) {
                     menit = 59;
                     jam --;
                      
                     /** Jika jam < 0
                         * Maka jam akan dikembali ke 23
                         * Jam akan Berkurang 1
                     */
                     if(jam < 0) {
                         jam = 23;
                         hari --;
                          
                         /** Jika hari < 0
                             * Maka hari akan dikembali ke 29
                             * Jam akan Berkurang 1
                         */                             
                         if(hari < 0) {
                             hari = 29
                             bulan --;
                              
                             /** Jika var bulan < 0
                                 * clearInterval() Memberhentikan Interval dan submit secara otomatis
                             */
                             if(bulan < 0){
                                 clearInterval(); 
                                 /** Variable yang digunakan untuk submit secara otomatis di Form */
                                 var sub = document.getElementById("sub"); 
                                 alert('Waktu Pembayaran Otomatis telah habis, Silahkan konfirmasi manual jika sudah transfer...');
                             }
                         }
                     }
                 } 
             } 
         }           
         /** Menjalankan Function Hitung Waktu Mundur */
         hitung();
   }); 
   // ]]>
 </script>

<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="<?php echo base_url()."konfirmasi/tracking"; ?>">Tracking</a></li>
            <li><?php echo $judul; ?></li>
        </ul>
    </div>
</div>
<div class="ps-section--shopping ps-shopping-cart">
    <div class="container">
        <div class="ps-section__content">
            <div class="table-responsive">
                <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 ">
                <?php 
                $cek_cod = $this->db->query("SELECT * FROM rb_penjualan where kode_kurir='0' AND kode_transaksi='$judul'");
                if ($cek_cod->num_rows()>=1){ // Cek Transaksi COD
                    echo "<p style='font-size:17px'> <div class='alert alert-danger'><strong>PENTING</strong> - Khusus Pesanan dengan COD (Cash on delivery) bisa bayar saat serah terima Produk...</div></p>";
                }

                $cek_onl = $this->db->query("SELECT * FROM rb_penjualan where kode_kurir!='0' AND kode_transaksi='$judul'");
                if ($cek_onl->num_rows()>=1){ // Cek Transaksi Online
                    $cek_pembayaran = $this->db->query("SELECT * FROM rb_penjualan_otomatis where kode_transaksi='$judul' AND nominal='$unik[nominal]' AND pembayaran='1'");
                    if ($rows['proses']=='0'){
                        if ($cek_pembayaran->num_rows()>='1'){
                            echo "<div class='alert alert-success' role='alert'><center style='font-size:16px'>Terima kasih, pembayaran untuk order ini telah kami terima, 
                            Dan kami telah menginformasikan kepada seller untuk segera diproses dalam 1 x 24 Jam.</center></div>";
                        }else{
                            $cek_payment = $this->db->query("SELECT catatan FROM rb_penjualan_otomatis where kode_transaksi='$judul' AND nominal='$unik[nominal]'")->row_array();
                            if ($ss['durasi']<='24'){
                            echo "<div style='font-size:18px; color:red; line-height:initial' id='timer'></div>";
                            }

                            if (is_numeric($cek_payment['catatan'])!='1'){
                                echo "<p><center style='font-size:16px'>Lakukan pembayaran <u><b class='nominaltrx1' style='color:green'>".rupiah($unik['nominal'])."</b></u>
                                <button type='button' id='copy' data-toggle='button' title='Copy Nominal Transfer' aria-pressed='false' autocomplete='off' class='btn btn-success btn-xs myButton' onclick=\"copyToClipboard('.nominaltrx1')\"><span style='font-size:12px' class='fa fa-copy'></span></button>
                                (Tepat Hingga 3 Digit Terakhir) :</center></p>";
                                echo "<table class='table table-sm table-hover'>
                                    <thead>
                                    <tr bgcolor='#e3e3e3'>
                                        <th scope='col' width='20px'><strong>No</strong></th>
                                        <th scope='col'><strong>Nama Bank</strong></th>
                                        <th scope='col'><strong>Rekening</strong></th>
                                        <th scope='col'><strong>Atas Nama</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>";
                                        $nooo = 1;
                                        $rekening = $this->model_app->view('rb_rekening');
                                        foreach ($rekening->result_array() as $row){
                                            echo "<tr><td>$nooo</td>
                                                <td>$row[nama_bank]</td>
                                                <td><button style='border:1px solid #d2d2d2' type='button' id='copy' data-toggle='button' title='Copy No. Rekening' aria-pressed='false' autocomplete='off' class='btn btn-default btn-xs myButton' onclick=\"copyToClipboard('.rekening$nooo')\"><span style='font-size:12px' class='fa fa-copy'></span></button> <span class='rekening$nooo'> <b>$row[no_rekening]</b></span></td>
                                                <td>$row[pemilik_rekening]</td>
                                            </tr>";
                                            $nooo++;
                                        }
                                echo "</tbody>
                                    </table>";
                            }else{
                                echo "<div class='alert alert-info' role='alert'><center style='font-size:15px'><b>PENTING</b> - Kami Telah Mengirim Sebuah pesan ke email anda <b>".sensor_email($rows['email'])."</b> untuk menyelesaikan pembayaran pesanan anda ini, Terima kasih...</center></div>";
                            }
                        }
                            echo "<hr>";
                    }

                    if (config('ipaymu_aktif')=='Y'){
                        if ($rows['proses']=='0'){
                            if ($cek_pembayaran->num_rows()<='0'){
                                $cp = $this->db->query("SELECT status_trx FROM rb_penjualan_otomatis where kode_transaksi='$judul' AND nominal='$unik[nominal]'")->row_array();
                                if ($cp['status_trx']=='pending'){
                                    echo "<a target='_BLANK' class='ps-btn ps-btn--fullwidth' href='".base_url()."konfirmasi/bayar?inv=$kode'>Proses Ulang Pembayaran Pesanan</a><br>";
                                }else{
                                    echo "<a target='_BLANK' class='ps-btn ps-btn--fullwidth' href='".base_url()."konfirmasi/bayar?inv=$kode'>Lihat Metode Pembayaran Lainnya...</a><br>";   
                                }
                            }
                        }
                    }

                }
                

                echo "<br><table class='table table-sm'>
                    <tbody>
                    <tr><td style='width:150px'><strong>No. Invoice</strong></td>  <td class='text-success'><b>$judul</b></td></tr>
                        <tr><td><strong>Dikirim kepada</strong></td>  <td>$rows[nama_lengkap]</td></tr>
                        <tr><td><strong>No Hp/Telpon</strong></td>      <td>".substr($rows['no_hp'], 0, -2)."xx</td></tr>
                        <tr><td><strong>Alamat Pengiriman</strong></td> <td>".alamat($judul)."</td></tr>
                    </tbody>
                    </table><hr>
                    
                    <div style='padding:5px; font-size:16px; font-weight:bold; background:#f4f4f4; border-bottom:1px solid #ab0534; margin-bottom:10px;'>Data Produk</div>";
                          $no = 1;
                          foreach ($record->result_array() as $row){
                          $cku = $this->db->query("SELECT * FROM rb_penjualan_kupon where id_penjualan_detail='$row[id_penjualan_detail]'")->row_array();
                          $sub_total = (($row['harga_jual']-$row['diskon'])*$row['jumlah']);
                          $ext = explode(';', $row['gambar']);
                          if ($row['preorder']!='' AND $row['preorder']>0){
                            $pre_order = "<span class='badge badge-secondary'>Pre-Order $row[preorder] Hari</span>";
                          }else{
                            $pre_order = "";
                          }
                          if (trim($ext[0])=='' OR !file_exists("asset/foto_produk/".$ext[0])){ $foto_produk = 'no-image.png'; }else{ if (!file_exists("asset/foto_produk/thumb_".$ext[0])){ $foto_produk = $ext[0]; }else{ $foto_produk = "thumb_".$ext[0]; }}
                          echo "<a style='font-size:17px; display:block; border-bottom:1px dotted' href='".base_url()."produk/detail/$row[produk_seo]'>$row[nama_produk]</a>
                                <div class='ps-product--cart'>
                                    <div class='ps-product__thumbnail'>
                                        <div style='height:60px; overflow:hidden'><a href='".base_url()."produk/detail/$row[produk_seo]'><img style='padding-right:10px' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a></div>
                                    </div>
                                    
                                    <div class='ps-product__content' style='text-align:left; padding-left:0px'>
                                    <p style='margin-bottom:0'>$row[nama_reseller] $pre_order</p>
                                    <b>Qty.</b> $row[jumlah] x ".rupiah($row['harga_jual']-$row['diskon'])." = ";
                                      if ($cku['nilai']>0){
                                        echo "<del style='color:#8a8a8a'><b>".rupiah($sub_total)."</b></del> <b>".rupiah($sub_total-$cku['nilai'])."</b>";
                                      }else{
                                        echo "<b>".rupiah($sub_total)."</b>";
                                      }
                                      echo "<br>";
                                        
                                        $catatan = explode('||',$row['keterangan_order']);
                                        // $variasi = $this->db->query("SELECT * FROM rb_produk_variasi where id_produk='$row[id_produk]' ORDER BY id_variasi ASC");
                                        // if ($variasi->num_rows()>0){ 
                                        //     $noo = 1;
                                        //     $ex = explode(';',$catatan[1]);
                                        //     $exx = explode('|',$ex[$ii]);
                                        //     echo "<b>Variasi : </b>";
                                        //     for ($ii=0; $ii < count($ex); $ii++) { 
                                        //         $exx = explode('|',$ex[$ii]);
                                        //             echo "<u>".trim($exx[1])."</u>, ";
                                        //         //$variasi_terpilih[] = trim($exx[0]);
                                        //     }
                                        //     // foreach ($variasi->result_array() as $va) {
                                        //     //     if ($noo%2 == 1){ $bg = '#e3e3e3'; }else{ $bg = '#f4f4f4'; }
                                        //     //     echo "<div style='background:$bg; padding:3px 10px; display:inline-block'><b>$va[nama]</b> : "; 
                                        //     //     $variasi = explode(";",$va['variasi']);
                                        //     //     for ($i=0; $i < count($variasi) ; $i++) { 
                                        //     //         $nama_variasi = "variasi".$noo.$i.$no;
                                        //     //         $_ck = (array_search($nama_variasi, $variasi_terpilih) === false)? '' : 'checked';
                                        //     //         if ($_ck=='checked'){
                                        //     //           echo "<span style='color:blue'>".$variasi[$i]."</span> &nbsp; ";
                                        //     //         }
                                        //     //     }
                                        //     //     echo "</div>";
                                        //     //     $noo++;
                                        //     // }
                                        //     echo "<br>";
                                        // }
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
                
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                    <div class="ps-block--shopping-total">
                        <div class="ps-block__header">
                            <?php 
                                $ong = $this->db->query("SELECT sum(ongkir) as ongkir, sum(fee_admin)/count(*) as fee_admin FROM rb_penjualan where kode_transaksi='$kode'")->row_array();
                                $angka_acak = substr($judul,-3);
                            ?>
                            <p style='margin-bottom:0px'><b>Status Order<span class='text-danger'><?php echo status($total['proses']); ?></span></b></p><hr>
                            <p style='margin-bottom:0px'>Berat<span> <?php echo "$total[total_berat] Gram"; ?></span></p>
                            <p style='margin-bottom:0px'>Ongkos Kirim <span> <?php echo "Rp ".rupiah($ong['ongkir']); ?></span></p>
                            <?php 
                                if ($ong['fee_admin']>'0'){
                                    echo "<p style='margin-bottom:0px'>Fee Admin <span>Rp ".rupiah($ong['fee_admin'])."</span></p>";
                                }
                            ?>
                            <p style='margin-bottom:0px'>Subtotal <span> <?php echo "Rp ".rupiah($total['total']-$total['diskon_total']); ?></span></p>
                            <hr>
                            <?php   
                                $data_kupon = $this->db->query("SELECT c.* FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
                                JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
                                where b.kode_transaksi='$kode'");
                                foreach ($data_kupon->result_array() as $kup) {
                                    echo "<p style='margin-bottom:0px'>
                                         <b style='color:green'>$kup[kode]</b>
                                         <span>Rp -".rupiah($kup['nilai'])."</span></p>";
                                }
                            ?>
                            <p style='margin-bottom:0px'>Kode Unik<span> +<?php echo $angka_acak; ?></span></p>
                            <small class='text-success'><i><b>NOTE</b> : (<?php echo $angka_acak; ?> Kode untuk mengenali transferan anda)</i></small>
                        </div>
                        <div class="ps-block__content">
                            <ul class="ps-block__product">
                                <?php
                                  $penjual = $this->db->query("SELECT a.id_penjualan, a.id_penjual, a.kode_kurir, a.ongkir, a.kurir, a.service, b.id_reseller, b.nama_reseller, b.alamat_lengkap, b.kecamatan_id, b.kota_id, c.nama_kota FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller JOIN rb_kota c ON b.kota_id=c.kota_id where a.kode_transaksi='$kode'");
                                  foreach ($penjual->result_array() as $pen) {
                                    $bel = $this->db->query("SELECT sum(jumlah*(harga_jual-diskon)) as total FROM `rb_penjualan_detail` where id_penjualan='$pen[id_penjualan]'")->row_array();
                                    $ber = $this->db->query("SELECT sum(c.berat) as berat FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan 
                                                                JOIN rb_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='$kode' AND a.id_penjual='$pen[id_penjual]'")->row_array();
                                    $kupon = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
                                    JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
                                        where b.id_penjualan='$pen[id_penjualan]'")->row_array();
                                    
                                    echo "<li><a href='".base_url()."u/".user_reseller($pen['id_reseller'])."'><u><b>$pen[nama_reseller]</b></u></a> <br>";
                                    if ($kupon['diskon']>0){
                                        echo "<b>Belanja</b> : <del style='color:#8a8a8a'>Rp ".rupiah($bel['total'])."</del> Rp ".rupiah($bel['total']-$kupon['diskon'])."<br>";
                                    }else{
                                        echo "<b>Belanja</b> : Rp ".rupiah($bel['total']-$kupon['diskon'])."<br>";
                                    }

                                    echo "<b>Ongkir</b> : Rp ".rupiah($pen['ongkir'])." <small style='color:blue'>($ber[berat] Gram)</small><br>";
                                    if ($pen['service']=='SOPIR'){
                                    $ceks = $this->db->query("SELECT * FROM rb_sopir where id_sopir='".(int)$pen['kurir']."'")->row_array();
                                        echo "<b>Kurir</b> : <small style='color:blue'>$pen[service] - $ceks[merek] ($ceks[plat_nomor])</small>";
                                    }else{
                                        echo "<b>Kurir</b> : <small style='color:blue'>$pen[kurir], $pen[service]</small>";
                                    }

                                    echo "<br><b>Dikirim dari</b> : $pen[alamat_lengkap], ".kecamatan($pen['kecamatan_id'],$pen['kota_id'])."<br>";
                                    if ($pen['kode_kurir']!='0'){
                                        if ($pen['kode_kurir']!='1'){  
                                            echo "<a class='blink_me' href='".base_url()."members/keranjang_detail/$pen[id_penjualan]'><u>Cek Resi Pengiriman</u></a>";
                                        }else{
                                            echo "<a class='blink_me' href='".base_url()."members/keranjang_detail/$pen[id_penjualan]'><u>Lihat Detail Pesanan</u></a>";
                                        }
                                    }else{
                                        echo "<a class='blink_me' href='".base_url()."members/keranjang_detail/$pen[id_penjualan]'><u>Lihat Detail Pesanan</u></a>";
                                    }
                                    echo "</li>";
                                  }
                                ?>
                                
                            </ul>
                            <h3>Total <span><b class='nominaltrx2'><?php echo rupiah($unik['nominal']); ?></b> <button style='float:right; margin-left:10px; border:1px solid #ababab' type='button' id='copy' data-toggle='button' title='Copy Nominal Transfer' aria-pressed='false' autocomplete='off' class='btn btn-default myButtonL' onclick="copyToClipboard('.nominaltrx2')"><span style='font-size:18px' class='fa fa-copy'></span></button></span></h3>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <hr>

    </div>
</div>