<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Margin PPOB</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/edit_ppob_margin',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_ppob_margin]'>

                    <tr><th width='120px' scope='row'>Transaksi</th>    <td>
                    <select name='transaksi' class='form-control' id='transaksi_id' required>";
                    $data_ppob = array('Pulsa All Operator','Token Listrik','Paket Data','Voucher Game','E-Money');
                    $data_ppob_id = array('pulsa','token','data','game','emoney');
                    for ($i=0; $i < count($data_ppob) ; $i++) { 
                      if ($rows['id_jenis']==ppob($data_ppob_id[$i])){
                        echo "<option selected>".$data_ppob[$i]."</option>";
                      }
                    }
                    echo "</select></td></tr>

                    <tr><th width='120px' scope='row'>Operator</th>    <td>
                    <select name='operator' class='form-control' id='operator' required>";
                    foreach($operator->data as $item){
                      if ($item->pembeliankategori_id==$rows['id_jenis']){
                        if ($rows['id_ppob']==$item->id){
                          echo "<option selected>".$item->product_name."</option>";
                        }
                      }
                    }
                    echo "</select></td></tr>
                    <tr><th scope='row'>Produk</th>                 <td>
                    <select name='produk' class='form-control' id='produk' required>
                      <option value='$rows[harga]' selected>$rows[nama_ppob] (Rp ".rupiah($rows['harga']).")</option>
                    </select></td></tr>
                    <tr><th scope='row'>Jual (Rp)</th>    <td><input type='number' class='form-control' value='".($rows['margin']+$rows['harga'])."' name='margin'></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='#' onclick=\"window.history.go(-1); return false;\"><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";