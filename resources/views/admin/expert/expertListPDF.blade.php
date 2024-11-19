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
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Sr.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Occupation</th>
                <th>Joining Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($experts as $list)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        @if ($list->photo)
                            <img height="30" width="30" class="img-thumbnail"
                                src="{{ asset('/images/' . $list->photo) }}" alt="ExpertImage">
                        @else
                            <img height="30" width="30" class="img-thumbnail"
                                src="{{ asset('/stud_images/default.jpg') }}" alt="DefaultImage">
                        @endif
                    </td>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->phone }}</td>
                    <td>{{ $list->email }}</td>
                    <td>{{ $list->occupation }}</td>
                    <td>{{ $list->date_of_join }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
