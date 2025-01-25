<!-- resources/views/emails/welcome.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Website</title>
</head>
<body>
    <h1>Welcome, {{ $user->full_name }}!</h1>
    <p>Thank you for registering on our website. We're excited to have you on board.</p>
    <p>Best regards,<br>Our Team</p>
</body>
</html>
