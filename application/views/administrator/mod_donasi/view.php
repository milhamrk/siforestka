            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Donasi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Jenis Donasi</th>
                        <th>Nama Lengkap</th>
                        <th>No Handphone</th>
                        <th>Alamat Email</th>
                        <th>Waktu Kirim</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                      if ($row['jenis']=='zakat'){ $color = 'red'; }elseif ($row['jenis']=='wakaf_asset'){ $color = 'green'; }elseif ($row['jenis']=='wakaf_uang'){ $color = 'blue'; }else{ $color = 'black'; }
                    echo "<tr><td>$no</td>
                              <td style='color:$color'>$row[jenis]</td>
                              <td>$row[nama_lengkap]</td>
                              <td>$row[no_handphone]</td>
                              <td>$row[alamat_email]</td>
                              <td><i>$row[waktu_kirim]</i></td>
                              <td><center>
                                <a class='btn btn-success btn-xs lihat-donasi' data-id='$row[id_donasi]' title='Lihat Data' href='#'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_donasi/$row[id_donasi]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>