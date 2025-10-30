<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sticky Product Detail GSAP + Parallax</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
    background: #f8f9fa;
    padding-top: 50px;
  }

  .col-left {
    position: relative;
    will-change: transform;
  }

  .col-left img {
    width: 100%;
    border-radius: 10px;
    display: block;
    margin-bottom: 20px;
  }

  .product-detail {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
  }

  .col-right {
    position: relative;
  }
</style>
</head>
<body>

<!-- Page Content -->
<div class="container-fluid mb-2 bg-white position-relative " style="top:120px; z-index:1;">
    <!-- Breadcrumb -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <!-- Breadcrumb -->
            <div class="card-header py-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('index.php/Landing/index') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('index.php/Collections/index') ?>">Collections</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('index.php/Collections/view/' . $product->koleksi_id) ?>"><?= htmlspecialchars($product->nama_koleksi) ?></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= htmlspecialchars($product->nama_product) ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<div class="container" id="productContainer">
  <div class="row align-items-start">
    <!-- KIRI -->
    <div class="col-md-6 col-left" id="left-col">
      <?php if(!empty($colors)): ?>
        <?php foreach($colors as $colorIndex => $color): ?>
            <?php if(!empty($color->images)): ?>
                <div id="color-<?= $colorIndex ?>" class="mb-3">
                    <?php foreach($color->images as $image): ?>
                        <img src="<?= base_url('uploads/products/'.$image->image) ?>" class="img-fluid rounded mb-2" alt="<?= $product->nama_product ?>">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Produk belum memiliki gambar.</p>
      <?php endif; ?>
    </div>

    <!-- KANAN -->
    <div class="col-md-5 ms-4 col-right">
      <div class="product-detail" id="productDetail">
        <h2><?= $product->nama_product ?? 'Demo Produk' ?></h2>

        <div class="mb-3">
          <label class="form-label fw-bold">Color</label>
          <div class="d-flex flex-wrap gap-2">
            <?php if(!empty($colors)): ?>
              <?php foreach($colors as $colorIndex => $color): ?>
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="scrollToColor(<?= $colorIndex ?>)"><?= $color->nama_warna ?></button>
              <?php endforeach; ?>
            <?php else: ?>
              <p>Tidak ada warna untuk produk ini.</p>
            <?php endif; ?>
          </div>
        </div>

        <p class="text-muted"><?= $product->keterangan ?? 'Deskripsi demo produk di sini'; ?></p>
        <h4 class="text-success">Rp. <?= $product->harga ?? 'harga'?></h4>
        <ul class="list-unstyled mt-3">
          <li><strong>Kategori:</strong> <?= $product->kategori ?? 'Demo Kategori' ?></li>
          <li><strong>Koleksi:</strong> <?= $product->koleksi ?? 'Demo Koleksi' ?></li>
        </ul>
        <button class="btn btn-primary mt-3">Add to Cart</button>
      </div>
    </div>
  </div>
</div>


<!-- GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script>
  gsap.registerPlugin(ScrollTrigger);
  const productDetail = document.getElementById("productDetail");
  const container = document.getElementById("productContainer");
  const leftCol = document.getElementById("left-col");

  // Sticky kanan + scroll lebih cepat
  ScrollTrigger.create({
    trigger: productDetail,
    start: "top top+=120",
    endTrigger: container,
    end: "bottom bottom",
    pin: productDetail,
    pinSpacing: true,
    scrub: 1.2,
    markers: true
  });
  

  // Parallax kiri lebih lambat
  let isScrollingToColor = false;
  window.addEventListener('scroll', () => {
    if (isScrollingToColor) return;
    
    const rect = container.getBoundingClientRect();
    const scrollTop = window.scrollY || window.pageYOffset;
    const containerTop = container.offsetTop;
    
    if (scrollTop > containerTop) {
      const scrollDistance = scrollTop - containerTop;
      const maxScroll = container.offsetHeight - window.innerHeight;
      const offset = Math.min(scrollDistance * 0.3, maxScroll * 0.3);
      leftCol.style.transform = `translateY(${offset}px)`;
    } else {
      leftCol.style.transform = 'translateY(0px)';
    }
  });
  
  // Fungsi scroll ke warna tertentu
  function scrollToColor(colorIndex) {
    const colorElement = document.getElementById('color-' + colorIndex);
    if (colorElement) {
      isScrollingToColor = true;
      
      // Hitung posisi absolut dari element
      const elementRect = colorElement.getBoundingClientRect();
      const absoluteTop = elementRect.top + window.pageYOffset;
      const currentTransform = leftCol.style.transform;
      const currentOffset = currentTransform.match(/translateY\((-?\d+\.?\d*)px\)/) 
        ? parseFloat(currentTransform.match(/translateY\((-?\d+\.?\d*)px\)/)[1]) 
        : 0;
      
      // Target scroll dengan kompensasi parallax
      const targetScroll = absoluteTop - currentOffset - 140;
      
      window.scrollTo({
        top: targetScroll,
        behavior: 'smooth'
      });
      
      // Reset flag setelah scroll selesai
      setTimeout(() => {
        isScrollingToColor = false;
      }, 1000);
    }
  }
</script>

</body>
</html>