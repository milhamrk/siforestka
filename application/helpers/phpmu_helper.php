<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require APPPATH.'libraries/phpmailer/src/Exception.php';
require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
require APPPATH.'libraries/phpmailer/src/SMTP.php';

function cek_session_members(){
    $ci = & get_instance();
    $session = $ci->session->userdata('level');
    if ($session != 'konsumen'){
        echo $ci->session->set_flashdata('message', '<div class="alert alert-danger"><center>Anda harus login untuk akses halaman tersebut!</center></div>');
        redirect('auth/login');
    }
}

function url_redirect(){
    return (isset($_SERVER['HTTPS']) ? "https://" : "http://") . "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}

function selisih_jam($tgl1,$tgl2){
    $akhir = strtotime($tgl2);
    $awal = strtotime($tgl1); // waktu sekarang
    $lama = $awal-$akhir;
    return floor($lama / (60 * 60));   
}

function selisih_waktu_run($tgl1,$tgl2){
    $akhir = str_replace('-','',$tgl2);
    $awal = str_replace('-','',$tgl1);
    $lama = $akhir-$awal;
    return $lama; 
}

function sensor_email($email){
    $p = strpos($email, '@');
    $email_sensor = substr_replace($email, str_repeat('*', $p-2), 1, $p-2);
    return $email_sensor; 
}

function format_telpon($no_telpon){
    $angka_awal = substr($no_telpon,0,1);
    if ($angka_awal==0){
        $telpon = "62".substr($no_telpon,1,15);
    }elseif ($angka_awal=='62'){
        $telpon = substr($no_telpon,0,15);
    }elseif ($angka_awal=='6'){
        $telpon = "62".substr($no_telpon,1,15);
    }elseif ($angka_awal!='0'){
        $telpon = "62".substr($no_telpon,0,15);
    }else{
        $telpon = substr($no_telpon,0,15);
    }
    return $telpon; 
}

function verifikasi($id_konsumen){
    $ci = & get_instance();
    if (config('mode')=='marketplace'){
        $res = $ci->db->query("SELECT id_reseller FROM rb_reseller where id_reseller='$id_konsumen' AND verifikasi='N'");
        if ($res->num_rows()>=1){
            echo $ci->session->set_flashdata('message', '<div class="alert alert-danger"><b>PENTING</b> - Lapak anda belum ter-verifikasi, silahkan menunggu hingga diproses admin,..</div>');
            redirect("members/profil_toko");
        }
    }else{
        echo $ci->session->set_flashdata('message', '<div class="alert alert-danger"><b>GAGAL</b> - Saat ini System beralih ke mode E-Comerce...</div>');
        redirect("members/profile");
    }
}

function hits(){
    $ci = & get_instance();
    $today = date("Y-m-d");
    $res = $ci->db->query("SELECT * FROM hits where date='$today'");
    if ($res->num_rows()>=1){
        $new = $res->row_array()['count']+1;
        $ci->db->query("UPDATE hits set count='$new' where date='$today'");
    }
    else{
        $ci->db->query("INSERT INTO hits VALUES('','1','$today')");
    }
}

function hits_today(){
    $ci = & get_instance();
    $res = $ci->db->query("SELECT sum(`count`) as total FROM `hits` WHERE DAY(`date`) = DAY(CURRENT_DATE())");
    if ($res->num_rows()>=1){
        return $res->row_array()['total'];
    }else{
        return 0;
    }
}

function hits_month(){
    $ci = & get_instance();
    $res = $ci->db->query("SELECT sum(`count`) as total FROM `hits` WHERE MONTH(`date`) = MONTH(CURRENT_DATE())");
    if ($res->num_rows()>=1){
        return $res->row_array()['total'];
    }else{
        return 0;
    }
}

function hits_total(){
    $ci = & get_instance();
    $res = $ci->db->query("SELECT sum(`count`) as total FROM `hits`");
    if ($res->num_rows()>=1){
        return $res->row_array()['total'];
    }else{
        return 0;
    }
}

function verifikasi_cek($id_reseller){
    $ci = & get_instance();
    $res = $ci->db->query("SELECT id_reseller FROM rb_reseller where id_reseller='$id_reseller' AND verifikasi='N'");
    return $res->num_rows();
}

function verifikasi_icon($id_reseller){
    $ci = & get_instance();
    $res = $ci->db->query("SELECT verifikasi FROM rb_reseller where id_reseller='$id_reseller'")->row_array();
    if ($res['verifikasi']=='Y'){ $verfikasi = 'Verified '; $color = 'green'; $icon = "check-square"; }else{ $verfikasi = 'Unverified'; $color = 'red'; $icon = "remove"; }
    $icon = "<small style='color:$color'><i><span class='fa fa-$icon'></span> $verfikasi</i></small>";
    return $icon;
}

function cek_session_reseller(){
    $ci = & get_instance();
    $session = $ci->session->userdata('level');
    if ($session != 'reseller'){
        redirect(base_url());
    }
}

function replace_url($data){
    return str_replace("https://","",$data);
}

function filter($str){
    $ci = & get_instance();
    return $ci->db->escape_str(strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8')));
}

function rupiah($total){
    return number_format($total,0);
}

function terbilang($x){
    $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    if ($x < 12)
    return " " . $abil[$x];
    elseif ($x < 20)
    return Terbilang($x - 10) . " Belas";
    elseif ($x < 100)
    return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
    elseif ($x < 200)
    return " Seratus" . Terbilang($x - 100);
    elseif ($x < 1000)
    return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
    elseif ($x < 2000)
    return " Seribu" . Terbilang($x - 1000);
    elseif ($x < 1000000)
    return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
    elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
}

function cetak($str){
    $ci = & get_instance();
    return $ci->db->escape_str(strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8')));
}

function cetak_meta($str,$mulai,$selesai){
    return strip_tags(html_entity_decode(substr(str_replace('"','',$str),$mulai,$selesai), ENT_COMPAT, 'UTF-8'));
}

function isJson($string) {
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}

function sensor($teks){
    $ci = & get_instance();
    $query = $ci->db->query("SELECT * FROM katajelek");
    foreach ($query->result_array() as $r) {
        $teks = str_replace($r['kata'], $r['ganti'], $teks);       
    }
    return $teks;
}  

function getSearchTermToBold($text, $words){
    preg_match_all('~[A-Za-z0-9_äöüÄÖÜ]+~', $words, $m);
    if (!$m)
        return $text;
    $re = '~(' . implode('|', $m[0]) . ')~i';
    return preg_replace($re, '<b style="color:red">$0</b>', $text);
}

function tgl_indo($tgl){
        $tanggal = substr($tgl,8,2);
        $bulan = getBulan(substr($tgl,5,2));
        $tahun = substr($tgl,0,4);
        return $tanggal.' '.$bulan.' '.$tahun;       
} 

function tgl_flashdeal($tgl){
    $tanggal = substr($tgl,8,2);
    $bulan = getBulan(substr($tgl,5,2));
    $tahun = substr($tgl,0,4);
    return $bulan.' '.$tanggal.', '.$tahun;       
} 

function jam_tgl_indo($tgl){
    $ex = explode(' ',$tgl);
    $tanggal = substr($ex[0],8,2);
    $bulan = getBulan(substr($ex[0],5,2));
    $tahun = substr($ex[0],0,4);
    return $tanggal.' '.$bulan.' '.$tahun.', '.$ex[1];       
} 

function tgl_simpan($tgl){
        $tanggal = substr($tgl,0,2);
        $bulan = substr($tgl,3,2);
        $tahun = substr($tgl,6,4);
        return $tahun.'-'.$bulan.'-'.$tanggal;       
}

function tgl_view($tgl){
        $tanggal = substr($tgl,8,2);
        $bulan = substr($tgl,5,2);
        $tahun = substr($tgl,0,4);
        return $tanggal.'-'.$bulan.'-'.$tahun;       
}

function tgl($tgl){
    $tanggal = substr($tgl,8,2);
    $bulan = substr($tgl,5,2);
    $tahun = substr($tgl,0,4);
    return $bulan.'/'.$tanggal.'/'.$tahun;       
}

function tgls($tgl){
    $tanggal = substr($tgl,3,2);
    $bulan = substr($tgl,0,2);
    $tahun = substr($tgl,6,4);
    return $tahun.'-'.$bulan.'-'.$tanggal;       
}

function tgl_grafik($tgl){
        $tanggal = substr($tgl,8,2);
        $bulan = getBulan(substr($tgl,5,2));
        $tahun = substr($tgl,0,4);
        return $tanggal.'_'.$bulan;       
}   

function generateRandomString($length = 10) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
} 

function seo_title($s) {
    $c = array (' ');
    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','–');
    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}

function hari_ini($w){
    $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $hari_ini = $seminggu[$w];
    return $hari_ini;
}

function getBulan($bln){
            switch ($bln){
                case 1: 
                    return "Jan";
                    break;
                case 2:
                    return "Feb";
                    break;
                case 3:
                    return "Mar";
                    break;
                case 4:
                    return "Apr";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Jun";
                    break;
                case 7:
                    return "Jul";
                    break;
                case 8:
                    return "Agu";
                    break;
                case 9:
                    return "Sep";
                    break;
                case 10:
                    return "Okt";
                    break;
                case 11:
                    return "Nov";
                    break;
                case 12:
                    return "Des";
                    break;
            }
        } 

function bulan($bln){
    switch ($bln){
        case 1: 
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function cek_terakhir($datetime, $full = false) {
	 $today = time();    
     $createdday= strtotime($datetime); 
     $datediff = abs($today - $createdday);  
     $difftext="";  
     $years = floor($datediff / (365*60*60*24));  
     $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
     $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
     $hours= floor($datediff/3600);  
     $minutes= floor($datediff/60);  
     $seconds= floor($datediff);  
     //year checker  
     if($difftext=="")  
     {  
       if($years>1)  
        $difftext=$years." Tahun";  
       elseif($years==1)  
        $difftext=$years." Tahun";  
     }  
     //month checker  
     if($difftext=="")  
     {  
        if($months>1)  
        $difftext=$months." Bulan";  
        elseif($months==1)  
        $difftext=$months." Bulan";  
     }  
     //month checker  
     if($difftext=="")  
     {  
        if($days>1)  
        $difftext=$days." Hari";  
        elseif($days==1)  
        $difftext=$days." Hari";  
     }  
     //hour checker  
     if($difftext=="")  
     {  
        if($hours>1)  
        $difftext=$hours." Jam";  
        elseif($hours==1)  
        $difftext=$hours." Jam";  
     }  
     //minutes checker  
     if($difftext=="")  
     {  
        if($minutes>1)  
        $difftext=$minutes." Menit";  
        elseif($minutes==1)  
        $difftext=$minutes." Menit";  
     }  
     //seconds checker  
     if($difftext=="")  
     {  
        if($seconds>1)  
        $difftext=$seconds." Detik";  
        elseif($seconds==1)  
        $difftext=$seconds." Detik";  
     }  
     return $difftext;  
    }

    function rate_bintang($id_produk){
        $ci = & get_instance();
        $rates = $ci->db->query("SELECT sum(rating) as rating, count(*) as jumlah, sum(rating)/count(*) as total FROM rb_produk_ulasan where id_produk='$id_produk'")->row_array();
        $rates_cek = $ci->db->query("SELECT * FROM rb_produk_ulasan where id_produk='$id_produk'")->num_rows();
        if ($rates_cek<='0'){
            $rate .= "<option value='1'>$i</option>
                      <option value='2'>$i</option>
                      <option value='2'>$i</option>
                      <option value='2'>$i</option>
                      <option value='2'>$i</option>";
        }else{
            for ($i=1; $i <= 5; $i++) { 
                if ($i<=number_format($rates['total'],0)){
                    $rate .= "<option value='1'>$i</option>";
                }else{
                    $rate .= "<option value='2'>$i</option>";
                }   
            }
        }
        return $rate;
    }

    function rate_bintang_ulasan($bintang){
        $ci = & get_instance();
        if ($bintang<='0'){
            $rate .= "<option value='1'>$i</option>
                      <option value='2'>$i</option>
                      <option value='2'>$i</option>
                      <option value='2'>$i</option>
                      <option value='2'>$i</option>";
        }else{
            for ($i=1; $i <= 5; $i++) { 
                if ($i<=number_format($bintang,0)){
                    $rate .= "<option value='1'>$i</option>";
                }else{
                    $rate .= "<option value='2'>$i</option>";
                }   
            }


        }
        return $rate;
    }

    function reseller($id_konsumen){
        $ci = & get_instance();
        $res = $ci->db->query("SELECT id_reseller FROM rb_reseller where id_konsumen='$id_konsumen'")->row_array();
        if ($res['id_reseller']==''){
            return 0;
        }else{
            return $res['id_reseller'];
        }
    }

    function config($field){
        $ci = & get_instance();
        $res = $ci->db->query("SELECT value FROM rb_config where field='$field'")->row_array();
        return $res['value'];
    }

    function stok($id_reseller,$id_produk){
        $ci = & get_instance();
        $jual = $ci->model_reseller->jual_reseller($id_reseller,$id_produk)->row_array();
        $beli = $ci->model_reseller->beli_reseller($id_reseller,$id_produk)->row_array();
        return $beli['beli']-$jual['jual'];
    }

    function user_reseller($id_reseller){
        $ci = & get_instance();
        $res = $ci->db->query("SELECT user_reseller FROM rb_reseller where id_reseller='$id_reseller'")->row_array();
        return $res['user_reseller'];
    }

function saldo($id_reseller,$id_konsumen){
    $ci = & get_instance();
    $cek_sopir = $ci->db->query("SELECT id_sopir FROM rb_sopir where id_konsumen='$id_konsumen'");

    // Saldo Jika Jadi Kurir
    if ($cek_sopir->num_rows()>=1){
        $sop = $cek_sopir->row_array();
        $sopir = $ci->db->query("SELECT sum(ongkir) as total FROM rb_penjualan a JOIN rb_penjualan_otomatis d ON a.kode_transaksi=d.kode_transaksi WHERE a.kurir='$sop[id_sopir]' AND a.proses='4' AND a.kode_kurir='1' AND d.pembayaran='1'")->row_array();
        $saldo_sopir = $sopir['total'];
    }else{
        $saldo_sopir = 0;
    }

    // Saldo Jika memiliki Toko/Lapak
    if ($id_reseller!='0'){
        $penjualan_perusahaan = $ci->model_reseller->penjualan_perusahaan($id_reseller)->row_array();
        $kupon = $ci->db->query("SELECT sum(a.nilai) as diskon FROM `rb_penjualan_kupon` a JOIN rb_penjualan_detail b ON a.id_penjualan_detail=b.id_penjualan_detail
                                    JOIN rb_penjualan c ON b.id_penjualan=c.id_penjualan  JOIN rb_penjualan_otomatis d ON c.kode_transaksi=d.kode_transaksi where c.id_penjual='$id_reseller' AND c.status_penjual='reseller' AND c.proses='4' AND d.pembayaran='1'")->row_array();
        $ongkir = $ci->db->query("SELECT sum(z.ongkir) as ongkir FROM (SELECT sum(c.ongkir) as ongkir FROM rb_penjualan c JOIN rb_penjualan_otomatis d ON c.kode_transaksi=d.kode_transaksi where c.status_penjual='reseller' AND c.id_penjual='$id_reseller' AND c.kode_kurir!='0' AND c.kode_kurir!='1' AND c.proses>'3' AND d.pembayaran='1' GROUP BY c.kode_transaksi) as z")->row_array();
        $saldo_pelapak = ($penjualan_perusahaan['total']-$kupon['diskon'])+$ongkir['ongkir'];
    }else{
        $saldo_pelapak = 0;
    }

    // Saldo Konsumen
    $tarik = $ci->db->query("SELECT sum(nominal) as total FROM rb_withdraw WHERE id_reseller='$id_konsumen' AND status!='Batal' AND transaksi='debit' AND akun='konsumen'")->row_array();
    $deposit = $ci->db->query("SELECT sum(nominal) as total FROM rb_withdraw WHERE id_reseller='$id_konsumen' AND status='Sukses' AND transaksi='kredit' AND akun='konsumen'")->row_array();
    $pulsa = $ci->db->query("SELECT sum(total) as total FROM rb_pembelian_pulsa WHERE id_reseller='$id_konsumen'")->row_array();
    $saldo_konsumen = (($deposit['total']-$tarik['total'])-$pulsa['total']);

    return (($saldo_pelapak+$saldo_konsumen)+$saldo_sopir);
}

    function simpan_rupiah($total){
        $total1 = str_replace(".","",$total);
        $total2 = str_replace(",","",$total1);
        return $total2;
    }

    function rate_jumlah($id_produk){
        $ci = & get_instance();
        $rate = $ci->db->query("SELECT sum(rating) as rating, count(*) as jumlah, sum(rating)/count(*) as total FROM rb_produk_ulasan where id_produk='$id_produk'")->row_array();
        return $rate['jumlah'];
    }

    function rate_total($id_produk){
        $ci = & get_instance();
        $rate = $ci->db->query("SELECT sum(rating) as rating, count(*) as jumlah, sum(rating)/count(*) as total FROM rb_produk_ulasan where id_produk='$id_produk'")->row_array();
        return number_format($rate['total']);
    }

    function clean_rupiah($total){
        $total1 = str_replace(".","",$total);
        $total2 = str_replace(",","",$total1);
        return $total2;
    }

    function alamat($kode_transaksi){
        $ci = & get_instance();
        $row = $ci->db->query("SELECT keterangan FROM rb_penjualan where kode_transaksi='$kode_transaksi' GROUP BY kode_transaksi")->row_array();
        $ex = explode('|',$row['keterangan']);
        return $ex[3].'<br>'.kecamatan($ex[2],$ex[1]);
    }

    function status($status){
        if ($status=='0'){ 
            $proses = '<span class="text">Pending</span>'; 
        }elseif($status=='1'){ 
            $proses = '<span class="text-danger">Proses</span>'; 
        }elseif($status=='2'){ 
            $proses = '<span class="text-info">Konfirmasi</span>'; 
        }elseif($status=='3'){ 
            $proses = '<span class="text-success">Dikirim</span>'; 
        }elseif($status=='4'){ 
            $proses = '<span class="text-success">Selesai</span>'; 
        }else{ 
            $proses = '<i>Batal</i>'; 
        }
        return $proses;
    }

    function status_pembayaran($status,$kode_transaksi){
        $ci = & get_instance();
        if ($status==2){
            $cek_payment = $ci->db->query("SELECT * FROM rb_penjualan_otomatis where kode_transaksi='$kode_transaksi' AND pembayaran='1'");
            if ($cek_payment->num_rows()>=1){
                return "(<i>Menunggu Diproses...</i>)";
            }else{
                return "(<i>Proses Pengecekan...</i>)";
            }
        }
    }

    function cek_paket($id_reseller){
        $ci = & get_instance();
        return $ci->db->query("SELECT * FROM rb_reseller_paket a JOIN rb_paket b ON a.id_paket=b.id_paket where a.id_reseller='$id_reseller' AND status='Y'")->num_rows();
    }

    function cek_paket_bintang($id_reseller){
        $ci = & get_instance();
        $row = $ci->db->query("SELECT * FROM rb_reseller_paket a JOIN rb_paket b ON a.id_paket=b.id_paket where a.id_reseller='$id_reseller' AND status='Y'")->row_array();
        return $row['id_paket'];
    }

    function cek_paket_icon($id_reseller){
        $ci = & get_instance();
        $rows = $ci->db->query("SELECT * FROM rb_reseller_paket a JOIN rb_paket b ON a.id_paket=b.id_paket where a.id_reseller='$id_reseller' AND status='Y'")->row_array();
        if ($rows['icon_kode']!=''){
            $icon = "<i style='margin-right:5px; font-size: 16px;' class='$rows[icon_kode] float-left'></i>";
        }elseif ($rows['icon_image']!=''){
            $icon = "<img style='width:20px; margin-right:5px; float:left' src='".base_url()."asset/foto_produk/$rows[icon_image]'>";
        }else{
            $icon = "";
        }
        return $icon;
    }

    function cek_status_paket($id_reseller){
        $ci = & get_instance();
        $rowp = $ci->db->query("SELECT * FROM rb_reseller_paket a JOIN rb_paket b ON a.id_paket=b.id_paket where a.id_reseller='$id_reseller'")->row_array();
        if ($rowp['status']=='Y'){
            $akhir  = strtotime($rowp['expire_date']); //Waktu awal
            $awal = time(); // Waktu sekarang atau akhir
            $diff  = $akhir - $awal;
            return "<span style='color:green'>$rowp[nama_paket]</b>, Berakhir ".tgl_indo($rowp['expire_date'])." (".floor($diff / (60 * 60 * 24)) ." hari lagi)</span>";
        }elseif ($rowp['status']=='N'){
            return "<span style='color:red'>PENDING PAYMENT <b>$rowp[nama_paket]</b>, <b style='color:#000; text-decoration:underline'>Rp ".rupiah($rowp['harga']+$rowp['id_reseller_paket'])."</b></span>";
        }else{
            return "<span style='color:red'>Penjual Free</span>";
        }
    }

function cek_status_payment($id_reseller){
    $ci = & get_instance();
    $rowp = $ci->db->query("SELECT a.*, b.nama_paket, b.durasi FROM rb_reseller_paket a JOIN rb_paket b ON a.id_paket=b.id_paket where a.id_reseller='$id_reseller'")->row_array();
    if ($rowp['status']=='Y'){
        $akhir  = strtotime($rowp['expire_date']); //Waktu awal
        $awal = time(); // Waktu sekarang atau akhir
        $diff  = $akhir - $awal;
        return "<a class='btn btn-xs btn-danger' href='".base_url().$ci->uri->segment(1)."/reseller?paket=N&id=$rowp[id_reseller]' onclick=\"return confirm('Apa anda yakin untuk Non-Aktifkan Paket untuk Pelapak ini?')\"><span class='fa fa-remove'></span></a> <span style='color:green'>$rowp[nama_paket]</b>, Berakhir ".tgl_indo($rowp['expire_date'])." (".floor($diff / (60 * 60 * 24)) ." hari lagi)</span>";
    }elseif ($rowp['status']=='N'){
        return "<a class='btn btn-xs btn-success' href='".base_url().$ci->uri->segment(1)."/reseller?paket=Y&durasi=$rowp[durasi]&id=$rowp[id_reseller]' onclick=\"return confirm('Apa anda yakin untuk Aktifkan Paket untuk Pelapak ini?')\"><span class='fa fa-check-square'></span></a> <span style='color:#000'>PENDING, <b>$rowp[nama_paket]</b></span>";
    }else{
        return "<a class='btn btn-xs btn-default' href='#'><span class='fa fa-minus-square'></span></a> <span style='color:#cecece'>Penjual Free</span>";
    }
}

    function total_order($status,$id_konsumen){
        $ci = & get_instance();
        return $ci->db->query("SELECT * FROM rb_penjualan where id_pembeli='$id_konsumen' AND status_pembeli='konsumen' AND proses='$status'")->num_rows();
    }

    function total_penjualan($status,$id_konsumen){
        $ci = & get_instance();
        return $ci->db->query("SELECT * FROM rb_penjualan where id_penjual='$id_konsumen' AND status_penjual='reseller' AND proses='$status'")->num_rows();
    }

    function total_penjualan_pending($status,$id_konsumen){
        $ci = & get_instance();
        return $ci->db->query("SELECT a.* FROM rb_penjualan a JOIN rb_penjualan_otomatis b ON a.kode_transaksi=b.kode_transaksi where a.id_penjual='$id_konsumen' AND a.status_penjual='reseller' AND b.pembayaran is null")->num_rows();
    }

    function kurir($kode_kurir,$kurir,$service){
        $ci = & get_instance();
        if ($kode_kurir=='1'){
        $ceks = $ci->db->query("SELECT * FROM rb_sopir where id_sopir='".(int)$kurir."'")->row_array();
            return "$service - $ceks[merek]";
        }elseif ($kode_kurir=='0'){
        $ceks = $ci->db->query("SELECT * FROM rb_sopir where id_sopir='".(int)$kurir."'")->row_array();
            return "COD - $service";
        }else{
            return "<span style='text-transform:uppercase'>$kurir</span> - $service";
        }
    }

    function ppob($value){
        switch ($value){
            case 'pulsa': 
                return "1";
                break;
            case 'token':
                return "19";
                break;
            case 'data':
                return "2";
                break;
            case 'game':
                return "11";
                break;
            case 'emoney':
                return "15";
                break;
        }
    }

    function kirim_email($subjek,$message,$tujuan){
        $ci = & get_instance();
        $data['subjek'] = $subjek;
        $data['message'] = $message;
        $message_send = $ci->load->view('email_template',$data,TRUE);
        
        $iden = $ci->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
        $ci->load->library('email');

        // PHPMailer object
        $response = false;
        $mail = new PHPMailer();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = config('email_server'); //sesuaikan sesuai nama domain hosting/server yang digunakan
        $mail->SMTPAuth = true;
        $mail->Username = "$iden[email]"; // user email
        $mail->Password = "$iden[password]"; // password email
        $mail->SMTPSecure = config('smtp_secure');
        $mail->Port     = config('email_port');

        $mail->setFrom("$iden[email]", "$iden[pengirim_email]"); // user email
        $mail->addReplyTo("$iden[email]", "$iden[pengirim_email]"); //user email
        $mail->addAddress($tujuan); //email tujuan pengiriman email
        $mail->Subject = $subjek;
        $mail->isHTML(true);
        $mail->Body = $message_send;
        $mail->send();
        // if(!$mail->send()){
        //     echo "Message could not be sent.<br>
        //          ".config('email_server')." / ".config('smtp_secure')." / ".config('email_port')."<br>";
        //     echo 'Mailer Error: ' . $mail->ErrorInfo;
        // }
    }

    function penjualan($id_reseller,$proses){
        $ci = & get_instance();
        $kupon = $ci->db->query("SELECT sum(a.nilai) as diskon FROM `rb_penjualan_kupon` a JOIN rb_penjualan_detail b ON a.id_penjualan_detail=b.id_penjualan_detail
        JOIN rb_penjualan c ON b.id_penjualan=c.id_penjualan where c.id_penjual='$id_reseller' AND c.status_penjual='reseller' AND c.proses='4'")->row_array();
        $row = $ci->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND id_penjual='$id_reseller' AND c.kode_kurir!='0' AND c.proses>'3'")->row_array();
        return $row['total']-$kupon['diskon'];
    }

    function modal($id_reseller,$proses){
        $ci = & get_instance();
        $row = $ci->db->query("SELECT sum(b.harga_beli*a.jumlah) as modal, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND id_penjual='$id_reseller' AND c.kode_kurir!='0' AND c.proses>'3'")->row_array();
        return $row['modal'];
    }

    function kecamatan_kota($kecamatan,$kota){
        $ci = & get_instance();
        $row = $ci->db->query("SELECT a.subdistrict_name, b.city_name, c.province_name FROM `tb_ro_subdistricts` a JOIN tb_ro_cities b ON a.city_id=b.city_id JOIN tb_ro_provinces c ON b.province_id=c.province_id where a.subdistrict_id='$kecamatan'")->row_array();
        /*$row = $ci->db->query("SELECT api_mutasibank, api_rajaongkir FROM identitas where id_identitas='1'")->row_array();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$kota",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: $row[api_rajaongkir]"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $obj = json_decode($response, true);
        for($i=0; $i < count($obj['rajaongkir']['results']); $i++){
            if ($obj['rajaongkir']['results'][$i]['subdistrict_id'] == $kecamatan){
                $select_kecamatan =  $obj['rajaongkir']['results'][$i]['subdistrict_name'].', '.$obj['rajaongkir']['results'][$i]['city'];
            }
        }*/
        return $row['subdistrict_name'].', '.$row['city_name'];
    }
    
    
    function kecamatan($kecamatan,$kota){
        $ci = & get_instance();
        $row = $ci->db->query("SELECT a.subdistrict_name, b.city_name, c.province_name FROM `tb_ro_subdistricts` a JOIN tb_ro_cities b ON a.city_id=b.city_id JOIN tb_ro_provinces c ON b.province_id=c.province_id where a.subdistrict_id='$kecamatan'")->row_array();
        /*$row = $ci->db->query("SELECT api_mutasibank, api_rajaongkir FROM identitas where id_identitas='1'")->row_array();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$kota",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: $row[api_rajaongkir]"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $obj = json_decode($response, true);
        for($i=0; $i < count($obj['rajaongkir']['results']); $i++){
            if ($obj['rajaongkir']['results'][$i]['subdistrict_id'] == $kecamatan){
                $select_kecamatan =  $obj['rajaongkir']['results'][$i]['subdistrict_name'].', '.$obj['rajaongkir']['results'][$i]['city'].', '.$obj['rajaongkir']['results'][$i]['province'];
            }
        }*/
        return $row['subdistrict_name'].', '.$row['city_name'].', '.$row['province_name'];
    }

    function get_provinsi(){
        $ci = & get_instance();
        $row = $ci->db->query("SELECT api_mutasibank, api_rajaongkir FROM identitas where id_identitas='1'")->row_array();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: $row[api_rajaongkir]"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          //echo $response;
        }
        return json_decode($response, true);
    }

    function get_kota($id){
        $ci = & get_instance();
        $row = $ci->db->query("SELECT api_mutasibank, api_rajaongkir FROM identitas where id_identitas='1'")->row_array();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/city?province=$id",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: $row[api_rajaongkir]"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          //echo $response;
        }
    
        return json_decode($response, true);
    }

    function get_kecamatan($id){
        $ci = & get_instance();
        $row = $ci->db->query("SELECT api_mutasibank, api_rajaongkir FROM identitas where id_identitas='1'")->row_array();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$id",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: $row[api_rajaongkir]"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          //echo $response;
        }
    
        return json_decode($response, true);
    }

    function cek_resi($no_resi,$kurir){
        $ci = & get_instance();
        if(config('api_resi_aktif')=='rajaongkir'){
            if ($kurir=='jne' OR $kurir=='tiki'){
                $url = "https://api.binderbyte.com/v1/track?api_key=".config('api_resi')."&courier=$kurir&awb=$no_resi";
                $response = file_get_contents($url);
            }else{
                $row = $ci->db->query("SELECT api_mutasibank, api_rajaongkir FROM identitas where id_identitas='1'")->row_array();
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "waybill=$no_resi&courier=$kurir",
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded",
                    "key: $row[api_rajaongkir]"
                ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
            }
        }else{
            $url = "https://api.binderbyte.com/v1/track?api_key=".config('api_resi')."&courier=$kurir&awb=$no_resi";
            $response = file_get_contents($url);
        }
        return json_decode($response, true);
    }