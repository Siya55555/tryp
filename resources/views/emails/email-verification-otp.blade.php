<!-- resources/views/emails/email-verification-otp.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
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
            <h2>Verify Your Email Address</h2>
        </div>
        
        <p>Hello {{ $user->name }},</p>
        
        <p>Thank you for registering with MyTravel. Please verify your email address to complete your registration.</p>
        
        <p>Your verification code is:</p>
        
        <div class="otp-container">
            <div class="otp">{{ $otp }}</div>
        </div>
        
        <p>This code will expire in 60 minutes.</p>
        
        <p>If you did not create an account, no further action is required.</p>
        
        <p>Regards,<br>MyTravel Team</p>
        
        <div class="footer">
            <p>This is an automated email, please do not reply.</p>
        </div>
    </div>
</body>
</html>