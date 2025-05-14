<!-- Slider Banner -->
    <section id="header-carousel" class="carousel slide header-carousel" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <?php $no = 0; foreach ($sliders as $s): ?>
            <div class="carousel-item<?= $no == 0 ? ' active' : '' ?>">
                <!-- <img src="<?= base_url('assets/img/slides-1.jpg')?>" class="d-block w-100" alt="Slide 1" /> -->
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
<div class="container-fluid">
    <!-- PRODUCT CATEGORY -->
    <div class="row mt-4 mb-4">
        <div class="col-md-12 text-center my-5 fw-bold">
            <h1>Product Category</h1>
        </div>
        <div class="col-md-12 text-center">
            <div class="row">
                <?php foreach ($categories as $cat): ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="<?= base_url('assets/img/'.$cat->nama_kategori.'.jpg')?>" class="card-img-top" alt="...">
                            <div class="card-body my-1">
                                <a href="<?= base_url('Product/category/'.$cat->id); ?>" class="btn btn-outline-dark btn-block"><?= $cat->nama_kategori; ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- End PRODUCT CATEGORY -->
    <!-- BEST SELLING -->
    <!-- Images Best Selling -->
    <div class="row mt-4 mb-4">
        <div class="col-lg-12 text-center">
            <div class="position-relative">
                <img src="<?= base_url('assets/img/bestselling.png')?>" class="img-fluid" style="width: 100%;" alt="Best Selling">
                
                <div class="position-absolute top-50 start-50 translate-end text-white fw-bold" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);">
                    <h1>BEST SELLING PRODUCTS</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- End Images Best Selling -->
    <!-- Carousel dengan Cards Berisi Produk {Gambar, Nama Produk, Harga} dengan efek hover-->
        <div class="container-fluid">
            <!-- Carousel Wrapper -->
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    // Membagi produk menjadi kelompok 4 untuk setiap carousel-item
                    $chunks = array_chunk($products, 4);
                    // Debugging
                    // echo '<pre>';
                    // print_r($chunks);
                    // echo '</pre>';
                    foreach ($chunks as $index => $chunk) :
                        // Aktifkan carousel-item pertama
                        $activeClass = ($index === 0) ? 'active' : '';
                    ?>
                        <div class="carousel-item <?= $activeClass ?>">
                            <div class="row">
                                <?php foreach ($chunk as $p) : ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="card h-auto">
                                            <img src="<?= base_url('uploads/products/' . $p->gambar1) ?>" class="card-img-top" alt="<?= htmlspecialchars($p->title ?? 'Produk') ?>">
                                            <div class="card-body d-flex flex-column text-center">
                                                <h5 class="card-title"><?= htmlspecialchars($p->nama_product ?? 'Produk') ?></h5>
                                                <h6 class="card-text flex-grow-1">Rp <?= htmlspecialchars(number_format($p->harga,0,',','.') ?? 'Harga produk tidak tersedia.') ?></h6>
                                                <!-- Pembatas -->
                                                <div class="mb-2" style="border-top: 1px solid #ccc;"></div>
                                                <!-- Tombol untuk mengarahkan ke halaman produk -->
                                                <div class="row justify-content-center">
                                                    <div class="col-auto">
                                                        <a href="<?= $p->shopee ?>" target="_blank">
                                                            <img src="<?= base_url("assets/img/shopee.png") ?>" alt="Shopee" style="width: 40px; object-fit: cover;">
                                                        </a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="<?= $p->lazada ?>" target="_blank">
                                                            <img src="<?= base_url("assets/img/lazada.png") ?>" alt="Lazada" style="width: 40px; object-fit: cover;">
                                                        </a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="<?= $p->tiktokshop ?>" target="_blank">
                                                            <img src="<?= base_url("assets/img/tiktokshop.png") ?>" alt="TikTok Shop" style="width: 40px; object-fit: cover;">
                                                        </a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="<?= $p->tokopedia ?>" target="_blank">
                                                            <img src="<?= base_url("assets/img/tokopedia.png") ?>" alt="Tokopedia" style="width: 40px; object-fit: cover;">
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div> 
    <!-- End Carousel dengan Cards Berisi Produk {Gambar, Nama Produk, Harga} dengan efek hover-->
    <!-- Latest news -->
    <div class="row mt-4 mb-4">
        <div class="col-md-12 text-center my-2 fw-bold">
            <h1>.:: LATEST NEWS ::.</h1>
        </div>
        <div class="container-fluid">
            <!-- Carousel Wrapper -->
            <div id="carouselExampleControlsNews" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    // Membagi produk menjadi kelompok 4 untuk setiap carousel-item
                    $chunks = array_chunk($news, 4);
                    foreach ($chunks as $index => $chunk) :
                        // Aktifkan carousel-item pertama
                        $activeClass = ($index === 0) ? 'active' : '';
                    ?>
                        <div class="carousel-item <?= $activeClass ?>">
                            <div class="row">
                                <?php foreach ($chunk as $n) : ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="card h-100 border-0 shadow-sm rounded overflow-hidden">
                                            <img src="<?= base_url('assets/uploads/news/' . $n->gambar) ?>" class="card-img-top" alt="<?= htmlspecialchars($p->title ?? 'Produk') ?>">
                                            <div class="card-body d-flex flex-column text-center">
                                                <div class="card-title text-center mt-2 fw-bold text-truncate">
                                                    <?= htmlspecialchars(substr(strip_tags($n->judul), 0, 50) ?? 'News Title') ?>
                                                </div>
                                                <p class="card-text flex-grow-1 text-truncate">
                                                    <?= htmlspecialchars(substr(strip_tags($n->narasi), 0, 100) ?? 'Artikel tidak tersedia.') ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNews" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNews" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>