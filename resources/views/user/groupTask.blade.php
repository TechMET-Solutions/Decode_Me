@extends('user.layout.master')
@section('content')
    <div class="app-wrapper" style="background:#fff">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container mt-4">
                <form action="{{ route('submitGroupTasks') }}" method="post" enctype="multipart/form-data" id="myForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-1">
                                        <a href="{{ route('careerClubTask') }}"><i class="fa-solid fa-arrow-left fa-2x"
                                                style="color: #1F1F1F"></i></a>&nbsp;&nbsp;
                                    </div>
                                    <div class="col-11">
                                        <div class="d-flex justify-content-between"
                                            style="background:#8D5D00;color:#fff; padding:20px; border-radius:20px;">
                                            <div>
                                                <p class="mb-0"><i class="fa-solid fa-calendar-check"></i>&nbsp;&nbsp;Task
                                                    :{{ $taskName->id }}
                                                </p>
                                                <h6 class="mb-0" style="color:#FFE235">{{ $taskName->name }}</h6>
                                            </div>
                                            <div>
                                                @php
                                                    $date = $pendingTask->deadlineDate;
                                                    $time = $pendingTask->deadlineTime;

                                                    $deadline = new DateTime("$date $time");
                                                    $now = new DateTime();

                                                    $interval = $now->diff($deadline);

                                                    if ($now > $deadline) {
                                                        $remainingTime = 'Deadline passed';
                                                    } else {
                                                        $remainingTime = $interval->format(
                                                            '%d days, %h hours, %i minutes',
                                                        );
                                                    }
                                                @endphp
                                                <p><i class="fa-regular fa-clock"></i>&nbsp;&nbsp;{{ $remainingTime }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="taskId" value="{{ $taskName->id }}">
                                <input type="hidden" name="schoolId" value="{{ $pendingTask->schoolId }}">
                                <input type="hidden" name="studId" value="{{ Auth::user()->id }}">
                                <div class="row mt-4">
                                    <div class="col-1">
                                    </div>
                                    <div class="col-11">
                                        <p>{!! $pendingTask->desc !!}</p>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-1">
                                    </div>
                                    <div class="col-11">
                                        <textarea name="task_answer" id="summernote" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-1">
                                    </div>
                                    <div class="col-11">
                                        <input type="file" id="file" name="task_file" placeholder="File upload">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,
                focus: true
            });
        });
        $(document).ready(function() {
            $('#summernote1').summernote({
                height: 200,
                focus: true
            });
        });

        $(document).ready(function() {
            $('#summernote').summernote();

            $('#myForm').on('submit', function(event) {
                var textContent = $('#summernote').val().trim();
                var fileContent = $('#file').val().trim();

                if (textContent === '' && fileContent === '') {
                    event.preventDefault();
                    alert('Please Enter Description or Upload a File Before Submitting.');
                }
            });
        });
    </script>
@endsection
