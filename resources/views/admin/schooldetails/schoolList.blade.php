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
                    <div class="col-lg-10 col-sm-10">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">School List</p>
                    </div>
                    {{-- <div class="col-lg-1  col-sm-1 ">
                        <a href="{{ route('admin.addschool') }}" class="btn"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">+Add
                        </a>
                    </div> --}}
                    <div class="col-lg-2  col-sm-2 text-end mt-4">
                        <a href="{{ route('generateSchoolPDF') }}" style="margin-right: 7px;">
                            <i class='fa-solid fa-file-arrow-down'
                                style='font-size:41px;color:green;margin-bottom: -10px;'></i>
                        </a>
                        <a href="{{ route('admin.addschool') }}" class="btn"
                            style="background: #FFE235;
                        font-size:18px; ">+Add
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
                                        <th>Code</th>
                                        <th>Place</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schoolDetail as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $data->school_name }}</td>
                                            <td>{{ $data->school_code }}</td>
                                            <td>{{ $data->school_place }}</td>
                                            <td style="text-align: center;">
                                                @if ($data->status == 0)
                                                    <a href="{{ route('admin.schoolstatus', $data->id) }}">

                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                            height="32" fill="currentColor"
                                                            class="bi bi-check-circle-fill " viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                        </svg>
                                                    </a>
                                                @elseif($data->status == 1)
                                                    <a href="{{ route('admin.schoolstatus', $data->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                            height="32" fill="#d26d69" class="bi bi-x-circle-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                                                        </svg>

                                                    </a>
                                                @endif

                                            </td>

                                            <td style="text-align: center;">
                                                <a href="{{ route('admin.editschool', $data->id) }}">
                                                    <button class="btn btn-success green-color no-boundary mt-1"><i
                                                            class="fas fa-pencil-alt"></i></button>
                                                </a>

                                                <a href="{{ route('admin.schooldelete', $data->id) }}"
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
