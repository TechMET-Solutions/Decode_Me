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

                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Student List</p>
                    </div>
                    <div class="col-lg-4 col-sm-12 mt-2">
                        <div class="row">
                            <div class="col-3">
                                <label for="school_id" class="form-label"
                                    style="font-family:Rubik; font-size:24px; font-weight:500;">
                                    School:
                                </label>
                            </div>
                            <div class="col-8">
                                <form id="schoolForm" method="GET" action="{{ route('admin.studentlist') }}">
                                    <select name="school_id" id="school_id" class="form-control"
                                        onchange="document.getElementById('schoolForm').submit()">
                                        <option value=""><span style="font-size:18px;">Select School</span></option>
                                        @foreach ($schools as $list)
                                            <option value="{{ $list->id }}" style="font-size: 18px;"
                                                {{ request('school_id') == $list->id ? 'selected' : '' }}>
                                                {{ $list->school_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                            <div class="col-1 ">
                                <a href="{{ route('generateStudentPDF', ['school_id' => request('school_id')]) }}"
                                    style="margin-left: -18px;">
                                    <i class='fa-solid fa-file-arrow-down'
                                        style='font-size: 41px; color: green; margin-bottom: -10px;'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 mt-2">
                        <div class="form-group">
                            <form>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="search" name="search"
                                        placeholder="Search Student.....">
                                    <button type="button" class="btn btn-primary"
                                        onclick="filterStudents()">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-12 mt-2">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addExcel">Upload
                            Excel</button>

                        <a href="{{ route('admin.studentlist', 'latest') }}">
                            <button class="btn btn-warning" style="background: #FFE235;
                        ">Newest <i
                                    class='fas fa-caret-down'></i></button>
                        </a>
                        <a href="{{ route('admin.addstudent') }}">
                            <button class="btn btn-warning" style="background: #FFE235;
                        ">+ New
                                Student </button>
                        </a>
                    </div>
                    <div class="col-lg-12 ">
                        <div class=" table-responsive mt-2">
                            <table class="table " style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6);">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Student Name</th>
                                        <th>Contact</th>
                                        <th>Grade</th>
                                        <th>Expert</th>
                                        <th>Current Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="studentTableBody">
                                    @foreach ($studentDetail as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <img src="{{ asset($data->profile ? 'stud_images/' . $data->profile : 'stud_images/DefaultUserimg.png') }}"
                                                    alt="student_image" class="rounded-circle" width="35"
                                                    height="35">&nbsp;
                                                {{--  <img src="{{ asset('stud_images/' . $data->profile) }}" alt="student_image"
                                                    class="rounded-circle" width="35" height="35">&nbsp;  --}}
                                                <a href="{{ route('admin.showstudent', $data->id) }}"
                                                    style="font-size:18px; font-weight:600; text-decoration:underline;">
                                                    {{ $data->name }}</a>


                                            </td>
                                            <td>
                                                <a href="tel:{{ $data->mobile }}" class="rounded-circle"><i
                                                        class="fa-solid fa-phone"
                                                        style="margin: 2px;font-size:24px;"></i></a>
                                                &nbsp;
                                                <a href="mailto:{{ $data->email }}" class="rounded-circle" width="40%"
                                                    height="40%"><i class="fa-solid fa-envelope"
                                                        style="margin: 2px;font-size:26px;"></i></a>
                                            </td>

                                            <td>
                                                @switch($data->std)
                                                    @case('8th')
                                                        <span
                                                            style="background-color: #ff8000; color: #fff;padding:0 12px; border-radius: 6px;">VIII</span>
                                                    @break

                                                    @case('9th')
                                                        <span
                                                            style="background-color: #0080ff; color: #fff;padding:0 12px; border-radius: 6px;">IX</span>
                                                    @break

                                                    @case('10th')
                                                        <span
                                                            style="background-color: #00ff00; color: #fff;padding:0 12px; border-radius: 6px;">X</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                @if ($data->expert == null)
                                                    <button data-bs-toggle="modal"
                                                        onclick="getStudentId('{{ $data->id }}')"
                                                        data-bs-target="#staticBackdrop"
                                                        style="border:none; border-radius:10px; background:lightgrey;">
                                                        <i class='fas fa-plus-circle'></i>&nbsp;Expert</button>
                                                @else
                                                    {{ $data->expert }}
                                                @endif
                                            </td>
                                            <td>{{ $data->current_status }}</td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#viewStudentModal"
                                                    onclick="getStudentData('{{ $data->id }}','{{ $data->name }}','{{ $data->profile }}')"
                                                    style="font-size:18px; font-weight:600; text-decoration:underline;">
                                                    <i class="fa-solid fa-eye"></i></a>
                                                <a href="{{ route('admin.editstudent', $data->id) }}">
                                                    <button class="btn btn-success green-color no-boundary mt-1"><i
                                                            class="fas fa-pencil-alt"></i></button>
                                                </a>
                                                <a href="{{ route('studtaskreport', $data->id) }}"><i
                                                        class='fas fa-download'
                                                        style='font-size:35px;margin-bottom:-12px;'></i></a>
                                                <a href="{{ route('studentreportcard', $data->id) }}"><i
                                                        class="fa-solid fa-file-arrow-down "
                                                        style="font-size: 37px;margin-bottom:-12px;"></i></a>

                                                <a href="{{ route('admin.studentcareeroptions', $data->id) }}"
                                                    class="btn  mt-1" style="background: #FD5E3A;color:#FFF;">
                                                    &nbsp;Career Option
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{--  <div class="d-flex justify-content-center">
                            {{ $studentDetail->links() }}
                        </div>  --}}
                        <div class="d-flex justify-content-end">
                            {{ $studentDetail->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Assign Expert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.storeexpert_instudent') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="stud_id" id="stud_id">
                        <div class="mb-3">
                            <label for="expert" class="form-label">Expert Name<span class="text text-danger">*
                                </span>
                            </label>
                            <select name="expert" id="expert" class="form-control" required>
                                <option>Select Expert </option>
                                @foreach ($expert as $list)
                                    <option value="{{ $list->name }}">{{ $list->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn " style="background: #FFE235;">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Add Student Excel Sheet Modal -->
    <div class="modal fade" id="addExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Students List</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('importExcel') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="schoolId" class="form-label">School
                                <span class="text text-danger">*</span>
                            </label>
                            <select name="schoolId" id="schoolId" class="form-control" required>
                                <option>Select School</option>
                                @foreach ($schools as $data)
                                    <option value="{{ $data->id }}">{{ $data->school_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="file" name="import_file" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Import</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Student Details Model --}}
    <div class="modal fade modal-lg" id="viewStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #FFE235; height:100% !important;">
                    <div style="height: 80px;"></div>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        {{--  <img id="student_photo" alt="student_image" class="rounded-circle" width="160"
                            height="160" style="margin-left:50px;margin-top:-50px; border:5px solid #fff ;"
                            >  --}}
                        <img id="student_photo" alt="student_image" class="rounded-circle" width="160"
                            height="160" style="margin-left:50px;margin-top:-50px; border:5px solid #fff;"
                            onerror="this.onerror=null; this.src='{{ asset('stud_images/DefaultUserimg.png') }}';">

                        <p>
                        <div
                            style="margin-left:65px;font-family: Rubik; font-size:30px; font-weight:500;margin-top:-10px;">
                            <p id="student_name"></p>
                        </div>
                        </p>
                    </div>
                    <button type="button" class="btn-close btn-dark" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col-lg-6 col-sm-12">
                                <div class="container">
                                    <div class="row custom-margin mt-2">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-graduation-cap"
                                                style="font-size:25px; margin:12px 3px 0 0; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Student Wants</p>
                                            <p
                                                style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                            <div>
                                                <p id="studWant"></p>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row custom-margin mt-2">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">

                                            <i class="fa-solid fa-graduation-cap"
                                                style="font-size:25px; margin:12px 3px 0 0; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Father Wants</p>
                                            <p
                                                style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                            <div>
                                                <p id="fatherWant"></p>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row custom-margin mt-2">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-graduation-cap"
                                                style="font-size:25px; margin:12px 2px 0 2px; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Other Info</p>
                                            <p
                                                style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                            <div>
                                                <p id="otherInfo"></p>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row custom-margin mt-2">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-graduation-cap"
                                                style="font-size:25px; margin:12px 2px 0 2px; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Outcome</p>
                                            <p
                                                style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                            <div>
                                                <p id="outcome"></p>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row custom-margin mt-2">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-graduation-cap"
                                                style="font-size:25px; margin:12px 2px 0 2px; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Father Occupation</p>
                                            <p
                                                style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                            <div>
                                                <p id="fatherOccupation"></p>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 ">
                                <div class="container">
                                    <div class="row custom-margin mt-2">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">

                                            <i class="fa-solid fa-graduation-cap"
                                                style="font-size:25px; margin:12px 3px 0 0; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Student Dream</p>
                                            <p
                                                style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                            <div>
                                                <p id="studDream"></p>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row custom-margin mt-2">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">

                                            <i class="fa-solid fa-graduation-cap"
                                                style="font-size:25px; margin:12px 3px 0 0; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Mother Wants</p>
                                            <p
                                                style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                            <div>
                                                <p id="motherWant"></p>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row custom-margin mt-2">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">

                                            <i class="fa-solid fa-graduation-cap"
                                                style="font-size:25px; margin:12px 2px 0 0px; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Family Income</p>
                                            <p
                                                style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                            <div>
                                                <p id="familyIncome"></p>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row custom-margin mt-2">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">

                                            <i class="fa-solid fa-graduation-cap"
                                                style="font-size:25px; margin:12px 2px 0 0px; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Beyond Academics</p>
                                            <p
                                                style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                            <div>
                                                <p id="doAcademic"></p>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row custom-margin mt-2">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-graduation-cap"
                                                style="font-size:25px; margin:12px 2px 0 0px; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Mother Occupation</p>
                                            <p
                                                style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                            <div>
                                                <p id="motherOccupation"></p>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var studData = @json($students);
        // console.log(studData);

        function getStudentId(id) {
            document.getElementById('stud_id').value = id;
        }

        function getStudentId(id) {
            document.getElementById('stud_id').value = id;
        }

        document.getElementById('search').addEventListener('input', function() {
            filterStudents();
        });

        function filterStudents() {
            var filter = document.getElementById('search').value.toLowerCase();
            var rows = document.querySelectorAll('#studentTableBody tr');

            rows.forEach(function(row) {
                var studentName = row.querySelector('td:nth-child(2) a').textContent.toLowerCase();
                if (studentName.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function getStudentData(id, name, profile) {
            let stud = studData.find(p => p.studId == id);
            document.getElementById('student_name').innerHTML = '';
            document.getElementById('studWant').innerHTML = '';
            document.getElementById('fatherWant').innerHTML = '';
            document.getElementById('motherWant').innerHTML = '';
            document.getElementById('otherInfo').innerHTML = '';
            document.getElementById('outcome').innerHTML = '';
            document.getElementById('studDream').innerHTML = '';
            document.getElementById('familyIncome').innerHTML = '';
            document.getElementById('doAcademic').innerHTML = '';
            document.getElementById('fatherOccupation').innerHTML = '';
            document.getElementById('motherOccupation').innerHTML = '';
            var studImage = document.getElementById('student_photo');
            studImage.src = '{{ asset('stud_images/DefaultUserimg.png') }}';

            document.getElementById('student_name').innerHTML = stud.stud_name;
            document.getElementById('studWant').innerHTML = stud.studWant;
            document.getElementById('fatherWant').innerHTML = stud.fathWant;
            document.getElementById('motherWant').innerHTML = stud.mothWant;
            document.getElementById('otherInfo').innerHTML = stud.otherInfo;
            document.getElementById('outcome').innerHTML = stud.outcome;
            document.getElementById('studDream').innerHTML = stud.studDream;
            document.getElementById('familyIncome').innerHTML = stud.familyIncome;
            document.getElementById('doAcademic').innerHTML = stud.doAcademic;
            document.getElementById('fatherOccupation').innerHTML = stud.fatherOccupation;
            document.getElementById('motherOccupation').innerHTML = stud.motherOccupation;
            studImage.src = '{{ asset('stud_images') }}/' + profile;
            if (profile) {
                studImage.src = '{{ asset('stud_images') }}/' + profile;
            } else {
                // Set default image if profile is null or empty
                studImage.src = '{{ asset('stud_images/DefaultUserimg.png') }}';
            }
        }
    </script>
@endsection
