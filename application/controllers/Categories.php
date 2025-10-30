<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load Models
        $this->load->model([
            'Product_model', 
            'Collection_model', 
            'Category_model', 
            'News_model', 
            'Product_image_model', // pastikan nama model sesuai
            'Profile_model'
        ]);

        // Load Data untuk navbar
        $data['collections'] = $this->Collection_model->get_all();
        $data['categories'] = $this->Category_model->get_all();

        // Load Views head + navbar
        $this->load->view('Layout/head');
        $this->load->view('Layout/navbar_lp', $data);
    }

    // Halaman utama kategori
    public function index() {
        $data['categories'] = $this->Category_model->get_all();
        $data['collections'] = $this->Collection_model->get_all();
        $data['profile'] = $this->Profile_model->get();

        $this->load->view('Pages/Pelanggan/Categories/index', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer');
    }

    // Detail kategori + list produk
    public function view($id) {
        $data['category'] = $this->Category_model->get_category_by_id($id);
        if (!$data['category']) show_404();

        $data['categories'] = $this->Category_model->get_all();
        $data['collections'] = $this->Collection_model->get_all();
        $data['products'] = $this->Product_model->get_products_by_category($id);
        $data['profile'] = $this->Profile_model->get();

        // Ambil gambar pertama tiap produk dari product_color_images
        foreach ($data['products'] as &$product) {
            $first_image = $this->Product_image_model->get_first_image_by_product($product->id);
            // Ganti 'image' dengan kolom yang benar di DB jika perlu
            $product->first_image = $first_image ? $first_image->image : null;
        }

        $this->load->view('Pages/Pelanggan/Categories/view', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer', $data);
    }

}
