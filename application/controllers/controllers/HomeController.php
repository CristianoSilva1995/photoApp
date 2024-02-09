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
        $this->load->view('home', $this->session->userdata);
    }

    public function getImages()
    {
        $imgData = $this->HomeModel->getImages();
        echo json_encode($imgData);
    }
}
