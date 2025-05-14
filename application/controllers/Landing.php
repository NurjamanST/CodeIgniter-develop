<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load Models
        $this->load->model(['Product_model', 'Collection_model', 'Category_model', 'News_model', 'Profile_model']);
        // Load Data
        $data['collections'] = $this->Collection_model->get_all();;
        $data['categories'] = $this->Category_model->get_all();

        // Load Views
        $this->load->view('Layout/head');
        $this->load->view('Layout/navbar_lp', $data);

    }
    // Halaman utama
    public function index() {
        // Load Data
        $data['products'] = $this->Product_model->get_limit_catalogues(8, 0);
        $data['categories'] = $this->Category_model->get_all();
        $data['collections'] = $this->Collection_model->get_all();
        $data['sliders'] = $this->db->order_by('urutan')->get_where('sliders', ['status' => 'aktif'])->result();
        $data['news'] = $this->News_model->get_all();

        $this->load->view('Pages/Pelanggan/index', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer');

    }
    // Menampilkan detail produk berdasarkan ID
    public function view($id) {
        $data['product'] = $this->Product_model->get_product_by_id($id);
        $data['categories'] = $this->Category_model->get_all();
        $data['collections'] = $this->Collection_model->get_all();;
        if (!$data['product']) {
            show_404(); // Tampilkan error jika produk tidak ditemukan
        }

        $this->load->view('Pages/Pelanggan/Products/detail_view', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer');
    }
    // Menampilkan list News
    public function news() {
        $data['news'] = $this->News_model->get_all();
        $data['categories'] = $this->Category_model->get_all();
        $data['collections'] = $this->Collection_model->get_all();;
        $this->load->view('Pages/Pelanggan/News/index', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer');
    }
    // Menampilkan detail news berdasarkan ID
    public function news_view($id) {
        $data['news'] = $this->News_model->get_news_by_id($id);
        // News dengan Limit
        $data['news_limit'] = $this->News_model->get_limit_news(3, 0);
        $data['categories'] = $this->Category_model->get_all();
        $data['collections'] = $this->Collection_model->get_all();
        if (!$data['news']) {
            show_404(); // Tampilkan error jika produk tidak ditemukan
        }

        $this->load->view('Pages/Pelanggan/News/view', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer');
    }
    // Menampilkan list About
    public function about() {
        // Load Data
        $data['categories'] = $this->Category_model->get_all();
        $data['collections'] = $this->Collection_model->get_all();
        $data['profile'] = $this->Profile_model->get();
        
        $this->load->view('Pages/Pelanggan/About/index', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer');
    }
}