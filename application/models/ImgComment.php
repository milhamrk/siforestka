<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ImgComment extends CI_Model{
    function __construct() {
        $this->tableName = 'img_comment';
    }
    
    public function getImage($id){
        $this->db->select('id,file_name,uploaded_on,id_comment');
        $this->db->from('img_comment');
        if($id){
            $this->db->where('id_comment',$id);
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return $result;
    }

    public function insert($data){
        $insert = $this->db->insert('img_comment', $data);
        return $insert ? true : false;
    }
    
}