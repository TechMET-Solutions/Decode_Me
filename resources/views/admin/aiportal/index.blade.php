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
                    <div class="col-lg-12 col-sm-12">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">AIPortals</p>
                    </div>
                    <div class="col-lg-12  col-sm-12 ">
                        <form action="{{ route('admin.storeaiportal') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name
                                        </label>
                                        <input type="text" name="name" placeholder="Enter Portal Name"
                                            class="form-control" id="name" style="font-size:14px;color: #95949E;"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="link" class="form-label">Link
                                        </label>
                                        <input type="text" name="link" placeholder="Enter Portal link"
                                            class="form-control" id="link" style="font-size:14px;color: #95949E;"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="desc" class="form-label">Description
                                        </label>
                                        <input type="text" name="desc" placeholder="Enter Portal Description"
                                            class="form-control" id="desc" style="font-size:14px;color: #95949E;"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 text-end">
                                    <button type="submit"
                                        style="background:#FFE235;width: 100px;border-radius:10px; border:none; margin-top:30px; margin-left:-20px;">
                                        <p
                                            style="font-family: Rubik;font-size: 28px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                            Save</p>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">

                        <div class=" table-responsive mt-2 ">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Link</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aiportal as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td><a href="{{ $data->link }}" target="_blank">{{ $data->link }}</a></td>
                                            <td>{{ $data->desc }}</td>
                                            <td>
                                                <button data-bs-toggle="modal" onclick="getAiData('{{ $data->id }}')"
                                                    data-bs-target="#editAiportal"
                                                    class="btn btn-success green-color no-boundary mt-1"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                <a href="{{ route('admin.deleteaiportal', $data->id) }}"
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

    <!--Edit AI Portal Modal -->
    <div class="modal fade " id="editAiportal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit AI Portal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('updatePortal') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="port_id">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name
                                    </label>
                                    <input type="text" name="name" id="port_name" placeholder="Enter Portal Name"
                                        class="form-control" id="name" style="font-size:14px;color: #95949E;" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="link" class="form-label">Link
                                    </label>
                                    <input type="text" name="link" id="port_link" placeholder="Enter Portal link"
                                        class="form-control" id="link" style="font-size:14px;color: #95949E;"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label for="desc" class="form-label">Description
                                    </label>
                                    <input type="text" name="desc" id="port_desc"
                                        placeholder="Enter Portal Description" class="form-control" id="desc"
                                        style="font-size:14px;color: #95949E;" required>
                                </div>
                            </div>
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
    <script>
        var portal = @json($aiportal);

        function getAiData(id) {
            let portalData = portal.find(p => p.id == id);
            if (portalData) {
                document.getElementById('port_id').value = portalData.id;
                document.getElementById('port_name').value = portalData.name;
                document.getElementById('port_link').value = portalData.link;
                document.getElementById('port_desc').value = portalData.desc;
            }
        }
    </script>
@endsection
