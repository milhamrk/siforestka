<html>
<head>
<title>Laporan penjualan <?= bulan($_GET['bulan']); ?></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/printer.css">
</head>
<body onload="window.print()">
<h2><center>Laporan Penjualan Bulan  <?= bulan($_GET['bulan']); ?></center></h2>
<table id='tablemodul1' width=100% border=1>
  <thead>
    <tr>
      <th style='width:40px'>No</th>
      <th>Kode Transaksi</th>
      <th>Konsumen</th>
      <th>Kurir</th>
      <th>Status</th>
      <th>Total + Ongkir</th>
      <th>Waktu Transaksi</th>
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

      $kode_transaksi = "GROUP-<b>$row[group_order]</b>";
    }else{
      $kode_transaksi = $row['kode_transaksi'];
    }
    echo "<tr><td>$no</td>
            <td>$kode_transaksi</td>
            <td>$row[nama_lengkap]</td>";
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
        </tr>";
    $no++;
  }
?>
</tbody>
</table>
<?php 
  if ($record->num_rows()<=0){
    echo "<center style='padding:10% 0px'>Belum ada data penjualan pada bulan <b>".bulan($_GET['bulan'])."</b>...</center>";
  }
?>
</body>
</html> 