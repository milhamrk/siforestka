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
        <?php 
          $attributes = array('class'=>'form-horizontal','role'=>'form');
          echo form_open_multipart($this->uri->segment(1).'/tambah_pembelian',$attributes); 
        ?>
          <table class="table table-striped table-condensed iconset">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Total</th>
                        <th width='80px'>Action</th>
                      </tr>
                    </thead>
                    <?php 
                        echo "<tr>
                                <td></td>
                                <input type='hidden' value='".$this->uri->segment(3)."' name='idpd'>
                                <td><select name='aa' class='combobox form-control form-mini' onchange=\"changeValue(this.value)\" autofocus>
                                                                      <option value='' selected> Cari Barang </option>";
                                                                      $jsArray = "var prdName = new Array();\n";    
                                                                      foreach ($barang as $r){
                                                                        if ($r['id_produk']==$row['id_produk']){
                                                                          echo "<option value='$r[id_produk]' selected>$r[nama_produk]</option>";
                                                                          $jsArray .= "prdName['" . $r['id_produk'] . "'] = {name:'" . addslashes($r['harga_reseller']) . "',desc:'".addslashes($r['satuan'])."'};\n";
                                                                        }else{
                                                                          echo "<option value='$r[id_produk]'>$r[nama_produk]</option>";
                                                                          $jsArray .= "prdName['" . $r['id_produk'] . "'] = {name:'" . addslashes($r['harga_reseller']) . "',desc:'".addslashes($r['satuan'])."'};\n";
                                                                        }
                                                                      }
                                                                   echo "</select> </td>
                                <td><input class='form-control form-mini' type='number' name='bb' value='$row[harga_jual]' id='harga' readonly='on'> </td>
                                <td><input class='form-control form-mini' type='number' name='dd' value='$row[jumlah]' required></td>
                                <td><input class='form-control form-mini' type='text' name='ee' id='satuan' value='$row[satuan]' readonly='on'> </td>
                                <td></td>
                                <td><button type='submit' name='submit' class='btn btn-success  btn-xs'><span class='fa fa-check' aria-hidden='true'></span></button>
                                </td>
                              </tr>
                            <tbody>";
                    echo form_close();
                    
                    $attributes = array('class'=>'form-horizontal','role'=>'form');
                    echo form_open_multipart($this->uri->segment(1).'/tambah_pembelian',$attributes); 
                    $no = 1;
                    foreach ($record as $row){
                    $sub_total = ($row['harga_jual']*$row['jumlah'])-$row['diskon'];
                    if (strlen($row['nama_produk']) > 48){ $judul = substr($row['nama_produk'],0,48).',..';  }else{ $judul = $row['nama_produk']; }
                    echo "<tr><td>$no</td>
                              <td><a target='_BLANK' href='".base_url()."produk/perusahaan_detail/$row[produk_seo]'>$judul</a></td>
                              <td>".rupiah($row['harga_jual'])."</td>
                              <td>$row[jumlah]</td>
                              <td>$row[satuan]</td>
                              <td>".rupiah($sub_total)."</td>
                              <td>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_pembelian_tambah_detail/$row[id_penjualan_detail]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='fa fa-remove'></span></a>
                              </td>
                          </tr>";
                      $no++;
                    }

                    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='".$this->session->idp."'")->row_array();
                    if (saldo(reseller($this->session->id_konsumen),$this->session->id_konsumen)>=$total['total']){
                      $disabled = '';
                      $checked = 'checked';
                    }else{
                      $disabled = 'disabled';
                      $checked = '';
                    }
                    echo "<tr class='success'>
                            <td colspan='5'><b>Total Belanja</b></td>
                            <td colspan='2'><b>".rupiah($total['total'])."</b></td>
                          </tr>
                          <tr class='success'>
                            <td colspan='5'><input type='checkbox' name='metode' value='saldo' $checked $disabled> <b>Gunakan Saldo untuk Membayar</b></td>
                            <td colspan='2'><b>".rupiah(saldo(reseller($this->session->id_konsumen),$this->session->id_konsumen))."</b></td>
                          </tr>";
                  ?>
                  </tbody>
                </table><hr><br>
                <button type='submit' name='selesai' class='ps-btn margin-btn spinnerButton' href=''>Selesai dan Proses</button>
                <a class='ps-btn ps-btn--black ml-3 margin-btn' href='<?php echo base_url(); ?>produk/perusahaan'>Lihat Produk perusahaan</a>
          <?php echo form_close(); ?>
          </div>
      </div>
        </div>
    </div>
</div>

              

<script type="text/javascript">    
<?php echo $jsArray; ?>  
  function changeValue(id){  
    document.getElementById('harga').value = prdName[id].name;  
    document.getElementById('satuan').value = prdName[id].desc;  
  };  
</script> 