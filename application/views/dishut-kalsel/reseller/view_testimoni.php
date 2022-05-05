<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><?php echo $title; ?></li>
        </ul>
    </div>
</div>
<div class="ps-section--shopping ps-shopping-cart">
    <div class="container">
        <div class="ps-section__content">
            <div class="table-responsive">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <?php 
                    echo $this->session->flashdata('message'); 
                    $this->session->unset_userdata('message');
                ?>
                    <figure>
                    <table class="table table-sm">
                      <tbody>
                      <?php
                        if ($this->session->id_konsumen != ''){
                          $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
                          echo form_open_multipart('testimoni',$attributes); 
                            echo "<tr><td colspan='2'><textarea name='testimoni' style='height:70px' class='required form-control' placeholder='Tulis Testimoni Disini...' required></textarea> <br> 
                                                      <button name='submit' class='ps-btn ps-btn--outline pull-right' type='submit'>Kirimkan Testimoni</button></td></tr>";
                          echo form_close();
                        }

                        $no = 0;
                        foreach ($record->result_array() as $row){
                        if (!file_exists("asset/foto_user/$row[foto]") OR $row['foto']==''){
                          $foto = "blank.png";
                        }else{
                          $foto = $row['foto'];
                        }

                        $tgl_posting = tgl_indo($row['tgl_posting']);
                        echo "<tr><td class='d-none d-sm-block'><img width='120px' class='rounded-circle' src='".base_url()."asset/foto_user/$foto'></td>
                                  <td><div style='border-radius:0px; padding:6px; margin-bottom:3px' class='alert alert-danger'><strong class='text-uppercase'>$row[nama_lengkap]</strong> <br><small>Dikirim. ".cek_terakhir($row['waktu_testimoni'])." Lalu / $row[waktu_testimoni]</small></div> 
                                  <img width='80px' style='margin-right:8px; height:80px' class='rounded-circle d-xl-none float-left' src='".base_url()."asset/foto_user/$foto'> $row[isi_testimoni]</td>
                              </tr>";
                          $no++;
                        }
                      ?>
                      </tbody>
                    </table>
                    </figure>
                </div>
            </div>
            <div class="ps-pagination">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
        <hr>

    </div>
</div>
