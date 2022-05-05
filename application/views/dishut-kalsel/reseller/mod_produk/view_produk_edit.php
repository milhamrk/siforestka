<script language="JavaScript" type="text/JavaScript">
  function showSub(){
    <?php
    $query = $this->db->query("SELECT * FROM rb_kategori_produk");
    foreach ($query->result_array() as $data) {
       $id_kategori_produk = $data['id_kategori_produk'];
       echo "if (document.demo.a.value == \"".$id_kategori_produk."\")";
       echo "{";
       $query_sub_kategori = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$id_kategori_produk'");
       $content = "document.getElementById('sub_kategori_produk').innerHTML = \"  <option value=''>- Pilih Sub Kategori Produk -</option>";
       foreach ($query_sub_kategori->result_array() as $data2) {
           $content .= "<option value='".$data2['id_kategori_produk_sub']."'>".$data2['nama_kategori_sub']."</option>";
       }
       $content .= "\"";
       echo $content;
       echo "}\n";
    }
    ?>
    }
</script>

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
            $attributes = array('class'=>'biodata','role'=>'form','name'=>'demo');
            echo form_open_multipart('members/edit_produk',$attributes);
          echo $this->session->flashdata('message'); 
          $this->session->unset_userdata('message');
        ?>
        <div class="row">
        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 "><br>

