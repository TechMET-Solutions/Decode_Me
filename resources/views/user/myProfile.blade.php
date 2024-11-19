@extends('user.layout.master')
@section('content')
    <style>
        .profileData li h5,
        p {
            font-family: 'Rubik';
        }
    </style>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 col-md-12">
                        <div class="card p-2" style="overflow: hidden;border-radius:24px; background:#FEFFC2">
                            <div class="" style="margin-left:110px;margin-bottom:-80px;">
                                <h5>{{ Auth::user()->name }}</h5>
                                <p>Std: {{ Auth::user()->std }}</p>
                            </div>
                            <div style="text-align: end; margin-top:10px;">
                                <a href="{{ route('editStudent', Auth::user()->id) }}">
                                    <i class='fas fa-edit' style='font-size:30px; color:green;'></i>
                                </a>
                            </div>
                            <div class="myProfile">
                                <img
                                    src="{{ asset(Auth::user()->profile ? 'stud_images/' . Auth::user()->profile : 'stud_images/DefaultUserimg.png') }}"class="img-fluid" />
                            </div>
                            <div>
                                <div class="" style="margin-left:110px; margin-top:-40px;">
                                    <p class="mb-0">Email Id: {{ Auth::user()->email }}</p>
                                    <p>Contact No.: +91 {{ Auth::user()->mobile }}</p>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('completeProfile') }}">
                                        <button
                                            style="border-radius:30px; background:#71BF0D;border:none;color:#fff;padding:6px;width:40%;">Complete
                                            Profile</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <ul class="profileData" style="background:#fff;">
                                <li>
                                    <h5>Personal Information</h5>
                                    <p class="mb-0">DOB: <b>{{ Auth::user()->dob }}</b></p>
                                    <p>Contact No.: <b>+91{{ Auth::user()->mobile }}</b></p>
                                    <hr>
                                </li>
                                <li>
                                    <h5>School Information</h5>
                                    <p class="mb-0">School Name: <b>{{ $school->school_name ?? '' }}</b></p>
                                    <p>School Contact no: <b>+91 {{ $school->school_contact ?? '' }}</b></p>
                                    <hr>
                                </li>
                                <li>
                                    <h5>Parent’s Information</h5>
                                    <p class="mb-0">Father Name: <b>{{ Auth::user()->fatherName }}</b></p>
                                    <p class="mb-0">Father’s Contact no: <b>+91 {{ Auth::user()->fatherPhone }}</b></p>
                                    <p class="mb-0">Mother Name: <b>{{ Auth::user()->motherName }}</b></p>
                                    <p>Mother’s Contact no: <b>+91 {{ Auth::user()->motherPhone }}</b></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card p-3" style="overflow: hidden;border-radius:24px; background:#fff">
                            <div class="d-flex">
                                <img src="{{ asset('user/assets/images/a1.png') }}" alt="">&nbsp;&nbsp;
                                <p style="font-family: Love Ya Like A Sister;font-size:20px;font-weight:400;">Upcomoning
                                    Workshop</p>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-sm-12">
                                    <p style="font-size:14px;font-weight:500;">Career Quest: Guiding Children to Success</p>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <p><span style="color:#D72727">24th Mar</span><br>By- Dr. Nina Shah</p>
                                </div>
                                <div class="col-lg-4 col-sm-12"><button
                                        style="background:#8D5D00;color:#FDD901;border-radius:20px;border:none;padding:6px;">View
                                        Details</button>
                                </div>
                            </div>
                        </div>
                        <div class="card p-3 mt-4" style="overflow: hidden;border-radius:24px; background:#fff">
                            <div class="d-flex">
                                <img src="{{ asset('user/assets/images/a2.png') }}" alt=""
                                    class="img-fluid">&nbsp;&nbsp;
                                <p style="font-family: Love Ya Like A Sister;font-size:20px;font-weight:400;">Personal
                                    Counselling</p>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <p style="font-size:14px;font-weight:500;">Your Assigned Expert:
                                        <b>{{ Auth::user()->expert }}</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card p-3 mt-4" style="overflow: hidden;border-radius:24px; background:#fff">
                            <div class="d-flex">
                                <img src="{{ asset('user/assets/images/a3.png') }}" alt=""
                                    class="img-fluid">&nbsp;&nbsp;
                                <p style="font-family: Love Ya Like A Sister;font-size:20px;font-weight:400;">Tasks</p>
                            </div>
                            <div class="text-center">
                                <div class="d-flex justify-content-center align-items-center mb-0">
                                    <dotlottie-player
                                        src="https://lottie.host/d5b2e1e9-798a-4d85-9eb5-e9ca70e72fa6/Eq0FvSrzXT.json"
                                        background="transparent" speed="1" style="width: 100px; height: 100px;" loop
                                        autoplay></dotlottie-player>
                                </div>
                                <p style="color:#D72727">Yet to start Task</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <div class="container">
                            <p style="font-family: Love Ya Like A Sister;font-size:30px;font-weight:600;">My Journey
                            </p>
                            <div class="row">
                                <div class="col-md-2 offset-lg-1">
                                    <div class="text-center mt-2 mb-2">
                                        @if ($attendedWorkshop == true)
                                            <button
                                                style="background:#71BF0D; color:#fff;border:none; border-radius:20px;padding:6px;width:70%">Completed</button>
                                        @else
                                            <p style="color: #71BF0D">Yet to reach</p>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center mt-2 mb-2">
                                        {{-- <button>Completed</button> --}}
                                        @if ($dmsession)
                                            <button
                                                style="background:#71BF0D; color:#fff;border:none; border-radius:20px;padding:6px;width:70%">Completed</button>
                                        @else
                                            <p style="color: #71BF0D">Yet to reach</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center mt-2">
                                        @if ($studentTask)
                                            <button
                                                style="background:#71BF0D; color:#fff;border:none; border-radius:20px;padding:6px;width:70%">Completed</button>
                                        @else
                                            <p style="color: #71BF0D">Yet to reach</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center mt-2">
                                        @if ($studentCareerOption)
                                            <button
                                                style="background:#71BF0D; color:#fff;border:none; border-radius:20px;padding:6px;width:70%">Completed</button>
                                        @else
                                            <p style="color: #71BF0D">Yet to reach</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center mt-2">
                                        @if ($internship)
                                            <button
                                                style="background:#71BF0D; color:#fff;border:none; border-radius:20px;padding:6px;width:70%">Completed</button>
                                        @else
                                            <p style="color: #71BF0D">Yet to reach</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 offset-lg-1">
                                    <div class="text-center mt-2">
                                        <img src="{{ asset('user/assets/images/l1.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center mt-2">
                                        <img src="{{ asset('user/assets/images/l2.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center mt-2">
                                        <img src="{{ asset('user/assets/images/l3.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center mt-2">
                                        <img src="{{ asset('user/assets/images/l4.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center mt-2">
                                        <img src="{{ asset('user/assets/images/l5.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div style="width: 100%; height: 0px; border: 4px #442D00 dotted">
                                <div class="row">
                                    <div class="col-md-2 offset-lg-1">
                                        <div class="text-center mt-2">
                                            <p style="font-weight:500;">Workshop</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="text-center mt-2">
                                            <p style="font-weight:500;">Personal Counselling</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="text-center mt-2">
                                            <p style="font-weight:500;">Tasks</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="text-center mt-2">
                                            <p style="font-weight:500;">Career Elimination <br>
                                                with a Expert</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="text-center mt-2">
                                            <p style="font-weight:500;">Internship</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
