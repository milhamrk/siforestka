<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="#">Members</a></li>
                <li>Profile</li>
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
                    $attributes = array('id' => 'formku');
                    echo form_open_multipart('members/edit_profile',$attributes); 
                    if (trim($row['foto'])=='' OR !file_exists("asset/foto_user/".$row['foto'])){
                      echo "<img class='img-thumbnail' style='width:100%' src='".base_url()."asset/foto_user/blank.png'>";
                    }else{
                      echo "<img class='img-thumbnail' style='width:100%' src='".base_url()."asset/foto_user/$row[foto]'>";
                    }
                    echo "<input class='required number form-control form-mini' type='file' name='foto'><small><center>Allowed : gif, jpg, png, jpeg (Max 1 MB)</center></small><br>
                    <button type='submit' name='submit' class='ps-btn btn-block spinnerButton'><center><i class='icon-pen'></i> Simpan Perubahan</center></button>";
                  ?><div style='clear:both'><br></div>
                </div>

                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 ">
                <?php 
                    echo $this->session->flashdata('message'); 
                    $this->session->unset_userdata('message');
                ?>
                    <div class="ps-block--vendor-status biodata">
                        <?php 
                            echo "<p style='font-size:17px'>Hai <b>$row[nama_lengkap]</b>, selamat datang di halaman Biodata diri! <br>
                                                            Pastikan data profil sesuai dengan KTP untuk kemudahan dalam bertransaksi.</p><br>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Username</b></label>
                              <div class='col-sm-9'>
                              <input type='text' name='aa' class='form-control form-mini' value='$row[username]' autocomplete='off' onkeyup=\"nospaces(this)\" readonly>
                              </div>
                            </div>
                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Password</b></label>
                              <div class='col-sm-9'>
                              <input type='text' name='a' class='form-control form-mini' placeholder='**************' onkeyup=\"nospaces(this)\">
                              </div>
                            </div>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Nama Lengkap</b></label>
                              <div class='col-sm-9'>
                              <input type='text' name='b' class='form-control form-mini' value='$row[nama_lengkap]' autocomplete='off' required>
                              </div>
                            </div>
                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Jenis Kelamin</b></label>
                              <div class='col-sm-9'>"; 
                              if ($row['jenis_kelamin']=='Laki-laki'){ echo "<input type='radio' value='Laki-laki' name='d' checked> Laki-laki <input type='radio' value='Perempuan' name='d'> Perempuan "; }else{ echo "<input type='radio' value='Laki-laki' name='d'> Laki-laki <input type='radio' value='Perempuan' name='d' checked> Perempuan "; } 
                              echo "</div>
                            </div>
                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Email</b></label>
                              <div class='col-sm-9'>
                              <input type='text' name='c' class='form-control form-mini' value='$row[email]' onkeyup=\"nospaces(this)\" autocomplete='off' required>
                              </div>
                            </div>
                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>No Hp</b></label>
                            <div class='col-sm-9'>
                              <input type='text' name='l' class='form-control form-mini' value='$row[no_hp]' onkeyup=\"nospaces(this)\" autocomplete='off' required>
                            </div>
                            </div>
                            
                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Tempat/Tanggal Lahir</b></label>
                              <div class='col-sm-9'>
                              <div class='row'>
                                <div class='col'>
                                <input type='text' name='f' class='form-control form-mini' value='".($row['tempat_lahir'] == '' ? '-' : $row['tempat_lahir'])."' autocomplete='off'>
                                </div>
                                <div class='col'>
                                <input type='text' name='e' class='form-control form-mini ps-datepicker' value='".($row['tanggal_lahir'] == '0000-00-00' ? date('m/d/Y') : tgl($row['tanggal_lahir']))."' autocomplete='off'>
                                </div>
                              </div>
                              </div>
                            </div>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Alamat Pengiriman</b></label>
                              <div class='col-sm-9'>
                              <input type='text' name='g' class='form-control form-mini' value='$row[alamat_lengkap]' autocomplete='off' required>
                              </div>
                            </div>
                            
                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Daerah Pengiriman</b></label>
                            <div class='col-sm-9'>
                              <div class='row'>
                                <div class='col'>
                                  <select class='form-control form-mini' name='provinsi_id' id='list_provinsi' required>";
                                  echo "<option value=0>- Pilih Provinsi -</option>";
                                    $provinsi = $this->db->query("SELECT * FROM tb_ro_provinces ORDER BY province_name ASC");
                                    foreach ($provinsi->result_array() as $rows) {
                                      if ($row['provinsi_id']==$rows['province_id']){
                                        echo "<option value='$rows[province_id]' selected>$rows[province_name]</option>";
                                      }else{
                                        echo "<option value='$rows[province_id]'>$rows[province_name]</option>";
                                      }
                                    }
                                  echo "</select>
                                </div>
                                <div class='col'>
                                  <select class='form-control form-mini' name='kota_id' id='list_kotakab' required>";
                                  echo "<option value=0>- Pilih Kota / Kabupaten -</option>";
                                  $kota = $this->db->query("SELECT * FROM tb_ro_cities where province_id='$row[provinsi_id]' ORDER BY city_name ASC");
                                    foreach ($kota->result_array() as $rows) {
                                      if ($row['kota_id']==$rows['city_id']){
                                        echo "<option value='$rows[city_id]' selected>$rows[city_name]</option>";
                                      }else{
                                        echo "<option value='$rows[city_id]'>$rows[city_name]</option>";
                                      }
                                    }
                                  echo "</select>
                                </div>
                                <div class='col'>
                                  <select class='form-control form-mini' name='kecamatan_id' id='list_kecamatan' required>";
                                  echo "<option value=0>- Pilih Kecamatan -</option>";
                                    $subdistrict = $this->db->query("SELECT * FROM tb_ro_subdistricts where city_id='$row[kota_id]' ORDER BY subdistrict_name ASC");
                                    foreach ($subdistrict->result_array() as $rows) {
                                      if ($row['kecamatan_id']==$rows['subdistrict_id']){
                                        echo "<option value='$rows[subdistrict_id]' selected>$rows[subdistrict_name]</option>";
                                      }else{
                                        echo "<option value='$rows[subdistrict_id]'>$rows[subdistrict_name]</option>";
                                      }
                                    }
                                  echo "</select>
                                </div>
                              </div>
                            </div>
                            </div>
                          </div>";
                          echo form_close();
                        ?>
                    </figure>
                </div>
              
            </div>
        </div>
    </div>
</div>
