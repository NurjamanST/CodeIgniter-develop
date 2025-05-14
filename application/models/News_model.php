<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {
    public function get_all() {
        return $this->db->get('news')->result();
    }
    public function get_news_by_id($id) {
        return $this->db->where('id', $id)->get('news')->row();
    }
    public function get_limit_news($limit, $offset) {
        return $this->db->get('news', $limit, $offset)->result();
    }
    public function insert($data) {
        return $this->db->insert('news', $data);
    }
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('news', $data);
    }
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('news');
    }
    public function getById($id) {
        return $this->db->where('id', $id)->get('news')->row();
    }

}