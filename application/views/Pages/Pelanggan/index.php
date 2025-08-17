<!-- Slider Banner -->
    <section id="header-carousel" class="carousel slide header-carousel" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <?php $no = 0; foreach ($sliders as $s): ?>
            <div class="carousel-item active">
                <img src="<?= base_url("assets/uploads/sliders/" . $s->gambar) ?>" class="d-block w-100" alt="<?= $s->gambar ?>">
            </div>
            <?php $no++; endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
        </button>
    </section>
<!-- End Slider Banner -->

<!-- Main Content -->
<div class="container my-1">
    <!-- PRODUCT CATEGORY -->
		<div class="container py-5">
			<div class="text-center mb-4">
				<h2 class="fw-bold">Product Category</h2>
				<p class="text-muted">Pilih kategori untuk melihat produk kami</p>
			</div>

			<div class="row g-3 justify-content-center">
				<?php foreach ($categories as $cat): ?>
					<div class="col-6 col-md-4 col-lg-3">
						<a href="<?= base_url('Categories/view/' . $cat->id) ?>" class="text-decoration-none">
							<div class="card border-0 shadow-sm text-center h-100"
								style="background-color: #e1e1e1ff; 
										border-radius: 12px; 
										transition: transform 0.2s ease, box-shadow 0.2s ease;"
								onmouseover="this.style.transform='translateY(-4px);'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)';"
								onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.05)';">
								<div class="card-body d-flex align-items-center justify-content-center p-3">
									<h5 class="mb-0 fw-semibold text-dark" style="font-size: 1rem;">
										<?= htmlspecialchars($cat->nama_kategori) ?>
									</h5>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<!-- End PRODUCT CATEGORY -->
	
	
	
	<!-- BEST SELLING -->
	<?php if (isset($banner_best_selling) && $banner_best_selling): ?>
	<div class="row d-flex justify-content-center">
		<div class="col-md-12 col-lg-12 text-center fw-bold">
			<div class="position-relative shadow-sm rounded-3 overflow-hidden">
				<img src="<?= base_url('assets/img/' . $banner_best_selling->gambar)?>" class="img-fluid" style="width: 100%;height:70vh; object-fit: cover;" alt="Best Selling">
				<div class="position-absolute top-50 start-50 translate-middle text-white fw-bold" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);">
					<h1><?= html_escape($banner_best_selling->teks) ?></h1>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<!-- End BEST SELLING -->

	
	
	<!-- CARD PRODUCT - NEW ARRIVAL -->
		<div class="row d-flex justify-content-center">
			<div class="col-md-12 col-lg-12 text-center mt-4 fw-bold">
				<h4>New Arrival</h4>
			</div>

			<div class="row row-cols-2 row-cols-md-4 g-3 px-4">
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

			<!-- Tombol Produk Selanjutnya -->
			<div class="col-12 text-center mt-4 mb-5">
				<a href="<?= base_url('Landing/products') ?>" 
				class="btn btn-primary px-4 py-2 rounded-3 shadow-sm"
				style="font-weight: 500; font-size: 1rem;">
					Produk Selanjutnya
				</a>
			</div>
		</div>
	<!-- End CARD PRODUCT -->
	
	
	
	<!-- CARD NEWS -->
		<div class="row mx-2 d-flex justify-content-center">
			<div class="col-md-12 col-lg-12 text-center py-4 fw-bold">
				<h4>Latest News</h4>
			</div>
			<div class="row row-cols-2 row-cols-md-4 gx-4">
				<?php foreach ($news as $n): ?>
                    <div class="col-md-3 mb-4 product-card"
                        data-name="<?= strtolower($n->judul) ?>"
                        data-date="<?= strtotime($n->created_at) ?>">
                        <a href="<?= base_url("index.php/Landing/news_view/{$n->id}") ?>">
                            <div class="card h-100">
                                <img src="<?= base_url('assets/uploads/news/' . $n->gambar) ?>" class="card-img-top" alt="<?= $n->judul ?>">
                                <div class="card-body mt-2">
                                    <p class="card-text text-dark">
                                        <?= htmlspecialchars(substr(strip_tags($n->judul), 0, 50) ?? 'News Title') ?>
                                    </p>
                                    <small class="card-text text-secondary">
                                        <?= $n->created_at ?> | <?= "@HaweCollections" ?>    
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
			</div>
		</div>
	<!-- End CARD NEWS -->
</iv>
