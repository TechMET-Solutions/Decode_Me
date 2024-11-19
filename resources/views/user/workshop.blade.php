@extends('user.layout.master')
@section('content')
    <style>
        @media (max-width: 768px) {
            .btn {
                width: 60%;
            }
        }

        .circle {
            width: 100%;
            height: auto;
            border-top-left-radius: 30px;
        }

        .bg-danger-custom {
            background-color: #D7CECE !important;
            width: 100%;
            height: 86px;
            padding: 0;
            font-size: 40px;
            color: #000;
        }

        .bg-red-custom {
            background-color: #D72727 !important;
            width: 100%;
            height: 86px;
            padding: 0;
            font-size: 40px;
            color: #fff;
        }

        .text-love-ya {
            font-family: 'Love Ya Like A Sister', cursive;
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
    </style>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                {{-- <h1 class="app-page-title">Workshop</h1> --}}
                <div class="row g-4 mb-4">
                    <div class="col-lg-8 col-sm-12">
                    </div><!--//col-->
                    {{--  <div class="col-lg-4 col-sm-12">
                        <div style="width: 100%; height: auto; background: #FFFFF4; border-radius: 20px;">
                            <h6 class="p-4"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;&nbsp;&nbsp;&nbsp;Search</h6>
                        </div>
                    </div>  --}}
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div>
                            <p
                                style="font-family: Love Ya Like A Sister, cursive; font-size:30px;line-height:45px; color:#1F1F1F;">
                                Upcoming Workshops!</p>
                            <div style="width:50px; border-top: 4px solid yellow;margin-top:-30px;margin-left:180px;">
                            </div>
                        </div>
                        @foreach ($workshops as $data)
                            <div class="row mt-4" style="background:#fff;">
                                <div class="col-lg-2 position-relative mb-2">
                                    <div class="circle bg-red-custom">
                                        <div class="text-love-ya text-center">
                                            {{ \Carbon\Carbon::parse($data->start_date)->format('d') }}+{{ \Carbon\Carbon::parse($data->end_date)->format('d') }}
                                        </div>
                                        <div class="text-love-ya text-center" style="margin-top: -18px;font-size: 26px;">MAR
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <h6>{{ $data->topic }}</h6>
                                    <p class="mb-0"><svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_42_7859)">
                                                <path
                                                    d="M18.2305 8.42456C18.2305 14.2579 10.7305 19.2579 10.7305 19.2579C10.7305 19.2579 3.23047 14.2579 3.23047 8.42456C3.23047 6.43544 4.02064 4.52778 5.42717 3.12126C6.83369 1.71474 8.74134 0.924561 10.7305 0.924561C12.7196 0.924561 14.6272 1.71474 16.0338 3.12126C17.4403 4.52778 18.2305 6.43544 18.2305 8.42456Z"
                                                    stroke="#6F6B64" stroke-width="1.4" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M10.7305 10.9246C12.1112 10.9246 13.2305 9.80527 13.2305 8.42456C13.2305 7.04385 12.1112 5.92456 10.7305 5.92456C9.34976 5.92456 8.23047 7.04385 8.23047 8.42456C8.23047 9.80527 9.34976 10.9246 10.7305 10.9246Z"
                                                    stroke="#6F6B64" stroke-width="1.4" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_42_7859">
                                                    <rect width="20" height="20" fill="white"
                                                        transform="translate(0.730469 0.0913086)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        {{ $data->venue }}</p>
                                    <p class="mb-0"><svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.7298 18.4504C15.3322 18.4504 19.0632 14.7194 19.0632 10.117C19.0632 5.51465 15.3322 1.78369 10.7298 1.78369C6.12744 1.78369 2.39648 5.51465 2.39648 10.117C2.39648 14.7194 6.12744 18.4504 10.7298 18.4504Z"
                                                stroke="#6F6B64" stroke-width="1.4" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M10.7305 5.11694V10.1169L14.0638 11.7836" stroke="#6F6B64"
                                                stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        @if ($data->start_date == date('Y-m-d'))
                                            {{ $data->start_time_start_date }}
                                        @else
                                            {{ $data->start_time_end_date }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="row mt-4" style="background:#fff;">
                                <div class="col">
                                    <p>{!! $data->desc !!}</p>
                                </div>
                            </div>
                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <div class="card" style="background: #FEFFC2;">
                                        <div class="card-body">
                                            <div class="row">
                                                @php
                                                    $experts = json_decode($data->expert);
                                                @endphp
                                                <div class="col d-flex align-items-center justify-content-between">
                                                    <div><span class="text-muted">Expert:</span>
                                                        @foreach ($experts as $value)
                                                            <span class="font-weight-bold">{{ $value }},</span>
                                                        @endforeach
                                                    </div>
                                                    <a href="{{ route('expertNames', $data->id) }}">
                                                        <button
                                                            style="background:#8D5D00;color:#FDD901;border-radius:18px;border:none;padding:10px;">View
                                                            Details</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-start ">
                                        <p class="mt-2 mb-2" style="color: #000; margin-bottom: 0px;">Seats Available:
                                            {{-- {{ $data->seats }} --}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="row mt-4">

                            <div class="col-lg-12">
                                <p
                                    style="font-family: Love Ya Like A Sister, cursive; font-size:30px;line-height:45px; color:#1F1F1F;">
                                    Previous Workshops! </p>
                                <div style="width:50px; border-top: 4px solid yellow;margin-top:-30px;margin-left:270px;">
                                </div>
                                <div class="row">
                                    @foreach ($prevWorkshops as $value)
                                        <div class="col-lg-12 mt-4 ">
                                            <div class="row mt-4" style="background:#fff;">
                                                <div class="col-lg-2 col-sm-12">
                                                    <div class="circle bg-danger-custom">
                                                        <div class="text-love-ya text-center">
                                                            {{ \Carbon\Carbon::parse($value->end_date)->format('d') }}
                                                        </div>
                                                        <div class="text-love-ya text-center"
                                                            style="margin-top: -18px;font-size: 26px;">
                                                            {{ \Carbon\Carbon::parse($value->end_date)->format('F') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-lg-10 col-sm-12 d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 style="font-size: 18px;">{{ $value->topic }}</h6>
                                                        @php
                                                            $experts = json_decode($value->expert);
                                                        @endphp
                                                        @foreach ($experts as $data)
                                                            <p>Expert : <br><span
                                                                    style="font-size: 20px;font-weight:500;">{{ $data }}</span>
                                                            </p>
                                                        @endforeach

                                                    </div>
                                                    <div>
                                                        <a href="{{ route('pastWorkshop', $value->id) }}">
                                                            <i class="fa-solid fa-circle-arrow-right fa-2x"
                                                                style="color: #FDD901;background:#000;border-radius:30px;"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="card" style="width: 100%;border-radius:20px;">
                            <div class="card-body">
                                <h5 class="card-title"
                                    style="color: #1F1F1F; font-size: 20px; font-family: Love Ya Like A Sister; font-weight: 400; word-wrap: break-word">
                                    <svg width="29" height="29" viewBox="0 0 29 29" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M25.3047 7.87916C25.3047 10.1308 23.473 11.9625 21.2214 11.9625C18.9697 11.9625 17.138 10.1308 17.138 7.87916C17.138 5.62749 18.9697 3.79582 21.2214 3.79582C23.473 3.79582 25.3047 5.62749 25.3047 7.87916ZM22.9714 14.0508C22.388 14.2025 21.8047 14.2958 21.2214 14.2958C19.5205 14.2927 17.8902 13.6157 16.6875 12.413C15.4848 11.2103 14.8078 9.58001 14.8047 7.87916C14.8047 6.16416 15.4814 4.61249 16.5547 3.45749C16.343 3.19795 16.076 2.98892 15.7733 2.84562C15.4705 2.70233 15.1396 2.62838 14.8047 2.62916C13.5214 2.62916 12.4714 3.67916 12.4714 4.96249V5.30082C9.00635 6.32749 6.63802 9.51249 6.63802 13.1292V20.1292L4.30469 22.4625V23.6292H25.3047V22.4625L22.9714 20.1292V14.0508ZM14.8047 27.1292C16.0997 27.1292 17.138 26.0908 17.138 24.7958H12.4714C12.4714 25.4147 12.7172 26.0082 13.1548 26.4457C13.5924 26.8833 14.1858 27.1292 14.8047 27.1292Z"
                                            fill="#2B2B2B" />
                                    </svg>

                                    My Notifications
                                </h5>
                                @foreach ($notifications as $data)
                                    <div style="border-radius:10px; background:#FFF2D9;color:#000;width:100%; padding:10px;"
                                        class="mt-2" onclick="markAsRead({{ $data->id }})">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <svg width="31" height="31" viewBox="0 0 31 31" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.632812" y="0.596191" width="29" height="29"
                                                        rx="14.5" fill="#442D00" stroke="white" />
                                                    <g clip-path="url(#clip0_42_7420)">
                                                        <path
                                                            d="M21.055 9.1751V22.9909H9.21289V9.1751H13.1603C13.1603 8.90269 13.2117 8.64827 13.3145 8.41184C13.4172 8.17541 13.5586 7.96468 13.7385 7.77964C13.9184 7.59461 14.1265 7.45327 14.363 7.35561C14.5994 7.25795 14.8564 7.20656 15.1339 7.20142C15.4064 7.20142 15.6608 7.25281 15.8972 7.35561C16.1336 7.45841 16.3444 7.59975 16.5294 7.77964C16.7144 7.95954 16.8558 8.1677 16.9534 8.40413C17.0511 8.64056 17.1025 8.89755 17.1076 9.1751H21.055ZM12.1734 11.1488H18.0945V10.1619H16.1208V9.1751C16.1208 9.03633 16.0951 8.90783 16.0437 8.78962C15.9923 8.6714 15.9229 8.5686 15.8355 8.48123C15.7481 8.39385 15.6428 8.32189 15.5194 8.26536C15.3961 8.20882 15.2676 8.18312 15.1339 8.18826C14.9952 8.18826 14.8667 8.21396 14.7485 8.26536C14.6302 8.31675 14.5274 8.38614 14.4401 8.47352C14.3527 8.56089 14.2807 8.66626 14.2242 8.78962C14.1677 8.91297 14.142 9.04147 14.1471 9.1751V10.1619H12.1734V11.1488ZM19.7829 14.4562L18.7344 13.4077L13.6537 18.4884L11.5335 16.3683L10.485 17.4168L13.6537 20.5855L19.7829 14.4562Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_42_7420">
                                                            <rect width="15.7895" height="15.7895" fill="white"
                                                                transform="translate(7.23828 7.20142)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </div>
                                            <div class="col-lg-10">
                                                <p>{{ $data->title }}</p>
                                                <p>{{ $data->description }}</p>
                                                <div class="d-flex justify-content-end"
                                                    style="color: #1F1F1F; font-size: 10px; font-family: Rubik; font-weight: 400; word-wrap: break-word;margin-bottom: -20px;">
                                                    <p>{{ $data->created_at->format('d F') }}</p>&nbsp;&nbsp;
                                                    <p>{{ $data->created_at->format('g:iA') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if (!$feedback || $feedback->status == 0)
                            <div class="card mt-2" style="width: 100%;border-radius:20px;">
                                <div class="card-body">
                                    <h5 class="card-title"
                                        style="color: #1F1F1F; font-size: 20px; font-family: Love Ya Like A Sister; font-weight: 400; word-wrap: break-word">
                                        <img src="{{ asset('user/assets/images/img1.png') }}" alt="Svg Image"
                                            width="25px;">
                                        Give Your Feedback
                                    </h5>
                                    <div style="border-radius:10px;color:#000;width:100%; padding:10px;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p>Your feedback is appreciated.</p>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="image-container">
                                                            <div class="image-item" data-value="Poor">
                                                                <img src="{{ asset('user/assets/images/p1.png') }}"
                                                                    alt="Image">
                                                                <p>Poor</p>
                                                            </div>
                                                            <div class="image-item" data-value="Not Good">
                                                                <img src="{{ asset('user/assets/images/p2.png') }}"
                                                                    alt="Image">
                                                                <p>Not Good</p>
                                                            </div>
                                                            <div class="image-item" data-value="Happy">
                                                                <img src="{{ asset('user/assets/images/p3.png') }}"
                                                                    alt="Image">
                                                                <p>Happy</p>
                                                            </div>
                                                            <div class="image-item" data-value="Great"
                                                                style="background:#FFED7E;">
                                                                <img src="{{ asset('user/assets/images/p4.png') }}"
                                                                    alt="Image">
                                                                <p>Great</p>
                                                            </div>
                                                            <div class="image-item" data-value="Fantastic">
                                                                <img src="{{ asset('user/assets/images/p5.png') }}"
                                                                    alt="Image">
                                                                <p>Fantastic</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <form action="{{ route('feedBack') }}" method="POST"
                                                        id="feedbackForm">
                                                        @csrf
                                                        <input type="hidden" name="image_value" id="image_value">
                                                        <label class="mb-2">Write Feedback</label>
                                                        <input type="text" name="feedback" class="form-control">
                                                        <div
                                                            class="text-end d-flex justify-content-end align-items-center">
                                                            <button type="submit" class="mt-2 text-center"
                                                                style="width:30%;height: 30px; border-radius: 20px;margin-right:44px;border:none;background:#442D00;color:#FFED7E">Submit</button>
                                                            <div style="position: absolute;">
                                                                <img src="{{ asset('user/assets/images/img2.png') }}"
                                                                    alt="" class="img-fluid" width="70%">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-12 mt-2 schedule-call">
                                    <div class="card expert-call-card">
                                        <div class="card-body">
                                            <div class="expert-call-content">
                                                <div class="call-icon-container">
                                                    <dotlottie-player
                                                        src="https://lottie.host/cd27ae1f-7d42-472f-9d60-9c753be95955/UxLXoJpDX0.json"
                                                        background="transparent" speed="1" loop
                                                        autoplay></dotlottie-player>
                                                </div>
                                                <div class="call-details">
                                                    <h5>Schedule a Expert Call</h5>
                                                    <p>Please contact an expert for further process.</p>
                                                    @if (!$scheduleCall || $scheduleCall->status == 0)
                                                        <button class="btn btn-danger schedule-call-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalCenter">Schedule Call</button>
                                                    @else
                                                        <button class="btn btn-danger schedule-call-btn" disabled>Schedule
                                                            Call</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Schedule a call Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Schedule A Call</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('scheduleExpertCall') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="stud_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="school_id" value="{{ Auth::user()->school_id }}">
                            <input type="hidden" name="expert" value="{{ Auth::user()->expert }}">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="scheduleDate" class="form-label">Schedule Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="scheduleDate" placeholder="Enter Schedule Date"
                                        class="form-control" id="scheduleDate" style="font-size:14px;color: #95949E;"
                                        required>
                                    <div id="date-error-message" style="color:red; font-size:12px;"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="scheduleTime" class="form-label">Schedule Time
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="time" name="scheduleTime" placeholder="hh:mm AM/PM"
                                        class="form-control" id="scheduleTime" style="font-size:14px;color: #95949E;"
                                        required>
                                    <div id="error-message" style="color:red; font-size:12px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text text-center mt-2 ">
                            <button type="submit" class="btn btn-primary">Schedule</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageItems = document.querySelectorAll('.image-item');
            const imageValueInput = document.getElementById('image_value');
            const feedbackForm = document.getElementById('feedbackForm');

            imageItems.forEach(item => {
                item.addEventListener('click', function() {
                    imageValueInput.value = this.getAttribute('data-value');
                    imageItems.forEach(i => i.style.background = '');
                    this.style.background = '#FFED7E';
                });
            });

            document.getElementById('scheduleTime').addEventListener('input', function() {
                const timeInput = this.value;
                const errorMessage = document.getElementById('error-message');
                const [hours, minutes] = timeInput.split(':').map(Number);

                if (hours < 9 || hours > 20 || (hours === 20 && minutes > 0)) {
                    errorMessage.textContent = 'Please select a time between 09:00 and 20:00.';
                    this.setCustomValidity('Invalid time');
                } else {
                    errorMessage.textContent = '';
                    this.setCustomValidity('');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const scheduleDateInput = document.getElementById('scheduleDate');
            const errorMessage = document.getElementById('date-error-message');

            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);

            const formattedDate = tomorrow.toISOString().split('T')[0];
            scheduleDateInput.setAttribute('min', formattedDate);

            scheduleDateInput.addEventListener('input', function() {
                const selectedDate = new Date(this.value);
                if (selectedDate <= today) {
                    errorMessage.textContent = 'Please select a date after today.';
                    this.setCustomValidity('Invalid date');
                } else {
                    errorMessage.textContent = '';
                    this.setCustomValidity('');
                }
            });
        });

        function markAsRead(notificationId) {
            $.ajax({
                url: "{{ route('markAsRead') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "nid": notificationId
                },
                success: function(resp) {
                    if (resp.error) {
                        alert(resp.error);
                    } else {
                        $("#test").html(resp);
                        // alert(resp.notification);
                        window.location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON.error;
                    alert(errorMessage);
                }
            });
        }
    </script>
@endsection
