<?php if ($rows['kode_transaksi']!=''){ ?>
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="<?php echo base_url()."konfirmasi/tracking"; ?>">Konfirmasi</a></li>
            <li><?php echo $kode; ?></li>
        </ul>
    </div>
</div>
<?php } ?>
<div class="ps-order-tracking">
    <div class="container">
        <div class="ps-section__header">
            
            <?php if ($rows['kode_transaksi']==''){
                echo "<h3>$title</h3>";
                echo $this->session->flashdata('message'); 
                $this->session->unset_userdata('message');
                echo "<p>Untuk Melakukan konfirmasi pesanan Anda, masukkan No Pesanan Anda di kotak di bawah ini dan tekan tombol ''Submit''. Kode Ini diberikan kepada Anda pada saat tanda menerima detail pesanan dalam email konfirmasi.</p>";
              }elseif ($rows['kode_transaksi']!=''){ 
                $cek_konfirmasi = $this->db->query("SELECT * FROM rb_konfirmasi_pembayaran_konsumen where kode_transaksi='$rows[kode_transaksi]'");
                echo "<h3>Konfirmasi. <span style='font-size:28px'>$kode</span></h3>";
                if ($cek_konfirmasi->num_rows()>=1){
                  echo "<div class='alert alert-danger'><strong>PENTING</strong> - Pesanan ini sudah dikonfirmasi Sebelumnya sebanyak ".$cek_konfirmasi->num_rows()." kali,..</div>";
                }
                echo "<p>Untuk Melakukan konfirmasi pesanan Anda ''$kode'', Silahkan untuk memasukkan Data transferan yang telah anda lakukan pada form dibawah ini.</p>";
              } 
            ?>
          </div>
        <div class="ps-section__content">
            <?php 
              $attributes = array('class'=>'ps-form--order-tracking');
              echo form_open_multipart('konfirmasi/index',$attributes); 
              $ongk = $this->db->query("SELECT a.*, b.nama_lengkap FROM rb_penjualan a JOIN rb_konsumen b ON a.id_pembeli=b.id_konsumen where a.id_penjualan='$rows[id_penjualan]'")->row_array();
            
              if ($rows['kode_transaksi']==''){ 
              ?>
                  <div class="form-group">
                      <label>No Pesanan</label>
                      <input class="form-control" type="text" name='a' placeholder="Input No Pesanan, Contoh : TRX- - - - - - " required>
                  </div>
                  
                  <div class="form-group">
                      <label>Alamat E-mail</label>
                      <input class="form-control" type="text" placeholder="Alamat Email Terkait Pesanan,..">
                  </div>
                
              <?php
              }elseif ($rows['kode_transaksi']!=''){
                  echo "<input type='hidden' name='id' value='$rows[kode_transaksi]'>
                  <div class='form-group'><label>Total Tagihan/Transfer</label> <input type='text' name='b' class='form-control font-weight-bold text-success' value='".rupiah($total['nominal'])."' required></div>
                  <div class='form-group'><label>Transfer Ke Rekening</label> <select name='c' class='form-control'>";
                                                                          foreach ($record->result_array() as $row){
                                                                              echo "<option value='$row[id_rekening]'>$row[nama_bank] - $row[no_rekening], A/N : $row[pemilik_rekening]</option>";
                                                                          }
                  echo "</select></div>
                  <div class='form-group'><label>Nama Pengirim</label> <input type='text' class='form-control' value='$ongk[nama_lengkap]' name='d' required></div>
                  <div class='form-group'><label>Tanggal Transfer</label> <input type='text' class='datepicker form-control' name='e' data-date-format='yyyy-mm-dd' value='".date('Y-m-d')."'></div>
                  <div class='form-group'><label>Upload Bukti Transfer</label> <input class='form-control' type='file' name='f' required></div>";
                }
                ?>
                <div class="form-group">
                  <?php if ($rows['kode_transaksi']!=''){ ?>
                    <button type='submit' name='submit' class="ps-btn ps-btn--fullwidth">Konfirmasi Pembayaran</button>
                  <?php }else{ ?>
                    <button type='submit' name='submit1' class="ps-btn ps-btn--fullwidth">Submit</button>
                  <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>