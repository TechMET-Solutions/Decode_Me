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

        @media (max-width: 768px) {
            .custom-margin {
                margin-left: 10px !important;
            }
        }
    </style>
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <x-session-message />
                <div class="row" style="display: flex; justify-content: space-between;">
                    <div class="col-lg-10 col-sm-10">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Venues List</p>
                    </div>
                    <div class="col-lg-2  col-sm-2 text-end mt-4">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addVenueModal"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">
                            <i class='fas fa-plus' style='font-size:18px'></i>&nbsp;&nbsp;Add
                        </button>
                        {{--  {{ route('admin.addexpert') }}  --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class=" table-responsive mt-2 ">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Venue</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($venue as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $data->venue }}</td>
                                            <td style="text-align: center;">
                                                <button data-bs-toggle="modal" onclick="getVenueData('{{ $data->id }}')"
                                                    data-bs-target="#editVenueModal"
                                                    class="btn btn-success green-color no-boundary mt-1"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                <a href="{{ route('admin.deletevenue', $data->id) }}  "
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
    <!--Add Venue Modal -->
    <div class="modal fade " id="addVenueModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Venue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.storevenue') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="venue" class="form-label">Venue
                                <span class="text text-danger">*</span>
                                :</label>
                            <input type="text" name="venue" placeholder="Enter Venue" class="form-control"
                                id="venue" style="font-size:14px;color: #95949E;" required>
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
    <!--Edit Time Slot  Modal -->
    <div class="modal fade " id="editVenueModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Venue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updatevenue') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="venue_id">
                        <div class="mb-3">
                            <label for="slot" class="form-label">Venue
                                <span class="text text-danger">*</span>
                                :</label>
                            <input type="text" name="venue" placeholder="Enter Venue" class="form-control"
                                id="venue_name" style="font-size:14px;color: #95949E;" required>
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
        var venueData = @json($venue);

        function getVenueData(id) {
            let venue = venueData.find(p => p.id == id);
            if (venue) {
                document.getElementById('venue_id').value = venue.id;
                document.getElementById('venue_name').value = venue.venue;
                //console.log(venue.venue);
            }
        }
    </script>
@endsection
