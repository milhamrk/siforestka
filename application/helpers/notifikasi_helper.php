<?php
function notif_pembayaran_sukses($kode_transaksi){
    $ci = & get_instance();
    $logo = $ci->db->query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1")->row_array();
    $iden = $ci->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
    $cek_kons = $ci->db->query("SELECT b.id_pembeli FROM rb_penjualan_otomatis a JOIN rb_penjualan b ON a.kode_transaksi=b.kode_transaksi where b.status_pembeli='konsumen' AND a.kode_transaksi='$kode_transaksi' GROUP BY b.id_pembeli")->row_array();
    $kons = $ci->model_reseller->profile_konsumen($cek_kons['id_pembeli'])->row_array();
    // Kirim Notif Ke pembelia
    $subject      = "$iden[pengirim_email] - Pembayaran Sukses,..";
    $message  = "<html><body><span style='font-size:18px; color:green'>Selamat Pembayaran anda Sukses.</span><br>
                            Hai $kons[nama_lengkap]! Kami telah menerima pembayaran untuk pesanan anda #$kode_transaksi. <br>
                            Kami juga telah menginformasikan kepada seller/penjual agar segera memproses pesanannya.<br> 
                            Silahkan cek disini untuk perkembangan status pesanan : <a href='".base_url()."konfirmasi/tracking/$kode_transaksi'>Disini</a>.<br><br>

                            Terima kasih telah berbelanja di $iden[url].</body></html> \n";
                            
    $isi_pesan_pembeli = "*$iden[pengirim_email]* - Haloo Bpk/Ibk. *$kons[nama_lengkap]*, Pembayaran order anda dengan No Invoice #$kode_transaksi Telah kami terima, yuk cek disini ".base_url()."konfirmasi/tracking/$kode_transaksi";
    $ci->model_app->wa(format_telpon($kons['no_hp']),$isi_pesan_pembeli);
    echo kirim_email($subject,$message,$kons['email']);

    // Kirim Notif Ke Penjual
    $penjual = $ci->db->query("SELECT b.id_penjual FROM rb_penjualan_otomatis a JOIN rb_penjualan b ON a.kode_transaksi=b.kode_transaksi where b.status_pembeli='konsumen' AND a.kode_transaksi='$kode_transaksi' AND b.kode_kurir!='0' GROUP BY b.id_penjual");
    foreach ($penjual->result_array() as $row){
        $subject_ress      = "$iden[pengirim_email] - Pembayaran dari Pembeli Sukses,..";
        $ress = $ci->db->query("SELECT a.nama_reseller, a.no_telpon, b.email FROM rb_reseller a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen where a.id_reseller='$row[id_penjual]'")->row_array();
        $message_ress  = "<html><body><span style='font-size:18px; color:green'>Selamat Pembayaran dari pembeli Sukses.</span><br>
                                        Hai $ress[nama_reseller]! Kami telah menerima pembayaran pesanan dari konsumen anda untuk Invoice <a href='".base_url()."konfirmasi/tracking/$kode_transaksi'>#$kode_transaksi</a>. <br><br>
                                        
                                        Harap segera memproses pesanannya, jika dalam 1 x 24 jam belum diproses maka transaksi ini akan otomatis dibatalkan..<br><br>

                                        Terima kasih telah berjualan di $iden[url].</body></html> \n";
        $isi_pesan_penjual = "*$iden[pengirim_email]* - Hai *$ress[nama_reseller]*, Kami telah menerima pembayaran pesanan dari konsumen anda untuk Invoice #$kode_transaksi

Harap segera memproses pesanannya, jika dalam 1 x 24 jam belum diproses maka transaksi ini akan otomatis dibatalkan..";
        $ci->model_app->wa(format_telpon($ress['no_telpon']),$isi_pesan_penjual);
        echo kirim_email($subject_ress,$message_ress,$ress['email']);
    }
}

