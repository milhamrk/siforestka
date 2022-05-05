
<?php
$rows = $this->db->query("SELECT a.*, b.nama_kota, c.nama_provinsi FROM `rb_reseller` a JOIN rb_kota b ON a.kota_id=b.kota_id
                            JOIN rb_provinsi c ON b.provinsi_id=c.provinsi_id where a.id_reseller='$record[id_reseller]'")->row_array();
$kat = $this->model_app->view_where('rb_kategori_produk',array('id_kategori_produk'=>$record['id_kategori_produk']))->row_array();
$jual = $this->model_reseller->jual_reseller($record['id_reseller'],$record['id_produk'])->row_array();
$beli = $this->model_reseller->beli_reseller($record['id_reseller'],$record['id_produk'])->row_array();
$disk = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='$record[id_produk]'")->row_array();
$diskon = rupiah(($disk['diskon']/$record['harga_konsumen'])*100,0)."%";
if ($disk['diskon']>0){ $diskon_persen = "<div class='top-right'>$diskon</div>"; }else{ $diskon_persen = ''; }
if ($disk['diskon']>=1){ 
  $harga_konsumen =  "Rp ".rupiah($record['harga_konsumen']-$disk['diskon']);
  $harga_asli = "Rp ".rupiah($record['harga_konsumen']);
}else{
  $harga_konsumen =  "Rp ".rupiah($record['harga_konsumen']);
  $harga_asli = "";
}
?>


                                
<h3 style='font-weight:400;'><?php echo $record['nama_produk']; ?></h3>
<?php
    if ($record['gambar'] != ''){ 
        $ex = explode(';',$record['gambar']);
        $hitungex = count($ex);
        for($i=0; $i<1; $i++){
            if (file_exists("asset/foto_produk/".$ex[$i])) { 
                echo "<div class='item'><a href='".base_url()."asset/foto_produk/".$ex[$i]."'><img style='width:220px; float:left; margin-right:10px' src='".base_url()."asset/foto_produk/".$ex[$i]."'></a></div>";
            }
        }
    }
?><div class="ps-product__meta">
    <p>Berat : <a href="#"><?php echo "$record[berat] Gram" ?></a>,
    Rating : <?php echo rate_total($record['id_produk']).'/5, ada '.rate_jumlah($record['id_produk']); ?> Ulasan </p>
        

</div>
<h4 class="ps-product__price" style='margin-bottom: 0px'><?php echo "$harga_konsumen <del style='color:#8a8a8a'>$harga_asli</del>"; ?></h4>
<div class="ps-product__desc">
    <p>Penjual :<a href="<?php echo base_url()."u/".user_reseller($record['id_reseller']).""; ?>"><strong> <?php echo $rows['nama_reseller']; ?></strong></a></p>
    <?php 
    $variasi = $this->db->query("SELECT * FROM rb_produk_variasi where id_produk='$record[id_produk]' ORDER BY id_variasi ASC");
    if ($variasi->num_rows()>0){ echo "<p>";
        foreach ($variasi->result_array() as $va) {
            echo "<b>$va[nama]</b> : ".str_replace(';',', ',$va['variasi'])." <br>";
        }
        echo "</p>";
    }
    echo ($record['tentang_produk']); 
    ?>
</div>

<?php 
    echo "<form action='".base_url()."produk/keranjang/$record[id_reseller]/$record[id_produk]' method='POST'>";
?>
    <div style='clear:both'><br></div>
    <!-- <div class='pull-right'>
        <input style='font-size:20px' class="form-control" type="hidden" value='1' name='qty'>
        <button type='submit' name='keranjang' class="ps-btn ps-btn--black ml-3" style='color:#fff'>+ Keranjang</button>
        <button type='submit' name='beli' class="ps-btn">Beli Sekarang</button>
    </div> -->
</form>
                        