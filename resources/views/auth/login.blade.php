<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pabelo Salon - Login</title>
    
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts - Playfair Display for luxury feel -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #faf7f2;
        }

        .split-container {
            display: flex;
            min-height: 100vh;
        }

        /* Left side with image */
        .image-side {
            flex: 1;
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), 
                        url('https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1187&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay-content {
            text-align: center;
            color: white;
            padding: 40px;
            animation: fadeInUp 1s ease;
        }

        .overlay-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .overlay-content p {
            font-size: 1.1rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            border-bottom: 2px solid #b48a5a;
            padding-bottom: 20px;
            display: inline-block;
        }

        .quote {
            margin-top: 40px;
            font-style: italic;
            font-size: 1.2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        /* Right side with form */
        .form-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            padding: 40px;
        }

        .login-wrapper {
            max-width: 400px;
            width: 100%;
            animation: fadeInRight 1s ease;
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo i {
            font-size: 50px;
            color: #b48a5a;
            background: #faf7f2;
            width: 100px;
            height: 100px;
            line-height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(180, 138, 90, 0.2);
        }

        .logo h2 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            color: #2c2c2c;
            letter-spacing: 1px;
        }

        .logo span {
            color: #b48a5a;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-title h3 {
            font-size: 24px;
            color: #2c2c2c;
            font-weight: 500;
        }

        .form-title p {
            color: #777;
            font-size: 14px;
            margin-top: 5px;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #b48a5a;
            font-size: 16px;
        }

        .input-group input {
            width: 100%;
            padding: 14px 14px 14px 45px;
            border: 2px solid #f0e9e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .input-group input:focus {
            outline: none;
            border-color: #b48a5a;
            box-shadow: 0 0 0 3px rgba(180, 138, 90, 0.1);
        }

        .input-group input::placeholder {
            color: #aaa;
            font-size: 13px;
        }

        .checkbox-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: #666;
            font-size: 14px;
        }

        .checkbox-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            accent-color: #b48a5a;
        }

        .forgot-link {
            color: #b48a5a;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .forgot-link:hover {
            color: #8d6b45;
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            background: #b48a5a;
            color: white;
            padding: 16px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .login-btn i {
            font-size: 18px;
        }

        .login-btn:hover {
            background: #8d6b45;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(180, 138, 90, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #f0e9e0;
        }

        .register-link p {
            color: #777;
            font-size: 14px;
        }

        .register-link a {
            color: #b48a5a;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: #8d6b45;
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #999;
            font-size: 12px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Error styling */
        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .session-status {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
            border: 1px solid #badbcc;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .split-container {
                flex-direction: column;
            }
            
            .image-side {
                min-height: 300px;
            }
            
            .overlay-content h1 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="split-container">
        <!-- Left side with image -->
        <div class="image-side">
            <div class="overlay-content">
                <h1>Pabelo Salon</h1>
                <p>Where Beauty Meets Elegance</p>
                <div class="quote">
                    <i class="fas fa-quote-left" style="opacity: 0.5;"></i>
                    Your beauty, our passion
                    <i class="fas fa-quote-right" style="opacity: 0.5;"></i>
                </div>
            </div>
        </div>

        <!-- Right side with login form -->
        <div class="form-side">
            <div class="login-wrapper">
                <!-- Logo -->
                <!-- <div class="logo">
                    <i class="fas fa-cut"></i>
                    <h2>Pablo Salon</h2>
                    <span>Luxury & Style</span>
                </div> -->
                <div class="logo">
        <img src="{{ asset('build/assets/images/pablo-final.png') }}" alt="Pabelo Salon Logo" width="60%">
        <h2>Pabelo Salon</h2>
        <span>Luxury & Style</span>
    </div>

                <!-- Session Status (if any) -->
                <div class="session-status" style="display: none;">
                    <!-- Session status will appear here -->
                </div>
                <form method="POST" action="{{ route('login') }}">
                    <!-- CSRF Token (for Laravel) -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- Email Field -->
                    <div class="input-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrapper">
                            <i class="far fa-envelope"></i>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required 
                                autofocus 
                                placeholder="Enter your email"
                            >
                        </div>
                        <!-- Error message for email -->
                        <span class="error-message" id="email-error"></span>
                    </div>

                    <!-- Password Field -->
                    <div class="input-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required 
                                placeholder="Enter your password"
                            >
                        </div>
                        <!-- Error message for password -->
                        <span class="error-message" id="password-error"></span>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>

                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Forgot Password?
                        </a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="login-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        Log In
                    </button>

                    <!-- Register Link -->
                    <div class="register-link">
                        <p>Don't have an account? 
                            <a href="{{ route('register') }}">Create Account</a>
                        </p>
                    </div>
                </form>

                <!-- Footer -->
                <div class="footer">
                    © {{ date('Y') }} Pabelo Salon. All rights reserved.
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: JavaScript for form validation and interactivity -->
    <script>
        // Simple form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            let isValid = true;
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            
            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            
            // Email validation
            if (!email.value) {
                document.getElementById('email-error').textContent = 'Email is required';
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                document.getElementById('email-error').textContent = 'Please enter a valid email';
                isValid = false;
            }
            
            // Password validation
            if (!password.value) {
                document.getElementById('password-error').textContent = 'Password is required';
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
        
        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        
        // Add animation to inputs
        document.querySelectorAll('.input-group input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>