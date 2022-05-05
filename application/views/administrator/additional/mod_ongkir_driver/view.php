            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Rute dan Ongkir Driver <br><small>Data Rute tersedia untuk Kurir Internal Marketplace</small></h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_ongkir_driver'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Kendaraan</th>
                        <th>Posisi</th>
                        <th>Tujuan</th>
                        <th>Ongkir</th>
                        <th>Keterangan</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $ex = explode('|',$row['provinsi_kota']);
                    $cut1 = explode(':',$ex[0]);
                    $cut2 = explode(':',$ex[1]);
                    echo "<tr><td>$no</td>
                              <td>$row[jenis_kendaraan]</td>
                              <td>".kecamatan_kota($row['posisi'],$cut1[1])."</td>
                              <td>".kecamatan_kota($row['tujuan'],$cut2[1])."</td>
                              <td>".rupiah($row['ongkir'])."</td>
                              <td>$row[keterangan]</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/edit_ongkir_driver/$row[id_driver_ongkir]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_ongkir_driver/$row[id_driver_ongkir]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>