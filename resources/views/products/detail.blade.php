@extends('layouts.app')

@section('title', $product->name . ' - GoLanding')

@section('styles')
<style>
    /* Navbar */
    .navbar {
        background: rgba(10, 10, 10, 0.95);
        backdrop-filter: blur(10px);
        padding: 15px 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        border-bottom: 1px solid rgba(220, 0, 0, 0.2);
    }

    .navbar .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 28px;
        font-weight: 800;
        background: linear-gradient(135deg, #dc0000, #ff4444);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-decoration: none;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: linear-gradient(135deg, #dc0000, #8b0000);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
    }

    .back-btn {
        background: none;
        border: 1px solid rgba(220, 0, 0, 0.3);
        color: #dc0000;
        padding: 8px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .back-btn:hover {
        background: #dc0000;
        color: white;
    }

    /* Product Detail */
    .product-detail {
        padding: 60px 0;
        background: #0a0a0a;
    }

    .breadcrumb {
        display: flex;
        gap: 10px;
        margin-bottom: 40px;
        font-size: 14px;
        color: #666;
        align-items: center;
    }

    .breadcrumb a {
        color: #dc0000;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .product-main {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        margin-bottom: 80px;
    }

    .product-image-section {
        position: relative;
    }

    .main-image {
        width: 100%;
        height: 500px;
        background: rgba(20, 20, 20, 0.8);
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid rgba(220, 0, 0, 0.2);
    }

    .main-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #dc0000, #8b0000);
        color: white;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        z-index: 10;
    }

    .product-info-section {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .product-category-tag {
        display: inline-block;
        background: rgba(220, 0, 0, 0.1);
        color: #dc0000;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        width: fit-content;
    }

    .product-name {
        font-size: 42px;
        font-weight: 800;
        line-height: 1.2;
        color: white;
    }

    .product-desc {
        color: #aaa;
        font-size: 16px;
        line-height: 1.8;
    }

    .price-section {
        background: rgba(20, 20, 20, 0.6);
        padding: 30px;
        border-radius: 12px;
        border: 1px solid rgba(220, 0, 0, 0.2);
    }

    .price-row {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 15px;
    }

    .current-price {
        font-size: 36px;
        font-weight: 800;
        color: #dc0000;
    }

    .original-price {
        font-size: 20px;
        color: #666;
        text-decoration: line-through;
    }

    .save-badge {
        background: rgba(220, 0, 0, 0.2);
        color: #ff4444;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .price-note {
        color: #888;
        font-size: 13px;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .btn-buy {
        flex: 1;
        padding: 16px;
        font-size: 16px;
        font-weight: 600;
    }

    .btn-preview {
        padding: 16px 30px;
        font-size: 16px;
        font-weight: 600;
    }

    .features-list {
        background: rgba(20, 20, 20, 0.4);
        padding: 25px;
        border-radius: 12px;
        border: 1px solid rgba(220, 0, 0, 0.1);
    }

    .features-list h3 {
        font-size: 18px;
        margin-bottom: 20px;
        color: white;
    }

    .features-list ul {
        list-style: none;
        display: grid;
        gap: 12px;
    }

    .features-list li {
        color: #aaa;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .features-list li::before {
        content: '✓';
        color: #dc0000;
        font-weight: bold;
        font-size: 16px;
    }

    /* Tabs */
    .product-tabs {
        margin-top: 60px;
    }

    .tab-buttons {
        display: flex;
        gap: 20px;
        border-bottom: 1px solid rgba(220, 0, 0, 0.2);
        margin-bottom: 40px;
    }

    .tab-btn {
        background: none;
        border: none;
        color: #666;
        padding: 15px 25px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        border-bottom: 3px solid transparent;
    }

    .tab-btn.active {
        color: #dc0000;
        border-bottom-color: #dc0000;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .description-content {
        color: #aaa;
        font-size: 16px;
        line-height: 1.8;
        max-width: 800px;
    }

    .description-content h3 {
        color: white;
        margin-top: 30px;
        margin-bottom: 15px;
        font-size: 24px;
    }

    .description-content p {
        margin-bottom: 20px;
    }

    .description-content ul {
        margin: 15px 0;
        padding-left: 20px;
    }

    .description-content li {
        margin-bottom: 10px;
    }

    /* Related Products */
    .related-section {
        margin-top: 80px;
        padding-top: 60px;
        border-top: 1px solid rgba(220, 0, 0, 0.2);
    }

    .section-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 40px;
        text-align: center;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 30px;
    }

    .product-card {
        background: rgba(20, 20, 20, 0.8);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s;
        border: 1px solid rgba(220, 0, 0, 0.1);
        text-decoration: none;
        display: block;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(220, 0, 0, 0.2);
        border-color: rgba(220, 0, 0, 0.4);
    }

    .product-image {
        position: relative;
        width: 100%;
        height: 180px;
        overflow: hidden;
        background: #1a1a1a;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .product-card:hover .product-image img {
        transform: scale(1.1);
    }

    .product-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: linear-gradient(135deg, #dc0000, #8b0000);
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .product-info {
        padding: 20px;
    }

    .product-category {
        color: #dc0000;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .product-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        color: white;
    }

    .product-price {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(220, 0, 0, 0.1);
    }

    .price-current {
        font-size: 18px;
        font-weight: 700;
        color: #dc0000;
    }

    .price-original {
        font-size: 13px;
        color: #666;
        text-decoration: line-through;
    }

    /* Footer */
    .footer {
        background: #0f0f0f;
        padding: 40px 0;
        text-align: center;
        border-top: 1px solid rgba(220, 0, 0, 0.2);
        margin-top: 60px;
    }

    .footer p {
        color: #666;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .product-main {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .product-name {
            font-size: 28px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }
</style>
@endsection

@section('content')

    <div class="hero">
        <div class="hero-content">
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->description }}</p>
        </div>
    </div>

    <div class="product-detail">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">Dashboard</a> /
            <a href="{{ route('product.detail', $product->slug) }}">{{ $product->category->name }}</a> /
            <span>{{ $product->name }}</span>
        </div>

        <div class="product-main">
            <div class="product-image-section">
                <div class="main-image">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}">
                </div>
            </div>

            <div class="product-info-section">
                <span class="product-category-tag">{{ $product->category->name }}</span>
                <h2 class="product-name">{{ $product->name }}</h2>
                <p class="product-desc">{{ $product->description }}</p>

                <div class="price-section">
                    <div class="price-row">
                        <span class="current-price">
                            @if($product->discount_price)
                                Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                                <span class="original-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @else
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            @endif
                        </span>
                    </div>
                    @if($product->discount_percentage > 0)
                        <span class="save-badge">Hemat {{ $product->discount_percentage }}%</span>
                    @endif
                    <p class="price-note">* Harga sudah termasuk lisensi penggunaan komersial</p>
                </div>

                <div class="action-buttons">
                    <a href="#" class="btn-buy">🛒 Beli Sekarang</a>
                    @if($product->preview_url)
                        <a href="{{ $product->preview_url }}" class="btn-preview" target="_blank">👁️ Preview</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="features-list">
            <h3>Yang Anda Dapatkan:</h3>
            <ul>
                <li>Full Source Code (HTML, CSS, JavaScript)</li>
                <li>Responsive Design untuk semua perangkat</li>
                <li>Dokumentasi lengkap instalasi</li>
                <li>Lisensi penggunaan komersial</li>
                <li>Support 30 hari</li>
                <li>Update gratis selamanya</li>
            </ul>
        </div>

        <div class="product-tabs">
            <div class="tab-buttons">
                <button class="tab-btn active" onclick="openTab(event, 'description')">Deskripsi</button>
                <button class="tab-btn" onclick="openTab(event, 'features')">Fitur Lengkap</button>
                <button class="tab-btn" onclick="openTab(event, 'support')">Support & FAQ</button>
            </div>

            <div id="description" class="tab-content active">
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

            <div id="features" class="tab-content">
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

            <div id="support" class="tab-content">
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

                <p><strong>Q: Apakah
