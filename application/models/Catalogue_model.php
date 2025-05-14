<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogue_model extends CI_Model {
    // Get all catalogues with collections and categories
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
        $this->db->order_by('products.created_at', 'DESC');
        return $this->db->get()->result();
    }   
    // Get catalogue by ID
    public function get_catalogue_by_id($id)
    {
        $this->db->select('
            products.*, 
            collections.nama_koleksi, 
            categories.nama_kategori
        ');
        $this->db->from('products');
        $this->db->join('collections', 'products.koleksi_id = collections.id', 'left');
        $this->db->join('categories', 'products.kategori_id = categories.id', 'left');
        $this->db->where('products.id', $id);
        return $this->db->get()->row();
    }
    // Create new catalogue
    public function create_catalogue($data) {
        return $this->db->insert('products', $data);
    }
    // Update catalogue
    public function update_catalogue($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    // Delete catalogue
    public function delete_catalogue($id) {
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }

}
?>
