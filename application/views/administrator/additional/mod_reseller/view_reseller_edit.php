<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Informasi Lapak</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_reseller',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden'  value='$rows[id_reseller]' name='id'>";
                    if (trim($rows['foto'])==''){ $foto_toko = 'toko.jpg'; }else{ if (!file_exists("asset/foto_user/$rows[foto]")){ $foto_toko = 'toko.jpg'; }else{ $foto_toko = $rows['foto']; } } 
                    echo "<tr bgcolor='#e3e3e3'><th rowspan='14' width='110px'><center><img style='border:1px solid #cecece; height:85px; width:85px' src='".base_url()."asset/foto_user/$foto_toko' class='img-circle img-thumbnail'></center></th></tr>
                    <tr><th width='130px' scope='row'>Nama Pelapak</th>                <td><input class='form-control' type='text' name='c' value='$rows[nama_reseller]'></td></tr>
                    <tr><th scope='row'>Alamat Lengkap</th>               <td><input class='form-control' type='text' name='e' value='$rows[alamat_lengkap]'></td></tr>
                    <tr><td><b>Propinsi</b></td>         <td><select class='form-control form-mini' name='provinsi_id' id='list_provinsi' required>";
                    $obj = get_provinsi();
                    echo "<option value=0>- Pilih Provinsi -</option>";
                    for($i=0; $i < count($obj['rajaongkir']['results']); $i++){
                      if ($rows['provinsi_id']==$obj['rajaongkir']['results'][$i]['province_id']){
                        echo "<option value='".$obj['rajaongkir']['results'][$i]['province_id']."' selected>".$obj['rajaongkir']['results'][$i]['province']."</option>";
                      }else{
                        echo "<option value='".$obj['rajaongkir']['results'][$i]['province_id']."'>".$obj['rajaongkir']['results'][$i]['province']."</option>";
                      }
                    }
                    echo "</select>
                          </td></tr>
                          <tr><td><b>Kota</b></td>             <td><select class='form-control form-mini' name='kota_id' id='list_kotakab' required>";
                          $kota = get_kota($rows['provinsi_id']);
                          echo "<option value=0>- Pilih Kota / Kabupaten -</option>";
                          for($i=0; $i < count($kota['rajaongkir']['results']); $i++){
                            if ($rows['kota_id']==$kota['rajaongkir']['results'][$i]['city_id']){
                              echo "<option value='".$kota['rajaongkir']['results'][$i]['city_id']."' selected>".$kota['rajaongkir']['results'][$i]['city_name']."</option>";
                            }else{
                              echo "<option value='".$kota['rajaongkir']['results'][$i]['city_id']."'>".$kota['rajaongkir']['results'][$i]['city_name']."</option>";
                            }
                          }
                          echo "</select>
                          </td></tr>
                    <tr><td><b>Kecamatan</b></td>  <td><select class='form-control form-mini' name='kecamatan_id' id='list_kecamatan' required>";
                    $kec = get_kecamatan($rows['kota_id']);
                    echo "<option value=0>- Pilih Kecamatan -</option>";
                    for($i=0; $i < count($kec['rajaongkir']['results']); $i++){
                      if ($rows['kecamatan_id']==$kec['rajaongkir']['results'][$i]['subdistrict_id']){
                        echo "<option value='".$kec['rajaongkir']['results'][$i]['subdistrict_id']."' selected>".$kec['rajaongkir']['results'][$i]['subdistrict_name']."</option>";
                      }else{
                        echo "<option value='".$kec['rajaongkir']['results'][$i]['subdistrict_id']."'>".$kec['rajaongkir']['results'][$i]['subdistrict_name']."</option>";
                      }
                    }
                    echo "</select></td></tr>
                    <tr><th scope='row'>No Hp</th>                        <td><input class='form-control' type='number' name='f' value='$rows[no_telpon]'></td></tr>
                    <tr><th scope='row'>Keterangan</th>                   <td><textarea class='form-control' type='text' name='i' style='height:120px'>$rows[keterangan]</textarea></td></tr>
                    <input class='form-control' type='hidden' name='j' value='$rows[referral]'>
                    <tr><th scope='row'>Ganti Foto</th>                         <td><input type='file' class='form-control' name='gg'>";
                                                                               if ($rows['foto'] != ''){ echo "<i style='color:red'>Foto Profile saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_user/$rows[foto]'>$rows[foto]</a>"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='#' onclick=\"window.history.go(-1); return false;\"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
