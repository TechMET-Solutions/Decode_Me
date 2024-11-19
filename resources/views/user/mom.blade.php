@extends('user.layout.master')
@section('content')
    <style>
        .upcoming-task-container {
            border-radius: 20px;
            background: #442D00;
        }

        .task-icon-container {
            height: 50px;
        }

        @media only screen and (max-width: 600px) {
            .task-icon-container {
                width: 36%;
                border-top-left-radius: 122px;
                border-top-right-radius: 122px;
                margin-left: 0;
            }
        }

        .task-details {
            display: flex;
            /* flex-direction: column; */
            justify-content: center;
            padding: 10px;
        }

        .task-title {
            color: white;
            font-size: 28px;
            font-family: 'Love Ya Like A Sister';
            font-weight: 400;
        }

        .task-info {
            margin-top: 2px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            padding: 4px;
            border-radius: 10px;
            width: 98%;
            margin-left: -30px;
        }

        .task-name {
            color: #8D5D00;
            font-size: 16px;
            font-family: Rubik;
            font-weight: 500;
        }

        .task-date {
            color: #FC542D;
            font-size: 12px;
            font-family: Rubik;
            font-weight: 500;
        }

        .expert-call-card {
            width: 100%;
            border-radius: 20px;
            margin-top: 30px;
        }

        .expert-call-content {
            border-radius: 10px;
            color: #000;
            width: 100%;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .call-icon-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .call-details {
            text-align: center;
        }

        .schedule-call-btn {
            background: #D72727;
            color: #fff;
            border-radius: 20px;
        }

        .card-title {
            font-size: 28px;
            font-family: 'Love Ya Like A Sister';
            font-weight: 400;
        }

        .card-text {
            font-family: 'Rubik';
        }

        .image-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .image-container p {
            font-size: 10px;
        }

        .image-item {
            margin-bottom: 20px;
            text-align: center;
            background: white;
            box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.16);
            border-radius: 6px
        }

        .image-item img {
            width: 100%;
            max-width: 200px;
        }

        @media (max-width: 768px) {
            .image-container {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .image-item {
                margin-bottom: 20px;
                margin-right: 20px;
                width: calc(50% - 20px);
            }

            .image-item img {
                width: 40%;
            }
        }

        .btn-custom {
            font-family: 'Rubik';
            width: 100%;
            height: auto;
            color: #8D5D00;
            background: #FFED7E;
            border-radius: 30px;
            border: none;
            font-weight: 600;
        }

        @media (min-width: 768px) {
            .btn-custom {
                max-width: 80px;
            }
        }
    </style>
    {{--  <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container">
                <div class="row">
                    <div class="card mt-4" style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;">
                    <p class="mt-4">
                        <a><i class='fas fa-arrow-left' style='font-size:30px'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size:28px; font-weight:700;"> Moment of Meeting(MOM)</span>
                    </p>
                    <div>
                        <p style="margin-left:30px;font-size:22px;">Leader: {{ $stud_name }}</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <div class="app-wrapper" style="background:#fff">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container mt-4">
                <form action="{{ route('storecareermom') }}" method="post" enctype="multipart/form-data" id="myForm">
                    @csrf
                    <div class="row">
                        <div class="mt-4">
                            <a href="{{ route('careerGoal') }}"><i class='fas fa-arrow-left'
                                    style='font-size:30px;color:#000;'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <span style="font-size:28px; font-weight:700;color:#000;"> Minute of Meeting(MOM)</span>
                            <p style="margin-left:47px;font-size:22px;maggin-bottom:10px;">Leader: {{ $stud_name }}</p>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="container">
                                <div class="row ">
                                    <input type="hidden" name="cc_id" value="{{ $careerClub->id }}">
                                    <input type="hidden" name="studId" value="{{ $stud_id }}">
                                    <input type="hidden" name="schoolId" value="{{ $careerClub->sch_id }}">
                                    <div class="col-12">
                                        <textarea name="mom" id="summernote" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-2">
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
    </script>
    @endsession
