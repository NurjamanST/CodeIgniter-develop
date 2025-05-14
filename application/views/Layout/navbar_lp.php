<nav class="navbar navbar-expand-lg fixed-top navbar-light" id="navbar">
  <div class="container-fluid px-4 px-lg-5" style="height: 100%; display: flex; align-items: center;">
    <!-- Brand -->
    <a class="navbar-brand" href="#">
      <img src="<?= base_url('assets/img/logohawe2.png') ?>" alt="Logo" width="100" class="img-fluid">
    </a>

    <!-- Toggler Button untuk Mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar"
      aria-controls="mobileSidebar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Desktop Menu -->
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll fw-bold" style="--bs-scroll-height: 100px;">
          <!-- Home -->
          <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= base_url('index.php/Landing/index') ?>">Home</a>
          </li>

          <!-- Collections -->
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="<?= base_url('index.php/Collections/index') ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Product Collections
              </a>
              <ul class="dropdown-menu shadow-sm">
                  <?php foreach ($collections as $collection): ?>
                      <li>
                          <a class="dropdown-item" href="<?= base_url('index.php/Collections/view/' . $collection->id) ?>">
                              <?= $collection->nama_koleksi ?>
                          </a>
                      </li>
                  <?php endforeach; ?>
              </ul>
          </li>

          <!-- Categories -->
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="<?= base_url('index.php/Categories/index') ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Product Categories
              </a>
              <ul class="dropdown-menu shadow-sm">
                  <?php foreach ($categories as $cat): ?>
                      <li>
                          <a class="dropdown-item" href="<?= base_url('index.php/Categories/view/' . $cat->id) ?>">
                              <?= $cat->nama_kategori ?>
                          </a>
                      </li>
                  <?php endforeach; ?>
              </ul>
          </li>

          <!-- News -->
          <li class="nav-item">
              <a class="nav-link" href="<?= base_url('index.php/Landing/News') ?>">News</a>
          </li>

          <!-- About Us -->
          <li class="nav-item">
              <a class="nav-link" href="<?= base_url('index.php/Landing/About') ?>">About Us</a>
          </li>
      </ul>

      <!-- Tombol Login Admin -->
      <a href="<?= base_url('index.php/auth/login'); ?>" class="btn btn-outline-dark d-none d-lg-inline-block me-2">Login Admin</a>
    </div>
  </div>
</nav>

<!-- Sidebar Offcanvas untuk Mobile -->
<div class="offcanvas offcanvas-start bg-white" tabindex="-1" id="mobileSidebar" aria-labelledby="sidebarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column p-4">
    <ul class="navbar-nav mb-auto">
      <li class="nav-item">
          <a class="nav-link" href="<?= base_url('index.php/Landing/index') ?>">Home</a>
      </li>

      <!-- Collections -->
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="<?= base_url('index.php/Collections/index') ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Product Collections
          </a>
          <ul class="dropdown-menu w-100">
              <?php foreach ($collections as $collection): ?>
                  <li>
                      <a class="dropdown-item" href="<?= base_url('index.php/Collections/view/' . $collection->id) ?>">
                          <?= $collection->nama_koleksi ?>
                      </a>
                  </li>
              <?php endforeach; ?>
          </ul>
      </li>

      <!-- Categories -->
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="<?= base_url('index.php/Categories/index') ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Product Categories
          </a>
          <ul class="dropdown-menu w-100">
              <?php foreach ($categories as $cat): ?>
                  <li>
                      <a class="dropdown-item" href="<?= base_url('index.php/Categories/view/' . $cat->id) ?>">
                          <?= $cat->nama_kategori ?>
                      </a>
                  </li>
              <?php endforeach; ?>
          </ul>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="<?= base_url('index.php/Landing/News') ?>">News</a>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="<?= base_url('index.php/Landing/About') ?>">About Us</a>
      </li>
    </ul>

    <!-- Tombol Login Admin di Sidebar -->
    <hr class="my-3">
    <div class="d-grid">
      <a href="<?= base_url('index.php/auth/login'); ?>" class="btn btn-outline-dark">Login Admin</a>
    </div>
  </div>
</div>