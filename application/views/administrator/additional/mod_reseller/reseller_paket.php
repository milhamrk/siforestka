            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Permintaan Paket Star Seller</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Penjual</th>
                        <th>Tagihan</th>
                        <th>Paket Pilihan</th>
                        <th>Status</th>
                        <th>Waktu Request</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    if ($row['status']=='Y'){ $color = 'green'; $status = 'Aktif'; $stat = 'N'; $tombol = 'default'; $info = "onclick=\"return confirm('Yakin ingin mengubah status jadi Non Aktif??')\""; }else{ $color = 'red'; $status = 'Non Aktif'; $stat = 'Y'; $tombol = 'success'; $info = ''; }
                    echo "<tr><td>$no</td>
                              <td><a href='".base_url()."administrator/detail_reseller/$row[id_reseller]'>$row[nama_reseller]</a></td>
                              <td><b>".rupiah($row['harga']+$row['id_reseller_paket'])."</b></td>
                              <td>$row[nama_paket], Durasi <b>$row[durasi]</b> Hari</td>
                              <td style='color:$color'>$status</td>
                              <td>".jam_tgl_indo($row['waktu_paket'])."</td>
                              <td><center>
                                <a class='btn btn-$tombol btn-xs' title='Sukses Data' href='".base_url()."administrator/proses_reseller_paket/$row[id_reseller_paket]/$stat/$row[id_paket]' $info><span class='glyphicon glyphicon-ok'></span></a>
                                <a class='btn btn-danger btn-xs' title='Batalkan Data' href='".base_url()."administrator/delete_reseller_paket/$row[id_reseller_paket]' onclick=\"return confirm('Apa anda yakin untuk Hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                                </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>