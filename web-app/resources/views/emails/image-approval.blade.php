<!DOCTYPE html>
<html>
<head>
    <title>Image Approval Status</title>
</head>
<body>
    <p>Hello {{ $image->user->name }},</p>
    
    <p>Your image has been reviewed and its status is now: <strong>{{ $image->status }}</strong>.</p>

    <p>Thank you!</p>
</body>
</html>
