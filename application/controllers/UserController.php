<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }
	
	public function loginView(){
		$this->load->view('login');
	}

	public function login(){
		$data = json_decode(trim(file_get_contents('php://input')), true);
        if($this->UserModel->auth($data['email'], $data['password'])){
			$res = 1;
		}else{
			$res = 0;
		}
		echo json_encode(array('res' => $res));
	}

	public function signup(){
		$this->load->view('createAccount');
	}

	public function newUser(){
		$data = json_decode(trim(file_get_contents('php://input')), true);
        $res = $this->UserModel->createUser($data['fName'], $data['lName'], $data['email'], $data['password']);
        echo json_encode(array('res' => $res));
	}

	public function getProfilePicture(){
		$id_user = $this->uri->segment(2);
		$data = $this->UserModel->getProfilePicture($id_user);
		echo $data;
	}
	
	public function signOut(){
		$this->session->sess_destroy();
		redirect(base_url() . 'index.php/login');
	}

	public function setAboutMe(){
		$data = json_decode(trim(file_get_contents('php://input')), true);
		$this->UserModel->setAboutMe($data);
	}

	public function verifyEmail(){
		$data = json_decode(trim(file_get_contents('php://input')), true);
		$emailExists = $this->UserModel->verifyIfEmailExists($data);
		echo json_encode(array('emailExists' => $emailExists));
	}
}
