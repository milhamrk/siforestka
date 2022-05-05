<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Kategori Produk</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_kategori_produk',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_kategori_produk]'>
                    <tr><th width='120px' scope='row'>Nama Kategori</th>    <td><input type='text' class='form-control' name='a' value='$rows[nama_kategori]' required></td></tr>
                    <tr><th scope='row'>Ganti Gambar</th>                 <td><input type='file' class='form-control' name='gambar'>";
                                                                               if ($rows['gambar'] != ''){ echo "<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_produk/$rows[gambar]'>$rows[gambar]</a>"; } echo "</td></tr>
                    <tr><th scope='row'>Urutan</th>    <td><input type='number' class='form-control' name='urutan' value='$rows[urutan]'></td></tr>
                    <tr><th scope='row'>Kolom</th>    <td><select class='form-control' name='mkolom'>";
                                                              $kolom = array('12','0');
                                                              for ($i=0; $i < count($kolom) ; $i++) { 
                                                                if ($rows['mkolom']==$kolom[$i]){
                                                                  echo "<option value='$kolom[$i]' selected>".($i+1)." Kolom</option>";
                                                                }else{
                                                                  echo "<option value='$kolom[$i]'>".($i+1)." Kolom</option>";
                                                                }
                                                              }
                                                              echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Icon Kode</th>    <td><input type='text' class='form-control' name='icon_kode' value='$rows[icon_kode]'></td></tr>
                    <tr><th scope='row'>Icon Image</th>                 <td><input type='file' class='form-control' name='icon_image'>";
                    if ($rows['icon_image'] != ''){ echo "<i style='color:red'>Icon Saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_produk/$rows[icon_image]'>$rows[icon_image]</a>"; } echo "</td></tr>
                    
                    </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='#' onclick=\"window.history.go(-1); return false;\"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";