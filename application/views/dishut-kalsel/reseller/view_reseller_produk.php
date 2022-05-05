

<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="<?php echo base_url(); ?>produk">Produk</a></li>
            <li><?php echo $rows['nama_reseller']; ?></li>
        </ul>
    </div>
</div>

<div class="ps-vendor-store">
    <div class="container">
        <div class="ps-section__container">
            <?php include "sidebar_pelapak.php"; ?>
            <div class="ps-section__right">
                <?php echo $this->session->flashdata('message'); 
              $this->session->unset_userdata('message'); ?>
              
                <div class="ps-block--vendor-filter">
                    <div class="ps-block__left">
                        <ul class="ps-tab-list">
                          <li><a href="#">Terdapat <strong><?php echo $record_hitung->num_rows(); ?></strong> Produk : </a></li>

                        </ul>
                    </div>
                    <div class="ps-block__right">
                        <form class="ps-form--search" action="#" method="get">
                            <input class="form-control" type="text" id='search_text' name='search_text' placeholder="Cari produk di Jualan ini,.">
                        </form>
                    </div>
                </div>
                
                <div class="ps-shopping ps-tab-root">
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="tab-1">
                            <div id='result'></div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
 load_data();
 function load_data(query){
  $.ajax({
   url:"<?php echo base_url(); ?>produk/reseller_cari_produk",
   method:"POST",
   data:{query:query,id:<?php echo cetak($rows['id_reseller']); ?>},
   success:function(data){
    $('#result').html(data);
   }
  })
 }

 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != ''){
   load_data(search);
  }else{
   load_data();
  }
 });
});
</script>

