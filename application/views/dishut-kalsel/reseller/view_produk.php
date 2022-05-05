<script> 
$(document).ready(function(){
    $(".flip").click(function(){
        $(".panel").toggle();
    });
});
</script>
<div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <?php 
                    if (cetak($this->input->get('s'))!=''){
                        echo "<li><a href='#'>Produk</a></li>
                              <li>$title</li>";
                    }else{
                        if (isset($_POST['cari'])){
                            echo "<li>Produk</li>";
                            echo "<li>$judul</li>";
                        }else{
                            echo "<li>Produk</li>";
                        }
                    }
                ?>
                
            </ul>
        </div>
    </div>
    <div class="ps-page--shop" id="shop-sidebar">
        <div class="container">
            <div class="ps-layout--shop">
                <?php include "sidebar-produk.php"; ?>
                <div class="ps-layout__right">
                    <button class="flip ps-btn--outline ps-btn--fullwidth d-block d-sm-none" style='margin-bottom:10px'>Filter Produk</button>
                    <div class="panel" style="display:none;">
                    <form style='margin-bottom:0px' class="ps-form--widget-search" action="<?php echo base_url(); ?>produk" method="GET">
                    <?php 
                        echo "<input type='text' style='padding-left:25px' class='form-control' placeholder='Keyword...' name='s' value='".cetak($_GET['s'])."' autocomplete='off'>
                        <select class='form-control' style='background:#fff' name='f'>
                            <option value='0' selected='selected'>Semua Kategori</option>";
                            $kategori = $this->model_app->view_ordering('rb_kategori_produk', 'nama_kategori', 'ASC');
                            foreach ($kategori as $rows) {
                                $sub_kategori = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY nama_kategori_sub ASC");
                                if (cetak($_GET['f']=="kategori|$rows[id_kategori_produk]")){
                                    echo "<option class='level-0' value='kategori|$rows[id_kategori_produk]' selected>$rows[nama_kategori]</option>";
                                }else{
                                    echo "<option class='level-0' value='kategori|$rows[id_kategori_produk]'>$rows[nama_kategori]</option>";
                                }
                                if ($sub_kategori->num_rows() >= 1) {
                                    foreach ($sub_kategori->result_array() as $row) {
                                        if (cetak($_GET['f']=="subkategori|$row[id_kategori_produk_sub]")){
                                            echo "<option class='level-1' value='subkategori|$row[id_kategori_produk_sub]' selected> - $row[nama_kategori_sub]</option>";
                                        }else{
                                            echo "<option class='level-1' value='subkategori|$row[id_kategori_produk_sub]'> - $row[nama_kategori_sub]</option>";
                                        }
                                    }
                                }
                            }
                        echo "</select>

                        <select class='form-control' name='provinsi' style='background:#fff' id='list_provinsi'>";
                        echo "<option value=0>Provinsi</option>";
                        $provinsi = $this->db->query("SELECT * FROM tb_ro_provinces ORDER BY province_name ASC");
                        foreach ($provinsi->result_array() as $row) {
                            if ($this->input->get('provinsi')==$row['province_id']){
                            echo "<option value='$row[province_id]' selected>$row[province_name]</option>";
                            }else{
                            echo "<option value='$row[province_id]'>$row[province_name]</option>";
                            }
                        }
                        echo "</select>

                        <select class='form-control' name='kota' style='background:#fff' id='list_kotakab'>";
                        echo "<option value=0>Kota / Kabupaten</option>";
                        
                        $kota = $this->db->query("SELECT * FROM tb_ro_cities where province_id='".cetak($this->input->get('provinsi'))."' ORDER BY city_name ASC");
                        foreach ($kota->result_array() as $row) {
                            if ($this->input->get('kota')==$row['city_id']){
                            echo "<option value='$row[city_id]' selected>$row[city_name]</option>";
                            }else{
                            echo "<option value='$row[city_id]'>$row[city_name]</option>";
                            }
                        }
                        echo "</select>

                        <select class='form-control' name='kecamatan' style='background:#fff' id='list_kecamatan'>";
                        echo "<option value=0>Kecamatan</option>";
                        $subdistrict = $this->db->query("SELECT * FROM tb_ro_subdistricts where city_id='".cetak($this->input->get('kota'))."' ORDER BY subdistrict_name ASC");
                        foreach ($subdistrict->result_array() as $row) {
                            if ($this->input->get('kecamatan')==$row['subdistrict_id']){
                            echo "<option value='$row[subdistrict_id]' selected>$row[subdistrict_name]</option>";
                            }else{
                            echo "<option value='$row[subdistrict_id]'>$row[subdistrict_name]</option>";
                            }
                        }
                        echo "</select>";
                        ?><br>

                        <select class='form-control' name='urut' style='background:#fff'>
                        <?php 
                            $data_urut = array('Urutan','Termurah','Termahal');
                            $data_val = array('','asc','desc');
                            for ($i=0; $i < count($data_urut); $i++) { 
                                if ($data_val[$i]==$this->input->get('urut')){
                                echo "<option value='".$data_val[$i]."' selected>".$data_urut[$i]."</option>";
                                }else{
                                echo "<option value='".$data_val[$i]."'>".$data_urut[$i]."</option>";
                                }
                            }
                        ?>
                        </select>
                        <br>
                        <input class="form-control formatNumber" type="text" name='dari' value='<?php echo cetak($this->input->get('dari')); ?>' placeholder="Harga Dari..." autocomplete='off'>
                        <input class="form-control formatNumber" type="text" name='sampai' value='<?php echo cetak($this->input->get('sampai')); ?>' placeholder="Harga Sampai..." autocomplete='off'>
                        
                        <button type='submit' class='ps-btn ps-btn--black ml-3' style='width:100%; position: inherit; margin-top: 25px; color: #fff;'>Tampilkan</button>
                    </form>
                    </div>
                    <?php 
                        if (!isset($_GET['s'])){ 
                    ?>
                    <div class="ps-block--shop-features">
                    <?php echo $this->session->flashdata('message'); 
                        $this->session->unset_userdata('message'); ?>
                        <div class="ps-block__header">
                            <h3>Produk Terlaris</h3>
                            <div class="ps-block__navigation"><a class="ps-carousel__prev" href="#bestsale"><i class="icon-chevron-left"></i></a><a class="ps-carousel__next" href="#bestsale"><i class="icon-chevron-right"></i></a></div>
                        </div>
                        <div class="ps-block__content">
                            <div class="owl-slider" id="bestsale" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="2" data-owl-item-lg="3" data-owl-item-xl="4" data-owl-duration="1000" data-owl-mousedrag="on">
                                <?php 
                                    $produk_terlaris = $this->model_reseller->produk_terlaris(0,0,10);
                                    foreach ($produk_terlaris->result_array() as $row){
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
                            
                                        if ($disk['diskon']>=1){ 
                                            $harga_produk =  "Rp ".rupiah($row['harga_konsumen']-$disk['diskon'])." <del style='display:none'>".rupiah($row['harga_konsumen'])."</del>";
                                        }else{
                                            $harga_produk =  "Rp ".rupiah($row['harga_konsumen']);
                                        }

                                        $sold = $this->model_reseller->produk_terjual($row['id_produk'],2);
                                        $persentase = ($sold->num_rows()/$beli['beli'])*100;
                                        $cek_save = $this->db->query("SELECT * FROM rb_konsumen_simpan where id_konsumen='".$this->session->id_konsumen."' AND id_produk='$row[id_produk]'")->num_rows();
                                        
                                        echo "<div class='ps-product'>
                                                <div class='ps-product__thumbnail'>
                                                <a href='".base_url()."asset/foto_produk/$foto_produk' class='progressive replace'><img class='preview' loading='lazy' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a>
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
                                                <div class='ps-product__container'><a class='ps-product__vendor' href='".base_url()."u/".user_reseller($row['id_reseller'])."'>".cek_paket_icon($row['id_reseller'])." $row[nama_reseller]</a>
                                                    <div class='ps-product__content'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                                                        <div class='ps-product__rating'>
                                                            <select class='ps-rating' data-read-only='true'>".rate_bintang($row['id_produk'])."</select><span>".rate_jumlah($row['id_produk'])."</span>
                                                        </div>
                                                        <p class='ps-product__price'>$harga_produk</p>
                                                    </div>
                                                        <div class='ps-product__content hover'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>";
                                                        // if (stok($row['id_reseller'],$row['id_produk'])<=0){ 
                                                        //     echo "<a style='margin-top:10px; color:#a7a7a7; background-color:#e2e2e2' class='ps-btn ps-btn--fullwidth add-to-cart-empty'>+ Keranjang</a>";
                                                        // }else{
                                                        //     echo "<a style='margin-top:10px; color:#fff' id='$row[id_produk]' class='ps-btn ps-btn--fullwidth add-to-cart'>+ Keranjang</a>";
                                                        // }
                                                        echo "<a style='margin-top:10px' href='".base_url()."produk/detail/$row[produk_seo]' class='ps-btn ps-btn--fullwidth add-to-cart'>Lihat Detail</a>";
                                                        echo "</div>
                                                </div>
                                            </div>";
                                    }
                                ?>

                            </div>
                        </div>
                    </div>
                    <?php 
                    }elseif (cetak($this->input->get('s'))!='' AND cetak($this->input->get('dari'))!=''){ 
                    if ($rekomendasi->num_rows()>=1){
                    ?>
                        <div class="ps-block--shop-features">
                            <div class="ps-block__header">
                                <h3>Rekomendasi Produk</h3>
                                <div class="ps-block__navigation"><a class="ps-carousel__prev" href="#bestsale"><i class="icon-chevron-left"></i></a><a class="ps-carousel__next" href="#bestsale"><i class="icon-chevron-right"></i></a></div>
                            </div>
                            <div class="ps-block__content">
                                <div class="owl-slider" id="bestsale" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="2" data-owl-item-lg="3" data-owl-item-xl="4" data-owl-duration="1000" data-owl-mousedrag="on">
                                    <?php 
                                        foreach ($rekomendasi->result_array() as $row){
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
                                
                                            if ($disk['diskon']>=1){ 
                                                $harga_produk =  "Rp ".rupiah($row['harga_konsumen']-$disk['diskon'])." <del style='display:none'>".rupiah($row['harga_konsumen'])."</del>";
                                            }else{
                                                $harga_produk =  "Rp ".rupiah($row['harga_konsumen']);
                                            }

                                            $sold = $this->model_reseller->produk_terjual($row['id_produk'],2);
                                            $persentase = ($sold->num_rows()/$beli['beli'])*100;
                                            $cek_save = $this->db->query("SELECT * FROM rb_konsumen_simpan where id_konsumen='".$this->session->id_konsumen."' AND id_produk='$row[id_produk]'")->num_rows();
                                            
                                            echo "<div class='ps-product'>
                                                    <div class='ps-product__thumbnail'>
                                                    <a href='".base_url()."asset/foto_produk/$foto_produk' class='progressive replace'><img class='preview' loading='lazy' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a>
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
                                                    <div class='ps-product__container'><a class='ps-product__vendor' href='".base_url()."u/".user_reseller($row['id_reseller'])."'>".cek_paket_icon($row['id_reseller'])." $row[nama_reseller]</a>
                                                        <div class='ps-product__content'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                                                            <div class='ps-product__rating'>
                                                                <select class='ps-rating' data-read-only='true'>".rate_bintang($row['id_produk'])."</select><span>".rate_jumlah($row['id_produk'])."</span>
                                                            </div>
                                                            <p class='ps-product__price'>$harga_produk</p>
                                                        </div>
                                                            <div class='ps-product__content hover'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>";
                                                            // if (stok($row['id_reseller'],$row['id_produk'])<=0){ 
                                                            //     echo "<a style='margin-top:10px; color:#a7a7a7; background-color:#e2e2e2' class='ps-btn ps-btn--fullwidth add-to-cart-empty'>+ Keranjang</a>";
                                                            // }else{
                                                            //     echo "<a style='margin-top:10px; color:#fff' id='$row[id_produk]' class='ps-btn ps-btn--fullwidth add-to-cart'>+ Keranjang</a>";
                                                            // }
                                                            echo "<a style='margin-top:10px' href='".base_url()."produk/detail/$row[produk_seo]' class='ps-btn ps-btn--fullwidth add-to-cart'>Lihat Detail</a>";
                                                            echo "</div>
                                                    </div>
                                                </div>";
                                        }
                                    ?>

                                </div>
                            </div>
                        </div>
                    <?php } } ?>
                    <div class="ps-shopping ps-tab-root">
                        <div class="ps-shopping__header">
                            <p>Terdapat <strong><?php echo $jumlah; ?></strong> Produk</p>
                            <div class="ps-shopping__actions">
                            </div>
                        </div>
                        <div class="ps-tabs">
                            <div class="ps-tab active" id="tab-1">
                                <div class="ps-shopping-product">
                                    <?php 
                                        if ($jumlah=='0'){ 
                                            echo "<center>
                                            <img style='width:250px' src='".base_url()."asset/images/no-product.png'>
                                            <h3><br>Oops, produk gak ditemukan</h3>
                                                  Coba kata kunci lain untuk menemukan produk yang dicari...</center>";
                                        }

                                        if (cetak($_GET['s'])=='group'){
                                            echo "<form class='ps-form--quick-search' action='".base_url()."produk?s=group' method='POST'>
                                                <input style='border-left:1px solid #e1e1e1' class='form-control' name='group' type='text' value='".cetak($this->input->post('group'))."' placeholder='Input Kode Group...' autocomplete='off' required=''>
                                                <button type='submit' name='submit'>Cari</button>
                                            </form>";
                                        }
                                    ?>
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
                                
                                            

                                            $sold = $this->model_reseller->produk_terjual($row['id_produk'],2);
                                            $persentase = ($sold->num_rows()/$beli['beli'])*100;
                                            $cek_save = $this->db->query("SELECT * FROM rb_konsumen_simpan where id_konsumen='".$this->session->id_konsumen."' AND id_produk='$row[id_produk]'")->num_rows();
                                            
                                            if (isset($_POST['submit'])){
                                                $ex = explode('.',$row['group_order']);
                                                $idgroup = $ex['0']."&kode=$row[group_order]";
                                                $beligroup = $ex['1'];
                                                $harga_produk =  "Rp ".rupiah($row['harga_jual']);
                                            }else{
                                                $idgroup = $row['id_group'];
                                                $beligroup = $row['jumlah_group'];
                                                if ($disk['diskon']>=1){ 
                                                    $harga_produk =  "Rp ".rupiah($row['harga_konsumen']-$disk['diskon'])." <del style='display:none'>".rupiah($row['harga_konsumen'])."</del>";
                                                }else{
                                                    $harga_produk =  "Rp ".rupiah($row['harga_konsumen']);
                                                }
                                            }

                                            echo "<div class='col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 '>
                                                    <div class='ps-product'>
                                                        <div class='ps-product__thumbnail'><a href='".base_url()."asset/foto_produk/$foto_produk' class='progressive replace'><img class='preview' loading='lazy' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a>
                                                        $diskon_persen
                                                        $stok";
                                                        if (cetak($_GET['s'])!='group'){
                                                            echo "<ul class='ps-product__actions produk-$row[id_produk]'>
                                                                <li><a href='".base_url()."produk/detail/$row[produk_seo]' data-toggle='tooltip' data-placement='top' title='Read More'><i class='icon-bag2'></i></a></li>
                                                                <li><a href='#' data-toggle='tooltip' data-placement='top' title='Quick View' class='quick_view' data-id='$row[id_produk]'><i class='icon-eye'></i></a></li>";
                                                                if ($cek_save>='1'){
                                                                    echo "<li><a data-toggle='tooltip' data-placement='top' title='Add to Whishlist'><i style='color:red' class='icon-heart'></i></a></li>";
                                                                }else{
                                                                    echo "<li><a data-toggle='tooltip' data-placement='top' id='save-$row[id_produk]' title='Add to Whishlist'><i class='icon-heart' onclick=\"save('$row[id_produk]',this.id)\"></i></a></li>";
                                                                }
                                                            echo "</ul>";
                                                        }
                                                        echo "</div>
                                                        <div class='ps-product__container'><a class='ps-product__vendor' href='".base_url()."u/".user_reseller($row['id_reseller'])."'>".cek_paket_icon($row['id_reseller'])." $row[nama_reseller]</a>
                                                            <div class='ps-product__content'>";
                                                                if (cetak($_GET['s'])=='group'){
                                                                    echo "<a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]?g=$idgroup'>$judul</a>
                                                                            <p class='ps-product__price'>$harga_produk</p>
                                                                            <p class='ps-product__price group-order'><i class='icon-users'></i> <b>Beli Ber-$beligroup</b></p>";
                                                                }else{
                                                                echo "<a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                                                                    <p class='ps-product__price'>$harga_produk</p>";
                                                                }
                                                            echo "</div>
                                                            <div class='ps-product__content hover'>";
                                                            if (cetak($_GET['s'])=='group'){
                                                                echo "<span class='ps-product__title'>$judul</span>
                                                                <p class='ps-product__price'>$harga_produk</p>
                                                                <a href='".base_url()."produk/detail/$row[produk_seo]?g=$idgroup'><p class='ps-product__price group-order'><i class='icon-users'></i> <b style='color:red'>Beli Ber-$beligroup</b></p></a>";
                                                            }else{
                                                                echo "<a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                                                                        <a style='margin-top:10px' href='".base_url()."produk/detail/$row[produk_seo]' class='ps-btn ps-btn--fullwidth add-to-cart'>Lihat Detail</a>";
                                                            }
                                                            echo "</div>
                                                        </div>
                                                    </div>
                                                </div>";
                                        }
                                    ?>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="ps-tab" id="tab-2">
                                <div class="ps-shopping-product">
                                <?php 
                                    foreach ($record->result_array() as $row){
                                        $ex = explode(';', $row['gambar']);
                                        if (trim($ex[0])=='' OR !file_exists("asset/foto_produk/".$ex[0])){ $foto_produk = 'no-image.png'; }else{ if (!file_exists("asset/foto_produk/thumb_".$ex[0])){ $foto_produk = $ex[0]; }else{ $foto_produk = "thumb_".$ex[0]; }}
                                        $judul = $row['nama_produk'];
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
                            
                                        if ($disk['diskon']>=1){ 
                                            $harga_produk =  "Rp ".rupiah($row['harga_konsumen']-$disk['diskon'])." <del style='display:none'>".rupiah($row['harga_konsumen'])."</del>";
                                        }else{
                                            $harga_produk =  "Rp ".rupiah($row['harga_konsumen']);
                                        }

                                        $sold = $this->model_reseller->produk_terjual($row['id_produk'],2);
                                        $persentase = ($sold->num_rows()/$beli['beli'])*100;
                                        $cek_save = $this->db->query("SELECT * FROM rb_konsumen_simpan where id_konsumen='".$this->session->id_konsumen."' AND id_produk='$row[id_produk]'")->num_rows();
                                        
                                        echo "<div class='ps-product ps-product--wide'>
                                            <div class='ps-product__thumbnail'><a href='".base_url()."asset/foto_produk/$foto_produk' class='progressive replace'><img class='preview' loading='lazy' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a>
                                            </div>
                                            <div class='ps-product__container'>
                                                <div class='ps-product__content'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                                                    <p class='ps-product__vendor'>Penjual : <a href='".base_url()."u/".user_reseller($row['id_reseller'])."'>".cek_paket_icon($row['id_reseller'])." $row[nama_reseller]</a></p>
                                                    ".nl2br($row['tentang_produk'])."
                                                </div>
                                                <div class='ps-product__shopping'>
                                                    <p class='ps-product__price'>$harga_produk</p>";
                                                    // if (stok($row['id_reseller'],$row['id_produk'])<=0){ 
                                                    //     echo "<a style='margin-top:10px; color:#a7a7a7; background-color:#e2e2e2' class='ps-btn ps-btn--fullwidth add-to-cart-empty'>+ Keranjang</a>";
                                                    // }else{
                                                    //     echo "<a style='margin-top:10px; color:#fff' id='$row[id_produk]' class='ps-btn ps-btn--fullwidth add-to-cart'>+ Keranjang</a>";
                                                    // }
                                                    echo "<a style='margin-top:10px' href='".base_url()."produk/detail/$row[produk_seo]' class='ps-btn ps-btn--fullwidth add-to-cart'>Lihat Detail</a>";
                                                    echo "<ul class='ps-product__actions'>";
                                                        if ($cek_save>='1'){
                                                            echo "<li><a style='cursor:pointer'><i style='color:red' class='icon-heart'></i> Wishlist</a></li>";
                                                        }else{
                                                            echo "<li><a style='cursor:pointer' id='save-$row[id_produk]' onclick=\"save('$row[id_produk]',this.id)\"><i class='icon-heart'></i> Wishlist</a></li>";
                                                        }
                                                        echo "<li><a href='' class='quick_view' data-id='$row[id_produk]'><i class='icon-eye'></i> Quick</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                ?>

                                </div>
                                
                            </div>
                                <div class="ps-pagination">
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
