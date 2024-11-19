@extends('admin.layout.master')
@section('container')
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <form action="{{ route('admin.updateschool', $schoolDetail->id) }}" method="post" style="margin-left: 10px;"
                    enctype="multipart/form-data">
                    @csrf
                    <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Edit School</p>
                    <div class="card" style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;">

                        <div class="row" style="font-family: Rubik; font-size:18px;color:#4E4D55; padding:20px;">
                            <div class="col-lg-6 col-sm-12">

                                <div class="mb-3">
                                    <label for="school_name" class="form-label">School Name
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="school_name" placeholder="Enter School Name"
                                        class="form-control" id="school_name" value="{{ $schoolDetail->school_name }}"
                                        style="font-size:14px;color: #95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="school_code" class="form-label">School Code
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="school_code" placeholder="Enter School Code"
                                        class="form-control" id="school_code" value="{{ $schoolDetail->school_code }}"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="school_contact" class="form-label">School Contact
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="school_contact" placeholder="Enter School Code"
                                        class="form-control" id="school_contact" value="{{ $schoolDetail->school_contact }}"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="school_email" class="form-label">Email ID
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="email" name="school_email" value="{{ $schoolDetail->school_email }}"
                                        placeholder="Enter Email" class="form-control" id="school_email"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>

                                <div class="mb-3">
                                    <label for="school_place" class="form-label">Place
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="school_place" placeholder="Enter School Place"
                                        class="form-control" id="school_place" value="{{ $schoolDetail->school_place }}"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>


                                <div class="mb-3">
                                    <label for="status" class="form-label">Status<span class="text text-danger">*
                                        </span>
                                    </label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option {{ $schoolDetail->status == 0 ? 'selected' : '' }} value="0">Active
                                        </option>
                                        <option {{ $schoolDetail->status == 1 ? 'selected' : '' }} value="1">Deactive
                                        </option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-12" style="font-family: Rubik; font-size:18px;color:#4E4D55;">
                                <div class="mb-3">
                                    <label for="concern_person_name" class="form-label">Concern Person Name
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="concern_person_name" placeholder="Concern Person Name"
                                        class="form-control" id="concern_person_name"
                                        value="{{ $schoolDetail->concern_person_name }}"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="concern_person_phone" class="form-label">Concern Person Contact No.
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="concern_person_phone" placeholder="+91" class="form-control"
                                        id="concern_person_phone" value="{{ $schoolDetail->concern_person_phone }}"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alt_contact_person_name" class="form-label">Alternate Contact Person
                                        Name<span class="text text-danger">*</span></label>
                                    <input type="text" name="alt_contact_person_name"
                                        placeholder="Alternate Person Name "class="form-control"
                                        id="alt_contact_person_name" value="{{ $schoolDetail->alt_contact_person_name }}"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alt_contact_person_phone" class="form-label">Alternate Person Contact
                                        No.<span class="text text-danger">*</span></label>
                                    <input type="text" name="alt_contact_person_phone"
                                        placeholder="Alternate Person Contact No "class="form-control"
                                        id="alt_contact_person_phone"
                                        value="{{ $schoolDetail->alt_contact_person_phone }}"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="date_of_join" class="form-label">Date of Join
                                        <span class="text text-danger">*</span></label>
                                    <input type="date" name="date_of_join"
                                        placeholder="Date of Join "class="form-control" id="date_of_join"
                                        value="{{ $schoolDetail->date_of_join }}" style="font-size:14px;color:#95949E;"
                                        required>
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
@endsection
