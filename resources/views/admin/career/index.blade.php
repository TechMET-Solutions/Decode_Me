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
    </style>
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <x-session-message />

                <div class="row" style="display: flex; justify-content: space-between;">
                    <div class="col-lg-8 col-sm-8">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Career List</p>
                    </div>
                    <div class="col-lg-2 col-sm-2">
                        <a href="{{ route('admin.subcareerlist') }}" class="btn"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px;">
                            SubCareer Options</a>
                    </div>
                    <div class="col-lg-2 col-sm-2">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addCareerModal"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">
                            <i class='fas fa-plus' style='font-size:18px'></i>&nbsp;&nbsp;Add Career Option
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">

                        <div class=" table-responsive mt-2 ">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Id</th>
                                        <th style="text-align: center;">Name</th>
                                        <th style="text-align: end;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($career as $data)
                                        <tr>
                                            <td style="text-align: center;">{{ $data->id }}</td>
                                            <td style="text-align: center;">{{ $data->name }}</td>
                                            <td style="text-align: end;">
                                                <button data-bs-toggle="modal"
                                                    onclick="getCareerData('{{ $data->id }}')"
                                                    data-bs-target="#editCareerModal"
                                                    class="btn btn-success green-color no-boundary mt-1"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                <a href="{{ route('admin.deletecareer', $data->id) }}"
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

    <!--Add Career Modal -->
    <div class="modal fade " id="addCareerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Career Option</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.storecareer') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name
                                <span class="text text-danger">*</span>
                            </label>
                            <input type="text" name="name" placeholder="Enter Career Option" class="form-control"
                                id="name" style="font-size:14px;color: #95949E;" required>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description<span
                                    class="text text-danger">*</span></label>
                            <textarea name="desc" id="summernote" cols="30" rows="10"></textarea>
                        </div>
                        <div class="text text-center mt-2 ">
                            <button type="submit"
                                style="background:#EEC714;width: 100px;border-radius:10px; border:none; margin-top:10px;">
                                <p
                                    style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                    Save</p>
                            </button>
                            <button type="button"
                                style="background:rgb(150, 147, 147);width: 100px;border-radius:10px; border:none; margin-top:10px;"
                                data-bs-dismiss="modal">
                                <p
                                    style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                    Close</p>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--Edit Career Modal -->
    <div class="modal fade " id="editCareerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Career Option</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updatecareer') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="career_id" id="career_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name
                                <span class="text text-danger">*</span>
                            </label>
                            <input type="text" name="name" placeholder="Enter Career Option" class="form-control"
                                id="career_name" style="font-size:14px;color: #95949E;" required>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description<span
                                    class="text text-danger">*</span></label>
                            <textarea name="desc" id="summernote2" cols="30" rows="10"></textarea>
                        </div>
                        <div class="text text-center mt-2 ">
                            <button type="submit"
                                style="background:#EEC714;width: 120px;border-radius:10px; border:none; margin-top:10px;">
                                <p
                                    style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                    Update</p>
                            </button>
                            <button type="button"
                                style="background:rgb(150, 147, 147);width: 100px;border-radius:10px; border:none; margin-top:10px;"
                                data-bs-dismiss="modal">
                                <p
                                    style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                    Close</p>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        //Summernote of add Career
        var careerData = @json($career);
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,
                focus: true
            });
        });
        //Summernote of edit Career
        $(document).ready(function() {
            $('#summernote2').summernote({
                height: 200,
                focus: true
            });
        });

        function getCareerData(id) {
            let career = careerData.find(p => p.id == id);
            if (career) {
                document.getElementById('career_id').value = career.id;
                document.getElementById('career_name').value = career.name;
                setSummerNote(career.desc);
            }
        }

        function setSummerNote(content) {
            $('#summernote2').summernote('code', content);
        }
    </script>
@endsection
