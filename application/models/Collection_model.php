<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collection_model extends CI_Model {
    // get all collections
    public function get_all() {
        return $this->db->get('collections')->result();
    }
    // insert data
    public function insert($data) {
        return $this->db->insert('collections', $data);
    }
    // update data
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('collections', $data);
    }
    // delete data
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('collections');
    }
    // get collection by id
    public function get_collection_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('collections')->row();
    }
}