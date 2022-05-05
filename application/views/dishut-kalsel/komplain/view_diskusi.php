<style>

	.user1 {

		width: 40px;

		height: 40px;

		float: left;

		position: absolute;

		animation: pulse 1s infinite ease-in-out;

		-webkit-animation: pulse 1s infinite ease-in-out;

	}



	.line1 {

		height: 12px;

		margin: 10px 10px 10px 0px;

		animation: pulse 1s infinite ease-in-out;

		-webkit-animation: pulse 1s infinite ease-in-out;

	}



	.isi_pesan1 {

		height: 39px;

		margin: 10px 10px 10px 0px;

		animation: pulse 1s infinite ease-in-out;

		-webkit-animation: pulse 1s infinite ease-in-out;

	}



	@keyframes pulse {

		0% {

			background-color: rgba(165, 165, 165, .1);

		}



		50% {

			background-color: rgba(165, 165, 165, .3);

		}



		100% {

			background-color: rgba(165, 165, 165, .1);

		}

	}



	@-webkit-keyframes pulse {

		0% {

			background-color: rgba(165, 165, 165, .1);

		}



		50% {

			background-color: rgba(165, 165, 165, .3);

		}



		100% {

			background-color: rgba(165, 165, 165, .1);

		}

	}

</style>



<?php

$cek_respon = $this->db->query("SELECT * FROM rb_pusat_bantuan_diskusi where id_pusat_bantuan='" . cetak($this->uri->segment(3)) . "' AND id_konsumen='$detail[id_terlapor]'");

if ($cek_respon->num_rows() >= 1) {

	$cek_respon_pelapor = $this->db->query("SELECT * FROM rb_pusat_bantuan_diskusi where id_pusat_bantuan='" . cetak($this->uri->segment(3)) . "' AND id_konsumen='$detail[id_pelapor]'");

	if ($cek_respon_pelapor->num_rows() <= 0) {

		$rwork = $this->db->query("SELECT * FROM rb_pusat_bantuan_diskusi where id_pusat_bantuan='" . cetak($this->uri->segment(3)) . "' AND id_konsumen='$detail[id_terlapor]' ORDER BY id_diskusi DESC LIMIT 1")->row_array();

		$date1 = str_replace('-', '/', $rwork['waktu_kirim']);

		$tomorrow = date('Y-m-d H:i:s', strtotime($date1 . "+1 days"));

		$tomorrow_cek = str_replace(' ', '', str_replace(':', '', str_replace('-', '', $tomorrow)));

		$ss = $this->db->query("SELECT ABS(timediff(now(),'$tomorrow')) as sisa_waktu FROM rb_pusat_bantuan where id_pusat_bantuan='" . cetak($this->uri->segment(3)) . "'")->row_array();

		if (date('YmdHis') > $tomorrow_cek) {

			$sisa_waktu = $sisa_waktu = '000000';

		} else {

			$sisa_waktu = sprintf("%06d", $ss['sisa_waktu']);

		}

	} else {

		$cek_respon_pertama = $this->db->query("SELECT waktu_kirim FROM rb_pusat_bantuan_diskusi where id_pusat_bantuan='" . cetak($this->uri->segment(3)) . "' AND id_konsumen='$detail[id_terlapor]' ORDER BY id_diskusi ASC LIMIT 1")->row_array();

		$ss = $this->db->query("SELECT timediff(now(),'$cek_respon_pertama[waktu_kirim]') as sisa_waktu FROM rb_pusat_bantuan where id_pusat_bantuan='" . cetak($this->uri->segment(3)) . "'")->row_array();

		$sisa_waktu = str_replace(':', '', $ss['sisa_waktu']);

	}

} else {

	$date1 = str_replace('-', '/', $detail['waktu_report']);

	$tomorrow = date('Y-m-d H:i:s', strtotime($date1 . "+1 days"));

	$tomorrow_cek = str_replace(' ', '', str_replace(':', '', str_replace('-', '', $tomorrow)));

	$ss = $this->db->query("SELECT ABS(timediff(now(),'$tomorrow')) as sisa_waktu FROM rb_pusat_bantuan where id_pusat_bantuan='" . cetak($this->uri->segment(3)) . "'")->row_array();

	if (date('YmdHis') > $tomorrow_cek) {

		$sisa_waktu = '000000';

	} else {

		$sisa_waktu = sprintf("%06d", $ss['sisa_waktu']);

	}

}

