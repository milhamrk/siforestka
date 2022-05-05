            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Semua Konsumen</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>No Telpon</th>
                        <th>Referral</th>
                        <th style='width:120px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    if (reseller($row['id_konsumen'])!=''){
                      $bintang = "<i class='fa fa-shopping-cart text-success'></i>";
                    }else{
                      $bintang = "<i class='fa fa-user'></i>";
                    }

                    // Izinkan Menggunakan link referral untuk rekrut bawahan / untuk menjadi referral.
                    if ($row['token']=='Y'){ 
                      $perwakilan = '<i style="color:green">Aktif</i>'; 
                      $verifikasi = 'N';
                      $button = 'default';
                      $alert = "Batalkan status Perwakilan/Referral untuk Konsumen ini?";
                    }else{ 
                      $perwakilan = '<i style="color:red">Non-Aktif</i>'; 
                      $verifikasi = 'Y';
                      $button = 'primary';
                      $alert = "Rekrut Konsumen ini menjadi Perwakilan/Referral?";
                    }
                    
                    if ($row['kecamatan_id']=='0'){ $alamat = "<i style='color:#ff9c9c'>Belum Mengisikan Alamat,..</i>"; }else{ $alamat = kecamatan($row['kecamatan_id'],$row['kota_id']); }

                    echo "<tr><td>$no</td>
                              <td>$bintang $row[nama_lengkap]</td>
                              <td>$alamat</td>
                              <td>$row[no_hp]</td>
                              <td>$perwakilan</td>
                              <td><center>
                              <a class='btn btn-$button btn-xs' title='Verifikasi Data' href='".base_url()."administrator/verifikasi_konsumen/$row[id_konsumen]/$verifikasi' onclick=\"return confirm('$alert')\"><span class='glyphicon glyphicon-ok'></span></a>
                                <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url()."administrator/detail_konsumen/$row[id_konsumen]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url()."administrator/edit_konsumen/$row[id_konsumen]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_konsumen/$row[id_konsumen]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>