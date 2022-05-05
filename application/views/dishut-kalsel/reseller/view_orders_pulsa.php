<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="#">Members</a></li>
                <li>Transaksi Pulsa</li>
            </ul>
        </div>
    </div>
</div>
<div class="ps-vendor-dashboard pro" style='margin-top:10px'>
    <div class="container">
        <div class="ps-section__content">
            <?php include "menu-members.php"; 
                echo $this->session->flashdata('message'); 
                $this->session->unset_userdata('message');
            ?>
            <div id='respon'></div>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 ">
                    <div class="ps-section__left">
                        <aside class="ps-widget--account-dashboard">
                            <div class="ps-widget__content">
                                <ul>
                                    <li><a class='<?= ($_GET['ppob'] == '' ? 'active' : ''); ?>' href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>">Riwayat Transaksi</a></li>
                                    <?php 
                                      $idn = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
                                      $data_ppob = array('Pulsa All Operator','Token Listrik','Paket Data','Voucher Game','E-Money');
                                      $data_ppob_id = array('pulsa','token','data','game','emoney');
                                      $data_ppob_icon = array('smartphone','lighter','sun','earth','laptop-phone','money');
                                      for ($i=0; $i < count($data_ppob) ; $i++) { 
                                        if ($_GET['ppob']==$data_ppob_id[$i]){
                                           echo "<li><a class='active' href='".base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'?ppob='.$data_ppob_id[$i]."'>".$data_ppob[$i]." <i class='float-right icon-chevron-right'></i></a></li>";
                                        }else{
                                         echo "<li><a href='".base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'?ppob='.$data_ppob_id[$i]."'>".$data_ppob[$i]."</a></li>";
                                        }
                                      }
                                    ?>
                                    <li><a target='_BLANK' href="<?php echo "https://api.whatsapp.com/send?phone=".preg_replace('/\s+/', '', format_telpon($idn['no_telp']))."&amp;text=Hallo%20".config('title').",%20Saya%20Butuh%20Bantuan%20Terkait%20PPOB..."; ?>">Layanan Bantuan</a></li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                  <div style='clear:both'><br></div>
                </div>
                
                <div class='col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 biodata notif'>
                        <?php 
                            $rows = $this->db->query("SELECT maps FROM identitas where id_identitas='1'")->row_array();
                            if ($rows['maps']!='|'){
                                $maps = explode('|',$rows['maps']);
                                $url1 = 'https://tripay.co.id/api/v2/pembelian/operator/';
                                $header = array(
                                'Accept: application/json',
                                'Authorization: Bearer '.$maps[0], // Ganti [apikey] dengan API KEY Anda
                                );
                                $ch1 = curl_init();
                                curl_setopt($ch1, CURLOPT_URL, $url1);
                                curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
                                curl_setopt($ch1, CURLOPT_HTTPHEADER, $header);
                                curl_setopt($ch1, CURLOPT_POST, 1);
                                $operator = curl_exec($ch1);
                                if(curl_errno($ch1)){
                                    return 'Request Error:' . curl_error($ch1);
                                }
                                $operator = json_decode($operator);
                            }
                             if ($rows['maps']!='|' AND trim($rows['maps'])!='||'){
                              if(isset($_GET['ppob'])){ 
                                $id_trx = ppob(cetak($_GET['ppob']));
                               echo "<div class='ps-block--site-features' style='margin-bottom:20px; background-color:#fff; border: none; padding: 10px 0px;'>";
                                   echo "<form class='col-md-12' style='padding-right:0px; padding-left:0px' method='POST' action='".base_url()."main/proses?trx_pulsa=1'>
                                   <div class='form-row'>";

                                   if ($_GET['ppob']==19){
                                     echo "<div style='margin-bottom:0px' class='col-md-6 form-group'>
                                            <input type='number' name='id_pelanggan' id='id_pelanggan' class='form-control' placeholder='ID Pelanggan' required>
                                          </div>";
                                   }

                                   echo "<div style='margin-bottom:0px' class='col-md-6 form-group'>
                                     <input type='number' name='tujuan' id='tujuan' class='form-control' placeholder='Nomor Handphone,..' required>
                                   </div>";
                                   
                                   if ($_GET['ppob']!=19){
                                   echo "<div style='margin-bottom:0px' class='col-md-6 form-group'>
                                     <select name='operator' class='form-control' id='operator' required>
                                     <option value=''>- Jenis -</option>";
                                     foreach($operator->data as $item){
                                       if ($item->pembeliankategori_id==$id_trx){
                                         if ($item->status=='0'){ $status = 'disabled'; }else{ $status = ''; }
                                         echo "<option value='".$item->id."' $status>".$item->product_name."</option>";
                                       }
                                     }
                                     echo "</select>
                                   </div>";
                                  }
                                   
                                   echo "
                                   </form>
                                   </div>
                                   <div style='clear:both'></div>";
                           echo "</div>";
                            }
                          }

 
                          echo "<div id='loader' style='display:none'>
                                  <center><img src='".base_url()."asset/images/loading.gif'></center>
                                </div>
                                <div id='produk'></div>

                                <div id='historytrx'>";
                                if ($pulsa->num_rows()<=0){
                                  echo "<div class='alert alert-info'><strong>INFORMASI</strong> - Halo kak, Saat ini Belum ada transaksi pembelian pulsa. <br> Yuk mari, jangan lupa isi pulsa dulu <a href='".base_url()."' style='color:#000'><b>disini</b></a>.</div>";
                                }
                                $no = 1;
                                foreach ($pulsa->result_array() as $row){
                                  $ex = explode('|',$row['keterangan']);
                                  echo "<div class='form-group row' style='margin-bottom:5px; background: #efefef;'>
                                  <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Waktu Transaksi</label>
                                    <div class='col-sm-10'>
                                      ".jam_tgl_indo($row['waktu_pembelian'])."
                                  </div>
                                  </div>
        
                                  <div class='form-group row' style='margin-bottom:5px'>
                                  <label class='col-sm-2 col-form-label' style='margin-bottom:1px'>Keterangan</label>
                                    <div class='col-sm-10'>";
                                    if ($row['total']=='0'){
                                      echo "<span style='color:Red'>GAGAL - Saldo Dikembalikan</span>";
                                    }else{
                                      echo "Total <span style='color:Red'>Rp ".rupiah($row['total'])."</span>"; 
                                    }
                                      echo " :  Pulsa ".$ex[1].", Tujuan <b>".$ex[2]."</b><br>
                                    </div>
                                  </div>
                                  
                                  <div class='form-group row' style='margin-bottom:5px'>
                                  <label class='col-sm-2 col-form-label' style='margin-bottom:1px'></label>
                                    <div class='col-sm-10'>
                                      <a style='padding:10px 25px; line-height:1px; font-weight:300; color:#fff' class='ps-btn cekstatus' data-id='$row[id_pembelian_pulsa]' href='#'>Cek Status</a>
                                      <a style='padding:10px 25px; line-height:1px; font-weight:300; color:#fff' target='_BLANK' class='ps-btn red-btn' href='https://api.whatsapp.com/send?phone=".preg_replace('/\s+/', '', format_telpon($idn['no_telp']))."&amp;text=Hallo%20".config('title').",%20Saya%20Butuh%20Bantuan%20Terkait%20Transaksi%20PPOB%20untuk%20INV-$row[id_pembelian_pulsa]...'>Komplain</a>
                                    </div>
                                  </div><br>";
                                    $no++;
                                }
                                echo "</div>";
                        
                        ?>

                    </div>
                    <div class="ps-pagination">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

