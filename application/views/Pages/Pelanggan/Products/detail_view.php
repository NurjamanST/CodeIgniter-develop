<!-- Page Content -->
<div class="container-fluid mb-2 bg-white position-relative " style="padding-top: 120px;">
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

    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sticky Product Detail GSAP</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
    background: #f8f9fa;
    padding-top: 50px;
  }

  .col-left img {
    width: 100%;
    border-radius: 10px;
    display: block;
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

<div class="container" id="productContainer">
  <div class="row align-items-start">

    <!-- KIRI -->
    <div class="col-md-6 col-left" id="left-col">
      <?php for($i=0;$i<6;$i++): ?>
        <img src="https://picsum.photos/600/400?random=<?= $i ?>" 
             alt="Gambar <?= $i ?>" 
             class="img-fluid rounded py-2">
      <?php endfor; ?>
    </div>

    <!-- KANAN -->
    <div class="col-md-5 ms-4 col-right">
      <div class="product-detail" id="productDetail">
        <h2>Kids Couple Towel - Astronaut Snuggles</h2>
        <p class="text-muted fs-5 mb-4">Rp 329.900,00</p>

        <div class="mb-3">
          <label class="form-label fw-bold">Color</label>
          <div class="d-flex flex-wrap gap-2">
            <?php 
            $colors = [
              "DREAMY BEIGE – DREAMY BEIGE",
              "DREAMY BEIGE – MAGIC LILAC",
              "MAGIC LILAC – MAGIC LILAC",
              "MAGIC LILAC – TWILIGHT BLUE",
              "TWILIGHT BLUE – TWILIGHT BLUE",
              "TWILIGHT BLUE – DREAMY BEIGE"
            ];
            foreach ($colors as $color): ?>
              <button type="button" class="btn btn-outline-secondary btn-sm"><?= $color ?></button>
            <?php endforeach; ?>
          </div>
        </div>

        <h4>Nama Produk</h4>
        <p class="text-muted"><?= $product->keterangan ?? 'Deskripsi demo produk di sini'; ?></p>
        <h4 class="text-success">Rp 329.900</h4>

        <ul class="list-unstyled mt-3">
          <li><strong>Kategori:</strong> Demo Kategori</li>
          <li><strong>Koleksi:</strong> Demo Koleksi</li>
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

  // ScrollTrigger Sticky logic
  ScrollTrigger.create({
    trigger: productDetail,
    start: "bottom bottom", // ketika produk kanan habis (bawah-nya menyentuh bawah layar)
    endTrigger: container,  // sticky sampai container habis
    end: "bottom bottom",
    pin: productDetail,     // elemen yang di-pin (sticky)
    pinSpacing: false,      // tidak menambah ruang kosong di bawah
    scrub: true,
    markers: true // bisa kamu matikan nanti
  });
</script>

</body>
</html>
