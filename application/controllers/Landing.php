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

		// Muat helper product_helper
			$this->load->helper('product_helper'); 

    }
    // Halaman utama
    public function index() {
        // Load Data
        $data['products'] = $this->Product_model->get_limit_catalogues(4, 0);
        
        $data['categories'] = $this->Category_model->get_all();
        $data['collections'] = $this->Collection_model->get_all();
        $data['sliders'] = $this->db->order_by('urutan')->get_where('sliders', ['status' => 'aktif'])->result();
        $data['news'] = $this->News_model->get_limit_news(4, 0);
		
		// Load Profile
		$this->load->model('Profile_model');
		$data['profile'] = $this->Profile_model->get();
		

        $this->load->view('Pages/Pelanggan/index', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer');

    }
	
	// Menampilkan daftar semua produk
	public function products() {
    $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
    $per_page = 8;
    $offset = ($page - 1) * $per_page;

    // Ambil produk
    $data['products'] = $this->Product_model->get_limit_catalogues($per_page, $offset);
    $total_products = $this->Product_model->count_all();
    $data['total_products'] = $total_products;

    // Konfigurasi pagination
    $config['base_url'] = base_url('index.php/Landing/products');
    $config['total_rows'] = $total_products;
    $config['per_page'] = $per_page;
    $config['use_page_numbers'] = TRUE;
    $config['page_query_string'] = TRUE;
    $config['query_string_segment'] = 'page';

    $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = '«';
    $config['last_link'] = '»';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo;';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
    $config['next_link'] = '&raquo;';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';
    $config['attributes'] = ['class' => 'page-link'];

    $this->pagination->initialize($config);

    // Data tambahan
    $data['categories'] = $this->Category_model->get_all();
    $data['collections'] = $this->Collection_model->get_all();

    // Load profile
    $this->load->model('Profile_model');
    $data['profile'] = $this->Profile_model->get();

    // Judul halaman
    $data['page_title'] = 'Semua Produk';

    // Load view
    $this->load->view('Pages/Pelanggan/Products/products', $data);
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

		// Load Profile
		$this->load->model('Profile_model');
		$data['profile'] = $this->Profile_model->get();

        $this->load->view('Pages/Pelanggan/Products/detail_view', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer');
    }
    // Menampilkan list News
    public function news() {
        $data['news'] = $this->News_model->get_all();
        $data['categories'] = $this->Category_model->get_all();
        $data['collections'] = $this->Collection_model->get_all();;

		// Load Profile
		$this->load->model('Profile_model');
		$data['profile'] = $this->Profile_model->get();

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


		// Load Profile
		$this->load->model('Profile_model');
		$data['profile'] = $this->Profile_model->get();

        $this->load->view('Pages/Pelanggan/News/view', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer');
    }
    // Menampilkan list About
    public function about() {
        // Load Data
        $data['categories'] = $this->Category_model->get_all();
        $data['collections'] = $this->Collection_model->get_all();
        // Load Profile
		$this->load->model('Profile_model');
		$data['profile'] = $this->Profile_model->get();
        $this->load->view('Pages/Pelanggan/About/index', $data);
        $this->load->view('Layout/addon-footer-lp', $data);
        $this->load->view('Layout/footer');
    }
}
