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
                            <a href="<?= base_url('index.php/Landing/News') ?>">News</a>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Konten Utama: Judul + Info + Tombol + Sort By -->
            <div class="card-body d-flex flex-wrap justify-content-between align-items-start">
                <!-- Judul dan Informasi -->
                <div class="mb-3 mb-md-0">
                    <h5 class="card-title mb-1">Narrative List</h5>
                    <p class="card-text text-secondary mb-0 mt-1">
                        Tersedia <?= count($news) ?> Narrative.
                    </p>
                </div>

                <!-- Tombol Back dan Dropdown Sort By -->
                <div class="d-flex flex-wrap mt-0 mt-md-5">
                    <select id="sortSelect" class="form-select form-select-sm w-auto">
                        <option value="">Sort By</option>
                        <option value="az">A to Z</option>
                        <option value="za">Z to A</option>
                        <!-- <option value="lowHigh">Harga: Rendah ke Tinggi</option>
                        <option value="highLow">Harga: Tinggi ke Rendah</option> -->
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
    </div>
</div>