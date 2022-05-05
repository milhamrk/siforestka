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

<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Produk Terpilih</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form','name'=>'demo');
              echo form_open_multipart('administrator/edit_produk',$attributes);
              $disk = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$rows['id_produk']))->row_array();
              if ($rows['id_reseller']=='0'){
                  $jual = $this->model_reseller->jual($rows['id_produk'])->row_array();
                  $beli = $this->model_reseller->beli($rows['id_produk'])->row_array();
              }else{
                  $jual = $this->model_reseller->jual_reseller($rows['id_reseller'],$rows['id_produk'])->row_array();
                  $beli = $this->model_reseller->beli_reseller($rows['id_reseller'],$rows['id_produk'])->row_array();
              }
              $kupon = $this->db->query("SELECT * FROM rb_produk_kupon where id_produk='$rows[id_produk]'");

          echo "<div class='col-md-6 col-xs-12'>
                  <table class='table table-condensed'>
                    <tbody>
                      <input type='hidden' name='id' value='$rows[id_produk]'>
                      <tr><th width='130px'scope='row'>Pemilik</th>                   <td><select style='color:red' name='id_reseller' class='form-control combobox' required>";
                        if (config('mode')=='marketplace'){
                          echo "<option value='0' selected>Perusahaan</option>";
                          $reseller = $this->db->query("SELECT * FROM rb_reseller");
                        }else{
                          $reseller = $this->db->query("SELECT * FROM rb_reseller where verifikasi='Y'");
                        }
                        
                        foreach ($reseller->result_array() as $row){
                          if ($rows['id_reseller']==$row['id_reseller']){
                            echo "<option value='$row[id_reseller]' selected>$row[nama_reseller]</option>";
                          }else{
                            echo "<option value='$row[id_reseller]'>$row[nama_reseller]</option>";
                          }
                        }
                      echo "</td></tr>
                      <tr><th scope='row'>Kategori</th>                   <td><select name='a' class='form-control' onchange=\"showSub()\" required>
                                                                              <option value='' selected>- Pilih Kategori Produk -</option>";
                                                                              foreach ($record as $row){
                                                                                if ($rows['id_kategori_produk']==$row['id_kategori_produk']){
                                                                                  echo "<option value='$row[id_kategori_produk]' selected>$row[nama_kategori]</option>";
                                                                                }else{
                                                                                  echo "<option value='$row[id_kategori_produk]'>$row[nama_kategori]</option>";
                                                                                }
                                                                              }
                      echo "</select></td></tr>
                      <tr><th scope='row'>Sub Kategori</th>                   <td><select name='aa' class='form-control' id='sub_kategori_produk'>
                                                                                  <option value='' selected>- Pilih Sub Kategori Produk -</option>";
                                                                                  $sub_kategori_produk = $this->db->query("SELECT * FROM rb_kategori_produk_sub");
                                                                                  foreach ($sub_kategori_produk->result_array() as $row){
                                                                                    if ($rows['id_kategori_produk_sub']==$row['id_kategori_produk_sub']){
                                                                                      echo "<option value='$row[id_kategori_produk_sub]' selected>$row[nama_kategori_sub]</option>";
                                                                                    }else{
                                                                                      echo "<option value='$row[id_kategori_produk_sub]'>$row[nama_kategori_sub]</option>";
                                                                                    }
                                                                                  }
                      echo "</select></td></tr>
                      <tr><th width='130px' scope='row'>Nama Produk</th>  <td><input type='text' class='form-control' name='b' value='$rows[nama_produk]' required></td></tr>
                      <tr><th scope='row'>Satuan</th>                     <td><input type='text' class='form-control' name='c' value='$rows[satuan]'></td></tr>
                      <tr><th scope='row'>Berat / Gram</th>                      <td><input type='number' class='form-control' name='berat' value='$rows[berat]'></td></tr>
                      <tr><th scope='row'>Harga Modal</th>                 <td><input type='text' class='form-control formatNumber' name='d' value='".rupiah($rows['harga_beli'])."'></td></tr>
                      <tr><th scope='row'>Harga Penjual</th>             <td><input type='text' class='form-control formatNumber' name='e' value='".rupiah($rows['harga_reseller'])."'></td></tr>
                      <tr><th scope='row'>Harga Konsumen</th>             <td><input type='text' class='form-control formatNumber' name='f' value='".rupiah($rows['harga_konsumen'])."'></td></tr>
                      <tr><th scope='row'>Min. Order</th>                 <td><input type='number' class='form-control' name='minimum' value='$rows[minimum]'></td></tr>";
                      if (config('fee_produk')=='Y'){ echo "<tr><th scope='row'>Fee Produk</th>             <td><input style='border:1px solid blue' type='text' class='form-control formatNumber' name='fee_produk' value='".rupiah($rows['fee_produk'])."'></td></tr>"; }
                      echo "<tr><th scope='row'>Cuplikan</th>                 <td><textarea class='form-control' name='fff' style='height:160px'>$rows[tentang_produk]</textarea></td></tr>
                      </tbody>
                  </table>
                </div>
                <div class='col-md-6 col-xs-12'>
                  <table class='table table-condensed'>
                    <tbody>
                      <tr><td colspan='2'><button type='button' class='btn btn-primary btn-block btn-sm' style='padding:7px 10px' data-toggle='modal' data-target='#kuponProduk'>Buat Kupon / Voucher <span class='badge badge-secondary' style='background-color:#222; color:#fff; padding:5px 9px 4px 7px'><span class='kupon_button'>".$kupon->num_rows()."</span></span></button></td></tr>
                      <tr><th scope='row'>Diskon</th>                 <td><input type='text' class='form-control formatNumber' name='diskon' value='".rupiah($disk['diskon'])."'></td></tr>
                      <tr><th scope='row'>Stok / Tambah</th>                       <td><input type='number' class='form-control' style='width:100px !important; display:inline-block' value='".($beli['beli']-$jual['jual'])."' disabled>
                                                                              + <input type='number' name='stok' class='form-control' style='width:100px !important; display:inline-block'> </td></tr>
                      <tr><th width='130px' scope='row'>Merek</th>                    <td><div class='checkbox-scroll'>";
                              $_arrNilai = explode(',', $rows['tag']);
                              foreach ($tag as $tag){
                                  $_ck = (array_search($tag['tag_seo'], $_arrNilai) === false)? '' : 'checked';
                                  echo "<span style='display:block;'><input type=checkbox value='$tag[tag_seo]' name=tag[] $_ck> $tag[nama_tag] &nbsp; &nbsp; &nbsp; </span>";
                              }
                      echo "</div></td></tr>";
                      
                    $no = 1;
                    $noidcount = 0;
                    $variasi = $this->db->query("SELECT * FROM rb_produk_variasi where id_produk='$rows[id_produk]' ORDER BY id_variasi ASC");
                    if ($variasi->num_rows()>=1){
                      foreach ($variasi->result_array() as $row) {
                        if ($noidcount == 0){ $noid = ''; }else{ $noid = $noidcount; }
                        if ($no=='1'){ $intextbox1 = count(explode(';',$row['variasi'])); }
                        if ($no=='2'){$intextbox2 = count(explode(';',$row['variasi'])); }
                        if ($no=='3'){$intextbox3 = count(explode(';',$row['variasi'])); }
    
                        echo "<tr><th width='130px' scope='row'>Variasi $no</th>                 <td>
                        <div class='form-group row' style='margin-bottom:5px'>
                          <div class='col-sm-9'>
                          <input type='text' class='form-control form-mini' name='variasix$no' style='font-weight:bold; color:red' value='$row[nama]' placeholder='- - - - - - - -'>
                          <div id='content$noid'>";
                            $ex = explode(';',$row['variasi']);
                            for ($i=0; $i < count($ex); $i++) { 
                              $nomor = $i+1;
                              echo "<div id='div_$nomor'><input placeholder='Input $nomor.........' value='".$ex[$i]."' type='text' class='form-control form-mini' id='variasi".$no."_".$nomor."' name='variasi".$no."[]'></div>";
                            }
                            echo "</div>
                              <a href=\"javascript:void(0);\" onclick=\"addElement$noid();\"><i class='fa fa-plus' style='color:green; font-weight:900'></i> Tambah</a> &nbsp; 
                              <a href=\"javascript:void(0);\" onclick=\"removeElement$noid();\"><i class='fa fa-remove' style='color:red; font-weight:900'></i> Hapus</a>
                          </div>
                        </div>    
                        </td></tr>";
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
                      
                      echo "
                      <tr><th width='130px' scope='row'>Variasi $no</th>                 <td>
                        <div class='form-group row' style='margin-bottom:5px'>
                          <div class='col-sm-9'>
                          <input type='text' class='form-control form-mini' name='variasix$no' style='font-weight:bold; color:red' placeholder='Contoh : ".$data_example[$no]."'>
                          <div id='content$noidx'>
                            <div id='div_1'><input placeholder='Input 1 .........' type='text' class='form-control form-mini' id='variasi".$no."_1' name='variasi".$no."[]'></div>
                            <div id='div_2'><input placeholder='Input 2 .........' type='text' class='form-control form-mini' id='variasi".$no."_2' name='variasi".$no."[]'></div>
                          </div>
                              <a href=\"javascript:void(0);\" onclick=\"addElement$noidx();\"><i class='fa fa-plus' style='color:green; font-weight:900'></i> Tambah</a> &nbsp; 
                              <a href=\"javascript:void(0);\" onclick=\"removeElement$noidx();\"><i class='fa fa-remove' style='color:red; font-weight:900'></i> Hapus</a>
                          </div>
                        </div>    
                        </td></tr>";
                        $no++;
                        $noidx++;
                    }

                      echo "</tbody>
                  </table>
                </div>

                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='130px' scope='row'>Keterangan</th>                 <td><textarea  id='editor1' class='form-control' name='ff'>$rows[keterangan]</textarea></td></tr>
                    <tr><th scope='row'>Aktif</th>                          <td>"; if ($rows['aktif']=='Y'){ echo "<input type='radio' name='aktif' value='Y' checked> Ya &nbsp; <input type='radio' name='aktif' value='N'> Tidak"; }else{ echo "<input type='radio' name='aktif' value='Y'> Ya &nbsp; <input type='radio' name='aktif' value='N' checked> Tidak"; } echo "</td></tr>
                    <tr><th scope='row'>Foto Produk</th>                     <td>
                      <div id='mulitplefileuploader' class='mt-2'>Choose files</div>
                      <div id='status'></div>";
                      if ($rows['gambar'] != ''){ 
                        $ex = explode(';',$rows['gambar']);
                        $hitungex = count($ex);
                        echo "<span style='color:Red'>File Foto Produk saat ini : </span><br>";
                        for($i=0; $i<$hitungex; $i++){
                            if (file_exists("asset/foto_produk/".$ex[$i])) { 
                                echo "<div class='item' style='border-bottom:1px dotted #cecece; padding-left: 10px;'><a target='_BLANK' href='".base_url()."asset/foto_produk/".$ex[$i]."'>".($i)."). ".$ex[$i]."</a></div>";
                            }
                        }
                      }
                    echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='#' onclick=\"window.history.go(-1); return false;\"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
?>

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
show_kupon();  
function show_kupon(){
  $.ajax({
      type  : 'ajax',
      url   : '<?php echo site_url('administrator/kupon/'.$rows['id_produk']); ?>',
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
        url  : "<?php echo site_url('administrator/kupon_save')?>",
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
        url  : "<?php echo site_url('administrator/kupon_delete')?>",
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
</script>
