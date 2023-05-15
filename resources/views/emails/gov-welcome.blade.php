<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
    </head>
    <body>
        <h1>Welcome to our website, {{ $user->name }}!</h1>
        <p>Thank you for registering with us. We hope you enjoy your experience on our website.</p>
        <p>Please find login credentials below:</p>
        <p>Name: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Password: {{ $user->password }}</p>
        <p></p>
        <p></p>
    </body>
</html>