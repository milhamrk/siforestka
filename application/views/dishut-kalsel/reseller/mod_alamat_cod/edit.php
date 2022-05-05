<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="#">Members</a></li>
                <li><?php echo $title; ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="ps-vendor-dashboard pro" style='margin-top:10px'>
    <div class="container">
      <div class="ps-section__content">
        <?php 
          echo $this->session->flashdata('message'); 
          $this->session->unset_userdata('message');
        ?>
        <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br>
      <?php 
        $attributes = array('class'=>'biodata','role'=>'form');
        echo form_open_multipart($this->uri->segment(1).'/edit_cod',$attributes); 
          echo "<input type='hidden' name='id' value='$rows[id_cod]'>
              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Nama Alamat</b></label>
                <div class='col-sm-10'>
                <input type='text' class='form-control form-mini' name='a' value='$rows[nama_alamat]' required>
                </div>
              </div>  

              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Tarif (Rp)</b></label>
                <div class='col-sm-10'>
                <input type='number' class='form-control form-mini' name='b' value='$rows[biaya_cod]' required>
                </div>
              </div> 
              <br>
              <div class='box-footer'>
                <button type='submit' name='submit' class='ps-btn margin-btn spinnerButton'>Update</button>
                <button type='button' onclick=\"history.back()\" class='ps-btn ps-btn--black margin-btn'>Cancel</button>
              </div>
            </div>
          
            </div>
            </div>
        </div>
    </div>";