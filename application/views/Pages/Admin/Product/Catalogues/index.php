<style>
.btn-remove-row {
    position: absolute;
    top: 8px;
    right: 8px;
    background-color: #dc3545; /* merah bootstrap */
    color: white;
    border: none;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    font-size: 18px;
    font-weight: bold;
    line-height: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: 0.2s;
  }

  .btn-remove-row:hover {
    background-color: #bb2d3b;
    transform: scale(1.1);
  }
</style>

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
                  // Jika menggunakan tabel product_color_images
                  if (isset($cata->images) && is_array($cata->images) && count($cata->images) > 0) :
                      foreach ($cata->images as $img) :
                  ?>
                          <img src="<?= base_url('uploads/products/' . $img->image) ?>" 
                              alt="Foto" 
                              style="width: 50px; height: 50px; object-fit: cover; border:1px solid #ddd; padding:2px;">
                  <?php 
                      endforeach;
                  else:
                      // Fallback untuk data lama (gambar1 - gambar5)
                      $gambarList = [
                          $cata->gambar1 ?? null, 
                          $cata->gambar2 ?? null, 
                          $cata->gambar3 ?? null, 
                          $cata->gambar4 ?? null, 
                          $cata->gambar5 ?? null
                      ];
                      foreach ($gambarList as $gambar) :
                          if (!empty($gambar)) :
                  ?>
                              <img src="<?= base_url('uploads/products/' . $gambar) ?>" 
                                  alt="Foto" 
                                  style="width: 50px; height: 50px; object-fit: cover; border:1px solid #ddd; padding:2px;">
                  <?php
                          endif;
                      endforeach;
                  endif;
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
                              <img src="<?= base_url("assets/img/shopee.png")?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border:1px solid #ddd; padding:2px;">
                      </button>
                    </div>
                    <div class="">
                      <button type="button" class="btn btn-light btn-sm" onclick="window.open('<?= $cata->lazada ?>', '_blank')"
                              >
                              <img src="<?= base_url("assets/img/lazada.png")?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border:1px solid #ddd; padding:2px;">
                      </button>
                    </div>
                    <div class="">
                      <button type="button" class="btn btn-light btn-sm" onclick="window.open('<?= $cata->tiktokshop ?>', '_blank')"
                              >
                              <img src="<?= base_url("assets/img/tiktokshop.png")?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border:1px solid #ddd; padding:2px;">
                      </button>
                    </div>
                    <div class="">
                      <button type="button" class="btn btn-light btn-sm" onclick="window.open('<?= $cata->tokopedia ?>', '_blank')"
                              >
                              <img src="<?= base_url("assets/img/tokopedia.png")?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border:1px solid #ddd; padding:2px;">
                      </button>
                    </div>

                  </div>
                </td>
                <td>
                  <?= $cata->nama_koleksi ?>|<?= $cata->nama_kategori ?>
                  <?= substr(strip_tags($cata->keterangan), 0, 50) ?>...</td>
                <td>
                  <!-- Tombol Modal edit -->
            <!-- Tombol Edit -->
<button type="button"
  class="btn btn-warning btn-sm w-100"
  onclick='openEditModal(<?= json_encode($cata) ?>)'>
  Edit
