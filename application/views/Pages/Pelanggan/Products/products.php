<!-- Background Putih -->
<div class="container-fluid py-5 bg-white">
    <div class="py-5"></div>
</div>

<!-- Page Content -->
<div class="container my-5">
    <!-- Breadcrumb + Judul Halaman + Sort By -->
    <div class="col-md-12 bg-warning border-0 rounded-3 mb-3">
        <div class="card border-0 rounded-3 shadow-sm">
            <!-- Breadcrumb -->
            <div class="card-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('index.php/Landing/index') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= $page_title ?>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Konten Utama: Judul + Info + Tombol + Sort By -->
            <div class="card-body d-flex flex-wrap justify-content-between align-items-start">
                <!-- Judul dan Informasi -->
                <div class="mb-3 mb-md-0">
                    <h5 class="card-title mb-1"><?= $page_title ?></h5>
                    <p class="card-text text-secondary mb-0 mt-1">
                        Menampilkan <span id="productCount"><?= count($products) ?></span> dari <?= $total_products ?> produk.
                    </p>
                </div>

                <!-- Dropdown Sort By -->
                <div class="d-flex flex-wrap mt-0 mt-md-5">
                    <select id="sortSelect" class="form-select form-select-sm w-100 w-md-auto me-2 my-2 mb-md-0 px-3 py-2" aria-label="Sort By">
                        <option value="">Sort By</option>
                        <option value="az">A to Z</option>
                        <option value="za">Z to A</option>
                        <option value="lowHigh">Harga: Rendah ke Tinggi</option>
                        <option value="highLow">Harga: Tinggi ke Rendah</option>
                        <option value="oldNew">Tanggal: Lama ke Baru</option>
                        <option value="newOld">Tanggal: Baru ke Lama</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- List Produk -->
    <div id="productsContainer">
        <?php if (!empty($products)): ?>
            <div class="row row-cols-2 row-cols-md-4 g-3" id="productsGrid">
                <?php foreach ($products as $product): ?>
                    <div class="col product-item" 
                         data-name="<?= htmlspecialchars($product->nama_product, ENT_QUOTES, 'UTF-8') ?>"
                         data-price="<?= $product->harga ?>"
                         data-date="<?= $product->created_at ?? '' ?>">
                        <a href="<?= base_url('index.php/Landing/view/' . $product->id) ?>" 
                           class="text-decoration-none text-dark">
                            <div class="bg-white rounded-3 shadow-sm w-100 d-flex flex-column"
                                style="transition: transform 0.2s ease; cursor: pointer;"
                                onmouseover="this.style.transform='scale(1.02)';"
                                onmouseout="this.style.transform='scale(1)';">
                                
                                <!-- Gambar Produk -->
                                <div class="position-relative overflow-hidden" style="height: 180px;">
                                    <img src="<?= !empty($product->first_image) ? base_url('uploads/products/' . $product->first_image) : base_url('assets/img/no-image.png') ?>"
                                         class="w-100 h-100 object-fit-cover"
                                         alt="<?= htmlspecialchars($product->nama_product, ENT_QUOTES, 'UTF-8') ?>"
                                         style="transition: transform 0.3s ease;"
                                         onmouseover="this.style.transform='scale(1.1)';"
                                         onmouseout="this.style.transform='scale(1)';">
                                </div>

                                <!-- Deskripsi Produk -->
                                <div class="p-2 flex-grow-1 d-flex flex-column text-center">
                                    <p class="card-text text-dark fw-medium mb-1" style="height: 1.8rem; overflow: hidden;">
                                        <?= htmlspecialchars(substr($product->nama_product, 0, 24)) ?>...
                                    </p>
                                    <p class="card-text text-secondary small mb-1">
                                        <?= htmlspecialchars($product->nama_kategori ?? 'Kategori') ?> <br>
                                    </p>
                                    <p class="card-text fw-bold" style="color: #212121;">
                                        Rp <?= number_format($product->harga, 0, ',', '.') ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">Tidak ada produk ditemukan.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <?= $this->pagination->create_links(); ?>
    </div>
