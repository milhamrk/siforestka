<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class peta extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
		
	/* public function index()
	{
		$this->load->view('v_home');
	} */
	
	public function produk_json()
	{
		$data=$this->db->get('bangunan')->result();
		echo json_encode($data);
	}
	
	public function bidang_detail()
	{
		$idp=$this->uri->segment(3);
        $data['rows'] = $this->db->query("SELECT * FROM `potensi_sdh`a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_produk=$idp")->row_array();
        
		$this->template->load(template().'/template',template().'/peta/view_bidang_detail',$data);
	}
	
	public function produk_detail(){
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM rb_produk where id_reseller!='0'");
	    $row = $dat->row();
	    $total = $dat->num_rows();
	        if ($total == 0){
	        	redirect('main');
	        }
		$data['title'] = $row->nama_produk;
		$data['record'] = $this->model_app->view_where('rb_produk',array('id_produk'=>$ids))->row_array();
		$this->template->load(template().'/template',template().'/reseller/view_produk_detail',$data);
	}
	
	public function view(){
		$this->template->load(template().'/template',template().'/content2');
	}
	
	public function dishut(){
		$this->template->load(template().'/template',template().'/dishut');
	}

}
