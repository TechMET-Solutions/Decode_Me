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

        .text-love-ya {
            font-family: 'Love Ya Like A Sister', cursive;
        }

        .responsive-image {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 25px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            font-size: 20px;
            font-family: 'Love Ya Like A Sister';
            font-weight: 400;
            margin-top: -80px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #8D5D00;
            color: #FFED7E;
            border: 1px solid #FFED7E;
            border-radius: 30px;
            cursor: pointer;
            margin: 5px;
        }

        .button-container a.active .button {
            background-color: #FFED7E;
            color: #442D00;
        }

        .button-container a.active .button:hover {
            background-color: #FFED7E;
        }

        .selected {
            background-color: #FEFFC2;
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

        iframe {
            width: 100%;
            height: auto;
            border: 1px solid #ccc;
        }
    </style>

    <div class="app-wrapper">
        <div class="app-content pt-3 p-lg-3">
            <div class="container-xl">
                {{-- <h1 class="app-page-title">Personal Counselling</h1> --}}
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                    </div><!--//col-->
                    <div class="col-lg-4 col-sm-12 mt-4">
                        {{--  <div style="width: 100%; height: auto; background: #FFFFF4; border-radius: 20px;">
                            <h6 class="p-4"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;&nbsp;&nbsp;&nbsp;Search</h6>
                        </div>  --}}
                    </div>
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div>
    <div class="app-wrapper">
        <div class="app-content p-lg-3">
            <x-session-message />
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-8 col-sm-12 mb-4">
                        <div class="text-center">
                            <p class="heading">
                                DM Session</p>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12 mb-4">
                                <div class="">
                                    <img src="{{ asset('user/assets/images/bg1.png') }}" alt=""
                                        class="responsive-image">
                                    <div class="button-container">
                                        <a href="{{ route('counselling') }}" class="active"><button
                                                class="button">Online</button></a>
                                        <a href="{{ route('counsellingOffline') }}"><button
                                                class="button">Offline</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="container">
                                    <div class="d-flex">
                                        <div
                                            style="background: #FFED7E; width:30px;height:30px;border-radius:50%;text-align:center;">
                                            <img src="{{ asset('assets/images/sidebar/img3.png') }}" alt=""
                                                width="24px;">
                                        </div>
                                        <p style="font-family: Rubik; font-size:20px;font-weight:400;"><b>45 Min</b> call
                                            with
                                            <b>Expert</b>
                                        </p>
                                    </div>
                                    <ul>
                                        <li>Choose the date and time slot that fits your schedule and click on it to
                                            proceed.
                                        </li>
                                        <li>Approximately <b>24 hours before your scheduled session, you will receive an
                                                email
                                                or
                                                notification
                                                containing the link</b> to access the online expert session.</li>
                                    </ul>
                                    <hr>
                                    <div class="d-flex justify-content-between mb-4">
                                        <div class="d-flex justify-content-between">
                                            <svg width="27" height="27" viewBox="0 0 27 27" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="0.853516" y="0.26416" width="26" height="26" rx="13"
                                                    fill="#FDD901" />
                                                <path
                                                    d="M18.8112 7.59733H17.3945V6.889C17.3945 6.70114 17.3199 6.52097 17.1871 6.38813C17.0542 6.25529 16.8741 6.18066 16.6862 6.18066C16.4983 6.18066 16.3182 6.25529 16.1853 6.38813C16.0525 6.52097 15.9779 6.70114 15.9779 6.889V7.59733H11.7279V6.889C11.7279 6.70114 11.6532 6.52097 11.5204 6.38813C11.3876 6.25529 11.2074 6.18066 11.0195 6.18066C10.8317 6.18066 10.6515 6.25529 10.5187 6.38813C10.3858 6.52097 10.3112 6.70114 10.3112 6.889V7.59733H8.89453C8.33095 7.59733 7.79044 7.82121 7.39193 8.21973C6.99341 8.61824 6.76953 9.15875 6.76953 9.72233V18.2223C6.76953 18.7859 6.99341 19.3264 7.39193 19.7249C7.79044 20.1234 8.33095 20.3473 8.89453 20.3473H18.8112C19.3748 20.3473 19.9153 20.1234 20.3138 19.7249C20.7123 19.3264 20.9362 18.7859 20.9362 18.2223V9.72233C20.9362 9.15875 20.7123 8.61824 20.3138 8.21973C19.9153 7.82121 19.3748 7.59733 18.8112 7.59733ZM19.5195 18.2223C19.5195 18.4102 19.4449 18.5904 19.3121 18.7232C19.1792 18.856 18.9991 18.9307 18.8112 18.9307H8.89453C8.70667 18.9307 8.5265 18.856 8.39366 18.7232C8.26083 18.5904 8.1862 18.4102 8.1862 18.2223V13.264H19.5195V18.2223ZM19.5195 11.8473H8.1862V9.72233C8.1862 9.53447 8.26083 9.3543 8.39366 9.22146C8.5265 9.08863 8.70667 9.014 8.89453 9.014H10.3112V9.72233C10.3112 9.91019 10.3858 10.0904 10.5187 10.2232C10.6515 10.356 10.8317 10.4307 11.0195 10.4307C11.2074 10.4307 11.3876 10.356 11.5204 10.2232C11.6532 10.0904 11.7279 9.91019 11.7279 9.72233V9.014H15.9779V9.72233C15.9779 9.91019 16.0525 10.0904 16.1853 10.2232C16.3182 10.356 16.4983 10.4307 16.6862 10.4307C16.8741 10.4307 17.0542 10.356 17.1871 10.2232C17.3199 10.0904 17.3945 9.91019 17.3945 9.72233V9.014H18.8112C18.9991 9.014 19.1792 9.08863 19.3121 9.22146C19.4449 9.3543 19.5195 9.53447 19.5195 9.72233V11.8473Z"
                                                    fill="#8D5D00" />
                                            </svg>
                                            &nbsp;&nbsp;
                                            <h5>Choose a date</h5>
                                        </div>
                                        <div
                                            style="background:#FFED7E;border-radius:20px;padding:10px;width:130px;height:40px;text-align:center;">
                                            <h5>{{ date('F Y') }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row" id="calendar">
                                </div>
                                <hr>
                                <div class="d-flex">
                                    &nbsp;&nbsp;&nbsp;<svg width="27" height="27" viewBox="0 0 27 27" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="0.853516" y="0.193848" width="26" height="26" rx="13"
                                            fill="#FDD901" />
                                        <g clip-path="url(#clip0_617_2733)">
                                            <path
                                                d="M13.8529 6.11035C17.765 6.11035 20.9362 9.28156 20.9362 13.1937C20.9362 17.1058 17.765 20.277 13.8529 20.277C9.94074 20.277 6.76953 17.1058 6.76953 13.1937C6.76953 9.28156 9.94074 6.11035 13.8529 6.11035ZM13.8529 7.52702C12.35 7.52702 10.9086 8.12404 9.84593 9.18675C8.78322 10.2495 8.1862 11.6908 8.1862 13.1937C8.1862 14.6966 8.78322 16.1379 9.84593 17.2006C10.9086 18.2633 12.35 18.8604 13.8529 18.8604C15.3558 18.8604 16.7971 18.2633 17.8598 17.2006C18.9225 16.1379 19.5195 14.6966 19.5195 13.1937C19.5195 11.6908 18.9225 10.2495 17.8598 9.18675C16.7971 8.12404 15.3558 7.52702 13.8529 7.52702ZM13.8529 8.94369C14.0264 8.94371 14.1938 9.0074 14.3235 9.12269C14.4531 9.23798 14.5359 9.39684 14.5562 9.56914L14.5612 9.65202V12.9004L16.4787 14.8179C16.6057 14.9454 16.6795 15.1164 16.6849 15.2963C16.6904 15.4762 16.6273 15.6514 16.5082 15.7864C16.3892 15.9214 16.2233 16.006 16.0441 16.0231C15.865 16.0401 15.686 15.9884 15.5437 15.8783L15.4771 15.8195L13.3521 13.6945C13.242 13.5843 13.1713 13.4409 13.1509 13.2865L13.1445 13.1937V9.65202C13.1445 9.46416 13.2192 9.28399 13.352 9.15115C13.4848 9.01831 13.665 8.94369 13.8529 8.94369Z"
                                                fill="#8D5D00" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_617_2733">
                                                <rect width="17" height="17" fill="white"
                                                    transform="translate(5.35352 4.69385)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    &nbsp;&nbsp;
                                    <h5>Choose a Slot</h5>
                                </div>
                                <div class="container">
                                    <div class="row" id="eventsContainer">
                                    </div>
                                    <div class="row mt-4">
                                        <div class="text-center">
                                            {{-- {{ route('bookSession') }} --}}
                                            <form action="{{ route('bookSession') }}" method="post" id="booksession">
                                                @csrf
                                                <input type="hidden" name="stud_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="expert_id" id="expert_id">
                                                <input type="hidden" name="dmsessionId" id="dmsessionId">
                                                <input type="hidden" name="date" id="dateSelect">
                                                <input type="hidden" name="timeSlot" id="timeSlot">
                                                <input type="hidden" name="mode" value="Online">
                                                <button type="submit" id="bookSessionButton"
                                                    style="background:#442D00;width:40%;text-align:center;border-radius:20px;color:#FDD901;padding:6px;border:none;">Book
                                                    a Session</button>
                                            </form>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-12">
                                        <p
                                            style="font-family: Love Ya Like A Sister, cursive; font-size:30px;line-height:45px; color:#1F1F1F;">
                                            My Sessions! </p>
                                        <div
                                            style="width:50px; border-top: 4px solid yellow;margin-top:-30px;margin-left:250px;">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mt-4 ">
                                                {{--  --}}
                                                @foreach ($ongoingSession as $data)
                                                    <div class="row mt-4" style="background:#fff;">
                                                        <div class="col-lg-2 col-sm-12">
                                                            <div class="circle bg-danger-custom">
                                                                <div class="text-love-ya text-center">
                                                                    {{ \Carbon\Carbon::parse($data->date)->format('d') }}
                                                                </div>
                                                                <div class="text-love-ya text-center"
                                                                    style="margin-top: -18px;font-size: 26px;">
                                                                    {{ \Carbon\Carbon::parse($data->date)->format('F') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-lg-10 col-sm-12 d-flex justify-content-between align-items-center">
                                                            <div>
                                                                {{-- <h6 style="font-size: 18px;">Career Quest: Guiding Children
                                                                    to
                                                                    Success</h6> --}}
                                                                <p>Expert : &nbsp;<span
                                                                        style="font-size: 20px;font-weight:500;">{{ $data->expert_name }}</span>
                                                                </p>
                                                                <p>Time : &nbsp;<span
                                                                        style="font-size: 20px;font-weight:500;">{{ $data->time }}</span>
                                                                </p>
                                                            </div>
                                                            <div>
                                                                @if ($data->status == '0')
                                                                    <a href="{{ route('writeTakeaway', $data->id) }}">
                                                                        <button class="btn btn-success"
                                                                            style="color: #8D5D00;background:#FFED7E;border-radius:14px;width:100%">Write
                                                                            a Takeaway</button>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-12">
                                        <p
                                            style="font-family: Love Ya Like A Sister, cursive; font-size:30px;line-height:45px; color:#1F1F1F;">
                                            Previous Sessions! </p>
                                        <div
                                            style="width:50px; border-top: 4px solid yellow;margin-top:-30px;margin-left:250px;">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mt-4 ">
                                                @foreach ($completeSession as $key => $value)
                                                    {{--  @if ($loop->first)  --}}
                                                    <div class="row mt-4" style="background:#fff;">
                                                        <div class="col-lg-2 position-relative">
                                                            <div class="circle bg-danger-custom">
                                                                <div class="text-love-ya text-center">
                                                                    {{ \Carbon\Carbon::parse($value->date)->format('d') }}
                                                                </div>
                                                                <div class="text-love-ya text-center"
                                                                    style="margin-top: -18px;font-size: 26px;">
                                                                    {{ \Carbon\Carbon::parse($value->date)->format('F') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-lg-10 col-sm-12 d-flex justify-content-between align-items-center">
                                                            <div>
                                                                {{-- <h6 style="font-size: 18px;">Career Quest: Guiding Children
                                                                    to
                                                                    Success</h6> --}}
                                                                <p>Expert : &nbsp;<span
                                                                        style="font-size: 20px;font-weight:500;">{{ $value->expert_name }}</span>
                                                                </p>
                                                                <p>Time : &nbsp;<span
                                                                        style="font-size: 20px;font-weight:500;">{{ $value->time }}</span>
                                                                </p>
                                                            </div>
                                                            <div>
                                                                @if ($value->takeaway == null && $value->stud_file == null)
                                                                    <a href="{{ route('writeTakeaway', $value->id) }}">
                                                                        <button class="btn btn-success"
                                                                            style="color: #8D5D00;background:#FFED7E;border-radius:14px;width:100%">Write
                                                                            a Takeaway</button>
                                                                    </a>
                                                                @endif
                                                                {{--  <div>
                                                                    @if ($value->stud_file != null)
                                                                        <p>
                                                                        <a href="#" id="file-link"
                                                                            data-file-url="{{ asset('takeaway_file/' . $value->stud_file) }}"
                                                                            onclick="showFile(event)">
                                                                            Click to view file
                                                                        </a>
                                                                        <iframe id="file-frame"></iframe>
                                                                    </p>
                                                                        <div class="text-start">
                                                                            <a href="{{ route('sessionCompleted', $value->id) }}"
                                                                                style="text-decoration: underline;">See
                                                                                More</a>
                                                                        </div>
                                                                    @else
                                                                        <p>{!! $value->takeaway !!}</p>
                                                                        <div class="text-start">
                                                                            <a href="{{ route('sessionCompleted', $value->id) }}"
                                                                                style="text-decoration: underline;">See
                                                                                More</a>
                                                                        </div>
                                                                    @endif
                                                                </div>  --}}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 offset-lg-2 col-sm-12 ">
                                                            @if ($value->stud_file != null)
                                                                {{--  <p>
                                                                        <a href="#" id="file-link"
                                                                            data-file-url="{{ asset('takeaway_file/' . $value->stud_file) }}"
                                                                            onclick="showFile(event)">
                                                                            Click to view file
                                                                        </a>
                                                                        <iframe id="file-frame"></iframe>
                                                                    </p>  --}}
                                                                <div class="text-start">
                                                                    <a href="{{ route('sessionCompleted', $value->id) }}"
                                                                        style="text-decoration: underline;">See
                                                                        More</a>
                                                                </div>
                                                            @else
                                                                {{--  <p>{!! $value->takeaway !!}</p>  --}}
                                                                <div class="text-start">
                                                                    <a href="{{ route('sessionCompleted', $value->id) }}"
                                                                        style="text-decoration: underline;">See
                                                                        More</a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{--  @endif  --}}
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <p
                                            style="font-family: Love Ya Like A Sister, cursive; font-size:30px;line-height:45px; color:#1F1F1F;">
                                            Cancel Sessions! </p>
                                        <div
                                            style="width:50px; border-top: 4px solid yellow;margin-top:-30px;margin-left:250px;">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mt-4 ">

                                                @foreach ($cancelSession as $key => $value2)
                                                    @if ($loop->first)
                                                        <div class="row mt-4" style="background:#fff;">
                                                            <div class="col-lg-2 position-relative">
                                                                <div class="circle bg-danger-custom">
                                                                    <div class="text-love-ya text-center">
                                                                        {{ \Carbon\Carbon::parse($value2->date)->format('d') }}
                                                                    </div>
                                                                    <div class="text-love-ya text-center"
                                                                        style="margin-top: -18px;font-size: 26px;">
                                                                        {{ \Carbon\Carbon::parse($value2->date)->format('F') }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-lg-10 d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <p>Time : &nbsp;<span
                                                                            style="font-size: 20px;font-weight:500;">{{ $value2->time }}</span>
                                                                    </p>
                                                                    <p>Reason : &nbsp;<span
                                                                            style="font-size: 20px;font-weight:500;">{{ $value2->remark }}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 mt-4">
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
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            var sessionData = @json($dmSession);
            var currentDate = new Date();

            var daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

            var calendarContainer = document.getElementById('calendar');

            for (var i = 0; i < sessionData.length && i < 6; i++) {
                let dataRecord = sessionData[i];

                var timeSlots = JSON.parse(dataRecord.time_slots);
                var date = new Date(dataRecord.date);

                var calendarSlot = document.createElement('div');
                calendarSlot.className = 'col-md-2 mb-3';

                var card = document.createElement('div');
                card.className = 'card h-100';
                card.style.borderRadius = '8px';
                card.style.textAlign = 'center';

                card.setAttribute('data-date', date.toISOString());
                card.setAttribute('data-id', dataRecord.id); // Add data-id attribute

                var content = document.createElement('div');
                content.className = 'p-2';
                var dayName = document.createElement('p');
                dayName.className = 'mb-0';
                dayName.textContent = daysOfWeek[date.getDay()];
                var dateNumber = document.createElement('h6');
                dateNumber.className = 'mb-0';
                dateNumber.textContent = date.getDate();
                var slotInfo = document.createElement('p');
                slotInfo.className = 'mb-0';
                slotInfo.textContent = timeSlots.length + ' Slot(s)';

                content.appendChild(dayName);
                content.appendChild(dateNumber);
                content.appendChild(slotInfo);

                card.appendChild(content);

                calendarSlot.appendChild(card);

                calendarContainer.appendChild(calendarSlot);

                card.addEventListener('click', function() {
                    var selectedDate = new Date(this.getAttribute('data-date'));
                    var formattedDate = selectedDate.toISOString().split('T')[0];
                    var recordId = this.getAttribute('data-id'); // Get record ID

                    displayTimeSlots(recordId); // Pass record ID to displayTimeSlots
                    document.getElementById('dateSelect').value = formattedDate;
                    var allCards = document.querySelectorAll('.card');
                    allCards.forEach(function(card) {
                        card.classList.remove('selected');
                    });

                    this.classList.add('selected');
                });
            }

            function displayTimeSlots(recordId) {
                var eventsContainer = document.getElementById('eventsContainer');
                var dataRecord = sessionData.find(function(record) {
                    return record.id == recordId;
                });

                if (dataRecord) {
                    var selectedDate = new Date(dataRecord.date).toISOString().split('T')[0];
                    document.getElementById('expert_id').value = dataRecord.ex_id;
                    document.getElementById('dmsessionId').value = dataRecord.id;

                    eventsContainer.innerHTML = '';
                    var timeSlots = JSON.parse(dataRecord.time_slots);
                    var currentDate = new Date();
                    var isToday = (new Date(selectedDate).toDateString() === currentDate.toDateString());

                    timeSlots.forEach(function(slot) {
                        var [startTime, endTime] = slot.split(' to ');

                        var startDateTime = new Date(`${selectedDate} ${startTime}`);
                        var currentTime = new Date();

                        if (!isToday || startDateTime >= currentTime) {
                            var eventElement = document.createElement('div');
                            eventElement.className = 'event';
                            eventElement.style.borderRadius = '20px';
                            eventElement.style.border = '1px solid black';
                            eventElement.classList.add('col-lg-4', 'col-sm-6', 'col-md-6', 'text-center', 'mt-2');

                            var timeParagraph = document.createElement('p');
                            timeParagraph.className = 'm-2';
                            timeParagraph.textContent = startTime + ' to ' + endTime;

                            eventElement.appendChild(timeParagraph);

                            eventElement.addEventListener('click', function() {
                                var allEvents = document.querySelectorAll('.event');
                                allEvents.forEach(function(event) {
                                    event.classList.remove('selected');
                                });
                                this.classList.add('selected');
                                var selectedTimeSlot = startTime + ' to ' + endTime;
                                document.getElementById('timeSlot').value = selectedTimeSlot;
                            });

                            eventsContainer.appendChild(eventElement);
                        }
                    });
                }
            }

            // Initial call to display calendar slots if a venue is already selected
            if (selectedVenue && selectedVenueId) {
                displayCalendarSlots();
            }




            var myProfileRoute = "{{ route('completeProfile') }}";
            $(document).ready(function() {
                $('#booksession').on('submit', function(e) {
                    e.preventDefault();

                    checkProfile('{{ Auth::user()->id }}');
                });
            });

            function checkProfile(sid) {
                $.ajax({
                    url: "{{ route('getCustomerProfile') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "sid": sid
                    },
                    success: function(resp) {
                        if (resp.error) {
                            alert(resp.error);
                        } else {
                            $("#test").html(resp);
                            // Submit the form
                            $('#booksession')[0].submit();
                        }
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.error;
                        alert(errorMessage);
                        window.location.href = myProfileRoute;
                    }
                });
            }

            function showFile(event) {
                event.preventDefault();
                const fileUrl = event.target.getAttribute('data-file-url');
                const fileFrame = document.getElementById('file-frame');
                fileFrame.src = fileUrl;
            }

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
                            window.location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.error;
                        alert(errorMessage);
                    }
                });
            }

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
        </script>
        {{--  function displayTimeSlots(selectedDate) {
                var eventsContainer = document.getElementById('eventsContainer');
                var dataRecord = sessionData.find(function(record) {
                    return new Date(record.date).toISOString().split('T')[0] === selectedDate;
                });

                document.getElementById('expert_id').value = dataRecord.ex_id;
                document.getElementById('dmsessionId').value = dataRecord.id;
                if (dataRecord) {
                    eventsContainer.innerHTML = '';
                    var timeSlots = JSON.parse(dataRecord.time_slots);
                    timeSlots.forEach(function(slot) {
                        var [startTime, endTime] = slot.split(' to ');
                        var eventElement = document.createElement('div');
                        eventElement.className = 'event';
                        eventElement.style.borderRadius = '20px';
                        eventElement.style.border = '1px solid black';
                        eventElement.classList.add('col-lg-4', 'col-sm-6', 'col-md-6', 'text-center', 'mt-2');

                        var timeParagraph = document.createElement('p');
                        timeParagraph.className = 'm-2';
                        timeParagraph.textContent = startTime + ' to ' + endTime;
                        // Add event listener to the event element
                        eventElement.addEventListener('click', function() {
                            var selectedDate = new Date(this.getAttribute('data-date'));
                            var formattedDate = selectedDate.toISOString().split('T')[0];
                            var allEvents = document.querySelectorAll('.event');
                            allEvents.forEach(function(event) {
                                event.classList.remove('selected');
                            });
                            this.classList.add('selected');
                            var selectedTimeSlot = startTime + ' to ' + endTime;
                            document.getElementById('timeSlot').value = selectedTimeSlot;
                        });

                        eventElement.appendChild(timeParagraph);

                        eventsContainer.appendChild(eventElement);
                    });
                }
            }  --}}
    @endsection
