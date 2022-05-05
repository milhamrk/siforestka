<?php 
if (cetak($this->input->post('id'))!=''){
  $ex = explode('.',cetak($this->input->post('id')));
  $total_group = $this->db->query("SELECT * FROM rb_penjualan where group_order='".cetak($this->input->post('id'))."' AND proses!='0'");
  if ($total_group->num_rows()>=$ex[1]){
    $total_menunggu = "<i style='color:green'>Kuota Group Order telah Terpenuhi!</i>";
  }else{
    $total_menunggu = "<i style='color:red'>Menunggu ".($ex[1]-$total_group->num_rows())." Orderan Lagi</i>";
  }

  $kode_transaksi = "<a style='color:red' href='#' class='grouporder' data-id='$row[group_order]'>GROUP-<b>$row[group_order]</b></a>";
  echo "<table class='table table-sm'>
          <tr><td width='120px'><b>Kode Group</b></td> <td>".cetak($this->input->post('id'))."</td></tr>
          <tr><td width='120px'><b>Group</b></td> <td>Beli Ber-".$ex[1]."</td></tr>
          <tr><td width='120px'><b>Status</b></td> <td>$total_menunggu</td></tr>
        </table><br>";
}
?>


<table id="example1" class="table table-striped table-sm iconset">
  <thead>
    <tr>
      <th style='width:40px'>No</th>
      <th>Kode Transaksi</th>
      <th>Nama Konsumen</th>
      <th>Kurir</th>
      <th>Status</th>
      <th>Total + Ongkir</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
<?php 
  $no = 1;
  foreach ($records->result_array() as $row){
  if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; $status = 'Proses'; $icon = 'star-empty'; $ubah = 1; }elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; $status = 'Pending'; $icon = 'star text-yellow'; $ubah = 0; }elseif($row['proses']=='3'){ 
      $proses = '<i class="text-success">Dikirim</i>'; $status = 'Dikirim'; $icon = 'star text-yellow'; $ubah = 0; 
  }else{ $proses = '<i class="text-info">Konfirmasi</i>'; $status = 'Proses'; $icon = 'star'; $ubah = 1; }
  $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(a.fee_produk_end*a.jumlah) as fee_produk FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
  $kupon = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
                              JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
                                where b.id_penjualan='$row[id_penjualan]'")->row_array();
  $cekbayar = $this->db->query("SELECT * FROM rb_penjualan a JOIN rb_penjualan_otomatis b ON a.kode_transaksi=b.kode_transaksi where a.kode_kurir!='0' AND b.kode_transaksi='$row[kode_transaksi]' AND b.pembayaran='1'");
  if($cekbayar->num_rows()>='1'){
    $alert = "Apa anda yakin untuk ubah status jadi Proses?";
  }else{
    $alert = "PENTING - Pembayaran pesanan ini belum kami terima, yakin ingin melanjutkan untuk diproses?";
  }
  if($row['kode_kurir']=='0'){
    $proses_dikirim = 3;
  }else{
    $proses_dikirim = 1;
  }
  $proses = strip_tags(status($row['proses']));
  if ($total['fee_produk']>0){ $fee_produk = $total['fee_produk']; }else{ $fee_produk = 0; }

  echo "<tr><td>$no</td>
            <td>$row[kode_transaksi]</td>
            <td><a href='".base_url().$this->uri->segment(1)."/detail_konsumen/$row[id_konsumen]'>$row[nama_lengkap]</a></td>
            <td style='text-transform:uppercase'>$row[kode_kurir]</td>
            <td><b>".status($row['proses']).'</b><br><small>'.status_pembayaran($row['proses'],$row['kode_transaksi'])."</small> </td>
            <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir']-$kupon['diskon']-$fee_produk)."</td>
            <td><center>";
            if ($row['proses']=='0' OR $row['proses']=='2'){
              echo "<a class='btn btn-primary btn-xs' title='Proses Data' href='".base_url().$this->uri->segment(1)."/proses_penjualan/$row[id_penjualan]/$proses_dikirim' onclick=\"return confirm('$alert')\" style='height:none'><span class='fa fa-star'></span></a>";
            }else{
              echo "<a class='btn btn-default btn-xs' title='Proses Data' href='#' onclick=\"return alert('Maaf, Pesanan ini ($row[kode_transaksi]) dalam status $proses!')\" style='height:none'><span class='fa fa-star'></span></a>";
            }
              echo " <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url().$this->uri->segment(1)."/detail_penjualan/$row[id_penjualan]' style='font-size:13px; padding:4px 10px'><span class='fa fa-search'></span></a>
            </center></td>
        </tr>";
    $no++;
  }
?>
</tbody>
</table><br><br>
                    