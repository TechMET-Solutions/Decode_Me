@extends('admin.layout.master')
@section('container')
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <x-session-message />
                <form action="{{ route('admin.updatetakeaway', $takeaway->id) }}" method="post" style="margin-left: 10px;"
                    enctype="multipart/form-data">
                    @csrf
                    {{--  <div class="card mt-4" style="box-shadow: 0 0 30px rgba(214, 215, 216, 0.6); border:none;">  --}}
                    <div class="row" style="font-family: Rubik; font-size:18px;color:#4E4D55; padding:20px;">
                        <div class="col-lg-10 col-sm-12 mt-2">
                            <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Edit DM Session
                                Takeaways
                            </p>
                        </div>
                        <div class="col-lg-2 col-sm-12 mt-2 text-end">
                            <div class="text-end"> <a href="{{ route('admin.dmsessionlist') }}" class="btn"
                                    style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">Back
                                </a></div>
                        </div>
                        <div class="col-lg-12 col-sm-12 mt-2">
                            <div class="mb-3">
                                <label for="desc" class="form-label">Admin Takeaway:</label>
                                <textarea name="admintakeaway" id="summernote" cols="30" rows="10">{{ $takeaway->admintakeaway }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 mt-2">
                            <div class="mb-3">
                                <label for="desc" class="form-label">Student Takeaway:</label>
                                <textarea name="takeaway" id="summernote2" cols="30" rows="10">{{ $takeaway->takeaway }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 mt-2">

                        </div>
                    </div>
                    {{--  </div>  --}}
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
        $(document).ready(function() {
            $('#summernote2').summernote({
                height: 200,
                focus: true
            });
        });
    </script>
@endsection
