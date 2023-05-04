<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Activate your account</title>
</head>

<body>
    <h1>Activate your account</h1>

    <p>Thank you for registering with our website. Please click the link below to activate your account:</p>
    <p><a href="http://127.0.0.1:8000/activate/.{{ $data['token'] }}">{{ $data['token'] }}</a></p>
    <p>If you did not register on our website, please ignore this email.</p>
</body>

</html>
