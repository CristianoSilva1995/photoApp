<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileController extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        //$this->load->model('PostModel');
       
    }
	
	public function myProfile(){
		$this->load->view('profile', array('session' => $this->session->userdata));
	}
}