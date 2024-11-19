@extends('user.layout.master')
@section('content')
    <style>
        .upcoming-task-container {
            border-radius: 20px;
            background: #442D00;
        }

        .task-icon-container {
            width: 20%;
            height: 80px;
            background: #FDFFA9;
            border-top-left-radius: 122px;
            border-top-right-radius: 122px;
            margin-left: 40px;
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
            flex-direction: column;
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
            color: #8D5D00;
        }

        .card-title1 {
            font-size: 18px;
            font-family: 'Love Ya Like A Sister';
            font-weight: 400;
            color: #8D5D00;
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
    </style>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <x-session-message />
                <div class="row g-4 mb-4">
                    <div class="col-lg-8 col-sm-12">
                        <div class="d-flex align-items-center upcoming-task-container">
                            <div class="task-icon-container">
                                <dotlottie-player
                                    src="https://lottie.host/37042057-02b4-46f2-b085-de992c0817d1/6oSNBB8Bly.json"
                                    background="transparent" speed="1" loop autoplay></dotlottie-player>

                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-12">
                                <div class="task-details">
                                    <div class="task-title"> Upcoming Internships</div>
                                </div>
                            </div>
                        </div>
                    </div><!--//col-->
                    <div class="col-lg-4 col-sm-12">
                        {{--  <div style="width: 100%; height: auto; background: #FFFFF4; border-radius: 20px;">
                            <h6 class="p-4"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;&nbsp;&nbsp;&nbsp;Search
                            </h6>
                        </div>  --}}
                    </div>
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-sm-12 mb-4">
                        @foreach ($internships as $data)
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <h5 class="card-title">{{ $data->field_name }}</h5>
                                            <p class="card-text">{{ $data->company_name }}</p>
                                        </div>
                                        <div style="background:#FFED7E;color:#000;border-radius:20px;padding:8px;">
                                            <p class="card-text">Type: {{ $data->mode }}</p>
                                        </div>
                                    </div>

                                    <p>{!! $data->desc !!}</p>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div
                                                    style="width: 26px; height: 26px; background-color: #FDD901; border-radius: 50%; display: flex;justify-content: center; align-items: center;color: white;font-size: 24px;">
                                                    <svg width="20" height="20" viewBox="0 0 21 21" fill="none"
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
                                                </div>
                                                &nbsp;&nbsp;<p class="card-text"> Location: {{ $data->venue }}</p>
                                            </div>
                                            <div class="d-flex mt-2">
                                                <div
                                                    style="width: 26px; height: 26px; background-color: #FDD901; border-radius: 50%; display: flex;justify-content: center; align-items: center;color: white;font-size: 24px;">
                                                    <svg width="27" height="27" viewBox="0 0 27 27" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="0.794922" y="0.425781" width="20" height="20"
                                                            rx="13" fill="#FDD901" />
                                                        <g clip-path="url(#clip0_96_1641)">
                                                            <path
                                                                d="M20.7949 6.92422L16.7914 6.92423V5.92773C16.7914 5.65148 16.5677 5.42773 16.2914 5.42773C16.0152 5.42773 15.7914 5.65148 15.7914 5.92773V6.92398H11.7914V5.92773C11.7914 5.65148 11.5677 5.42773 11.2914 5.42773C11.0152 5.42773 10.7914 5.65148 10.7914 5.92773V6.92398H6.79492C6.24267 6.92398 5.79492 7.37173 5.79492 7.92398V20.424C5.79492 20.9762 6.24267 21.424 6.79492 21.424H20.7949C21.3472 21.424 21.7949 20.9762 21.7949 20.424V7.92398C21.7949 7.37197 21.3472 6.92422 20.7949 6.92422ZM20.7949 20.424H6.79492V7.92398H10.7914V8.42773C10.7914 8.70397 11.0152 8.92773 11.2914 8.92773C11.5677 8.92773 11.7914 8.70397 11.7914 8.42773V7.92423H15.7914V8.42798C15.7914 8.70423 16.0152 8.92798 16.2914 8.92798C16.5677 8.92798 16.7914 8.70423 16.7914 8.42798V7.92423H20.7949V20.424ZM17.2949 13.4242H18.2949C18.5709 13.4242 18.7949 13.2002 18.7949 12.9242V11.9242C18.7949 11.6482 18.5709 11.4242 18.2949 11.4242H17.2949C17.0189 11.4242 16.7949 11.6482 16.7949 11.9242V12.9242C16.7949 13.2002 17.0189 13.4242 17.2949 13.4242ZM17.2949 17.424H18.2949C18.5709 17.424 18.7949 17.2002 18.7949 16.924V15.924C18.7949 15.648 18.5709 15.424 18.2949 15.424H17.2949C17.0189 15.424 16.7949 15.648 16.7949 15.924V16.924C16.7949 17.2005 17.0189 17.424 17.2949 17.424ZM14.2949 15.424H13.2949C13.0189 15.424 12.7949 15.648 12.7949 15.924V16.924C12.7949 17.2002 13.0189 17.424 13.2949 17.424H14.2949C14.5709 17.424 14.7949 17.2002 14.7949 16.924V15.924C14.7949 15.6482 14.5709 15.424 14.2949 15.424ZM14.2949 11.4242H13.2949C13.0189 11.4242 12.7949 11.6482 12.7949 11.9242V12.9242C12.7949 13.2002 13.0189 13.4242 13.2949 13.4242H14.2949C14.5709 13.4242 14.7949 13.2002 14.7949 12.9242V11.9242C14.7949 11.648 14.5709 11.4242 14.2949 11.4242ZM10.2949 11.4242H9.29492C9.01892 11.4242 8.79492 11.6482 8.79492 11.9242V12.9242C8.79492 13.2002 9.01892 13.4242 9.29492 13.4242H10.2949C10.5709 13.4242 10.7949 13.2002 10.7949 12.9242V11.9242C10.7949 11.648 10.5709 11.4242 10.2949 11.4242ZM10.2949 15.424H9.29492C9.01892 15.424 8.79492 15.648 8.79492 15.924V16.924C8.79492 17.2002 9.01892 17.424 9.29492 17.424H10.2949C10.5709 17.424 10.7949 17.2002 10.7949 16.924V15.924C10.7949 15.6482 10.5709 15.424 10.2949 15.424Z"
                                                                fill="#8D5D00" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_96_1641">
                                                                <rect width="16" height="16" fill="white"
                                                                    transform="translate(5.79492 5.42578)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </div>
                                                &nbsp;&nbsp;<p class="card-text">Starting Date: {{ $data->start_date }}</p>
                                            </div>
                                            <div class="d-flex mt-2">
                                                <div
                                                    style="width: 26px; height: 26px; background-color: #FDD901; border-radius: 50%; display: flex;justify-content: center; align-items: center;color: white;font-size: 24px;">
                                                    <svg width="27" height="27" viewBox="0 0 27 27" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="0.794922" y="0.425781" width="20" height="20"
                                                            rx="13" fill="#FDD901" />
                                                        <g clip-path="url(#clip0_96_1641)">
                                                            <path
                                                                d="M20.7949 6.92422L16.7914 6.92423V5.92773C16.7914 5.65148 16.5677 5.42773 16.2914 5.42773C16.0152 5.42773 15.7914 5.65148 15.7914 5.92773V6.92398H11.7914V5.92773C11.7914 5.65148 11.5677 5.42773 11.2914 5.42773C11.0152 5.42773 10.7914 5.65148 10.7914 5.92773V6.92398H6.79492C6.24267 6.92398 5.79492 7.37173 5.79492 7.92398V20.424C5.79492 20.9762 6.24267 21.424 6.79492 21.424H20.7949C21.3472 21.424 21.7949 20.9762 21.7949 20.424V7.92398C21.7949 7.37197 21.3472 6.92422 20.7949 6.92422ZM20.7949 20.424H6.79492V7.92398H10.7914V8.42773C10.7914 8.70397 11.0152 8.92773 11.2914 8.92773C11.5677 8.92773 11.7914 8.70397 11.7914 8.42773V7.92423H15.7914V8.42798C15.7914 8.70423 16.0152 8.92798 16.2914 8.92798C16.5677 8.92798 16.7914 8.70423 16.7914 8.42798V7.92423H20.7949V20.424ZM17.2949 13.4242H18.2949C18.5709 13.4242 18.7949 13.2002 18.7949 12.9242V11.9242C18.7949 11.6482 18.5709 11.4242 18.2949 11.4242H17.2949C17.0189 11.4242 16.7949 11.6482 16.7949 11.9242V12.9242C16.7949 13.2002 17.0189 13.4242 17.2949 13.4242ZM17.2949 17.424H18.2949C18.5709 17.424 18.7949 17.2002 18.7949 16.924V15.924C18.7949 15.648 18.5709 15.424 18.2949 15.424H17.2949C17.0189 15.424 16.7949 15.648 16.7949 15.924V16.924C16.7949 17.2005 17.0189 17.424 17.2949 17.424ZM14.2949 15.424H13.2949C13.0189 15.424 12.7949 15.648 12.7949 15.924V16.924C12.7949 17.2002 13.0189 17.424 13.2949 17.424H14.2949C14.5709 17.424 14.7949 17.2002 14.7949 16.924V15.924C14.7949 15.6482 14.5709 15.424 14.2949 15.424ZM14.2949 11.4242H13.2949C13.0189 11.4242 12.7949 11.6482 12.7949 11.9242V12.9242C12.7949 13.2002 13.0189 13.4242 13.2949 13.4242H14.2949C14.5709 13.4242 14.7949 13.2002 14.7949 12.9242V11.9242C14.7949 11.648 14.5709 11.4242 14.2949 11.4242ZM10.2949 11.4242H9.29492C9.01892 11.4242 8.79492 11.6482 8.79492 11.9242V12.9242C8.79492 13.2002 9.01892 13.4242 9.29492 13.4242H10.2949C10.5709 13.4242 10.7949 13.2002 10.7949 12.9242V11.9242C10.7949 11.648 10.5709 11.4242 10.2949 11.4242ZM10.2949 15.424H9.29492C9.01892 15.424 8.79492 15.648 8.79492 15.924V16.924C8.79492 17.2002 9.01892 17.424 9.29492 17.424H10.2949C10.5709 17.424 10.7949 17.2002 10.7949 16.924V15.924C10.7949 15.6482 10.5709 15.424 10.2949 15.424Z"
                                                                fill="#8D5D00" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_96_1641">
                                                                <rect width="16" height="16" fill="white"
                                                                    transform="translate(5.79492 5.42578)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </div>
                                                &nbsp;&nbsp;<p class="card-text">Ending Date: {{ $data->end_date }}</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div
                                                    style="width: 26px; height: 26px; background-color: #FFED7E; border-radius: 50%; display: flex;justify-content: center; align-items: center;color: #8D5D00;">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_619_3220)">
                                                            <path
                                                                d="M8.97491 7.87207C9.16278 7.87207 9.34294 7.9467 9.47578 8.07954C9.60862 8.21238 9.68325 8.39254 9.68325 8.5804V13.2441L10.5991 12.3289C10.7321 12.1961 10.9124 12.1215 11.1004 12.1217C11.2884 12.1218 11.4686 12.1966 11.6014 12.3296C11.7342 12.4626 11.8088 12.6429 11.8086 12.8309C11.8085 13.0189 11.7337 13.1991 11.6007 13.3319L9.60037 15.3287C9.42116 15.5072 9.24621 15.6637 8.97491 15.6637C8.73691 15.6637 8.574 15.544 8.41675 15.3946L6.34912 13.3319C6.21612 13.1991 6.14132 13.0189 6.14119 12.8309C6.14105 12.6429 6.2156 12.4626 6.34841 12.3296C6.48123 12.1966 6.66145 12.1218 6.84941 12.1217C7.03738 12.1215 7.2177 12.1961 7.35071 12.3289L8.26658 13.2441V8.5804C8.26658 8.39254 8.34121 8.21238 8.47405 8.07954C8.60689 7.9467 8.78705 7.87207 8.97491 7.87207ZM8.62075 1.49707C10.5927 1.49707 12.2757 2.73665 12.9317 4.48057C13.8055 4.72082 14.5796 5.23395 15.1413 5.94512C15.703 6.65629 16.0227 7.5283 16.054 8.43398C16.0852 9.33966 15.8263 10.2316 15.3149 10.9798C14.8036 11.728 14.0666 12.2932 13.2115 12.5931C13.1586 12.1148 12.9442 11.6688 12.6037 11.3287C12.2417 10.9651 11.7599 10.7453 11.248 10.7104L11.0999 10.7054V8.5804C11.1004 8.02726 10.8853 7.49571 10.5001 7.0987C10.115 6.70169 9.59018 6.4705 9.03727 6.45427C8.48437 6.43804 7.94693 6.63804 7.53914 7.01177C7.13136 7.38551 6.88537 7.90352 6.85346 8.45574L6.84991 8.5804V10.7054C6.57053 10.705 6.29383 10.7598 6.03574 10.8668C5.77765 10.9738 5.54328 11.1308 5.34612 11.3287C4.96508 11.7095 4.74345 12.2212 4.72633 12.7596C3.9889 12.6089 3.31862 12.2273 2.81264 11.6701C2.30666 11.1128 1.99127 10.409 1.91219 9.66048C1.83311 8.91198 1.99445 8.15774 2.37282 7.5071C2.75118 6.85645 3.32692 6.3432 4.01658 6.04174C4.03223 4.83098 4.52421 3.67512 5.38597 2.8245C6.24773 1.97387 7.40989 1.49697 8.62075 1.49707Z"
                                                                fill="#8D5D00" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_619_3220">
                                                                <rect width="17" height="17" fill="white"
                                                                    transform="translate(0.474609 0.0800781)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>

                                                </div> &nbsp;&nbsp;
                                                <a href=""
                                                    style="color: #8D5D00;font-size:16px;font-weight:600;">Internship
                                                    Schedule</a>
                                            </div>
                                            <div class="d-flex mt-2">
                                                <div
                                                    style="width: 26px; height: 26px; background-color: #FFED7E; border-radius: 50%; display: flex;justify-content: center; align-items: center;color: #8D5D00;">
                                                    <i class="fa-solid fa-phone"></i>
                                                </div> &nbsp;&nbsp;
                                                <a href=""
                                                    style="color: #8D5D00;font-size:16px;font-weight:600;">Contact
                                                    Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div class="d-flex">
                                        </div>
                                        <a href="{{ route('internshipApply', $data->id) }}"><button
                                                style="background:#442D00;color:#fff;width:160px;border-radius:20px;padding:6px;border:none;">Apply
                                                Now</button></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-4">
                            <p
                                style="font-family: Love Ya Like A Sister, cursive; font-size:30px;line-height:45px; color:#1F1F1F;">
                                Previous Internship! </p>
                            <div style="width:50px; border-top: 4px solid yellow;margin-top:-30px;margin-left:270px;">
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-4 ">
                                    <div class="row mt-4" style="background:#fff;">
                                        <div
                                            class="col-lg-12 col-sm-12 d-flex justify-content-between align-items-center mb-4">
                                            <div>
                                                <h5 class="card-title1">DESIGN INTERNSHIP</h5>
                                                <p class="card-text">Company Name: WDE School, Nashik</p>
                                            </div>
                                            <div>
                                                <a href="{{ route('internshipTakeaway') }}">
                                                    <button class="btn btn-success"
                                                        style="color: #8D5D00;background:#FFED7E;border-radius:14px;width:100%">Submit
                                                        a Takeaway</button>
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-lg-12 col-sm-12 d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="card-title1">DESIGN INTERNSHIP</h5>
                                                <p class="card-text">Company Name: WDE School, Nashik</p>
                                            </div>
                                            <div>
                                                <button class="btn btn-success"
                                                    style="color: #8D5D00;background:#FFED7E;border-radius:14px;width:100%">Submit
                                                    a Takeaway</button>
                                            </div>
                                        </div>
                                    </div>
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
