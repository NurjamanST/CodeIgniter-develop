<div class="container-fluid py-5 mb-2 bg bg-white"></div>
<!-- Page Content -->
<!-- About Us Page -->
<div class="container-fluid py-5 bg-light">
    <div class="container">
        <!-- Judul -->
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold"><?= htmlspecialchars($profile->judul ?? 'Tentang Kami') ?></h1>
            <p class="lead text-muted"><?= htmlspecialchars($profile->judul ?? 'Kenali lebih dalam tentang Hawe Collections') ?></p>
        </div>

        <!-- Profil Perusahaan -->
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <img src="<?= base_url('assets/uploads/profile/' . ($profile->logo_merek ?? 'default.jpg')) ?>"
                     alt="Tentang Kami" class="img-fluid rounded shadow-sm">
            </div>
            <div class="col-md-6">
                <h2><?= htmlspecialchars($profile->nama_merek ?? 'Hawe Collections') ?></h2>
                <p class="text-secondary"><?= nl2br(htmlspecialchars($profile->slogan ?? 'Belum ada informasi.')) ?></p>
                <p class="text-secondary"><?= nl2br(htmlspecialchars($profile->deskripsi ?? 'Deskripsi belum tersedia.')) ?></p>

                <!-- Info Tambahan -->
                <div class="mt-4">
                    <h5>Ikuti Kami</h5>
                    <div class="d-flex gap-3 fs-5">
                        <?php if (!empty($profile->instagram)): ?>
                            <a href="<?= $profile->instagram ?>" target="_blank" class="instagram text-decoration-none text-dark ">
                                <i class="bi bi-instagram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($profile->facebook)): ?>
                            <a href="<?= $profile->facebook ?>" target="_blank" class="facebook text-decoration-none text-dark ">
                                <i class="bi bi-facebook"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($profile->tiktok)): ?>
                            <a href="<?= $profile->tiktok ?>" target="_blank" class="tiktok text-decoration-none text-dark ">
                                <i class="bi bi-tiktok"></i>
                            </a>
                        <?php endif; ?>
                        
                    </div>
                    <hr class="my-4">
                    <h5>Hubungi Kami</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <?php if (!empty($profile->email)): ?>
                                <a href="mailto:<?= $profile->email ?>" class="text-decoration-none text-dark ">
                                    <i class="bi bi-envelope"></i> <?= htmlspecialchars($profile->email) ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <?php if (!empty($profile->whatsapp)): ?>
                            <a href="tel:<?= $profile->whatsapp ?>" class="text-decoration-none text-dark ">
                                <i class="bi bi-whatsapp"></i> <?= htmlspecialchars($profile->whatsapp) ?>
                            </a>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-flex gap-3 fs-5">
                        
                        
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4">
        <!-- Visi & Misi -->
        <div class="row mt-5">
            <div class="col-md-6 mb-4">
                <h3>Visi</h3>
                <p><?= nl2br(htmlspecialchars($profile->visi ?? 'Belum ada visi.')) ?></p>
            </div>
            <div class="col-md-6 mb-4">
                <h3>Misi</h3>
                <p><?= nl2br(htmlspecialchars($profile->misi ?? 'Belum ada misi.')) ?></p>
            </div>
        </div>
    </div>
</div>