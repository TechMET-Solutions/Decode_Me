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
    <table class="table table-bordered " style="margin-top: 50px;">
        <thead>
            <tr>
                <th>Task Name</th>
                <th>Assignment Date</th>
                {{--  <th>Submission Date</th>  --}}
                <th>Due Date</th>
                <th>Submission Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($task as $data)
                <tr>
                    <td>{{ $data->task->name }}</td>
                    <td>
                        {{ $data->created_at->format('Y-m-d') }}
                    </td>
                    {{--  <td>
                        {{ $data->updated_at->format('Y-m-d') }}
                    </td>  --}}
                    <td>
                        {{ $data->deadlineDate }}
                    </td>
                    <td>
                        @if ($data->status == '0')
                            <h5>Pending</h5>
                            {{--  <button type="button" class="btn"
                                                            style="background: #95949E;color:#fff;">Pending</button>  --}}
                        @elseif ($data->status == '1')
                            <h5>Submit</h5>
                            {{--  <button type="button" class="btn" data-bs-toggle="modal"
                                data-bs-target="#taskApprovalModal"
                                onclick="openTaskApprovalModal('individual','{{ $data->stud_id }}','{{ $data->schoolId }}','{{ $data->taskId }}','{{ $data->id }}')"
                                style="background: #007BFF;color:#fff;">Submit</button>  --}}
                        @elseif ($data->status == '2')
                            <h5>Resubmit</h5>

                            {{--  <button type="button" class="btn "
                                style="background: #FFA500 ;color:#fff;">Resubmit</button>  --}}
                        @elseif ($data->status == '3')
                            <h5>Overdue</h5>

                            {{--  <button type="button" class="btn"
                                style="background: #FC542D;color:#fff;">Overdue</button>  --}}
                        @elseif ($data->status == '4')
                            <h5>Approved</h5>

                            {{--  <button type="button" class="btn"
                                style="background: #71DC75;color:#fff;">Approved</button>  --}}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</body>

</html>
