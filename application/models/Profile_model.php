<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {
    private $table = 'profile';
    public function get() {
        return $this->db->get($this->table)->row();
    }
    // public function update($data) {
    //     return $this->db->update($this->table, $data);
    // }
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function update($data) {
        return $this->db->where('id', 1)->update('profile', $data);
    }

    public function get_old_logo() {
        $query = $this->db->select('logo_merek')->get_where('profile', ['id' => 1]);
        return $query->row()->logo_merek ?? null;
    }

}
