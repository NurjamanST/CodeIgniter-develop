<form action="<?= base_url('index.php/Slider/save') ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" name="judul" id="judul" class="form-control">
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar Slider</label>
        <input type="file" name="gambar" id="gambar" class="form-control" required accept="image/*">
    </div>

    <div class="mb-3">
        <label for="link" class="form-label">Link Tujuan</label>
        <input type="url" name="link" id="link" class="form-control" placeholder="https://...">
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select">
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="urutan" class="form-label">Urutan</label>
        <input type="number" name="urutan" id="urutan" class="form-control" value="0">
    </div>

    <button type="submit" class="btn btn-success">Simpan Slider</button>
</form>