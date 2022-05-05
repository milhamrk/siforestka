<?php 
    echo "<dl class='dl-horizontal'>";
            if ($row['nominal']!=''){
                if ($row['jenis']!='wakaf_asset'){
                    echo "<dt>Nominal</dt> <dd style='color:green'>Rp ".rupiah($row['nominal'])."</dd>";
                }
            }
            echo "<dt>Nama Lengkap</dt> <dd style='color:red'>$row[nama_lengkap]</dd>
            <dt>No Handphone </dt> <dd>$row[no_handphone]</dd>
            <dt>Alamat Email</dt> <dd>$row[alamat_email]</dd>";
            if ($row['id_rekening']!='0'){
                echo "<dt>Metode Pembayaran</dt> <dd><u>$row[nama_bank] - $row[no_rekening] - $row[pemilik_rekening]</u></dd>";
            }
            if ($row['keterangan']!='-'){
                if ($row['jenis']=='zakat'){
                    $ex = explode("||",$row['keterangan']);
                    echo "<dt>Jenis Zakat</dt> <dd style='color:green'>".$ex[0]."</dd>";
                    echo "<dt>Alamat Penjemputan</dt> <dd style='color:blue'>".$ex[1]."</dd>";
                }elseif ($row['jenis']=='wakaf_asset'){
                    $ex = explode("||",$row['keterangan']);
                    echo "<dt>Type Wakaf</dt> <dd style='color:red'>".$ex[0]."</dd>";
                    echo "<dt>Nilai Asset</dt> <dd style='color:green'>Rp ".rupiah($row['nominal'])."</dd>";
                    echo "<dt>Alamat Asset</dt> <dd style='color:blue'>".$ex[1]."</dd>";
                    echo "<dt>Keterangan Asset</dt> <dd>".$ex[2]."</dd>";
                }else{
                    echo "<dt>Ditujukan untuk</dt> <dd>$row[keterangan]</dd>";
                }
            }

            if ($row['doa_terbaik']!=''){
                echo "<dt>Doa Terbaik</dt> <dd>$row[doa_terbaik]</dd>";
            }
            echo "<dt>File Upload</dt> <dd>".($row['file_upload'] != '' ? "<a href='".base_url().$this->uri->segment(1)."/donasi_file/$row[file_upload]'>$row[file_upload]</a>" : "<i style='color:#cecece'>Tidak Ada File Lampirkan...</i>")."</dd>
            <dt>Waktu Kirim</dt> <dd>$row[waktu_kirim]</dd>
        </dl>";
?>