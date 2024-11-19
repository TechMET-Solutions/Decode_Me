@extends('admin.layout.master')
@section('container')
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <x-session-message />
                <form action="{{ route('admin.updateworkshop', $workshop->id) }}" method="post" style="margin-left: 10px;"
                    enctype="multipart/form-data">
                    @csrf
                    <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Edit Workshop Details</p>
                    <div class="card" style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;">
                        <div class="row" style="font-family: Rubik; font-size:18px;color:#4E4D55; padding:20px;">

                            <div class="col-lg-6 col-sm-12">

                                <div class="mb-3">
                                    <label for="topic" class="form-label">Workshop Topic
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="topic" placeholder="Topic" value="{{ $workshop->topic }}"
                                        class="form-control" id="topic" style="font-size:14px;color: #95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="venue" class="form-label">Add Venue
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="venue" value="{{ $workshop->venue }}"
                                        placeholder="Address" class="form-control" id="venue"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="seats" class="form-label">Seats
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="text" name="seats" value="{{ $workshop->seats }}" placeholder="seats"
                                        class="form-control" id="seats" pattern="[0-9]*"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    {{--  <label for="expert" class="form-label">Assign Expert<span class="text text-danger">*
                                        </span>
                                    </label>
                                    <select name="expert" id="expert" class="form-control" required>
                                        <option>{{ $workshop->expert }} </option>
                                        @foreach ($expert as $list)
                                            <option value="{{ $list->name }}">{{ $list->name }}</option>
                                        @endforeach
                                    </select>  --}}
                                    <label for="experts" class="form-label">Assign Expert<span
                                            class="text text-danger">*</span></label>
                                    <select name="experts[]" id="experts" class="form-control" required multiple
                                        style="height: 100px;">
                                        <option disabled>Select Expert</option>
                                        @php
                                            $selectedExperts = json_decode($workshop->expert, true);
                                        @endphp
                                        @foreach ($expert as $list)
                                            <option value="{{ $list->name }}"
                                                @if (in_array($list->name, $selectedExperts)) selected @endif>
                                                {{ $list->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Workshop Start Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="start_date" value="{{ $workshop->start_date }}"
                                        placeholder="MM/DD/YYYY" class="form-control" id="start_date"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-12" style="font-family: Rubik; font-size:18px;color:#4E4D55;">
                                <div class="mb-3">
                                    <label for="start_time_start_date" class="form-label">Start Time of Start Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="time" name="start_time_start_date"
                                        value="{{ $workshop->start_time_start_date }}" placeholder="hh:mm AM/PM"
                                        class="form-control" id="start_time_start_date"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>

                                <div class="mb-3">
                                    <label for="end_time_start_date" class="form-label">End Time of Start Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="time" name="end_time_start_date"
                                        value="{{ $workshop->end_time_start_date }}" placeholder="hh:mm AM/PM"
                                        class="form-control" id="end_time_start_date" style="font-size:14px;color:#95949E;"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Workshop End Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="date" name="end_date" value="{{ $workshop->end_date }}"
                                        placeholder="MM/DD/YYYY" class="form-control" id="end_date"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>
                                <div class="mb-3">
                                    <label for="start_time_end_date" class="form-label">Start Time of End Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="time" name="start_time_end_date"
                                        value="{{ $workshop->start_time_end_date }}" placeholder="hh:mm AM/PM"
                                        class="form-control" id="start_time_end_date"
                                        style="font-size:14px;color:#95949E;" required>
                                </div>

                                <div class="mb-3">
                                    <label for="end_time_end_date" class="form-label">End Time of End Date
                                        <span class="text text-danger">*</span>
                                    </label>
                                    <input type="time" name="end_time_end_date"
                                        value="{{ $workshop->end_time_end_date }}" placeholder="hh:mm AM/PM"
                                        class="form-control" id="end_time_end_date" style="font-size:14px;color:#95949E;"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="">
                                    <label for="desc" class="form-label">Description<span
                                            class="text text-danger">*</span></label>
                                    <textarea name="desc" id="summernote" cols="30" rows="10">{{ $workshop->desc }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text text-center mt-4 ">
                        <button type="submit" style="background:#EEC714;width: 180px;border-radius:10px; border:none;">
                            <p style="font-family: Rubik;font-size: 38px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                Submit</p>
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
