<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation', 'upload', 'session');
        $this->load->helper(array('form', 'url', 'html', 'file'));
        // Load session library
        $admin = $this->session->userdata('admin');
        // var_dump($admin);
        // Cek apakah admin sudah login
        if (!$admin) {
            redirect('auth/login');
        }
        // Load Model
        $this->load->model(['Product_model', 'Collection_model', 'Category_model', 'News_model', 'Profile_model']);

        // Tampilkan dashboard dengan data admin
        $data['admin'] = $admin;
        $data['profile'] = $this->Profile_model->get();

        // $this->load->model('Install_model');
        $this->load->view('Layout/head');
        $this->load->view('Layout/header', $data);
        $this->load->view('Layout/aside');

    }
    public function index() {
        $this->load->model('News_model');
        $data['news'] = $this->News_model->get_all();
        $this->load->view('Pages/Admin/News/index', $data);
        $this->load->view('Layout/addon-footer');
        $this->load->view('Layout/footer');
    }
    public function create() {
        $this->load->library(['form_validation', 'upload']);
    
        // Validasi form
        $this->form_validation->set_rules('tanggal', 'Upload Date', 'required');
        $this->form_validation->set_rules('judul', 'Narrative Title', 'required');
        $this->form_validation->set_rules('narasi', 'Narrative Text', 'required');
        
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('danger', '<div class="alert alert-danger">' . validation_errors() . '</div>');
            // var_dump($this->input->post('judul'));
            // var_dump($this->input->post('narasi'));
            // var_dump($this->input->post('tanggal'));
            redirect('News/index');
            return;
        }
    
        // Konfigurasi upload gambar
        $config['upload_path']   = './assets/uploads/news/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['encrypt_name']  = TRUE;
    
        // Buat folder jika belum ada
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
    
        $this->upload->initialize($config);
    
        if (!$this->upload->do_upload('gambar')) {
            // Tampilkan error upload
            $error = $this->upload->display_errors();
            echo '<h3>Upload Gagal:</h3>';
            echo '<pre>' . $error . '</pre>';
            echo '<pre>FILES:</pre>';
            print_r($_FILES);
            return;
        }
    
        // Ambil data gambar
        $upload_data = $this->upload->data();
    
        // Siapkan data untuk disimpan
        $data = [
            'judul'   => $this->input->post('judul'),
            'narasi'     => $this->input->post('narasi'),
            'tanggal' => $this->input->post('tanggal'),
            'gambar'  => $upload_data['file_name']
        ];
    
        // Debug: tampilkan data sebelum disimpan
        echo '<h3>Debug: Data yang akan disimpan:</h3>';
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    
        // Simpan data
        if ($this->News_model->insert($data)) {
            // Tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Berita berhasil ditambahkan!');
            redirect('News/index');
        } else {
            // Tampilkan pesan gagal
            $this->session->set_flashdata('danger', 'Gagal menyimpan berita!');
            redirect('News/index');
        }
    }
    public function update() {
        $this->load->library(['form_validation', 'upload']);
    
        // Validasi form
        $this->form_validation->set_rules('tanggal', 'Upload Date', 'required');
        $this->form_validation->set_rules('judul', 'Narrative Title', 'required');
        $this->form_validation->set_rules('narasi', 'Narrative Text', 'required');
        
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('danger', '<div class="alert alert-danger">' . validation_errors() . '</div>');
            redirect('News/index');
            return;
        }
    
        // Konfigurasi upload gambar
        $config['upload_path']   = './assets/uploads/news/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['encrypt_name']  = TRUE;
    
        // Buat folder jika belum ada
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
    
        $this->upload->initialize($config);
    
        // Cek apakah ada file yang diupload
        if ($_FILES['gambar']['name']) {
            if (!$this->upload->do_upload('gambar')) {
                // Tampilkan error upload
                $error = $this->upload->display_errors();
                echo '<h3>Upload Gagal:</h3>';
                echo '<pre>' . $error . '</pre>';
                echo '<pre>FILES:</pre>';
                print_r($_FILES);
                return;
            }
    
            // Ambil data gambar
            $upload_data = $this->upload->data();
            $data['gambar'] = $upload_data['file_name'];
        }
    
        // Siapkan data untuk disimpan
        $data['judul']   = $this->input->post('judul');
        $data['narasi']     = $this->input->post('narasi');
        $data['tanggal'] = $this->input->post('tanggal');
    
        // Debug: tampilkan data sebelum disimpan
        echo '<h3>Debug: Data yang akan disimpan:</h3>';
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    
        // Simpan data
        if ($this->News_model->update($this->input->post('id'), $data)) {
            // Tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Berita berhasil diperbarui!');
            redirect('News/index');
        } else {
            // Tampilkan pesan gagal
            $this->session->set_flashdata('danger', 'Gagal memperbarui berita!');
            redirect('News/index');
        }
    }
    public function delete()
    {
        // Load model
        $this->load->model('News_model');

        // Ambil ID dari form
        $id = $this->input->post('id');

        // Ambil data news berdasarkan ID untuk mendapatkan nama file gambar
        $news = $this->News_model->getById($id);
        if (!$news) {
            $this->session->set_flashdata('danger', 'Data tidak ditemukan.');
            redirect('News/index');
            return;
        }

        // Hapus gambar jika ada
        $gambarPath = './assets/uploads/news/' . $news->gambar;
        if ($news->gambar && file_exists($gambarPath)) {
            unlink($gambarPath);
        }

        // Hapus dari database
        if ($this->News_model->delete($id)) {
            $this->session->set_flashdata('success', 'Narrative berhasil dihapus.');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menghapus narrative.');
        }

        redirect('News/index');
    }

}