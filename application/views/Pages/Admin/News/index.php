<main id="main" class="main">
  <div class="pagetitle">
    <h1>News</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">News</li>
        <li class="breadcrumb-item active"><a href="<?= base_url('/index.php/News/index')?>">Narrative List</a></li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Narrative List</h5>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createNewsModal">
          <i class="bi bi-plus-circle-fill"></i>
          Add Narration
        </button>
        <!-- Flashdata -->
        <?php if ($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('danger')): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('danger') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <!-- <table class="table table-hover table-bordered" id="NewsTable" style="width:100%"> -->
        <table class="table table-borderless table-hover datatable" id="NewsTable" style="width:100%">
          <thead class="text-center">
            <tr>
              <th style="width:5%;">#</th>
              <th style="width:10%;">Upload Date</th>
              <th style="width:10%;">Narrative Title</th>
              <th style="width:auto;">Narrative Text</th>
              <th style="width:25%;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($news as $nw): ?>
              <tr>
                <td><?= $nw->id ?></td>
                <td><?= $nw->tanggal ?></td>
                <!-- Title & Images News -->
                <td>
                  <h6><?= $nw->judul ?></h6>
                  <div>
                      <img src="<?= base_url('assets/uploads/news/'.$nw->gambar) ?>" alt="Foto" style="width: 100%; object-fit: cover; border:1px solid #ddd; padding:2px;">
                  </div>
                  <span class="badge bg-dark" style="font-size: 14px; margin-top: 5px;">
                    <?= $nw->updated_at ?>
                  </span>
                </td>
                <td><?= substr(strip_tags($nw->narasi), 0, 500) ?>...</td>
                <td>
                  <!-- Tombol Modal edit -->
                  <button class="btn btn-warning btn-sm w-100" onclick='openEditModalNews(
                    <?= json_encode([
                      "id" => $nw->id,
                      "judul" => $nw->judul,
                      "narasi" => $nw->narasi,
                      "gambar" => $nw->gambar,
                      "tanggal" => $nw->tanggal,                      
                    ]) ?> )'> 
                    Edit
                  </button> <br><br>
                  <!-- Tombol Hapus -->
                  <button class="btn btn-danger btn-sm w-100" onclick="openDeleteModalNews('<?= $nw->id ?>')">Hapus</button>
                  
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>

      </div>
    </div>
  </section>
</main>


<!-- Modal Tambah News -->
<div class="modal fade" id="createNewsModal" tabindex="-1" aria-labelledby="createNewsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <form id="newsForm" action="<?= base_url('index.php/News/create') ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createNewsModalLabel">Create a New Narrative</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <!-- Kolom Kanan -->
            <div class="col-md-6">
              <div class="mb-3">
                  <label for="nama_product" class="form-label">Upload Date</label>
                  <input type="date" class="form-control" name="tanggal" required>
              </div>
              <div class="mb-3">
                  <label for="judul" class="form-label">Narrative Title</label>
                  <input type="text" class="form-control" name="judul" required>
              </div>
            </div>
            <!-- Kolom Kiri -->
            <div class="col-md-6">
              <div class="mb-3">
                  <label for="gambar1" class="form-label">Narrative Image</label>
                  <input type="file" class="form-control" name="gambar"  accept="image/*" onchange="previewImage(event, 'preview-gambar')">
                  <img id="preview-gambar" class="img-thumbnail mt-2" style="max-width: 200px; display:none;">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="mb-3">
                <label for="narasi" class="form-label">Narrative Text</label>
                <!-- Quill Editor -->
                <div id="editQuillNews" style="height: 350px;"></div>
                <!-- Hidden textarea -->
                <textarea name="narasi" id="narasi" style="display:none;"></textarea>
              </div>
            </div>
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

<!-- Modal Edit News -->
<div class="modal fade" id="editNewsModal" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <form id="editNewsForm" action="<?= base_url('index.php/News/update') ?>" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" id="edit_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editNewsModalLabel">Edit Narrative</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <!-- Kolom Kanan -->
            <div class="col-md-6">
              <div class="mb-3">
                <label for="edit_tanggal" class="form-label">Upload Date</label>
                <input type="date" class="form-control" name="tanggal" id="edit_tanggal" required>
              </div>
              <div class="mb-3">
                <label for="edit_judul" class="form-label">Narrative Title</label>
                <input type="text" class="form-control" name="judul" id="edit_judul" required>
              </div>
            </div>
            <!-- Kolom Kiri -->
            <div class="col-md-6">
              <div class="mb-3">
                <label for="edit_gambar1" class="form-label">Narrative Image</label>
                <input type="file" class="form-control" name="gambar" id="edit_gambar1" accept="image/*" onchange="previewImage(event, 'edit_preview_gambar')">
                <img id="edit_preview_gambar" class="img-thumbnail mt-2" style="max-width: 200px; display:none;">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="mb-3">
                <label for="edit_narasi" class="form-label">Narrative Text</label>
                <!-- Quill Editor -->
                <div id="editNews" style="height: 350px;"></div>
                <!-- Hidden textarea -->
                <textarea name="narasi" id="edit_narasi" style="display:none;"></textarea>
              </div>
            </div>
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


<!-- Modal Hapus News -->
<div class="modal fade" id="deleteNewsModal" tabindex="-1" aria-labelledby="deleteNewsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('index.php/News/delete') ?>" method="post">
      <input type="hidden" name="id" id="delete_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteNewsModalLabel">Konfirmasi Hapus Narrative</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin menghapus narrative ini?
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Hapus</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