<?php 
  $disk = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$rows['id_produk'],'id_reseller'=>reseller($this->session->id_konsumen)))->row_array();
  $jual = $this->model_reseller->jual_reseller(reseller($this->session->id_konsumen),$rows['id_produk'])->row_array();
  $beli = $this->model_reseller->beli_reseller(reseller($this->session->id_konsumen),$rows['id_produk'])->row_array();
  $kupon = $this->db->query("SELECT * FROM rb_produk_kupon where id_produk='$rows[id_produk]'");
          echo "<input type='hidden' name='id' value='$rows[id_produk]'>
                <div class='form-group row' style='margin-bottom:5px'>
                  <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Kategori</b></label>
                    <div class='col-sm-9'>
                      <select name='a' class='form-control form-mini' onchange=\"showSub()\" required>
                        <option value='' selected>- Pilih Kategori Produk -</option>";
                        foreach ($record as $row){
                          if ($rows['id_kategori_produk']==$row['id_kategori_produk']){
                            echo "<option value='$row[id_kategori_produk]' selected>$row[nama_kategori]</option>";
                          }else{
                            echo "<option value='$row[id_kategori_produk]'>$row[nama_kategori]</option>";
                          }
                        }
                    echo "</select>
                  </div>
                </div>

                <div class='form-group row' style='margin-bottom:5px'>
                  <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Sub-Kategori</b></label>
                    <div class='col-sm-9'>
                    <select name='aa' class='form-control form-mini' id='sub_kategori_produk'>
                      <option value='' selected>- Pilih Sub Kategori Produk -</option>";
                      $sub_kategori_produk = $this->db->query("SELECT * FROM rb_kategori_produk_sub");
                      foreach ($sub_kategori_produk->result_array() as $row){
                        if ($rows['id_kategori_produk_sub']==$row['id_kategori_produk_sub']){
                          echo "<option value='$row[id_kategori_produk_sub]' selected>$row[nama_kategori_sub]</option>";
                        }else{
                          echo "<option value='$row[id_kategori_produk_sub]'>$row[nama_kategori_sub]</option>";
                        }
                      }
                echo "</select>
                </div>
              </div>
              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Nama Produk</b></label>
                <div class='col-sm-9'>
                <input type='text' class='form-control form-mini' name='b' value='$rows[nama_produk]' required>
                </div>
              </div>

              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'></b></label>
                <div class='col-sm-9'>
                  <div class='form-row'>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Satuan</label>
                      <input type='text' class='form-control form-mini' name='c' value='$rows[satuan]' placeholder='-'>
                    </div>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Berat /g</label>
                      <input type='number' class='form-control form-mini' name='berat' value='$rows[berat]' placeholder='-'>
                    </div>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Stok <button type='button' style='font-size:12px; padding:0px 8px' class='btn btn-success btn-xs allStok' data-toggle='modal' data-target='#stokProduk'>".($beli['beli']-$jual['jual'])."</button>, Tambahkan :</label>
                        <input type='number' class='form-control form-mini' value='0' name='stok'>  
                    </div>
                  </div>
                </div>
              </div>  

              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'></b></label>
                <div class='col-sm-9'>
                  <div class='form-row'>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Harga Modal</label>
                      <input type='text' class='form-control form-mini formatNumber' name='d' value='".rupiah($rows['harga_beli'])."' placeholder='-'>
                    </div>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Harga Jual</label>
                      <input type='text' class='form-control form-mini formatNumber' name='f' value='".rupiah($rows['harga_konsumen'])."' placeholder='-'>
                    </div>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Diskon (Rp)</label>
                      <input type='text' class='form-control form-mini formatNumber' name='diskon' value='".rupiah($disk['diskon'])."' placeholder='-'> 
                    </div>
                  </div>
                </div>
              </div>
              <input type='hidden' class='form-control form-mini' name='e' value='$rows[harga_reseller]'>

              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Min. Order</b></label>
                  <div class='col-sm-9'>
                  <input type='number' class='form-control form-mini' name='minimum' placeholder='' value='1' value='$rows[minimum]'> 
                  </div>
              </div>

              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Cuplikan</b></label>
                  <div class='col-sm-9'>
                  <textarea class='form-control' name='fff' style='height:120px'>$rows[tentang_produk]</textarea>
                  </div>
              </div>

              <div class='form-group row' style='margin-bottom:5px'>
                  <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Keterangan</b></label>
                    <div class='col-sm-9'>
                    <textarea id='editor1' class='form-control form-mini' name='ff' style='height:180px'>$rows[keterangan]</textarea>
                    </div>
              </div>

              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Gambar</b></label>
                  <div class='col-sm-9'>
                    <div id='mulitplefileuploader' class='mt-2'>Choose files</div>
                    <div id='status'></div>";
                    if ($rows['gambar'] != ''){ 
                      $ex = explode(';',$rows['gambar']);
                      $hitungex = count($ex);
                      echo "<span style='color:Red'>File Foto Produk saat ini : </span><br>";
                      for($i=0; $i<$hitungex; $i++){
                          if (file_exists("asset/foto_produk/".$ex[$i])) { 
                              echo "<div class='item' style='border-bottom:1px dotted #cecece; padding-left: 10px;'><a target='_BLANK' href='".base_url()."asset/foto_produk/".$ex[$i]."'>".($i+1)."). ".$ex[$i]."</a></div>";
                          }
                      }
                    }
                  echo "</div>
              </div>
			  
			  <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>url</b></label>
                <div class='col-sm-9'>
				
                <input type='text' class='form-control form-mini' name='url' value='$rows[url]''>
                </div>
              </div> 
			  
            </div>

            <div class='col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12'><br>
            <button type='button' class='ps-btn ps-btn--fullwidth' style='padding:7px 10px' data-toggle='modal' data-target='#kuponProduk'>Buat Kupon / Voucher <span class='badge badge-secondary' style='background-color:#222; color:#fff; padding:5px 9px 4px 7px'><span class='kupon_button'>".$kupon->num_rows()."</span></span></button><hr>
                <div class='form-group row' style='margin-bottom:5px'>
                  <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Pre-Order</b></label>
                    <div class='col-sm-9'>";
                    if ($rows['pre_order']!=''){ $status = 'Ya'; $display = 'inline'; $style="width:40%; display:inline-block"; }else{ $status = 'Tidak'; $display = 'none'; $style=""; }
                    echo "<select name='pre_order_status' id='pre_order_status' class='form-control form-mini' style='$style'>";
                    $preorder = array('Tidak','Ya');
                    for ($i=0; $i < count($preorder) ; $i++) { 
                      if ($preorder[$i]==$status){
                        echo "<option value='".$preorder[$i]."' selected>".$preorder[$i]."</option>";
                      }else{
                        echo "<option value='".$preorder[$i]."'>".$preorder[$i]."</option>";
                      }
                    }
                    echo "</select>
                    <div class='lama_pre_order' style='display:$display'><input type='number' style='width:30%; display:inline-block' class='form-control form-mini' name='pre_order' placeholder='0' value='$rows[pre_order]'> Hari</div>
                    </div>
                </div>

                <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Group Order</b></label>
                  <div class='col-sm-9'>
                  <div id='group'>";
                  $group = $this->db->query("SELECT * FROM rb_produk_group where id_produk='$rows[id_produk]' ORDER BY id_group ASC");
                  $no = 1;
                  foreach ($group->result_array() as $row) {
                    echo "<div id='div_$no'>
                      <input type='hidden' value='$row[id_group]' name='id_group[]' id='id$no'>
                      <input style='width:35%; display:inline-block' placeholder='Jumlah $no' type='number' value='$row[jumlah_group]' class='form-control form-mini' id='jumlah_$no' name='jumlah[]'>
                      <input style='width:55%; display:inline-block' placeholder='Harga Group $no' type='number' value='$row[harga_group]' class='form-control form-mini' id='harga_$no' name='harga[]'>
                      <a href='".base_url().$this->uri->segment(1)."/edit_produk/".$this->uri->segment(3)."?id=$row[id_group]'><i class='icon-cross-circle' style='color:red; font-weight:900'></i></a>
                    </div>";
                    $no++;
                  }
                  echo "</div>
                      <a class='btn btn-success btn-sm btn-block' href=\"javascript:void(0);\" onclick=\"addElementg();\" style='background:#9e9e9e; border:1px solid #fff; font-size:11px'>Tambahkan</a>
                      
                  </div>
                </div>  

                <div class='form-group row' style='margin-bottom:5px'>
                    <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Merek</b></label>
                      <div class='col-sm-9'>
                      <div class='checkbox-scroll'>";
                      $_arrNilai = explode(',', $rows['tag']);
                      foreach ($tag as $tag){
                          $_ck = (array_search($tag['tag_seo'], $_arrNilai) === false)? '' : 'checked';
                          echo "<span style='display:block;'><input style='height:1em' type=checkbox value='$tag[tag_seo]' name=tag[] $_ck> $tag[nama_tag] &nbsp; &nbsp; &nbsp; </span>";
                      }
                      echo "</div>
                      </div>
                    </div> ";
                $no = 1;
                $noidcount = 0;
                $variasi = $this->db->query("SELECT * FROM rb_produk_variasi where id_produk='$rows[id_produk]' ORDER BY id_variasi ASC");
                if ($variasi->num_rows()>=1){
                  foreach ($variasi->result_array() as $row) {
                    if ($noidcount == 0){ $noid = ''; }else{ $noid = $noidcount; }
                    if ($no=='1'){ $intextbox1 = count(explode(';',$row['variasi'])); }
                    if ($no=='2'){$intextbox2 = count(explode(';',$row['variasi'])); }
                    if ($no=='3'){$intextbox3 = count(explode(';',$row['variasi'])); }

                    echo "<div class='form-group row' style='margin-bottom:5px'>
                    <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Variasi $no</b></label>
                      <div class='col-sm-9'>
                      <input type='text' class='form-control form-mini' name='variasix$no' style='font-weight:bold; color:red' value='$row[nama]' placeholder='- - - - - - - -'>
                      <div id='content$noid'>";
                        $ex = explode(';',$row['variasi']);
                        for ($i=0; $i < count($ex); $i++) { 
                          $nomor = $i+1;
                          echo "<div id='div_$nomor'><input placeholder='Input $nomor.........' value='".$ex[$i]."' type='text' class='form-control form-mini' id='variasi".$no."_".$nomor."' name='variasi".$no."[]'></div>";
                        }
                        echo "</div>
                          <a href=\"javascript:void(0);\" onclick=\"addElement$noid();\"><i class='icon-plus-circle' style='color:green; font-weight:900'></i> Tambah</a>
                          <a href=\"javascript:void(0);\" onclick=\"removeElement$noid();\"><i class='icon-cross-circle' style='color:red; font-weight:900'></i> Hapus</a>
                      </div>
                    </div>    
                    <br>";
                    $no++;
                    $noidcount++;
                  }
                }

                $total = (3-$variasi->num_rows());
                $no = $variasi->num_rows()+1;
                if ($variasi->num_rows() == 0){ 
                  $noidx = ''; 
                }else{ 
                  $noidx = $variasi->num_rows(); 
                }
                $data_example = array('','Warna','Ukuran','Lainnya');
                for ($i=1; $i <= $total; $i++) { 
                  if ($no=='1'){ $intextbox1 = 2; }
                  if ($no=='2'){$intextbox2 = 2; }
                  if ($no=='3'){$intextbox3 = 2; }
                  
                  echo "<div class='form-group row' style='margin-bottom:5px'>
                    <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Variasi $no</b></label>
                      <div class='col-sm-9'>
                      <input type='text' class='form-control form-mini' name='variasix$no' style='font-weight:bold; color:red' placeholder='Contoh : ".$data_example[$no]."'>
                      <div id='content$noidx'>
                        <div id='div_1'><input placeholder='Input 1 .........' type='text' class='form-control form-mini' id='variasi".$no."_1' name='variasi".$no."[]'></div>
                        <div id='div_2'><input placeholder='Input 2 .........' type='text' class='form-control form-mini' id='variasi".$no."_2' name='variasi".$no."[]'></div>
                      </div>
                          <a href=\"javascript:void(0);\" onclick=\"addElement$noidx();\"><i class='icon-plus-circle' style='color:green; font-weight:900'></i> Tambah</a>
                          <a href=\"javascript:void(0);\" onclick=\"removeElement$noidx();\"><i class='icon-cross-circle' style='color:red; font-weight:900'></i> Hapus</a>
                      </div>
                    </div>    
                    <br>";
                    $no++;
                    $noidx++;
                }
            echo "</div>

              <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'><br>
                <div class='box-footer'>
                  <button type='submit' name='submit' class='ps-btn margin-btn spinnerButton'>Update</button>
                  <button type='button' onclick=\"history.back()\" class='ps-btn ps-btn--black margin-btn'>Cancel</button>
                </div>
              </div>
            </div>
            </div>";
            echo form_close();
        echo "</div>
    </div>";
