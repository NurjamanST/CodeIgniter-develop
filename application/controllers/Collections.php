<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Collections extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load Models
        $this->load->model(['Product_model', 'Collection_model', 'Category_model', 'News_model']);
        // Load Data
        $data['collections'] = $this->Collection_model->get_all();;
        $data['categories'] = $this->Category_model->get_all();

        // Load Views
        $this->load->view('Layout/head');
        $this->load->view('Layout/navbar_lp', $data);
    }

    // Halaman utama koleksi
    public function index() {
        // Load Data
        $data['collections'] = $this->Collection_model->get_all();;
        $data['categories'] = $this->Category_model->get_all();
        // Load Views
        $this->load->view('Pages/Pelanggan/Collections/index', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer');
    }

    // Detail koleksi berdasarkan ID
    public function view($id) {
        // Load Data
        $data['collection'] = $this->Collection_model->get_collection_by_id($id);
        $data['collections'] = $this->Collection_model->get_all();
        $data['categories'] = $this->Category_model->get_all();
        $data['products'] = $this->Product_model->get_products_by_collection($id);

        // Load produk berdasarkan koleksi
        if (!$data['collection']) {
            show_404();
        }
        // load view
        $this->load->view('Pages/Pelanggan/Collections/view', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer', $data);
    }
}