@extends('admin.layout.master')
@section('container')
    <div class="app-wrapper">
        <style>
            @media (max-width: 767px) {
                .col-12 {
                    padding: 10px;
                    /* Decrease padding for mobile */
                }

                .text-container {
                    padding-top: 30px;
                    /* Decrease top padding for mobile */
                    padding-bottom: 30px;
                    /* Decrease bottom padding for mobile */
                }

                .text-container h1 {
                    font-size: 24px;
                    /* Further decrease font size for smaller screens */
                }

                .text-container p {
                    font-size: 16px;
                    /* Further decrease font size for smaller screens */
                    margin-top: 15px;
                    /* Further decrease margin for smaller screens */
                }

                .statistic .icon {
                    font-size: 20px;
                    /* Further decrease font size for smaller screens */
                }

                .statistic .number {
                    font-size: 18px;
                    /* Further decrease font size for smaller screens */
                }
            }
        </style>
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row">
                    <div class="col-12"
                        style="background-image: url('{{ asset('admin/assets/images/dashbg.png') }}');background-repeat:no-repeat; background-size: cover;  margin-left:0px;">
                        <div class="row">
                            <div class=" col-lg-8 col-sm-12">
                                <p class="text-lg-start"
                                    style="font-family: Rubik; font-size:40px; font-weight:400; margin-left:30px;margin-top:60px;color:#000;">
                                    Empowering Your Career Journey</p>
                                <p class="text-lg-start "
                                    style="font-family: Rubik; font-size:22px; font-weight:300; margin-left:30px;margin-top:25px;">
                                    Empowering individuals to navigate their
                                    professional journey with clarity, confidence, and
                                    purpose through strategic career counseling.</p>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                        <div class="row mt-4" style=" margin-left:30px; margin-bottom:60px;">
                            <div class="col-lg-3 col-sm-6">
                                <div class="row">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;margin-top:10px;">
                                        <i class='fas fa-user-circle'
                                            style='font-size:28px; margin:10px 0 0 0;color: #fff;'></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:30px; font-weight:400;color: #000;">
                                            <a href="{{ route('admin.expert') }}"> Experts</a>
                                        </p>
                                        <p
                                            style="font-family: Rubik; font-size:25px; font-weight:400;color: #000; margin-top:-18px;">
                                            {{ $expert }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="row">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;margin-top:10px;">
                                        <i class="fa-solid fa-graduation-cap"
                                            style='font-size:24px; margin:12px 2px 0 0;color: #fff;'></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:30px; font-weight:400;color: #000;">
                                            <a href="{{ route('admin.studentlist') }}">Students</a>
                                        </p>
                                        <p
                                            style="font-family: Rubik; font-size:25px; font-weight:400;color: #000; margin-top:-18px;">
                                            {{ $student }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="row">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;margin-top:10px;">
                                        <i class="fa fa-school"
                                            style='font-size:22px; margin:12px 2px 0 0;color: #fff;'></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:30px; font-weight:400;color: #000;">
                                            <a href="{{ route('admin.schoollist') }}"> Schools</a>
                                        </p>
                                        <p
                                            style="font-family: Rubik; font-size:25px; font-weight:400;color: #000; margin-top:-18px;">
                                            {{ $school }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card mt-4"
                            style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;border-radius:20px;">
                            <div class="row mt-4" style="margin-left:20px;">
                                <div class="col-12 text-end">
                                    <a class="" href="{{ route('analyticspdf') }}" style="margin-right: 7px;">
                                        <i class='fa-solid fa-file-arrow-down '
                                            style='font-size:41px;color:green;margin-bottom: -10px;'></i>
                                    </a>
                                </div>
                                <div class="col-3"
                                    style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;margin-top:10px;">
                                    <img src="{{ asset('admin/assets/images/dashtask.png') }}" alt=""
                                        style="width: 120%;padding:7px 0 0 0px;">
                                </div>
                                <div class="col-9">
                                    <p
                                        style="font-family: Rubik; font-size:35px; font-weight:420;color: #000;margin-top:10px;">
                                        Tasks</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-12  mb-2">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-1 offset-lg-1"
                                            style="width:40px; height:40px; border-radius:50%; background-color:#FFE235;margin-top:10px;">
                                            <i class='fas fa-user-alt'
                                                style='font-size:23px;color:#fff;margin:6px 0 0 -4px;'></i>
                                        </div>
                                        <div class="col-8">
                                            <p
                                                style="font-family: Rubik; font-size:27px; font-weight:430;color: #000;margin-top:10px;margin-left:5px;">
                                                <a href="{{ route('admin.previousTaskList') }}"> Individual Tasks</a>
                                            </p>
                                        </div>
                                        <div class="col-lg-5 offset-lg-4" style="">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin:0 10px 0 10px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Total</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;padding:0 0 10px 0;">
                                                    {{ $inditask }}</P>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 offset-lg-1 " style="">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin:0 10px 0 10px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Submitted</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;padding:0 0 10px 0;">
                                                    {{ $sinditask }}</P>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 offset-lg-1 " style="">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin:0 10px 0 10px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Overdue</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;padding:0 0 10px 0;">
                                                    {{ $oinditask }}</P>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 offset-lg-1 " style="">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin:0 10px 0 10px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Pending</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;padding:0 0 10px 0;">
                                                    {{ $pinditask }}</P>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 offset-lg-1 " style="">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin:0 10px 0 10px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Completed</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;padding:0 0 10px 0;">
                                                    {{ $cinditask }}</P>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12  mb-2">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-1 offset-lg-1"
                                            style="width:40px; height:40px; border-radius:50%; background-color:#FFE235;margin-top:10px;">
                                            <i class='fas fa-users'
                                                style='font-size:23px;color:#fff;margin:9px 0 0 -7px;'></i>
                                        </div>
                                        <div class="col-8">
                                            <p
                                                style="font-family: Rubik; font-size:27px; font-weight:430;color: #000;margin-top:10px;margin-left:5px;">
                                                <a href="{{ route('admin.previousTaskList') }}"> Group Tasks</a>
                                            </p>
                                        </div>
                                        <div class="col-lg-5 offset-lg-3" style="">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin:0 10px 0 10px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Total</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;padding:0 0 10px 0;">
                                                    {{ $grtask }}</P>
                                            </div>
                                        </div>
                                        <div class="col-lg-5  " style="">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin:0 10px 0 10px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Submitted</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;padding:0 0 10px 0;">
                                                    {{ $sgrtask }}</P>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 offset-lg-1 " style="">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin:0 10px 0 10px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Overdue</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;padding:0 0 10px 0;">
                                                    {{ $ogrtask }}</P>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 " style="">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin:0 10px 0 10px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Pending</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;padding:0 0 10px 0;">
                                                    {{ $pgrtask }}</P>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 offset-lg-1 " style="">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin:0 10px 0 10px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Completed</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;padding:0 0 10px 0;">
                                                    {{ $cgrtask }}</P>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12">
                                <div class="card mt-4"
                                    style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;border-radius:20px;">
                                    <div class="row mt-4" style="margin-left:20px;">
                                        <div class="col-2"
                                            style="width:40px; height:40px; border-radius:50%; background-color:#FFE235;margin-top:10px;">
                                            <img src="{{ asset('admin/assets/images/dashin.png') }}" alt=""
                                                style="width: 160%;margin:7px 1px 0 -5px;">
                                        </div>
                                        <div class="col-9">
                                            <p
                                                style="font-family: Rubik; font-size:31px; font-weight:430;color: #000;margin-top:10px;">
                                                <a href="{{ route('admin.internshiplist') }}"> Internships</a>
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin-left:-12px;margin-right:12px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Total</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;">
                                                    {{ $internship }}</P>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="card mt-4"
                                    style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;border-radius:20px;">
                                    <div class="row mt-4" style="margin-left:20px;">
                                        {{--  <div class="col-3"></div>  --}}
                                        <div class="col-lg-2 offset-lg-3 col-2"
                                            style="width:40px; height:40px; border-radius:50%; background-color:#FFE235;margin-top:10px;">
                                            <img src="{{ asset('admin/assets/images/dashdm.png') }}" alt=""
                                                style="width: 160%;margin:7px 1px 0 -5px;">
                                        </div>
                                        <div class="col-lg-7 col-9 ">
                                            <p
                                                style="font-family: Rubik; font-size:31px; font-weight:430;color: #000;margin-top:10px;">
                                                <a href="{{ route('admin.dmsession') }}"> DM Sessions</a>
                                            </p>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin-left:-12px;margin-right:12px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Scheduled</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;">
                                                    {{ $dmsession }}
                                                </P>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin-left:-12px;margin-right:12px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Completed</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;">
                                                    {{ $comdmsession }}
                                                </P>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="card mt-4"
                                    style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;border-radius:20px;">
                                    <div class="row mt-4" style="margin-left:20px;">
                                        <div class="col-2"
                                            style="width:40px; height:40px; border-radius:50%; background-color:#FFE235;margin-top:10px;">
                                            <img src="{{ asset('admin/assets/images/dashw.png') }}" alt=""
                                                style="width: 160%;margin:7px 1px 0 -5px;">
                                        </div>
                                        <div class="col-9">
                                            <p
                                                style="font-family: Rubik; font-size:31px; font-weight:430;color: #000;margin-top:10px;">
                                                <a href="{{ route('admin.workshop') }}"> Workshops</a>
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <div
                                                style="background: #FFF8D1;border-radius:10px; text-align:center;margin-left:-12px;margin-right:12px;">
                                                <p
                                                    style="font-family: Rubik; font-size:22px; font-weight:450;color: #000;padding:10px 0 0 0;">
                                                    Done Workshops</P>
                                                <p
                                                    style="font-family: Rubik; font-size:26px; font-weight:400;color: #000;margin-top:-20px;">
                                                    {{ $workshop }}</P>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!--//container-fluid-->
        </div><!--//app-content-->
    @endsection
