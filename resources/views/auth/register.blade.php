<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - AI Powered Job Posting | LaFab Solution</title>
    
    <!-- Favicon References -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3498db;
            --primary-dark: #2980b9;
            --secondary: #2c3e50;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --success: #27ae60;
            --text: #333;
            --text-light: #7f8c8d;
            --shadow: 0 10px 30px rgba(0,0,0,0.1);
            --gradient: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        }
        
        body {
            background: var(--gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }
        
        .auth-container {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            overflow: hidden;
            max-width: 600px;
            width: 100%;
            margin: 20px;
        }
        
        .auth-header {
            background: var(--gradient);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .auth-header h2 {
            margin: 0;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .auth-header p {
            margin: 10px 0 0;
            opacity: 0.9;
        }
        
        .auth-body {
            padding: 30px;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-auth {
            background: var(--gradient);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }
        
        .btn-auth:active {
            transform: translateY(0);
        }
        
        .auth-footer {
            text-align: center;
            padding: 20px;
            border-top: 1px solid #e9ecef;
            background: #f8f9fa;
        }
        
        .auth-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .auth-footer a:hover {
            text-decoration: underline;
        }
        
        .auth-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: white;
            opacity: 0.9;
        }
        
        .alert {
            border-radius: 8px;
            border: none;
            padding: 12px 15px;
        }
        
        .alert-success {
            background-color: #d5f4e6;
            color: #27ae60;
        }
        
        .alert-danger {
            background-color: #fadbd8;
            color: #e74c3c;
        }
        
        .alert-warning {
            background-color: #fef5e7;
            color: #f39c12;
        }
        
        .back-to-home {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-to-home a {
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .back-to-home a:hover {
            text-decoration: underline;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border: 2px solid #e9ecef;
            border-right: none;
        }
        
        .input-group .form-control {
            border-left: none;
        }
        
        .input-group .form-control:focus {
            border-left: none;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <div class="auth-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2><i class="fas fa-robot"></i> LaFab AI Posting</h2>
            <p>Create your account to start automating job postings</p>
        </div>
        
        <div class="auth-body">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> 
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('auth.register.submit') }}">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="first_name" name="first_name" 
                                   placeholder="First name" value="{{ old('first_name') }}" required>
                        </div>
                        @error('first_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="last_name" name="last_name" 
                                   placeholder="Last name" value="{{ old('last_name') }}" required>
                        </div>
                        @error('last_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" 
                               placeholder="Enter your email address" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number (Optional)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input type="tel" class="form-control" id="phone" name="phone" 
                               placeholder="Your phone number" value="{{ old('phone') }}">
                    </div>
                    @error('phone')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="user_type" class="form-label">Account Type</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                        <select class="form-control" id="user_type" name="user_type" required>
                            <option value="">Select account type</option>
                            <option value="employer" {{ old('user_type') == 'employer' ? 'selected' : '' }}>Employer</option>
                            <option value="volunteer" {{ old('user_type') == 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                        </select>
                    </div>
                    @error('user_type')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="country_code" class="form-label">Country</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                        <select class="form-control" id="country_code" name="country_code">
                            <option value="UG" {{ old('country_code', 'UG') == 'UG' ? 'selected' : '' }}>Uganda</option>
                            <option value="KE" {{ old('country_code') == 'KE' ? 'selected' : '' }}>Kenya</option>
                            <option value="TZ" {{ old('country_code') == 'TZ' ? 'selected' : '' }}>Tanzania</option>
                            <option value="RW" {{ old('country_code') == 'RW' ? 'selected' : '' }}>Rwanda</option>
                            <option value="BI" {{ old('country_code') == 'BI' ? 'selected' : '' }}>Burundi</option>
                            <!-- Add more countries as needed -->
                        </select>
                    </div>
                    @error('country_code')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                    <label class="form-check-label" for="terms">
                        I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                    </label>
                    @error('terms')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-auth">
                    <i class="fas fa-user-plus"></i> Create Account
                </button>
            </form>
        </div>
        
        <div class="auth-footer">
            <p>Already have an account? <a href="{{ route('auth.login') }}">Login here</a></p>
        </div>
    </div>
    
    <div class="back-to-home">
        <a href="{{ url('/') }}"><i class="fas fa-arrow-left"></i> Back to Homepage</a>
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            if (form) {
                const submitBtn = form.querySelector('.btn-auth');
                
                form.addEventListener('submit', function(e) {
                    if (submitBtn) {
                        // Change button text to indicate loading
                        const originalHtml = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                        submitBtn.disabled = true;
                        
                        // Re-enable button after 5 seconds in case of error
                        setTimeout(() => {
                            submitBtn.innerHTML = originalHtml;
                            submitBtn.disabled = false;
                        }, 5000);
                    }
                });
            }
            
            // Add focus effects to form inputs
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focus');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focus');
                });
            });
        });
    </script>
</body>
</html>