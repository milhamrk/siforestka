<?php
	$baca = $rows['dibaca']+1;	
	$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $rows['id_berita']))->num_rows();
?>	
<div class="ps-breadcrumb">
	<div class="ps-container">
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li><a href="<?php echo base_url(); ?>berita">Berita</a></li>
			<li><a href="<?php echo base_url()."kategori/detail/$rows[kategori_seo]"; ?>"><?php echo "$rows[nama_kategori]"; ?></a></li>
			<li><?php echo "$rows[judul]"; ?></li>
		</ul>
	</div>
</div>
<div class="ps-page--blog">
	<div class="container">
		<div class="ps-blog--sidebar">
			<div class="ps-blog__left">
				<div class="ps-post--detail sidebar">
					<div class="ps-post__header">
						<h1><?php echo "<b>$rows[judul]</b> <br> <span style='font-size:16px; color:blue'>$rows[sub_judul] </span>"; ?></h1>
						<p><?php echo "$rows[hari], ".tgl_indo($rows['tanggal']).", $rows[jam] WIB"; ?> / By <?php echo "$rows[nama_lengkap]"; ?></p>
					</div>
					<div class="ps-post__content">
					<?php 
						if ($rows['gambar'] !=''){ echo "<img style='width:100%' src='".base_url()."asset/foto_berita/$rows[gambar]' alt='$rows[judul]' /></a><br><br>"; }
						if ($rows['keterangan_gambar'] !=''){ echo "<center><p><i><b>Keterangan Gambar :</b> $rows[keterangan_gambar]</i></p></center><br>"; }
						echo "<b>$rows[isi_berita]</b><br>"; 

						if ($rows['youtube']!=''){
							echo "<h4>Video Terkait:</h4>";
							if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $rows['youtube'], $match)) {
								echo "<iframe width='100%' height='350px' id='ytplayer' type='text/html'
									src='https://www.youtube.com/embed/".$match[1]."?rel=0&showinfo=1&color=white&iv_load_policy=3'
									frameborder='0' allowfullscreen></iframe><div class='garis'></div><br/>";
							} 
						}
					?>
					</div>
					<div class="ps-post__footer">
						<p class="ps-post__tags">Tags : 
						<?php
							$tags = (explode(",",$rows['tag']));
							$hitung = count($tags);
							for ($x=0; $x<=$hitung-1; $x++) {
								if ($tags[$x] != ''){
									echo "<a href='".base_url()."tag/detail/$tags[$x]'>$tags[$x]</a>";
								}
							}
						?>
						</p>
					</div>
				</div>

				<div class="ps-post-comments" id='listcomment'>
					<?php 
						echo $this->session->flashdata('message'); 
						$this->session->unset_userdata('message');
						if ($this->session->id_konsumen!=''){ 
					?>
						<form class="ps-form--review" action="<?php echo base_url()."berita/kirim_komentar"; ?>" method="POST">
							<h4>Kirimkan Komentar.</h4>
							<div class='form-group' style='margin-bottom:0.5rem'>
								<input type="hidden" name='a' value='<?= $rows['id_berita']; ?>'>
								<textarea class='form-control' name='d' rows='4' placeholder='Tuliskan Pesan disini,..' required></textarea>
							</div>

							<div class='form-group'>
								<input type='text' style='display:inline-block; width:70%' class='form-control' name='secutity_code' placeholder='Masukkan Kode Keamanan...' required>
								<?= $image; ?>
							</div>

							<div class='form-group submit'>
								<button type='submit' name='submit' class='ps-btn'>Kirimkan</button>
							</div><br>
						</form>
					<?php 
						}else{
							echo "<div class='alert alert-warning' style='margin:40px 0px'><center>Silahkan Login untuk memberikan Komentar...</center></div>";
						}

						$komentar = $this->db->query("SELECT * FROM `komentar` where id_berita='$rows[id_berita]' AND aktif='Y' ORDER BY id_komentar DESC");
						if ($komentar->num_rows()>0){
							echo "<h4>Ada <b>".$komentar->num_rows()."</b> Komentar</h4><hr>";
							foreach ($komentar->result_array() as $row) {
								$gravatar = md5(strtolower(trim($row['email'])));	
								echo "<div class='ps-block--comment' style='margin-bottom:20px'>
										<div class='ps-block__thumbnail'>
											<img src='http://www.gravatar.com/avatar/$gravatar.jpg?s=100'>
										</div>
										<div class=''>
											<h5>$row[nama_komentar]<small style='float:right'>".jam_tgl_indo($row['tgl'].' '.$row['jam_komentar'])."</small></h5>
											<p>".nl2br($row['isi_komentar'])."</p>
										</div>
									</div>";
							}
						}
					?>
				</div>
			</div>

			<div class="ps-blog__right">
				<?php include "sidebar.php"; ?>
			</div>
		</div>
	</div>
</div>
