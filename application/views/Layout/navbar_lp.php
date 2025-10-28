<nav class="navbar navbar-expand-lg fixed-top navbar-light" id="navbar">
    <div class="container-fluid">
        <div class="col-12 py-2 px-3 px-lg-5">
            <div class="d-flex justify-content-between align-items-center p-1 position-relative">
                <!-- Search Icon -->
                <a href="#" class="btn btn-transparent me-2" data-bs-toggle="collapse" data-bs-target="#searchCollapse">
                    <i class="bi bi-search"></i>
                </a>

                <!-- Brand/Logo -->
                <a class="navbar-brand position-absolute top-50 start-50 translate-middle" href="<?= base_url('Landing/index') ?>">
                    <img src="<?= base_url('assets/img/logohawe2.png') ?>" alt="Logo" width="100" class="img-fluid">
                </a>

                <!-- Mobile Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" 
                        aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            
            <!-- Collapsible Content -->
            <div class="collapse navbar-collapse" id="navbarScroll">
                <!-- Menu Items -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url('Landing/index') ?>">Home</a>
                    </li>
                    
                    <!-- Collections -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('Collections/index') ?>" role="button" 
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu shadow-sm">
                            <?php foreach ($collections as $collection): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('Collections/view/' . $collection->id) ?>">
                                        <?= $collection->nama_koleksi ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    
                    <!-- Categories -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('Categories/index') ?>" role="button" 
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Collections
                        </a>
                        <ul class="dropdown-menu shadow-sm">
                            <?php foreach ($categories as $cat): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('Categories/view/' . $cat->id) ?>">
                                        <?= $cat->nama_kategori ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    
                    <!-- News -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('Landing/News') ?>">News</a>
                    </li>
                    
                    <!-- About Us -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('Landing/About') ?>">About Us</a>
                    </li>
                </ul>
            </div>

            <!-- Search Bar (Collapsible) -->
            <div class="collapse" id="searchCollapse">
                <div class="my-3">
                    <form action="<?= base_url('landing/search') ?>" method="get" class="d-flex align-items-center">
                        <input type="text" name="keyword" class="form-control rounded-pill me-2 bg-transparent border-secondary" 
                                placeholder="Pencarian Produk . . . ." aria-label="Search" required>
                        <button class="btn btn-outline-secondary rounded-pill" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
