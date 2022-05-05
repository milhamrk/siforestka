            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Semua Penjual</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Penjual</th>
                        <th>Alamat Lapak</th>
                        <th>Akun</th>
                        <th style='width:120px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    if (verifikasi_cek($row['id_reseller'])=='1'){ 
                      $bintang = "<i title='Unverified' style='color:red' class='fa fa-remove'></i>"; 
                    }else{ 
                      $bintang = "<i title='Verified' style='color:green' class='fa fa-check-square'></i>"; 
                    }
                    
                    $cek_paket = $this->db->query("SELECT * FROM rb_reseller_paket a JOIN rb_paket b ON a.id_paket=b.id_paket where a.id_reseller='$row[id_reseller]'");
                    if ($cek_paket->num_rows()>=1){
                        $rowp = $cek_paket->row_array();
                          if ($rowp['status']=='Y'){
                            $akhir  = strtotime($rowp['expire_date']); //Waktu awal
                            $awal = time(); // Waktu sekarang atau akhir
                            $diff  = $akhir - $awal;
                            
                            if (floor($diff / (60 * 60 * 24))<1){
                                $this->db->query("UPDATE rb_reseller_paket set status='N' where id_reseller='$row[id_reseller]'");
                            }
                          }
                    }

                    if ($row['verifikasi']=='Y'){
                      $verifikasi = 'N';
                      $alert = "Yakin ingin Un-verifikasi data ini?";
                      $button = 'default';
                    }else{
                      $verifikasi = 'Y';
                      $alert = "Yakin ingin Verifikasi data ini?";
                      $button = 'primary';
                    }
                    echo "<tr><td>$no</td>
                              <td>$bintang <b>$row[nama_reseller]</b></td>
                              <td>".kecamatan($row['kecamatan_id'],$row['kota_id'])."</td>
                              <td>".cek_status_payment($row['id_reseller'])."</td>
                              <td><center>
                              <a class='btn btn-$button btn-xs' title='Verifikasi Data' href='".base_url()."administrator/verifikasi_reseller/$row[id_reseller]/$verifikasi' onclick=\"return confirm('$alert')\"><span class='glyphicon glyphicon-ok'></span></a>
                                <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url()."administrator/detail_reseller/$row[id_reseller]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url()."administrator/edit_reseller/$row[id_reseller]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_reseller/$row[id_reseller]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>