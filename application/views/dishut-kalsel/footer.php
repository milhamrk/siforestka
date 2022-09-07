<footer class="ps-footer">
    <div class="ps-container">
        <?php if ($this->uri->segment('1')!='members' and $this->uri->segment('1')!='auth'){ ?>
        <div class="ps-footer__widgets">
        <?php 
            $kategori_banner = $this->model_app->view('kategori_banner');
            foreach ($kategori_banner->result_array() as $row) {
                if ($row['id_kategori_banner']=='1'){ 
                    echo "<aside class='widget widget_contact-us' style='width:35%;padding:25px;'>
                        <h4 class='widget-title'>Tentang Kami</h4>
                        <div class='widget_content'>";
                            $banner = $this->model_app->view_where('banner',array('id_kategori_banner'=>$row['id_kategori_banner'],'posisi'=>'footer'));
                            foreach ($banner->result_array() as $rows) {
                                echo "<p>".nl2br($rows['keterangan'])."</p>";
                            }
                            echo "
                        </div>
                    </aside>";
                }else if($row['id_kategori_banner']=='6'){ 
                    echo "<aside class='widget widget_footer' style='width:20%;padding:25px;'>
                        <h4 class='widget-title'>Alamat</h4>
                        <p>Jl. A. Yani Km. 6 (arah kaltim), Kelurahan Belimbing Raya, Kec. Murung Pudak, Kab. Tabalong. </p>
                        <a href='#' style='color:#FFC552;text-decoration:underline;'>lihat peta</a>
                    </aside>"; 
                }else if($row['nama_kategori_banner']=='Statistik Pengunjung'){ 
                    echo "<aside class='widget widget_footer' style='width:20%;padding:25px;'>
                        <h4 class='widget-title'>Statistik Pengunjung</h4>
                        <p><b style='color:#FFC552;'>Hari ini</b><p><p>".hits_today()." kunjungan</p>
                        <p><b style='color:#FFC552;'>Bulan ini</b><p><p>".hits_month()." kunjungan</p>
                        <p><b style='color:#FFC552;'>Total</b><p><p>".hits_total()." kunjungan</p>
                    </aside>"; 
                }else if($row['id_kategori_banner']=='8'){ 
                    echo "<aside class='widget widget_footer' style='width:25%;padding:25px;'>
                        <h4 class='widget-title'>Kontak</h4>
                        <p><i class='fa fa-phone' aria-hidden='true'></i> 0526-2031541</p>
                    </aside>"; 
                }else{ 
                    echo "<aside class='widget widget_footer' style='width:25%;padding:25px;'>
                        <h4 class='widget-title'>$row[nama_kategori_banner]</h4>
                        <ul class='ps-list--link'>";
                            $banner = $this->model_app->view_where('banner',array('id_kategori_banner'=>$row['id_kategori_banner'],'posisi'=>'footer'));
                            foreach ($banner->result_array() as $rows) {
                                echo "<li><a href='$rows[url]'>$rows[judul]</a></li>";
                            }
                        echo "</ul>
                    </aside>"; 
                }
                
            }
        ?>
        </div>
        <?php } ?>
    </div>
</footer>