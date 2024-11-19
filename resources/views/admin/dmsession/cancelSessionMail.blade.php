<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DECODING ME</title>
</head>

<body>
    <h3>Hello {{ $cancelDmSessionMailData['student_name'] }},<br></h3>
    <p>
        Your DM session scheduled for {{ $cancelDmSessionMailData['date'] }} at {{ $cancelDmSessionMailData['time'] }}
        has been canceled.<br>
        Reason: {{ $cancelDmSessionMailData['reason'] }}.<br><br>
        Regards,<br>
        Team Decoding Me
    </p>
</body>

</html>
