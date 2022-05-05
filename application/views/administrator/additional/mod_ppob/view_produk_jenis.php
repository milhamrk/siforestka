<?php 
echo "<option value='' selected>- Pilih -</option>";
foreach($produk->data as $item){
    if ($item->pembeliankategori_id==$transaksi_id){
      if ($item->status=='0'){ $status = 'disabled'; }else{ $status = ''; }
      echo "<option value='".$item->id."' $status>".$item->product_name."</option>";
    }
  }