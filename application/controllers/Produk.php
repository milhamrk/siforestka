<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Produk extends CI_Controller {
	function index(){
		if (isset($_GET['s'])){
			$darii = (int)clean_rupiah(cetak($this->input->get('dari')));
			$sampaii = (int)clean_rupiah(cetak($this->input->get('sampai')));
			$provinsi = (int)clean_rupiah(cetak($this->input->get('provinsi')));
			$kota = (int)clean_rupiah(cetak($this->input->get('kota')));
			$kecamatan = (int)clean_rupiah(cetak($this->input->get('kecamatan')));
			if (cetak($_GET['s'])=='group'){
				if (isset($_POST['submit'])){
					$jumlah= $this->model_reseller->cari_produk_group(cetak($this->input->get('s')),cetak($this->input->get('f')),$darii,$sampaii,$dari,0,$provinsi,$kota,$kecamatan)->num_rows();
				}else{
					$jumlah= $this->model_reseller->cari_produk_group(cetak($this->input->get('s')),cetak($this->input->get('f')),$darii,$sampaii,$dari,0,$provinsi,$kota,$kecamatan)->num_rows();
				}
			}else{
				$jumlah= $this->model_reseller->cari_produk(cetak($this->input->get('s')),cetak($this->input->get('f')),$darii,$sampaii,$dari,0,$provinsi,$kota,$kecamatan)->num_rows();
			}
		}else{
			$jumlah= $this->db->query("SELECT a.* FROM rb_produk a where a.id_reseller!='0' AND a.id_produk_perusahaan='0' AND a.aktif='Y'")->num_rows();
		}
		
		$data['jumlah'] = $jumlah;
		$config['base_url'] = base_url().'produk/index';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 12; 	

		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
			$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
			
		if ($this->uri->segment('3')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('3');
		}


		if (is_numeric($dari)) {
			if (isset($_GET['s'])){
				$data['description'] = description();
				$data['keywords'] = keywords();
				if (cetak($_GET['s'])=='group'){
					$data['title'] = "Produk - Group Order";
					if (isset($_POST['submit'])){
						$data['record'] = $this->model_reseller->cari_produk_kode_group(cetak($this->input->get('s')),cetak($this->input->get('f')),$darii,$sampaii,$dari,$config['per_page'],$provinsi,$kota,$kecamatan,cetak($this->input->post('group')));
					}else{
						$data['record'] = $this->model_reseller->cari_produk_group(cetak($this->input->get('s')),cetak($this->input->get('f')),$darii,$sampaii,$dari,$config['per_page'],$provinsi,$kota,$kecamatan);
					}
				}else{
					$data['title'] = "Pencarian Produk";
					$data['record'] = $this->model_reseller->cari_produk(cetak($this->input->get('s')),cetak($this->input->get('f')),$darii,$sampaii,$dari,$config['per_page'],$provinsi,$kota,$kecamatan);
				}
				$data['rekomendasi'] = $this->model_reseller->cari_produk_rekomendasi(cetak($this->input->get('s')),cetak($this->input->get('f')));
			}else{
				$data['title'] = title();
				$data['judul'] = 'Semua Produk Kami';
				$data['record'] = $this->db->query("SELECT a.*, b.nama_reseller, c.nama_kota FROM rb_produk a LEFT JOIN rb_reseller b ON a.id_reseller=b.id_reseller
									LEFT JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_reseller!='0' AND a.aktif='Y' ORDER BY a.id_produk DESC LIMIT $dari,$config[per_page]");
			}
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/reseller/view_produk',$data);
		}else{
			redirect('main');
		}
	}


	function perusahaan(){
		if (reseller($this->session->id_konsumen)==''){
			echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, halaman tersebut khusus untuk Penjual/Pelapak,..</center></div>');
			redirect('main');
		}else{
			if ($this->input->post('kata')){
				if (cetak($this->input->post('filter'))=='0'){
					$jumlah= $this->db->query("SELECT a.* FROM rb_produk a where a.id_reseller='0' AND a.id_produk_perusahaan='0' AND a.aktif='Y' AND a.nama_produk LIKE '%".cetak($this->input->post('kata'))."%'")->num_rows();
				}else{
					$exp = explode('|',cetak($this->input->post('filter')));
					if ($exp[0]=='kategori'){
						$jumlah= $this->db->query("SELECT a.* FROM rb_produk a where a.id_reseller='0' AND a.id_produk_perusahaan='0' AND a.aktif='Y' AND a.id_kategori_produk='".$exp[1]."' AND a.nama_produk LIKE '%".cetak($this->input->post('kata'))."%'")->num_rows();
					}else{
						$jumlah= $this->db->query("SELECT a.* FROM rb_produk a where a.id_reseller='0' AND a.id_produk_perusahaan='0' AND a.aktif='Y' AND a.id_kategori_produk_sub='".$exp[1]."' AND a.nama_produk LIKE '%".cetak($this->input->post('kata'))."%'")->num_rows();
					}
				}
			}else{
				$jumlah= $this->db->query("SELECT a.* FROM rb_produk a where a.id_reseller='0' AND a.id_produk_perusahaan='0' AND a.aktif='Y'")->num_rows();
			}
			
			
			$config['base_url'] = base_url().'produk/perusahaan';
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 12; 	
			if ($this->uri->segment('3')==''){
				$dari = 0;
			}else{
				$dari = $this->uri->segment('3');
			}

			if (is_numeric($dari)) {
				if (isset($_POST['kata'])){
					$data['title'] = "Pencarian - ''".cetak($this->input->post('kata'))."''";
					$data['description'] = description();
					$data['keywords'] = keywords();
					$data['record'] = $this->model_reseller->cari_produk(cetak($this->input->post('kata')),cetak($this->input->post('filter')));
					$data['rekomendasi'] = $this->model_reseller->cari_produk_rekomendasi(cetak($this->input->post('kata')),cetak($this->input->post('filter')));
				}else{
					$data['description'] = description();
					$data['keywords'] = keywords();
					$this->pagination->initialize($config);

					if (isset($_POST['cari'])){
						$dari = clean_rupiah(cetak($this->input->post('dari')));
						$sampai = clean_rupiah(cetak($this->input->post('sampai')));
						$data['title'] = "Produk Harga ".rupiah($dari)." - ".rupiah($sampai);
						$data['judul'] = "Harga ".rupiah($dari)." - ".rupiah($sampai);
						$data['record'] = $this->db->query("SELECT a.*, b.nama_reseller, c.nama_kota, z.diskon FROM rb_produk_diskon z JOIN rb_produk a ON z.id_produk=a.id_produk LEFT JOIN rb_reseller b ON a.id_reseller=b.id_reseller
											LEFT JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_reseller='0' AND a.id_produk_perusahaan='0' AND a.aktif='Y' AND (a.harga_konsumen-z.diskon) BETWEEN $dari AND $sampai ORDER BY a.id_produk DESC LIMIT 0,24");
					}else{
						$data['title'] = title();
						$data['judul'] = 'Semua Produk Perusahaan';
						$data['record'] = $this->db->query("SELECT a.*, b.nama_reseller, c.nama_kota FROM rb_produk a LEFT JOIN rb_reseller b ON a.id_reseller=b.id_reseller
											LEFT JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_reseller='0' AND a.id_produk_perusahaan='0' AND a.aktif='Y' ORDER BY a.id_produk DESC LIMIT $dari,$config[per_page]");
					}
				}

				$this->template->load(template().'/template',template().'/reseller/view_produk_perusahaan',$data);
			}else{
				redirect('main');
			}
		}
	}

	function kategori(){
		$cek = $this->model_app->edit('rb_kategori_produk',array('kategori_seo'=>$this->uri->segment(3)))->row_array();
		$jumlah= $this->model_app->view_where('rb_produk',array('id_kategori_produk'=>$cek['id_kategori_produk']))->num_rows();
		$config['base_url'] = base_url().'produk/kategori/'.$this->uri->segment(3);
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 18; 	
		if ($this->uri->segment('4')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('4');
		}

		if (is_numeric($dari)) {
			$data['title'] = "Kategori / $cek[nama_kategori]";
			$data['judul'] = "Kategori / $cek[nama_kategori]";
			if ($cek['mkolom']=='' OR $cek['mkolom']=='0'){
				$data['kolom'] = "6";
			}else{
				$data['kolom'] = $cek['mkolom'];
			}
			$data['description'] = description();
			$data['keywords'] = keywords();
			$this->pagination->initialize($config);
			$data['record'] = $this->db->query("SELECT a.*, b.nama_reseller, c.nama_kota FROM rb_produk a LEFT JOIN rb_reseller b ON a.id_reseller=b.id_reseller
                                    LEFT JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_reseller!='0' AND a.id_produk_perusahaan='0' AND a.id_kategori_produk='$cek[id_kategori_produk]' AND a.aktif='Y' ORDER BY a.id_produk DESC LIMIT $dari,$config[per_page]");
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/reseller/view_kategori_all',$data);
		}else{
			redirect('main');
		}
	}

	function subkategori(){
		$cek = $this->model_app->edit('rb_kategori_produk_sub',array('kategori_seo_sub'=>$this->uri->segment(3)))->row_array();
		
		$jumlah= $this->model_app->view_where('rb_produk',array('id_kategori_produk_sub'=>$cek['id_kategori_produk_sub']))->num_rows();
		$config['base_url'] = base_url().'produk/subkategori/'.$this->uri->segment(3);
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 12; 	
		if ($this->uri->segment('4')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('4');
		}

		if (is_numeric($dari)) {
			$data['title'] = "Subkategori / $cek[nama_kategori_sub]";
			$data['judul'] = "Subkategori / $cek[nama_kategori_sub]";
			if ($cek['mkolom_sub']=='' OR $cek['mkolom_sub']=='0'){
				$data['kolom'] = "6";
			}else{
				$data['kolom'] = $cek['mkolom_sub'];
			}
			$data['description'] = description();
			$data['keywords'] = keywords();
			$this->pagination->initialize($config);
			$data['record'] = $this->db->query("SELECT a.*, b.nama_reseller, c.nama_kota FROM rb_produk a LEFT JOIN rb_reseller b ON a.id_reseller=b.id_reseller
                                    LEFT JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_reseller!='0' AND a.id_produk_perusahaan='0' AND a.id_kategori_produk_sub='$cek[id_kategori_produk_sub]' AND a.aktif='Y' ORDER BY a.id_produk DESC LIMIT $dari,$config[per_page]");
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/reseller/view_kategori_all',$data);
		}else{
			redirect('main');
		}
	}


	function reseller(){
		if (config('mode')=='marketplace'){
			$jumlah= $this->model_app->view('rb_reseller')->num_rows();
			$config['base_url'] = base_url().'produk/reseller';
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 15; 	
			if ($this->uri->segment('3')==''){
				$dari = 0;
			}else{
				$dari = $this->uri->segment('3');
			}

			if (is_numeric($dari)) {
				$data['title'] = 'Semua Daftar Pelapak';
				$data['description'] = description();
				$data['keywords'] = keywords();
				$this->pagination->initialize($config);
				if (isset($_POST['submit'])){
					$data['record'] = $this->model_reseller->cari_reseller(filter($this->input->post('cari_reseller')));
				}elseif (isset($_GET['cari_reseller'])){
					$data['record'] = $this->model_reseller->cari_reseller(filter($this->input->get('cari_reseller')));
				}else{
					$data['record'] = $this->db->query("SELECT * FROM rb_reseller a LEFT JOIN rb_kota b ON a.kota_id=b.kota_id ORDER BY id_reseller DESC LIMIT $dari,$config[per_page]");
				}
				$this->template->load(template().'/template',template().'/reseller/view_reseller',$data);
			}else{
				redirect('main');
			}
		}else{
			echo "Maaf, Akses untuk Halaman ini ditutup...";
		}
	}

	

	function detail_reseller(){
		$data['title'] = 'Detail Profile Penjual';
		$data['description'] = description();
		$data['keywords'] = keywords();
		$id = $this->uri->segment(3);
		$data['rows'] = $this->model_app->edit('rb_reseller',array('id_reseller'=>$id))->row_array();
		$data['record'] = $this->model_reseller->penjualan_list_konsumen($id,'reseller');
		$data['rekening'] = $this->model_app->view_where('rb_rekening_reseller',array('id_reseller'=>$id));
		$this->template->load(template().'/template',template().'/reseller/view_reseller_detail',$data);
	}


	function produk_reseller(){
		$query = $this->db->query("SELECT id_reseller FROM rb_reseller where user_reseller='".cetak($this->uri->segment(2))."'");
		if ($query->num_rows()<=0){
			redirect('produk');
		}

		$row = $query->row_array();
		$id = cetak($row['id_reseller']);
		$jumlah= $this->model_app->view_where('rb_produk',array('id_reseller'=>$id))->num_rows();
		$config['base_url'] = base_url().'produk/produk_reseller/'.$this->uri->segment('3');
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 4; 	
		if ($this->uri->segment('4')==''){
			$dari = 0;
		}else{
			$dari = $this->uri->segment('4');
		}

		if (is_numeric($dari)) {
			$data['title'] = 'Data Produk Penjual';
			$data['description'] = description();
			$data['keywords'] = keywords();
			$data['rows'] = $this->db->query("SELECT a.*, b.nama_kota FROM rb_reseller a JOIN rb_kota b ON a.kota_id=b.kota_id where a.id_reseller='$id'")->row_array();
			$data['record'] = $this->model_app->view_where_ordering('rb_produk',array('id_reseller'=>$id,'aktif'=>'Y'),'id_produk','DESC');
			$data['record_hitung'] = $this->model_app->view_where('rb_produk',array('id_reseller'=>$id,'aktif'=>'Y'));
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/reseller/view_reseller_produk',$data);
		}else{
			redirect('main');
		}
	}

	function reseller_cari_produk(){
		$keyword = cetak($this->input->post('query'));
		$data['record'] = $this->db->query("SELECT * FROM rb_produk where id_reseller='".cetak($this->input->post('id'))."' AND nama_produk LIKE '%$keyword%'");
		$this->load->view(template().'/reseller/view_reseller_produk_cari',$data);
	}

	function keranjang(){
		$ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
		$fv = explode('|',$ref['keterangan']);

		$id_reseller = cetak($this->uri->segment(3));
		if ($this->session->id_konsumen!=''){
			$cek_penjual = $this->db->query("SELECT id_konsumen, user_reseller FROM rb_reseller where id_reseller='$id_reseller'")->row_array();
			if ($cek_penjual['id_konsumen']==$this->session->id_konsumen){
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center><b>Woiii</b> - Jangan Belanja diLapak Sendiri!</center></div>');
				redirect('u/'.$cek_penjual['user_reseller']);
			}
		}
		
		$id_produk   = cetak($this->uri->segment(4));
		$j = $this->model_reseller->jual_reseller($id_reseller,$id_produk)->row_array();
        $b = $this->model_reseller->beli_reseller($id_reseller,$id_produk)->row_array();
		$stok = $b['beli']-$j['jual'];

		$cek_minimum = $this->db->query("SELECT nama_produk, minimum, satuan FROM rb_produk where id_produk='$id_produk'")->row_array();
		if ($cek_minimum['minimum']<=cetak($this->input->post('qty'))){
			$qty = $this->input->post('qty');
		}else{
			echo $this->session->set_flashdata('message', '<div class="alert alert-info"><center><b>PENTING</b> - Minimal Order untuk <b>'.$cek_minimum['nama_produk'].'</b> adalah '.$cek_minimum['minimum'].' '.$cek_minimum['satuan'].'</center></div>');
			$qty = $cek_minimum['minimum'];
		}
		
		if (isset($_POST['update'])){
			$i = 1;
			$keranjang = $this->db->query("SELECT * FROM rb_penjualan_temp where session='".$this->session->idp."' GROUP BY id_produk ORDER BY id_penjualan_detail ASC");
			foreach ($keranjang->result_array() as $row){
				
				$exs = explode('||',$row['keterangan_order']);
				if (count($exs)=='1'){
					if (cetak($this->input->post('keterangan'.$i))==''){
						$variasi_simpan = $row['keterangan_order'];
					}else{
						$variasi_simpan = cetak($this->input->post('keterangan'.$i)).'||'.$row['keterangan_order'];
					}
				}else{
					$variasi_simpan = cetak($this->input->post('keterangan'.$i)).'||'.$exs[1];
				}

				$cek_minimumx = $this->db->query("SELECT id_reseller, nama_produk, minimum, satuan FROM rb_produk where id_produk='".cetak($this->input->post('idp'.$i))."'")->row_array();
				if ($cek_minimumx['minimum']<=cetak($this->input->post('qty'.$i))){
					$qtyx = cetak($this->input->post('qty'.$i));
				}else{
					$qtyx = $cek_minimumx['minimum'];
				}

				if (stok($cek_minimumx['id_reseller'],cetak($this->input->post('idp'.$i)))>=$qtyx){
					$qtyx_set = $qtyx;
				}else{
					$qtyx_set = stok($cek_minimumx['id_reseller'],cetak($this->input->post('idp'.$i)));
				}

				$dataa = array('jumlah'=>$qtyx_set,
							  'keterangan_order'=>$variasi_simpan);
                $wheree = array('id_penjualan_detail' => cetak($this->input->post('id'.$i)));
				$this->model_app->update('rb_penjualan_temp',$dataa,$wheree);
				$i++;
			}
			redirect('produk/checkouts');
		}

		if ($id_produk!=''){
			if ($stok < $qty){
				$produk = $this->model_app->edit('rb_produk',array('id_produk'=>$id_produk))->row_array();
				$produk_cek = filter($produk['nama_produk']);
				echo "<script>window.alert('Maaf, Stok untuk Produk $produk_cek pada Pelapak ini telah habis, silahkan menunggu atau order dengan pelapak lain!');
                                  window.location=('".base_url()."/produk/produk_reseller/$id_reseller')</script>";
			}else{
				
				$this->session->unset_userdata('produk');
				if ($this->session->idp == ''){
					if ($this->session->id_konsumen!=''){ $idp = $this->session->id_konsumen; }else{ $idp = date('YmdHis'); }
					$this->session->set_userdata(array('idp'=>$idp,'reseller'=>$id_reseller));
				}

				$reseller_cek = $this->db->query("SELECT b.id_reseller FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where session='".$this->session->idp."' AND b.id_reseller!='$id_reseller' GROUP BY b.id_reseller");
				if ($reseller_cek->num_rows()<'3'){
					$cek = $this->model_app->view_where('rb_penjualan_temp',array('session'=>$this->session->idp,'id_produk'=>$id_produk))->num_rows();
					if ($cek >=1){
						$this->db->query("UPDATE rb_penjualan_temp SET jumlah=jumlah+$qty where session='".$this->session->idp."' AND id_produk='$id_produk'");
					}else{
						$harga = $this->model_app->view_where('rb_produk',array('id_produk'=>$id_produk))->row_array();
						$disk = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$id_produk,'id_reseller'=>$id_reseller))->row_array();
						
						if ($disk['diskon']==''){ $diskon = 0; }else{ $diskon = $disk['diskon']; }
						
						$var1 = cetak($this->input->post('variasi_1'));
						$var2 = cetak($this->input->post('variasi_2'));
						$var3 = cetak($this->input->post('variasi_3'));
						$keterangan_order = ($var1 != '' ? $var1.'; ' : '').($var2 != '' ? $var2.'; ' : '').($var3 != '' ? $var3.'; ' : '');

						if (cetak($this->input->post('group'))!=''){
							$cgroup = $this->db->query("SELECT * FROM rb_produk_group where id_produk='$id_produk' AND id_group='".cetak($this->input->post('group'))."'");
                                if ($cgroup->num_rows()>=1){
                                    $cg = $cgroup->row_array();
									$harga_konsumen = $cg['harga_group'];
									if ($this->session->group_sesi==''){
										if (cetak($this->input->post('kgroup'))!=''){
											$this->session->set_userdata(array('group_sesi'=>cetak($this->input->post('kgroup'))));
										}else{
											$this->session->set_userdata(array('group_sesi'=>$cg['id_group'].'.'.$cg['jumlah_group'].'.'.date('His')));
										}
									}
								}else{
									$harga_konsumen = $harga['harga_konsumen'];
								}
						}else{
							$harga_konsumen = $harga['harga_konsumen'];
						}

						$data = array('session'=>$this->session->idp,
					        		  'id_produk'=>$id_produk,
									  'jumlah'=>$qty,
					        		  'diskon'=>$diskon,
					        		  'harga_jual'=>$harga_konsumen,
					        		  'satuan'=>$harga['satuan'],
									  'keterangan_order'=>$keterangan_order,
					        		  'waktu_order'=>date('Y-m-d H:i:s'));
						$this->model_app->insert('rb_penjualan_temp',$data);
					}

					$ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
					$fv = explode('|',$ref['keterangan']);

					
						if (isset($_POST['keranjang'])){
							$prd = $this->db->query("SELECT * FROM rb_produk where id_produk='$id_produk'")->row_array();
							echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Berhasil ditambahkan ke Keranjang Belanja,..</center></div>');
							redirect('produk/detail/'.$prd['produk_seo']);
						}else{
							redirect('produk/keranjang');
						}
					
					
				}else{
					if ($this->session->idp != ''){
						$data['rows'] = $this->model_app->edit('rb_reseller',array('id_reseller'=>$this->session->reseller))->row_array();
						$data['record'] = $this->model_app->view_join_where('rb_penjualan_temp','rb_produk','id_produk',array('session'=>$this->session->idp),'id_penjualan_detail','ASC');
					}
					$data['title'] = 'Keranjang Belanja';
					$data['description'] = description();
					$data['keywords'] = keywords();
					echo $this->session->set_flashdata('message', '<div class="alert alert-info"><center>Ingat, 1 Transaksi maksimal ke 3 Lapak saja,..</center></div>');
					redirect('produk/keranjang');
				}
			}
		}else{
			if ($this->session->idp != ''){
				$data['rows'] = $this->model_app->edit('rb_reseller',array('id_reseller'=>$this->session->reseller))->row_array();
				$data['total'] = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.session='".$this->session->idp."'")->row_array();
				$data['record'] = $this->db->query("SELECT a.*, b.*, c.nama_reseller FROM rb_penjualan_temp a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_reseller c ON b.id_reseller=c.id_reseller where a.session='".$this->session->idp."' ORDER BY id_penjualan_detail ASC");
				$this->model_app->view_join_where('rb_penjualan_temp','rb_produk','id_produk',array('session'=>$this->session->idp),'id_penjualan_detail','ASC');
			}
			
				$data['title'] = 'Keranjang Belanja';
				$this->template->load(template().'/template',template().'/reseller/view_keranjang',$data);
			
		}
	}
	
	// keranjang jasling ---------------------------------------------------------------------------
	
	function keranjang_jasling(){
		$ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
		$fv = explode('|',$ref['keterangan']);

		$id_reseller = cetak($this->uri->segment(3));
		if ($this->session->id_konsumen!=''){
			$cek_penjual = $this->db->query("SELECT id_konsumen, user_reseller FROM rb_reseller where id_reseller='$id_reseller'")->row_array();
			if ($cek_penjual['id_konsumen']==$this->session->id_konsumen){
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center><b>Woiii</b> - Jangan Belanja diLapak Sendiri!</center></div>');
				redirect('u/'.$cek_penjual['user_reseller']);
			}
		}
		
		$id_produk   = cetak($this->uri->segment(4));
		$j = $this->model_reseller->jual_reseller($id_reseller,$id_produk)->row_array();
        $b = $this->model_reseller->beli_reseller($id_reseller,$id_produk)->row_array();
		$stok = $b['beli']-$j['jual'];

		$cek_minimum = $this->db->query("SELECT nama_produk, minimum, satuan FROM rb_produk where id_produk='$id_produk'")->row_array();
		if ($cek_minimum['minimum']<=cetak($this->input->post('qty'))){
			$qty = $this->input->post('qty');
		}else{
			echo $this->session->set_flashdata('message', '<div class="alert alert-info"><center><b>PENTING</b> - Minimal Order untuk <b>'.$cek_minimum['nama_produk'].'</b> adalah '.$cek_minimum['minimum'].' '.$cek_minimum['satuan'].'</center></div>');
			$qty = $cek_minimum['minimum'];
		}
		
		if (isset($_POST['update'])){
			$i = 1;
			$keranjang = $this->db->query("SELECT * FROM rb_penjualan_temp where session='".$this->session->idp."' GROUP BY id_produk ORDER BY id_penjualan_detail ASC");
			
			foreach ($keranjang->result_array() as $row){
				
				$exs = explode('||',$row['keterangan_order']);
				
				if (count($exs)=='1'){
					if (cetak($this->input->post('keterangan'.$i))==''){
						$variasi_simpan = $row['keterangan_order'];
					}else{
						$variasi_simpan = cetak($this->input->post('keterangan'.$i)).'||'.$row['keterangan_order'];
					}
				}else{
					$variasi_simpan = cetak($this->input->post('keterangan'.$i)).'||'.$exs[1];
				}

				$cek_minimumx = $this->db->query("SELECT id_reseller, nama_produk, minimum, satuan FROM rb_produk where id_produk='".cetak($this->input->post('idp'.$i))."'")->row_array();
				if ($cek_minimumx['minimum']<=cetak($this->input->post('qty'.$i))){
					$qtyx = cetak($this->input->post('qty'.$i));
				}else{
					$qtyx = $cek_minimumx['minimum'];
				}

				if (stok($cek_minimumx['id_reseller'],cetak($this->input->post('idp'.$i)))>=$qtyx){
					$qtyx_set = $qtyx;
				}else{
					$qtyx_set = stok($cek_minimumx['id_reseller'],cetak($this->input->post('idp'.$i)));
				}

				$dataa = array('jumlah'=>$qtyx_set,
							  'keterangan_order'=>$variasi_simpan);
                $wheree = array('id_penjualan_detail' => cetak($this->input->post('id'.$i)));
				$this->model_app->update('rb_penjualan_temp',$dataa,$wheree);
				$i++;
			}
			redirect('produk/print_checkouts');
		}

		if ($id_produk!=''){
			if ($stok < $qty){
				$produk = $this->model_app->edit('rb_produk',array('id_produk'=>$id_produk))->row_array();
				$produk_cek = filter($produk['nama_produk']);
				echo "<script>window.alert('Maaf, Stok untuk Produk $produk_cek pada Pelapak ini telah habis, silahkan menunggu atau order dengan pelapak lain!');
                                  window.location=('".base_url()."/produk/produk_reseller/$id_reseller')</script>";
			}else{
				$this->session->unset_userdata('produk');
				if ($this->session->idp == ''){
					if ($this->session->id_konsumen!=''){ $idp = $this->session->id_konsumen; }else{ $idp = date('YmdHis'); }
					$this->session->set_userdata(array('idp'=>$idp,'reseller'=>$id_reseller));
				}

				$reseller_cek = $this->db->query("SELECT b.id_reseller FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where session='".$this->session->idp."' AND b.id_reseller!='$id_reseller' GROUP BY b.id_reseller");
				if ($reseller_cek->num_rows()<'3'){
					$cek = $this->model_app->view_where('rb_penjualan_temp',array('session'=>$this->session->idp,'id_produk'=>$id_produk))->num_rows();
					if ($cek >=1){
						$this->db->query("UPDATE rb_penjualan_temp SET jumlah=jumlah+$qty where session='".$this->session->idp."' AND id_produk='$id_produk'");
					}else{
						$harga = $this->model_app->view_where('rb_produk',array('id_produk'=>$id_produk))->row_array();
						$disk = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$id_produk,'id_reseller'=>$id_reseller))->row_array();
						if ($disk['diskon']==''){ $diskon = 0; }else{ $diskon = $disk['diskon']; }
						
						$var1 = cetak($this->input->post('variasi_1'));
						$var2 = cetak($this->input->post('variasi_2'));
						$var3 = cetak($this->input->post('variasi_3'));
						$keterangan_order = ($var1 != '' ? $var1.'; ' : '').($var2 != '' ? $var2.'; ' : '').($var3 != '' ? $var3.'; ' : '');

						if (cetak($this->input->post('group'))!=''){
							$cgroup = $this->db->query("SELECT * FROM rb_produk_group where id_produk='$id_produk' AND id_group='".cetak($this->input->post('group'))."'");
                                if ($cgroup->num_rows()>=1){
                                    $cg = $cgroup->row_array();
									$harga_konsumen = $cg['harga_group'];
									if ($this->session->group_sesi==''){
										if (cetak($this->input->post('kgroup'))!=''){
											$this->session->set_userdata(array('group_sesi'=>cetak($this->input->post('kgroup'))));
										}else{
											$this->session->set_userdata(array('group_sesi'=>$cg['id_group'].'.'.$cg['jumlah_group'].'.'.date('His')));
										}
									}
								}else{
									$harga_konsumen = $harga['harga_konsumen'];
								}
						}else{
							$harga_konsumen = $harga['harga_konsumen'];
						}

						$data = array('session'=>$this->session->idp,
					        		  'id_produk'=>$id_produk,
					        		  'jumlah'=>$qty,
					        		  'diskon'=>$diskon,
					        		  'harga_jual'=>$harga_konsumen,
					        		  'satuan'=>$harga['satuan'],
									  'keterangan_order'=>$keterangan_order,
					        		  'waktu_order'=>date('Y-m-d H:i:s'));
						$this->model_app->insert('rb_penjualan_temp',$data);
					}

					$ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
					$fv = explode('|',$ref['keterangan']);

					
						if (isset($_POST['keranjang'])){
							$prd = $this->db->query("SELECT * FROM rb_produk where id_produk='$id_produk'")->row_array();
							echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Berhasil ditambahkan ke Keranjang Belanja,..</center></div>');
							redirect('produk/detail/'.$prd['produk_seo']);
						}else{
							redirect('produk/keranjang_jasling');
						}
					
					
				}else{
					if ($this->session->idp != ''){
						$data['rows'] = $this->model_app->edit('rb_reseller',array('id_reseller'=>$this->session->reseller))->row_array();
						$data['record'] = $this->model_app->view_join_where('rb_penjualan_temp','rb_produk','id_produk',array('session'=>$this->session->idp),'id_penjualan_detail','ASC');
					}
					$data['title'] = 'Keranjang Belanja';
					$data['description'] = description();
					$data['keywords'] = keywords();
					echo $this->session->set_flashdata('message', '<div class="alert alert-info"><center>Ingat, 1 Transaksi maksimal ke 3 Lapak saja,..</center></div>');
					redirect('produk/keranjang_jasling');
				}
			}
		}else{
			if ($this->session->idp != ''){
				$data['rows'] = $this->model_app->edit('rb_reseller',array('id_reseller'=>$this->session->reseller))->row_array();
				$data['total'] = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.session='".$this->session->idp."'")->row_array();
				$data['record'] = $this->db->query("SELECT a.*, b.*, c.nama_reseller FROM rb_penjualan_temp a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_reseller c ON b.id_reseller=c.id_reseller where a.session='".$this->session->idp."' ORDER BY id_penjualan_detail ASC");
				$this->model_app->view_join_where('rb_penjualan_temp','rb_produk','id_produk',array('session'=>$this->session->idp),'id_penjualan_detail','ASC');
			}
		
		$jumlah_item = $this->db->query("SELECT * FROM rb_penjualan_temp where session='".$this->session->idp."' GROUP BY id_produk ORDER BY id_penjualan_detail ASC");
		$hasil = $jumlah_item->num_rows();
		
		if ($hasil !=1){
			echo "<script>window.alert('Maaf, untuk pembelian produk Jasling / Tiket tidak boleh digabung dengan produk lain, silahkan order kembali!');
                                  window.location=('".base_url()."/produk/produk_reseller/$id_reseller')</script>";
		}else{
		
			$data['title'] = 'Belanja Tiket';
			$this->template->load(template().'/template',template().'/reseller/view_keranjang_jasling',$data);
			
	}	}
	}
	
	
	// end keranjang jasling -----------------------------------------------------------------------
	

	function keranjang_delete(){
		$id = array('id_penjualan_detail' => $this->uri->segment(3));
		$this->model_app->delete('rb_penjualan_temp',$id);
		$isi_keranjang = $this->db->query("SELECT sum(jumlah) as jumlah FROM rb_penjualan_temp where session='".$this->session->idp."'")->row_array();
		if ($isi_keranjang['jumlah']==''){
			$this->session->unset_userdata('idp');
			$this->session->unset_userdata('reseller');
		}
		redirect('produk/keranjang');
	}

	function kurirdata(){
		$iden = $this->model_reseller->penjualan_konsumen_detail($this->session->idp)->row_array();
		$this->load->library('rajaongkir');
		$tujuan=cetak($this->input->get('kota'));
		$dari=$iden['kota_id'];
		$berat=cetak($this->input->get('berat'));
		$kurir=cetak($this->input->get('kurir'));
		$dc=$this->rajaongkir->cost($dari,$tujuan,$berat,$kurir);
		$d=json_decode($dc,TRUE);
		$o='';
		if(!empty($d['rajaongkir']['results'])){
			$data['data']=$d['rajaongkir']['results'][0]['costs'];
			$this->load->view(template().'/reseller/kurirdata',$data);			
		}else{
			$data['ongkir'] = 0;
			$this->load->view(template().'/reseller/kurirdata',$data);	
		}
	}

	function kurirdata_non(){
		$this->load->library('rajaongkir');
		$tujuan=cetak($this->input->get('kota'));
		$dari=cetak($this->input->get('tujuan'));
		$berat=cetak($this->input->get('berat'));
		$kurir=cetak($this->input->get('kurir'));
		$dc=$this->rajaongkir->cost($dari,$tujuan,$berat,$kurir);
		$d=json_decode($dc,TRUE);
		$o='';
		if(!empty($d['rajaongkir']['results'])){
			$data['data']=$d['rajaongkir']['results'][0]['costs'];
			$this->load->view(template().'/reseller/kurirdata',$data);			
		}else{
			$data['ongkir'] = 0;
			$this->load->view(template().'/reseller/kurirdata',$data);	
		}
	}

	function rajaongkir_get_provinsi(){
		$records = $this->db->query("SELECT * FROM tb_ro_provinces ORDER BY province_name ASC");
		$select_prov = '<option value="">Provinsi</option>';
		foreach ($records->result_array() as $row) {
			$select_prov .= "<option value='$row[province_id]'>$row[province_name]</option>";
		}
		
        echo $select_prov;
    }
    
    function rajaongkir_get_kota(){
        //$row = $this->db->query("SELECT api_mutasibank, api_rajaongkir FROM identitas where id_identitas='1'")->row_array();
        $id_province = cetak($this->input->post('id_province'));
		$records = $this->db->query("SELECT * FROM tb_ro_cities where province_id='$id_province'");
		$select_kotkab = '<option value="">Kota / Kabupaten</option>';
		foreach ($records->result_array() as $row) {
			$select_kotkab .= "<option value='$row[city_id]'>$row[city_name]</option>";
		}
        
        echo $select_kotkab;
        
    }
    
    
    function rajaongkir_get_kecamatan(){
		//$row = $this->db->query("SELECT api_mutasibank, api_rajaongkir FROM identitas where id_identitas='1'")->row_array();
		$id_kota = cetak($this->input->post('id_kota'));
		$records = $this->db->query("SELECT * FROM tb_ro_subdistricts where city_id='$id_kota'");
		$select_kecamatan = '<option value="">Kecamatan</option>';
		foreach ($records->result_array() as $row) {
			$select_kecamatan .= "<option value='$row[subdistrict_id]'>$row[subdistrict_name]</option>";
		}
        
        
        echo $select_kecamatan;
        
    }
    
    
    function rajaongkir_get_cost(){
		$row = $this->db->query("SELECT api_mutasibank, api_rajaongkir FROM identitas where id_identitas='1'")->row_array();
        //origin : kota asal ( ini karna kita dari tangerang selatan, kita default aja kota tangerang selatan = 457)
        $kota_asal      = cetak($this->uri->segment(4));
        //$kecamatan_asal      = 6314;
        //destination : kota tujuan
        $kecamatan_tujuan    = cetak($this->input->post('kecamatan_tujuan'));
        //kurir pengiriman
        $kurir          = cetak($this->input->post('kurir_pengiriman'));
        //berat
        $berat          = cetak($this->uri->segment(5));
        //&courier=jne
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$kota_asal&originType=city&destination=$kecamatan_tujuan&destinationType=subdistrict&weight=$berat&courier=$kurir",
            CURLOPT_HTTPHEADER => array(
              "content-type: application/x-www-form-urlencoded",
              "key: $row[api_rajaongkir]"
            ),
          ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          //echo $response;
        }
        
        $obj = json_decode($response, true);
        
        $datas;
        for($i=0; $i < count($obj['rajaongkir']['results']); $i++){
            //$datas .= $obj['rajaongkir']['results'][$i]['name'];
            $serv = 88;
            for($j=0; $j < count($obj['rajaongkir']['results'][$i]['costs']); $j++){
                
                $nama_pengiriman = $obj['rajaongkir']['results'][$i]['name'];
                $service         = $obj['rajaongkir']['results'][$i]['costs'][$j]['service'];
                $biaya           = $obj['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['value'];
                $biaya_format    = number_format($obj['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['value']);
            
                $datas .='<li id="serv-'.$serv.'-'.cetak($this->uri->segment(3)).'" onclick="klikongkir'.cetak($this->uri->segment(3)).'(\''.$nama_pengiriman.'\',\''.$service.'\',\''.$biaya.'\',\''.$biaya_format.'\',this.id)" class="list-group-item clearall-kurir" style="cursor:pointer;margin:1px; padding:5px 1.25rem; line-height: 1;"><span style="color:black; ">'.$obj['rajaongkir']['results'][$i]['name'].' - '.$service.'</span> <small><b style="color:red">Rp. '.number_format($obj['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['value']).'</b></small> / <small>Pengiriman : '.$obj['rajaongkir']['results'][$i]['costs'][$j]['cost'][0]['etd'].' hari</small></li>';
				$serv++;
            }
            
            if (count($obj['rajaongkir']['results'][$i]['costs'])<=0){
				echo "<li class='list-group-item clearall-kurir' style='cursor:pointer;margin:1px; padding:5px 1.25rem; line-height: 1; color:red'><center>Maaf Kurir Tidak tersedia.</center></li>";
			}

        }

		if ($kecamatan_tujuan==''){
			echo "<li class='list-group-item clearall-kurir' style='cursor:pointer;margin:1px; padding:5px 1.25rem; line-height: 1; color:red'><center>Anda Belum mengisi <b>Alamat Kirim</b>?</center></li>";
		}

        echo $datas;
        
	}
	
	function sopir_get_cost(){
		$kurir = cetak($this->input->post('kurir_pengiriman'));
		$kecamatan_dari = cetak($this->input->post('kecamatan_dari'));
		$kecamatan_tujuan = cetak($this->input->post('kecamatan_tujuan'));
		$sopir = $this->db->query("SELECT * FROM rb_driver_ongkir where id_jenis_kendaraan='$kurir' AND posisi='$kecamatan_dari' AND tujuan='$kecamatan_tujuan'");
		foreach ($sopir->result_array() as $row) {
			$sopir = $this->db->query("SELECT a.*, b.kecamatan_id FROM rb_sopir a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen where b.kecamatan_id='$kecamatan_dari' AND a.aktif='Y'");
			foreach ($sopir->result_array() as $rows) {
				echo "<li id='serv-99-".$rows['id_sopir']."' onclick=\"klikongkir".$this->uri->segment(3)."('$rows[id_sopir]','SOPIR','$row[ongkir]','".rupiah($row['ongkir'])."',this.id)\" class='list-group-item clearall-kurir' style='cursor:pointer;margin:1px; padding:5px 1.25rem; line-height: 1;'><span style='color:black'>$rows[merek] ($rows[plat_nomor])</span> <small><b style='color:red'>Rp. ".rupiah($row['ongkir'])."</b></small> / <small>$row[keterangan]</small></li>";
			}
		}
		if ($kurir!='0'){
			if ($sopir->num_rows()<=0){
				echo "<center style='color:red'>Maaf, tidak ditemukan pada Rute ini.</center>";
			}
		}
	}

function selesai_belanja(){
	if (isset($_POST['submit'])){
		$iden = $this->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
		if ($this->session->id_konsumen==''){
			$data = array('username'=>$this->input->post('email'),
						'password'=>hash("sha512", md5($this->input->post('telpon'))),
						'nama_lengkap'=>$this->input->post('nama'),
						'email'=>$this->input->post('email'),
						'alamat_lengkap'=>$this->input->post('alamat'),
						'kecamatan_id'=>$this->input->post('kecamatan'),
						'kota_id'=>$this->input->post('kota'),
						'provinsi_id'=>$this->input->post('provinsi'),
						'no_hp'=>$this->input->post('telpon'),
						'token'=>'-',
						'tanggal_daftar'=>date('Y-m-d'));
			$this->model_app->insert('rb_konsumen',$data);
			$id_konsumen = $this->db->insert_id();
		}else{
			$id_konsumen = $this->session->id_konsumen;
			$kon = $this->model_reseller->profile_konsumen($id_konsumen)->row_array();
			if ($kon['alamat_lengkap']!=cetak($this->input->post('alamat')) OR ($kon['kecamatan_id'].$kon['kota_id'].$kon['provinsi_id'])!=(cetak($this->input->post('kecamatan')).cetak($this->input->post('kota')).cetak($this->input->post('provinsi')))){
				$data_insert = array('id_konsumen'=>$this->session->id_konsumen,
						'alamat_lengkap'=>cetak($this->input->post('alamat')),
						'kecamatan_id'=>cetak($this->input->post('kecamatan')),
						'kota_id'=>cetak($this->input->post('kota')),
						'provinsi_id'=>cetak($this->input->post('provinsi')),
						'waktu_perubahan'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_konsumen_alamat',$data_insert);
				
				$data = array('alamat_lengkap'=>cetak($this->input->post('alamat')),
								'kecamatan_id'=>cetak($this->input->post('kecamatan')),
								'kota_id'=>cetak($this->input->post('kota')),
								'provinsi_id'=>cetak($this->input->post('provinsi')));
				$where = array('id_konsumen' => $this->session->id_konsumen);
				$this->model_app->update('rb_konsumen', $data, $where);
			}
		}
		if ($this->input->post('dropshipp')=='Ya'){
			$dropshipper = cetak($this->input->post('nama_dropshipp')).'||'.cetak($this->input->post('telp_dropshipp'));
		}else{
			$dropshipper = '';
		}

		$keterangan = cetak($this->input->post('provinsi')).'|'.cetak($this->input->post('kota')).'|'.cetak($this->input->post('kecamatan')).'|'.cetak($this->input->post('alamat'));
		$kode_transaksi = 'TRX'.$id_konsumen.'.'.date('YmdHis');
		if ($this->session->idp!=''){
			$reseller_cek = $this->db->query("SELECT b.id_reseller FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where session='".$this->session->idp."' GROUP BY b.id_reseller");
			$noo = 1;
			$ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
			$fv = explode('|',$ref['keterangan']);
			if ($fv[0]>'0'){
				$fee_admin = $fv[0];
			}else{
				$fee_admin = 0;
			}
			foreach ($reseller_cek->result_array() as $row) {
				if ($this->input->post('kode_kurir'.$noo)=='0'){
					$kode_kurir = $this->input->post('kode_sopir'.$noo);
				}else{
					$kode_kurir = $this->input->post('kode_kurir'.$noo);
				}

				if ($this->session->group_sesi!=''){
					$group_sesi = $this->session->group_sesi;
				}else{
					$group_sesi = NULL;
				}
				$data = array('kode_transaksi'=>$kode_transaksi,
							'id_pembeli'=>$id_konsumen,
							'id_penjual'=>$row['id_reseller'],
							'status_pembeli'=>'konsumen',
							'status_penjual'=>'reseller',
							'kode_kurir'=>$kode_kurir,
							'kurir'=>$this->input->post('kurir'.$noo),
							'service'=>$this->input->post('service'.$noo),
							'ongkir'=>$this->input->post('ongkir'.$noo),
							'keterangan'=>$keterangan,
							'waktu_transaksi'=>date('Y-m-d H:i:s'),
							'proses'=>'0',
							'fee_admin'=>$fee_admin,
							'dropshipper'=>$dropshipper,
							'group_order'=>$group_sesi);
				$this->model_app->insert('rb_penjualan',$data);
				$idp = $this->db->insert_id();
				$this->session->unset_userdata('group_sesi');

				$no = 1;
				$keranjang = $this->db->query("SELECT a.*, b.id_reseller, b.fee_produk, b.pre_order FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where session='".$this->session->idp."' AND b.id_reseller='$row[id_reseller]'");
				foreach ($keranjang->result_array() as $row) {
					if (config('fee_produk')=='Y'){ $fee_produk = $row['fee_produk']; }else{ $fee_produk = 0; }
					$dataa = array('id_penjualan'=>$idp,
								'id_produk'=>$row['id_produk'],
								'jumlah'=>$row['jumlah'],
								'diskon'=>$row['diskon'],
								'harga_jual'=>$row['harga_jual'],
								'fee_produk_end'=>$fee_produk,
								'preorder'=>$row['pre_order'],
								'keterangan_order'=>$row['keterangan_order'],
								'satuan'=>$row['satuan']);
					$this->model_app->insert('rb_penjualan_detail',$dataa);
					$idp_detail = $this->db->insert_id();

					if ($row['id_kupon']!=''){
						$kp = $this->db->query("SELECT kode_kupon, nilai_kupon FROM rb_produk_kupon where id_kupon='$row[id_kupon]'")->row_array();
						$dataa = array('id_penjualan_detail'=>$idp_detail,
								'id_kupon'=>$row['id_kupon'],
								'kode'=>$kp['kode_kupon'],
								'nilai'=>$kp['nilai_kupon'],
								'waktu_pakai'=>date('Y-m-d H:i:s'));
						$this->model_app->insert('rb_penjualan_kupon',$dataa);
					}
					$no++;
				}
				$noo++;
			}
			
			$this->db->query("DELETE FROM rb_penjualan_temp where session='".$this->session->idp."'");
			$this->session->unset_userdata('reseller');
			$this->session->unset_userdata('idp');
		}

		$tong = $this->db->query("SELECT sum(ongkir) as ongkir FROM `rb_penjualan` where kode_transaksi='".$kode_transaksi."'")->row_array();
		$ttal = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.service, a.proses, sum(a.ongkir) as ongkir, sum(b.harga_jual*b.jumlah) as total, sum(b.diskon*b.jumlah) as diskon_total, sum(c.berat*b.jumlah) as total_berat FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN rb_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='".$kode_transaksi."'")->row_array();
		$kupon = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
										JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
											where b.kode_transaksi='$kode_transaksi'")->row_array();

		$total_tagihan = (($ttal['total']-$ttal['diskon_total'])+($tong['ongkir']+$fee_admin))-$kupon['diskon'];
		
		// Cek Duplikat Transfer Otomatis rentang waktu < 24 Jam
		$cek_duplikat = $this->db->query("SELECT a.*, b.proses, SUBSTR(timediff(now(), a.waktu_proses),1,2) as durasi FROM `rb_penjualan_otomatis` a JOIN rb_penjualan b ON a.kode_transaksi=b.kode_transaksi where a.nominal='$total_tagihan' AND b.proses='0' AND SUBSTR(timediff(now(), a.waktu_proses),1,2)<'24' GROUP BY b.kode_transaksi");
		if ($cek_duplikat->num_rows()>=1){
			$angka_acak = rand(100,999);
			$total_tagihan_akhir = $total_tagihan+$angka_acak;
		}else{
			$angka_acak = substr($kode_transaksi,-3);
			$total_tagihan_akhir = $total_tagihan+$angka_acak;
		}

		if ($this->input->post('metode')=='saldo'){
			if (saldo(reseller($this->session->id_konsumen),$this->session->id_konsumen)>=(($ttal['total']-$ttal['diskon_total'])+$tong['ongkir'])){
				$data_otomatis = array('kode_transaksi'=>$kode_transaksi,
						'nominal'=>$total_tagihan_akhir,
						'pembayaran'=>'1',
						'waktu_proses'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_penjualan_otomatis',$data_otomatis);

				$data = array('id_rekening_reseller'=>0,
						'id_reseller'=>$this->session->id_konsumen,
						'nominal'=>$total_tagihan_akhir,
						'status'=>'Sukses',
						'transaksi'=>'Debit',
						'keterangan'=>$kode_transaksi,
						'waktu_withdraw'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_withdraw',$data);

				$datas = array('proses'=>'2');
				$wheres = array('kode_transaksi'=>$kode_transaksi);
				$this->model_app->update('rb_penjualan', $datas, $wheres);
			}else{
				$data_otomatis = array('kode_transaksi'=>$kode_transaksi,
						'nominal'=>$total_tagihan_akhir,
						'waktu_proses'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_penjualan_otomatis',$data_otomatis);
			}
		}else{
			$data_otomatis = array('kode_transaksi'=>$kode_transaksi,
						'nominal'=>$total_tagihan_akhir,
						'waktu_proses'=>date('Y-m-d H:i:s'));
			$this->model_app->insert('rb_penjualan_otomatis',$data_otomatis);
		}
		
		notif_selesai_belanja($kode_transaksi,$id_konsumen,$total_tagihan_akhir);
		notif_penjual($kode_transaksi);

		$this->session->set_userdata(array('id_konsumen'=>$id_konsumen, 'level'=>'konsumen'));
		redirect('konfirmasi/tracking/'.$kode_transaksi.'?sukses');
	}else{
		redirect('produk/checkouts');
	}
	
}

	function checkouts(){
		if ($this->session->idp==''){
			redirect('produk');
		}

		$ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
		$fv = explode('|',$ref['keterangan']);
		if ($fv[2]=='enable'){
			if ($this->session->id_konsumen==''){
			echo $this->session->set_flashdata('message', '<div class="alert alert-info"><center><b>INFORMASI</b> - Anda Harus Login untuk Melanjutkan...</center></div>');
				redirect('auth/login');
			}
		}
		if (isset($_POST['submit'])){
				if ($this->session->idp!=''){
					$this->load->library('email');
					$data = array('username'=>cetak($this->input->post('b')),
			        			  'password'=>hash("sha512", md5(date('YmdHis'))),
			        			  'nama_lengkap'=>cetak($this->input->post('a')),
			        			  'email'=>$this->input->post('b'),
			        			  'jenis_kelamin'=>'Laki-laki',
			        			  'tanggal_lahir'=>date('Y-m-d'),
								  'tempat_lahir'=>'Belum ada informasi',
								  'alamat_lengkap'=>cetak($this->input->post('c')),
								  'kecamatan'=>cetak($this->input->post('g')),
								  'kota_id'=>cetak($this->input->post('f')),
								  'no_hp'=>cetak($this->input->post('h')),
								  'tanggal_daftar'=>date('Y-m-d H:i:s'));
					$this->model_app->insert('rb_konsumen',$data);
					$id = $this->db->insert_id();
					
					$data = array('kode_transaksi'=>$this->session->idp,
				        		  'id_pembeli'=>$id,
				        		  'id_penjual'=>$this->session->reseller,
				        		  'status_pembeli'=>'konsumen',
				        		  'status_penjual'=>'reseller',
				        		  'waktu_transaksi'=>date('Y-m-d H:i:s'),
				        		  'proses'=>'0');
					$this->model_app->insert('rb_penjualan',$data);
					$idp = $this->db->insert_id();

					$keranjang = $this->model_app->view_where('rb_penjualan_temp',array('session'=>$this->session->idp));
					foreach ($keranjang->result_array() as $row) {
						$dataa = array('id_penjualan'=>$idp,
					        		   'id_produk'=>$row['id_produk'],
					        		   'jumlah'=>$row['jumlah'],
					        		   'harga_jual'=>$row['harga_jual'],
									   'satuan'=>$row['satuan'],
									   'id_kupon'=>$row['id_kupon']);
						$this->model_app->insert('rb_penjualan_detail',$dataa);
					}

					$session = array('session' => $this->session->idp);
					$this->model_app->delete('rb_penjualan_temp',$session);

					$data['title'] = 'Transaksi Success';
					$data['email'] = cetak($this->input->post('b'));
					$data['orders'] = $this->session->idp;

					$iden = $this->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
					$res = $this->model_app->view_where('rb_reseller',array('id_reseller'=>$this->session->reseller))->row_array();
					$alamat = $this->db->query("SELECT a.nama_kota as kota, b.nama_provinsi as propinsi FROM `rb_kota`a JOIN rb_provinsi b ON a.provinsi_id=b.provinsi_id where a.kota_id='".cetak($this->input->post('f'))."'")->row_array();
					$data['rekening_reseller'] = $this->model_app->view_where('rb_rekening_reseller',array('id_reseller'=>$this->session->reseller));

					$email_tujuan = cetak($this->input->post('b'));
					$tglaktif = date("d-m-Y H:i:s");

					$subject      = "$iden[nama_website] - Detail Orderan anda";
					$message      = "<html><body>Halooo! <b>".$this->input->post('a')."</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> Anda telah order produk di $iden[nama_website].
						<br><table style='width:100%;'>
			   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Anda : </b></td></tr>
							<tr><td width='140px'><b>Nama Lengkap</b></td>  <td> : ".cetak($this->input->post('a'))."</td></tr>
							<tr><td><b>Alamat Email</b></td>			<td> : ".cetak($this->input->post('b'))."</td></tr>
							<tr><td><b>No Telpon</b></td>				<td> : ".cetak($this->input->post('h'))."</td></tr>
							<tr><td><b>Alamat</b></td>					<td> : ".cetak($this->input->post('c'))." </td></tr>
							<tr><td><b>Provinsi</b></td>				<td> : ".$alamat['propinsi']." </td></tr>
							<tr><td><b>Kabupaten/Kota</b></td>			<td> : ".$alamat['kota']." </td></tr>
							<tr><td><b>Kecamatan</b></td>				<td> : ".cetak($this->input->post('g'))." </td></tr>
						</table><br>

						<table style='width:100%;'>
			   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Penjual : </b></td></tr>
							<tr><td width='140px'><b>Nama Penjual</b></td>	<td> : ".$res['nama_reseller']."</td></tr>
							<tr><td><b>Alamat</b></td>					<td> : ".$res['alamat_lengkap']."</td></tr>
							<tr><td><b>No Telpon</b></td>				<td> : ".$res['no_telpon']."</td></tr>
							<tr><td><b>Email</b></td>					<td> : ".$res['email']." </td></tr>
							<tr><td><b>Keterangan</b></td>				<td> : ".$res['keterangan']." </td></tr>
						</table><br>

						No Orderan anda : <b>".$this->session->idp."</b><br>
						Berikut Detail Data Orderan Anda :
						<table style='width:100%;' class='table table-striped'>
					          <thead>
					            <tr bgcolor='#337ab7'>
					              <th style='width:40px'>No</th>
					              <th width='47%'>Nama Produk</th>
					              <th>Harga</th>
					              <th>Qty</th>
					              <th>Berat</th>
					              <th>Subtotal</th>
					            </tr>
					          </thead>
					          <tbody>";

					          $no = 1;
					          $belanjaan = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$idp),'id_penjualan_detail','ASC');
					          foreach ($belanjaan as $row){
					          $sub_total = ($row['harga_jual']*$row['jumlah']);
					$message .= "<tr bgcolor='#e3e3e3'><td>$no</td>
					                    <td>$row[nama_produk]</td>
					                    <td>".rupiah($row['harga_jual'])."</td>
					                    <td>$row[jumlah]</td>
					                    <td>".($row['berat']*$row['jumlah'])." Gram</td>
					                    <td>Rp ".rupiah($sub_total)."</td>
					                </tr>";
					            $no++;
					          }
					          $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".$idp."'")->row_array();
					$message .= "<tr bgcolor='lightgreen'>
					                  <td colspan='5'><b>Total Harga</b></td>
					                  <td><b>Rp ".rupiah($total['total'])."</b></td>
					                </tr>

					                <tr bgcolor='lightblue'>
					                  <td colspan='5'><b>Total Berat</b></td>
					                  <td><b>$total[total_berat] Gram</b></td>
					                </tr>

					        </tbody>
					      </table><br>

					      Silahkan melakukan pembayaran ke rekening Penjual :
					      <table style='width:100%;' class='table table-hover table-condensed'>
							<thead>
							  <tr bgcolor='#337ab7'>
							    <th width='20px'>No</th>
							    <th>Nama Bank</th>
							    <th>No Rekening</th>
							    <th>Atas Nama</th>
							  </tr>
							</thead>
							<tbody>";
							    $noo = 1;
							    $rekening = $this->model_app->view('rb_rekening');
							    foreach ($rekening->result_array() as $row){
					$message .= "<tr bgcolor='#e3e3e3'><td>$noo</td>
							              <td>$row[nama_bank]</td>
							              <td>$row[no_rekening]</td>
							              <td>$row[pemilik_rekening]</td>
							          </tr>";
							      $noo++;
							    }
					$message .= "</tbody>
						  </table><br><br>

					      Jika sudah melakukan transfer, jangan lupa konfirmasi transferan anda <a href='".base_url()."konfirmasi'>disini</a><br>
					      Admin, $iden[nama_website] </body></html> \n";
					
					$this->email->from($iden['email'], $iden['nama_website']);
					$this->email->to($email_tujuan);
					$this->email->cc('');
					$this->email->bcc('');

					$this->email->subject($subject);
					$this->email->message($message);
					$this->email->set_mailtype("html");
					$this->email->send();
					
					$config['protocol'] = 'sendmail';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['charset'] = 'utf-8';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$this->email->initialize($config);

					$this->session->unset_userdata('idp');
					$this->session->unset_userdata('reseller');
					$this->template->load('phpmu-one/template','phpmu-one/view_order_success',$data);
				}else{
					redirect('produk/keranjang');
				}
		}else{
			$data['title'] = 'Checkout Order';
			$data['provinsi'] = $this->model_app->view_ordering('rb_provinsi','provinsi_id','DESC');
			$data['rows'] = $this->model_app->view_where('rb_reseller',array('id_reseller'=>$this->session->reseller))->row_array();
			$data['record'] = $this->db->query("SELECT a.*, b.nama_produk, b.gambar, b.produk_seo, b.pre_order, c.nama_reseller, GROUP_CONCAT(d.nama SEPARATOR '||') as nama, GROUP_CONCAT(d.variasi SEPARATOR '||') as variasi FROM rb_penjualan_temp a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_reseller c ON b.id_reseller=c.id_reseller 
			LEFT JOIN rb_produk_variasi d ON a.id_produk=d.id_produk
				where a.session='".$this->session->idp."' GROUP BY b.id_produk ORDER BY id_penjualan_detail ASC")->result_array();
				
			if ($this->session->id_konsumen==''){
				$this->template->load(template().'/template',template().'/reseller/view_checkouts_option',$data);
			}else{
				$this->template->load(template().'/template',template().'/reseller/view_checkouts_konsumen',$data);
			}
		}
	}
	
	
//////////////////////////////////////////////////////////////////////////////////////////////
	// selesai belanja	

function selesai_belanja_jasling(){
	if (isset($_POST['submit'])){
		$iden = $this->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
		if ($this->session->id_konsumen==''){
			$data = array('username'=>$this->input->post('email'),
						'password'=>hash("sha512", md5($this->input->post('telpon'))),
						'nama_lengkap'=>$this->input->post('nama'),
						'email'=>$this->input->post('email'),
						'alamat_lengkap'=>$this->input->post('alamat'),
						'kecamatan_id'=>$this->input->post('kecamatan'),
						'kota_id'=>$this->input->post('kota'),
						'provinsi_id'=>$this->input->post('provinsi'),
						'no_hp'=>$this->input->post('telpon'),
						'token'=>'-',
						'tanggal_daftar'=>date('Y-m-d'));
			$this->model_app->insert('rb_konsumen',$data);
			$id_konsumen = $this->db->insert_id();
		}else{
			$id_konsumen = $this->session->id_konsumen;
			$kon = $this->model_reseller->profile_konsumen($id_konsumen)->row_array();
			if ($kon['alamat_lengkap']!=cetak($this->input->post('alamat')) OR ($kon['kecamatan_id'].$kon['kota_id'].$kon['provinsi_id'])!=(cetak($this->input->post('kecamatan')).cetak($this->input->post('kota')).cetak($this->input->post('provinsi')))){
				$data_insert = array('id_konsumen'=>$this->session->id_konsumen,
						'alamat_lengkap'=>cetak($this->input->post('alamat')),
						'kecamatan_id'=>cetak($this->input->post('kecamatan')),
						'kota_id'=>cetak($this->input->post('kota')),
						'provinsi_id'=>cetak($this->input->post('provinsi')),
						'waktu_perubahan'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_konsumen_alamat',$data_insert);
				
				$data = array('alamat_lengkap'=>cetak($this->input->post('alamat')),
								'kecamatan_id'=>cetak($this->input->post('kecamatan')),
								'kota_id'=>cetak($this->input->post('kota')),
								'provinsi_id'=>cetak($this->input->post('provinsi')));
				$where = array('id_konsumen' => $this->session->id_konsumen);
				$this->model_app->update('rb_konsumen', $data, $where);
			}
		}
		if ($this->input->post('dropshipp')=='Ya'){
			$dropshipper = cetak($this->input->post('nama_dropshipp')).'||'.cetak($this->input->post('telp_dropshipp'));
		}else{
			$dropshipper = '';
		}

		$keterangan = cetak($this->input->post('provinsi')).'|'.cetak($this->input->post('kota')).'|'.cetak($this->input->post('kecamatan')).'|'.cetak($this->input->post('alamat'));
		$kode_transaksi = 'TIKET'.$id_konsumen.'.'.date('YmdHis');
		if ($this->session->idp!=''){
			$reseller_cek = $this->db->query("SELECT b.id_reseller FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where session='".$this->session->idp."' GROUP BY b.id_reseller");
			$noo = 1;
			$ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
			$fv = explode('|',$ref['keterangan']);
			if ($fv[0]>'0'){
				$fee_admin = $fv[0];
			}else{
				$fee_admin = 0;
			}
			foreach ($reseller_cek->result_array() as $row) {
				if ($this->input->post('kode_kurir'.$noo)=='0'){
					$kode_kurir = $this->input->post('kode_sopir'.$noo);
				}else{
					$kode_kurir = $this->input->post('kode_kurir'.$noo);
				}

				if ($this->session->group_sesi!=''){
					$group_sesi = $this->session->group_sesi;
				}else{
					$group_sesi = NULL;
				}
				$data = array('kode_transaksi'=>$kode_transaksi,
							'id_pembeli'=>$id_konsumen,
							'id_penjual'=>$row['id_reseller'],
							'status_pembeli'=>'konsumen',
							'status_penjual'=>'reseller',
							'kode_kurir'=>'0',
							'kurir'=>$this->input->post('kurir'.$noo),
							'service'=>$this->input->post('service'.$noo),
							'ongkir'=>$this->input->post('ongkir'.$noo),
							'keterangan'=>$keterangan,
							'waktu_transaksi'=>date('Y-m-d H:i:s'),
							'proses'=>'2',
							'fee_admin'=>$fee_admin,
							'dropshipper'=>$dropshipper,
							'group_order'=>$group_sesi);
				$this->model_app->insert('rb_penjualan',$data);
				$idp = $this->db->insert_id();
				$this->session->unset_userdata('group_sesi');

				$no = 1;
				$keranjang = $this->db->query("SELECT a.*, b.id_reseller, b.fee_produk, b.pre_order FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where session='".$this->session->idp."' AND b.id_reseller='$row[id_reseller]'");
				foreach ($keranjang->result_array() as $row) {
					if (config('fee_produk')=='Y'){ $fee_produk = $row['fee_produk']; }else{ $fee_produk = 0; }
					$dataa = array('id_penjualan'=>$idp,
								'id_produk'=>$row['id_produk'],
								'jumlah'=>$row['jumlah'],
								'diskon'=>$row['diskon'],
								'harga_jual'=>$row['harga_jual'],
								'fee_produk_end'=>$fee_produk,
								'preorder'=>$row['pre_order'],
								'keterangan_order'=>$row['keterangan_order'],
								'satuan'=>$row['satuan']);
					$this->model_app->insert('rb_penjualan_detail',$dataa);
					$idp_detail = $this->db->insert_id();

					if ($row['id_kupon']!=''){
						$kp = $this->db->query("SELECT kode_kupon, nilai_kupon FROM rb_produk_kupon where id_kupon='$row[id_kupon]'")->row_array();
						$dataa = array('id_penjualan_detail'=>$idp_detail,
								'id_kupon'=>$row['id_kupon'],
								'kode'=>$kp['kode_kupon'],
								'nilai'=>$kp['nilai_kupon'],
								'waktu_pakai'=>date('Y-m-d H:i:s'));
						$this->model_app->insert('rb_penjualan_kupon',$dataa);
					}
					$no++;
				}
				$noo++;
			}
			
			$this->db->query("DELETE FROM rb_penjualan_temp where session='".$this->session->idp."'");
			$this->session->unset_userdata('reseller');
			$this->session->unset_userdata('idp');
		}

		$tong = $this->db->query("SELECT sum(ongkir) as ongkir FROM `rb_penjualan` where kode_transaksi='".$kode_transaksi."'")->row_array();
		$ttal = $this->db->query("SELECT a.kode_transaksi, a.kurir, a.service, a.proses, sum(a.ongkir) as ongkir, sum(b.harga_jual*b.jumlah) as total, sum(b.diskon*b.jumlah) as diskon_total, sum(c.berat*b.jumlah) as total_berat FROM `rb_penjualan` a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan JOIN rb_produk c ON b.id_produk=c.id_produk where a.kode_transaksi='".$kode_transaksi."'")->row_array();
		$kupon = $this->db->query("SELECT sum(c.nilai) as diskon FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
										JOIN rb_penjualan_kupon c ON a.id_penjualan_detail=c.id_penjualan_detail
											where b.kode_transaksi='$kode_transaksi'")->row_array();

		$total_tagihan_akhir = (($ttal['total']-$ttal['diskon_total'])+($tong['ongkir']+$fee_admin))-$kupon['diskon'];
		
		
		

		if ($this->input->post('metode')=='saldo'){
			if (saldo(reseller($this->session->id_konsumen),$this->session->id_konsumen)>=(($ttal['total']-$ttal['diskon_total'])+$tong['ongkir'])){
				$data_otomatis = array('kode_transaksi'=>$kode_transaksi,
						'nominal'=>$total_tagihan_akhir,
						'pembayaran'=>'1',
						'waktu_proses'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_penjualan_otomatis',$data_otomatis);

				$data = array('id_rekening_reseller'=>0,
						'id_reseller'=>$this->session->id_konsumen,
						'nominal'=>$total_tagihan_akhir,
						'status'=>'Sukses',
						'transaksi'=>'Debit',
						'keterangan'=>$kode_transaksi,
						'waktu_withdraw'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_withdraw',$data);

				$datas = array('proses'=>'2');
				$wheres = array('kode_transaksi'=>$kode_transaksi);
				$this->model_app->update('rb_penjualan', $datas, $wheres);
			}else{
				$data_otomatis = array('kode_transaksi'=>$kode_transaksi,
						'nominal'=>$total_tagihan_akhir,
						'waktu_proses'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_penjualan_otomatis',$data_otomatis);
			}
		}else{
			$data_otomatis = array('kode_transaksi'=>$kode_transaksi,
						'nominal'=>$total_tagihan_akhir,
						'waktu_proses'=>date('Y-m-d H:i:s'));
			$this->model_app->insert('rb_penjualan_otomatis',$data_otomatis);
		}
		
		notif_selesai_belanja($kode_transaksi,$id_konsumen,$total_tagihan_akhir);
		notif_penjual($kode_transaksi);

		$this->session->set_userdata(array('id_konsumen'=>$id_konsumen, 'level'=>'konsumen'));
		redirect('konfirmasi/tiket/'.$kode_transaksi.'?sukses');
	}else{
		redirect('produk/print_checkouts');
	}
	
}

	// end selesai belanja
//////////////////////////////////////////////////////////////////////////////////////////////
	
	
	

	
//////////////////////////////////////////////////////////////////////////////////////////////
	// print checkouts
	
	function print_checkouts(){
		if ($this->session->idp==''){
			redirect('produk');
		}

		$ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
		$fv = explode('|',$ref['keterangan']);
		if ($fv[2]=='enable'){
			if ($this->session->id_konsumen==''){
			echo $this->session->set_flashdata('message', '<div class="alert alert-info"><center><b>INFORMASI</b> - Anda Harus Login untuk Melanjutkan...</center></div>');
				redirect('auth/login');
			}
		}
		if (isset($_POST['submit'])){
				if ($this->session->idp!=''){
					$this->load->library('email');
					$data = array('username'=>cetak($this->input->post('b')),
			        			  'password'=>hash("sha512", md5(date('YmdHis'))),
			        			  'nama_lengkap'=>cetak($this->input->post('a')),
			        			  'email'=>$this->input->post('b'),
			        			  'jenis_kelamin'=>'Laki-laki',
			        			  'tanggal_lahir'=>date('Y-m-d'),
								  'tempat_lahir'=>'Belum ada informasi',
								  'alamat_lengkap'=>cetak($this->input->post('c')),
								  'kecamatan'=>cetak($this->input->post('g')),
								  'kota_id'=>cetak($this->input->post('f')),
								  'no_hp'=>cetak($this->input->post('h')),
								  'tanggal_daftar'=>date('Y-m-d H:i:s'));
					$this->model_app->insert('rb_konsumen',$data);
					$id = $this->db->insert_id();
					
					$data = array('kode_transaksi'=>$this->session->idp,
				        		  'id_pembeli'=>$id,
				        		  'id_penjual'=>$this->session->reseller,
				        		  'status_pembeli'=>'konsumen',
				        		  'status_penjual'=>'reseller',
				        		  'waktu_transaksi'=>date('Y-m-d H:i:s'),
				        		  'proses'=>'2');
					$this->model_app->insert('rb_penjualan',$data);
					$idp = $this->db->insert_id();

					$keranjang = $this->model_app->view_where('rb_penjualan_temp',array('session'=>$this->session->idp));
					foreach ($keranjang->result_array() as $row) {
						$dataa = array('id_penjualan'=>$idp,
					        		   'id_produk'=>$row['id_produk'],
					        		   'jumlah'=>$row['jumlah'],
					        		   'harga_jual'=>$row['harga_jual'],
									   'satuan'=>$row['satuan'],
									   'id_kupon'=>$row['id_kupon']);
						$this->model_app->insert('rb_penjualan_detail',$dataa);
					}

					$session = array('session' => $this->session->idp);
					$this->model_app->delete('rb_penjualan_temp',$session);

					$data['title'] = 'Transaksi Success';
					$data['email'] = cetak($this->input->post('b'));
					$data['orders'] = $this->session->idp;

					$iden = $this->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
					$res = $this->model_app->view_where('rb_reseller',array('id_reseller'=>$this->session->reseller))->row_array();
					$alamat = $this->db->query("SELECT a.nama_kota as kota, b.nama_provinsi as propinsi FROM `rb_kota`a JOIN rb_provinsi b ON a.provinsi_id=b.provinsi_id where a.kota_id='".cetak($this->input->post('f'))."'")->row_array();
					$data['rekening_reseller'] = $this->model_app->view_where('rb_rekening_reseller',array('id_reseller'=>$this->session->reseller));

					$email_tujuan = cetak($this->input->post('b'));
					$tglaktif = date("d-m-Y H:i:s");

					$subject      = "$iden[nama_website] - Detail Orderan anda";
					$message      = "<html><body>Halooo! <b>".$this->input->post('a')."</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> Anda telah order produk di $iden[nama_website].
						<br><table style='width:100%;'>
			   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Anda : </b></td></tr>
							<tr><td width='140px'><b>Nama Lengkap</b></td>  <td> : ".cetak($this->input->post('a'))."</td></tr>
							<tr><td><b>Alamat Email</b></td>			<td> : ".cetak($this->input->post('b'))."</td></tr>
							<tr><td><b>No Telpon</b></td>				<td> : ".cetak($this->input->post('h'))."</td></tr>
							<tr><td><b>Alamat</b></td>					<td> : ".cetak($this->input->post('c'))." </td></tr>
							<tr><td><b>Provinsi</b></td>				<td> : ".$alamat['propinsi']." </td></tr>
							<tr><td><b>Kabupaten/Kota</b></td>			<td> : ".$alamat['kota']." </td></tr>
							<tr><td><b>Kecamatan</b></td>				<td> : ".cetak($this->input->post('g'))." </td></tr>
						</table><br>

						<table style='width:100%;'>
			   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Penjual : </b></td></tr>
							<tr><td width='140px'><b>Nama Penjual</b></td>	<td> : ".$res['nama_reseller']."</td></tr>
							<tr><td><b>Alamat</b></td>					<td> : ".$res['alamat_lengkap']."</td></tr>
							<tr><td><b>No Telpon</b></td>				<td> : ".$res['no_telpon']."</td></tr>
							<tr><td><b>Email</b></td>					<td> : ".$res['email']." </td></tr>
							<tr><td><b>Keterangan</b></td>				<td> : ".$res['keterangan']." </td></tr>
						</table><br>

						No Orderan anda : <b>".$this->session->idp."</b><br>
						Berikut Detail Data Orderan Anda :
						<table style='width:100%;' class='table table-striped'>
					          <thead>
					            <tr bgcolor='#337ab7'>
					              <th style='width:40px'>No</th>
					              <th width='47%'>Nama Produk</th>
					              <th>Harga</th>
					              <th>Qty</th>
					              <th>Berat</th>
					              <th>Subtotal</th>
					            </tr>
					          </thead>
					          <tbody>";

					          $no = 1;
					          $belanjaan = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$idp),'id_penjualan_detail','ASC');
					          foreach ($belanjaan as $row){
					          $sub_total = ($row['harga_jual']*$row['jumlah']);
					$message .= "<tr bgcolor='#e3e3e3'><td>$no</td>
					                    <td>$row[nama_produk]</td>
					                    <td>".rupiah($row['harga_jual'])."</td>
					                    <td>$row[jumlah]</td>
					                    <td>".($row['berat']*$row['jumlah'])." Gram</td>
					                    <td>Rp ".rupiah($sub_total)."</td>
					                </tr>";
					            $no++;
					          }
					          $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".$idp."'")->row_array();
					$message .= "<tr bgcolor='lightgreen'>
					                  <td colspan='5'><b>Total Harga</b></td>
					                  <td><b>Rp ".rupiah($total['total'])."</b></td>
					                </tr>

					                <tr bgcolor='lightblue'>
					                  <td colspan='5'><b>Total Berat</b></td>
					                  <td><b>$total[total_berat] Gram</b></td>
					                </tr>

					        </tbody>
					      </table><br>

					      Silahkan melakukan pembayaran ke rekening Penjual :
					      <table style='width:100%;' class='table table-hover table-condensed'>
							<thead>
							  <tr bgcolor='#337ab7'>
							    <th width='20px'>No</th>
							    <th>Nama Bank</th>
							    <th>No Rekening</th>
							    <th>Atas Nama</th>
							  </tr>
							</thead>
							<tbody>";
							    $noo = 1;
							    $rekening = $this->model_app->view('rb_rekening');
							    foreach ($rekening->result_array() as $row){
					$message .= "<tr bgcolor='#e3e3e3'><td>$noo</td>
							              <td>$row[nama_bank]</td>
							              <td>$row[no_rekening]</td>
							              <td>$row[pemilik_rekening]</td>
							          </tr>";
							      $noo++;
							    }
					$message .= "</tbody>
						  </table><br><br>

					      Jika sudah melakukan transfer, jangan lupa konfirmasi transferan anda <a href='".base_url()."konfirmasi'>disini</a><br>
					      Admin, $iden[nama_website] </body></html> \n";
					
					$this->email->from($iden['email'], $iden['nama_website']);
					$this->email->to($email_tujuan);
					$this->email->cc('');
					$this->email->bcc('');

					$this->email->subject($subject);
					$this->email->message($message);
					$this->email->set_mailtype("html");
					$this->email->send();
					
					$config['protocol'] = 'sendmail';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['charset'] = 'utf-8';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$this->email->initialize($config);

					$this->session->unset_userdata('idp');
					$this->session->unset_userdata('reseller');
					$this->template->load('phpmu-one/template','phpmu-one/view_order_success',$data);
				}else{
					redirect('produk/keranjang_jasling');
				}
		}else{
			$data['title'] = 'Cetak Checkout Order';
			$data['provinsi'] = $this->model_app->view_ordering('rb_provinsi','provinsi_id','DESC');
			$data['rows'] = $this->model_app->view_where('rb_reseller',array('id_reseller'=>$this->session->reseller))->row_array();
			$data['record'] = $this->db->query("SELECT a.*, b.nama_produk, b.gambar, b.produk_seo, b.pre_order, c.nama_reseller, GROUP_CONCAT(d.nama SEPARATOR '||') as nama, GROUP_CONCAT(d.variasi SEPARATOR '||') as variasi FROM rb_penjualan_temp a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_reseller c ON b.id_reseller=c.id_reseller 
			LEFT JOIN rb_produk_variasi d ON a.id_produk=d.id_produk
				where a.session='".$this->session->idp."' GROUP BY b.id_produk ORDER BY id_penjualan_detail ASC")->result_array();
				
			if ($this->session->id_konsumen==''){
				$this->template->load(template().'/template',template().'/reseller/view_checkouts_option_jasling',$data);
			}else{
				$this->template->load(template().'/template',template().'/reseller/view_checkouts_konsumen_jasling',$data);
			}
		}
	}
	
	
////////////////////////////////////////////////////////////////////////////////////////////////	

	function order(){
		$this->session->set_userdata(array('produk'=>cetak($this->uri->segment(3))));
		redirect('produk/reseller');
	}

	public function detail(){
		$ids = cetak($this->uri->segment(3));
		$dat = $this->db->query("SELECT * FROM rb_produk where produk_seo='$ids' AND id_reseller!='0'");
		$row = $dat->row();
		if (isset($_POST['submit_rating'])){
			$data = array('id_konsumen'=>$this->session->id_konsumen,
							'id_produk'=>$row->id_produk,
							'rating'=>cetak($this->input->post('rating')),
							'ulasan'=>cetak($this->input->post('ulasan')),
							'waktu_kirim'=>date('Y-m-d H:i:s'));
			$this->model_app->insert('rb_produk_ulasan',$data);
			notif_ulasan($row->id_produk,$this->session->id_konsumen,cetak($this->input->post('rating')));
			echo $this->session->set_flashdata('message_ulasan', '<div class="alert alert-success"><center>Berhasil Mengirimkan Ulasan,..</center></div>');
			redirect('produk/detail/'.$row->produk_seo);

		}elseif (isset($_POST['submit_pertanyaan'])){
			$data = array('id_produk'=>$row->id_produk,
							'id_konsumen'=>$this->session->id_konsumen,
							'reply'=>'0',
							'isi_pesan'=>cetak($this->input->post('pesan',TRUE)),
							'tanggal_komentar'=>date('Y-m-d'),
							'jam_komentar'=>date('H:i:s'));
			$this->model_app->insert('tbl_comment',$data);
			notif_diskusi($row->id_produk,$this->session->id_konsumen);
			redirect('produk/detail/'.$row->produk_seo);

		}elseif (isset($_POST['submit_balasan'])){
			$data = array('id_produk'=>$row->id_produk,
							'id_konsumen'=>$this->session->id_konsumen,
							'reply'=>cetak($this->input->post('reply',TRUE)),
							'isi_pesan'=>cetak($this->input->post('pesan',TRUE)),
							'tanggal_komentar'=>date('Y-m-d'),
							'jam_komentar'=>date('H:i:s'));
			$this->model_app->insert('tbl_comment',$data);
			redirect('produk/detail/'.$row->produk_seo);
		}else{
			$total = $dat->num_rows();
			if ($total == 0){ redirect('main'); }

			$dataa = array('dilihat'=>$row->dilihat+1);
			$where = array('id_produk' => $row->id_produk);
			$this->model_utama->update('rb_produk', $dataa, $where);

			$tag_seox = explode(',',$row->tag);
			for ($i=0; $i <count($tag_seox); $i++){ 
				$tagc = $this->db->query("SELECT count FROM tagpro where tag_seo='".$tag_seox[$i]."'")->row_array();
				$data_tag = array('count'=>$tagc['count']+1);
				$where_tag = array('tag_seo' => $tag_seox[$i]);
				$this->model_app->update('tagpro', $data_tag, $where_tag);
			}

			$data['title'] = $row->nama_produk;
			$data['record'] = $this->model_app->view_where('rb_produk',array('id_produk'=>$row->id_produk))->row_array();
			
			$this->template->load(template().'/template',template().'/reseller/view_produk_detail',$data);
			
		}
	}

	public function perusahaan_detail(){
		if (reseller($this->session->id_konsumen)==''){
			echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, halaman tersebut khusus untuk Penjual/Pelapak,..</center></div>');
			redirect('main');
		}else{
			$ids = cetak($this->uri->segment(3));
			$dat = $this->db->query("SELECT * FROM rb_produk where produk_seo='$ids' AND id_reseller='0'");
			$row = $dat->row();
			if (isset($_POST['submit_rating'])){
				$data = array('id_konsumen'=>$this->session->id_konsumen,
								'id_produk'=>$row->id_produk,
								'rating'=>cetak($this->input->post('rating')),
								'ulasan'=>cetak($this->input->post('ulasan')),
								'waktu_kirim'=>date('Y-m-d H:i:s'));
								
				$this->model_app->insert('rb_produk_ulasan',$data);
				echo $this->session->set_flashdata('message_ulasan', '<div class="alert alert-success"><center>Berhasil Mengirimkan Ulasan,..</center></div>');
				redirect('produk/perusahaan_detail/'.$row->produk_seo);
			}else{
				$total = $dat->num_rows();
					if ($total == 0){
						redirect('main');
					}

				$dataa = array('dilihat'=>$row->dilihat+1);
				$where = array('id_produk' => $row->id_produk);
				$this->model_utama->update('rb_produk', $dataa, $where);

				$data['title'] = $row->nama_produk;
				$data['record'] = $this->model_app->view_where('rb_produk',array('id_produk'=>$row->id_produk))->row_array();
				$this->template->load(template().'/template',template().'/reseller/view_produk_perusahaan_detail',$data);
			}
		}
	}

	function save(){
        $result = array('id_konsumen'=>$this->session->id_konsumen,
				'id_produk'=>cetak($this->input->post('id')),
				'waktu_simpan'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_konsumen_simpan',$result);
        echo json_encode($result);
	}

	function cart_update(){
		$id_produk = cetak($this->input->post('id'));
		$qty = cetak($this->input->post('qty'));
		$result = $this->db->query("UPDATE rb_penjualan_temp SET jumlah=jumlah+$qty where session='".$this->session->idp."' AND id_produk='$id_produk'");
		echo json_encode($result);
	}

	function cart(){
		$id_produk = cetak($this->input->post('id'));
		$var1 = cetak($this->input->post('var1'));
		$var2 = cetak($this->input->post('var2'));
		$var3 = cetak($this->input->post('var3'));

		$keterangan_order = ($var1 != '' ? $var1.'; ' : '').($var2 != '' ? $var2.'; ' : '').($var3 != '' ? $var3.'; ' : '');

		$harga = $this->model_app->view_where('rb_produk',array('id_produk'=>$id_produk))->row_array();
		$id_reseller = $harga['id_reseller'];

		$ref = $this->model_app->view_where('rb_setting',array('id_setting'=>'1'))->row_array();
		$fv = explode('|',$ref['keterangan']);

		if ($this->session->idp == ''){
			if ($this->session->id_konsumen!=''){ $idp = $this->session->id_konsumen; }else{ $idp = date('YmdHis'); }
			$this->session->set_userdata(array('idp'=>$idp,'reseller'=>$id_reseller));
		}

		$cek_minimum = $this->db->query("SELECT nama_produk, minimum, satuan FROM rb_produk where id_produk='$id_produk'")->row_array();
		if (cetak($this->input->post('qty'))==''){ $tqty = 1; }else{ $tqty = cetak($this->input->post('qty')); }

		if ($cek_minimum['minimum']<=$tqty){
			$qty = $tqty;
		}else{
			$qty = $cek_minimum['minimum'];
		}

		
		if ($this->session->id_konsumen!=''){
			$cek_penjual = $this->db->query("SELECT id_konsumen, user_reseller FROM rb_reseller where id_reseller='$id_reseller'")->row_array();
			if ($cek_penjual['id_konsumen']!=$this->session->id_konsumen){
				$reseller_cek = $this->db->query("SELECT b.id_reseller FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where session='".$this->session->idp."' AND b.id_reseller!='$id_reseller' GROUP BY b.id_reseller");
				if ($reseller_cek->num_rows()<'3'){
					$cek = $this->model_app->view_where('rb_penjualan_temp',array('session'=>$this->session->idp,'id_produk'=>$id_produk))->num_rows();
					if ($cek >=1){
						$result = $this->db->query("UPDATE rb_penjualan_temp SET jumlah=jumlah+$qty where session='".$this->session->idp."' AND id_produk='$id_produk'");
					}else{
						$disk = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$id_produk,'id_reseller'=>$id_reseller))->row_array();
						if ($disk['diskon']==''){ $diskon = 0; }else{ $diskon = $disk['diskon']; }
						if (cetak($this->input->post('group'))!=''){
							$cgroup = $this->db->query("SELECT * FROM rb_produk_group where id_produk='$id_produk' AND id_group='".cetak($this->input->post('group'))."'");
                                if ($cgroup->num_rows()>=1){
                                    $cg = $cgroup->row_array();
									$harga_konsumen = $cg['harga_group'];
									if ($this->session->group_sesi==''){
										if (cetak($this->input->post('kgroup'))!=''){
											$this->session->set_userdata(array('group_sesi'=>cetak($this->input->post('kgroup'))));
										}else{
											$this->session->set_userdata(array('group_sesi'=>$cg['id_group'].'.'.$cg['jumlah_group'].'.'.date('His')));
										}
									}
								}else{
									$harga_konsumen = $harga['harga_konsumen'];
								}
						}else{
							$harga_konsumen = $harga['harga_konsumen'];
						}
						$result = array('session'=>$this->session->idp,
										'id_produk'=>$id_produk,
										'jumlah'=>$qty,
										'diskon'=>$diskon,
										'harga_jual'=>$harga_konsumen,
										'satuan'=>$harga['satuan'],
										'keterangan_order'=>$keterangan_order,
										'waktu_order'=>date('Y-m-d H:i:s'));
						$this->model_app->insert('rb_penjualan_temp',$result);
					}
				}
			}
		}else{
			$reseller_cek = $this->db->query("SELECT b.id_reseller FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where session='".$this->session->idp."' AND b.id_reseller!='$id_reseller' GROUP BY b.id_reseller");
			if ($reseller_cek->num_rows()<'3'){
				$cek = $this->model_app->view_where('rb_penjualan_temp',array('session'=>$this->session->idp,'id_produk'=>$id_produk))->num_rows();
				if ($cek >=1){
					$result = $this->db->query("UPDATE rb_penjualan_temp SET jumlah=jumlah+$qty where session='".$this->session->idp."' AND id_produk='$id_produk'");
				}else{
					$disk = $this->model_app->edit('rb_produk_diskon',array('id_produk'=>$id_produk,'id_reseller'=>$id_reseller))->row_array();
					if ($disk['diskon']==''){ $diskon = 0; }else{ $diskon = $disk['diskon']; }
					$harga_konsumen = $harga['harga_konsumen'];
					$result = array('session'=>$this->session->idp,
									'id_produk'=>$id_produk,
									'jumlah'=>$qty,
									'diskon'=>$diskon,
									'harga_jual'=>$harga_konsumen,
									'satuan'=>$harga['satuan'],
									'keterangan_order'=>$keterangan_order,
									'waktu_order'=>date('Y-m-d H:i:s'));
					$this->model_app->insert('rb_penjualan_temp',$result);
				}
			}
		}
		echo json_encode($result);
	}

	function cart_remove(){
		$id_penjualan_detail = cetak($this->input->post('id'));
		$id = array('id_penjualan_detail' => $id_penjualan_detail, 'session'=>$this->session->idp);
		$result = $this->model_app->delete('rb_penjualan_temp',$id);
		$isi_keranjang = $this->db->query("SELECT sum(jumlah) as jumlah FROM rb_penjualan_temp where session='".$this->session->idp."'")->row_array();
		if ($isi_keranjang['jumlah']==''){
			$this->session->unset_userdata('idp');
			$this->session->unset_userdata('reseller');
		}
		echo json_encode($result);
	}

	function read_query(){
		$data = $this->db->query("SELECT a.*, b.nama_produk, b.gambar, b.produk_seo, b.pre_order, c.nama_reseller, GROUP_CONCAT(d.nama SEPARATOR '||') as nama, GROUP_CONCAT(d.variasi SEPARATOR '||') as variasi FROM rb_penjualan_temp a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_reseller c ON b.id_reseller=c.id_reseller 
									LEFT JOIN rb_produk_variasi d ON a.id_produk=d.id_produk
										where a.session='".$this->session->idp."' GROUP BY b.id_produk ORDER BY id_penjualan_detail ASC")->result();
		echo json_encode($data);
	}

	function delete_stok(){
		$cek = $this->db->query("SELECT b.id_pembeli FROM rb_penjualan_detail a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan where b.id_pembeli='".reseller($this->session->id_konsumen)."' AND a.id_penjualan_detail='".cetak($this->input->post('id'))."'");
		if ($cek->num_rows()>=1){
			$result = $this->db->query("DELETE FROM rb_penjualan_detail where id_penjualan_detail='".cetak($this->input->post('id'))."'");
			echo json_encode($result);
		}
	}
	
	function quick_view(){
		$data['record'] = $this->db->query("SELECT * FROM rb_produk where id_produk='".cetak($this->input->post('id'))."'")->row_array();
		$this->load->view(template().'/reseller/view_produk_quick',$data);
	}
}
