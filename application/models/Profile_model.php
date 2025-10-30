<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model: Profile_model
 * Menangani data profil perusahaan / toko
 */
class Profile_model extends CI_Model {

    private $table = 'profile';

    /**
     * Ambil data profil pertama
     */
    public function get() {
        return $this->db->get($this->table)->row();
    }

    /**
     * Ambil data profil berdasarkan ID
     */
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    /**
     * Update data profil (default ke id=1)
     */
    public function update($data) {
        return $this->db->where('id', 1)->update($this->table, $data);
    }

    /**
     * Ambil logo lama untuk proses update file
     */
    public function get_old_logo() {
        $query = $this->db->select('logo_merek')->get_where($this->table, ['id' => 1]);
        return $query->row()->logo_merek ?? null;
    }
}
