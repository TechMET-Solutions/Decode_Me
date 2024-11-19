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
                    <div class="col-lg-8 col-sm-8">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Student DM Session </p>
                    </div>
                    <div class="col-lg-3  col-sm-3 text-center mt-2">
                        <div style="border:solid 3px Black;border-radius:5px;width: 86%; height:80%;margin-left:32px;">
                            <p style="font-family: Rubik; font-size:25px;padding:16px 10px 0 15px; ">
                                {{ date(' j F, Y') }}&nbsp;&nbsp;<i class='fas fa-calendar-alt' style='font-size:28px'></i>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-1 text-end">
                        <a href="{{ route('admin.dmsession') }}">
                            <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000"> <i
                                    class='fas fa-arrow-right' style='font-size:30px'></i></p>
                        </a>
                    </div>
                    <div class="col-lg-12">
                        <div class="row mb-3">
                            <div class="col-md-4 offset-lg-3">
                                <input type="text" id="studentNameInput" class="form-control"
                                    placeholder="Search by Student Name">
                            </div>
                            <div class="col-md-4">
                                <input type="date" id="dateInput" class="form-control" placeholder="Search by Date">
                            </div>
                            <div class="col-md-1">
                                <button type="button" id="clearButton" class="btn btn-secondary">Clear</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table" id="sessionsTable">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Sr.</th>
                                        <th style="text-align: center;">Name</th>
                                        <th style="text-align: center;">Expert</th>
                                        <th style="text-align: center;">Date</th>
                                        <th style="text-align: center;">Time</th>
                                        <th style="text-align: center;">Mode</th>
                                        <th style="text-align: center;">Venue</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Takeaway</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studsession as $data)
                                        @php
                                            $deadlineDate = \Carbon\Carbon::parse($data->date);
                                            $currentDate = \Carbon\Carbon::now();
                                            $backgroundColor = $deadlineDate > $currentDate ? '#FC542D' : 'green';
                                        @endphp
                                        <tr>
                                            <td style="text-align: center;">{{ $loop->index + 1 }}</td>
                                            <td class="student-name" style="text-align: center;">{{ $data->student_name }}
                                            </td>
                                            <td style="text-align: center;">{{ $data->expert_name }}</td>
                                            <td class="session-date"
                                                style="text-align: center; color: {{ $backgroundColor }}">
                                                {{ $data->date }}</td>
                                            <td style="text-align: center;">
                                                <span class="time-string"
                                                    data-time="{{ $data->time }}">{{ $data->time }}</span>
                                            </td>
                                            <td style="text-align: center;">{{ $data->mode }}</td>
                                            <td style="text-align: center;">{{ $data->venue }}</td>
                                            <td style="text-align: center;">
                                                @if ($data->status == '0')
                                                    <a href="{{ route('admin.dmsessioncancel', $data->id) }}"
                                                        type="button" class="btn"
                                                        style="background: #95949E;color:#fff;">Alloted</a>
                                                @elseif ($data->status == '1')
                                                    <a href="{{ route('admin.dmsessioncancel', $data->id) }}"
                                                        type="button" class="btn"
                                                        style="background: #007BFF;color:#fff;">Alloted</a>
                                                @elseif ($data->status == '2')
                                                    <button type="button" class="btn"
                                                        style="background: #FFA500;color:#fff;">Complated</button>
                                                @elseif ($data->status == '3')
                                                    <button type="button" class="btn"
                                                        style="background: red;color:#fff;">Cancel</button>
                                                @endif
                                            </td>
                                            <td style="text-align: center;">
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    onclick="getTakeAwayData('{{ addslashes($data->student_name) }}','{{ addslashes($data->expert_name) }}','{{ addslashes($data->date) }}','{{ addslashes($data->time) }}','{{ addslashes($data->mode) }}','{{ addslashes($data->venue) }}','{{ addslashes($data->takeaway) }}','{{ addslashes($data->admintakeaway) }}','{{ addslashes($data->stud_file) }}')"
                                                    data-bs-target="#takeawayModal" style="background: #71DC75;color:#fff;">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                @if ($data->status != '3' && $data->admintakeaway == null)
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        onclick="getAdminTakeAwayData('{{ $data->id }}')"
                                                        data-bs-target="#adminTakeawayModal"
                                                        style="background: #71DC75;color:#fff;"><i class='fas fa-plus'
                                                            style='font-size:18px;'></i></button>
                                                @endif
                                                @if ($data->status == '2')
                                                    <a href="{{ route('admin.edittakeaway', $data->id) }}">
                                                        <button class="btn   no-boundary mt-1"
                                                            style="background: #71DC75;color:#fff;"><i
                                                                class="fas fa-pencil-alt"></i></button>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{--  <div class="col-lg-12">
                        <div class=" table-responsive ">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Sr.</th>
                                        <th style="text-align: center;">Name</th>
                                        <th style="text-align: center;">Expert</th>
                                        <th style="text-align: center;">Date</th>
                                        <th style="text-align: center;">Time</th>
                                        <th style="text-align: center;">Mode</th>
                                        <th style="text-align: center;">Venue</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Takeaway</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studsession as $data)
                                        @php
                                            $deadlineDate = \Carbon\Carbon::parse($data->date);
                                            $currentDate = \Carbon\Carbon::now();
                                            $backgroundColor = $deadlineDate > $currentDate ? '#FC542D' : 'green';
                                        @endphp
                                        <tr>
                                            <td style="text-align: center;">{{ $loop->index + 1 }}</td>
                                            <td style="text-align: center;">{{ $data->student_name }}</td>
                                            <td style="text-align: center;">{{ $data->expert_name }}</td>

                                            <td style="text-align: center; color: {{ $backgroundColor }}">
                                                {{ $data->date }}
                                            </td>
                                            <td style="text-align: center;">
                                                <span class="time-string"
                                                    data-time="{{ $data->time }}">{{ $data->time }}
                                                </span>
                                            </td>
                                            <td style="text-align: center;">{{ $data->mode }}</td>
                                            <td style="text-align: center;">{{ $data->venue }}</td>
                                            <td style="text-align: center;">
                                                @if ($data->status == '0')
                                                    <a href="{{ route('admin.dmsessioncancel', $data->id) }}"
                                                        type="button" class="btn"
                                                        style="background: #95949E;color:#fff;">Alloted</a>
                                                @elseif ($data->status == '1')
                                                    <a href="{{ route('admin.dmsessioncancel', $data->id) }}"
                                                        type="button" class="btn"
                                                        style="background: #007BFF;color:#fff;">Alloted</a>
                                                @elseif ($data->status == '2')
                                                    <button type="button" class="btn"
                                                        style="background: #FFA500;color:#fff;">Complated</button>
                                                @elseif ($data->status == '3')
                                                    <button type="button" class="btn"
                                                        style="background: red;color:#fff;">Cancel</button>
                                                @endif
                                            </td>
                                            <td style="text-align: center;">
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    onclick="getTakeAwayData('{{ addslashes($data->student_name) }}','{{ addslashes($data->expert_name) }}','{{ addslashes($data->date) }}','{{ addslashes($data->time) }}','{{ addslashes($data->mode) }}','{{ addslashes($data->venue) }}','{{ addslashes($data->takeaway) }}','{{ addslashes($data->admintakeaway) }}','{{ addslashes($data->stud_file) }}')"
                                                    data-bs-target="#takeawayModal" style="background: #71DC75;color:#fff;">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                @if ($data->status == '2' && $data->admintakeaway == null)
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        onclick="getAdminTakeAwayData('{{ $data->id }}')"
                                                        data-bs-target="#adminTakeawayModal"
                                                        style="background: #71DC75;color:#fff;"><i class='fas fa-plus'
                                                            style='font-size:18px;'></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>

    {{--  <div class="modal fade bd-example-modal-xl" id="takeawayModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DM Session Takeaway Data
                    </h5>
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
                            <div class="info-label">Expert Name:</div>
                            <div class="info-data" id="expert_name"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-label">Date:</div>
                            <div class="info-data" id="date"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="info-label">Time:</div>
                            <div class="info-data" id="time"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-label">Mode:</div>
                            <div class="info-data" id="mode"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-label">Venue:</div>
                            <div class="info-data" id="venue"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="info-label">Admin Takeaway:</div>
                            <div class="info-data" id="admintakeaway"></div>
                        </div>
                        <div class="col-lg-12">
                            <div class="info-label">Student Takeaway:</div>
                            <div class="info-data" id="takeaway"></div>
                            <div id="sessin_file_container"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>  --}}
    <div class="modal fade bd-example-modal-xl" id="takeawayModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DM Session Takeaway Data</h5>
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
                            <div class="info-label">Expert Name:</div>
                            <div class="info-data" id="expert_name"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-label">Date:</div>
                            <div class="info-data" id="date"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="info-label">Time:</div>
                            <div class="info-data" id="time"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-label">Mode:</div>
                            <div class="info-data" id="mode"></div>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-label">Venue:</div>
                            <div class="info-data" id="venue"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="info-label">Admin Takeaway:</div>
                            <div class="info-data" id="admintakeaway"></div>
                        </div>
                        <div class="col-lg-12">
                            <div class="info-label">Student Takeaway:</div>
                            <div class="info-data" id="takeaway"></div>
                            <div id="session_file_container"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade " id="adminTakeawayModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Write A Admin Takeaway</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.storeadmintakeaway') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="sId" id="sId">
                            <div class="mb-3">
                                <label for="admintakeaway" class="form-label">Description<span
                                        class="text text-danger">*</span></label>
                                <textarea name="admintakeaway" id="summernote" cols="30" rows="10"></textarea>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let sessionData = @json($studsession);

        function addslashes(str) {
            return (str + '')
                .replace(/[\\"']/g, '\\$&')
                .replace(/\u0000/g, '\\0');
        }

        function getTakeAwayData(studentName, expertName, date, time, mode, venue, takeaway, admintakeaway, studFile) {
            // Log the received data for debugging
            console.log("Data received:", {
                studentName,
                expertName,
                date,
                time,
                mode,
                venue,
                takeaway,
                admintakeaway,
                studFile
            });

            // Set the modal data using jQuery
            $('#stud_name').text(studentName);
            $('#expert_name').text(expertName);
            $('#date').text(date);
            $('#time').text(time);
            $('#mode').text(mode);
            $('#venue').text(venue);
            $('#takeaway').html(takeaway.replace(/\n/g, '<br>'));
            $('#admintakeaway').html(admintakeaway.replace(/\n/g, '<br>'));

            // Clear the file container
            var sessionFileContainer = $('#session_file_container');
            sessionFileContainer.empty();

            // If there is a student file, display it in the modal
            if (studFile) {
                // Create the file path dynamically
                var filePath = `/takeaway_file/${studFile}`;

                // Check the file type
                var fileExtension = studFile.split('.').pop().toLowerCase();
                var fileElement;

                if (fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png' || fileExtension ===
                    'gif') {
                    // If the file is an image, create an img tag
                    fileElement = $('<img>')
                        .attr('src', filePath) // Use filePath here
                        .css('max-width', '100%')
                        .css('height', 'auto');
                } else if (fileExtension === 'pdf') {
                    // If the file is a PDF, create an iframe
                    fileElement = $('<iframe>')
                        .attr('src', filePath) // Use filePath here
                        .css('width', '100%')
                        .css('height', '500px');
                } else {
                    // For other file types, display a message
                    fileElement = $('<p>').text('File format not supported for preview.');
                }

                sessionFileContainer.append(fileElement);
            }
        }
        // Clear modal data on close to prevent data from previous students from displaying
        $('#takeawayModal').on('hidden.bs.modal', function() {
            $('#stud_name').text('');
            $('#expert_name').text('');
            $('#date').text('');
            $('#time').text('');
            $('#mode').text('');
            $('#venue').text('');
            $('#takeaway').text('');
            $('#admintakeaway').text('');
            $('#session_file_container').empty();
        });

        // Clear modal data on close to prevent data from previous students from displaying
        $('#takeawayModal').on('hidden.bs.modal', function() {
            $('#stud_name').text('');
            $('#expert_name').text('');
            $('#date').text('');
            $('#time').text('');
            $('#mode').text('');
            $('#venue').text('');
            $('#takeaway').text('');
            $('#admintakeaway').text('');
            $('#session_file_container').empty();
        });

        // Clear modal data on close to prevent data from previous students from displaying
        $('#takeawayModal').on('hidden.bs.modal', function() {
            $('#stud_name').text('');
            $('#expert_name').text('');
            $('#date').text('');
            $('#time').text('');
            $('#mode').text('');
            $('#venue').text('');
            $('#takeaway').text('');
            $('#admintakeaway').text('');
            $('#session_file_container').empty();
        });
        document.addEventListener("DOMContentLoaded", function() {
            const timeElements = document.querySelectorAll('.time-string');

            timeElements.forEach(function(element) {
                const timeString = element.getAttribute('data-time');
                const [startTime, endTime] = timeString.split(' to ');

                const parentTd = element.parentNode;
                const startTimeSpan = parentTd.querySelector('.start-time');
                const endTimeSpan = parentTd.querySelector('.end-time');

                // Function to convert 12-hour time to 24-hour time
                function convertTo24Hour(time) {
                    let [hours, minutes] = time.match(/\d{1,2}/g);
                    const ampm = time.match(/am|pm/i)[0].toLowerCase();

                    hours = parseInt(hours);
                    if (ampm === 'pm' && hours !== 12) {
                        hours += 12;
                    }
                    if (ampm === 'am' && hours === 12) {
                        hours = 0;
                    }
                    return `${hours.toString().padStart(2, '0')}:${minutes}`;
                }

                // Convert and display times
                let starttime = convertTo24Hour(startTime);
                // console.log(starttime);
                let endtime = convertTo24Hour(endTime);
                //console.log(endtime);

                startTimeSpan.textContent = `${convertTo24Hour(startTime)} `;

                endTimeSpan.textContent = `to ${convertTo24Hour(endTime)}`;
            });
        });

        //function sessionCancelModalData(id) {
        // document.getElementById('session_id').value = id;
        //  Show the modal
        //  $('#sessionCancelModal').modal('show');
        // }


        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,
                focus: true
            });
        });

        function getAdminTakeAwayData(sessionId) {
            document.getElementById('sId').value = sessionId;
        }

        document.getElementById('studentNameInput').addEventListener('input', filterTable);
        document.getElementById('dateInput').addEventListener('input', filterTable);
        document.getElementById('clearButton').addEventListener('click', clearFilters);

        function filterTable() {
            var studentNameInput = document.getElementById('studentNameInput').value.toLowerCase();
            var dateInput = document.getElementById('dateInput').value;

            var table = document.getElementById('sessionsTable');
            var tr = table.getElementsByTagName('tr');

            for (var i = 1; i < tr.length; i++) { // Start at 1 to skip the header row
                var tdName = tr[i].getElementsByClassName('student-name')[0];
                var tdDate = tr[i].getElementsByClassName('session-date')[0];

                if (tdName && tdDate) {
                    var nameValue = tdName.textContent.toLowerCase();
                    var dateValue = tdDate.textContent;

                    if ((nameValue.indexOf(studentNameInput) > -1 || studentNameInput == '') && (dateValue.indexOf(
                            dateInput) > -1 || dateInput == '')) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }

        function clearFilters() {
            document.getElementById('studentNameInput').value = '';
            document.getElementById('dateInput').value = '';
            filterTable(); // Reset the table to show all rows
        }

        //function getAdminTakeAwayData(id) {
        // let studsession = sessionData.find(t => t.id == id);
        // if (studsession) {
        // document.getElementById('sId').value = studsession.id;
        // console.log(studsession.id);
        //  }
        // }
    </script>
@endsection
