<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="#">Members</a></li>
                <li>Profile Sopir</li>
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
                    $attributes = array('id' => 'formku');
                    echo form_open_multipart('members/daftar_sopir',$attributes); 
                    include "sidebar-members.php";
                    echo "<button type='submit' name='submit' class='ps-btn btn-block spinnerButton'><center><i class='icon-pen'></i> Simpan Perubahan</center></button>";
                  ?><div style='clear:both'><br></div>
                </div>

                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 ">
                <?php 
                    echo $this->session->flashdata('message'); 
                    $this->session->unset_userdata('message');
                ?>
                    <div class="ps-block--vendor-status biodata">
                        <?php 
                            echo "<p style='font-size:17px'>Hai <b>$row[nama_lengkap]</b>, selamat datang di halaman Data Sopir! <br>
                            Pastikan data profil sesuai dengan KTP untuk kemudahan dalam bertransaksi.</p><br>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Nama Lengkap</b></label>
                              <div class='col-sm-9'>
                              $row[nama_lengkap]
                              </div>
                            </div>
 
                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>No Hp</b></label>
                            <div class='col-sm-9'>
                              $row[no_hp]
                            </div>
                            </div>
                            
                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Pengiriman Dari</b></label>
                            <div class='col-sm-9'>
                            ".(kecamatan($row['kecamatan_id'],$row['kota_id']) == '' ? '<i style="color:#cecece">Wajib Diisi untuk mendapatkan rute,..</i>' : kecamatan($row['kecamatan_id'],$row['kota_id']))."
                            </div>
                            </div>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Jenis Kendaraan</b></label>
                            <div class='col-sm-9'>
                              <select class='form-control form-mini' name='jenis' required>
                                  <option value='0'>- Pilih Kendaraan -</option>";
                                  $kurir_sopir = $this->model_app->view_ordering('rb_jenis_kendaraan','id_jenis_kendaraan','ASC');
                                  foreach ($kurir_sopir as $rowk) {
                                    if ($rows['id_jenis_kendaraan']==$rowk['id_jenis_kendaraan']){
                                      echo "<option value='$rowk[id_jenis_kendaraan]' selected>$rowk[jenis_kendaraan]</option>";
                                    }else{
                                      echo "<option value='$rowk[id_jenis_kendaraan]'>$rowk[jenis_kendaraan]</option>";
                                    }
                                  }
                              echo "</select>
                            </div>
                            </div>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Merek Kendaraan</b></label>
                            <div class='col-sm-9'>
                              <input type='text' name='merek' class='form-control form-mini' value='$rows[merek]' required>
                            </div>
                            </div>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Plat Nomor</b></label>
                            <div class='col-sm-9'>
                              <input type='text' name='plat_nomor' class='form-control form-mini' value='$rows[plat_nomor]' required>
                            </div>
                            </div>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Keterangan</b></label>
                            <div class='col-sm-9'>
                              <textarea class='form-control form-mini' name='lainnya' style='height:80px !important'></textarea>
                            </div>
                            </div>

                            <div class='form-group row' style='margin-bottom:5px'>
                            <label class='col-sm-3 col-form-label' style='margin-bottom:1px'>Lampiran File</b></label>
                            <div class='col-sm-9'>
                              <div id='mulitplefileuploader' class='mt-2'>Choose files</div>
                              <div id='status'></div>
                            </div>
                            </div>

                          </div>";
                          echo form_close();
                        ?>
                    </figure>
                </div>
              
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
var settings = {
    url: "<?php echo base_url().$this->uri->segment(1); ?>/upload_syarat",
    formData: {id: "<?php echo $this->session->id_konsumen; ?>"},
    dragDrop: false,
	  maxFileCount:10,
    fileName: "uploadFile",
	  maxFileSize:5000*1024,
    allowedTypes:"jpg,png,jpeg,gif,zip,rar,pdf,doc,docx,xls,xlsx",		
    returnType:"json",
	onSuccess:function(files,data,xhr)
    {
       // alert((data));
    },
    showDone:false,
    showDelete:true,
    deleteCallback: function(data,pd) {
        $.post("<?php echo base_url().$this->uri->segment(1); ?>/deleteFile_syarat",{op: "delete", name:data},
            function(resp, textStatus, jqXHR) {
                // $("#status").append("<div>File Deleted</div>");   
            });
        for(var i=0;i<data.length;i++) {
            $.post("<?php echo base_url().$this->uri->segment(1); ?>/deleteFile_syarat",{op:"delete",name:data[i]},
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
$(document).ready(function(){
//* select Provinsi */
var base_url    = "<?php echo base_url();?>";
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
});
</script>