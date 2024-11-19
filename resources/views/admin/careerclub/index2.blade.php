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
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">Career Club</p>
                    </div>
                    <div class="col-lg-12  col-sm-12 ">
                        <form action="{{ route('admin.storecareerclub') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Career Club Name
                                        </label>
                                        <input type="text" name="name" placeholder="Enter Career Club Name"
                                            class="form-control" id="name" style="font-size:14px;color: #95949E;"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="mb-3">
                                        <label for="link" class="form-label">Link
                                        </label>
                                        <input type="text" name="link" placeholder="Enter Career Club link"
                                            class="form-control" id="link" style="font-size:14px;color: #95949E;"
                                            required>
                                    </div>
                                </div>

                                {{--  <div class="col-lg-6 col-sm-6">
                                    <div class="mb-3">
                                        <label for="school" class="form-label">School
                                        </label>
                                        <select name="school_id" id="school_id" class="form-control" required>
                                            <option>Select School</option>
                                            @foreach ($schoolDetails as $list)
                                                <option value="{{ $list->id }}">{{ $list->school_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-8">
                                    <div class="mb-3">
                                        <label for="studIds" class="form-label">Select Student as Leaders
                                            <span class="text text-danger">*</span>
                                        </label>
                                        <select name="leader_name[]" id="leader_name" multiple="multiple"
                                            class="form-control" required style="height: 100px;">
                                            <option value="">Select Multiple Students</option>
                                            @foreach ($student as $studlist)
                                                <option value="{{ $studlist->name }}"
                                                    data-schoolid="{{ $studlist->school_id }}">{{ $studlist->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>  --}}
                                <div class="col-lg-6 col-sm-6">
                                    <div class="mb-3">
                                        <label for="school" class="form-label">School</label>
                                        <select name="school_id" id="school_id" class="form-control" required>
                                            <option value="">Select School</option>
                                            @foreach ($schoolDetails as $list)
                                                <option value="{{ $list->id }}">{{ $list->school_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-8">
                                    <div class="mb-3">
                                        <label for="studIds" class="form-label">Select Student as Leaders <span
                                                class="text text-danger">*</span></label>
                                        <select name="leader_name[]" id="leader_name" multiple="multiple"
                                            class="form-control" required style="height: 100px;">
                                            <option value="">Select Multiple Students</option>
                                            @foreach ($student as $studlist)
                                                <option value="{{ $studlist->name }}"
                                                    data-schoolid="{{ $studlist->school_id }}">{{ $studlist->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 text-end">
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
                                        <th>Leaders name</th>
                                        <th>School</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($careerclub as $data)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td><a href="{{ $data->link }}" target="_blank">{{ $data->link }}</a></td>
                                            <td>
                                                @php
                                                    $leaderNames = json_decode($data->leader_name, true);
                                                @endphp

                                                @foreach ($leaderNames as $leader_name)
                                                    <p>{{ $loop->index + 1 }}. {{ $leader_name }}</p>
                                                @endforeach

                                            </td>
                                            @foreach ($schoolDetails as $value)
                                                @if ($value->id == $data->sch_id)
                                                    <td>{{ $value->school_name }}</td>
                                                @endif
                                            @endforeach
                                            <td>
                                                <button data-bs-toggle="modal"
                                                    onclick="getCareerClubData('{{ $data->id }}')"
                                                    data-bs-target="#editCareerClubModal"
                                                    class="btn btn-success green-color no-boundary mt-1"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                </a>
                                                <a href="{{ route('admin.deletecareerclub', $data->id) }}"
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

    <!--Edit CareerClub Modal -->
    <div class="modal fade " id="editCareerClubModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Career Club</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('updatecareerClub') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="cc_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Career Club Name
                            </label>
                            <input type="text" name="name" id="cc_name" placeholder="Enter Career Club Name"
                                class="form-control" style="font-size:14px;color: #95949E;" required>
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Link
                            </label>
                            <input type="text" name="link" id="cc_link" placeholder="Enter Career Club link"
                                class="form-control" style="font-size:14px;color: #95949E;" required>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-10">
                                    <label for="link" class="form-label">Leaders
                                        Name</label>
                                </div>
                                <div class="col-2 text-end">
                                    <button type="button" id="editLeaderName" class="btn btn-primary "
                                        style="margin-top: -10px;"><i class='fas fa-plus'
                                            style='font-size:12px'></i></button>
                                </div>
                                <div class="col-12">
                                    <div id="editleaderNamesContainer" style="">
                                        <input type="text" name="leader_name[]" placeholder="Enter Leader Name"
                                            id="cc_leader_name" class="form-control leader-name-input "
                                            style="font-size:14px;color: #95949E; " required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="school" class="form-label">School
                            </label>
                            <select name="sch_id" class="form-control" id="cc_school">
                                <option value="">Select School</option>
                            </select>
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var careerclubData = @json($careerclub);
        var schoolData = @json($schoolDetails);
        $(document).ready(function() {
            $('#addLeaderName').click(function() {
                var inputField = $('<div class="input-group mb-1 mt-1">' +
                    '<input type="text" name="leader_name[]" placeholder="Enter Leader Names" class="form-control leader-name-input" style="font-size:14px;color: #95949E;" required>' +
                    '<button type="button" class="btn btn-danger remove-leader">Remove</button>' +
                    '</div>');

                $('#leaderNamesContainer').append(inputField);
            });

            $('#leaderNamesContainer').on('click', '.remove-leader', function() {
                $(this).closest('.input-group').remove();
            });
        });


        $(document).ready(function() {
            $('#editLeaderName').click(function() {
                $('#editleaderNamesContainer').append(
                    '<div class="input-group mb-3">' +
                    '<input type="text" name="leader_name[]" placeholder="Enter Leader Names" class="form-control leader-name-input" style="font-size:14px;color: #95949E;" required>' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-danger removeLeaderName" type="button">Remove</button>' +
                    '</div>' +
                    '</div>'
                );
            });

            // Add click event for dynamically added remove buttons
            $(document).on('click', '.removeLeaderName', function() {
                $(this).closest('.input-group').remove();
            });
        });


        //edit js for modal
        function getCareerClubData(id) {
            let careerclub = careerclubData.find(p => p.id == id);
            if (careerclub) {
                document.getElementById('cc_id').value = careerclub.id;
                document.getElementById('cc_name').value = careerclub.name;
                document.getElementById('cc_link').value = careerclub.link;
                var ccSchool = document.getElementById('cc_school');
                schoolData.forEach(school => {
                    const option = document.createElement('option');
                    option.text = school.school_name;
                    option.value = school.id;
                    ccSchool.appendChild(option);
                    if (school.id === careerclub.sch_id) {
                        ccSchool.value = school.id;
                    }
                });

                $('#editleaderNamesContainer').empty();

                let leaderNames = JSON.parse(careerclub.leader_name);

                // Add each leader name in a separate row
                leaderNames.forEach(function(leaderName) {
                    $('#editleaderNamesContainer').append(
                        '<div class="input-group mb-3">' +
                        '<input type="text" name="leader_name[]" value="' + leaderName +
                        '" class="form-control leader-name-input" style="font-size:14px;color: #95949E;" required>' +
                        '<div class="input-group-append">' +
                        '<button class="btn btn-danger removeLeaderName" type="button">Remove</button>' +
                        '</div>' +
                        '</div>'
                    );
                });
            }
        }

        $(document).ready(function() {
            $('#school_id').change(function() {
                var selectedSchoolId = $(this).val();
                if (selectedSchoolId === '') {
                    $('#leader_name').empty().append('<option value="">Select Multiple Students</option>');
                } else {
                    $('#leader_name option').each(function() {
                        if ($(this).data('schoolid') == selectedSchoolId) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                }
            });
        });
    </script>
@endsection
