<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DecodeMe</title>
    <style>
        /* Include necessary Bootstrap styles */
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .img-thumbnail {
            display: inline-block;
            max-width: 100%;
            height: auto;
            padding: 0.25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">{{ $title }}</h1>
    <h5 class="mt-4" style="text-align:right;color:blue;">{{ $date }}</h5>
    <h4 class="mt-4" style="text-align:right;">Student Name:{{ $name }}</h4>
    <h4 class="mt-4" style="text-align:right;">School Name:{{ $sname }}</h4>
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th style="text-align: left;">Type</th>
                <th style="text-align: left;">Option</th>
                <th style="text-align: left;">Rank</th>
            </tr>
        </thead>
        <tbody>
            @php
                if (!empty($careerrank)) {
                    $rank = json_decode($careerrank->sc_priority, true);
                } else {
                    $rank = [];
                }
                asort($rank);
            @endphp
            @if (!empty($rank))
                @foreach ($rank as $key => $value)
                    @foreach ($subCareer as $data)
                        @if ($data->id == $key)
                            <tr>
                                <td>{{ $data->career_name }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $value }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            @endif
        </tbody>
    </table>
</body>

</html>
