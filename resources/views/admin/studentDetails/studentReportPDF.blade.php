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
    <hr>
    <h5 class="mt-4" style="text-align:right;">Student Name:{{ $stud_name }}</h5>
    <h5 class="mt-4" style="text-align:right;">School Name:{{ $school_name }}</h5>
    <h5 class="mt-4" style="text-align:right;">Grade:{{ $stud_grade }}</h5>
    <hr>
    <h4 class="mt-2">Workshop: <i class='fas fa-check-circle' style='font-size:36px'></i></h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th></th>
                <th>Start Date
                    ({{ $w_s_d }})
                </th>
                <th>End Date
                    ({{ $w_e_d }})
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $workshop }}</td>
                <td>
                    @if ($day1att)
                        <p>Attendad</p>
                        {{--  <img src="{{ public_path('images/check.png') }}">  --}}
                    @else
                        <p>Not Attendad</p>
                        {{--  <img src="{{ public_path('images/uncheck.png') }}">  --}}
                    @endif
                </td>
                <td>
                    @if ($day2att)
                        <p>Attendad</p>
                        {{--  <img src="{{ public_path('images/check.png') }}">  --}}
                    @else
                        <p>Not Attendad</p>
                        {{--  <img src="{{ public_path('images/uncheck.png') }}">  --}}
                    @endif
                </td>
            </tr>

        </tbody>
    </table>

    <h4 class="mt-2">DM Task:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th></th>
                <th>Total</th>
                <th>Pending</th>
                <th>Submitted</th>
                <th>Completed</th>
                <th>Overdue</th>
                <th>Resubmitted</th>
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
                <td>{{ $rsinditask }}</td>
            </tr>
            {{--  <tr>
                <td>Career Club</td>
                <td>{{ $grtask }}</td>
                <td>{{ $pgrtask }}</td>
                <td>{{ $sgrtask }}</td>
                <td>{{ $cgrtask }}</td>
                <td>{{ $ogrtask }}</td>
            </tr>  --}}
        </tbody>
    </table>
    <h4 class="mt-2">DM Session:</h4>
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
    <h4 class="mt-2">Top Career Options:</h4>
    @php
        if (!empty($sco)) {
            $rank = json_decode($sco->sc_priority, true);
        } else {
            $rank = [];
        }
        asort($rank);
        //asort($rank);
        $rank = array_slice($rank, 0, 3, true);

    @endphp
    @if (!empty($rank))
        <ol>
            @foreach ($rank as $key => $value)
                @foreach ($subcareer as $data)
                    @if ($data->id == $key)
                        <li>{{ $data->name }}</li>
                    @endif
                @endforeach
            @endforeach
        </ol>
    @endif
    {{--  <div class="card mt-2">
        <h4 style="margin-left:20px; Margin-top:20px;">Total Done Workshop:{{ $workshop }}</h4>
        <h4 style="margin-left:20px; Margin-bottom:20px;">Total Internships:{{ $internship }}</h4>
    </div>  --}}
</body>

</html>
