<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="#">Members</a></li>
                <li>Profile Kurir</li>
            </ul>
        </div>
    </div>
</div>
<div class="ps-vendor-dashboard pro" style='margin-top:10px'>
    <div class="container">
        <div class="ps-section__content">
            <?php include "menu-members.php"; ?>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 ">
                    <?php
                      
                      include "sidebar-members.php";
                      echo "<a href='".base_url()."members/daftar_sopir' class='ps-btn btn-block'><i class='icon-pen'></i> Daftar / Edit Data</a>";
                    ?><div style='clear:both'><br></div>
                </div>

                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 ">
                    <figure class="ps-block--vendor-status biodata">
                        <?php 
                          echo $this->session->flashdata('message'); 
                                $this->session->unset_userdata('message');
                          $cek_sopir = $this->db->query("SELECT a.*, b.nama_lengkap, b.no_hp, b.kecamatan_id, b.kota_id, c.jenis_kendaraan FROM rb_sopir a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen 
                                                          JOIN rb_jenis_kendaraan c ON a.id_jenis_kendaraan=c.id_jenis_kendaraan where a.id_konsumen='".$this->session->id_konsumen."'");
                          if ($cek_sopir->num_rows()>=1){
                            $rows = $cek_sopir->row_array();
                            $sopir = $this->db->query("SELECT id_sopir FROM rb_sopir where id_konsumen='".$this->session->id_konsumen."'")->row_array();
                            $cek_pesanan_sopir = $this->db->query("SELECT * FROM rb_penjualan a WHERE a.kurir='$sopir[id_sopir]' AND a.proses!='4' AND service='SOPIR'")->num_rows();
                            if ($cek_pesanan_sopir>=1){
                                echo "<p style='font-size:17px'> <div style='border-left:5px solid' class='alert alert-danger'><strong>PENTING</strong> - Ada <span class='badge badge-secondary' style='font-size:85%'>$cek_pesanan_sopir</span> Pesanan yang belum diselesaikan, <a style='color:#000; font-weight:bold' href='".base_url()."members/sopir_list'>Lihat disini</a>..</div>";
                            }else{
                              echo "<p style='font-size:17px'> <div style='border-left:5px solid' class='alert alert-success'><strong>INFORMASI</strong> - Untuk Melihat Laporan Pesanan silahkan klik, <a style='color:#000; font-weight:bold' href='".base_url()."members/sopir_list'>disini</a>..</div>";
                            }
                            echo "<p style='font-size:17px'>Hai <b>$row[nama_lengkap]</b>, selamat datang di halaman Data Kurir! <br>
                                                              Pastikan data profil sesuai dengan KTP untuk kemudahan dalam bertransaksi.</p><br>

                              <div class='form-group row' style='margin-bottom:5px'>
                              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Nama Lengkap</b></label>
                                <div class='col-sm-9'>
                                  $rows[nama_lengkap]
                                </div>
                              </div>
                              <div class='form-group row' style='margin-bottom:5px'>
                              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>No Hp</b></label>
                              <div class='col-sm-9'>
                                $rows[no_hp]
                              </div>
                              </div>
                              <div class='form-group row' style='margin-bottom:5px'>
                              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Daerah Pengiriman</b></label>
                              <div class='col-sm-9'>
                                ".(kecamatan($rows['kecamatan_id'],$rows['kota_id']) == '' ? '<i style="color:#cecece">Wajib Diisi untuk melacak rute,..</i>' : kecamatan($row['kecamatan_id'],$row['kota_id']))."
                              </div>
                              </div>
                              
                              <div class='form-group row' style='margin-bottom:5px'>
                              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Jenis</b></label>
                              <div class='col-sm-9'>
                                $rows[jenis_kendaraan]
                              </div>
                              </div>

                              <div class='form-group row' style='margin-bottom:5px'>
                              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Merek</b></label>
                              <div class='col-sm-9'>
                              $rows[merek]
                              </div>
                              </div>
                              
                              <div class='form-group row' style='margin-bottom:5px'>
                              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Plat Nomor</b></label>
                              <div class='col-sm-9'>
                              $rows[plat_nomor]
                              </div>
                              </div>
                              
                              <div class='form-group row' style='margin-bottom:5px'>
                              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Keterangan</b></label>
                              <div class='col-sm-9'>
                              ".($rows['lainnya']==''? '<i style="color:#cecece">Tidak ada keterangan,..</i>':$rows['lainnya'])."
                              </div>
                              </div>
                              
                              <div class='form-group row' style='margin-bottom:5px'>
                              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Lampiran / File</b></label>
                              <div class='col-sm-9'>";
                              if ($rows['lampiran'] != ''){ 
                                $exx = explode(';',$rows['lampiran']);
                                $hitungex1 = count($exx);
                                $noi = 1;
                                  for($i=0; $i<$hitungex1; $i++){
                                    if (file_exists("asset/images/".$exx[$i])) { 
                                        $files_bahantugas = $this->mylibrary->Size("asset/images/".$exx[$i]);
                                        echo "<p style='margin: 0 0 0px 11px;'>$noi). <a href='".site_url($this->uri->segment(1).'/download_file/images/'.$exx[$i])."'>$exx[$i]</a> ($files_bahantugas)</p>";
                                    }else{
                                        echo "<p style='margin: 0 0 0px 11px;'>$noi). <a href='#'><i>Maaf File '$exx[$i] (0)' Gagal Terkirim!</i></a></p>";
                                    }
                                    $noi++;
                                }
                              }
                              echo "</div>
                              </div>
                              
                              <div class='form-group row' style='margin-bottom:5px'>
                              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Status</b></label>
                              <div class='col-sm-9'>
                              ".($rows['aktif'] == 'N' ? '<i style="color:red">Non Aktif (Menunggu Verifikasi)</i>' : '<i style="color:green">Aktif (Ter-Verifikasi)</i>')."
                              </div>
                              </div>";
                          }else{
                            echo "<div class='alert alert-danger'><strong>PENTING</strong> - Halo kak! Mau ikutan jadi Kurir untuk mengantarkan pesanan?. <br> 
                                                                                    yuk isikan dulu data kendaraannya, Daftarkan Kendaraan <a href='".base_url()."members/daftar_sopir' style='color:#000'><b>disini</b></a>.</div><br>";
                                                                                    
                                  $page = $this->model_app->view_where('halamanstatis',array('id_halaman'=>3))->row_array();
                                  echo "<h3><b>$page[judul]</h3>
                                  $page[isi_halaman]";
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