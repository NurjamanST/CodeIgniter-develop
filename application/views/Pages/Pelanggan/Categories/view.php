<div class="container-fluid py-5 bg bg-white">
	<div class="py-5"></div>
</div>
<!-- Page Content -->
<div class="container my-2">
    <!-- Breadcrumb + Judul Halaman + Sort By -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <!-- Breadcrumb -->
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('index.php/Landing/index') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('index.php/Categories/index') ?>">Categories</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= $category->nama_kategori ?>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Konten Utama: Judul + Info + Tombol + Sort By -->
            <div class="card-body d-flex flex-wrap justify-content-between align-items-start">
                <!-- Judul dan Informasi -->
                <div class="mb-3 mb-md-0">
                    <h5 class="card-title mb-1"><?= $category->nama_kategori ?></h5>
                    <p class="card-text text-secondary mb-0 mt-1">
                        Koleksi ini terdiri dari <?= count($products) ?> produk.
                    </p>
                </div>

                <!-- Tombol Back dan Dropdown Sort By -->
                <div class="d-flex flex-wrap mt-0 mt-md-5">
                    <select id="sortSelect" class="form-select form-select-sm w-100 w-md-auto me-2 my-2 mb-md-0 px-3 py-2" aria-label="Sort By">
                        <option value="">Sort By</option>
                        <option value="az">A to Z</option>
                        <option value="za">Z to A</option>
                        <option value="lowHigh">Harga: Rendah ke Tinggi</option>
                        <option value="highLow">Harga: Tinggi ke Rendah</option>
                        <option value="oldNew">Tanggal: Lama ke Baru</option>
                        <option value="newOld">Tanggal: Baru ke Lama</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- List Produk -->
    <div class="row">
         <?php if (!empty($products)): ?>
            <div class="row row-cols-2 row-cols-md-4 g-3">
				<?php foreach ($products as $product): ?>
					<div class="col">
						<a href="<?= base_url('index.php/Landing/view/' . $product->id) ?>" 
						class="text-decoration-none text-dark">
							<div class="bg-white rounded-3 shadow-sm w-100 d-flex flex-column"
								style="transition: transform 0.2s ease; cursor: pointer;"
								onmouseover="this.style.transform='scale(1.02)';"
								onmouseout="this.style.transform='scale(1)';">
								
						
								  <!-- Gambar Produk -->
                    <div class="position-relative overflow-hidden" style="height: 180px;">
                        <img src="<?= !empty($product->first_image) ? base_url('uploads/products/' . $product->first_image) : base_url('assets/img/no-image.png') ?>"
                             class="w-100 object-fit-cover"
                             alt="<?= htmlspecialchars($product->nama_product, ENT_QUOTES, 'UTF-8') ?>"
                             style="transition: transform 0.3s ease;"
                             onmouseover="this.style.transform='scale(1.1)';"
                             onmouseout="this.style.transform='scale(1)';">
                    </div>

								<!-- Deskripsi Produk -->
								<div class="p-2 flex-grow-1 d-flex flex-column text-center">
									<p class="card-text text-dark fw-medium mb-1" style="height: 1.8rem; overflow: hidden;">
										<?= htmlspecialchars(substr($product->nama_product, 0, 24)) ?>...
									</p>
									<p class="card-text text-secondary small mb-1">
										<?= htmlspecialchars($product->nama_kategori ?? 'Kategori') ?> <br>
								
									</p>
									<p class="card-text fw-bold" style="color: #212121;">
										Rp <?= number_format($product->harga, 0, ',', '.') ?>
									</p>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">Tidak ada produk ditemukan.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <?= $this->pagination->create_links(); ?>
    </div>
</div>