</button>

                  <br><br>
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

          <!-- Atas: info produk -->
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

            <!-- Kolom Kiri: marketplace -->
            <div class="col-md-5">
              <div class="mb-3">
                <label for="shopee" class="form-label">Shopee</label>
                <input type="text" class="form-control" name="shopee">
              </div>
              <div class="mb-3">
                <label for="lazada" class="form-label">Lazada</label>
                <input type="text" class="form-control" name="lazada">
              </div>
              <div class="mb-3">
                <label for="tiktokshop" class="form-label">Tiktok Shop</label>
                <input type="text" class="form-control" name="tiktokshop">
              </div>
              <div class="mb-3">
                <label for="tokopedia" class="form-label">Tokopedia</label>
                <input type="text" class="form-control" name="tokopedia">
              </div>
            </div>
          </div>

          <hr>

          <!-- Warna + Gambar -->
          <div id="colorImagesContainer">
              <div class="color-image-row row mb-3 position-relative p-2 border rounded">
                <button type="button" class="btn-close position-absolute top-0 end-0 me-2 mt-2" aria-label="Close" onclick="removeColorImageRow(this)" style="display: none;"></button>
                <div class="col-md-6">
                  <label class="form-label">Nama Warna</label>
                  <input type="text" name="color_name[]" class="form-control" placeholder="Misal: Merah" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Upload Gambar</label>
                  <input type="file" name="color_image[0][]" class="form-control" accept="image/*" multiple onchange="previewImage(event, this)">
                  <div class="image-preview mt-2 d-flex flex-wrap"></div>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-secondary btn-sm mb-3" onclick="addColorImageRow()">Tambah Warna</button>

          <hr>

          <!-- Keterangan -->
          <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <div id="quillEditoraddprod" style="height: 200px;"></div>
            <textarea name="keterangan" id="addprodketerangan" style="display:none;"></textarea>
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

<!-- Modal Edit Produk Lengkap -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content h-100" style="max-height: 95vh;"> <!-- Batasi tinggi maksimal -->
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="editForm" action="<?= base_url('index.php/product/update_catalogue') ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body" style="overflow-y: auto; max-height: calc(95vh - 150px);"> <!-- Scrollable body -->
          <input type="hidden" name="id" id="edit_id">

          <!-- Info Produk -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Nama Produk</label>
              <input type="text" name="nama_product" id="edit_nama_product" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Harga</label>
              <input type="number" name="harga" id="edit_harga" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Pilih Koleksi</label>
              <select id="edit_koleksi" class="form-select" name="koleksi_id" required>
                <option value="">-- Pilih Koleksi --</option>
                <?php foreach ($collections as $collection): ?>
                  <option value="<?= $collection->id ?>"><?= $collection->nama_koleksi ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold">Pilih Kategori</label>
              <select id="edit_kategori" class="form-select" name="kategori_id" required>
                <option value="">-- Pilih Koleksi dulu --</option>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-3">
              <label class="form-label">Shopee</label>
              <input type="text" name="shopee" id="edit_shopee" class="form-control">
            </div>
            <div class="col-md-3">
              <label class="form-label">Lazada</label>
              <input type="text" name="lazada" id="edit_lazada" class="form-control">
            </div>
            <div class="col-md-3">
              <label class="form-label">Tiktok Shop</label>
              <input type="text" name="tiktokshop" id="edit_tiktokshop" class="form-control">
            </div>
            <div class="col-md-3">
              <label class="form-label">Tokopedia</label>
              <input type="text" name="tokopedia" id="edit_tokopedia" class="form-control">
            </div>
          </div>

          <hr>

          <!-- Container Warna -->
          <div id="colorContainer"></div>
          <button type="button" class="btn btn-success btn-sm mt-2" onclick="addColorRow()">+ Tambah Warna</button>

          <hr>

          <!-- Keterangan -->
          <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <div id="editQuill" style="height:200px;"></div>
            <textarea name="keterangan" id="edit_keterangan" style="display:none;"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <input type="hidden" name="deleted_colors" id="deleted_colors">
          <input type="hidden" name="deleted_images" id="deleted_images">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
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



<script>
let colorIndex = 1;


