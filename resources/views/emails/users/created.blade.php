<!DOCTYPE html>
<html>
    <head>
        <title>User Created</title>
    </head>
    <body>
        <h1>Your User Has Created!</h1>
        <p>Here are the details of your account:</p>

        <p><strong>User Name:</strong> {{ $userName }}</p>
        <p><strong>User Email:</strong> {{ $userEmail }}</p>
        <img src="{{ $message->embed($userAvatar) }}">
    </body>
</html>
