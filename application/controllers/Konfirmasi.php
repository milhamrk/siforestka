<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Konfirmasi extends CI_Controller {
	public function __construct(){
        parent::__construct();
	}
	
	function index(){
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/files/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('f');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
				$data = array('kode_transaksi'=>cetak($this->input->post('id', TRUE)),
			        		  'total_transfer'=>cetak($this->input->post('b', TRUE)),
			        		  'id_rekening'=>cetak($this->input->post('c', TRUE)),
			        		  'nama_pengirim'=>cetak($this->input->post('d', TRUE)),
			        		  'tanggal_transfer'=>cetak($this->input->post('e', TRUE)),
			        		  'waktu_konfirmasi'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_konfirmasi_pembayaran_konsumen',$data);
			}else{
				$data = array('kode_transaksi'=>cetak($this->input->post('id', TRUE)),
								'total_transfer'=>cetak($this->input->post('b', TRUE)),
								'id_rekening'=>cetak($this->input->post('c', TRUE)),
								'nama_pengirim'=>cetak($this->input->post('d', TRUE)),
								'tanggal_transfer'=>cetak($this->input->post('e', TRUE)),
			        		  'bukti_transfer'=>$hasil['file_name'],
			        		  'waktu_konfirmasi'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_konfirmasi_pembayaran_konsumen',$data);
			}
			$data1 = array('proses'=>'2');
			$where = array('kode_transaksi' => cetak($this->input->post('id', TRUE)));
			$this->model_app->update('rb_penjualan', $data1, $where);
			echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Sukses Melakukan Konfirmasi Pembayaran Pesanan!</center></div>');
			redirect('konfirmasi/index?success');
		}else{
			$data['title'] = 'Konfirmasi Pesanan';
			$data['description'] = description();
			$data['keywords'] = keywords();
			if (isset($_POST['submit1']) OR $_GET['kode']){
				if ($_GET['kode']!=''){
					$kode_transaksi = filter($this->input->get('kode'));
				}else{
					$kode_transaksi = filter($this->input->post('a'));
				}
				$row = $this->db->query("SELECT a.id_penjualan, b.id_reseller FROM `rb_penjualan` a jOIN rb_reseller b ON a.id_penjual=b.id_reseller where status_penjual='reseller' AND a.kode_transaksi='$kode_transaksi'")->row_array();
				$data['record'] = $this->model_app->view('rb_rekening');
				$data['kode'] = $kode_transaksi;
				$data['total'] = $this->db->query("SELECT nominal FROM rb_penjualan_otomatis where kode_transaksi='".$kode_transaksi."'")->row_array();
				$data['rows'] = $this->model_app->view_where('rb_penjualan',array('id_penjualan'=>$row['id_penjualan']))->row_array();
				$this->template->load(template().'/template',template().'/reseller/view_konfirmasi_pembayaran',$data);
			}else{
				$this->template->load(template().'/template',template().'/reseller/view_konfirmasi_pembayaran',$data);
			}
		}
	}

	function tracking(){
		if (isset($_GET['trx_id'])){
			if ($this->uri->segment(3)!=''){
				$kode_transaksi = filter($this->uri->segment(3));
			}else{
				$kode_transaksi = filter($this->input->post('a'));
			}
			$strx = $this->db->query("SELECT status_trx FROM rb_penjualan_otomatis where kode_transaksi='$kode_transaksi'")->row_array();
			if ($strx['status_trx']==''){
				$data = array('catatan'=>cetak($_GET['trx_id']),'status_trx'=>cetak($_GET['status']));
				$where = array('kode_transaksi' => $kode_transaksi);
				$this->model_app->update('rb_penjualan_otomatis', $data, $where);
			}
		}

		if (isset($_POST['submit1']) OR $this->uri->segment(3)!=''){
			if ($this->uri->segment(3)!=''){
				$kode_transaksi = filter($this->uri->segment(3));
			}else{
				$kode_transaksi = filter($this->input->post('a'));
			}

			$cek = $this->model_app->view_where('rb_penjualan',array('kode_transaksi'=>$kode_transaksi));
			if ($cek->num_rows()>=1){
				$data['title'] = 'Telusuri Pesanan '.$kode_transaksi;
				$data['judul'] = $kode_transaksi;
				$data['kode'] = $kode_transaksi;
				$data['description'] = description();
				$data['keywords'] = keywords();
				$data['rows'] = $this->db->query("SELECT * FROM rb_penjualan a JOIN rb_konsumen b ON a.id_pembeli=b.id_konsumen JOIN rb_kota c ON b.kota_id=c.kota_id where a.kode_transaksi='$kode_transaksi'")->row_array();
				$data['record'] = $this->db->query("SELECT a.kode_transaksi, b.*, c.nama_produk, c.gambar, c.satuan, c.berat, c.produk_seo, d.nama_reseller FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN rb_produk c ON b.id_produk=c.id_produk JOIN rb_reseller d ON c.id_reseller=d.id_reseller where a.kode_transaksi='".$kode_transaksi."'");
				$data['total'] = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.service, a.proses, sum(a.ongkir) as ongkir, sum(b.harga_jual*b.jumlah) as total, sum(b.diskon*b.jumlah) as diskon_total, sum(c.berat*b.jumlah) as total_berat FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN rb_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='".$kode_transaksi."'")->row_array();
				$data['unik'] = $this->db->query("SELECT * FROM rb_penjualan_otomatis where kode_transaksi='".$kode_transaksi."'")->row_array();
			
				if (isset($_POST['submit1'])){
					notif_tracking_order($kode_transaksi);
				}
				$this->template->load(template().'/template',template().'/reseller/view_tracking_view',$data);
			}else{
				redirect('konfirmasi/tracking');
			}
		}else{
			$data['title'] = 'Telusuri Pesanan';
			$data['description'] = description();
			$data['keywords'] = keywords();
			$this->template->load(template().'/template',template().'/reseller/view_tracking',$data);
		}
	}
	
	
	function tiket(){
		if (isset($_GET['trx_id'])){
			if ($this->uri->segment(3)!=''){
				$kode_transaksi = filter($this->uri->segment(3));
			}else{
				$kode_transaksi = filter($this->input->post('a'));
			}
			$strx = $this->db->query("SELECT status_trx FROM rb_penjualan_otomatis where kode_transaksi='$kode_transaksi'")->row_array();
			if ($strx['status_trx']==''){
				$data = array('catatan'=>cetak($_GET['trx_id']),'status_trx'=>cetak($_GET['status']));
				$where = array('kode_transaksi' => $kode_transaksi);
				$this->model_app->update('rb_penjualan_otomatis', $data, $where);
			}
		}

		if (isset($_POST['submit1']) OR $this->uri->segment(3)!=''){
			if ($this->uri->segment(3)!=''){
				$kode_transaksi = filter($this->uri->segment(3));
			}else{
				$kode_transaksi = filter($this->input->post('a'));
			}

			$cek = $this->model_app->view_where('rb_penjualan',array('kode_transaksi'=>$kode_transaksi));
			if ($cek->num_rows()>=1){
				$data['title'] = 'Tiket Order '.$kode_transaksi;
				$data['judul'] = $kode_transaksi;
				$data['kode'] = $kode_transaksi;
				$data['description'] = description();
				$data['keywords'] = keywords();
				$data['rows'] = $this->db->query("SELECT * FROM rb_penjualan a JOIN rb_konsumen b ON a.id_pembeli=b.id_konsumen JOIN rb_kota c ON b.kota_id=c.kota_id where a.kode_transaksi='$kode_transaksi'")->row_array();
				$data['record'] = $this->db->query("SELECT a.kode_transaksi, b.*, c.nama_produk, c.gambar, c.satuan, c.berat, c.produk_seo, d.nama_reseller FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN rb_produk c ON b.id_produk=c.id_produk JOIN rb_reseller d ON c.id_reseller=d.id_reseller where a.kode_transaksi='".$kode_transaksi."'");
				$data['total'] = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.service, a.proses, sum(a.ongkir) as ongkir, sum(b.harga_jual*b.jumlah) as total, sum(b.diskon*b.jumlah) as diskon_total, sum(c.berat*b.jumlah) as total_berat FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN rb_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='".$kode_transaksi."'")->row_array();
				$data['unik'] = $this->db->query("SELECT * FROM rb_penjualan_otomatis where kode_transaksi='".$kode_transaksi."'")->row_array();
			
				if (isset($_POST['submit1'])){
					notif_tracking_order($kode_transaksi);
				}
				$this->template->load(template().'/template',template().'/reseller/view_tracking_view_jasling',$data);
			}else{
				redirect('konfirmasi/tiket');
			}
		}else{
			$data['title'] = 'Tiket Order';
			$data['description'] = description();
			$data['keywords'] = keywords();
			$this->template->load(template().'/template',template().'/reseller/view_tracking',$data);
		}
	}
	

	public function bayar(){
		$cek_kodetrx = $this->db->query("SELECT * FROM rb_penjualan_otomatis where kode_transaksi='".cetak($this->input->get('inv',TRUE))."' AND pembayaran is NULL");
		if ($cek_kodetrx->num_rows()>=1){
			$record = $this->db->query("SELECT a.kode_transaksi, b.*, c.nama_produk, c.gambar, c.satuan, c.berat, c.produk_seo, d.nama_reseller FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN rb_produk c ON b.id_produk=c.id_produk JOIN rb_reseller d ON c.id_reseller=d.id_reseller where a.kode_transaksi='".cetak($this->input->get('inv',TRUE))."'");
			foreach ($record->result_array() as $row){
			    $kupon = $this->db->query("SELECT nilai FROM rb_penjualan_kupon where id_penjualan_detail='$row[id_penjualan_detail]'")->row_array();
				$catatan = explode('||',$row['keterangan_order']);
				$sub_total = ($row['harga_jual']-$row['diskon'])-$kupon['nilai'];
				if ($catatan[1]!=''){
					$noo = 1;
					$ex = explode(';',$catatan[1]);
					for ($ii=0; $ii < count($ex) ; $ii++) { 
						$exx = explode('|',$ex[$ii]);
						$variasi_terpilih[] = trim($exx[1]);
					}
					$variasi_tersimpan = implode(', ',$variasi_terpilih);
				}

				$produk[] = $row['nama_produk'];
				$jumlah[] = $row['jumlah'];
				$harga[] = $sub_total;
				$catatan_order[] = '';
			}

			$ong = $this->db->query("SELECT sum(ongkir) as total_ongkir, sum(fee_admin)/count(*) as fee_admin FROM `rb_penjualan` where kode_transaksi='".cetak($this->input->get('inv',TRUE))."'")->row_array();
			if ($ong['total_ongkir']>0){
				array_push($produk,"Total Ongkir #".$this->input->get('inv',TRUE));
				array_push($harga,$ong['total_ongkir']);
				array_push($jumlah,"1");
				array_push($catatan_order,"");
			}

			// Masukkan Fee Admin jika ada...
			if ($ong['fee_admin']>'0'){
				array_push($produk,"Fee Admin");
				array_push($harga,$ong['fee_admin']);
				array_push($jumlah,"1");
				array_push($catatan_order,"");
			}
			
			// Fee Transaksi Dibebankan ke Pembeli Jika menggunakan Pembayaran via Payment Gateway
			if (config('ipaymu_fee')>0){
				array_push($produk,"Fee Transaksi");
				array_push($harga,config('ipaymu_fee'));
				array_push($jumlah,"1");
				array_push($catatan_order,"");
			}

			/** Initialize Config */
			$conf['product'] = $produk;
			$conf['price'] = $harga;
			$conf['quantity'] = $jumlah;
			$conf['comments'] = $catatan_order;

			$conf['ureturn'] = site_url('konfirmasi/tracking/'.$this->input->get('inv',TRUE));
			$conf['unotify'] = site_url('konfirmasi/unotify');
        	$conf['ucancel'] = site_url('konfirmasi/ucancel');
			$conf['uniqid'] = uniqid();
			
			/** Load Lib and Init */
			$this->load->library('ipaymu', $conf);
			/** Call Response */
			$response = $this->ipaymu->response();

			/** Result Response */
			$resp = json_decode($response);
			$data = array('catatan'=>$resp->sessionID);
			$where = array('kode_transaksi' => $this->input->get('inv',TRUE));
			$this->model_app->update('rb_penjualan_otomatis', $data, $where);
			redirect($resp->url);
			//print_r($resp);
		}else{
			echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Maaf, Status Pembayaran untuk Orderan ini sudah Lunas!</center></div>');
			redirect('konfirmasi/tracking/'.$this->input->get('inv',TRUE));
		}
	}
	
	public function unotify(){
		if ($this->input->post('status')=='berhasil'){ $status_trx = '1'; $id = cetak($this->input->post('trx_id')); $proses = 2; }else{ $status_trx = ''; $id = cetak($this->input->post('sid')); $proses = 0; }
		$datax = array('pembayaran'=>$status_trx,'status_trx'=>cetak($this->input->post('status')),'catatan'=>cetak($this->input->post('trx_id')),'penampung'=>cetak($this->input->post('via')));
		$where = array('catatan' =>$id);
		$this->model_app->update('rb_penjualan_otomatis', $datax, $where);

		$idp = $this->db->query("SELECT kode_transaksi FROM rb_penjualan_otomatis where catatan='$id'")->row_array();
		$data_idp = array('proses'=>$proses);
   		$where_idp = array('kode_transaksi'=>$idp['kode_transaksi'],'status_pembeli'=>'konsumen');
   		$this->model_app->update('rb_penjualan', $data_idp, $where_idp);

		if ($this->input->post('status')=='berhasil'){
			$mut = $this->db->query("SELECT kode_transaksi FROM rb_penjualan_otomatis where catatan='".cetak($this->input->post('trx_id'))."'")->row_array();
			notif_pembayaran_sukses($mut['kode_transaksi']);
		}
	}


	public function deposit(){
		$row = $this->db->query("SELECT * FROM rb_withdraw where id_withdraw='".cetak($this->input->get('inv',TRUE))."'")->row_array();
		if ($row['status']!='Sukses'){
			$produk = "Kredit (Deposit Saldo Akun)";
			$harga = $row['nominal'];
			$jumlah = 1;
			$catatan_order = "";
			
			// Fee Transaksi Dibebankan ke Pembeli Jika menggunakan Pembayaran via Payment Gateway
			if (config('ipaymu_fee')>0){
				array_push($produk,"Fee Transaksi");
				array_push($harga,config('ipaymu_fee'));
				array_push($jumlah,"1");
				array_push($catatan_order,"");
			}

			/** Initialize Config */
			$conf['product'] = $produk;
			$conf['price'] = $harga;
			$conf['quantity'] = $jumlah;
			$conf['comments'] = $catatan_order;

			$conf['ureturn'] = site_url('members/withdraw?id='.$this->input->get('inv',TRUE));
			$conf['unotify'] = site_url('konfirmasi/unotify_deposit');
        	$conf['ucancel'] = site_url('konfirmasi/ucancel_deposit');
			$conf['uniqid'] = uniqid();
			
			/** Load Lib and Init */
			$this->load->library('ipaymu', $conf);
			/** Call Response */
			$response = $this->ipaymu->response();

			/** Result Response */
			$resp = json_decode($response);
			$data = array('keterangan'=>$resp->sessionID,'status'=>'Proses');
			$where = array('id_withdraw' => $this->input->get('inv',TRUE));
			$this->model_app->update('rb_withdraw', $data, $where);
			redirect($resp->url);
			//print_r($resp);
		}else{
			echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Maaf, Deposit ini sudah Dibayarkan!</center></div>');
			redirect('members/withdraw');
		}
	}

	public function unotify_deposit(){
		if ($this->input->post('status')=='berhasil'){ $status_trx = '1'; $id = cetak($this->input->post('trx_id')); $proses = 2; }else{ $status_trx = ''; $id = cetak($this->input->post('sid')); $proses = 0; }
		$idp = $this->db->query("SELECT id_withdraw FROM rb_withdraw where keterangan='$id'")->row_array();
		$data = array('status'=>$status_trx);
		$where = array('id_withdraw' => $idp['id_withdraw']);
		$this->model_app->update('rb_withdraw', $data, $where);
	}
}
