  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?= base_url('/index.php/profile')?>" class="logo d-flex align-items-center">
        <!-- <img src="<?= base_url('assets/img/logohawe.png')?>" alt="" width="100"> -->
        <span class="d-none d-lg-block"><?= $profile->nama_merek ?></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <!-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- <img src="<?= base_url('assets/img/logohawe.png')?>" alt="Profile" class="rounded-circle"> -->
            <i class="bi bi-gear"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2">Pengaturan</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $admin->nama ?></h6>
              <span><?= $admin->email ?></span><br>
              <span>Manajemen Konten <?= $admin->nama?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= base_url('index.php/profile/details')?>">
                <i class="bi bi-person"></i>
                <span>Profil Saya</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center text-danger" href="<?= base_url('index.php/auth/logout')?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->