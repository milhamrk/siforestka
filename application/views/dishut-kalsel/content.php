<?php
$nu = 0;
$slider = $this->model_app->view_ordering_limit('slide','id_slide','DESC',0,4);
foreach ($slider->result_array() as $row) { 
    if(isJson($row['keterangan'])){
        $rows_slider = json_decode($row['keterangan']);
    }else{$rows_slider = '';}
    $url = str_replace("watch?v=", "embed/", $rows_slider->video);
?>

<div id="myModal<?= $nu ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
            </div>

            <div class="modal-body">
                    <iframe width="560" height="315" src="<?= $url ?>?rel=0&amp;controls=0" "frameborder="0" allowfullscreen autoplay></iframe>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<?php $nu++; } ?>
<div id="homepage-1" style="background:#000;">
    

    <div class="ps-home-banner ps-home-banner--1">
        <div class="ps-container" style='padding:0 0px'>
            
            <div class="ps-section">
                <!-- / photos from stocksnap.io -->
                <div class='owl-carousel' id='owlCarousel'>
                <?php 
                $na = 0;
                $slider = $this->model_app->view_ordering_limit('slide','id_slide','DESC',0,4);
                foreach ($slider->result_array() as $row) { 
                    if(isJson($row['keterangan'])){
                        $rows_slider = json_decode($row['keterangan']);
                    }else{$rows_slider = '';}
                    ?>
                    <div class='slide'>
                        <img class='owl-item-bg' src='<?= base_url()."asset/foto_slide/$row[gambar]" ?>'>
                        <div class='slide-content'>
                            <div class='overlay'></div>
                            <h3><?= $rows_slider->judul ?></h3>
                            <h2><?= $rows_slider->subjudul ?></h2>
                            <div class="border-slide"> </div>
                            <p><?= $rows_slider->deskrip ?></p>
                            <div class="sticky-play">
                                <a data-toggle="modal" data-target="#myModal<?= $na ?>"><img src="<?= base_url() ?>asset/images/play.svg" alt="" /></a>
                            </div>
                        </div>
                    </div>
                <?php $na++; } ?>
                </div>
            </div>
        </div>
    </div>

    

<!-- iklan tengah -->
 
    <!-- <div class="ps-home-ads " style='background:#000;background-image:url("<?php echo base_url()."asset/images/layanan.png"; ?>");background-repeat: no-repeat;background-size: 100% 100%;'> -->
    <div class="ps-home-ads " style='background:#000;padding-top:50px;'>
        <div class="container">
            <div class="row justify-content-center" style="position:relative;">
                <div class="col-md-12 boxed-white-before-1"></div>
                <div class="col-md-12 boxed-white-before-2"></div>
                <div class="col-md-12 boxed-white-before-3"></div>
                <div class="col-md-12 boxed-white">
                    <div class="row justify-content-center">
                    <div class="col-md-12 boxed-head">
                        <h3 class="boxed-title">Layanan</h3>
                        <div class="boxed-border"></div>
                    </div>
                    <?php
                    $iklantengah = $this->db->query("SELECT * FROM iklantengah where judul like 'home%' order by id_iklantengah asc");
                    foreach ($iklantengah->result_array() as $b) {
                        $string = $b['gambar'];
                        $title = str_replace("home ","",$b['judul']);
                        if ($b['gambar'] != ''){
                            if(preg_match("/swf\z/i", $string)) {
                                echo "<div class='col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4'><embed loading='lazy' class='ps-collection preview' src='".base_url()."asset/foto_iklantengah/$b[gambar]' quality='high' type='application/x-shockwave-flash'><p class='text-center'>$title</p></div>";
                            } else {
                                echo "<div class='col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4'><a loading='lazy' class='ps-collection preview' href='$b[url]' target='_blank'><img class='preview' loading='lazy' src='".base_url()."asset/foto_iklantengah/$b[gambar]' alt='$b[judul]' /></a><p class='text-center'>$title</p></div>";
                            }
                        }
                    }
                    ?>
                    </div>
                </div>
            </div>
            <!-- < ?php if ($maps!=''){
            echo "<div class='ps-block--site-features' style='margin-top:10px; background-color:#fff; border: none; padding: 10px 0px;'>";
            if ($this->uri->segment(1)=='' OR $this->uri->segment(1)=='main'){
                echo "<form class='col-md-12' style='padding-right:0px; padding-left:0px' method='POST' action='".base_url()."main/proses'>
                <div class='form-row'>
                <div style='margin-bottom:0px' class='col-md-4 form-group'>
                <input type='number' name='tujuan' class='form-control' placeholder='Masukkan Nomor Handphone,..' required>
                </div>
                
                <div style='margin-bottom:0px' class='col-md-3 form-group'>
                <select name='operator' class='form-control' id='operatorx' required>
                <option value=''>- Pilih Operator -</option>";
                foreach($operator->data as $item){
                    if ($item->pembeliankategori_id=='1'){
                    if ($item->status=='0'){ $status = 'disabled'; }else{ $status = ''; }
                    echo "<option value='".$item->id."' $status>".$item->product_name."</option>";
                    }
                }
                echo "</select>
                </div>
                
                <div style='margin-bottom:0px' class='col-md-3 form-group'>
                <select name='produk' class='form-control' id='produkx' required>
                    <option value=''>- Pilih Produk -</option>
                </select>
                </div>
                
                <div style='margin-bottom:0px' class='col-md-2 form-group'>
                    <button type='submit' name='submit' class='btnppob btn-pulsa'>Beli Pulsa</button>
                    <div class='dropdown'>
                    <span class='btnppob' style='border-left:1px solid #fff'>
                        <i class='fa fa-caret-down'></i>
                    </span>
                    <div class='dropdown-content'>";
                        $data_ppob = array('Token Listrik','Paket Data','Voucher Game','E-Money');
                        $data_ppob_id = array('token','data','game','emoney');
                        for ($i=0; $i < count($data_ppob) ; $i++) { 
                            echo "<a href='".base_url().'members/trx_pulsa?ppob='.$data_ppob_id[$i]."'>".$data_ppob[$i]."</a>";
                        }
                    echo "</div>
                    </div>
                </div>
                </form>
                </div>
                <div style='clear:both'></div>";
            }
            echo "</div>"; 
        } ?>-->
        </div>
    </div>

    <?php 
        // Aktifkan Flash Deal Tiap Hari
        $idn = $this->db->query("SELECT flash_deal FROM identitas where id_identitas='1'")->row_array();
        $kini = new DateTime('now');  
        $besok = date('Y-m-d', strtotime('+1 days'));
        $kemarin = new DateTime($besok.' 00:00:00');
        $tanggal = $kemarin->diff($kini)->format('%a:%h:%i:%s'); 
        $date1 = date('Y-m-d');
        $date2 = $besok;
        if(selisih_waktu_run($date1,$date2)>='1'){

        // $idn = $this->db->query("SELECT flash_deal FROM identitas where id_identitas='1'")->row_array();
        // $kini = new DateTime('now');  
        // $kemarin = new DateTime($idn['flash_deal'].' 00:00:00');
        // $tanggal = $kemarin->diff($kini)->format('%a:%h:%i:%s'); 

        // $date1 = date('Y-m-d');
        // $date2 = $idn['flash_deal'];
        // if(selisih_waktu_run($date1,$date2)>='1'){
    ?>
   
    <?php }else{ echo "<span style='display:none' id='berakhir'></span>"; } ?>
    
    <!--
	<div class="ps-home-ads " style='background:#fff'>
        <div class="ps-container">
            <h3>Kategori Terpopuler</h3>
            <div class="row">
                < ?php 
                    $top_kategori = $this->db->query("SELECT * FROM (SELECT a.*, b.jumlah FROM
                                        (SELECT * FROM rb_kategori_produk) as a LEFT JOIN
                                        (SELECT z.id_kategori_produk, COUNT(*) jumlah FROM rb_penjualan_detail y JOIN rb_produk z ON y.id_produk=z.id_produk GROUP BY z.id_kategori_produk HAVING COUNT(z.id_kategori_produk)) as b on a.id_kategori_produk=b.id_kategori_produk) as x ORDER BY x.jumlah DESC LIMIT 6");
                    foreach($top_kategori->result_array() as $row){
                        echo "<div class='col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 '>
                                <div class='ps-block--category'><a class='ps-block__overlay' href='".base_url()."produk/kategori/$row[kategori_seo]'></a>";
                                    if ($row['gambar'] == ''){
                                        echo "<img class='preview' loading='lazy' style='width:210px;' src='".base_url()."asset/foto_produk/no-image.jpg' alt='no-image.jpg' />";
                                    }else{
                                        echo "<img class='preview' loading='lazy' style='width:210px;' src='".base_url()."asset/foto_produk/$row[gambar]' alt='$row[gambar]' />";
                                    }
                                    echo "
                                </div>
                              </div>";
                    }
                ?>
            </div>
		</div>
	</div>
	-->
    <div class="ps-product-list ps-clothings specialized">
        <div class="ps-container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Produk</h4>
                    <span class="border-center"></span>
                    <div class="berita-section">
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
                    </div>
                </div>
            </div>
            <div class="row footer-row">
                <div class="col-md-12">
                    <div class="mt-30"></div>
                    <hr>
                    <a href="<?= base_url() ?>produk">Lihat Semua Produk</a>
                </div>
            </div>
        </div>
    </div>

    <div class="ps-product-list ps-clothings specialized">
        <div class="ps-container">
            <div class="row">
                <div class="col-md-8">
                    <h4>Opini Terbaru</h4>
                    <span class="border-center"></span>
                    <div class="berita-section">
                        <div class="sample">
                            <div class="row">
                            <?php 
                            $no = 0;
                            foreach ($opini->result_array() as $r) {	
                                $no++;
                                $baca = $r['dibaca']+1;	
                                $isi_berita =(strip_tags($r['isi_berita'])); 
                                $isi = substr($isi_berita,0,220); 
                                $isi = substr($isi_berita,0,strrpos($isi," ")); 
                                $judul = $r['judul']; 
                                $total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r['id_berita']))->num_rows();
                                $width = 33.33;
                                if($no==1) $width = 60;
                                else if($no==2) $width = 40;

                                    echo '<div class="card-2 card-mean" style="width:'.$width.'%;">
                                    <div class="wrapper" style="background: url(';

                                    if ($r['gambar'] == ''){
                                        echo base_url()."asset/foto_berita/no-image.jpg";
                                    }else{
                                        echo base_url()."asset/foto_berita/$r[gambar]";
                                    }
                                    
                                    // '".base_url()."berita/detail/$r[judul_seo]
                                    
                                    echo ') center / cover no-repeat;">
                                        <div class="data">
                                            <div class="content">
                                            <!-- <span class="author">Jane Doe</span> -->
                                            <h1 class="title"><a href="'.base_url().'berita/detail/'.$r[judul_seo].'">'.substr_replace($judul, "..", 40).'</a></h1>
                                            <p class="text" ';

                                            if($no!= 1 && $no!=2){
                                                echo 'style="height:100px;"';
                                            }
                                            
                                            echo '>'.substr_replace($isi, "..", 90).'</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="#">'.tgl_indo($r['tanggal']).'</a>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <a href="#">'.$r[nama_lengkap].'</a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                }
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Berita Lainnya</h4>
                            <span class="border-center-right"></span>
                            <?php 
                            $no = 0;
                            foreach ($berita_sisi->result_array() as $r) {	
                                $no++;
                                $judul = $r['judul']; 
                                echo '
                            <div class="home-news">
                                <h4><a href="'.base_url().'berita/detail/'.$r[judul_seo].'">'.$judul.'</a></h4>
                                <p>'.tgl_indo($r['tanggal']).' Oleh '.$r[nama_lengkap].'</p>
                            </div>'; }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-40"></div>
    </div>

    <div style='clear:both'></div>

    <div class="ps-product-list ps-clothings specialized">
        <div class="ps-container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Berita Terbaru</h4>
                    <span class="border-center"></span>
                    <div class="berita-section">
                        <div class="sample">
                            <div class="row">
                            <?php 
                            $no = 0;
                            foreach ($berita->result_array() as $r) {	
                                $no++;
                                $baca = $r['dibaca']+1;	
                                $isi_berita =(strip_tags($r['isi_berita'])); 
                                $isi = substr($isi_berita,0,220); 
                                $isi = substr($isi_berita,0,strrpos($isi," ")); 
                                $judul = $r['judul']; 
                                $total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r['id_berita']))->num_rows();
                                $width = 25;
                                if($no==1) $width = 50;
                                // else if($no==2) $width = 40;
                                // else if($no==2) $width = 40;

                                    echo '<div class="card-2 card-mean" style="width:'.$width.'%;">
                                    <div class="wrapper" style="background: url(';

                                    if ($r['gambar'] == ''){
                                        echo base_url()."asset/foto_berita/no-image.jpg";
                                    }else{
                                        echo base_url()."asset/foto_berita/$r[gambar]";
                                    }
                                    
                                    // '".base_url()."berita/detail/$r[judul_seo]
                                    
                                    echo ') center / cover no-repeat;">
                                        <div class="data">
                                            <div class="content">
                                            <!-- <span class="author">Jane Doe</span> -->
                                            <h1 class="title"><a href="'.base_url().'berita/detail/'.$r[judul_seo].'">'.substr_replace($judul, "..", 40).'</a></h1>
                                            <p class="text" ';

                                            if($no!= 1 && $no!=2){
                                                echo 'style="height:100px;"';
                                            }
                                            
                                            echo '>'.substr_replace($isi, "..", 90).'</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="#">'.tgl_indo($r['tanggal']).'</a>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <a href="#">'.$r[nama_lengkap].'</a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                }
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row footer-row">
                <div class="col-md-12">
                    <hr>
                    <a href="<?= base_url() ?>berita">Lihat Semua Berita</a>
                </div>
            </div>
        </div>
        <div class="mt-100"></div>
        <div class="styled-box" style="position:relative;z-index:1;">
            <div class="box-before-1"></div>
            <div class="box-before-2"></div>
        </div>
        <div class="ps-container" style="position:relative;z-index:2;">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrap-center">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="pills-aksi-tab" data-toggle="pill" href="#pills-aksi" role="tab" aria-controls="pills-aksi" aria-selected="true">Aksi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-sosialisasi-tab" data-toggle="pill" href="#pills-sosialisasi" role="tab" aria-controls="pills-sosialisasi" aria-selected="false">Sosialisasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-edukasi-tab" data-toggle="pill" href="#pills-edukasi" role="tab" aria-controls="pills-edukasi" aria-selected="false">Edukasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-persuasif-tab" data-toggle="pill" href="#pills-persuasif" role="tab" aria-controls="pills-persuasif" aria-selected="false">Persuasif</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-aksi" role="tabpanel" aria-labelledby="pills-aksi-tab">
                            </div>
                            <div class="tab-pane fade" id="pills-sosialisasi" role="tabpanel" aria-labelledby="pills-sosialisasi-tab"></div>
                            <div class="tab-pane fade" id="pills-edukasi" role="tabpanel" aria-labelledby="pills-edukasi-tab"></div>
                            <div class="tab-pane fade" id="pills-persuasif" role="tabpanel" aria-labelledby="pills-persuasif-tab"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-30">
                <div class="col-md-6">
                    <div class="ps-blog__left">
                    <?php 
                        function rand_color() {
                            return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                        }

                        foreach ($aksi->result_array() as $r) {	
                            $judul = $r['judul']; 
                            $total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r['id_berita']))->num_rows();
                            
                            echo "<div class='ps-post ps-post--small-thumbnail'>
                                <div class='ps-post__thumbnail' style='max-width:230px;'><a class='ps-post__overlay' href='".base_url()."berita/detail/$r[judul_seo]'></a>";
                                    if ($r['gambar'] == ''){
                                        echo "<img style='border-radius:8px;' src='".base_url()."asset/foto_berita/no-image.jpg' alt='no-image.jpg' /></a>";
                                    }else{
                                        echo "<img style='border-radius:8px;' src='".base_url()."asset/foto_berita/$r[gambar]' alt='$r[gambar]' /></a>";
                                    }
                                echo "</div>
                                <div class='ps-post__content' style='text-align:left;'>
                                    <div class='ps-post__top'>
                                        <div class='ps-post__meta'>";
                                        $tags = (explode(",",$r['tag']));
                                        $hitung = count($tags);
                                        for ($x=0; $x<=$hitung-1; $x++) {
                                            if ($tags[$x] != ''){
                                                $final_tags = str_replace("-"," ",$tags[$x]);
                                                echo "<a style='text-transform:capitalize;color:".rand_color()."' href='".base_url()."tag/detail/$tags[$x]'>$final_tags</a>";
                                            }
                                            break;
                                        }
                                        echo "</div><a class='ps-post__title' href='".base_url()."berita/detail/$r[judul_seo]'>$judul</a>
                                    </div>
                                    <div class=''>
                                        <p>".tgl_indo($r['tanggal'])." oleh <a href='#'> $r[nama_lengkap]</a></p>
                                    </div>
                                </div>
                            </div>";
                        }
                    ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ps-blog__left">
                        <?php 

                            foreach ($aksi_dua->result_array() as $r) {	
                                $judul = $r['judul']; 
                                $total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r['id_berita']))->num_rows();
                                
                                echo "<div class='ps-post ps-post--small-thumbnail'>
                                    <div class='ps-post__thumbnail' style='max-width:230px;'><a class='ps-post__overlay' href='".base_url()."berita/detail/$r[judul_seo]'></a>";
                                        if ($r['gambar'] == ''){
                                            echo "<img style='border-radius:8px;' src='".base_url()."asset/foto_berita/no-image.jpg' alt='no-image.jpg' /></a>";
                                        }else{
                                            echo "<img style='border-radius:8px;' src='".base_url()."asset/foto_berita/$r[gambar]' alt='$r[gambar]' /></a>";
                                        }
                                    echo "</div>
                                    <div class='ps-post__content' style='text-align:left;'>
                                        <div class='ps-post__top'>
                                            <div class='ps-post__meta'>";
                                            $tags = (explode(",",$r['tag']));
                                            $hitung = count($tags);
                                            for ($x=0; $x<=$hitung-1; $x++) {
                                                if ($tags[$x] != ''){
                                                    $final_tags = str_replace("-"," ",$tags[$x]);
                                                    echo "<a style='text-transform:capitalize;color:".rand_color()."' href='".base_url()."tag/detail/$tags[$x]'>$final_tags</a>";
                                                }
                                                break;
                                            }
                                            echo "</div><a class='ps-post__title' href='".base_url()."berita/detail/$r[judul_seo]'>$judul</a>
                                        </div>
                                        <div class=''>
                                            <p>".tgl_indo($r['tanggal'])." oleh <a href='#'> $r[nama_lengkap]</a></p>
                                        </div>
                                    </div>
                                </div>";
                            }
                        ?>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div style='clear:both'></div>
    
    <?php if (config('apps_aktif')=='Y'){ ?>
    <div class="ps-download-app" style='margin:30px 0px;'>
        <div class="container">
            <div class="ps-block--download-app" style='border:1px solid #e8e8e8'>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block__thumbnail"><a href='<?php echo base_url(); ?>asset/images/<?= config('apps_image'); ?>' class='progressive replace'><img class='preview' loading='lazy' src="<?php echo base_url(); ?>asset/images/<?= config('apps_image'); ?>" alt=""></a></div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block__content">
                            <h3><?= config('apps_title'); ?></h3>
                            <p><?= config('apps_deskripsi'); ?></p>
                            <form class="ps-form--download-app" action="<?php echo base_url() ?>main/subscribe" method="post">
                                <div class="form-group--nest">
                                    <input class="form-control" type="email" name='email' placeholder="Email Address" autocomplete='off' required>
                                    <button type='submit' name='submit' class="ps-btn">Subscribe</button>
                                </div>
                            </form>
                            <p class="download-link"><a href="<?= config('apps_google_play'); ?>"><img class='preview' loading='lazy' src="<?php echo base_url(); ?>asset/images/google-play.png" alt="google-play.png"></a><a href="<?= config('apps_app_store'); ?>"><img class='preview' loading='lazy' src="<?php echo base_url(); ?>asset/images/app-store.png" alt="app-store.png"></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
<!--
    <div class="ps-site-features d-none d-sm-block">
        <div class="ps-container">
            <div class="ps-block--site-features ps-block--site-features-2">
            <?php 
                $banner = $this->model_app->view_where_ordering_limit('banner',array('posisi'=>'top'),'id_banner','DESC',0,4);
                foreach ($banner->result_array() as $row) {
                    echo "<div class='ps-block__item'>
                            <div class='ps-block__left'><i class='$row[icon]'></i></div>
                            <div class='ps-block__right'>
                            <a href='$row[url]'>
                                <h4>$row[judul]</h4>
                                <p>$row[keterangan]</p>
                            </a>
                            </div>
                          </div>";
                }
            ?>
            </div>
        </div>
    </div>
-->

    
</div>