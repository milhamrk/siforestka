            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Transaksi Penjualan / Orderan Konsumen</h3>
                  <form target='_BLANK' action="<?= base_url().$this->uri->segment('1'); ?>/penjualan_konsumen" method='GET' class='pull-right'>
                    <select style='padding:4px 10px; border:1px solid #cecece' name="bulan">
                      <?php 
                        for ($i=1; $i<= 12; $i++) { 
                          if ($_GET['bulan']==$i){
                            echo "<option value='$i' selected>".bulan($i)."</option>";
                          }else{
                            if (date('m')==$i){
                              echo "<option value='$i' selected>".bulan($i)."</option>";
                            }else{
                              echo "<option value='$i'>".bulan($i)."</option>";
                            }
                          }
                        }
                      ?>
                    </select>
                    <button style='margin-top:-4px' class='btn btn-sm btn-primary' type="submit">Cetak / Print</button>
                  </form>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped table-condensed table-condensed">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Transaksi</th>
                        <th>Konsumen</th>
                        <th>Kurir</th>
                        <th>Status</th>
                        <th>Total + Ongkir</th>
                        <th>Waktu Transaksi</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                      $total = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(a.fee_produk_end*a.jumlah) as fee_produk FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                      $produk = $this->db->query("SELECT * FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->num_rows();
                      $kupon = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
                                JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
                                    where b.id_penjualan='$row[id_penjualan]'")->row_array();
                      if ($total['fee_produk']>0){ $fee_produk = $total['fee_produk']; }else{ $fee_produk = 0; }
                      if ($row['group_order']!=''){
                        $ex = explode('.',$row['group_order']);
                        $total_group = $this->db->query("SELECT * FROM rb_penjualan where group_order='$row[group_order]' AND proses!='0'");
                        if ($total_group->num_rows()>=$ex[1]){
                          $total_menunggu = "<i style='color:green'>(Kuota Group Order telah Terpenuhi!)</i>";
                        }else{
                          $total_menunggu = "<i style='color:red'>(Menunggu ".($ex[1]-$total_group->num_rows())." Orderan Lagi)</i>";
                        }

                        $kode_transaksi = "<a style='color:red' href='#' class='grouporder' data-id='$row[id_penjual]:$row[group_order]'>GROUP-<b>$row[group_order]</b></a>";
                      }else{
                        $kode_transaksi = $row['kode_transaksi'];
                      }
                      echo "<tr><td>$no</td>
                              <td>$kode_transaksi</td>
                              <td><a href='".base_url().$this->uri->segment(1)."/detail_konsumen/$row[id_konsumen]'>$row[nama_lengkap]</a></td>";
                              if ($row['kode_kurir']=='1'){
                                $ceks = $this->db->query("SELECT * FROM rb_sopir where id_sopir='".(int)$row['kurir']."'")->row_array();
                                echo "<td>$row[service] - $ceks[merek]</td>";
                              }elseif ($row['kode_kurir']=='0'){
                                $ceks = $this->db->query("SELECT * FROM rb_sopir where id_sopir='".(int)$row['kurir']."'")->row_array();
                                echo "<td>COD - $row[service]</td>";
                              }else{
                                echo "<td><span style='text-transform:uppercase'>$row[kode_kurir]</span> - $row[service]</td>";
                              }
                              echo "<td>".status($row['proses'])."</td>
                              <td>
                                Rp ".rupiah($total['total']+$row['ongkir']-$kupon['diskon']-$fee_produk)."</span> ($produk Produk)";
                                if ($row['kode_kurir']!='0'){
                                  if ($row['proses']!='0'){
                                    $cek_payment = $this->db->query("SELECT * FROM rb_penjualan_otomatis where kode_transaksi='$row[kode_transaksi]' AND pembayaran is null");
                                    if ($cek_payment->num_rows()>=1){
                                      echo "<br><small style='color:red'><i>Pending Payment</i></small> <a href='".base_url().$this->uri->segment(1)."/penjualan_konsumen?terima=$row[id_penjualan]' onclick=\"return confirm('Yakin ubah status Pembayaran ini jadi diterima?')\"><span class='fa fa-check'></span></a>";
                                    }
                                  }
                                }
                              echo "</td>
                              <td>".jam_tgl_indo($row['waktu_transaksi'])."</td>
                              <td><center>";
                              if ($row['group_order']!=''){
                                echo "<a href='#' class='btn btn-xs btn-success grouporder' data-id='$row[id_penjual]:$row[group_order]' style='width:50px'>Detail</b></a> ";
                              }else{
                                echo "<div class='btn-group'>
                                  <button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                      <span class='caret'></span>
                                  </button>
                                  <ul class='dropdown-menu'>
                                      <li><a onclick=\"return confirm('Yakin Ubah status pesanan jadi Pending?')\" href='".base_url().$this->uri->segment(1)."/penjualan_konsumen?id=$row[id_penjualan]&status=0'>Pending</a></li>
                                      <li><a onclick=\"return confirm('Yakin Ubah status pesanan jadi Proses?')\" href='".base_url().$this->uri->segment(1)."/penjualan_konsumen?id=$row[id_penjualan]&status=1'>Proses</a></li>
                                      <li><a onclick=\"return confirm('Yakin Ubah status pesanan jadi Konfirmasi?')\" href='".base_url().$this->uri->segment(1)."/penjualan_konsumen?id=$row[id_penjualan]&status=2'>Konfirmasi</a></li>
                                      <li><a onclick=\"return confirm('Yakin Ubah status pesanan jadi Dikirim?')\" href='".base_url().$this->uri->segment(1)."/penjualan_konsumen?id=$row[id_penjualan]&status=3'>Dikirim</a></li>
                                      <li><a onclick=\"return confirm('Apa anda yakin Pesanan ini sudah selesai?')\" href='".base_url().$this->uri->segment(1)."/penjualan_konsumen?sukses=$row[id_penjualan]'>Selesai</a></li>";
                                        $cek_payment2 = $this->db->query("SELECT * FROM rb_penjualan_otomatis where kode_transaksi='$row[kode_transaksi]' AND pembayaran='1'");
                                        if ($cek_payment2->num_rows()>=1){
                                            echo "<li><a style='color:red' onclick=\"return confirm('Apa anda yakin Pesanan ini dibatalkan dan Dana dikembalikan?')\" href='".base_url().$this->uri->segment(1)."/penjualan_konsumen?id=$row[id_penjualan]&batal=x'>Batal/Refund</a></li>";
                                        }else{
                                            echo "<li><a style='color:red' onclick=\"return confirm('Apa anda yakin Pesanan ini dibatalkan dan Hapus Data?')\" href='".base_url().$this->uri->segment(1)."/penjualan_konsumen?id=$row[id_penjualan]&batal=xx'>Batal/Hapus</a></li>";
                                        }
                                    echo "</ul>
                                </div>
                                <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url().$this->uri->segment(1)."/detail_penjualan_konsumen/$row[id_penjualan]'><span class='glyphicon glyphicon-search'></span></a> ";
                              }
                                echo "<a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_penjualan_konsumen/$row[id_penjualan]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_penjualan_konsumen/$row[id_penjualan]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
              </div>
              </div>

<div class="modal fade bd-example-modal-lg grouporder-modal" style='z-index:99999' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header" style='border-bottom:0px solid #e9ecef'>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
      <div class='content-body' style='padding:0px 20px'></div>
    </div>
</div>
</div>
</div>          
<script>
    $(function(){
        $(document).on('click','.grouporder',function(e){
            e.preventDefault();
            $(".grouporder-modal").modal('show');
            $.post("<?php echo site_url()?>administrator/grouporder",
                {id:$(this).attr('data-id')},
                function(html){
                    $(".content-body").html(html);
                }   
            );
        });
    });
</script>   