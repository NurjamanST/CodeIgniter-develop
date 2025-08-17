<!-- Background Putih -->
<div class="container-fluid py-5 bg-light">
    <div class="py-5"></div>
</div>

<!-- Page Content -->
<div class="container my-5">
    <!-- Breadcrumb + Judul Halaman + Sort By -->
    <div class="col-md-12 border-0 rounded-3 mb-3">
        <div class="card border-0 rounded-3 shadow-sm">
            <!-- Breadcrumb -->
            <div class="card-header bg-white">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('index.php/Landing/index') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Hasil Pencarian
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Konten Utama: Judul + Info + Tombol + Sort By -->
            <div class="card-body d-flex flex-wrap justify-content-between align-items-start">
                <!-- Judul dan Informasi -->
                <div class="mb-3 mb-md-0">
                    <h5 class="card-title mb-1">Hasil Pencarian untuk "<?= html_escape($keyword) ?>"</h5>
                    <p class="card-text text-secondary mb-0 mt-1">
                        Menampilkan <?= count($products) ?> dari <?= $total_products ?> produk ditemukan.
                    </p>
                </div>

                <!-- Dropdown Sort By -->
                <div class="d-flex flex-wrap mt-0 mt-md-5">
                    <select id="sortSelect" class="form-select form-select-sm w-100 w-md-auto me-2 my-2 mb-md-0 px-3 py-2" aria-label="Sort By">
                        <option value="">Sort By</option>
                        <option value="newOld" <?= ($sort_by == 'newOld') ? 'selected' : '' ?>>Terbaru</option>
                        <option value="oldNew" <?= ($sort_by == 'oldNew') ? 'selected' : '' ?>>Terlama</option>
                        <option value="az" <?= ($sort_by == 'az') ? 'selected' : '' ?>>A to Z</option>
                        <option value="za" <?= ($sort_by == 'za') ? 'selected' : '' ?>>Z to A</option>
                        <option value="lowHigh" <?= ($sort_by == 'lowHigh') ? 'selected' : '' ?>>Harga: Rendah ke Tinggi</option>
                        <option value="highLow" <?= ($sort_by == 'highLow') ? 'selected' : '' ?>>Harga: Tinggi ke Rendah</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- List Produk -->
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
									<img src="<?php
										if (!empty($product->gambar1)) {
											echo base_url('uploads/products/' . $product->gambar1);
										} else {
											echo base_url('assets/img/no-image.png');
										}
										?>" 
										class="w-100 object-fit-cover" 
										alt="<?= htmlspecialchars($product->nama_product) ?>"
										style="transition: transform 0.3s ease;"
										onmouseover="this.style.transform='scale(1.1)';"
										onmouseout="this.style.transform='scale(1)';">
								</div>

								<!-- Deskripsi Produk -->
								<div class="p-2 flex-grow-1 d-flex flex-column">
									<p class="card-text text-dark fw-medium mb-1" style="height: 1.8rem; overflow: hidden;">
										<?= htmlspecialchars(substr($product->nama_product, 0, 24)) ?>...
									</p>
									<p class="card-text text-secondary small mb-1">
										<?= htmlspecialchars($product->nama_kategori ?? 'Kategori') ?> <br>
										<?= htmlspecialchars($product->nama_koleksi ?? 'Koleksi') ?>
									</p>
									<p class="card-text text-danger fw-bold">
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

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <?= $this->pagination->create_links(); ?>
    </div>
</div>

<script>
document.getElementById('sortSelect').addEventListener('change', function() {
    var sortValue = this.value;
    var currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('sort_by', sortValue);
    // Reset page to 1 when sorting changes
    currentUrl.searchParams.delete('page'); 
    window.location.href = currentUrl.toString();
});
</script>
