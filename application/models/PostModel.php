<?php 
    class PostModel extends CI_Model{

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
        
        public function getPhotoID($fileName){
            $this->db->where('file_name', $fileName);
            $res = $this->db->get('photo');
            $id = $res->row();
            return $id->photo_id;
        }

        public function uploadPicture($fileName, $tag, $user_id, $description){
            $data = array(
                'user_id' => $user_id,
                'file_Name' => $fileName,
                'tag' => $tag,
                'description' => $description
            );
            $res = $this->db->insert('photo', $data);
        }

        public function setProfilePic($id_user, $id_photo){
            $this->db->where('id_user', $id_user);
            $this->db->update('user', array('profile_pic_id' => $id_photo));
        }

        public function createPost($fileName, $tag, $user_id, $description, $profilePic){
            $this->PostModel->uploadPicture($fileName, $tag, $user_id,$description);
            $id_photo = $this->PostModel->getPhotoID($fileName);
            if($profilePic == 'on'){
                $this->PostModel->setProfilePic($user_id, $id_photo);
            }
            $data = array(
                'user_id' => $user_id,
                'photo_id' => $id_photo,
                'date_time' => date("Y-m-d h:i:sa"),
                'number_of_likes' => 0,
                'number_of_dislikes' => 0
            );
            $res = $this->db->insert('post', $data);
        }

        public function getPosterName($id){
            $this->db->from('user');
            $this->db->join('photo', 'photo.user_id = user.id_user');
            $this->db->where('photo.photo_id', $id);
            $res = $this->db->get();
            $data = $res -> row();
            return $data->fName;
        }

        public function getPostData($id){
            $this->db->from('photo');
            $this->db->join('post', 'post.photo_id = photo.photo_id');
            $this->db->where('post.photo_id', $id);
            $res = $this->db->get();
            $row = $res->row();
            $arr= array(
                'file_name' => $row->file_name,
                'number_of_likes' => $row->number_of_likes,
                'number_of_dislikes' => $row->number_of_dislikes,
                'description' => $row->description,
                'tag' => $row->tag,
                'post_id' => $row->post_id,
                'postFName' => $this->PostModel->getPosterName($id),
                'num_comments' => $this->HomeModel->getNumberOfComments($id)
            );
            return $arr;
        }

        function getAllComments($id){
            $arr = array();
            $this->db->where('post_id', $id);
            $res = $this->db->get('comment');
            foreach($res -> result() as $row){
                $arr[] = array(
                    'comment_id' => $row->comment_id,
                    'comment' => $row->comment);
            }
            return $arr;
        }

        function addComment($data){
            $this->db->insert('comment', $data);
        }
        function updateLike($data){
            $this->db->where('post_id', $data['post_id']);
            $this->db->update('post', $data);
        }

        function updateDislike($data){
            $this->db->where('post_id', $data['post_id']);
            $this->db->update('post', $data);
        }

        public function getImagesFromUserId($id){
            $this->db->from('photo');
            $this->db->join('user', 'user.id_user = photo.user_id');
            $this->db->where('user.id_user', $id);
            $res = $this->db->get();
            foreach ($res->result() as $row) {
                $arr[] = array(
                    'file_name' => $row->file_name
                );
            }
            return json_encode($arr);
        }

        public function getUserIDbyPost($id){
            $this->db->select('user_id');
            $this->db->from('post');
            $this->db->where('post_id', $id);
            $res = $this->db->get();
            $row = $res->row();
            return $row->user_id;
        }

        public function searchTag($tag){
            $arr = array();
            $this->db->from('photo');
            $this->db->where('tag', $tag);
            $res = $this->db->get();
            foreach ($res -> result() as $row){
                $arr[] = array('file_name' => $row->file_name);
            }
            return $arr;
        }

        public function getNumComments($id){
            $this->db->where('post_id', $id);
            $res = $this->db->get('comment');
            return $res->num_rows();
        }
    } 
?>