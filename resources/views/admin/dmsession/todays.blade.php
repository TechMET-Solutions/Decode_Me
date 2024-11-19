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
                @if (!$dms->isEmpty())
                    <div class="row" style="display: flex; justify-content: space-between;">
                        <div class="col-lg-9 col-sm-9">
                            <p style="font-family: Rubik; font-size:34px; font-weight:500px; color:#000">Todays DM Sessions
                            </p>
                        </div>
                        <div class="col-lg-3  col-sm-3" style="text-align: center;">
                            <div style="border:solid 3px Black;border-radius:5px;width: 84%; height:80%;margin-left:32px;">
                                <p style="font-family: Rubik; font-size:25px;padding:10px 10px 0 15px;">
                                    {{ date(' j F, Y') }}&nbsp;&nbsp;<i class='fas fa-calendar-alt'
                                        style='font-size:23px'></i>
                                </p>
                            </div>
                        </div>
                        {{--  <div class="col-lg-1 col-sm-1">
                        <a href="{{ route('admin.dmsession') }}" class="btn"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">Back
                        </a>
                    </div>  --}}
                    </div>
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class=" table-responsive mt-2 ">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Expert Name</th>
                                            <th>Date</th>
                                            <th style="padding: 0 0 8px 40px;">Session Times</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dms as $data)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    @foreach ($expert as $ex)
                                                        @if ($ex->id == $data->ex_id)
                                                            {{ $ex->name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $data->date }}</td>
                                                @php
                                                    $time = json_decode($data->time);
                                                @endphp
                                                <td>
                                                    @if (!empty($time))
                                                        <ul>
                                                            @foreach ($time as $timel)
                                                                <li>{{ $timel }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </td>

                                                <td style="text-align: center;">

                                                    <a href="{{ route('admin.editdmsession', $data->id) }}">
                                                        <button class="btn btn-success green-color no-boundary mt-1"><i
                                                                class="fas fa-pencil-alt"></i></button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 text-end">
                            <a href="{{ route('admin.dmsession') }}" class="btn"
                                style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">Back
                            </a>
                        </div>
                    @else
                        <div>
                            <p style="font-family: Rubik; font-size:35px; font-weight:500; color:darkgreen;">No
                                DM Session Today
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
