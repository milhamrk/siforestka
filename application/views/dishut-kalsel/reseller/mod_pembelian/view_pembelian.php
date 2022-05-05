<div class="ps-page--single">
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="#">Members</a></li>
            <li><?php echo $title; ?></li>
        </ul>
    </div>
</div>
</div>
<div class="ps-vendor-dashboard pro" style='margin-top:10px'>
    <div class="container">
      <div class="ps-section__content">
        <?php 
          echo $this->session->flashdata('message'); 
          $this->session->unset_userdata('message');
        ?>
        <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br>
        <div class='table-responsive'>
        <a class='ps-btn margin-btn' href='<?php echo base_url(); ?>members/tambah_pembelian'>Tambah Pembelian</a>
        <table id="example1" class="table table-striped table-sm iconset">
          <thead>
            <tr>
              <th style='width:40px'>No</th>
              <th>Kode Transaksi</th>
              <th>Waktu Transaksi</th>
              <th>Status</th>
              <th>Total Tagihan</th>
              <th>Proses</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
        <?php 
          $no = 1;
          foreach ($record->result_array() as $row){
          if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; }elseif($row['proses']=='4'){ $proses = '<i class="text-success">Proses</i>'; }else{ $proses = '<i class="text-info">Konfirmasi</i>'; }
          $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
          if ($row['service']==''){ $service = "<i style='color:black'>Pembelian ke Pusat</i>"; }else{ $service = "<i style='color:blue'>$row[service]</i>"; }
          echo "<tr><td>$no</td>
                    <td><b>#$row[kode_transaksi]</b></td>
                    <td>$row[waktu_transaksi]</td>
                    <td>$proses</td>
                    <td>Rp ".rupiah($total['total'])."</td>
                    <td>$service</td>
                    <td><center>
                      <a style='margin-right:3px' class='btn btn-info btn-xs' title='Detail Data' href='".base_url().$this->uri->segment(1)."/detail_pembelian/$row[id_penjualan]'><span class='fa fa-search'></span></a>";
                      if ($row['proses']=='0'){
                        echo "<a class='btn btn-success btn-xs' title='Konfirmasi Pemabayaran' href='".base_url().$this->uri->segment(1)."/konfirmasi_pembayaran/$row[id_penjualan]'> <span class='fa fa-money'></span></a>
                              <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_pembelian/$row[id_penjualan]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='fa fa-remove'></span></a>";
                      }else{
                        echo "<a class='btn btn-default btn-xs' title='Konfirmasi Pemabayaran' href='#' onclick=\"return alert('Maaf, Transaksi ini sudah di konfirmasi untuk pembayarannya!')\"> <span class='fa fa-money'></span></a>
                              <a class='btn btn-default btn-xs' title='Delete Data' href='#' onclick=\"return alert('Maaf, Transaksi ini sudah di proses dan tidak bisa di-hapus!')\"><span class='fa fa-remove'></span></a>"; 
                      }
                    echo "</center></td>
                </tr>";
            $no++;
          }
        ?>
        </tbody>
        </table>
      </div>
      </div>
        </div>
    </div>
</div>