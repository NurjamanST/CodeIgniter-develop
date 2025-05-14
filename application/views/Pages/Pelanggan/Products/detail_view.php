<div class="container-fluid py-5 mb-2 bg bg-white"></div>
<!-- Page Content -->
<div class="container-fluid py-5 mb-2 bg bg-white">
    <!-- Breadcrumb -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <!-- Breadcrumb -->
            <div class="card-header py-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('index.php/Landing/index') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('index.php/Collections/index') ?>">Collections</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('index.php/Collections/view/' . $product->koleksi_id) ?>"><?= htmlspecialchars($product->nama_koleksi) ?></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= htmlspecialchars($product->nama_product) ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
            
    <div class="row">
        <!-- Gambar Produk - Gaya Shopee -->
        <div class="col-md-6 d-flex flex-column align-items-center">
            <!-- Main Image Preview -->
            <div class="main-image mb-3 border rounded overflow-hidden shadow-sm" style="width: 100%; max-width: 450px;">
                <img id="mainImage" src="<?= !empty($product->gambar1) ? base_url("uploads/products/" . $product->gambar1) : base_url("assets/img/no-image.png") ?>"
                    alt="<?= htmlspecialchars($product->nama_product) ?>" class="img-fluid">
            </div>

            <!-- Thumbnail Gallery -->
            <div class="d-flex gap-2 justify-content-center flex-wrap mt-2" style="width: 100%;">
                <?php if (!empty($product->gambar1)): ?>
                    <img src="<?= base_url("uploads/products/" . $product->gambar1) ?>" alt="Gambar 1" class="thumb-img rounded border active" onclick="changeImage(this)">
                <?php endif; ?>

                <?php if (!empty($product->gambar2)): ?>
                    <img src="<?= base_url("uploads/products/" . $product->gambar2) ?>" alt="Gambar 2" class="thumb-img rounded border" onclick="changeImage(this)">
                <?php endif; ?>

                <?php if (!empty($product->gambar3)): ?>
                    <img src="<?= base_url("uploads/products/" . $product->gambar3) ?>" alt="Gambar 3" class="thumb-img rounded border" onclick="changeImage(this)">
                <?php endif; ?>

                <?php if (!empty($product->gambar4)): ?>
                    <img src="<?= base_url("uploads/products/" . $product->gambar4) ?>" alt="Gambar 4" class="thumb-img rounded border" onclick="changeImage(this)">
                <?php endif; ?>
            </div>
        </div>

        <!-- Informasi Produk -->
        <div class="col-md-6 d-flex flex-column align-items-start">
            <h4><?= htmlspecialchars($product->nama_product) ?></h4>
            <p class="text-muted"><?= $product->keterangan?></p>
            <h4 class="text-success">Rp <?= number_format($product->harga, 0, ',', '.') ?></h4>
            <ul class="list-unstyled mt-3">
                <li><strong>Kategori:</strong> <?= htmlspecialchars($product->nama_kategori ?? 'Tidak diketahui') ?></li>
                <li><strong>Koleksi:</strong> <?= htmlspecialchars($product->nama_koleksi ?? 'Tidak tersedia') ?></li>
            </ul>

            <!-- Tombol Marketplace -->
            <div class="mt-4">
                <h6 class="mb-3">Beli di:</h6>
                <div class="d-flex flex-nowrap overflow-auto gap-2 pb-2" style="-webkit-overflow-scrolling: touch;">
                    <?php if (!empty($product->shopee)): ?>
                        <a href="<?= $product->shopee ?>" target="_blank" class="btn btn-outline-dark btn-sm d-flex align-items-center flex-shrink-0">
                            <img src="<?= base_url("assets/img/shopee.png") ?>" width="20" class="me-1">
                            <span class="d-none d-md-inline">Shopee</span>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($product->lazada)): ?>
                        <a href="<?= $product->lazada ?>" target="_blank" class="btn btn-outline-dark btn-sm d-flex align-items-center flex-shrink-0">
                            <img src="<?= base_url("assets/img/lazada.png") ?>" width="20" class="me-1">
                            <span class="d-none d-md-inline">Lazada</span>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($product->tiktokshop)): ?>
                        <a href="<?= $product->tiktokshop ?>" target="_blank" class="btn btn-outline-dark btn-sm d-flex align-items-center flex-shrink-0">
                            <img src="<?= base_url("assets/img/tiktokshop.png") ?>" width="20" class="me-1">
                            <span class="d-none d-md-inline">TikTok Shop</span>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($product->tokopedia)): ?>
                        <a href="<?= $product->tokopedia ?>" target="_blank" class="btn btn-outline-dark btn-sm d-flex align-items-center flex-shrink-0">
                            <img src="<?= base_url("assets/img/tokopedia.png") ?>" width="20" class="me-1">
                            <span class="d-none d-md-inline">Tokopedia</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>