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

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item"><a class="nav-link <?php echo ($_GET['page'] == '' ? 'active' : ''); ?>" href='<?= base_url(); ?>members/penjualan'>Menunggu Pembayaran <span class="badge badge-secondary"><?php echo total_penjualan_pending('0',reseller($this->session->id_konsumen)); ?></span></a></li>
                      <li class="nav-item"><a class="nav-link <?php echo ($_GET['page'] == 'siap' ? 'active' : ''); ?>" href='<?= base_url(); ?>members/penjualan?page=siap'>Lunas (Siap Dikirim) <span class="badge badge-secondary"><?php echo total_penjualan('1',reseller($this->session->id_konsumen)); ?></span></a></li>
                      <li class="nav-item"><a class="nav-link <?php echo ($_GET['page'] == 'dikirim' ? 'active' : ''); ?>" href='<?= base_url(); ?>members/penjualan?page=dikirim'>Sedang Dikirim <span class="badge badge-secondary"><?php echo total_penjualan('3',reseller($this->session->id_konsumen)); ?></span></a></li>
                      <li class="nav-item"><a class="nav-link <?php echo ($_GET['page'] == 'selesai' ? 'active' : ''); ?>" href='<?= base_url(); ?>members/penjualan?page=selesai'>Sampai Tujuan <span class="badge badge-secondary"><?php echo total_penjualan('4',reseller($this->session->id_konsumen)); ?></span></a></li>
                    </ul><br>


                      <?php if ($_GET['page']==''){ ?>
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
                        foreach ($menunggu->result_array() as $row){
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

                        if ($row['group_order']!=''){
                          $ex = explode('.',$row['group_order']);
                          $total_group = $this->db->query("SELECT * FROM rb_penjualan where group_order='$row[group_order]' AND proses!='0'");
                          if ($total_group->num_rows()>=$ex[1]){
                            $total_menunggu = "<i style='color:green'>(Kuota Group Order telah Terpenuhi!)</i>";
                          }else{
                            $total_menunggu = "<i style='color:red'>(Menunggu ".($ex[1]-$total_group->num_rows())." Orderan Lagi)</i>";
                          }

                          $kode_transaksi = "<a style='color:red' href='#' class='grouporder' data-id='$row[group_order]'>GROUP-<b>$row[group_order]</b></a>";
                        }else{
                          $kode_transaksi = $row['kode_transaksi'];
                        }

                        echo "<tr><td>$no</td>
                                  <td>$kode_transaksi</td>
                                  <td><a href='".base_url().$this->uri->segment(1)."/detail_konsumen/$row[id_konsumen]'>$row[nama_lengkap]</a></td>
                                  <td>".kurir($row['kode_kurir'],$row['kurir'],$row['service'])."</td>
                                  <td>".status($row['proses']).'<br><small>'.status_pembayaran($row['proses'],$row['kode_transaksi'])."</small> </td>
                                  <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir']-$kupon['diskon']-$fee_produk)."</td>";
                                  if ($row['group_order']!=''){
                                    echo "<td><center><a class='btn btn-success btn-xs grouporder' href='#' data-id='$row[group_order]' style='width:110px; font-size:13px; padding:2px 10px'><span class='fa fa-users'></span> Detail</a></center></td>";
                                  }else{
                                    echo "<td><center>";
                                      if ($row['proses']=='0' OR $row['proses']=='2'){
                                        echo "<a class='btn btn-primary btn-xs' title='Proses Data' href='".base_url().$this->uri->segment(1)."/proses_penjualan/$row[id_penjualan]/$proses_dikirim' onclick=\"return confirm('$alert')\"><span class='fa fa-star'></span></a>";
                                      }else{
                                        echo "<a class='btn btn-default btn-xs' title='Proses Data' href='#' onclick=\"return alert('Maaf, Pesanan ini ($row[kode_transaksi]) dalam status $proses!')\"><span class='fa fa-star'></span></a>";
                                      }
                                      echo " <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url().$this->uri->segment(1)."/detail_penjualan/$row[id_penjualan]' style='font-size:13px; padding:2px 10px'><span class='fa fa-search'></span> Detail</a>
                                    </center></td>";
                                  }
                              echo "</tr>";
                          $no++;
                        }
                      ?>
                      </tbody>
                    </table>
                    <?php } ?>

                    <?php if ($_GET['page']=='siap'){ ?>
                    <table id="example11" class="table table-striped table-sm iconset">
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
                        foreach ($diterima->result_array() as $row){
                        if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; $status = 'Proses'; $icon = 'star-empty'; $ubah = 1; }elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; $status = 'Pending'; $icon = 'star text-yellow'; $ubah = 0; }elseif($row['proses']=='3'){ 
                            $proses = '<i class="text-success">Dikirim</i>'; $status = 'Dikirim'; $icon = 'star text-yellow'; $ubah = 0; 
                        }else{ $proses = '<i class="text-info">Konfirmasi</i>'; $status = 'Proses'; $icon = 'star'; $ubah = 1; }
                        $total = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(a.fee_produk_end*a.jumlah) as fee_produk FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
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

                          $kode_transaksi = "<a style='color:red' href='#' class='grouporder' data-id='$row[group_order]'>GROUP-<b>$row[group_order]</b></a>";
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
                                    echo "<td><span style='text-transform:uppercase'>$row[kurir]</span> - $row[service]</td>";
                                  }
                                  echo "<td>".status($row['proses'])."</td>
                                  <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir']-$kupon['diskon']-$fee_produk)."</td>";
                                    if ($row['group_order']!=''){
                                      echo "<td><center><a class='btn btn-success btn-xs grouporder' href='#' data-id='$row[group_order]' style='font-size:13px; padding:2px 10px'><span class='fa fa-users'></span> Detail</a></center></td>";
                                    }else{
                                      echo "<td><center>
                                        <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url().$this->uri->segment(1)."/detail_penjualan/$row[id_penjualan]' style='font-size:13px; padding:2px 10px'><span class='fa fa-search'></span> Detail</a>
                                      </center></td>";
                                    }
                              echo "</tr>";
                          $no++;
                        }
                      ?>
                      </tbody>
                    </table>
                    <?php } ?>

                    <?php if ($_GET['page']=='dikirim'){ ?>
                    <table id="example12" class="table table-striped table-sm iconset">
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
                        foreach ($dikirim->result_array() as $row){
                        if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; $status = 'Proses'; $icon = 'star-empty'; $ubah = 1; }elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; $status = 'Pending'; $icon = 'star text-yellow'; $ubah = 0; }elseif($row['proses']=='3'){ 
                            $proses = '<i class="text-success">Dikirim</i>'; $status = 'Dikirim'; $icon = 'star text-yellow'; $ubah = 0; 
                        }else{ $proses = '<i class="text-info">Konfirmasi</i>'; $status = 'Proses'; $icon = 'star'; $ubah = 1; }
                        $total = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(a.fee_produk_end*a.jumlah) as fee_produk FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
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

                          $kode_transaksi = "<a style='color:red' href='#' class='grouporder' data-id='$row[group_order]'>GROUP-<b>$row[group_order]</b></a>";
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
                                    echo "<td><span style='text-transform:uppercase'>$row[kurir]</span> - $row[service]</td>";
                                  }
                                  echo "<td>".status($row['proses'])."</td>
                                  <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir']-$kupon['diskon']-$fee_produk)."</td>";
                                    if ($row['group_order']!=''){
                                      echo "<td><center><a class='btn btn-success btn-xs grouporder' href='#' data-id='$row[group_order]' style='font-size:13px; padding:2px 10px'><span class='fa fa-users'></span> Detail</a></center></td>";
                                    }else{
                                      echo "<td><center>
                                        <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url().$this->uri->segment(1)."/detail_penjualan/$row[id_penjualan]' style='font-size:13px; padding:2px 10px'><span class='fa fa-search'></span> Detail</a>
                                      </center></td>";
                                    }
                            echo "</tr>";
                          $no++;
                        }
                      ?>
                      </tbody>
                    </table>
                    <?php } ?>

                    <?php if ($_GET['page']=='selesai'){ ?>
                    <table id="example13" class="table table-striped table-sm iconset">
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
                        foreach ($selesai->result_array() as $row){
                        if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; $status = 'Proses'; $icon = 'star-empty'; $ubah = 1; }elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; $status = 'Pending'; $icon = 'star text-yellow'; $ubah = 0; }elseif($row['proses']=='3'){ 
                            $proses = '<i class="text-success">Dikirim</i>'; $status = 'Dikirim'; $icon = 'star text-yellow'; $ubah = 0; 
                        }else{ $proses = '<i class="text-info">Konfirmasi</i>'; $status = 'Proses'; $icon = 'star'; $ubah = 1; }
                        $total = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(a.fee_produk_end*a.jumlah) as fee_produk FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
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

                          $kode_transaksi = "<a style='color:red' href='#' class='grouporder' data-id='$row[group_order]'>GROUP-<b>$row[group_order]</b></a>";
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
                                    echo "<td><span style='text-transform:uppercase'>$row[kurir]</span> - $row[service]</td>";
                                  }
                                  echo "<td>".status($row['proses'])."</td>
                                  <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir']-$kupon['diskon']-$fee_produk)."</td>";
                                    if ($row['group_order']!=''){
                                      echo "<td><center><a class='btn btn-success btn-xs grouporder' href='#' data-id='$row[group_order]' style='font-size:13px; padding:2px 10px'><span class='fa fa-users'></span> Detail</a></center></td>";
                                    }else{
                                      echo "<td><center>
                                        <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url().$this->uri->segment(1)."/detail_penjualan/$row[id_penjualan]' style='font-size:13px; padding:2px 10px'><span class='fa fa-search'></span> Detail</a>
                                      </center></td>";
                                    }
                            echo "</tr>";
                          $no++;
                        }
                      ?>
                      </tbody>
                    </table>
                    <?php } ?>

                  </div>

              </div>
              </div>
              </div>
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
            $.post("<?php echo site_url()?>members/grouporder",
                {id:$(this).attr('data-id')},
                function(html){
                    $(".content-body").html(html);
                }   
            );
        });
    });
</script>   