<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collections extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load Models
        $this->load->model([
            'Product_model',
            'Collection_model',
            'Category_model',
            'Product_image_model',
            'Profile_model'
        ]);

        // Load Data Navbar
        $data['collections'] = $this->Collection_model->get_all();
        $data['categories'] = $this->Category_model->get_all();

        // Load Layout
        $this->load->view('Layout/head');
        $this->load->view('Layout/navbar_lp', $data);
    }

    // Halaman utama collections
    public function index() {
        $data['collections'] = $this->Collection_model->get_all();
        $data['categories'] = $this->Category_model->get_all();
        $data['profile'] = $this->Profile_model->get();

        $this->load->view('Pages/Pelanggan/Collections/index', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer');
    }

    // Detail collection + list produk
    public function view($id) {
        $data['collection'] = $this->Collection_model->get_collection_by_id($id);
        if (!$data['collection']) show_404();

        $data['collections'] = $this->Collection_model->get_all();
        $data['categories'] = $this->Category_model->get_all();
        $data['products'] = $this->Product_model->get_products_by_collection($id);
        $data['profile'] = $this->Profile_model->get();

        // Ambil gambar pertama tiap produk
        foreach ($data['products'] as &$product) {
            $first_image = $this->Product_image_model->get_first_image_by_product($product->id);
            $product->first_image = $first_image ? $first_image->image : null;
        }

        $this->load->view('Pages/Pelanggan/Collections/view', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer', $data);
    }
}