function notif_tracking_order($kode_transaksi){
    $ci = & get_instance();
    $cek = $ci->model_app->view_where('rb_penjualan',array('kode_transaksi'=>$kode_transaksi));
    $iden = $ci->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
    $tot = $ci->db->query("SELECT * FROM rb_penjualan_otomatis where kode_transaksi='".$kode_transaksi."'")->row_array();
    $total_tagihan_akhir = $tot['nominal'];
    $rowc = $cek->row_array();
    $kons = $ci->model_reseller->profile_konsumen($rowc['id_pembeli'])->row_array();

    $subject      = "$iden[pengirim_email] - Tracking Orders";
    $message  = "<html><body><span style='font-size:20px'>Informasi Transaksi #$kode_transaksi</span><br>
                            Hai $kons[nama_lengkap]! Terima kasih telah berbelanja di <a style='text-decoration:none; color:#000' href='$iden[url]'>$iden[url]</a>. <br>Berikut informasi Orderan Invoice <b>#$kode_transaksi</b>.<br><br>

        <b>Detail Pemesanan</b>

        <table style='width:100%'>
            <tbody>";
            $no = 1;
            $record_detail = $ci->db->query("SELECT a.id_penjual, a.kode_transaksi, b.*, c.nama_produk, c.gambar, c.satuan, c.berat, c.produk_seo, d.nama_reseller FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN rb_produk c ON b.id_produk=c.id_produk JOIN rb_reseller d ON c.id_reseller=d.id_reseller where a.kode_transaksi='".$kode_transaksi."' AND a.kode_kurir!='0'");
            foreach ($record_detail->result_array() as $det) {
                $sub_total = $det['jumlah']*($det['harga_jual']-$det['diskon']);
                $message  .= "<tr>
                                <td><h1>$no</h1></td>
                                <td><a style='text-decoration:none; color:green; font-size:16px' href='".base_url()."produk/detail/$det[produk_seo]' title='$det[nama_produk]'><b>$det[nama_produk]</b></a>
                                    <br> Seller : <a href='".base_url()."produk/produk_reseller/$det[id_penjual]'>$det[nama_reseller]</a>
                                    <br> $det[jumlah] x ".rupiah($det['harga_jual']-$det['diskon'])."
                                    <br><b>Subtotal : Rp ".rupiah($sub_total)."</b>
                                </td>
                            </tr>";
                $no++;
            }
            $message  .= "</tbody>
        </table>";

        $message      .= "<br><span style='color:#999'>Total Belanja + Ongkir</span><br>
                        <span style='font-size:20px; font-weight:bold; color:red'>Rp ".rupiah($total_tagihan_akhir)."</span><br>";
        if ($rowc['proses']=='0'){
            $message      .= "<span style='color:#333;font-size:12px;'>Transfer Tepat hingga 3 digit terakhir</span><br>
                            <span style='color:#999;font-size:12px;'>Perbedaan nilai transfer akan menghambat proses verifikasi</span><br><br>

                            <b>METODE PEMBAYARAN :</b><br>
                            Silakan melakukan pembayaran ke salah satu rekening di bawah ini:<br><br>

                            <table style='width:100%'>";
                            $rekening = $ci->model_app->view('rb_rekening');
                            foreach ($rekening->result_array() as $row){
                                $message  .= "<tr><td style='width:88px'><img style='width:69px;height:auto;line-height:100%;outline:none;text-decoration:none;border:0 none' src='".base_url()."asset/images/$row[gambar]'></td>
                                    <td width='120px' colspan='2'>
                                    $row[nama_bank], <br>A/N : $row[pemilik_rekening], <br><b>$row[no_rekening] </b></td></tr>";
                            }
                            $message  .= "</table>

            <br>Rincian pemesananmu dapat dilihat di halaman <a style='text-decoration:none; color:green' target='_BLANK' href='".base_url()."konfirmasi/tracking/$kode_transaksi'>detail transaksi</a>, <br>
            Sudah melakukan pembayaran namun orderan belum terproses? Konfirmasi Pembayaran anda <a href='".base_url()."konfirmasi/index?kode=$kode_transaksi'>disini</a>.</body></html> \n";
        }else{
            $message      .= "Status Pesanan : <b>".status($rowc['proses'])."</b>
            <br>Rincian pemesananmu dapat dilihat di halaman <a style='text-decoration:none; color:green' target='_BLANK' href='".base_url()."konfirmasi/tracking/$kode_transaksi'>detail transaksi</a>";
        }

    $isi_pesan = "*$iden[pengirim_email]* - Hai $kons[nama_lengkap]! berikut Informasi Orderan anda #$kode_transaksi : 

";
    $nou = 1;
    foreach ($record_detail->result_array() as $det) {
        $sub_total = $det['jumlah']*($det['harga_jual']-$det['diskon']);
        $isi_pesan  .= "*$nou.* $det[nama_produk] : *$det[jumlah] x ".rupiah($det['harga_jual']-$det['diskon'])."*
";
        $nou++;
    }
    $isi_pesan .= "
Total + Ongkir : *Rp ".rupiah($total_tagihan_akhir)."*";
if ($rowc['proses']=='0'){
$isi_pesan .= " Silakan melakukan pembayaran ke salah satu rekening di bawah ini:

";
$norek = 1;
foreach ($rekening->result_array() as $row){
    $isi_pesan .= "$norek. *$row[nama_bank]*, 
A/N : $row[pemilik_rekening], *$row[no_rekening]*
";
$norek++;
}
}else{
$isi_pesan .= "

Status Pesanan : *".status($rowc['proses'])."*";
}		

    kirim_email($subject,$message,$kons['email']);
    $ci->model_app->wa(format_telpon($kons['no_hp']),$isi_pesan);
}


function notif_pesanan_dikirim($id_penjualan){
    // Kirim Notifikasi Orderan Dikirim kepada Pembeli
    $ci = & get_instance();
    $iden = $ci->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
    $rows = $ci->db->query("SELECT * FROM rb_penjualan a JOIN rb_konsumen b ON a.id_pembeli=b.id_konsumen JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_penjualan='$id_penjualan'")->row_array();
    $isi_pesan_pembeli = "*$iden[pengirim_email]* - Haloo Bpk/Ibk. *$rows[nama_lengkap]*, orderan anda dengan No Invoice #$rows[kode_transaksi], Telah dikirim oleh penjual, yuk cek di ".base_url()."konfirmasi/tracking/$rows[kode_transaksi]";
    $ci->model_app->wa(format_telpon($rows['no_hp']),$isi_pesan_pembeli);

    $subject_notif      = "$iden[pengirim_email] - Pesanan telah dikirim";
    $message_notif = "<html><body><b>$iden[pengirim_email]</b> - Haloo Bpk/Ibk. <b>$rows[nama_lengkap]</b>, orderan anda dengan No Invoice #$rows[kode_transaksi], Telah dikirim oleh penjual, yuk cek di ".base_url()."konfirmasi/tracking/$rows[kode_transaksi]</body></html>";
    kirim_email($subject_notif,$message_notif,$rows['email']);
}

