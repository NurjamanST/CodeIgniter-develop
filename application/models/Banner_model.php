<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_model extends CI_Model {

    private $table = 'banners';

    /**
     * Mengambil data banner berdasarkan namanya.
     * @param string $nama_banner Nama banner yang ingin diambil.
     * @return object Data banner.
     */
    public function get_banner($nama_banner) {
        return $this->db->get_where($this->table, ['nama_banner' => $nama_banner])->row();
    }

    /**
     * Memperbarui data banner.
     * @param string $nama_banner Nama banner yang akan diperbarui.
     * @param array $data Data baru untuk banner.
     * @return boolean Hasil dari operasi update.
     */
    public function update_banner($nama_banner, $data) {
        $this->db->where('nama_banner', $nama_banner);
        return $this->db->update($this->table, $data);
    }
}
