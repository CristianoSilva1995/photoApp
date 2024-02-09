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

	public function homePage(){
		if(($this->session->userdata)){
			$this->load->view('home', $this->session->userdata);
		}else{
            $this->load->view('login');
        }
	}

	public function login(){
		$email = $this->input->post("email");
		$password = $this->input->post("password");
        if($this->UserModel->auth($email, $password)){
			$this->homePage();
		}else{
			return 0;
		}
	}

	public function signup(){
		$this->load->view('createAccount');
	}

	public function newUser(){
		$fName = $this->input->post("fName");
		$lName = $this->input->post("lName");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
        $this->UserModel->createUser($fName, $lName, $email, $password);
        $this->load->view('login');
	}

	public function getProfilePicture(){
		$id_user = $this->uri->segment(3);
		$data = $this->UserModel->getProfilePicture($id_user);
		echo $data;
	}
	
	public function signOut(){
		$this->session->sess_destroy();
		redirect(base_url() . 'UserController/loginView');
	}

	public function setAboutMe(){
		$data = json_decode(trim(file_get_contents('php://input')), true);
		$this->UserModel->setAboutMe($data);
	}
}
