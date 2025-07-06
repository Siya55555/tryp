<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
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
        
        .logo {
            max-width: 140px;
            height: auto;
            margin-bottom: 15px;
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
        
        .original-message {
            margin-top: 25px;
            padding: 20px;
            background-color: #f5f7fa;
            border-left: 4px solid #1a56db;
            border-radius: 4px;
        }
        
        .original-message-title {
            font-weight: 600;
            color: #1a56db;
            margin-top: 0;
            margin-bottom: 10px;
        }
        
        .original-message-content {
            color: #4b5563;
            font-size: 14px;
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
        
        .social-links {
            margin-top: 15px;
        }
        
        .social-links a {
            display: inline-block;
            margin: 0 8px;
            color: #ffffff;
            font-size: 20px;
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
                <p class="greeting">Dear {{ $name }},</p>
                
                <div class="message">
                    {!! nl2br(e($messageContent)) !!}
                </div>
                
                <p>If you have any other questions or need further assistance, please don't hesitate to contact us.</p>
                
                <div class="divider"></div>
                
                <p class="signature">
                    Best regards,<br>
                    <span class="company">MyTravel Team</span>
                </p>
                
                <a href="https://mytravelsite.com" class="button" style="color:white">Visit Our Website</a>
                
                <div class="original-message">
                    <p class="original-message-title">Your original message:</p>
                    <div class="original-message-content">
                        {!! nl2br(e($originalMessage)) !!}
                    </div>
                </div>
            </div>
            
            <div class="footer">
                <p>&copy; {{ date('Y') }} MyTravel. All rights reserved.</p>
                <p>
                    <a href="https://mytravelsite.com">Website</a> | 
                    <a href="https://mytravelsite.com/contact">Contact Us</a> | 
                    <a href="https://mytravelsite.com/privacy-policy">Privacy Policy</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>