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
                    <div class="col-lg-6 col-sm-6">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Task</p>
                    </div>

                    <div class="col-lg-2 col-sm-6  text-end ">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addTaskModal"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">
                            <i class='fas fa-plus' style='font-size:18px'></i>&nbsp;&nbsp;Add task
                        </button>
                    </div>
                    <div class="col-lg-2 col-sm-6 text-end">
                        <div class="mb-3">
                            <button type="button" class="btn" data-bs-toggle="modal"
                                data-bs-target="#AssignIndividualTaskModal"
                                style="background: #FFE235;font-size:18px;margin-top: 10px; ">
                                <i class='fas fa-plus' style='font-size:18px'></i>&nbsp;&nbsp;Assign Individual Task
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 text-end">
                        <div class="mb-3">
                            <button type="button" class="btn" data-bs-toggle="modal"
                                data-bs-target="#AssignGroupTaskModal"
                                style="background: #FFE235;font-size:18px;margin-top: 10px; ">
                                <i class='fas fa-plus' style='font-size:18px'></i>&nbsp;&nbsp;Assign Group Task
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">

                        <div class=" table-responsive mt-2 ">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Id</th>
                                        <th style="text-align: center;">Name</th>
                                        <th style="text-align: center;">Type</th>
                                        <th>Questions</th>
                                        <th style="text-align: end;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($task as $data)
                                        <tr>
                                            <td style="text-align: center;">{{ $loop->index + 1 }}</td>
                                            <td style="text-align: center;">{{ $data->name }}</td>
                                            <td style="text-align: center;">{{ $data->type }}</td>
                                            <td>{!! $data->desc !!}</td>
                                            <td style="text-align: end;">

                                                <button class="btn btn-success green-color no-boundary mt-1"
                                                    data-bs-toggle="modal" onclick="getTaskData('{{ $data->id }}')"
                                                    data-bs-target="#EditTaskModal"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                <a href="{{ route('admin.taskDelete', $data->id) }}"
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

    <!--Add Task Modal -->
    <div class="modal fade " id="addTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.storeTask') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name
                                <span class="text text-danger">*</span>
                            </label>
                            <input type="text" name="name" placeholder="Enter Task Name" class="form-control"
                                id="name" style="font-size:14px;color: #95949E;" required>
                        </div>
                        @php
                            $taskTypes = ['Individual', 'Group'];
                        @endphp
                        <div class="mb-3">
                            <label for="type" class="form-label">Task Type
                                <span class="text text-danger">*</span>
                            </label>
                            <select class="form-control" name="type" id="type" required>
                                <option value="">Select Task Type</option>
                                @foreach ($taskTypes as $tts)
                                    <option value="{{ $tts }}">{{ $tts }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description<span
                                    class="text text-danger">*</span></label>
                            <textarea name="desc" id="summernote" cols="30" rows="10" required></textarea>
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

    <!--Edit Task Modal -->
    <div class="modal fade " id="EditTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Task </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updateTask') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="task_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name
                                <span class="text text-danger">*</span>
                            </label>
                            <input type="text" name="name" placeholder="Enter Task Name" class="form-control"
                                id="task_name" style="font-size:14px;color: #95949E;" required>
                        </div>
                        @php
                            $taskType = ['Individual', 'Group'];
                        @endphp
                        <div class="mb-3">
                            <label for="type" class="form-label">Task Type
                                <span class="text text-danger">*</span>
                            </label>
                            <select class="form-control" name="type" id="task_type" required>
                                <option value="">Select Task Type</option>
                                @foreach ($taskType as $ts)
                                    <option value="{{ $ts }}">
                                        {{ $ts }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description<span
                                    class="text text-danger">*</span></label>
                            <textarea name="desc" id="summernote2" cols="30" rows="10"></textarea>
                        </div>

                        <div class="text text-center mt-2 ">
                            <button type="submit"
                                style="background:#EEC714;width: 110px;border-radius:10px; border:none; margin-top:10px;">
                                <p
                                    style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                    Update</p>
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


    <!--Assign  Individual Task to Student Modal -->
    <div class="modal fade " id="AssignIndividualTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Individual Task to Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.storeIndividualTask') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{--  <input type="hidden" name="id" id="task_id">  --}}
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="taskID" class="form-label">Task
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select name="taskID" onchange="getIndiTaskData(this.value)" class="form-control"
                                        required>
                                        <option value="">Select Task</option>
                                        @foreach ($intask as $list)
                                            <option value="{{ $list->id }}">{{ $list->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="deadlineDate" class="form-label">Deadline Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="deadlineDate" placeholder="Enter Dateline Date"
                                        class="form-control" id="deadlineDate" style="font-size:14px;color: #95949E;"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="studId" class="form-label">School
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select name="schoolId" id="schoolId" class="form-control" required>
                                        <option value="">Select School</option>
                                        @foreach ($school as $slist)
                                            <option value="{{ $slist->id }}">{{ $slist->school_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="deadlineTime" class="form-label">Deadline Time
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="time" name="deadlineTime" placeholder="hh:mm AM/PM"
                                        class="form-control" id="deadlineTime" style="font-size:14px;color: #95949E;"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="studId" class="form-label">Student
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select name="studId" id="studId" class="form-control" required>
                                        {{--  <select name="studId" id="studId" class="form-control" required>  --}}
                                        <option value="">Select Student</option>
                                        {{--  @foreach ($stud as $stud)
                                            <option value="{{ $stud->id }}">{{ $stud->stud_name }}</option>
                                        @endforeach  --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description<span
                                    class="text text-danger">*</span></label>
                            <textarea name="desc" id="summernote3" cols="30" rows="10"></textarea>
                        </div>

                        <div class="text text-center mt-2 ">
                            <button type="submit"
                                style="background:#EEC714;width: 120px;border-radius:10px; border:none; margin-top:10px;">
                                <p
                                    style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                    Submit</p>
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

    <!--Assign Group Task to Students Modal -->
    <div class="modal fade " id="AssignGroupTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Group Task to Students</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.storeGroupTask') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{--  <input type="hidden" name="id" id="task_id">  --}}
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="taskID" class="form-label">Task
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select name="taskID" onchange="getGroupTaskData(this.value)" class="form-control"
                                        required>
                                        <option value="">Select Task</option>
                                        @foreach ($grtask as $list)
                                            <option value="{{ $list->id }}">{{ $list->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="deadlineDate" class="form-label">Deadline Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="deadlineDate" placeholder="Enter Dateline Date"
                                        class="form-control" id="deadlineDate" style="font-size:14px;color: #95949E;"
                                        required>
                                </div>
                            </div>
                            {{-- <div class="col-6">
                                <div class="mb-3">
                                    <label for="studId" class="form-label">School
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select name="school_Id" id="school_Id" class="form-control" required>
                                        <option value="">Select School</option>
                                        @foreach ($sch as $schlist)
                                            <option value="{{ $schlist->id }}">{{ $schlist->school_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="studId" class="form-label">School
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select name="school_Id" id="school_Id" class="form-control" required>
                                        <option value="">Select School</option>
                                        @foreach ($sch as $schlist)
                                            <option value="{{ $schlist->id }}">{{ $schlist->school_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="deadlineTime" class="form-label">Deadline Time
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="time" name="deadlineTime" placeholder="hh:mm AM/PM"
                                        class="form-control" id="deadlineTime" style="font-size:14px;color: #95949E;"
                                        required>
                                </div>
                            </div>
                            {{-- <div class="col-6">
                                <div class="mb-3">
                                    <label for="studIds" class="form-label">Select Multiple Students for Group Task
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select name="studIds[]" id="studIds" multiple="multiple" class="form-control"
                                        required style="height: 100px;">
                                        <option value="">Select Multiple Student</option>
                                        @foreach ($student as $studlist)
                                            <option value="{{ $studlist->id }}"
                                                data-schoolid="{{ $studlist->school_id }}">{{ $studlist->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-6">
                                {{--  <div class="mb-3">
                                    <label for="studIds" class="form-label">Select Multiple Students for Group Task
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" id="search" class="search-box form-control"
                                        placeholder="Search for students..." />
                                    <select name="studIds[]" id="studIds" multiple="multiple" class="form-control"
                                        required style="height: 100px;">
                                        <option value="">Select Multiple Students</option>
                                        @foreach ($student as $studlist)
                                            <option value="{{ $studlist->id }}"
                                                data-schoolid="{{ $studlist->school_id }}">{{ $studlist->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>  --}}
                                <div class="mb-3">
                                    <label for="studIds" class="form-label">Select Multiple Students for Group Task
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" id="search" class="search-box form-control"
                                        placeholder="Search for students..." />
                                    <select name="studIds[]" id="studIds" multiple="multiple" class="form-control"
                                        required style="height: 100px;">
                                        <option value="">Select Multiple Students</option>
                                        @foreach ($student as $studlist)
                                            <option value="{{ $studlist->id }}"
                                                data-schoolid="{{ $studlist->school_id }}">{{ $studlist->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description<span
                                    class="text text-danger">*</span></label>
                            <textarea name="desc" id="summernote4" cols="30" rows="10"></textarea>
                        </div>

                        <div class="text text-center mt-2 ">
                            <button type="submit"
                                style="background:#EEC714;width: 120px;border-radius:10px; border:none; margin-top:10px;">
                                <p
                                    style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                    Submit</p>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var taskData = @json($task);
        var itasks = @json($intask);
        var tasks = @json($grtask);
        var stud = @json($student);
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,
                focus: true
            });
        });

        $(document).ready(function() {
            $('#summernote2').summernote({
                height: 200,
                focus: true
            });
        });
        $(document).ready(function() {
            $('#summernote3').summernote({
                height: 200,
                focus: true
            });
        });
        $(document).ready(function() {
            $('#summernote4').summernote({
                height: 200,
                focus: true
            });
        });

        function getTaskData(id) {
            let task = taskData.find(t => t.id == id);
            if (task) {
                document.getElementById('task_id').value = task.id;
                document.getElementById('task_name').value = task.name;
                document.getElementById('task_type').value = task.type;
                setSummerNote(task.desc);
                //console.log( task.type);
            }
        }

        function setSummerNote(content) {
            $('#summernote2').summernote('code', content);
        }

        document.getElementById('schoolId').addEventListener('change', function() {
            var schoolId = this.value;
            var studentDropdown = document.getElementById('studId');
            studentDropdown.innerHTML = '<option>Select Student</option>';

            stud.forEach(student => {
                if (student.school_id == schoolId) {
                    const option = document.createElement('option');
                    option.value = student.id;
                    option.textContent = student.name;
                    studentDropdown.appendChild(option);
                }
            });
        });

        $(document).ready(function() {
            $('#school_Id').change(function() {
                var selectedSchoolId = $(this).val();
                $('#studIds option').each(function() {
                    if ($(this).data('schoolid') == selectedSchoolId || selectedSchoolId === '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $('#search').on('keyup', function() {
                var searchTerm = this.value.toLowerCase();
                var selectedSchoolId = $('#school_Id').val();
                $('#studIds option').each(function() {
                    var optionText = $(this).text().toLowerCase();
                    var isSchoolMatched = ($(this).data('schoolid') == selectedSchoolId ||
                        selectedSchoolId === '');
                    if (optionText.includes(searchTerm) && isSchoolMatched) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });


        function getIndiTaskData(id) {
            var selectedITask = itasks.find(task => task.id == id);
            var desc = selectedITask ? selectedITask.desc : '';
            //console.log(desc);
            setSummerNote2(desc);

        }

        function setSummerNote2(content) {
            $('#summernote3').summernote('code', content);
        }

        function getGroupTaskData(id) {
            var selectedTask = tasks.find(task => task.id == id);
            var desc = selectedTask ? selectedTask.desc : '';
            //console.log(desc);
            setSummerNote3(desc);

        }

        function setSummerNote3(content) {
            $('#summernote4').summernote('code', content);
        }


        document.addEventListener('DOMContentLoaded', (event) => {
            const textarea = document.getElementById('summernote');

            textarea.oninvalid = function(event) {
                event.target.setCustomValidity('Description is required');
            };

            textarea.oninput = function(event) {
                event.target.setCustomValidity('');
            };
        });
    </script>
@endsection
