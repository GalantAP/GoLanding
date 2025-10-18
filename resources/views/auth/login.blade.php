<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoLanding - Auth</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('{{ asset('assets/BG_Login.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
        }

        .auth-wrapper {
            position: relative;
            width: 100%;
            max-width: 420px;
            height: 600px;
            perspective: 1000px;
        }

        .auth-box {
            position: absolute;
            width: 100%;
            height: 100%;
            transition: transform 0.6s ease-in-out;
            transform-style: preserve-3d;
        }

        .auth-box.flip {
            transform: rotateY(180deg);
        }

        .form-side {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            background: rgba(139, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            padding: 40px 45px;
            border-radius: 20px;
            border: 1px solid rgba(255, 0, 0, 0.3);
        }

        .register-side {
            transform: rotateY(0deg);
        }

        .login-side {
            transform: rotateY(180deg);
        }

        .form-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .form-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #ff0000;
            margin-bottom: 5px;
        }

        .form-header p {
            color: #ffcccc;
            font-size: 13px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #ff0000;
            font-weight: 600;
            font-size: 14px;
        }

        .password-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .password-header label {
            margin-bottom: 0;
        }

        .password-header a {
            color: #ffcccc;
            font-size: 12px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .password-header a:hover {
            color: #ffffff;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            background: rgba(80, 0, 0, 0.6);
            border: 1px solid rgba(255, 0, 0, 0.4);
            border-radius: 8px;
            color: white;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-control:focus {
            outline: none;
            border-color: #ff0000;
            background: rgba(100, 0, 0, 0.7);
        }

        .form-control.is-invalid {
            border-color: #ff6b6b;
        }

        .invalid-feedback {
            color: #ff6b6b;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            font-size: 18px;
            user-select: none;
        }

        .password-toggle:hover {
            color: rgba(255, 255, 255, 0.9);
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
        }

        .form-check input {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .form-check label {
            color: #ffcccc;
            font-size: 13px;
            cursor: pointer;
            margin: 0;
            font-weight: 400;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #ff0000;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            text-transform: capitalize;
        }

        .btn-submit:hover {
            background: #cc0000;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 0, 0, 0.4);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            color: #ffcccc;
            font-size: 14px;
            font-weight: 600;
        }

        .social-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }

        .btn-social {
            padding: 12px;
            background: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-google {
            color: #333;
        }

        .btn-facebook {
            color: #1877f2;
        }

        .btn-social:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .switch-link {
            text-align: center;
            color: #ffcccc;
            font-size: 14px;
        }

        .switch-link a {
            color: #ff0000;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
            cursor: pointer;
        }

        .switch-link a:hover {
            color: #ffffff;
        }

        .google-icon {
            width: 18px;
            height: 18px;
            background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
            border-radius: 50%;
            display: inline-block;
        }

        .facebook-icon {
            width: 18px;
            height: 18px;
            background: #1877f2;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 12px;
        }

        .back-to-home {
            position: absolute;
            top: 30px;
            left: 30px;
            z-index: 10;
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-5px);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Back to Home Button -->
        <div class="back-to-home">
            <a href="{{ route('dashboard') }}" class="back-btn">
                ← Kembali ke Beranda
            </a>
        </div>

        <div class="auth-wrapper">
            <div class="auth-box" id="authBox">
                <!-- Register Side -->
                <div class="form-side register-side">
                    <div class="form-header">
                        <h1>Silahkan Daftar Akun Anda</h1>
                    </div>

                    <form action="{{ route('register.post') }}" method="POST" id="registerForm">
                        @csrf

                        <div class="form-group">
                            <label for="register-email">Email</label>
                            <input type="email" 
                                   name="email" 
                                   id="register-email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="golanding@gmail.com" 
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="password-header">
                                <label for="register-password">Password</label>
                                <a href="#">Lupa ?</a>
                            </div>
                            <div class="input-wrapper">
                                <input type="password" 
                                       name="password" 
                                       id="register-password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Masukkan Password Anda (min. 6 karakter)" 
                                       required>
                                <span class="password-toggle" onclick="togglePassword('register-password')">👁️</span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn-submit">Daftar</button>
                    </form>

                    <div class="divider">Atau</div>

                    <div class="social-buttons">
                        <button type="button" class="btn-social btn-google">
                            <span class="google-icon"></span>
                            Google
                        </button>
                        <button type="button" class="btn-social btn-facebook">
                            <span class="facebook-icon">f</span>
                            Facebook
                        </button>
                    </div>

                    <div class="switch-link">
                        Sudah Punya Akun? <a onclick="switchToLogin()">Log In</a>
                    </div>
                </div>

                <!-- Login Side -->
                <div class="form-side login-side">
                    <div class="form-header">
                        <h1>Selamat Datang Kembali</h1>
                    </div>

                    <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                        @csrf

                        <div class="form-group">
                            <label for="login-email">Email</label>
                            <input type="email" 
                                   name="email" 
                                   id="login-email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="golanding@gmail.com" 
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="password-header">
                                <label for="login-password">Password</label>
                                <a href="#">Lupa ?</a>
                            </div>
                            <div class="input-wrapper">
                                <input type="password" 
                                       name="password" 
                                       id="login-password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Masukkan Password Anda" 
                                       required>
                                <span class="password-toggle" onclick="togglePassword('login-password')">👁️</span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">Ingat saya</label>
                        </div>

                        <button type="submit" class="btn-submit">Login</button>
                    </form>

                    <div class="divider">Atau</div>

                    <div class="social-buttons">
                        <button type="button" class="btn-social btn-google">
                            <span class="google-icon"></span>
                            Google
                        </button>
                        <button type="button" class="btn-social btn-facebook">
                            <span class="facebook-icon">f</span>
                            Facebook
                        </button>
                    </div>

                    <div class="switch-link">
                        Belum Punya Akun? <a onclick="switchToRegister()">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = passwordInput.parentElement.querySelector('.password-toggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '👁️';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️';
            }
        }

        function switchToLogin() {
            document.getElementById('authBox').classList.add('flip');
        }

        function switchToRegister() {
            document.getElementById('authBox').classList.remove('flip');
        }

        // Check if there are errors and show the correct form
        document.addEventListener('DOMContentLoaded', function() {
            @if($errors->any())
                // If there are errors, check which form was submitted
                const loginErrors = {{ $errors->has('email') || $errors->has('password') ? 'true' : 'false' }};
                if (loginErrors) {
                    switchToLogin();
                }
            @endif
        });
    </script>
</body>
</html>