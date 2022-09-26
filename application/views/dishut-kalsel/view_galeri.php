<div class="ps-breadcrumb">
	<div class="ps-container">
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li>Semua Galeri</li>
		</ul>
	</div>
</div>
	
<div class="ps-page--blog">
	<div class="container">
		<div class="ps-blog--sidebar">
			<div class="ps-blog__left">
                <div class="row">
                <?php 
                $no = 0;
                foreach ($album->result_array() as $r) {	
                    $no++;
                    $width = 33.333;

                        echo '<div class="card-2 card-mean" data-toggle="modal" data-target="#myModals'.$no.'" style="width:'.$width.'%;">
                        <div class="wrapper" style="background: url(';
                        
                        if($r['opsi']=='video'){
                            parse_str( parse_url( $r['keterangan'], PHP_URL_QUERY ), $duridam );    
                            echo "https://img.youtube.com/vi/$duridam[v]/maxresdefault.jpg";
                        }
                        else if ($r['gbr_album'] == ''){
                            echo base_url()."asset/img_album/no-image.jpg";
                        }else{
                            echo base_url()."asset/img_album/$r[gbr_album]";
                        }
                        
                        echo ') center / cover no-repeat;background-size:contain;">
                        </div>
                    </div>';
                    }
                    ?>
                    
                </div>
			</div>
		</div>
	</div>
</div>
<?php 
    $no = 0;
    foreach ($album->result_array() as $r) {	
        $no++;
        $width = 33.333;

            ?>
            
<div id="myModals<?= $no ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
            </div>

            <div class="modal-body">
            <?php
            
            if($r['opsi']=='video'){
                parse_str( parse_url( $r['keterangan'], PHP_URL_QUERY ), $duridam );   
                echo "<iframe width='560' height='315' src='https://www.youtube.com/embed/$duridam[v]?rel=0&amp;controls=0' 'frameborder='0' allowfullscreen autoplay></iframe>";
            }
            else if ($r['gbr_album'] == ''){
                echo "<img src='".base_url()."asset/img_album/no-image.jpg"."' width='560' height='315' />";
            }else{
                echo "<img src='".base_url()."asset/img_album/$r[gbr_album]"."' width='560' height='315' />";
            }
    ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
    <?php
    }
?>