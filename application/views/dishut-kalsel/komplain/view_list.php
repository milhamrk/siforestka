<style>div.container {
        width: 80%;
    }</style>
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
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 penjualan"><br>
        <div class='table-responsive'>
          <table id="example1" class="table table-striped table-sm iconset">
            <thead>
              <tr>
                <th style='width:40px'>No</th>
                <th>No Invoice</th>
                <th>Seller/Buyer</th>
                <th>Nominal</th>
                <th>Diskusi</th>
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
                      <td>$row[kode_transaksi]</td>
                      <td><a href='#'>$row[nama]</a></td>
                      <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir']-$kupon['diskon'])."</td>
                      <td>$ro<span class='fa fa-comments'></span> $diskusi Data</td>
                      <td>$row[putusan]</td>
                      <td style='color:red;'>".jam_tgl_indo($row['waktu_report'])."</td>
                      <td><center><a class='btn btn-success btn-xs' title='Detail Data' href='".base_url()."komplain/room/$row[id_pusat_bantuan]' style='font-size:13px; padding:2px 10px'><span class='fa fa-search'></span> Detail</a>
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
    </div>
  </div>
</div>
              