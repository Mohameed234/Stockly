<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color:rgb(76, 97, 175);
            color: white !important;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <h2>Reset Your Password</h2>

    <p>You are receiving this email because we received a password reset request for your account.</p>

    <p>Click the button below to reset your password:</p>

    <a href="{{ $url }}" class="button">Reset Password</a>

    <p>If you did not request a password reset, no further action is required.</p>

    <p>This password reset link will expire in 60 minutes.</p>

    <div class="footer">
        <p>If you're having trouble clicking the button, copy and paste the URL below into your web browser:</p>
        <p>{{ $url }}</p>
    </div>
</body>
</html>
