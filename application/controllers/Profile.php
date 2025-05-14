<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation', 'session', 'upload',);
        $this->load->helper(array('form', 'url'));

        $admin = $this->session->userdata('admin');
        // var_dump($admin);
        // Cek apakah admin sudah login
        if (!$admin) {
            redirect('auth/login');
        }
        // Load Model
        $this->load->model('Profile_model');
        // Tampilkan dashboard dengan data admin
        $data['admin'] = $admin;
        $data['profile'] = $this->Profile_model->get();

        // $this->load->model('Install_model');
        $this->load->view('Layout/head');
        $this->load->view('Layout/header', $data);
        $this->load->view('Layout/aside', $data);

    }
    // Dashboard Admin = Profile Admin
    public function index() {
        // load model
        $this->load->model('Profile_model');
        $this->load->model('News_model');
        $data['profile'] = $this->Profile_model->get();
        $data['news'] = $this->News_model->get_all();
        $this->load->view('Pages/Admin/Profile/index', $data);
        $this->load->view('Layout/addon-footer');
        $this->load->view('Layout/footer');
    }
    // Profile details
    public function details() {
        $admin = $this->session->userdata('admin');
        $data['admin'] = $admin;
        // var_dump($admin);
        $data['profile'] = $this->Profile_model->get();
        $this->load->view('Pages/Admin/Profile/details', $data);
        $this->load->view('Layout/addon-footer');
        $this->load->view('Layout/footer');
    }
    public function update() {
        // Validasi input
        $this->form_validation->set_rules('brandname', 'Brand Name', 'required');
        $this->form_validation->set_rules('slogan', 'Slogan', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('visi', 'Visi', 'required');
        $this->form_validation->set_rules('misi', 'Misi', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');

        if (!empty($_FILES['logo_merek']['name'])) {
            $this->form_validation->set_rules('logo_merek', 'Logo Merek', 'callback__check_logo');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('profile/details');
        } else {
            $data = [
                'nama_merek' => $this->input->post('brandname'),
                'slogan' => $this->input->post('slogan'),
                'deskripsi' => $this->input->post('description'),
                'visi' => $this->input->post('visi'),
                'misi' => $this->input->post('misi'),
                'instagram' => $this->input->post('instagram'),
                'tiktok' => $this->input->post('tiktok'),
                'facebook' => $this->input->post('facebook'),
                'whatsapp' => $this->input->post('whatsapp'),
                'email' => $this->input->post('email')
            ];

            if (!empty($_FILES['logo_merek']['name'])) {
                $upload_dir = FCPATH . 'assets/uploads/profile/';
                
                // Buat folder otomatis (opsional)
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                $config = [
                    'upload_path'   => $upload_dir,
                    'allowed_types' => 'jpg|jpeg|png|gif',
                    'max_size'      => 2048,
                    'encrypt_name'  => TRUE,
                    'remove_spaces' => TRUE
                ];

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('logo_merek')) {
                    $error = $this->upload->display_errors();
                    log_message('error', 'Upload Error: ' . $error);
                    $this->session->set_flashdata('error', $error);
                    redirect('profile/details');
                }

                // Hapus logo lama
                $old_logo = $this->Profile_model->get_old_logo();
                if ($old_logo && file_exists(FCPATH . 'assets/uploads/profile/' . $old_logo)) {
                    unlink(FCPATH . 'assets/uploads/profile/' . $old_logo);
                }

                $upload_data = $this->upload->data();
                $data['logo_merek'] = $upload_data['file_name'];
            }

            // Update ke database
            $this->Profile_model->update($data);
            $this->session->set_flashdata('success', 'Profile updated successfully!');
            redirect('profile/details');
        }
    }

    // Callback upload
    public function _check_logo() {
        $config['upload_path'] = FCPATH . 'assets/uploads/profile/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('logo_merek')) {
            $this->form_validation->set_message('_check_logo', $this->upload->display_errors());
            return FALSE;
        }

        return TRUE;
    }

    // Edit Account
    // Method untuk update akun (username, email, password)
    public function update_account()
    {
        // Validasi input
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');

        // Jika new_password diisi, maka harus divalidasi juga
        if ($this->input->post('new_password')) {
            $this->form_validation->set_rules('new_password', 'New Password', 'min_length[6]');
            $this->form_validation->set_rules('renew_password', 'Re-Enter New Password', 'matches[new_password]');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('profile/details');
        } else {
            // Ambil data dari form
            $data = array(
                'nama' => $this->input->post('username'),
                'email' => $this->input->post('email'),
            );

            // Cek apakah current password benar
            $current_password = $this->input->post('current_password');
            $admin = $this->Admin_model->getAdmin();

            if (!password_verify($current_password, $admin->password)) {
                $this->session->set_flashdata('error', 'Incorrect current password');
                redirect('profile/details');
            }

            // Jika new_password diisi, update password baru
            if ($this->input->post('new_password')) {
                $data['password'] = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT);
            } else {
                // Jika tidak diisi, gunakan password lama
                $data['password'] = $admin->password;
            }

            // Update data
            $this->Admin_model->update_account($data);
            $this->session->set_flashdata('success', 'Account information updated successfully');
            redirect('Auth/logout');
        }
    }
}