<div class="modal fade bd-example-modal-lg ppob-modal" style='z-index:99999' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header" style='border-bottom:0px solid #e9ecef'>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
      <div class='content-body' style='padding:0px 20px'></div>
    </div>
</div>
</div>
</div>

<script>
    $(function(){
        $(document).on('click','.cekstatus',function(e){
            e.preventDefault();
            $(".ppob-modal").modal('show');
            $.post("<?php echo site_url()?>members/trx_pulsa_komplain",
                {id:$(this).attr('data-id')},
                function(html){
                    $(".content-body").html(html);
                }   
            );
        });
    });
</script>         
<script>
function belippob(produk){
  var tujuan = $('#tujuan').val();
  var id_pelanggan = $('#id_pelanggan').val();
  if (tujuan==''){
    $('#tujuan').focus();
  }else{
    $.ajax({
        type : "POST",
        url  : "<?php echo site_url('main/proses?trx_pulsa=1')?>",
        dataType : "JSON",
        data : {tujuan:tujuan,produk:produk,id_pelanggan:id_pelanggan},
        beforeSend: function(){
            // Show image container
            $("#loader").show();
            $(".ppob").hide();
            $("#historytrx").hide();
        },
        success: function(data){
          $('#id_pelanggan').val("");
          $('#operator').val("");
        },
        complete:function(response){
            // Hide image container
            $("#loader").hide();
            $("#historytrx").hide().load(" #historytrx").fadeIn();
            $('#id_pelanggan').val("");
            $('#operator').val("");
            $("#respon").html(response.responseText);
        }
    });
    return false;
  }
}
</script>
