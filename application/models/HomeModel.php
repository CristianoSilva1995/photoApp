<?php 
    class HomeModel extends CI_Model{

        public function __construct()
        {
            $this->load->database();
        }

       function isUserLoggedIn(){
            if(isset($this->session->isUserLoggedIn)){
                return $this->session->isUserLoggedIn;
            }else {
                return false;
            }
       }

        function getNumberOfComments($photo_id){
            $this->db->where('photo_id', $photo_id);
            $res = $this->db->get('post');
            $data = $res->row();
            $this->db->where('post_id', $data->post_id);
            $result = $this->db->get('comment');
            return $result->num_rows();
        }
        public function getImages(){
            $arr = array();
            $this->db->from('photo');
            $this->db->join('post', 'post.photo_id = photo.photo_id');
            $this->db->join('user', 'user.id_user = post.user_id');
            $res = $this->db->get();
            foreach ($res->result() as $row) {
                $arr[] = array('photo_id' => $row->photo_id,
                                'file_name' =>$row->file_name,
                                'number_of_likes' => $row->number_of_likes,
                                'number_of_dislikes' => $row->number_of_dislikes,
                                'fName' => $row->fName,
                                'tag' => $row->tag,
                                'num_comments' => $this->HomeModel->getNumberOfComments($row->photo_id));
            }
            return json_encode($arr);
        }

        public function getImgPath($id){
            $this->db->where('photo_id', $id);
            $res = $this->db->get('photo');
            foreach ($res->result() as $row) {
                $data = $row->file_name;               
            }
            return $data;
        }
        
    } 
?>