<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Banner Link</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_banner',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_banner]'>
                    <tr><th width='120px' scope='row'>Judul</th>    <td><input type='text' class='form-control' name='a' value='$rows[judul]' required></td></tr>
                    <tr><th scope='row'>Kategori</th>               <td><select name='id_kategori_banner' class='form-control'>
                                                                            <option value='0' selected>- Pilih Kategori -</option>";
                                                                            $kategori = $this->model_app->view('kategori_banner');
                                                                            foreach ($kategori->result_array() as $row){
                                                                              if ($row['id_kategori_banner']==$rows['id_kategori_banner']){
                                                                                echo "<option value='$row[id_kategori_banner]' selected>$row[nama_kategori_banner]</option>";
                                                                              }else{
                                                                                echo "<option value='$row[id_kategori_banner]'>$row[nama_kategori_banner]</option>";
                                                                              }
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row' width='120px'>Keterangan</th> <td><textarea class='form-control' name='keterangan' style='height:100px'>$rows[keterangan]</textarea></td></tr>

                    <tr><th scope='row'>Url</th>    <td><input type='url' class='form-control' name='b' value='$rows[url]'></td></tr>
                    <tr><th scope='row'>Gambar</th>    <td><input type='file' name='gambar'>";
                    if ($rows['gambar'] != ''){ echo "<i style='color:red'>Lihat Gambar Saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_banner/$rows[gambar]'>$rows[gambar]</a>"; } echo "</td></tr>
                    <tr><th scope='row'>Icon</th>    <td><input type='text' class='form-control' name='icon' value='$rows[icon]'></td></tr>
                    <tr><th scope='row'>Url</th>    <td>"; if ($rows['posisi']=='top'){
                                                              echo "<input type='radio' name='posisi' value='top' checked> Top
                                                                    <input type='radio' name='posisi' value='footer'> Footer
                                                                    <input type='radio' name='posisi' value='produk'> Produk";
                                                            }elseif ($rows['posisi']=='footer'){
                                                              echo "<input type='radio' name='posisi' value='top'> Top
                                                                    <input type='radio' name='posisi' value='footer' checked> Footer
                                                                    <input type='radio' name='posisi' value='produk'> Produk";
                                                            }else{
                                                              echo "<input type='radio' name='posisi' value='top'> Top
                                                                    <input type='radio' name='posisi' value='footer'> Footer
                                                                    <input type='radio' name='posisi' value='produk' checked> Produk";
                                                            }
                                                        
                                                        
                    echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/banner'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
