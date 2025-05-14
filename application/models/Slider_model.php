<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends CI_Model {

    // Ambil urutan berikutnya
    public function get_next_urutan() {
        $this->db->select_max('urutan');
        $query = $this->db->get('sliders');
        $result = $query->row();
        return $result->urutan ? $result->urutan + 1 : 1;
    }

    // Simpan slider baru
    public function tambah_slider($data) {
        return $this->db->insert('sliders', $data);
    }

    // Hapus slider
    public function hapus_slider($id) {
        return $this->db->delete('sliders', ['id' => $id]);
    }

    // Dapatkan data slider by ID
    public function get_by_id($id) {
        return $this->db->get_where('sliders', ['id' => $id])->row();
    }

    // Perbaiki urutan setelah penghapusan
    public function reorder_sliders() {
        $sliders = $this->db->order_by('urutan')->get('sliders')->result();
        $new_order = 1;

        foreach ($sliders as $slider) {
            $this->db->where('id', $slider->id)->update('sliders', ['urutan' => $new_order]);
            $new_order++;
        }
    }
    public function update_slider($id, $data) {
        return $this->db->where('id', $id)->update('sliders', $data);
    }
}