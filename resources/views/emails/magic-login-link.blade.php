<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Magic Login Link</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .email-container {
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
        }
        
        .email-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
            color: white;
            padding: 50px 30px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 200px;
        }
        
        .header h1 {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
            text-align: center;
            width: 100%;
            line-height: 1.2;
        }
        
        .header p {
            font-size: 18px;
            opacity: 0.9;
            margin: 10px 0 0 0;
            text-align: center;
            width: 100%;
            line-height: 1.4;
        }
        
        .content {
            padding: 40px;
        }
        
        .content h2 {
            font-size: 22px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 16px;
            text-align: center;
        }
        
        .content p {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 24px;
            text-align: center;
            line-height: 1.6;
        }
        
        .button-container {
            text-align: center;
            margin: 32px 0;
        }
        
        .login-button {
            display: inline-block;
            background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
            color: white;
            padding: 16px 48px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }
        
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
            margin: 32px 0;
        }
        
        .warning-box {
            background: #fffaf0;
            border: 1px solid #fed7aa;
            border-radius: 8px;
            padding: 20px;
            margin: 24px 0;
        }
        
        .warning-box p {
            text-align: left;
            margin-bottom: 8px;
            color: #744210;
            font-size: 14px;
        }
        
        .warning-box p:last-child {
            margin-bottom: 0;
        }
        
        .warning-title {
            font-weight: 600;
            color: #dd6b20;
            margin-bottom: 8px;
        }
        
        .url-section {
            margin: 24px 0;
        }
        
        .url-section p {
            text-align: left;
            margin-bottom: 12px;
            font-weight: 500;
            color: #4a5568;
        }
        
        .url-box {
            background: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 16px;
            word-break: break-all;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            color: #2d3748;
            line-height: 1.4;
        }
        
        .footer {
            text-align: center;
            padding: 24px;
            border-top: 1px solid #e2e8f0;
            background: #f8f9fa;
        }
        
        .footer p {
            margin: 0;
            color: #718096;
            font-size: 14px;
        }
        
        .footer a {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }
        
        .footer a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 480px) {
            .content {
                padding: 24px;
            }
            
            .header {
                padding: 40px 20px;
                min-height: 180px;
            }
            
            .header h1 {
                font-size: 28px;
            }
            
            .header p {
                font-size: 16px;
            }
            
            .content h2 {
                font-size: 20px;
            }
            
            .login-button {
                padding: 14px 32px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-card">
            <div class="header">
                <h1>Katica Posting</h1>
                <p>AI Powered Job Posting Platform</p>
            </div>
            
            <div class="content">
                @if($isWelcomeEmail)
                    <h2>Welcome to Katica Posting! 🎉</h2>
                    <p>Your account has been successfully created. Click the button below to log in to your new account:</p>
                @else
                    <h2>Your Magic Login Link ✨</h2>
                    <p>Click the button below to securely log in to your Katica Posting account:</p>
                @endif
                
                <div class="button-container">
                    <a href="{{ route('auth.authenticate', $token) }}" class="login-button">
                        {{ $isWelcomeEmail ? 'Activate Your Account' : 'Login to Your Account' }}
                    </a>
                </div>
                
                <div class="divider"></div>
                
                <div class="warning-box">
                    <div class="warning-title">Important</div>
                    <p>This link will expire in 24 hours and can only be used once.</p>
                    <p>If you didn't request this login link, please ignore this email.</p>
                </div>
                
                <div class="url-section">
                    <p>Or copy and paste this link in your browser:</p>
                    <div class="url-box">
                        {{ route('auth.authenticate', $token) }}
                    </div>
                </div>
            </div>
            
            <div class="footer">
                <p>If you need help, contact us at <a href="mailto:admin@stardena.com">admin@stardena.com</a></p>
            </div>
        </div>
    </div>
</body>
</html>