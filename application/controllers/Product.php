<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation', 'upload', 'session');
        $this->load->helper(array('form', 'url', 'html', 'file'));
            $this->load->model('Product_color_model');   // <<--- tambahkan ini
    $this->load->model('Product_image_model');   // jika pakai untuk upload gambar
        $this->load->model('Product_color_images_model');
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
public function create_catalogue_debug()
{
    // Ambil input produk
    $nama_product  = $this->input->post('nama_product');
    $harga         = $this->input->post('harga');
    $koleksi_id    = $this->input->post('koleksi_id');
    $kategori_id   = $this->input->post('kategori_id');
    $shopee        = $this->input->post('shopee');
    $lazada        = $this->input->post('lazada');
    $tiktokshop    = $this->input->post('tiktokshop');
    $tokopedia     = $this->input->post('tokopedia');
    $keterangan    = $this->input->post('keterangan');

    // Simpan produk utama
    $product_id = $this->Product_model->insert_product([
        'nama_product' => $nama_product,
        'harga'        => $harga,
        'koleksi_id'   => $koleksi_id,
        'kategori_id'  => $kategori_id,
        'shopee'       => $shopee,
        'lazada'       => $lazada,
        'tiktokshop'   => $tiktokshop,
        'tokopedia'    => $tokopedia,
        'keterangan'   => $keterangan
    ]);

    echo "Product inserted with ID: $product_id<br>";

    // Upload folder
    $uploadPath = FCPATH . 'uploads/products/';
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
        echo "Folder upload dibuat: $uploadPath<br>";
    } else {
        echo "Folder upload OK: $uploadPath<br>";
    }

    // Ambil warna
    $colors = $this->input->post('color_name');
    if (!empty($colors)) {
        foreach ($colors as $index => $color_name) {
            // Simpan warna
            $color_id = $this->Product_color_model->create([
                'product_id' => $product_id,
                'nama_warna' => $color_name
            ]);
            echo "Color '$color_name' inserted with ID: $color_id<br>";

            // Cek file
            if (isset($_FILES['color_image']['name'][$index])) {
                $filesCount = count($_FILES['color_image']['name'][$index]);
                echo "Found $filesCount file(s) for color $color_name<br>";

                for ($f = 0; $f < $filesCount; $f++) {
                    if ($_FILES['color_image']['name'][$index][$f] != '') {
                        // Set array temporary untuk CI upload
                        $_FILES['userfile']['name']     = $_FILES['color_image']['name'][$index][$f];
                        $_FILES['userfile']['type']     = $_FILES['color_image']['type'][$index][$f];
                        $_FILES['userfile']['tmp_name'] = $_FILES['color_image']['tmp_name'][$index][$f];
                        $_FILES['userfile']['error']    = $_FILES['color_image']['error'][$index][$f];
                        $_FILES['userfile']['size']     = $_FILES['color_image']['size'][$index][$f];

                        // Config upload
                        $config = [
                            'upload_path'   => $uploadPath,
                            'allowed_types' => 'jpg|jpeg|png|gif',
                            'max_size'      => 2048,
                            'file_name'     => time() . '_' . rand(1000,9999)
                        ];

                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('userfile')) {
                            $data = $this->upload->data();

                            // Simpan ke DB
                            $this->Product_color_images_model->create([
                                'product_color_id' => $color_id,
                                'image'            => $data['file_name']
                            ]);

                            echo "Uploaded file: ".$data['file_name']."<br>";
                        } else {
                            echo "Upload error: ".$this->upload->display_errors()."<br>";
                        }
                    }
                }
            }
        }
    }

    echo "<br>Debug finished. Cek folder 'uploads/products/' dan tabel 'product_color_images'.";
}








	public function file_check($str, $field)
	{
		$config['upload_path']   = FCPATH . 'uploads/products/'; // path absolut
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; // KB
        $this->load->library('upload', $config);


		if (!empty($_FILES[$field]['name'])) {
			if (!$this->upload->do_upload($field)) {
				$this->form_validation->set_message('file_check', $this->upload->display_errors('', ''));
				return false;
			} else {
				// Hapus file sementara setelah validasi
				$data = $this->upload->data();
				@unlink($data['full_path']);
				return true;
			}
		} else {
			$this->form_validation->set_message('file_check', 'Silakan pilih file untuk ' . $field);
			return false;
		}
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

		// 
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

   public function detail($id)
{
    // Load model
    $this->load->model('Product_model');
    $this->load->model('Product_color_model');
    $this->load->model('Product_image_model');

    // Ambil data produk utama
    $data['product'] = $this->Product_model->get_product_by_id($id);

    // Ambil warna + gambar warna (gunakan fungsi yang baru kamu tambahkan di Product_color_model)
    $data['colors'] = $this->Product_color_model->get_colors_with_images($id);

    // Load view detail produk
    $this->load->view('Pages/Admin/Product/Catalogues/detail', $data);
    $this->load->view('Layout/addon-footer');
    $this->load->view('Layout/footer');
}




} 
