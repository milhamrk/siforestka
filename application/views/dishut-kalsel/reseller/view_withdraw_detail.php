<?php 
if ($this->session->id_konsumen!=''){
    if ($row['status']=='Sukses'){ $color = 'green'; }else{ $color = 'red'; }
    $ex = explode(';',$row['ket']);
    if ($row['id_rekening_reseller']=='0'){
        $cek_status = $this->db->query("SELECT id_penjualan FROM rb_penjualan where kode_transaksi='$row[keterangan]' AND status_pembeli='konsumen'");
        if ($cek_status->num_rows()>=1){
            $url_order = "konfirmasi/tracking/$row[keterangan]";
        }else{
            if ($row['akun']=='konsumen'){
            $exk = explode('-',$row['keterangan']);
            $kode_transaksi = trim($exk[0]);
            $url_order = "konfirmasi/tracking/".$kode_transaksi;
            }else{
            $rew = $this->db->query("SELECT id_penjualan FROM rb_penjualan where kode_transaksi='$row[keterangan]' AND status_pembeli='reseller'")->row_array();
            $url_order = "members/detail_pembelian/$rew[id_penjualan]";
            }
        }

        if ($row['transaksi']=='debit'){ $status_transaksi = 'Pembayaran Order'; }else{ $status_transaksi = 'Deposit via Ipaymu (Payment Gateway)'; }
        echo "<table class='table table-sm'>
                <tr><td width='140px'>Waktu Proses </td>   <td><span style='color:green'>".jam_tgl_indo($row['waktu_withdraw'])."</span></td></tr>
                <tr><td>Transaksi </td>   <td>$status_transaksi</td></tr>
                <tr><td>Keterangan</td> <td><a target='_BLANK' href='".base_url().$url_order."'>$row[keterangan]</a></td></tr>
                <tr><td>Nominal</td> <td><b>Rp ".rupiah($row['nominal'])."</b></td></tr>
                <tr><td>Fee Transaksi</td> <td style='color:blue'>Rp ".rupiah($row['withdraw_fee'])."</td></tr>
                <tr><td>Jenis</td> <td>$row[transaksi]</td></tr>
                <tr><td>Status</td> <td style='color:$color'><i>$row[status]</i></td></tr>
              </table><br>";
    }else{
        if ($row['transaksi']=='debit'){
            echo "<table class='table table-sm'>
                <tr><td width='140px'>Waktu Proses </td>   <td><span style='color:green'>".jam_tgl_indo($row['waktu_withdraw'])."</span></td></tr>
                <tr><td>Transaksi </td>   <td>Withdraw (Penarikan Dana)</td></tr>
                <tr><td>Rek. Tujuan</td> <td><b>$ex[0]</b>, <br>$ex[1], <br>A/N $ex[2]</td></tr>
                <tr><td>Nominal</td> <td><b>Rp ".rupiah($row['nominal'])."</b></td></tr>
                <tr><td>Fee Transaksi</td> <td style='color:blue'>Rp ".rupiah($row['withdraw_fee'])."</td></tr>
                <tr><td>Jenis</td> <td>$row[transaksi]</td></tr>
                <tr><td>Status</td> <td style='color:$color'><i>$row[status]</i></td></tr>
            </table><br>";
        }else{
            $rek = $this->model_app->view_where('rb_rekening',array('id_rekening'=>$row['id_rekening_reseller']))->row_array();
            echo "<form action='".base_url()."members/detail_keuangan' method='POST' enctype='multipart/form-data'>
            <table class='table table-sm'>
                <input type='hidden' name='id' value='$row[id_withdraw]'>
                <tr><td width='140px'>Waktu Proses </td>   <td><span style='color:green'>".jam_tgl_indo($row['waktu_withdraw'])."</span></td></tr>
                <tr><td>Transaksi </td>   <td>Deposit Saldo</td></tr>
                <tr><td>Rek. Tujuan</td> <td><b>$rek[nama_bank]</b>, <br>$rek[no_rekening], <br>A/N $rek[pemilik_rekening]</td></tr>
                <tr><td>Nominal</td> <td><b>Rp ".rupiah($row['nominal'])."</b></td></tr>
                <tr><td>Fee Transaksi</td> <td style='color:blue'>Rp ".rupiah($row['withdraw_fee'])."</td></tr>
                <tr><td>Jenis</td> <td>$row[transaksi]</td></tr>
                <tr><td>Status</td> <td style='color:$color'><i>$row[status]</i></td></tr>
                <tr><td>Bukti Transfer</td> <td><input type='file' name='bukti' required>";
                if ($row['keterangan']!=''){
                    echo "<div><small><i><b>File saat ini</b> : <a style='color:green' href='".base_url()."members/download_file/bukti_transfer/$row[keterangan]'>$row[keterangan]</a></i></small></div>";
                }
                echo "</td></tr>
              </table><br>
              <input type='submit' name='upload' style='padding:8px 20px 28px 20px' class='ps-btn' value='Upload Bukti Transfer'>
              </form>
              <br>";
        }
    }
}else{
    echo "<center style='padding:80px 10px'>Maaf, anda tidak memiliki akses,..</center>";
}
?>