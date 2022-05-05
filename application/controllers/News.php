<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class News extends CI_Controller {
	private $page = null;
	private $params = null;

	public function __construct (){
        parent::__construct();
        $this->page = $this->uri->segment(1);
        $this->reroute();
	}

	public function _remap ($page, $params = array() ){
		if(count($params) > 0){
			if(strlen($params[0]) > 0){
				$this->params = $params;
			}
		}

		if($this->params){
			$method = strtolower(trim($this->params[0]));
		    if(method_exists($this, $method)){
		        return call_user_func_array (array($this, $method), $this->params);
		    }else{
				$this->index();
		    }
		}else{
			$this->index();
		}
	}

	function index(){
		if ($this->session->id_konsumen!=''){
			echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, Anda harus logout dulu untuk mengakses halaman tersebut...</center></div>');
			redirect('members/profile');
		}else{
			$query = $this->db->query("SELECT id_konsumen, token FROM rb_konsumen where username='".cetak($this->uri->segment(1))."'");
			if ($query->num_rows()<=0){
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, Referral '.cetak($this->uri->segment(1)).' Tidak ditemukan...</center></div>');
				redirect('auth/login');
			}else{
				$row = $query->row_array();
				if ($row['token']=='Y'){
					$this->session->set_userdata(array('referral'=>$row['id_konsumen']));
					redirect('auth/login?'.cetak($this->uri->segment(1)));
				}else{
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Data Referral <b>'.cetak($this->uri->segment(1)).'</b> Tidak aktif...</center></div>');
					redirect('auth/login');
				}
			}
		}
	}

	private function reroute (){
        /**
         * if the route starts with this classes name (ie. "page")
         * then reroute without the class prefix ...
         **/
        if($this->page == $this->router->class){
    		if($this->uri->total_segments() > 1){
    			$this->load->helper('url');
    			/** 
    			 * parse the uri string and remove the "page/" portion
    			**/
    			$uri = substr($this->uri->uri_string, strlen($this->page)+1);
    			redirect($uri);
    		}else{
    			$this->noroute($this->page);
    		}
        }
	}
}
