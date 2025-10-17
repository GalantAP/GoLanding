@extends('layouts.app')

@section('title', $product->name . ' - GoLanding')

@section('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #000000;
        color: #fff;
        font-family: 'Inter', sans-serif;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 40px;
    }

    /* Product Detail Container */
    .product-detail-wrapper {
        background: #000000;
        padding: 40px 0 80px;
    }

    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        gap: 8px;
        margin-bottom: 30px;
        font-size: 13px;
        color: #666;
        align-items: center;
    }

    .breadcrumb a {
        color: #dc0000;
        text-decoration: none;
        transition: color 0.3s;
    }

    .breadcrumb a:hover {
        color: #ff0000;
    }

    .breadcrumb span {
        color: #999;
    }

    /* Main Product Layout */
    .product-layout {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 40px;
        margin-bottom: 60px;
    }

    /* Left Column - Image & Details */
    .product-left {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .product-main-image {
        width: 100%;
        height: auto;
        background: #0a0a0a;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .product-main-image img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    /* Product Info Below Image */
    .product-main-info {
        background: #0a0a0a;
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        padding: 30px;
    }

    .product-title-section {
        margin-bottom: 25px;
    }

    .product-title-main {
        font-size: 32px;
        font-weight: 700;
        color: white;
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .product-description-text {
        color: #999;
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    /* Tabs */
    .product-tabs {
        margin-top: 30px;
    }

    .tab-navigation {
        display: flex;
        gap: 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 25px;
    }

    .tab-button {
        background: none;
        border: none;
        color: #666;
        padding: 12px 20px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        border-bottom: 2px solid transparent;
        position: relative;
    }

    .tab-button.active {
        color: #dc0000;
        border-bottom-color: #dc0000;
    }

    .tab-button:hover {
        color: #dc0000;
    }

    .tab-panel {
        display: none;
    }

    .tab-panel.active {
        display: block;
    }

    .tab-content-text {
        color: #999;
        font-size: 14px;
        line-height: 1.8;
    }

    .tab-content-text h3 {
        color: white;
        font-size: 18px;
        margin-top: 25px;
        margin-bottom: 12px;
    }

    .tab-content-text p {
        margin-bottom: 15px;
    }

    .tab-content-text ul {
        list-style: none;
        margin: 15px 0;
        padding-left: 0;
    }

    .tab-content-text ul li {
        margin-bottom: 10px;
        padding-left: 20px;
        position: relative;
    }

    .tab-content-text ul li::before {
        content: '•';
        color: #dc0000;
        font-weight: bold;
        position: absolute;
        left: 0;
    }

    /* Right Sidebar */
    .product-sidebar {
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .sidebar-card {
        background: #0a0a0a;
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        padding: 25px;
        margin-bottom: 20px;
    }

    .sidebar-card h3 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 20px;
        color: white;
    }

    /* Price Section */
    .price-display {
        margin-bottom: 20px;
    }

    .current-price {
        font-size: 36px;
        font-weight: 800;
        color: #dc0000;
        display: block;
        margin-bottom: 8px;
    }

    .original-price {
        font-size: 18px;
        color: #666;
        text-decoration: line-through;
        margin-left: 10px;
    }

    .discount-badge {
        display: inline-block;
        background: rgba(220, 0, 0, 0.15);
        color: #ff4444;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 10px;
    }

    .price-note {
        color: #666;
        font-size: 12px;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 20px;
    }

    .btn-primary {
        background: #dc0000;
        color: white;
        padding: 14px 24px;
        border: none;
        border-radius: 6px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        text-decoration: none;
        display: block;
    }

    .btn-primary:hover {
        background: #ff0000;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 0, 0, 0.4);
    }

    .btn-secondary {
        background: transparent;
        color: #dc0000;
        padding: 14px 24px;
        border: 1.5px solid #dc0000;
        border-radius: 6px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        text-decoration: none;
        display: block;
    }

    .btn-secondary:hover {
        background: #dc0000;
        color: white;
    }

    /* Related Topics */
    .related-topics {
        margin-top: 20px;
    }

    .related-topics h4 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 15px;
        color: white;
    }

    .topic-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .topic-tag {
        background: rgba(220, 0, 0, 0.1);
        color: #dc0000;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s;
        border: 1px solid rgba(220, 0, 0, 0.2);
    }

    .topic-tag:hover {
        background: #dc0000;
        color: white;
        border-color: #dc0000;
    }

    /* Author/Support Info */
    .author-info {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        font-size: 13px;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #666;
    }

    .info-value {
        color: white;
        font-weight: 500;
    }

    .info-value a {
        color: #dc0000;
        text-decoration: none;
    }

    .info-value a:hover {
        text-decoration: underline;
    }

    /* Related Products Section */
    .related-products-section {
        margin-top: 80px;
        padding-top: 60px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: white;
    }

    .view-all-link {
        color: #dc0000;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: color 0.3s;
    }

    .view-all-link:hover {
        color: #ff0000;
    }

    /* Product Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }

    .product-card {
        background: #0a0a0a;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s;
        border: 1px solid rgba(255, 255, 255, 0.05);
        text-decoration: none;
        display: block;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(220, 0, 0, 0.3);
        border-color: rgba(220, 0, 0, 0.3);
    }

    .product-card-image {
        position: relative;
        width: 100%;
        height: 180px;
        overflow: hidden;
        background: #1a0000;
    }

    .product-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .product-card:hover .product-card-image img {
        transform: scale(1.1);
    }

    .product-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #dc0000;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .product-card-content {
        padding: 18px;
    }

    .product-category {
        color: #dc0000;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .product-card-title {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 12px;
        color: white;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 12px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .product-price {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .price-current {
        font-size: 18px;
        font-weight: 700;
        color: #dc0000;
    }

    .price-original {
        font-size: 12px;
        color: #666;
        text-decoration: line-through;
    }

    .product-actions {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        width: 32px;
        height: 32px;
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

    /* Responsive */
    @media (max-width: 1024px) {
        .product-layout {
            grid-template-columns: 1fr;
        }

        .product-sidebar {
            position: static;
        }

        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }

        .product-title-main {
            font-size: 24px;
        }

        .product-grid {
            grid-template-columns: 1fr;
        }

        .current-price {
            font-size: 28px;
        }
    }
</style>
@endsection

@section('content')
<div class="product-detail-wrapper">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <span>/</span>
            <a href="#">{{ $product->category->name }}</a>
            <span>/</span>
            <span>{{ $product->name }}</span>
        </div>

        <!-- Main Product Layout -->
        <div class="product-layout">
            <!-- Left Column -->
            <div class="product-left">
                <!-- Main Image -->
                <div class="product-main-image">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}">
                </div>

                <!-- Product Info & Tabs -->
                <div class="product-main-info">
                    <div class="product-title-section">
                        <h1 class="product-title-main">{{ $product->name }}</h1>
                        <p class="product-description-text">{{ $product->description }}</p>
                    </div>

                    <!-- Tabs -->
                    <div class="product-tabs">
                        <div class="tab-navigation">
                            <button class="tab-button active" onclick="switchTab(event, 'overview')">Overview</button>
                            <button class="tab-button" onclick="switchTab(event, 'features')">Features</button>
                            <button class="tab-button" onclick="switchTab(event, 'support')">Support</button>
                        </div>

                        <div id="overview" class="tab-panel active">
                            <div class="tab-content-text">
                                <h3>Tentang Template Ini</h3>
                                <p>{{ $product->description }}</p>
                                
                                <h3>Kenapa Memilih Template Ini?</h3>
                                <p>Template ini dirancang dengan teknologi terkini dan mengikuti best practice dalam web development. Cocok untuk berbagai jenis bisnis dan mudah dikustomisasi sesuai kebutuhan Anda.</p>
                                
                                <ul>
                                    <li>Desain modern dan profesional</li>
                                    <li>Clean code dan well-documented</li>
                                    <li>SEO friendly structure</li>
                                    <li>Fast loading performance</li>
                                    <li>Cross-browser compatible</li>
                                </ul>
                            </div>
                        </div>

                        <div id="features" class="tab-panel">
                            <div class="tab-content-text">
                                <h3>Fitur Teknis</h3>
                                <ul>
                                    <li>HTML5 & CSS3 terbaru</li>
                                    <li>JavaScript ES6+</li>
                                    <li>Bootstrap 5 / Tailwind CSS</li>
                                    <li>Animasi smooth dengan CSS/JS</li>
                                    <li>Form validation</li>
                                    <li>Image optimization</li>
                                    <li>Icon library included</li>
                                </ul>
                                
                                <h3>Halaman Termasuk</h3>
                                <ul>
                                    <li>Homepage / Landing Page</li>
                                    <li>About Us / Company Profile</li>
                                    <li>Services / Product Pages</li>
                                    <li>Portfolio / Gallery</li>
                                    <li>Contact Us dengan form</li>
                                    <li>Blog / News (optional)</li>
                                </ul>
                            </div>
                        </div>

                        <div id="support" class="tab-panel">
                            <div class="tab-content-text">
                                <h3>Support yang Kami Berikan</h3>
                                <p>Kami menyediakan support penuh untuk memastikan Anda dapat menggunakan template dengan maksimal:</p>
                                <ul>
                                    <li>Email support 24/7</li>
                                    <li>Dokumentasi lengkap instalasi dan kustomisasi</li>
                                    <li>Video tutorial (untuk beberapa template)</li>
                                    <li>Bantuan troubleshooting</li>
                                    <li>Update gratis untuk bug fixes dan improvements</li>
                                </ul>

                                <h3>FAQ</h3>
                                <p><strong>Q: Apakah saya butuh coding skill?</strong></p>
                                <p>A: Basic HTML/CSS knowledge akan sangat membantu, tapi kami menyediakan dokumentasi lengkap untuk pemula.</p>

                                <p><strong>Q: Apakah bisa refund?</strong></p>
                                <p>A: Ya, kami menyediakan 30 hari money back guarantee jika template tidak sesuai ekspektasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="product-sidebar">
                <!-- Purchase Card -->
                <div class="sidebar-card">
                    <div class="price-display">
                        @if($product->discount_price)
                            <span class="current-price">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                            <span class="original-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @if($product->discount_percentage > 0)
                                <span class="discount-badge">Hemat {{ $product->discount_percentage }}%</span>
                            @endif
                        @else
                            <span class="current-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @endif
                    </div>

                    <div class="action-buttons">
                        <a href="#" class="btn-primary">🛒 Add to cart</a>
                        @if($product->preview_url)
                            <a href="{{ $product->preview_url }}" class="btn-secondary" target="_blank">👁️ Live Preview</a>
                        @endif
                    </div>

                    <p class="price-note">* Harga sudah termasuk lisensi penggunaan komersial</p>
                </div>

                <!-- Product Info -->
                <div class="sidebar-card">
                    <h3>Product Features</h3>
                    <div class="author-info">
                        <div class="info-row">
                            <span class="info-label">Compatible Browsers</span>
                            <span class="info-value">All Modern</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Files Included</span>
                            <span class="info-value">HTML, CSS, JS</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Layout</span>
                            <span class="info-value">Responsive</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Documentation</span>
                            <span class="info-value">Well Documented</span>
                        </div>
                    </div>
                </div>

                <!-- Tags -->
                <div class="sidebar-card">
                    <h3>Tags</h3>
                    <div class="related-topics">
                        <div class="topic-tags">
                            <a href="#" class="topic-tag">{{ $product->category->name }}</a>
                            <a href="#" class="topic-tag">Landing Page</a>
                            <a href="#" class="topic-tag">Responsive</a>
                            <a href="#" class="topic-tag">Modern</a>
                            <a href="#" class="topic-tag">Premium</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="related-products-section">
            <div class="section-header">
                <h2 class="section-title">Produk Serupa</h2>
                <a href="#" class="view-all-link">View All →</a>
            </div>

            <div class="product-grid">
                @for($i = 0; $i < 4; $i++)
                    <a href="#" class="product-card">
                        <div class="product-card-image">
                            <img src="{{ $product->image }}" alt="Related Product">
                            <div class="product-badge">PREMIUM</div>
                        </div>
                        <div class="product-card-content">
                            <p class="product-category">{{ $product->category->name }}</p>
                            <h3 class="product-card-title">Premium Template {{ $i + 1 }}</h3>
                            <div class="product-card-footer">
                                <div class="product-price">
                                    <span class="price-current">Rp 250.000</span>
                                    <span class="price-original">Rp 500.000</span>
                                </div>
                                <div class="product-actions">
                                    <button class="action-btn" onclick="event.preventDefault();">🛒</button>
                                    <button class="action-btn" onclick="event.preventDefault();">👁</button>
                                </div>
                            </div>
                        </div>
                    </a>
                @endfor
            </div>
        </div>
    </div>
</div>

<script>
function switchTab(event, tabId) {
    // Hide all tab panels
    const tabPanels = document.querySelectorAll('.tab-panel');
    tabPanels.forEach(panel => {
        panel.classList.remove('active');
    });

    // Remove active class from all buttons
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.classList.remove('active');
    });

    // Show selected tab panel
    document.getElementById(tabId).classList.add('active');
    
    // Add active class to clicked button
    event.currentTarget.classList.add('active');
}
</script>
@endsection