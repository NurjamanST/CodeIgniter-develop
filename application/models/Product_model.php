<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
    // Fungsi ini digunakan untuk mendapatkan semua produk dari tabel 'products'
    // dengan menggabungkan tabel 'collections' dan 'categories'
    public function get_all_catalogues()
    {
        $this->db->select('
            products.*, 
            collections.nama_koleksi, 
            categories.nama_kategori
        ');
        $this->db->from('products');
        $this->db->join('collections', 'products.koleksi_id = collections.id', 'left');
        $this->db->join('categories', 'products.kategori_id = categories.id', 'left');
        $this->db->order_by('products.id', 'ASC');
        return $this->db->get()->result();
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
        $this->db->order_by('products.id', 'ASC');
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

    // public function get_categories_by_koleksi($koleksi_id)
    // {
    //     return $this->db->where('koleksi_id', $koleksi_id)->get('categories')->result();
    // }
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
        return $this->db->get_where('products', ['id' => $id])->row();  // sesuaikan nama tabel
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
        // Lakukan join antara tabel products, categories dan collections
        $this->db->select('products.*, categories.nama_kategori, collections.nama_koleksi');
        $this->db->from('products');
        $this->db->join('categories', 'products.kategori_id = categories.id', 'left');
        $this->db->join('collections', 'products.koleksi_id = collections.id', 'left');
        $this->db->where('products.koleksi_id', $collection_id);
        return $this->db->get()->result();
    } public function get_products_by_category($category_id)
    {
        // Lakukan join antara tabel products, categories dan collections
        $this->db->select('products.*, categories.nama_kategori, collections.nama_koleksi');
        $this->db->from('products');
        $this->db->join('categories', 'products.kategori_id = categories.id', 'left');
        $this->db->join('collections', 'products.koleksi_id = collections.id', 'left');
        $this->db->where('products.kategori_id', $category_id);
        return $this->db->get()->result();
    }

}
