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
                    <div class="col-lg-11 col-sm-11">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Company List</p>
                    </div>
                    <div class="col-lg-1  col-sm-1 ">
                        <a href="{{ route('admin.addinternship') }}" class="btn"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">+Add
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
                                        <th>Company Name</th>
                                        <th>Link</th>
                                        <th>Field Name</th>
                                        <th>Venue</th>
                                        <th>Mode</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($internship as $data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            <td>{{ $data->company_name }}</td>
                                            <td>{{ $data->link }}</td>
                                            <td>{{ $data->field_name }}</td>
                                            <td>{{ $data->venue }}</td>
                                            <td>{{ $data->mode }}</td>
                                            <td>{{ $data->start_date }}</td>
                                            <td>{{ $data->end_date }}</td>
                                            <td>{{ $data->time }}</td>
                                            <td>
                                                <a href="{{ route('admin.editinternship', $data->id) }}">
                                                    <button class="btn btn-success green-color no-boundary mt-1"><i
                                                            class="fas fa-pencil-alt"></i></button>
                                                </a>

                                                <a href="{{ route('admin.deleteinternship', $data->id) }}"
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
@endsection
