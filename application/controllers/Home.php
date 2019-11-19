<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        //pengalihan jika belum login
        if (isset($_SESSION['logged'])) {
            redirect('dashboard');
        }
        $this->load->view('landing');
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('home');
    }
}
