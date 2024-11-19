@extends('admin.layout.master')
@section('container')
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <form action="{{ route('admin.updateinternship', $internship->id) }}" method="post" style="margin-left: 10px;"
                    enctype="multipart/form-data">
                    @csrf
                    <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Edit Internship Details</p>
                    <div class="card" style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;">
                        <div class="row" style="font-family: Rubik; font-size:18px;color:#4E4D55;   padding:20px;">
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="company_name" class="form-label">Company Name
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="company_name" placeholder="Enter Company Name"
                                        value="{{ $internship->company_name }}" class="form-control" id="company_name"
                                        style="font-size:14px;color: #95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="link" class="form-label">Link
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="link" placeholder="Enter Company link"
                                        value="{{ $internship->link }}" class="form-control" id="link"
                                        style="font-size:14px;color: #95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="field_name" class="form-label">Field Name
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="field_name" placeholder="Enter Feild Name"
                                        value="{{ $internship->field_name }}" class="form-control" id="field_name"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>

                                <div class="mb-3">
                                    <label for="venue" class="form-label">Venue
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="venue" placeholder="Enter Venue"
                                        value="{{ $internship->venue }}" class="form-control" id="venue"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>

                                <div class="mb-3">
                                    <label for="mode" class="form-label">Mode
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="mode" placeholder="Online/Offline"
                                        value="{{ $internship->mode }}" class="form-control" id="mode"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12" style="font-family: Rubik; font-size:18px;color:#4E4D55;">
                                <div class="mb-3">
                                    <label for="duration" class="form-label">Duration
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="duration" placeholder="Internship Duration"
                                        value="{{ $internship->duration }}" class="form-control" id="duration"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="joining_date" class="form-label">Joining Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="joining_date" placeholder="DD/MM/YYYY"
                                        value="{{ $internship->joining_date }}" class="form-control" id="joining_date"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="time" class="form-label">Time
                                        <span class="text text-danger">*</span></label>
                                    <input type="text" name="time" placeholder="00.00 to 00.00 "
                                        value="{{ $internship->time }}" class="form-control" id="time"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="start_date" placeholder="DD/MM/YYYY"
                                        value="{{ $internship->start_date }}" class="form-control" id="start_date"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="end_date" placeholder="DD/MM/YYYY"
                                        value="{{ $internship->end_date }}" class="form-control" id="end_date"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>

                            </div>
                            <div class="col-12 ">
                                <label for="desc" class="form-label">Description<span
                                        class="text text-danger">*</span></label>
                                <textarea name="desc" id="summernote" cols="30" rows="10">{{ $internship->desc }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text text-center mt-2 ">
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
    </script>
@endsection
