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
                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">
                  <?php
                    $attributes = array('id' => 'formku');
                    echo form_open_multipart('members/tambah_opini',$attributes); 
                  ?><div style='clear:both'><br></div>
                </div>

                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 ">
                <?php 
                    echo $this->session->flashdata('message'); 
                    $this->session->unset_userdata('message');
                ?>
                    <div class="ps-block--vendor-status biodata">
                        <?php 
                            echo "<p style='font-size:17px'>Hai <b>$row[nama_lengkap]</b>, selamat datang di halaman Opini Publik! <br>
                                                            Silahkan lengkapi data berikut untuk membuat opini publik.</p><br>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Judul</b></label>
                              <div class='col-sm-9'>
                              <input type='text' name='b' class='form-control form-mini' autocomplete='off' required>
                              </div>
                            </div>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Sub Judul</b></label>
                              <div class='col-sm-9'>
                              <input type='text' name='c' class='form-control form-mini' autocomplete='off'>
                              </div>
                            </div>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Video Youtube</b></label>
                              <div class='col-sm-9'>
                              <input type='text' name='d' class='form-control form-mini' autocomplete='off'>
                              </div>
                            </div>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Isi Berita</b></label>
                              <div class='col-sm-9'>
                              <textarea id='editor1' class='form-control' name='h' style='height:260px' required></textarea>
                              </div>
                            </div>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Gambar</b></label>
                              <div class='col-sm-9'>
                              <input type='file' name='k' class='form-control form-mini' autocomplete='off'>
                              </div>
                            </div>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Keterangan Gambar</b></label>
                              <div class='col-sm-9'>
                              <input type='text' name='i' class='form-control form-mini' autocomplete='off'>
                              </div>
                            </div>

                            <input type='hidden' name='id' value=''>
                            <input type='hidden' name='e' value='N'>
                            <input type='hidden' name='f' value='N'>
                            <input type='hidden' name='g' value='N'>
                            <input type='hidden' name='j[]'>
                            
                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Kategori</b></label>
                            <div class='col-sm-9'>
                              <div class='row'>
                                <div class='col'>
                                  <select class='form-control form-mini' name='a' id='' required>";
                                  echo "<option value=0>- Pilih Kategori -</option>";
                                    $kategori = $this->db->query("SELECT * FROM kategori ORDER BY id_kategori desc");
                                    foreach ($kategori->result_array() as $rows) {
                                        echo "<option value='$rows[id_kategori]'>$rows[nama_kategori]</option>";
                                    }
                                  echo "</select>
                                </div>
                              </div>
                              
                            </div>
                            
                            </div>
                            <button type='submit' name='submit' class='ps-btn btn-block spinnerButton'><center><i class='icon-pen'></i> Simpan</center></button>
                          </div>";
                          echo form_close();
                        ?>
                    </figure>
                </div>
              
            </div>
        </div>
    </div>
</div>
