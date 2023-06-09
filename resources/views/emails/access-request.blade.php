<!DOCTYPE html>
<html>
    <head>
        <title>Request for proposal</title>
    </head>
    <body>
        <h1>Hello {{$proposal->user->name}}</h1>
        <p>Government User {{ auth()->user()->name }} is requested access for {{$proposal->title}}. </p>
        <p>{{$proposal->access_request_note}}</p>
        <p></p>
        <p>Please grant access for proposal.</p>
        <p></p>
    </body>
</html>