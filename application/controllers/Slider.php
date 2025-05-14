<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation', 'session', 'upload');
        $this->load->helper(array('form', 'url'));

        // Cek apakah admin sudah login
        if (!$this->session->userdata('admin')) {
            redirect('auth/login');
        }

        // Load Model
        $this->load->model('Slider_model');
        $this->load->model('Profile_model');

        // Tampilkan dashboard dengan data admin
        $data['admin'] = $this->session->userdata('admin');
        $data['profile'] = $this->Profile_model->get();
        $this->load->view('Layout/head');
        $this->load->view('Layout/header', $data);
        $this->load->view('Layout/aside', $data);
    }

    public function index() {
        $data['sliders'] = $this->db->order_by('urutan')->get('sliders')->result();
        
        $this->load->view('Pages/Admin/Slider/list', $data);
        $this->load->view('Layout/addon-footer');
        $this->load->view('Layout/footer');
    }

    public function save() {
        // Validasi
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[aktif,nonaktif]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect("Slider/index");
        }

        // Ambil urutan terakhir dari database
        $next_urutan = $this->Slider_model->get_next_urutan();

        // Konfigurasi upload
        $config = [
            'upload_path'   => './assets/uploads/sliders/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'encrypt_name'  => TRUE,
            'max_size'     => 2048
        ];

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $this->upload->initialize($config);

        // Cek apakah file diupload
        if (!$this->upload->do_upload('gambar')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect("Slider/index");
        }

        $upload_data = $this->upload->data();
        $data = [
            'gambar' => $upload_data['file_name'],
            'status' => $this->input->post('status'),
            'urutan' => $next_urutan
        ];

        if ($this->Slider_model->tambah_slider($data)) {
            $this->session->set_flashdata('success', 'Slide berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan slide');
        }

        redirect('Slider/index');
    }

    public function update() {
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[aktif,nonaktif]');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required|integer');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($this->agent->referrer());
        }

        $id = $this->input->post('id');
        $slider = $this->Slider_model->get_by_id($id);

        $config = [
            'upload_path'   => './assets/uploads/sliders/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'encrypt_name'  => TRUE,
            'max_size'      => 2048
        ];

        $this->upload->initialize($config);
        $data = [
            'status' => $this->input->post('status'),
            'urutan' => $this->input->post('urutan')
        ];

        // Jika ganti gambar
        if (!empty($_FILES['gambar']['name'])) {
            if ($this->upload->do_upload('gambar')) {
                $upload_data = $this->upload->data();
                $data['gambar'] = $upload_data['file_name'];

                // Hapus gambar lama
                if ($slider && file_exists($config['upload_path'] . '/' . $slider->gambar)) {
                    unlink($config['upload_path'] . '/' . $slider->gambar);
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect($this->agent->referrer());
            }
        }

        // Update ke database
        if ($this->Slider_model->update_slider($id, $data)) {
            $this->fix_urutan();
            $this->session->set_flashdata('success', 'Data slider berhasil diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui slider');
        }

        redirect('Slider/index');
    }

    // Hapus slider + gambar
    public function delete($id) {
        $slider = $this->Slider_model->get_by_id($id);
        if ($slider && file_exists('./assets/uploads/sliders/' . $slider->gambar)) {
            unlink('./assets/uploads/sladers/' . $slider->gambar); // Hapus file
        }

        if ($this->Slider_model->hapus_slider($id)) {
            $this->fix_urutan(); // Perbaiki urutan setelah hapus
            $this->session->set_flashdata('success', 'Slider berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus slider');
        }

        redirect('slider/index');
    }

    // Re-urutkan ulang slider
    private function fix_urutan() {
        $this->Slider_model->reorder_sliders();
    }
}


?>