<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pabelo Salon - Register</title>
    
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

        .benefits {
            margin-top: 40px;
            text-align: left;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .benefits h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #b48a5a;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .benefit-item i {
            width: 30px;
            color: #b48a5a;
            font-size: 18px;
        }

        /* Right side with form */
        .form-side {
            flex: 1;
            display: flex;
            align-items: flex-start; /* Changed from center to flex-start */
            justify-content: center;
            background: #ffffff;
            padding: 40px 40px 40px 40px;
            overflow-y: auto;
            min-height: 100vh;
        }

        .register-wrapper {
            max-width: 450px;
            width: 100%;
            margin: 20px 0 40px 0; /* Added top and bottom margin */
            animation: fadeInRight 1s ease;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
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
            margin-bottom: 25px;
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
            margin-bottom: 18px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-weight: 500;
            font-size: 13px;
        }

        .input-wrapper {
            position: relative;
            transition: transform 0.3s ease;
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
            padding: 12px 12px 12px 45px;
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
            font-size: 12px;
        }

        /* Password strength indicator */
        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: #f0e9e0;
            border-radius: 2px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
        }

        .strength-text {
            font-size: 11px;
            margin-top: 4px;
            text-align: right;
        }

        /* Terms checkbox */
        .terms-group {
            margin: 20px 0;
        }

        .checkbox-label {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            cursor: pointer;
            color: #666;
            font-size: 13px;
        }

        .checkbox-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            accent-color: #b48a5a;
        }

        .checkbox-label a {
            color: #b48a5a;
            text-decoration: none;
            font-weight: 600;
        }

        .checkbox-label a:hover {
            text-decoration: underline;
        }

        .register-btn {
            width: 100%;
            background: #b48a5a;
            color: white;
            padding: 14px;
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

        .register-btn i {
            font-size: 18px;
        }

        .register-btn:hover {
            background: #8d6b45;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(180, 138, 90, 0.3);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #f0e9e0;
        }

        .login-link p {
            color: #777;
            font-size: 14px;
        }

        .login-link a {
            color: #b48a5a;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #8d6b45;
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #999;
            font-size: 12px;
            padding-bottom: 10px;
        }

        /* Error styling */
        .error-message {
            color: #dc2626;
            font-size: 11px;
            margin-top: 4px;
            display: block;
        }

        .input-error {
            border-color: #dc2626 !important;
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

        /* Responsive design */
        @media (max-width: 768px) {
            .split-container {
                flex-direction: column;
            }
            
            .image-side {
                min-height: 400px;
            }
            
            .overlay-content h1 {
                font-size: 2.5rem;
            }
            
            .form-side {
                padding: 20px;
            }
            
            .register-wrapper {
                margin: 10px 0 20px 0;
            }
        }

        /* For very large screens */
        @media (min-height: 900px) {
            .register-wrapper {
                margin: 40px 0 60px 0;
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
                <p>Join Our Exclusive Club</p>
                
                <div class="benefits">
                    <h3>Member Benefits</h3>
                    
                    <div class="benefit-item">
                        <i class="fas fa-gem"></i>
                        <span>10% off on all services</span>
                    </div>
                    
                    <div class="benefit-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Priority booking</span>
                    </div>
                    
                    <div class="benefit-item">
                        <i class="fas fa-gift"></i>
                        <span>Birthday special treats</span>
                    </div>
                    
                    <div class="benefit-item">
                        <i class="fas fa-star"></i>
                        <span>Exclusive member events</span>
                    </div>
                    
                    <div class="benefit-item">
                        <i class="fas fa-percent"></i>
                        <span>Seasonal promotions</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side with registration form -->
        <div class="form-side">
            <div class="register-wrapper">
                <!-- Logo -->
                <div class="logo">
                    <img src="{{ asset('build/assets/images/pablo-final.png') }}" alt="Pabelo Salon Logo" width="60%">
                    <h2>Pabelo Salon</h2>
                    <span>Create Account</span>
                </div>
                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    <!-- CSRF Token (for Laravel) -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- Name Field -->
                    <div class="input-group">
                        <label for="name">Full Name</label>
                        <div class="input-wrapper">
                            <i class="far fa-user"></i>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}"
                                required 
                                autofocus 
                                autocomplete="name"
                                placeholder="Enter your full name"
                            >
                        </div>
                        <!-- Error message for name -->
                        <span class="error-message" id="name-error"></span>
                    </div>

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
                                autocomplete="username"
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
                                autocomplete="new-password"
                                placeholder="Create a password"
                            >
                        </div>
                        <!-- Password strength indicator -->
                        <div class="password-strength">
                            <div class="strength-bar" id="strengthBar"></div>
                        </div>
                        <div class="strength-text" id="strengthText"></div>
                        <!-- Error message for password -->
                        <span class="error-message" id="password-error"></span>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="input-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                placeholder="Confirm your password"
                            >
                        </div>
                        <!-- Error message for confirm password -->
                        <span class="error-message" id="confirm-password-error"></span>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="terms-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="terms" id="terms" required>
                            <span>
                                I agree to the <a href="#">Terms of Service</a> and 
                                <a href="#">Privacy Policy</a>
                            </span>
                        </label>
                        <span class="error-message" id="terms-error"></span>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="register-btn">
                        <i class="fas fa-user-plus"></i>
                        Create Account
                    </button>

                    <!-- Login Link -->
                    <div class="login-link">
                        <p>Already have an account? 
                            <a href="{{ route('login') }}">Sign In</a>
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

    <!-- JavaScript for form validation and interactivity -->
    <script>
        // Password strength checker
        const password = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        password.addEventListener('input', function() {
            const strength = checkPasswordStrength(this.value);
            updateStrengthIndicator(strength);
        });

        function checkPasswordStrength(password) {
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[$@#&!]+/)) strength++;
            
            return strength;
        }

        function updateStrengthIndicator(strength) {
            const colors = ['#dc2626', '#f59e0b', '#f59e0b', '#10b981', '#10b981'];
            const texts = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
            const widths = ['20%', '40%', '60%', '80%', '100%'];
            
            if (password.value.length === 0) {
                strengthBar.style.width = '0';
                strengthText.textContent = '';
            } else {
                const index = Math.min(strength, 4);
                strengthBar.style.width = widths[index];
                strengthBar.style.backgroundColor = colors[index];
                strengthText.textContent = texts[index];
                strengthText.style.color = colors[index];
            }
        }

        // Form validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            let isValid = true;
            
            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            document.querySelectorAll('.input-group input').forEach(el => {
                el.classList.remove('input-error');
            });
            
            // Name validation
            const name = document.getElementById('name');
            if (!name.value.trim()) {
                document.getElementById('name-error').textContent = 'Name is required';
                name.classList.add('input-error');
                isValid = false;
            } else if (name.value.trim().length < 2) {
                document.getElementById('name-error').textContent = 'Name must be at least 2 characters';
                name.classList.add('input-error');
                isValid = false;
            }
            
            // Email validation
            const email = document.getElementById('email');
            if (!email.value) {
                document.getElementById('email-error').textContent = 'Email is required';
                email.classList.add('input-error');
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                document.getElementById('email-error').textContent = 'Please enter a valid email';
                email.classList.add('input-error');
                isValid = false;
            }
            
            // Password validation
            const password = document.getElementById('password');
            if (!password.value) {
                document.getElementById('password-error').textContent = 'Password is required';
                password.classList.add('input-error');
                isValid = false;
            } else if (password.value.length < 8) {
                document.getElementById('password-error').textContent = 'Password must be at least 8 characters';
                password.classList.add('input-error');
                isValid = false;
            }
            
            // Confirm password validation
            const confirmPassword = document.getElementById('password_confirmation');
            if (password.value !== confirmPassword.value) {
                document.getElementById('confirm-password-error').textContent = 'Passwords do not match';
                confirmPassword.classList.add('input-error');
                isValid = false;
            }
            
            // Terms validation
            const terms = document.getElementById('terms');
            if (!terms.checked) {
                document.getElementById('terms-error').textContent = 'You must agree to the terms and conditions';
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

        // Animation on focus
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