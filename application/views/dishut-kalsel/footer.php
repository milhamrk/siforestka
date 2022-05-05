<footer class="ps-footer">
    <div class="ps-container">
        <?php if ($this->uri->segment('1')!='members' and $this->uri->segment('1')!='auth'){ ?>
        <div class="ps-footer__widgets">
        <?php 
            $kategori_banner = $this->model_app->view('kategori_banner');
            foreach ($kategori_banner->result_array() as $row) {
                if ($row['id_kategori_banner']=='1'){ 
                    echo "<aside class='widget widget_contact-us'>
                        <h4 class='widget-title'>$row[nama_kategori_banner]</h4>
                        <div class='widget_content'>";
                            $banner = $this->model_app->view_where('banner',array('id_kategori_banner'=>$row['id_kategori_banner'],'posisi'=>'footer'));
                            foreach ($banner->result_array() as $rows) {
                                echo "<p>".nl2br($rows['keterangan'])."</p>";
                            }
                            echo "<ul class='ps-list--social'>
                                <li><a class='facebook' href='https://id-id.facebook.com/DishutProvKalsel/?locale2=id_ID&_rdr' target='_blank'><i class='fa fa-facebook'></i></a></li>
                                <li><a class='twitter' href='https://mobile.twitter.com/dishutkalsel' target='_blank'><i class='fa fa-twitter'></i></a></li>
                                <li><a class='google-plus' href='https://youtube.com/channel/UCc1bE078BkLFj3EmjumZSGw' target='_blank'><i class='fa fa-youtube'></i></a></li>
                                <li><a class='instagram' href='https://instagram.com/dishutprovkalsel?utm_medium=copy_link' target='_blank'><i class='fa fa-instagram'></i></a></li>
                            </ul>
                        </div>
                    </aside>";
                }else{ 
                    echo "<aside class='widget widget_footer'>
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
        <div class="ps-footer__copyright">
            <p>© <?php echo date('Y')." ".config('info_footer'); ?></p>
        </div>
    </div>
</footer>