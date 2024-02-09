<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';
use chriskacerguis\RestServer\RestController;

class Restapi extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('PostModel');
        $this->load->model('UserModel');
    }
    
    public function comment_post(){
        $data = json_decode(trim(file_get_contents('php://input')), true);
        $this->PostModel->addComment($data);
    }

    public function comment_get(){
        $id = $this->uri->segment(2);
        $data = $this->PostModel->getAllComments($id);
        echo json_encode($data);
    }

    public function image_get(){
        $id = $this->uri->segment(2);
        $data = $this->PostModel->getImagesFromUserId($id);
        echo json_encode($data);
    }

    public function friendList_get(){
        $id = $this->uri->segment(2);
        $data = $this->UserModel->friendList($id);
        echo $data;
    }

    public function friend_post(){
        $id_user = $this->uri->segment(2);
        $id_friend = $this->uri->segment(3);
        $res = $this->UserModel->addFriend($id_user, $id_friend);
        echo json_encode(array('res' => $res));
    }

    public function friend_get(){
        $id = $this->uri->segment(2);
        $friend_id = $this->PostModel->getUserIDbyPost($id);
        echo json_encode($friend_id);
    }
}
