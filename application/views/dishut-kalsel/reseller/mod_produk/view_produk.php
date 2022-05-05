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
        <div class="ps-shopping-product">
        <a class='ps-btn margin-btn' href='<?php echo base_url(); ?>members/tambah_produk'>Tambahkan Produk</a>
        <div style='clear:both'><br></div>
        <div class="row">
        
        <?php 
          $no = 1;
          if ($record_cek->num_rows()<='0'){
            echo "<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 '>
                    <div style='padding:10%; text-align:center'><span class='text-danger'>Maaf, anda belum memiliki produk untuk dijual,...</span><br>
                            <a href='".base_url()."members/tambah_produk'>Klik Disini Untuk mulai Posting Produk!</a></div></div>";
          }
          foreach ($record as $row){
            $ex = explode(';', $row['gambar']);
            if (trim($ex[0])=='' OR !file_exists("asset/foto_produk/".$ex[0])){ $foto_produk = 'no-image.png'; }else{ if (!file_exists("asset/foto_produk/thumb_".$ex[0])){ $foto_produk = $ex[0]; }else{ $foto_produk = "thumb_".$ex[0]; }}
            if (strlen($row['nama_produk']) > 38){ $judul = substr($row['nama_produk'],0,38).',..';  }else{ $judul = $row['nama_produk']; }

            $jual = $this->model_reseller->jual_reseller(reseller($this->session->id_konsumen),$row['id_produk'])->row_array();
            $beli = $this->model_reseller->beli_reseller(reseller($this->session->id_konsumen),$row['id_produk'])->row_array();
            $disk = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$row['id_produk'],'id_reseller'=>reseller($this->session->id_konsumen)))->row_array();
            
            if ($disk['diskon']=='' OR $disk['diskon']=='0'){ $diskon = '0'; $line = ''; $harga = ''; }else{ $diskon = $disk['diskon']; $line = 'line-through'; $harga = "/ <span style='color:red'>".rupiah($row['harga_konsumen']-$disk['diskon'])."</span>";}
            if ($row['id_produk_perusahaan']!='0'){ $perusahaan = "<small><i style='color:green'>(Perusahaan)</i></small>"; }else{ $perusahaan = ''; }
            if ($row['id_produk_perusahaan']=='0'){ $modal = $row['harga_beli'];  }else{ $modal = $row['harga_reseller']; }
            if ($row['aktif']=='Y'){ $aktif = 'Ya'; }else{ $aktif = 'Tidak'; }
            $diskonn = rupiah(($disk['diskon']/$row['harga_konsumen'])*100,0)."%";

            if ($disk['diskon']>=1){ 
              $harga_produk =  "<span class='ps-product__price sale'>Rp ".rupiah($row['harga_konsumen']-$disk['diskon'])." </span><br><i style='font-size:11px'>Diskon $diskonn (".rupiah($disk['diskon']).")</i>";
            }else{
              $harga_produk =  "Rp ".rupiah($row['harga_konsumen']);
            }

            if ($row['aktif']=='N'){
              $status_publish = "<small style='display:block; text-align:center'><i style='color:red'>Menunggu Persetujuan!</i></small>";
              $opacity = '0.2';
            }else{
              $status_publish = "";
              $opacity = '1';
            }

            
            echo "<div class='col-xl-2 col-lg-3 col-md-3 col-sm-6 col-6 '>
            <div class='ps-product'>
                $status_publish
                <div class='ps-product__thumbnail'><a href='".base_url()."produk/detail/$row[produk_seo]'><img style='opacity:$opacity' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a>
                $diskon_persen
                <div class='ps-product__badge'>".($beli['beli']-$jual['jual'])." $row[satuan]</div>
                <ul class='ps-product__actions produk-$row[id_produk]'>
                    <li><a href='#' data-toggle='tooltip' data-placement='top' title='Quick View' class='quick_view' data-id='$row[id_produk]'><i class='icon-eye'></i></a></li>
                    <li><a href='".base_url().$this->uri->segment(1)."/edit_produk/$row[id_produk]' data-toggle='tooltip' data-placement='top' title='Kupon / Edit Produk'><i class='fa fa-edit'></i></a></li>
                    <li><a href='".base_url().$this->uri->segment(1)."/delete_produk/$row[id_produk]' data-toggle='tooltip' data-placement='top' title='Delete Produk' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><i class='icon-cross'></i></a></li></ul>
                </div>
                
                <div class='ps-product__container'><a class='ps-product__vendor' href='".base_url()."u/".user_reseller($row['id_reseller'])."'>".cek_paket_icon($row['id_reseller'])." $row[nama_reseller]</a>
                    <div class='ps-product__content'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                        <p class='ps-product__price'>$harga_produk</p>
                    </div>
                    <div class='ps-product__content hover'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                        <p class='ps-product__price'>$harga_produk</p>
                    </div>
                </div>
            </div>
        </div>";
            $no++;
          }
        ?>
      </div>
      </div>
        </div>
    </div>
</div>