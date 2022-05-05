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
      <?php include "menu-members.php"; ?>
        <?php 
          echo $this->session->flashdata('message'); 
          $this->session->unset_userdata('message');
        ?>
        <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 ">
              <?php
                include "sidebar-members.php";
              ?><div style='clear:both'><br></div>
          </div>

          <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 "><br>
          <?php 
              $attributes = array('class'=>'biodata','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/tambah_withdraw',$attributes); 
          echo "<div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Saldo Anda</b></label>
                  <div class='col-sm-10'>
                  <input type='text' class='form-control form-mini' style='color:blue' value='".rupiah(saldo(reseller($this->session->id_konsumen),$this->session->id_konsumen))."' disabled>
                  </div>
                </div>

                <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Jenis Transaksi</b></label>
                  <div class='col-sm-10'>
                  <select name='jenis' id='jenis' class='form-control form-mini' required>
                    <option value='' selected>- Pilih -</option>";
                    $jenis = array('debit','kredit');
                    $jenis_text = array('Debit (Withdraw)','Kredit (Deposit)');
                    for ($i=0; $i < count($jenis); $i++) { 
                      echo "<option value='$jenis[$i]'>$jenis_text[$i]</option>";
                    }
                  echo "</select>
                  </div>
                </div>
                
                <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Ke Rekening</b></label>
                  <div class='col-sm-10'>
                  <select name='a' class='form-control form-mini' id='rekening' required>
                    <option value='' selected>- Pilih -</option>
                  </select>
                  </div>
                </div>"; 

                if (config('withdraw_fee')>0){
                  echo "<div class='form-group row' id='withdraw_fee' style='margin-bottom:5px'>
                  <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Biaya / Fee</b></label>
                    <div class='col-sm-10'>
                    <input style='color:red' type='text' class='form-control form-mini formatNumber' value='".rupiah(config('withdraw_fee'))."' disabled>
                    </div>
                  </div>";
                }

                echo "<div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Withdraw (Rp)</b></label>
                  <div class='col-sm-10'>
                  <input type='text' class='form-control form-mini formatNumber' name='b' value='0' required>
                  </div>
                </div>

                <br>
                <div class='box-footer'>
                  <button type='submit' name='submit' class='ps-btn spinnerButton'>Kirim Permintaan</button>
                  <button type='button' onclick=\"history.back()\" class='ps-btn ps-btn--black'>Cancel</button>
                </div>
              </div>
          
              </div>
              </div>
          </div>
      </div>";
?>
<script type="text/javascript">
	$(document).ready(function(){
    $("#withdraw_fee").hide();
    $("#jenis").change(function(){
    var jenis = $("#jenis").val();
    if (jenis=='debit'){
      $("#withdraw_fee").show();
    }else{
      $("#withdraw_fee").hide();
    }
        $.ajax({
          type: 'POST',
            url: "<?php echo base_url(); ?>members/rekening_pilih",
            data: {jenis: jenis},
            cache: false,
            success: function(msg){
              $("#rekening").html(msg);
            }
        });
    });
  });
</script>
