<div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Penawaran Produk (Flash Deal)</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/konsumen'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <?php 
                    echo $this->session->flashdata('message'); 
                    $this->session->unset_userdata('message');
                  ?>
                  <table id="example1" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Nama Produk</th>
                        <th>Penjual</th>
                        <th>Modal (Rp)</th>
                        <th>Diskon (Rp)</th>
                        <th>Jual (Rp)</th>
                        <th>Stok</th>
                        <th>Berat</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                      $jual = $this->model_reseller->jual_reseller($row['id_reseller'],$row['id_produk'])->row_array();
                      $beli = $this->model_reseller->beli_reseller($row['id_reseller'],$row['id_produk'])->row_array();
                      $disk = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$row['id_produk'],'id_reseller'=>$row['id_reseller']))->row_array();
                      if ($disk['diskon']=='' OR $disk['diskon']=='0'){ $diskon = '0'; $line = ''; $harga = ''; }else{ $diskon = $disk['diskon']; $line = 'line-through'; $harga = "/ <span style='color:red'>".rupiah($row['harga_konsumen']-$disk['diskon'])."</span>";}
                      if ($row['id_produk_perusahaan']!='0'){ $perusahaan = "<small><i style='color:green'>(Perusahaan)</i></small>"; }else{ $perusahaan = ''; }
                      if ($row['id_produk_perusahaan']=='0'){ $modal = $row['harga_beli'];  }else{ $modal = $row['harga_reseller']; }
                      if ($row['aktif']=='Y'){ $aktif = 'Ya'; }else{ $aktif = 'Tidak'; }
                    echo "<tr><td>$no</td>
                              <td>$row[nama_produk] </td>
                              <td><a href='".base_url()."administrator/detail_reseller/$row[id_reseller]'>$row[nama_reseller]</a></td>
                              <td>".rupiah($modal)."</td>
                              <td>".rupiah($diskon)."</td>
                              <td><span style='text-decoration:$line'>".rupiah($row['harga_konsumen'])."</span> $harga</td>
                              <td>".($beli['beli']-$jual['jual'])." $row[satuan]</td>
                              <td>$row[berat] g</td>
                              <td><a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_penawaran/$row[id_produk_penawaran]' onclick=\"return confirm('Apa anda yakin untuk hapus penawaran produk ini?')\"><span class='glyphicon glyphicon-remove'></span></a></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table><hr>
              </div>