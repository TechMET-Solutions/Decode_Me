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

<body style="font-size:18px;">
    <h1 class="mb-4 text-center">{{ $title }}</h1>
    @if ($schoolname != null)
        <h3 class="text-right">School Name: {{ $schoolname }}</h3>
    @endif
    <h5 class="text-right" style="color: blue;">{{ $date }}</h5>
    <table class="table table-bordered table-sm">
        <thead style="font-size: 16px;">
            <tr>
                <th>Sr.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                {{--  <th>Contact</th>  --}}
                @if ($schoolname == null)
                    <th>School</th>
                @endif
                <th>Grade</th>
                {{--  @if ($schoolname != null)
                    <th>Date of Enrollment</th>
                @endif  --}}
            </tr>
        </thead>
        <tbody style="font-size:14px;">
            @foreach ($students as $list)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        <img height="30" width="30" class="img-thumbnail"
                            src="{{ asset($list->profile ? 'stud_images/' . $list->profile : 'stud_images/DefaultUserimg.png') }}"
                            alt="StudentImage">
                        {{--  ('/stud_images/' . $list->profile)  --}}
                        {{--  @if ($list->profile)
                            <img height="30" width="30" class="img-thumbnail"
                                src="{{ asset('/stud_images/' . $list->profile) }}" alt="ExpertImage">
                        @else
                            <img height="30" width="30" class="img-thumbnail"
                                src="{{ asset('/stud_images/defaultuser.png') }}" alt="DefaultImage">
                        @endif  --}}
                    </td>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->email }}</td>
                    {{--  <td>{{ $list->mobile }}</td>  --}}
                    @if ($schoolname == null)
                        @if ($list->school_name != null)
                            <td>{{ $list->school_name }}</td>
                        @endif
                    @endif
                    <td>{{ $list->std }}</td>
                    {{--  @if ($schoolname != null)
                        <td>{{ $list->enrollDate }}</td>
                    @endif  --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
