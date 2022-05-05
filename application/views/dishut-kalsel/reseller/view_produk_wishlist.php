<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="#">Members</a></li>
                <li>Whislist</li>
            </ul>
        </div>
    </div>
</div>
<div class="ps-vendor-dashboard pro" style='margin-top:10px'>
    <div class="container">
        <div class="ps-section__content">
            <?php include "menu-members.php"; ?>
   
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 ">
                    <?php
                      include "sidebar-members.php";
                    ?><div style='clear:both'><br></div>
                </div>

                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 ">
                    <figure class="ps-block--vendor-status biodata">
                        <div id='wishlist_produk'></div>
                    </figure>
                </div>
              
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#wishlist_produk').load("<?php echo base_url(); ?>members/wishlist_update");
    setInterval(function(){
        $('#wishlist_produk').load("<?php echo base_url(); ?>members/wishlist_update").fadeIn('slow');
    },5000);
});
</script>