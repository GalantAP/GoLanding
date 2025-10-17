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

        .login-btn {
            background: transparent;
            border: none;
            color: white;
            padding: 8px 20px;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.3s;
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
        }

        .signup-btn:hover {
            background: #ff0000;
            transform: translateY(-2px);
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
            justify-content: flex-start;
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

        .product-card.hidden {
            display: none;
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

        .product-image img[src=""] {
            background: linear-gradient(90deg, #1a0000 25%, #2a0000 50%, #1a0000 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
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

        /* FAQ Section */
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

        .faq-question {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 500;
            font-size: 15px;
        }

        .faq-icon {
            color: #dc0000;
            font-size: 18px;
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

    <!-- Hero Section -->
    <div class="hero">
        <div class="container">
            <h1>Template situs web untuk desainer,<br>perusahaan, dan penggunaan pribadi</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed accumsan tortor malesuada at sodales ut placerat. Praesent vulputate commodo laoreet.</p>
            
            <div class="search-bar">
                <input type="text" id="searchInput" class="search-input" placeholder="🔍 Cari template anda">
                <button class="search-btn" onclick="performSearch()">Search</button>
            </div>

            <div class="category-pills">
                <span class="pill" data-category="all" onclick="filterByCategory('all')">Semua</span>
                <span class="pill" data-category="E-Commerce" onclick="filterByCategory('E-Commerce')">E-Commerce</span>
                <span class="pill" data-category="Portofolio" onclick="filterByCategory('Portofolio')">Portofolio</span>
                <span class="pill" data-category="Landing Page" onclick="filterByCategory('Landing Page')">Landing Page</span>
                <span class="pill" data-category="Other" onclick="filterByCategory('Other')">Other</span>
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    @if($featuredProducts->count() > 0)
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Lihat templat situs web Populer kami</h2>
                <a href="#" class="view-all-btn">View All →</a>
            </div>

            <div class="product-grid" id="featuredGrid">
                @foreach($featuredProducts->take(4) as $product)
                    <a href="{{ route('products.detail', $product->id) }}" 
                       class="product-card" 
                       data-name="{{ strtolower($product->name) }}" 
                       data-category="{{ $product->category->name }}">
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
            <div id="featuredNoResults" class="no-results" style="display: none;">
                <h3>Tidak ada produk ditemukan</h3>
                <p>Coba kata kunci atau kategori lain</p>
            </div>
        </div>
    @endif

    <!-- Latest Products Section -->
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Produk Terbaru Kami</h2>
            <a href="#" class="view-all-btn">View All →</a>
        </div>

        <div class="product-grid" id="latestGrid">
            @foreach($featuredProducts as $product)
                <a href="{{ route('products.detail', $product->id) }}" 
                   class="product-card" 
                   data-name="{{ strtolower($product->name) }}" 
                   data-category="{{ $product->category->name }}">
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
        <div id="latestNoResults" class="no-results" style="display: none;">
            <h3>Tidak ada produk ditemukan</h3>
            <p>Coba kata kunci atau kategori lain</p>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="faq-section">
        <div class="container">
            <div class="faq-header">
                <h2>Website templates FAQs</h2>
                <p>Find answers to frequently asked questions about website builder templates.</p>
            </div>

            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apa itu template website?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apa yang membuat template web itu bagus?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Bagaimana cara menggunakan tema website?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Bisakah saya menambahkan halaman baru ke tema yang dipakai?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apakah saya butuh kemampuan coding untuk menggunakan template?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Bagaimana cara memilih template untuk website saya?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apakah template bisa digunakan untuk semua jenis bisnis?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apakah saya bisa mengubah template sesuai keinginan?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Apakah ada jaminan uang kembali?</span>
                        <span class="faq-icon">⌄</span>
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
        // State management
        let currentCategory = 'all';
        let currentSearchTerm = '';

        // Filter by category
        function filterByCategory(category) {
            currentCategory = category;
            
            // Update active pill
            document.querySelectorAll('.pill').forEach(pill => {
                pill.classList.remove('active');
            });
            document.querySelector(.pill[data-category="${category}"]).classList.add('active');
            
            // Apply filters
            applyFilters();
        }

        // Perform search
        function performSearch() {
            const searchInput = document.getElementById('searchInput');
            currentSearchTerm = searchInput.value.toLowerCase().trim();
            applyFilters();
        }

        // Search on Enter key
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        // Apply both search and category filters
        function applyFilters() {
            filterProducts('featuredGrid', 'featuredNoResults');
            filterProducts('latestGrid', 'latestNoResults');
        }

        // Filter products in a specific grid
        function filterProducts(gridId, noResultsId) {
            const grid = document.getElementById(gridId);
            const noResults = document.getElementById(noResultsId);
            const products = grid.querySelectorAll('.product-card');
            let visibleCount = 0;

            products.forEach(product => {
                const productName = product.getAttribute('data-name');
                const productCategory = product.getAttribute('data-category');
                
                // Check category filter
                const categoryMatch = currentCategory === 'all' || productCategory === currentCategory;
                
                // Check search filter
                const searchMatch = currentSearchTerm === '' || productName.includes(currentSearchTerm);
                
                // Show or hide product
                if (categoryMatch && searchMatch) {
                    product.classList.remove('hidden');
                    visibleCount++;
                } else {
                    product.classList.add('hidden');
                }
            });

            // Show/hide no results message
            if (visibleCount === 0) {
                noResults.style.display = 'block';
                grid.style.display = 'none';
            } else {
                noResults.style.display = 'none';
                grid.style.display = 'grid';
            }
        }

        // Reset filters
        function resetFilters() {
            currentCategory = 'all';
            currentSearchTerm = '';
            document.getElementById('searchInput').value = '';
            
            document.querySelectorAll('.pill').forEach(pill => {
                pill.classList.remove('active');
            });
            
            applyFilters();
        }

        // Initialize - set "Semua" as active by default
        document.addEventListener('DOMContentLoaded', function() {
            const allPill = document.querySelector('.pill[data-category="all"]');
            if (allPill) {
                allPill.classList.add('active');
            }
        });
    </script>

@endsection