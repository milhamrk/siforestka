            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">History Deposit dan Tarik Dana (Withdraw)</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_withdraw'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Penjual</th>
                        <th>Nominal</th>
                        <th>Data Bank</th>
                        <th>Status</th>
                        <th>Jenis</th>
                        <th>Waktu Proses</th>
                        <th style='width:80px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    if ($row['akun']=='reseller'){
                      $rows = $this->db->query("SELECT b.* FROM rb_reseller a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen where a.id_reseller='$row[id_reseller]'")->row_array();
                      $url = "detail_konsumen/$rows[id_konsumen]";
                      $nama_akun = $rows['nama_lengkap'];
                    }elseif ($row['akun']=='konsumen'){
                      $ak = $this->db->query("SELECT * FROM rb_konsumen where id_konsumen='$row[id_reseller]'")->row_array();
                      $url = "detail_konsumen/$ak[id_konsumen]";
                      $nama_akun = $ak['nama_lengkap'];
                    }else{
                      $url = "#";
                      $nama_akun = "-";
                    }

                    if ($row['transaksi']=='debit'){ $color_trx =  'red'; }else{ $color_trx = 'green'; }
                    if ($row['status']=='Sukses'){ $color = 'blue'; $status = 'Pending'; $tombol = 'default'; $info = "onclick=\"return confirm('Yakin ingin mengubah status jadi Pending??')\""; }else{ $color = '#cecece'; $status = 'Sukses'; $tombol = 'success'; $info = "onclick=\"return confirm('Yakin ingin mengubah status jadi Sukses??')\""; }
                    $ex = explode(';',$row['keterangan']);
                    echo "<tr><td>$no</td>
                              <td><a href='".base_url()."administrator/$url'>$nama_akun</a></td>
                              <td><b>".rupiah($row['nominal']-$row['withdraw_fee'])."</b></td>";

                              if ($row['id_rekening_reseller']=='0'){
                                if ($row['akun']=='konsumen'){
                                  $exk = explode('-',$row['keterangan_order']);
                                  $kode_transaksi = trim($exk[0]);
                                  $rwp = $this->db->query("SELECT id_penjualan FROM rb_penjualan where kode_transaksi='$kode_transaksi' AND status_pembeli='konsumen'")->row_array();
                                  $url_order = "administrator/detail_penjualan_konsumen/$rwp[id_penjualan]";
                                }else{
                                  $cek_status = $this->db->query("SELECT id_penjualan FROM rb_penjualan where kode_transaksi='$row[keterangan_order]' AND status_pembeli='konsumen'");
                                  if ($cek_status->num_rows()>=1){
                                    $rowp = $cek_status->row_array();
                                    $url_order = "administrator/detail_penjualan_konsumen/$rowp[id_penjualan]";
                                  }else{
                                    $rew = $this->db->query("SELECT id_penjualan FROM rb_penjualan where kode_transaksi='$row[keterangan_order]' AND status_pembeli='reseller'")->row_array();
                                    $url_order = "administrator/detail_penjualan/$rew[id_penjualan]";
                                  }
                                }

                                if ($row['transaksi']=='debit'){ 
                                  echo "<td>Pembayaran Order <a style='color:blue; text-decoration:underline' target='_BLANK' href='".base_url().$url_order."'>$row[keterangan_order]</a></td>";
                                }else{ 
                                  echo "<td>Deposit via Ipaymu (Payment Gateway)</td>"; 
                                }
                              
                              }else{
                                if ($row['transaksi']=='debit'){
                                  echo "<td>$ex[0], $ex[1], $ex[2]</td>";
                                }else{
                                  $rek = $this->model_app->view_where('rb_rekening',array('id_rekening'=>$row['id_rekening_reseller']))->row_array();
                                  echo "<td>$rek[nama_bank], $rek[no_rekening], $rek[pemilik_rekening]</td>";
                                }
                              }

                              echo "<td style='color:$color'>$row[status]</td>
                              <td style='color:$color_trx'>$row[transaksi]</td>
                              <td>".jam_tgl_indo($row['waktu_withdraw'])."</td>
                              <td><center>";
                              if ($row['transaksi']=='kredit' AND $row['id_rekening_reseller']!='0'){
                                echo "<a class='btn btn-primary btn-xs' href='".base_url()."administrator/download_file/bukti_transfer/$row[keterangan_order]'><span class='glyphicon glyphicon-file'></span></a> ";
                              }else{
                                echo "<a class='btn btn-default btn-xs' href='#'><span class='glyphicon glyphicon-minus'></span></a> ";
                              }
                                echo "<a class='btn btn-$tombol btn-xs' title='Sukses Data' href='".base_url()."administrator/proses_withdraw/$row[id_withdraw]/$status' $info><span class='glyphicon glyphicon-ok'></span></a>";
                                if ($row['status']=='Batal'){
                                  echo " <a class='btn btn-default btn-xs' title='Batalkan Data' href='#' onclick=\"return confirm('Maaf, Permintaan ini telah dibatalkan!')\"><span class='glyphicon glyphicon-remove'></span></a>";
                                }else{
                                  echo " <a class='btn btn-danger btn-xs' title='Batalkan Data' href='".base_url()."administrator/proses_withdraw/$row[id_withdraw]/Batal' onclick=\"return confirm('Apa anda yakin untuk Batalkan Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>";
                                }
                                echo "</center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>