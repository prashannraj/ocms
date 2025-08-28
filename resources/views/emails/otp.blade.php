{{-- resources/views/emails/otp.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
</head>
<body>
    <p>Dear user,</p>
    <p>Your OTP code is: <strong>{{ $otp }}</strong></p>
    <p>This code will expire in 5 minutes.</p>
    <p>Thank you!</p>
</body>
</html>
