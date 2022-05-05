<div class="ps-breadcrumb">
	<div class="ps-container">
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li>Unduh</li>
		</ul>
	</div>
</div>

<div class="ps-page--blog">
	<div class="container">
		<div class="ps-blog--sidebar">
			<div class="ps-blog__left">
				<div class="ps-post--detail sidebar">
					<div class="ps-post__header">
						<h1><?php echo "Unduh Berkas"; ?></h1>
					</div>
					
					<table class="table table-striped">
						<thead>
							<tr style='background:#8a8a8a'>
								<th>No</th>
								<th>Uraian</th>
								<th>Jenis Dokumen</th>
								<th>Hits</th>
								<th style='width:70px'></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no=$this->uri->segment(3)+1;
							foreach ($download->result_array() as $r) {	
							if(($no % 2)==0){ $warna="#ffffff";}else{ $warna="#E1E1E1"; }
								echo "<tr bgcolor=$warna>
									<td>$no</td>
									<td>$r[judul]</td>
									<td>$r[jenis]</td>
									<td>$r[hits] Kali</td>
									<td><a class='button' style='background:#29b332; color:#ffffff; padding:2px 10px' href='".base_url()."download/file/$r[nama_file]'>Unduh</a></td>
									</tr>";
								$no++;
							}
							?>
						</tbody>
					</table>
					<div class="pagination">
						<?php echo $this->pagination->create_links(); ?>
					</div>
				</div>
			</div>

			<div class="ps-blog__right">
				<?php include "sidebar.php"; ?>
			</div>
		</div>
	</div>
</div>


