@extends('admin.layout.master')
@section('container')
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row">
                    <div class="col-lg-10 col-sm-12 offset-lg-1">
                        <div class="card mt-4" style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;">
                            <form class="m-4" action="{{ route('admin.storedmsessioncancel', $studsession->id) }}"
                                method="post">
                                @csrf
                                <div class="row">
                                    <h2 class="text-center mb-4">Cancel DM Session</h2>
                                    <hr>
                                    <div class="col-lg-4">
                                        <div class="info-label" style="font-size:18px; font-weight:500;">Student Name:</div>
                                        <p style="background: lightgray;font-size:20px;padding:3px 4px;border-radius:5px;">
                                            {{ $student->name }}
                                        </p>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="info-label" style="font-size:18px; font-weight:500;">Expert Name:</div>
                                        <p style="background: lightgray;font-size:20px;padding:3px 4px;border-radius:5px;">
                                            {{ $expert->name }}
                                        </p>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="info-label" style="font-size:18px; font-weight:500;">Date:</div>
                                        <p style="background: lightgray;font-size:20px;padding:3px 6px;border-radius:5px;">
                                            {{ $studsession->date }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="info-label" style="font-size:18px; font-weight:500;">Time:</div>
                                        <div class="info-data"
                                            style="background: lightgray;font-size:20px;padding:3px 6px;border-radius:5px;">
                                            {{ $studsession->time }}</div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="info-label" style="font-size:18px; font-weight:500;">Mode:</div>
                                        <div class="info-data"
                                            style="background: lightgray;font-size:20px;padding:3px 6px;border-radius:5px;">
                                            {{ $studsession->mode }}</div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="info-label" style="font-size:18px; font-weight:500;">Venue:</div>
                                        <div class="info-data"
                                            style="background: lightgray;font-size:20px;padding:3px 6px;border-radius:5px;">
                                            {{ $studsession->venue }}</div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-4 text-center">
                                        <div class="info-label" style="font-size:18px; font-weight:500;"> Cancel
                                            Session:</div>
                                        <input type="radio" name="status" id="cancel" value="cancel" class="mt-4"
                                            style="transform: scale(1.5); -webkit-transform: scale(1.5); -moz-transform: scale(1.5); width: 15px; height: 15px;"
                                            required>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="info-label" style="font-size:18px; font-weight:500;">DM Session
                                            Cancel Reason:</div>
                                        <textarea name="remark" id="remark" cols="75" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('admin.dmsessionlist') }}" type="button"
                                        class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
