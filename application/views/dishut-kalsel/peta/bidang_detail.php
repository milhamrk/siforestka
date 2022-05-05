
            <section class="col-lg-5 connectedSortable">
            
              <div class="box box-info">
                <div class="box-header">
                <i class="fa fa-th-list"></i>
                <h3 class="box-title">INFO DETAIL</h3>
                    <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                  <div class="box-body">
                  Berikut data marker yang anda pilih: <br><br>
                      <?php 
                      //$iden = $this->model_app->edit('identitas',array('id_identitas'=>'1'))->row_array();
                      //$rows = $this->model_app->edit('rb_reseller',array('id_reseller'=>$this->session->id_reseller))->row_array();
                      //if (trim($rows['foto'])==''){ $foto_user = 'users.gif'; }else{ $foto_user = $rows['foto']; } ?>
                      <dl class="dl-horizontal">
                          <dt>Username</dt>   <dd><?php echo $rows['id_produk']; ?></dd>
                          <dt>Password</dt>   <dd>********************</dd>
                          <dt>Nama Penjual</dt>   <dd><?php echo $rows['potensi']; ?></dd>
                          <dt>Jenis Kelamin</dt>   <dd><?php echo $rows['nama']; ?></dd>
                          <dt>Alamat</dt>   <dd><?php echo $rows['kelompok']; ?></dd>
                          <dt>No Telp/Hp</dt>   <dd><?php echo $rows['jenis']; ?></dd>
                          <dt>Alamat Email</dt>   <dd><?php echo $rows['kph']; ?></dd>
                          <dt>Kode POS</dt>   <dd><?php echo $rows['rph']; ?></dd>
                          <dt>Referral</dt>   <dd><?php echo $rows['kecamatan']; ?></dd>
						  <dt>Referral</dt>   <dd><?php echo $rows['desa']; ?></dd>
						  <dt>Referral</dt>   <dd><?php echo $rows['kabupaten']; ?></dd>
						  <dt>Referral</dt>   <dd><?php echo $rows['kwsn']; ?></dd>
						  <dt>Referral</dt>   <dd><?php echo $rows['unit']; ?></dd>
						  <dt>Referral</dt>   <dd><?php echo $rows['x']; ?></dd>
						  <dt>Referral</dt>   <dd><?php echo $rows['y']; ?></dd>
						  <dt>Referral</dt>   <dd><?php echo $rows['referral']; ?></dd>
						  <dt>Referral</dt>   <dd><?php echo $rows['referral']; ?></dd>
						  <dt>Referral</dt>   <dd><?php echo $rows['referral']; ?></dd>
						  <dt>Referral</dt>   <dd><?php echo $rows['referral']; ?></dd>
						  <dt>Referral</dt>   <dd><?php echo $rows['referral']; ?></dd>
						  <dt>Referral</dt>   <dd><?php echo $rows['referral']; ?></dd>
						  
                      </dl>
                    <hr style='margin:7px'>
                    <a class='btn btn-default btn-block' href="<?php echo base_url().$this->uri->segment(1); ?>/edit_reseller/<?php echo $this->session->id_reseller; ?>">Edit Profile</a>
                    <a target='_BLANK' class='btn btn-success btn-block' href="<?php echo base_url(); ?>produk/produk_reseller/<?php echo $this->session->id_reseller; ?>">Lihat Produk anda!</a>
                    <br><br>
                  </div>
              </div>

            </section><!-- /.Left col -->

            <section class="col-lg-7 connectedSortable">

            <div class="box box-success">
              <div class="box-header">
				  <i class="fa fa-th-list"></i>
				  <h3 class="box-title">F o t o</h3>
				  <div class="box-tools pull-right">
					  <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					  <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				  </div>
              </div>
              <!--
			  <div class="box-body">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Transaksi</th>
                        <th>Kurir</th>
                        <th>Status</th>
                        <th>Total + Ongkir</th>
                      </tr>
                    </thead>
                    <tbody>
                  < ?php 
                    $no = 1;
                    $record = $this->model_reseller->penjualan_list_konsumen_top($this->session->id_reseller,'reseller');
                    foreach ($record->result_array() as $row){
                    if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; $status = 'Proses'; $icon = 'star-empty'; $ubah = 1; }elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; $status = 'Pending'; $icon = 'star text-yellow'; $ubah = 0; }else{ $proses = '<i class="text-info">Konfirmasi</i>'; $status = 'Proses'; $icon = 'star'; $ubah = 1; }
                    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                    echo "<tr><td>$no</td>
                              <td><a href='".base_url().$this->uri->segment(1)."/detail_penjualan/$row[id_penjualan]'>$row[kode_transaksi]</a></td>
                              <td><span style='text-transform:uppercase'>$row[kurir]</span> - $row[service]</td>
                              <td>$proses</td>
                              <td style='color:red;'>Rp ".rupiah($total['total']+$row['ongkir'])."</td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
                <a class='btn btn-default btn-block' href='< ?php echo base_url().$this->uri->segment(1); ?>/penjualan'>Lihat Semua</a>
              </div>
			  -->
            </div>
            </section><!-- right col -->
            