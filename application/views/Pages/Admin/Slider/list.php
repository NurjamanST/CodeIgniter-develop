<main id="main" class="main">
  <div class="pagetitle">
    <h1>Slides</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Slides</li>
        <li class="breadcrumb-item active"><a href="<?= base_url('/index.php/Slider/index')?>">Slides Setup</a></li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Slider Setup</h5>

        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createSlidesModal">
            <i class="bi bi-plus-circle-fill"></i> Add Slider
        </button>
        <!-- Divider -->
        <hr>
        <p class="card-text">Daftar slider yang ada di website.</p>
        <?php
            if ($this->session->flashdata('success')) {
            echo '<div class="alert alert-success mt-3">' . $this->session->flashdata('success') . '</div>';
            } elseif ($this->session->flashdata('error')) {
            echo '<div class="alert alert-danger mt-3">' . $this->session->flashdata('error') . '</div>';
            }
        ?>
        <!-- Card List -->
        <div class="row" id="sliderCardList">
            <?php foreach ($sliders as $s): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm clickable-card"
                        onclick='openEditSlide(<?= json_encode([
                            "id" => $s->id,
                            "gambar" => $s->gambar,
                            "status" => $s->status,
                            "urutan" => $s->urutan
                        ]) ?>)'
                        style="cursor: pointer; transition: transform 0.2s;">
                        <img src="<?= base_url("assets/uploads/sliders/".$s->gambar) ?>" class="card-img-top" alt="Slider" style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h6 class="card-title">Urutan: <?= $s->urutan ?></h6>
                            <p class="card-text">
                                <span class="badge bg-<?= $s->status === 'aktif' ? 'success' : 'secondary' ?>">
                                    <?= ucfirst($s->status) ?>
                                </span>
                            </p>
                            <button class="btn btn-danger btn-sm w-100 mt-2" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteSliderModal" 
                                    onclick="setDeleteId('<?= $s->id ?>'); event.stopPropagation();">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        
      </div>
    </div>
  </section>
</main>


<!-- Modal Tambah Slides -->
<div class="modal fade" id="createSlidesModal" tabindex="-1" aria-labelledby="createSlidesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <form action="<?= base_url('index.php/Slider/save') ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createSlidesModalLabel">Tambah Slide</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Gambar -->
          <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Slider</label>
            <input type="file" name="gambar" id="gambar" class="form-control" required accept="image/*" onchange="previewNewImage(event)">
            <img id="preview_gambar_baru" src="" alt="Preview" style="max-width: 100%; display: none;" class="mt-2 img-thumbnail">
          </div>

          <!-- Status -->
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
              <option value="">-- Pilih Status --</option>
              <option value="aktif">Aktif</option>
              <option value="nonaktif">Nonaktif</option>
            </select>
          </div>

          <!-- Urutan (Auto) -->
          <div class="mb-3 d-none">
            <label for="urutan" class="form-label">Urutan</label>
            <input type="number" name="urutan" id="urutan" class="form-control" value="<?= $next_urutan ?? 1 ?>" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Slides -->
<div class="modal fade" id="editSlideModal" tabindex="-1" aria-labelledby="editSlideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="formEditSlide" method="post" action="<?= base_url('index.php/Slider/update') ?>" enctype="multipart/form-data">
        <input type="hidden" name="id" id="edit_id">

        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editSlideModalLabel">Edit Slider</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <!-- Preview Gambar -->
            <div class="mb-3 text-center">
                <label>Gambar Saat Ini</label><br>
                <img id="edit_gambar_preview" class="img-thumbnail" style="max-width: 100%;" src="">
            </div>

            <!-- Ganti Gambar -->
            <div class="mb-3">
                <label for="edit_gambar" class="form-label">Ganti Gambar</label>
                <input type="file" name="gambar" id="edit_gambar" class="form-control" accept="image/*" onchange="previewNewImage(event)">
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label for="edit_status" class="form-label">Status</label>
                <select name="status" id="edit_status" class="form-select" required>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
                </select>
            </div>

            <!-- Urutan -->
            <div class="mb-3">
                <label for="edit_urutan" class="form-label">Urutan</label>
                <input type="number" name="urutan" id="edit_urutan" class="form-control" min="1" required>
            </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
        </form>
    </div>
</div>

<!-- Modal Hapus Slider -->
<div class="modal fade" id="deleteSliderModal" tabindex="-1" aria-labelledby="deleteSliderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteSliderModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus slider ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Hapus</a>
      </div>
    </div>
  </div>
</div>