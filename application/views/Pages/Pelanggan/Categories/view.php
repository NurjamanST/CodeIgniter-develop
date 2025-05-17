<div class="container-fluid py-5 mb-2 bg bg-white"></div>
<!-- Page Content -->
<div class="container-fluid">
    <!-- Breadcrumb + Judul Halaman + Sort By -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <!-- Breadcrumb -->
            <div class="card-header bg-white py-3">
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
                    <select id="sortSelect" class="form-select form-select-sm w-auto">
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
    <div class="row">
        <!-- List Produk -->
        <div class="col-md-12">
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-6 col-md-4 mb-4 product-card"
                        data-name="<?= strtolower($product->nama_product) ?>"
                        data-price="<?= $product->harga ?>"
                        data-date="<?= strtotime($product->created_at) ?>">
                        <div class="card h-100">
                                <a href="<?= base_url("index.php/Landing/view/{$product->id}") ?>">
                                    <img src="<?= base_url('uploads/products/' . $product->gambar1) ?>" class="card-img-top" alt="<?= $product->nama_product ?>">
                                </a>
                                
                                <div class="card-body mt-2 text-center">                                    
                                    <p class="card-text text-dark ">
                                    <?= htmlspecialchars(substr(strip_tags($product->nama_product), 0, 24) ?? 'Produk') ?>...
                                    <p class="card-text text-secondary"><?= $product->nama_kategori ?> | <?= $product->nama_koleksi ?></p>
                                    <p class="card-text text-secondary">Rp <?= number_format($product->harga, 0, ',', '.') ?></p>
                                    <!-- Tombol Marketplace -->
                                    <div class="d-flex justify-content-center mt-3">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-cart me-1"></i> Beli Sekarang
                                            </button>
                                            <ul class="dropdown-menu shadow-sm">
                                                <?php if (!empty($product->shopee)): ?>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center" href="<?= $product->shopee ?>" target="_blank">
                                                            <img src="<?= base_url("assets/img/shopee.png") ?>" alt="Shopee" width="20" class="me-2">
                                                            Shopee
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($product->lazada)): ?>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center" href="<?= $product->lazada ?>" target="_blank">
                                                            <img src="<?= base_url("assets/img/lazada.png") ?>" alt="Lazada" width="20" class="me-2">
                                                            Lazada
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($product->tiktokshop)): ?>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center" href="<?= $product->tiktokshop ?>" target="_blank">
                                                            <img src="<?= base_url("assets/img/tiktokshop.png") ?>" alt="TikTok Shop" width="20" class="me-2">
                                                            TikTok Shop
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!empty($product->tokopedia)): ?>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center" href="<?= $product->tokopedia ?>" target="_blank">
                                                            <img src="<?= base_url("assets/img/tokopedia.png") ?>" alt="Tokopedia" width="20" class="me-2">
                                                            Tokopedia
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>