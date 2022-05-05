<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Margin PPOB</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_ppob_margin',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value=''>
                    
                    <tr><th width='120px' scope='row'>Transaksi</th>    <td>
                    <select name='transaksi' class='form-control' id='transaksi_id' required>
                    <option value=''>- Pilih -</option>";
                    $data_ppob = array('Pulsa All Operator','Token Listrik','Paket Data','Voucher Game','E-Money');
                    $data_ppob_id = array('pulsa','token','data','game','emoney');
                    for ($i=0; $i < count($data_ppob) ; $i++) { 
                        echo "<option value='".$data_ppob_id[$i]."'>".$data_ppob[$i]."</option>";
                    }
                    echo "</select></td></tr>
                    
                    <tr><th width='120px' scope='row'>Jenis</th>    <td>
                    <select name='operator' class='form-control' id='operator' required>
                    </select></td></tr>

                    <tr><th scope='row'>Produk</th>                 <td>
                    <select name='produk' class='form-control' id='produk' required>
                    </select></td></tr>
                    <tr><th scope='row'>Jual (Rp)</th>    <td><input type='number' class='form-control' name='margin'></td></tr>
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
  $('#transaksi_id').change(function(){
      var transaksi_id = $(this).val();
      $.ajax({
      type:"POST",
      url:"<?php echo site_url('administrator/jenis_ppob'); ?>",
      data:"transaksi_id="+transaksi_id,
      success: function(response){
          $('#operator').html(response);
      }
      })
  });

  $('#operator').change(function(){
      var operator_id = $(this).val();
      $.ajax({
      type:"POST",
      url:"<?php echo site_url('administrator/produk_ppob'); ?>",
      data:"operator_id="+operator_id,
      success: function(response){
          $('#produk').html(response);
      }
      })
  })
  })
</script>