function notif_withdraw($nominal,$id_konsumen){
    $ci = & get_instance();
    $rows = $ci->db->query("SELECT * FROM rb_konsumen where id_konsumen='".$id_konsumen."'")->row_array();
    // Kirim Notifikasi Withdraw ke admin
    $iden = $ci->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
    $adm = $ci->model_app->view_where('users',array('level'=>'admin'))->row_array();
    $isi_pesan_admin = "*$iden[pengirim_email]* - Haloo Bpk/Ibk. *$adm[nama_lengkap]* (Admin), ada permintaan Withdraw sebesar Rp ".rupiah($nominal)." dari *$rows[nama_lengkap]* di ".base_url()."";
    $isi_pesan_konsumen = "*$iden[pengirim_email]* - Haloo Bpk/Ibk. *$rows[nama_lengkap]*, Anda baru saja meminta Withdraw sebesar *Rp ".rupiah($nominal)."*
    
Saat ini kami sedang PROSES permintaan anda, silahkan menunggu informasi selanjutnya setelah selesai kami proses, Terima kasih,..";
    $ci->model_app->wa(format_telpon($rows['no_hp']),$isi_pesan_konsumen);
    $ci->model_app->wa(format_telpon($adm['no_telp']),$isi_pesan_admin);

    $subject_notif      = "$iden[pengirim_email] - Permintaan Penarikan Dana (Withdraw)";
    $message_notif = "<html><body><b>$iden[pengirim_email]</b> - Haloo Bpk/Ibk. <b>$adm[nama_lengkap]</b> (Admin), ada permintaan Withdraw sebesar Rp ".rupiah($nominal)." dari <b>$rows[nama_lengkap]</b> di ".base_url()."</body></html>";
    $message_notif_konsumen = "<html><body><b>$iden[pengirim_email]</b> - Haloo Bpk/Ibk. <b>$rows[nama_lengkap]</b>, Anda baru saja meminta Withdraw sebesar <b>Rp ".rupiah($nominal)."</b> <br><br>
    Saat ini kami sedang PROSES permintaan anda, silahkan menunggu informasi selanjutnya setelah selesai kami proses, Terima kasih,..</body></html>";
    kirim_email($subject_notif,$message_notif,$adm['email']);
    kirim_email($subject_notif,$message_notif_konsumen,$rows['email']);
}

function notif_deposit($nominal,$id_konsumen,$id_rekening){
    $ci = & get_instance();
    
    if ($id_rekening=='0'){
        $tujuan_deposit = "IPAYMU (Payment Gateway)";
        $tujuan_deposit_mail = "<b>IPAYMU (Payment Gateway)</b>";
    }else{
        $rek = $ci->model_app->view_where('rb_rekening',array('id_rekening'=>cetak($id_rekening)))->row_array();
        $tujuan_deposit = "*$rek[nama_bank]*
$rek[no_rekening]
$rek[pemilik_rekening] ";

        $tujuan_deposit_mail = "<b>$rek[nama_bank]</b><br>
        $rek[no_rekening]<br>
        $rek[pemilik_rekening]<br><br>";
    }
    $rows = $ci->db->query("SELECT * FROM rb_konsumen where id_konsumen='".$id_konsumen."'")->row_array();
    // Kirim Notifikasi Request Deposit ke admin
    
    $iden = $ci->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
    $adm = $ci->model_app->view_where('users',array('level'=>'admin'))->row_array();
    $isi_pesan_admin = "*$iden[pengirim_email]* - Haloo Bpk/Ibk. *$adm[nama_lengkap]* (Admin), Konsumen Atas nama *$rows[nama_lengkap]* Proses transaksi Deposit Saldo ke : 

$tujuan_deposit

Sebesar Rp ".rupiah($nominal).", Saat ini Status Deposit _Menunggu Pembayaran_";
    $ci->model_app->wa(format_telpon($adm['no_telp']),$isi_pesan_admin);

    $subject_notif      = "$iden[pengirim_email] - Permintaan Deposit Dana Saldo";
    $message_notif = "<html><body><b>$iden[pengirim_email]</b> - Haloo Bpk/Ibk. <b>$adm[nama_lengkap]</b> (admin), Konsumen Atas nama <b>$rows[nama_lengkap]</b> Proses transaksi Deposit Saldo ke : <br><br>

    $tujuan_deposit_mail

    Sebesar Rp ".rupiah($nominal).", Saat ini Status Deposit <i>Menunggu Pembayaran</i></body></html>";
    kirim_email($subject_notif,$message_notif,$adm['email']);	


// Kirim Notifikasi ke Konsumen
$isi_pesan_wa_deposit = "*$iden[pengirim_email]* - Haloo Bpk/Ibk. *$rows[nama_lengkap]*, Anda baru saja request Deposit Saldo sebesar Rp ".rupiah($nominal).", silahkan transfer ke :

$tujuan_deposit

Jika sudah Transfer silahkan konfirmasi disini agar bisa diproses lebih cepat, Terima kasih...";
    $ci->model_app->wa(format_telpon($rows['no_hp']),$isi_pesan_wa_deposit);

    $message_notif_deposit = "<html><body><b>$iden[pengirim_email]</b> - Haloo Bpk/Ibk. <b>$rows[nama_lengkap]</b>, Anda baru saja request Deposit Saldo sebesar Rp ".rupiah($nominal).", silahkan transfer ke : <br><br>

    $tujuan_deposit_mail

    Jika sudah Transfer silahkan konfirmasi disini agar bisa diproses lebih cepat, Terima kasih...</body></html>";
    kirim_email($subject_notif,$message_notif_deposit,$rows['email']);	
}


