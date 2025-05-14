<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
    // get all categories by collection id
    public function get_categories_by_collection($collection_id) {
        $this->db->select('categories.*, COUNT(products.id) as jumlah_produk');
        $this->db->from('categories');
        $this->db->join('products', 'products.kategori_id = categories.id', 'left');
        $this->db->where('categories.koleksi_id', $collection_id);
        $this->db->group_by('categories.id');
        return $this->db->get()->result();
    }
    public function get_category_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('categories')->row();
    }
    // get all categories
    public function get_all() {
        return $this->db->get('categories')->result();
    }
    // insert category  
    public function create($data) {
        return $this->db->insert('categories', $data);
    }
    // update category
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('categories', $data);
    }
    // delete category
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('categories');
    }
}