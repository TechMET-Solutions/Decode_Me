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
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Attendance</p>
                    </div>
                    <div class="col-lg-3 col-sm-3 text-center">
                        <div style="border:solid 3px Black;border-radius:5px;width: 86%; height:80%;margin-left:32px;">
                            <p style="font-family: Rubik; font-size:25px;padding:10px 10px 0 15px;">
                                {{ $date }}&nbsp;&nbsp;<i class='fas fa-calendar-alt' style='font-size:23px'></i>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-2 col-sm-6">
                        <div>
                            <p style="font-family:Rubik; font-size:28px; font-weight:500;">Workshop Name:
                                {{ $workshop->topic }}</p>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-lg-4 text-end  col-sm-4">
                        <label for="school_id" class="form-label"
                            style="font-family:Rubik; font-size:22px; font-weight:500;">
                            Select School For Attendance <span class="text text-danger">*</span>
                        </label>
                        <select name="school_id" id="school_id" class="form-control" required
                            onchange="fetchStudents(this.value, true)">
                            <option><span style="font-size:18px;">Select School Name</span></option>
                            @foreach ($school as $list)
                                <option value="{{ $list->id }}" style="font-size: 18px;">
                                    <p style="font-family:Rubik; font-size:22px; font-weight:500;">
                                        {{ $list->school_name }}
                                    </p>
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-lg-6 mt-4 offset-lg-6 text-end">
                        <div class="form-group">
                            <form method="GET" action="javascript:void(0);">
                                <div class="input-group">
                                    <input class="form-control" type="text" id="search" name="search"
                                        placeholder="Search Student....."
                                        onkeyup="fetchStudents(document.getElementById('school_id').value, false)">
                                    <button type="submit" class="btn btn-primary"
                                        onclick="fetchStudents(document.getElementById('school_id').value, false)">Search</button>
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
                        <form action="{{ route('admin.storeattendance') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="date" name="date" value="{{ $date }}">
                            <input type="hidden" id="attendance" name="attendance">
                            <input type="hidden" id="workshop_id" value="{{ $workshop->id }}" name="workshop_id">
                            <input type="hidden" name="school_id" id="selected_school_id">
                            <button type="submit"
                                style="background:#EEC714;width: 140px;border-radius:10px; border:none; margin-top:10px;">
                                <p
                                    style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                    Submit</p>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        let student = @json($students);
        let attendance = {};

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

            let filteredStudents = student.filter(stud =>
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
                        <input class="form-check-input" style="width: 15px; height: 15px; transform: scale(1.5); -webkit-transform: scale(1.5);" type="checkbox" id="flexCheckDefault${stud.id}" onchange="updateAttendance(${stud.id}, this.checked)" ${attendance[stud.id] ? 'checked' : ''}>
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
    </script>
@endsection
