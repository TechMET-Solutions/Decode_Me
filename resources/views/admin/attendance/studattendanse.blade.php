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
                    <div class="col-lg-6 col-sm-12">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">
                            <a href="{{ route('admin.workshop') }}"><i class='fas fa-arrow-left'
                                    style='font-size:42px'></i></a>&nbsp;&nbsp;Attendance List
                        </p>
                    </div>
                    <div class="col-lg-6 col-sm-12 text-end">
                        <p style="font-family: Rubik; font-size:32px; font-weight:450; color:green">Workshop
                            Name:{{ $workshop->topic }}</p>
                    </div>
                    <div class="col-lg-12 ">
                        <div class=" table-responsive mt-2 ">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>School Name</th>
                                        <th>{{ $workshop->start_date }}</th>
                                        <th>{{ $workshop->end_date }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($school as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $data->school_name }}</td>
                                            <td><a
                                                    href="{{ route('admin.showattendance', ['id' => $data->id, 'wid' => $workshop->id, 'date' => $workshop->start_date]) }}"><button
                                                        type="button" class="btn "
                                                        style="background:#FFE235;">Show</button></a></td>
                                            <td><a
                                                    href="{{ route('admin.showattendance', ['id' => $data->id, 'wid' => $workshop->id, 'date' => $workshop->end_date]) }}"><button
                                                        type="button" class="btn "
                                                        style="background:#FFE235;">Show</button></a></td>
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
@endsection
