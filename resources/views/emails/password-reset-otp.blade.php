<!DOCTYPE html>
<html>
<head>
    <title>Password Reset OTP</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .otp-container {
            background-color: #f7f7f7;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            margin: 20px 0;
        }
        .otp {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #3b82f6;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Password Reset Request</h2>
        </div>
        
        <p>Hello {{ $user->name }},</p>
        
        <p>You are receiving this email because we received a password reset request for your account.</p>
        
        <p>Please use the following OTP (One-Time Password) to reset your password:</p>
        
        <div class="otp-container">
            <div class="otp">{{ $otp }}</div>
        </div>
        
        <p>This OTP will expire in 60 minutes.</p>
        
        <p>If you did not request a password reset, no further action is required.</p>
        
        <p>Regards,<br>MyTravel Team</p>
        
        <div class="footer">
            <p>If you're having trouble clicking the button, copy and paste the URL below into your web browser.</p>
            <p>This is an automated email, please do not reply.</p>
        </div>
    </div>
</body>
</html>