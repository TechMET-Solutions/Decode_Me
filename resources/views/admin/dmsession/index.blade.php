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
                    <div class="col-lg-5 col-sm-5">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">DM Sessions</p>
                    </div>
                    <div class="col-lg-3  col-sm-3 text-end">
                        <a href="{{ route('admin.todaysdmsession') }}" class="btn"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">Todays
                            DM Session
                        </a>
                    </div>
                    <div class="col-lg-2  col-sm-2 text-end">
                        <a href="{{ route('admin.dmtimeslot') }}" class="btn"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; "> Session
                            Time Slots
                        </a>
                        {{--  <button type="button" class="btn"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">
                            Session Time Slots
                        </button>  --}}
                    </div>
                    <div class="col-lg-2  col-sm-2 text-end ">
                        <a href="{{ route('admin.adddmsession') }}" class="btn"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">+Add DM
                            Session
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
                                        <th>Date</th>
                                        <th>Expert Name</th>
                                        <th style="width: 250px;">Session Times</th>
                                        <th>Mode</th>
                                        <th>Venue</th>
                                        <th>Current Status</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dms as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $data->date }}</td>
                                            <td>
                                                @foreach ($expert as $ex)
                                                    @if ($ex->id == $data->ex_id)
                                                        {{ $ex->name }}
                                                    @endif
                                                @endforeach
                                                {{--  {{ $data->ex_id }}  --}}
                                            </td>
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
                                            <td>{{ $data->mode }}</td>
                                            <td>{{ $data->venue }}</td>
                                            <td>
                                                @if ($data->date > date('Y-m-d'))
                                                    <button type="button" class="btn"
                                                        style="background: #007BFF;color:#fff;font-size:16px;">Allotted</button>
                                                @elseif($data->date < date('Y-m-d'))
                                                    <button type="button" class="btn"
                                                        style="background: #FC542D;color:#fff;font-size:16px;">Completed</button>
                                                @else
                                                    <button type="button" class="btn"
                                                        style="background: #FFA500;color:#fff;font-size:16px;">Todays</button>
                                                @endif
                                            </td>

                                            <td style="text-align: center;">
                                                @if ($data->date < date('Y-m-d'))
                                                    <a href="{{ route('admin.editdmsession', $data->id) }}">
                                                        <button class="btn btn-success green-color no-boundary mt-1"><i
                                                                class="fas fa-pencil-alt"></i></button>
                                                    </a>
                                                @endif

                                                <a href=" {{ route('admin.deletedmsession', $data->id) }} "
                                                    onclick="return confirm('Are you sure you want to delete this data?');"
                                                    class="btn btn-danger red-color mt-1"><i class="fas fa-trash"></i>
                                                </a>
                                            </td>
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
    <!--Add Career Modal -->
    <div class="modal fade " id="addSTimeModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Time Slot for DM Session</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.storetimeslot') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="slot" class="form-label">Time
                                <span class="text text-danger">*</span>
                            </label>
                            <input type="text" name="slot" placeholder="hh:mm am/pm to hh:mm am/pm"
                                class="form-control" id="slot" style="font-size:14px;color: #95949E;" required>
                        </div>
                        <div class="text text-center mt-2 ">
                            <button type="submit"
                                style="background:#EEC714;width: 100px;border-radius:10px; border:none; margin-top:10px;">
                                <p
                                    style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                    Save</p>
                            </button>
                            <button type="button"
                                style="background:rgb(150, 147, 147);width: 100px;border-radius:10px; border:none; margin-top:10px;"
                                data-bs-dismiss="modal">
                                <p
                                    style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                    Close</p>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
