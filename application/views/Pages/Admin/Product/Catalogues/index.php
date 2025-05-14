<main id="main" class="main">
  <div class="pagetitle">
    <h1>Products</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item active"><a href="<?= base_url('/index.php/Product/catalogues')?>">Catalogues</a></li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Product List</h5>

        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createCatalogueModal">
          <i class="bi bi-plus-circle-fill"></i> Add Product
        </button>
        <?php
            if($this->session->flashdata('success')) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                echo $this->session->flashdata('success');
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            } elseif ($this->session->flashdata('danger')) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                echo $this->session->flashdata('danger');
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            }
        ?>
        <!-- <table class="table table-hover table-bordered" id="catalogueTable" style="width:100%"> -->
        <table class="table table-borderless table-hover datatable" id="catalogueTable" style="width:100%">
          <thead class="text-center">
            <tr>
              <th style="width:5%">#</th>
              <th style="width:40%">Product</th>
              <th style="width:20%">Hyperlink</th>
              <!-- <th style="width:10%">Harga</th> -->
              <!-- <th>Koleksi</th> -->
              <!-- <th>Kategori</th> -->
              <th style="width:auto">Information</th>
              <th style="width:25%">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($catalogues as $cata): ?>
              <tr>
                <td><?= $cata->id ?></td>
                <!-- Foto Produk -->
                <td>
                  <h6><?= $cata->nama_product ?></h6>
                  <div style="display: flex; gap: 5px;">
                    <?php
                        $gambarList = [$cata->gambar1, $cata->gambar2, $cata->gambar3, $cata->gambar4, $cata->gambar5];
                        foreach ($gambarList as $gambar) :
                        if (!empty($gambar)) :
                    ?>
                        <img src="<?= base_url('uploads/products/'.$gambar) ?>" alt="Foto" style="width: 50px; height: 50px; object-fit: cover; border:1px solid #ddd; padding:2px;">
                    <?php
                        endif;
                        endforeach;
                    ?>
                  </div>
                  <span class="badge bg-info" style="font-size: 14px; margin-top: 5px;">
                    Rp <?= number_format($cata->harga,0,',','.') ?>
                  </span>
                </td>
                <td class="item-center">
                  <div style="grid-template-columns: 1fr 1fr;" class="d-grid gap-3 row-gap-0 text-center">
                    <div class="">
                      <button type="button" class="btn btn-light btn-sm" onclick="window.open('<?= $cata->shopee ?>', '_blank')"
                              >
                              <img src="<?= base_url("assets/img/shopee.png")?>" alt="" style="width: 30%; object-fit: cover;">
                      </button>
                    </div>
                    <div class="">
                      <button type="button" class="btn btn-light btn-sm" onclick="window.open('<?= $cata->lazada ?>', '_blank')"
                              >
                              <img src="<?= base_url("assets/img/lazada.png")?>" alt="" style="width: 30%; object-fit: cover;">
                      </button>
                    </div>
                    <div class="">
                      <button type="button" class="btn btn-light btn-sm" onclick="window.open('<?= $cata->tiktokshop ?>', '_blank')"
                              >
                              <img src="<?= base_url("assets/img/tiktokshop.png")?>" alt="" style="width: 30%; object-fit: cover;">
                      </button>
                    </div>
                    <div class="">
                      <button type="button" class="btn btn-light btn-sm" onclick="window.open('<?= $cata->tokopedia ?>', '_blank')"
                              >
                              <img src="<?= base_url("assets/img/tokopedia.png")?>" alt="" style="width: 30%; object-fit: cover;">
                      </button>
                    </div>

                  </div>
                </td>
                <td>
                  <?= $cata->nama_koleksi ?>|<?= $cata->nama_kategori ?>
                  <?= substr(strip_tags($cata->keterangan), 0, 50) ?>...</td>
                <td>
                  <!-- Tombol Modal edit -->
                  <button class="btn btn-warning btn-sm w-100" onclick='openEditModal(
                    <?= json_encode([
                      "id" => $cata->id,
                      "nama_product" => $cata->nama_product,
                      "harga" => $cata->harga,
                      "koleksi_id" => $cata->koleksi_id,
                      "kategori_id" => $cata->kategori_id,
                      "keterangan" => $cata->keterangan,
                      "shopee" => $cata->shopee,
                      "lazada" => $cata->lazada,
                      "tiktokshop" => $cata->tiktokshop,
                      "tokopedia" => $cata->tokopedia,
                      "gambar1" => $cata->gambar1,
                      "gambar2" => $cata->gambar2,
                      "gambar3" => $cata->gambar3,
                      "gambar4" => $cata->gambar4,
                      "gambar5" => $cata->gambar5,
                    ]) ?> )'> 
                    Edit
                  </button> <br><br>
                  <!-- Tombol Hapus -->
                  <button class="btn btn-danger btn-sm w-100" onclick="openDeleteModal('<?= $cata->id ?>')">Hapus</button>
                  
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>

      </div>
    </div>
  </section>
