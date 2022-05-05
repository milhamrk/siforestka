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
      <?php include "menu-members.php"; ?>
        <?php 
          echo $this->session->flashdata('message'); 
          $this->session->unset_userdata('message');
        ?>

        <div class="row">
          <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 ">
              <?php
                include "sidebar-members.php";
                echo "<a href='".base_url()."members/tambah_withdraw' class='ps-btn btn-block'><i class='icon-pen'></i> Buat Permintaan</a>";
              ?><div style='clear:both'><br></div>
          </div>

          <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 ">
        <div class='table-responsive'>
        <table id="example1" class="table table-striped table-sm iconset">
          <thead>
            <tr>
              <th style='width:20px'>No</th>
              <th colspan='3'>Keterangan</th>
              <th>Nominal</th>
              <th>Status</th>
              <th>Jenis</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
        <?php 
          $no = 1;
          foreach ($record->result_array() as $row){
          if ($row['transaksi']=='debit'){ $color =  'red'; }else{ $color = 'green'; }
          if ($row['status']=='Sukses'){ $color_status =  'green'; }else{ $color_status = '#cecece'; }
          $ex = explode(';',$row['keterangan']);
          echo "<tr><td>$no</td>";
                  if ($row['id_rekening_reseller']=='0' AND $row['transaksi']=='debit'){
                    $cek_status = $this->db->query("SELECT id_penjualan FROM rb_penjualan where kode_transaksi='$row[keterangan_order]' AND status_pembeli='konsumen'");
                    if ($cek_status->num_rows()>=1){
                      $url_order = "konfirmasi/tracking/$row[keterangan_order]";
                    }else{
                      if ($row['akun']=='konsumen'){
                        $exk = explode('-',$row['keterangan_order']);
                        $kode_transaksi = trim($exk[0]);
                        $url_order = "konfirmasi/tracking/".$kode_transaksi;
                      }else{
                        $rew = $this->db->query("SELECT id_penjualan FROM rb_penjualan where kode_transaksi='$row[keterangan_order]' AND status_pembeli='reseller'")->row_array();
                        $url_order = "members/detail_pembelian/$rew[id_penjualan]";
                      }
                      
                    }

                    echo "<td><small style='color:green'>".jam_tgl_indo($row['waktu_withdraw'])."</small><br>Pembayaran Order</td>
                          <td><a style='color:blue; text-decoration:underline' target='_BLANK' href='".base_url().$url_order."'>$row[keterangan_order]</a></td>
                          <td>-</td>";
                  }else{
                    if ($row['transaksi']=='debit'){
                      echo "<td><small style='color:green'>".jam_tgl_indo($row['waktu_withdraw'])."</small><br>$ex[0]</td>
                            <td>$ex[1]</td>
                            <td>$ex[2]</td>";
                    }elseif ($row['transaksi']=='kredit' AND $row['id_rekening_reseller']=='0'){
                      echo "<td><small style='color:green'>".jam_tgl_indo($row['waktu_withdraw'])."</small><br>Via IPAYMU.COM</td>
                            <td>Payment Gateway</td>";
                            if ($row['status']!='Sukses'){
                              echo "<td><a target='_BLANK' class='btn btn-default ipaymu' style='border:1px solid #d2d2d2; background:#fff; font-size:14px; color:red' href='".base_url()."konfirmasi/deposit?inv=$row[id_withdraw]'><i class='icon-enter'></i> Bayarkan</a></td>";
                            }else{
                              echo "<td></td>";
                            }
                    }else{
                      $rek = $this->model_app->view_where('rb_rekening',array('id_rekening'=>$row['id_rekening_reseller']))->row_array();
                      echo "<td><small style='color:green'>".jam_tgl_indo($row['waktu_withdraw'])."</small><br>$rek[nama_bank]</td>
                            <td>$rek[no_rekening]</td>
                            <td>$rek[pemilik_rekening]</td>";
                    }
                  }
                    echo "<td><b>".rupiah($row['nominal']-$row['withdraw_fee'])."</b></td>
                    <td style='color:$color_status'><i>$row[status]</i></td>
                    <td style='color:$color'>$row[transaksi]</td>
                    <td><a class='ps-btn detail-keuangan' data-id='$row[id_withdraw]' href='#'><i class='icon-magnifier'></i></a></td>
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

<div class="modal fade bd-example-modal-lg detail-modal" style='z-index:99999' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
        $(document).on('click','.detail-keuangan',function(e){
            e.preventDefault();
            $(".detail-modal").modal('show');
            $.post("<?php echo site_url()?>members/detail_keuangan",
                {id:$(this).attr('data-id')},
                function(html){
                    $(".content-body").html(html);
                }   
            );
        });
    });
</script>