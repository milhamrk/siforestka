<?php 
  if (trim($rows['foto'])==''){ $foto_user = 'toko.jpg'; }else{ $foto_user = $rows['foto']; }
  $ex = explode(' ', $rows['tanggal_daftar']);
  $sukses = $this->db->query("SELECT * FROM rb_penjualan where id_penjual='$rows[id_reseller]' AND status_penjual='reseller' AND proses!='0'");
  //$pelanggan = $this->db->query("SELECT * FROM rb_penjualan where id_penjual='$rows[id_reseller]' AND status_pembeli='konsumen' AND status_penjual='reseller' GROUP BY id_pembeli");
?>
<div class="ps-section__left">
  <div class="ps-block--vendor">
      <div class="ps-block__thumbnail"><img src="<?php echo base_url()."asset/foto_user/$foto_user"; ?>" alt=""></div>
      <div class="ps-block__container">
          <div class="ps-block__header">
            <?php 
                  echo verifikasi_icon($rows['id_reseller']);
                  echo cek_paket_icon($rows['id_reseller']); ?><h4><?php echo $rows['nama_reseller']."</h4>";
            ?>
            <div class="br-wrapper br-theme-fontawesome-stars">
            
            </div>
          </div>
          <span class="ps-block__divider"></span>
          <div class="ps-block__content">
              <?php echo $rows['keterangan']; ?>
              <span class="ps-block__divider"></span>
              <?php echo $rows['alamat_lengkap']; ?>
              <p><strong><?php echo kecamatan($rows['kecamatan_id'],$rows['kota_id']); ?></strong></p>
              <span class="ps-block__divider"></span>
          </div>
          <div class="ps-block__footer">
            <?php if (config('wa_seller')=='Y'){ ?>
              <p>Hubungi kami di : <strong>+<?php echo format_telpon($rows['no_telpon']); ?></strong>atau Klik Tombol Dibawah ini </p><a class="ps-btn ps-btn--fullwidth" target='_BLANK' href="<?php echo "https://api.whatsapp.com/send?phone=".format_telpon($rows['no_telpon'])."&amp;text=Hallo%20kak%20$rows[nama_reseller],%20Saya%20Mau%20Bertanya..."; ?>">Hubungi Kami</a>
            <?php } ?>
            </div>
      </div>
  </div>
</div>
