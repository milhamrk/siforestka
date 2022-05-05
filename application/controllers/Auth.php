<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
    function __construct(){
		parent::__construct();
		$this->load->library('facebook');
		$this->load->library('google');
	}
	
	function city(){
		$state_id = $this->input->post('stat_id');
		$data['kota'] = $this->model_app->view_where_ordering('rb_kota',array('provinsi_id' => $state_id),'kota_id','DESC');
		$this->load->view(template().'/reseller/view_city',$data);		
	}

	public function register(){
		if (isset($_POST['submit2'])){
			if (cetak($this->input->post('password'))==cetak($this->input->post('repassword'))){
				$cek_username = $this->db->query("SELECT * FROM rb_konsumen where username='".cetak($this->input->post('username'))."' OR email='".cetak($this->input->post('a'))."' OR no_hp='".cetak($this->input->post('b'))."'");
				if (strlen(cetak($this->input->post('b')))<'10'){
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>GAGAL - No telpon anda tidak valid..</center></div>');
					redirect("auth/login");
				}

				if ($cek_username->num_rows()<='0'){
					$ex = explode('@',cetak($this->input->post('a')));
					$data = array('username'=>cetak($this->input->post('username')),
								'password'=>hash("sha512", md5($this->input->post('password'))),
								'nama_lengkap'=>$ex[0],
								'email'=>cetak($this->input->post('a')),
								'jenis_kelamin'=>cetak($this->input->post('jenis_kelamin')),
								'no_hp'=>cetak($this->input->post('b')),
								'token'=>config('token_referral'),
								'referral_id'=>$this->session->referral,
								'tanggal_daftar'=>date('Y-m-d H:i:s'));
					$this->model_app->insert('rb_konsumen',$data);
					$id = $this->db->insert_id();
					$this->session->set_userdata(array('id_konsumen'=>$id, 'level'=>'konsumen'));

					$tgl_kirim = date("d-m-Y H:i:s");
					$iden = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
					$subject      = "$iden[pengirim_email] - Pendaftaran Sukses,..";
					$logo = $this->db->query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1")->row_array();
					$kons = $this->model_reseller->profile_konsumen($id)->row_array();

					$message  = "<html><body><span style='font-size:18px; color:green'>Selamat Bergabung di $iden[url]</span><br>
											Hai $kons[nama_lengkap]! Terima kasih telah mendaftar di <a style='text-decoration:none; color:#000' href='$iden[url]'>$iden[url]</a>. <br>
											Silakan untuk melengkapi data diri anda sesuai dengan identitas pada KTP di <a href='".base_url()."members/edit_profile'>Disini</a>.<br><br>

											Akun Anda sudah kami aktifkan. Anda mendaftar menggunakan email: $kons[email].<br> 
											Masukkan email dan password yang Anda daftarkan tersebut setiap kali log in ke $iden[url].<br><br>

											Siap mencari produk dari ribuan<br>
											penjual online di Indonesia? <a href='".base_url()."produk'>Klik Disini</a></body></html> \n";
					
					echo kirim_email($subject,$message,$kons['email']); 
					echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Terima kasih, anda sudah terdaftar di <b>'.$iden['url'].'</b> silahkan cek email untuk verifikasi!</center></div>');
					redirect('members/edit_profile');
				}else{
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Username/Email/No Telpon Telah Digunakan!</center></div>');
					redirect('auth/login');
				}
			}else{
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Password anda tidak Valid!</center></div>');
				redirect('auth/login');
			}
		}
	}
	
	public function facebook_login(){
		$data = array();
		// Authenticate user with facebook
		if($this->facebook->is_authenticated()){
			// Get user info from facebook
			$fbUser = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');

            // Preparing data for database insertion
            $data['oauth_provider'] = 'facebook';
            $data['oauth_uid']	= !empty($fbUser['id'])?$fbUser['id']:'';
            $data['first_name']	= !empty($fbUser['first_name'])?$fbUser['first_name']:'';
            $data['last_name']	= !empty($fbUser['last_name'])?$fbUser['last_name']:'';
            $data['email']		= !empty($fbUser['email'])?$fbUser['email']:'';
            $data['gender']		= !empty($fbUser['gender'])?$fbUser['gender']:'';
			$data['picture']	= !empty($fbUser['picture']['data']['url'])?$fbUser['picture']['data']['url']:'';
            $data['link']		= !empty($fbUser['link'])?$fbUser['link']:'https://www.facebook.com/';

			$rows = $this->db->query("SELECT * FROM rb_konsumen where email='$fbUser[email]' ORDER BY id_konsumen DESC LIMIT 1")->row_array();
			if ($rows['id_konsumen']!=''){
				$this->session->set_userdata(array('id_konsumen'=>$rows['id_konsumen'], 'level'=>'konsumen'));
				
				if ($this->session->idp!=''){
					$keranjang = $this->db->query("SELECT a.*, c.id_konsumen FROM rb_penjualan_temp a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_reseller c ON b.id_reseller=c.id_reseller where a.session='".$this->session->idp."'");
					foreach ($keranjang->result_array() as $row) {
						$cek_exist = $this->db->query("SELECT * FROM rb_penjualan_temp where id_produk='$row[id_produk]' AND session='$rows[id_konsumen]'");
						if ($cek_exist->num_rows()<=0){
							if ($row['id_konsumen']!=$rows['id_konsumen']){
								$this->db->query("UPDATE rb_penjualan_temp SET session='$rows[id_konsumen]' where id_penjualan_detail='$row[id_penjualan_detail]'");
							}
						}else{
							$this->db->query("UPDATE rb_penjualan_temp SET jumlah='$row[jumlah]' where id_penjualan_detail='$row[id_penjualan_detail]'");
						}
					}
				}

				$this->session->set_userdata(array('idp'=>$rows['id_konsumen']));

				redirect('members/profile');
			}else{
    			if ($this->session->id_konsumen!=''){
    				redirect('members/profile');
    			}else{
					$ex = explode('@',cetak($fbUser['email']));
					$dataa = array('username'=>cetak($ex[0]),
								'password'=>hash("sha512", md5($ex[0])),
								'nama_lengkap'=>($fbUser['first_name'].' '.$fbUser['last_name']),
								'email'=>cetak($fbUser['email']),
								'jenis_kelamin'=>'Laki-laki',
								'token'=>config('token_referral'),
								'referral_id'=>$this->session->referral,
								'tanggal_daftar'=>date('Y-m-d H:i:s'));
					$this->model_app->insert('rb_konsumen',$dataa);
					$id = $this->db->insert_id();
					$this->session->set_userdata(array('id_konsumen'=>$id, 'level'=>'konsumen'));

					$tgl_kirim = date("d-m-Y H:i:s");
					$iden = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
					$subject      = "$iden[pengirim_email] - Pendaftaran Sukses,..";
					$logo = $this->db->query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1")->row_array();
					$kons = $this->model_reseller->profile_konsumen($id)->row_array();

					$message  = "<html><body><span style='font-size:18px; color:green'>Selamat Bergabung di $iden[url]</span><br>
											Hai $kons[nama_lengkap]! Terima kasih telah mendaftar di <a style='text-decoration:none; color:#000' href='$iden[url]'>$iden[url]</a>. <br>
											Silakan untuk melengkapi data diri anda sesuai dengan identitas pada KTP di <a href='".base_url()."members/edit_profile'>Disini</a>.<br><br>

											Akun Anda sudah kami aktifkan. Anda mendaftar menggunakan email: $kons[email].<br> 
											Masukkan email dan password yang Anda daftarkan tersebut setiap kali log in ke $iden[url].<br><br>

											Siap mencari produk dari ribuan<br>
											penjual online di Indonesia? <a href='".base_url()."produk'>Klik Disini</a></body></html> \n";
					
					echo kirim_email($subject,$message,$kons['email']); 
					echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Terima kasih, anda sudah terdaftar di <b>'.$iden['url'].'</b> silahkan cek email untuk verifikasi!</center></div>');
					redirect('members/edit_profile');
    			}
			}
		}else{
			if ($this->session->id_konsumen!=''){
				redirect('members/profile');
			}else{
				redirect('auth/login');
			}
        }
	}
	
	public function facebook_logout() {
		$this->facebook->destroy_session();
		$this->session->sess_destroy();
        redirect('auth/login');
    }

	function google_login(){
		if(isset($_GET["code"])){
			if($this->google->getAuthenticate()){
				$gpInfo = $this->google->getUserInfo();
				// Preparing data for database insertion
				$data['oauth_provider'] = 'google';
				$data['oauth_uid'] 		= $gpInfo['id'];
				$data['first_name'] 	= $gpInfo['given_name'];
				$data['last_name'] 		= $gpInfo['family_name'];
				$data['email'] 			= $gpInfo['email'];
				$data['gender'] 		= !empty($gpInfo['gender'])?$gpInfo['gender']:'';
				$data['locale'] 		= !empty($gpInfo['locale'])?$gpInfo['locale']:'';
				$data['picture'] 		= !empty($gpInfo['picture'])?$gpInfo['picture']:'';

				$rows = $this->db->query("SELECT * FROM rb_konsumen where email='$gpInfo[email]' ORDER BY id_konsumen DESC LIMIT 1")->row_array();
				if ($rows['id_konsumen']!=''){
					$this->session->set_userdata(array('id_konsumen'=>$rows['id_konsumen'], 'level'=>'konsumen'));

					if ($this->session->idp!=''){
						$keranjang = $this->db->query("SELECT a.*, c.id_konsumen FROM rb_penjualan_temp a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_reseller c ON b.id_reseller=c.id_reseller where a.session='".$this->session->idp."'");
						foreach ($keranjang->result_array() as $row) {
							$cek_exist = $this->db->query("SELECT * FROM rb_penjualan_temp where id_produk='$row[id_produk]' AND session='$rows[id_konsumen]'");
							if ($cek_exist->num_rows()<=0){
								if ($row['id_konsumen']!=$rows['id_konsumen']){
									$this->db->query("UPDATE rb_penjualan_temp SET session='$rows[id_konsumen]' where id_penjualan_detail='$row[id_penjualan_detail]'");
								}
							}else{
								$this->db->query("UPDATE rb_penjualan_temp SET jumlah='$row[jumlah]' where id_penjualan_detail='$row[id_penjualan_detail]'");
							}
						}
					}

					$this->session->set_userdata(array('idp'=>$rows['id_konsumen']));

				    redirect('members/profile');
				}else{
					if ($this->session->id_konsumen!=''){
        				redirect('members/profile');
        			}else{
        			    $ex = explode('@',cetak($gpInfo['email']));
						$dataa = array('username'=>cetak($ex[0]),
									'password'=>hash("sha512", md5($ex[0])),
									'nama_lengkap'=>($gpInfo['given_name'].' '.$gpInfo['family_name']),
									'email'=>cetak($gpInfo['email']),
									'jenis_kelamin'=>'Laki-laki',
									'token'=>config('token_referral'),
									'referral_id'=>$this->session->referral,
									'tanggal_daftar'=>date('Y-m-d H:i:s'));
						$this->model_app->insert('rb_konsumen',$dataa);
						$id = $this->db->insert_id();
						$this->session->set_userdata(array('id_konsumen'=>$id, 'level'=>'konsumen'));

						$tgl_kirim = date("d-m-Y H:i:s");
						$iden = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
						$subject      = "$iden[pengirim_email] - Pendaftaran Sukses,..";
						$logo = $this->db->query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1")->row_array();
						$kons = $this->model_reseller->profile_konsumen($id)->row_array();

						$message  = "<html><body><span style='font-size:18px; color:green'>Selamat Bergabung di $iden[url]</span><br>
												Hai $kons[nama_lengkap]! Terima kasih telah mendaftar di <a style='text-decoration:none; color:#000' href='$iden[url]'>$iden[url]</a>. <br>
												Silakan untuk melengkapi data diri anda sesuai dengan identitas pada KTP di <a href='".base_url()."members/edit_profile'>Disini</a>.<br><br>

												Akun Anda sudah kami aktifkan. Anda mendaftar menggunakan email: $kons[email].<br> 
												Masukkan email dan password yang Anda daftarkan tersebut setiap kali log in ke $iden[url].<br><br>

												Siap mencari produk dari ribuan<br>
												penjual online di Indonesia? <a href='".base_url()."produk'>Klik Disini</a></body></html> \n";
						
						echo kirim_email($subject,$message,$kons['email']); 
						echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Terima kasih, anda sudah terdaftar di <b>'.$iden['url'].'</b> silahkan cek email untuk verifikasi!</center></div>');
						redirect('members/edit_profile');
        			}
				}
			}
		}else{
			if ($this->session->id_konsumen!=''){
				redirect('members/profile');
			}else{
				redirect('auth/login');
			}
        }
	}

	public function google_logout(){
		$this->google->revokeToken();
        $this->session->sess_destroy();
		redirect('auth/login');
    }

	public function login(){
		if (isset($_POST['login'])){
				$username = $this->input->post('a');
				$password = hash("sha512", md5(strip_tags($this->input->post('b'))));
				$cek = $this->db->query("SELECT * FROM rb_konsumen where (username='".cetak($username)."' OR email='".cetak($username)."' OR no_hp='".cetak($username)."') AND password='".cetak($password)."'");
			    $row = $cek->row_array();
			    $total = $cek->num_rows();
				if ($total > 0){
					$this->session->set_userdata(array('id_konsumen'=>$row['id_konsumen'], 'level'=>'konsumen'));

					if ($this->session->idp!=''){
						$keranjang = $this->db->query("SELECT a.*, c.id_konsumen FROM rb_penjualan_temp a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_reseller c ON b.id_reseller=c.id_reseller where a.session='".$this->session->idp."'");
						foreach ($keranjang->result_array() as $rows) {
							$cek_exist = $this->db->query("SELECT * FROM rb_penjualan_temp where id_produk='$rows[id_produk]' AND session='$row[id_konsumen]'");
							if ($cek_exist->num_rows()<=0){
								if ($rows['id_konsumen']!=$row['id_konsumen']){
									$this->db->query("UPDATE rb_penjualan_temp SET session='$row[id_konsumen]' where id_penjualan_detail='$rows[id_penjualan_detail]'");
								}
							}else{
								$this->db->query("UPDATE rb_penjualan_temp SET jumlah='$rows[jumlah]' where id_penjualan_detail='$rows[id_penjualan_detail]'");
							}
						}
					}

					$this->session->set_userdata(array('idp'=>$row['id_konsumen']));

					/*if ($this->session->idp!=''){
						$data = array('kode_transaksi'=>$this->session->idp,
			        			  'id_pembeli'=>$row['id_konsumen'],
			        			  'id_penjual'=>$this->session->reseller,
			        			  'status_pembeli'=>'konsumen',
			        			  'status_penjual'=>'reseller',
			        			  'waktu_transaksi'=>date('Y-m-d H:i:s'),
			        			  'proses'=>'0');
						$this->model_app->insert('rb_penjualan',$data);
						$id = $this->db->insert_id();

						$query_temp = $this->db->query("SELECT * FROM rb_penjualan_temp where session='".$this->session->idp."'");
						foreach ($query_temp->result_array() as $r) {
							$data = array('id_penjualan'=>$id,
			        			  'id_produk'=>$r['id_produk'],
			        			  'jumlah'=>$r['jumlah'],
			        			  'diskon'=>$r['diskon'],
			        			  'harga_jual'=>$r['harga_jual'],
			        			  'satuan'=>$r['satuan']);
							$this->model_app->insert('rb_penjualan_detail',$data);
						}
						$this->db->query("DELETE FROM rb_penjualan_temp where session='".$this->session->idp."'");

						$this->session->unset_userdata('reseller');
						$this->session->unset_userdata('idp');
						$this->session->set_userdata(array('idp'=>$id));
					}*/
					redirect('members/profile');
				}else{
					$data['title'] = 'Gagal Login';
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, Username atau password salah!</center></div>');
					redirect('auth/login');
				}
		}else{
			if ($this->session->id_konsumen!=''){
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, Anda saat ini sudah Terdaftar!</center></div>');
				redirect('members/profile');
			}else{
				$iden = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
				$data['title'] = "Masuk / Daftar di ".replace_url($iden['url']);
				$data['row'] = $this->model_utama->view_where('mod_alamat',array('id_alamat' => 2))->row_array();
				$this->template->load(template().'/template',template().'/reseller/view_login',$data);
			}
		}
	}

	public function lupass(){
		if (isset($_POST['submit3'])){
			$email = cetak($this->input->post('a'));
			$no_telpon = cetak($this->input->post('b'));
			$cek = $this->db->query("SELECT * FROM rb_konsumen where email='$email' OR username='$email' OR no_hp='$no_telpon'");
		    $total = $cek->num_rows();
			if ($total > 0){
				$data = $cek->row_array();
				$tgl_kirim = date("d-m-Y H:i:s");
				$iden = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
				$subject      = "$iden[pengirim_email] - Permintaan pergantian Password,..";
				$logo = $this->db->query("SELECT * FROM logo ORDER BY id_logo DESC LIMIT 1")->row_array();
				
				$message      = "<html><body>Halooo! <b>".$data['nama_lengkap']."</b> ... <br> 
					Hari ini pada tanggal <span style='color:red'>$tgl_kirim</span> anda meminta akses untuk reset password...<br><br>

					Silahkan klik link berikut untuk mengubah password : <br>
					<a href='".base_url()."auth/resetpassword?token=$data[password].$data[id_konsumen]'>".base_url()."auth/resetpassword?token=$data[password].$data[id_konsumen]</a><br><br>

					Jika permintaan ini bukan dari anda maka silahkan melaporkannya kepada kami dengan mengirim email ke $iden[email].<br><br>

					Jika Anda mencurigai seseorang mungkin memiliki akses tidak sah ke akun Anda, kami sarankan Anda mengubah kata sandi sebagai tindakan pencegahan dengan mengunjungi $iden[url].</body></html> \n";

				echo kirim_email($subject,$message,$data['email']);
				echo $this->session->set_flashdata('message', '<div class="alert alert-success"><center>Permintaan terkirim!, Cek email anda.</center></div>');
			}else{
				echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, data anda tidak ditemukan!</center></div>');
			}
			redirect('auth/login');
		}
	}

	function resetpassword(){
		$ex = explode('.',cetak($this->input->get('token')));
		$cek = $this->db->query("SELECT * FROM rb_konsumen where password='".cetak($ex[0])."' AND id_konsumen='".$ex[1]."'");
		if ($cek->num_rows()>=1){
			if (isset($_POST['submit'])){
				if (cetak($this->input->post('pass'))==cetak($this->input->post('repass'))){
					$password = hash("sha512", md5(strip_tags($this->input->post('pass'))));
					$this->db->query("UPDATE rb_konsumen set password='$password' where password='".cetak($ex[0])."' AND id_konsumen='".cetak($ex[1])."'");
					$row = $cek->row_array();
					$this->session->set_userdata(array('id_konsumen'=>$row['id_konsumen'], 'level'=>'konsumen'));
					if ($this->session->idp!=''){
						$data = array('kode_transaksi'=>$this->session->idp,
			        			  'id_pembeli'=>$row['id_konsumen'],
			        			  'id_penjual'=>$this->session->reseller,
			        			  'status_pembeli'=>'konsumen',
			        			  'status_penjual'=>'reseller',
			        			  'waktu_transaksi'=>date('Y-m-d H:i:s'),
			        			  'proses'=>'0');
						$this->model_app->insert('rb_penjualan',$data);
						$id = $this->db->insert_id();

						$query_temp = $this->db->query("SELECT * FROM rb_penjualan_temp where session='".$this->session->idp."'");
						foreach ($query_temp->result_array() as $r) {
							$data = array('id_penjualan'=>$id,
			        			  'id_produk'=>$r['id_produk'],
			        			  'jumlah'=>$r['jumlah'],
			        			  'diskon'=>$r['diskon'],
			        			  'harga_jual'=>$r['harga_jual'],
			        			  'satuan'=>$r['satuan']);
							$this->model_app->insert('rb_penjualan_detail',$data);
						}
						$this->db->query("DELETE FROM rb_penjualan_temp where session='".$this->session->idp."'");

						$this->session->unset_userdata('reseller');
						$this->session->unset_userdata('idp');
						$this->session->set_userdata(array('idp'=>$id));
					}
					redirect('members/profile');
				}else{
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, Password tidak sama!</center></div>');
					redirect('auth/resetpassword?token='.cetak($this->input->get('token')));
				}
			}else{
				$data['title'] = 'Reset Password';
				$this->template->load(template().'/template',template().'/reseller/view_lupass',$data);
			}
		}else{
			echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, Token sudah kadaluarsa!</center></div>');
			redirect('auth/login');
		}
	}

	function logout(){
		cek_session_members();
		$this->session->sess_destroy();
		redirect('main');
	}
}
