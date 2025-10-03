<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Magic Login Link</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #7f8c8d;
            font-size: 14px;
        }
        .warning {
            background: #fef5e7;
            border-left: 4px solid #f39c12;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-robot"></i> LaFab AI Posting</h1>
            <p>AI Powered Job Posting Platform</p>
        </div>
        
        <div class="content">
            @if($isWelcomeEmail)
                <h2>Welcome to LaFab AI Posting! 🎉</h2>
                <p>Your account has been successfully created. Click the button below to log in to your new account:</p>
            @else
                <h2>Your Magic Login Link ✨</h2>
                <p>Click the button below to securely log in to your LaFab AI Posting account:</p>
            @endif
            
            <div style="text-align: center;">
                <a href="{{ route('auth.authenticate', $token) }}" class="button">
                    <i class="fas fa-magic"></i> 
                    {{ $isWelcomeEmail ? 'Activate Your Account' : 'Login to Your Account' }}
                </a>
            </div>
            
            <div class="warning">
                <p><strong>Important:</strong> This link will expire in 24 hours and can only be used once.</p>
                <p>If you didn't request this login link, please ignore this email.</p>
            </div>
            
            <p>Or copy and paste this link in your browser:</p>
            <p style="word-break: break-all; background: white; padding: 10px; border-radius: 5px; font-size: 12px;">
                {{ route('auth.authenticate', $token) }}
            </p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} LaFab Solution. All rights reserved.</p>
            <p>If you need help, contact us at <a href="mailto:support@lafab.com">support@lafab.com</a></p>
        </div>
    </div>
</body>
</html>