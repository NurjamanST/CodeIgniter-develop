    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Script JavaScript untuk kirim data ke Modal Edit & Delete Product -->
    <script>
        // Fungsi untuk membuka Modal Delete dan set id
        function openDeleteModal(id) {
            $('#delete_id').val(id);
            $('#deleteCatalogueModal').modal('show');
        }
        // Fungsi untuk membuka Modal Edit dan set data
        function openEditModal(product) {
            $('#edit_id').val(product.id);
            $('#edit_nama_product').val(product.nama_product);
            $('#edit_shopee').val(product.shopee);
            $('#edit_lazada').val(product.lazada);
            $('#edit_tiktokshop').val(product.tiktokshop);
            $('#edit_tokopedia').val(product.tokopedia);
            $('#edit_harga').val(product.harga);

            // $('#edit_keterangan').val(product.keterangan);

            // Masukkan isi keterangan ke Quill
            editQuill.root.innerHTML = product.keterangan || "";

            // Set Koleksi
            $('#edit_koleksiSelect').val(product.koleksi_id).trigger('change');

            // Tunggu dikit supaya kategori load
            setTimeout(function() {
                $('#edit_kategoriSelect').val(product.kategori_id);
            }, 500);

            // Set Preview Gambar Lama
            if (product.gambar1) {
                $('#edit_preview_gambar1').attr('src', '<?= base_url("uploads/products/") ?>' + product.gambar1).show();
            }
            if (product.gambar2) {
                $('#edit_preview_gambar2').attr('src', '<?= base_url("uploads/products/") ?>' + product.gambar2).show();
            }
            if (product.gambar3) {
                $('#edit_preview_gambar3').attr('src', '<?= base_url("uploads/products/") ?>' + product.gambar3).show();
            }
            if (product.gambar4) {
                $('#edit_preview_gambar4').attr('src', '<?= base_url("uploads/products/") ?>' + product.gambar4).show();
            }
            if (product.gambar5) {
                $('#edit_preview_gambar5').attr('src', '<?= base_url("uploads/products/") ?>' + product.gambar5).show();
            }

            $('#editCatalogueModal').modal('show');
        }

        // Saat koleksi dipilih di edit, ambil kategori
        $('#edit_koleksiSelect').change(function () {
            var koleksi_id = $(this).val();
            if (koleksi_id) {
                $.ajax({
                    url: "<?= base_url('index.php/Product/get_categories_by_koleksi/') ?>" + koleksi_id,
                    method: "GET",
                    dataType: "json", // ✅ otomatis parse JSON
                    success: function (kategori) {
                        $('#edit_kategoriSelect').html('<option value="">-- Pilih Kategori --</option>');
                        kategori.forEach(function (k) {
                            $('#edit_kategoriSelect').append('<option value="' + k.id + '">' + k.nama_kategori + '</option>');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error("Gagal ambil kategori:", error);
                        $('#edit_kategoriSelect').html('<option value="">Gagal memuat kategori</option>');
                    }
                });
            } else {
                $('#edit_kategoriSelect').html('<option value="">-- Pilih Koleksi dulu --</option>');
            }
        });
        // Preview gambar saat upload di add atau edit modal
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                preview.src = e.target.result;
                preview.style.display = "block";
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }

    </script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const koleksiSelect = document.getElementById('koleksiSelect');
        const kategoriSelect = document.getElementById('kategoriSelect');

        if (koleksiSelect && kategoriSelect) {
            koleksiSelect.addEventListener('change', function () {
                const koleksiId = this.value;
                kategoriSelect.innerHTML = '<option value="">Loading...</option>';

                fetch('<?= base_url('index.php/Product/get_categories_by_koleksi/') ?>' + koleksiId)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('HTTP error! Status: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        kategoriSelect.innerHTML = '<option value="">-- Pilih Kategori --</option>';
                        if (data.length > 0) {
                            data.forEach(cat => {
                                kategoriSelect.innerHTML += `<option value="${cat.id}">${cat.nama_kategori}</option>`;
                            });
                        } else {
                            kategoriSelect.innerHTML += `<option value="">(Kategori kosong)</option>`;
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        kategoriSelect.innerHTML = '<option value="">Error memuat kategori</option>';
                        alert('Gagal memuat kategori: ' + error.message);
                    });
            });
        }
    });
    </script>



    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets/vendor/apexcharts/apexcharts.min.js')?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?= base_url('assets/vendor/chart.js/chart.umd.js')?>"></script>
    <script src="<?= base_url('assets/vendor/echarts/echarts.min.js')?>"></script>
    <script src="<?= base_url('assets/vendor/simple-datatables/simple-datatables.js')?>"></script>
    <script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js')?>"></script>
    <script src="<?= base_url('assets/vendor/php-email-form/validate.js')?>"></script>
    <!-- Navbar Scroll Setup -->
    <script>
        window.addEventListener("scroll", function () {
        var navbar = document.getElementById("navbar");
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
        });
    </script>
    <!-- Navbar Scroll Setup -->

    <!-- Quill JS -->
    <script src="<?= base_url('assets/vendor/quill/quill.min.js')?>"></script>

    <!-- add Quill Keterangan -->
    <script>
        // Inisialisasi Quill Editor
        const quill = new Quill('#quillEditor', {
            theme: 'snow'
        });

        // Sync ke textarea sebelum submit
        document.querySelector('form').addEventListener('submit', function () {
            document.getElementById('keterangan').value = quill.root.innerHTML;
        });
    </script> 

    <!-- Add Narasi Quill -->
    <script>
        // Inisialisasi Quill Editor untuk Edit
        const newsQuill = new Quill('#editQuillNews', {
            theme: 'snow'
        });

        // Sync ke textarea sebelum submit
        document.getElementById('newsForm').addEventListener('submit', function () {
            document.getElementById('narasi').value = newsQuill.root.innerHTML;
        }); 

    </script>

    <!-- edit Keterangan Quill -->
    <script>
        // Inisialisasi Quill Editor untuk Edit
        const editQuill = new Quill('#editQuillEditor', {
            theme: 'snow'
        });

        // Sync ke textarea sebelum submit
        document.getElementById('formEditProduk').addEventListener('submit', function () {
            document.getElementById('edit_keterangan').value = editQuill.root.innerHTML;
        }); 

    </script>
    <!-- Edit Narasi Quill -->
     <script>
        // Inisialisasi Quill Editor untuk Edit
        const editNews = new Quill('#editNews', {
            theme: 'snow'
        });

        // Sinkronisasi isi Quill ke textarea sebelum form disubmit
        document.getElementById('editNewsForm').addEventListener('submit', function () {
            document.getElementById('edit_narasi').value = editNews.root.innerHTML;
        });
     </script>

    <!-- Script JavaScript untuk kirim data ke Modal Edit & Delete News -->
    <script>
    // Fungsi untuk buka modal edit dan isi data
    function openEditModalNews(data) {
        // Isi input form
        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_judul').value = data.judul;
        document.getElementById('edit_tanggal').value = data.tanggal;

        // Isi Quill Editor
        if (window.editNews) {
        editNews.root.innerHTML = data.narasi || '';
        }

        // Tampilkan preview gambar jika ada
        const imgPreview = document.getElementById('edit_preview_gambar');
        if (data.gambar) {
        imgPreview.src = `<?= base_url('assets/uploads/news/') ?>${data.gambar}`;
        imgPreview.style.display = 'block';
        } else {
        imgPreview.style.display = 'none';
        }

        // Tampilkan modal edit
        const modal = new bootstrap.Modal(document.getElementById('editNewsModal'));
        modal.show();
    }

    // Fungsi untuk konfirmasi dan buka modal hapus
    function openDeleteModalNews(id) {
        // Set id ke input hidden
        document.getElementById('delete_id').value = id;

        // Tampilkan modal hapus
        const modal = new bootstrap.Modal(document.getElementById('deleteNewsModal'));
        modal.show();
    }
    </script>
    <!-- Burger Menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navbar = document.getElementById('navbar');
            const navbarCollapse = document.querySelector('.navbar-collapse');

            // Saat menu dibuka
            navbarCollapse.addEventListener('shown.bs.collapse', function () {
            navbar.classList.remove('navbar-transparent');
            navbar.classList.add('navbar-solid');
            });

            // Saat menu ditutup
            navbarCollapse.addEventListener('hidden.bs.collapse', function () {
            // Jika user masih di atas halaman, biarkan transparan
            if (window.scrollY === 0) {
                navbar.classList.remove('navbar-solid');
                navbar.classList.add('navbar-transparent');
            }
            });

            // Optional: ubah background saat scroll
            document.addEventListener('DOMContentLoaded', function () {
                const navbar = document.getElementById('navbar');

                if (!navbar) return; // Jika navbar tidak ada, hentikan eksekusi

                function updateNavbar() {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                }

                // Jalankan sekali saat halaman dimuat
                updateNavbar();

                // Tambahkan event listener untuk scroll
                window.addEventListener('scroll', updateNavbar);
            });
        });
    </script>
    <!-- Detail Produk Images -->
    <script>
        function changeImage(element) {
            const mainImage = document.getElementById('mainImage');
            const thumbnails = document.querySelectorAll('.thumb-img');

            // Hapus class 'active' dari semua thumbnail
            thumbnails.forEach(thumb => thumb.classList.remove('active'));

            // Tambahkan class 'active' ke thumbnail yang diklik
            element.classList.add('active');

            // Ganti src gambar utama
            mainImage.src = element.src;
        }
    </script>
    <!-- Sorting Data Produk -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.product-card');
            const sortSelect = document.getElementById('sortSelect');

            // Fungsi untuk mengurutkan dan merender ulang produk
            function sortProducts(criteria) {
                let sortedCards = Array.from(cards);

                switch (criteria) {
                    case 'az':
                        sortedCards.sort((a, b) => a.dataset.name.localeCompare(b.dataset.name));
                        break;
                    case 'za':
                        sortedCards.sort((a, b) => b.dataset.name.localeCompare(a.dataset.name));
                        break;
                    case 'lowHigh':
                        sortedCards.sort((a, b) => a.dataset.price - b.dataset.price);
                        break;
                    case 'highLow':
                        sortedCards.sort((a, b) => b.dataset.price - a.dataset.price);
                        break;
                    case 'oldNew':
                        sortedCards.sort((a, b) => a.dataset.date - b.dataset.date);
                        break;
                    case 'newOld':
                        sortedCards.sort((a, b) => b.dataset.date - a.dataset.date);
                        break;
                    default:
                        return; // Tidak perlu diubah jika tidak ada pilihan
                }

                // Kosongkan kontainer lalu tambahkan produk yang sudah di-sort
                const container = document.querySelector('.row');
                container.innerHTML = '';
                sortedCards.forEach(card => container.appendChild(card));
            }

            // Event listener untuk dropdown
            sortSelect.addEventListener('change', function () {
                sortProducts(this.value);
            });
        });
    </script>
    <script>
        document.getElementById('logo_merek').addEventListener('change', function(event) {
            const input = event.target;
            const preview = document.getElementById('logoPreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>
    <!-- JavaScript: Buka Modal Edit Saat Card Diklik -->
    <script>
        function openEditSlide(data) {
            const slider = typeof data === 'string' ? JSON.parse(data) : data;

            document.getElementById('edit_id').value = slider.id;
            document.getElementById('edit_urutan').value = slider.urutan;
            document.getElementById('edit_status').value = slider.status;
            document.getElementById('edit_gambar_preview').src = "<?= base_url('assets/uploads/sliders/') ?>" + slider.gambar;

            const editModal = new bootstrap.Modal(document.getElementById('editSlideModal'));
            editModal.show();
        }

        // Preview saat ganti gambar di edit
        function previewNewImage(event) {
            const reader = new FileReader();
            const preview = document.getElementById('edit_gambar_preview');
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script>
         let delete_id = null;

        function setDeleteId(id) {
            delete_id = id;
            document.getElementById('confirmDeleteBtn').href = "<?= base_url('index.php/Slider/delete/') ?>" + id;
        }
    </script>
    <!-- Template Main JS File -->
    <script src="<?= base_url('assets/js/main.js')?>"></script>

</body>
</html>