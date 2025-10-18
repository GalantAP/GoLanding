@extends('layouts.app')

@section('title', 'All Products - GoLanding')

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

        /* Page Header */
        .page-header {
            background: linear-gradient(180deg, #1a0000 0%, #000000 100%);
            padding: 80px 0 60px;
            text-align: center;
        }

        .page-header h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .page-header p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.6);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Search & Filter Section */
        .filter-section {
            padding: 40px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .search-bar {
            display: flex;
            gap: 10px;
            max-width: 700px;
            margin: 0 auto 30px;
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

        /* Products Section */
        .products-section {
            padding: 60px 0 80px;
        }

        .section-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .product-count {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.7);
        }

        .product-count strong {
            color: #dc0000;
            font-weight: 700;
        }

        .sort-filter {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .sort-filter label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
        }

        .sort-filter select {
            padding: 8px 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }

        .sort-filter select:focus {
            outline: none;
            border-color: #dc0000;
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

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 40px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: #dc0000;
            border-color: #dc0000;
        }

        .pagination .active {
            background: #dc0000;
            border-color: #dc0000;
        }

        .pagination .disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 80px 20px;
            color: rgba(255, 255, 255, 0.5);
        }

        .no-results h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: rgba(255, 255, 255, 0.7);
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

            .page-header h1 {
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

            .section-info {
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
                <a href="{{ route('dashboard') }}">Beranda</a>
                <a href="{{ route('products.index') }}" class="active">Template</a>
                <a href="#">Tentang</a>
                <a href="#">Kontak</a>
            </div>

            <div class="nav-right">
                <i class="cart-icon">🛒</i>
                
                @auth
                    <span class="user-name">{{ Auth::user()->name ?? Auth::user()->email }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="login-btn">Logout</button>
                    </form>
                @else
                    <a href="{{ route('auth') }}" class="login-btn">Log In</a>
                    <a href="{{ route('auth') }}" class="signup-btn">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Semua Template Website</h1>
            <p>Jelajahi koleksi lengkap template website premium kami untuk berbagai kebutuhan bisnis Anda</p>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="filter-section">
        <div class="container">
            <!-- Search Form -->
            <form action="{{ route('products.index') }}" method="GET" id="searchForm">
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

    <!-- Products Section -->
    <div class="products-section">
        <div class="container">
            <div class="section-info">
                <div class="product-count">
                    Menampilkan <strong>{{ $products->count() }}</strong> dari <strong>{{ $products->total() }}</strong> produk
                </div>
            </div>

            @if($products->count() > 0)
                <div class="product-grid">
                    @foreach($products as $product)
                        <a href="{{ route('products.detail', $product->id) }}" class="product-card">
                            <div class="product-image">
                                <img src="{{ $product->image }}" 
                                     alt="{{ $product->name }}"
                                     loading="lazy"
                                     onerror="this.onerror=null; this.src='https://placehold.co/800x500/1a0000/dc0000?text={{ urlencode($product->name) }}';">
                                @if($product->is_featured || $product->is_new)
                                    <div class="product-badge {{ $product->is_featured ? 'featured' : '' }}">
                                        {{ $product->is_new ? 'PREMIUM' : 'FEATURED' }}
                                    </div>
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

                <!-- Pagination -->
                <div class="pagination">
                    @if ($products->onFirstPage())
                        <span class="disabled">← Previous</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}&search={{ request('search') }}&category={{ request('category', 'all') }}">← Previous</a>
                    @endif

                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <span class="active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}&search={{ request('search') }}&category={{ request('category', 'all') }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}&search={{ request('search') }}&category={{ request('category', 'all') }}">Next →</a>
                    @else
                        <span class="disabled">Next →</span>
                    @endif
                </div>
            @else
                <div class="no-results">
                    <h3>Tidak ada produk ditemukan</h3>
                    <p>Coba kata kunci atau kategori lain</p>
                </div>
            @endif
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
        // Filter by category
        function filterByCategory(category) {
            document.getElementById('categoryInput').value = category;
            document.getElementById('searchForm').submit();
        }

        // Search on Enter key
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('searchForm').submit();
            }
        });
    </script>

@endsection