// Fungsi tambah baris warna
function addColorImageRow() {
    const container = document.getElementById('colorImagesContainer');
    const row = document.createElement('div');
    row.className = 'color-image-row row mb-3 position-relative p-2 border rounded';
    row.innerHTML = `
        <!-- Tombol Hapus -->
        <button type="button" class="btn-remove-row" onclick="removeColorImageRow(this)">×</button>

        <div class="col-md-6">
            <label class="form-label">Nama Warna</label>
            <input type="text" name="color_name[]" class="form-control" placeholder="Misal: Biru" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Upload Gambar</label>
            <input type="file" name="color_image[${colorIndex}][]" class="form-control" accept="image/*" multiple onchange="previewImage(event, 'preview-color-${colorIndex}')">
            <div class="mt-2">
                <img id="preview-color-${colorIndex}" class="w-100 img-thumbnail mt-2 img-fluid" style="display:none;">
            </div>
        </div>
    `;
    container.appendChild(row);
    colorIndex++;
    updateRemoveButtons();
}

// Fungsi hapus baris warna
function removeColorImageRow(button) {
    const container = document.getElementById('colorImagesContainer');
    const rows = container.querySelectorAll('.color-image-row');

    if (rows.length > 1) {
        button.closest('.color-image-row').remove();
    }

    updateRemoveButtons();
}

// Update tombol close (jangan tampil kalau tinggal 1)
function updateRemoveButtons() {
    const rows = document.querySelectorAll('.color-image-row');
    rows.forEach(row => {
        const closeBtn = row.querySelector('.btn-remove-row');
        if (rows.length === 1) {
            closeBtn.style.display = 'none';
        } else {
            closeBtn.style.display = 'flex';
        }
    });
}

