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
          echo $this->session->flashdata('message'); 
          $this->session->unset_userdata('message');
          $attributes = array('class'=>'biodata','role'=>'form','name'=>'demo');
          echo form_open_multipart('members/tambah_produk',$attributes); 
        ?>
        <div class="row">
        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 "><br>
<?php 
        
          echo "<input type='hidden' name='id' value=''>
              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Kategori</b></label>
                  <div class='col-sm-9'>
                  <select name='a' class='form-control form-mini' onchange=\"showSub()\" required>
                    <option value='' selected>- Pilih Kategori Produk -</option>";
                    foreach ($record as $row){
                        echo "<option value='$row[id_kategori_produk]'>$row[nama_kategori]</option>";
                    }
                  echo "</select>
                  </div>
              </div>

              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Sub-Kategori</b></label>
                  <div class='col-sm-9'>
                    <select name='aa' class='form-control form-mini' id='sub_kategori_produk'>
                    <option value='' selected>- Pilih Sub Kategori Produk -</option>
                    </select>
                  </div>
              </div>

              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Nama Produk</b></label>
                <div class='col-sm-9'>
                <input type='text' class='form-control form-mini' name='b' required>
                </div>
              </div>    
              
              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'></b></label>
                <div class='col-sm-9'>
                  <div class='form-row'>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Satuan</label>
                      <input type='text' class='form-control form-mini' name='c' placeholder='-'>
                    </div>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Berat /g</label>
                      <input type='number' class='form-control form-mini' name='berat' placeholder='-'>
                    </div>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Stok Awal</label>
                      <input type='number' class='form-control form-mini' name='stok' placeholder='' value='1'> 
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
                      <input type='text' class='form-control form-mini formatNumber' name='d' placeholder='-'>
                    </div>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Harga Jual</label>
                      <input type='text' class='form-control form-mini formatNumber' name='f' placeholder='-'>
                    </div>
                    <div class='form-group col-md-4' style='margin-bottom:5px'>
                      <label style='margin-bottom:1px'>Diskon (Rp)</label>
                      <input type='text' class='form-control form-mini formatNumber' name='diskon' placeholder='-'> 
                    </div>
                  </div>
                </div>
              </div> 

              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Min. Order</b></label>
                  <div class='col-sm-9'>
                  <input type='number' class='form-control form-mini' name='minimum' placeholder='' value='1'> 
                  </div>
              </div>

              <input type='hidden' class='form-control form-mini' name='e'>
              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Cuplikan</b></label>
                  <div class='col-sm-9'>
                  <textarea class='form-control' name='fff' style='height:120px'></textarea>
                  </div>
              </div>

              <div class='form-group row' style='margin-bottom:5px'>
                  <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Keterangan</b></label>
                    <div class='col-sm-9'>
                    <textarea id='editor1' class='form-control' name='ff' style='height:180px'>$rows[keterangan]</textarea>
                    </div>
              </div>
              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Gambar</b></label>
                  <div class='col-sm-9'>
                  <div id='mulitplefileuploader' class='mt-2'>Choose files</div>
                  <div id='status'></div>
                  </div>
              </div>
			  <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>url</b></label>
                <div class='col-sm-9'>
                <input type='text' class='form-control form-mini' name='url' placeholder='https://...'>
                </div>
              </div>   
			  
              <br>
              
            </div>

            <div class='col-xl-5 col-lg-45 col-md-5 col-sm-12 col-12'><br>
              
              <div class='form-group row' style='margin-bottom:5px'>
                <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Pre-Order</b></label>
                  <div class='col-sm-9'>
                  <select name='pre_order_status' id='pre_order_status' class='form-control form-mini'>";
                  $preorder = array('Tidak','Ya');
                  for ($i=0; $i < count($preorder) ; $i++) { 
                    echo "<option value='".$preorder[$i]."'>".$preorder[$i]."</option>";
                  }
                  echo "</select>
                  <div class='lama_pre_order' style='display:none'><input type='number' style='width:30%; display:inline-block' class='form-control form-mini' name='pre_order' value='2'> Hari</div>
                  </div>
              </div>

              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Group Order</b></label>
                <div class='col-sm-9'>
                <div id='group'>
                  <div id='div_1'>
                    <input style='width:39%; display:inline-block' placeholder='Jumlah 1' type='number' class='form-control form-mini' id='jumlah_1' name='jumlah[]'>
                    <input style='width:58%; display:inline-block' placeholder='Harga Group 1' type='number' class='form-control form-mini' id='harga_1' name='harga[]'>
                  </div>
                </div>
                    <a href=\"javascript:void(0);\" onclick=\"addElementg();\"><i class='icon-plus-circle' style='color:green; font-weight:900'></i> Tambah</a>
                    <a href=\"javascript:void(0);\" onclick=\"removeElementg();\"><i class='icon-cross-circle' style='color:red; font-weight:900'></i> Hapus</a>
                </div>
                
              </div>    

              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Merek</b></label>
                <div class='col-sm-9'>
                <div class='checkbox-scroll'>";
                foreach ($tag as $tag){
                    echo "<span style='display:block;'><input style='height:1em' type=checkbox value='$tag[tag_seo]' name=tag[]> $tag[nama_tag] &nbsp; &nbsp; &nbsp; </span>";
                }
                echo "</div>
                </div>
              </div>  

              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Variasi 1</b></label>
                <div class='col-sm-9'>
                <input type='text' class='form-control form-mini' name='variasi1' style='font-weight:bold; color:red' placeholder='- - - - - - - -'>
                <div id='content'>
                  <div id='div_1'><input placeholder='Input 1 .........' type='text' class='form-control form-mini' id='warna_1' name='warna[]'></div>
                  <div id='div_2'><input placeholder='Input 2 .........' type='text' class='form-control form-mini' id='warna_2' name='warna[]'></div>
                </div>
                    <a href=\"javascript:void(0);\" onclick=\"addElement();\"><i class='icon-plus-circle' style='color:green; font-weight:900'></i> Tambah</a>
                    <a href=\"javascript:void(0);\" onclick=\"removeElement();\"><i class='icon-cross-circle' style='color:red; font-weight:900'></i> Hapus</a>
                </div>
              </div>    
              <br>
              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Variasi 2</b></label>
                <div class='col-sm-9'>
                <input type='text' class='form-control form-mini' name='variasi2' style='font-weight:bold; color:red' placeholder='- - - - - - - -'>
                <div id='content1'>
                  <div id='div_1'><input placeholder='Input 1 .........' type='text' class='form-control form-mini' id='ukuran_1' name='ukuran[]'></div>
                  <div id='div_2'><input placeholder='Input 2 .........' type='text' class='form-control form-mini' id='ukuran_2' name='ukuran[]'></div>
                </div>
                    <a href=\"javascript:void(0);\" onclick=\"addElement1();\"><i class='icon-plus-circle' style='color:green; font-weight:900'></i> Tambah</a>
                    <a href=\"javascript:void(0);\" onclick=\"removeElement1();\"><i class='icon-cross-circle' style='color:red; font-weight:900'></i> Hapus</a>
                </div>
              </div>    
              <br>
              <div class='form-group row' style='margin-bottom:5px'>
              <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Lainnya</b></label>
                <div class='col-sm-9'>
                <input type='text' class='form-control form-mini' name='variasi3' style='font-weight:bold; color:red' placeholder='- - - - - - - -'>
                <div id='content2'>
                  <div id='div_1'><input placeholder='Input 1 .........' type='text' class='form-control form-mini' id='lainnya_1' name='lainnya[]'></div>
                  <div id='div_2'><input placeholder='Input 2 .........' type='text' class='form-control form-mini' id='lainnya_2' name='lainnya[]'></div>
                </div>
                    <a href=\"javascript:void(0);\" onclick=\"addElement2();\"><i class='icon-plus-circle' style='color:green; font-weight:900'></i> Tambah</a>
                    <a href=\"javascript:void(0);\" onclick=\"removeElement2();\"><i class='icon-cross-circle' style='color:red; font-weight:900'></i> Hapus</a>
                </div>
              </div>   

            </div>
            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
            <div class='box-footer'>
                <button type='submit' name='submit' class='ps-btn margin-btn spinnerButton'>Tambahkan</button>
                <button type='button' onclick=\"history.back()\" class='ps-btn ps-btn--black margin-btn'>Cancel</button>
              </div>
            </div>
            </div>
            </div>";
            echo form_close();
        echo "</div>
    </div>";
?>
<script>
$(document).ready(function(){
var Privileges = jQuery('#pre_order_status');
Privileges.change(function () {
    if ($(this).val() == 'Ya') {
      $("#pre_order_status").attr("style", "width:40%; display:inline-block");
      $(".lama_pre_order").attr("style", "display:inline");
      $("input[name='pre_order']").prop('required',true);
    }else{
      $("#pre_order_status").removeAttr("style");
      $(".lama_pre_order").attr("style", "display:none");
      $("input[name='pre_order']").removeAttr('required');
    }
});

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

var intTextBoxg = 1;
function addElementg() {
    intTextBoxg++;
    var objNewDiv = document.createElement('div');
    objNewDiv.setAttribute('id', 'div_' + intTextBoxg);
    objNewDiv.innerHTML = '<input style="width:39%; display:inline-block" placeholder="Jumlah ' + intTextBoxg + '"  type="number" class="form-control form-mini" id="jumlah_' + intTextBoxg + '" name="jumlah[]"/> <input style="width:58%; display:inline-block" placeholder="Harga Group ' + intTextBoxg + '"  type="number" class="form-control form-mini" id="harga_' + intTextBoxg + '" name="harga[]"/>';
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
