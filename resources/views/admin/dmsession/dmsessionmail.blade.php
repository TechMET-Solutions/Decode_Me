<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DECODING ME</title>
</head>

<body>
    <h3>Hello {{ $dmSessionMailData['student_name'] }},<br></h3>
    <p>This is a gentle reminder about your DM session booked for {{ $dmSessionMailData['date'] }}, at
        {{ $dmSessionMailData['time'] }}.<br><br><br>
        Regards,<br>
        Team Decoding Me
    </p>
</body>
</html>