?>



<script type="text/javascript">

	$(document).ready(function() {

		var detik = <?php echo substr($sisa_waktu, 4, 2); ?>;

		var menit = <?php echo substr($sisa_waktu, 2, 2); ?>;

		var jam = <?php echo substr($sisa_waktu, 0, 2); ?>;

		var hari = 0;

		var bulan = 0;



		function hitung() {

			/** setTimout(hitung, 1000) digunakan untuk 

			 * mengulang atau merefresh halaman selama 1000 (1 detik) 

			 */

			setTimeout(hitung, 1000);



			/** Jika waktu kurang dari 10 menit maka Timer akan berubah menjadi warna merah */

			if (menit < 10 && jam == 0 && hari == 0 && bulan == 0) {

				var peringatan = 'style="color:red;"';

			};



			/** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */

			$('#timer').html(

				'<div align="center"' + peringatan + '>' + jam + ' jam, ' + menit + ' menit, ' + detik + ' detik...</h1><br><hr>'

			);



			/** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */

			detik--;



			/** Jika var detik < 0

			 * var detik akan dikembalikan ke 59

			 * Menit akan Berkurang 1

			 */

			if (detik < 0) {

				detik = 59;

				menit--;



				/** Jika menit < 0

				 * Maka menit akan dikembali ke 59

				 * Jam akan Berkurang 1

				 */

				if (menit < 0) {

					menit = 59;

					jam--;



					/** Jika jam < 0

					 * Maka jam akan dikembali ke 23

					 * Jam akan Berkurang 1

					 */

					if (jam < 0) {

						jam = 23;

						hari--;



						/** Jika hari < 0

						 * Maka hari akan dikembali ke 29

						 * Jam akan Berkurang 1

						 */

						if (hari < 0) {

							hari = 29

							bulan--;



							/** Jika var bulan < 0

							 * clearInterval() Memberhentikan Interval dan submit secara otomatis

							 */

							if (bulan < 0) {

								clearInterval();

								/** Variable yang digunakan untuk submit secara otomatis di Form */

								var sub = document.getElementById("sub");

								$("#refresh").hide().load(" #refresh").fadeIn('normal');

							}

						}

					}

				}

			}

		}

		/** Menjalankan Function Hitung Waktu Mundur */

		hitung();

	});

	// ]]>

</script>



<?php

if ($this->uri->segment(4) == '0' or $this->uri->segment(4) == '') {

  $next = $this->uri->segment(4) + 10;

  $prev = 0;

  $prev_tombol = "style='pointer-events:none; color:#a7a7a7'";

} else {

  $next = $this->uri->segment(4) + 10;

  $prev = $this->uri->segment(4) - 10;

  $prev_tombol = '';

}

?>



<div class="ps-page--single">

    <div class="ps-breadcrumb">

        <div class="container">

            <ul class="breadcrumb">

                <li><a href="<?php echo base_url(); ?>">Home</a></li>

                <li><a href="#">Komplain</a></li>

                <li>Resolution Center</li>

            </ul>

        </div>

    </div>

</div>

