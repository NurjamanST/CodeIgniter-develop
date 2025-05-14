<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
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
        $this->load->model(['Product_model', 'Collection_model', 'Category_model', 'Profile_model']);    
        // Tampilkan dashboard dengan data admin
        $data['admin'] = $admin;
        $data['profile'] = $this->Profile_model->get();

        // $this->load->model('Install_model');
        $this->load->view('Layout/head');
        $this->load->view('Layout/header', $data);
        $this->load->view('Layout/aside', $data);

    }
    // Dashboard Admin = Product
    public function collections() {

        $collections = $this->Collection_model->get_all();
        $categories = [];
        foreach ($collections as $collection) {
          $categories[$collection->id] = $this->Category_model->get_categories_by_collection($collection->id);
        }

        $data['collections'] = $collections;
        $data['categories'] = $categories;
        $this->load->view('Pages/Admin/Product/Collections/index', $data);
        $this->load->view('Layout/addon-footer');
        $this->load->view('Layout/footer');
    }
    // create product
    public function create() {
        if ($this->input->post()) {
            $this->Product_model->insert($this->input->post());
            redirect('product');
        }
        $data['collections'] = $this->Collection_model->get_all();
        $data['categories'] = $this->Category_model->get_all();
        $this->load->view('product/create', $data);
    }
    // create collections
    public function create_collections() {
        if ($this->input->post()) {
            $this->Collection_model->insert($this->input->post());
            redirect('product/collections');
        }
        $this->load->view('product/create_collections');
    }
    // update collections
    public function update_collections() {
        
        $id = $this->input->post('id');
        $data = [
            'nama_koleksi' => $this->input->post('nama_koleksi'),
        ];
        $this->Collection_model->update($id, $data);
        redirect('product/collections');
    }
    // delete_collections
    public function delete_collections() {
        $id = $this->input->post('id');
        $this->Collection_model->delete($id);
        redirect('product/collections');
    }
    // create category
    public function create_category() {
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori'),
            'koleksi_id' => $this->input->post('collection_id'),
        ];
        $this->Category_model->create($data);
        redirect('product/collections'); // atau sesuaikan
    }
    // update category
    public function update_category() {
        $id = $this->input->post('id');
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori')
        ];
        $this->Category_model->update($id, $data);
        redirect('product/collections');
    }
    // delete category
    public function delete_category() {
        $id = $this->input->post('id');
        $this->Category_model->delete($id);
        redirect('product/collections');
    }
    // get categories by collection id
    public function get_categories_by_koleksi($koleksi_id) {
        $this->load->model('Product_model');
        $categories = $this->Product_model->get_categories_by_koleksi($koleksi_id);
    
        // Pastikan tidak ada output lain!
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($categories));
    }

    public function catalogues()
    {
        $data['collections'] = $this->Collection_model->get_all();
        $data['categories'] = $this->Category_model->get_all();
        $data['catalogues'] = $this->Product_model->get_all_catalogues();
        $this->load->view('Pages/Admin/Product/Catalogues/index', $data);
        $this->load->view('Layout/addon-footer');
        $this->load->view('Layout/footer');
    }

    //  create catalogue
    public function create_catalogue()
    {
        $this->load->library(['form_validation', 'upload']);

        // Validasi form input
        $this->form_validation->set_rules('nama_product', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('koleksi_id', 'Koleksi', 'required|integer');
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required|integer');
        $this->form_validation->set_rules('shopee', 'Shopee', 'required|valid_url');
        $this->form_validation->set_rules('lazada', 'Lazada', 'required|valid_url');
        $this->form_validation->set_rules('tiktokshop', 'Tiktokshop', 'required|valid_url');
        $this->form_validation->set_rules('tokopedia', 'Tokopedia', 'required|valid_url');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('danger', validation_errors());
            // redirect('product/catalogues');
            return;
        }

        // Konfigurasi upload
        $config['upload_path'] = './uploads/products/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['encrypt_name'] = TRUE;
        // $config['max_size'] = 5048;

        // Buat folder jika belum ada
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $gambar = [];
        // Upload gambar
        $upload_count = 0;
        $upload_errors = [];

        for ($i = 1; $i <= 5; $i++) {
            $field = 'gambar' . $i;
            $gambar[$field] = null;

            if (!empty($_FILES[$field]['name'])) {
                $this->upload->initialize($config);
    
                if ($this->upload->do_upload($field)) {
                    $uploaded = $this->upload->data();
                    $gambar[$field] = $uploaded['file_name'];
                    $upload_count++;
                } else {
                    $upload_errors[] = "Gagal upload $field: " . strip_tags($this->upload->display_errors('', ''));
                }
            }
        }

        // Validasi minimal 1 gambar berhasil diupload
        if ($upload_count === 0) {
            $this->session->set_flashdata('danger', 'Minimal 1 gambar produk harus diupload.');
            if (!empty($upload_errors)) {
                $this->session->set_flashdata('upload_errors', implode('<br>', $upload_errors));
            }
            redirect('product/form_tambah'); // Ganti sesuai form
            return;
        }

        echo '<pre>';
        print_r($_FILES);
        echo '</pre>';
        
        // Menyimpan data produk
        $data = [
            'nama_product'      => $this->input->post('nama_product'),
            'harga'             => $this->input->post('harga'),
            'koleksi_id'        => $this->input->post('koleksi_id'),
            'kategori_id'       => $this->input->post('kategori_id'),
            'gambar1'           => $gambar['gambar1'] ?? null,
            'gambar2'           => $gambar['gambar2'] ?? null,
            'gambar3'           => $gambar['gambar3'] ?? null,
            'gambar4'           => $gambar['gambar4'] ?? null,
            'gambar5'           => $gambar['gambar5'] ?? null,
            'shopee'            => $this->input->post('shopee'),
            'lazada'            => $this->input->post('lazada'),
            'tiktokshop'        => $this->input->post('tiktokshop'),
            'tokopedia'         => $this->input->post('tokopedia'),
            'keterangan'        => $this->input->post('keterangan'),
        ];
        
        // Debugging
        echo '<pre>';
        print_r($data);
        echo '</pre>';

        // Simpan ke database
        $this->Product_model->insert_product($data);
        $this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
        redirect('product/catalogues');
    }
    

    // Fungsi bantu untuk handle upload file (bisa diletakkan di bawah create_catalogue)
    private function _upload_file($field, $config)
    {
        if (!empty($_FILES[$field]['name'])) {
            $this->upload->initialize($config);
            if ($this->upload->do_upload($field)) {
                return $this->upload->data('file_name');
            } else {
                // Log atau tampilkan error (sementara)
                log_message('error', $this->upload->display_errors());
                return null;
            }
        }
        return null;
    }

    // Fungsi untuk menampilkan form edit produk 
    public function update_catalogue()
    {
        $id = $this->input->post('id');

        // Ambil data lama untuk cek gambar yang sudah ada
        $oldData = $this->Product_model->get_by_id($id);

        $data = [
            'nama_product' => $this->input->post('nama_product'),
            'harga' => $this->input->post('harga'),
            'koleksi_id' => $this->input->post('koleksi_id'),
            'kategori_id' => $this->input->post('kategori_id'),
            'shopee' => $this->input->post('shopee'),
            'lazada' => $this->input->post('lazada'),
            'tiktokshop' => $this->input->post('tiktokshop'),
            'tokopedia' => $this->input->post('tokopedia'),
            'keterangan' => $this->input->post('keterangan'),
        ];

        $uploadPath = './uploads/products/';
        $this->load->library('upload');

        for ($i = 1; $i <= 5; $i++) {
            $fileField = 'gambar' . $i;
            if (!empty($_FILES[$fileField]['name'])) {
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = time() . '_' . $i . '_' . $_FILES[$fileField]['name'];
                $this->upload->initialize($config);

                if ($this->upload->do_upload($fileField)) {
                    // Hapus gambar lama jika ada
                    if (!empty($oldData->$fileField) && file_exists($uploadPath . $oldData->$fileField)) {
                        unlink($uploadPath . $oldData->$fileField);
                    }

                    $data[$fileField] = $this->upload->data('file_name');
                }
            }
        }

        $this->Product_model->update_catalogue($id, $data);
        redirect('Product/catalogues');
    }

    public function delete_catalogue()
    {
        $id = $this->input->post('id');

        // Ambil data produk dulu buat hapus gambar
        $produk = $this->Product_model->get_catalogue_by_id($id);

        // Hapus gambar-gambar jika ada
        $uploadPath = './uploads/products/';
        for ($i = 1; $i <= 5; $i++) {
            $field = 'gambar' . $i;
            if (!empty($produk->$field) && file_exists($uploadPath . $produk->$field)) {
                unlink($uploadPath . $produk->$field);
            }
        }

        // Hapus dari DB
        $this->Product_model->delete_catalogue($id);

        redirect('Product/catalogues');
    }


} 