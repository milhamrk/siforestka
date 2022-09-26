
<?php 
    // hits counter
    hits();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title; ?></title>
    <?php
    if ($this->uri->segment(1) == 'berita' and $this->uri->segment(2) == 'detail') {
        $rows = $this->model_utama->view_where('berita', array('judul_seo' => $this->uri->segment(3)))->row_array();
        $directory_img = "foto_berita";
        $foto_meta = $rows['gambar'];
        $meta_url = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3);
    } elseif ($this->uri->segment(1) == 'produk' and $this->uri->segment(2) == 'detail') {
        $rows = $this->model_utama->view_where('rb_produk', array('produk_seo' => $this->uri->segment(3)))->row_array();
        $directory_img = "foto_produk";
        $ex = explode(';', $rows['gambar']);
        $foto_meta = $ex[0];
        $meta_url = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3);
    }else{
        $rows = $this->model_utama->view_ordering_limit('logo', 'id_logo', 'DESC', 0, 1)->row_array();
        $directory_img = "logo";
        $foto_meta = $rows['gambar'];
        $meta_url = base_url();

        echo "<link rel='apple-touch-icon' sizes='57x57' href='".base_url()."asset/images/apple-icon-57x57.png'>
        <link rel='apple-touch-icon' sizes='60x60' href='".base_url()."asset/images/apple-icon-60x60.png'>
        <link rel='apple-touch-icon' sizes='72x72' href='".base_url()."asset/images/apple-icon-72x72.png'>
        <link rel='apple-touch-icon' sizes='76x76' href='".base_url()."asset/images/apple-icon-76x76.png'>
        <link rel='apple-touch-icon' sizes='114x114' href='".base_url()."asset/images/apple-icon-114x114.png'>
        <link rel='apple-touch-icon' sizes='120x120' href='".base_url()."asset/images/apple-icon-120x120.png'>
        <link rel='apple-touch-icon' sizes='144x144' href='".base_url()."asset/images/apple-icon-144x144.png'>
        <link rel='apple-touch-icon' sizes='152x152' href='".base_url()."asset/images/apple-icon-152x152.png'>
        <link rel='apple-touch-icon' sizes='180x180' href='".base_url()."asset/images/apple-icon-180x180.png'>
        <link rel='icon' type='image/png' sizes='192x192'  href='".base_url()."asset/images/android-icon-192x192.png'>
        <link rel='icon' type='image/png' sizes='32x32' href='".base_url()."asset/images/favicon-32x32.png'>
        <link rel='icon' type='image/png' sizes='96x96' href='".base_url()."asset/images/favicon-96x96.png'>
        <link rel='icon' type='image/png' sizes='16x16' href='".base_url()."asset/images/favicon-16x16.png'>
        <meta name='msapplication-TileColor' content='#ffffff'>
        <meta name='msapplication-TileImage' content='".base_url()."asset/images/ms-icon-144x144.png'>
        <meta name='theme-color' content='#ffffff'>";
    }
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="google-site-verification" content="<?= config('google_site_verification'); ?>" />
    <meta name="robots" content="index, follow">
    <meta name="description" content="<?= $description; ?>">
    <meta name="keywords" content="<?= $keywords; ?>">
    <meta name="author" content="phpmu.com">
    <meta name="robots" content="all,index,follow">
    <meta http-equiv="Content-Language" content="id-ID">
    <meta NAME="Distribution" CONTENT="Global">
    <meta NAME="Rating" CONTENT="General">
    <?php 
    // Schema.org markup for Google+ 
	echo '<meta itemprop="name" content="' . $title . '">
	<meta itemprop="description" content="' . $description . '">
    <meta itemprop="image" content="' . base_url() . 'asset/' . $directory_img . '/' . $foto_meta . '">';
    
	// Twitter Card data
    echo '
    <meta name="twitter:card" content="product">
	<meta name="twitter:site" content="'.config('twitter').'">
	<meta name="twitter:title" content="' . $title . '">
	<meta name="twitter:description" content="' . $description . '">
	<meta name="twitter:creator" content="'.config('twitter').'">
    <meta name="twitter:image" content="' . base_url() . 'asset/' . $directory_img . '/' . $foto_meta . '">';
    
	// Open Graph data
    echo '
    <meta property="fb:app_id" content="'.config('facebook_app_id').'">
    <meta property="og:title" content="' . $title . '" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="' .$meta_url. '" />
    <meta property="og:image" content="' . base_url() . 'asset/' . $directory_img . '/' . $foto_meta . '" />
    <meta property="og:description" content="' . $description . '"/>
    <meta property="og:site_name" content="' . $title . '" />';
    ?>
    
    <link rel="shortcut icon" href="<?php echo base_url(); ?>asset/images/<?php echo favicon(); ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.xml" />
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/fonts/Linearicons/Linearicons/Font/demo-files/demo.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/slick/slick/slick.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/lightGallery-master/dist/css/lightgallery.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/css/<?php echo ($this->session->theme != '' ? $this->session->theme : background()); ?>.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/admin/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/summernote/summernote-bs4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/uploadfile.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/progressive-image.js/dist/progressive-image.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/progressive-image.js/dist/progressive-image.js"></script>
    <script src="<?php echo base_url(); ?>asset/phpmu_scripts.js"></script>
    
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-1LPM1X4QZM"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-1LPM1X4QZM');
	</script>
	
	
	
	<!-- Facebook Pixel Code -->
    <script>
        
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?= config('facebook_pixel'); ?>');
        fbq('track', 'PageView');
    </script>

    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=<?= config('facebook_pixel'); ?>&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    <script>
        function copyToClipboard(element) {
	      var $temp = $("<input>");
	      $("body").append($temp);
	      $temp.val($(element).text()).select();
	      document.execCommand("copy");
	      $temp.remove();
        }
        
        $(document).ready( function() {
                $('.ajax-file-upload-filename').on('load', function() {
                originalString = 'aaa';
                hasil = originalString.replace(/<\/?[^>]+>/gi, '');
                $(".ajax-file-upload-filename").html(hasil);
            });
        });

        $(document).ready(function(){
    	    $('.myButton').on('click', function() {
                var $this = $(this);
                var loadingText = '<i class="fa fa-check"></i>';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 2000);
            });
	    });

        $(document).ready(function(){
    	    $('.myButtonL').on('click', function() {
                var $this = $(this);
                var loadingText = '<i style="font-size:18px; color:green" class="fa fa-check"></i>';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 2000);
            });
	    });

        $(document).ready(function(){
    	    $('.spinnerButton').on('click', function() {
                var $this = $(this);
                var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 10000);
            });
        });
        
        $(document).ready(function(){
			$('.oksimpanxx').on('click', function() {
                var $this = $(this);
                var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <b style="color:red">Gagal Proses Pemesanan...</b>';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 5000);
            });
			
    	    $('.oksimpanx').on('click', function() {
                var $this = $(this);
                var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <b style="color:red">Gagal Proses Pembayaran...</b>';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 5000);
            });

            $('#oksimpan').on('click', function() {
                var $this = $(this);
                var loadingText = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <b>Tunggu Sebentar, Ya...</b>';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 20000);
            });
	    });

        function nospaces(t) {
            if (t.value.match(/\s/g)) {
                alert('Maaf, Tidak Boleh Menggunakan Spasi,..');
                t.value = t.value.replace(/\s/g, '');
            }
        }

        $(".formatNumber").on('keyup', function() {
            var n = parseInt($(this).val().replace(/\D/g, ''), 10);
            $(this).val(n.toLocaleString());
        });
    </script>

    <script>
        $(document).ready(function() {
            // Select your input element.
            var number = document.getElementsByClassName('qty');
            // Listen for input event on numInput.
            number.onkeydown = function(e) {
                if(!((e.keyCode > 95 && e.keyCode < 106)
                || (e.keyCode > 47 && e.keyCode < 58) 
                || e.keyCode == 8)) {
                    return false;
                }
            }

            $('#operatorx').change(function() {
                var operator_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('main/produk?page=home'); ?>",
                    data: "operator_id=" + operator_id,
                    success: function(response) {
                        $('#produkx').html(response);
                    }
                })
            });

            $('#operator').change(function() {
                var operator_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('main/produk'); ?>",
                    data: "operator_id=" + operator_id,
                    beforeSend: function(){
                        // Show image container
                        $("#loader").show();
                        $(".ppob").hide();
                        $("#historytrx").hide();
                    },
                    success: function(response) {
                        $('#produk').html(response);
                    },
                    complete:function(data){
                        // Hide image container
                        $("#loader").hide();
                        $(".ppob").show();
                    }
                })
            })

            $(document).on('click', '#id_pelanggan', function(e) {
                var operator_id = 133;
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('main/produk'); ?>",
                    data: "operator_id=" + operator_id,
                    beforeSend: function(){
                        // Show image container
                        $("#loader").show();
                        $(".ppob").hide();
                        $("#historytrx").hide();
                    },
                    success: function(response) {
                        $('#produk').html(response);
                    },
                    complete:function(data){
                        // Hide image container
                        $("#loader").hide();
                        $(".ppob").show();
                    }
                })
            })
        })
    </script>

    <style>
        .ps-product__container .add-to-cart{
            padding: 3px 10px !important;
        }
        .group-order{
            background: #e3e3e3;
            color: red;
            border: 1px solid #8a8a8a;
            padding: 0px 10px;
            margin-top:5px;
        }
        .group-order i{
            font-weight: bold;
            background: red;
            color: #fff;
            font-size: 17px;
            padding: 3px 7px 6px 7px;
            margin: 3px 0px -10px -10px;
        }
        .form-control.error{
            font-style: normal;
        }
        .error{
            color: red;
            font-style: italic;
        }

        .margin-btn{
            padding: 10px 20px !important;
        }

        .dataTables_wrapper .row {
            width: 100%
        }

        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting_asc:after {
            display: none
        }

        .dataTables_length select,
        .dataTables_filter input[type=search] {
            height: 30px
        }

        .dataTables_length {
            float: left
        }

        .dataTables_filter {
            float: right
        }

        #example1 th,
        #example11 th {
            font-weight: bold
        }

        .modal-content .btn-primary {
            height: 30px;
            font-size: 12px;
        }

        .modal-content input[type=text] {
            height: 30px;
        }

        .iconset .fa {
            font-size: 13px !important;
        }

        .is-invalid{
            color:red;
        }

        .blink_me {
            animation: blinker 1s linear infinite;
            color: red
        }

        .blink_me:hover {
            animation: blinker 0s linear infinite;
            color: red
        }

        @keyframes blinker {
            50% {
                opacity: 0
            }
        }

        .mb-10 {
            margin-bottom: 0px;
        }

        .pricing-table-product-box {
            -webkit-box-shadow: 0 4px 9px 0 rgba(67, 65, 79, .1);
            box-shadow: 0 4px 9px 0 rgba(67, 65, 79, .1);
            border: solid 2px #f5f5f5;
        }

        .harga {
            font-size: 3em;
            font-weight: 700;
            line-height: .8em;
            display: inline-block;
        }

        .currency {
            font-size: 1em;
            font-weight: 700;
            margin-top: .2em;
            display: inline-block;
        }

        .waktu {
            font-size: .7em;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: end;
            -ms-flex-align: end;
            align-items: flex-end;
            margin: .3em;
            display: inline-block;
        }

        .waktu_block {
            display: inline-block;
        }

        #Back-to-top {
            text-align: center;
            z-index: 99999;
            position: fixed;
            bottom: 70px;
            right: 30px;
            cursor: pointer;
            display: none;
            opacity: 0.7;
        }

        #Back-to-top:hover {
            opacity: 1;
        }

        .badge-secondary {
            color: #fff;
            background-color: #dd2400;
            padding: 5px 7px 4px 7px;
        }

        .notif .nav-tabs .nav-link {
            background: #3cd03c;
            color: #fff;
            border-top: 1px solid #e3e3e3 !important;
            border-left: 1px solid #e3e3e3 !important;
            border-right: 1px solid #e3e3e3 !important;
        }

        .notif .badge-secondary {
            color: #fff;
            background-color: #00b30e;
            padding: 5px 7px 4px 7px;
        }

        .notif .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: #495057 !important;
            background-color: #fff !important;
        }

        .penjualan .nav-tabs .nav-link {
            background: #ff9900;
            color: #fff;
            border-top: 1px solid #e3e3e3 !important;
            border-left: 1px solid #e3e3e3 !important;
            border-right: 1px solid #e3e3e3 !important;
        }

        .penjualan .badge-secondary {
            color: #fff;
            background-color: #dc8400;
            padding: 5px 7px 4px 7px;
        }

        .penjualan .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: #495057 !important;
            background-color: #fff !important;
        }

        .container .ps-section__content {
            min-height: 650px;
        }

        input[type=number]::-webkit-inner-spin-button {
            opacity: 1
        }

        .form-control {
            border-bottom: 1px solid #cecece;
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
            background-color: #f9f9f9;
        }

        .multiselect-container {
            width: 100%;
            font-size: 13px;
        }

        .form-control, .form-control:focus{
            border:none !important;
        }

        button.multiselect {
            font-size: 14px;
        }

        .multiselect-container>li {
            border-bottom: 1px dotted #e3e3e3;
        }

        .form-sm .form-group {
            margin-bottom: 5px !important;
        }

        .form-sm i {
            margin-left: 10px;
        }

        .form-sm .ajax-file-upload {
            width: 100%;
        }

        .no-margin{
            margin-bottom: 0px !important;
        }

        .biodata .col-form-label{
            color:#5d5d5d;
            font-weight: bold;
            background: #f9f9f9;
        }

        .checkbox-scroll { 
            border:1px solid #ccc; 
            width:100%; 
            height: 170px; 
            padding-left:8px; 
            overflow-y: scroll; 
        }

        .boxed-border{
            border-bottom: 5px solid #01826F;
            border-radius: 4px;
            width: 49px;
            margin: 0 auto;
        }

        @media (max-width: 479px) {
            .penawaran{
                font-size:20px !important;
            }

            .ps-product-list .ps-section__header h3{
                padding-bottom:0px;
                font-size:16px
            }

            .ps-product-list .ps-section__links li a{
                font-size: 11px;
                text-decoration: underline;
            }

            .ps-block--download-app .ps-block__content{
                padding: 0 15px;
            }

            .widget_contact-us h3{
                font-size:20px;
            }
        }

        input[type=checkbox]{
            height: 1em;
        }
        .selected-ongkir10{ background-color:#cecece; }
        .selected-ongkir11{ background-color:#cecece; }
        .selected-ongkir12{ background-color:#cecece; }

        .btn-custom{
            padding: 3px 10px;
            background: #f7f7f7;
            border: 1px solid #cecece;
            width: 90%;
            display: block;
        }

        .menu--mobile > li > a {
            padding: 6px 20px;
            border-left: 1px solid #afafaf;
            margin-left: 20px;
        }

        .menu--mobile > li.menu-item-has-children .sub-toggle{
            top: -5px;
        }

        .menu--mobile .sub-menu > li > a{
            border-bottom: 1px dotted #e3e3e3;
            padding: 3px 20px;
            margin-left: 30px;
        }

        .boxed-white{
            background: rgba(255, 255, 255, 0.99);
            border: 1px solid white;
            border-radius: 15px;
            max-width: 944px;
            padding: 25px 0 !important;
        }

        .boxed-title{
            text-align: center;
            font-weight: 200;
        }

        .boxed-white-before-3{
            background: #8D8D8D;
            width: 1100px;
            height: 225px;
            position: absolute;
            top: 25px;
            border-radius: 12px;
        }

        .boxed-white-before-2{
            background: #5C5C5C;
            width: 1165px;
            height: 200px;
            position: absolute;
            top: 35px;
            border-radius: 12px;
        }

        .boxed-white-before-1{
            background: #333;
            width: 1228px;
            height: 175px;
            position: absolute;
            top: 50px;
            border-radius: 12px;
        }

        /* owl-carousel */

        /* sliders container */
            #owlCarousel, 
            .owl-stage-outer, 
            .owl-stage,
            .owl-item-bg,
            .owl-item { 
            height: 100%;
            min-height: 200px;
            }

            #owlCarousel{
            width: 100%;
            overflow: hidden;
            position: relative;
            }
            #owlCarousel:hover .owl-nav{
                opacity: 1;
            }
            /* slider container */
            .owl-item {
                display: inline-block;
                width: 100%;
                overflow: hidden;
                -webkit-backface-visibility: hidden;
            /*     -webkit-transform: translateZ(0) scale(1.0, 1.0); */
            }

            .owl-item .owl-item-bg {
                width: 100%;
                display: inline-block;
                position: absolute;
                background-size: 100% 100%;
                background-position: center center;
            }

            /* previus/next slider control container */
            .owl-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-80px);
            left: 0;
            right: 0;
                opacity: 0;
                transition: all .3s;
            }

            /* previus/next slider control*/
            .owl-prev,
            .owl-next {
                width: 200px;
                height: 100px;
                line-height: 70px;
                position: absolute;
                top:50%;
                transform: translateY(50%);
            /*     border-radius: 4px; */
                overflow: hidden;
                transition: all 1s ease
            }

            /* previus slider control*/
            .owl-prev { 
                left: 10px;
            }
            /* next slider control*/
            .owl-next { 
                right: 10px; 
            }
            /* slider controls thump image and icon */
            .owl-prev-thump,
            .owl-prev-icon,
            .owl-next-thump,
            .owl-next-icon {
                height: 100%;
            }
            /* slider controls thump image */
            .owl-prev-thump,
            .owl-next-thump {
                width: 100%;
                background-size: cover;
                transition: all 1s ease-in-out;
                image-rendering: -webkit-optimize-contrast;
            }
            /* slider previous/next controls icon */
            .owl-prev-icon,
            .owl-next-icon {
                width: 40%;
                    height: 100%;
                background-color: rgba(0,0,0,.4);
                position: absolute;
                top: 0;
                    padding-top: 8%;
                text-align: center;
                transition: all 1s ease;
            }
            /* slider previous/next fontawsome icon */
            .owl-prev-icon:before,
            .owl-next-icon:before {
                font-family: FontAwesome;
                color: rgba(255,255,255,.7);
                font-size: 30px;
                transition: all 1s ease
            }
            /* left arrow */
            .owl-prev-icon:before {
                content: '\f104';
            }
            /* right arrow */
            .owl-next-icon:before {
                content: '\f105';
            }

            .owl-prev-icon {left: 0;}
            .owl-next-icon {right: 0}

            /*-----------
            nav hover
            ------------*/
            /* prevent animation when disabling loop mode 
            .owl-next:not(.disabled):hover
            */
            .owl-prev:hover,
            .owl-next:hover {
                animation: navShadow 4s ease-in-out infinite;
            }
            .owl-prev:hover .owl-prev-icon,
            .owl-next:hover .owl-next-icon {
                width: 25%;
            }

            @keyframes navShadow {
                0%, 100% {box-shadow: 0px 0px 1px 0 #f1f1f1;}
                50% {box-shadow: 0px 0px 5px 0 #f1f1f1}
            }

            .owl-prev.disabled:hover , 
            .owl-next.disabled:hover {
            animation: none;
            }
            .owl-prev.disabled:hover .owl-prev-icon, 
            .owl-next.disabled:hover .owl-next-icon {
            width: 50%;
            }
            /*-----------------------------------
                    Owl content styling
            -----------------------------------*/
            .slide-content {
                position: absolute;
                left: 20%;
                top: 35%;
                width: 45%;
                height: 300px;
                padding: 70px 70px 0;
                text-align: left;
                transform: translate(-50%,-50%) rotate3d(1, 0, 0, -90deg);
                transform-origin: top;
                color: #fff;
                font-size: 2em;
            }
            .slide-content, 
            .slide-content h3,
            .slide-content h2,
            .slide-content p,
            .slide-content h3:before,
            .slide-content h3:after {
            transition: all 2s ease;
            }
            .slide-content h3 {
            position: relative;
            display: inline-block;
            font-weight:200;
            margin-bottom:0px;
            padding-top:0px;
            color: rgba(255,255,255,.95);
            /*   transform: translate3d(-100%, 0,1px); */
            }
            
            .slide-content h2 {
            color: #f9f9f9;
            /*   font-size: 1.3em; */
            margin-top:0px;
            padding-top:0px;
            margin-bottom: 20px;
            font-weight:400;
            /*   transform: translate3d(100%, 0,1px); */
            }
            .slide-content p {
            /*   font-size: .6em; */
            /*   padding: 0 190px; */
            line-height: 1.4em;
            text-transform: capitalize;
            color: rgba(255,255,255,.8);
            /*   transform: translate3d(0, 400%,1px); */
            }
            /* animate content */
            .owl-item.active .slide-content {
            transform: translate(-20%, 0%) rotate3d(1, 0, 0, 0);
            transition-delay: .7s
            }
            .owl-item.active h3,
            .owl-item.active h2,
            .owl-item.active p,
            .owl-item.active h3:before,
            .owl-item.active h3:after {
            transform: translate3d(0, 0,1px);
            transition-delay: 1s
            }
            .border-slide{
                border-bottom: 4px solid #198A82;
                width: 70%;
                height: 5px;
                background: #198A82;
                content: ' ';
                margin-bottom: 11px;
                border-radius: 8px;
                position: relative;
            }
            .border-slide:after{
                border-bottom: 4px solid #FFC552;
                width: 30%;
                height: 5px;
                background: #FFC552;
                content: ' ';
                margin-bottom: 11px;
                border-radius: 8px;
                position: absolute;
                right: -115px;
            }

            footer h1,footer h2, footer h3, footer h4,footer h5, footer h6, .widget_footer .widget-title{
                color:#fff;
            }
            
            footer p, .ps-list--link li a{
                color:#fff;
            }

            .mt-50{
                background:#050505;
                background-image: url('http://localhost/siforestika/asset/images/bg-footer-top.png');
                height: 280px;
                position: relative;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
            }

            .top-footer{
                position: absolute;
                background: rgba(0,0,0,0.8);
                color: #fff;
                width: 1100px;
                margin: 0 auto;
                left: 0;
                right: 0;
                bottom: 30px;
                padding-bottom: 20px;
                padding-left:85px;
                padding-right:85px;
                padding-top: 25px;
                border-radius: 9px;
            }

            .top-footer p, .top-footer ul{
                color:#ECF0F1;
                display:inline-block;
            }

            .top-footer ul li{
                display:inline-block;
                color:#FFC552;
                text-decoration:underline;
                padding:0 35px;
            }

            #filtersubmit {
                position: relative;
                z-index: 1;
                left: -30px;
                top: 9px;
                color: #7B7B7B;
                cursor: pointer;
                width: 0;
            }

            #homepage-1 .ps-product-list.specialized .ps-container{
                background: #fff;
                margin: 0 auto;
                border-radius: 9px;
                padding: 35px 45px;
                padding-top: 45px;
            }
            #homepage-1 .ps-product-list.specialized{
                background:#000;
                padding:55px;
            }

            #homepage-1 .specialized h4{
                font-size: 26px;
                font-weight: 200;
            }

            #homepage-1 .specialized .ps-container > .row:nth-child(2){
                text-align:center;
            }

            #homepage-1 .specialized .ps-container > .row:nth-child(2) hr{
                margin-bottom:25px;
            }

            .border-center{
                width: 225px;
                height: 5px;
                background: #198A82;
                content: ' ';
                margin: 11px 0;
                border-radius: 0 8px 8px 0;
                position: relative;
                display: block;
                left: -45px;
            }

            .border-center::after{
                width: 30%;
                height: 5px;
                background: #FFC552;
                content: ' ';
                border-radius: 8px;
                position: absolute;
                right: -75px;
            }

            .border-center-right{
                width: 225px;
                height: 5px;
                background: #198A82;
                content: ' ';
                margin: 11px 0;
                border-radius: 0 8px 8px 0;
                position: relative;
                display: block;
            }

            /* Card */

            .card-mean {
                float: left;
                padding: 0.7rem;
                width: 60%;
                }
                .card-mean .menu-content {
                margin: 0;
                padding: 0;
                list-style-type: none;
                }
                .card-mean .menu-content::before, .card-mean .menu-content::after {
                content: '';
                display: table;
                }
                .card-mean .menu-content::after {
                clear: both;
                }
                .card-mean .menu-content li {
                display: inline-block;
                }
                .card-mean .menu-content a {
                color: #fff;
                }
                .card-mean .menu-content span {
                position: absolute;
                left: 50%;
                top: 0;
                font-size: 10px;
                font-weight: 700;
                font-family: 'Open Sans';
                transform: translate(-50%, 0);
                }
                .card-mean .wrapper {
                background-color: #fff;
                min-height: 340px;
                position: relative;
                overflow: hidden;
                transition:0.2s;
                }

                .card-mean .wrapper:hover{
                    transition:0.2s;
                    box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 15px 12px rgba(0, 0, 0, 0.2);
                }

                /* .card-mean .wrapper:hover .data { */
                .card-mean .wrapper .data {
                transform: translateY(0);
                }
                .card-mean .data {
                position: absolute;
                bottom: 0;
                width: 100%;
                transform: translateY(calc(70px + 1em));
                transition: transform 0.3s;
                }
                .card-mean .data .content {
                padding: 1em;
                position: relative;
                z-index: 1;
                }
                .card-mean .author {
                font-size: 12px;
                }
                .card-mean .title {
                margin-top: 10px;
                }
                .card-mean .text {
                height: 70px;
                margin: 0;
                }
                .card-mean input[type='checkbox'] {
                display: none;
                }
                .card-mean input[type='checkbox']:checked + .menu-content {
                transform: translateY(-60px);
                }
                
                .card-2 .wrapper {
                /* background: url(http://localhost/siforestika/asset/foto_berita/279073209_357974409694920_2037136998432395723_n.jpg) center / cover no-repeat; */
                background: url(http://localhost/siforestika/asset/foto_berita/279073209_357974409694920_2037136998432395723_n.jpg) center / cover no-repeat;
                border-radius:11px;
                }
                /* .card-2 .wrapper:hover .menu-content span { */
                .card-2 .wrapper .menu-content span {
                transform: translate(-50%, -10px);
                opacity: 1;
                }

                .card-2 h1{
                    font-size:18px;
                }

                .card-2 .header {
                color: #fefefe;
                padding: 1em;
                }
                .card-2 .header::before, .card-2 .header::after {
                content: '';
                display: table;
                }
                .card-2 .header::after {
                clear: both;
                }
                .card-2 .header .date {
                float: left;
                font-size: 12px;
                }
                .card-2 .menu-content {
                float: right;
                }
                .card-2 .menu-content li {
                margin: 0 5px;
                position: relative;
                }
                .card-2 .menu-content span {
                transition: all 0.3s;
                opacity: 0;
                }
                .card-2 .data {
                color: #fff;
                position: absolute;
                content: "";
                padding:8px;
                display: block;
                width: 100%;
                /* height: 100%; */
                /* top: 0; */
                background-image: linear-gradient(transparent, 20%, #000);
                z-index: 0;
                transform: translateY(calc(70px + 4em));
                }
                .card-2 .title a {
                color: #fff;
                }

                .card-2 p{
                    color:#fefefe;
                }

                .card-2 .button {
                display: block;
                width: 100px;
                margin: 2em auto 1em;
                text-align: center;
                font-size: 12px;
                color: #fff;
                line-height: 1;
                position: relative;
                font-weight: 700;
                }
                .card-2 .button::after {
                content: '\2192';
                opacity: 0;
                position: absolute;
                right: 0;
                top: 50%;
                transform: translate(0, -50%);
                transition: all 0.3s;
                }
                /* .card-2 .button:hover::after { */
                .card-2 .button::after {
                transform: translate(5px, -50%);
                opacity: 1;
                }

                .boxed-writer {
                    display: flex;
                    align-items:center;
                    padding:15px 0;
                    border-bottom:0.1px solid #eee;
                }

                .boxed-writer img{
                    width: 50px;
                    border-radius: 30px;
                }

                .boxed-writer span{
                    margin-left: 13px;
                    font-size: 17px;
                }

                .boxed-writer:last-child{
                    border:none;
                    margin-bottom:25px;
                }

                .navbar-nav li:hover>.dropdown-menu {
                   display: block;
                }

                .boxed-writer:first-child{
                    margin-top:25px;
                }

                #homepage-1 .specialized .home-news h4{
                    font-weight:200;
                    font-size:19px;
                }

                #homepage-1 .specialized .home-news{
                    margin:25px 0;
                }

                .nav-pills .nav-item a{
                    color: #777;
                    font-weight: 100;
                }

                .nav-pills .nav-item a:hover{
                    text-decoration:none !important;
                }

                .nav-pills .nav-link.active, .nav-pills .show > .nav-link{
                    color:#000;
                    /* font-weight:400; */
                    background:transparent;
                }

                .nav-pills{
                    display:table;
                    margin:0 auto !important;
                }

                .nav-pills .nav-item{
                    display:inline-block;
                    margin:0 15px;
                }

                .nav-link.show::after{
                    content: '';
                    position: absolute;
                    bottom: -3px;
                    left: 0;
                    right: 0;
                    background: #01826F;
                    height: 3px;
                    border-radius: 10px;
                }

                .box-before-1{
                    background: rgba(255,255,255,0.5);
                    width: 1100px;
                    height: 125px;
                    position: absolute;
                    top: -28px;
                    border-radius: 12px;
                    left: 0;
                    right: 0;
                    margin: 0 auto;
                }

                .box-before-2{
                    background: rgba(255,255,255,0.25);
                    width: 800px;
                    height: 125px;
                    position: absolute;
                    top: -51px;
                    border-radius: 12px;
                    left: 0;
                    right: 0;
                    margin: 0 auto;
                }

                .sticky-play{
                    position: relative;
                    margin-left: 775px;
                    margin-top: -85px;
                }

                .sticky-play a{
                    width: 75px;
                    height: 75px;
                    content: ' ';
                    display: block;
                    background: rgba(255,255,255,0.25);
                    border-radius: 50%;
                }

                .sticky-play a::before{
                    width: 115px;
                    height: 115px;
                    content: ' ';
                    display: block;
                    background: rgba(255,255,255,0.15);
                    border-radius: 50%;
                    margin: auto;
                    top: 0;
                    bottom: 0;
                    position: absolute;
                    left: -18px;
                    right: 0;
                }

                .sticky-play a img{
                    height: 45px;
                    margin: auto;
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                }

                .heading-content{
                    background-image: url('<?= base_url() ?>asset/images/ornamen.png');
                    background-size: contain;
                    background-repeat: no-repeat;
                    background-position: center;
                }

                /* Responsive */

                @media only screen and (max-width: 600px) {
                    .owl-next, .owl-prev{
                        display: none !important;
                    }
                    .slide-content{
                        left:15%;
                        width:90%;
                    }
                    .border-slide::after{
                        right:-55px;
                    }
                    .ps-home-ads .ps-collection{
                        margin:0;
                    }
                    .berita-section .sample .row .card-2{
                        width:100% !important;
                    }
                    .berita-section .sample .card-mean .text{
                        height:100px;
                    }
                    .top-footer ul li{
                        display: block;
                        padding:5px 0;
                    }
                    .top-footer p, .top-footer ul{
                        margin:0;
                        padding:0;
                        display:block;
                    }
                    .ps-footer .ps-container aside{
                        width:100% !important;
                        display: block;
                        flex-basis:100%;
                        max-width:100%;
                    }
                    #homepage-1 .ps-product-list.specialized{
                        padding:15px;
                    }
                    .ps-home-ads{
                        padding-left:15px;
                        padding-right:15px;
                    }
                    .boxed-white{
                        padding:25px 15px !important;
                    }
                    .boxed-white-before-1,.boxed-white-before-2,.boxed-white-before-3,.box-before-1,.box-before-2,.no-mobile{
                        display:none;
                    }
                    .top-footer{
                        width:100%;
                    }
                }
    </style>
