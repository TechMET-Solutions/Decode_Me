@extends('user.layout.master')
@section('content')
    <div class="app-wrapper" style="background:#fff">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container mt-4">
                <form action="{{ route('submitTakeaway') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('internship') }}"><i class="fa-solid fa-arrow-left fa-2x"
                                    style="color: #1F1F1F"></i></a>&nbsp;&nbsp;
                            <p
                                style="font-family: Love Ya Like A Sister, cursive; font-size:30px;line-height:45px; color:#1F1F1F;">
                                Write Session Takeaway </p>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="container">
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <textarea name="desc" id="summernote" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-1">
                                    </div>
                                    <div class="col-11">
                                        <input type="file" id="fileInput" name="takeaway" placeholder="File upload">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
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
            $('#summernote1').summernote({
                height: 200,
                focus: true
            });
        });
    </script>
@endsection
