<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="#">Members</a></li>
                <li>Rekening Bank</li>
            </ul>
        </div>
    </div>
</div>
<div class="ps-vendor-dashboard pro" style='margin-top:10px'>
    <div class="container">
        <div class="ps-section__content">
            <?php include "menu-members.php"; ?>
            <!--<form class="ps-form--vendor-datetimepicker" action="index.html" method="get">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text" id="time-from">From</span></div>
                            <input class="form-control ps-datepicker" aria-label="Username" aria-describedby="time-from">
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text" id="time-form">To</span></div>
                            <input class="form-control ps-datepicker" aria-label="Username" aria-describedby="time-to">
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
                        <button class="ps-btn"><i class="icon-sync2"></i> Update</button>
                    </div>
                </div>
            </form>-->
            
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 ">
                    <?php
                      if (trim($row['foto'])=='' OR !file_exists("asset/foto_user/".$row['foto'])){
                        echo "<img class='img-thumbnail' style='width:100%' src='".base_url()."asset/foto_user/blank.png'>";
                      }else{
                        echo "<img class='img-thumbnail' style='width:100%' src='".base_url()."asset/foto_user/$row[foto]'>";
                      }
                      echo "<a href='".base_url()."members/tambah_rekening_bank' class='ps-btn btn-block'><center><i class='icon-pen'></i> Tambahkan Rekening</center></a>";
                    ?><div style='clear:both'><br></div>
                </div>

                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 ">
                    <figure class="ps-block--vendor-status biodata">
                        <?php 
                            echo "<p style='font-size:17px'>Hai <b>$row[nama_lengkap]</b>, selamat datang di halaman Biodata diri! <br>
                                                            Pastikan data profil sesuai dengan KTP untuk kemudahan dalam bertransaksi.</p><br>";

                            if ($record->num_rows()<=0){
                                echo "<div class='alert alert-danger'><strong>PENTING</strong> - Halo kak! Data rekening bank-nya di isi ya. <br> Biar lebih enak transaksinya, yuk klik <a href='".base_url()."members/tambah_rekening_bank' style='color:#000'><b>disini</b></a>.</div>";
                            }

                            foreach ($record->result_array() as $rows) {
                              $ex = explode(';', $rows['keterangan']);
                              echo "<div class='form-group row' style='margin-bottom:5px'>
                                    <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Nama Bank</b></label>
                                      <div class='col-sm-10'>
                                      <b>".($ex[0] == '' ? '-' : $ex[0])."</b> 
                                      <a onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\" href='".base_url()."members/delete_rekening_bank/$rows[id_konsumen_detail]' class='pull-right' style='color:red; margin-left:10px'> Delete</a>
                                      <a href='".base_url()."members/edit_rekening_bank/$rows[id_konsumen_detail]' class='pull-right'><i class='icon-pen'></i> Edit</a>
                                      </div>
                                    </div>

                                    <div class='form-group row' style='margin-bottom:5px'>
                                    <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>No Rekening</b></label>
                                      <div class='col-sm-10'>
                                      ".($ex[1] == '' ? '-' : $ex[1])."
                                      </div>
                                    </div>
                                    
                                    <div class='form-group row' style='margin-bottom:5px'>
                                    <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Atas Nama</b></label>
                                      <div class='col-sm-10'>
                                      ".($ex[2] == '' ? '-' : $ex[2])."
                                      </div>
                                    </div><br>";
                            }
                        ?>
                    </figure>
                </div>
              
            </div>
        </div>
    </div>
</div>












<?php 
/*
echo "<table id='example11' class='table table-hover table-condensed'>
  <thead>
    <tr>
      <th width='20px'>No</th>
      <th>Nama Penjual</th>
      <th>Belanja & Ongkir</th>
      <th>Status</th>
      <th>Total + Ongkir</th>
      <th></th>
    </tr>
  </thead>
  <tbody>";

      $no = 1;
      $record = $this->model_reseller->orders_report($this->session->id_konsumen,'reseller');
      foreach ($record->result_array() as $row){
      if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; }elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; }else{ $proses = '<i class="text-info">Konfirmasi</i>'; }
      $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
      echo "<tr><td>$no</td>
                <td><a href='".base_url()."members/detail_reseller/$row[id_reseller]'><small><b>$row[nama_reseller]</b></small><br><small class='text-success'>$row[kode_transaksi]</small></a></td>
                <td><span style='color:blue;'>Rp ".rupiah($total['total'])."</span> <br> <small><i style='color:green;'><b style='text-transform:uppercase'>$row[kurir]</b> - Rp ".rupiah($row['ongkir'])."</i></small></td>
                <td>$proses <br><small>$row[nama_reseller]</small></td>
                <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir'])."</td>
                <td width='130px'>";
                if ($row['proses']=='0'){
                  echo "<a style='margin-right:3px' class='btn btn-success btn-sm' title='Konfirmasi Pembayaran' href='".base_url()."konfirmasi?kode=$row[kode_transaksi]'>Konfirmasi</a>";
                }else{
                  echo "<a style='margin-right:3px' class='btn btn-default btn-sm' href='#'  onclick=\"return confirm('Maaf, Pembayaran ini sudah di konfirmasi!')\">Konfirmasi</a>";
                }
              
              echo "<a class='btn btn-info btn-sm' title='Detail data pesanan' href='".base_url()."members/keranjang_detail/$row[id_penjualan]'><span class='glyphicon glyphicon-search'></span></a></td>
            </tr>";
        $no++;
      }

  echo "</tbody>
</table>"; */
?>