<?php 
$proses = '<i class="text-danger">Pending</i>'; 
$total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.session='".$this->session->idp."'")->row_array();
?>
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="<?php echo base_url()."produk/keranjang"; ?>">Keranjang</a></li>
            <li><?php echo $title; ?></li>
        </ul>
    </div>
</div>
<div class="ps-section--shopping ps-shopping-cart">
    <div class="container">
        <div class="ps-section__content">
            <div class="table-responsive">
              <?php echo "<form action='".base_url()."produk/selesai_belanja' method='POST'>"; ?>
                <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 ">
                <?php 
                  echo "<center>Sudah Punya akun? <a href='#' style='text-decoration:underline' data-toggle='modal' data-target='.bd-example-modal-lg'>Login disini</a></center><hr><br>
                  
                  <div class='form-group row' style='margin-bottom:5px'>
                        <label class='col-sm-2 col-form-label' style='margin-bottom:1px; font-weight:bold'>Nama anda</label>
                        <div class='col-sm-10'>
                            <input type='text' name='nama' class='form-control form-mini' placeholder='- - - - - - - - -' autocomplete='off' required>
                        </div>
                        </div>
                        <div class='form-group row' style='margin-bottom:5px'>
                        <label class='col-sm-2 col-form-label' style='margin-bottom:1px; font-weight:bold'>Kontak</label>
                        <div class='col-sm-10'>
                            <div class='form-row'>
                                <div class='form-group col-md-6' style='margin-bottom:5px'>
                                    <input type='number' name='telpon' class='form-control form-mini' placeholder='No Hp/Telpon' autocomplete='off' required>
                                </div>
                                <div class='form-group col-md-6' style='margin-bottom:5px'>
                                <input type='email' name='email' class='form-control form-mini' placeholder='- - - - - - @mail.com' autocomplete='off' required>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class='form-group row'>
                        <label class='col-sm-2 col-form-label' style='margin-bottom:1px; font-weight:bold'>Alamat Kirim</label>
                        <div class='col-sm-10'>
                            <div class='form-row'>
                                <div class='form-group col-md-4' style='margin-bottom:5px'>
                                    <select class='form-control form-mini' name='provinsi' id='list_provinsi' required></select>
                                </div>
                                <div class='form-group col-md-4' style='margin-bottom:5px'>
                                    <select class='form-control form-mini' name='kota' id='list_kotakab' required></select>
                                </div>
                                <div class='form-group col-md-4' style='margin-bottom:5px'>
                                    <select class='form-control form-mini' name='kecamatan' id='list_kecamatan' required></select>
                                </div>
                            </div>
                            <input type='text' name='alamat' class='form-control form-mini' placeholder='Nama Jalan, No Rumah/Kantor anda..' autocomplete='off' required>
                        </div>
                        </div>
                  
                        <div style='padding:5px; font-size:16px; font-weight:bold; background:#f4f4f4; border-bottom:1px solid #ab0534; margin-bottom:10px;'>Data Produk</div>";
                
                          $no = 1;
                          foreach ($record as $row){
                            $re = $this->model_app->view_where('rb_reseller',array('id_reseller'=>$row['id_reseller']))->row_array();
                            $sub_total = (($row['harga_jual']-$row['diskon'])*$row['jumlah']);
                            $ex = explode(';', $row['gambar']);
                            if ($row['pre_order']!='' AND $row['pre_order']>0){
                                $pre_order = "<span class='badge badge-secondary'>Pre-Order $row[pre_order] Hari</span>";
                            }else{
                                $pre_order = "";
                            }
                            if (trim($ex[0])==''){ $foto_produk = 'no-image.png'; }else{ if (!file_exists("asset/foto_produk/thumb_".$ex[0])){ $foto_produk = $ex[0]; }else{ $foto_produk = "thumb_".$ex[0]; }}
                            echo "<a style='font-size:17px; display:block; border-bottom:1px dotted' href='".base_url()."produk/detail/$row[produk_seo]'>$row[nama_produk]</a>
                                  <div class='ps-product--cart'>
                                      <input type='hidden' name='id$no' value='$row[id_penjualan_detail]'> 
                                      <div class='ps-product__thumbnail'>
                                          <div style='height:60px; overflow:hidden'><a href='".base_url()."produk/detail/$row[produk_seo]'><img style='padding-right:10px' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a></div>
                                          
                                      </div>
                                      
                                      <div class='ps-product__content' style='text-align:left; padding-left:0px'>
                                          <p style='margin-bottom:0'>$row[nama_reseller] $pre_order</p>
                                          <b>Qty.</b> $row[jumlah] x : ".rupiah($row['harga_jual']-$row['diskon'])." = <b>".rupiah($sub_total)."</b><br>";
                                          $catatan = explode('||',$row['keterangan_order']);
                                            // $variasi = $this->db->query("SELECT * FROM rb_produk_variasi where id_produk='$row[id_produk]' ORDER BY id_variasi ASC");
                                            // if ($variasi->num_rows()>0){
                                            //     $noo = 1;
                                            //     $ex = explode(';',$catatan[1]);
                                            //     for ($ii=0; $ii < count($ex) ; $ii++) { 
                                            //         $exx = explode('|',$ex[$ii]);
                                            //         $variasi_terpilih[] = trim($exx[0]);
                                            //     }
                                            //     foreach ($variasi->result_array() as $va) {
                                            //         if ($noo%2 == 1){ $bg = '#e3e3e3'; }else{ $bg = '#f4f4f4'; }
                                            //         echo "<div style='background:$bg; padding:3px 10px; display:inline-block'><b>$va[nama]</b> : "; 
                                            //         $variasi = explode(";",$va['variasi']);
                                            //         for ($i=0; $i < count($variasi) ; $i++) { 
                                            //             $nama_variasi = "variasi".$noo.$i.$no;
                                            //             $_ck = (array_search($nama_variasi, $variasi_terpilih) === false)? '' : 'checked';
                                            //             if ($_ck=='checked'){
                                            //             echo "<span style='color:blue'>".$variasi[$i]."</span> &nbsp; ";
                                            //             }
                                            //         }
                                            //         echo "</div>";
                                            //         $noo++;
                                            //     }
                                            //     echo "<br>";
                                            // }
                                            if (trim($catatan[1])!=''){
                                                echo "<b>Variasi</b> : ".$catatan[1].'<br>';
                                            }
                                            if (trim($catatan[0])!=''){
                                                echo "<b>Catatan</b> : ".$catatan[0];
                                            }
                                      echo "</div>
                                  </div><br>";
                              $no++;
                          }
                ?>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                    <div class="ps-block--shopping-total">
                        <div class="ps-block__content">
                            <ul class="ps-block__product">
                                <?php
                                  if ($this->session->idp != ''){
                                    //echo "<div class='widget'><h3>Anda Belanja dari ".$reseller_order->num_rows()." Jualan</h3></div>";
                                    $noo = 1;
                                    $reseller_order = $this->db->query("SELECT a.*, e.nama_reseller, e.alamat_lengkap, e.keterangan, e.kecamatan_id, e.kota_id, e.pilihan_kurir, b.id_reseller, c.nama_kota, d.nama_provinsi FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk 
                                    JOIN rb_reseller e ON b.id_reseller=e.id_reseller
                                    JOIN rb_kota c ON e.kota_id=c.kota_id 
                                    JOIN rb_provinsi d ON c.provinsi_id=d.provinsi_id where a.session='".$this->session->idp."' GROUP BY b.id_reseller"); 
                                    foreach ($reseller_order->result_array() as $res) {
                                      $ber = $this->db->query("SELECT sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.session='".$this->session->idp."' AND b.id_reseller='$res[id_reseller]'")->row_array();
                                      $kota_asal[] = $res['kota_id'];
                                      $berat[] = $ber['total_berat'];
                          
                                      echo "<div class='form-group'>
                                            <label style='display:block'>
                                            <div class='pelapak'>
                                              <p style='margin-bottom:0px'>Jualan : <b>$res[nama_reseller]</b></p>
                                              Alamat : ".kecamatan($res['kecamatan_id'],$res['kota_id'])."<br>
                                              <input type='hidden' name='toko$noo' value='$res[id_reseller]'>
                                            </div>
                                            </label>
                                            <label style='display:block; cursor:pointer; margin-bottom:0rem'>
                                              <input type='checkbox' name='kurir' class='kurir$noo' value='cod'/> <span style='display:inline-block'>Kirim via COD (Bayar Di tempat)</span>
                                            </label>
                                              <select class='form-control form-mini text-success' name='kode_kurir$noo' id='list_kurir$noo' style='margin-bottom: 2px'>
                                              <option value='0'>- Kirim via Kurir Lainnya -</option>";
                                                    $kurir_data = $this->model_app->view_ordering('rb_kurir','id_kurir','ASC');
                                                    if ($res['pilihan_kurir']==''){
                                                        foreach ($kurir_data as $rowk) {
                                                        echo "<option value='$rowk[kode_kurir]'>$rowk[nama_kurir]</option>";
                                                        }
                                                    }else{
                                                        $kurir_terpilih = explode(',',$res['pilihan_kurir']);
                                                        foreach ($kurir_data as $rowk) {
                                                        foreach ($kurir_terpilih as $select_option){
                                                            if($rowk['id_kurir'] == $select_option) {
                                                            echo "<option value='$rowk[kode_kurir]'>$rowk[nama_kurir]</option>";
                                                            break;
                                                            }
                                                        }
                                                        }
                                                    }

                                            echo "</select>
                                              <ul class='list-group list-group-flush'>
                                                  <div id='list_kurir_div$noo'></div>
                                              </ul>
                                              <ul class='list-group list-group-flush' id='kurir-list$noo'>";
                                                  if ($this->session->id_konsumen==''){
                                                    $cod = $this->db->query("SELECT * FROM rb_reseller_cod where id_reseller='$res[id_reseller]'");
                                                  }else{
                                                    $ress = $this->model_reseller->penjualan_konsumen_detail($this->session->idp)->row_array();
                                                    $cod = $this->db->query("SELECT * FROM rb_reseller_cod where id_reseller='$res[id_reseller]'");
                                                  }
                                                  $service = 1;
                                                  foreach ($cod->result_array() as $ros) {
                                                    echo '<li  id="'.$noo.$idn.'serv-'.$service.'" class="list-group-item clearall-kurir" style="cursor:pointer; margin:1px; padding-bottom: 10px; " onclick="klikongkir'.$noo.'(\'COD (Cash on delivery)\',\''.$ros['nama_alamat'].'\',\''.$ros['biaya_cod'].'\',\''.number_format($ros['biaya_cod'],0).'\',this.id)">
                                                              <span style="color:black;font-weight:bold">COD - '.$ros['nama_alamat'].'</span><small><b>Tarif.</b> <b style="color:red">Rp '.number_format($ros['biaya_cod'],0).'</b> - Ambil Ditempat</small>
                                                        </li>';
                                                    $service++;
                                                  }
                          
                                                  if ($cod->num_rows()<=0){
                                                    echo "<center style='color:red'>COD Tidak Tersedia!</center>";
                                                  }
                          
                                              echo "</ul>
                                              
                                          </div>";
                                      $noo++;
                                    }
                                  }
                                ?>
                            </ul>
                            <hr>
                            <div class="ps-block__header">
                                <p style='margin-bottom:0px'>Berat<span> <?php echo "$total[total_berat] Gram"; ?></span></p>
                                <p style='margin-bottom:0px'>Ongkos Kirim <span> <input type='text' id='ongkir_view' style='background:none; text-align:right; width:110px' value='0' disabled/></span></p>
                                <?php 
                                  $ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
                                  $fv = explode('|',$ref['keterangan']);
                                  if ($fv[0]>'0'){
                                    $fee_admin = $fv[0];
                                    echo "<p style='margin-bottom:0px'>Fee Admin <span>Rp ".rupiah($fv[0])."</span></p>";
                                  }else{
                                    $fee_admin = 0;
                                  }
                                ?>
                                <p>Subtotal <span> <?php echo "Rp ".rupiah($total['total']-$total['diskon_total']); ?></span></p>
                            </div>
                            <h3>Total <span id='totalbayar'></span></h3>
                        </div>
                    </div>
                    <button type='submit' name='submit' id='oksimpan' style='display: none' class="ps-btn ps-btn--fullwidth">Proses Pembayaran</a>
                    <button type='button' id='oksimpanx' style='background:#e3e3e3; color:#000' class="ps-btn ps-btn--fullwidth oksimpanx">Proses Pembayaran</a>
                </div>
                </div>
                <?php 
                  echo "<input type='hidden' id='fee_admin' value='$fee_admin'/>
                        <input type='hidden' name='total' id='total' value='$total[total]'/>
                        <input type='hidden' name='ongkir' id='ongkir' style='color:red' value=''/>
                        <input type='hidden' name='berat' value='$total[total_berat]'/>
                        <input type='hidden' name='diskonnilai' id='diskonnilai' value='$diskon_total'/>
                        <input type='hidden' name='ongkir1' id='ongkir1' value='0'/>
                        <input type='hidden' name='service1' id='service1'/>
                        <input type='hidden' name='kurir1' id='kurir1'/>
                        <input type='hidden' name='ongkir2' id='ongkir2' value='0'/>
                        <input type='hidden' name='service2' id='service2'/>
                        <input type='hidden' name='kurir2' id='kurir2'/>
                        <input type='hidden' name='ongkir3' id='ongkir3' value='0'/>
                        <input type='hidden' name='service3' id='service3'/>
                        <input type='hidden' name='kurir3' id='kurir3'/>
                        <div class='kota'></div>";
                ?>
                </form>
            </div>
        </div>
        <hr>
    </div>
</div>


<script>
/*$(document).ready(function(){
    $("#submit").on("click", function(){
    var a = parseInt($('#a').val());
    var b = parseInt($('#b').val());
        var sum = a + b;
        $("#ongkir").val(sum);
    })
})*/
$("#form_alamat").hide();

$("#kurir-list1").hide();
$(".kurir1").change(function(){
    $("#kurir-list1").toggle();
});

$("#kurir-list2").hide();
$(".kurir2").change(function(){
    $("#kurir-list2").toggle();
});

$("#kurir-list3").hide();
$(".kurir3").change(function(){
    $("#kurir-list3").toggle();
});

function klikongkir1(data,detail,harga,harga_rp,id){
  $("#ongkir1").val(harga);
  $(".clearall-kurir").removeClass("selected-ongkir1");
  $('#'+id).addClass("selected-ongkir1");
  $('#service1').val(detail);
  $('#kurir1').val(data);
  var val1 = +$("#ongkir1").val();
  var val2 = +$("#ongkir2").val();
  var val3 = +$("#ongkir3").val();
  $("#ongkir").val(val1+val2+val3);
  $("#ongkir_view").val(toDuit(val1+val2+val3));
  $("#oksimpan").show();
  $("#oksimpanx").hide();
  hitung();
}

function klikongkir2(data,detail,harga,harga_rp,id){
  $("#ongkir2").val(harga);
  $(".clearall-kurir").removeClass("selected-ongkir2");
  $('#'+id).addClass("selected-ongkir2");
  $('#service2').val(detail);
  $('#kurir2').val(data);
  var val1 = +$("#ongkir1").val();
  var val2 = +$("#ongkir2").val();
  var val3 = +$("#ongkir3").val();
  $("#ongkir").val(val1+val2+val3);
  $("#ongkir_view").val(toDuit(val1+val2+val3));
  $("#oksimpan").show();
  $("#oksimpanx").hide();
  hitung();
}

function klikongkir3(data,detail,harga,harga_rp,id){
  $("#ongkir3").val(harga);
  $(".clearall-kurir").removeClass("selected-ongkir3");
  $('#'+id).addClass("selected-ongkir3");
  $('#service3').val(detail);
  $('#kurir3').val(data);
  var val1 = +$("#ongkir1").val();
  var val2 = +$("#ongkir2").val();
  var val3 = +$("#ongkir3").val();
  $("#ongkir").val(val1+val2+val3);
  $("#ongkir_view").val(toDuit(val1+val2+val3));
  $("#oksimpan").show();
  $("#oksimpanx").hide();
  hitung();
}

$(document).ready(function(){
//* select Provinsi */
var base_url    = "<?php echo base_url();?>";
$.ajax({
    type: 'post',
    url: base_url + 'produk/rajaongkir_get_provinsi',
    data: {},
    dataType  : 'html',
    success: function (data) {
        $("#list_provinsi").html(data);
    }
});
/* select Provinsi */

$("#list_provinsi").change(function(){
    var id_province = this.value;
    kota(id_province);
    $("#div_kota").show();
});

/* select Kota */
kota = function(id_province){
    $.ajax({
    type: 'post',
    url: base_url + 'produk/rajaongkir_get_kota',
    data: {id_province:id_province},
    dataType  : 'html',
    success: function (data) {
        $("#list_kotakab").html(data);
    },
    beforeSend: function () {
        
    },
    complete: function () {
      
    }
});
}

$("#list_kotakab").change(function(){
    var id_kota = this.value;
    kecamatan(id_kota);
    $("#div_kecamatan").show();
});

kecamatan = function(id_kota){
    $.ajax({
    type: 'post',
    url: base_url + 'produk/rajaongkir_get_kecamatan',
    data: {id_kota:id_kota},
    dataType  : 'html',
    success: function (data) {
        $("#list_kecamatan").html(data);
    }
});
}

$("#list_kurir1").change(function(){
    var id_kurir     = this.value;
    var id_kecamatan      = $("#list_kecamatan").val();
    cost1(id_kurir,id_kecamatan);
    $("#div_kurir1").show();
});

cost1 = function(id_kurir,id_kecamatan){
    $.ajax({
    type: 'post',
    url: base_url + 'produk/rajaongkir_get_cost/1/<?php echo $kota_asal[0]; ?>/<?php echo $berat[0]; ?>',
    data: {kurir_pengiriman:id_kurir,kecamatan_tujuan:id_kecamatan},
    dataType  : 'html',
    success: function (data) {
        $("#list_kurir_div1").html(data);
    }
});
}

$("#list_kurir2").change(function(){
    var id_kurir     = this.value;
    var id_kecamatan      = $("#list_kecamatan").val();
    cost2(id_kurir,id_kecamatan);
    $("#div_kurir2").show();
});

cost2 = function(id_kurir,id_kecamatan){
    $.ajax({
    type: 'post',
    url: base_url + 'produk/rajaongkir_get_cost/2/<?php echo $kota_asal[1]; ?>/<?php echo $berat[1]; ?>',
    data: {kurir_pengiriman:id_kurir,kecamatan_tujuan:id_kecamatan},
    dataType  : 'html',
    success: function (data) {
        $("#list_kurir_div2").html(data);
    }
});
}

$("#list_kurir3").change(function(){
    var id_kurir     = this.value;
    var id_kecamatan      = $("#list_kecamatan").val();
    cost3(id_kurir,id_kecamatan);
    $("#div_kurir3").show();
});

cost3 = function(id_kurir,id_kecamatan){
    $.ajax({
    type: 'post',
    url: base_url + 'produk/rajaongkir_get_cost/3/<?php echo $kota_asal[2]; ?>/<?php echo $berat[2]; ?>',
    data: {kurir_pengiriman:id_kurir,kecamatan_tujuan:id_kecamatan},
    dataType  : 'html',
    success: function (data) {
        $("#list_kurir_div3").html(data);
    }
});
}

$(".alamat").click(function(){
    $("#form_alamat").toggle();
});

$("#diskon").html(toDuit(0));
hitung();
});

function hitung(){
    var diskon=$('#diskonnilai').val();
    var total=$('#total').val();
    var ongkir=$("#ongkir").val();
    var fee_admin=$("#fee_admin").val();
    if(parseFloat(ongkir) >= 0){
        $("#oksimpan").show();
    }else{
        $("#oksimpan").hide();
    }

    ongkir = ongkir || 0;
    var bayar=(parseFloat(total)+parseFloat(ongkir)+parseFloat(fee_admin));
    $("#totalbayar").html(toDuit(bayar));
}
</script>