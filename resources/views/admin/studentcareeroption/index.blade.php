@extends('admin.layout.master')
@section('container')
    <style>
        thead th {
            background-color: #FFE235 !important;
            padding: 0 20px;

                {
                    {
                    -- color: white !important;
                    --
                }
            }
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

        @media (max-width: 576px) {
            .custom-margin-left {
                margin-left: 20px !important;
            }
        }
    </style>
    <div class="app-wrapper" style="background: #FFFFF4;">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <x-session-message />

                <div class="row" style="display: flex; justify-content: space-between;">
                    <div class="col-lg-12 col-sm-12 ">
                        <p style="font-family: Rubik; font-size:38px; font-weight:500px; color:#000;">Student Career Options
                        </p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="mb-3 mt-4">
                            <p style="font-family: Rubik; font-size:28px; font-weight:500;color:darkgreen;">
                                <span style="color: #000;font-size:24px;">Student Name:</span>
                                {{ $student->name }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="row">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-1 col-2">
                                <a href="{{ route('generateStudentCareerRankPDF', ['id' => $student->id, 'sid' => $student->school_id]) }}"
                                    style="margin-left: 0px;">
                                    <i class='fa-solid fa-file-arrow-down'
                                        style='font-size: 43px; color: green; margin-bottom: -45px;'></i>
                                </a>
                            </div>
                            <div class=" col-lg-3 col-5 text text-end mt-4">
                                <a href="{{ route('admin.scohistory', $student->id) }}"
                                    style="background:#FFE235;width: 140px;border-radius:10px; border:none;font-family: Rubik;font-size: 30px;font-weight: 500;color:#fff; padding:5px 10px 5px 10px;">
                                    History
                                </a>
                            </div>
                            <div class="col-lg-3 col-5">
                                <form action="{{ route('admin.storestudentcareeroptions') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="date" name="date" value="{{ date('Y-m-d') }}">
                                    <input type="hidden" name="stud_id" value="{{ $student->id }}">
                                    <input type="hidden" id="sc_priority" name="sc_priority" value="">
                                    <input type="hidden" name="career_action" id="career_action">
                                    <div class="text text-end mt-4">
                                        <button type="submit"
                                            style="background:#FFE235;width: 110px;border-radius:10px; border:none;">
                                            <p
                                                style="font-family: Rubik;font-size: 30px;font-weight: 500;color:#fff;margin-bottom:-1px;">
                                                Save</p>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 ">
                        <div class=" table-responsive mt-2 ">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;padding:0 0 23px 0;">Id</th>
                                        <th style="padding:0 0 23px 0;">Careers</th>
                                        <th>Sub Careers
                                            <p
                                                style="text-align:center;margin-top:-23px;margin-left:90px;margin-right:-25px;">
                                                Priority
                                            </p>
                                        </th>
                                    </tr>
                                </thead>
                                @php
                                    $sc_priority = [];
                                    if (!empty($scop)) {
                                        $rank = json_decode($scop->sc_priority, true);
                                    } else {
                                        $rank = [];
                                    }

                                @endphp

                                <tbody>

                                    @foreach ($career as $data)
                                        <tr>
                                            <td style="text-align: center;">{{ $loop->index + 1 }}</td>
                                            <td>
                                                {{ $data->name }}
                                            </td>
                                            <td>
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

                                                            foreach (array_reverse(array_keys($map)) as $value) {
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
                                                            <div class="col-7">
                                                                {{ toRoman($counter) }}.&nbsp;&nbsp;{{ $sc->name }}
                                                            </div>

                                                            <div class="col-2 "
                                                                style="width:35px; height:35px; border-radius:50%; background-color:#FFE235;margin-top:4px;margin-left:-16px;font-size:20px;font-weight:600;">
                                                                @if ($rank != '')
                                                                    @foreach ($rank as $key => $value)
                                                                        @if ($sc->id == $key)
                                                                            {{ $value }}
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </div>

                                                            <div class="col-3 " style="margin-left:20px;">
                                                                <input type="number" class="rankInput"
                                                                    name="rank[{{ $sc->id }}]" placeholder="Rank">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var sc_priority = {};
        $(document).ready(function() {
            $('.rankInput').on('input', function() {
                var rankValue = $(this).val();
                var scId = $(this).attr('name').match(/\d+/)[0];
                rankValue = rankValue.replace(/[^0-9]/g,
                    '');
                if (rankValue !== '') {
                    sc_priority[scId] = parseInt(rankValue, 10);
                } else {
                    delete sc_priority[scId];
                }
                document.getElementById('sc_priority').value = JSON.stringify(sc_priority);
            });
        });
    </script>
    {{--  $(document).ready(function() {
            $('.rankInput').on('input', function() {
                var rankValue = $(this).val();
                var scId = $(this).attr('name').match(/\d+/)[0];
                //console.log(scId, rankValue);
                // Assuming sc_priority is a JavaScript object
                sc_priority[scId] = rankValue;
                //let json = JSON.stringify(sc_priority);
                document.getElementById('sc_priority').value = JSON.stringify(sc_priority);
                //console.log(json);
            });
        });  --}}
@endsection
