
<div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>produk">Produk</a></li>
                <li><?php echo $judul; ?></li>
            </ul>
        </div>
    </div>
    <div class="ps-page--shop" id="shop-sidebar">
        <div class="container">
            <div class="ps-layout--shop">
                <?php include "sidebar-produk.php"; ?>
                <div class="ps-layout__right">
                    <div class="ps-shopping ps-tab-root">
                        <div class="ps-shopping__header">
                            <p>Terdapat <strong><?php echo $record->num_rows(); ?></strong> Produk</p>
                            <div class="ps-shopping__actions">
                                <div class="ps-shopping__view">
                                    <p>View</p>
                                    <ul class="ps-tab-list">
                                        <li class="active"><a href="#tab-1"><i class="icon-grid"></i></a></li>
                                        <li><a href="#tab-2"><i class="icon-list4"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ps-tabs">
                            <?php 
                              if ($this->uri->segment(2)=='kategori'){
                                $cek = $this->model_app->edit('rb_kategori_produk',array('kategori_seo'=>cetak($this->uri->segment(3))))->row_array();
                                $jumlah= $this->model_app->view_where('rb_produk',array('id_kategori_produk'=>$cek['id_kategori_produk']))->num_rows();
                                if ($jumlah <= 0){
                                    echo "<div style='margin:2%'>
                                        <center>
                                        <img style='width:250px' src='".base_url()."asset/images/no-product.png'>
                                        <h3><br>Oops, produk gak Tersedia.</h3>
                                            Yuk, Coba lihat di kategori lain untuk menemukan produk yang dicari...
                                        </center>
                                    </div>";
                                }
                              }

                              if ($this->uri->segment(2)=='subkategori'){
                                $cek = $this->model_app->edit('rb_kategori_produk_sub',array('kategori_seo_sub'=>cetak($this->uri->segment(3))))->row_array();
                                $jumlah= $this->model_app->view_where('rb_produk',array('id_kategori_produk_sub'=>$cek['id_kategori_produk_sub']))->num_rows();
                                if ($jumlah <= 0){
                                    echo "<div style='margin:2%'>
                                        <center>
                                        <img style='width:250px' src='".base_url()."asset/images/no-product.png'>
                                        <h3><br>Oops, produk gak Tersedia.</h3>
                                            Yuk, Coba lihat di kategori lain untuk menemukan produk yang dicari...
                                        </center>
                                    </div>";
                                }
                              }

                              if ($this->uri->segment(2)=='produk'){
                                $jumlah= $this->db->query("SELECT * FROM rb_produk where tag LIKE '%".cetak($this->uri->segment(3))."%'")->num_rows();
                                if ($jumlah <= 0){
                                    echo "<div  style='margin:10%' class='alert alert-info'><center>Maaf, Produk pada Tag ini belum tersedia..!</center></div>";
                                }
                              }
                            ?>

                            <div class="ps-tab active" id="tab-1">
                                <div class="ps-shopping-product">
                                    <div class="row">
                                    <?php 
                                        foreach ($record->result_array() as $row){
                                            $ex = explode(';', $row['gambar']);
                                            if (trim($ex[0])=='' OR !file_exists("asset/foto_produk/".$ex[0])){ $foto_produk = 'no-image.png'; }else{ $foto_produk = $ex[0]; }
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
                                            if (cek_paket_bintang($row['id_reseller'])=='1'){ 
                                                $bintang = "<i class='fa fa-star text-yellow'></i>"; 
                                            }elseif (cek_paket_bintang($row['id_reseller'])=='2'){ 
                                                $bintang = "<i class='fa fa-star text-blue'></i>"; 
                                            }elseif (cek_paket_bintang($row['id_reseller'])=='3'){ 
                                                $bintang = "<i class='fa fa-star text-green'></i>"; 
                                            }else{ 
                                                $bintang = "<i class='fa fa-star-o'></i>"; 
                                            }
                                            echo "<div class='col-xl-3 col-lg-4 col-md-4 col-sm-$kolom col-$kolom '>
                                                    <div class='ps-product'>
                                                        <div class='ps-product__thumbnail'><a href='".base_url()."asset/foto_produk/$foto_produk' class='progressive replace'><img class='preview' loading='lazy' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a>
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
                                                        <div class='ps-product__container'><a class='ps-product__vendor' href='".base_url()."u/".user_reseller($row['id_reseller'])."'>$bintang $row[nama_reseller]</a>
                                                            <div class='ps-product__content'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                                                                <p class='ps-product__price'>$harga_produk</p>
                                                            </div>
                                                            <div class='ps-product__content hover'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                                                                <p class='ps-product__price'>$harga_produk</p>
                                                            </div>
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
                                        if (trim($ex[0])==''){ $foto_produk = 'no-image.png'; }else{ $foto_produk = $ex[0]; }
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
                            
                                        if ($diskon>=1){ 
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
                                                    <p class='ps-product__vendor'>Penjual : <a href='".base_url()."u/".user_reseller($row['id_reseller'])."'>$row[nama_reseller]</a></p>
                                                    ".nl2br($row['tentang_produk'])."
                                                </div>
                                                <div class='ps-product__shopping'>
                                                    <p class='ps-product__price'>$harga_produk</p>
                                                    <form action='".base_url()."produk/keranjang/$row[id_reseller]/$row[id_produk]' method='POST'>
                                                        <input style='font-size:20px' class='form-control' type='hidden' value='1' name='qty'>
                                                        <button type='submit' name='beli' class='ps-btn'>Beli Sekarang</button>
                                                    </form>
                                                    <ul class='ps-product__actions'>";
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