function notif_selesai_belanja($kode_transaksi,$id_konsumen,$total_tagihan_akhir){
    $ci = & get_instance();
    $kons = $ci->model_reseller->profile_konsumen($id_konsumen)->row_array();
    $rekening = $ci->model_app->view('rb_rekening');
    $iden = $ci->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
    $subject      = "$iden[pengirim_email] - Tagihan dan Petunjuk Pembayaran";
    $message  = "<html><body><span style='font-size:20px'>Tagihan Transaksi #$kode_transaksi</span><br>
                                Hai $kons[nama_lengkap]! Terima kasih telah berbelanja di <a style='text-decoration:none; color:#000' href='$iden[url]'>$iden[url]</a>. Silakan melakukan pembayaran untuk tagihan <b>#$kode_transaksi</b>.<br><br>

        <b>Detail Pemesanan</b>

        <table style='width:100%'>
            <tbody>";
            $no = 1;
            $record_detail = $ci->db->query("SELECT a.id_penjual, a.kode_transaksi, b.*, c.nama_produk, c.gambar, c.satuan, c.berat, c.produk_seo, d.nama_reseller FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN rb_produk c ON b.id_produk=c.id_produk JOIN rb_reseller d ON c.id_reseller=d.id_reseller where a.kode_transaksi='".$kode_transaksi."' AND a.kode_kurir!='0'");
            foreach ($record_detail->result_array() as $det) {
                $sub_total = $det['jumlah']*($det['harga_jual']-$det['diskon']);
                $message  .= "<tr>
                                <td><h1>$no</h1></td>
                                <td><a style='text-decoration:none; color:green; font-size:16px' href='".base_url()."produk/detail/$det[produk_seo]' title='$det[nama_produk]'><b>$det[nama_produk]</b></a>
                                    <br> Seller : <a href='".base_url()."produk/produk_reseller/$det[id_penjual]'>$det[nama_reseller]</a>
                                    <br> $det[jumlah] x ".rupiah($det['harga_jual']-$det['diskon'])."
                                    <br><b>Subtotal : Rp ".rupiah($sub_total)."</b>
                                </td>
                            </tr>";
                $no++;
            }
            $message  .= "</tbody>
        </table>";

        $message      .= "<br><span style='color:#999'>Total Belanja + Ongkir</span><br>
                            <span style='font-size:20px; font-weight:bold; color:red'>Rp ".rupiah($total_tagihan_akhir)."</span><br>
                            <span style='color:#333;font-size:12px;'>Transfer Tepat hingga 3 digit terakhir</span><br>
                            <span style='color:#999;font-size:12px;'>Perbedaan nilai transfer akan menghambat proses verifikasi</span><br><br>

                            <b>METODE PEMBAYARAN :</b><br>
                            Silakan melakukan pembayaran ke salah satu rekening di bawah ini:<br><br>

                            <table style='width:100%'>";
                            foreach ($rekening->result_array() as $row){
                            $message  .= "<tr><td style='width:88px'><img style='width:69px;height:auto;line-height:100%;outline:none;text-decoration:none;border:0 none' src='".base_url()."asset/images/$row[gambar]'></td>
                                <td width='120px' colspan='2'>
                                $row[nama_bank], <br>A/N : $row[pemilik_rekening], <br><b>$row[no_rekening] </b></td></tr>";
                            }
                            $message  .= "</table><br>
                            
                            Metode Pembayaran Lainnya bisa dilihat disini :
                            ".base_url()."konfirmasi/bayar?inv=$kode_transaksi<br>
                            
        <br>Untuk melihat Rincian pemesananmu bisa melalui halaman berikut <a style='text-decoration:none; color:green' target='_BLANK' href='".base_url()."konfirmasi/tracking/$kode_transaksi'>".base_url()."konfirmasi/tracking/$kode_transaksi</a>, <br><br>
        <b>Sudah melakukan pembayaran namun orderan belum terproses?</b> Konfirmasi Pembayaran anda <a href='".base_url()."konfirmasi/index?kode=$kode_transaksi'>".base_url()."konfirmasi/index?kode=$kode_transaksi</a>.</body></html> \n";
    $firstname = explode(' ',$kons['nama_lengkap']);
    $isi_pesan = "*$iden[pengirim_email]* - Halo kak $firstname[0]!, Terima kasih sudah berbelanja di $iden[url], 
    
Saat ini kami sedang menunggu pembayaran agar bisa segera diproses, sebagai informasi berikut data orderannya : ";
    $isi_pesan .= "

No Inv. *#$kode_transaksi*
Total + Ongkir : *Rp ".rupiah($total_tagihan_akhir)."*

*Detail Pengiriman*
Penerima : _$kons[nama_lengkap]_
No HP : _$kons[no_hp]_
Alamat : _".alamat($kode_transaksi)."_

Untuk pembayaran silahkan ke Salah satu rekening dibawah ini :
";

foreach ($rekening->result_array() as $row){
$isi_pesan .= "- *$row[nama_bank]*, 
a/n : $row[pemilik_rekening], *$row[no_rekening]*
";
}
    
$isi_pesan .= "
Butuh Metode Pembayaran Lainnya? klik disini : ".base_url()."konfirmasi/bayar?inv=$kode_transaksi";
    
    $cek_onl = $ci->db->query("SELECT * FROM rb_penjualan where kode_kurir!='0' AND kode_transaksi='$kode_transaksi'");
    if ($cek_onl->num_rows()>=1){ // Cek Transaksi Online
        if ($ci->input->post('metode')=='saldo'){
            if (saldo(reseller($ci->session->id_konsumen),$ci->session->id_konsumen)>=$total_tagihan_akhir){
                // Pembayaran Sukses
                $isi_pesan_sukses = "*$iden[pengirim_email]* - Transaksi #$kode_transaksi Sukses
                
Hai *$kons[nama_lengkap]*, Terima kasih telah berbelanja di $iden[url], pembayaran anda untuk orderan ini telah kami terima Dan kami telah menginformasikan kepada seller untuk segera diproses.";

                $subject_sukses = "$iden[pengirim_email] - Transaksi #$kode_transaksi Sukses";
                $message_sukses  = "<html><body><span style='font-size:20px'>Transaksi #$kode_transaksi Sukses</span><br>
                                    Hai $kons[nama_lengkap]! Terima kasih telah berbelanja di <a style='text-decoration:none; color:#000' href='$iden[url]'>$iden[url]</a>. <br>pembayaran anda untuk orderan ini telah kami terima Dan kami telah menginformasikan kepada seller untuk segera diproses..<br><br>

                            <br>Rincian pemesananmu dapat dilihat di halaman <a style='text-decoration:none; color:green' target='_BLANK' href='".base_url()."konfirmasi/tracking/$kode_transaksi'>detail transaksi</a>, <br>
                            Sudah melakukan pembayaran namun orderan belum terproses? Konfirmasi Pembayaran anda <a href='".base_url()."konfirmasi'>disini</a>.</body></html> \n";

                kirim_email($subject_sukses,$message_sukses,$kons['email']);
                $ci->model_app->wa(format_telpon($kons['no_hp']),$isi_pesan_sukses);
            }else{
                kirim_email($subject,$message,$kons['email']);
                $ci->model_app->wa(format_telpon($kons['no_hp']),$isi_pesan);
            }
        }else{
            kirim_email($subject,$message,$kons['email']);
            $ci->model_app->wa(format_telpon($kons['no_hp']),$isi_pesan);
        }
    }
}

