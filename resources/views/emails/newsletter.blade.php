<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: -30px -30px 30px -30px;
            padding: 30px;
            border-radius: 8px 8px 0 0;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: white;
        }
        .content {
            margin-bottom: 30px;
        }
        .content h1, .content h2, .content h3 {
            color: #1e40af;
            margin-top: 25px;
            margin-bottom: 15px;
        }
        .content p {
            margin-bottom: 15px;
        }
        .content img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin: 15px 0;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            color: #6b7280;
            font-size: 14px;
            margin-top: 30px;
        }
        .unsubscribe {
            margin-top: 20px;
        }
        .unsubscribe a {
            color: #6b7280;
            text-decoration: none;
        }
        .unsubscribe a:hover {
            text-decoration: underline;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(to right, #2563eb, #3b82f6);
            color: white !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            margin: 10px 5px;
            text-align: center;
        }
        .btn:hover {
            background: linear-gradient(to right, #1d4ed8, #2563eb);
        }
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            .container {
                padding: 20px;
            }
            .header {
                margin: -20px -20px 20px -20px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $subject }}</h1>
        </div>
        
        <div class="content">
            {!! $content !!}
        </div>
        
        <div class="footer">
            <p>Thank you for subscribing to our newsletter!</p>
            <p>You're receiving this because you subscribed to our updates.</p>
            
            <div class="unsubscribe">
                <p>
                    <a href="{{ route('email-subscriptions.unsubscribe', ['token' => $unsubscribeToken]) }}">
                        Click here to unsubscribe
                    </a>
                </p>
            </div>
            
            <p style="margin-top: 20px;">
                &copy; {{ date('Y') }} {{ config('app.name', 'MyTravel') }}. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
