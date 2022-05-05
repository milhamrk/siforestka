<div class="ps-breadcrumb">
	<div class="ps-container">
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li><a href="<?php echo base_url(); ?>berita">Berita</a></li>
			<li>Tag "<?php echo $rows['nama_tag']; ?>"</li>
		</ul>
	</div>
</div>
	
<div class="ps-page--blog">
	<div class="container">
		<div class="ps-blog--sidebar">
			<div class="ps-blog__left">
			<?php
				foreach ($beritatag->result_array() as $r) {	
					$baca = $r['dibaca']+1;	
					$isi_berita =(strip_tags($r['isi_berita'])); 
					$isi = substr($isi_berita,0,220); 
					$isi = substr($isi_berita,0,strrpos($isi," ")); 
					$judul = $r['judul']; 
					$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r['id_berita']))->num_rows();
					
					echo "<div class='ps-post ps-post--small-thumbnail'>
						<div class='ps-post__thumbnail'><a class='ps-post__overlay' href='".base_url()."berita/detail/$r[judul_seo]'></a>";
							if ($r['gambar'] == ''){
								echo "<img src='".base_url()."asset/foto_berita/no-image.jpg' alt='no-image.jpg' /></a>";
							}else{
								echo "<img src='".base_url()."asset/foto_berita/$r[gambar]' alt='$r[gambar]' /></a>";
							}
						echo "</div>
						<div class='ps-post__content'>
							<div class='ps-post__top'>
								<div class='ps-post__meta'>";
								$tags = (explode(",",$r['tag']));
								$hitung = count($tags);
								for ($x=0; $x<=$hitung-1; $x++) {
									if ($tags[$x] != ''){
										echo "<a href='".base_url()."tag/detail/$tags[$x]'>$tags[$x]</a>";
									}
								}
								echo "</div><a class='ps-post__title' href='".base_url()."berita/detail/$r[judul_seo]'>$judul</a>
								<p>".getSearchTermToBold($isi,$this->input->post('kata'))." . . .</p>
							</div>
							<div class='ps-post__bottom'>
								<p>$r[jam], ".tgl_indo($r['tanggal']).", Oleh. <a href='#'> $r[nama_lengkap]</a></p>
							</div>
						</div>
					</div>";
				}
			?>

				<div class="ps-pagination">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>
			<div class="ps-blog__right">
				<?php include "sidebar.php"; ?>
			</div>
		</div>
	</div>
</div>

