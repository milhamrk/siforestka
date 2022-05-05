<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Komplain extends CI_Controller {
	public function index(){
		$data['title'] = 'Resolution Center - Daftar Komplain ('.cetak($_GET['s']).')';
		if (cetak($_GET['s'])=='terlapor'){
			$data['komplain'] = $this->db->query("SELECT a.*, b.kode_transaksi, b.id_penjual, b.ongkir, c.nama_lengkap as nama FROM rb_pusat_bantuan a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan JOIN rb_konsumen c ON a.id_pelapor=c.id_konsumen where a.id_terlapor='".$this->session->id_konsumen."'");
		}else{
			$data['komplain'] = $this->db->query("SELECT a.*, b.kode_transaksi, b.id_penjual, b.ongkir, c.nama_reseller as nama FROM rb_pusat_bantuan a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan JOIN rb_reseller c ON a.id_terlapor=c.id_konsumen where a.id_pelapor='".$this->session->id_konsumen."'");
		}
		$this->template->load(template().'/template',template().'/komplain/view_list',$data);
	}

	function ulasan(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$cek_orderan = $this->db->query("SELECT a.*, b.id_konsumen FROM rb_penjualan a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.id_penjualan='".cetak($this->uri->segment(3))."' AND a.id_pembeli='".$this->session->id_konsumen."' AND a.status_pembeli='konsumen'");
			if ($cek_orderan->num_rows()>=1){
				$cek_exist = $this->db->query("SELECT id_pusat_bantuan  FROM rb_pusat_bantuan where id_penjualan='".cetak($this->uri->segment(3))."'");
				if ($cek_exist->num_rows()>=1){
					$rows = $cek_exist->row_array();
					$id_pusat_bantuan = $rows['id_pusat_bantuan'];
				}else{
					$row = $cek_orderan->row_array();
					$id_penjualan_detail = implode(';',$_POST['pilih']);
					$data = array('id_penjualan'=>cetak($this->uri->segment(3)),
						'id_penjualan_detail'=>$id_penjualan_detail,
						'id_pelapor'=>$this->session->id_konsumen,
						'id_terlapor'=>$row['id_konsumen'],
						'keterangan'=>cetak($this->input->post('komplain')),
						'status'=>'produk',
						'waktu_report'=>date('Y-m-d H:i:s'),
						'status'=>'proses');
					$this->model_app->insert('rb_pusat_bantuan',$data);
					$id_pusat_bantuan = $this->db->insert_id();

					$ter = $this->db->query("SELECT a.*, b.nama_reseller, b.no_telpon, c.email FROM rb_penjualan a JOIN rb_reseller b ON a.id_penjual=b.id_konsumen 
												JOIN rb_konsumen c ON b.id_konsumen=c.id_konsumen where a.id_penjualan='".cetak($this->uri->segment(3))."'")->row_array();
					$iden = $this->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
					$isi_pesan_pembeli = "*$iden[pengirim_email]* - Hallo *$ter[nama_reseller]*, orderan dari Lapak anda dengan No Invoice #$ter[kode_transaksi] Telah dilaporkan bermasalah, 
					
anda diundang untuk diskusi terkait masalah ini disini : ".base_url()."komplain/room/$id_pusat_bantuan";
					$this->model_app->wa(format_telpon($ter['no_telpon']),$isi_pesan_pembeli);

					$subject_notif      = "$iden[pengirim_email] - Komplain Order #$ter[kode_transaksi] untuk Lapak Anda";
					$message_notif = "<html><body><b>$iden[pengirim_email]</b> - Hallo <b>$ter[nama_reseller]</b>, orderan dari Lapak anda dengan No Invoice #$ter[kode_transaksi] Telah dilaporkan bermasalah,<br><br> 
					anda diundang untuk diskusi terkait masalah ini disini : ".base_url()."komplain/room/$id_pusat_bantuan</body></html>";
					echo kirim_email($subject_notif,$message_notif,$ter['email']);
				}
				redirect('komplain/room/'.$id_pusat_bantuan);
			}else{
				echo $this->session->set_flashdata('message', "<div class='alert alert-danger'><b>INFORMASI</b> - Maaf, Anda tidak memiliki akses,..</div>");
				redirect('members/orders_report');
			}
		}else{
			$data['detail'] = $this->db->query("SELECT * FROM rb_penjualan where id_penjualan='".cetak($this->input->post('id'))."'")->row_array();
			$data['rows'] = $this->model_reseller->penjualan_konsumen_detail(cetak($this->input->post('id')))->row_array();
			$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>cetak($this->input->post('id'))),'id_penjualan_detail','ASC');
			$data['pen'] = $this->db->query("SELECT a.id_penjual, a.ongkir, a.kurir, a.service, b.id_reseller, b.nama_reseller, b.alamat_lengkap, b.kecamatan_id, b.kota_id, b.user_reseller, c.nama_kota FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_penjualan='".cetak($this->input->post('id'))."'")->row_array();
			$data['total'] = $this->db->query("SELECT c.proses, sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk 
								JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where a.id_penjualan='".cetak($this->input->post('id'))."'")->row_array();
			$data['kupon'] = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
			JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
				where b.id_penjualan='".cetak($this->input->post('id'))."'")->row_array();
			$this->load->view(template().'/komplain/ulasan',$data);
		}
	}

	function resolusi(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$cek_orderan = $this->db->query("SELECT a.*, b.id_konsumen FROM rb_penjualan a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.id_penjualan='".cetak($this->uri->segment(3))."' AND a.id_pembeli='".$this->session->id_konsumen."' AND a.status_pembeli='konsumen'");
			if ($cek_orderan->num_rows()>=1){
				$cek_exist = $this->db->query("SELECT id_pusat_bantuan  FROM rb_pusat_bantuan where id_penjualan='".cetak($this->uri->segment(3))."'");
				if ($cek_exist->num_rows()>=1){
					$rows = $cek_exist->row_array();
					$id_pusat_bantuan = $rows['id_pusat_bantuan'];
				}else{
					$row = $cek_orderan->row_array();
					$id_penjualan_detail = implode(';',$_POST['pilih']);
					$data = array('id_penjualan'=>cetak($this->uri->segment(3)),
						'id_penjualan_detail'=>$id_penjualan_detail,
						'id_pelapor'=>$this->session->id_konsumen,
						'id_terlapor'=>$row['id_konsumen'],
						'keterangan'=>cetak($this->input->post('komplain')),
						'status'=>'produk',
						'waktu_report'=>date('Y-m-d H:i:s'),
						'status'=>'proses');
					$this->model_app->insert('rb_pusat_bantuan',$data);
					$id_pusat_bantuan = $this->db->insert_id();

					$ter = $this->db->query("SELECT a.*, b.nama_reseller, b.no_telpon, c.email FROM rb_penjualan a JOIN rb_reseller b ON a.id_penjual=b.id_konsumen 
												JOIN rb_konsumen c ON b.id_konsumen=c.id_konsumen where a.id_penjualan='".cetak($this->uri->segment(3))."'")->row_array();
					$iden = $this->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
					$isi_pesan_pembeli = "*$iden[pengirim_email]* - Hallo *$ter[nama_reseller]*, orderan dari Lapak anda dengan No Invoice #$ter[kode_transaksi] Telah dilaporkan bermasalah, 
					
anda diundang untuk diskusi terkait masalah ini disini : ".base_url()."komplain/room/$id_pusat_bantuan";
					$this->model_app->wa(format_telpon($ter['no_telpon']),$isi_pesan_pembeli);

					$subject_notif      = "$iden[pengirim_email] - Komplain Order #$ter[kode_transaksi] untuk Lapak Anda";
					$message_notif = "<html><body><b>$iden[pengirim_email]</b> - Hallo <b>$ter[nama_reseller]</b>, orderan dari Lapak anda dengan No Invoice #$ter[kode_transaksi] Telah dilaporkan bermasalah,<br><br> 
					anda diundang untuk diskusi terkait masalah ini disini : ".base_url()."komplain/room/$id_pusat_bantuan</body></html>";
					echo kirim_email($subject_notif,$message_notif,$ter['email']);
				}
				redirect('komplain/room/'.$id_pusat_bantuan);
			}else{
				echo $this->session->set_flashdata('message', "<div class='alert alert-danger'><b>INFORMASI</b> - Maaf, Anda tidak memiliki akses,..</div>");
				redirect('members/orders_report');
			}
		}else{
			$data['detail'] = $this->db->query("SELECT * FROM rb_penjualan where id_penjualan='".cetak($this->input->post('id'))."'")->row_array();
			$data['rows'] = $this->model_reseller->penjualan_konsumen_detail(cetak($this->input->post('id')))->row_array();
			$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>cetak($this->input->post('id'))),'id_penjualan_detail','ASC');
			$data['pen'] = $this->db->query("SELECT a.id_penjual, a.ongkir, a.kurir, a.service, b.id_reseller, b.nama_reseller, b.alamat_lengkap, b.kecamatan_id, b.kota_id, b.user_reseller, c.nama_kota FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_penjualan='".cetak($this->input->post('id'))."'")->row_array();
			$data['total'] = $this->db->query("SELECT c.proses, sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk 
								JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where a.id_penjualan='".cetak($this->input->post('id'))."'")->row_array();
			$data['kupon'] = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
			JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
				where b.id_penjualan='".cetak($this->input->post('id'))."'")->row_array();
			$this->load->view(template().'/komplain/view',$data);
		}
	}

	function room(){
		cek_session_members();
		if (isset($_GET['status'])){
			$data_komplain = array('putusan'=>cetak($this->input->get('status')));
			$where_komplain = array('id_pusat_bantuan'=>cetak($this->uri->segment('3')),'id_pelapor'=>$this->session->id_konsumen);
            $this->model_app->update('rb_pusat_bantuan', $data_komplain, $where_komplain);
			redirect('komplain/room/'.cetak($this->uri->segment('3')));
		}

		$akses = $this->db->query("SELECT id_pusat_bantuan FROM rb_pusat_bantuan where id_pusat_bantuan='".cetak($this->uri->segment(3))."' AND (id_pelapor='".$this->session->id_konsumen."' OR id_terlapor='".$this->session->id_konsumen."')");
		if ($akses->num_rows()>=1){
			$query = $this->db->query("SELECT timediff(now(),waktu_kunjung) as terakhir FROM rb_pusat_bantuan_kunjungan where id_konsumen='".$this->session->id_konsumen."' AND id_pusat_bantuan='".cetak($this->uri->segment(3))."' ORDER BY id_kunjungan DESC LIMIT 1");
			if ($query->num_rows()==1){
				$hl = $query->row_array();
				$exhl = explode(':',$hl['terakhir']);
				if ($exhl[1]>=10){
					$datadbl = array('id_pusat_bantuan'=>cetak($this->uri->segment(3)),
										'id_konsumen'=>$this->session->id_konsumen,
										'ip_address'=>$_SERVER['REMOTE_ADDR'],
										'os_browser'=>$this->agent->browser().' '.$this->agent->version().', '.$this->agent->platform(),
										'waktu_kunjung' =>date("Y-m-d H:i:s"));	
					$this->model_app->insert('rb_pusat_bantuan_kunjungan',$datadbl);
				}
			}else{
				$datadbl = array('id_pusat_bantuan'=>cetak($this->uri->segment(3)),
									'id_konsumen'=>$this->session->id_konsumen,
									'ip_address'=>$_SERVER['REMOTE_ADDR'],
									'os_browser'=>$this->agent->browser().' '.$this->agent->version().', '.$this->agent->platform(),
									'waktu_kunjung' =>date("Y-m-d H:i:s"));	
				$this->model_app->insert('rb_pusat_bantuan_kunjungan',$datadbl);
			}
			$data['title'] = 'Resolution Center';
			$idp = $this->db->query("SELECT id_penjualan FROM rb_pusat_bantuan where id_pusat_bantuan='".cetak($this->uri->segment(3))."'")->row_array();
			$id_penjualan = $idp['id_penjualan'];

			$data['detail'] = $this->db->query("SELECT b.*, c.nama_lengkap as pelapor, d.nama_lengkap as terlapor FROM rb_penjualan a JOIN rb_pusat_bantuan b ON a.id_penjualan=b.id_penjualan 
													JOIN rb_konsumen c ON b.id_pelapor=c.id_konsumen JOIN rb_konsumen d ON b.id_terlapor=d.id_konsumen
														where a.id_penjualan='".cetak($id_penjualan)."'")->row_array();
			$data['rows'] = $this->model_reseller->penjualan_konsumen_detail(cetak($id_penjualan))->row_array();
			$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>cetak($id_penjualan)),'id_penjualan_detail','ASC');
			$data['pen'] = $this->db->query("SELECT a.id_penjual, a.ongkir, a.kurir, a.service, b.id_reseller, b.nama_reseller, b.alamat_lengkap, b.kecamatan_id, b.kota_id, b.user_reseller, c.nama_kota FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_penjualan='".cetak($id_penjualan)."'")->row_array();
			$data['total'] = $this->db->query("SELECT c.proses, sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk 
								JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where a.id_penjualan='".cetak($id_penjualan)."'")->row_array();
			$data['kupon'] = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
			JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
				where b.id_penjualan='".cetak($id_penjualan)."'")->row_array();
			$data['record'] = $this->model_app->view_where('rb_konsumen_detail',array('id_konsumen'=>$this->session->id_konsumen,'status'=>'rekening'));
			$this->template->load(template().'/template',template().'/komplain/view_diskusi',$data);
		}else{
			redirect('members/profile');
		}
	}

	public function deleteFile_diskusi(){
		cek_session_members();
		$name = cetak($this->input->post('name'));
		$filePath = 'asset/files/'.$name;
		if($name){
			if (file_exists($filePath)) 
			{
		        unlink($filePath); // delete file from dir
		    }
			$this->db->delete('img_comment', array('file_name' => $name));
		}

		echo "Deleted File ".$name."<br>";
	}

	public function upload_diskusi(){
		cek_session_members();
		$this->load->model('imgComment');
		$data = array();
		if ($this->session->sesi_messages_diskusi==''){
			$id = $this->session->id_members.'-messages_diskusi-'.date('Ymdhis');
			$this->session->set_userdata(array('sesi_messages_diskusi'=>$id));
		}else{
			$id = $this->session->sesi_messages_diskusi;
		}
        if(isset($_FILES['uploadFile'])){
        	// File upload configuration
            $uploadPath = 'asset/files/';
            $config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|txt|pdf|gif|zip|rar|tar';
			$config['max_size']	= '5000'; // kb

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);	

	 	 	$fileName = $_FILES["uploadFile"]["name"];

            // Upload file to server
            if($this->upload->do_upload('uploadFile')){
                $fileData = $this->upload->data();
                $uploadData['file_name'] = $fileData['file_name'];
                $uploadData['uploaded_on'] = date("Y-m-d H:i:s");
                $uploadData['id_comment'] = $id;
            }

	    	if(!empty($uploadData)){
                $insert = $this->imgComment->insert($uploadData);
                $data[] = $uploadData['file_name'];
                echo json_encode($data);
            }
        }else{
        	echo json_encode('param is empty.');
        }
	}

	function read_query(){
		cek_session_members();
		$id = cetak($this->uri->segment(3));
		$jumlah= $this->db->query("SELECT * FROM rb_pusat_bantuan_diskusi where id_pusat_bantuan='$id'")->num_rows();
		$config['base_url'] = base_url().'komplain/room/'.$id.'/';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 10; 	
		if ($this->uri->segment('4') == ''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('4');
		}
		if (is_numeric($dari)) {
			$data = $this->db->query("SELECT a.*, b.nama_lengkap, b.foto as thumb_foto, c.nama_reseller,  c.foto as foto_reseller 
					FROM rb_pusat_bantuan_diskusi a LEFT JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen
						LEFT JOIN rb_reseller c ON a.id_konsumen=c.id_konsumen
							where a.id_pusat_bantuan='$id' ORDER BY a.id_diskusi DESC LIMIT $dari, $config[per_page]")->result();
			$this->pagination->initialize($config);
		}else{
			redirect('home/error');
		}
		echo json_encode($data);
	}

	public function sendComment(){
		// $row = $this->db->query("SELECT a.*, b.nama_lengkap as nama_pelapor, b.no_hp as whatsapp_pelapor, 
		// 									 c.nama_lengkap as nama_terlapor, c.no_hp as whatsapp_terlapor 
		// 										FROM rb_pusat_bantuan a 
		// 										JOIN rb_konsumen b ON a.id_pelapor=b.id_konsumen  
		// 										JOIN rb_konsumen c ON a.id_terlapor=c.id_konsumen
		// 										where a.id_pusat_bantuan='".cetak($this->input->post('id'))."'")->row_array();	

		$cek_level = $this->db->query("SELECT * FROM rb_pusat_bantuan where id_pusat_bantuan='".cetak($this->input->post('id'))."' AND id_pelapor='".$this->session->id_konsumen."'");
		if ($cek_level->num_rows()>=1){ $level = 'pembeli'; }else{ $level = 'penjual'; }
		$uploadData['id_pusat_bantuan'] = cetak($this->input->post('id'));
		$uploadData['id_konsumen'] = $this->session->id_konsumen;
		$uploadData['isi_pesan'] = cetak($this->input->post('comment'));
		$uploadData['level'] = $level;
		$uploadData['waktu_kirim'] = date('Y-m-d H:i:s');
		$uploadData['stat'] = '1';

		$rows = $this->db->query("SELECT GROUP_CONCAT(file_name SEPARATOR ';') as files FROM `img_comment` where id_comment='".$this->session->sesi_messages_diskusi."'")->row_array();
		$uploadData['lampiran'] = $rows['files'];
		if ($this->input->post('comment')!='' OR $rows['files']!=''){
			$data = $this->model_app->pusat_bantuan_diskusi($uploadData);
			$this->session->unset_userdata('sesi_messages_diskusi');
			echo json_encode($data);
		}
	}

	function download(){
		$name = $this->uri->segment(3);
		$data = file_get_contents("asset/files/".$name);
		force_download($name, $data);
	}
}