<div class="ps-vendor-dashboard pro" style='margin-top:10px'>

    <div class="container">

        <div class="ps-section__content"><br>

            <div class="row">

                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 ">

                <?php 

                  if ($detail['putusan'] == 'proses') {

                    if ($detail['id_pelapor'] == $this->session->id_konsumen) {

                      echo "<a style='text-align:left' class='ps-btn ps-btn--fullwidth' href='" . base_url() . "komplain/room/" . $this->uri->segment(3) . "?status=selesai' onclick=\"return confirm('Apa anda yakin masalah ini sudah selesai?')\"><center>Selesai / Batalkan Komplain</center></a>";

                    }

                  } else {

                    echo "<div style='border-left:0px; margin-top:10px; margin-bottom:0px' class='alert alert-success'><span class='fa fa-check-square'></span> Telah Selesai/Dibatalkan,..</div>";

                  }

                  echo "<hr><table class='table table-sm'>

                          <tbody>

                          <h4 class='no-margin'>No. Invoice</h4>    <p>$rows[kode_transaksi]/$rows[id_reseller]</p>

                          <h4 class='no-margin'>Jualan</h4>    <p><a target='_BLANK' href='".base_url()."u/$pen[user_reseller]'>$pen[nama_reseller]</a></p>

                          <h4 class='no-margin'>Produk</h4>"; 

                          $id_penjualan_detail = explode(';',$detail['id_penjualan_detail']);  

                          for ($i=0; $i < count($id_penjualan_detail); $i++) { 

                            $row = $this->db->query("SELECT a.*, b.nama_produk, b.produk_seo FROM rb_penjualan_detail a JOIN rb_produk b ON a.id_produk=b.id_produk where id_penjualan_detail='".cetak($id_penjualan_detail[$i])."'")->row_array();

                            echo "<p class='no-margin'>".($i+1).". <a style='text-decoration:underline' target='_BLANK' href='".base_url()."produk/detail/$row[produk_seo]'>$row[nama_produk]</a> <b>(Qty. $row[jumlah] x Rp ".rupiah($row['harga_jual']-$row['diskon']).")</b></p>";

                          }

                          echo "<br><h4 class='no-margin'>Isi Komplain</h4>   <p>$detail[keterangan]</p>

                          </tbody>

                        </table>";



                        echo "<h4>History Kunjungan</h4>

                        <div style='padding:5px 10px; border:1px solid #e3e3e3; height:270px'><span class='refresh'>";

                        $kunjungan = $this->db->query("SELECT a.*, a.id_konsumen, b.level, c.nama_lengkap, d.nama_reseller FROM `rb_pusat_bantuan_kunjungan` a JOIN rb_pusat_bantuan_diskusi b ON a.id_konsumen=b.id_konsumen 

                                                      LEFT JOIN rb_konsumen c ON a.id_konsumen=c.id_konsumen

                                                      LEFT JOIN rb_reseller d ON c.id_konsumen=d.id_konsumen

                                                      where a.id_pusat_bantuan='".cetak($this->uri->segment('3'))."' ORDER BY a.id_kunjungan DESC LIMIT 10");

                        if ($kunjungan->num_rows() <= 0) {

                          echo "<center style='padding:90px 0px'>Belum ada kunjungan...</center>";

                        }

                        foreach ($kunjungan->result_array() as $kun) {

                          if ($kun['level']=='pembeli'){ $nama =  $kun['nama_lengkap']; $color = ''; }else{ $nama =  $kun['nama_reseller']; $color = 'blue'; }

                          echo "<a title='$kun[ip_address] - $kun[os_browser]' href='#' style='color:$color'>$nama</a> <small class='pull-right' style='color:#8a8a8a'>" . cek_terakhir($kun['waktu_kunjung']) . "</small><hr style='margin:2px'>";

                        }

                        echo "</span></div>";

                ?>

                    <div style='clear:both'><br></div>

                </div>



                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 ">

                    <figure class="ps-block--vendor-status biodata">

                        <?php 

                            echo "<p style='font-size:17px; border-left:5px solid #8a8a8a; padding:10px; background:#e3e3e3'><b>Hallo!</b> Selamat datang di Resolution Center,..<br>

                            Mari berdiskusi secara langsung untuk menentukan solusi dari penyelesaian kendala terkait pesanan.</p>



                            <table style='background:#fff; border-radius:6px;' class='table table-hover dont-break-out'>

                                <thead>

                                <tr>

                                  <td colspan='2' valign=top>";

                                    $cek_status_komplain = $this->db->query("SELECT putusan FROM rb_pusat_bantuan where id_pusat_bantuan='" . cetak($this->uri->segment(3)) . "'")->row_array();

                                    if ($cek_status_komplain['putusan'] == 'proses') {

                                        if ($cek_respon->num_rows() >= 1) {

                                          if ($cek_respon_pelapor->num_rows() <= 0) {

                                            if (selisih_jam(date('Y-m-d H:i:s'), $rwork['waktu_kirim']) < 24) {

                                              echo "<div class='refresh'><center>Menunggu Respon <b>$detail[pelapor]</b> (Pelapor) dalam

                                                    <div style='font-size:15px; color:red; line-height:initial' id='timer'></div>

                                                    </center></div>

                                                    

                                                    <div id='form-comment'>

                                                      <textarea class='form-control required textarea komentarx' id='comment' placeholder='Tuliskan Pesan Disini...' onkeyup=\"auto_grow(this)\" required></textarea>

                                                      <button class='ps-btn ps-btn--outline refresh-btn float-right' style='padding:4px 15px'><span class='fa fa-refresh'></span></button>

                                                      <button id='sendMessage' class='ps-btn submitx' style='margin-right:3px; padding:5px 15px' data-loading-text='Loading...'>Kirimkan</button>

                                                      <div id='mulitplefileuploader' class='mt-2'>Choose files</div>

                                                            <div id='status'></div>

                                                        </div>";

                                            } else {

                                              echo "<div class='alert alert-danger'><center>Diskusi untuk komplain ini sudah ditutup<br> karena tidak ada respon dari <b>$detail[pelapor]</b> (Pelapor),..</center></div>";

                                            }

                                          } else {

                                            echo "<div id='form-comment'>

                                                    <textarea class='form-control required textarea komentarx' id='comment' placeholder='Tuliskan Pesan Disini...' onkeyup=\"auto_grow(this)\" required></textarea>

                                                    <button class='ps-btn ps-btn--outline refresh-btn float-right' style='padding:4px 15px'><span class='fa fa-refresh'></span></button>

                                                    <button id='sendMessage' class='ps-btn submitx float-right' style='margin-right:3px; padding:5px 15px' data-loading-text='Loading...'>Kirimkan</button>

                                                    <div id='mulitplefileuploader' class='mt-2'>Choose files</div>

                                                    <div id='status'></div>

                                                  </div>";

                                          }

                                        } else {

                                          if (selisih_jam(date('Y-m-d H:i:s'), $detail['waktu_report']) < 24) {

                                            echo "<div class='refresh'><center>Menunggu Respon <b>$detail[terlapor]</b> (Terlapor) dalam

                                                    <div style='font-size:15px; color:red; line-height:initial' id='timer'></div>

                                                    </center></div>

                                                    

                                                  <div id='form-comment'>

                                                    <textarea class='form-control required textarea komentarx' id='comment' placeholder='Tuliskan Pesan Disini...' onkeyup=\"auto_grow(this)\" required></textarea>

                                                    <button class='ps-btn ps-btn--outline refresh-btn float-right' style='padding:4px 15px'><span class='fa fa-refresh'></span></button>

                                                    <button id='sendMessage' class='ps-btn submitx' style='margin-right:3px; padding:5px 15px' data-loading-text='Loading...' style='float:right'>Kirimkan</button>

                                                    

                                                    <div id='mulitplefileuploader' class='mt-2'>Choose files</div>

                                                          <div id='status'></div>";

                                            echo "</div>";

                                          } else {

                                            echo "<div class='alert alert-danger'><center>Diskusi untuk komplain ini sudah ditutup<br> karena tidak ada respon dari <b>$detail[terlapor]</b> (Terlapor),..,..</center></div>";

                                          }

                                        }

 

                                    } else {

                                      echo "<div class='alert alert-danger'><center>Diskusi untuk komplain ini sudah selesai dan ditutup,..</center></div>";

                                    }

                                    echo "</td>

                                                  </tr>

                                        </thead>";

                                  

                                    for ($i = 1; $i <= 7; $i++) {

                                      echo "<tr class='lazy'><td width='50px'><div class='user1'></div></td><td><div class='line1'></div><div class='isi_pesan1'></div></td></tr>";

                                    }

                          

                            echo "<tbody class='tampilkan_diskusi'>

                                </tbody>

                              </table>";

                          

                            $hitung_pesan = $this->db->query("SELECT id_diskusi FROM `rb_pusat_bantuan_diskusi` where id_pusat_bantuan='" . $this->uri->segment(3) . "'");

                            if ($hitung_pesan->num_rows() > 10) {

                              echo "<center><ul class='pagination messageatt'>

                                  <li><a href='" . base_url() . "komplain/room/" . $this->uri->segment(3) . "/$prev' $prev_tombol>&lt; Selanjutnya</a></li>

                                  <li><a href='" . base_url() . "komplain/room/" . $this->uri->segment(3) . "/$next' >Sebelumnya &gt;</a></li>

                                </ul></center>";

                            }

                            echo "</div>";

                        ?>

                    </figure>

                </div>

              

            </div>

        </div>

    </div>

</div>



<script>

  $(document).ready(function() {

    var settings = {

      url: "<?php echo base_url(); ?>komplain/upload_diskusi",

      formData: {

        id: "<?php echo $this->uri->segment(3); ?>"

      },

      dragDrop: false,

      maxFileCount: 5,

      multiple: true,

      fileName: "uploadFile",

      maxFileSize: 5000 * 1024,

      allowedTypes: "jpg,png,jpeg,txt,pdf,gif,zip,rar,tar",

      returnType: "json",

      showDone: false,

      showDelete: true,

      deleteCallback: function(data, pd) {

        for (var i = 0; i < data.length; i++) {

          $.post("<?php echo base_url(); ?>komplain/deleteFile_diskusi", {

              op: "delete",

              name: data[i]

            },

            function(resp, textStatus, jqXHR) {

              // $("#status").append("<div>File Deleted</div>");  

            });

        }

        pd.statusbar.hide();

      }

    }

    $("#mulitplefileuploader").uploadFile(settings);

  });

</script>



<script>

		$(document).ready(function() {

			tampilkan_diskusi();

			function split_data(myStr) {

				if (myStr !== null) {

					//console.log(myStr.split(";"));

					var strArray = myStr.split(";");

					var data_file = '';

					no = 1;

					data_file += '<div style="padding:5px; margin:0px" class="alert alert-info"> <i class="fa fa-link fa-fw"></i>Ada ' + strArray.length + ' Lampiran : </div>';

					for (var i = 0; i < strArray.length; i++) {

						data_file += '<small style="color:#000; margin-left:20px"><b>' + no + '. <a href="<?php echo base_url(); ?>komplain/download/' + strArray[i] + '">' + strArray[i] + '</a> </b></small><br>';

						//('+getFileSize('<?php //echo base_url(); 

											?>messages/download/'+strArray[i])+')

						no++;

					}

					return data_file;

				} else {

					return '';

				}

			}



			function tampilkan_diskusi() {

				$('.lazy').show();

				$('.messageatt').hide();

				$.ajax({

					url: '<?php echo site_url("komplain/read_query/" . $this->uri->segment(3) . '/' . $this->uri->segment('4')); ?>',

					type: 'GET',

					async: true,

					dataType: 'json',

					success: function(data) {

						var html = '';

						var count = 1;

						var i;

						for (i = 0; i < data.length; i++) {



              if (data[i].level=='pembeli'){

                nama_lengkap = data[i].nama_lengkap;

                if (data[i].thumb_foto == '') {

                  foto_profile = "blank.png";

                } else {

                  foto_profile = data[i].thumb_foto;

                }

              }

              

              if (data[i].level=='penjual'){

                nama_lengkap = data[i].nama_reseller;

                if (data[i].foto_reseller == null) {

                  foto_profile = "toko.jpg";

                } else {

                  foto_profile = data[i].foto_reseller;

                }

              }



              if (data[i].level=='admin'){

                nama_lengkap = '<?= config('resolusi_center'); ?>';

                foto_profile = "admin_resolusi.png";

              }



							html += '<tr>' +

								'<td width="55px"> <a href="<?php echo base_url(); ?>"><img width="50px" src="<?php echo base_url(); ?>asset/foto_user/' + foto_profile + '" class="img-thumbnail" alt="User Image"></a></td>' +

								'<td><a href="<?php echo base_url(); ?>"><b style="font-size:18px">' + nama_lengkap + '</b></a>, ' +

								'<span class="pull-right"><small style="color:green">' + timeAgo(Date.parse(data[i].waktu_kirim)) + '</small></span>' +

								'<small style="color:red"> Mengatakan :</small> <br>' +

								auto_link(nl2br(stripslashes(htmlEntities(data[i].isi_pesan)))).replaceArray() +

								'<br>' + split_data(data[i].lampiran) +

								'</td>' +

								'</tr>';

						}

						$('.tampilkan_diskusi').html(html);

					},

					complete: function() {

						$('.lazy').hide();

						$('.messageatt').show();

					}



				});

			}



			$('#sendMessage').on('click', function() {

				var id = <?php echo $this->uri->segment(3); ?>;

				var comment = $('#comment').val();

				$.ajax({

					url: '<?php echo site_url("komplain/sendComment"); ?>',

					method: 'POST',

					data: {

						id: id,

						comment: comment

					},

					success: function() {

						$('#comment').val("");

            $(".ajax-file-upload-statusbar").addClass("hidden");

            $(".refresh").hide().load(" .refresh").fadeIn();

            tampilkan_diskusi();

					}

				});

      });

      

      $('.refresh-btn').on('click', function() {

            $(".refresh").hide().load(" .refresh").fadeIn();

            tampilkan_diskusi();

      });

      

		});

	</script>