<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Hubungi extends CI_Controller {
	public function index(){
		$query = $this->model_utama->view_where('mod_alamat',array('id_alamat' => 1));
		$data['iden'] = $this->model_utama->view_where('identitas',array('id_identitas' => 1))->row_array();
		$row = $query->row_array();
		$data['title'] = 'Hubungi Kami';
		$data['description'] = 'Silahkan Mengisi Form Dibawah ini untuk menghubungi kami';
		$data['keywords'] = 'hubungi, kontak, kritik, saran, pesan';
		$data['rows'] = $row;

		$this->load->helper('captcha');
		$vals = array(
            'img_path'	 => './captcha/',
            'img_url'	 => base_url().'captcha/',
            'font_size'     => 17,
            'img_width'	 => '150',
            'img_height' => 30,
            'border' => 0, 
            'word_length'   => 5,
            'expiration' => 7200
        );

        $cap = create_captcha($vals);
        $data['image'] = $cap['image'];
        $this->session->set_userdata('mycaptcha', $cap['word']);
		$this->template->load(template().'/template',template().'/hubungi',$data);
	}

	function kirim(){
		if (isset($_POST['submit'])){
			if ($this->input->post() && (strtolower($this->input->post('security_code')) == strtolower($this->session->userdata('mycaptcha')))) {
				$data = array('nama'=>cetak($this->input->post('a')),
	                            'email'=>cetak($this->input->post('b')),
	                            'subjek'=>$_SERVER['REMOTE_ADDR'],
	                            'pesan'=>cetak($this->input->post('c')),
	                            'tanggal'=>date('Y-m-d'),
	                            'jam'=>date('H:i:s'));
				$this->model_utama->insert('hubungi',$data);
				echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Pesan terkirim!, akan kami respon via email!</center></div>');
			}else{
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Security Code yang anda masukkan salah!</center></div>');
			}
			redirect('hubungi');
		}
	}
}
