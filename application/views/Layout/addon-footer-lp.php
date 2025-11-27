<footer>
    <div class="container-fluid footer-container w-100">
        <div class="footer-row d-flex justify-content-between w-100">
            <!-- COLLECTIONS -->
            <div class="footer-section">
                <h3 style="font-size: calc(1.25rem + 1px)">COLLECTIONS</h3>
                <ul>
                    <?php foreach ($collections as $collection): ?>
                        <li>
                            <a href="<?= base_url("index.php/Collections/view/{$collection->id}") ?>" style="font-size: calc(1rem + 1px)">
                                <?= $collection->nama_koleksi ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- CATEGORIES -->
            <div class="footer-section">
                <h3 style="font-size: calc(1.25rem + 1px)">CATEGORIES</h3>
                <ul>
                    <?php foreach ($categories as $cat): ?>
                        <li>
                            <a href="<?= base_url("index.php/Categories/view/{$cat->id}") ?>" style="font-size: calc(1rem + 1px)">
                                <?= $cat->nama_kategori ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- ABOUT US -->
            <div class="footer-section">
                <h3 style="font-size: calc(1.25rem + 1px)">ABOUT US</h3>
                <ul>
                    <li><a href="<?= base_url("index.php/Landing/About") ?>" style="font-size: calc(1rem + 1px)">Brand Story</a></li>
                    <li><a href="#" style="font-size: calc(1rem + 1px)">Testimonials (Commingsoon)</a></li>
                    <li><a href="#" style="font-size: calc(1rem + 1px)">Careers (Commingsoon)</a></li>
                </ul>
            </div>

            <!-- NEWS & SERVICES -->
            <div class="footer-section">
                <h3 style="font-size: calc(1.25rem + 1px)">NEWS & SERVICES</h3>
                <ul>
                    <li><a href="<?= base_url("index.php/Landing/News") ?>" style="font-size: calc(1rem + 1px)">News</a></li>
                     <li>
                    <a href="<?= method_exists('Landing', 'FAQ') ? base_url("index.php/Landing/terms_of_service") : '#' ?>" 
                    style="font-size: calc(1rem + 1px)">
                        FAQ
                    </a>
                </li>
                 <li>
                    <a href="<?= method_exists('Landing', 'faq') ? base_url("index.php/Landing/faq") : '#' ?>" 
                    style="font-size: calc(1rem + 1px)">
                        Return Policy
                    </a>
                </li>
                <li>
                    <a href="<?= method_exists('Landing', 'terms_of_service') ? base_url("index.php/Landing/terms_of_service") : '#' ?>" 
                    style="font-size: calc(1rem + 1px)">
                        Terms Of Service
                    </a>
                </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <p style="font-size: calc(1rem + 1px)">© Hawe Collections <script>document.write(new Date().getFullYear())</script>. All rights reserved.</p>
        <p style="font-size: calc(1rem + 1px)">Powered by SCRIPTECHLIGHT</p>
    </div>
</footer>


<div class="chat-bubble d-flex flex-row align-items-center">
	<!-- Add WhatsApp button -->
	<div class="chat-button my-2 mx-2">
		<a  href="https://api.whatsapp.com/send/?
				phone=<?= $profile->whatsapp ?>&
				text=Halo,%20saya%20tertarik%20dengan%20produk%20anda%20dan%20ingin%20bertanya%20lebih%20lanjut..."
			class="chat-btn whatsapp-btn" title="Contact Us via WhatsApp" target="_blank">
			<i class="bi bi-whatsapp" style="font-size:25px;"></i>
		</a>
	</div>
	<!-- Back to top button -->
	<div class="chat-button my-2 mx-2">
		<a href="#" class="chat-btn back-to-top-btn" title="Back to Top">
			<i class="bi bi-arrow-up-short" style="font-size: 32px;"></i>
		</a>
	</div>
</div>