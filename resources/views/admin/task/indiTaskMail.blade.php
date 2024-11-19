<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DECODEME</title>
</head>

<body>
    <h3>Hello {{ $inditaskmailData['student_name'] }},<br></h3>
    <h4>Task: {{ $inditaskmailData['task_name'] }}<br> </h4>
    <p>{{ $inditaskmailData['massage'] }} </p>
</body>

</html>
