@extends('layouts.app')

@section('title', 'Login - GoLanding')

@section('styles')
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a0000 100%);
            position: relative;
            overflow: hidden;
        }

        .login-container::before,
        .login-container::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            animation: pulse 4s ease-in-out infinite;
        }

        .login-container::before {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(220, 0, 0, 0.1) 0%, transparent 70%);
            top: -200px;
            right: -200px;
        }

        .login-container::after {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(220, 0, 0, 0.08) 0%, transparent 70%);
            bottom: -150px;
            left: -150px;
            animation-duration: 6s;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.2); opacity: 0.8; }
        }

        .login-box {
            background: rgba(20, 20, 20, 0.9);
            backdrop-filter: blur(20px);
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(220, 0, 0, 0.2);
            position: relative;
            z-index: 1;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-logo {
            font-size: 36px;
            font-weight: 800;
            background: linear-gradient(135deg, #dc0000, #ff4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .login-subtitle {
            color: #888;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #ccc;
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            background: rgba(30, 30, 30, 0.8);
            border: 1px solid rgba(220, 0, 0, 0.2);
            border-radius: 8px;
            color: white;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #dc0000;
            box-shadow: 0 0 0 3px rgba(220, 0, 0, 0.1);
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
        }

        .form-check input {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .form-check label {
            color: #ccc;
            font-size: 14px;
            cursor: pointer;
            margin: 0;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            margin-top: 10px;
        }

        .error-message {
            background: rgba(220, 0, 0, 0.1);
            border: 1px solid rgba(220, 0, 0, 0.3);
            color: #ff6666;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            color: #666;
            font-size: 14px;
        }

        .demo-accounts {
            background: rgba(220, 0, 0, 0.05);
            border: 1px solid rgba(220, 0, 0, 0.2);
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .demo-accounts h4 {
            font-size: 14px;
            margin-bottom: 10px;
            color: #dc0000;
        }

        .demo-accounts p {
            font-size: 12px;
            color: #888;
            margin: 5px 0;
        }
    </style>
@endsection

@section('content')

    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <div class="login-logo">
                    GoLanding
                </div>
                <p class="login-subtitle">Premium Website Templates Marketplace</p>
            </div>

            <!-- Error Message -->
            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-login btn-primary">Login</button>
            </form>

            <div class="divider">or</div>

            <div class="demo-accounts">
                <h4>Demo Accounts</h4>
                <p><strong>Admin:</strong> admin@golanding.com / password123</p>
                <p><strong>User:</strong> demo@golanding.com / demo123</p>
            </div>
        </div>
    </div>

@endsection
