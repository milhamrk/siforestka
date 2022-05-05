<?php
  $file = fopen("sitemap.xml", "w");
  fwrite($file, '<?xml version="1.0" encoding="UTF-8"?> 
  <rss version="2.0">');
  fwrite($file, "<channel> 
	<title>RSS $iden[nama_website]</title> 
	<description>$iden[meta_deskripsi]</description>
	<link>$iden[url]</link> 
	<language>id-id</language>");
	foreach ($sitemap->result_array() as $row) {
		$isi = $row['tentang_produk']; 
		fwrite($file, "<item>
							<title>".cetak_meta($row['nama_produk'],0,255)."</title>
							<link>".base_url()."produk/detail/$row[judul_seo]</link>
							<description>".strip_tags(html_entity_decode(simplexml_load_file($isi)))."</description>
						</item>");
	}
  fwrite($file, "</channel>
  	</rss>");
  fclose($file);
?>