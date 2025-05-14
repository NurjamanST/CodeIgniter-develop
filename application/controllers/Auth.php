<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // $this->load->model('Install_model');
        $this->load->view('Layout/head');

    }

    public function login() {
        $this->load->view('auth/login');
        $this->load->view('Layout/head');
        $this->load->view('Layout/footer');

    }
    public function do_login() {
        $this->load->model('Admin_model');

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $admin = $this->Admin_model->get_by_email($email);
        // var_dump($admin);
        if ($admin && password_verify($password, $admin->password)) {
            $this->session->set_userdata('admin', $admin);
            redirect('profile');
        } else {
            $this->session->set_flashdata('error', 'Email atau password salah');
            redirect('auth/login');
        }
    }
    public function logout() {
        $this->session->unset_userdata('admin');
        redirect('auth/login');
    }
}