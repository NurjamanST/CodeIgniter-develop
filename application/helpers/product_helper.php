<?php
if (!function_exists('get_product_image')) {
    function get_product_image($filename) {
        // Pastikan $filename tidak kosong dan file ada di direktori uploads
        if (!empty($filename) && file_exists(FCPATH . 'uploads/products/' . $filename)) {
            return base_url('uploads/products/' . $filename);
        } else {
            // Jika gambar tidak ada, gunakan gambar default
            return base_url('assets/img/no-image.png');
        }
    }
}
?>
