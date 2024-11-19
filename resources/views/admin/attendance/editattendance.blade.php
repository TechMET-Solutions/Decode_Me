@extends('admin.layout.master')
@section('container')
    <style>
        thead th {
            background-color: #FFE235 !important;
            padding: 0 20px;
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
                    <div class="col-lg-9 col-sm-9">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Edit Attendance</p>
                    </div>
                    <div class="col-lg-3 col-sm-3 text-center">
                        <div style="border:solid 3px Black;border-radius:5px;width: 86%; height:80%;margin-left:32px;">
                            <p style="font-family: Rubik; font-size:25px;padding:10px 10px 0 15px;">
                                {{ $attendance->date }}&nbsp;&nbsp;<i class='fas fa-calendar-alt'
                                    style='font-size:23px'></i>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-2 col-sm-6">
                        <div>
                            <p style="font-family:Rubik; font-size:22px; font-weight:500;">Workshop Name:<br>
                                <span style="color:green;font-size:30px;">{{ $attendance->workshop_name }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-lg-4 text-end col-sm-4">
                        <p style="font-family:Rubik; font-size:22px; font-weight:500;">School Name:<br>
                            <span style="color:green;font-size:30px;">{{ $attendance->school_name }}</span>
                        </p>
                    </div>
                </div>
                {{--  <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive mt-2">
                            <form action="{{ route('admin.updateattendance', $attendance->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="date" name="date" value="{{ $attendance->date }}">
                                <input type="hidden" id="workshop_id" value="{{ $attendance->workshop_id }}"
                                    name="workshop_id">
                                <input type="hidden" name="school_id" value="{{ $attendance->school_id }}">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Student Name</th>
                                            <th>Email ID</th>
                                            <th>Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $studattArray = json_decode($attendance->attendance);
                                            if (!is_array($studattArray)) {
                                                $studattArray = [];
                                            }
                                        @endphp
                                        @foreach ($students as $stud)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $stud->name }}</td>
                                                <td>{{ $stud->email }}</td>
                                                <td>
                                                    <input type="checkbox" name="attendance[]"
                                                        style="width: 15px; height: 15px; transform: scale(1.5); -webkit-transform: scale(1.5);"
                                                        value="{{ $stud->id }}"
                                                        {{ in_array($stud->id, $studattArray) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="col-12 text-center">
                                    <button type="submit"
                                        style="background:#EEC714;width: 140px;border-radius:10px; border:none; margin-top:10px;">
                                        <p
                                            style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                            Update
                                        </p>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>  --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table mt-2">
                            <form action="{{ route('admin.updateattendance', $attendance->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="date" name="date" value="{{ $attendance->date }}">
                                <input type="hidden" id="workshop_id" value="{{ $attendance->workshop_id }}"
                                    name="workshop_id">
                                <input type="hidden" name="school_id" value="{{ $attendance->school_id }}">

                                <!-- Search Input -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 offset-lg-6 text-end">
                                            <label for="search" style="font-size:22px; font-weight:500;">Search
                                                Student:</label>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <input type="text" class="form-control" id="search" name="search"
                                                placeholder="Enter student name">
                                        </div>
                                    </div>
                                </div>
                                <table class="table mt-2">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Student Name</th>
                                            <th>Email ID</th>
                                            <th>Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $studattArray = json_decode($attendance->attendance);
                                            if (!is_array($studattArray)) {
                                                $studattArray = [];
                                            }
                                        @endphp
                                        @foreach ($students as $stud)
                                            <tr class="student-row">
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $stud->name }}</td>
                                                <td>{{ $stud->email }}</td>
                                                <td>
                                                    <input type="checkbox" name="attendance[]"
                                                        style="width: 15px; height: 15px; transform: scale(1.5); -webkit-transform: scale(1.5);"
                                                        value="{{ $stud->id }}"
                                                        {{ in_array($stud->id, $studattArray) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="col-12 text-center">
                                    <button type="submit"
                                        style="background:#EEC714;width: 140px;border-radius:10px; border:none; margin-top:10px;">
                                        <p
                                            style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                            Update
                                        </p>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('search').addEventListener('input', function() {
                var searchText = this.value.toLowerCase();
                var rows = document.getElementsByClassName('student-row');

                for (var i = 0; i < rows.length; i++) {
                    var studentName = rows[i].getElementsByTagName('td')[1].innerText.toLowerCase();
                    if (studentName.includes(searchText)) {
                        rows[i].style.display = ''; // show the row if the search text matches
                    } else {
                        rows[i].style.display = 'none'; // hide the row if it doesn't match
                    }
                }
            });
        });
    </script>
@endsection

{{--  @extends('admin.layout.master')
@section('container')
    <style>
        thead th {
            background-color: #FFE235 !important;
            padding: 0 20px;
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
                    <div class="col-lg-9 col-sm-9">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Edit Attendance</p>
                    </div>
                    <div class="col-lg-3 col-sm-3 text-center">
                        <div style="border:solid 3px Black;border-radius:5px;width: 86%; height:80%;margin-left:32px;">
                            <p style="font-family: Rubik; font-size:25px;padding:10px 10px 0 15px;">
                                {{ $attendance->date }}&nbsp;&nbsp;<i class='fas fa-calendar-alt'
                                    style='font-size:23px'></i>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-2 col-sm-6">
                        <div>
                            <p style="font-family:Rubik; font-size:28px; font-weight:500;">Workshop Name:
                                {{ $attendance->workshop_name }}</p>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-lg-4 text-end col-sm-4">
                        <p style="font-family:Rubik; font-size:28px; font-weight:500;">School Name:
                            {{ $attendance->school_name }}</p>
                    </div>
                    <div class="col-sm-6 col-lg-6 mt-4 offset-lg-6 text-end">
                        <div class="form-group">
                            <form method="GET" action="javascript:void(0);">
                                <div class="input-group">
                                    <input class="form-control" type="text" id="search" name="search"
                                        placeholder="Search Student....."
                                        onkeyup="fetchStudents({{ $attendance->school_id }}, false)">
                                    <button type="submit" class="btn btn-primary"
                                        onclick="fetchStudents({{ $attendance->school_id }}, false)">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive mt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Student Name</th>
                                        <th>Email ID</th>
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody id="studentTable">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <form action="{{ route('admin.updateattendance', $attendance->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="date" name="date" value="{{ $attendance->date }}">
                            <input type="hidden" id="attendance" name="attendance">
                            <input type="hidden" id="workshop_id" value="{{ $attendance->workshop_id }}"
                                name="workshop_id">
                            <input type="hidden" name="school_id" id="selected_school_id"
                                value="{{ $attendance->school_id }}">
                            <button type="submit"
                                style="background:#EEC714;width: 140px;border-radius:10px; border:none; margin-top:10px;">
                                <p
                                    style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                    Update</p>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let students = @json($students);
        let attendance = {};

        @if (is_array($attendance->attendance))
            @foreach ($attendance->attendance as $stud)
                attendance[{{ $stud['id'] }}] = true;
            @endforeach
        @else
            console.log('Attendance is not an array', {{ json_encode($attendance->attendance) }});
        @endif

        function updateAttendance(studentId, isChecked) {
            if (isChecked) {
                attendance[studentId] = true;
                document.getElementById('row' + studentId).style.cssText = 'background-color: lightgray;';
            } else {
                delete attendance[studentId];
                document.getElementById('row' + studentId).style.cssText = '';
            }
            let valuesArray = Object.keys(attendance);
            document.getElementById('attendance').value = JSON.stringify(valuesArray);
        }

        function fetchStudents(schoolId, isSchoolChanged) {
            let searchQuery = document.getElementById('search').value.toLowerCase();
            document.getElementById('selected_school_id').value = schoolId;

            if (isSchoolChanged) {
                attendance = {}; // Clear old attendance records
            }

            while (studentTable.firstChild) {
                studentTable.removeChild(studentTable.firstChild);
            }

            let filteredStudents = students.filter(stud =>
                stud.school_id == schoolId &&
                (stud.name.toLowerCase().includes(searchQuery) || stud.email.toLowerCase().includes(searchQuery))
            );

            filteredStudents.forEach((stud, index) => {
                const row = `
                <tr id="row${stud.id}" ${attendance[stud.id] ? 'style="background-color: lightgray;"' : ''}>
                    <td>${index + 1}</td>
                    <td onclick="toggleAttendance(${stud.id})">${stud.name}</td>
                    <td>${stud.email}</td>
                    <td>
                        <input class="form-check-input" type="checkbox" id="flexCheckDefault${stud.id}" onchange="updateAttendance(${stud.id}, this.checked)" ${attendance[stud.id] ? 'checked' : ''}>
                    </td>
                </tr>
                `;
                studentTable.insertAdjacentHTML('beforeend', row);
            });
        }

        function toggleAttendance(studentId) {
            const checkbox = document.getElementById('flexCheckDefault' + studentId);
            checkbox.checked = !checkbox.checked;
            updateAttendance(studentId, checkbox.checked);
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchStudents({{ $attendance->school_id }}, false);
        });
    </script>
@endsection  --}}
