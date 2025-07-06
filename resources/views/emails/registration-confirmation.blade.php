<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MyTravel</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f5f7fa;
            padding: 0;
            margin: 0;
        }
        
        .wrapper {
            width: 100%;
            background-color: #f5f7fa;
            padding: 30px 0;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background-color: #1a56db;
            padding: 25px 30px;
            text-align: center;
        }
        
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        
        .content {
            padding: 30px;
            background-color: #ffffff;
        }
        
        .greeting {
            font-size: 20px;
            font-weight: 500;
            color: #1a56db;
            margin-top: 0;
            margin-bottom: 20px;
        }
        
        .message {
            color: #4b5563;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 25px;
        }
        
        .divider {
            height: 1px;
            background-color: #e5e7eb;
            margin: 25px 0;
        }
        
        .signature {
            font-weight: 500;
            color: #4b5563;
        }
        
        .company {
            font-weight: 600;
            color: #1a56db;
        }
        
        .footer {
            background-color: #1f2937;
            color: #ffffff;
            padding: 25px 30px;
            text-align: center;
            font-size: 14px;
        }
        
        .footer p {
            margin: 6px 0;
            color: #9ca3af;
        }
        
        .footer a {
            color: #ffffff;
            text-decoration: none;
        }
        
        .button {
            display: inline-block;
            background-color: #1a56db;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            margin-top: 15px;
            text-align: center;
        }
        
        .button:hover {
            background-color: #1e40af;
        }
        
        @media only screen and (max-width: 620px) {
            .container {
                width: 100%;
                border-radius: 0;
            }
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>MyTravel</h1>
            </div>
            
            <div class="content">
                <p class="greeting">Welcome, {{ $name }}!</p>
                
                <div class="message">
                    <p>Thank you for creating an account with MyTravel. We're excited to have you join our community of travelers!</p>
                    
                    <p>With your new account, you can:</p>
                    <ul>
                        <li>Book vacation packages and custom bundles</li>
                        <li>Track your bookings and travel plans</li>
                        <li>Receive personalized travel recommendations</li>
                        <li>Access exclusive deals and promotions</li>
                    </ul>
                    
                    <p>Your account has been successfully created and is ready to use.</p>
                </div>
                
                <a href="{{ route('user.dashboard') }}" class="button" style="color:white">Visit Your Dashboard</a>
                
                <div class="divider"></div>
                
                <p class="signature">
                    Best regards,<br>
                    <span class="company">MyTravel Team</span>
                </p>
            </div>
            
            <div class="footer">
                <p>&copy; {{ date('Y') }} MyTravel. All rights reserved.</p>
                <p>
                    <a href="{{ route('home') }}">Website</a> | 
                    <a href="{{ route('contact.submit') }}">Contact Us</a> | 
                    <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>