<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileController extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        //$this->load->model('PostModel');
       
    }
	
	public function myProfile(){
        if (!empty($this->session->userdata('fName') != '')) {
            $this->load->view('profile', array('session' => $this->session->userdata));
        }else{
            redirect(base_url() . "UserController/loginView");
        }
		
	}
}