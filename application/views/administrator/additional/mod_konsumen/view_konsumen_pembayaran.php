            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Konfirmasi Pembayaran Konsumen</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tagihan</th>
                        <th>Transfer</th>
                        <th>Nama Pengirim</th>
                        <th>Ke Rekening</th>
                        <th>Waktu Trx</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    if ($row['proses']=='0'){ $status = "<span class='fa fa-hourglass-2'></span>"; $text = 'Lunas'; $order = 'Pending'; $nilai = 1; $button = 'default'; }else{ $status = "<span class='fa fa-check-square'></span>"; $order = "<span style='color:green'>Lunas</span>"; $text = 'Pending'; $nilai = 0; $button = 'success'; }
                    $total = $this->db->query("SELECT nominal FROM `rb_penjualan_otomatis` a where a.kode_transaksi='$row[kode_transaksi]'")->row_array();
                    echo "<tr>
                              <td>$no</td>
                              <td><a target='_BLANK' href='".base_url()."konfirmasi/tracking/$row[kode_transaksi]'>$row[kode_transaksi]</a></td>
                              <td><b style='color:red'>".rupiah($total['nominal'])."</b></td>
                              <td>$row[total_transfer]</td>
                              <td>$row[nama_pengirim]</td>
                              <td>$row[nama_bank]</td>
                              <td>".tgl_indo($row['tanggal_transfer'])."</td>
                              <td>$order</td>
                              <td><a class='btn btn-xs btn-primary' href='".base_url()."reseller/download/$row[bukti_transfer]'><span class='fa fa-file-text'></span></a>
                                  <a class='btn btn-xs btn-$button' href='".base_url()."administrator/pembayaran_konsumen/$row[id_penjualan]/$nilai' onclick=\"return confirm('Ubah Status Orderan Menjadi $text?')\">$status</a></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>