@extends('user.layout.master')
@section('content')
    <style>
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
                <h1 class="app-page-title">Dashboard</h1>
                <div class="row g-4 mb-4">
                    <div class="col-lg-8 col-sm-12">
                    </div><!--//col-->
                    <div class="col-lg-4 col-sm-12">
                        <div style="width: 100%; height: auto; background: #FFFFF4; border-radius: 20px;">

                            <p class="p-4" style="font-size: 26px;    font-family: Love Ya Like A Sister, cursive;"> <a
                                    href="{{ route('studentreport') }}"><i class="fa-solid fa-file-arrow-down"
                                        style="font-size: 30px;"></i></a>&nbsp;&nbsp;Download
                                Report</p>

                        </div>
                    </div>
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
                                style="font-family: Love Ya Like A Sister, cursive; font-size:36px;line-height:45px; color:#1F1F1F;">
                                Hi,
                                <span style="color: #B26D00">{{ Auth::user()->name }}</span>
                            </p>
                            <p
                                style="font-family: Love Ya Like A Sister, cursive; font-size:30px;line-height:45px; color:#1F1F1F;">
                                Let's
                                map your career journey!
                            <div style="width:60px; border-top: 4px solid yellow;margin-top:-30px;">
                            </div>
                            </p>
                        </div>
                        <div>
                            <img src="{{ asset('admin/assets/images/roadmap.png') }}" alt="Road Map" width="100%">
                        </div>
                        {{-- <div class="text-center">
                            <p class="mt-2 mb-2" style="color: #F43333;margin-bottom:0px;">1st Milestone</p>
                            <button class="btn btn-success"
                                style="color: #FDD901;background:#442D00;border-radius:14px;width:50%">Join Upcoming
                                Workshops</button>
                        </div> --}}
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
                                {{-- <div class="mt-2"
                                    style="border-radius:10px; background:#FFF2D9;color:#000;width:100%; padding:10px;">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <svg width="31" height="31" viewBox="0 0 31 31" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="0.632812" y="0.596191" width="29" height="29" rx="14.5"
                                                    fill="#442D00" stroke="white" />
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
                                            <p style="font-size: 12px;">Lorem, ipsum dolor sit amet consectetur adipisicing
                                                elit. Velit minima earum
                                                sed
                                                omnis explicabo tempora cum labore molestias blanditiis. </p>
                                            <div class="d-flex justify-content-end"
                                                style="color: #1F1F1F; font-size: 10px; font-family: Rubik; font-weight: 400; word-wrap: break-word;margin-bottom: -20px;">
                                                <p>18 March</p>&nbsp;&nbsp;&nbsp;
                                                <p>5.56PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="mt-2"
                                    style="border-radius:10px; background:#FFF2D9;color:#000;width:100%; padding:10px;">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <svg width="31" height="31" viewBox="0 0 31 31" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="0.632812" y="0.596191" width="29" height="29" rx="14.5"
                                                    fill="#442D00" stroke="white" />
                                                <g clip-path="url(#clip0_42_7393)">
                                                    <path
                                                        d="M19.2966 22.004C18.6946 22.004 17.849 21.7863 16.5828 21.0788C15.043 20.2153 13.852 19.4181 12.3206 17.8907C10.844 16.4151 10.1255 15.4597 9.11981 13.6297C7.98371 11.5635 8.17738 10.4804 8.39387 10.0175C8.65168 9.4643 9.03223 9.1334 9.52411 8.80497C9.80349 8.62192 10.0992 8.46501 10.4073 8.33622C10.4382 8.32296 10.4669 8.31031 10.4924 8.2989C10.6451 8.23013 10.8764 8.1262 11.1694 8.23722C11.3649 8.31062 11.5394 8.46081 11.8127 8.73065C12.373 9.28328 13.1387 10.5141 13.4212 11.1185C13.6109 11.5259 13.7364 11.7948 13.7367 12.0964C13.7367 12.4495 13.5591 12.7218 13.3435 13.0157C13.3031 13.0709 13.263 13.1236 13.2242 13.1748C12.9895 13.4832 12.938 13.5723 12.9719 13.7315C13.0407 14.0513 13.5535 15.0033 14.3963 15.8442C15.2392 16.6852 16.1637 17.1657 16.4847 17.2341C16.6507 17.2696 16.7416 17.2159 17.0599 16.9729C17.1055 16.9381 17.1524 16.902 17.2014 16.8659C17.5302 16.6214 17.7898 16.4484 18.1346 16.4484H18.1365C18.4365 16.4484 18.6934 16.5785 19.119 16.7931C19.6741 17.0732 20.9419 17.829 21.4979 18.39C21.7684 18.6626 21.9192 18.8365 21.9929 19.0317C22.1039 19.3256 21.9993 19.556 21.9312 19.7102C21.9198 19.7358 21.9071 19.7638 21.8939 19.795C21.7641 20.1026 21.6062 20.3977 21.4223 20.6764C21.0945 21.1667 20.7624 21.5463 20.2079 21.8045C19.9232 21.9391 19.6116 22.0074 19.2966 22.004Z"
                                                        fill="white" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_42_7393">
                                                        <rect width="15.7895" height="15.7895" fill="white"
                                                            transform="translate(7.23828 7.20142)" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="col-lg-10">
                                            <p style="font-size: 12px;">Lorem, ipsum dolor sit amet consectetur adipisicing
                                                elit. Velit minima earum
                                                sed
                                                omnis explicabo tempora cum labore molestias blanditiis. </p>
                                            <div class="d-flex justify-content-end"
                                                style="color: #1F1F1F; font-size: 10px; font-family: Rubik; font-weight: 400; word-wrap: break-word;margin-bottom: -20px;">
                                                <p>18 March</p>&nbsp;&nbsp;&nbsp;
                                                <p>5.56PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2"
                                    style="border-radius:10px; background:#FFF2D9;color:#000;width:100%; padding:10px;">
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
                                            <p style="font-size: 12px;">Lorem, ipsum dolor sit amet consectetur adipisicing
                                                elit. Velit minima earum
                                                sed
                                                omnis explicabo tempora cum labore molestias blanditiis. </p>
                                            <div class="d-flex justify-content-end"
                                                style="color: #1F1F1F; font-size: 10px; font-family: Rubik; font-weight: 400; word-wrap: break-word;margin-bottom: -20px;">
                                                <p>18 March</p>&nbsp;&nbsp;&nbsp;
                                                <p>5.56PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row mt-4">
                    <div class="col-lg-8">
                        <p
                            style="font-family: Love Ya Like A Sister, cursive; font-size:30px;line-height:45px; color:#1F1F1F;">
                            Our Services
                        <div style="width:50px; border-top: 4px solid yellow;margin-top:-30px;margin-left:180px;">
                        </div>
                        <div class="row">
                            <div class="col-6 mt-4 d-flex justify-content-center align-items-center">
                                <div class="">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('user/assets/images/star.png') }}" alt="">
                                        <div
                                            style="position: absolute; color: black; font-size: 80px; font-family: Love Ya Like A Sister; font-weight: 400; word-wrap: break-word;">
                                            30+</div>
                                    </div>
                                    <div class="mt-4"
                                        style="text-align: center; color: #8D5D00; font-size: 24px; font-family: Love Ya Like A Sister; font-weight: 400; word-wrap: break-word">
                                        Our Workshop</div>
                                    <div class="text-center">
                                        <p>Lorem ipsum dolor sit amet consectetur. Lectus
                                            eu risus pellentesque convallis fusce. Sit nisi
                                            risus malesuada morbi eget aliquam magna
                                            natoque vitae.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-4">
                                <div class="">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('user/assets/images/star.png') }}" alt="">
                                        <div
                                            style="position: absolute; color: black; font-size: 80px; font-family: Love Ya Like A Sister; font-weight: 400; word-wrap: break-word;">
                                            21+</div>
                                    </div>
                                    <div class="mt-4"
                                        style="text-align: center; color: #8D5D00; font-size: 24px; font-family: Love Ya Like A Sister; font-weight: 400; word-wrap: break-word">
                                        Our Experts</div>
                                    <div class="text-center">
                                        <p>Lorem ipsum dolor sit amet consectetur. Lectus
                                            eu risus pellentesque convallis fusce. Sit nisi
                                            risus malesuada morbi eget aliquam magna
                                            natoque vitae.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card" style="width: 100%;border-radius:20px;">
                            <div class="card-body">
                                <h5 class="card-title"
                                    style="color: #1F1F1F; font-size: 20px; font-family: Love Ya Like A Sister; font-weight: 400; word-wrap: break-word">
                                    <img src="{{ asset('user/assets/images/img1.png') }}" alt="Svg Image" width="25px;">
                                    Give Your Feedback
                                </h5>
                                <div style="border-radius:10px;color:#000;width:100%; padding:10px;">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>Your feedback is appreciated.</p>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="image-container">
                                                        <div class="image-item" style=" ">
                                                            <img src="{{ asset('user/assets/images/p1.png') }}"
                                                                alt="Image">
                                                            <p>Poor</p>
                                                        </div>
                                                        <div class="image-item">
                                                            <img src="{{ asset('user/assets/images/p2.png') }}"
                                                                alt="Image">
                                                            <p>Not Good</p>
                                                        </div>
                                                        <div class="image-item">
                                                            <img src="{{ asset('user/assets/images/p3.png') }}"
                                                                alt="Image">
                                                            <p>Happy</p>
                                                        </div>
                                                        <div class="image-item" style="background:#FFED7E;">
                                                            <img src="{{ asset('user/assets/images/p4.png') }}"
                                                                alt="Image">
                                                            <p>Great</p>
                                                        </div>
                                                        <div class="image-item">
                                                            <img src="{{ asset('user/assets/images/p5.png') }}"
                                                                alt="Image">
                                                            <p>Fantastic</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-2">
                                                <form action="" method="post">
                                                    @csrf
                                                    <label class="mb-2">Write Feedback</label>
                                                    <input type="text" name="feedback" class="form-control">
                                                    <div class="text-end d-flex justify-content-end align-items-center">
                                                        <button type="submit" class="mt-2"
                                                            style="width:50%;height: 50px; border-radius: 20px;margin-right:70px;">Submit</button>
                                                        <div style="position: absolute;">
                                                            <img src="{{ asset('user/assets/images/img2.png') }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function markAsRead(notificationId) {
            console.log(notificationId);
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
