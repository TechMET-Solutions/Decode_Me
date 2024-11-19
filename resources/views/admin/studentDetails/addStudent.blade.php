@extends('admin.layout.master')
@section('container')
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <form action="{{ route('admin.storestudent') }}" method="post" style="margin-left: 10px;"
                    enctype="multipart/form-data">
                    @csrf
                    <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Add New Student</p>
                    <div class="card" style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;">
                        <p
                            style="font-family: Rubik; font-size:26px; font-weight:500px; color:#000; padding: 20px 0 0 20px;">
                            Add Student Details</p>
                        <hr style="margin-top: -10px;">
                        <div class="row" style="font-family: Rubik; font-size:18px;color:#4E4D55; padding:20px;">

                            <div class="col-lg-2 col-sm-12">
                                <div class="mb-3">
                                    <label for="stud_image" class="form-label">Photo
                                        {{-- <span class="text text-danger">*</span> --}}
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <div id="image-preview-container" style="width: 100%; background: #D9D9D9;">
                                        <img id="image-preview" src="{{ asset('admin/assets/images/users/male.png') }}"
                                            alt="" class="img-fluid">
                                    </div>
                                    <div style="text-align: center;">
                                        <input type="file" name="stud_image" class="form-control mt-2"
                                            style="width: 110px;margin-left:25px;" id="stud_image"
                                            onchange="previewImage(event)">
                                    </div>

                                </div>
                                <div class="mb-3">
                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-12">

                                <div class="mb-3">
                                    <label for="stud_name" class="form-label">Student Name
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="stud_name" placeholder="Enter Name" class="form-control"
                                        id="stud_name" style="font-size:14px;color: #95949E;" required>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="stud_dob" class="form-label">Date of Birth
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="stud_dob" placeholder="MM/DD/YYYY" class="form-control"
                                        id="stud_dob" style="font-size:14px;color:#95949E;" required>
                                </div> --}}
                                <div class="mb-3">
                                    <label for="stud_dob" class="form-label">Date of Birth
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="stud_dob" placeholder="MM/DD/YYYY" class="form-control"
                                        id="stud_dob" style="font-size:14px;color:#95949E;" required>
                                    <span id="dob_error" class="text text-danger" style="display:none;">Please select a
                                        valid date of birth.</span>
                                </div>
                                <div class="mb-3">
                                    <label for="stud_phone" class="form-label">Contact Number
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="stud_phone" placeholder="+91" class="form-control"
                                        id="stud_phone" style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stud_email" class="form-label">Email Id
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="email" name="stud_email" placeholder="Enter Email Id"
                                        class="form-control" id="stud_email" style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="date_of_en" class="form-label">Date of Enrollment
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="date_of_en" placeholder="Enter Date of Enrollment"
                                        class="form-control" id="date_of_en" style="font-size:14px;color:#95949E;" required>
                                </div>

                            </div>
                            <div class="col-lg-5 col-sm-12" style="font-family: Rubik; font-size:18px;color:#4E4D55;">

                                <div class="mb-3">
                                    <label for="stud_school_name" class="form-label">School Name
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <select name="school_id" id="school_id" class="form-control" required>
                                        <option>Select School</option>
                                        @foreach ($school as $list)
                                            <option value="{{ $list->id }}">{{ $list->school_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    @php
                                        $grade = ['8th', '9th', '10th'];
                                    @endphp
                                    <label for="stud_grade" class="form-label">Grade<span
                                            class="text text-danger">*</span></label>
                                    <select class="form-control" name="stud_grade" required>
                                        <option value="">select Grade</option>
                                        @foreach ($grade as $single)
                                            <option value="{{ $single }}">{{ $single }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="aadhaar_card" class="form-label">Aadhaar Card
                                    </label>
                                    <input type="file" name="aadhaar_card" class="form-control" id="aadhaar_card"
                                        style="font-size:14px;color:#95949E;">
                                </div>
                                <div class="mb-3">
                                    <label for="pan_card" class="form-label">Pan Card
                                    </label>
                                    <input type="file" name="pan_card" class="form-control" id="pan_card"
                                        style="font-size:14px;color:#95949E;">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password
                                    </label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        style="font-size:14px;color:#95949E;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4" style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;">
                        <p class=""
                            style="font-family: Rubik; font-size:26px; font-weight:500px; color:#000;padding: 20px 0 0 20px;">
                            Parent’s
                            Details</p>
                        <hr style="margin-top: -10px;">
                        <div class="row" style="font-family: Rubik; font-size:18px;color:#4E4D55; padding:20px;">

                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="mother_name" class="form-label">Mother Name
                                        <span class="text text-danger">*</span></label>
                                    <input type="text" name="mother_name" placeholder="Mother Name "
                                        class="form-control" id="mother_name" style="font-size:14px;color:#95949E;"
                                        required>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="mb-3">
                                            <label for="mother_phone" class="form-label">Contact Number<span
                                                    class="text text-danger">*</span></label>
                                            <input type="text" name="mother_phone" placeholder="+91"
                                                class="form-control" id="mother_phone"
                                                style="font-size:14px;color:#95949E;" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="mb-3">
                                            <label for="mother_occupation" class="form-label">Occupation</label>
                                            <input type="text" name="mother_occupation" placeholder="Occupation"
                                                class="form-control" id="mother_occupation"
                                                style="font-size:14px;color:#95949E;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="father_name" class="form-label">Father Name<span
                                            class="text text-danger">*</span></label>
                                    <input type="text" name="father_name" placeholder="Father Name "
                                        class="form-control" id="father_name" style="font-size:14px;color:#95949E;"
                                        required>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="mb-3">
                                            <label for="father_phone" class="form-label">Contact Number<span
                                                    class="text text-danger">*</span></label>
                                            <input type="text" name="father_phone" placeholder="+91"
                                                class="form-control" id="father_phone"
                                                style="font-size:14px;color:#95949E;" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="mb-3">
                                            <label for="father_occupation" class="form-label">Occupation</label>
                                            <input type="text" name="father_occupation" placeholder="Occupation"
                                                class="form-control" id="father_occupation"
                                                style="font-size:14px;color:#95949E;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4" style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;">
                        <p class=""
                            style="font-family: Rubik; font-size:26px; font-weight:500px; color:#000;padding: 20px 0 0 20px;">
                            Bank Details(Optional)</p>
                        <hr style="margin-top: -10px;">
                        <div class="row" style="font-family: Rubik; font-size:18px;color:#4E4D55; padding:20px;">

                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="bank_holder_name" class="form-label">Name (As Account Holder)
                                    </label>
                                    <input type="text" name="bank_holder_name" placeholder="Account Holder Name "
                                        class="form-control" id="bank_holder_name" style="font-size:14px;color:#95949E;">
                                </div>
                                <div class="mb-3">
                                    <label for="bank_name" class="form-label">Bank Name
                                    </label>
                                    <input type="text" name="bank_name" placeholder="Account Holder Name "
                                        class="form-control" id="bank_name" style="font-size:14px;color:#95949E;">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="bank_acc_no" class="form-label">Bank Account Number</label>
                                    <input type="text" name="bank_acc_no" placeholder="Bank Account Number "
                                        class="form-control" id="bank_acc_no" style="font-size:14px;color:#95949E;">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="text text-center mt-4">
                        <button type="submit" style="background:#EEC714;width: 160px;border-radius:10px; border:none;">
                            <p style="font-family: Rubik;font-size: 38px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                Save</p>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var imageContainer = document.getElementById('image-preview-container');
                var image = document.getElementById('image-preview');
                imageContainer.style.background = 'none';
                image.src = reader.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
        document.addEventListener('DOMContentLoaded', (event) => {
            const dobInput = document.getElementById('stud_dob');
            const dobError = document.getElementById('dob_error');

            var today = new Date();
            var twentyOneYearsAgo = new Date(today.getFullYear() - 12, today.getMonth(), today.getDate())
                .toISOString().split('T')[0];
            dobInput.setAttribute('max', twentyOneYearsAgo);

            dobInput.addEventListener('input', function() {
                const selectedDate = new Date(dobInput.value);
                const maxDate = new Date(twentyOneYearsAgo);

                if (selectedDate > maxDate || selectedDate > new Date()) {
                    dobError.style.display = 'block';
                    dobInput.setCustomValidity('Invalid date');
                } else {
                    dobError.style.display = 'none';
                    dobInput.setCustomValidity('');
                }
            });
        });
    </script>
@endsection
