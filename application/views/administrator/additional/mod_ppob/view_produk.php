<?php 
echo "<option value='' selected>- Pilih -</option>";
foreach($produk->data as $item){
    if ($item->pembelianoperator_id==$operator_id){
        if ($item->status=='0'){ $status = 'disabled'; $null = '- Habis'; }else{ $status = ''; $null = ''; }
        echo "<option value='".$item->code."|".$item->price."|".$item->product_name."'>".$item->product_name." (Rp ".rupiah($item->price).") $null</option>";
    }
}