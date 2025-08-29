<!DOCTYPE html>
<html>
<head>
    <title>Your Account Credentials</title>
</head>
<body>
    <h1>Welcome, {{ $user->name }}!</h1>
    <p>An account has been created for you. Please use the following credentials to log in:</p>
    <ul>
        <li><strong>Username:</strong> {{ $user->email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>
    <p>Thank you!</p>
</body>
</html>