</main>


<!-- Modal Tambah Catalogue -->
<div class="modal fade" id="createCatalogueModal" tabindex="-1" aria-labelledby="createCatalogueModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <form action="<?= base_url('index.php/Product/create_catalogue') ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createCatalogueModalLabel">Tambah Produk Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Atas -->
          <div class="row">
            <!-- Kolom Kanan -->
            <div class="col-md-7">
              <div class="mb-3">
                  <label for="nama_product" class="form-label">Nama Produk</label>
                  <input type="text" class="form-control" name="nama_product" required>
              </div>

              <div class="mb-3">
                  <label for="harga" class="form-label">Harga</label>
                  <input type="number" class="form-control" name="harga" required>
              </div>

              <div class="mb-3">
                  <label for="koleksiSelect" class="form-label">Pilih Koleksi</label>
                  <select id="koleksiSelect" class="form-select" name="koleksi_id" required>
                      <option value="">-- Pilih Koleksi --</option>
                      <?php foreach ($collections as $collection): ?>
                      <option value="<?= $collection->id ?>"><?= $collection->nama_koleksi ?></option>
                      <?php endforeach; ?>
                  </select>
              </div>
              <div class="mb-3">
                  <label for="kategoriSelect" class="form-label">Pilih Kategori</label>
                  <select id="kategoriSelect" class="form-select" name="kategori_id" required>
                      <option value="">-- Pilih Koleksi dulu --</option>
                  </select>
              </div>
            </div>
            <!-- Kolom Kiri -->
            <div class="col-md-5">
              <div class="mb-3">
                  <label for="shopee" class="form-label">Shopee</label>
                  <input type="text" class="form-control" name="shopee" required>
              </div>

              <div class="mb-3">
                  <label for="lazada" class="form-label">Lazada</label>
                  <input type="text" class="form-control" name="lazada" required>
              </div>

              <div class="mb-3">
                  <label for="tiktokshop" class="form-label">Tiktok Shop</label>
                  <input type="text" class="form-control" name="tiktokshop" required>
              </div>

              <div class="mb-3">
                  <label for="tokopedia" class="form-label">Tokopedia</label>
                  <input type="text" class="form-control" name="tokopedia" required>
              </div>
            </div>
          </div>
          <!-- Bawah -->
          <div class="row">
            <div class="col-md-5">
              <div class="mb-3">
                  <label for="gambar1" class="form-label">Gambar 1</label>
                  <input type="file" class="form-control" name="gambar1"  accept="image/*" onchange="previewImage(event, 'preview-gambar1')">
                  <img id="preview-gambar1" class="img-thumbnail mt-2" style="max-width: 200px; display:none;">
              </div>

              <div class="mb-3">
                  <label for="gambar2" class="form-label">Gambar 2</label>
                  <input type="file" class="form-control" name="gambar2"  accept="image/*" onchange="previewImage(event, 'preview-gambar2')">
                  <img id="preview-gambar2" class="img-thumbnail mt-2" style="max-width: 200px; display:none;">
              </div>

              <div class="mb-3">
                  <label for="gambar3" class="form-label">Gambar 3</label>
                  <input type="file" class="form-control" name="gambar3"  accept="image/*" onchange="previewImage(event, 'preview-gambar3')">
                  <img id="preview-gambar3" class="img-thumbnail mt-2" style="max-width: 200px; display:none;">
              </div>

              <div class="mb-3">
                  <label for="gambar4" class="form-label">Gambar 4</label>
                  <input type="file" class="form-control" name="gambar4"  accept="image/*" onchange="previewImage(event, 'preview-gambar4')">
                  <img id="preview-gambar4" class="img-thumbnail mt-2" style="max-width: 200px; display:none;">
              </div>
              
              <div class="mb-3">
                  <label for="gambar5" class="form-label">Gambar 5</label>
                  <input type="file" class="form-control" name="gambar5"  accept="image/*" onchange="previewImage(event, 'preview-gambar5')">
                  <img id="preview-gambar5" class="img-thumbnail mt-2" style="max-width: 200px; display:none;">
              </div>
            </div>

            <div class="col-md-7">
              <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <!-- Quill Editor -->
                <div id="quillEditor" style="height: 350px;"></div>
                <!-- Hidden textarea -->
                <textarea name="keterangan" id="keterangan" style="display:none;"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Catalogues -->