?>

<div class="modal fade" id="stokProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">History Stok Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style='padding:1rem 30px 30px'>
      <div style='height:250px; overflow:scroll;'>
      <div class='listStok'>
        <?php 
          $stok_history = $this->db->query("SELECT a.*, b.service, b.waktu_transaksi FROM rb_penjualan_detail a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan where a.id_produk='$rows[id_produk]' AND b.id_pembeli='".reseller($this->session->id_konsumen)."' ORDER BY a.id_penjualan_detail DESC");
          foreach ($stok_history->result_array() as $row) {
            echo "<div style='border-bottom:1px dotted #cecece'>+ <b>$row[jumlah] $row[satuan]</b>, <i style='color:#8a8a8a'>$row[service]</i> 
                  <a style='cursor:pointer; margin-left:10px; margin-right:10px; color:red' onclick=\"delete_stok('$row[id_penjualan_detail]')\" class='float-right'><i class='icon-cross'></i></a> <small style='cursor:pointer' title='$row[waktu_transaksi]' class='float-right'>".cek_terakhir($row['waktu_transaksi'])." Lalu</small> </div>";
          }
        ?>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="kuponProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kode Kupon / Voucher Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style='padding:1rem 30px 30px'>
      <div style='height:250px; overflow:scroll;'>
      <div class='listKupon'>
        <table class='table table-sm'>
          <thead>
          <tr>
            <th>No</th>
            <th>Kode Kupon</th>
            <th>Jumlah</th>
            <th>Expire</th>
            <th>Min Order</th>
            <th>Nilai (Rp)</th>
            <th></th>
          </tr>
          <tr style='background:#e3e3e3'>
            <th><input type="hidden" name='id_kupon' id='id_kupon'>
                <input type="hidden" name='id_produk' id='id_produk' value='<?= $rows['id_produk']; ?>'></th>
            <th><input style='background:#e3e3e3; width:120px' id='kode_kupon' onkeyup="nospaces(this)" type='text' name='kode_kupon' placeholder='XXXXXXXXX' autocomplete='off'></th>
            <th><input type='number' id='jumlah_kupon' style='height:30px; background:#e3e3e3; width:90px' name='jumlah_kupon' placeholder='0' autocomplete='off'></th>
            <th><input style='background:#e3e3e3; width:90px' id='expire_date' type='text' name='expire_date' placeholder='YYYY-MM-DD HH:II:SS' value='<?= date('Y-m-d'); ?>' autocomplete='off'></th>
            <th><input type='number' id='min_order' style='height:30px; background:#e3e3e3; width:90px;' name='min_order' value='1' autocomplete='off'></th>
            <th><input style='background:#e3e3e3; width:100px' id='nilai_kupon' type='text' name='nilai_kupon' class='formatNumber' placeholder='**.***.***' autocomplete='off'></th>
            <th><button type='button' name='submit' id='submit' class='ps-btn margin-btn' style='padding:2px 10px !important; font-size:12px; width:80px'>Simpan</button></th>
          </tr>
          </thead>
          <tbody id="show_data"></tbody>
        </table>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
