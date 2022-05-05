<?php 
if ($page=='home'){
    foreach($produk->data as $item){
        if ($item->pembelianoperator_id==$operator_id){
            if ($item->status=='0'){ $status = 'disabled'; }else{ $status = ''; }
            $cek_margin = $this->db->query("SELECT * FROM rb_ppob_margin where kode_ppob='".$item->code."'");
            if ($cek_margin->num_rows()>='1'){
                $row = $cek_margin->row_array();
                echo "<option value='".$item->code."|".($item->price+$row['margin'])."' $status>".$item->product_name." (Rp ".rupiah($item->price+$row['margin']).")</option>";
            }else{
                echo "<option value='".$item->code."|".$item->price."' $status>".$item->product_name." (Rp ".rupiah($item->price).")</option>";
            }
        }
    }
}else{
    echo "<div class='row ppob'>";
    foreach($produk->data as $item){
        if ($item->pembelianoperator_id==$operator_id){
            if ($item->status=='0'){ $status = 'disabled'; }else{ $status = ''; }
            $cek_margin = $this->db->query("SELECT * FROM rb_ppob_margin where kode_ppob='".$item->code."'");
            if ($cek_margin->num_rows()>='1'){
                $row = $cek_margin->row_array();
                echo "<div class='col-lg-5 col-12'>
                        <div class='row'>
                        <div class='col-lg-9 col-9'>
                            <div class='menu__sub-product-name'>".$item->product_name."</div>
                            <div class='menu__sub-product-price'>Harga Rp ".rupiah($item->price+$row['margin'])."</div>
                        </div>
                        <div class='col-lg-3 col-3'>  
                            <button onclick=\"belippob(this.id)\" type='button' id='".$item->code."|".($item->price+$row['margin'])."' style='padding:9px 12px' class='ps-btn ps-btn--fullwidth spinnerButton' $status>Beli</button>
                        </div>
                        </div>
                    </div>";
            }else{
                echo "<div class='col-lg-5 col-12'>
                        <div class='row'>
                        <div class='col-lg-9 col-9'>
                            <div class='menu__sub-product-name'>".$item->product_name."</div>
                            <div class='menu__sub-product-price'>Harga Rp ".rupiah($item->price)."</div>
                        </div>
                        <div class='col-lg-3 col-3'>  
                            <button onclick=\"belippob(this.id)\" type='button' id='".$item->code."|".($item->price)."' style='padding:9px 12px' class='ps-btn ps-btn--fullwidth spinnerButton' $status>Beli</button>
                        </div>
                        </div>
                    </div>";
            }
        }
    }
    echo "</div>";
}