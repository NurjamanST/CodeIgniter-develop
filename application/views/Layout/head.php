<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts Merriweather -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css')?>" rel="stylesheet">
    <!-- Quill CSS -->
    <!-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    
    <!-- <link href="<?= base_url('assets/vendor/quill/quill.snow.css')?>" rel="stylesheet"> -->
    <link href="<?= base_url('assets/vendor/quill/quill.bubble.css')?>" rel="stylesheet">

    <link href="<?= base_url('assets/vendor/remixicon/remixicon.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/simple-datatables/style.css')?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/css/style.css')?>" rel="stylesheet">
    <!-- Setup Navbar Landing Page -->
    <style>
        /* Memaksa seluruh halaman menggunakan font Merriweather */
        * {
            font-family: 'Merriweather', serif !important;
        }
        /* Pastikan konten tidak tertutup navbar */
        /* body {
            padding-top: 70px;
        } */
        /* Navbar */
        /* Sticky navbar */
        #navbar {
            background-color: transparent;
            transition: background-color 0.3s ease, padding 0.3s ease;
            z-index: 1030;
        }

        #navbar.scrolled {
            background-color: white !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        /* Height and styling for carousel as header */
        .header-carousel {
            height: 50vh; /* Menggunakan 50% dari tinggi viewport */
        }
        @media (min-width: 768px) {
            .header-carousel {
                height: 100vh; /* Menggunakan 100% dari tinggi viewport pada layar lebih besar */
            }
        }
        /* Carousel images fill and crop */
        .header-carousel .carousel-item img {
            object-fit: cover;
            width: 100%;
            height: 50vh; /* Menggunakan 50% dari tinggi viewport */
        }
        @media (min-width: 768px) {
            .header-carousel .carousel-item img {
                height: 100vh; /* Menggunakan 100% dari tinggi viewport pada layar lebih besar */
            }
        }

        /* Carousel caption styling */
        .header-carousel .carousel-caption {
            background: rgba(0, 0, 0, 0.35);
            border-radius: 0.5rem;
            padding: 1rem 1.5rem;
        }
        footer {
        background-color: #ffffff;
        padding: 40px 20px;
        text-align: left;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
        }

        .footer-section {
            width: 23%;
        }

        .footer-section h3 {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            color: #333;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin: 10px 0;
            color: #555;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }

    </style>
    <!-- End Setup Navbar Landing Page -->

    <!-- Setup Footer Landing Page -->
    <style>
        /* Container utama footer */
        .footer-container {
            padding: 40px 20px;
            background-color: #f8f9fa;
        }

        .footer-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .footer-section {
            flex: 1 1 200px;
            min-width: 250px;
        }

        .footer-section h3 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section li {
            margin-bottom: 8px;
        }

        .footer-section a {
            text-decoration: none;
            color: #555;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #000;
        }

        /* Footer bawah */
        .footer-bottom {
            background-color: #e9ecef;
            text-align: center;
            padding: 15px 10px;
            font-size: 14px;
            color: #666;
        }

        /* Responsive Mobile */
        @media (max-width: 768px) {
            .footer-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .footer-section {
                width: 100%;
            }
        }
    </style>
    <!-- End Setup Footer Landing Page -->

    <!-- Setup Detail Produk -->
    <style>
        .main-image img {
            transition: transform 0.3s ease;
        }

        .main-image img:hover {
            transform: scale(1.05);
        }

        .thumb-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .thumb-img.active {
            border-color: #ff6600 !important;
            box-shadow: 0 0 5px rgba(255, 102, 0, 0.5);
        }

        .thumb-img:hover {
            opacity: 0.9;
        }
        .product-card {
            transition: transform 0.2s ease;
        }
        .product-card:hover {
            transform: scale(1.02);
        }
        /* Thumbnail */
        .card .list-group-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Spacing */
        .card .list-group-item {
            padding: 10px 15px;
        }
        /* Mengatur gambar dalam narasi agar responsif */
        .article-content img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto; /* Pusatkan gambar */
            border-radius: 8px; /* Opsi tambahan: memberikan radius sudut */
        }

        /* Mengatur video dalam narasi agar responsif */
        .article-content iframe,
        .article-content video {
            width: 100%;
            height: auto;
            max-height: 400px; /* Batas maksimal tinggi video */
            margin: 0 auto; /* Pusatkan video */
            border-radius: 8px; /* Opsi tambahan: memberikan radius sudut */
        }
    </style>
    <!-- End Setup Detail Produk -->

    <!-- Setup Carousel-inner -->
    <style>
        /* Carousel */
        .carousel-inner .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .carousel-inner .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Gambar Produk */
        .carousel-inner .card-img-top {
            object-fit: cover;
            height: 200px; /* Atur tinggi gambar */
        }

        /* Tombol Marketplace */
        .carousel-inner .card-body img {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }
    </style>

    <style>
        /* Gambar Marketplace */
        .modal-body img {
            width: 20px;
            height: auto;
            object-fit: cover;
        }

        /* Layout Modal */
        .modal-body .row {
            justify-content: center;
        }

        /* Card Produk */
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Tombol Beli */
        .product-card .btn {
            display: block;
            width: 100%;
            margin-top: 10px;
        }

        /* Responsif untuk Mobile */
        @media (max-width: 768px) {
            .product-card .btn {
                font-size: 0.9rem; /* Ukuran teks lebih kecil di mobile */
            }
        }
    </style>
</head>

<body>