var Privileges = jQuery('#pre_order_status');
Privileges.change(function () {
    if ($(this).val() == 'Ya') {
      $("#pre_order_status").attr("style", "width:40%; display:inline-block");
      $(".lama_pre_order").attr("style", "display:inline");
    }else{
      $("#pre_order_status").removeAttr("style");
      $(".lama_pre_order").attr("style", "display:none");
    }
});

show_kupon();  
function show_kupon(){
  $.ajax({
      type  : 'ajax',
      url   : '<?php echo site_url('members/kupon/'.$rows['id_produk']); ?>',
      async : true,
      dataType : 'json',
      success : function(data){
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
            html += '<tr>'+
                    '<td>'+(i+1)+'</td>'+
                    '<td><b style="color:green">'+data[i].kode_kupon+'</b></td>'+
                    '<td>'+data[i].used+'/'+data[i].jumlah_kupon+' Kupon</td>'+
                    '<td>'+data[i].expire_date+'</td>'+
                    '<td><b>'+data[i].min_order+'</b></td>'+
                    '<td><b>'+toDuit(data[i].nilai_kupon)+'</b></td>'+
                    '<td>'+
                      '<a href="javascript:void(0);" class="ps-btn margin-btn gray-btn custom-btn item_edit" style="padding:2px 10px !important; font-size:12px" data-id_kupon="'+data[i].id_kupon+'" data-kode_kupon="'+data[i].kode_kupon+'" data-nilai_kupon="'+data[i].nilai_kupon+'" data-jumlah_kupon="'+data[i].jumlah_kupon+'" data-expire_date="'+data[i].expire_date+'" data-min_order="'+data[i].min_order+'">Edit</a>'+' '+
                      '<a href="javascript:void(0);" class="ps-btn margin-btn red-btn custom-btn item_delete" style="padding:2px 10px !important; font-size:12px" data-id_kupon="'+data[i].id_kupon+'"><i class="icon-cross"></i></a></td>'+
                  '</tr>';
          }
          $('#show_data').html(html);
      }
  });
}

 //Save product
 $('#submit').on('click',function(){
    var a = $('#kode_kupon').val();
    var b = $('#jumlah_kupon').val();
    var c = $('#expire_date').val();
    var d = $('#nilai_kupon').val();
    var e = $('#min_order').val();
    var id_produk = $('#id_produk').val();
    var id_kupon = $('#id_kupon').val();
    $.ajax({
        type : "POST",
        url  : "<?php echo site_url('members/kupon_save')?>",
        dataType : "JSON",
        data : {a:a , b:b, c:c, d:d, e:e, id_produk:id_produk, id_kupon:id_kupon},
        success: function(data){
            $('[name="id_kupon"]').val("");
            $('[name="kode_kupon"]').val("");
            $('[name="jumlah_kupon"]').val("");
            $('[name="min_order"]').val("1");
            $('[name="nilai_kupon"]').val("");
            $(".kupon_button").hide().load(" .kupon_button").fadeIn();
            show_kupon();
        }
    });
    return false;
});