<div class="modal fade" id="editCatalogueModal" tabindex="-1" aria-labelledby="editCatalogueModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <form action="<?= base_url('index.php/Product/update_catalogue') ?>" id="formEditProduk" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" id="edit_id">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editCatalogueModalLabel">Edit Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row">
            <!-- Kolom Kanan -->
            <div class="col-md-7">
              <div class="mb-3">
                <label for="edit_nama_product" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" name="nama_product" id="edit_nama_product" required>
              </div>

              <div class="mb-3">
                <label for="edit_harga" class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" id="edit_harga" required>
              </div>

              <div class="mb-3">
                <label for="edit_koleksiSelect" class="form-label">Pilih Koleksi</label>
                <select id="edit_koleksiSelect" class="form-select" name="koleksi_id" required>
                  <option value="">-- Pilih Koleksi --</option>
                  <?php foreach ($collections as $collection): ?>
                    <option value="<?= $collection->id ?>"><?= $collection->nama_koleksi ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="edit_kategoriSelect" class="form-label">Pilih Kategori</label>
                <select id="edit_kategoriSelect" class="form-select" name="kategori_id" required>
                  <option value="">-- Pilih Koleksi dulu --</option>
                </select>
              </div>
            </div>

            <!-- Kolom Kiri -->
            <div class="col-md-5">
              <div class="mb-4">
                <div class="mb-3">
                  <label for="edit_shopee" class="form-label">Shopee</label>
                  <input type="url" class="form-control" name="shopee" id="edit_shopee" placeholder="https://shopee.com/produk... ">
                </div>

                <div class="mb-3">
                  <label for="edit_lazada" class="form-label">Lazada</label>
                  <input type="url" class="form-control" name="lazada" id="edit_lazada" placeholder="https://www.lazada.com/produk... ">
                </div>

                <div class="mb-3">
                  <label for="edit_tiktokshop" class="form-label">TikTok Shop</label>
                  <input type="url" class="form-control" name="tiktokshop" id="edit_tiktokshop" placeholder="https://www.tiktok.com/ @.../product...">
                </div>

                <div class="mb-3">
                  <label for="edit_tokopedia" class="form-label">Tokopedia</label>
                  <input type="url" class="form-control" name="tokopedia" id="edit_tokopedia" placeholder="https://www.tokopedia.com/produk... ">
                </div>
              </div>
            </div>
          </div>

          <!-- Upload Gambar & Keterangan -->
          <div class="row">
            <div class="col-md-5">
              <?php for ($i = 1; $i <= 5; $i++): ?>
              <div class="mb-3">
                <label for="edit_gambar<?= $i ?>" class="form-label">Gambar <?= $i ?></label>
                <input type="file" class="form-control" name="gambar<?= $i ?>" id="edit_gambar<?= $i ?>" onchange="previewImage(event, 'edit_preview_gambar<?= $i ?>')">
                <img id="edit_preview_gambar<?= $i ?>" class="img-thumbnail mt-2" style="max-width: 100%; display: none;">
              </div>
              <?php endfor; ?>
            </div>

            <div class="col-md-7">
              <div class="mb-3">
                <label for="editQuillEditor" class="form-label">Keterangan</label>
                <div id="editQuillEditor" style="height: 350px;"></div>
                <textarea name="keterangan" id="edit_keterangan" style="display:none;"></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Hapus Catalogues -->
<div class="modal fade" id="deleteCatalogueModal" tabindex="-1" aria-labelledby="deleteCatalogueModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('index.php/Product/delete_catalogue') ?>" method="post">
      <input type="hidden" name="id" id="delete_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          Yakin ingin menghapus produk ini?
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Hapus</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
