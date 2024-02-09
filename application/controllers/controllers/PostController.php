<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PostController extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->model('PostModel');
        $this->load->model('HomeModel');
    }
	
	public function post(){
		$this->load->view('post', $this->session->userdata);
	}

    public function upload(){
	    
        $config['allowed_types'] = 'jpg|png';
        $config['upload_path'] = './upload/';
        $this->load->library('Upload', $config);    
        if ($this->upload->do_upload('fileupload')) {
            $file_name = $this->upload->data('file_name');
            $this->PostModel->createPost($file_name, $this->input->post('tag'),$this->session->userdata['id_user'], $this->input->post('description'), $this->input->post('profilePic'));
            // redirect(base_url() . 'UserController/homePage');
            
        }else{
            print_r($this->upload->display_errors());
        }
    }
    
    public function getImg(){
        $id = $this->uri->segment(3);
        $postData = $this->PostModel->getPostData($id);
        $this->load->view('displayPost', array('session' => $this->session->userdata,
                        'photo_id' => $id,
                        'file_name' => $postData['file_name'],
                        'number_of_likes' => $postData["number_of_likes"],
                        'number_of_dislikes' => $postData["number_of_dislikes"],
                        'description' => $postData['description'],
                        'tag' => $postData['tag'],
                        'post_id' => $postData['post_id'],
                        'postFName' => $postData['postFName'],
                        'num_comments' => $postData["num_comments"]));
        
    }
    public function updateLike(){
        $data = json_decode(trim(file_get_contents('php://input')), true);
        $this->PostModel->updateLike($data);
        echo json_encode($data);
    }

    public function updateDislike(){
        $data = json_decode(trim(file_get_contents('php://input')), true);
        $this->PostModel->updateDislike($data);
        echo json_encode($data);
    }

    public function searchByTag(){
        $tag = $this->uri->segment(3);
        $data = $this->PostModel->searchTag($tag);
        echo json_encode($data);
    }
}