// Preview gambar
function previewImage(event, previewId) {
    const files = event.target.files;
    const output = document.getElementById(previewId);
    if (files.length > 0) {
        const reader = new FileReader();
        reader.onload = function(e) {
            output.src = e.target.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(files[0]);
    }
}

// Jalankan saat halaman siap
document.addEventListener('DOMContentLoaded', () => {
    updateRemoveButtons();
});


document.addEventListener('DOMContentLoaded', () => {
  const BASE_URL = "<?= base_url('uploads/products/') ?>";
  let deletedColors = [];
  let deletedImages = [];

  // Data semua kategori dari PHP - gunakan variable categories yang sudah ada
  const allCategories = <?= json_encode($categories) ?>;

  // Event handler untuk perubahan koleksi di modal edit
  document.getElementById('edit_koleksi').addEventListener('change', function() {
    const koleksiId = this.value;
    const kategoriSelect = document.getElementById('edit_kategori');
    
    kategoriSelect.innerHTML = '<option value="">-- Pilih Kategori --</option>';
    
    if (koleksiId) {
      // Filter kategori berdasarkan koleksi_id
      const filteredCategories = allCategories.filter(cat => cat.koleksi_id == koleksiId);
      
      if (filteredCategories.length > 0) {
        filteredCategories.forEach(category => {
          kategoriSelect.innerHTML += `<option value="${category.id}">${category.nama_kategori}</option>`;
        });
      } else {
        kategoriSelect.innerHTML = '<option value="">-- Tidak ada kategori untuk koleksi ini --</option>';
      }
    }
  });

  window.openEditModal = function (product) {
    const container = document.getElementById('colorContainer');
    container.innerHTML = '';
    deletedColors = [];
    deletedImages = [];

    // Data utama
    document.getElementById('edit_id').value = product.id || '';
    document.getElementById('edit_nama_product').value = product.nama_product || '';
    document.getElementById('edit_harga').value = product.harga || '';
    document.getElementById('edit_shopee').value = product.shopee || '';
    document.getElementById('edit_lazada').value = product.lazada || '';
    document.getElementById('edit_tiktokshop').value = product.tiktokshop || '';
    document.getElementById('edit_tokopedia').value = product.tokopedia || '';
    
    // Set koleksi dan trigger change event untuk load kategori
    const koleksiSelect = document.getElementById('edit_koleksi');
    koleksiSelect.value = product.koleksi_id || '';
    
    // Trigger change event untuk load kategori
    if (product.koleksi_id) {
      const event = new Event('change');
      koleksiSelect.dispatchEvent(event);
      
      // Set kategori setelah kategori selesai dimuat
      setTimeout(() => {
        document.getElementById('edit_kategori').value = product.kategori_id || '';
      }, 50);
    }

    // Keterangan (Quill)
    if(window.editQuill) {
      window.editQuill.root.innerHTML = product.keterangan || "";
    }

    // Warna & gambar
    if (product.colors && product.colors.length > 0) {
      product.colors.forEach((color, i) => {
        container.insertAdjacentHTML('beforeend', renderColorRow(color, i));
      });
    } else {
      container.insertAdjacentHTML('beforeend', renderColorRow({}, 0));
    }

    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    modal.show();
  }

  // Fungsi render color row (tetap sama)
  window.renderColorRow = function(color = {}, index = 0) {
    const imagesHTML = (color.images || []).map(img => `
      <div class="position-relative d-inline-block m-1">
        <img src="<?= base_url('uploads/products/') ?>${img.image}" 
             class="img-thumbnail" style="width:100px;height:100px;object-fit:cover;">
        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle"
                style="width:24px;height:24px;font-size:12px;"
                onclick="removeImage(${img.id}, this)">
          <i class="bi bi-x"></i>
        </button>
      </div>
    `).join('');

    return `
      <div class="border p-3 mb-3 color-row rounded">
        <input type="hidden" name="color_id_existing[${index}]" value="${color.id || ''}">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <label class="fw-bold mb-0">Warna</label>
          <button type="button" class="btn btn-outline-danger btn-sm"
                  onclick="removeColorRow(this, '${color.id || ''}')">
            Hapus Warna
          </button>
        </div>

        <input type="text" name="color_name[${index}]" value="${color.nama_warna || ''}" 
               class="form-control mb-2" placeholder="Contoh: Merah">

        <label class="fw-bold">Gambar Warna</label>
        <input type="file" name="color_image[${index}][]" multiple accept="image/*" 
               class="form-control mb-2" onchange="previewNewImages(event, this)">
        <div class="image-preview d-flex flex-wrap">${imagesHTML}</div>
      </div>
    `;
  }

  // Fungsi lainnya tetap sama...
  window.addColorRow = function () {
    const index = document.querySelectorAll('.color-row').length;
    document.getElementById('colorContainer').insertAdjacentHTML('beforeend', renderColorRow({}, index));
  }

  window.removeColorRow = function(button, colorId) {
    if(colorId) deletedColors.push(colorId);
    button.closest('.color-row').remove();
    document.getElementById('deleted_colors').value = deletedColors.join(',');
  }

  window.removeImage = function(imageId, button) {
    fetch(`<?= site_url('product/delete_color_image') ?>/${imageId}`, { method:'POST'})
      .then(async res=>{
        const text = await res.text();
        try { return JSON.parse(text); } 
        catch { throw new Error('Response bukan JSON: '+text.slice(0,100)); }
      })
      .then(data=>{
        if(data.status==='success'){
          deletedImages.push(imageId);
          document.getElementById('deleted_images').value = deletedImages.join(',');
          button.closest('div').remove();
        } else { console.error('Gagal hapus:', data.message); }
      })
      .catch(err=>console.error('Gagal hapus gambar:', err));
  }

  window.previewNewImages = function(event, input) {
    const container = input.closest('.color-row').querySelector('.image-preview');
    
    Array.from(event.target.files).forEach(file => {
      const reader = new FileReader();
      reader.onload = e => {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'img-thumbnail m-1';
        img.style = 'width:100px;height:100px;object-fit:cover;';
        container.appendChild(img);
      };
      reader.readAsDataURL(file);
    });
  };
});

// Quill initialization (tetap sama)
document.addEventListener('DOMContentLoaded', () => {
  window.editQuill = new Quill('#editQuill', {
    theme: 'snow',
    placeholder: 'Masukkan keterangan produk...'
  });

  document.getElementById('editForm').addEventListener('submit', function() {
    document.getElementById('edit_keterangan').value = window.editQuill.root.innerHTML;
  });
});
</script>
