<div class="col-xs-12">  
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Daftar Komplain - Resolution Center</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
  <div class='table-responsive'>
    <table id="example1" class="table table-bordered table-striped table-condensed">
      <thead>
        <tr>
          <th style='width:40px'>No</th>
          <th>No Invoice</th>
          <th>Pelapor</th>
          <th>Terlapor</th>
          <th>Nominal</th>
          <th>Status</th>
          <th>Waktu Lapor</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
    <?php 
      $no = 1;
      foreach ($komplain->result_array() as $row){
      $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
      $kupon = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
                                  JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
                                    where b.id_penjualan='$row[id_penjualan]'")->row_array();
      $diskusi = $this->db->query("SELECT * FROM rb_pusat_bantuan_diskusi where id_pusat_bantuan='$row[id_pusat_bantuan]'")->num_rows();
      echo "<tr><td>$no</td>
                <td><a href='".base_url().$this->uri->segment('1')."/detail_penjualan_konsumen/$row[id_penjualan]'>$row[kode_transaksi]</a></td>
                <td><a href='".base_url().$this->uri->segment('1')."/detail_konsumen/$row[id_pelapor]'>$row[nama_lengkap]</a></td>
                <td><a href='".base_url().$this->uri->segment('1')."/detail_reseller/$row[id_terlapor]'>$row[nama_reseller]</a></td>
                <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir']-$kupon['diskon'])."</td>
                <td>$row[putusan]</td>
                <td>".jam_tgl_indo($row['waktu_report'])."</td>
                <td><center><a class='btn btn-success btn-xs' title='Detail Data' href='".base_url().$this->uri->segment(1)."/room/$row[id_pusat_bantuan]' style='font-size:13px; padding:2px 10px'><span class='fa fa-comments'></span> $diskusi Data</a>
                </center></td>
            </tr>";
        $no++;
      }
    ?>
    </tbody>
  </table>     
</div>            
</div>