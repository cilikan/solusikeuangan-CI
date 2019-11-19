<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_register');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        //register
        if (isset($_POST['register'])) {
            $password1 = $this->input->post('password1');
            $password2 = $this->input->post('password2');
            $email = $this->input->post('email');
            $this->form_validation->set_rules('email', 'Email', 'is_unique[user.email]');
            $this->form_validation->set_rules('password1', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password1]');
            if ($this->form_validation->run() == TRUE) {
                $data_user = array(
                    'email' => $email,
                    'password' => md5($password1)
                );
                $data_syarat = array(
                    'email' => $email
                );
                $this->M_register->daftarkan('user',$data_user);
                $this->M_register->daftarkan('syarat',$data_syarat);
                $this->session->set_flashdata("terdaftar","Akun anda telah terdaftar, anda dapat login sekarang");
                redirect("register","refresh");
            }
        }

        //login
        if (isset($_POST['login'])) {
            $password = md5($this->input->post('password'));
            $email = $this->input->post('email');
            $ada = $this->db->get_where('user', array('email' => $email))->num_rows();
            if($ada > 0){
                $data = $this->M_register->get_select('user',array('email' => 'email', 'password' => 'password'),'email',$email)->result_array();
                if($password == $data[0]['password']){
                    $this->session->set_userdata('logged','terlogin');
                    $this->session->set_userdata('email',$data[0]['email']);
                    redirect("dashboard");
                }
                else{
                    $this->session->set_flashdata('kesalahan','Password Salah');
                    redirect("register","refresh");
                }
            }
            else{
                $this->session->set_flashdata('kesalahan','Akun tidak ditemukan');
                redirect("register","refresh");
            }
        }
        $this->load->view('register');
    }
}
