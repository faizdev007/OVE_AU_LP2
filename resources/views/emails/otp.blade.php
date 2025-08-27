<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OTP Email</title>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            padding: 20px;
            text-align: center;
        }
        .email-header {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .otp-code {
            font-size: 40px;
            font-weight: bold;
            color: #2C79F3; /* You can change this color to your brand's color */
            margin: 20px 0;
        }
        .email-body {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 14px;
            color: #888;
            margin-top: 20px;
        }
</style>
</head>
<body>
<div class="email-container">
<div class="email-header">
            Email Verification Code
</div>
<div class="otp-code">
            {{ $otp ?? '--' }}
</div>
<div class="email-body">
<p>Hello {{ $name ?? '--'}},</p>
<p>Your OTP code is provided above. Please enter the code to complete your verification process. This code is valid for 10 minutes.</p>
</div>
<div class="footer">
<p>If you did not request this, please ignore this email.</p>
</div>
</div>
</body>
</html>