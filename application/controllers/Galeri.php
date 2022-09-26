<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Galeri extends CI_Controller {
	public function index(){
			$jumlah= $this->model_utama->view('berita')->num_rows();
			$config['base_url'] = base_url().'berita/index/';
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 5; 	
			if ($this->uri->segment('3')==''){
				$dari = 0;
			}else{
				$dari = $this->uri->segment('3');
			}
			
				if ($this->input->post('kata')){
					$data['title'] = "Hasil Pencarian keyword - ".cetak($this->input->post('kata'));
					$data['description'] = description();
					$data['keywords'] = keywords();
					$data['album'] = $this->model_utama->cari_berita(cetak($this->input->post('kata')));
				}else{
					$data['title'] = "Semua Galeri";
					$data['description'] = description();
					$data['keywords'] = keywords();
					$data['album'] = $this->model_utama->view_ordering_limit('album','id_album','desc',$dari,$config['per_page']);
					$this->pagination->initialize($config);
				}
			$this->template->load(template().'/template',template().'/view_galeri',$data);
	}

}
