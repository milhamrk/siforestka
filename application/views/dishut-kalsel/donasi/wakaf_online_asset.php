
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="<?php echo base_url()."donasi/wakaf_asset"; ?>">Wakaf</a></li>
            <li><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="ps-order-tracking">
    <div class="container">
        <div class="ps-section__header">
            <?php
              echo "<h3>$title</h3>";
              echo $this->session->flashdata('message'); 
                   $this->session->unset_userdata('message');
              echo "<p>Wakaf dalam bentuk Aset yang dapat dikelola secara produktif dan hasilnya dimanfaatkan oleh mauquf alaih.</p>";
            ?>
          </div>
        <div class="ps-section__content">
            <?php 
              $attributes = array('class'=>'ps-form--order-tracking');
              echo form_open_multipart('donasi/wakaf_asset',$attributes); 

              echo "<div class='form-group'><label>Pilih Type Wakaf *</label> <select class='form-control form-auth' name='jenis' required>";
                            $data = array('Bangunan','Pendidikan','Lainnya');    
                            for ($i=0; $i < count($data) ; $i++) { 
                                echo "<option value='".$data[$i]."'>".$data[$i]."</option>";
                            }    
                    echo "</select></div>
                    <div class='form-group'><label>Perkiraan Nilai Asset *</label>      <input type='number' name='nominal' style='font-size:20px' class='form-control form-auth font-weight-bold text-success' required></div>
                    <div class='form-group'><label>Alamat Asset *</label>               <input type='text' name='alamat' class='form-control form-auth' value='' required></div>
                    <div class='form-group'><label>Keterangan Asset *</label>           <textarea class='form-control form-auth' style='height:140px !important' name='keterangan'></textarea></div>

                    <div class='form-group'><label>Nama Lengkap *</label>               <input type='text' name='nama_lengkap' class='form-control form-auth text-success' required></div>
                    <div class='form-group'><label>No Handphone *</label>               <input type='number' name='no_handphone' class='form-control form-auth text-success' required></div>
                    <div class='form-group'><label>Alamat Email anda *</label>          <input type='email' name='alamat_email' class='form-control form-auth text-success' required></div>
                    
                    <div class='form-group'><label>File Upload *</label> <input class='form-control' type='file' name='f' required></div>
                    <div class='form-group'><label>Masukkan 2 Digit Terakhir Nomor HP Anda *</label> <input class='form-control form-auth' type='number' name='validasi' required></div>";
            ?>
                    <div class="form-group">
                        <button type='submit' name='submit' class="ps-btn ps-btn--fullwidth">Wakaf Sekarang</button>
                    </div>
            </form>
        </div>
    </div>
</div>