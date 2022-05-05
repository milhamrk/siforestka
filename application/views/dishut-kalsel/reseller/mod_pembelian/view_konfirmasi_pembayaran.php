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
              echo form_open_multipart($this->uri->segment(1).'/konfirmasi_pembayaran',$attributes); 
          echo "<input type='hidden' name='id' value='".$this->uri->segment(3)."'>
                <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>No Invoice</b></label>
                  <div class='col-sm-10'>
                  <input type='text' class='form-control form-mini' name='a' value='$rows[kode_transaksi]' readonly='on' required>
                  </div>
                </div>  

                <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Total</b></label>
                  <div class='col-sm-10'>
                  <input type='text' class='form-control form-mini' name='b' value='Rp ".rupiah($total['total'])."' required>
                  </div>
                </div>  

                <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Transfer ke</b></label>
                  <div class='col-sm-10'>
                  <select name='c' class='form-control form-mini' required>";
                    foreach ($record->result_array() as $row){
                        echo "<option value='$row[id_rekening]'>$row[nama_bank] - $row[no_rekening], A/N : $row[pemilik_rekening]</option>";
                    }
                  echo "</select>
                  </div>
                </div>  

                <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Nama Pengirim</b></label>
                  <div class='col-sm-10'>
                  <input type='text' class='form-control form-mini' name='d' required>
                  </div>
                </div> 

                <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Tanggal Transfer</b></label>
                  <div class='col-sm-10'>
                  <input type='text' class='form-control form-mini' name='e' value='".date('Y-m-d')."' required>
                  </div>
                </div> 

                <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Bukti Transfer</b></label>
                  <div class='col-sm-10'>
                  <input type='file' class='form-control form-mini' name='f' required>
                  </div>
                </div> 
                <br>
              <div class='box-footer'>
                <button type='submit' name='submit' class='ps-btn'>Kirimkan</button>
                <button type='button' onclick=\"history.back()\" class='ps-btn ps-btn--black'>Cancel</button>
              </div>
            </div>
        
            </div>
            </div>
        </div>
    </div>";
