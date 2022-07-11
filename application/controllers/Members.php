<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Members extends CI_Controller {
	function foto(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$this->model_reseller->modupdatefoto();
			redirect('members/profile');
		}else{
			redirect('members/profile');
		}
	}

	function profile(){
		cek_session_members();
		$data['title'] = 'Profile Anda';
		$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
		$this->template->load(template().'/template',template().'/reseller/view_profile',$data);
	}

	function sopir(){
		cek_session_members();
		$this->session->unset_userdata('sesi_syarat');
		$data['title'] = 'Data Sopir';
		$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
		$this->template->load(template().'/template',template().'/reseller/view_sopir',$data);
	}

	function daftar_sopir(){
		cek_session_members();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			if ($this->session->sesi_syarat!=''){
				$rows = $this->db->query("SELECT GROUP_CONCAT(file_name SEPARATOR ';') as files FROM `img_comment` where id_comment='".$this->session->sesi_syarat."'")->row_array();
				$fileName = $rows['files'];
			}else{
				$fileName = '';
			}
			$data = array('id_konsumen'=>$this->session->id_konsumen,
							'id_jenis_kendaraan'=>cetak($this->input->post('jenis')),
							'plat_nomor'=>cetak($this->input->post('plat_nomor')),
							'merek'=>cetak($this->input->post('merek')),
							'lainnya'=>cetak($this->input->post('lainnya')),
							'lampiran'=>$fileName);
			$cek_sopir = $this->model_app->view_where('rb_sopir',array('id_konsumen'=>$this->session->id_konsumen));
			if ($cek_sopir->num_rows()>=1){
				$where = array('id_konsumen' => $this->session->id_konsumen);
				$this->model_app->update('rb_sopir', $data, $where);
			}else{
				$this->model_app->insert('rb_sopir',$data);
			}
			redirect('members/sopir');
		}else{
			$data['title'] = 'Lengkapi Data Kendaraan';
			$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
			$row = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
			$data['provinsi'] = $this->model_app->view_ordering('rb_provinsi','provinsi_id','ASC');
			$data['rowse'] = $this->db->query("SELECT provinsi_id FROM rb_kota where kota_id='$row[kota_id]'")->row_array();
			$data['rows'] = $this->db->query("SELECT a.*, b.nama_lengkap, b.no_hp, b.kecamatan_id, b.kota_id, c.jenis_kendaraan FROM rb_sopir a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen 
                                                          JOIN rb_jenis_kendaraan c ON a.id_jenis_kendaraan=c.id_jenis_kendaraan where a.id_konsumen='".$this->session->id_konsumen."'")->row_array();
			$this->template->load(template().'/template',template().'/reseller/view_sopir_edit',$data);
		}
	}

	function download_file(){
        $name = $this->uri->segment(4);
        $data = file_get_contents("asset/".$this->uri->segment(3)."/".$name);
        force_download($name, $data);
    }

	function wishlist(){
		cek_session_members();
		$data['title'] = 'Wishlist - Produk Tersimpan';
		$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
		$this->template->load(template().'/template',template().'/reseller/view_produk_wishlist',$data);
	}

	function wishlist_update(){
		cek_session_members();
		$data['record'] = $this->db->query("SELECT a.*, b.nama_reseller, c.nama_kota, z.id_konsumen_simpan FROM rb_konsumen_simpan z JOIN rb_produk a ON z.id_produk=a.id_produk LEFT JOIN rb_reseller b ON a.id_reseller=b.id_reseller
										LEFT JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_reseller!='0' AND a.id_produk_perusahaan='0' AND a.aktif='Y' AND z.id_konsumen='".$this->session->id_konsumen."' ORDER BY a.id_produk DESC");
		$this->load->view(template().'/reseller/view_produk_wishlist_update',$data);
	}

	function delete_wishlist(){
		cek_session_members();
        $id = array('id_konsumen_simpan' => cetak($this->uri->segment(3)), 'id_konsumen'=>$this->session->id_konsumen);
		$this->model_app->delete('rb_konsumen_simpan',$id);
		redirect($this->uri->segment(1).'/wishlist');
	}

	function edit_profile(){
		cek_session_members();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$cek_username = $this->db->query("SELECT * FROM rb_konsumen where id_konsumen!='".$this->session->id_konsumen."' AND (username='".cetak($this->input->post('aa'))."' OR email='".cetak($this->input->post('c'))."' OR no_hp='".cetak($this->input->post('l'))."')");
			if ($cek_username->num_rows()<='0'){
				$this->model_reseller->profile_update($this->session->id_konsumen);
				echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Sukses Update Data Profile,..</center></div>');
			}else{
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Gagal Update Profile, Username/E-mail/No HP telah digunakan...</center></div>');
			}
			redirect('members/profile');
		}else{
			$data['title'] = 'Lengkapi Data Profile';
			$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
			$row = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
			$data['provinsi'] = $this->model_app->view_ordering('rb_provinsi','provinsi_id','ASC');
			$data['rowse'] = $this->db->query("SELECT provinsi_id FROM rb_kota where kota_id='$row[kota_id]'")->row_array();
			$this->template->load(template().'/template',template().'/reseller/view_profile_edit',$data);
		}
	}

	function tambah_opini(){
		cek_session_members();
		$row = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_berita/';
	        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
	        $config['max_size'] = '3000'; // kb
	        $this->load->library('upload', $config);
	        $this->upload->do_upload('k');
	        $hasil=$this->upload->data();
            
            $config['source_image'] = 'asset/foto_berita/'.$hasil['file_name'];
            $config['wm_text'] = '';
            $config['wm_type'] = 'text';
            $config['wm_font_path'] = './system/fonts/texb.ttf';
            $config['wm_font_size'] = '26';
            $config['wm_font_color'] = 'ffffff';
            $config['wm_vrt_alignment'] = 'middle';
            $config['wm_hor_alignment'] = 'center';
            $config['wm_padding'] = '20';
            $this->load->library('image_lib',$config);
            $this->image_lib->watermark();

            $status = 'N';
            if ($this->input->post('j')!=''){
                $tag_seo = $this->input->post('j');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
            }
            if ($hasil['file_name']==''){
                    $data = array('id_kategori'=>$this->db->escape_str($this->input->post('a')),
                                    'username'=>$row['username'],
                                    'judul'=>$this->db->escape_str($this->input->post('b')),
                                    'sub_judul'=>$this->db->escape_str($this->input->post('c')),
                                    'youtube'=>$this->db->escape_str($this->input->post('d')),
                                    'judul_seo'=>seo_title($this->input->post('b')),
                                    'headline'=>$this->db->escape_str($this->input->post('e')),
                                    'aktif'=>$this->db->escape_str($this->input->post('f')),
                                    'utama'=>$this->db->escape_str($this->input->post('g')),
                                    'isi_berita'=>$this->input->post('h'),
                                    'keterangan_gambar'=>$this->input->post('i'),
                                    'hari'=>hari_ini(date('w')),
                                    'tanggal'=>date('Y-m-d'),
                                    'jam'=>date('H:i:s'),
                                    'dibaca'=>'0',
                                    'tag'=>$tag,
                                    'status'=>$status);
            }else{
                    $data = array('id_kategori'=>$this->db->escape_str($this->input->post('a')),
									'username'=>$row['username'],
                                    'judul'=>$this->db->escape_str($this->input->post('b')),
                                    'sub_judul'=>$this->db->escape_str($this->input->post('c')),
                                    'youtube'=>$this->db->escape_str($this->input->post('d')),
                                    'judul_seo'=>seo_title($this->input->post('b')),
                                    'headline'=>$this->db->escape_str($this->input->post('e')),
                                    'aktif'=>$this->db->escape_str($this->input->post('f')),
                                    'utama'=>$this->db->escape_str($this->input->post('g')),
                                    'isi_berita'=>$this->input->post('h'),
                                    'keterangan_gambar'=>$this->input->post('i'),
                                    'hari'=>hari_ini(date('w')),
                                    'tanggal'=>date('Y-m-d'),
                                    'jam'=>date('H:i:s'),
                                    'gambar'=>$hasil['file_name'],
                                    'dibaca'=>'0',
                                    'tag'=>$tag,
                                    'status'=>$status);
            }
            $this->model_app->insert('berita',$data);
			redirect($this->uri->segment(1).'/opini_publik');
		}else{
			$data['title'] = 'Tambah Opini Publik';
			$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
			$row = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
			$data['provinsi'] = $this->model_app->view_ordering('rb_provinsi','provinsi_id','ASC');
			$data['rowse'] = $this->db->query("SELECT provinsi_id FROM rb_kota where kota_id='$row[kota_id]'")->row_array();
			// $data['record'] = $this->model_app->view_ordering('kategori','id_kategori','DESC');
			$this->template->load(template().'/template',template().'/reseller/view_add_opini',$data);
		}
	}

	function sosial_media(){
		cek_session_members();
		$data['title'] = 'Sosial Media';
		$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
		$data['rows'] = $this->model_app->view_where('rb_konsumen_detail',array('id_konsumen'=>$this->session->id_konsumen,'status'=>'sosmed'))->row_array();
		$this->template->load(template().'/template',template().'/reseller/view_sosmed',$data);
	}

	function edit_sosial_media(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$keterangan = cetak($this->input->post('a')).';'.cetak($this->input->post('b')).';'.cetak($this->input->post('c')).';'.cetak($this->input->post('d')).';'.cetak($this->input->post('e')).';'.cetak($this->input->post('f')).';'.cetak($this->input->post('g')).';'.cetak($this->input->post('h'));
			$data = array('id_konsumen'=>$this->session->id_konsumen,
							'keterangan'=>$keterangan,
							'status'=>'sosmed',
							'waktu_input'=>date('Y-m-d H:i:s'));
			$cek_sosmed = $this->model_app->view_where('rb_konsumen_detail',array('id_konsumen'=>$this->session->id_konsumen,'status'=>'sosmed'));
			if ($cek_sosmed->num_rows()>=1){
				$where = array('id_konsumen' => $this->session->id_konsumen,'status'=>'sosmed');
				$this->model_app->update('rb_konsumen_detail', $data, $where);
			}else{
				$this->model_app->insert('rb_konsumen_detail',$data);
			}
			redirect('members/sosial_media');
		}else{
			$data['title'] = 'Sosial Media';
			$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
			$data['rows'] = $this->model_app->view_where('rb_konsumen_detail',array('id_konsumen'=>$this->session->id_konsumen,'status'=>'sosmed'))->row_array();
			$this->template->load(template().'/template',template().'/reseller/view_sosmed_edit',$data);
		}
	}

	function rekening_bank(){
		cek_session_members();
		$data['title'] = 'Rekening Bank';
		$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
		$data['record'] = $this->model_app->view_where('rb_konsumen_detail',array('id_konsumen'=>$this->session->id_konsumen,'status'=>'rekening'));
		$this->template->load(template().'/template',template().'/reseller/view_rekening',$data);
	}

	function tambah_rekening_bank(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$keterangan = cetak($this->input->post('a')).';'.cetak($this->input->post('b')).';'.cetak($this->input->post('c'));
			$data = array('id_konsumen'=>$this->session->id_konsumen,
							'keterangan'=>$keterangan,
							'status'=>'rekening',
							'waktu_input'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_konsumen_detail',$data);
			redirect('members/rekening_bank');
		}else{
			$data['title'] = 'Rekening Bank';
			$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
			$this->template->load(template().'/template',template().'/reseller/view_rekening_tambah',$data);
		}
	}

	function edit_rekening_bank(){
		cek_session_members();
		if (isset($_POST['submit'])){
			$keterangan = cetak($this->input->post('a')).';'.cetak($this->input->post('b')).';'.cetak($this->input->post('c'));
			$data = array('id_konsumen'=>$this->session->id_konsumen,
							'keterangan'=>$keterangan,
							'status'=>'rekening');
			$where = array('id_konsumen'=>$this->session->id_konsumen,'status'=>'rekening','id_konsumen_detail'=>cetak($this->input->post('id')));
			$this->model_app->update('rb_konsumen_detail', $data, $where);
			redirect('members/rekening_bank');
		}else{
			$data['title'] = 'Rekening Bank';
			$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
			$data['rows'] = $this->model_app->view_where('rb_konsumen_detail',array('id_konsumen'=>$this->session->id_konsumen,'status'=>'rekening','id_konsumen_detail'=>cetak($this->uri->segment('3'))))->row_array();
			$this->template->load(template().'/template',template().'/reseller/view_rekening_edit',$data);
		}
	}

	function delete_rekening_bank(){
        cek_session_members();
		$id = array('id_konsumen'=>$this->session->id_konsumen,'status'=>'rekening','id_konsumen_detail'=>cetak($this->uri->segment('3')));
        $this->model_app->delete('rb_konsumen_detail',$id);
		redirect($this->uri->segment(1).'/rekening_bank');
	}

	function reseller(){
		cek_session_members();
		$jumlah= $this->model_app->view('rb_reseller')->num_rows();
		$config['base_url'] = base_url().'members/reseller';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 12; 	
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}

		if (is_numeric($dari)) {
			$data['title'] = 'Semua Daftar Penjual';
			$this->pagination->initialize($config);
			if (isset($_POST['submit'])){
				$data['record'] = $this->model_reseller->cari_reseller(filter($this->input->post('cari_reseller')));
			}elseif (isset($_GET['cari_reseller'])){
				$data['record'] = $this->model_reseller->cari_reseller(filter($this->input->get('cari_reseller')));
				$total = $this->model_reseller->cari_reseller(filter($this->input->get('cari_reseller')));
				if ($total->num_rows()==1){
					$row = $total->row_array();
					redirect('produk/keranjang/'.$row['id_reseller'].'/'.$this->session->produk);
				}
			}else{
				$data['record'] = $this->db->query("SELECT * FROM rb_reseller a LEFT JOIN rb_kota b ON a.kota_id=b.kota_id ORDER BY id_reseller DESC LIMIT $dari,$config[per_page]");
			}
			$this->template->load(template().'/template',template().'/reseller/view_reseller',$data);
		}else{
			redirect('main');
		}
	}

	function detail_reseller(){
		cek_session_members();
		$data['title'] = 'Detail Profile Penjual';
		$id = cetak($this->uri->segment(3));
		$data['rows'] = $this->model_app->edit('rb_reseller',array('id_reseller'=>$id))->row_array();
		$data['record'] = $this->model_reseller->penjualan_list_konsumen($id,'reseller');
		$data['rekening'] = $this->model_app->view_where('rb_rekening_reseller',array('id_reseller'=>$id));
		$this->template->load(template().'/template',template().'/reseller/view_reseller_detail',$data);

	}

	function orders_report(){
		cek_session_members();
		if (isset($_GET['sukses'])){
			$data = array('proses'=>'4');
			$where = array('id_penjualan'=>cetak($this->input->get('sukses')),'id_pembeli'=>$this->session->id_konsumen,'status_pembeli'=>'konsumen');
			$this->model_app->update('rb_penjualan', $data, $where);
			notif_pesanan_selesai(cetak($this->input->get('sukses')),$this->session->id_konsumen);
			// Cek Referral, jika ada maka masukkan fee ke referral

			$ref = $this->db->query("SELECT a.kode_transaksi, a.id_penjual, b.nama_reseller, b.referral FROM rb_penjualan a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.id_penjualan='".cetak($this->input->get('sukses'))."' AND a.status_penjual='reseller'")->row_array();
			if ($ref['referral']!='' AND $ref['referral']!='0'){
				$row = $this->db->query("SELECT sum(b.harga_beli*a.jumlah) as modal, sum((a.harga_jual-a.diskon)*a.jumlah) as total, (sum((a.harga_jual-a.diskon)*a.jumlah)-sum(b.harga_beli*a.jumlah)) as untung FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".cetak($this->input->get('sukses'))."'")->row_array();
				if ($row['untung']>0){
					$cekfee = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
					$fee_rupiah = $cekfee['referral']/100*$row['untung'];
					$data = array('id_rekening_reseller'=>0,
							'id_reseller'=>$ref['referral'],
							'nominal'=>$fee_rupiah,
							'status'=>'Sukses',
							'transaksi'=>'Kredit',
							'keterangan'=>"$ref[kode_transaksi] - Fee $cekfee[referral]%",
							'akun'=>'konsumen',
							'waktu_withdraw'=>date('Y-m-d H:i:s'));
					$this->model_app->insert('rb_withdraw',$data);
					
					$data_fee = array('id_rekening_reseller'=>0,
							'id_reseller'=>$ref['id_penjual'],
							'nominal'=>$fee_rupiah,
							'status'=>'Sukses',
							'transaksi'=>'Debit',
							'keterangan'=>"$ref[kode_transaksi] - Fee $cekfee[referral]%",
							'akun'=>'konsumen',
							'waktu_withdraw'=>date('Y-m-d H:i:s'));
					$this->model_app->insert('rb_withdraw',$data_fee);
				}
			}

			echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Terima kasih karena telah mengkonfirmasi Penerimaan pesanan anda,.. ^_^</center></div>');
			redirect('members/orders_report');
		}
		$jumlah= $this->db->query("SELECT * FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.status_penjual='reseller' AND a.id_pembeli='".$this->session->id_konsumen."' ORDER BY a.id_penjualan DESC")->num_rows();
		$config['base_url'] = base_url().'members/orders_report';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 50; 	
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}
		$data['title'] = 'Laporan Pesanan Anda';
		$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
		$data['pending'] = $this->db->query("SELECT * FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.status_penjual='reseller' AND a.id_pembeli='".$this->session->id_konsumen."' AND (a.proses='0' OR a.proses='2') ORDER BY a.id_penjualan DESC LIMIT $dari,$config[per_page]");
		$data['proses'] = $this->db->query("SELECT * FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.status_penjual='reseller' AND a.id_pembeli='".$this->session->id_konsumen."' AND a.proses='1' ORDER BY a.id_penjualan DESC LIMIT $dari,$config[per_page]");
		$data['dikirim'] = $this->db->query("SELECT * FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.status_penjual='reseller' AND a.id_pembeli='".$this->session->id_konsumen."' AND a.proses='3' ORDER BY a.id_penjualan DESC LIMIT $dari,$config[per_page]");
		$data['selesai'] = $this->db->query("SELECT * FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.status_penjual='reseller' AND a.id_pembeli='".$this->session->id_konsumen."' AND a.proses='4' ORDER BY a.id_penjualan DESC LIMIT $dari,$config[per_page]");
		$this->pagination->initialize($config);
		$this->template->load(template().'/template',template().'/reseller/view_orders_report',$data);
	}

	function sopir_list(){
		cek_session_members();
		$sopir = $this->db->query("SELECT id_sopir FROM rb_sopir where id_konsumen='".$this->session->id_konsumen."'")->row_array();
		$jumlah= $this->db->query("SELECT * FROM rb_penjualan a WHERE a.kurir='$sopir[id_sopir]' AND a.kode_kurir='1'")->num_rows();
		$config['base_url'] = base_url().'members/sopir_list';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 10; 	
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}
		$data['title'] = 'Order Pengantaran Barang';
		$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
		$data['pending'] = $this->db->query("SELECT a.*, b.alamat_lengkap, b.no_telpon, c.no_hp, c.nama_lengkap, b.nama_reseller, b.kecamatan_id as kecamatan_id_jual, b.kota_id as kota_id_jual, c.kecamatan_id as kecamatan_id_beli, c.kota_id as kota_id_beli FROM rb_penjualan a 
												JOIN rb_reseller b ON a.id_penjual=b.id_reseller
													JOIN rb_konsumen c ON a.id_pembeli=c.id_konsumen
														WHERE a.kurir='$sopir[id_sopir]' AND a.kode_kurir='1' ORDER BY a.waktu_transaksi DESC LIMIT $dari,$config[per_page]");
		$this->pagination->initialize($config);
		$this->template->load(template().'/template',template().'/reseller/view_sopir_report',$data);
	}

	function trx_pulsa(){
		cek_session_members();
		$jumlah= $this->db->query("SELECT * FROM `rb_pembelian_pulsa` where id_reseller='".reseller($this->session->id_konsumen)."' ORDER BY waktu_pembelian DESC")->num_rows();
		$config['base_url'] = base_url().'members/trx_pulsa';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 20; 	
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}
		$data['title'] = 'Laporan Pembelian Pulsa';
		$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
		$data['pulsa'] = $this->db->query("SELECT * FROM `rb_pembelian_pulsa` where id_reseller='".$this->session->id_konsumen."' ORDER BY waktu_pembelian DESC LIMIT $dari,$config[per_page]");
		$this->pagination->initialize($config);
		$this->template->load(template().'/template',template().'/reseller/view_orders_pulsa',$data);
	}

	

	function produk_reseller(){
		cek_session_members();
		$jumlah= $this->model_app->view('rb_produk')->num_rows();
		$config['base_url'] = base_url().'members/produk_reseller/'.$this->uri->segment('3');
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 12; 	
		if ($this->uri->segment('4')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('4');
		}

		if (is_numeric($dari)) {
			$data['title'] = 'Data Produk Penjual';
			$id = cetak($this->uri->segment(3));
			$data['rows'] = $this->db->query("SELECT * FROM rb_reseller a JOIN rb_kota b ON a.kota_id=b.kota_id where a.id_reseller='$id'")->row_array();
			$data['record'] = $this->model_app->view_where_ordering_limit('rb_produk',array('id_reseller!='=>'0'),'id_produk','DESC',$dari,$config['per_page']);
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/reseller/view_reseller_produk',$data);
		}else{
			redirect('main');
		}
	}

	function keranjang(){
		cek_session_members();
		$id_reseller = cetak($this->uri->segment(3));
		$id_produk   = cetak($this->uri->segment(4));

		$j = $this->model_reseller->jual_reseller($id_reseller,$id_produk)->row_array();
        $b = $this->model_reseller->beli_reseller($id_reseller,$id_produk)->row_array();
        $stok = $b['beli']-$j['jual'];

		if ($id_produk!=''){
			if ($stok <= '0'){
				$produk = $this->model_app->edit('rb_produk',array('id_produk'=>$id_produk))->row_array();
				$produk_cek = filter($produk['nama_produk']);
				echo "<script>window.alert('Maaf, Stok untuk Produk $produk_cek pada Penjual ini telah habis!');
                                  window.location=('".base_url()."members/reseller')</script>";
			}else{
				$this->session->unset_userdata('produk');
				if ($this->session->idp == ''){
					$kode_transaksi = 'TRX-'.date('YmdHis');
					$data = array('kode_transaksi'=>$kode_transaksi,
				        		  'id_pembeli'=>$this->session->id_konsumen,
				        		  'id_penjual'=>$id_reseller,
				        		  'status_pembeli'=>'konsumen',
				        		  'status_penjual'=>'reseller',
				        		  'waktu_transaksi'=>date('Y-m-d H:i:s'),
				        		  'proses'=>'0');
					$this->model_app->insert('rb_penjualan',$data);
					$idp = $this->db->insert_id();
					$this->session->set_userdata(array('idp'=>$idp));
				}

				$qty = cetak($this->input->post('qty'));
				$reseller = $this->model_app->view_where('rb_penjualan',array('id_penjualan'=>$this->session->idp))->row_array();
				$cek = $this->model_app->view_where('rb_penjualan_detail',array('id_penjualan'=>$this->session->idp,'id_produk'=>$id_produk))->num_rows();
				if ($reseller['id_penjual']==$id_reseller){
					if ($cek >=1){
						$this->db->query("UPDATE rb_penjualan_detail SET jumlah=jumlah+$qty where id_penjualan='".$this->session->idp."' AND id_produk='$id_produk'");
					}else{
						$harga = $this->model_app->view_where('rb_produk',array('id_produk'=>$id_produk))->row_array();
						$disk = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$id_produk,'id_reseller'=>$id_reseller))->row_array();
	                    $harga_konsumen = $harga['harga_konsumen']-$disk['diskon'];
						$data = array('id_penjualan'=>$this->session->idp,
					        		  'id_produk'=>$id_produk,
					        		  'jumlah'=>$qty,
					        		  'harga_jual'=>$harga_konsumen,
					        		  'satuan'=>$harga['satuan']);
						$this->model_app->insert('rb_penjualan_detail',$data);
					}
					redirect('members/keranjang');
				}else{
					if ($this->session->idp != ''){
						$data['rows'] = $this->model_reseller->penjualan_konsumen_detail($this->session->idp)->row_array();
						$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->session->idp),'id_penjualan_detail','ASC');
					}
					$data['title'] = 'Keranjang Belanja';
					$data['error_reseller'] = "<div class='alert alert-danger'>Maaf, Dalam 1 Transaksi hanya boleh order dari 1 Penjual saja.</div>";
					$this->template->load(template().'/template',template().'/reseller/members/view_keranjang',$data);
				}
			}
		}else{
			if ($this->session->idp != ''){
				$data['rows'] = $this->model_reseller->penjualan_konsumen_detail($this->session->idp)->row_array();
				$data['rowsk'] = $this->model_reseller->view_join_where_one('rb_konsumen','rb_kota','kota_id',array('id_konsumen'=>$this->session->id_konsumen))->row_array();
				$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->session->idp),'id_penjualan_detail','ASC');
			}
				$data['title'] = 'Keranjang Belanja';
				$this->template->load(template().'/template',template().'/reseller/members/view_keranjang',$data);

		}
	}

	function keranjang_detail(){
		$data['rows'] = $this->model_reseller->penjualan_konsumen_detail(cetak($this->uri->segment(3)))->row_array();
		$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>cetak($this->uri->segment(3))),'id_penjualan_detail','ASC');
		$data['title'] = 'Detail Belanja';
		$this->template->load(template().'/template',template().'/reseller/members/view_keranjang_detail',$data);
	}
	
	function keranjang_detail_jasling(){
		$data['rows'] = $this->model_reseller->penjualan_konsumen_detail(cetak($this->uri->segment(3)))->row_array();
		$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>cetak($this->uri->segment(3))),'id_penjualan_detail','ASC');
		$data['title'] = 'TIKET';
		
		$this->template->load(template().'/template',template().'/reseller/members/view_keranjang_detail_jasling',$data);
	}

	function keranjang_delete(){
		$id = array('id_penjualan_detail' => cetak($this->uri->segment(3)));
		$this->model_app->delete('rb_penjualan_detail',$id);
		$isi_keranjang = $this->db->query("SELECT sum(jumlah) as jumlah FROM rb_penjualan_detail where id_penjualan='".$this->session->idp."'")->row_array();
		if ($isi_keranjang['jumlah']==''){
			$idp = array('id_penjualan' => $this->session->idp);
			$this->model_app->delete('rb_penjualan',$idp);
			$this->session->unset_userdata('idp');
		}
		redirect('members/keranjang');
	}

	function batalkan_transaksi(){
		echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Anda Telah mebatalkan Transaksi!</center></div>');
		$idp = array('id_penjualan' => $this->session->idp);
		$this->model_app->delete('rb_penjualan',$idp);
		$idp_detail = array('id_penjualan' => $this->session->idp);
		$this->model_app->delete('rb_penjualan_detail',$idp_detail);

		$this->session->unset_userdata('idp');
		redirect('members/profile');
	}

	function order(){
		cek_session_members();
		$this->session->set_userdata(array('produk'=>cetak($this->uri->segment(3))));
		$cek = $this->db->query("SELECT b.nama_kota FROM rb_konsumen a JOIN rb_kota b ON a.kota_id=b.kota_id where a.id_konsumen='".$this->session->id_konsumen."'")->row_array();
		redirect('members/reseller?cari_reseller='.$cek['nama_kota']);
	}

	public function username_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        // grab the email value from the post variable.
	        $username = cetak($this->input->post('a'));
            if(!$this->form_validation->is_unique($username, 'rb_konsumen.username')) {          
	         	$this->output->set_content_type('application/json')->set_output(json_encode(array('messageusername' => 'Maaf, Username ini sudah terdaftar,..')));
            }

        }
    }

    public function email_check(){
        // allow only Ajax request    
        if($this->input->is_ajax_request()) {
	        // grab the email value from the post variable.
	        $email = cetak($this->input->post('d'));

	        if(!$this->form_validation->is_unique($email, 'rb_konsumen.email')) {          
	         	$this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'Maaf, Email ini sudah terdaftar,..')));
            }
        }
	}
	

	// Controller Modul Produk

	function produk(){
		cek_session_members();
		$data['sitemap'] = $this->model_app->view_ordering_limit('rb_produk','id_produk','DESC',0,50);
		$this->load->view('administrator/sitemap',$data);
		
		verifikasi(reseller($this->session->id_konsumen));
		if (isset($_POST['submit'])){
			$jml = $this->model_app->view('rb_produk')->num_rows();
			for ($i=1; $i<=$jml; $i++){
				$a  = $_POST['a'][$i];
				$b  = $_POST['b'][$i];
				$cek = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$a,'id_reseller'=>reseller($this->session->id_konsumen)))->num_rows();
				if ($cek >= 1){
					if ($b > 0){
						$data = array('diskon'=>$b);
						$where = array('id_produk' => $a,'id_reseller' => reseller($this->session->id_konsumen));
						$this->model_app->update('rb_produk_diskon', $data, $where);
					}else{
						$this->model_app->delete('rb_produk_diskon',array('id_produk'=>$a,'id_reseller'=>reseller($this->session->id_konsumen)));
					}
				}else{
					if ($b > 0){
						$data = array('id_produk'=>$a,
			                          'id_reseller'=>reseller($this->session->id_konsumen),
			                          'diskon'=>$b);
						$this->model_app->insert('rb_produk_diskon',$data);
					}
				}
			}
			redirect($this->uri->segment(1).'/produk');
		}else{
			$this->session->unset_userdata('sesi_produk');
			$data['title'] = 'Produk Anda';
			$data['record'] = $this->model_app->view_where_ordering('rb_produk',array('id_reseller'=>reseller($this->session->id_konsumen)),'id_produk','DESC');
			$data['record_cek'] = $this->model_app->view_where('rb_produk',array('id_reseller'=>reseller($this->session->id_konsumen)));
			$this->template->load(template().'/template',template().'/reseller/mod_produk/view_produk',$data);
		}
	}

	function tambah_produk(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
        if (isset($_POST['submit'])){
			if ($this->input->post('tag')!=''){
                $tag_seo = $this->input->post('tag');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
			}
			
			$iden = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
			$cek_produk = $this->db->query("SELECT * FROM rb_produk where id_reseller='".reseller($this->session->id_konsumen)."'");
			$status = cek_paket(reseller($this->session->id_konsumen));
			if ($status>=1){
				$cekpa = $this->db->query("SELECT a.id_reseller, b.max_produk, b.nama_paket FROM `rb_reseller_paket` a JOIN rb_paket b ON a.id_paket=b.id_paket where a.status='Y' AND a.id_reseller='".reseller($this->session->id_konsumen)."'")->row_array();
				if ($cek_produk->num_rows()>=$cekpa['max_produk']){
					echo $this->session->set_flashdata('message', "<div class='alert alert-danger'><b>PENTING</b> - Maaf, Paket anda $cekpa[nama_paket] hanya bisa posting maksimal $cekpa[max_produk] Produk.</div>");
					redirect($this->uri->segment(1).'/upgrade');
				}else{
					if ($this->session->sesi_produk!=''){
						$rows = $this->db->query("SELECT GROUP_CONCAT(file_name SEPARATOR ';') as files FROM `img_comment` where id_comment='".$this->session->sesi_produk."'")->row_array();
						$fileName = $rows['files'];
					}else{
						$fileName = '';
					}

					$cek_referral = $this->db->query("SELECT id_reseller FROM rb_reseller where id_reseller='".reseller($this->session->id_konsumen)."' AND referral!=''");
					if ($cek_referral->num_rows()>=1){
						if (cetak($this->input->post('d'))<='0'){
							echo $this->session->set_flashdata('message', "<div class='alert alert-danger'><b>GAGAL</b> - Anda diwajibkan input Harga Modal Produk...</div>");
							redirect($this->uri->segment(1).'/produk');
						}
					}

					$produk_seo = seo_title($this->input->post('b')).'-'.date('His');
					$data = array('id_kategori_produk'=>cetak($this->input->post('a')),
								'id_kategori_produk_sub'=>cetak($this->input->post('aa')),
								'id_reseller'=>reseller($this->session->id_konsumen),
								'nama_produk'=>cetak($this->input->post('b')),
								'produk_seo'=>$produk_seo,
								'satuan'=>cetak($this->input->post('c')),
								'harga_beli'=>simpan_rupiah(cetak($this->input->post('d'))),
                              	'harga_reseller'=>simpan_rupiah(cetak($this->input->post('e'))),
                              	'harga_konsumen'=>simpan_rupiah(cetak($this->input->post('f'))),
								'berat'=>cetak($this->input->post('berat')),
								'gambar'=>$fileName,
								'tentang_produk'=>strip_tags($this->input->post('fff')),
								'keterangan'=>$this->input->post('ff'),
								'aktif'=>config('approve_produk'),
								'tag'=>$tag,
								'username'=>$this->session->username,
								'minimum'=>$this->input->post('minimum'),
								'pre_order'=>$this->input->post('pre_order'),
								'waktu_input'=>date('Y-m-d H:i:s'),
								'url'=>$this->input->post('url'));
					
					$this->model_app->insert('rb_produk',$data);
					$id_produk = $this->db->insert_id();
					if (simpan_rupiah(cetak($this->input->post('diskon'))) > 0){
						$cek = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='".$id_produk."' AND id_reseller='".reseller($this->session->id_konsumen)."'");
						if ($cek->num_rows()>=1){
							$data = array('diskon'=>simpan_rupiah(cetak($this->input->post('diskon'))));
							$where = array('id_produk' => $id_produk,'id_reseller' => reseller($this->session->id_konsumen));
							$this->model_app->update('rb_produk_diskon', $data, $where);
						}else{
							$data = array('id_produk'=>$id_produk,
										'id_reseller'=>reseller($this->session->id_konsumen),
										'diskon'=>simpan_rupiah(cetak($this->input->post('diskon'))));
							$this->model_app->insert('rb_produk_diskon',$data);
						}
					}

					if ($this->input->post('jumlah')[0]!=''){
						for ($i=0; $i < count($this->input->post('jumlah')); $i++) { 
							if (cetak($this->input->post('jumlah')[$i])!=''){
								$warna = array('id_produk'=>$id_produk,
											'jumlah_group'=>cetak($this->input->post('jumlah')[$i]),
											'harga_group'=>simpan_rupiah(cetak($this->input->post('harga')[$i])));
								$this->model_app->insert('rb_produk_group',$warna);
							}
						}
					}

					if ($this->input->post('variasi1')!=''){
						$warna = array('id_produk'=>$id_produk,
										'nama'=>cetak($this->input->post('variasi1')),
										'variasi'=>implode(";",cetak($this->input->post('warna'))));
						$this->model_app->insert('rb_produk_variasi',$warna);
					}

					if ($this->input->post('variasi2')!=''){
						$ukuran = array('id_produk'=>$id_produk,
										'nama'=>cetak($this->input->post('variasi2')),
										'variasi'=>implode(";",cetak($this->input->post('ukuran'))));
						$this->model_app->insert('rb_produk_variasi',$ukuran);
					}

					if ($this->input->post('variasi3')!=''){
						$lainnya = array('id_produk'=>$id_produk,
										'nama'=>cetak($this->input->post('variasi3')),
										'variasi'=>implode(";",cetak($this->input->post('lainnya'))));
						$this->model_app->insert('rb_produk_variasi',$lainnya);
					}


					if ((int)$this->input->post('stok') != '0'){
						$kode_transaksi = "TRX-".date('YmdHis');
						$data = array('kode_transaksi'=>$kode_transaksi,
									'id_pembeli'=>reseller($this->session->id_konsumen),
									'id_penjual'=>'1',
									'status_pembeli'=>'reseller',
									'status_penjual'=>'admin',
									'service'=>'Stok Otomatis (Pribadi)',
									'waktu_transaksi'=>date('Y-m-d H:i:s'),
									'proses'=>'4');
						$this->model_app->insert('rb_penjualan',$data);
						$idp = $this->db->insert_id();

						$data = array('id_penjualan'=>$idp,
									'id_produk'=>$id_produk,
									'jumlah'=>cetak($this->input->post('stok')),
									'harga_jual'=>cetak($this->input->post('e')),
									'satuan'=>cetak($this->input->post('c')));
						$this->model_app->insert('rb_penjualan_detail',$data);
					}
					$this->session->unset_userdata('sesi_produk');
					redirect($this->uri->segment(1).'/produk');
				}
				
			}else{
				if ($cek_produk->num_rows()>=$iden['free_reseller']){
					echo $this->session->set_flashdata('message', "<div class='alert alert-danger'><b>PENTING</b> - Maaf, Penjual dengan status FREE hanya bisa posting maksimal $iden[free_reseller] Produk.</div>");
					redirect($this->uri->segment(1).'/produk');
				}else{
					if ($this->session->sesi_produk!=''){
						$rows = $this->db->query("SELECT GROUP_CONCAT(file_name SEPARATOR ';') as files FROM `img_comment` where id_comment='".$this->session->sesi_produk."'")->row_array();
						$fileName = $rows['files'];
					}else{
						$fileName = '';
					}

					$cek_referral = $this->db->query("SELECT id_reseller FROM rb_reseller where id_reseller='".reseller($this->session->id_konsumen)."' AND referral!=''");
					if ($cek_referral->num_rows()>=1){
						if (cetak($this->input->post('d'))<='0'){
							echo $this->session->set_flashdata('message', "<div class='alert alert-danger'><b>GAGAL</b> - Anda diwajibkan input Harga Modal Produk...</div>");
							redirect($this->uri->segment(1).'/produk');
						}
					}

					$produk_seo = seo_title($this->input->post('b')).'-'.date('His');
					$data = array('id_kategori_produk'=>cetak($this->input->post('a')),
								'id_kategori_produk_sub'=>cetak($this->input->post('aa')),
								'id_reseller'=>reseller($this->session->id_konsumen),
								'nama_produk'=>cetak($this->input->post('b')),
								'produk_seo'=>cetak($produk_seo),
								'satuan'=>cetak($this->input->post('c')),
								'harga_beli'=>simpan_rupiah(cetak($this->input->post('d'))),
                              	'harga_reseller'=>simpan_rupiah(cetak($this->input->post('e'))),
                              	'harga_konsumen'=>simpan_rupiah(cetak($this->input->post('f'))),
								'berat'=>cetak($this->input->post('berat')),
								'gambar'=>$fileName,
								'tentang_produk'=>strip_tags($this->input->post('fff')),
								'keterangan'=>$this->input->post('ff'),
								'aktif'=>config('approve_produk'),
								'tag'=>$tag,
								'username'=>$this->session->username,
								'minimum'=>$this->input->post('minimum'),
								'pre_order'=>$this->input->post('pre_order'),
								'waktu_input'=>date('Y-m-d H:i:s'),
								'url'=>$this->input->post('url'));
					
					$this->model_app->insert('rb_produk',$data);
					$id_produk = $this->db->insert_id();
					if (simpan_rupiah(cetak($this->input->post('diskon'))) > 0){
						$cek = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='".$id_produk."' AND id_reseller='".reseller($this->session->id_konsumen)."'");
						if ($cek->num_rows()>=1){
							$data = array('diskon'=>simpan_rupiah(cetak($this->input->post('diskon'))));
							$where = array('id_produk' => $id_produk,'id_reseller' => reseller($this->session->id_konsumen));
							$this->model_app->update('rb_produk_diskon', $data, $where);
						}else{
							$data = array('id_produk'=>$id_produk,
										'id_reseller'=>reseller($this->session->id_konsumen),
										'diskon'=>simpan_rupiah(cetak($this->input->post('diskon'))));
							$this->model_app->insert('rb_produk_diskon',$data);
						}
					}

					if ($this->input->post('jumlah')[0]!=''){
						for ($i=0; $i < count($this->input->post('jumlah')); $i++) { 
							if (cetak($this->input->post('jumlah')[$i])!=''){
								$warna = array('id_produk'=>$id_produk,
											'jumlah_group'=>cetak($this->input->post('jumlah')[$i]),
											'harga_group'=>simpan_rupiah(cetak($this->input->post('harga')[$i])));
								$this->model_app->insert('rb_produk_group',$warna);
							}
						}
					}

					if ($this->input->post('variasi1')!=''){
						$warna = array('id_produk'=>$id_produk,
										'nama'=>cetak($this->input->post('variasi1')),
										'variasi'=>implode(";",$this->input->post('warna')));
						$this->model_app->insert('rb_produk_variasi',$warna);
					}

					if ($this->input->post('variasi2')!=''){
						$ukuran = array('id_produk'=>$id_produk,
										'nama'=>cetak($this->input->post('variasi2')),
										'variasi'=>implode(";",$this->input->post('ukuran')));
						$this->model_app->insert('rb_produk_variasi',$ukuran);
					}

					if ($this->input->post('variasi3')!=''){
						$lainnya = array('id_produk'=>$id_produk,
										'nama'=>cetak($this->input->post('variasi3')),
										'variasi'=>implode(";",$this->input->post('lainnya')));
						$this->model_app->insert('rb_produk_variasi',$lainnya);
					}


					if ((int)$this->input->post('stok') != '0'){
						$kode_transaksi = "TRX-".date('YmdHis');
						$data = array('kode_transaksi'=>$kode_transaksi,
									'id_pembeli'=>reseller($this->session->id_konsumen),
									'id_penjual'=>'1',
									'status_pembeli'=>'reseller',
									'status_penjual'=>'admin',
									'service'=>'Stok Otomatis (Pribadi)',
									'waktu_transaksi'=>date('Y-m-d H:i:s'),
									'proses'=>'4');
						$this->model_app->insert('rb_penjualan',$data);
						$idp = $this->db->insert_id();

						$data = array('id_penjualan'=>$idp,
									'id_produk'=>$id_produk,
									'jumlah'=>cetak($this->input->post('stok')),
									'harga_jual'=>cetak($this->input->post('e')),
									'satuan'=>cetak($this->input->post('c')));
						$this->model_app->insert('rb_penjualan_detail',$data);
					}
					$this->session->unset_userdata('sesi_produk');
					redirect($this->uri->segment(1).'/produk');
				}
			}
            
        }else{
			$data['title'] = 'Tambah Produk';
			$data['tag'] = $this->model_app->view_ordering('tagpro','id_tag','DESC');
            $data['record'] = $this->model_app->view_ordering('rb_kategori_produk','id_kategori_produk','DESC');
            $this->template->load(template().'/template',template().'/reseller/mod_produk/view_produk_tambah',$data);
        }
	}
	
	function kupon(){
		$id_produk = cetak($this->uri->segment(3));
		$kupon = $this->db->query("SELECT a.*,COALESCE(b.used, 0) as used FROM
		(SELECT * FROM rb_produk_kupon where id_produk='$id_produk') as a LEFT JOIN
		(select id_kupon, COUNT(*) used from rb_penjualan_kupon GROUP BY id_kupon HAVING COUNT(id_kupon)) as b on a.id_kupon=b.id_kupon")->result();
		echo json_encode($kupon);
	}

	function kupon_save(){
		if (cetak($this->input->post('a'))!=''){
			$data = array('id_produk'=>cetak($this->input->post('id_produk')),
						'kode_kupon'=>cetak($this->input->post('a')),
						'nilai_kupon'=>cetak(simpan_rupiah($this->input->post('d'))),
						'jumlah_kupon'=>cetak($this->input->post('b')),
						'min_order'=>cetak($this->input->post('e')),
						'expire_date'=>cetak($this->input->post('c')),
						'created_date'=>date('Y-m-d H:i:s'));
			if ($this->input->post('id_kupon')==''){
				$result = $this->model_app->insert('rb_produk_kupon',$data);
			}else{
				$where = array('id_kupon' => cetak($this->input->post('id_kupon')));
            	$result = $this->model_app->update('rb_produk_kupon', $data, $where);
			}
			echo json_encode($result);
		}
	}

	function kupon_used(){
		$cek_kupon = $this->db->query("SELECT * FROM rb_produk_kupon where kode_kupon='".cetak($this->input->post('kode_kupon'))."'");
		if ($cek_kupon->num_rows()>=1){
			$row = $cek_kupon->row_array();
			$cek_keranjang = $this->db->query("SELECT * FROM rb_penjualan_temp where id_produk='$row[id_produk]' AND session='".$this->session->idp."'");
			if ($cek_keranjang->num_rows()>=1){
				$rows = $cek_keranjang->row_array();
				if ($rows['jumlah']>=$row['min_order']){
					$expired = str_replace("-","",$row['expire_date']);
					if ($expired>=date('Ymd')){
						$terpakai = $this->db->query("SELECT * FROM rb_penjualan_kupon where id_kupon='$row[id_kupon]'");
						if ($terpakai->num_rows()<$row['jumlah_kupon']){
							$data = array('id_kupon'=>$row['id_kupon']);
							$where = array('id_produk' => $row['id_produk'], 'session'=>$this->session->idp);
							$result = $this->model_app->update('rb_penjualan_temp', $data, $where);
							echo json_encode($result);
						}else{
							echo json_encode(array('pesan'=>'Maaf, Kupon / Voucher yang anda diinput sudah tidak tersedia.'));
						}
					}else{
						echo json_encode(array('pesan'=>'Maaf, Kupon / Voucher yang anda diinput sudah Kadaluarsa (Expire).'));
					}
				}else{
					echo json_encode(array('pesan'=>'Maaf, Kupon / Voucher hanya bisa Digunakan untuk Minimal Order '.$row['min_order'].' Produk'));
				}
			}else{
				echo json_encode(array('pesan'=>'Maaf, Produk untuk kupon / Voucher yang diinput tidak ada di keranjang anda.'));
			}
		}else{
			echo json_encode(array('pesan'=>'Maaf, Kode Kupon / Voucher Tidak ditemukan.'));
		}
	}

	function kupon_list(){
		$data = $this->db->query("SELECT a.id_penjualan_detail, b.* FROM rb_penjualan_temp a JOIN rb_produk_kupon b ON a.id_kupon=b.id_kupon where a.session='".$this->session->idp."' AND a.id_kupon!=''")->result();
		echo json_encode($data);
	}

	function kupon_list_sum(){
		$data = $this->db->query("SELECT sum(b.nilai_kupon) as total_nilai_kupon FROM rb_penjualan_temp a JOIN rb_produk_kupon b ON a.id_kupon=b.id_kupon where a.session='".$this->session->idp."' AND a.id_kupon!=''")->result();
		echo json_encode($data);
	}

	function kupon_cart_delete(){
		$data = array('id_kupon'=>null);
		$where = array('id_penjualan_detail ' => cetak($this->input->post('id')));
		$result = $this->model_app->update('rb_penjualan_temp', $data, $where);
		echo json_encode($result);
	}

	function kupon_delete(){
		$cek = $this->db->query("SELECT * FROM rb_penjualan_kupon where id_kupon='".cetak($this->input->post('id'))."'");
		if ($cek->num_rows()<=0){
			$result = $this->db->query("DELETE FROM rb_produk_kupon where id_kupon='".cetak($this->input->post('id'))."'");
			echo json_encode($result);
		}
	}

    function edit_produk(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
        $id = cetak($this->uri->segment(3));
		if (isset($_GET['id'])){
			$id = array('id_group' => cetak($this->input->get('id')));
			$this->model_app->delete('rb_produk_group',$id);
			redirect($this->uri->segment(1).'/edit_produk/'.$this->uri->segment(3));
		}

        if (isset($_POST['submit'])){
			if ($this->input->post('tag')!=''){
                $tag_seo = $this->input->post('tag');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
			}
			
            if ($this->session->sesi_produk!=''){
				$rows = $this->db->query("SELECT GROUP_CONCAT(file_name SEPARATOR ';') as files FROM `img_comment` where id_comment='".$this->session->sesi_produk."'")->row_array();
				$fileName = $rows['files'];
			}else{
				$fileName = '';
			}

			$cek_referral = $this->db->query("SELECT id_reseller FROM rb_reseller where id_reseller='".reseller($this->session->id_konsumen)."' AND referral!=''");
			if ($cek_referral->num_rows()>=1){
				if (cetak($this->input->post('d'))<='0'){
					echo $this->session->set_flashdata('message', "<div class='alert alert-danger'><b>GAGAL</b> - Anda diwajibkan input Harga Modal Produk...</div>");
					redirect($this->uri->segment(1).'/produk');
				}
			}

			if (cetak($this->input->post('pre_order_status'))=='Tidak'){ $pre_order = NULL; }else{ $pre_order = cetak($this->input->post('pre_order')); }

			if ($fileName!=''){
                $data = array('id_kategori_produk'=>cetak($this->input->post('a')),
                			  'id_kategori_produk_sub'=>cetak($this->input->post('aa')),
                              'nama_produk'=>cetak($this->input->post('b')),
                              'satuan'=>cetak($this->input->post('c')),
                              'harga_beli'=>simpan_rupiah(cetak($this->input->post('d'))),
                              'harga_reseller'=>simpan_rupiah(cetak($this->input->post('e'))),
                              'harga_konsumen'=>simpan_rupiah(cetak($this->input->post('f'))),
                              'berat'=>cetak($this->input->post('berat')),
							  'gambar'=>$fileName,
							  'url'=>$this->input->post('url'),
							  'tentang_produk'=>strip_tags($this->input->post('fff')),
							  'keterangan'=>$this->input->post('ff'),
							  'tag'=>$tag,
							  'minimum'=>$this->input->post('minimum'),
							  'pre_order'=>$pre_order,
                              'username'=>reseller($this->session->id_konsumen));
			}else{
				$data = array('id_kategori_produk'=>cetak($this->input->post('a')),
                			  'id_kategori_produk_sub'=>cetak($this->input->post('aa')),
                              'nama_produk'=>cetak($this->input->post('b')),
                              'satuan'=>cetak($this->input->post('c')),
                              'harga_beli'=>simpan_rupiah(cetak($this->input->post('d'))),
                              'harga_reseller'=>simpan_rupiah(cetak($this->input->post('e'))),
                              'harga_konsumen'=>simpan_rupiah(cetak($this->input->post('f'))),
                              'berat'=>cetak($this->input->post('berat')),
							  'tentang_produk'=>strip_tags($this->input->post('fff')),
							  'keterangan'=>$this->input->post('ff'),
							  'url'=>$this->input->post('url'),
							  'tag'=>$tag,
							  'minimum'=>$this->input->post('minimum'),
							  'pre_order'=>$pre_order,
                              'username'=>reseller($this->session->id_konsumen));
			}
            $where = array('id_produk' => cetak($this->input->post('id')),'id_reseller'=>reseller($this->session->id_konsumen));
            $this->model_app->update('rb_produk', $data, $where);

            if (simpan_rupiah(cetak($this->input->post('diskon'))) >= 0){
            	$cek = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='".cetak($this->input->post('id'))."' AND id_reseller='".reseller($this->session->id_konsumen)."'");
				if ($cek->num_rows()>=1){
					$data = array('diskon'=>simpan_rupiah(cetak($this->input->post('diskon'))));
					$where = array('id_produk' => cetak($this->input->post('id')),'id_reseller' => reseller($this->session->id_konsumen));
					$this->model_app->update('rb_produk_diskon', $data, $where);
				}else{
					$data = array('id_produk'=>cetak($this->input->post('id')),
			                      'id_reseller'=>reseller($this->session->id_konsumen),
			                      'diskon'=>simpan_rupiah(cetak($this->input->post('diskon'))));
					$this->model_app->insert('rb_produk_diskon',$data);
				}
			}


			$id_produk = cetak($this->input->post('id'));
			$id_variasi = array('id_produk' => $id_produk);

			$cek_akses = $this->db->query("SELECT * FROM rb_produk where id_produk='".cetak($this->input->post('id'))."' AND id_reseller='".reseller($this->session->id_konsumen)."'");
			if ($cek_akses->num_rows()>=1){

				$this->model_app->delete('rb_produk_variasi',$id_variasi);

				if ($this->input->post('jumlah')[0]!=''){
					for ($i=0; $i < count($this->input->post('jumlah')); $i++) { 
						if (cetak($this->input->post('jumlah')[$i])!=''){
							$group_data = array('id_produk'=>$id_produk,
											'jumlah_group'=>cetak($this->input->post('jumlah')[$i]),
											'harga_group'=>simpan_rupiah(cetak($this->input->post('harga')[$i])));
							if (cetak($this->input->post('id_group')[$i])=='0'){
								$this->model_app->insert('rb_produk_group',$group_data);
							}else{
								$where_group = array('id_group' => cetak($this->input->post('id_group')[$i]));
            					$this->model_app->update('rb_produk_group', $group_data, $where_group);
							}
						}
					}
				}

				if ($this->input->post('variasix1')!=''){
					$warna = array('id_produk'=>$id_produk,
									'nama'=>cetak($this->input->post('variasix1')),
									'variasi'=>implode(";",$this->input->post('variasi1')));
					$this->model_app->insert('rb_produk_variasi',$warna);
				}

				if ($this->input->post('variasix2')!=''){
					$ukuran = array('id_produk'=>$id_produk,
									'nama'=>cetak($this->input->post('variasix2')),
									'variasi'=>implode(";",$this->input->post('variasi2')));
					$this->model_app->insert('rb_produk_variasi',$ukuran);
				}

				if ($this->input->post('variasix3')!=''){
					$lainnya = array('id_produk'=>$id_produk,
									'nama'=>cetak($this->input->post('variasix3')),
									'variasi'=>implode(";",$this->input->post('variasi3')));
					$this->model_app->insert('rb_produk_variasi',$lainnya);
				}
			}

			if ($this->input->post('stok') > '0'){
				$kode_transaksi = "TRX-".date('YmdHis');
				$data1 = array('kode_transaksi'=>$kode_transaksi,
			        		  'id_pembeli'=>reseller($this->session->id_konsumen),
			        		  'id_penjual'=>'1',
			        		  'status_pembeli'=>'reseller',
							  'status_penjual'=>'admin',
							  'no_resi'=>'-',
							  'kode_kurir'=>'-',
							  'kurir'=>'-',
							  'service'=>'Stok Otomatis (Pribadi)',
							  'ongkir'=>'0',
							  'keterangan'=>'-',
			        		  'waktu_transaksi'=>date('Y-m-d H:i:s'),
			        		  'proses'=>'4');
				$this->model_app->insert('rb_penjualan',$data1);
				$idp = $this->db->insert_id();

				$data2 = array('id_penjualan'=>$idp,
		        			  'id_produk'=>cetak($this->input->post('id')),
							  'jumlah'=>cetak($this->input->post('stok')),
							  'diskon'=>'0',
		        			  'harga_jual'=>cetak($this->input->post('e')),
							  'satuan'=>cetak($this->input->post('c')),
							  'keterangan_order'=>'-');
				$this->model_app->insert('rb_penjualan_detail',$data2);
			}

            redirect($this->uri->segment(1).'/produk');
        }else{
			$this->session->unset_userdata('sesi_produk');
			$data['title'] = 'Edit Produk';
			$data['tag'] = $this->model_app->view_ordering('tagpro','id_tag','DESC');
            $data['record'] = $this->model_app->view_ordering('rb_kategori_produk','id_kategori_produk','DESC');
            $data['rows'] = $this->model_app->edit('rb_produk',array('id_produk'=>$id,'id_reseller'=>reseller($this->session->id_konsumen)))->row_array();
            $this->template->load(template().'/template',template().'/reseller/mod_produk/view_produk_edit',$data);
        }
    }

    private function set_upload_options(){
        $config = array();
        $config['upload_path'] = 'asset/foto_produk/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '5000'; // kb
        $config['encrypt_name'] = FALSE;
        $this->load->library('upload', $config);
      return $config;
    }

	function delete_group(){
		cek_session_members();
        $id = array('id_group' => cetak($this->input->post('id_group')));
        $this->model_app->delete('rb_produk_group',$id);
	}

	public function deleteFile(){
		cek_session_members();
		$name = $this->input->post('name');
		$filePath = 'asset/foto_produk/'.$name;
		$thumb_filePath = 'asset/foto_produk/thumb_'.$name;
		if($name){
			if (file_exists($filePath)) 
			{
				unlink($filePath); // delete file from dir
				unlink($thumb_filePath); // delete file from dir
		    }
			$this->db->delete('img_comment', array('file_name' => $name));
		}

		echo "Deleted File ".$name."<br>";
	}

	public function upload(){
        cek_session_members();
        $this->load->model('imgComment');
		$data = array();
		if ($this->session->sesi_produk==''){
			$id = $this->session->id_konsumen.'-produk-'.date('Ymdhis');
			$this->session->set_userdata(array('sesi_produk'=>$id));
		}else{
			$id = $this->session->sesi_produk;
		}
        if(isset($_FILES['uploadFile'])){
        	// File upload configuration
            $uploadPath = 'asset/foto_produk/';
            $config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|txt|pdf|gif|zip|rar|tar';
			$config['max_size']	= '50000'; // kb

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);	

	 	 	$fileName = $_FILES["uploadFile"]["name"];

            // Upload file to server
            if($this->upload->do_upload('uploadFile')){
				$fileData = $this->upload->data();
				//Compress Image
				$config['image_library']='gd2';
				$config['source_image']='./asset/foto_produk/'.$fileData['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= FALSE;
				$config['quality']= '50%';
				$config['width']= 191;
				$config['height']= 171;
				$config['new_image']= './asset/foto_produk/thumb_'.$fileData['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

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


	public function deleteFile_syarat(){
		cek_session_members();
		$name = $this->input->post('name');
		$filePath = 'asset/images/'.$name;
		if($name){
			if (file_exists($filePath)) 
			{
		        unlink($filePath); // delete file from dir
		    }
			$this->db->delete('img_comment', array('file_name' => $name));
		}

		echo "Deleted File ".$name."<br>";
	}

	public function upload_syarat(){
        cek_session_members();
        $this->load->model('imgComment');
		$data = array();
		if ($this->session->sesi_syarat==''){
			$id = $this->session->id_konsumen.'-syarat-'.date('Ymdhis');
			$this->session->set_userdata(array('sesi_syarat'=>$id));
		}else{
			$id = $this->session->sesi_syarat;
		}
        if(isset($_FILES['uploadFile'])){
        	// File upload configuration
            $uploadPath = 'asset/images/';
            $config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|txt|pdf|gif|zip|rar|tar';
			$config['max_size']	= '50000'; // kb

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
	
	// Upload image summernote
    function upload_image(){
		cek_session_members();
        if(isset($_FILES["image"]["name"])){
            $config['upload_path'] = 'asset/images/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('image')){
                $this->upload->display_errors();
                return FALSE;
            }else{
                $data = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='asset/images/'.$data['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= TRUE;
                $config['quality']= '60%';
                $config['width']= 800;
                $config['height']= 800;
                $config['new_image']= 'asset/images/thumb_'.$data['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                echo base_url().'asset/images/'.$data['file_name'];
            }
        }
	}
	
	// Controller Modul COD

	function alamat_cod(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		$data['title'] = "Alamat Cash on Delivery (COD)";
		$data['record'] = $this->model_app->view_where('rb_reseller_cod',array('id_reseller'=>reseller($this->session->id_konsumen)));
		$this->template->load(template().'/template',template().'/reseller/mod_alamat_cod/view',$data);
	}

	function tambah_cod(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		if (isset($_POST['submit'])){
			$data = array('id_reseller'=>reseller($this->session->id_konsumen),
			              'nama_alamat'=>cetak($this->input->post('a')),
			              'biaya_cod'=>cetak($this->input->post('b')));
						$this->model_app->insert('rb_reseller_cod',$data);
			redirect($this->uri->segment(1).'/alamat_cod');
		}else{
			$data['title'] = "Tambah Alamat Cash on Delivery (COD)";
			$this->template->load(template().'/template',template().'/reseller/mod_alamat_cod/tambah',$data);
		}
	}

	function edit_cod(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		$id = cetak($this->uri->segment(3));
		if (isset($_POST['submit'])){
			$data = array('id_reseller'=>reseller($this->session->id_konsumen),
			              'nama_alamat'=>cetak($this->input->post('a')),
			              'biaya_cod'=>cetak($this->input->post('b')));
			$where = array('id_cod' => cetak($this->input->post('id')),'id_reseller' => reseller($this->session->id_konsumen));
			$this->model_app->update('rb_reseller_cod', $data, $where);
			redirect($this->uri->segment(1).'/alamat_cod');
		}else{
			$data['title'] = "Edit Alamat Cash on Delivery (COD)";
			$data['rows'] = $this->model_app->edit('rb_reseller_cod',array('id_cod'=>$id))->row_array();
			$this->template->load(template().'/template',template().'/reseller/mod_alamat_cod/edit',$data);
		}
	}

	function delete_cod(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		$id = array('id_cod' => cetak($this->uri->segment(3)),'id_reseller' => reseller($this->session->id_konsumen));
		$this->model_app->delete('rb_reseller_cod',$id);
		redirect($this->uri->segment(1).'/alamat_cod');
	}
 
    //Delete image summernote
    function delete_image(){
        $src = cetak($this->input->post('src'));
        $file_name = str_replace(base_url(), '', $src);
        if(unlink($file_name)){
            echo 'File Delete Successfully';
        }
	}
	

	// Controller Modul Pembelian

	function pembelian(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		$this->session->unset_userdata('idp');
		$data['title'] = "Data Pembelian Ke Pusat";
		$data['record'] = $this->model_reseller->reseller_pembelian(reseller($this->session->id_konsumen),'admin');
		$this->template->load(template().'/template',template().'/reseller/mod_pembelian/view_pembelian',$data);
	}

	function detail_pembelian(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		$data['title'] = "Detail Data Pembelian Ke Pusat";
		$data['rows'] = $this->model_reseller->penjualan_detail(cetak($this->uri->segment(3)))->row_array();
		$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>cetak($this->uri->segment(3))),'id_penjualan_detail','DESC');
		$this->template->load(template().'/template',template().'/reseller/mod_pembelian/view_pembelian_detail',$data);
	}

	function tambah_pembelian(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		if(isset($_POST['submit'])){
			if ($this->input->post('aa')!=''){
				$id_produk = cetak($this->input->post('aa'));
				$jumlah = cetak($this->input->post('dd'));
				$harga_jual = cetak($this->input->post('bb'));
				$satuan = cetak($this->input->post('ee'));
			}else{
				$id_produk = cetak($this->uri->segment(3));
				$resp = $this->model_app->view_where('rb_produk',array('id_produk'=>$id_produk))->row_array();
				$jumlah = cetak($this->input->post('qty'));
				$harga_jual = $resp['harga_reseller'];
				$satuan = $resp['satuan'];
			}

			if ($this->session->idp == ''){
				$kode_transaksixe = "TRX-".date('YmdHis');
				$data = array('kode_transaksi'=>$kode_transaksixe,
			        		  'id_pembeli'=>reseller($this->session->id_konsumen),
			        		  'id_penjual'=>'1',
			        		  'status_pembeli'=>'reseller',
			        		  'status_penjual'=>'admin',
			        		  'waktu_transaksi'=>date('Y-m-d H:i:s'),
							  'proses'=>'0',
							  'service'=>'TRX-Penjual Produk (Transfer)');
				$this->model_app->insert('rb_penjualan',$data);
				$idp = $this->db->insert_id();
				$this->session->set_userdata(array('idp'=>$idp,'kode_transaksi'=>$kode_transaksixe));
			}

	        if ($this->input->post('idpd')==''){
				$data = array('id_penjualan'=>$this->session->idp,
		        			  'id_produk'=>$id_produk,
		        			  'jumlah'=>$jumlah,
		        			  'harga_jual'=>$harga_jual,
		        			  'satuan'=>$satuan);
				$this->model_app->insert('rb_penjualan_detail',$data);
			}else{
		        $data = array('id_produk'=>$id_produk,
		        			  'jumlah'=>$jumlah,
		        			  'harga_jual'=>$harga_jual,
		        			  'satuan'=>$satuan);
				$where = array('id_penjualan_detail' => cetak($this->input->post('idpd')));
				$this->model_app->update('rb_penjualan_detail', $data, $where);
			}
			redirect($this->uri->segment(1).'/tambah_pembelian');

		}elseif(isset($_POST['selesai'])){
			if ($this->input->post('metode')=='saldo'){
				$idp = $this->session->idp;
				$total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='".$idp."'")->row_array();
				if (saldo(reseller($this->session->id_konsumen),$this->session->id_konsumen)>=$total['total']){
					$kode_transaksi = $this->session->kode_transaksi;

					$datax = array('proses'=>1,'service'=>'TRX-Penjual Produk (Saldo)');
					$wherex = array('id_penjualan' => $idp);
					$this->model_app->update('rb_penjualan', $datax, $wherex);

					$data = array('id_rekening_reseller'=>0,
						  'id_reseller'=>reseller($this->session->id_konsumen),
			              'nominal'=>$total['total'],
						  'status'=>'Sukses',
						  'transaksi'=>'Debit',
						  'keterangan'=>$kode_transaksi,
			              'waktu_withdraw'=>date('Y-m-d H:i:s'));
					$this->model_app->insert('rb_withdraw',$data);
				}else{
					echo $this->session->set_flashdata('message', "<div class='alert alert-danger'><center><b>SALDO TIDAK MENCUKUPI</b> - GAGAL Order dengan saldo..</center></div>");	
				}
			}
			redirect($this->uri->segment(1).'/pembelian');

		}else{
			$data['title'] = "Tambah Pembelian Ke Pusat";
			$data['rows'] = $this->model_reseller->penjualan_detail($this->session->idp)->row_array();
			$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->session->idp),'id_penjualan_detail','DESC');
			$data['barang'] = $this->model_app->view_where_ordering('rb_produk',array('id_reseller'=>'0','id_produk_perusahaan'=>'0'),'id_produk','ASC');
			$data['reseller'] = $this->model_app->view_ordering('rb_reseller','id_reseller','ASC');
			if ($this->uri->segment(3)!=''){
				$data['row'] = $this->model_app->view_where('rb_penjualan_detail',array('id_penjualan_detail'=>$this->uri->segment(3)))->row_array();
			}
			$this->template->load(template().'/template',template().'/reseller/mod_pembelian/view_pembelian_tambah',$data);
		}
	}

	function delete_pembelian(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		$id = array('id_penjualan' => cetak($this->uri->segment(3)));
		$this->model_app->delete('rb_penjualan',$id);
		$this->model_app->delete('rb_penjualan_detail',$id);
		redirect($this->uri->segment(1).'/pembelian');
	}

	function delete_pembelian_tambah_detail(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		$id = array('id_penjualan_detail' => $this->uri->segment(3));
		$this->model_app->delete('rb_penjualan_detail',$id);
		redirect($this->uri->segment(1).'/tambah_pembelian');
	}

	function konfirmasi_pembayaran(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/files/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('f');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
				$data = array('id_penjualan'=>cetak($this->input->post('id')),
			        		  'total_transfer'=>cetak($this->input->post('b')),
			        		  'id_rekening'=>cetak($this->input->post('c')),
			        		  'nama_pengirim'=>cetak($this->input->post('d')),
			        		  'tanggal_transfer'=>cetak($this->input->post('e')),
			        		  'waktu_konfirmasi'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_konfirmasi_pembayaran',$data);
			}else{
				$data = array('id_penjualan'=>cetak($this->input->post('id')),
			        		  'total_transfer'=>cetak($this->input->post('b')),
			        		  'id_rekening'=>cetak($this->input->post('c')),
			        		  'nama_pengirim'=>cetak($this->input->post('d')),
			        		  'tanggal_transfer'=>cetak($this->input->post('e')),
			        		  'bukti_transfer'=>$hasil['file_name'],
			        		  'waktu_konfirmasi'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_konfirmasi_pembayaran',$data);
			}
				$data1 = array('proses'=>'2');
				$where = array('id_penjualan' => cetak($this->input->post('id')));
				$this->model_app->update('rb_penjualan', $data1, $where);
			redirect($this->uri->segment(1).'/pembelian');
		}else{
			$data['title'] = "Konfirmasi Pembayaran Pembelian Ke Pusat";
			$data['record'] = $this->model_app->view('rb_rekening');
			$data['total'] = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='".cetak($this->uri->segment(3))."'")->row_array();
			$data['rows'] = $this->model_app->view_where('rb_penjualan',array('id_penjualan'=>cetak($this->uri->segment(3))))->row_array();
			$this->template->load(template().'/template',template().'/reseller/mod_pembelian/view_konfirmasi_pembayaran',$data);
		}
	}

	function grouporder(){
		if ($this->session->id_konsumen!=''){
			cek_session_members();
			$id = reseller($this->session->id_konsumen);
			$data['records'] = $this->model_reseller->group_order($id,'reseller',cetak($this->input->post('id')));
			$this->load->view(template().'/reseller/mod_penjualan/view_penjualan_group',$data);
		}else{
			echo "<center style='padding:60px 0px'>Maaf, Saat ini anda tidak memiliki Akses...<br> Silahkan <a style='font-weight:bold; text-decoration:underline' href='".base_url()."auth/login'>Login</a> Terlebih dahulu..</center>";
		}
	}


	function penjualan(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		$this->session->unset_userdata('idp');
		$id = reseller($this->session->id_konsumen);
		$data['title'] = "Data Penjualan";
		$data['menunggu'] = $this->model_reseller->menunggu_pembayaran($id,'reseller');
		$data['diterima'] = $this->model_reseller->penjualan_status_tanpabayar($id,'reseller','1');
		$data['dikirim'] = $this->model_reseller->penjualan_status_tanpabayar($id,'reseller','3');
		$data['selesai'] = $this->model_reseller->penjualan_status_tanpabayar($id,'reseller','4');
		$this->template->load(template().'/template',template().'/reseller/mod_penjualan/view_penjualan',$data);
	}

	function detail_penjualan(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		if (isset($_POST['submit'])){
			$data1 = array('no_resi'=>cetak($this->input->post('no_resi')),
							'proses'=>'3');
			$where = array('id_penjualan' => cetak($this->uri->segment(3)),'id_penjual'=>reseller($this->session->id_konsumen));
			$this->model_app->update('rb_penjualan', $data1, $where);
			notif_pesanan_dikirim(cetak($this->uri->segment(3)));
			redirect($this->uri->segment(1).'/detail_penjualan/'.$this->uri->segment(3));
		}else{
			$data['title'] = "Detail Data Penjualan";
			$data['rows'] = $this->model_reseller->penjualan_konsumen_detail_reseller(cetak($this->uri->segment(3)))->row_array();
			$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>cetak($this->uri->segment(3))),'id_penjualan_detail','ASC');
			$this->template->load(template().'/template',template().'/reseller/mod_penjualan/view_penjualan_detail',$data);
		}
	}

	function tambah_penjualan(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		if (isset($_POST['submit1'])){
			if ($this->session->idp == ''){
				$data = array('kode_transaksi'=>cetak($this->input->post('a')),
			        		  'id_pembeli'=>cetak($this->input->post('b')),
			        		  'id_penjual'=>reseller($this->session->id_konsumen),
			        		  'status_pembeli'=>'konsumen',
			        		  'status_penjual'=>'reseller',
			        		  'waktu_transaksi'=>date('Y-m-d H:i:s'),
			        		  'proses'=>'0');
				$this->model_app->insert('rb_penjualan',$data);
				$idp = $this->db->insert_id();
				$this->session->set_userdata(array('idp'=>$idp));
			}else{
				$data = array('kode_transaksi'=>cetak($this->input->post('a')),
			        		  'id_pembeli'=>cetak($this->input->post('b')));
				$where = array('id_penjualan' => $this->session->idp);
				$this->model_app->update('rb_penjualan', $data, $where);
			}
				redirect($this->uri->segment(1).'/tambah_penjualan');

		}elseif(isset($_POST['submit'])){
			$jual = $this->model_reseller->jual_reseller(reseller($this->session->id_konsumen), cetak($this->input->post('aa')))->row_array();
            $beli = $this->model_reseller->beli_reseller(reseller($this->session->id_konsumen), cetak($this->input->post('aa')))->row_array();
            $stok = $beli['beli']-$jual['jual'];
            if ($this->input->post('dd') > $stok){
            	echo "<script>window.alert('Maaf, Stok Tidak Mencukupi!');
                                  window.location=('".base_url().$this->uri->segment(1)."/tambah_penjualan')</script>";
            }else{
		        if ($this->input->post('idpd')==''){
					$data = array('id_penjualan'=>$this->session->idp,
			        			  'id_produk'=>cetak($this->input->post('aa')),
			        			  'jumlah'=>cetak($this->input->post('dd')),
			        			  'harga_jual'=>cetak($this->input->post('bb')),
			        			  'satuan'=>cetak($this->input->post('ee')));
					$this->model_app->insert('rb_penjualan_detail',$data);
				}else{
			        $data = array('id_produk'=>cetak($this->input->post('aa')),
			        			  'jumlah'=>cetak($this->input->post('dd')),
			        			  'harga_jual'=>cetak($this->input->post('bb')),
			        			  'satuan'=>cetak($this->input->post('ee')));
					$where = array('id_penjualan_detail' => cetak($this->input->post('idpd')));
					$this->model_app->update('rb_penjualan_detail', $data, $where);
				}
				redirect($this->uri->segment(1).'/tambah_penjualan');
			}
			
		}else{
			$data['rows'] = $this->model_reseller->penjualan_konsumen_detail_reseller($this->session->idp)->row_array();
			$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->session->idp),'id_penjualan_detail','DESC');
			$data['barang'] = $this->model_app->view_ordering('rb_produk','id_produk','ASC');
			$data['konsumen'] = $this->model_app->view_ordering('rb_konsumen','id_konsumen','ASC');
			if ($this->uri->segment(3)!=''){
				$data['row'] = $this->model_app->view_where('rb_penjualan_detail',array('id_penjualan_detail'=>cetak($this->uri->segment(3))))->row_array();
			}
			$this->template->load(template().'/template',template().'/reseller/mod_penjualan/view_penjualan_tambah',$data);
		}
	}

	function edit_penjualan(){
		cek_session_members();
		if (isset($_POST['submit1'])){
			$data = array('kode_transaksi'=>cetak($this->input->post('a')),
			        	  'id_pembeli'=>cetak($this->input->post('b')),
			        	  'waktu_transaksi'=>cetak($this->input->post('c')));
			$where = array('id_penjualan' => cetak($this->input->post('idp')));
			$this->model_app->update('rb_penjualan', $data, $where);
			redirect($this->uri->segment(1).'/edit_penjualan/'.cetak($this->input->post('idp')));

		}elseif(isset($_POST['submit'])){
			$cekk = $this->db->query("SELECT * FROM rb_penjualan_detail where id_penjualan='".cetak($this->input->post('idp'))."' AND id_produk='".cetak($this->input->post('aa'))."'")->row_array();
			$jual = $this->model_reseller->jual_reseller(reseller($this->session->id_konsumen), cetak($this->input->post('aa')))->row_array();
            $beli = $this->model_reseller->beli_reseller(reseller($this->session->id_konsumen), cetak($this->input->post('aa')))->row_array();
            $stok = $beli['beli']-$jual['jual']+$cekk['jumlah'];
            if ($this->input->post('dd') > $stok){
            	echo "<script>window.alert('Maaf, Stok $stok Tidak Mencukupi!');
                                  window.location=('".base_url().$this->uri->segment(1)."/edit_penjualan/".cetak($this->input->post('idp'))."')</script>";
            }else{
				if ($this->input->post('idpd')==''){
					$data = array('id_penjualan'=>cetak($this->input->post('idp')),
			        			  'id_produk'=>cetak($this->input->post('aa')),
			        			  'jumlah'=>cetak($this->input->post('dd')),
			        			  'harga_jual'=>cetak($this->input->post('bb')),
			        			  'satuan'=>cetak($this->input->post('ee')));
					$this->model_app->insert('rb_penjualan_detail',$data);
				}else{
			        $data = array('id_produk'=>cetak($this->input->post('aa')),
			        			  'jumlah'=>cetak($this->input->post('dd')),
			        			  'harga_jual'=>cetak($this->input->post('bb')),
			        			  'satuan'=>cetak($this->input->post('ee')));
					$where = array('id_penjualan_detail' => cetak($this->input->post('idpd')));
					$this->model_app->update('rb_penjualan_detail', $data, $where);
				}
				redirect($this->uri->segment(1).'/edit_penjualan/'.cetak($this->input->post('idp')));
			}
			
		}else{
			$data['rows'] = $this->model_reseller->penjualan_konsumen_detail_reseller(cetak($this->uri->segment(3)))->row_array();
			$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>cetak($this->uri->segment(3))),'id_penjualan_detail','DESC');
			$data['barang'] = $this->model_app->view_ordering('rb_produk','id_produk','ASC');
			$data['konsumen'] = $this->model_app->view_ordering('rb_konsumen','id_konsumen','ASC');
			if ($this->uri->segment(4)!=''){
				$data['row'] = $this->model_app->view_where('rb_penjualan_detail',array('id_penjualan_detail'=>cetak($this->uri->segment(4))))->row_array();
			}
			$this->template->load(template().'/template',template().'/reseller/mod_penjualan/view_penjualan_edit',$data);
		}
	}

	function proses_penjualan(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
        $data = array('proses'=>cetak($this->uri->segment(4)));
		$where = array('id_penjualan' => cetak($this->uri->segment(3)));
		$this->model_app->update('rb_penjualan', $data, $where);
		notif_perubahan_status(cetak($this->uri->segment(4)),cetak($this->uri->segment(3)));
		
		/*$rows = $this->model_app->view_where('rb_penjualan',array('id_penjualan' => $this->uri->segment(3)))->row_array();
		$dataa = array('pembayaran'=>'1');
		$wheree = array('kode_transaksi' => $rows['kode_transaksi']);
		$this->model_app->update('rb_penjualan_otomatis', $dataa, $wheree);*/
		
		redirect($this->uri->segment(1).'/penjualan');
	}

	function proses_penjualan_detail(){
		cek_session_members();
        $data = array('proses'=>cetak($this->uri->segment(4)));
		$where = array('id_penjualan' => cetak($this->uri->segment(3)));
		$this->model_app->update('rb_penjualan', $data, $where);
		redirect($this->uri->segment(1).'/detail_penjualan/'.$this->uri->segment(3));
	}

	function delete_penjualan(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		$id = array('id_penjualan' => cetak($this->uri->segment(3)));
		$this->model_app->delete('rb_penjualan',$id);
		$this->model_app->delete('rb_penjualan_detail',$id);
		redirect($this->uri->segment(1).'/penjualan');
	}

	function delete_penjualan_detail(){
        cek_session_members();
		$id = array('id_penjualan_detail' => cetak($this->uri->segment(4)));
		$this->model_app->delete('rb_penjualan_detail',$id);
		redirect($this->uri->segment(1).'/edit_penjualan/'.$this->uri->segment(3));
	}

	function delete_penjualan_tambah_detail(){
        cek_session_members();
		$id = array('id_penjualan_detail' => cetak($this->uri->segment(3)));
		$this->model_app->delete('rb_penjualan_detail',$id);
		redirect($this->uri->segment(1).'/tambah_penjualan');
	}

	function detail_konsumen(){
		cek_session_members();
		$id = cetak($this->uri->segment(3));
		$edit = $this->model_app->edit('rb_konsumen',array('id_konsumen'=>$id))->row_array();
		$data = array('rows' => $edit);
		$this->template->load(template().'/template',template().'/reseller/mod_konsumen/view_konsumen_detail',$data);
	}

	function pembayaran_konsumen(){
		cek_session_members();
		$data['record'] = $this->db->query("SELECT a.*, b.*, c.kode_transaksi, c.proses FROM `rb_konfirmasi_pembayaran_konsumen` a JOIN rb_rekening b ON a.id_rekening=b.id_rekening JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.id_penjual='".reseller($this->session->id_konsumen)."' AND c.status_penjual='reseller'");
		$this->template->load(template().'/template',template().'/reseller/mod_konsumen/view_konsumen_pembayaran',$data);
	}

	function download(){
		$name = cetak($this->uri->segment(3));
		$data = file_get_contents("asset/files/".$name);
		force_download($name, $data);
	}

	function keuangan(){
		cek_session_members();
		$id = reseller($this->session->id_konsumen);
		$record = $this->model_reseller->reseller_pembelian($id,'admin');
		$penjualan = $this->model_reseller->penjualan_list_konsumen($id,'reseller');
		$edit = $this->model_app->edit('rb_reseller',array('id_reseller'=>$id))->row_array();
		$reward = $this->model_app->view_ordering('rb_reward','id_reward','ASC');

		$data = array('rows' => $edit,'record'=>$record,'penjualan'=>$penjualan,'reward'=>$reward);
		if (isset($_GET['print'])){
			$this->load->view($this->uri->segment(1).'/mod_reseller/view_reseller_keuangan_print',$data);
		}else{
			$this->template->load(template().'/template',template().'/reseller/mod_reseller/view_reseller_keuangan',$data);
		}
	}

	function withdraw(){
		cek_session_members();
		$data['title'] = "Deposit dan Tarik Dana (Withdraw)";
		$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
		$data['record'] = $this->db->query("SELECT a.*, a.keterangan as keterangan_order, b.keterangan FROM rb_withdraw a LEFT JOIN rb_konsumen_detail b ON a.id_rekening_reseller=b.id_konsumen_detail where (a.id_reseller='".reseller($this->session->id_konsumen)."' AND a.akun='reseller') OR (a.id_reseller='".$this->session->id_konsumen."' AND a.akun='konsumen') ORDER BY a.id_withdraw DESC");
		$this->template->load(template().'/template',template().'/reseller/view_withdraw',$data);
	}

	function opini_publik(){
		cek_session_members();
		$data['title'] = "Opini Publik";
		$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
		$data['record'] = $this->db->query("SELECT a.* FROM berita a where a.username='".$data['row']['username']."' ORDER BY a.id_berita DESC");
		$this->template->load(template().'/template',template().'/reseller/view_opini_publik',$data);
	}

	function rekening_pilih(){
		cek_session_members();
		$jenis = $this->input->post('jenis');
		if ($jenis=='debit'){
			$rekening = $this->db->query("SELECT * FROM rb_konsumen_detail where id_konsumen='".$this->session->id_konsumen."' AND status='rekening'");
			if ($rekening->num_rows()=='0'){
				echo "<option value=''>Maaf, Anda Belum memiliki No Rekening</option>";
			}else{
				foreach ($rekening->result_array() as $row) {
					$ex = explode(';',$row['keterangan']);
					echo "<option value='$row[id_konsumen_detail]'>$ex[0], $ex[1], A/N : $ex[2]</option>";
				}
			}
		}else{
			$rekening = $this->db->query("SELECT * FROM rb_rekening");
			foreach ($rekening->result_array() as $row) {
				echo "<option value='$row[id_rekening]'>$row[nama_bank], $row[no_rekening], A/N : $row[pemilik_rekening]</option>";
			}
			if (config('ipaymu_aktif')=='Y'){
				echo "<option value='0'>Ipaymu (Payment Gateway)</option>";
			}
		}
	}

	function tambah_withdraw(){
		cek_session_members();
		verifikasi(reseller($this->session->id_konsumen));
		if (isset($_POST['submit'])){
			$id_reseller = $this->session->id_konsumen;
			$akun = 'konsumen';
			if (cetak($this->input->post('jenis'))=='debit'){
				$nominal = clean_rupiah(cetak($this->input->post('b')));
				if ($nominal>=config('withdraw_min')){
					if (saldo(reseller($this->session->id_konsumen),$this->session->id_konsumen)>=$nominal){
						if ($nominal>0){
							$data = array('id_rekening_reseller'=>cetak($this->input->post('a')),
								'id_reseller'=>$id_reseller,
								'nominal'=>$nominal,
								'withdraw_fee'=>config('withdraw_fee'),
								'status'=>'Pending',
								'akun'=>$akun,
								'transaksi'=>cetak($this->input->post('jenis')),
								'waktu_withdraw'=>date('Y-m-d H:i:s'));
							$this->model_app->insert('rb_withdraw',$data);
							notif_withdraw($nominal,$this->session->id_konsumen);
						}else{
							echo $this->session->set_flashdata('message', "<div class='alert alert-danger'><center><b>NOMINAL TIDAK VALID</b> - GAGAL Proses Penarikan dana..</center></div>");	
						}
					}else{
						echo $this->session->set_flashdata('message', "<div class='alert alert-danger'><center><b>SALDO TIDAK MENCUKUPI</b> - GAGAL Proses Penarikan dana..</center></div>");	
					}
				}else{
					echo $this->session->set_flashdata('message', "<div class='alert alert-danger'><center><b>GAGAL</b> - Minimal Proses Penarikan dana Rp ".rupiah(config('withdraw_min'))."..</center></div>");
				}
			}else{
				$nominal = clean_rupiah(cetak($this->input->post('b')))+rand(100,999);
				if (clean_rupiah(cetak($this->input->post('b')))>0){
					$data = array('id_rekening_reseller'=>cetak($this->input->post('a')),
							'id_reseller'=>$id_reseller,
							'nominal'=>$nominal,
							'withdraw_fee'=>0,
							'status'=>'Pending',
							'akun'=>$akun,
							'transaksi'=>cetak($this->input->post('jenis')),
							'waktu_withdraw'=>date('Y-m-d H:i:s'));
							$this->model_app->insert('rb_withdraw',$data);
					notif_deposit($nominal,$this->session->id_konsumen,cetak($this->input->post('a')));
				}else{
					echo $this->session->set_flashdata('message', "<div class='alert alert-danger'><center><b>NOMINAL TIDAK VALID</b> - GAGAL Proses Penarikan dana..</center></div>");	
				}
			}
			redirect($this->uri->segment(1).'/withdraw');
		}else{
			$data['title'] = "Buat Permintaan Tarik Dana (Withdraw)";
			$data['row'] = $this->model_reseller->profile_konsumen($this->session->id_konsumen)->row_array();
			$this->template->load(template().'/template',template().'/reseller/view_withdraw_tambah',$data);
		}
	}

	function upgrade(){
		cek_session_members();
		if (isset($_GET['paket'])){
			$rowp = $this->db->query("SELECT * FROM rb_reseller_paket a JOIN rb_paket b ON a.id_paket=b.id_paket where a.id_reseller='".reseller($this->session->id_konsumen)."'")->row_array();
			if ($rowp['status']=='Y'){
				$akhir  = strtotime($rowp['expire_date']); //Waktu awal
				$awal = time(); // Waktu sekarang atau akhir
				$diff  = $akhir - $awal;
				echo $this->session->set_flashdata('message', "<div class='alert alert-danger'><center>GAGAL Memilih Paket, Saat ini paket anda dalam status sudah aktif sampai ".tgl_indo($rowp['expire_date'])." (".floor($diff / (60 * 60 * 24)) ." hari lagi).</center></div>");	
				redirect($this->uri->segment(1).'/upgrade');
			}else{
				$cekp = $this->db->query("SELECT * FROM rb_reseller_paket where id_reseller='".reseller($this->session->id_konsumen)."' AND status='N'");
				$data = array('id_paket'=>cetak($this->input->get('paket')),
							'id_reseller'=>reseller($this->session->id_konsumen),
							'expire_date'=>date('Y-m-d'),
							'status'=>'N',
							'waktu_paket'=>date('Y-m-d H:i:s'));
				if ($cekp->num_rows()<='0'){
					$this->model_app->insert('rb_reseller_paket',$data);
				}else{
					$where = array('id_reseller' => reseller($this->session->id_konsumen),'status' => 'N');
					$this->model_app->update('rb_reseller_paket', $data, $where);
				}
			}
			redirect($this->uri->segment(1).'/upgrade');
		}else{
			$data['title'] = "Pilih Paket (Star Seller)";
			$data['record'] = $this->db->query("SELECT * FROM rb_paket ORDER BY id_paket");
			$this->template->load(template().'/template',template().'/reseller/mod_reseller/paket',$data);
		}
	}

	function edit_profil_toko(){
		cek_session_members();
		$id = reseller($this->session->id_konsumen);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gg');
			$hasil=$this->upload->data();

            if ($hasil['file_name']==''){
		           $data = array('nama_reseller'=>cetak($this->input->post('c')),
							'alamat_lengkap'=>cetak($this->input->post('e')),
							'keterangan'=>strip_tags($this->input->post('i')),
							'pilihan_kurir'=>cetak($this->input->post('pilihan_kurir')),
							'no_telpon'=>cetak($this->input->post('f')),
							'kecamatan_id'=>cetak($this->input->post('kecamatan_id')),
							'kota_id'=>cetak($this->input->post('kota_id')),
							'provinsi_id'=>cetak($this->input->post('provinsi_id')));
		    }else{
				$data = array('nama_reseller'=>cetak($this->input->post('c')),
							'alamat_lengkap'=>cetak($this->input->post('e')),
							'keterangan'=>strip_tags($this->input->post('i')),
							'pilihan_kurir'=>cetak($this->input->post('pilihan_kurir')),
							'no_telpon'=>cetak($this->input->post('f')),
							'foto'=>$hasil['file_name'],
							'kecamatan_id'=>cetak($this->input->post('kecamatan_id')),
							'kota_id'=>cetak($this->input->post('kota_id')),
							'provinsi_id'=>cetak($this->input->post('provinsi_id')));
		    }
			$where = array('id_reseller' => reseller($this->session->id_konsumen));
			$this->model_app->update('rb_reseller', $data, $where);
			redirect($this->uri->segment(1).'/profil_toko');
		}else{
			$title = "Edit Identitas Jualan / Penjual";
			$edit = $this->model_app->edit('rb_reseller',array('id_reseller'=>$id))->row_array();
			$data = array('rows' => $edit, 'title'=>$title);
			$this->template->load(template().'/template',template().'/reseller/mod_reseller/view_reseller_edit',$data);
		}
	}

	function buat_toko(){
		cek_session_members();
		$id = $this->session->id_konsumen;
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gg');
			$hasil=$this->upload->data();

			$ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
			$fv = explode('|',$ref['keterangan']);
			if ($fv[1]=='N'){ $verifikasi = 'Y'; }else{ $verifikasi = 'N'; }
			$ref = $this->db->query("SELECT referral_id FROM rb_konsumen where id_konsumen='".$this->session->id_konsumen."'")->row_array();
			
			$cek_user_exist = $this->db->query("SELECT user_reseller FROM rb_reseller where user_reseller='".seo_title($row['nama_reseller'])."'");
			if ($cek_user_exist->num_rows()>=1){ $user_reseller = seo_title(cetak($this->input->post('c'))).rand(100,999); }else{ $user_reseller = seo_title(cetak($this->input->post('c'))); }
			if ($hasil['file_name']==''){
				   $data = array('id_konsumen'=>cetak($id),
				   			'user_reseller'=>cetak($user_reseller),
				   			'nama_reseller'=>cetak($this->input->post('c')),
							'alamat_lengkap'=>cetak($this->input->post('e')),
							'keterangan'=>cetak($this->input->post('i')),
							'pilihan_kurir'=>cetak($this->input->post('pilihan_kurir')),
							'no_telpon'=>cetak($this->input->post('f')),
							'kecamatan_id'=>cetak($this->input->post('kecamatan_id')),
							'kota_id'=>cetak($this->input->post('kota_id')),
							'provinsi_id'=>cetak($this->input->post('provinsi_id')),
							'referral'=>$ref['referral_id'],
							'verifikasi'=>cetak($verifikasi),
							'tanggal_daftar'=>date('Y-m-d H:i:s'));
		    }else{
				$data = array('id_konsumen'=>cetak($id),
							'user_reseller'=>cetak($user_reseller),
							'nama_reseller'=>cetak($this->input->post('c')),
							'alamat_lengkap'=>cetak($this->input->post('e')),
							'keterangan'=>cetak($this->input->post('i')),
							'pilihan_kurir'=>cetak($this->input->post('pilihan_kurir')),
							'no_telpon'=>cetak($this->input->post('f')),
							'foto'=>$hasil['file_name'],
							'kecamatan_id'=>cetak($this->input->post('kecamatan_id')),
							'kota_id'=>cetak($this->input->post('kota_id')),
							'provinsi_id'=>cetak($this->input->post('provinsi_id')),
							'referral'=>$ref['referral_id'],
							'verifikasi'=>cetak($verifikasi),
							'tanggal_daftar'=>date('Y-m-d H:i:s'));
		    }
			$this->model_app->insert('rb_reseller',$data);
			redirect($this->uri->segment(1).'/profil_toko');
		}else{
			$title = "Buat Jualan / Penjual";
			$data = array('title'=>$title);
			$this->template->load(template().'/template',template().'/reseller/mod_reseller/view_reseller_tambah',$data);
		}
	}

	function profil_toko(){
		cek_session_members();
		$id = reseller($this->session->id_konsumen);
		$title = "Identitas Jualan / Penjual";
		$edit = $this->model_app->edit('rb_reseller',array('id_reseller'=>$id))->row_array();
		$data = array('rows' => $edit, 'title'=>$title);
		$this->template->load(template().'/template',template().'/reseller/mod_reseller/view_reseller_detail',$data);
	}

	function detail_keuangan(){
		cek_session_members();
		if (isset($_POST['upload'])){
            $config['upload_path'] = 'asset/bukti_transfer/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('bukti');
            $hasil=$this->upload->data();
            $this->model_app->update('rb_withdraw', array('keterangan'=>$hasil['file_name']),array('id_withdraw'=>$this->input->post('id'),'id_reseller'=>$this->session->id_konsumen));
			redirect('members/withdraw');
		}else{
			$data['row'] = $this->db->query("SELECT a.*, b.keterangan as ket FROM rb_withdraw a LEFT JOIN rb_konsumen_detail b ON a.id_rekening_reseller=b.id_konsumen_detail where id_withdraw ='".cetak($this->input->post('id'))."'")->row_array();
			$this->load->view(template().'/reseller/view_withdraw_detail',$data);
		}
	}
	
	function delete_produk(){
        cek_session_members();
        $id = array('id_produk' => $this->uri->segment(3));
        $row = $this->db->query("SELECT * FROM rb_produk where id_produk='".$this->uri->segment(3)."'")->row_array();
        $ex = explode(';',$row['gambar']);
        for($i=0; $i<count($ex); $i++){
            unlink('asset/foto_produk/'.$ex[$i]);
        }
        $this->model_app->delete('rb_produk',$id);
        redirect('members/produk');
    }
}
