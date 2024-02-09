<?php 
    class UserModel extends CI_Model{

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

        public function auth($email_req, $password_req){
            $this->db->where('email', $email_req);
            $res = $this->db->get('user');
            if($res->num_rows() == 0){
                return False;
            }else {
                $row = $res->row();  
                if(password_verify($password_req, $row->password)){
                    $this->session->set_userdata(array(
                        'fName' => $row->fName,
                        'id_user' => $row->id_user,
                        'logged_in' => 1));
                    return true;
                }else{
                    return false;
                }
            }
        }
        
        public function createUser($fName, $lName, $email, $password){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $data = array(
                'fName' => $fName,
                'lName' => $lName,
                'email' => $email,
                'password' => $hashed_password
            );
            $res = $this->db->insert('user', $data);
            return $res;
        }

        public function friendList($id){
            $arr = array();
            $this->db->from('user');
            $this->db->join('friend_list', 'user.id_user = friend_list.friend_id');
            $this->db->where('friend_list.user_id', $id);
            $res = $this->db->get();
            foreach ($res->result() as $row) {
                $arr[] = array(
                    'fName' => $row->fName
                );
            }
            return json_encode($arr);
        }

        public function verifyFriendship($id_user, $id_friend){
            $this->db->from('friend_list');
            $this->db->where('user_id', $id_user);
            $this->db->where('friend_id', $id_friend);
            $res = $this->db->get();
            return $res->num_rows();
        }

        public function addFriend($id_user, $id_friend){
            $id_user = (int) $id_user;
            $id_friend = (int) $id_friend;
            if(($this->UserModel->verifyFriendship($id_user,$id_friend)) < 1){
                $arr = array(
                    'user_id' => $id_user,
                    'friend_id' => $id_friend
                );
                $this->db->insert('friend_list', $arr);
                return 1;
            }else{
                return 0;
            }
        }

        public function getProfilePicture($id_user){
            $this->db->from('user');
            $this->db->where('user.id_user', $id_user);
            $res = $this->db->get();
            $getPhotoData = $res->row();
            $this->db->from('photo');
            $this->db->where('photo_id', $getPhotoData->profile_pic_id);
            $data = $this->db->get();
            $data = $data->row();

            $arr = array('file_name' => $data->file_name,
                        'description' => $data->description,
                        'about_me' => $getPhotoData->about_me);
            return json_encode($arr);
        }

        function setAboutMe($data){
            $this->db->where('id_user', $data['id_user']);
            $this->db->update('user', $data);
        }

        function verifyIfEmailExists($data){
            $this->db->where('email', $data['email']);
            $res = $this->db->get('user');
            return $res->num_rows();
        }
        
    } 
?>