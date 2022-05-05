            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Rekap Penjualan Penjual</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-condensed">
                    <thead>
                      <tr bgcolor='#e3e3e3'>
                        <th style='width:20px'>No</th>
                        <th>Nama Penjual</th>
                        <th>Modal</th>
                        <th>Trx. Sukses</th>
                        <th>+ Ongkir</th>
                        <th>Jasa Kurir</th>
                        <th>Saldo</th>
                        <th>Withdraw</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    $ongkir = $this->db->query("SELECT sum(z.ongkir) as ongkir FROM (SELECT sum(c.ongkir) as ongkir FROM rb_penjualan c where c.status_penjual='reseller' AND c.id_penjual='$row[id_reseller]' AND c.kode_kurir!='0' AND c.kode_kurir!='1' AND c.proses>'3' GROUP BY c.kode_transaksi) as z")->row_array();
                    $sop = $this->db->query("SELECT id_sopir FROM rb_sopir where id_konsumen='$row[id_konsumen]'")->row_array();
                    $sopir = $this->db->query("SELECT sum(ongkir) as total FROM rb_penjualan a WHERE a.kurir='$sop[id_sopir]' AND a.proses='4' AND a.kode_kurir='1'")->row_array();
                    $tarik = $this->db->query("SELECT sum(nominal) as total FROM rb_withdraw WHERE id_reseller='$row[id_reseller]' AND status='Sukses' AND transaksi='debit'")->row_array();
                    if (verifikasi_cek($row['id_reseller'])=='1'){ 
                      $bintang = "<i title='Unverified' style='color:red' class='fa fa-remove'></i>"; 
                    }else{ 
                      $bintang = "<i title='Verified' style='color:green' class='fa fa-check-square'></i>"; 
                    }

                    echo "<tr><td>$no</td>
                              <td>$bintang <a href='".base_url()."administrator/detail_reseller/$row[id_reseller]'>$row[nama_reseller]</a></td>
                              <td>".rupiah(modal($row['id_reseller'],'4'))."</td>
                              <td>".rupiah(penjualan($row['id_reseller'],'4'))."</td>
                              <td>".rupiah($ongkir['ongkir'])."</td>
                              <td>".rupiah($sopir['total'])."</td>
                              <td class='success'><b>".rupiah(saldo($row['id_reseller'],$row['id_konsumen']))."</b></td>
                              <td class='danger'><b>".rupiah($tarik['total'])."</b></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>