<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {
	public function email(){
		echo kirim_email('Coba Kirimkan Email','Ini adalah isi Pesan yang dikirim...','kymteta@gmail.com');
		echo "E-mail Terkirim,..";
	}
	
	public function update(){
		if ($this->db->field_exists('user_reseller', 'rb_reseller')){
			$reseller = $this->db->query("SELECT id_reseller, nama_reseller FROM rb_reseller where user_reseller is NULL");
			foreach ($reseller->result_array() as $row) {
				$cek_user_exist = $this->db->query("SELECT user_reseller FROM rb_reseller where user_reseller='".seo_title($row['nama_reseller'])."'");
				if ($cek_user_exist->num_rows()>=1){ $user_reseller = seo_title($row['nama_reseller']).rand(100,999); }else{ $user_reseller = seo_title($row['nama_reseller']); }
				$this->db->query("UPDATE rb_reseller SET user_reseller='$user_reseller' where id_reseller='$row[id_reseller]'");
			}
		}else{
			$this->db->query("ALTER TABLE `rb_reseller` ADD `user_reseller` VARCHAR(255) NULL DEFAULT NULL AFTER `id_konsumen`;");
			$reseller = $this->db->query("SELECT id_reseller, nama_reseller FROM rb_reseller where user_reseller is NULL");
			foreach ($reseller->result_array() as $row) {
				$cek_user_exist = $this->db->query("SELECT user_reseller FROM rb_reseller where user_reseller='".seo_title($row['nama_reseller'])."'");
				if ($cek_user_exist->num_rows()>=1){ $user_reseller = seo_title($row['nama_reseller']).rand(100,999); }else{ $user_reseller = seo_title($row['nama_reseller']); }
				$this->db->query("UPDATE rb_reseller SET user_reseller='$user_reseller' where id_reseller='$row[id_reseller]'");
			}
		}

		
	}
    
	public function index(){
		if (isset($_GET['hapus_cookie'])){
			$cookie = array(
				'name'   => 'notshow',
				'value'  => '',
				'expire' => '0',
				);
			delete_cookie($cookie);
			redirect('main');
		}
		
		$data['title'] = title();
		$data['description'] = description();
		$data['keywords'] = keywords();
		$data['ik1'] = $this->model_app->view_ordering_limit('iklanatas','id_iklanatas','ASC',0,1)->row_array();
		$data['ik2'] = $this->model_app->view_ordering_limit('iklanatas','id_iklanatas','ASC',1,1)->row_array();
		$data['ik3'] = $this->model_app->view_ordering_limit('iklanatas','id_iklanatas','ASC',2,1)->row_array();
		$data['ik4'] = $this->model_app->view_ordering_limit('iklanatas','id_iklanatas','ASC',3,1)->row_array();
		$data['ik5'] = $this->model_app->view_ordering_limit('iklanatas','id_iklanatas','ASC',4,1)->row_array();
		$data['kategori'] = $this->db->query("SELECT * FROM (SELECT a.*,b.produk FROM (SELECT * FROM `rb_kategori_produk`) as a LEFT JOIN
										(SELECT id_kategori_produk, COUNT(*) produk FROM rb_produk GROUP BY id_kategori_produk HAVING COUNT(id_kategori_produk)) as b on a.id_kategori_produk=b.id_kategori_produk ORDER BY RAND()) as c WHERE produk>=6 ORDER BY c.id_kategori_produk DESC LIMIT 5");
		
		$row = $this->db->query("SELECT maps FROM identitas where id_identitas='1'")->row_array();
		$data['record'] = $this->db->query("SELECT a.*, b.nama_reseller, c.nama_kota FROM rb_produk a LEFT JOIN rb_reseller b ON a.id_reseller=b.id_reseller
									LEFT JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_reseller!='0' AND a.aktif='Y' ORDER BY a.id_produk DESC LIMIT 0,12");
		$maps = explode('|',$row['maps']);
		$data['penulis'] = $this->model_utama->penulis();
		$data['berita'] = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori', 'berita.status = "Y" AND berita.username = "admin"','id_berita','DESC',0,7);
		$data['opini'] = $this->model_utama->view_join_one('berita','kategori','id_kategori', 'berita.status = "Y" AND berita.username != "admin"','id_berita','DESC',0,5);
		$data['berita_sisi'] = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori', 'berita.status = "Y" AND berita.username = "admin"','id_berita','DESC',5,5);

		$data['aksi'] = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori', 'berita.status = "Y" AND berita.username = "admin"','id_berita','DESC',0,3);
		$data['aksi_dua'] = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori', 'berita.status = "Y" AND berita.username = "admin"','id_berita','DESC',3,3);
		$data['sosialisasi'] = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori', 'berita.status = "Y" AND berita.username = "admin"','id_berita','DESC',6,6);
		$data['edukasi'] = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori', 'berita.status = "Y" AND berita.username = "admin"','id_berita','DESC',12,6);
		$data['persuasif'] = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori', 'berita.status = "Y" AND berita.username = "admin"','id_berita','DESC',18,6);
		$data['maps'] = $maps[0];
		if ($maps[0]!=''){
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
			$data['operator'] = json_decode($operator);
		}
		$this->template->load(template().'/template',template().'/content',$data);
	}

	function produk(){
        if (isset($_POST['operator_id'])){
			$row = $this->db->query("SELECT maps FROM identitas where id_identitas='1'")->row_array();
			$maps = explode('|',$row['maps']);

            $data['operator_id'] = cetak($this->input->post('operator_id'));
			$data['page'] = cetak($this->input->get('page'));
            $url = 'https://tripay.co.id/api/v2/pembelian/produk/';
            $header = array(
            'Accept: application/json',
            'Authorization: Bearer '.$maps[0], // Ganti [apikey] dengan API KEY Anda
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POST, 1);
            $produk = curl_exec($ch);
            if(curl_errno($ch)){
                return 'Request Error:' . curl_error($ch);
            }
            $data['produk'] = json_decode($produk);
            $this->load->view(template().'/view_produk',$data);	
        }else{
            redirect('home');
        }	
	}
	
	function proses(){
		cek_session_members();
		if ($_POST['produk']!=''){
			$row = $this->db->query("SELECT maps FROM identitas where id_identitas='1'")->row_array();
			$maps = explode('|',$row['maps']);

			$ex = explode('|',cetak($this->input->post('produk')));
			$urla = 'https://tripay.co.id/api/v2/pembelian/produk/';
			$headera = array(
			'Accept: application/json',
			'Authorization: Bearer '.$maps[0], // Ganti [apikey] dengan API KEY Anda
			);

			$cha = curl_init();
			curl_setopt($cha, CURLOPT_URL, $urla);
			curl_setopt($cha, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($cha, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($cha, CURLOPT_HTTPHEADER, $headera);
			curl_setopt($cha, CURLOPT_POST, 1);
			$produk = curl_exec($cha);
			if(curl_errno($cha)){
				return 'Request Error:' . curl_error($cha);
			}
			
			$harga = 0;
			$json = json_decode($produk, 1);
			$resources = $json['data'];
			foreach ($resources as $rkey => $resource){
				if ($resource['code'] == $ex[0]){
					$cek_margin = $this->db->query("SELECT * FROM rb_ppob_margin where kode_ppob='".$resource['code']."'");
					if ($cek_margin->num_rows()>='1'){
						$row = $cek_margin->row_array();
						$harga = $resource['price']+$row['margin'];
					}else{
						$harga = $resource['price'];
					}
				}
			}
	
			if (saldo(reseller($this->session->id_konsumen),$this->session->id_konsumen)>=$harga){
				$url = 'https://tripay.co.id/api/v2/transaksi/pembelian';
				$header = array(
				'Accept: application/json',
				'Authorization: Bearer '.$maps[0].'', // Ganti [apikey] dengan API KEY Anda
				);
				
				$api_trxid = $this->session->id_konsumen.''.date('YmdHis');
				if (cetak($this->input->post('id_pelanggan'))!=''){
					$data = array(
						'inquiry' => 'PLN', // 'PLN' untuk pembelian PLN Prabayar, atau 'I' (i besar) untuk produk lainnya
						'code' => $ex[0], // kode produk
						'phone' => cetak($this->input->post('tujuan')), // nohp pembeli
						'no_meter_pln' => cetak($this->input->post('id_pelanggan')), // khusus untuk pembelian token PLN prabayar
						'api_trxid' => $api_trxid, // ID transaksi dari server Anda. (tidak wajib, maks. 25 karakter)
						'pin' => $maps[1], // pin member
						);
				}else{
					$data = array(
						'inquiry' => 'I', // 'PLN' untuk pembelian PLN Prabayar, atau 'I' (i besar) untuk produk lainnya
						'code' => $ex[0], // kode produk
						'phone' => cetak($this->input->post('tujuan')), // nohp pembeli
						'no_meter_pln' => '', // khusus untuk pembelian token PLN prabayar
						'api_trxid' => $api_trxid, // ID transaksi dari server Anda. (tidak wajib, maks. 25 karakter)
						'pin' => $maps[1], // pin member
						);
				}

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				$result = curl_exec($ch);
				if(curl_errno($ch)){
					return 'Request Error:' . curl_error($ch);
				}
				$trx = json_decode($result);
				if ($trx->success=='true'){
					$keterangan = $this->session->id_konsumen.'-'.date('YmdHis').'|'.$ex[0].'|'.cetak($this->input->post('tujuan'));
					$data = array('id_reseller'=>$this->session->id_konsumen,
								'total'=>$harga,
								'keterangan'=>$keterangan,
								'api_trxid'=>$api_trxid,
								'waktu_pembelian'=>date('Y-m-d H:i:s'));
					$this->model_app->insert('rb_pembelian_pulsa',$data);
					
					echo $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center>Transaksi Pembelian anda sedang diproses,..</center></div>');
					if (!isset($_GET['trx_pulsa'])){
						redirect('members/trx_pulsa');
					}else{
						echo "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><center>Transaksi Pembelian anda sedang diproses,..</center></div>";
					}
				}else{
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, Transaksi Gagal Diproses,..</center></div>');
					if (!isset($_GET['trx_pulsa'])){
						redirect('members/trx_pulsa');
					}else{
						echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><center>Gagal Diproses, terjadi masalah pada server PPOB</center></div>";
					}
				}
			}else{
				if ($_GET['trx_pulsa']!='1'){
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, Saldo anda tidak muncukupi,..</center></div>');
					redirect('members/trx_pulsa');
				}else{
					echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><center>Maaf, Saldo anda tidak muncukupi,..</center></div>";
				}
			}
		}else{
			echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, Anda mengakses secara ilegal,..</center></div>');
			if (!isset($_GET['trx_pulsa'])){
				redirect('members/trx_pulsa');
			}else{
				echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><center>Maaf, Anda mengakses secara ilegal,..</center></div>";
			}
		}
	}

	public function theme(){
		$theme = array("red", "green", "blue", "orange", "yellow", "white");
		if (in_array($this->uri->segment(3), $theme)){
			$this->session->set_userdata(array('theme'=>cetak($this->uri->segment(3))));
			redirect('main');
		}else{
			redirect('main');
		}
	}

	public function subscribe(){
		if (isset($_POST['submit'])){
			$cek = $this->db->query("SELECT * FROM rb_subscribe where email='".cetak($this->input->post('email'))."'");
			if ($cek->num_rows()<=0){
				$data = array('ip_address'=>$_SERVER['REMOTE_ADDR'],
										'email'=>cetak($this->input->post('email')),
										'waktu_subscribe'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_subscribe',$data);
			}
			if (isset($_POST['notshow'])) {
				$key = date('YmdHis');
				set_cookie('notshow', $key, 3600*24*30); // set expired 30 hari kedepan
			}
			redirect('main');
		}
	}
}
