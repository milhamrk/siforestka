<?php if (config('mode')=='marketplace'){
                                if ($this->session->level != 'konsumen') {
                                    ?>
<p>
    <a href="https://siforestka.co.id/members/buat_toko"><i class="icon-bag"></i> Klik disini untuk mulai Jualan!</a>
</p> <?php } } ?>
<ul class="ps-section__links d-none d-sm-block">
    <?php 
        $sopir = $this->db->query("SELECT id_sopir FROM rb_sopir where id_konsumen='".$this->session->id_konsumen."'")->row_array();
        $cek_pesanan_sopir = $this->db->query("SELECT * FROM rb_penjualan a WHERE a.kurir='$sopir[id_sopir]' AND a.proses!='4' AND service='SOPIR'")->num_rows();
        if ($cek_pesanan_sopir>=1){
            $pesanan_sopir = '<span class="badge badge-secondary" style="font-size:85%">'.$cek_pesanan_sopir.'</span>';
        }else{
            $pesanan_sopir = '';
        }
        
        $data = array('<i class="icon-user"></i> Profile','<i class="icon-news"></i> Opini Publik','<i class="icon-couch"></i> Sosmed','<i class="icon-bag-dollar"></i> Data Bank','<i class="icon-bag-dollar"></i> Keuangan','<i class="icon-heart"></i> Wishlist','<i class="icon-bag2"></i> Pembelian','<i class="icon-car"></i> Jadi Kurir '.$pesanan_sopir.'');
        $link = array('profile', 'opini_publik','sosial_media','rekening_bank','withdraw','wishlist','orders_report','sopir');
        for ($i=0; $i < count($data); $i++) { 
            if ($this->uri->segment('2')==$link[$i]){
                echo "<li class='active'><a href='".base_url()."members/".$link[$i]."'>".$data[$i]."</a></li>";
            }else{
                echo "<li><a href='".base_url()."members/".$link[$i]."'>".$data[$i]."</a></li>";
            }
        }
    ?>
</ul>