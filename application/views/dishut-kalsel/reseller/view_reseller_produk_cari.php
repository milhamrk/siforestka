<div class="row">
<?php 
    foreach ($record->result_array() as $row){
        $ex = explode(';', $row['gambar']);
        if (trim($ex[0])=='' OR !file_exists("asset/foto_produk/".$ex[0])){ $foto_produk = 'no-image.png'; }else{ if (!file_exists("asset/foto_produk/thumb_".$ex[0])){ $foto_produk = $ex[0]; }else{ $foto_produk = "thumb_".$ex[0]; }}
        if (strlen($row['nama_produk']) > 38){ $judul = substr($row['nama_produk'],0,38).',..';  }else{ $judul = $row['nama_produk']; }
        $jual = $this->model_reseller->jual_reseller($row['id_reseller'],$row['id_produk'])->row_array();
        $beli = $this->model_reseller->beli_reseller($row['id_reseller'],$row['id_produk'])->row_array();

        $disk = $this->model_app->view_where("rb_produk_diskon",array('id_produk'=>$row['id_produk']))->row_array();
        $diskon = rupiah(($disk['diskon']/$row['harga_konsumen'])*100,0)." %";

        if ($beli['beli']-$jual['jual']<=0){ 
            $stok = "<div class='ps-product__badge out-stock'>Habis Terjual</div>"; 
            $diskon_persen = ''; 
        }else{ 
            $stok = ""; 
            if ($diskon>0){ 
                $diskon_persen = "<div class='ps-product__badge'>$diskon</div>"; 
            }else{
                $diskon_persen = ''; 
            }
        }

        if ($diskon>=1){ 
            $harga_produk =  "Rp ".rupiah($row['harga_konsumen']-$disk['diskon'])." <del style='display:none'>".rupiah($row['harga_konsumen'])."</del>";
        }else{
            $harga_produk =  "Rp ".rupiah($row['harga_konsumen']);
        }

        $sold = $this->model_reseller->produk_terjual($row['id_produk'],2);
        $persentase = ($sold->num_rows()/$beli['beli'])*100;
        $cek_save = $this->db->query("SELECT * FROM rb_konsumen_simpan where id_konsumen='".$this->session->id_konsumen."' AND id_produk='$row[id_produk]'")->num_rows();
        echo "<div class='col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 '>
                <div class='ps-product'>
                    <div class='ps-product__thumbnail'><a href='".base_url()."produk/detail/$row[produk_seo]'><img src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a>
                    $diskon_persen
                    $stok
                    <ul class='ps-product__actions produk-$row[id_produk]'>
                        <li><a href='".base_url()."produk/detail/$row[produk_seo]' data-toggle='tooltip' data-placement='top' title='Read More'><i class='icon-bag2'></i></a></li>
                        <li><a href='#' data-toggle='tooltip' data-placement='top' title='Quick View' class='quick_view' data-id='$row[id_produk]'><i class='icon-eye'></i></a></li>";
                        if ($cek_save>='1'){
                            echo "<li><a data-toggle='tooltip' data-placement='top' title='Add to Whishlist'><i style='color:red' class='icon-heart'></i></a></li>";
                        }else{
                            echo "<li><a data-toggle='tooltip' data-placement='top' id='save-$row[id_produk]' title='Add to Whishlist'><i class='icon-heart' onclick=\"save('$row[id_produk]',this.id)\"></i></a></li>";
                        }
                    echo "</ul>
                    </div>
                    <div class='ps-product__container'><a class='ps-product__vendor' href='".base_url()."u/".user_reseller($row['id_reseller'])."'>$row[nama_reseller]</a>
                        <div class='ps-product__content'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]' title='$row[nama_produk]'>$judul</a>
                            <p class='ps-product__price'>$harga_produk</p>
                        </div>
                        <div class='ps-product__content hover'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]' title='$row[nama_produk]'>$judul</a>
                            <p class='ps-product__price'>$harga_produk</p>
                        </div>
                    </div>
                </div>
            </div>";
    }
?>
</div>