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
        <div class="col-md-12 ">
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4 mb-4 product-card"
                        data-name="<?= strtolower($product->nama_product) ?>"
                        data-price="<?= $product->harga ?>"
                        data-date="<?= strtotime($product->created_at) ?>">
                        <a href="<?= base_url("index.php/Landing/view/{$product->id}") ?>">
                            <div class="card h-100">
                                <img src="<?= base_url('uploads/products/' . $product->gambar1) ?>" class="card-img-top" alt="<?= $product->nama_product ?>">
                                <div class="card-body mt-2">
                                    <p class="card-text text-dark"><?= $product->nama_product ?></p>
                                    <p class="card-text text-secondary"><?= $product->nama_kategori ?> | <?= $product->nama_koleksi ?></p>
                                    <p class="card-text text-secondary">Rp <?= number_format($product->harga, 0, ',', '.') ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>