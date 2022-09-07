<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Album Berita Foto</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/tambah_album',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Judul Album</th>   <td><input type='text' class='form-control' name='a'></td></tr>
                    <tr><th scope='row'>Youtube URL</th>                 <td><input placeholder='https://youtube.com?watch=lalala' class='form-control' name='b' /></td></tr>
                    <tr><th scope='row'>Cover</th>                    <td><input type='file' class='form-control' name='c'></td></tr>
                    <tr><th scope='row'>Opsi </th>        <td>"; echo "<input type='radio' name='e' value='gambar' required> Gambar &nbsp; <input type='radio' name='e' value='video' required> Video"; echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/album'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