function notif_penjual($kode_transaksi){
    // Kirim Notifikasi ke Penjual
    $ci = & get_instance();
    $iden = $ci->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
    $penjual_notifx = $ci->db->query("SELECT a.id_penjualan, a.id_penjual, a.kode_kurir, a.ongkir, a.kurir, a.service, b.id_reseller, b.nama_reseller, b.alamat_lengkap, b.kecamatan_id, b.kota_id, b.no_telpon, b.id_konsumen, c.nama_kota FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller JOIN rb_kota c ON b.kota_id=c.kota_id where a.kode_transaksi='$kode_transaksi'");
    foreach ($penjual_notifx->result_array() as $penx) {
        $belx = $ci->db->query("SELECT sum(jumlah*(harga_jual-diskon)) as total FROM `rb_penjualan_detail` where id_penjualan='$penx[id_penjualan]'")->row_array();
        $isi_pesan_penjual = "*$iden[pengirim_email]* - Haloo *$penx[nama_reseller]*, ada orderan masuk di Lapak anda dengan No Invoice #$kode_transaksi, total belanja *Rp ".rupiah($belx['total'])."*, yuk cek di ".base_url()."konfirmasi/tracking/$kode_transaksi";
        $ci->model_app->wa(format_telpon($penx['no_telpon']),$isi_pesan_penjual);

        $konsumx = $ci->db->query("SELECT email FROM rb_konsumen where id_konsumen='$penx[id_konsumen]'")->row_array();
        $subject_notif      = "$iden[pengirim_email] - Ada Orderan Masuk";
        $message_notif = "<html><body><b>$iden[pengirim_email]</b> - Haloo <b>$penx[nama_reseller]</b>, ada orderan masuk di Lapak anda dengan No Invoice #$kode_transaksi, total belanja *Rp ".rupiah($belx['total'])."*, yuk cek di ".base_url()."konfirmasi/tracking/$kode_transaksi</body></html>";
        kirim_email($subject_notif,$message_notif,$konsumx['email']);

        // Kirim Notifikasi ke Kurir, jika menggunakan Kurir Internal
        if($penx['kode_kurir']=='1'){
            $row = $ci->db->query("SELECT a.*, b.nama_lengkap, b.email, b.no_hp, c.jenis_kendaraan  FROM rb_sopir a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen JOIN rb_jenis_kendaraan c ON a.id_jenis_kendaraan=c.id_jenis_kendaraan where a.id_sopir='$penx[kurir]'")->row_array();
            $isi_pesan_kekurir= "*$iden[pengirim_email]* - Haloo *$row[nama_lengkap]* Kurir $row[jenis_kendaraan] 
*$row[merek]* ($row[plat_nomor]), 
            
Seseorang ingin menggunakan jasa anda untuk orderan No Invoice #$kode_transaksi, total belanja *Rp ".rupiah($belx['total'])."*, 

Status order menunggu pembayaran, dan kami akan menginformasikan kembali jika pembeli sudah memproses pembayaran orderannya.

anda juga bisa cek di ".base_url()."konfirmasi/tracking/$kode_transaksi";
            $ci->model_app->wa(format_telpon($row['no_hp']),$isi_pesan_kekurir);

            $subject_notif      = "$iden[pengirim_email] - Request Kurir $row[jenis_kendaraan] *$row[merek]* ($row[plat_nomor])";
            $message_notif = "<html><body><b>$iden[pengirim_email]</b> - Haloo <b>$row[nama_lengkap]</b> Kurir $row[jenis_kendaraan] <b>$row[merek]</b> ($row[plat_nomor]), Seseorang ingin menggunakan jasa anda untuk orderan No Invoice #$kode_transaksi, total belanja <b>Rp ".rupiah($belx['total'])."</b>, yuk cek di ".base_url()."konfirmasi/tracking/$kode_transaksi</body></html>";
            kirim_email($subject_notif,$message_notif,$row['email']);
        }
    }
}

