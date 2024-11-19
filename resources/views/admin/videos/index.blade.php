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
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Video List</p>
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
                                        <th style="text-align: center;">Std</th>
                                        <th style="text-align: center;">Video</th>
                                        <th style="text-align: center;">Description</th>
                                        <th style="text-align: end;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($progressVideos as $data)
                                        <tr>
                                            <td style="text-align: center;">{{ $data->id }}</td>
                                            <td style="text-align: center;">{{ $data->stud_name }}</td>
                                            <td style="text-align: center;">{{ $data->stud_std }}</td>
                                            <td style="text-align: center;"> <video src="{{ url('video', $data->video) }}"
                                                    width="150px;" height="150px" controls></video></td>
                                            <td style="text-align: center;">{{ $data->desc }}</td>
                                            <td style="text-align: end;">
                                                <button data-bs-toggle="modal" onclick="getVideoData('{{ $data->id }}')"
                                                    data-bs-target="#videoApprovalModal"
                                                    class="btn btn-success green-color no-boundary mt-1"><i
                                                        class="fas fa-eye"></i></button>
                                                {{-- <a href="{{ route('admin.deletecareer', $data->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this data?');"
                                                    class="btn btn-danger red-color mt-1"><i class="fas fa-trash"></i>
                                                </a> --}}
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

    <div class="modal fade bd-example-modal-s" id="videoApprovalModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-s" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Progress Video</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('videoConfirmation') }}" method="post">
                    @csrf
                    <div class="modal-body text-center">
                        <div class="row">
                            <input type="hidden" name="video_id" id="video_id">
                            <div class="col-lg-4">
                                <div class="info-label">Video Approve:</div>
                                <input type="radio" name="status" id="approve" value="1">
                            </div>
                            <div class="col-lg-4">
                                <div class="info-label">Video Disapprove:</div>
                                <input type="radio" name="status" id="disapprove" value="0">
                            </div>
                            <div class="col-lg-4">
                                <div class="info-label">Video Cancel:</div>
                                <input type="radio" name="status" id="cancel" value="2">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function getVideoData(id) {
            document.getElementById('video_id').value = id;
        }
    </script>
@endsection
