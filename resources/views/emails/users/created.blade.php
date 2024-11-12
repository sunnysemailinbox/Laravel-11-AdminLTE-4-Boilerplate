<!DOCTYPE html>
<html>
    <head>
        <title>User Created</title>
    </head>
    <body>
        <h1>Your User Has Been Created!</h1>
        <p>Here are the details of your account:</p>

        <p><strong>User Name:</strong> {{ $userName }}</p>
        <p><strong>User Email:</strong> {{ $userEmail }}</p>
        <p><strong>User Password:</strong> {{ $userPassword }}</p>
        <img src="{{ $message->embed($userAvatar) }}">
    </body>
</html>
