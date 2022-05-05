<html>
<head>
<title>Data Keuangan dan Bonus Reward</title>
</head>
<body onload="window.print()">
<?php
$pembelian = $this->model_reseller->pembelian($this->session->id_reseller)->row_array();
$penjualan_perusahaan = $this->model_reseller->penjualan_perusahaan($this->session->id_reseller)->row_array();
$penjualan = $this->model_reseller->penjualan($this->session->id_reseller)->row_array();
$modal_perusahaan = $this->model_reseller->modal_perusahaan($this->session->id_reseller)->row_array();
$modal_pribadi = $this->model_reseller->modal_pribadi($this->session->id_reseller)->row_array();
$set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();

echo "<table class='table table-striped table-condensed'>
  <tr><td width='190px'>Belanja ke Perusahaan</td>                <td> : Rp ".rupiah($pembelian['total'])."</td></tr>
  <tr><td>Penjualan Produk Perusahaan</td>                        <td> : Rp ".rupiah($penjualan_perusahaan['total'])." (".rupiah($penjualan_perusahaan['produk'])." Produk)</td></tr>
  <tr><td>Modal Produk Perusahaan</td>                            <td> : Rp ".rupiah($modal_perusahaan['total'])."</td></tr>
  <tr><td>Penjualan Produk Pribadi</td>                           <td> : Rp ".rupiah($penjualan['total'])."</td></tr>
  <tr><td>Modal Produk Pribadi</td>                               <td> : Rp ".rupiah($modal_pribadi['total'])."</td></tr>

  <tr class='success'><td>Keuntungan </td>                        <td> : Rp ".rupiah(($penjualan['total']+$penjualan_perusahaan['total'])-($modal_perusahaan['total']+$modal_pribadi['total']))."</td></tr>
</table>

<div class='alert alert-success'>Data Penjual Referral Anda :</div>
<table class='table table-striped table-condensed table-bordered'>
  <tr style='background:#e3e3e3'>
      <th>No </th>
      <th>Nama Jualan / Penjual</th>
      <th>Penjualan Produk Perusahaan</th>
      <th>Bonus Anda $set[referral]%</th>
  </tr>";
$no = 1;
$total_jual = 0;
$total_bonus = 0;
$reseller = $this->db->query("SELECT * FROM rb_reseller where referral='".$this->session->username."'");
if ($reseller->num_rows()<=0){
  echo "<tr><td colspan='4'><center style='color:red; padding:40px'><i>Anda Belum Memiliki Jualan / Penjual Referral!,.. ^_^</i></center></td></tr>";
}else{
  foreach ($reseller->result_array() as $row) {
    $pp = $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan!='0' AND id_penjual='".$row['id_reseller']."' AND c.proses='1'")->row_array();
    $total_jual = $total_jual+$pp['total'];
    $total_bonus = $total_bonus+($set['referral']/100*$pp['total']);
    echo "<tr><td width='20px'>$no</td>
              <td><b>$row[nama_reseller]</b></td>  
              <td>: Rp ".rupiah($pp['total'])." (".rupiah($pp['produk'])." Produk)</td>
              <td>: Rp ".rupiah($set['referral']/100*$pp['total'])."</td>
          </tr>";
    $no++;
  }
}
$pen = $this->db->query("SELECT sum(bonus_referral) as pencairan FROM rb_pencairan_bonus where id_reseller='".$this->session->id_reseller."'")->row_array();
echo "<tr class='alert alert-danger'>
            <th colspan='2'>Total Penjualan</th> 
            <th>Rp ".rupiah($total_jual)."</th> 
            <th>Rp ".rupiah($total_bonus)."</th>
      </tr>
      <tr class='alert alert-success'>
            <th colspan='2'>Total Pencairan Dana</th> 
            <th></th> 
            <th>Rp ".rupiah($pen['pencairan'])."</th>
      </tr>
      <tr  class='danger'>
            <th colspan='2'>Sisa Bonus Referral</th> 
            <th></th> 
            <th>Rp ".rupiah($total_bonus-$pen['pencairan'])."</th>
      </tr>
  </table>";
?>

</body>
</html>                  