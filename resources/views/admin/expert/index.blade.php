@extends('admin.layout.master')
@section('container')
    <style>
        thead th {
            background-color: #FFE235 !important;
            padding: 0 20px;
            {{--  color: white !important;  --}}
        }

        tbody td {
            background-color: #fff !important;
        }

        @media (max-width: 768px) {
            .custom-margin {
                margin-left: 10px !important;
            }
        }
    </style>
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <x-session-message />
                <div class="row" style="display: flex; justify-content: space-between;">
                    <div class="col-lg-10 col-sm-10">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Expert List</p>
                    </div>
                    <div class="col-lg-2  col-sm-2 text-end mt-4">
                        <a class="" href="{{ route('generateExpertPDF') }}" style="margin-right: 7px;">
                            <i class='fa-solid fa-file-arrow-down '
                                style='font-size:41px;color:green;margin-bottom: -10px;'></i>
                        </a>
                        <a href="{{ route('admin.addexpert') }}" class="btn"
                            style="background: #FFE235;
                        font-size:18px; ">+Add
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class=" table-responsive mt-2 ">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email Id</th>
                                        <th>Qualification</th>
                                        <th>Occupation</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expert as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><a data-bs-toggle="modal" data-bs-target="#viewExpertModal"
                                                    onclick="getExpertData('{{ $data->id }}')"
                                                    style="font-size:18px; font-weight:600; text-decoration:underline;color:green;">{{ $data->name }}</a>
                                            </td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->qualification }}</td>
                                            <td>{{ $data->occupation }}</td>
                                            <td style="text-align: center;">
                                                <a href="{{ route('admin.editexpert', $data->id) }}">
                                                    <button class="btn btn-success green-color no-boundary mt-1"><i
                                                            class="fas fa-pencil-alt"></i></button>
                                                </a>
                                                <a href=" {{ route('admin.deleteexpert', $data->id) }} "
                                                    onclick="return confirm('Are you sure you want to delete this data?');"
                                                    class="btn btn-danger red-color mt-1"><i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-lg" id="viewExpertModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #FFE235; height:100% !important;">
                    <div style="height: 80px;"></div>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <img id="expert_photo" alt="expert_image" class="rounded-circle" width="160" height="160"
                            style="margin-left:50px;margin-top:-50px; border:5px solid #fff ;">
                        <p>
                        <div style="margin-left:65px;font-family: Rubik; font-size:30px; font-weight:500;margin-top:-20px;">
                            <input type="text" id="expert_name" style="border:none;" readonly>
                        </div>
                        </p>
                        {{--  <p
                            style="margin-left:80px;margin-top:-25px;font-family: Rubik; font-size:24px; font-weight:400;color:gray;">
                            Expert</p>  --}}
                    </div>
                    <button type="button" class="btn-close btn-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col-lg-6 col-sm-12">
                                <div class="row custom-margin mt-2" style="margin-left: 40px;">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                        <i class="fa-solid fa-phone"
                                            style="font-size:25px; margin:12px 3px 0 0; color: #646060;"></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                            Contact Number</p>
                                        <p
                                            style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                        <div>
                                            <input type="text" id="expert_phone" style="border:none;" readonly>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="row custom-margin mt-2" style="margin-left: 40px;">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">

                                        <i class="fa-solid fa-envelope"
                                            style="font-size:25px; margin:12px 3px 0 0; color: #646060;"></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                            Expert Email</p>
                                        <p
                                            style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                        <div>
                                            <input type="text" id="expert_email" style="border:none;" readonly>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="row custom-margin mt-2" style="margin-left: 40px;">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">

                                        <i class="fa-solid fa-calendar-days"
                                            style="font-size:25px; margin:12px 2px 0 3px; color: #646060;"></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                            Date Of Birth</p>
                                        <p
                                            style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                        <div>
                                            <input type="text" id="expert_date_of_birth" style="border:none;" readonly>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="row custom-margin mt-2" style="margin-left: 40px;">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                        <i class="fas fa-user-graduate"
                                            style="font-size:25px; margin:12px 2px 0 2px; color: #646060;"></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                            Qualification</p>
                                        <p
                                            style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                        <div>
                                            <input type="text" id="expert_qualification" style="border:none;"
                                                readonly>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="row custom-margin mt-2" style="margin-left: 40px;">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                        <i class="fa-solid fa-graduation-cap"
                                            style="font-size:25px; margin:12px 2px 0 2px; color: #646060;"></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                            Occupation</p>
                                        <p
                                            style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                        <div>
                                            <input type="text" id="expert_occupation" style="border:none;" readonly>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="row custom-margin mt-2" style="margin-left: 40px;">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">

                                        <i class="fa-solid fa-graduation-cap"
                                            style="font-size:25px; margin:12px 3px 0 0; color: #646060;"></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                            Designation</p>
                                        <p
                                            style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                        <div>
                                            <input type="text" id="expert_designation" style="border:none;" readonly>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 ">
                                <div class="row custom-margin mt-2" style="margin-left: 40px;">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">

                                        <i class="fas fa-building"
                                            style="font-size:25px; margin:12px 2px 0 3px; color: #646060;"></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                            Department</p>
                                        <p
                                            style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                        <div>
                                            <input type="text" id="expert_department" style="border:none;" readonly>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="row custom-margin mt-2" style="margin-left: 40px;">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">

                                        <i class="fas fa-book-reader"
                                            style="font-size:25px; margin:12px 2px 0 3px; color: #646060;"></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                            Expertise</p>
                                        <p
                                            style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                        <div>
                                            <input type="text" id="expert_expertise" style="border:none;" readonly>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="row custom-margin mt-2" style="margin-left: 40px;">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                        <i class="fa-solid fa-building-columns"
                                            style="font-size:25px; margin:12px 2px 0 3px; color: #646060;"></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                            Name as(Account Holder)</p>
                                        <p
                                            style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                        <div>
                                            <input type="text" id="expert_bank_account_holder_name"
                                                style="border:none;" readonly>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="row custom-margin mt-2 " style="margin-left: 40px;">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                        <i class="fa-solid fa-building-columns"
                                            style="font-size:25px; margin:12px 2px 0 3px; color: #646060;"></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                            Account Number</p>
                                        <p
                                            style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                        <div>
                                            <input type="text" id="expert_account_number" style="border:none;"
                                                readonly>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="row custom-margin mt-2" style="margin-left: 40px;">
                                    <div class="col-4"
                                        style="width:50px; height:50px; border-radius:50%; background-color:#FFE235;">
                                        <i class="fa-solid fa-calendar-days"
                                            style="font-size:25px; margin:12px 2px 0 3px; color: #646060;"></i>
                                    </div>
                                    <div class="col-8">
                                        <p style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;">
                                            Date Of Joining</p>
                                        <p
                                            style="font-family: Rubik; font-size:20px; font-weight:400;color: #000; margin-top:-14px;">
                                        <div>
                                            <input type="text" id="expert_date_of_join" style="border:none;" readonly>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 ">
                                <div class="row custom-margin mt-2" style="margin-left: 40px;">
                                    <div class="col-lg-6 col-sm-12">
                                        <p
                                            style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;margin-left:40px;">
                                            Aadhar Card</p>
                                        <img id="expert_aadhar_card" height="120" width="130"
                                            style=" margin-left:40px; border-radius:5px;" alt="Aadhar_image">
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <p
                                            style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;margin-left:40px;">
                                            Pan Card</p>
                                        <img id="expert_pan_card" height="120" width="130"
                                            style=" margin-left:40px; border-radius:5px;" alt="Pan_image">
                                        </p>
                                    </div>
                                </div>
                                {{--  <div class="row custom-margin" style="margin-left: 40px;">
                                    <div class="col-12">
                                        <p
                                            style="font-family: Rubik; font-size:16px; font-weight:400;color: #95949E;margin-left:40px;">
                                            Aadhar Card</p>
                                        <img id="expert_pan_card" height="120" width="130"
                                            style=" margin-left:40px; border-radius:5px;" alt="Pan_image">
                                        </p>
                                    </div>
                                </div>  --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        var expertData = @json($expert);

        function getExpertData(id) {
            let expert = expertData.find(p => p.id == id);
            // console.log(expert.id);
            document.getElementById('expert_name').value = expert.name;
            document.getElementById('expert_phone').value = expert.phone;
            document.getElementById('expert_email').value = expert.email;
            document.getElementById('expert_date_of_birth').value = expert.date_of_birth;
            document.getElementById('expert_qualification').value = expert.qualification;
            document.getElementById('expert_occupation').value = expert.occupation;
            document.getElementById('expert_designation').value = expert.designation;
            document.getElementById('expert_department').value = expert.department;
            document.getElementById('expert_expertise').value = expert.expertise;
            document.getElementById('expert_bank_account_holder_name').value = expert.bank_account_holder_name;
            document.getElementById('expert_account_number').value = expert.account_number;
            document.getElementById('expert_date_of_join').value = expert.date_of_join;
            //document.getElementById('expert_photo').value = expert.photo;
            var expertImage = document.getElementById('expert_photo');
            expertImage.src = '{{ asset('images') }}/' + expert.photo;
            //console.log('{{ asset('images') }}/' + expert.photo);
            //document.getElementById('expert_aadhar_card').value = expert.aadhar_card;
            var aadharImage = document.getElementById('expert_aadhar_card');
            aadharImage.src = '{{ asset('images') }}/' + expert.aadhar_card;
            //console.log('{{ asset('images') }}/' + expert.aadhar_card);
            //document.getElementById('expert_pan_card').value = expert.pan_card;
            var panImage = document.getElementById('expert_pan_card');
            panImage.src = '{{ asset('images') }}/' + expert.pan_card;
            //console.log('{{ asset('images') }}/' + expert.pan_card);
        }
    </script>
@endsection
