<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek sesi admin
        if (!$this->session->userdata('admin')) {
            redirect('auth/login');
        }
        $this->load->model(['Banner_model', 'Profile_model']);
        $this->load->helper(['url', 'form']);
        $this->load->library('upload');
    }

    /**
     * Menampilkan halaman utama untuk mengelola banner.
     */
    public function index() {
        $admin = $this->session->userdata('admin');
        $data['admin'] = $admin;
        $data['profile'] = $this->Profile_model->get();
        $data['banner'] = $this->Banner_model->get_banner('Best Selling');

        $this->load->view('Layout/head');
        $this->load->view('Layout/header', $data);
        $this->load->view('Layout/aside', $data);
        $this->load->view('Pages/Admin/Banner/index', $data); // View baru
        $this->load->view('Layout/addon-footer');
        $this->load->view('Layout/footer');
    }

    /**
     * Memproses pembaruan banner.
     */
    public function update() {
        $nama_banner = 'Best Selling';
        $banner = $this->Banner_model->get_banner($nama_banner);

        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = 2048; // 2MB

        $this->upload->initialize($config);

        $data = [];

        // Cek jika ada file gambar yang diunggah
        if (!empty($_FILES['gambar']['name'])) {
            if ($this->upload->do_upload('gambar')) {
                // Hapus gambar lama jika ada
                if ($banner->gambar && file_exists($config['upload_path'] . $banner->gambar) && $banner->gambar != 'bestselling.png') {
                    unlink($config['upload_path'] . $banner->gambar);
                }
                $upload_data = $this->upload->data();
                $data['gambar'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('banner');
                return;
            }
        }

        // Ambil data teks dari form
        $data['teks'] = $this->input->post('teks');

        // Lakukan pembaruan jika ada data yang akan diubah
        if (!empty($data)) {
            if ($this->Banner_model->update_banner($nama_banner, $data)) {
                $this->session->set_flashdata('success', 'Banner berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui banner.');
            }
        } else {
            $this->session->set_flashdata('success', 'Tidak ada perubahan yang disimpan.');
        }
        
        redirect('banner');
    }
}
