<div class="container-fluid py-5 mb-2 bg bg-white"></div>
<div class="container-fluid">
    <h2>Product Collections</h2>
    <div class="row">
        <?php foreach ($categories as $cata): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $cata->nama_kategori ?></h5>
                        <a href="<?= base_url("index.php/Categories/view/{$cata->id}") ?>" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>