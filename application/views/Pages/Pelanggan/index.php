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
			<div class="text-center mb-5">
				<h2 class="fw-bold">Product Category</h2>
				<p class="text-muted">Pilih kategori untuk melihat produk kami</p>
			</div>

			<div class="row g-2 justify-content-center">
				<?php
				// Daftar warna pastel acak
				$colors = [
					'#f8d7da', '#d1e7dd', '#fff3cd', '#d6d8db', '#c9d4ff',
					'#ffd8be', '#d2f5e3', '#e2e3e5', '#ffe8f0', '#e9f4ff'
				];
				$color_index = 0;
				?>
				<?php foreach ($categories as $cat): ?>
					<div class="col-md-4 col-lg-3">
						<a href="<?= base_url('/Categories/view/' . $cat->id); ?>" class="text-decoration-none">
							<div class="card border-0 shadow-sm text-center p-2 h-100 w-100 hover-lift category-card" 
								style="background-color: #e1e1e1ff; color: #333;">
								<div class="card-body p-0 d-flex flex-column justify-content-center flex-grow-1">
									<h5 class=" mb-0 fw-semibold"><?= htmlspecialchars($cat->nama_kategori) ?></h5>
								</div>
							</div>
						</a>
					</div>
					<?php $color_index++; ?>
				<?php endforeach; ?>
			</div>
		</div>
    <!-- End PRODUCT CATEGORY -->
	
	
	
	<!-- BEST SELLING -->
        <div class="row mx-2 d-flex justify-content-center">
            <div class="col-md-12 col-lg-12 text-center fw-bold">
                <div class="position-relative shadow-sm rounded-3 overflow-hidden">
                    <img src="<?= base_url('assets/img/bestselling.png')?>" class="img-fluid" style="width: 100%;" alt="Best Selling">
                    <div class="position-absolute top-50 start-0 translate-end text-white fw-bold" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);">
                        <h1>BEST SELLING PRODUCTS</h1>
                    </div>
                </div>
            </div>
        </div>
    <!-- End BEST SELLING -->

	
	
	<!-- CARD PRODUCT -->
		<div class="row mx-2 d-flex justify-content-center">
			<div class="col-md-12 col-lg-12 text-center py-4 fw-bold">
				<h4>New Arrival</h4>
			</div>
			<div class="row row-cols-2 row-cols-md-4 gx-4">
				<?php foreach ($products as $product): ?>
					<a href="<?= base_url('index.php/Landing/view/' . $product->id) ?>" class="text-decoration-none">
						<div class="col">
							<div class="card h-100 text-center shadow-sm border-0 rounded-3 overflow-hidden position-relative 
										transition-transform" 
								style="transition: transform 0.3s ease; cursor: pointer;"
								onmouseover="this.style.transform='translateY(-5px)';"
								onmouseout="this.style.transform='translateY(0)';">
								
								<img src="<?= base_url('uploads/products/' . $product->gambar1) ?>" 
									class="card-img-top img-fluid" 
									alt="<?= htmlspecialchars($product->nama_product) ?>"
									style="transition: transform 0.3s ease;"
									onmouseover="this.style.transform='scale(1.05)';"
									onmouseout="this.style.transform='scale(1)';">
								
								<div class="card-body">
									<p class="card-title text-xs">
										<?= substr(strip_tags(htmlspecialchars($product->nama_product)), 0, 20) ?>...
									</p>
									<p class="card-text">Rp. <?= number_format($product->harga, 0, ',', '.') ?></p>
								</div>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
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
					<a href="<?= base_url('index.php/Landing/news_view/' . $n->id) ?>" class="text-decoration-none">
						<div class="col">
							<div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden position-relative transition-transform" 
									style="transition: transform 0.3s ease; cursor: pointer;"
									onmouseover="this.style.transform='translateY(-5px)';"
									onmouseout="this.style.transform='translateY(0)';">
								<img src="<?= base_url('assets/uploads/news/' . $n->gambar) ?>" 
									class="card-img-top img-fluid" 
									alt="<?= htmlspecialchars($n->judul) ?>"
									style="transition: transform 0.3s ease;"
									onmouseover="this.style.transform='scale(1.05)';"
									onmouseout="this.style.transform='scale(1)';">
								<div class="card-body">
									<p class="card-title text-xs">
										<?= substr(strip_tags(htmlspecialchars($n->judul)), 0, 20) ?>...
									</p>
									<p class="card-text"><?= substr(strip_tags($n->narasi), 0, 20) ?>...</p>
								</div>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	<!-- End CARD NEWS -->
</iv>