function notif_perubahan_status($status,$id_penjualan){
    $ci = & get_instance();
    $logo = $ci->db->query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1")->row_array();
    $iden = $ci->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
    $ord = $ci->db->query("SELECT * FROM rb_penjualan where id_penjualan='$id_penjualan'")->row_array();
    $kons = $ci->model_reseller->profile_konsumen($ord['id_pembeli'])->row_array();

    // Kirim Notif Ke pembeli
    $subject      = "$iden[pengirim_email] - Orderan Invoice #$ord[kode_transaksi]/$ord[id_penjual] ".strip_tags(status($status));
    $message  = "<html><body>Hai $kons[nama_lengkap]! pesanan anda dengan No Invoice #$ord[kode_transaksi]/$ord[id_penjual] saat ini dalam status ".strip_tags(status($status))."<br>
                            Silahkan cek disini untuk perkembangan status pesanan : <a href='".base_url()."konfirmasi/tracking/$ord[kode_transaksi]'>Disini</a>.<br><br>
                            Terima kasih telah berbelanja di $iden[url].</body></html> \n";
    $isi_pesan_pembeli = "*$iden[pengirim_email]* - Haloo Bpk/Ibk. *$kons[nama_lengkap]*, pesanan anda dengan No Invoice #$ord[kode_transaksi]/$ord[id_penjual] saat ini dalam status ".strip_tags(status($status)).", 
    
yuk cek disini ".base_url()."konfirmasi/tracking/$ord[kode_transaksi]";
    $ci->model_app->wa(format_telpon($kons['no_hp']),$isi_pesan_pembeli);
    kirim_email($subject,$message,$kons['email']);

    // Kirim Notif Ke Penjual
    $row = $ci->db->query("SELECT b.id_penjual FROM rb_penjualan_otomatis a JOIN rb_penjualan b ON a.kode_transaksi=b.kode_transaksi where b.status_pembeli='konsumen' AND b.id_penjualan='$id_penjualan' AND b.kode_kurir!='0'")->row_array();
    $subject_ress      = "$iden[pengirim_email] - Orderan Invoice #$ord[kode_transaksi]/$ord[id_penjual] ".strip_tags(status($status));
    $ress = $ci->db->query("SELECT a.nama_reseller, a.no_telpon, b.email FROM rb_reseller a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen where a.id_reseller='$row[id_penjual]'")->row_array();
    $message_ress  = "<html><body>Hai $ress[nama_reseller]! Orderan dari konsumen anda untuk No Invoice <a href='".base_url()."konfirmasi/tracking/$ord[kode_transaksi]'>#$ord[kode_transaksi]</a> saat ini berstatus ".strip_tags(status($status)).". <br><br>
    Pastikan untuk selalu monitor orderan masuk dilapak anda,<br><br> Terima kasih telah berjualan di $iden[url].</body></html> \n";
    $isi_pesan_penjual = "*$iden[pengirim_email]* - Hai *$ress[nama_reseller]*, Orderan dari konsumen anda untuk No Invoice #$ord[kode_transaksi] saat ini berstatus *".strip_tags(status($status))."*.

Pastikan untuk selalu monitor orderan masuk dilapak anda.";
    $ci->model_app->wa(format_telpon($ress['no_telpon']),$isi_pesan_penjual);
    kirim_email($subject_ress,$message_ress,$ress['email']);
    
    
    // Kirim Notifikasi ke Kurir untuk menjemput pesanan jika status Proses, jika menggunakan Kurir Internal
    if ($status=='1'){
    if($ord['kode_kurir']=='1'){
        $toko = $ci->db->query("SELECT a.kode_transaksi, b.nama_reseller, b.kecamatan_id, b.kota_id, b.provinsi_id, b.alamat_lengkap, b.no_telpon FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.id_penjualan='$id_penjualan'")->row_array();
        $row = $ci->db->query("SELECT a.*, b.nama_lengkap, b.email, b.no_hp, c.jenis_kendaraan  FROM rb_sopir a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen JOIN rb_jenis_kendaraan c ON a.id_jenis_kendaraan=c.id_jenis_kendaraan where a.id_sopir='$ord[kurir]'")->row_array();
        $isi_pesan_kekurir= "*$iden[pengirim_email]* - Haloo *$row[nama_lengkap]* Kurir $row[jenis_kendaraan] 
*$row[merek]* ($row[plat_nomor]), 
        
Orderan No Invoice #$toko[kode_transaksi], Status Transaksi lunas dan siap untuk di *PROSES*, 

Silahkan menjemput Kiriman ke alamat Pelapak/Penjual di :
*Toko* : $toko[nama_reseller]
*Telp.* : $toko[no_telpon]
*Alamat* : $toko[alamat_lengkap], ".kecamatan($toko['kecamatan_id'],$toko['kota_id'])."

anda juga bisa cek status order di ".base_url()."konfirmasi/tracking/$toko[kode_transaksi]";
        $ci->model_app->wa(format_telpon($row['no_hp']),$isi_pesan_kekurir);

        $subject_notif      = "$iden[pengirim_email] - Pesanan #$toko[kode_transaksi] Siap untuk diantar.";
        $message_notif = "<html><body><b>$iden[pengirim_email]</b> - Haloo <b>$row[nama_lengkap]</b> Kurir $row[jenis_kendaraan]<br> 
                            <b>$row[merek]</b> ($row[plat_nomor]), 
                            <br>Orderan No Invoice #$toko[kode_transaksi], Status Transaksi lunas dan siap untuk di <b>PROSES</b>,<br><br>
                            
                            Silahkan menjemput Kiriman ke Pelapak/Penjual di :<br>
                            <b>Toko</b> : $toko[nama_reseller]<br>
                            <b>Telp.</b> : $toko[no_telpon]<br>
                            <b>Alamat</b> : $toko[alamat_lengkap], ".kecamatan($toko['kecamatan_id'],$toko['kota_id'])."<br><br>
                            
                            anda juga bisa cek status order di ".base_url()."konfirmasi/tracking/$toko[kode_transaksi]</body></html>";
        kirim_email($subject_notif,$message_notif,$row['email']);
    }
    }
}

