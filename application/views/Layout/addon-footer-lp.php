<footer>
    <div class="container-fluid footer-container">
        <div class="footer-row">
            <!-- COLLECTIONS -->
            <div class="footer-section">
                <h3>COLLECTIONS</h3>
                <ul>
                    <?php foreach ($collections as $collection): ?>
                        <li>
                            <a href="<?= base_url("index.php/Collections/view/{$collection->id}") ?>">
                                <?= $collection->nama_koleksi ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- CATEGORIES -->
            <div class="footer-section">
                <h3>CATEGORIES</h3>
                <ul>
                    <?php foreach ($categories as $cat): ?>
                        <li>
                            <a href="<?= base_url("index.php/Categories/view/{$cat->id}") ?>">
                                <?= $cat->nama_kategori ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- ABOUT US -->
            <div class="footer-section">
                <h3>ABOUT US</h3>
                <ul>
                    <li><a href="<?= base_url("index.php/Landing/About") ?>">Brand Story</a></li>
                    <li><a href="#">Testimonials (Commingsoon)</a></li>
                    <li><a href="#">Careers (Commingsoon)</a></li>
                </ul>
            </div>

            <!-- NEWS & SERVICES -->
            <div class="footer-section">
                <h3>NEWS & SERVICES</h3>
                <ul>
                    <li><a href="<?= base_url("index.php/Landing/News") ?>">News</a></li>
                    <li><a href="<?= base_url("index.php/Landing/faq") ?? '#'?>">FAQ</a></li>
                    <li><a href="<?= base_url("index.php/Landing/return_policy") ?>">Return Policy</a></li>
                    <li><a href="<?= base_url("index.php/Landing/terms_of_service") ?>">Terms of Service</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <p>© Hawe Collections <script>document.write(new Date().getFullYear())</script>. All rights reserved.</p>
        <p>Powered by SCRIPTECHLIGHT</p>
    </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
