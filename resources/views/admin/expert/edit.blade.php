@extends('admin.layout.master')
@section('container')
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <x-session-message />
                <form action="{{ route('admin.updateexpert', $expert->id) }}" method="post" style="margin-left: 10px;"
                    enctype="multipart/form-data">
                    @csrf
                    <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Edit Expert </p>
                    <div class="card" style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;">

                        <div class="row" style="font-family: Rubik; font-size:18px;color:#4E4D55; padding:20px;">
                            <div class="col-lg-6 col-sm-12">

                                <div class="mb-3">
                                    <label for="name" class="form-label"> Name
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" placeholder="Enter Name"
                                        value="{{ $expert->name }}" class="form-control" id="name"
                                        style="font-size:14px;color: #95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Contact
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="phone" placeholder="+91" value="{{ $expert->phone }}"
                                        class="form-control" id="phone" pattern="[0-9]*"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email ID
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="email" name="email" value="{{ $expert->email }}"
                                        placeholder="Enter Email" class="form-control" id="email"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="date_of_birth" value="{{ $expert->date_of_birth }}"
                                        placeholder="MM/DD/YYYY" class="form-control" id="date_of_birth"
                                        style="font-size:14px;color:#95949E;" required>
                                </div> --}}
                                <div class="mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="date_of_birth" value="{{ $expert->date_of_birth }}"
                                        placeholder="MM/DD/YYYY" class="form-control" id="date_of_birth"
                                        style="font-size:14px;color:#95949E;" required>
                                    <span id="dob_error" class="text text-danger" style="display:none;">Please select a
                                        valid date of birth.</span>
                                </div>
                                <div class="mb-3">
                                    <label for="qualification" class="form-label">Qualification
                                        <span class="text text-danger">*</span>
                                    </label>

                                    <input type="text" name="qualification" value="{{ $expert->qualification }}"
                                        placeholder="Enter Qualification " class="form-control" id="qualification"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="occupation" class="form-label">Occupation
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="occupation" value="{{ $expert->occupation }}"
                                        placeholder="Enter Occupation " class="form-control" id="occupation"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>

                            </div>

                            <div class="col-lg-6 col-sm-12" style="font-family: Rubik; font-size:18px;color:#4E4D55;">
                                <div class="mb-3">
                                    <label for="designation" class="form-label">Designation
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="designation" value="{{ $expert->designation }}"
                                        placeholder="Enter
                                        Designation "
                                        class="form-control" id="designation" style="font-size:14px;color:#95949E;"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="expertise" class="form-label">Expertise
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="expertise" value="{{ $expert->expertise }}"
                                        placeholder="Enter Expertise" class="form-control" id="expertise"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="department" class="form-label">Department
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="department" value="{{ $expert->department }}"
                                        placeholder="Enter department" class="form-control" id="department"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="date_of_join" class="form-label">Date of Join <span
                                            class="text text-danger">*</span></label>
                                    <input type="date" name="date_of_join" placeholder="Joining Date "
                                        value="{{ $expert->date_of_join }}" class="form-control" id="date_of_join"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="date_of_resignation" class="form-label">Date of Resignation <span
                                            class="text text-danger">*</span></label>
                                    <input type="date" name="date_of_resignation"
                                        value="{{ $expert->date_of_resignation }}"
                                        placeholder="Joining Date "class="form-control" id="date_of_resignation"
                                        style="font-size:14px;color:#95949E;" required>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4" style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;">
                        <div class="row" style="font-family: Rubik; font-size:18px;color:#4E4D55; padding:20px;">
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="bank_account_holder_name" class="form-label">Name as(Bank Account Holder)
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="bank_account_holder_name"
                                        value="{{ $expert->bank_account_holder_name }}"
                                        placeholder="Enter Name as(Bank Account Holder)" class="form-control"
                                        id="bank_account_holder_name" style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="account_number" class="form-label">Account Number
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="account_number" value="{{ $expert->account_number }}"
                                        placeholder="Enter Bank Account Number" class="form-control" id="account_number"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>

                                <div class="mb-3">
                                    <label for="photo" class="form-label">Upload Your Photo
                                        <span class="text text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-2">
                                            <img height="60" width="60"
                                                style=" margin-left:10px; border-radius:5px;"
                                                src="/images/{{ $expert->photo }}" alt="">
                                        </div>
                                        <div class="col-10">
                                            <input type="file" name="photo" id="photo" value=""
                                                class="form-control" style="font-size:14px;color:#95949E;">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-12" style="font-family: Rubik; font-size:18px;color:#4E4D55;">

                                <div class="mb-3">
                                    <label for="aadhar_card" class="form-label">Aadhar Card
                                        <span class="text text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-2">
                                            <img height="60" width="60"
                                                style=" margin-left:10px; border-radius:5px;"
                                                src="/images/{{ $expert->aadhar_card }}" alt="">
                                        </div>
                                        <div class="col-10">
                                            <input type="file" name="aadhar_card" id="aadhar_card" value=""
                                                class="form-control" style="font-size:14px;color:#95949E;">
                                        </div>
                                    </div>
                                    {{--  <input type="file" name="aadhar_card" value="{{ $expert->aadhar_card }}"
                                        class="form-control" id="aadhar_card" style="font-size:14px;color:#95949E;"
                                        required>  --}}
                                </div>
                                <div class="mb-3">
                                    <label for="pan_card" class="form-label">Pan Card
                                        <span class="text text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-2">
                                            <img height="60" width="60"
                                                style=" margin-left:10px; border-radius:5px;"
                                                src="/images/{{ $expert->pan_card }}" alt="">
                                        </div>
                                        <div class="col-10">
                                            <input type="file" name="pan_card" id="pan_card" value=""
                                                class="form-control" style="font-size:14px;color:#95949E;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 mt-4">
                                <div class="mb-3">
                                    <label for="desc" class="form-label">Description<span
                                            class="text text-danger">*</span></label>
                                    <textarea name="desc" id="summernote" cols="30" rows="10">{{ $expert->desc }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text text-center mt-4">
                        <button type="submit" style="background:#EEC714;width: 160px;border-radius:10px; border:none;">
                            <p style="font-family: Rubik;font-size: 38px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                Update</p>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,
                focus: true
            });
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            const dobInput = document.getElementById('date_of_birth');
            const dobError = document.getElementById('dob_error');

            var today = new Date();
            var twentyOneYearsAgo = new Date(today.getFullYear() - 21, today.getMonth(), today.getDate())
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
