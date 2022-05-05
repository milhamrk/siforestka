<div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Mutasi Bank</h3>
                  <?php 
                    $row = $this->db->query("SELECT api_mutasibank, api_rajaongkir FROM identitas where id_identitas='1'")->row_array();
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://mutasibank.co.id/api/v1/accounts",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                      "Authorization: $row[api_mutasibank]"
                    ),
                    ));
                    $response_akun = curl_exec($curl);
                    curl_close($curl);
                    $akun = json_decode($response_akun);
                    
                    echo "<select class='pull-right' onchange=\"document.location.href=this.value\">
                    <option value='' selected>- Pilih Bank -</option>";
                    foreach($akun->data as $item){
                        if($this->uri->segment(3)==$item->id){
                            echo "<option value='".base_url().$this->uri->segment(1)."/mutasi/".$item->id."' selected>".$item->bank."</option>";
                        }else{
                            echo "<option value='".base_url().$this->uri->segment(1)."/mutasi/".$item->id."'>".$item->bank."</option>";
                        }
                    }
                    echo "</select>";
                  ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="mutasi" class="table table-bordered table-sm table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>Status</th>
                        <th>Nominal</th>
                        <th>Keterangan</th>
                        <th>Waktu</th>
                        <th>Balance</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $riwayat = json_decode($response);
                    $no = 1;
                    foreach($riwayat->data as $item){
                        if (strlen($item->description) > 80){ $description = strip_tags(substr($item->description,0,80)).',..';  }else{ $description = strip_tags($item->description); }
                        if ($item->type=='DB'){ 
                            $color = 'danger'; 
                            $text = 'red';
                        }else{ 
                            $color = 'success'; 
                            $text = 'green';
                        }
                        echo "<tr>
                            <td class='$color'><b style='padding-left:10px; color:$text'>".$item->type."</b></td>
                            <td style='color:blue; font-weight:bold'><span style='padding-left:10px'>".rupiah($item->amount)."</span></td>
                            <td><i>$description</i></td>
                            <td>".($item->transaction_date)."</td>
                            <td style='color:green; font-weight:bold'>".rupiah($item->balance)."</td>
                        </tr>";
                        $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>