  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item active"><a href="<?= base_url('/index.php/profile')?>">Dashboard</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            <!-- Koleksi Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Collections <span>| Product</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-collection"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <!-- <span class="text-danger small pt-1 fw-bold">12%</span> -->
                      <span class="text-muted small pt-2 ps-1">Collections</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Kategori Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Category <span>| Product</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-columns-gap"></i>
                    </div>
                    <div class="ps-3">
                      <h6>364</h6>
                      <span class="text-muted small pt-2 ps-1">Category</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Katalog Card -->
            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Catalogue <span>| Produk</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart4"></i>
                    </div>
                    <div class="ps-3">
                      <h6>1244</h6>
                      <span class="text-muted small pt-2 ps-1">Catalog</span>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Katalog Produk -->
            <!-- <div class="col-12">
              <div class="card top-selling overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Katalog <span>| Produk</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Kategori</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php for ($i=1; $i < 60; $i++) {?>
                        <tr>
                          <th scope="row"><a href="#">#2457</a></th>
                          <td><img src="<?= base_url('assets/img/product-'.$i.'.jpg')?>" alt="" class="w-100"></td>
                          <td><a href="#" class="text-info">At praesentium minu</a></td>
                          <td>Rp. 100.000</td>
                          <td>
                            <span class="badge bg-success">Special Items</span><br>
                            <span class="badge bg-warning">Summer Collection</span>
                          </td>
                        </tr>
                      <?php }; ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div> -->
            <!-- End Recent Sales -->
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-12">
          <div class="row justify-content-between mx-1">
            <!-- Profile -->
            <div class="card col-lg-6 col-md-12">
              <div class="card-body profile-card d-flex flex-column align-items-center">
                <img src="<?= base_url('assets/uploads/profile/'.$profile->logo_merek)?>" alt="<?= $profile->nama_merek?>" class=" w-100 p-4">
                <h6><i>"<?= $profile->slogan?>"</i></h6>
                <div class="social-links mx-3">
                  <p class=""><?= $profile->deskripsi?></p>
                </div>
              </div>
            </div>
            <!-- Berita Terbaru -->
            <div class="card col-lg-5 col-md-12">
              <div class="card-body pb-1">
                <h5 class="card-title">News <span>| Latest</span></h5>
                <div class="news my-2">
                  <?php
                  // var_dump($news);
                  foreach ($news as $news) {
                    $date = date_create($news->tanggal);
                    $date = date_format($date, 'd/m/Y');
                    $title = $news->judul;
                    $img = base_url("assets/uploads/news/" . $news->gambar);
                  ?>
                    <div class="post-item clearfix">
                      <img src="<?= $img?>" alt="">
                      <h4><a href="#"><?= $title?></a></h4>
                      <p>Uploaded on :<?= $date?></p>
                    </div>
                  <?php }; ?>
                </div><!-- End sidebar recent posts-->
  
              </div>
            </div><!-- End News & Updates -->
          </div>
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  