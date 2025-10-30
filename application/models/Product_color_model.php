<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_color_model extends CI_Model {

    // Ambil semua warna berdasarkan ID produk
    public function get_by_product($product_id) {
        return $this->db->where('product_id', $product_id)
                        ->get('product_color')
                        ->result();
    }

    // Tambah warna baru ke produk
    public function create($data) {
        $this->db->insert('product_color', $data);
        return $this->db->insert_id();
    }

    // Update data warna
    public function update($id, $data) {
        $this->db->where('id', $id)->update('product_color', $data);
    }

    // Hapus satu warna
    public function delete($id) {
        $this->db->where('id', $id)->delete('product_color');
    }

    // Hapus semua warna berdasarkan produk
    public function delete_by_product($product_id) {
        $this->db->where('product_id', $product_id)->delete('product_color');
    }

    // Ambil warna dengan gambar (LEFT JOIN)
    public function get_colors_with_images($product_id) {
        $this->db->select('product_color.*, product_color_images.image');
        $this->db->from('product_color');
        $this->db->join('product_color_images', 'product_color_images.product_color_id = product_color.id', 'left');
        $this->db->where('product_color.product_id', $product_id);
        $this->db->order_by('product_color.id', 'ASC');
        return $this->db->get()->result();
    }
}
