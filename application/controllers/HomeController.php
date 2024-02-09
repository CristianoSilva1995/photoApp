<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('HomeModel');
    }
    public function home(){
        if(!empty($this->session->userdata('fName') != '')){
            $this->load->view('home', $this->session->userdata);
		}else{
            redirect(base_url() . "UserController/loginView");
        }
    }

    public function getImages()
    {
        $imgData = $this->HomeModel->getImages();
        echo json_encode($imgData);
    }
}
