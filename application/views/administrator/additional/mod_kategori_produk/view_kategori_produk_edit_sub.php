<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Sub Kategori Produk</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_kategori_produk_sub',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_kategori_produk_sub]'>
                    <tr><th scope='row'>Kategori</th>                   <td><select name='b' class='form-control' required>
                                                                            <option value='' selected>- Pilih Kategori Produk -</option>";
                                                                            $kategori = $this->db->query("SELECT * FROM rb_kategori_produk");
                                                                            foreach ($kategori->result_array() as $row){
                                                                              if ($rows['id_kategori_produk']==$row['id_kategori_produk']){
                                                                                echo "<option value='$row[id_kategori_produk]' selected>$row[nama_kategori]</option>";
                                                                              }else{
                                                                                echo "<option value='$row[id_kategori_produk]'>$row[nama_kategori]</option>";
                                                                              }
                                                                            }
                    echo "</td></tr>
                    <tr><th width='140px' scope='row'>Nama Sub Kategori</th>    <td><input type='text' class='form-control' name='a' value='$rows[nama_kategori_sub]' required></td></tr>
                    <tr><th scope='row'>Kolom</th>    <td><select class='form-control' name='mkolom_sub'>";
                                                              $kolom = array('12','0');
                                                              for ($i=0; $i < count($kolom) ; $i++) { 
                                                                if ($rows['mkolom_sub']==$kolom[$i]){
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