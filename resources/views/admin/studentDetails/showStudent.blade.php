@extends('admin.layout.master')
@section('container')
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row">
                    {{--  <div class="col-lg-12 col-sm-12">  --}}
                    <p style="font-family: Rubik; font-size:38px; font-weight:500;">Student Details</p>
                    {{--  </div>  --}}
                    <div class="col-lg-8 col-sm-12 mb-4">
                        <div class="card" style="border:none;box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); width:100%;">
                            <div class="card-header" style="background: #FFE235; height:100% !important;">
                                <div style="height: 80px;"></div>
                            </div>

                            <div class="  d-flex justify-content-between">
                                <div>
                                    <img src="{{ asset($studentDetail->profile ? 'stud_images/' . $studentDetail->profile : 'stud_images/DefaultUserimg.png') }}"
                                        alt="student_image" class="rounded-circle" width="160" height="160"
                                        style="margin-left:50px;margin-top:-50px; border:5px solid #fff ;">
                                    <p style="margin-left:65px;font-family: Rubik; font-size:30px; font-weight:500;">
                                        {{ $studentDetail->name }}</p>
                                    <p
                                        style="margin-left:80px;margin-top:-25px;font-family: Rubik; font-size:24px; font-weight:400;color:gray;">
                                        Student</p>
                                </div>
                                <a href="{{ route('admin.editstudent', $studentDetail->id) }}"> <i class='fas fa-edit'
                                        style='font-size:30px; color:green;padding:15px 15px;'></i></a>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-3 col-sm-12" style="margin-left: 55px;">
                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fas fa-phone"
                                                style="font-size:25px; margin:12px 3px 0 0; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Contact no.</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->mobile }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-envelope"
                                                style="font-size:25px; margin:12px 3px 0 0; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Email Id</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->email }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-12" style="margin-left: 55px;">
                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-graduation-cap"
                                                style="font-size:25px; margin:12px 3px 0 0;color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Grade</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->std }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-calendar-days"
                                                style="font-size:26px; margin:12px 2px 0 0;color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Date of Birth</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->dob }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3 col-sm-12" style="margin-left: 55px;">

                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-calendar-days"
                                                style="font-size:26px; margin:12px 2px 0 0;color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Date of Enrollment </p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->enrollDate }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-sm-12 " style="margin-left: 55px;">
                                    <div class="row custom-margin mt-2" style="margin-left: 40px;">
                                        <div class="col-lg-6 col-sm-12">
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;margin-left:40px;">
                                                Aadhar Card</p>
                                            <img img src="{{ asset('stud_images/' . $studentDetail->aadhaar) }}"
                                                height="120" width="130" style=" margin-left:40px; border-radius:5px;"
                                                alt="Aadhar_image">
                                            </p>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;margin-left:40px;">
                                                Pan Card</p>
                                            <img img src="{{ asset('stud_images/' . $studentDetail->pan) }}" height="120"
                                                width="130" style=" margin-left:40px; border-radius:5px;"
                                                alt="Pan_image">
                                            </p>
                                        </div>
                                    </div>

                                </div>

                                <p style="font-faily:Rubik; font-size:26px; font-weight:500;margin-left:45px;">Personal
                                    Details</p>

                                <div class="col-lg-3 col-sm-12" style="margin-left: 55px;">
                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-user"
                                                style="font-size:26px; margin:12px 2px 0 0; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Father Name</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->fatherName }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-phone"
                                                style="font-size:26px; margin:12px 3px 0 0; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Father Contact No.</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->fatherPhone }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3 col-sm-12" style="margin-left: 55px;">
                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-graduation-cap"
                                                style="font-size:25px; margin:12px 3px 0 0;color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Father Occupation</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->fatherOccupation }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-user"
                                                style="font-size:26px; margin:12px 2px 0 0;color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Mother Name</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->motherName }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-12" style="margin-left: 55px;">


                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-phone"
                                                style="font-size:25px; margin:12px 3px 0 0;color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Mother Contact no.</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->motherPhone }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-graduation-cap"
                                                style="font-size:25px; margin:12px 3px 0 0;color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Mother Occupation</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->motherOccupation }}</p>
                                        </div>
                                    </div>

                                </div>

                                <p style="font-faily:Rubik; font-size:26px; font-weight:500;margin-left:45px;">School
                                    Details</p>
                                <div class="col-lg-3 col-sm-12" style="margin-left: 55px;">
                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa fa-school"
                                                style="font-size:25px; margin:12px 0 0 -2px; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                School Name</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $school->school_name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-12" style="margin-left: 55px;">
                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-phone"
                                                style="font-size:25px; margin:12px 3px 0 0;color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                School Contact no.</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $school->school_contact }}</p>
                                        </div>
                                    </div>

                                </div>

                                <p style="font-faily:Rubik; font-size:26px; font-weight:500;margin-left:45px;">Bank
                                    Details</p>
                                <div class="col-lg-3 col-sm-12" style="margin-left: 55px;">
                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-user"
                                                style="font-size:25px; margin:12px 0 0 -2px; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Name (As Account Holder)</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->bank_holder_name }}
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3 col-sm-12" style="margin-left: 55px;">

                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-building-columns"
                                                style="font-size:25px; margin:12px 0 0 -1px; color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Bank Name</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->bank_name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-12" style="margin-left: 55px;">
                                    <div class="row">
                                        <div class="col-4"
                                            style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                            <i class="fa-solid fa-piggy-bank"
                                                style="font-size:25px; margin:12px 3px 0 0;color: #646060;"></i>
                                        </div>
                                        <div class="col-8">
                                            <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                                Bank Account Number</p>
                                            <p
                                                style="font-family: Rubik; font-size:16px; font-weight:400;color: #000; margin-top:-14px;">
                                                {{ $studentDetail->bank_acc_no }}</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-12">
                        <div class="card">
                            <p
                                style="font-family: Rubik; font-size:16px; font-weight:400; margin-left:22px; margin-top:25px;">
                                <img src="{{ asset('images/recounselor.png') }}" alt=""> &nbsp; Personal
                                Counselling
                            </p>
                            <p
                                style="font-family: Rubik; font-size:16px; font-weight:400; margin-left:22px; margin-top:-8px;">
                                Your Assigned Expert:<span style="font-weight: 500;"> {{ $studentDetail->expert }}</span>
                            </p>
                            <div class="text text-center mb-4">
                                <button style="width:160px;background: #FD5E3A; border-radius:10px; border:none; ">
                                    <p
                                        style="color:#fff; font-family:Rubik; font-size:18px; font-weight:500;margin:5px 0;">
                                        Re
                                        Counselor
                                    </p>
                                </button>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <p
                                style="margin-left: 22px; margin-top:25px; font-family:Rubik; font-size:16px; font-weight:500; ">
                                Upcoming Workshop</p>
                            @foreach ($workshops as $data)
                                <div>
                                    <p
                                        style="margin-left: 22px; margin-top:0; font-family:Rubik; font-size:16px; font-weight:400; ">
                                        {{ $data->topic }}</p>
                                    <p
                                        style="margin-left: 22px; margin-top:-15px; font-family:Rubik; font-size:14px; font-weight:400;color:#FC542D;">
                                        {{ \Carbon\Carbon::parse($data->start_date)->format('d F') }}</p>
                                </div>
                            @endforeach

                            <p
                                style="margin-left: 22px; margin-top:16px; font-family:Rubik; font-size:16px; font-weight:500; ">
                                Previous Workshop</p>
                            @foreach ($prevWorkshops as $data)
                                <div>
                                    <p
                                        style="margin-left: 22px; margin-top:0; font-family:Rubik; font-size:16px; font-weight:400; ">
                                        {{ $data->topic }}</p>
                                    <div class="row">
                                        <div class="col-8 ">
                                            <p
                                                style="margin-left: 22px; margin-top:-15px; font-family:Rubik; font-size:14px; font-weight:400;color:#FC542D;">
                                                {{ \Carbon\Carbon::parse($data->start_date)->format('d F') }}</p>
                                        </div>
                                        <div class="col-4 ">
                                            <p
                                                style="margin-left: 22px; margin-top:-15px; font-family:Rubik; font-size:14px; font-weight:400;color:#05922D;">
                                                Attended</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card mt-4">
                            <p
                                style="margin-left: 22px; margin-top:25px; font-family:Rubik; font-size:21px; font-weight:500; ">
                                Upcoming Task</p>
                            <div class="row mb-2">
                                @foreach ($upcomingTask as $data)
                                    <div class="col-7">
                                        <p
                                            style="margin-left: 22px; margin-top:0; font-family:Rubik; font-size:17px; font-weight:400; ">
                                            {{ $data->task_name }}</p>
                                    </div>
                                    <div class="col-5">
                                        <p
                                            style="margin-left: 0px; margin-top:2px; font-family:Rubik; font-size:13px; font-weight:400;color:#FC542D;">
                                            {{ \Carbon\Carbon::parse($data->deadlineDate)->format('d F') }}</p>
                                    </div>
                                @endforeach

                                <p
                                    style="margin-left: 22px; margin-top:0px; font-family:Rubik; font-size:21px; font-weight:500; ">
                                    Previous Task</p>
                                @foreach ($previousTask as $data)
                                    <div class="col-7">
                                        <p
                                            style="margin-left: 22px; margin-top:0; font-family:Rubik; font-size:17px; font-weight:400; ">
                                            {{ $data->task_name }}</p>
                                    </div>
                                    <div class="col-2">
                                        <button
                                            style="width:90px;background: #6BC14C; border-radius:10px; border:none;margin-left:-30px; ">
                                            <p
                                                style="color:#fff; font-family:Rubik; font-size:11px; font-weight:500;margin:1px 0;">
                                                Attended
                                            </p>
                                        </button>
                                    </div>
                                    <div class="col-3">
                                        <p
                                            style="margin-left: 3px; margin-top:3px; font-family:Rubik; font-size:12px; font-weight:400;color:#FC542D;">
                                            {{ \Carbon\Carbon::parse($data->deadlineDate)->format('d F') }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
