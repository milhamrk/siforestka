
<?php
$rows = $this->db->query("SELECT a.*, b.nama_kota, c.nama_provinsi FROM `rb_reseller` a JOIN rb_kota b ON a.kota_id=b.kota_id
                            JOIN rb_provinsi c ON b.provinsi_id=c.provinsi_id where a.id_reseller='$record[id_reseller]'")->row_array();
$kat = $this->model_app->view_where('rb_kategori_produk',array('id_kategori_produk'=>$record['id_kategori_produk']))->row_array();
$jual = $this->model_reseller->jual_reseller($record['id_reseller'],$record['id_produk'])->row_array();
$beli = $this->model_reseller->beli_reseller($record['id_reseller'],$record['id_produk'])->row_array();
$disk = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='$record[id_produk]'")->row_array();
$diskon = rupiah(($disk['diskon']/$record['harga_reseller'])*100,0)."%";
if ($disk['diskon']>0){ $diskon_persen = "<div class='top-right'>$diskon</div>"; }else{ $diskon_persen = ''; }
if ($disk['diskon']>=1){ 
  $harga_konsumen =  "Rp ".rupiah($record['harga_reseller']-$disk['diskon']);
  $harga_asli = "Rp ".rupiah($record['harga_reseller']);
}else{
  $harga_konsumen =  "Rp ".rupiah($record['harga_reseller']);
  $harga_asli = "";
}
?>
<div class="ps-breadcrumb">
<div class="ps-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo base_url().'produk/kategori/'.$kat['kategori_seo']; ?>"><?php echo $kat['nama_kategori']; ?></a></li>
        <li><?php echo $record['nama_produk']; ?></li>
    </ul>
</div>
</div>
<div class="ps-page--product">
<div class="ps-container">
    <div class="ps-page__container">
        <div class="ps-page__left">
            <div class="ps-product--detail ps-product--fullwidth">
            <?php 
                echo "<form action='".base_url()."members/tambah_pembelian/$record[id_produk]' method='POST'>";
            ?>
                <div class="ps-product__header">
                    <div class="ps-product__thumbnail" data-vertical="true">
                        <figure>
                            <div class="ps-wrapper">
                                <div class="ps-product__gallery" data-arrow="true">
                                    <?php
                                        if ($record['gambar'] != ''){ 
                                            $ex = explode(';',$record['gambar']);
                                            $hitungex = count($ex);
                                            for($i=0; $i<$hitungex; $i++){
                                                if (file_exists("asset/foto_produk/".$ex[$i])) { 
                                                    echo "<div class='item'><a href='".base_url()."asset/foto_produk/".$ex[$i]."'><img src='".base_url()."asset/foto_produk/".$ex[$i]."'></a></div>";
                                                }
                                            }
                                        }else{
                                            echo "<i style='color:red'>Gambar / Foto untuk Produk ini tidak tersedia!</i>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </figure>
                        <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
                            <?php
                                if ($record['gambar'] != ''){ 
                                    $ex = explode(';',$record['gambar']);
                                    $hitungex = count($ex);
                                    for($i=0; $i<$hitungex; $i++){
                                        if (file_exists("asset/foto_produk/".$ex[$i])) { 
                                            echo "<div class='item'><img src='".base_url()."asset/foto_produk/".$ex[$i]."'></div>";
                                        }
                                    }
                                }else{
                                    echo "<i style='color:red'>Gambar / Foto untuk Produk ini tidak tersedia!</i>";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="ps-product__info">
                        <h1><?php echo $record['nama_produk']; ?></h1>
                        <div class="ps-product__meta">
                            <p>Berat : <a href="#"><?php echo "$record[berat] Gram" ?></a></p>
                            <div class="ps-product__rating">
                                <select class="ps-rating" data-read-only="true">
                                    <?php 
                                        echo rate_bintang($record['id_produk']);
                                    ?>
                                </select>
                                <span>(<?php echo rate_jumlah($record['id_produk']); ?> Ulasan)</span>
                            </div>
                        </div>
                        <h4 class="ps-product__price"><?php echo "$harga_konsumen <del style='color:#8a8a8a'>$harga_asli</del>"; ?></h4>
                        <div class="ps-product__desc">
                            <?php 
                                $variasi = $this->db->query("SELECT * FROM rb_produk_variasi where id_produk='$record[id_produk]' ORDER BY id_variasi ASC");
                                if ($variasi->num_rows()>0){ echo "<p>";
                                    foreach ($variasi->result_array() as $va) {
                                        echo "<b>$va[nama]</b> : ".str_replace(';',', ',$va['variasi'])." <br>";
                                    }
                                    echo "</p>";
                                }
                                echo nl2br($record['tentang_produk']); 
                            ?>
                        </div>
                        <!--<div class="ps-product__variations">
                            <figure>
                                <figcaption>Color</figcaption>
                                <div class="ps-variant ps-variant--color color--1"><span class="ps-variant__tooltip">Black</span></div>
                                <div class="ps-variant ps-variant--color color--2"><span class="ps-variant__tooltip"> Gray</span></div>
                            </figure>
                        </div>-->

                        <div class="ps-product__shopping d-none d-sm-block">
                            <?php 
                                echo $this->session->flashdata('message'); 
                                $this->session->unset_userdata('message');
                            ?>
                            <figure class='d-inline'>
                                <figcaption>Quantity</figcaption>
                                <div class="form-group--number">
                                    <!--<button class="up"><i class="fa fa-plus"></i></button>
                                    <button class="down"><i class="fa fa-minus"></i></button>-->
                                    <input style='font-size:20px' class="form-control" type="number" value='1' name='qty'>
                                </div>
                            </figure>

                            <button type='submit' name='submit' class="ps-btn ps-btn--black ml-3" href="#">Masukkan Keranjang</button>
                        </div>
                        <?php $idn = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array(); ?>
                        <div class="ps-product__specification"><a class="report" target='_BLANK' href="<?php echo "https://api.whatsapp.com/send?phone=".format_telpon($idn['no_telp'])."&amp;text=Hallo%20kak!,%20Saya%20Mau%20Melaporkan%20Produk%20ini%20:%20$record[nama_produk]..."; ?>">Laporkan Penyalahgunaan</a>
                            <!--<p><strong>SKU:</strong> SF1133569600-1</p>-->
                            <p class="categories"><strong> Categories : </strong><a href="<?php echo base_url().'produk/kategori/'.$kat['kategori_seo']; ?>"><?php echo $kat['nama_kategori']; ?></a></p>
                            <?php if (trim($record['tag'])!=''){ echo "<p class='tags'><strong> Tags : </strong> $record[tag]</p>"; } ?>
                        </div>
                    </div>
                </div>
            </form>

                <div class="ps-product__content ps-tab-root">
                    <ul class="ps-tab-list">
                        <li class="active"><a href="#tab-1">Deskripsi</a></li>
                        <li><a href="#tab-5">Tanya Jawab</a></li>
                    </ul>
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="tab-1">
                            <div class="ps-document">
                            <?php echo $record['keterangan']; ?>
                            </div>
                        </div>
                        <div class="ps-tab" id="tab-5">
                            <div class="ps-block--questions-answers">
                                <div id="fb-root"></div>
                                <?php 
                                    echo "<div class='fb-comments' data-href='".base_url()."produk/detail/$record[produk_seo]' data-width='100%' data-numposts='5' data-colorscheme='light'></div> ";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-page__right">
            <aside class="widget widget_product widget_features">
                <?php 
                    $banner = $this->model_app->view_where_ordering('banner',array('posisi'=>'produk'),'id_banner','DESC');
                    foreach ($banner as $row) {
                        echo "<p><i class='$row[icon]'></i> $row[keterangan]</p>";
                    }
                ?>
            </aside>
            <aside class="widget widget_sell-on-site">
                <p><i class="icon-store"></i> Mau Jualan?<a href="<?php echo base_url(); ?>auth/register"> Daftar Sekarang!</a></p>
            </aside>
            <aside class="widget widget_ads">
                <?php
                $pasangiklan2 = $this->model_utama->view_ordering_limit('pasangiklan','id_pasangiklan','ASC',0,2);
                foreach ($pasangiklan2->result_array() as $b) {
                    $string = $b['gambar'];
                    if ($b['gambar'] != ''){
                        if(preg_match("/swf\z/i", $string)) {
                            echo "<embed style='margin-bottom:10px' src='".base_url()."asset/foto_pasangiklan/$b[gambar]' quality='high' type='application/x-shockwave-flash'>";
                        } else {
                            echo "<a href='$b[url]' target='_blank'><img style='margin-bottom:10px' src='".base_url()."asset/foto_pasangiklan/$b[gambar]' alt='$b[judul]' /></a>";
                        }
                    }
                }
                ?>
            </aside>
        </div>
    </div>

</div>
</div>

<script>
    var $star_rating = $('.star-rating .fa');
    var SetRatingStar = function() {
    return $star_rating.each(function() {
        if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
        return $(this).removeClass('fa-star-o').addClass('fa-star');
        } else {
        return $(this).removeClass('fa-star').addClass('fa-star-o');
        }
    });
    };

    $star_rating.on('click', function() {
    $star_rating.siblings('input.rating-value').val($(this).data('rating'));
    return SetRatingStar();
    });

    SetRatingStar();
    $(document).ready(function() {
    });

    $(".selected").click(function() {
            var selected = $(this).hasClass("highlight");
            $(".selected").removeClass("highlight");
            if(!selected){
            $(this).addClass("highlight");
            }
        
    });
</script>