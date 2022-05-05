<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Background Website </h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/background',$attributes); 
                error_reporting(0);
                if ($rows['gambar']=='red'){
                  $red = 'checked';
                }elseif ($rows['gambar']=='green'){
                  $green = 'checked';
                }elseif ($rows['gambar']=='blue'){
                  $blue = 'checked';
                }elseif ($rows['gambar']=='orange'){
                  $orange = 'checked';
                }elseif ($rows['gambar']=='yellow'){
                  $yellow = 'checked';
                }elseif ($rows['gambar']=='white'){
                  $white = 'checked';
                }
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                      <tr bgcolor=#ab0534><td><input name='a' value='red' type='radio' $red><b style='color:#fff'> Red</b> </td></tr>
                      <tr bgcolor=#1bb374><td><input name='a' value='green' type='radio' $green><b style='color:#fff'> Green</b> </td></tr>
                      <tr bgcolor=#002d46><td><input name='a' value='blue' type='radio' $blue><b style='color:#fff'> Blue</b> </td></tr>
                      <tr bgcolor=#e45c27><td><input name='a' value='orange' type='radio' $orange><b style='color:#fff'> Orange</b> </td></tr>
                      <tr bgcolor=#fcb800><td><input name='a' value='yellow' type='radio' $yellow><b style='color:#fff'> Yellow</b> </td></tr>
                      <tr bgcolor=#fff><td><input name='a' value='white' type='radio' $white><b style='color:#000'> White</b> </td></tr>
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='#' onclick=\"window.history.go(-1); return false;\"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
