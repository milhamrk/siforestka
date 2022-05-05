<?php 
if (trim($row['foto'])=='' OR !file_exists("asset/foto_user/".$row['foto'])){
    echo "<img class='img-thumbnail' style='width:100%' src='".base_url()."asset/foto_user/blank.png'>";
}else{
    echo "<img class='img-thumbnail' style='width:100%' src='".base_url()."asset/foto_user/$row[foto]'>";
}
echo "<div style='font-size:16px; padding:10px 0px 5px 0px'>Sisa Saldo <b class='pull-right'>Rp ".rupiah(saldo(reseller($this->session->id_konsumen),$this->session->id_konsumen))."</b> 
<a style='padding: 2px 15px;' class='ps-btn ps-btn--outline btn-block' href='".base_url()."members/tambah_withdraw'><i class='fa fa-plus'></i> Deposit / Withdraw</a></div>";

?>