<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DecodeMe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <h5 class="mt-4" style="text-align: right;color:blue;">{{ $date }}</h5>
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Sr.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Code</th>
                <th>Place</th>
                <th>Concern Person Name</th>
                <th>Concern Person Contact</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schools as $list)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $list->school_name }}</td>
                    <td>{{ $list->school_email }}</td>
                    <td>{{ $list->school_code }}</td>
                    <td>{{ $list->school_place }}</td>
                    <td>{{ $list->concern_person_name }}</td>
                    <td>{{ $list->concern_person_phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
