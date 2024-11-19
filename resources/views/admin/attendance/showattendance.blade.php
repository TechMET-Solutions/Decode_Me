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
                @if (!empty($attendance))
                    <div class="row" style="display: flex; justify-content: space-between;">
                        <div class="col-lg-6 col-sm-12">
                            <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">
                                @foreach ($school as $sch)
                                    @if ($sch->id == $attendance->school_id)
                                        <a href="{{ route('admin.attendancelist', $attendance->workshop_id) }}"><i
                                                class='fas fa-arrow-left'
                                                style='font-size:42px'></i></a>&nbsp;&nbsp;{{ $sch->school_name }}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <div class="col-lg-6 col-sm-12 text-end">
                            <p style="font-family: Rubik; font-size:32px; font-weight:450; color:green">
                                {{ $attendance->date }}</p>
                            <a href="{{ route('admin.editattendance', $attendance->id) }}" class="btn btn-success "
                                style="font-size:20px; color:#fff;">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a>
                        </div>
                        <div class="col-lg-12 ">
                            <div class=" table-responsive mt-2 ">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Student Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $attstuds = json_decode($attendance->attendance);
                                        @endphp
                                        @foreach ($attstuds as $student)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                @foreach ($students as $stud)
                                                    @if ($stud->id == $student)
                                                        <td> {{ $stud->name }}</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <h3>Attendance are not present</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
