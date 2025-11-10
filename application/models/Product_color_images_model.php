<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_color_images_model extends CI_Model {

    // Ambil semua gambar berdasarkan ID warna
    public function get_by_color($product_color_id) {
        return $this->db->where('product_color_id', $product_color_id)
                        ->get('product_color_images')
                        ->result();
    }

    // Tambah gambar baru
    public function create($data) {
        $this->db->insert('product_color_images', $data);
        return $this->db->insert_id();
    }

    // Hapus semua gambar berdasarkan ID warna
    public function delete_by_color($product_color_id) {
        $this->db->where('product_color_id', $product_color_id)
                 ->delete('product_color_images');
    }

    // Hapus semua gambar berdasarkan produk (JOIN ke tabel warna)
    public function delete_by_product($product_id) {
        $this->db->query("
            DELETE pci FROM product_color_images pci
            JOIN product_color pc ON pc.id = pci.product_color_id
            WHERE pc.product_id = " . (int)$product_id
        );
    }

    public function get($id) {
    return $this->db->where('id', $id)->get('product_color_images')->row();
}

public function delete_by_id($id) {
    return $this->db->where('id', $id)->delete('product_color_images');
}

}
