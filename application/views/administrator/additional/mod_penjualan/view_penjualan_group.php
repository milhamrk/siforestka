<?php 
if (cetak($this->input->post('id'))!=''){
  $ex = explode('.',cetak($this->input->post('id')));
  $total_group = $this->db->query("SELECT * FROM rb_penjualan where group_order='".cetak($this->input->post('id'))."' AND proses!='0'");
  if ($total_group->num_rows()>=$ex[1]){
    $total_menunggu = "<i style='color:green'>Kuota Group Order telah Terpenuhi!</i>";
  }else{
    $total_menunggu = "<i style='color:red'>Menunggu ".($ex[1]-$total_group->num_rows())." Orderan Lagi</i>";
  }
  $exx = explode(':',cetak($this->input->post('id')));
  $kode_transaksi = "<a style='color:red' href='#' class='grouporder' data-id='$row[group_order]'>GROUP-<b>$row[group_order]</b></a>";
  echo "<table class='table table-condensed'>
          <tr><td width='120px'><b>Kode Group</b></td> <td>".$exx[1]."</td></tr>
          <tr><td width='120px'><b>Group</b></td> <td>Beli Ber-".$ex[1]."</td></tr>
          <tr><td width='120px'><b>Status</b></td> <td>$total_menunggu</td></tr>
        </table><br>";
}
?>


<table id="example1" class="table table-striped table-condensed">
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
            <td><center>
            <div class='btn-group'>
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
              <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url().$this->uri->segment(1)."/detail_penjualan_konsumen/$row[id_penjualan]'><span class='fa fa-search'></span></a>
            </center></td>
        </tr>";
    $no++;
  }
?>
</tbody>
</table><br><br>
                    