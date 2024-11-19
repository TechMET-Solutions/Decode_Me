@extends('admin.layout.master')
@section('container')
    <style>
        thead th {
            background-color: #FFE235 !important;
            padding: 0 20px;
            {{--  color: white !important;  --}}
        }

        tbody td {
            background-color: #fff !important;
        }
    </style>
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <x-session-message />

                <div class="row" style="display: flex; justify-content: space-between;">
                    <div class="col-lg-8 col-sm-12">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Workshop List</p>
                    </div>

                    <div class="col-lg-1  col-sm-1 text-end">
                        <a href="{{ route('admin.addworkshop') }}" class="btn"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 20px; ">+Add
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class=" table-responsive mt-2 ">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Venue</th>
                                        <th>Seats</th>
                                        <th>Experts</th>
                                        <th style="text-align: center;">Attendance</th>
                                        <th style="text-align: end;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($workshop as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $data->topic }}</td>
                                            <td>{{ $data->start_date }}
                                            </td>
                                            <td>{{ $data->start_time_start_date }}
                                            </td>
                                            <td>
                                                {{ $data->end_time_start_date }}
                                            </td>
                                            <td>{{ $data->venue }}
                                            </td>
                                            <td>{{ $data->seats }}
                                            </td>
                                            @php
                                                $experts = json_decode($data->expert);
                                            @endphp
                                            <td>
                                                {{--  <ol>  --}}
                                                @foreach ($experts as $ex)
                                                    <li>{{ $ex }}</li>
                                                @endforeach
                                                {{--  </ol>  --}}
                                                {{--  {{ $data->experts }}  --}}
                                            </td>
                                            <td style="text-align: center;">
                                                @if ($data->start_date <= Date('Y-m-d'))
                                                    @if ($schoolCount == $attendanceCount)
                                                        <button type="button" class="btn no-boundary "
                                                            data-bs-toggle="modal" data-bs-target="#attendanceMessage"
                                                            style="background-color:#95949E !important;top-margin:5px !important;">Attendance</button>
                                                    @else
                                                        <a
                                                            href="{{ route('admin.attendance', ['id' => $data->id, 'date' => $data->start_date]) }}">
                                                            <button class="btn blue-color no-boundary mt-1"
                                                                style="background-color:#5dcbe3 !important; ">Attendance</button>
                                                        </a>
                                                    @endif
                                                @else
                                                    <button class="btn blue-color no-boundary mt-1"
                                                        style="background-color:#dedded !important; "
                                                        disabled>Attendance</button>
                                                @endif
                                            </td>
                                            <td style="text-align: end;">
                                                <a href="{{ route('admin.editworkshop', $data->id) }}">
                                                    <button class="btn btn-success green-color no-boundary mt-1"
                                                        style=""><i class="fas fa-pencil-alt"></i></button>
                                                </a>
                                                <a href=" {{ route('admin.deleteworkshop', $data->id) }} "
                                                    onclick="return confirm('Are you sure you want to delete this data?');"
                                                    class="btn btn-danger red-color mt-1"><i class="fas fa-trash"></i>
                                                </a>
                                                <a href="{{ route('admin.attendancelist', $data->id) }}" class="btn mt-2"
                                                    style="background: #71DC75;color:#fff;"><i
                                                        class="fa-solid fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                {{ $data->end_date }}</td>
                                            <td>
                                                {{ $data->start_time_end_date }}
                                            </td>
                                            <td>
                                                {{ $data->end_time_end_date }}
                                            </td>
                                            <td>
                                                {{ $data->venue }}
                                            </td>
                                            <td>
                                                {{ $data->seats }}</td>
                                            @php
                                                $experts = json_decode($data->expert);
                                            @endphp
                                            <td>
                                                {{--  <ol>  --}}
                                                @foreach ($experts as $ex2)
                                                    <li>{{ $ex2 }}</li>
                                                @endforeach
                                                {{--  </ol>  --}}
                                                {{--  {{ $data->experts }}  --}}
                                            </td>
                                            <td style="text-align: center;">
                                                @if ($data->end_date <= Date('Y-m-d'))
                                                    <br>
                                                    @if ($schoolCount == $attendanceCount)
                                                        <button type="button" class="btn no-boundary "
                                                            data-bs-toggle="modal" data-bs-target="#attendanceMessage"
                                                            style="background-color:#95949E !important;margin-top:-20px !important;">Attendance</button>
                                                    @else
                                                        <a
                                                            href="{{ route('admin.attendance', ['id' => $data->id, 'date' => $data->end_date]) }}">
                                                            <button class="btn blue-color no-boundary "
                                                                style="background-color:#5dcbe3 !important;
                                                                margin-top:-25px !important;">Attendance</button>
                                                        </a>
                                                    @endif
                                                @else
                                                    <button class="btn blue-color no-boundary "
                                                        style="background-color:#dedded !important; "
                                                        disabled>Attendance</button>
                                                @endif
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Attendance Message Modal -->
    <div class="modal fade" id="attendanceMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="attendanceMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #FFE235;">
                    <h5 class="modal-title" id="attendanceMessageLabel" style="text-align: center;">Attendance Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #FFFFF4;">
                    <div class="mt-4">
                        <p style="font-family:Rubik; font-size:28px;font-weight:500;color:green;">Todays Attendance Of All
                            Schools Already Conducted!!!!</p>
                        </P>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
