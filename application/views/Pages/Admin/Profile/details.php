  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item active"><a href="<?= base_url('/index.php/profile/details')?>">Details Profile</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <!-- Display flashdata messages -->
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <section class="section profile">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab"
                    data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-account-setting">Account Setting</button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <!-- Profile Overview -->
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <h5 class="card-title">Profile Details</h5>

                  <!-- Brand Name -->
                  <div class="row mb-3">
                    <div class="col-md-4 col-lg-3 label fw-bold text-md-end">Brand Name</div>
                    <div class="col-md-8 col-lg-9"><?= htmlspecialchars($profile->nama_merek) ?></div>
                  </div>
                  <!-- Brand Logo -->
                  <div class="row mb-3">
                    <div class="col-md-4 col-lg-3 label fw-bold text-md-end">Logo Merek</div>
                    <div class="col-md-8 col-lg-9">
                      <?php if (!empty($profile->logo_merek)): ?>
                        <img src="<?= base_url('assets/uploads/profile/' . $profile->logo_merek) ?>" alt="Logo Merek" class="img-fluid" style="max-width: 200px;">
                      <?php else: ?>
                        <p class="text-muted">Logo tidak tersedia</p>
                      <?php endif; ?>
                    </div>
                  </div>

                  <!-- Slogan -->
                  <div class="row mb-3">
                    <div class="col-md-4 col-lg-3 label fw-bold text-md-end">Slogan</div>
                    <div class="col-md-8 col-lg-9"><?= htmlspecialchars($profile->slogan) ?></div>
                  </div>

                  <!-- Description -->
                  <div class="row mb-3">
                    <div class="col-md-4 col-lg-3 label fw-bold text-md-end">Description</div>
                    <div class="col-md-8 col-lg-9"><?= nl2br(htmlspecialchars($profile->deskripsi)) ?></div>
                  </div>

                  <!-- Visi -->
                  <div class="row mb-3">
                    <div class="col-md-4 col-lg-3 label fw-bold text-md-end">Visi</div>
                    <div class="col-md-8 col-lg-9"><?= nl2br(htmlspecialchars($profile->visi)) ?></div>
                  </div>

                  <!-- Misi -->
                  <div class="row mb-3">
                    <div class="col-md-4 col-lg-3 label fw-bold text-md-end">Misi</div>
                    <div class="col-md-8 col-lg-9"><?= nl2br(htmlspecialchars($profile->misi)) ?></div>
                  </div>

                  <!-- Social Media -->
                  <div class="row mb-3">
                      <div class="col-md-4 col-lg-3 label fw-bold text-md-end align-self-center">Social Media</div>
                      <div class="col-md-8 col-lg-9">
                          <div class="d-flex flex-wrap gap-2">
                              <?php if (!empty($profile->instagram)): ?>
                                  <a href="<?= htmlspecialchars($profile->instagram) ?>" target="_blank" class="btn btn-outline-dark btn-sm d-flex align-items-center gap-2 social-btn" style="border-radius: 30px;">
                                      <i class="bi bi-instagram"></i>
                                      <span>Instagram</span>
                                  </a>
                              <?php endif; ?>

                              <?php if (!empty($profile->tiktok)): ?>
                                  <a href="<?= htmlspecialchars($profile->tiktok) ?>" target="_blank" class="btn btn-outline-dark btn-sm d-flex align-items-center gap-2 social-btn" style="border-radius: 30px;">
                                      <i class="bi bi-tiktok"></i>
                                      <span>TikTok</span>
                                  </a>
                              <?php endif; ?>

                              <?php if (!empty($profile->facebook)): ?>
                                  <a href="<?= htmlspecialchars($profile->facebook) ?>" target="_blank" class="btn btn-outline-dark btn-sm d-flex align-items-center gap-2 social-btn" style="border-radius: 30px;">
                                      <i class="bi bi-facebook"></i>
                                      <span>Facebook</span>
                                  </a>
                              <?php endif; ?>
                          </div>
                      </div>
                  </div>

                  <!-- Contact Info -->
                  <div class="row mb-3">
                    <div class="col-md-4 col-lg-3 label fw-bold text-md-end">Kontak</div>
                    <div class="col-md-8 col-lg-9">
                      <p class="mb-1">
                        <i class="bi bi-envelope-fill me-2"></i>
                        <?= htmlspecialchars($profile->email ?? 'Email tidak tersedia') ?>
                      </p>
                      <p class="mb-0">
                        <i class="bi bi-whatsapp me-2"></i>
                        <?= htmlspecialchars($profile->whatsapp ?? 'WhatsApp tidak tersedia') ?>
                      </p>
                    </div>
                  </div>

                </div>
                <!-- End Profile Overview -->

                <!-- Profile Edit Form -->
                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                  <form action="<?= base_url('index.php/profile/update') ?>" method="post" enctype="multipart/form-data">

                    <!-- Brand Name -->
                    <div class="row mb-3">
                      <label for="brandname" class="col-md-4 col-lg-3 col-form-label">Brand Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="brandname" type="text" class="form-control" id="brandname" value="<?= htmlspecialchars($profile->nama_merek) ?>">
                      </div>
                    </div>

                    <!-- Slogan -->
                    <div class="row mb-3">
                      <label for="slogan" class="col-md-4 col-lg-3 col-form-label">Slogan</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="slogan" type="text" class="form-control" id="slogan" value="<?= htmlspecialchars($profile->slogan) ?>">
                      </div>
                    </div>

                    <!-- Description -->
                    <div class="row mb-3">
                      <label for="description" class="col-md-4 col-lg-3 col-form-label">Description</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="description" class="form-control" id="description" style="height: 140px"><?= htmlspecialchars($profile->deskripsi) ?></textarea>
                      </div>
                    </div>

                    <!-- Visi -->
                    <div class="row mb-3">
                      <label for="visi" class="col-md-4 col-lg-3 col-form-label">Visi</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="visi" class="form-control" id="visi" style="height: 140px"><?= htmlspecialchars($profile->visi) ?></textarea>
                      </div>
                    </div>

                    <!-- Misi -->
                    <div class="row mb-3">
                      <label for="misi" class="col-md-4 col-lg-3 col-form-label">Misi</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="misi" class="form-control" id="misi" style="height: 140px"><?= htmlspecialchars($profile->misi) ?></textarea>
                      </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="row mb-3">
                      <label class="col-md-4 col-lg-3 col-form-label">Social Media Links</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="row g-2">
                          <!-- Instagram -->
                          <div class="col-sm-6">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input name="instagram" type="text" class="form-control" id="instagram" value="<?= htmlspecialchars($profile->instagram) ?>">
                          </div>

                          <!-- TikTok -->
                          <div class="col-sm-6">
                            <label for="tiktok" class="form-label">TikTok</label>
                            <input name="tiktok" type="text" class="form-control" id="tiktok" value="<?= htmlspecialchars($profile->tiktok) ?>">
                          </div>

                          <!-- Facebook -->
                          <div class="col-sm-6">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input name="facebook" type="text" class="form-control" id="facebook" value="<?= htmlspecialchars($profile->facebook) ?>">
                          </div>

                          <!-- WhatsApp -->
                          <div class="col-sm-6">
                            <label for="whatsapp" class="form-label">WhatsApp</label>
                            <input name="whatsapp" type="text" class="form-control" id="whatsapp" value="<?= htmlspecialchars($profile->whatsapp) ?>">
                          </div>

                          <!-- Email -->
                          <div class="col-sm-6">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="email" value="<?= htmlspecialchars($profile->email) ?>">
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Logo Merek -->
                    <div class="row mb-3">
                        <label for="logo_merek" class="col-md-4 col-lg-3 col-form-label">Logo Merek</label>
                        <div class="col-md-8 col-lg-9">
                            <!-- File Input -->
                            <input name="logo_merek" type="file" class="form-control" id="logo_merek">

                            <!-- Gambar Lama -->
                            <?php if (!empty($profile->logo_merek)): ?>
                                <div class="mt-2">
                                    <img src="<?= base_url('assets/uploads/profile/' . $profile->logo_merek) ?>" alt="Current Logo" class="img-fluid" style="max-width: 200px;">
                                </div>
                            <?php endif; ?>

                            <!-- Preview Gambar Baru -->
                            <div class="mt-2">
                                <img id="logoPreview" src="" alt="Preview Logo" class="img-fluid" style="max-width: 200px; display: none;">
                            </div>
                        </div>
                    </div>
                    <hr class="rounded" style="width: 100%;">

                    <div class="text-center">
                      <button type="submit" class="btn btn-info">Save Changes</button>
                    </div>
                  </form>
                </div>
                <!-- End Profile Edit Form -->

                <!-- Account Setting Form -->
                <div class="tab-pane fade pt-3" id="profile-account-setting">
                  <form action="<?= base_url('index.php/profile/update_account') ?>" method="POST">
                    <div class="row mb-3">
                      <label for="username" class="col-md-5 col-lg-5 col-form-label">Username</label>
                      <div class="col-md-auto col-lg-7">
                        <input name="username" type="text" class="form-control" id="username" value="<?= $admin->nama ?>">
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <label for="email" class="col-md-5 col-lg-5 col-form-label">Email Address</label>
                      <div class="col-md-auto col-lg-7">
                        <input name="email" type="email" class="form-control" id="email" value="<?= $admin->email ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-5 col-lg-5 col-form-label">Current Password</label>
                      <div class="col-md-auto col-lg-7">
                        <input name="current_password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-5 col-lg-5 col-form-label">New Password</label>
                      <div class="col-md-auto col-lg-7">
                        <input name="new_password" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-5 col-lg-5 col-form-label">Re-Enter New Password</label>
                      <div class="col-md-auto col-lg-7">
                        <input name="renew_password" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-info">Change Account Info</button>
                    </div>
                  </form>  
                </div>
                <!-- End Account Setting Form -->
              </div>
              <!-- End Bordered Tabs -->
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->