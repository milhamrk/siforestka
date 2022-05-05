<?php 
echo "<div class='col-md-12'>
    <div class='box box-info'>
      <div class='box-header with-border'>
        <h3 class='box-title'>Identitas Website</h3>
      </div>
    <div class='box-body'>

    <div class='panel-body'>
      <ul id='myTabs' class='nav nav-tabs' role='tablist'>
        <li role='presentation' class='active'><a href='#umum' id='umum-tab' role='tab' data-toggle='tab' aria-controls='umum' aria-expanded='true'>Data Umum </a></li>
        <li role='presentation' class=''><a href='#payment' role='tab' id='payment-tab' data-toggle='tab' aria-controls='payment' aria-expanded='false'>Payment</a></li>
        <li role='presentation' class=''><a href='#server' role='tab' id='server-tab' data-toggle='tab' aria-controls='server' aria-expanded='false'>Server / API</a></li>
        <li role='presentation' class=''><a href='#app' role='tab' id='app-tab' data-toggle='tab' aria-controls='app' aria-expanded='false'>App Widget</a></li>
        <li role='presentation' class=''><a href='#sosial' role='tab' id='sosial-tab' data-toggle='tab' aria-controls='sosial' aria-expanded='false'>Sosial Login</a></li>
      </ul><br>";

      echo $this->session->flashdata('message');
            $this->session->unset_userdata('message');

      echo "<div id='myTabContent' class='tab-content'>
            <div role='tabpanel' class='tab-pane fade active in' id='umum' aria-labelledby='umum-tab'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/identitaswebsite',$attributes); 
              $maps = explode('|',$record['maps']);
              $ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
              $fv = explode('|',$ref['keterangan']);

          echo "<div class='col-md-6 col-xs-12'>
                  <input type='hidden' name='id' value='$record[id_identitas]'>
                  <input type='hidden' class='form-control' name='d' value='$record[facebook]'>
                  <input type='hidden' class='form-control' name='e' value='$record[rekening]'>
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Website</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' placeholder='' name='title' value='".config('title')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Domain</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' placeholder='' name='c' value='$record[url]'>
                    </div>
                  </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Title</label>
                      <div class='col-sm-9'>
                        <input type='text' class='form-control' placeholder='' name='a' value='$record[nama_website]'>
                      </div>
                    </div>

                    
                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Meta Keyword</label>
                      <div class='col-sm-9'>
                        <textarea class='form-control' style='height:80px' placeholder='' name='h'>$record[meta_keyword]</textarea>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Meta Deskripsi</label>
                      <div class='col-sm-9'>
                        <textarea class='form-control' style='height:80px' placeholder='' name='g'>$record[meta_deskripsi]</textarea>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Info Footer</label>
                      <div class='col-sm-9'>
                        <textarea class='form-control' style='height:60px' placeholder='' name='info_footer'>".config('info_footer')."</textarea>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Twitter</label>
                      <div class='col-sm-9'>
                        <input type='text' class='form-control' placeholder='' name='twitter' value='".config('twitter')."'>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>FB Pixel</label>
                      <div class='col-sm-9'>
                        <input type='text' class='form-control' placeholder='' name='facebook_pixel' value='".config('facebook_pixel')."'>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Google verif.</label>
                      <div class='col-sm-9'>
                      <input type='text' class='form-control' placeholder='' name='google_site_verification' value='".config('google_site_verification')."'>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Mode Aktif</label>
                      <div class='col-sm-9'>";
                        if (config('mode')=='marketplace'){
                          echo "<input type='radio' name='mode' value='marketplace' class='marketplace' checked> Marketplace &nbsp; &nbsp;
                                <input type='radio' name='mode' value='ecommerce' class='ecommerce'> E-Commerce
                                  ";
                        }else{
                          echo "<input type='radio' name='mode' value='marketplace' class='marketplace'> Marketplace &nbsp; &nbsp;
                                <input type='radio' name='mode' value='ecommerce' class='ecommerce' checked> E-Commerce";
                        }
                      echo "</div>
                        
                    </div>
                    <div class='desc'>
                      <div class='alert alert-danger'><b>PENTING</b> - Pastikan di system sudah terdaftar 1 <a href='".base_url().$this->uri->segment(1)."/reseller'>PELAPAK</a> dan jika lebih dari 1 maka pastikan hanya 1 pelapak saja yang di <u><b>Verfikasi</b></u>, karena pelapak terverfikasi akan menjadi default Lapak posting produk mode E-Commerce. </div>
                    </div>
                </div>

                <div class='col-md-6 col-xs-12'>
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Izin Publish</label>
                    <div class='col-sm-9'>";
                      if (config('approve_produk')=='Y'){
                        echo "<input type='radio' name='approve_produk' value='N'> Ya &nbsp; &nbsp;
                              <input type='radio' name='approve_produk' value='Y' checked> Tidak
                                ";
                      }else{
                        echo "<input type='radio' name='approve_produk' value='N' checked> Ya &nbsp; &nbsp;
                              <input type='radio' name='approve_produk' value='Y'> Tidak";
                      }
                      echo "<br><small style='color:green'><i>Produk yang diposting (Pelapak) perlu persetujuan untuk publish.</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Resolution</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' placeholder='' name='resolusi_center' value='".config('resolusi_center')."'>
                      <small style='color:green'><i>Nama Tampil - untuk Admin Resolution Center</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Info Atas</label>
                    <div class='col-sm-9'>
                    <textarea class='form-control' style='height:80px' placeholder='' name='info_atas'>$record[info_atas]</textarea>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>No Telpon</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' placeholder='' name='f' value='$record[no_telp]'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Flash Deal</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control datepicker1' placeholder='' name='flash_deal' value='".tgl_view($record['flash_deal'])."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Free Seller</label>
                    <div class='col-sm-9'>
                    <input type='number' class='form-control' placeholder='' name='free_reseller' value='$record[free_reseller]'>
                    <small style='color:green'><i>Jumlah Produk yang dapat diposting oleh Pelapak (Free Seller)</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>WA Seller</label>
                    <div class='col-sm-9'>";
                    if (config('wa_seller')=='Y'){
                      echo "<input type='radio' name='wa_seller' value='Y' checked> Aktif &nbsp; &nbsp;
                              <input type='radio' name='wa_seller' value='N'> Non Aktif";
                    }else{
                      echo "<input type='radio' name='wa_seller' value='Y'> Aktif &nbsp; &nbsp;
                              <input type='radio' name='wa_seller' value='N' checked> Non Aktif";
                    }
                    echo "<br><small style='color:green'><i>Izinkan Konsumen Menghubungi Pelapak via Whatsapp?</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Referral</label>
                    <div class='col-sm-9'>";
                    if (config('token_referral')=='Y'){
                      echo "<input type='radio' name='token_referral' value='Y' checked> Ya &nbsp; &nbsp;
                              <input type='radio' name='token_referral' value='N'> Tidak";
                    }else{
                      echo "<input type='radio' name='token_referral' value='Y'> Ya &nbsp; &nbsp;
                              <input type='radio' name='token_referral' value='N' checked> Tidak";
                    }
                    echo "<br><small style='color:green'><i>Langsung Aktifkan URL Referral Saat Pendaftaran Konsumen?</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                      <label class='col-sm-3 control-label'>Favicon</label>
                      <div class='col-sm-9'>
                        <input type='file' class='form-control' name='j'>
                        Favicon Aktif Saat ini : <img style='width:32px; height:32px' src='".base_url()."asset/images/$record[favicon]'>
                      </div>
                    </div>

                  
                </div>

              <div style='clear:both'></div>
              <div class='box-footer'>
                <button type='submit' name='umum' class='btn btn-primary'>Simpan Perubahan</button>
                <a href='".base_url().$this->uri->segment(1)."/identitaswebsite'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
              </div>";
              echo form_close();
            echo "</div>



            <div role='tabpanel' class='tab-pane fade' id='payment' aria-labelledby='payment-tab'>";
            $attributes = array('class'=>'form-horizontal','role'=>'form');
            echo form_open_multipart($this->uri->segment(1).'/identitaswebsite',$attributes); 
              echo "<input type='hidden' name='id' value='$record[id_identitas]'>
              <div class='col-md-6 col-xs-12'> 
                  <div class='form-group'>
                    <label class='col-sm-4 control-label'>Verifikasi Lapak</label>
                    <div class='col-sm-8'>";
                    if ($fv[1]=='Y'){
                      echo "<input type='radio' name='verifikasi' value='Y' checked> Ya &nbsp; &nbsp;
                            <input type='radio' name='verifikasi' value='N'> Tidak";
                    }else{
                      echo "<input type='radio' name='verifikasi' value='Y'> Ya &nbsp; &nbsp;
                            <input type='radio' name='verifikasi' value='N' checked> Tidak";
                    }
                    echo "<br><small style='color:green'><i>Verifikasi Pengaktifan Akun Lapak/Pelapak oleh admin.</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-4 control-label'>Order requires</label>
                    <div class='col-sm-8'>";
                    if ($fv[2]=='enable'){
                      echo "<input type='radio' name='requires' value='enable' checked> Harus Login &nbsp; &nbsp;
                            <input type='radio' name='requires' value='disable'> Tanpa Login";
                    }else{
                      echo "<input type='radio' name='requires' value='enable'> Harus Login &nbsp; &nbsp;
                            <input type='radio' name='requires' value='disable' checked> Tanpa Login";
                    }
                    echo "<br><small style='color:green'><i>Untuk Order Produk harus Login atau tanpa Login?</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-4 control-label'>Fee Admin (Rp)</label>
                    <div class='col-sm-8'>
                    <input type='number' class='form-control' name='admin_fee' value='$fv[0]'>
                    <small style='color:green'><i>Fee admin tiap transaksi sukses (Dibebankan ke Konsumen).</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-4 control-label'>Fee Per-Produk</label>
                    <div class='col-sm-8'>";
                    if (config('fee_produk')=='Y'){
                      echo "<input type='radio' name='fee_produk' value='Y' checked> Ya &nbsp; &nbsp;
                            <input type='radio' name='fee_produk' value='N'> Tidak";
                    }else{
                      echo "<input type='radio' name='fee_produk' value='Y'> Ya &nbsp; &nbsp;
                            <input type='radio' name='fee_produk' value='N' checked> Tidak";
                    }
                    echo "<br><small style='color:green'><i>Terapkan Fee Transaksi Per-Produk (Dibebankan ke Pelapak).</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-4 control-label'>Fee Referal (%)</label>
                    <div class='col-sm-8'>
                    <input type='number' class='form-control' name='referral_fee' value='$ref[referral]'>
                    <small style='color:green'><i>Fee diambil dari transaksi sukses pelapak yang disponsori.</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-4 control-label'>Fee Withdraw</label>
                    <div class='col-sm-8'>
                    <input type='number' class='form-control' name='withdraw_fee' value='".config('withdraw_fee')."'>
                    <small style='color:green'><i>Fee untuk Tiap Transaksi Withdraw / Penarikan Dana.</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-4 control-label'>Min. Withdraw</label>
                    <div class='col-sm-8'>
                    <input type='number' class='form-control' name='withdraw_min' value='".config('withdraw_min')."'>
                    <small style='color:green'><i>Nilai Minimal Tiap Transaksi Withdraw / Penarikan Dana.</i></small style='color:green'>
                    </div>
                  </div>

                </div>

              <div class='col-md-6 col-xs-12'>
                <div class='form-group'>
                  <label class='col-sm-3 control-label'>API ipaymu</label>
                  <div class='col-sm-9'>
                  <textarea class='form-control' style='height:120px' placeholder='XXXXXXX-XXXXXX-XXXX-XXXXXX-XXXXXXXXXX' name='ipaymu'>".config('ipaymu')."</textarea>
                  </div>
                </div>

                <div class='form-group'>
                  <label class='col-sm-3 control-label'>Url ipaymu</label>
                  <div class='col-sm-9'>
                  <input type='text' class='form-control' name='ipaymu_url' value='".config('ipaymu_url')."'>
                  </div>
                </div>

                <div class='form-group'>
                    <label class='col-sm-3 control-label'>Fee Ipaymu</label>
                    <div class='col-sm-9'>
                    <input type='number' class='form-control' name='ipaymu_fee' value='".config('ipaymu_fee')."'>
                    <small style='color:green'><i>Fee Transaksi Ipaymu dibayarkan oleh Konsumen.</i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Status ipaymu</label>
                    <div class='col-sm-9'>";
                    if (config('ipaymu_aktif')=='Y'){
                      echo "<input type='radio' name='ipaymu_aktif' value='Y' checked> Aktif &nbsp; &nbsp;
                              <input type='radio' name='ipaymu_aktif' value='N'> Non Aktif";
                    }else{
                      echo "<input type='radio' name='ipaymu_aktif' value='Y'> Aktif &nbsp; &nbsp;
                              <input type='radio' name='ipaymu_aktif' value='N' checked> Non Aktif";
                    }
                    echo "</div>
                  </div>
                </div>

                
                <div style='clear:both'></div>
                <div class='box-footer'>
                  <button type='submit' name='payment' class='btn btn-primary'>Simpan Perubahan</button>
                  <a href='".base_url().$this->uri->segment(1)."/identitaswebsite'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                </div>";
                echo form_close();
              echo "</div>



              <div role='tabpanel' class='tab-pane fade' id='server' aria-labelledby='server-tab'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/identitaswebsite',$attributes); 
                echo "<input type='hidden' name='id' value='$record[id_identitas]'>
                  <div class='col-md-6 col-xs-12'>
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>WA Gateway</label>
                    <div class='col-sm-9'>";
                    if (config('wa_gateway')=='wablas'){
                      $text1 = 'Domain Wablas';
                      $text2 = 'API Wablas';
                      echo "<input type='radio' name='wa_gateway' value='wablas' checked> Wablas.com &nbsp; 
                            <input type='radio' name='wa_gateway' value='woowa'> Woo-wa.com (Woowandroid)";
                    }else{
                      $text1 = 'Authorization';
                      $text2 = 'Device / CS ID';
                      echo "<input type='radio' name='wa_gateway' value='wablas'> Wablas.com &nbsp; 
                            <input type='radio' name='wa_gateway' value='woowa' checked> Woo-wa.com (Woowandroid)";
                    }
                    echo "</div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label text1'>$text1</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' style='color:red' name='wa_domain' placeholder='- - - - - - - -' value='".config('wa_domain')."'>
                    </div>
                  </div>
                  
                  <div class='form-group'>
                    <label class='col-sm-3 control-label text2'>$text2</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' style='color:red' name='wa' placeholder='- - - - - - - -' value='".$maps[2]."'>
                    </div>
                  </div>
                  <hr>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>API PPOB</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' style='color:red' name='maps' placeholder='API dari https://tripay.co.id' value='".$maps[0]."'>
                        <input type='text' class='form-control' style='color:red; margin-top: 3px;' name='pin' placeholder='PIN Transaksi' value='".$maps[1]."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>API Rajaongkir</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' style='color:red' name='api_rajaongkir' placeholder='API https://rajaongkir.com PRO' value='$record[api_rajaongkir]'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>API Binderbyte</label>
                    <div class='col-sm-9'>
                      <input type='text' class='form-control' style='color:red' name='api_resi' placeholder='API Cek Resi Dari https://binderbyte.com/' value='".config('api_resi')."'>
                        <small style='color:green'><i>Api Cek Resi Alternatif untuk : <span style='color:red'>".config('api_resi_off')."</span></i></small style='color:green'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Api Resi Aktif</label>
                    <div class='col-sm-9'>";
                    if (config('api_resi_aktif')=='rajaongkir'){
                      echo "<input type='radio' name='api_resi_aktif' value='rajaongkir' checked> Rajaongkir <i style='color:green'>(Binderbyte Alternatif)</i> &nbsp; 
                            <input type='radio' name='api_resi_aktif' value='binderbyte'> Binderbyte (Only)";
                    }else{
                      echo "<input type='radio' name='api_resi_aktif' value='rajaongkir'> Rajaongkir <i style='color:green'>(Binderbyte Alternatif)</i> &nbsp; 
                            <input type='radio' name='api_resi_aktif' value='binderbyte' checked> Binderbyte  (Only)";
                    }
                    echo "</div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>MutasiBank</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' style='color:red' placeholder='API http://mutasibank.co.id' value='$record[api_mutasibank]' name='api_mutasibank'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Callback URL</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' style='color:red' value='".$this->uri->segment(1)."/mutasi_ty35fgdfgd777bba064b72be' disabled>
                    </div>
                  </div>
                </div>

                <div class='col-md-6 col-xs-12'>
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Jenis</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' value='SMTP' disabled>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Secure</label>
                    <div class='col-sm-9'>";
                    if (config('smtp_secure')=='tls'){
                      echo "<input type='radio' name='smtp_secure' value='tls' checked> TLS &nbsp; 
                            <input type='radio' name='smtp_secure' value='ssl'> SSL";
                    }else{
                      echo "<input type='radio' name='smtp_secure' value='tls'> TLS &nbsp; 
                            <input type='radio' name='smtp_secure' value='ssl' checked> SSL";
                    }
                    echo "</div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Server</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='Ex : smtp.googlemail.com' name='email_server' value='".config('email_server')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Port</label>
                    <div class='col-sm-9'>
                    <input type='number' class='form-control' placeholder='xxx' name='email_port' value='".config('email_port')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Pengirim</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='Nama Pengirim Email (Ex : dishutkalsel.co.id)' name='pengirim_email' value='$record[pengirim_email]'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>E-mail Addr.</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='Alamat Email' style='margin-top:3px' name='b' value='$record[email]'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Password</label>
                    <div class='col-sm-9'>
                    <input type='password' class='form-control' placeholder='*************' style='margin-top:3px' name='password'>
                    </div>
                  </div>


                </div>
                <div style='clear:both'></div>
                <div class='box-footer'>
                  <button type='submit' name='server' class='btn btn-primary'>Simpan Perubahan</button>
                  <a href='".base_url().$this->uri->segment(1)."/identitaswebsite'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                </div>";
                echo form_close();
              echo "</div>

              <div role='tabpanel' class='tab-pane fade' id='app' aria-labelledby='app-tab'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/identitaswebsite',$attributes); 
          echo "<div class='col-md-6 col-xs-12'>
                  <input type='hidden' name='id' value='$record[id_identitas]'>
                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Judul</label>
                      <div class='col-sm-9'>
                        <input type='text' class='form-control' placeholder='' name='apps_title' value='".config('apps_title')."'>
                      </div>
                    </div>

                    
                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Keterangan</label>
                      <div class='col-sm-9'>
                        <textarea class='form-control' style='height:120px' placeholder='' name='apps_deskripsi'>".config('apps_deskripsi')."</textarea>
                      </div>
                    </div>
                    
                    <div class='form-group'>
                      <label class='col-sm-3 control-label'>Image</label>
                      <div class='col-sm-9'>
                        <input type='file' class='form-control' name='apps_image'>
                        Gambar Terpasang : <a target='_BLANK' href='".base_url()."asset/images/".config('apps_image')."'>".config('apps_image')."</a>
                      </div>
                    </div>
                </div>

                <div class='col-md-6 col-xs-12'>
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Google Play</label>
                    <div class='col-sm-9'>
                    <input type='url' class='form-control' placeholder='https://...' name='apps_google_play' value='".config('apps_google_play')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>App Store</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='https://...' name='apps_app_store' value='".config('apps_app_store')."'>
                    </div>
                  </div>
                  
                  <div class='form-group'>
                    <label class='col-sm-3 control-label'>Status</label>
                    <div class='col-sm-9'>";
                    if (config('apps_aktif')=='Y'){
                      echo "<input type='radio' name='apps_aktif' value='Y' checked> Aktif &nbsp; &nbsp;
                              <input type='radio' name='apps_aktif' value='N'> Non Aktif";
                    }else{
                      echo "<input type='radio' name='apps_aktif' value='Y'> Aktif &nbsp; &nbsp;
                              <input type='radio' name='apps_aktif' value='N' checked> Non Aktif";
                    }
                    echo "</div>
                  </div>
                  
                </div>

              <div style='clear:both'></div>
              <div class='box-footer'>
                <button type='submit' name='apps' class='btn btn-primary'>Simpan Perubahan</button>
                <a href='".base_url().$this->uri->segment(1)."/identitaswebsite'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
              </div>";
              echo form_close();
            echo "</div>


            <div role='tabpanel' class='tab-pane fade' id='sosial' aria-labelledby='sosial-tab'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/identitaswebsite',$attributes); 
          echo "<div class='col-md-12 col-xs-12'>
                  <input type='hidden' name='id' value='$record[id_identitas]'>
                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>application_name</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' name='application_name' value='".config('application_name')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>redirect_uri</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' name='redirect_uri' value='".config('redirect_uri')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>facebook_app_id</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' name='facebook_app_id' value='".config('facebook_app_id')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>facebook_app_secret</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' name='facebook_app_secret' value='".config('facebook_app_secret')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>Google client_id</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' name='google_client_id' value='".config('google_client_id')."'>
                    </div>
                  </div>

                  <div class='form-group'>
                    <label class='col-sm-2 control-label'>Google client_secret</label>
                    <div class='col-sm-9'>
                    <input type='text' class='form-control' placeholder='xxx' name='google_client_secret' value='".config('google_client_secret')."'>
                    </div>
                  </div>
                </div>

              <div style='clear:both'></div>
              <div class='box-footer'>
                <button type='submit' name='sosial' class='btn btn-primary'>Simpan Perubahan</button>
                <a href='".base_url().$this->uri->segment(1)."/identitaswebsite'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
              </div>";
              echo form_close();
            echo "</div>

            </div></div></div>";
?>
<script>
$(document).ready(function() {
  $(".desc").hide();
  $(".marketplace").click(function(){
    $(".desc").hide();
  });
  $(".ecommerce").click(function(){
    $(".desc").show();
  });

  $('input[name="wa_gateway"]').on('change', function(){
    if ($(this).val()=='wablas') {
      //change to "show update"
      $(".text1").text("Domain Wablas");
      $(".text2").text("API Wablas");
    }else  {
      $(".text1").text("Authorization");
      $(".text2").text("Device / CS ID");
    }
});
});
</script>
            
