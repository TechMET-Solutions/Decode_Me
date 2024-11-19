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

        .info-label {
            font-weight: bold;
            color: #343a40;
            margin-bottom: 5px;
        }

        .info-data {
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            color: #495057;
        }
    </style>
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <x-session-message />

                <div class="row" style="display: flex; justify-content: space-between;">
                    <div class="col-lg-6 col-sm-6">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Previous Task</p>
                    </div>
                    <div class="col-lg-6 col-sm-6 text-end">
                        <a href="{{ route('admin.taskList') }}">
                            <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Task &nbsp;<i
                                    class='fas fa-arrow-right' style='font-size:30px'></i></p>
                        </a>
                    </div>
                    <div class="col-lg-2 col-sm-6 mt-2">
                        <form method="GET">
                            @csrf
                            @php
                                $taskTypes = ['Individual', 'Group'];
                                $selectedType = isset($_GET['type']) ? $_GET['type'] : 'Individual';
                            @endphp
                            <div class="mb-3">
                                <label for="type" class="form-label"
                                    style="font-family:Rubik; font-size:20px; font-weight:500;">Select Task Type
                                </label>
                                <select class="form-control" name="type" id="type" onchange="this.form.submit()"
                                    required>
                                    <option>Select Task Type</option>
                                    @foreach ($taskTypes as $ts)
                                        <option value="{{ $ts }}" {{ $selectedType === $ts ? 'selected' : '' }}>
                                            {{ $ts }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-7 col-sm-6 text-center mt-2">
                        <div style="border:solid 3px Black;border-radius:5px;width: 86%; height:80%;margin-left:32px;">
                            <p style="font-family: Rubik; font-size:25px;padding:16px 10px 0 15px; ">
                                {{ date(' j F, Y') }}&nbsp;&nbsp;<i class='fas fa-calendar-alt' style='font-size:28px'></i>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-12 ">
                        @if ($selectedType === 'Individual')
                            <div class="row">
                                <div class="col-md-10">
                                    <p style="font-family: Rubik; Font-size:40px;font-weight:500; text-align:center;">
                                        Individidual
                                    </p>
                                </div>
                                <div class="col-md-2 text-end">
                                    <a href="{{ route('taskreport') }}" style="margin-left: 0px;">
                                        <i class='fa-solid fa-file-arrow-down'
                                            style='font-size: 43px; color: green; margin-bottom: -45px;'></i>
                                    </a>
                                </div>
                            </div>

                            <div class=" table-responsive ">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Sr.</th>
                                            <th style="text-align: center;">Task</th>
                                            <th style="text-align: center;">School</th>
                                            <th style="text-align: center;">Student Name</th>
                                            <th style="text-align: center;">Deadline Date</th>
                                            {{--  <th style="text-align: center;">Schedule Call</th>  --}}
                                            <th style="text-align: center;">Current Status</th>
                                            <th style="text-align: center;">Final</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($individual as $data)
                                            <tr>
                                                <td style="text-align: center;">{{ $loop->index + 1 }}</td>
                                                <td style="text-align: center;">{{ $data->task_name }}</td>
                                                <td style="text-align: center;">{{ $data->school_name }}</td>
                                                <td style="text-align: center;">{{ $data->stud_name }}</td>
                                                {{-- <td style="text-align: center;">{{ $data->deadlineDate }}</td> --}}
                                                @php
                                                    $deadlineDate = \Carbon\Carbon::parse($data->deadlineDate);
                                                    $currentDate = \Carbon\Carbon::now();
                                                    $backgroundColor =
                                                        $deadlineDate > $currentDate ? '#FC542D' : 'green';
                                                @endphp
                                                <td style="text-align: center; color: {{ $backgroundColor }};">
                                                    {{ $data->deadlineDate }}
                                                </td>
                                                {{--  <td style="text-align: center;">
                                                    {{ $data->scheduleCall }}
                                                </td>  --}}

                                                <td style="text-align: center;">
                                                    @if ($data->status == '0')
                                                        <button type="button" class="btn"
                                                            style="background: #95949E;color:#fff;">Pending</button>
                                                    @elseif ($data->status == '1')
                                                        <button type="button" class="btn" data-bs-toggle="modal"
                                                            data-bs-target="#taskApprovalModal"
                                                            onclick="openTaskApprovalModal('individual','{{ $data->stud_id }}','{{ $data->schoolId }}','{{ $data->taskId }}','{{ $data->id }}')"
                                                            style="background: #007BFF;color:#fff;">Submit</button>
                                                    @elseif ($data->status == '2')
                                                        <button type="button" class="btn "
                                                            style="background: #FFA500 ;color:#fff;">Resubmit</button>
                                                    @elseif ($data->status == '3')
                                                        <button type="button" class="btn"
                                                            style="background: #FC542D;color:#fff;">Overdue</button>
                                                    @elseif ($data->status == '4')
                                                        <button type="button" class="btn"
                                                            style="background: #71DC75;color:#fff;">Approved</button>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        onclick="getTaskData('{{ $data->stud_name }}','{{ $data->school_name }}','{{ $data->task_name }}','{{ $data->task_questions }}','{{ $data->taskId }}','{{ $data->stud_id }}')"
                                                        data-bs-target="#exampleModal"
                                                        style="background: #71DC75;color:#fff;"><i
                                                            class="fa-solid fa-eye"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @elseif ($selectedType === 'Group')
                            <p style="font-family: Rubik; Font-size:40px;font-weight:500; text-align:center;">Group</p>
                            <div class=" table-responsive ">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Sr.</th>
                                            <th style="text-align: center;">Task </th>
                                            <th style="text-align: center;">School </th>
                                            <th style="text-align: center;">Students Name</th>
                                            <th style="text-align: center;">Deadline Date</th>
                                            {{--  <th style="text-align: center;">Schedule Call</th>  --}}
                                            <th style="text-align: center;">Current Status</th>
                                            <th style="text-align: center;">Final</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($group as $data)
                                            <tr>
                                                <td style="text-align: center;">{{ $loop->index + 1 }}</td>
                                                <td style="text-align: center;">{{ $data->task_name }}</td>
                                                <td style="text-align: center;">{{ $data->school_name }}</td>

                                                @php
                                                    $student = json_decode($data->studIds);
                                                @endphp
                                                <td style="text-align: center;">
                                                    @foreach ($student as $stud)
                                                        @foreach ($students as $stList)
                                                            @if ($stList->id == $stud)
                                                                <p>{{ $stList->name }}</p>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </td>
                                                @php
                                                    $deadlineDate = \Carbon\Carbon::parse($data->deadlineDate);
                                                    $currentDate = \Carbon\Carbon::now();
                                                    $backgroundColor =
                                                        $deadlineDate > $currentDate ? '#FC542D' : 'green';
                                                @endphp
                                                <td style="text-align: center; color: {{ $backgroundColor }};">
                                                    {{ $data->deadlineDate }}
                                                </td>
                                                {{--  <td style="text-align: center;">
                                                    {{ $data->scheduleCall }}
                                                </td>  --}}
                                                <td style="text-align: center;">
                                                    @if ($data->status == '0')
                                                        <button type="button" class="btn"
                                                            style="background: #95949E;color:#fff;">Pending</button>
                                                    @elseif ($data->status == '1')
                                                        <button type="button" class="btn" data-bs-toggle="modal"
                                                            data-bs-target="#taskApprovalModal"
                                                            onclick="openTaskApprovalModal('group','{{ $data->studIds }}','{{ $data->schoolId }}','{{ $data->taskId }}','{{ $data->id }}')"
                                                            style="background: #007BFF;color:#fff;">Submit</button>
                                                    @elseif ($data->status == '2')
                                                        <button type="button" class="btn "
                                                            style="background: #FFA500 ;color:#fff;">Resubmit</button>
                                                    @elseif ($data->status == '3')
                                                        <button type="button" class="btn"
                                                            style="background: #FC542D;color:#fff;">Overdue</button>
                                                    @elseif ($data->status == '4')
                                                        <button type="button" class="btn"
                                                            style="background: #71DC75;color:#fff;">Approved</button>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">

                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        onclick="getTaskGroupData('{{ $data->studIds }}','{{ $data->school_name }}','{{ $data->task_name }}','{{ $data->task_questions }}','{{ $data->taskId }}')"
                                                        data-bs-target="#groupModal"
                                                        style="background: #71DC75;color:#fff;"><i
                                                            class="fa-solid fa-eye"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Individual Task Modal -->
    <div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Submitted
                        Task</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="info-label">Student Name:</div>
                            <div class="info-data" id="stud_name"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-label">School Name:</div>
                            <div class="info-data" id="school_name"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-label">Task Name:</div>
                            <div class="info-data" id="task_name"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="info-label">Task Questions:</div>
                            <div class="info-data" id="task_questions"></div>
                        </div>
                        <div class="col-lg-8">
                            <div class="info-label">Task Answers:</div>
                            <div class="info-data" id="task_answers"></div>
                            <div id="task_file_container"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Group Task Modal -->
    <div class="modal fade bd-example-modal-xl" id="groupModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Submitted
                        Task</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="info-label">Student Name:</div>
                            <div class="info-data" id="gstud_name"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-label">School Name:</div>
                            <div class="info-data" id="gschool_name"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-label">Task Name:</div>
                            <div class="info-data" id="gtask_name"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="info-label">Task Questions:</div>
                            <div class="info-data" id="gtask_questions"></div>
                        </div>
                        <div class="col-lg-8">
                            <div class="info-label">Task Answers:</div>
                            <div class="info-data" id="gtask_answers"></div>
                            <div id="group_task_file_container"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reusable Task Approval Modal -->
    <div class="modal fade bd-example-modal-s" id="taskApprovalModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-s" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Submitted Task</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="taskApprovalForm">
                    @csrf
                    <div class="modal-body text-center">
                        <div class="row">
                            <input type="hidden" name="stud_id" id="stud_id">
                            <input type="hidden" name="school_id" id="school_id">
                            <input type="hidden" name="task_id" id="task_id">
                            <input type="hidden" name="grp_indi_id" id="grp_indi_id">
                            <div class="col-lg-6">
                                <div class="info-label">Task Approve:</div>
                                <input type="radio" name="status" id="approve" value="approve">
                            </div>
                            {{--  <div class="col-lg-6">
                                <div class="info-label">Task Disapprove:</div>
                                <input type="radio" name="status" id="disapprove" value="disapprove">
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div class="info-label">Task Disapprove Reason:</div>
                                <textarea name="reason" id="reason" cols="50" rows="4"></textarea>
                            </div>  --}}
                            <div class="col-lg-6">
                                <div class="info-label">Task Disapprove:</div>
                                <input type="radio" name="status" id="disapprove" value="disapprove">
                            </div>
                            <div class="col-lg-12 mt-2" id="reasonContainer" style="display: none;">
                                <div class="info-label">Task Disapprove Reason:</div>
                                <textarea name="reason" id="reason" cols="50" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        let submitedTask = @json($submitedTask);
        let groupTask = @json($groupTasks);
        let student = @json($students);

        function getTaskData(studName, studSchool, studTask, questions, taskId, studId) {
            document.getElementById('stud_name').innerHTML = studName;
            document.getElementById('school_name').innerHTML = studSchool;
            document.getElementById('task_name').innerHTML = studTask;
            document.getElementById('task_questions').innerHTML = questions;
            let taskData = submitedTask.find(task => task.taskID == taskId && task.studId == studId);

            let taskAnswers = document.getElementById('task_answers');
            let taskFileContainer = document.getElementById('task_file_container');

            if (taskData === undefined) {
                taskFileContainer.innerHTML = '';
                taskAnswers.innerHTML = '';
            } else {
                if (taskData.answer) {
                    taskFileContainer.innerHTML = '';
                    taskAnswers.innerHTML = '';
                    let answers = taskData.answer;
                    document.getElementById('task_answers').innerHTML = answers;
                } else {
                    taskFileContainer.innerHTML = '';
                    taskAnswers.innerHTML = '';
                    let taskFile = taskData.task_file;
                    let filePath = `/task_file/${taskFile}`;

                    if (taskFile.endsWith('.jpg') || taskFile.endsWith('.png')) {
                        taskFileContainer.innerHTML = '';
                        taskAnswers.innerHTML = '';
                        let img = document.createElement('img');
                        img.src = filePath;
                        img.alt = "Task Image";
                        img.style.maxWidth = "100%";
                        taskFileContainer.appendChild(img);
                    } else if (taskFile.endsWith('.pdf')) {
                        let iframe = document.createElement('iframe');
                        iframe.src = filePath;
                        iframe.width = "100%";
                        iframe.height = "500px";
                        taskFileContainer.appendChild(iframe);
                    } else if (taskFile.endsWith('.doc') || taskFile.endsWith('.docx') || taskFile.endsWith('.xls') ||
                        taskFile
                        .endsWith('.xlsx')) {
                        let fileMessage = document.createElement('p');
                        fileMessage.innerHTML =
                            `File: <a href="${filePath}" target="_blank">${taskFile.substring(taskFile.lastIndexOf('/') + 1)}</a>`;
                        taskFileContainer.appendChild(fileMessage);
                    } else {
                        let fileMessage = document.createElement('p');
                        fileMessage.innerText = `File: ${taskFile.substring(taskFile.lastIndexOf('/') + 1)}`;
                        taskFileContainer.appendChild(fileMessage);
                    }
                }
            }
        }

        function getTaskGroupData(studIds, studSchool, studTask, questions, taskId) {
            let studId = JSON.parse(studIds);
            let studName = studId.map(id => {
                let studData = student.find(s => s.id == id);
                return studData ? studData.name : 'Unknown Student';
            }).join(', ');
            document.getElementById('gstud_name').innerHTML = studName;
            document.getElementById('gschool_name').innerHTML = studSchool;
            document.getElementById('gtask_name').innerHTML = studTask;
            document.getElementById('gtask_questions').innerHTML = questions;
            let taskData = groupTask.find(task => task.taskID == taskId && studId.some(id => task.studId.includes(id)));

            let taskAnswers = document.getElementById('gtask_answers');
            let taskFileContainer = document.getElementById('group_task_file_container');

            if (taskData === undefined) {
                taskFileContainer.innerHTML = '';
                taskAnswers.innerHTML = '';
            } else {

                if (taskData.answer) {
                    taskFileContainer.innerHTML = '';
                    taskAnswers.innerHTML = '';
                    let answers = taskData.answer;
                    document.getElementById('gtask_answers').innerHTML = answers;
                } else {
                    taskFileContainer.innerHTML = '';
                    taskAnswers.innerHTML = '';
                    let taskFile = taskData.task_file;
                    let filePath = `/task_file/${taskFile}`;

                    if (taskFile.endsWith('.jpg') || taskFile.endsWith('.png')) {
                        let img = document.createElement('img');
                        img.src = filePath;
                        img.alt = "Task Image";
                        img.style.maxWidth = "100%";
                        taskFileContainer.appendChild(img);
                    } else if (taskFile.endsWith('.pdf')) {
                        let iframe = document.createElement('iframe');
                        iframe.src = filePath;
                        iframe.width = "100%";
                        iframe.height = "500px";
                        taskFileContainer.appendChild(iframe);
                    } else if (taskFile.endsWith('.doc') || taskFile.endsWith('.docx') || taskFile.endsWith('.xls') ||
                        taskFile
                        .endsWith('.xlsx')) {
                        let fileMessage = document.createElement('p');
                        fileMessage.innerHTML =
                            `File: <a href="${filePath}" target="_blank">${taskFile.substring(taskFile.lastIndexOf('/') + 1)}</a>`;
                        taskFileContainer.appendChild(fileMessage);
                    } else {
                        let fileMessage = document.createElement('p');
                        fileMessage.innerText = `File: ${taskFile.substring(taskFile.lastIndexOf('/') + 1)}`;
                        taskFileContainer.appendChild(fileMessage);
                    }
                }
            }
        }

        function openTaskApprovalModal(taskType, stud_id, school_id, task_id, id) {
            // Get the modal form and update its action URL based on the task type
            // console.log(taskType);
            const form = document.getElementById('taskApprovalForm');
            if (taskType === 'individual') {
                form.action = "{{ route('taskApproval') }}";
            } else if (taskType === 'group') {
                form.action = "{{ route('taskGroupApproval') }}";
            }

            // Update hidden input values
            document.getElementById('stud_id').value = stud_id;
            document.getElementById('school_id').value = school_id;
            document.getElementById('task_id').value = task_id;
            document.getElementById('grp_indi_id').value = id;

            // Show the modal
            $('#taskApprovalModal').modal('show');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const approveRadio = document.getElementById('approve');
            const disapproveRadio = document.getElementById('disapprove');
            const reasonContainer = document.getElementById('reasonContainer');

            function toggleReason() {
                if (disapproveRadio.checked) {
                    reasonContainer.style.display = 'block';
                } else {
                    reasonContainer.style.display = 'none';
                }
            }

            approveRadio.addEventListener('change', toggleReason);
            disapproveRadio.addEventListener('change', toggleReason);

            // Initial check on page load
            toggleReason();
        });
    </script>
@endsection
