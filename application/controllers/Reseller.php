<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Reseller extends CI_Controller {
	function index(){
		echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, untuk Login Penjual Sudah Pindah Kesini!!!</center></div>');
		redirect('auth/login');
	}

	function download(){
		$name = cetak($this->uri->segment(3));
		$data = file_get_contents("asset/files/".$name);
		force_download($name, $data);
	}
}
