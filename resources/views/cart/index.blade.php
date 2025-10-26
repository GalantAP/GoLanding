@extends('layouts.app')

@section('title', 'Keranjang Belanja - GoLanding')

@section('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #000000;
            color: #fff;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }

        /* Navbar - SAMA DENGAN DASHBOARD */
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
            cursor: pointer;
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
            position: relative;
            text-decoration: none;
            display: inline-block;
        }

        .cart-icon:hover {
            transform: scale(1.1);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background: #dc0000;
            color: white;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
            line-height: 1.2;
            box-shadow: 0 2px 5px rgba(220, 0, 0, 0.3);
        }

        .cart-badge:empty {
            display: none;
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

        /* Cart Page */
        .cart-page {
            padding: 40px 0 80px;
            background: linear-gradient(180deg, #1a0000 0%, #000000 100%);
            min-height: calc(100vh - 200px);
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .cart-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        /* Cart Actions */
        .cart-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .continue-btn {
            background: transparent;
            border: 2px solid #dc0000;
            color: #dc0000;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .continue-btn:hover {
            background: #dc0000;
            color: white;
            transform: translateY(-2px);
        }

        .delete-selected-btn {
            background: #dc0000;
            border: none;
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .delete-selected-btn:hover {
            background: #ff0000;
            transform: translateY(-2px);
        }

        /* Cart Items */
        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .cart-item {
            background: rgba(26, 0, 0, 0.5);
            border: 2px solid rgba(220, 0, 0, 0.3);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            gap: 20px;
            align-items: center;
            transition: all 0.3s;
        }

        .cart-item:hover {
            border-color: rgba(220, 0, 0, 0.6);
            background: rgba(26, 0, 0, 0.8);
        }

        .cart-item.selected {
            border-color: #dc0000;
            background: rgba(220, 0, 0, 0.1);
        }

        .item-checkbox {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #dc0000;
        }

        .item-image {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            background: #1a0000;
        }

        .item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .item-title {
            font-size: 16px;
            font-weight: 600;
            color: white;
            margin-bottom: 5px;
        }

        .item-category {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
        }

        .item-price {
            font-size: 18px;
            font-weight: 700;
            color: #dc0000;
            margin-top: 5px;
        }

        .item-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(220, 0, 0, 0.1);
            border: 1px solid rgba(220, 0, 0, 0.3);
            border-radius: 6px;
            padding: 5px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            background: transparent;
            border: 1px solid rgba(220, 0, 0, 0.5);
            border-radius: 4px;
            color: #dc0000;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .qty-btn:hover {
            background: #dc0000;
            color: white;
        }

        .qty-input {
            width: 50px;
            text-align: center;
            background: transparent;
            border: none;
            color: white;
            font-size: 14px;
            font-weight: 600;
        }

        .delete-btn {
            width: 40px;
            height: 40px;
            background: rgba(220, 0, 0, 0.1);
            border: 1px solid rgba(220, 0, 0, 0.3);
            border-radius: 6px;
            color: #dc0000;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .delete-btn:hover {
            background: #dc0000;
            color: white;
        }

        /* Cart Summary */
        .cart-summary {
            background: rgba(26, 0, 0, 0.5);
            border: 2px solid rgba(220, 0, 0, 0.3);
            border-radius: 12px;
            padding: 30px;
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 25px;
            color: white;
        }

        .summary-total {
            font-size: 32px;
            font-weight: 700;
            color: #dc0000;
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: rgba(220, 0, 0, 0.05);
            border-radius: 8px;
        }

        .checkout-btn {
            width: 100%;
            background: #dc0000;
            border: none;
            color: white;
            padding: 16px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .checkout-btn:hover {
            background: #ff0000;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(220, 0, 0, 0.4);
        }

        .empty-cart {
            text-align: center;
            padding: 80px 20px;
            color: rgba(255, 255, 255, 0.5);
            grid-column: 1 / -1;
        }

        .empty-cart-icon {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-cart h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: rgba(255, 255, 255, 0.7);
        }

        .empty-cart p {
            margin-bottom: 30px;
        }

        /* Alert Messages */
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

        /* Footer */
        .footer {
            background: #000000;
            padding: 60px 0 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
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

        /* Responsive */
        @media (max-width: 1024px) {
            .cart-layout {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
            }

            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 20px;
            }

            .nav-links {
                display: none;
            }

            .cart-item {
                flex-direction: column;
                text-align: center;
            }

            .item-actions {
                width: 100%;
                justify-content: center;
            }

            .cart-actions {
                flex-direction: column;
                gap: 15px;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Navbar - SAMA DENGAN DASHBOARD -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('dashboard') }}" class="logo">Go<span>Landing</span></a>
            
            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Beranda</a>
                <a href="{{ route('products.index') }}">Template</a>
                <a href="{{ route('dashboard') }}#faq-section">Tentang</a>
                <a href="{{ route('dashboard') }}#footer-section">Kontak</a>
            </div>

            <div class="nav-right">
                <a href="{{ route('cart') }}" class="cart-icon">
                    🛒
                    @if(isset($cartCount) && $cartCount > 0)
                        <span class="cart-badge">{{ $cartCount }}</span>
                    @endif
                </a>
                
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

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="container">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Cart Page -->
    <div class="cart-page">
        <div class="container">
            <h1 class="page-title">Keranjang Belanja</h1>

            @if(count($cart) > 0)
                <div class="cart-actions">
                    <a href="{{ route('products.index') }}" class="continue-btn">Lanjutkan Belanja</a>
                    <form action="{{ route('cart.clear') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="delete-selected-btn" onclick="return confirm('Hapus semua produk dari keranjang?')">
                            Hapus Semua 🗑
                        </button>
                    </form>
                </div>

                <div class="cart-layout">
                    <!-- Cart Items -->
                    <div class="cart-items">
                        @foreach($cart as $id => $item)
                            <div class="cart-item" data-price="{{ $item['price'] }}" data-id="{{ $id }}">
                                <img src="{{ $item['image'] }}" 
                                     alt="{{ $item['name'] }}" 
                                     class="item-image"
                                     onerror="this.onerror=null; this.src='https://placehold.co/100x100/1a0000/dc0000?text=Product';">
                                <div class="item-details">
                                    <h3 class="item-title">{{ $item['name'] }}</h3>
                                    <div class="item-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                                </div>
                                <div class="item-actions">
                                    <div class="quantity-control">
                                        <form action="{{ route('cart.update', $id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}">
                                            <button type="submit" class="qty-btn" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>-</button>
                                        </form>
                                        <input type="text" class="qty-input" value="{{ $item['quantity'] }}" readonly>
                                        <form action="{{ route('cart.update', $id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                            <button type="submit" class="qty-btn">+</button>
                                        </form>
                                    </div>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn" onclick="return confirm('Hapus produk ini dari keranjang?')">🗑</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Cart Summary -->
                    <div class="cart-summary">
                        <h2 class="summary-title">Ringkasan Belanja</h2>
                        <div class="summary-total">Rp {{ number_format($total, 0, ',', '.') }}</div>
                        <button class="checkout-btn" onclick="checkout()">Checkout</button>
                    </div>
                </div>
            @else
                <div class="cart-layout">
                    <div class="empty-cart">
                        <div class="empty-cart-icon">🛒</div>
                        <h3>Keranjang Belanja Kosong</h3>
                        <p>Belum ada produk yang ditambahkan</p>
                        <a href="{{ route('products.index') }}" class="continue-btn">Mulai Belanja</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <div class="footer" id="footer-section">
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
        function checkout() {
            const total = document.querySelector('.summary-total').textContent;
            alert(`Checkout\nTotal: ${total}\n\nFitur checkout akan segera tersedia!`);
        }

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