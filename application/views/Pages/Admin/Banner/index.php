<main id="main" class="main">
    <div class="pagetitle">
        <h1>Kelola Banner Best Selling</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('profile') ?>">Home</a></li>
                <li class="breadcrumb-item active">Banner</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Banner Best Selling</h5>

                        <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>

                        <?= form_open_multipart('banner/update') ?>
                            <div class="row mb-3">
                                <label for="gambar" class="col-sm-2 col-form-label">Ganti Gambar</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="gambar" name="gambar">
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar. Ukuran maks 2MB.</small>
                                </div>
                            </div>
                             <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Gambar Saat Ini</label>
                                <div class="col-sm-10">
                                     <img src="<?= base_url('assets/img/' . $banner->gambar) ?>" alt="Banner Saat Ini" class="img-thumbnail" width="300">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="teks" class="col-sm-2 col-form-label">Teks Banner</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="teks" name="teks" value="<?= html_escape($banner->teks) ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
