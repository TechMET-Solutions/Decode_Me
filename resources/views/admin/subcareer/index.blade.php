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


        .accordion-button:not(.collapsed) {
            box-shadow: none !important;
        }

        .accordion-collapse.show {
            box-shadow: none !important;
        }

        .accordion {
            border: none;
        }


        .accordion-item {
            border: none;
        }


        .accordion-item {
            box-shadow: none;
        }


        .accordion-item {
            border-radius: 0;
        }
    </style>
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <x-session-message />
                <div class="row" style="display: flex; justify-content: space-between;">
                    <div class="col-lg-7 col-sm-7">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000">SubCareer List</p>
                    </div>
                    <div class="col-lg-5 col-sm-5 text-end mt-2">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addSubCareerModal"
                            style="background: #FFE235;
                        font-size:18px;margin-top: 10px; ">
                            <i class='fas fa-plus' style='font-size:18px'></i>&nbsp;&nbsp;Add SubCareer Option
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
                                        <th>Name</th>
                                        <th style="text-align: end;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($career as $data)
                                        <tr>
                                            <td style="text-align: center;">{{ $loop->index + 1 }}</td>
                                            <td>
                                                <div class="accordion" id="accordion-{{ $data->id }}">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading-{{ $data->id }}">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapse-{{ $data->id }}"
                                                                aria-expanded="false"
                                                                aria-controls="collapse-{{ $data->id }}">
                                                                <p style="margin-left: -10px;"> {{ $data->name }}</p>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse-{{ $data->id }}"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="heading-{{ $data->id }}"
                                                            data-bs-parent="#accordion-{{ $data->id }}">
                                                            <div class="accordion-body">

                                                                @if (!function_exists('toRoman'))
                                                                    @php
                                                                        function toRoman($number)
                                                                        {
                                                                            $map = [
                                                                                1 => 'i',
                                                                                4 => 'iv',
                                                                                5 => 'v',
                                                                                9 => 'ix',
                                                                                10 => 'x',
                                                                                40 => 'xl',
                                                                                50 => 'l',
                                                                                90 => 'xc',
                                                                                100 => 'c',
                                                                            ];

                                                                            $result = '';

                                                                            foreach (
                                                                                array_reverse(array_keys($map))
                                                                                as $value
                                                                            ) {
                                                                                while ($number >= $value) {
                                                                                    $result .= $map[$value];
                                                                                    $number -= $value;
                                                                                }
                                                                            }

                                                                            return $result;
                                                                        }
                                                                    @endphp
                                                                @endif

                                                                @php
                                                                    $counter = 0;
                                                                @endphp

                                                                @foreach ($subcareer as $sc)
                                                                    @if ($sc->career_id == $data->id)
                                                                        @php
                                                                            $counter++;
                                                                        @endphp
                                                                        <div class="row">
                                                                            <div class="col-9">
                                                                                {{ toRoman($counter) }}.&nbsp;&nbsp;{{ $sc->name }}
                                                                            </div>
                                                                            <div class="col-3" style="text-align:end">
                                                                                <button data-bs-toggle="modal"
                                                                                    onclick="getSubCareerData('{{ $sc->id }}')"
                                                                                    data-bs-target="#editSubCareerModal"
                                                                                    class="btn btn-success green-color no-boundary mt-1"><i
                                                                                        class="fas fa-pencil-alt"></i></button>
                                                                                <a href="{{ route('admin.deletesubcareer', $sc->id) }}"
                                                                                    onclick="return confirm('Are you sure you want to delete this data?');"
                                                                                    class="btn btn-danger red-color mt-1"><i
                                                                                        class="fas fa-trash"></i>
                                                                                </a>
                                                                            </div>

                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td style="text-align: end;">
                                                <a href="{{ route('admin.deletecareer', $data->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this data?');"
                                                    class="btn btn-danger red-color mt-1">
                                                    <i class="fas fa-trash"></i>
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
    <div class="modal fade " id="addSubCareerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add SubCareer Option</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.storesubcareer') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Career Options
                                <span class="text text-danger">*</span>
                            </label>
                            <select name="career_id" id="career_id" class="form-control">
                                <option value="">Select the career</option>
                                @foreach ($career as $list)
                                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Sub Career Option
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
    <div class="modal fade " id="editSubCareerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Sub Career Option</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.editSubCareer') }}" method="post" style="margin-left: 10px;"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="sub_career_id" id="sub_career_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name
                                <span class="text text-danger">*</span>
                            </label>
                            <input type="text" name="name" placeholder="Enter Career Option" class="form-control"
                                id="sub_career_name" style="font-size:14px;color: #95949E;" required>
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
        var subcareerData = @json($subcareer);
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,
                focus: true
            });
        });
        //Summernote of edit Sub Career
        $(document).ready(function() {
            $('#summernote2').summernote({
                height: 200,
                focus: true
            });
        });

        function getSubCareerData(id) {
            let career = subcareerData.find(p => p.id == id);
            if (career) {
                document.getElementById('sub_career_id').value = career.id;
                document.getElementById('sub_career_name').value = career.name;
                setSummerNote(career.desc);
            }
        }

        function setSummerNote(content) {
            $('#summernote2').summernote('code', content);
        }
    </script>
@endsection
