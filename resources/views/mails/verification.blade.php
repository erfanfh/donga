<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ایمیل تایید</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        .email-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            width: 100px;
            margin-bottom: 20px;
        }
        .title {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .code {
            font-size: 32px;
            color: #4CAF50;
            letter-spacing: 2px;
            margin: 20px 0;
        }
        .message {
            font-size: 16px;
            margin-bottom: 30px;
        }
        .footer {
            font-size: 12px;
            color: #666;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <img src="{{ asset('images/logo-nobg.png') }}" alt="لوگو" class="logo">
    <div class="title">خوش آمدید!</div>
    <div class="message">
        از ثبت‌ نام شما در دنگا سپاسگزاریم. برای تأیید حساب کاربری خود، کد زیر را وارد کنید.
    </div>
    <div class="code">{{ $code }}</div>
    <div class="footer">
        اگر شما این درخواست را نداده‌اید، لطفاً این پیام را نادیده بگیرید.
    </div>
</div>
</body>
</html>
