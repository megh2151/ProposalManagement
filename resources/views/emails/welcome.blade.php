<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
    </head>
    <body>
        <h1>Welcome to our website, {{ $user->name }}!</h1>
        <p>Thank you for registering with us. We hope you enjoy your experience on our website.</p>
        <p>Please <a href="{{route('user.activate',['token'=>$user->activation_token])}}">click here</a> to activate your account.</p>
    </body>
</html>