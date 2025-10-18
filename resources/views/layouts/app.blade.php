<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GoLanding - Premium Website Templates">
    <meta name="author" content="GoLanding Team">
    
    <title>@yield('title', 'GoLanding - Premium Website Templates')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Base Styles -->
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
            color: #ffffff;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Utility Classes */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .btn-primary {
            background: #dc0000;
            color: white;
        }

        .btn-primary:hover {
            background: #ff0000;
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

        /* Hide scrollbar but keep functionality */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0a0a0a;
        }

        ::-webkit-scrollbar-thumb {
            background: #dc0000;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #ff0000;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 20px;
            }
        }
    </style>

    @yield('styles') <!-- Custom styles from child views -->
</head>

<body>
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    @yield('scripts') <!-- Custom scripts from child views -->

</body>

</html>