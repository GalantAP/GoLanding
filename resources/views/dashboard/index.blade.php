@extends('layouts.app')

@section('title', 'Dashboard - GoLanding')

@section('styles')
    <style>
        /* General Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #000000;
            color: #fff;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }

        /* Navbar Styling */
        .navbar {
            background: #000000;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: 700;
            text-decoration: none;
            color: white;
        }

        .logo span {
            color: #dc0000;
        }

        .nav-links {
            display: flex;
            gap: 35px;
            align-items: center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.3s;
            position: relative;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #ffffff;
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #dc0000;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .cart-icon {
            color: #dc0000;
            font-size: 20px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .cart-icon:hover {
            transform: scale(1.1);
        }

        .user-name {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            font-weight: 500;
        }

        .login-btn {
            background: transparent;
            border: none;
            color: white;
            padding: 8px 20px;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .login-btn:hover {
            color: #dc0000;
        }

        .signup-btn {
            background: #dc0000;
            border: none;
            color: white;
            padding: 10px 26px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .signup-btn:hover {
            background: #ff0000;
            transform: translateY(-2px);
        }

        .logout-form {
            display: inline-block;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(180deg, #1a0000 0%, #000000 100%);
            padding: 120px 0 100px;
            text-align: center;
            position: relative;
        }

        .hero h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .hero p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 50px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Search Section */
        .search-bar {
            display: flex;
            gap: 10px;
            max-width: 700px;
            margin: 0 auto 40px;
            background: rgba(255, 255, 255, 0.05);
            padding: 8px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .search-input {
            flex: 1;
            padding: 14px 20px;
            background: transparent;
            border: none;
            color: white;
            font-size: 14px;
        }

        .search-input:focus {
            outline: none;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .search-btn {
            padding: 14px 32px;
            background: #dc0000;
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .search-btn:hover {
            background: #ff0000;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 0, 0, 0.4);
        }

        /* Category Pills */
        .category-pills {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .pill {
            padding: 10px 22px;
            background: transparent;
            border: 1.5px solid #dc0000;
            border-radius: 30px;
            color: #dc0000;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .pill:hover {
            background: #dc0000;
            color: white;
        }

        .pill.active {
            background: #dc0000;
            color: white;
        }

        /* Section Header */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 60px 0 30px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
        }

        .view-all-btn {
            padding: 12px 28px;
            background: transparent;
            border: 2px solid #dc0000;
            border-radius: 8px;
            color: #dc0000;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .view-all-btn:hover {
            background: #dc0000;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 0, 0, 0.3);
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 60px;
        }

        .product-card {
            background: #0a0000;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.05);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(220, 0, 0, 0.3);
            border-color: rgba(220, 0, 0, 0.3);
        }

        .product-image {
            position: relative;
            width: 100%;
            height: 180px;
            overflow: hidden;
            background: #1a0000;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
            background: #1a0000;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: #dc0000;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .product-badge.featured {
            background: #dc0000;
        }

        .product-info {
            padding: 20px;
        }

        .product-category {
            color: rgba(255, 255, 255, 0.5);
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .product-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: white;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 44px;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-price {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .price-current {
            font-size: 20px;
            font-weight: 700;
            color: #dc0000;
        }

        .price-original {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.3);
            text-decoration: line-through;
        }

        .price-free {
            font-size: 20px;
            font-weight: 700;
            color: #dc0000;
        }

        .product-actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            background: rgba(220, 0, 0, 0.1);
            border: 1px solid rgba(220, 0, 0, 0.3);
            border-radius: 5px;
            color: #dc0000;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            font-size: 14px;
        }

        .action-btn:hover {
            background: #dc0000;
            color: white;
        }

        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: rgba(255, 255, 255, 0.5);
        }

        .no-results h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: rgba(255, 255, 255, 0.7);
        }

        /* FAQ Section - IMPROVED WITH ACCORDION */
        .faq-section {
            padding: 80px 0;
            background: #000000;
        }

        .faq-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .faq-header h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .faq-header p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 15px;
        }

        .faq-list {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(220, 0, 0, 0.2);
            border-radius: 8px;
            margin-bottom: 15px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .faq-item:hover {
            border-color: rgba(220, 0, 0, 0.4);
        }

        .faq-item.active {
            border-color: rgba(220, 0, 0, 0.6);
            background: rgba(220, 0, 0, 0.05);
        }

        .faq-question {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 500;
            font-size: 15px;
            user-select: none;
        }

        .faq-icon {
            color: #dc0000;
            font-size: 20px;
            transition: transform 0.3s ease;
            font-weight: bold;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease, padding 0.4s ease;
            padding: 0 25px;
        }

        .faq-answer.active {
            max-height: 500px;
            padding: 0 25px 20px 25px;
        }

        .faq-answer p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            line-height: 1.8;
            margin: 0;
        }

        /* Footer */
        .footer {
            background: #000000;
            padding: 60px 0 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            margin-top: 80px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 40px;
        }

        .footer-brand p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
            line-height: 1.8;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .social-links {
            display: flex;
            gap: 12px;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            background: #dc0000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .social-btn:hover {
            background: #ff0000;
            transform: translateY(-3px);
        }

        .footer-column h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 12px;
        }

        .footer-column ul li a {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .footer-column ul li a:hover {
            color: #dc0000;
        }

        .footer-contact p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            margin-bottom: 10px;
        }

        .footer-contact a {
            color: #dc0000;
            text-decoration: none;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.3);
            font-size: 13px;
        }

        /* Alert Messages - WARNA MERAH */
        .alert {
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: rgba(220, 0, 0, 0.15);
            color: #ff0000;
            border: 1px solid rgba(220, 0, 0, 0.4);
            box-shadow: 0 4px 15px rgba(220, 0, 0, 0.2);
        }

        .alert-success::before {
            content: '✓';
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: #dc0000;
            color: white;
            border-radius: 50%;
            font-weight: bold;
            font-size: 16px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
                gap: 40px;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 20px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }

            .search-bar {
                flex-direction: column;
            }

            .category-pills {
                overflow-x: auto;
                justify-content: flex-start;
                padding-bottom: 10px;
            }

            .section-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .nav-links {
                display: none;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
@endsection

@section('content')

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('dashboard') }}" class="logo">Go<span>Landing</span></a>
            
            <div class="nav-links">
                <a href="{{ route('dashboard') }}" class="active">Beranda</a>
                <a href="{{ route('products.index') }}">Template</a>
                <a href="#">Tentang</a>
                <a href="#">Kontak</a>
            </div>

            <div class="nav-right">
                <i class="cart-icon">🛒</i>
                
                @auth
                    <!-- Jika user sudah login -->
                    <span class="user-name">{{ Auth::user()->name ?? Auth::user()->email }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="login-btn">Logout</button>
                    </form>
                @else
                    <!-- Jika user belum login -->
                    <a href="{{ route('auth') }}" class="login-btn">Log In</a>
                    <a href="{{ route('auth') }}" class="signup-btn">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="container">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Hero Section -->
    <div class="hero">
        <div class="container">
            <h1>Template situs web untuk desainer,<br>perusahaan, dan penggunaan pribadi</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed accumsan tortor malesuada at sodales ut placerat. Praesent vulputate commodo laoreet.</p>
            
            <!-- Search Form -->
            <form action="{{ route('dashboard') }}" method="GET" id="searchForm">
                <div class="search-bar">
                    <input type="text" 
                           name="search" 
                           id="searchInput" 
                           class="search-input" 
                           placeholder="🔍 Cari template anda"
                           value="{{ request('search') }}">
                    <input type="hidden" name="category" id="categoryInput" value="{{ request('category', 'all') }}">
                    <button type="submit" class="search-btn">Search</button>
                </div>
            </form>

            <!-- Category Pills -->
            <div class="category-pills">
                <span class="pill {{ request('category', 'all') == 'all' ? 'active' : '' }}" 
                      data-category="all" 
                      onclick="filterByCategory('all')">
                    Semua
                </span>
                @foreach($categories as $category)
                    <span class="pill {{ request('category') == $category->name ? 'active' : '' }}" 
                          data-category="{{ $category->name }}" 
                          onclick="filterByCategory('{{ $category->name }}')">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    @if($featuredProducts->count() > 0)
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Lihat Template Situs Web Populer Kami</h2>
                <a href="{{ route('products.index') }}" class="view-all-btn">View All →</a>
            </div>

            <div class="product-grid">
                @foreach($featuredProducts as $product)
                    <a href="{{ route('products.detail', $product->id) }}" class="product-card">
                        <div class="product-image">
                            <img src="{{ $product->image }}" 
                                 alt="{{ $product->name }}"
                                 loading="lazy"
                                 onerror="this.onerror=null; this.src='https://placehold.co/800x500/1a0000/dc0000?text={{ urlencode($product->name) }}';">
                            <div class="product-badge {{ $product->is_new ? 'new' : 'featured' }}">
                                {{ $product->is_new ? 'PREMIUM' : 'FEATURED' }}
                            </div>
                        </div>
                        <div class="product-info">
                            <p class="product-category">{{ $product->category->name }}</p>
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <div class="product-footer">
                                <div class="product-price">
                                    @if($product->discount_price)
                                        <span class="price-current">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                        <span class="price-original">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @elseif($product->price > 0)
                                        <span class="price-current">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="price-free">Free</span>
                                    @endif
                                </div>
                                <div class="product-actions">
                                    <button class="action-btn" onclick="event.preventDefault(); event.stopPropagation();">🛒</button>
                                    <button class="action-btn" onclick="event.preventDefault(); event.stopPropagation();">👁</button>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Latest Products Section -->
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Produk Terbaru Kami</h2>
            <a href="{{ route('products.index') }}" class="view-all-btn">View All →</a>
        </div>

        @if($latestProducts->count() > 0)
            <div class="product-grid">
                @foreach($latestProducts as $product)
                    <a href="{{ route('products.detail', $product->id) }}" class="product-card">
                        <div class="product-image">
                            <img src="{{ $product->image }}" 
                                 alt="{{ $product->name }}"
                                 loading="lazy"
                                 onerror="this.onerror=null; this.src='https://placehold.co/800x500/1a0000/dc0000?text={{ urlencode($product->name) }}';">
                            @if($product->is_new)
                                <div class="product-badge">PREMIUM</div>
                            @endif
                        </div>
                        <div class="product-info">
                            <p class="product-category">{{ $product->category->name }}</p>
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <div class="product-footer">
                                <div class="product-price">
                                    @if($product->discount_price)
                                        <span class="price-current">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                        <span class="price-original">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @elseif($product->price > 0)
                                        <span class="price-current">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="price-free">Free</span>
                                    @endif
                                </div>
                                <div class="product-actions">
                                    <button class="action-btn" onclick="event.preventDefault(); event.stopPropagation();">🛒</button>
                                    <button class="action-btn" onclick="event.preventDefault(); event.stopPropagation();">👁</button>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="no-results">
                <h3>Tidak ada produk ditemukan</h3>
                <p>Coba kata kunci atau kategori lain</p>
            </div>
        @endif
    </div>

    <!-- FAQ Section with Accordion -->
    <div class="faq-section">
        <div class="container">
            <div class="faq-header">
                <h2>Website templates FAQs</h2>
                <p>Find answers to frequently asked questions about website builder templates.</p>
            </div>

            <div class="faq-list">
                <!-- FAQ Item 1 -->
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Apa itu template website?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                    <div class="faq-answer">
                        <p>Template website adalah desain atau tata letak siap pakai yang digunakan sebagai kerangka dasar untuk membangun sebuah situs web. Template ini biasanya sudah mencakup elemen-elemen seperti struktur halaman, tata letak, warna, font, dan fitur desain lainnya, sehingga pengguna tidak perlu membuat semuanya dari nol. Dengan menggunakan template, kamu bisa menghemat waktu dan tenaga karena cukup menyesuaikan konten dan gambar sesuai kebutuhan. Template website cocok digunakan oleh pemula maupun profesional yang ingin membangun website dengan cepat, mudah, dan tetap terlihat profesional.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Apa yang membuat template web itu bagus?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                    <div class="faq-answer">
                        <p>Template web yang bagus memiliki beberapa karakteristik penting: desain yang responsif (menyesuaikan dengan berbagai ukuran layar), loading yang cepat, mudah dikustomisasi, memiliki kode yang bersih dan terstruktur, SEO-friendly untuk membantu website mudah ditemukan di mesin pencari, serta kompatibel dengan berbagai browser. Template yang baik juga menyediakan dokumentasi lengkap dan support yang responsif untuk membantu pengguna dalam proses kustomisasi.</p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Bagaimana cara menggunakan tema website?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                    <div class="faq-answer">
                        <p>Cara menggunakan tema website cukup mudah.
                            Pertama, download file template yang sudah kamu beli atau pilih. Kemudian, ekstrak file zip tersebut dan upload ke hosting atau server kamu. Setelah itu, kamu bisa mulai mengkustomisasi konten seperti teks, gambar, logo, dan warna sesuai dengan brand atau kebutuhan bisnis kamu. Sebagian besar template modern sudah dilengkapi dengan panel admin atau page builder yang memudahkan proses editing tanpa perlu coding.</p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Bisakah saya menambahkan halaman baru ke tema yang dipakai?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                    <div class="faq-answer">
                        <p>Tentu saja! Sebagian besar template website memungkinkan kamu untuk menambahkan halaman baru dengan mudah. Kamu bisa menduplikasi halaman yang sudah ada dan mengubah kontennya, atau membuat halaman dari awal menggunakan page builder yang disediakan. Template yang baik biasanya sudah menyediakan berbagai pilihan layout halaman yang bisa kamu gunakan untuk halaman baru seperti halaman About, Services, Contact, Blog, dan lain-lain.</p>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Apakah saya butuh kemampuan coding untuk menggunakan template?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                    <div class="faq-answer">
                        <p>Tidak, kamu tidak memerlukan kemampuan coding untuk menggunakan sebagian besar template modern. Template kami dirancang agar user-friendly dan mudah dikustomisasi melalui interface visual atau drag-and-drop editor. Namun, jika kamu memiliki pengetahuan dasar HTML, CSS, atau JavaScript, itu akan menjadi nilai tambah untuk melakukan kustomisasi yang lebih advanced dan sesuai dengan kebutuhan spesifik kamu.</p>
                    </div>
                </div>

                <!-- FAQ Item 6 -->
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Bagaimana cara memilih template untuk website saya?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                    <div class="faq-answer">
                        <p>Untuk memilih template yang tepat, pertimbangkan beberapa hal: jenis bisnis atau tujuan website kamu, fitur-fitur yang dibutuhkan (seperti e-commerce, booking system, portfolio gallery), desain yang sesuai dengan brand identity, responsivitas untuk tampilan mobile, kemudahan kustomisasi, dan budget yang tersedia. Lihat juga demo dan review dari pengguna lain untuk memastikan template tersebut berkualitas baik dan mendapat dukungan yang memadai dari developer.</p>
                    </div>
                </div>

                <!-- FAQ Item 7 -->
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Apakah template bisa digunakan untuk semua jenis bisnis?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                    <div class="faq-answer">
                        <p>Ya, template website kami tersedia untuk berbagai jenis bisnis dan industri. Kami menyediakan template khusus untuk e-commerce, portfolio, corporate, restaurant, real estate, blog, startup, dan banyak lagi. Setiap template dirancang dengan mempertimbangkan kebutuhan spesifik industri tersebut, namun tetap fleksibel untuk dikustomisasi sesuai dengan kebutuhan unik bisnis kamu. Kamu juga bisa menggunakan template umum dan menyesuaikannya dengan konten dan branding bisnis kamu.</p>
                    </div>
                </div>

                <!-- FAQ Item 8 -->
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Apakah saya bisa mengubah template sesuai keinginan?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                    <div class="faq-answer">
                        <p>Tentu saja! Semua template kami fully customizable. Kamu bisa mengubah warna, font, layout, gambar, teks, dan hampir semua elemen visual sesuai dengan preferensi dan kebutuhan brand kamu. Untuk pengguna yang lebih advanced, kamu juga bisa memodifikasi kode HTML, CSS, dan JavaScript untuk kustomisasi yang lebih mendalam. Kami juga menyediakan dokumentasi lengkap dan video tutorial untuk membantu kamu dalam proses kustomisasi.</p>
                    </div>
                </div>

                <!-- FAQ Item 9 -->
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <span>Apakah ada jaminan uang kembali?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                    <div class="faq-answer">
                        <p>Ya, kami menyediakan jaminan uang kembali 30 hari untuk semua pembelian template. Jika kamu tidak puas dengan template yang dibeli karena alasan teknis atau tidak sesuai dengan ekspektasi, kamu bisa mengajukan refund dalam waktu 30 hari setelah pembelian. Kami berkomitmen untuk memberikan produk berkualitas tinggi dan kepuasan pelanggan adalah prioritas utama kami. Namun, pastikan untuk membaca syarat dan ketentuan refund policy kami untuk detail lebih lanjut.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="logo">Go<span>Landing</span></div>
                    <p>Jl. Lorem Ipsum No 5, Sit Amet,<br>Kabupaten Consectetur Adipiscing,<br>Edit</p>
                    <div class="social-links">
                        <a href="#" class="social-btn">𝕏</a>
                        <a href="#" class="social-btn">f</a>
                        <a href="#" class="social-btn">in</a>
                        <a href="#" class="social-btn">▶</a>
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Explore</h3>
                    <ul>
                        <li><a href="#">Aplikerenation</a></li>
                        <li><a href="#">Frip Services</a></li>
                        <li><a href="#">Business & Reunion</a></li>
                        <li><a href="#">Creative And Blog</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Departments</h3>
                    <ul>
                        <li><a href="#">Health & Safety</a></li>
                        <li><a href="#">Security by Law</a></li>
                        <li><a href="#">Legal & Finance</a></li>
                        <li><a href="#">Transport & Traffic</a></li>
                        <li><a href="#">Arts & Culture</a></li>
                    </ul>
                </div>

                <div class="footer-column footer-contact">
                    <h3>Contact</h3>
                    <p>J + H, Agen Santo No 1, Fantan,<br>Template On Landing</p>
                    <p><a href="mailto:golanding123@gmail.com">📧 golanding123@gmail.com</a></p>
                    <p>📞 (0766) 51300</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 GoLanding. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        // Toggle FAQ Accordion
        function toggleFAQ(element) {
            const faqItem = element.parentElement;
            const faqAnswer = faqItem.querySelector('.faq-answer');
            const isActive = faqItem.classList.contains('active');
            
            // Close all FAQ items
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
                item.querySelector('.faq-answer').classList.remove('active');
            });
            
            // Open clicked item if it wasn't active
            if (!isActive) {
                faqItem.classList.add('active');
                faqAnswer.classList.add('active');
            }
        }

        // Filter by category
        function filterByCategory(category) {
            // Set category value in hidden input
            document.getElementById('categoryInput').value = category;
            
            // Submit form
            document.getElementById('searchForm').submit();
        }

        // Search on Enter key
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('searchForm').submit();
            }
        });

        // Auto-hide alert after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.querySelector('.alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            }
        });
    </script>

@endsection