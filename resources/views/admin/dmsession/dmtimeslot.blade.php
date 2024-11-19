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
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">DM Sessions Time Slots
                        </p>
                    </div>
                    {{-- <div class="col-lg-3  col-sm-3 text-end">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addSTimeModal"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">
                            <i class='fas fa-plus' style='font-size:18px'></i>&nbsp;&nbsp;Add Session Time
                        </button>
                    </div> --}}
                    <div class="col-lg-4  col-sm-4 text-end">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addSTimeModal"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">
                            <i class='fas fa-plus' style='font-size:18px'></i>&nbsp;&nbsp;Add Session Time
                        </button>
                        <a href="{{ route('admin.dmsession') }}" class="btn"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">Back
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class=" table-responsive mt-2 ">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Time Slots</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dmtimeslot as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $data->slot }}</td>
                                            <td style="text-align: center;">
                                                <button data-bs-toggle="modal"
                                                    onclick="getTimeSlotData('{{ $data->id }}')"
                                                    data-bs-target="#editTimeSlotModal"
                                                    class="btn btn-success green-color no-boundary mt-1"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                <a href=" {{ route('admin.deletedmtimeslot', $data->id) }}  "
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
    <!--Add Time Slot Modal -->
    <div class="modal fade " id="addSTimeModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Time Slot for DM Session</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.storetimeslot') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="slot" class="form-label">Time Slot
                                <span class="text text-danger">*</span>
                            </label>
                            <input type="text" name="slot" placeholder="hh:mm am/pm to hh:mm am/pm"
                                class="form-control" id="slot" style="font-size:14px;color: #95949E;" required>
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
    <div class="modal fade " id="editTimeSlotModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Career Option</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updatetimeslot') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="dmtimeslot_id" id="dmtimeslot_id">
                        <div class="mb-3">
                            <label for="slot" class="form-label">Time Slot
                                <span class="text text-danger">*</span>
                            </label>
                            <input type="text" name="slot" placeholder="Enter Time Slot" class="form-control"
                                id="dmtimeslot_slot" style="font-size:14px;color: #95949E;" required>
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
        var timeSlotData = @json($dmtimeslot);

        function getTimeSlotData(id) {
            let dmtimeslot = timeSlotData.find(p => p.id == id);
            if (dmtimeslot) {
                document.getElementById('dmtimeslot_id').value = dmtimeslot.id;
                document.getElementById('dmtimeslot_slot').value = dmtimeslot.slot;
            }
        }
    </script>
@endsection
