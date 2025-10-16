<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GoLanding - Premium Website Templates">
    <meta name="author" content="GoLanding Team">
    
    <title>@yield('title', 'GoLanding - Premium Website Templates')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Inline Styles (if any) -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0a;
            color: #ffffff;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #dc0000, #8b0000);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ff0000, #dc0000);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(220, 0, 0, 0.4);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid #dc0000;
            color: #dc0000;
        }

        .btn-secondary:hover {
            background: #dc0000;
            color: white;
        }

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
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #dc0000;
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
        }

    </style>

    @yield('styles') <!-- Custom styles from child views -->
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                GoLanding
            </div>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('product.detail', ['slug' => 'sample-product']) }}">Product</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </div>
            <div class="user-info">
                <div class="user-avatar">
                    @if(Auth::check())
                        {{ substr(Auth::user()->name, 0, 1) }}
                    @else
                        G
                    @endif
                </div>
                <span>
                    @if(Auth::check())
                        {{ Auth::user()->name }}
                    @else
                        Guest
                    @endif
                </span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 GoLanding. All rights reserved.</p>
        </div>
    </footer>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    @yield('scripts') <!-- Custom scripts from child views -->

</body>

</html>
