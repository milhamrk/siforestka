<?php 
$angka_acak = substr($judul,-3);
echo "<form action='".base_url()."komplain/resolusi/".cetak($this->input->post('id'))."' method='POST'>
<table class='table table-sm'>
<tbody>
<tr><td style='width:150px'><strong>No. Invoice</strong></td>  <td class='text-success'><b>$rows[kode_transaksi]/$rows[id_reseller]</b></td></tr>
    <tr><td><strong>Isi Komplain</strong></td>         <td><textarea class='form-control' style='height:80px; padding:1rem' name='komplain' placeholder='Tuliskan Permasalahan / Keluhan disini...' required></textarea></td></tr>
</tbody>
</table><hr>

<div style='padding:5px; font-size:16px; font-weight:bold; background:#f4f4f4; border-bottom:1px solid #ab0534; margin-bottom:10px;'>Pilih / Checklist ''<span class='fa fa-check-square'></span>'' Produk yang Bermasalah?</div>
<div style='height:240px; overflow-y: scroll;'>";
$no = 1;
foreach ($record as $row){
$sub_total = (($row['harga_jual']-$row['diskon'])*$row['jumlah']);
$ex = explode(';', $row['gambar']);
if (trim($ex[0])=='' OR !file_exists("asset/foto_produk/".$ex[0])){ $foto_produk = 'no-image.png'; }else{ $foto_produk = $ex[0]; }
echo "<div style='border-bottom:1px dotted'><input type='checkbox' name='pilih[]' value='$row[id_penjualan_detail]'>
        <a style='font-size:17px; display:inline-block' target='_BLANK' href='".base_url()."produk/detail/$row[produk_seo]'>$row[nama_produk]</a>
      </div>
<div class='ps-product--cart'>
    <div class='ps-product__thumbnail'>
        <div style='height:60px; overflow:hidden'><a href='".base_url()."produk/detail/$row[produk_seo]'><img style='padding-right:10px' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a></div>
    </div>
    
    <div class='ps-product__content' style='text-align:left; padding-left:0px'>
    <b>Qty.</b> $row[jumlah] x ".rupiah($row['harga_jual']-$row['diskon'])." = <b>".rupiah($sub_total)."</b><br>";
        
        $catatan = explode('||',$row['keterangan_order']);
        $variasi = $this->db->query("SELECT * FROM rb_produk_variasi where id_produk='$row[id_produk]' ORDER BY id_variasi ASC");
        if ($variasi->num_rows()>0){ 
            $noo = 1;
            $ex = explode(';',$catatan[1]);
            for ($ii=0; $ii < count($ex) ; $ii++) { 
                $exx = explode('|',$ex[$ii]);
                $variasi_terpilih[] = trim($exx[0]);
            }
            foreach ($variasi->result_array() as $va) {
                if ($noo%2 == 1){ $bg = '#e3e3e3'; }else{ $bg = '#f4f4f4'; }
                echo "<div style='background:$bg; padding:3px 10px; display:inline-block'><b>$va[nama]</b> : "; 
                $variasi = explode(";",$va['variasi']);
                for ($i=0; $i < count($variasi) ; $i++) { 
                    $nama_variasi = "variasi".$noo.$i.$no;
                    $_ck = (array_search($nama_variasi, $variasi_terpilih) === false)? '' : 'checked';
                    if ($_ck=='checked'){
                    echo "<span style='color:blue'>".$variasi[$i]."</span> &nbsp; ";
                    }
                }
                echo "</div>";
                $noo++;
            }
            echo "<br>";
        }
        if (trim($catatan[0])!=''){
        echo "<b>Catatan</b> : ".$catatan[0];
        }
    echo "</div>
</div><br>";
    $no++;
}
echo "</div><hr><div class='float-right'>
<button type='button' style='width:130px' class='ps-btn ps-btn--outline' data-dismiss='modal'>Kembali</button>
<button type='submit' style='width:130px' name='submit' class='ps-btn'>Selanjutnya</button>
</div>
</form>";
?>
                        