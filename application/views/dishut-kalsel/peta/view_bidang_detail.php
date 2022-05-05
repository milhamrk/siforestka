
<head>
	    
	<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/slide/js/jssor.slider-23.1.0.mini.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/slide/js/slide.js"></script>
	
</head>	

<div class="ps-breadcrumb">
		<div class="ps-container">
			<ul class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>">Home</a></li>
				<li>Peta</li>
				<li>View</li>
			</ul>
		</div>
	</div>
	
<div class="ps-page--blog">
	<div class="container">
	
		<section class="col-lg-5 connectedSortable">
			<div class="panel panel-info">	
              
			  <p class='sidebar-title block-title'>INFO DETAIL</p>
                <div class="box-header">
                
                </div>
                  <div class="box-body">
                    Berikut data marker yang anda pilih: <br><br>
                      <?php 
                      
                      $baris = $this->model_app->view_where('rb_reseller',array('id_reseller'=>$rows['id_reseller']))->row_array();
					  
					  ?>
                      <dl class="dl-horizontal">
                          <dt>id produk</dt>   <dd><?php echo $rows['id_produk']; ?></dd>
						  <dt>Nama Penjual</dt>   <dd><?php echo $baris['nama_reseller']; ?></dd>
                          <dt>Potensi</dt>   <dd><?php echo $rows['potensi']; ?></dd>
                          <dt>Nama</dt>   <dd><?php echo $rows['nama']; ?></dd>
                          <dt>Kelompok</dt>   <dd><?php echo $rows['kelompok']; ?></dd>
                          <dt>Jenis</dt>   <dd><?php echo $rows['jenis']; ?></dd>
                          <dt>K P H</dt>   <dd><?php echo $rows['kph']; ?></dd>
                          <dt>R P H</dt>   <dd><?php echo $rows['rph']; ?></dd>
                          <dt>Kecamatan</dt>   <dd><?php echo $rows['kecamatan']; ?></dd>
						  <dt>Desa</dt>   <dd><?php echo $rows['desa']; ?></dd>
						  <dt>Kabupaten</dt>   <dd><?php echo $rows['kabupaten']; ?></dd>
						  <dt>Kawasan</dt>   <dd><?php echo $rows['kwsn']; ?></dd>
						  <dt>Unit</dt>   <dd><?php echo $rows['unit']; ?></dd>
						  <dt>X</dt>   <dd><?php echo $rows['x']; ?></dd>
						  <dt>Y</dt>   <dd><?php echo $rows['y']; ?></dd>
						  <dt>Volume Pohon</dt>   <dd><?php echo $rows['vol_pohon']; ?></dd>
						  <dt>Volume Tiang</dt>   <dd><?php echo $rows['vol_tiang']; ?></dd>
						  <dt>Kegiatan</dt>   <dd><?php echo $rows['kegiatan']; ?></dd>
						  <dt>Petak</dt>   <dd><?php echo $rows['petak']; ?></dd>
						  
                      </dl>
                    <hr style='margin:7px'>
					<center>
                    <a class='btn btn-default btn-block' href="<?php echo base_url();?>peta/view">Kembali ke Peta</a>
					<a class='btn btn-info btn-block' href="<?php echo base_url(); ?>peta/produk_detail/<?php echo $this->uri->segment(3); ?>">Beli Produk</a>
                    </center>
                  </div>
              </div>

            </section><!-- /.Left col -->

            <section class="col-lg-7 connectedSortable">

            <div class="box box-success">
				<p class='sidebar-title block-title'>F o t o</p>
              <div class="box-header">
				  <?php include 'slide.php';?>
              </div>
				
				
			  
            </div>
            </section><!-- right col -->
			
	</div>	
</div>