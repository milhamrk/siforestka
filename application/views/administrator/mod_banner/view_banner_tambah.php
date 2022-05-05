<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Banner Link</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/tambah_banner',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Judul</th>    <td><input type='text' class='form-control' name='a' required></td></tr>
                    <tr><th scope='row'>Kategori</th>               <td><select name='id_kategori_banner' class='form-control'>
                                                                            <option value='0' selected>- Pilih Kategori -</option>";
                                                                            $kategori = $this->model_app->view('kategori_banner');
                                                                            foreach ($kategori->result_array() as $row){
                                                                                echo "<option value='$row[id_kategori_banner]'>$row[nama_kategori_banner]</option>";
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row' width='120px'>Keterangan</th> <td><textarea class='form-control' name='keterangan' style='height:100px'></textarea></td></tr>

                    <tr><th scope='row'>Url</th>    <td><input type='url' class='form-control' name='b'></td></tr>
                    <tr><th scope='row'>Gambar</th>    <td><input type='file' name='gambar'></td></tr>
                    <tr><th scope='row'>Icon</th>    <td><input type='text' class='form-control' name='icon'></td></tr>
                    <tr><th scope='row'>Url</th>    <td><input type='radio' name='posisi' value='top' checked> Top
                                                        <input type='radio' name='posisi' value='footer'> Footer
                                                        <input type='radio' name='posisi' value='produk'> Produk</td></tr>
                    </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/banner'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