//get data for update record
$('#show_data').on('click','.item_edit',function(){
    var id_kupon = $(this).data('id_kupon');
    var kode_kupon = $(this).data('kode_kupon');
    var nilai_kupon        = $(this).data('nilai_kupon');
    var min_order        = $(this).data('min_order');
    var jumlah_kupon        = $(this).data('jumlah_kupon');
    var expire_date        = $(this).data('expire_date');
      
    $('[name="kode_kupon"]').val(kode_kupon);
    $('[name="jumlah_kupon"]').val(jumlah_kupon);
    $('[name="expire_date"]').val(expire_date);
    $('[name="nilai_kupon"]').val(toRupiah(nilai_kupon));
    $('[name="id_kupon"]').val(id_kupon);
    $('[name="min_order"]').val(min_order);
});

$('#show_data').on('click','.item_delete',function(){
  var id = $(this).data('id_kupon');
    $.ajax({
        type : "POST",
        url  : "<?php echo site_url('members/kupon_delete')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){
          show_kupon();  
          $(".kupon_button").hide().load(" .kupon_button").fadeIn();
        }
    });
    return false;
});
});

function delete_stok(id,data2){
    $.ajax({
        type : "POST",
        url  : "<?php echo site_url('produk/delete_stok')?>",
        dataType : "JSON",
        data : {id:id},
        success: function(data){
            $(".listStok").hide().load(" .listStok").fadeIn();
            $(".allStok").hide().load(" .allStok").fadeIn();
        }
    });
    return false;
}
</script>

