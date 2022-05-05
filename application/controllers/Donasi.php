<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Donasi extends CI_Controller {
	function sedekah(){
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			if (substr(cetak($this->input->post('no_handphone')),-2)==cetak($this->input->post('validasi'))){
				$data = array('jenis'=>'sedekah',
						'nominal'=>cetak($this->input->post('nominal')),
						'nama_lengkap'=>cetak($this->input->post('nama_lengkap')),
						'no_handphone'=>cetak($this->input->post('no_handphone')),
						'alamat_email'=>cetak($this->input->post('alamat_email')),
						'id_rekening'=>cetak($this->input->post('id_rekening')),
						'keterangan'=>cetak($this->input->post('keterangan')),
						'doa_terbaik'=>cetak($this->input->post('doa_terbaik')),
						'waktu_kirim'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_donasi',$data);
				echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Sukses Proses Bersedekah, kami akan segera menghubungi anda! Terima kasih</center></div>');
			}else{
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>GAGAL Diproses, 2 Digit Terakhir No Handphone yang anda input salah!</center></div>');
			}
			redirect('donasi/sedekah?success');
		}else{
			$data['title'] = 'Sedekah Online';
			$data['description'] = description();
			$data['keywords'] = keywords();
			$data['record'] = $this->model_app->view('rb_rekening');
			$this->template->load(template().'/template',template().'/donasi/sedekah_online',$data);
		}
	}

	function wakaf_uang(){
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			if (substr(cetak($this->input->post('no_handphone')),-2)==cetak($this->input->post('validasi'))){
				$data = array('jenis'=>'wakaf_uang',
						'nominal'=>cetak($this->input->post('nominal')),
						'nama_lengkap'=>cetak($this->input->post('nama_lengkap')),
						'no_handphone'=>cetak($this->input->post('no_handphone')),
						'alamat_email'=>cetak($this->input->post('alamat_email')),
						'id_rekening'=>cetak($this->input->post('id_rekening')),
						'keterangan'=>'-',
						'doa_terbaik'=>cetak($this->input->post('doa_terbaik')),
						'waktu_kirim'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_donasi',$data);
				echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Sukses Proses Wakaf uang, kami akan segera menghubungi anda! Terima kasih</center></div>');
			}else{
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>GAGAL Diproses, 2 Digit Terakhir No Handphone yang anda input salah!</center></div>');
			}
			redirect('donasi/wakaf_uang?success');
		}else{
			$data['title'] = 'Wakaf Uang Online';
			$data['description'] = description();
			$data['keywords'] = keywords();
			$data['record'] = $this->model_app->view('rb_rekening');
			$this->template->load(template().'/template',template().'/donasi/wakaf_online',$data);
		}
	}

	function wakaf_asset(){
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			if (substr(cetak($this->input->post('no_handphone')),-2)==cetak($this->input->post('validasi'))){
				$config['upload_path'] = 'asset/files/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|zip|rar|tar';
				$config['max_size'] = '20000'; // kb
				$this->load->library('upload', $config);
				$this->upload->do_upload('f');
				$hasil=$this->upload->data();
				$keterangan = cetak($this->input->post('jenis')).'||'.cetak($this->input->post('alamat')).'||'.cetak($this->input->post('keterangan'));
				if ($hasil['file_name']==''){
					$data = array('jenis'=>'wakaf_asset',
							'nominal'=>cetak($this->input->post('nominal')),
							'nama_lengkap'=>cetak($this->input->post('nama_lengkap')),
							'no_handphone'=>cetak($this->input->post('no_handphone')),
							'alamat_email'=>cetak($this->input->post('alamat_email')),
							'id_rekening'=>'0',
							'keterangan'=>$keterangan,
							'waktu_kirim'=>date('Y-m-d H:i:s'));
				}else{
					$data = array('jenis'=>'wakaf_asset',
							'nominal'=>cetak($this->input->post('nominal')),
							'nama_lengkap'=>cetak($this->input->post('nama_lengkap')),
							'no_handphone'=>cetak($this->input->post('no_handphone')),
							'alamat_email'=>cetak($this->input->post('alamat_email')),
							'id_rekening'=>'0',
							'file_upload'=>$hasil['file_name'],
							'keterangan'=>$keterangan,
							'waktu_kirim'=>date('Y-m-d H:i:s'));
				}
				$this->model_app->insert('rb_donasi',$data);
				echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Sukses Proses Wakaf Asset, kami akan segera menghubungi anda! Terima kasih</center></div>');
			}else{
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>GAGAL Diproses, 2 Digit Terakhir No Handphone yang anda input salah!</center></div>');
			}
			redirect('donasi/wakaf_asset?success');
		}else{
			$data['title'] = 'Wakaf Asset Online';
			$data['description'] = description();
			$data['keywords'] = keywords();
			$data['record'] = $this->model_app->view('rb_rekening');
			$this->template->load(template().'/template',template().'/donasi/wakaf_online_asset',$data);
		}
	}

	function jemput_zakat(){
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			if (substr(cetak($this->input->post('no_handphone')),-2)==cetak($this->input->post('validasi'))){
				$keterangan = cetak($this->input->post('jenis')).'||'.cetak($this->input->post('alamat'));
				$data = array('jenis'=>'zakat',
						'nama_lengkap'=>cetak($this->input->post('nama_lengkap')),
						'no_handphone'=>cetak($this->input->post('no_handphone')),
						'alamat_email'=>cetak($this->input->post('alamat_email')),
						'id_rekening'=>cetak($this->input->post('id_rekening')),
						'keterangan'=>$keterangan,
						'doa_terbaik'=>cetak($this->input->post('doa_terbaik')),
						'waktu_kirim'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_donasi',$data);
				echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Sukses Proses Jemput Zakat, kami akan segera menghubungi anda! Terima kasih</center></div>');
			}else{
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>GAGAL Diproses, 2 Digit Terakhir No Handphone yang anda input salah!</center></div>');
			}
			redirect('donasi/jemput_zakat?success');
		}else{
			$data['title'] = 'Jemput Zakat Online';
			$data['description'] = description();
			$data['keywords'] = keywords();
			$data['record'] = $this->model_app->view('rb_rekening');
			$this->template->load(template().'/template',template().'/donasi/jemput_zakat',$data);
		}
	}
}
