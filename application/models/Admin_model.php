<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    public function get_by_email($email) {
        return $this->db->get_where('admin', ['email' => $email])->row();
    }

    // Mendapatkan data admin
    public function getAdmin()
    {
        $query = $this->db->get_where('admin', array('id' => 1));  // Asumsikan id admin adalah 1
        return $query->row();
    }

    // Mengecek password saat ini
    public function check_current_password($current_password)
    {
        $admin = $this->getAdmin();  // Ambil data admin
        return password_verify($current_password, $admin->password);  // Verifikasi password
    }

    // Mengupdate data akun admin
    public function update_account($data)
    {
        $this->db->where('id', 1);  // Update data admin dengan id 1
        $this->db->update('admin', $data);
    }
}