<?php 
/*
-- ---------------------------------------------------------------
-- MARKETPLACE MULTI BUYER MULTI SELLER + SUPPORT RESELLER SYSTEM
-- CREATED BY : ROBBY PRIHANDAYA
-- COPYRIGHT  : Copyright (c) 2018 - 2019, PHPMU.COM. (https://phpmu.com/)
-- LICENSE    : http://opensource.org/licenses/MIT  MIT License
-- CREATED ON : 2019-03-26
-- UPDATED ON : 2019-03-27
-- ---------------------------------------------------------------
*/
class Model_app extends CI_model{
    public function view($table){
        return $this->db->get($table);
    }

    public function insert($table,$data){
        return $this->db->insert($table, $data);
    }

    public function edit($table, $data){
        return $this->db->get_where($table, $data);
    }
 
    public function update($table, $data, $where){
        return $this->db->update($table, $data, $where); 
    }

    public function delete($table, $where){
        return $this->db->delete($table, $where);
    }

    public function view_where($table,$data){
        $this->db->where($data);
        return $this->db->get($table);
    }

    public function view_ordering_limit($table,$order,$ordering,$baris,$dari){
        $this->db->select('*');
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }

    public function view_where_ordering_limit($table,$data,$order,$ordering,$baris,$dari){
        $this->db->select('*');
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }
    
    public function view_ordering($table,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function view_where_ordering($table,$data,$order,$ordering){
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function view_join_one($table1,$table2,$field,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_where($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    function umenu_akses($link,$id){
        return $this->db->query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'")->num_rows();
    }

    public function cek_login($username,$password,$table){
        return $this->db->query("SELECT * FROM $table where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."' AND blokir='N'");
    }

    function grafik_kunjungan(){
        return $this->db->query("SELECT count(*) as jumlah, tanggal FROM statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 10");
    }

    function kategori_populer($limit){
        return $this->db->query("SELECT * FROM (SELECT a.*, b.jum_dibaca FROM
                                    (SELECT * FROM kategori) as a left join
                                    (SELECT id_kategori, sum(dibaca) as jum_dibaca FROM berita GROUP BY id_kategori) as b on a.id_kategori=b.id_kategori) as c 
                                        where c.aktif='Y' ORDER BY c.jum_dibaca DESC LIMIT $limit");
    }

    function slide(){
        return $this->db->query("SELECT * FROM slide ORDER BY id_slide DESC");
    }

    function slide_tambah(){
        $config['upload_path'] = 'asset/foto_slide/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('b');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('keterangan'=>$this->db->escape_str($this->input->post('a')),
                            'waktu'=>date('Y-m-d H:i:s'));
        }else{
            $datadb = array('keterangan'=>$this->db->escape_str($this->input->post('a')),
                            'gambar'=>$hasil['file_name'],
                            'waktu'=>date('Y-m-d H:i:s'));
        }
        $this->db->insert('slide',$datadb);
    }

    function slide_update(){
        $config['upload_path'] = 'asset/foto_slide/';
        $config['allowed_types'] = 'gif|jpg|png|JPG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('b');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('keterangan'=>$this->input->post('a'));
        }else{
            $datadb = array('keterangan'=>$this->input->post('a'),
                            'gambar'=>$hasil['file_name']);
        }
        $this->db->where('id_slide',$this->input->post('id'));
        $this->db->update('slide',$datadb);
    }

    function slide_edit($id){
        return $this->db->query("SELECT * FROM slide where id_slide='$id'");
    }

    function slide_delete($id){
        return $this->db->query("DELETE FROM slide where id_slide='$id'");
    }

    function wa($telepon,$message){
        $row = $this->model_app->edit('identitas', array('id_identitas' => 1))->row_array();
        $maps = explode('|',$row['maps']);
        if (trim($maps[2])!=''){
        if (strlen($telepon)>='10'){
            $token = trim($maps[2]);
            if (config('wa_gateway')=='wablas'){
                $curl = curl_init();
                $data = [
                    'phone' => "$telepon",
                    'message' => "$message",
                ];

                curl_setopt($curl, CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, config('wa_domain')."/api/send-message");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                $result = curl_exec($curl);
                curl_close($curl);

            }else{
                $param = array(
                    "to" => "$token",
                    "data" => array(
                        "message"   => "$telepon",
                        "schedule"  => date('Y-m-d H:i:s'), // opsional
                        "number"    => "$message",
                        "whatsapp"  => "personal" // bisnis, auto
                    )
                );
                $data_json=json_encode($param, 1);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_json);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.config('wa_domain'))); //woowandroid
                $response = curl_exec($ch);
                curl_close($ch);
            }
        }
        }
    }

    public function pusat_bantuan_diskusi($data){
        $insert = $this->db->insert('rb_pusat_bantuan_diskusi', $data);
        return $insert ? true : false;
    }
}