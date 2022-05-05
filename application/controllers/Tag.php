<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Tag extends CI_Controller {
	public function detail(){
		$query = $this->model_utama->view_where('tag',array('tag_seo' => cetak($this->uri->segment(3))));
		if ($query->num_rows()<=0){
			redirect('main');
		}else{
			$row = $query->row_array();
			$jumlah= $this->db->query("SELECT * FROM berita where tag LIKE '%$row[tag_seo]%'")->num_rows();
			$config['base_url'] = base_url().'tag/detail/'.$this->uri->segment(3);
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 5; 	
			if ($this->uri->segment('4')==''){
				$dari = 0;
			}else{
				$dari = $this->uri->segment('4');
			}
			$data['title'] = "Berita Tag $row[nama_tag]";
			$data['description'] = description();
			$data['keywords'] = keywords();
			$data['rows'] = $row;
			if (is_numeric($dari)) {
				$data['beritatag'] = $this->db->query("SELECT berita.*, users.nama_lengkap, kategori.nama_kategori, kategori.kategori_seo FROM berita 
															left join users on berita.username=users.username
																left join kategori on berita.id_kategori=kategori.id_kategori 
																	WHERE  berita.status='Y' AND berita.tag LIKE '%$row[tag_seo]%' 
																		ORDER BY id_berita DESC LIMIT $dari,$config[per_page]");
			}else{
				redirect('main');
			}
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/detailtag',$data);
		}
	}

	public function produk(){
		$query = $this->model_utama->view_where('tagpro',array('tag_seo' => cetak($this->uri->segment(3))));
		if ($query->num_rows()<=0){
			redirect('main');
		}else{
			$row = $query->row_array();
			$jumlah= $this->db->query("SELECT * FROM rb_produk where tag LIKE '%$row[tag_seo]%'")->num_rows();
			$config['base_url'] = base_url().'tag/produk/'.$this->uri->segment(3);
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 12; 	
			if ($this->uri->segment('4')==''){
				$dari = 0;
			}else{
				$dari = $this->uri->segment('4');
			}
			$data['title'] = "Produk Tag $row[nama_tag]";
			$data['judul'] = "$row[nama_tag]";
			$data['description'] = description();
			$data['keywords'] = keywords();
			$data['rows'] = $row;
			if (is_numeric($dari)) {
				$data['record'] = $this->db->query("SELECT a.*, b.nama_reseller, c.nama_kota FROM rb_produk a LEFT JOIN rb_reseller b ON a.id_reseller=b.id_reseller LEFT JOIN rb_kota c ON b.kota_id=c.kota_id where a.id_reseller!='0' AND a.id_produk_perusahaan='0' AND a.aktif='Y' AND a.tag LIKE '%$row[tag_seo]%' ORDER BY a.id_produk DESC LIMIT $dari,$config[per_page]");
			}else{
				redirect('main');
			}
			$this->pagination->initialize($config);
			$this->template->load(template().'/template',template().'/reseller/view_kategori_all',$data);
		}
	}
}
