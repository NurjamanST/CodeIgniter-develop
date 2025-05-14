  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?= base_url('/index.php/profile')?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('index.php/profile/details')?>">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#product-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-shop"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="product-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= base_url('index.php/Product/collections')?>">
              <i class="bi bi-circle"></i><span>Collections & Categories</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('index.php/Product/catalogues')?>">
              <i class="bi bi-circle"></i><span>Catalogues</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('index.php/News/index')?>">
          <i class="bi bi-newspaper"></i><span>News | Narrative List</span>
        </a>
      </li>
      <li>
        <a class="nav-link collapsed" href="<?= base_url('index.php/Slider/index')?>">
          <i class="bi bi-gear"></i><span>Pengaturan Slides</span>
        </a>
      </li>
      <!-- End Profile Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->