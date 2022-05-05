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
        ?>
                <?php 
                    $cek_paket = $this->db->query("SELECT * FROM rb_reseller_paket a JOIN rb_paket b ON a.id_paket=b.id_paket where a.id_reseller='".reseller($this->session->id_konsumen)."'");
                    foreach ($cek_paket->result_array() as $rowp) {
                      if ($rowp['status']=='Y'){
                        $akhir  = strtotime($rowp['expire_date']); //Waktu awal
                        $awal = time(); // Waktu sekarang atau akhir
                        $diff  = $akhir - $awal;
                        echo "<br><div class='alert alert-success'><strong>PENTING</strong> - Saat ini akun anda Aktif pada paket <b>$rowp[nama_paket]</b>, untuk Durasi $rowp[durasi] Hari.<br>
                                              Dan Masa aktif Paket Akan Berakhir pada ".tgl_indo($rowp['expire_date'])." (".floor($diff / (60 * 60 * 24)) ." hari lagi).</div>";
                      }else{
                        echo "<br><div class='alert alert-danger' style='color:#000000; background-color:#f3f3f3; border-color:#e2e2e2'><strong>PENTING</strong> - Anda telah memilih paket <b>$rowp[nama_paket]</b> pada ''".jam_tgl_indo($rowp['waktu_paket'])." WIB'', <br>
                        untuk Durasi aktif paket <b>$rowp[durasi] Hari</b>, Silahkan melakukan Pembayaran Tepat <b style='color:red; text-decoration:underline'>Rp ".rupiah($rowp['harga']+$rowp['id_reseller_paket'])."</b><hr>";
                              $noo = 1;
                              $rekening = $this->model_app->view('rb_rekening');
                              foreach ($rekening->result_array() as $row){
                                  echo "<span style='color:#000; display:block'>$noo. $row[nama_bank], <b>$row[no_rekening]</b>, A/N $row[pemilik_rekening]</span>";
                                  $noo++;
                              }
                        echo "</div>";
                      }
                    }

                    echo $this->session->flashdata('message'); 
                    $this->session->unset_userdata('message');

                    echo "<br><div class='row' style='margin-bottom:80px'>";
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    if ($no==1){ 
                      $bintang = "<i class='fa fa-star fa-fw'></i>";
                      $tombol = "warning";
                    }elseif ($no==2){ 
                      $bintang = "<i class='fa fa-star fa-fw'></i><i class='fa fa-star fa-fw'></i>";
                      $tombol = "info";
                    }elseif ($no==3){ 
                      $bintang = "<i class='fa fa-star fa-fw'></i><i class='fa fa-star fa-fw'></i><i class='fa fa-star fa-fw'></i>";
                      $tombol = "success";
                    }
                    echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12' style='border-right: 1px solid #e3e3e3; border-left: 1px solid #e3e3e3;'>
                            <h3 class='mb-10 text-center'>$row[nama_paket]</h3>
                            <center>
                            $row[judul]<br><br>
                            <div class='price-block'>
                            <div class='price-block-wrapper'>
                              <div class='currency'>Rp.</div>
                              <div class='harga'>".rupiah($row['harga'])."</div>
                              <div class='waktu_block'>
                                <div class='waktu'>$row[durasi]/hari</div>
                              </div>
                            </div>
                            </div><br>
                            <a style='padding:7px 20px; font-size:16px; color:#fff' class='btn btn-$tombol btn-lg'  onclick=\"return confirm('Apa anda yakin untuk pilih paket ".$row['nama_paket']."?')\" href='".base_url().$this->uri->segment(1)."/upgrade?paket=$row[id_paket]'>$bintang Pilih Sekarang</a>
                            </center>
                            ".nl2br($row['keterangan'])."<div style='clear:both'><br></div><hr style='margin-top:5px; margin-bottom:10px'>
                          </div>
                          
                          <br class='d-none d-sm-block'><br class='d-none d-sm-block'>";
                      $no++;
                    }
                  ?>
              </div>
        </div>
    </div>
</div>