function notif_ulasan($id_produk,$id_konsumen,$rating){
    $ci = & get_instance();
    $logo = $ci->db->query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1")->row_array();
    $iden = $ci->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
    $kon = $ci->db->query("SELECT nama_lengkap FROM rb_konsumen where id_konsumen='$id_konsumen'")->row_array();
    
    $row = $ci->db->query("SELECT a.nama_produk, a.produk_seo, b.nama_reseller, b.no_telpon, c.email FROM `rb_produk` a JOIN rb_reseller b ON a.id_reseller=b.id_reseller JOIN rb_konsumen c ON b.id_konsumen=c.id_konsumen where a.id_produk='$id_produk'")->row_array();
    $isi_pesan_ulasan= "*$iden[pengirim_email]* - Haloo *$row[nama_reseller]*, baru saja Konsumen anda a/n *$kon[nama_lengkap]* memberikan ULASAN dan *Bintang $rating* untuk produk anda *$row[nama_produk]*, yuk lihat disini : ".base_url()."produk/detail/$row[produk_seo]";
    $ci->model_app->wa(format_telpon($row['no_telpon']),$isi_pesan_ulasan);

    $subject_notif      = "$iden[pengirim_email] - Seseorang menulis ulasan untuk produk anda";
    $message_notif = "<html><body><b>$iden[pengirim_email]</b> - Haloo <b>$row[nama_reseller]</b>, baru saja Konsumen anda a/n <b>$kon[nama_lengkap]</b> memberikan ULASAN dan <b>Bintang $rating</b> untuk produk anda <b>$row[nama_produk]</b>, yuk lihat disini : ".base_url()."produk/detail/$row[produk_seo]</body></html>";
    kirim_email($subject_notif,$message_notif,$row['email']);
}

