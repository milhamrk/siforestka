<aside class="widget widget--blog widget--search">

    <form class="ps-form--widget-search" action="<?php echo base_url(); ?>berita/index" method="POST">

        <input class="form-control" type="text" name='kata' placeholder="Cari Berita..." autocomplete='off'>

        <button type='submit' name='cari'><i class="icon-magnifier"></i></button>

    </form>

</aside>
<!--
<aside class="widget widget--blog widget--categories">

    <h3 class="widget__title">Kategori</h3>

    <div class="widget__content">

        <ul>

            <?php 

                $kategori = $this->model_app->view_ordering_limit('kategori','id_kategori','RANDOM',0,10);

                foreach ($kategori->result_array() as $row) {

                    $total = $this->model_app->view_where('berita',array('id_kategori'=>$row['id_kategori']))->num_rows();

                    echo "<li><a style='border-bottom:1px dotted #cecece' href='".base_url()."kategori/detail/$row[kategori_seo]'>$row[nama_kategori] <span class='pull-right'>($total)</span></a></li>";

                }

            ?>

        </ul>

    </div>

</aside>
-->
<aside class="widget widget--blog widget--recent-post">

    <h3 class="widget__title">Postingan Terbaru</h3>

    <div class="widget__content">

        <?php 

            $terbaru = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.status' => 'Y'),'id_berita','DESC',0,5);

            foreach ($terbaru->result_array() as $r) {

                echo "<a href='".base_url()."berita/detail/$r[judul_seo]'>$r[judul]</a>";

            }

        ?>

    </div>

</aside>
<!--
<aside class="widget widget--blog widget--tags">

    <h3 class="widget__title">Tags Terpopuler</h3>

    <div class="widget__content">

    <?php 

		$tag = $this->model_utama->view_ordering_limit('tag','id_tag','RANDOM',0,50);

  		foreach ($tag->result_array() as $row) {

			echo "<a href='".base_url()."tag/detail/$row[tag_seo]'>$row[nama_tag]</a>";

		}

	?>

    </div>

</aside>
-->