<script>
$(document).ready(function(){
var settings = {
    url: "<?php echo base_url().$this->uri->segment(1); ?>/upload",
    formData: {id: "<?php echo $this->session->id_konsumen; ?>"},
    dragDrop: true,
	  maxFileCount:10,
    fileName: "uploadFile",
	  maxFileSize:5000*1024,
    allowedTypes:"jpg,png,jpeg,gif",		
    returnType:"json",
	onSuccess:function(files,data,xhr)
    {
       // alert((data));
    },
    showDone:false,
    showDelete:true,
    deleteCallback: function(data,pd) {
        $.post("<?php echo base_url().$this->uri->segment(1); ?>/deleteFile",{op: "delete", name:data},
            function(resp, textStatus, jqXHR) {
                // $("#status").append("<div>File Deleted</div>");   
            });
        for(var i=0;i<data.length;i++) {
            $.post("<?php echo base_url().$this->uri->segment(1); ?>/deleteFile",{op:"delete",name:data[i]},
            function(resp, textStatus, jqXHR) {
                // $("#status").append("<div>File Deleted</div>");  
            });
        }   
        pd.statusbar.hide();
    }   
}
$("#mulitplefileuploader").uploadFile(settings);
});
</script>

<script>
var intTextBox = <?php echo $intextbox1; ?>;
function addElement() {
    intTextBox++;
    var objNewDiv = document.createElement('div');
    objNewDiv.setAttribute('id', 'div_' + intTextBox);
    objNewDiv.innerHTML = '<input placeholder="Input ' + intTextBox + ' ........." type="text" class="form-control form-mini" id="variasi1_' + intTextBox + '" name="variasi1[]"/>';
    document.getElementById('content').appendChild(objNewDiv);
}

function removeElement() {
    if(0 < intTextBox) {
        document.getElementById('content').removeChild(document.getElementById('div_' + intTextBox));
        intTextBox--;
    } else {
        alert("Tidak ditemukan textbox untuk dihapus.");
    }
}

var intTextBox1 = <?php echo $intextbox2; ?>;
function addElement1() {
    intTextBox1++;
    var objNewDiv = document.createElement('div');
    objNewDiv.setAttribute('id', 'div_' + intTextBox1);
    objNewDiv.innerHTML = '<input placeholder="Input ' + intTextBox1 + ' ........."  type="text" class="form-control form-mini" id="variasi2_' + intTextBox1 + '" name="variasi2[]"/>';
    document.getElementById('content1').appendChild(objNewDiv);
}

function removeElement1() {
    if(0 < intTextBox1) {
        document.getElementById('content1').removeChild(document.getElementById('div_' + intTextBox1));
        intTextBox1--;
    } else {
      alert("Tidak ditemukan textbox untuk dihapus.");
    }
}

var intTextBox2 = <?php echo $intextbox3; ?>;
function addElement2() {
    intTextBox2++;
    var objNewDiv = document.createElement('div');
    objNewDiv.setAttribute('id', 'div_' + intTextBox2);
    objNewDiv.innerHTML = '<input placeholder="Input ' + intTextBox2 + ' ........."  type="text" class="form-control form-mini" id="variasi3_' + intTextBox2 + '" name="variasi3[]"/>';
    document.getElementById('content2').appendChild(objNewDiv);
}

function removeElement2() {
    if(0 < intTextBox2) {
        document.getElementById('content2').removeChild(document.getElementById('div_' + intTextBox2));
        intTextBox2--;
    } else {
      alert("Tidak ditemukan textbox untuk dihapus.");
    }
}

var intTextBoxg = <?php echo $group->num_rows(); ?>;
function addElementg() {
    intTextBoxg++;
    var objNewDiv = document.createElement('div');
    objNewDiv.setAttribute('id', 'div_' + intTextBoxg);
    objNewDiv.innerHTML = '<input type="hidden" value="0" name="id_group[]"><input style="width:39%; display:inline-block" placeholder="Jumlah ' + intTextBoxg + '"  type="number" class="form-control form-mini" id="jumlah_' + intTextBoxg + '" name="jumlah[]"/> <input style="width:58%; display:inline-block" placeholder="Harga Group ' + intTextBoxg + '"  type="number" class="form-control form-mini" id="harga_' + intTextBoxg + '" name="harga[]"/>';
    document.getElementById('group').appendChild(objNewDiv);
}

function removeElementg() {
    if(0 < intTextBoxg) {
        document.getElementById('group').removeChild(document.getElementById('div_' + intTextBoxg));
        intTextBoxg--;
    } else {
      alert("Tidak ditemukan textbox untuk dihapus.");
    }
}
</script>
