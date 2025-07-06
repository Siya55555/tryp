<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
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
        
        .detail {
            margin-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 15px;
        }
        
        .detail:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        
        .detail strong {
            display: block;
            font-weight: 600;
            color: #1a56db;
            margin-bottom: 5px;
            font-size: 16px;
        }
        
        .detail p {
            margin: 5px 0 0;
            color: #4b5563;
            font-size: 15px;
            line-height: 1.7;
        }
        
        .detail-value {
            color: #4b5563;
            font-size: 15px;
        }
        
        .message-content {
            background-color: #f5f7fa;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #1a56db;
            margin-top: 10px;
        }
        
        .divider {
            height: 1px;
            background-color: #e5e7eb;
            margin: 25px 0;
        }
        
        .action-button {
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
        
        .action-button:hover {
            background-color: #1e40af;
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
                <h1>New Contact Form Submission</h1>
            </div>
            
            <div class="content">
                <p>A new contact form submission has been received from your website:</p>
                
                <div class="detail">
                    <strong>Name:</strong>
                    <div class="detail-value">{{ $first_name }} {{ $last_name }}</div>
                </div>
                
                <div class="detail">
                    <strong>Email:</strong>
                    <div class="detail-value">{{ $email }}</div>
                </div>
                
                <div class="detail">
                    <strong>Phone:</strong>
                    <div class="detail-value">{{ $phone }}</div>
                </div>
                
                <div class="detail">
                    <strong>Package Holder:</strong>
                    <div class="detail-value">{{ ucfirst($package_holder) }}</div>
                </div>
                
                <div class="detail">
                    <strong>Message:</strong>
                    <div class="message-content">
                        <p>{{ $message_content }}</p>
                    </div>
                </div>
                
                
               
            </div>
            
            <div class="footer">
                <p>&copy; {{ date('Y') }} MyTravel. All rights reserved.</p>
                <p>This is an automated notification from your website.</p>
            </div>
        </div>
    </div>
</body>
</html>