</head>

<body>
    <div class="modal fade bd-example-modal-lg" style='z-index:99999' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style='border-bottom:0px solid #e9ecef'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 d-none d-sm-block" style='padding:0px 40px'>
                            <?php
                            $banner = $this->model_app->view_where_ordering('banner', array('posisi' => 'top'), 'id_banner', 'DESC');
                            foreach ($banner as $row) {
                                echo "<div class='ps-block__item' style='margin-bottom: 18px;'>
                            <div class='ps-block__left' style='display:block; float:left'><i style='font-size:35px; margin-right:20px' class='$row[icon]'></i></div>
                            <div class='ps-block__right'>
                                <h5 style='margin-bottom:0px'>$row[judul]</h5>
                                <p>$row[keterangan]</p>
                            </div>
                        </div>";
                            }
                            ?>
                            <hr style='padding:15px 0px 5px 0px'>
                            <div class="info--register-bottom" style='margin-bottom:20px'>
                                <center><span>Belum punya akun? </span> <a style='color:#000' href="<?php echo base_url(); ?>auth/login" class="btn-register" target="_parent">Daftar sekarang!</a></center>
                            </div>
                        </div>
                        <div class="col-md-6" style='padding:0px 40px'>
                            <h3>MASUK</h3>
                            <form action="<?php echo base_url(); ?>auth/login" method="POST">
                                <div class="ps-form__content">
                                    <div class="form-group" style='margin-bottom: 1.2rem;'>
                                        <label style='margin-bottom:5px' class="col-form-label">Username, Email atau No. Handphone</label>
                                        <input class="form-control" name='a' style='height:40px' type="text" autofocus autocomplete='off' required>
                                    </div>
                                    <div class="form-group" style='margin-bottom: 1rem;'>
                                        <label style='margin-bottom:5px' class="col-form-label">Password</label>
                                        <input class="form-control" name='b' style='height:40px' type="password" required>
                                    </div>
                                    <div class="form-group" style='margin-bottom: 1rem;'>
                                        <div class="ps-checkbox">
                                            <input class="form-control" type="checkbox" id="remember-me" name="remember-me">
                                            <label for="remember-me">Ingat saya</label>
                                            <a href='#' style='color:#000' class='float-right' data-dismiss="modal" aria-hidden="true" data-toggle='modal' data-target='.lupa-example-modal-lg'>Lupa Password?</a>
                                        </div>
                                    </div><br>
                                    <div class="form-group submit" style='margin-bottom:5px'>
                                        <button type='submit' name='login' class="ps-btn ps-btn--fullwidth gray-btn custom-btn">Masuk</button>
                                        <?php
                                        $ci = &get_instance();
                                        $ci->load->library('facebook');
                                        $ci->load->library('google');
                                        echo "<a href='" . $ci->google->loginURL() . "' class='ps-btn ps-btn--fullwidth red-btn custom-btn' style='margin: 4px 0px'>Google</a>
                                      <a href='" . $ci->facebook->login_url() . "' class='ps-btn ps-btn--fullwidth blue-btn custom-btn'>Facebook</a>";
                                        ?>
                                    </div><br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade lupa-example-modal-lg" style='z-index:99999' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style='border-bottom:0px solid #e9ecef'>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6" style='padding:0px 40px'>
                            <?php
                            $banner = $this->model_app->view_where_ordering('banner', array('posisi' => 'top'), 'id_banner', 'DESC');
                            foreach ($banner as $row) {
                                echo "<div class='ps-block__item' style='margin-bottom: 10px;'>
                            <div class='ps-block__left' style='display:block; float:left'><i style='font-size:35px; margin-right:20px' class='$row[icon]'></i></div>
                            <div class='ps-block__right'>
                                <h5 style='margin-bottom:0px'>$row[judul]</h5>
                                <p>$row[keterangan]</p>
                            </div>
                        </div>";
                            }
                            ?>
                            <hr style='padding:15px 0px 5px 0px'>
                            <div class="info--register-bottom" style='margin-bottom:20px'>
                                <center><span>Belum punya akun? </span> <a style='color:#000' href="<?php echo base_url(); ?>auth/login" class="btn-register" target="_parent">Daftar sekarang!</a></center>
                            </div>
                        </div>
                        <div class="col-md-6" style='padding:0px 40px'>
                            <h3>LUPA PASSWORD?</h3>
                            <form action="<?php echo base_url(); ?>auth/lupass" method="POST">
                                <div class="ps-form__content">
                                    <div class="form-group" style='margin-bottom: 1.8rem;'>
                                        <label style='margin-bottom:5px' class="col-form-label">Username, Email</label>
                                        <input class="form-control" name='a' style='height:40px' type="text" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <label style='margin-bottom:5px' class="col-form-label">No. Handphone</label>
                                        <input class="form-control" name='b' style='height:40px' type="text" required>
                                    </div>
                                    <div class="form-group" style='margin-bottom: 1rem;'>
                                        <div class="ps-checkbox">
                                            <a href='#' class='text' data-dismiss="modal" aria-hidden="true">Batalkan?</a>
                                            <a href='#' style='color:#000' class='float-right' data-dismiss="modal" aria-hidden="true" data-toggle='modal' data-target='.bd-example-modal-lg'>Kembali Login?</a>
                                        </div>
                                    </div><br>
                                    <div class="form-group submit" style='margin-bottom:5px'>
                                        <button type='submit' name='submit3' class="ps-btn ps-btn--fullwidth">Kirimkan Permintaan</button>
                                    </div><br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id='Back-to-top'>
        <img alt='Scroll to top' src='<?= base_url(); ?>asset/images/top.png' />
    </div>
    <?php
    if ($this->uri->segment(1) != 'auth') {
        $idn = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
    ?>
        <header class="header header--1 header--sticky fixed-top" data-sticky="true">
            
            <div class="header__top">
                <div class="ps-container">
                    <div class="header__left">
                        
                        <?php
                        $logo = $this->model_utama->view_ordering_limit('logo', 'id_logo', 'DESC', 0, 1);
                        foreach ($logo->result_array() as $row) {
                            echo "<a class='sticky-logo' href='" . base_url() . "'><img src='" . base_url() . "asset/logo/$row[gambar]'/></a>";
                        }
                        ?>
                    </div>
                    <div class="header__center">
                        <ul class="new_menu">
                            <li><a href="<?php echo base_url() ?>">Beranda</a></li>
                            <li><a href="<?php echo base_url() ?>berita">Berita</a></li>
                            <li><a href="<?php echo base_url() ?>peta/dishut">Web GIS</a></li>
                            <li><a href="<?php echo base_url() ?>produk">Produk</a></li>
                            <li><a href="<?php echo base_url() ?>galeri">Galeri</a></li>
                            <li class="nav-item dropdown" style="position:relative !important;">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pembenihan</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" style="font-size:1.25rem;padding:0.3rem 1.5rem;" href="<?php echo base_url()  ?>halaman/detail/persediaan-bibit">Siap Tanam</a>
                                    <a class="dropdown-item" style="font-size:1.25rem;padding:0.3rem 1.5rem;" href="<?php echo base_url()  ?>halaman/detail/produksi-bibit">Produksi Bibit</a>
                                    <a class="dropdown-item" style="font-size:1.25rem;padding:0.3rem 1.5rem;" href="<?php echo base_url()  ?>halaman/detail/distribusi-bibit">Distribusi Bibit</a>
                                </div>
                                </li>
                            <li><a href="<?php echo base_url() ?>halaman/detail/kontak-kami">Kontak</a></li>
                        </ul>
						<!--
                        <p class='populer'><b>Trending :</b> 
                            < ?php
                                $jumlah_tampil = 6;
                                $tag_populer = $this->db->query("SELECT group_concat(a.tag_seo separator ',') as tag_populer FROM(SELECT * FROM `tagpro` ORDER BY count DESC LIMIT 15) as a")->row_array();
                                $random_keys=array_rand(explode(',',$tag_populer['tag_populer']),$jumlah_tampil);
                                for ($i=0; $i < $jumlah_tampil; $i++) { 
                                    $tag_seo = explode(',',$tag_populer['tag_populer'])[$random_keys[$i]];
                                    echo "<a href='".base_url()."produk?f=0&s=$tag_seo'>#$tag_seo</a>";
                                }
                            ?>
                        </p>
						-->
                    </div>
                    <div class="header__right">
                        
                        <div class="header__actions">
                            <form class="ps-form--quick-search" style='margin:0 0px;' id="filter" action="<?php echo base_url() ?>produk" method="GET">
                                <input class="form-control" name='s' value='<?= cetak($_GET['s']); ?>' type="text" placeholder="Search..." autocomplete='off' required><i class="fa fa-search" id="filtersubmit" aria-hidden="true"></i>
                            </form>
                            <!-- <a class="header__extra" href="#"><i class="icon-chart-bars"></i><span><i>0</i></span></a> -->
                            <a class="header__extra" href="#" data-toggle="modal" data-target=".bd-example-modal-lg" style='margin:0 10px;width:20px;'><i style='font-size:20px;' class="icon-user"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php // include "main-menu.php"; ?>
        </header>
    <?php } ?>
    <!-- <div style="padding-top:70px;"></div> -->
    <?php
    if ($this->uri->segment('1') == 'produk' and $this->uri->segment('2') == 'detail') {
        include "mobile/produk_detail.php";
    } else {
        include "mobile/home.php";
    }

    if ($this->uri->segment('1') != 'main' && $this->uri->segment('1')) {
        ?>
        <div class="mt-80 no-mobile"></div>
        <div class="heading-content">
            <p>KPH Kalimantan Selatan</p>
            <h2>
                <?= ($this->uri->segment('1') == 'berita' and $this->uri->segment('2') == 'detail') ? 'Detail Berita' : (($this->uri->segment('1') == 'produks' and $this->uri->segment('2') == '') ? 'Semua Produk' : $title) ?>
            </h2>
        </div>
        <?php
        echo $contents;
    }else{
        echo $contents;
    }
    if($this->uri->segment('1') == "auth" || $this->uri->segment('1') == "members"){}
    else if(empty($this->uri->segment('1')) || $this->uri->segment('1') == "main"){
        echo '<div class="mt-50" style="margin:0">
        <div class="top-footer">
            <p>Link Terkait:</p>
            <ul>
                <li><a href="#">kalselprov.go.id</a></li>
                <li><a href="#">menlhk.go.id</a></li>
                <li><a href="#">sipongi.menlhk.go.id</a></li>
                <li><a href="#">iklim.kalsel.bmkg.go.id</a></li>
            </ul>
        </div>
    </div>';
    }else{
        echo '<div style="margin-top:50px"></div><div class="top-footer no-mobile" style="bottom:430px;">
        <p>Link Terkait:</p>
        <ul>
            <li><a href="#">kalselprov.go.id</a></li>
            <li><a href="#">menlhk.go.id</a></li>
            <li><a href="#">sipongi.menlhk.go.id</a></li>
            <li><a href="#">iklim.kalsel.bmkg.go.id</a></li>
        </ul>
    </div>';
    }

    
    include "footer.php";
    $this->model_utama->kunjungan();

    if ($this->uri->segment(1) == 'main' or $this->uri->segment(1) == '') {
        if (get_cookie('notshow') == '') {
            $pop = $this->db->query("SELECT * FROM iklanatas ORDER BY id_iklanatas DESC LIMIT 1")->row_array();
            if ($pop['username'] == 'Y') {
                if ($this->session->id_konsumen == '') {
    ?>
                    <div class="ps-popup" id="subscribe" data-time="500">
                        <div class="ps-popup__content bg--cover" data-background="<?php echo base_url(); ?>/asset/foto_iklanatas/<?php echo $pop['gambar']; ?>"><a class="ps-popup__close" href="#"><i class="icon-cross"></i></a>
                            <form class="ps-form--subscribe-popup" action="<?php echo base_url() ?>main/subscribe" method="POST">
                                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
								<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                                <div class="ps-form__content">  
								  <div class="form-group">
									<div class="ps-checkbox">
                                        <input class="form-control" type="checkbox" id="not-show" name="notshow">
                                        <label for="not-show">Jangan Tampilkan lagi Form ini.</label>
                                    </div>
								  </div>
								</div>	 
								<!--	
								<div class="ps-form__content">	
									
									<h4>< ?php echo $pop['judul']; ?></h4>
                                    <p>< ?php echo $pop['url']; ?></p>
                                    <div class="form-group">
                                        <input class="form-control" type="email" name='email' placeholder="Email Address" autocomplete='off' required>
                                        
										<div class="ps-checkbox">
                                            <input class="form-control" type="checkbox" id="not-show" name="notshow">
                                            <label for="not-show">Jangan Tampilkan lagi Form ini.</label>
                                        </div><br>
                                        <button type='submit' name='submit' class="ps-btn">Subscribe</button>
                                    </div>
									
                                </div>-->
                            </form>
                        </div>
                    </div>
    <?php }
            }
        }
    } ?>

    <div id="back2top"><i class="pe-7s-angle-up"></i></div>
    <div class="ps-site-overlay"></div>
    <!--<div id="loader-wrapper">
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>-->
    <div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
        <div class="ps-search__content">
            <form class="ps-form--primary-search" action="do_action" method="post">
                <input class="form-control" type="text" placeholder="Search for...">
                <button><i class="aroma-magnifying-glass"></i></button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center style='padding:30px 30px'>
                    <h3>Hapus Barang ?</h3>
                    Barang ini akan dihapus dari keranjangmu.
                    <div><br>
                        <input type="hidden" name="product_code_delete" id="product_code_delete" class="form-control">
                        <button type="button" style='width:130px' class="ps-btn ps-btn--outline" data-dismiss="modal">Kembali</button>
                        <button type="button" style='width:130px' type="submit" id="btn_delete" class="ps-btn">Hapus Barang</button>
                    </div>
                </center>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="Modal_Notif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center style='padding:30px 30px'>
                    <h3>Error Notifikasi</h3>
                    <div id='error_notif'></div>
                    <div><br>
                        <button type="button" style='width:130px' class="ps-btn ps-btn--outline" data-dismiss="modal">Kembali</button>
                        <button type="button" style='width:130px' type="button" class="ps-btn" data-dismiss="modal">Coba Lagi!</button>
                    </div>
                </center>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="myModal-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <div style='padding:30px 30px'>
                <div class="content-body"></div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Notifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Produk Berhasil Disimpan!
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="myModalDetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style='padding:10px'>
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myModalLabel">Informasi Detail</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <div class="content-body"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/bootstrap4/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/masonry.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/isotope.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery.matchHeight-min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/slick/slick/slick.min.js"></script>

    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/slick-animation.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/lightGallery-master/dist/js/lightgallery-all.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/sticky-sidebar/dist/sticky-sidebar.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/plugins/select2/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <!-- custom scripts-->

    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>asset/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/jquery.uploadfile.min.js"></script>
    <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/js/main.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxflHHc5FlDVI-J71pO7hM1QJNW1dRp4U&amp;region=GB"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            show_cart();
            show_cart_detail();
            function show_cart(){
                $.ajax({
                    url   : '<?php echo site_url("produk/read_query"); ?>',
                    type  : 'GET',
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        var html = '';
                        var html_button = '';
                        var html_cart = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            var foto_all = data[i].gambar;
                            if (foto_all !== null) {
                                var strArray = foto_all.split(";");
                                var foto_produk = strArray[0];
                            }else{
                                var foto_produk = 'no-image.png';
                            }
                            $sub_total = ((data[i].harga_jual - data[i].diskon) * data[i].jumlah);
                            html += '<div class="ps-product--cart-mobile">'+
                                    '<div class="ps-product__thumbnail"><a href="<?php echo base_url(); ?>produk/detail/'+data[i].produk_seo+'"><img src="<?php echo base_url(); ?>asset/foto_produk/'+foto_produk+'" alt="'+data[i].nama_produk+'"></a></div>'+
                                    '<div class="ps-product__content">'+
                                    '<a href="javascript:void(0);" class="ps-product__remove item_delete" style="cursor:pointer" data-product_code="'+data[i].id_penjualan_detail+'"><i class="icon-cross"></i></a>'+
                                    '<a href="<?php echo base_url(); ?>produk/detail/'+data[i].produk_seo+'">'+data[i].nama_produk+'</a>'+
                                    '<p style="border-bottom:1px dotted #cecece"><b>Qty.</b> <small>'+data[i].jumlah+' x <b>'+toDuit(data[i].harga_jual - data[i].diskon)+'</b></small></p>'+
                                    '</div>'+
                                    '</div>';
                        }

                        if (data.length==0){
                            html += '<center style="padding:10px 15px">'+
                                    '<img style="width:90px" src="<?php echo base_url(); ?>asset/images/shopping-empty.png"><hr>'+
                                    '<h4>Wah keranjang belanjaanmu kosong!</h4>'+
                                    'Daripada dianggurin, mending isi dengan barang-barang impianmu. Yuk, cek sekarang!<br>'+
                                    '</center>';

                            html_button += '<figure><a style="padding:5px 20px; font-size:14px" class="ps-btn ps-btn--fullwidth" href="<?php echo base_url(); ?>produk">Mulai Belanja</a></figure>';
                        }else{
                            html_button += '<figure><a style="padding:5px 20px; font-size:14px" class="ps-btn ps-btn--fullwidth" href="<?php echo base_url(); ?>produk">Belanja Lagi</a></figure>';
                        }

                            html_cart += data.length;

                        $('.show_cart').html(html);
                        $('.show_cart_button').html(html_button);
                        $('.show_cart_count').html(html_cart);
                    }
                });
            } 

            $("#form1").validate({
                rules: {
                    variasi_1: "required",
                    variasi_2: "required",
                    variasi_3: "required",
                },
                messages: {
                    variasi_1: "Pilihan ini tidak boleh kosong!",
                    variasi_2: "Pilihan ini tidak boleh kosong!",
                    variasi_3: "Pilihan ini tidak boleh kosong!",
                }
            })

            $('.add-to-cart').on('click',function(){
                $("#form1").valid();
                if ($("#form1").valid()==true){
                    var id = $(this).attr("id");
                    var var1 = $('#var1').val();
                    var var2 = $('#var2').val();
                    var var3 = $('#var3').val();

                    var qty = $('#qty').val();
                    var group = $('#group').val();
                    var kgroup = $('#kgroup').val();
                    var $this = $(this);
                    var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Process...';
                    if ($(this).html() !== loadingText) {
                        $this.data('original-text', $(this).html());
                        $this.html(loadingText);
                    }
                    setTimeout(function() {
                    $this.html($this.data('original-text'));
                    }, 2000);

                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('produk/cart') ?>",
                        dataType: "json",
                        data: {
                            id: id, qty:qty, var1:var1, var2:var2, var3:var3, group:group, kgroup:kgroup
                        },
                        success: function(data) {
                            // if(data==true){
                                show_cart();
                                $(".m1keranjangx").hide().load(" .m1keranjangx").fadeIn();
                                window.location.replace("<?= site_url('produk/keranjang') ?>");
                            // }else{
                            //     $('#Modal_Notif').modal('show');
                            //     $('#error_notif').html(data.pesan);
                            // }
                        },
                    });
                    return false;
                }
            });

            //get data for delete record
            $('.show_cart').on('click','.item_delete',function(){
                var product_code = $(this).data('product_code');
                $('#Modal_Delete').modal('show');
                $('[name="product_code_delete"]').val(product_code);
            });

            //delete record to database
            $('#btn_delete').on('click',function(){
                var id = $('#product_code_delete').val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo site_url('produk/cart_remove')?>",
                    dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                        $('[name="product_code_delete"]').val("");
                        $('#Modal_Delete').modal('hide');
                        show_cart();
                        show_cart_detail();
                    }
                });
                // $('.item_delete').on('click', function() {
                //     show_cart_detail();
                // });
                return false;
            });

            $('.add-to-cart-empty').on('click', function() {
                var $this = $(this);
                var loadingText = '<i class="fa fa-remove text-danger"></i> Habis Terjual...';
                if ($(this).html() !== loadingText) {
                $this.data('original-text', $(this).html());
                $this.html(loadingText);
                }
                setTimeout(function() {
                $this.html($this.data('original-text'));
                }, 2000);
            });

            function split_data(nama,variasi,nomor) {
				if (nama != null) {
					var strArray = nama.split("||");
                    var variasiArray = variasi.split("||");
                    if (strArray.length>0){
                        var data_file = '';
                        no = 1;
                        for(var i = 0; i < strArray.length; i++){
                            if (no%2 == 1){ bg = '#ececec'; }else{ bg = '#f4f4f4'; }
                            data_file += '<div style="background:'+bg+'"><div style="min-width:50px; display:inline-block"><b>'+strArray[i]+'</b></div> : '; 
                            var variasiArraysplit = variasiArray[i].split(";");
                            for(var ii = 0; ii < variasiArraysplit.length; ii++){
                                data_file += '<input type="checkbox" value="variasi'+no+''+ii+''+nomor+'|'+strArray[i]+':'+variasiArraysplit[ii]+'" name="variasi'+no+''+ii+''+nomor+'" style="height:1em"> '+variasiArraysplit[ii]+' &nbsp; '
                            }
                            data_file += '</div>'; 
                            no++;
                        }
                    }
					return data_file;
				}else{
					return '';
				}
			}
            
            function show_cart_detail(){
                $.ajax({
                    url   : '<?php echo site_url("produk/read_query"); ?>',
                    type  : 'GET',
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        var html = '';
                        var html_button = '';
                        var html_cart = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            var foto_all = data[i].gambar;
                            var catatan = data[i].keterangan_order;

                            if (foto_all !== null) {
                                var strArray = foto_all.split(";");
                                var foto_produk = strArray[0];
                            }else{
                                var foto_produk = 'no-image.png';
                            }

                            if (catatan !== null &&  catatan !== '') {
                                var catatanArray = catatan.split("||");
                                // var catatan_order = catatanArray[0];
                                if (catatanArray[1]==undefined){
                                    variasi = '<b>Variasi :</b> '+catatanArray[0];
                                    variasi1 = '';
                                }else{
                                    variasi = '<b>Variasi :</b> '+catatanArray[1];
                                    variasi1 = catatanArray[0];
                                }
                            }else{
                                // var catatan_order = '';
                                variasi = '';
                                variasi1 = '';
                            }

                            if (data[i].pre_order !== null && data[i].pre_order > 0){
                                var pre_order = '<span class="badge badge-secondary">Pre-order '+data[i].pre_order+' Hari</span>';
                            }else{
                                var pre_order = '';
                            }

                            $sub_total = ((data[i].harga_jual - data[i].diskon) * data[i].jumlah);
                            html += '<input type="hidden" name="id'+(i+1)+'" value="'+data[i].id_penjualan_detail+'"> '+
                                    '<input type="hidden" name="idp'+(i+1)+'" value="'+data[i].id_produk+'"> '+
                                    '<div class="ps-product--cart-mobile" style="padding: 10px 0">'+
                                    '<div class="ps-product__thumbnail"><a href="<?php echo base_url(); ?>produk/detail/'+data[i].produk_seo+'"><img src="<?php echo base_url(); ?>asset/foto_produk/'+foto_produk+'" alt="'+data[i].nama_produk+'"></a></div>'+
                                    '<div class="ps-product__content">'+
                                    '<a href="javascript:void(0);" class="ps-product__remove item_delete" style="cursor:pointer" data-product_code="'+data[i].id_penjualan_detail+'" ><i class="icon-cross"></i></a>'+
                                    '<p style="margin-bottom:0"> '+data[i].nama_reseller+' '+pre_order+' </p>'+
                                    '<a href="<?php echo base_url(); ?>produk/detail/'+data[i].produk_seo+'"><span style="font-size:17px; display:block; border-bottom:1px solid">'+data[i].nama_produk+'</span></a>'+
                                    '<p style="border-bottom:1px dotted #cecece; margin-bottom:0px"><b>Qty.</b> <small><input type="number" class="qty_update qty" min="1" id="'+data[i].id_produk+'" name="qty'+(i+1)+'" value="'+data[i].jumlah+'" style="display:inline-block; margin-bottom:3px; width:50px; text-align: center; " autocomplete="off"> x <b>'+toDuit(data[i].harga_jual - data[i].diskon)+'</b></small></p> '+variasi+
                                    // '<div style="padding:3px 0px">'+split_data(data[i].nama,data[i].variasi,(i+1))+' </div>'+
                                    '<input type="text" name="keterangan'+(i+1)+'" style="display:inline-block; margin-bottom:3px; width:100%; border:1px dotted #cecece" placeholder="Tulis Catatan untuk Penjual ('+data[i].nama_reseller+')..." value="'+variasi1+'" autocomplete="off">'+
                                    '</div>'+
                                    '</div>';
                        }

                        if (data.length<=0){
                            $(".keranjang-all").hide().load(" .keranjang-all").fadeIn();
                        }else{
                            $(".keranjang-page").hide().load(" .keranjang-page").fadeIn();
                        }
                        $('.show_cart_detail').html(html);
                    }
                });
            } 

            //get data for delete record
            $('.show_cart_detail').on('click','.item_delete',function(){
                var product_code = $(this).data('product_code');
                $('#Modal_Delete').modal('show');
                $('[name="product_code_delete"]').val(product_code);
            });

        });

        $(document).ready(function() {
            $(function() {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 400) {
                        $('#Back-to-top').fadeIn();
                    } else {
                        $('#Back-to-top').fadeOut();
                    }
                });
                $('#Back-to-top').click(function() {
                    $('body,html')
                        .animate({
                            scrollTop: 0
                        }, 300)
                        .animate({
                            scrollTop: 40
                        }, 200)
                        .animate({
                            scrollTop: 0
                        }, 130)
                        .animate({
                            scrollTop: 15
                        }, 100)
                        .animate({
                            scrollTop: 0
                        }, 70);
                });
            });

            $('#editor1').summernote({
                height: "300px",
                callbacks: {
                    onImageUpload: function(image) {
                        uploadImage(image[0]);
                    },
                    onMediaDelete: function(target) {
                        deleteImage(target[0].src);
                    }
                }
            });

            function uploadImage(image) {
                var data = new FormData();
                data.append("image", image);
                $.ajax({
                    url: "<?php echo site_url('members/upload_image') ?>",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    type: "POST",
                    success: function(url) {
                        $('#editor1').summernote("insertImage", url);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

            function deleteImage(src) {
                $.ajax({
                    data: {
                        src: src
                    },
                    type: "POST",
                    url: "<?php echo site_url('members/delete_image') ?>",
                    cache: false,
                    success: function(response) {
                        console.log(response);
                    }
                });
            }
        });
    </script>
    <script>
        function removecart(id, data2) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('produk/cart_remove') ?>",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data) {
                    $(".remove-" + id).hide().load(" .remove-" + id).fadeIn();
                    $(".keranjang").hide().load(" .keranjang").fadeIn();
                    $(".keranjangx").hide().load(" .keranjangx").fadeIn();

                    $(".m1keranjangx").hide().load(" .m1keranjangx").fadeIn();
                }
            });
            return false;
        }
    </script>
    <script src="<?php echo base_url(); ?>asset/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function() {
            // Summernote
            $('#editor1').summernote()
        })

        $(".formatNumber").on('keyup', function() {
            var n = parseInt($(this).val().replace(/\D/g, ''), 10);
            $(this).val(n.toLocaleString());
        });
        $(document).ready(function() {
            $('#state').change(function() {
                var state_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('auth/city'); ?>",
                    data: "stat_id=" + state_id,
                    success: function(response) {
                        $('#city').html(response);
                    }
                })
            })
        })

        $(document).ready(function() {
            $('#state_reseller').change(function() {
                var state_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('auth/city'); ?>",
                    data: "stat_id=" + state_id,
                    success: function(response) {
                        $('#city_reseller').html(response);
                    }
                })
            })
        })

        function toDuit(number) {
            var number = number.toString(),
                duit = number.split('.')[0],
                duit = duit.split('').reverse().join('')
                .replace(/(\d{3}(?!$))/g, '$1,')
                .split('').reverse().join('');
            return 'Rp ' + duit;
        }

        function toRupiah(number) {
            var number = number.toString(),
                duit = number.split('.')[0],
                duit = duit.split('').reverse().join('')
                .replace(/(\d{3}(?!$))/g, '$1,')
                .split('').reverse().join('');
            return duit;
        }

        $('#filtersubmit').click(function() {
            $("#filter").submit();
        });


        $(function() {
            $("#example1").DataTable({
                "bSortable": false,
                "lengthChange": false,
                "pageLength": 20,
                "oLanguage": {
                    "sSearch": "Pencarian "
                }
            });
            $("#example11").DataTable({
                "bSortable": false,
                "lengthChange": false,
                "pageLength": 20,
                "oLanguage": {
                    "sSearch": "Pencarian "
                }
            });
            $("#example12").DataTable({
                "bSortable": false,
                "lengthChange": false,
                "pageLength": 20,
                "oLanguage": {
                    "sSearch": "Pencarian "
                }
            });
            $("#example13").DataTable({
                "bSortable": false,
                "lengthChange": false,
                "pageLength": 20,
                "oLanguage": {
                    "sSearch": "Pencarian "
                }
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });

            $('#example3').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "info": true,
                "autoWidth": false,
                "pageLength": 10,
                "order": [
                    [4, "desc"]
                ]
            });
        });

        function save(id, data2) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('produk/save') ?>",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data) {
                    $(".produk-" + id).hide().load(" .produk-" + id).fadeIn();
                    $("#exampleModalCenter").modal('show');
                    $(".wishlistcount").hide().load(" .wishlistcount").fadeIn();
                }
            });
            return false;
        }

        $(function() {
            $(document).on('click', '.quick_view', function(e) {
                e.preventDefault();
                $("#myModalDetail").modal('show');
                $.post("<?php echo site_url() ?>produk/quick_view", {
                        id: $(this).attr('data-id')
                    },
                    function(html) {
                        $(".content-body").html(html);
                    }
                );
            });
        });
    </script>


    <script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#multiple_select').multiselect({
                enableClickableOptGroups: true,
                enableCollapsibleOptGroups: true,
                enableFiltering: true,
                includeSelectAllOption: false,
                maxHeight: 300,
                enableCaseInsensitiveFiltering: true,
                buttonWidth: '99%',
                numberDisplayed: 6
            });

            $('#multiple_select2').multiselect({
                enableClickableOptGroups: true,
                enableCollapsibleOptGroups: true,
                enableFiltering: true,
                includeSelectAllOption: false,
                maxHeight: 200,
                enableCaseInsensitiveFiltering: true
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            //* select Provinsi */
            var base_url    = "<?php echo base_url();?>";
            $("#list_provinsi").change(function(){
                var id_province = this.value;
                kota(id_province);
                $("#div_kota").show();
            });

            /* select Kota */
            kota = function(id_province){
                $.ajax({
                type: 'post',
                url: base_url + 'produk/rajaongkir_get_kota',
                data: {id_province:id_province},
                dataType  : 'html',
                success: function (data) {
                    $("#list_kotakab").html(data);
                },
                beforeSend: function () {
                    
                },
                complete: function () {
                
                }
            });
            }

            $("#list_kotakab").change(function(){
                var id_kota = this.value;
                kecamatan(id_kota);
                $("#div_kecamatan").show();
            });

            kecamatan = function(id_kota){
                $.ajax({
                type: 'post',
                url: base_url + 'produk/rajaongkir_get_kecamatan',
                data: {id_kota:id_kota},
                dataType  : 'html',
                success: function (data) {
                    $("#list_kecamatan").html(data);
                }
            });
            }
        });
    </script>

    <script>
        $(document).ready(()=> {
            'use strict';

                var owl = $('.owl-carousel'),
                    item,
                    itemsBgArray = [], // to store items background-image
                    itemBGImg;
            
                owl.owlCarousel({  
                    items: 1,
                    smartSpeed: 1000,
                    autoplay: true,
                    autoplayTimeout: 8000,
                    autoplaySpeed: 1000,
                    loop: true,
                    nav: true,
                    navText: false,
                    onTranslated: function () {
                        changeNavsThump();
                    }
                });
            
                $('.active').addClass('anim');
            
                var owlItem = $('.owl-item'),
                    owlLen = owlItem.length;
                /* --------------------------------
                * store items bg images into array
                --------------------------------- */
                $.each(owlItem, function( i, e ) {
                    itemBGImg = $(e).find('.owl-item-bg').attr('src');
                    itemsBgArray.push(itemBGImg);
                });
                /* --------------------------------------------
                * nav control thump
                * nav control icon
                --------------------------------------------- */
                var owlNav = $('.owl-nav'),
                    el;
                
                $.each(owlNav.children(), function (i,e) {
                    el = $(e);
                    // append navs thump/icon with control pattern(owl-prev/owl-next)
                    el.append('<div class="'+ el.attr('class').match(/owl-\w{4}/) +'-thump">');
                    el.append('<div class="'+ el.attr('class').match(/owl-\w{4}/) +'-icon">');
                });
                
                /*-------------------------------------------
                Change control thump on each translate end
                ------------------------------------------- */
                function changeNavsThump() {
                    var activeItemIndex = parseInt($('.owl-item.active').index()),
                        // if active item is first item then set last item bg-image in .owl-prev-thump
                        // else set previous item bg-image
                        prevItemIndex = activeItemIndex != 0 ? activeItemIndex - 1 : owlLen - 1,
                        // if active item is last item then set first item bg-image in .owl-next-thump
                        // else set next item bg-image
                        nextItemIndex = activeItemIndex != owlLen - 1 ? activeItemIndex + 1 : 0;
                    
                    $('.owl-prev-thump').css({
                        backgroundImage: 'url(' + itemsBgArray[prevItemIndex] + ')'
                    });
                    
                    $('.owl-next-thump').css({
                        backgroundImage: 'url(' + itemsBgArray[nextItemIndex] + ')'
                    });
                }
                changeNavsThump();
                
            });
    </script>

    <script>
        <?php 
             if ($this->uri->segment('1') == 'main' || empty($this->uri->segment('1'))) {
        ?>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: 'Rehapdas IPPKH',
                    data: [14, 23, 45, 71, 32, 35, 40],
                    fill: false,
                    borderColor: '#FF7A00',
                    tension: 0.1
                },{
                    label: 'IUPHHK_HTI',
                    data: [65, 59, 65, 81, 56, 56, 20],
                    fill: false,
                    borderColor: '#7E36F3',
                    tension: 0.1
                },{
                    label: 'RHL KTH',
                    data: [35, 55, 60, 82, 51, 57, 30],
                    fill: false,
                    borderColor: '#EFAEE5',
                    tension: 0.1
                },{
                    label: 'Perhutanan Sosial',
                    data: [55, 53, 75, 73, 53, 58, 10],
                    fill: false,
                    borderColor: '#C5EDFF',
                    tension: 0.1
                },{
                    label: 'Penghijauan Lingkungan',
                    data: [85, 50, 80, 85, 52, 51, 50],
                    fill: false,
                    borderColor: '#11BBA3',
                    tension: 0.1
                }]
            },options: {
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Revolusi Hijau Update',
                        padding: {
                            top: 10,
                            bottom: 30
                        },
                        font: {
                            size: 24,
                            weight: 100,
                        }
                    }
                },
                legend: {
                    labels: {
                    usePointStyle: true,
                    boxWidth: 6
                    }
                }
            }
        });
        <?php } ?>
    </script>

    <!-- Go to www.addthis.com/dashboard to customize your tools  
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51875fc86c7648a1"></script> -->
    
</body>
</html>