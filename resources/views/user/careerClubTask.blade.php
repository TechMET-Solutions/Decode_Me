@extends('user.layout.master')
@section('content')
    <style>
        .upcoming-task-container {
            border-radius: 20px;
            background: #442D00;
        }

        .task-icon-container {
            width: 20%;
            height: 110px;
            background: #FDFFA9;
            border-top-left-radius: 122px;
            border-top-right-radius: 122px;
            display: flex;
            justify-content: center;
            align-items: center;
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

        .image-container {
            position: relative;
            display: inline-block;
        }

        .responsive-image {
            width: 100%;
            height: auto;
            display: block;
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

        menu ul {
            list-style: none;
            margin: 0;
        }

        menu ul {
            list-style: none;
            padding: 10px;
            margin: 0;
        }

        menu ul li {
            display: inline;
            margin-right: 20px;
        }

        menu ul li a {
            text-decoration: none;
            color: #8D5D00;
            font-size: 18px;
            font-family: Rubik;
            font-weight: 400;
        }

        menu ul li a.active {
            position: relative;
            color: #8D5D00;
            font-weight: 500;
        }

        menu ul li a.active::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 6px;
            background-color: #8D5D00;
            bottom: -4px;
            left: 0;
        }
    </style>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                {{-- <h1 class="app-page-title">Tasks</h1> --}}
                <div class="row g-4 mb-4">
                    <div class="col-lg-8 col-sm-12">
                    </div><!--//col-->
                    <div class="col-lg-4 col-sm-12">
                        {{--  <div style="width: 100%; height: auto; background: #FFFFF4; border-radius: 20px;">
                            <h6 class="p-4"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;&nbsp;&nbsp;&nbsp;Search</h6>
                        </div>  --}}
                    </div>
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <x-session-message />
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="text-center">
                            <p class="heading">
                                My Tasks</p>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="image-container">
                                    <img src="{{ asset('user/assets/images/bg1.png') }}" alt=""
                                        class="responsive-image">
                                    <div class="button-container">
                                        <a href="{{ route('tasks') }}"><button class="button">Individual Task</button></a>
                                        <a href="{{ route('careerClubTask') }}" class="active"><button class="button">Career
                                                Club
                                                Task</button></a>
                                    </div>
                                    <div style="width: 100%; height: auto; position: relative;background: #FDFFA9">
                                        <div
                                            style=" color: #8D5D00; font-size: 18px; font-family: Rubik; font-weight: 500; word-wrap: break-word;padding:2px;">
                                        </div>
                                        <menu>
                                            <ul>
                                                <li><a href="{{ route('careerClubTask') }}"
                                                        class="active">Submitted({{ $submitCount }})</a>
                                                </li>
                                                <li><a
                                                        href="{{ route('careerClubTaskPending') }}">Pending({{ $pendingCount }})</a>
                                                </li>
                                                <li><a
                                                        href="{{ route('careerClubTaskOverdue') }}">Overdue({{ $overdueCount }})</a>
                                                </li>
                                                <li><a
                                                        href="{{ route('careerClubTaskResubmit') }}">Resubmit({{ $resubmitCount }})</a>
                                                </li>
                                            </ul>
                                        </menu>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="container">
                                    @foreach ($submitedTasks as $index => $data)
                                        <div class="row">
                                            <div class="col-lg-6  p-2">
                                                <p class="mb-0"><i
                                                        class="fa-solid fa-calendar-check"></i>&nbsp;&nbsp;Task:
                                                    {{ $index + 1 }}
                                                </p>
                                                <p class="mb-0"
                                                    style="font-family: 'Rubik';font-size:18px;font-weight:500;">
                                                    {{ $data->task_name }}</p>
                                                @php
                                                    $studData = json_decode($data->studIds);
                                                @endphp
                                                <p class="mb-0"><i class="fa-regular fa-clock"></i>&nbsp;&nbsp;15 min</p>
                                                <p><i class="fa-solid fa-user-group"></i>&nbsp;&nbsp; Group:
                                                    @foreach ($studData as $value)
                                                        @foreach ($students as $stud)
                                                            @if ($stud->id == $value)
                                                                <img src="{{ asset('stud_images/' . $stud->profile) }}"
                                                                    alt="" width="10%"
                                                                    style="border-radius:20px;">
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </p>
                                            </div>
                                            <div class="col-lg-3">
                                                <p class="mb-0"><i class="fa-solid fa-calendar"></i>&nbsp;&nbsp;Deadline:
                                                </p>
                                                <p class="mb-0"
                                                    style="color: #FF8A00;font-size:18px;font-family:Rubik;font-weight:400;">
                                                    Submitted
                                                </p>

                                                <div class="mt-2" style="font-family:Rubik;">
                                                    <p class="mb-0">Submited
                                                        By: </p>
                                                    <p style="font-size:18px;font-family:Rubik;font-weight:500;">
                                                        {{ Auth::user()->name }}
                                                        (You)
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-12" style="font-family:Rubik;">
                                                <p class="mb-2"><svg width="21" height="21" viewBox="0 0 21 21"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M10.6168 2.60498C6.01434 2.60498 2.2835 6.33581 2.2835 10.9383C2.28171 12.3799 2.65506 13.7972 3.36684 15.0508L2.326 18.175C2.27704 18.3218 2.26993 18.4794 2.30548 18.63C2.34103 18.7807 2.41783 18.9184 2.52728 19.0279C2.63673 19.1373 2.77449 19.2141 2.92513 19.2497C3.07577 19.2852 3.23334 19.2781 3.38017 19.2291L6.50434 18.1875C7.75774 18.8999 9.17511 19.2736 10.6168 19.2716C15.2193 19.2716 18.9502 15.5408 18.9502 10.9383C18.9502 6.33581 15.2193 2.60498 10.6168 2.60498ZM10.6168 7.60498C9.86517 7.60498 9.17434 7.85248 8.61684 8.27165C8.52929 8.33731 8.42967 8.38508 8.32366 8.41224C8.21764 8.4394 8.10732 8.44542 7.99899 8.42994C7.89065 8.41446 7.78643 8.3778 7.69226 8.32204C7.59809 8.26629 7.51583 8.19253 7.45017 8.10498C7.38451 8.01743 7.33674 7.91781 7.30958 7.8118C7.28242 7.70579 7.2764 7.59546 7.29188 7.48713C7.30736 7.37879 7.34402 7.27457 7.39978 7.1804C7.45553 7.08624 7.52929 7.00397 7.61684 6.93831C8.5797 6.21617 9.77074 5.86557 10.9713 5.95089C12.1718 6.03621 13.3013 6.55172 14.1524 7.40278C15.0034 8.25384 15.5189 9.38332 15.6043 10.5839C15.6896 11.7844 15.339 12.9755 14.6168 13.9383C14.4808 14.1051 14.2855 14.2128 14.0718 14.2389C13.8582 14.2649 13.6427 14.2073 13.4706 14.078C13.2985 13.9488 13.1831 13.7579 13.1485 13.5455C13.1139 13.333 13.1629 13.1155 13.2852 12.9383C13.6567 12.443 13.8829 11.8539 13.9384 11.2373C13.9939 10.6206 13.8766 10.0006 13.5996 9.44686C13.3225 8.89311 12.8967 8.42748 12.3699 8.10215C11.843 7.77683 11.236 7.60467 10.6168 7.60498ZM6.45017 10.105C6.67119 10.105 6.88315 10.1928 7.03943 10.3491C7.19571 10.5053 7.2835 10.7173 7.2835 10.9383C7.2835 11.8224 7.63469 12.6702 8.25982 13.2953C8.88494 13.9205 9.73278 14.2716 10.6168 14.2716C10.8379 14.2716 11.0498 14.3594 11.2061 14.5157C11.3624 14.672 11.4502 14.884 11.4502 15.105C11.4502 15.326 11.3624 15.538 11.2061 15.6942C11.0498 15.8505 10.8379 15.9383 10.6168 15.9383C9.29076 15.9383 8.01899 15.4115 7.0813 14.4738C6.14362 13.5362 5.61684 12.2644 5.61684 10.9383C5.61684 10.7173 5.70464 10.5053 5.86092 10.3491C6.0172 10.1928 6.22916 10.105 6.45017 10.105ZM10.6168 9.27165C10.1748 9.27165 9.75089 9.44724 9.43833 9.7598C9.12577 10.0724 8.95017 10.4963 8.95017 10.9383C8.95017 11.3803 9.12577 11.8043 9.43833 12.1168C9.75089 12.4294 10.1748 12.605 10.6168 12.605C11.0589 12.605 11.4828 12.4294 11.7953 12.1168C12.1079 11.8043 12.2835 11.3803 12.2835 10.9383C12.2835 10.4963 12.1079 10.0724 11.7953 9.7598C11.4828 9.44724 11.0589 9.27165 10.6168 9.27165Z"
                                                            fill="#6F6B64" />
                                                    </svg>
                                                    &nbsp;Status:</p>
                                                @if ($data->grp_status == '1')
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalCenter"
                                                        onclick="scheduleCall('{{ $data->id }}','{{ $data->taskID }}','{{ $data->schoolId }}')"
                                                        style="background:#D72727;color:#fff;border-radius:20px;border:none;padding:6px;width:80%;margin-bottom:10px;"
                                                        disabled>Scheduled on {{ $data->scheduleDate }} at
                                                        {{ $data->scheduleTime }}</button>
                                                @else
                                                    {{--  <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalCenter"
                                                        onclick="scheduleCall('{{ $data->id }}','{{ $data->taskID }}','{{ $data->schoolId }}')"
                                                        style="background:#D72727;color:#fff;border-radius:20px;border:none;padding:6px;width:80%;margin-bottom:10px;">Schedule
                                                        a
                                                        call</button>  --}}
                                                    <a href="{{ route('counselling') }}">
                                                        <button type="button" class="btn btn-primary"
                                                            style="background:#D72727;color:#fff;border-radius:20px;border:none;padding:6px;width:80%;margin-bottom:10px;">Schedule
                                                            a
                                                            call</button></a>
                                                @endif
                                                {{-- <button
                                                    style="background:#D72727;color:#fff;border-radius:20px;border:none;padding:6px;width:80%;margin-bottom:10px;">Schedule
                                                    a
                                                    call</button> --}}
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>


                                {{-- <dotlottie-player
                                    src="https://lottie.host/7e719276-3d8d-43c2-b0df-b1dd46d2e9eb/VxAU6IlKCN.json"
                                    background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                                    autoplay></dotlottie-player> --}}
                            </div>
                            {{-- <div class="col-lg-6">
                                <dotlottie-player
                                    src="https://lottie.host/2c406efa-1f05-40e6-b049-76ba38e75599/zCsyNoh59b.json"
                                    background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                                    autoplay></dotlottie-player>
                            </div> --}}
                            {{-- <div class="col-lg-6">
                                <dotlottie-player
                                    src="https://lottie.host/def5fb29-52b8-47b4-b32d-dbf9264e892e/OZ3bEpYAK3.json"
                                    background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                                    autoplay></dotlottie-player>
                            </div> --}}
                            {{-- <div class="col-lg-6">
                                <dotlottie-player
                                    src="https://lottie.host/34de2cfc-d8bf-49b4-9cc8-8a660078320c/sOcy5YUmjM.json"
                                    background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                                    autoplay></dotlottie-player>
                            </div> --}}
                        </div>
                        <div class="row mt-4 mb-4">
                            <div class="col-lg-12 ">
                                <div class="d-flex align-items-center upcoming-task-container">
                                    <div class="task-icon-container">
                                        <dotlottie-player
                                            src="https://lottie.host/7e719276-3d8d-43c2-b0df-b1dd46d2e9eb/VxAU6IlKCN.json"
                                            background="transparent" speed="1" loop autoplay></dotlottie-player>
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-sm-12">
                                        <div class="task-details">
                                            <div class="task-title">Group Tasks</div>
                                            {{-- <div class="d-flex justify-content-between align-items-center">
                                                <div class="task-info">
                                                    <div class="task-name">Write Formal Letters</div>
                                                    <div class="task-date">Tomorrow, 22Mar</div>
                                                </div>
                                                <div
                                                    style="width: 30px; height: 30px; border-radius: 50%; border: 2px solid white; display: inline-flex; justify-content: center; align-items: center;background:#fff;">
                                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.6797 19.064C16.5457 19.064 19.6797 15.93 19.6797 12.064C19.6797 8.19797 16.5457 5.06396 12.6797 5.06396C8.81369 5.06396 5.67969 8.19797 5.67969 12.064C5.67969 15.93 8.81369 19.064 12.6797 19.064Z"
                                                            stroke="black" stroke-width="2" />
                                                        <path
                                                            d="M6.64541 3.2002C5.96701 3.38189 5.34841 3.73899 4.8518 4.23559C4.3552 4.7322 3.9981 5.3508 3.81641 6.0292M18.7154 3.2002C19.3938 3.38189 20.0124 3.73899 20.509 4.23559C21.0056 4.7322 21.3627 5.3508 21.5444 6.0292M12.6804 8.0642V11.8142C12.6804 11.9522 12.7924 12.0642 12.9304 12.0642H15.6804"
                                                            stroke="black" stroke-width="2" stroke-linecap="round" />
                                                    </svg>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12 mt-4 mb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex justify-content-around">
                                            <p style="font-size: 20px; font-weight:400;">Approved Tasks</p>
                                            <a href="{{ route('taskGroupComplete') }}"><i
                                                    class="fa-solid fa-circle-arrow-right"
                                                    style="color: #FDD901;width:100%;height:36px;"></i> </a>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <img src="{{ asset('user/assets/images/star.png') }}" alt=""
                                                width="16%">
                                            <div
                                                style="position: absolute; color: black; font-size: 50px; font-family: Love Ya Like A Sister; font-weight: 400; word-wrap: break-word;">
                                                {{ $completeCount }}</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex justify-content-around">
                                            <p style="font-size: 20px; font-weight:400;">Submitted Tasks</p>
                                            <a href="{{ route('taskGroupSubmitted') }}"> <i
                                                    class="fa-solid fa-circle-arrow-right"
                                                    style="color: #FDD901;width:100%;height:36px;"></i></a>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <img src="{{ asset('user/assets/images/star.png') }}" alt=""
                                                width="16%">
                                            <div
                                                style="position: absolute; color: black; font-size: 50px; font-family: Love Ya Like A Sister; font-weight: 400; word-wrap: break-word;">
                                                {{ $submitCount }}</div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-3"></div> --}}
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
                        <div class="card expert-call-card">
                            <div class="card-body">
                                <div class="expert-call-content">
                                    <div class="call-icon-container">
                                        <dotlottie-player
                                            src="https://lottie.host/cd27ae1f-7d42-472f-9d60-9c753be95955/UxLXoJpDX0.json"
                                            background="transparent" speed="1" loop autoplay></dotlottie-player>
                                    </div>
                                    <div class="call-details">
                                        <h5>Schedule a Expert Call</h5>
                                        <p>Please contact an expert to complete your task.</p>
                                        <button class="btn btn-danger schedule-call-btn">Schedule Call</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <form action="{{ route('scheduleGroupTask') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="grp_id" id="grp_id">
                            <input type="hidden" name="stud_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="task_id" id="task_id">
                            <input type="hidden" name="school_id" id="school_id">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="scheduleDate" class="form-label">Schedule Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="scheduleDate" placeholder="Enter Schedule Date"
                                        class="form-control" id="scheduleDate" style="font-size:14px;color: #95949E;"
                                        required>
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

        function scheduleCall(id, taskId, SchoolId) {
            document.getElementById('grp_id').value = id;
            document.getElementById('task_id').value = taskId;
            document.getElementById('school_id').value = SchoolId;
        }
    </script>
@endsection
