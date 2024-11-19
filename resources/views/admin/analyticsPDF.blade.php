<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DecodeMe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h1 style="text-align: center">{{ $title }}</h1>
    <h5 class="mt-4" style="text-align:right;color:blue;">{{ $date }}</h5>
    <div class="card mt-2">
        <h4 style="margin-left:20px; Margin-top:20px;">Total Number of Schools:{{ $school }}</h4>
        <h4 style="margin-left:20px;">Total Number of Students:{{ $student }}</h4>
        <h4 style="margin-left:20px; Margin-bottom:20px;">Total Number of Experts:{{ $expert }}</h4>
    </div>
    <h4 class="mt-2">DM Task</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Task Type</th>
                <th>Total</th>
                <th>Pending</th>
                <th>Submitted</th>
                <th>Completed</th>
                <th>Overdue</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Individual</td>
                <td>{{ $inditask }}</td>
                <td>{{ $pinditask }}</td>
                <td>{{ $sinditask }}</td>
                <td>{{ $cinditask }}</td>
                <td>{{ $oinditask }}</td>
            </tr>
            <tr>
                <td>Career Club</td>
                <td>{{ $grtask }}</td>
                <td>{{ $pgrtask }}</td>
                <td>{{ $sgrtask }}</td>
                <td>{{ $cgrtask }}</td>
                <td>{{ $ogrtask }}</td>
            </tr>
        </tbody>
    </table>

    <h4 class="mt-2">DM Session</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Session</th>
                <th>Total</th>
                <th>Assigned</th>
                <th>Completed</th>
                <th>Cancelled</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>DM Session</td>
                <td>{{ $totdmsession }}</td>
                <td>{{ $dmsession }}</td>
                <td>{{ $comdmsession }}</td>
                <td>{{ $candmsession }}</td>
            </tr>
        </tbody>
    </table>

    <div class="card mt-2">
        <h4 style="margin-left:20px; Margin-top:20px;">Total Done Workshop:{{ $workshop }}</h4>
        <h4 style="margin-left:20px; Margin-bottom:20px;">Total Internships:{{ $internship }}</h4>
    </div>
</body>

</html>
