<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
 
   public function get_all_catalogues()
{
$this->db->select('
    p.*, 
    c.nama_koleksi, 
    k.nama_kategori,
    MAX(pci.image) as image
');

    $this->db->from('products p');
    $this->db->join('collections c', 'p.koleksi_id = c.id', 'left');
    $this->db->join('categories k', 'p.kategori_id = k.id', 'left');
    $this->db->join('product_color pc', 'pc.product_id = p.id', 'left');
    $this->db->join('product_color_images pci', 'pci.product_color_id = pc.id', 'left');
    $this->db->group_by('p.id');
    $this->db->order_by('p.id', 'ASC');

    $result = $this->db->get()->result();

    // Kelompokkan gambar jadi array per produk
     foreach ($result as &$row) {
      $row->images = $this->db
            ->select('pci.image') // <— ini barisnya
            ->from('product_color_images pci')
            ->join('product_color pc', 'pci.product_color_id = pc.id', 'left')
            ->where('pc.product_id', $row->id)
            ->get()
            ->result();
    }
    return $result;
}

	// Ambil sebagian produk untuk pagination
	// public function get_limit_catalogues($limit, $offset) {
	// 	return $this->db->get('products', $limit, $offset)->result();
	// }

	// Hitung total semua produk
	public function count_all() {
		return $this->db->count_all('products'); // Hitung semua baris di tabel products
	}
    // Fungsi ini digunakan untuk mendapatkan produk dengan limit tertentu
    public function get_limit_catalogues($limit, $offset)
    {
        $this->db->select('
            products.*, 
            collections.nama_koleksi, 
            categories.nama_kategori
        ');
        $this->db->from('products');
        $this->db->join('collections', 'products.koleksi_id = collections.id', 'left');
        $this->db->join('categories', 'products.kategori_id = categories.id', 'left');
        $this->db->order_by('products.created_at', 'DESC');
        return $this->db->get('', $limit, $offset)->result();
    }
    // Fungsi ini digunakan untuk menghitung jumlah total produk dalam tabel 'products'
    public function get_catalogue_count()
    {
        return $this->db->count_all('products');
    }

    // Fungsi untuk menyimpan produk baru
    public function insert_product($data)
{
    $this->db->insert('products', $data);
    return $this->db->insert_id(); // tambahkan ini untuk ambil ID produk
}

    public function update_catalogue($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete_catalogue($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }

    public function get_catalogue_by_id($id)
    {
        return $this->db->where('id', $id)->get('products')->row();
    }

    public function get_categories_by_koleksi($koleksi_id)
    {
        $this->db->select('categories.id, categories.nama_kategori');
        $this->db->from('categories');
        $this->db->where('categories.koleksi_id', $koleksi_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row(); 
    }
    public function get_product_by_id($id)
    {
        $this->db->select('products.*, categories.nama_kategori, collections.nama_koleksi');
        $this->db->from('products');
        $this->db->join('categories', 'products.kategori_id = categories.id', 'left');
        $this->db->join('collections', 'products.koleksi_id = collections.id', 'left');
        $this->db->where('products.id', $id);
        return $this->db->get()->row();
    }
    public function get_products_by_collection($collection_id)
    {
       
        $this->db->select('products.*, categories.nama_kategori, collections.nama_koleksi');
        $this->db->from('products');
        $this->db->join('categories', 'products.kategori_id = categories.id', 'left');
        $this->db->join('collections', 'products.koleksi_id = collections.id', 'left');
        $this->db->where('products.koleksi_id', $collection_id);
        return $this->db->get()->result();
    } public function get_products_by_category($category_id)
    {
       
        $this->db->select('products.*, categories.nama_kategori, collections.nama_koleksi');
        $this->db->from('products');
        $this->db->join('categories', 'products.kategori_id = categories.id', 'left');
        $this->db->join('collections', 'products.koleksi_id = collections.id', 'left');
        $this->db->where('products.kategori_id', $category_id);
        return $this->db->get()->result();
    }


	// Method baru untuk menghitung total hasil pencarian
	public function count_search_results($keyword)
	{
		if (empty($keyword)) {
			return 0;
		}
		
		$this->db->join('collections', 'products.koleksi_id = collections.id', 'left');
		$this->db->join('categories', 'products.kategori_id = categories.id', 'left');

		$this->db->group_start();
		$this->db->like('nama_product', $keyword);
		$this->db->or_like('keterangan', $keyword);
		$this->db->or_like('collections.nama_koleksi', $keyword);
		$this->db->or_like('categories.nama_kategori', $keyword);
		$this->db->group_end();
		
		return $this->db->count_all_results('products');
	}

	// Modifikasi method search_products untuk menerima limit, offset, dan sort_by
	public function search_products($keyword, $sort_by, $limit, $offset)
	{
		if (empty($keyword)) {
			return array();
		}

		$this->db->select('
			products.*, 
			collections.nama_koleksi, 
			categories.nama_kategori
		');
		$this->db->from('products');
		$this->db->join('collections', 'products.koleksi_id = collections.id', 'left');
		$this->db->join('categories', 'products.kategori_id = categories.id', 'left');
		
		$this->db->group_start();
		$this->db->like('nama_product', $keyword);
		$this->db->or_like('keterangan', $keyword);
		$this->db->or_like('collections.nama_koleksi', $keyword);
		$this->db->or_like('categories.nama_kategori', $keyword);
		$this->db->group_end();
		
		// Logika Pengurutan
		switch ($sort_by) {
			case 'az':
				$this->db->order_by('nama_product', 'ASC');
				break;
			case 'za':
				$this->db->order_by('nama_product', 'DESC');
				break;
			case 'lowHigh':
				$this->db->order_by('harga', 'ASC');
				break;
			case 'highLow':
				$this->db->order_by('harga', 'DESC');
				break;
			case 'oldNew':
				$this->db->order_by('products.created_at', 'ASC');
				break;
			case 'newOld':
			default:
				$this->db->order_by('products.created_at', 'DESC');
				break;
		}

		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}

    public function get_colors_with_images($product_id)
{
    $this->db->select('pc.id as color_id, pc.nama_warna, pci.image');
    $this->db->from('product_color pc');
    $this->db->join('product_color_images pci', 'pci.product_color_id = pc.id', 'left');
    $this->db->where('pc.product_id', $product_id);
    $this->db->order_by('pc.id', 'ASC');
    return $this->db->get()->result();
}



}
