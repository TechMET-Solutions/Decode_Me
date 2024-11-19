@extends('user.layout.master')
@section('content')
    <div class="app-wrapper" style="background:#fff">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container mt-4">
                <form action="{{ route('takeaway') }}" method="post" enctype="multipart/form-data" id="myForm">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="sessionId" value="{{ $dmSession->id }}">
                        <div class="d-flex">
                            <a href="{{ route('counselling') }}"><i class="fa-solid fa-arrow-left fa-2x"
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
                                        <input type="file" name="stud_file" id="stud_file" name="takeaway"
                                            placeholder="File upload">
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

        $(document).ready(function() {
            $('#summernote').summernote();

            $('#myForm').on('submit', function(event) {
                var textContent = $('#summernote').val().trim();
                var fileContent = $('#stud_file').val().trim();

                if (textContent === '' && fileContent === '') {
                    event.preventDefault();
                    alert('Please Enter Description or Upload a File Before Submitting.');
                }
            });
        });
    </script>
@endsection
