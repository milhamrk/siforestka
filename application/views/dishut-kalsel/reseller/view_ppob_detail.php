<?php 
if ($this->session->id_konsumen!=''){
    if ($result['data']['trxid']!=''){
        // 0 = Proses, 1 = Sukses, 2 = Gagal, 3 = Refund
        if ($result['data']['status']=='0'){ 
            $status = 'PROSES'; 
        }elseif ($result['data']['status']=='1'){ 
            $status = 'SUKSES'; 
        }elseif ($result['data']['status']=='2'){ 
            $status = 'GAGAL - Saldo dikembalikan'; 
            $data_update = array('total'=>0);
            $where_add = array('id_pembelian_pulsa' =>cetak($this->input->post('id')));
            $this->model_app->update('rb_pembelian_pulsa', $data_update, $where_add);
        }elseif ($result['data']['status']=='3'){
            $status = 'REFUND - Saldo dikembalikan'; 
            $data_update = array('total'=>0);
            $where_add = array('id_pembelian_pulsa' =>cetak($this->input->post('id')));
            $this->model_app->update('rb_pembelian_pulsa', $data_update, $where_add);
        }else{ 
            $status = '-'; 
        }
        echo "<table class='table table-sm'>
            <tr><td width='140px'>Produk </td> <td><span style='color:green'>".$result['data']['produk']."</span></td></tr>
            <tr><td>Tujuan </td>   <td>".$result['data']['target']."</td></tr>
            <tr><td>Keterangan</td> <td>".$result['data']['note']."</td></tr>
            <tr><td>Status</td> <td><b style='text-transform:uppercase'>".$status."</b></td></tr>
            <tr><td>Waktu Transaksi</td> <td>".jam_tgl_indo($result['data']['created_at'])."</td></tr>
            <tr><td>Waktu Eksekusi</td> <td>".jam_tgl_indo($result['data']['updated_at'])."</td></tr>
        </table><br>";
    }else{
        echo "<center style='padding:80px 10px'>Maaf, data transaksi ini tidak ditemukan pada server PPOB,..</center>";
    }
}else{
    echo "<center style='padding:80px 10px'>Maaf, anda tidak memiliki akses,..</center>";
}
?>