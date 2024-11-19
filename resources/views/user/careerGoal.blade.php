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
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-sm-12 mb-4">
                        <div class="d-flex align-items-center justify-content-center upcoming-task-container">
                            <div class="task-icon-container">
                                <dotlottie-player
                                    src="https://lottie.host/34de2cfc-d8bf-49b4-9cc8-8a660078320c/sOcy5YUmjM.json"
                                    background="transparent" speed="1" loop autoplay></dotlottie-player>
                            </div>
                            <div class="task-details">
                                <div class="task-title">Career Club</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-2 mb-4">
                            {{--  <div
                                style="width: 40%; height:48px;  background: #FFFAF0; border-radius: 20px; border: 1px #8D5D00 solid">
                                <h6 class="p-3"><i
                                        class="fa-solid fa-magnifying-glass"></i>&nbsp;&nbsp;&nbsp;&nbsp;Search
                                </h6>
                            </div>  --}}
                        </div>
                        <div class="row">
                            @foreach ($careerClub as $index => $data)
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <div class="d-flex justify-content-between"
                                        style=" border-radius: 12px; padding: 10px;background:#fff;">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <p class="card-text" style="font-size: 24px; margin: 0;">
                                                    {{ $index + 1 }}. {{ $data->name }}
                                                </p>
                                                <div class="d-flex">
                                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="0.728516" y="0.529297" width="20" height="20"
                                                            rx="10" fill="#FDD901" />
                                                        <g clip-path="url(#clip0_333_2349)">
                                                            <path
                                                                d="M11.8594 10.2151C12.0306 10.2827 12.1974 10.357 12.3597 10.4382C12.5219 10.5193 12.6797 10.6117 12.8329 10.7154C12.7338 10.8235 12.6436 10.9362 12.5625 11.0534C12.4814 11.1706 12.407 11.2968 12.3394 11.432C11.9923 11.2067 11.6227 11.0354 11.2306 10.9182C10.8385 10.801 10.4351 10.7424 10.0204 10.7424C9.6238 10.7424 9.24068 10.7942 8.87109 10.8979C8.5015 11.0016 8.1567 11.1458 7.83669 11.3306C7.51668 11.5154 7.22596 11.7408 6.96454 12.0067C6.70312 12.2726 6.47776 12.5656 6.28846 12.8856C6.09916 13.2056 5.95267 13.5504 5.84901 13.92C5.74534 14.2896 5.69351 14.6727 5.69351 15.0693H4.82812C4.82812 14.5285 4.907 14.0079 5.06475 13.5076C5.22251 13.0073 5.45012 12.5453 5.7476 12.1216C6.04507 11.6979 6.39663 11.3216 6.80228 10.9926C7.20793 10.6635 7.66767 10.4044 8.18149 10.2151C7.67218 9.88154 7.27554 9.46237 6.99159 8.95756C6.70763 8.45275 6.5634 7.89386 6.55889 7.28087C6.55889 6.80311 6.64904 6.35464 6.82933 5.93547C7.00962 5.5163 7.25526 5.14896 7.56626 4.83346C7.87725 4.51795 8.24459 4.27006 8.66827 4.08977C9.09195 3.90948 9.54267 3.81934 10.0204 3.81934C10.4982 3.81934 10.9467 3.90948 11.3658 4.08977C11.785 4.27006 12.1523 4.5157 12.4678 4.8267C12.7834 5.1377 13.0312 5.50503 13.2115 5.92871C13.3918 6.35239 13.482 6.80311 13.482 7.28087C13.482 7.57835 13.4459 7.86907 13.3738 8.15302C13.3017 8.43697 13.1935 8.70515 13.0493 8.95756C12.905 9.20996 12.736 9.44208 12.5422 9.65392C12.3484 9.86576 12.1208 10.0528 11.8594 10.2151ZM7.42428 7.28087C7.42428 7.64145 7.49189 7.97724 7.6271 8.28824C7.76232 8.59923 7.94712 8.87417 8.18149 9.11306C8.41587 9.35194 8.69081 9.53899 9.00631 9.6742C9.32181 9.80942 9.65986 9.87703 10.0204 9.87703C10.3765 9.87703 10.7123 9.80942 11.0278 9.6742C11.3433 9.53899 11.6182 9.35419 11.8526 9.11982C12.087 8.88544 12.274 8.6105 12.4138 8.295C12.5535 7.97949 12.6211 7.64145 12.6166 7.28087C12.6166 6.9248 12.549 6.58902 12.4138 6.27351C12.2785 5.95801 12.0937 5.68307 11.8594 5.44869C11.625 5.21432 11.3478 5.02727 11.0278 4.88755C10.7078 4.74782 10.372 4.68021 10.0204 4.68472C9.65986 4.68472 9.32407 4.75233 9.01307 4.88755C8.70207 5.02276 8.42713 5.20756 8.18825 5.44193C7.94937 5.67631 7.76232 5.9535 7.6271 6.27351C7.49189 6.59352 7.42428 6.92931 7.42428 7.28087ZM17.3762 12.9059C17.3762 13.1402 17.3401 13.3679 17.268 13.5887C17.1959 13.8096 17.0877 14.0146 16.9435 14.204V17.6655L15.2127 16.8001L13.482 17.6655V14.204C13.3422 14.0146 13.2363 13.8096 13.1642 13.5887C13.0921 13.3679 13.0538 13.1402 13.0493 12.9059C13.0493 12.6084 13.1056 12.329 13.2183 12.0675C13.331 11.8061 13.4842 11.5785 13.678 11.3847C13.8718 11.1909 14.1017 11.0354 14.3676 10.9182C14.6336 10.801 14.9153 10.7424 15.2127 10.7424C15.5102 10.7424 15.7897 10.7988 16.0511 10.9114C16.3125 11.0241 16.5401 11.1796 16.7339 11.3779C16.9277 11.5762 17.0832 11.8061 17.2004 12.0675C17.3176 12.329 17.3762 12.6084 17.3762 12.9059ZM15.2127 11.6078C15.0325 11.6078 14.8634 11.6416 14.7057 11.7092C14.5479 11.7768 14.4105 11.8692 14.2933 11.9864C14.1761 12.1036 14.0837 12.2411 14.0161 12.3988C13.9485 12.5566 13.9147 12.7256 13.9147 12.9059C13.9147 13.0862 13.9485 13.2552 14.0161 13.4129C14.0837 13.5707 14.1761 13.7082 14.2933 13.8253C14.4105 13.9425 14.5479 14.0349 14.7057 14.1025C14.8634 14.1701 15.0325 14.204 15.2127 14.204C15.393 14.204 15.562 14.1701 15.7198 14.1025C15.8776 14.0349 16.015 13.9425 16.1322 13.8253C16.2494 13.7082 16.3418 13.5707 16.4094 13.4129C16.477 13.2552 16.5108 13.0862 16.5108 12.9059C16.5108 12.7256 16.477 12.5566 16.4094 12.3988C16.3418 12.2411 16.2494 12.1036 16.1322 11.9864C16.015 11.8692 15.8776 11.7768 15.7198 11.7092C15.562 11.6416 15.393 11.6078 15.2127 11.6078ZM16.0781 16.266V14.8868C15.8077 15.0085 15.5192 15.0693 15.2127 15.0693C14.9062 15.0693 14.6178 15.0085 14.3474 14.8868V16.266C14.4916 16.1939 14.6358 16.124 14.78 16.0564C14.9243 15.9888 15.0685 15.9144 15.2127 15.8333C15.357 15.9099 15.5012 15.982 15.6454 16.0497C15.7897 16.1173 15.9339 16.1894 16.0781 16.266Z"
                                                                fill="#8D5D00" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_333_2349">
                                                                <rect width="13.8462" height="13.8462" fill="white"
                                                                    transform="translate(3.96289 3.81934)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    &nbsp;&nbsp;
                                                    @php
                                                        $leaderNames = json_decode($data->leader_name);
                                                    @endphp
                                                    @foreach ($leaderNames as $key => $value)
                                                        <p>{{ $value }}</p>
                                                        @if ($key < count($leaderNames) - 1)
                                                            <p>&nbsp;,&nbsp;</p>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>

                                        <div class="d-flex flex-column flex-md-row align-items-center">
                                            <div class="mb-2 mb-md-0">
                                                @foreach ($leaderNames as $key => $value2)
                                                    @if ($value2 == $stud_name)
                                                        <div class="mb-2 mb-md-0">
                                                            <a href="{{ route('careermom', $data->id) }}">
                                                                <button class="btn btn-custom mb-4 mb-md-0">
                                                                    MOM</button>
                                                            </a>
                                                        </div>
                                                        <div class="mb-2 mb-md-0 mt-1">
                                                            <a href="{{ route('viewMom', $data->id) }}">
                                                                <button class="btn btn-custom mb-4 mb-md-0">
                                                                    View</button>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div>
                                                <a href="{{ $data->link }}" target="_blank">
                                                    <button class="btn btn-custom">Join</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-0 mb-0">
                                </div>
                            @endforeach
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
                                    <div class="card expert-call-card" style="border-radius:20px;">
                                        <div class="card-body">
                                            <div class="expert-call-content">
                                                <div
                                                    style="text-align: center;font-family: 'Love Ya Like A Sister', cursive;font-weight: 400;       font-size: 28px;line-height: 35px;color: #8D5D00;">
                                                    <p>We Appreciate Your
                                                        Valuable Feedback!</p>
                                                </div>
                                                <div style="display: flex;justify-content: center; align-items: center;">
                                                    <dotlottie-player
                                                        src="https://lottie.host/def5fb29-52b8-47b4-b32d-dbf9264e892e/OZ3bEpYAK3.json"
                                                        background="transparent" speed="1"
                                                        style="width: 200px; height: 200px;" loop
                                                        autoplay></dotlottie-player>
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
