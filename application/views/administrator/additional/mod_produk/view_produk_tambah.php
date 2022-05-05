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
                  <h3 class='box-title'>Tambah Produk Baru</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form','name'=>'demo');
              echo form_open_multipart('administrator/tambah_produk',$attributes); 
          echo "<div class='col-md-6 col-xs-12'>
                  <table class='table table-condensed'>
                    <tbody>
                    <tr><th width='130px' scope='row'>Pemilik</th>                   <td><select style='color:red' name='id_reseller' class='form-control combobox' required>";
                                        if (config('mode')=='marketplace'){
                                          echo "<option value='0' selected>Perusahaan</option>";
                                          $reseller = $this->db->query("SELECT * FROM rb_reseller");
                                        }else{
                                          $reseller = $this->db->query("SELECT * FROM rb_reseller where verifikasi='Y'");
                                        }
                                        foreach ($reseller->result_array() as $row){
                                            echo "<option value='$row[id_reseller]'>$row[nama_reseller]</option>";
                                        }
                    echo "</td></tr>
                    <tr><th scope='row'>Kategori</th>                   <td><select name='a' class='form-control' onchange=\"showSub()\" required>
                                        <option value='' selected>- Pilih Kategori Produk -</option>";
                                        foreach ($record as $row){
                                            echo "<option value='$row[id_kategori_produk]'>$row[nama_kategori]</option>";
                                        }
                    echo "</td></tr>
                    <tr><th scope='row'>Sub Kategori</th>                   <td><select name='aa' class='form-control' id='sub_kategori_produk'>
                                          <option value='' selected>- Pilih Sub Kategori Produk -</option>
                                        </td></tr>
                    <tr><th scope='row'>Nama Produk</th>  <td><input type='text' class='form-control' name='b' required></td></tr>
                    <tr><th scope='row'>Satuan</th>                     <td><input type='text' class='form-control' name='c'></td></tr>
                    <tr><th scope='row'>Berat / Gram</th>                      <td><input type='number' class='form-control' name='berat'></td></tr>
                    <tr><th width='130px' scope='row'>Harga Modal</th>                 <td><input type='text' class='form-control formatNumber' name='d'></td></tr>
                    <tr><th scope='row'>Harga Penjual</th>             <td><input type='text' class='form-control formatNumber' name='e'></td></tr>
                    <tr><th scope='row'>Harga Konsumen</th>             <td><input type='text' class='form-control formatNumber' name='f'></td></tr>
                    <tr><th scope='row'>Min. Order</th>                 <td><input type='number' class='form-control' name='minimum' value='1'></td></tr>
                    <tr><th scope='row'>Cuplikan</th>                 <td><textarea class='form-control' name='fff' style='height:140px'></textarea></td></tr>
                    </tbody>
                  </table>
                </div>

                <div class='col-md-6 col-xs-12'>
                  <table class='table table-condensed'>
                    <tbody>
                    <tr><th scope='row'>Diskon</th>                 <td><input type='text' class='form-control formatNumber' name='diskon'></td></tr>
                      <tr><th scope='row'>Stok Awal</th>             <td><input type='number' name='stok' class='form-control'> </td></tr>
                    <tr><th scope='row'>Merek</th>                    <td><div class='checkbox-scroll'>";
                                                                            foreach ($tag as $tag){
                                                                                echo "<span style='display:block;'><input type=checkbox value='$tag[tag_seo]' name=tag[]> $tag[nama_tag] &nbsp; &nbsp; &nbsp; </span>";
                                                                            }
                      echo "</div></td></tr>
                    <tr><th width='130px' scope='row'>Variasi 1</th>                 <td>
                      <div class='form-group row' style='margin-bottom:5px'>
                        <div class='col-sm-9'>
                        <input type='text' class='form-control form-mini' name='variasi1' style='font-weight:bold; color:red' placeholder='- - - - - - - -'>
                        <div id='content'>
                          <div id='div_1'><input placeholder='Input 1 .........' type='text' class='form-control form-mini' id='warna_1' name='warna[]'></div>
                          <div id='div_2'><input placeholder='Input 2 .........' type='text' class='form-control form-mini' id='warna_2' name='warna[]'></div>
                        </div>
                            <a href=\"javascript:void(0);\" onclick=\"addElement();\"><i class='fa fa-plus' style='color:green; font-weight:900'></i> Tambah</a> &nbsp;
                            <a href=\"javascript:void(0);\" onclick=\"removeElement();\"><i class='fa fa-remove' style='color:red; font-weight:900'></i> Hapus</a>
                        </div>
                      </div>   
                    </td></tr>

                    <tr><th scope='row'>Variasi 2</th>                 <td>
                      <div class='form-group row' style='margin-bottom:5px'>
                        <div class='col-sm-9'>
                        <input type='text' class='form-control form-mini' name='variasi2' style='font-weight:bold; color:red' placeholder='- - - - - - - -'>
                        <div id='content1'>
                          <div id='div_1'><input placeholder='Input 1 .........' type='text' class='form-control form-mini' id='ukuran_1' name='ukuran[]'></div>
                          <div id='div_2'><input placeholder='Input 2 .........' type='text' class='form-control form-mini' id='ukuran_2' name='ukuran[]'></div>
                        </div>
                            <a href=\"javascript:void(0);\" onclick=\"addElement1();\"><i class='fa fa-plus' style='color:green; font-weight:900'></i> Tambah</a> &nbsp;
                            <a href=\"javascript:void(0);\" onclick=\"removeElement1();\"><i class='fa fa-remove' style='color:red; font-weight:900'></i> Hapus</a>
                        </div>
                      </div>    
                    </td></tr>
                    
                    <tr><th scope='row'>Lainnya</th>                 <td>
                      <div class='form-group row' style='margin-bottom:5px'>
                        <div class='col-sm-9'>
                        <input type='text' class='form-control form-mini' name='variasi3' style='font-weight:bold; color:red' placeholder='- - - - - - - -'>
                        <div id='content2'>
                          <div id='div_1'><input placeholder='Input 1 .........' type='text' class='form-control form-mini' id='lainnya_1' name='lainnya[]'></div>
                          <div id='div_2'><input placeholder='Input 2 .........' type='text' class='form-control form-mini' id='lainnya_2' name='lainnya[]'></div>
                        </div>
                            <a href=\"javascript:void(0);\" onclick=\"addElement2();\"><i class='fa fa-plus' style='color:green; font-weight:900'></i> Tambah</a> &nbsp;
                            <a href=\"javascript:void(0);\" onclick=\"removeElement2();\"><i class='fa fa-remove' style='color:red; font-weight:900'></i> Hapus</a>
                        </div>
                      </div> 
                    </td></tr>

                    </tbody>
                  </table>
                </div>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='130px' scope='row'>Keterangan</th>                 <td><textarea id='editor1' class='form-control' name='ff'></textarea></td></tr>
                    <tr><th scope='row'>Aktif</th>                          <td><input type='radio' name='aktif' value='Y' checked> Ya &nbsp; <input type='radio' name='aktif' value='N'> Tidak</td></tr>
                    <tr><th scope='row'>Foto Produk</th>                     <td>
                      <div id='mulitplefileuploader' class='mt-2'>Choose files</div>
                      <div id='status'></div>
                    </td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambahkan</button>
                    <a href='#' onclick=\"window.history.go(-1); return false;\"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
?>
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
var intTextBox = 2;
function addElement() {
    intTextBox++;
    var objNewDiv = document.createElement('div');
    objNewDiv.setAttribute('id', 'div_' + intTextBox);
    objNewDiv.innerHTML = '<input placeholder="Input ' + intTextBox + ' ........." type="text" class="form-control form-mini" id="warna_' + intTextBox + '" name="warna[]"/>';
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

var intTextBox1 = 2;
function addElement1() {
    intTextBox1++;
    var objNewDiv = document.createElement('div');
    objNewDiv.setAttribute('id', 'div_' + intTextBox1);
    objNewDiv.innerHTML = '<input placeholder="Input ' + intTextBox1 + ' ........."  type="text" class="form-control form-mini" id="ukuran_' + intTextBox1 + '" name="ukuran[]"/>';
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

var intTextBox2 = 2;
function addElement2() {
    intTextBox2++;
    var objNewDiv = document.createElement('div');
    objNewDiv.setAttribute('id', 'div_' + intTextBox2);
    objNewDiv.innerHTML = '<input placeholder="Input ' + intTextBox2 + ' ........."  type="text" class="form-control form-mini" id="lainnya_' + intTextBox2 + '" name="lainnya[]"/>';
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
