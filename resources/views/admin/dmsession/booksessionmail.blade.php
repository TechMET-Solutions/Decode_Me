<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DECODING ME</title>
</head>

<body>
    <h3>Hello {{ $bookSessionMailData['stud_name'] }},<br></h3>
    <p>Thank you for booking your DM session<br>
        Your DM session is confirmed for {{ $bookSessionMailData['date'] }}, at {{ $bookSessionMailData['time'] }}.
        We'll see you soon<br><br><br>
        Regards,<br>
        Team Decoding Me
    </p>
</body>

</html>
