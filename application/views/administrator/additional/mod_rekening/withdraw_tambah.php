<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Withdraw / Deposit</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_withdraw',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    <tr><th width='140px' scope='row'>Konsumen / Penjual</th>    <td><select id='id_reseller' class='form-control combobox' name='id_reseller' required>
                                                                                <option value=''>- Pilih -</option>";
                                                                                $konsumen = $this->db->query("SELECT a.*, b.nama_reseller FROM rb_konsumen a LEFT JOIN rb_reseller b ON a.id_konsumen=b.id_konsumen");
                                                                                foreach ($konsumen->result_array() as $row) {
                                                                                  if ($row['nama_reseller']!=''){ $reseller = "/ $row[nama_reseller]"; }else{ $reseller = "";  }
                                                                                  echo "<option value='$row[id_konsumen]'>$row[nama_lengkap] $reseller</option>";
                                                                                }
                                                                                echo "</select></td></tr>
                    <tr><th scope='row'>Nominal (Rp)</th>                 <td><input type='text' class='form-control form-mini formatNumber' name='b' value='0' required></td></tr>
                    <tr><th scope='row'>Jenis Trx.</th>    <td><select name='jenis' id='jenis' class='form-control form-mini' required>
                    <option value='' selected>- Pilih -</option>";
                    $jenis = array('debit','kredit');
                    $jenis_text = array('Debit (Withdraw)','Kredit (Deposit)');
                    for ($i=0; $i < count($jenis); $i++) { 
                      echo "<option value='$jenis[$i]'>$jenis_text[$i]</option>";
                    }
                  echo "</select></td></tr>
                    <tr><th scope='row'>Rekening Tujuan</th>    <td><select name='a' class='form-control form-mini' id='rekening' required>
                    <option value='' selected>- Pilih -</option>
                  </select></td></tr>
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
<script type="text/javascript">
	$(document).ready(function(){
    $("#jenis").change(function(){
    var jenis = $("#jenis").val();
    var id_reseller = $("#id_reseller").val();
        $.ajax({
          type: 'POST',
            url: "<?php echo base_url().$this->uri->segment(1); ?>/rekening_pilih",
            data: {jenis: jenis, id_reseller: id_reseller},
            cache: false,
            success: function(msg){
              $("#rekening").html(msg);
            }
        });
    });
  });
</script>