</div>

<style>
/* Animasi Swap yang Smooth */
.product-item {
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.product-item.moving {
    opacity: 0.7;
    transform: scale(0.95);
}

.product-item.final-position {
    opacity: 1;
    transform: scale(1);
}

/* Grid container transition */
#productsGrid {
    transition: all 0.4s ease;
}
</style>

<!-- JavaScript untuk Sorting dengan Direct Swap -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.getElementById('sortSelect');
    const productsGrid = document.getElementById('productsGrid');
    const productCount = document.getElementById('productCount');
    
    if (!sortSelect || !productsGrid) return;
    
    // Simpan urutan original produk
    let originalProductOrder = [];
    let isAnimating = false;
    
    // Initialize original order
    function initializeOriginalOrder() {
        const productItems = Array.from(productsGrid.querySelectorAll('.product-item'));
        originalProductOrder = productItems.map(item => item);
    }
    
    // Panggil di awal
    initializeOriginalOrder();
    
    sortSelect.addEventListener('change', function() {
        if (isAnimating) return;
        
        const sortValue = this.value;
        const productItems = Array.from(productsGrid.querySelectorAll('.product-item'));
        
        isAnimating = true;
        
        if (sortValue === '') {
            // Reset ke urutan original
            resetToOriginalOrder(productItems);
        } else {
            // Sort products dengan animasi swap
            sortProductsWithSwap(productItems, sortValue);
        }
    });
    
    function resetToOriginalOrder(currentItems) {
        // Add moving class untuk animasi
        currentItems.forEach(item => {
            item.classList.add('moving');
        });
        
        setTimeout(() => {
            // Langsung swap ke posisi original
            originalProductOrder.forEach(originalItem => {
                productsGrid.appendChild(originalItem);
            });
            
            // Remove moving class dan add final position
            setTimeout(() => {
                currentItems.forEach(item => {
                    item.classList.remove('moving');
                    item.classList.add('final-position');
                });
                
                // Clean up classes
                setTimeout(() => {
                    currentItems.forEach(item => {
                        item.classList.remove('final-position');
                    });
                    isAnimating = false;
                }, 300);
            }, 50);
        }, 200);
    }
    
    function sortProductsWithSwap(productItems, sortValue) {
        // Sort array untuk mendapatkan urutan yang benar
        const sortedItems = [...productItems].sort((a, b) => {
            const nameA = a.dataset.name.toLowerCase();
            const nameB = b.dataset.name.toLowerCase();
            const priceA = parseFloat(a.dataset.price);
            const priceB = parseFloat(b.dataset.price);
            const dateA = new Date(a.dataset.date || '2000-01-01');
            const dateB = new Date(b.dataset.date || '2000-01-01');
            
            switch(sortValue) {
                case 'az':
                    return nameA.localeCompare(nameB);
                case 'za':
                    return nameB.localeCompare(nameA);
                case 'lowHigh':
                    return priceA - priceB;
                case 'highLow':
                    return priceB - priceA;
                case 'oldNew':
                    return dateA - dateB;
                case 'newOld':
                    return dateB - dateA;
                default:
                    return 0;
            }
        });
        
        // Add moving class untuk animasi
        productItems.forEach(item => {
            item.classList.add('moving');
        });
        
        // Wait for animation to start
        setTimeout(() => {
            // Langsung reorder items berdasarkan sorted array
            sortedItems.forEach(item => {
                productsGrid.appendChild(item);
            });
            
            // Remove moving class dan add final position
            setTimeout(() => {
                productItems.forEach(item => {
                    item.classList.remove('moving');
                    item.classList.add('final-position');
                });
                
                // Clean up classes
                setTimeout(() => {
                    productItems.forEach(item => {
                        item.classList.remove('final-position');
                    });
                    isAnimating = false;
                }, 300);
            }, 50);
        }, 200);
        
        productCount.textContent = productItems.length;
    }
});
</script>