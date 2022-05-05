<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Paket</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/tambah_paket',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='120px' scope='row'>Nama Paket</th>    <td><input type='text' class='form-control' name='nama_paket' required></td></tr>
                    <tr><th width='120px' scope='row'>Judul</th>    <td><input type='text' class='form-control' name='judul' required></td></tr>
                    <tr><th width='120px' scope='row'>Keterangan</th>    <td><textarea class='form-control' style='height:150px' name='keterangan'>$rows[keterangan]</textarea></td></tr>
                    <tr><th width='120px' scope='row'>Durasi</th>    <td><input type='number' class='form-control' name='durasi' required></td></tr>
                    <tr><th width='120px' scope='row'>Harga</th>    <td><input type='number' class='form-control' name='harga' required></td></tr>
                    <tr><th width='120px' scope='row'>Max Produk</th>    <td><input type='number' class='form-control' name='max_produk' required></td></tr>
                    <tr><th scope='row'>Icon Kode</th>    <td><input type='text' class='form-control' name='icon_kode'></td></tr>
                    <tr><th scope='row'>Icon Image</th>   <td><input type='file' class='form-control' name='icon_image'></td></tr>
                    </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='".base_url().$this->uri->segment(1)."/paket'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