function notif_diskusi($id_produk,$id_konsumen){
    $ci = & get_instance();
    $logo = $ci->db->query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1")->row_array();
    $iden = $ci->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
    $kon = $ci->db->query("SELECT nama_lengkap FROM rb_konsumen where id_konsumen='$id_konsumen'")->row_array();
    
    $row = $ci->db->query("SELECT a.nama_produk, a.produk_seo, b.nama_reseller, b.no_telpon, c.email FROM `rb_produk` a JOIN rb_reseller b ON a.id_reseller=b.id_reseller JOIN rb_konsumen c ON b.id_konsumen=c.id_konsumen where a.id_produk='$id_produk'")->row_array();
    $isi_pesan_ulasan= "*$iden[pengirim_email]* - Haloo *$row[nama_reseller]*, baru saja seseorang a/n *$kon[nama_lengkap]* mengirimkan KOMENTAR pada produk anda *$row[nama_produk]*, yuk lihat disini : ".base_url()."produk/detail/$row[produk_seo]";
    $ci->model_app->wa(format_telpon($row['no_telpon']),$isi_pesan_ulasan);

    $subject_notif      = "$iden[pengirim_email] - Seseorang menulis ulasan untuk produk anda";
    $message_notif = "<html><body><b>$iden[pengirim_email]</b> - Haloo <b>$row[nama_reseller]</b>, baru saja seseorang a/n <b>$kon[nama_lengkap]</b> mengirimkan KOMENTAR pada produk anda <b>$row[nama_produk]</b>, yuk lihat disini : ".base_url()."produk/detail/$row[produk_seo]</body></html>";
    kirim_email($subject_notif,$message_notif,$row['email']);
}

function notif_pesanan_selesai($id_penjualan,$id_konsumen){
    $ci = & get_instance();
    $logo = $ci->db->query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1")->row_array();
    $iden = $ci->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
    $kon = $ci->db->query("SELECT nama_lengkap FROM rb_konsumen where id_konsumen='$id_konsumen'")->row_array();
    
    $row = $ci->db->query("SELECT a.kode_transaksi, b.nama_reseller, b.no_telpon, c.email FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller JOIN rb_konsumen c ON b.id_konsumen=c.id_konsumen where a.id_penjualan='$id_penjualan'")->row_array();
    $isi_pesan_ulasan= "*$iden[pengirim_email]* - Haloo *$row[nama_reseller]*, Konsumen anda a/n *$kon[nama_lengkap]* telah meng-konfirmasi bahwa orderannya *#$row[kode_transaksi]* telah diterima/selesai dan Dana penjualan telah kami masukkan ke saldo akun anda, Terima kasih";
    $ci->model_app->wa(format_telpon($row['no_telpon']),$isi_pesan_ulasan);

    $subject_notif      = "$iden[pengirim_email] - Invoice #$row[kode_transaksi] Selesai";
    $message_notif = "<html><body><b>$iden[pengirim_email]</b> - Haloo <b>$row[nama_reseller]</b>, Konsumen anda a/n <b>$kon[nama_lengkap]</b> telah meng-konfirmasi bahwa orderannya <b>#$row[kode_transaksi]</b> telah diterima/selesai dan Dana penjualan telah kami masukkan ke saldo akun anda, Terima kasih</body></html>";
    kirim_email($subject_notif,$message_notif,$row['email']);
}

function notif_order_cancel($id_penjualan,$status){
    $ci = & get_instance();
    $logo = $ci->db->query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1")->row_array();
    $iden = $ci->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
    
    if ($status=='x'){
        $refund = 'Dibatalkan dan Dana sudah Dikembalikan';
    }else{
        $refund = 'Dibatalkan';
    }
    
    $row = $ci->db->query("SELECT a.kode_transaksi, a.id_pembeli, b.nama_reseller, b.no_telpon, c.email FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller JOIN rb_konsumen c ON b.id_konsumen=c.id_konsumen where a.id_penjualan='$id_penjualan'")->row_array();
    $kon = $ci->db->query("SELECT * FROM rb_konsumen where id_konsumen='$row[id_pembeli]'")->row_array();
    
    // Kirim Pesan/Notif ke Pelapak/Toko
    $isi_pesan_ulasan= "*$iden[pengirim_email]* - Haloo *$row[nama_reseller]*, Maaf Orderan No Invoice *#$row[kode_transaksi]* dari konsumen anda a/n *$kon[nama_lengkap]* telah $refund";
    $ci->model_app->wa(format_telpon($row['no_telpon']),$isi_pesan_ulasan);
    $subject_notif      = "$iden[pengirim_email] - Invoice #$row[kode_transaksi] $refund";
    $message_notif = "<html><body><b>$iden[pengirim_email]</b> - Haloo <b>$row[nama_reseller]</b>, Maaf Orderan No Invoice <b>#$row[kode_transaksi]</b> dari konsumen anda a/n <b>$kon[nama_lengkap]</b> telah $refund</body></html>";
    kirim_email($subject_notif,$message_notif,$row['email']);
    
    // Kirim Notif ke Pembeli
    $isi_pesan= "*$iden[pengirim_email]* - Haloo *$kon[nama_lengkap]*, Maaf Orderan anda No Invoice *#$row[kode_transaksi]* telah $refund";
    $ci->model_app->wa(format_telpon($kon['no_hp']),$isi_pesan);
    $subject      = "$iden[pengirim_email] - Invoice #$row[kode_transaksi] $refund";
    $message = "<html><body><b>$iden[pengirim_email]</b> - Haloo <b>$kon[nama_lengkap]</b>, Maaf Orderan anda No Invoice <b>#$row[kode_transaksi]</b> telah $refund</body></html>";
    kirim_email($subject,$message,$kon['email']);
}
