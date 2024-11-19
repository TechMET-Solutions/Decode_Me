<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DECODING ME</title>
</head>

<body>
    <h3>Hello {{ $indiTaskData['stud_name'] }},<br></h3>
    <p>Your new DM task is published on the dashboard. Click <a href="{{ route('tasks') }}">here</a> to check.<br>
        Let's ensure your task is completed faster than a bowl of Noodles! But remember it's equally important to do it
        right.<br><br><br>
        Regards,<br>
        Team Decoding Me
    </p>
</body>

</html>
