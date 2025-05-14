<div class="container-fluid py-5 mb-2 bg bg-white"></div>
<div class="container-fluid">
    <h2>Product Collections</h2>
    <div class="row">
        <?php foreach ($collections as $c): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $c->nama_koleksi ?></h5>
                        <a href="<?= base_url("index.php/Collections/view/{$c->id}") ?>" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>