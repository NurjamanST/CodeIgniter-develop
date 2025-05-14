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
                            <a href="<?= base_url('index.php/Landing/News') ?>">News</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= htmlspecialchars($news->judul) ?>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= htmlspecialchars($news->created_at) ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
            
    <div class="row">
        <!-- Informasi Produk -->
        <div class="col-md-8 d-flex flex-column align-items-start">
            <!-- Kategori & Tanggal Publikasi -->
            <div class="mb-3">
                <span class="badge bg-danger me-2">News</span>
                <!-- <span class="badge bg-secondary me-2">Program Kerja</span> -->
                <small class="text-muted"><?= "hawecollections@gmail.com" ?> | <?= date('F j, Y', strtotime($news->created_at)) ?></small>
            </div>

            <!-- Judul Artikel -->
            <h1 class="mb-4"><?= htmlspecialchars($news->judul) ?></h1>

            <!-- Gambar Utama -->
            <img src="<?= !empty($news->gambar) ? base_url("assets/uploads/news/" . $news->gambar) : base_url("assets/img/no-image.png") ?>"
                 alt="<?= htmlspecialchars($news->judul) ?>" class="img-fluid mb-4">

            <!-- Isi Artikel -->
            <div class="article-content">
                <p><?= $news->narasi ?></p>
            </div>
        </div>

        <!-- Sidebar atau Kolom Samping -->
        <div class="col-md-4">
            <!-- Berita Terbaru -->
            <div class="card col-lg-12 col-md-12">
                <div class="card-header">
                    <h5 class="card-title">Berita Terbaru</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach ($news_limit as $n): ?>
                            <li class="list-group-item d-flex align-items-center">
                                <!-- Thumbnail -->
                                <div class="me-3">
                                    <img src="<?= !empty($n->gambar) ? base_url("assets/uploads/news/" . $n->gambar) : base_url("assets/img/no-image.png") ?>"
                                        alt="<?= htmlspecialchars($n->judul) ?>" class="img-fluid rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                </div>

                                <!-- Judul & Tanggal -->
                                <div class="w-100">
                                    <a href="<?= base_url("index.php/Landing/news_view/{$n->id}") ?>" class="text-decoration-none text-dark">
                                        <h6 class="mb-1"><?= htmlspecialchars($n->judul) ?></h6>
                                    </a>
                                    <small class="text-muted float-end">
                                        <?= date('F j, Y', strtotime($n->created_at)) ?>
                                    </small>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!-- End News & Updates -->
        </div>
    </div>
</div>