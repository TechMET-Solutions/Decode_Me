@extends('user.layout.master')
@section('content')
    <style>
        @media (max-width: 768px) {
            .btn {
                width: 60%;
            }
        }

        .circle {
            width: 100%;
            height: auto;
            border-top-left-radius: 30px;
        }

        .bg-danger-custom {
            background-color: #D7CECE !important;
            width: 100%;
            height: 86px;
            padding: 0;
            font-size: 40px;
            color: #000;
        }

        .text-love-ya {
            font-family: 'Love Ya Like A Sister', cursive;
        }

        .responsive-image {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 25px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            font-size: 20px;
            font-family: 'Love Ya Like A Sister';
            font-weight: 400;
            margin-top: -80px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #8D5D00;
            color: #FFED7E;
            border: 1px solid #FFED7E;
            border-radius: 30px;
            cursor: pointer;
            margin: 5px;
        }

        .button-container a.active .button {
            background-color: #FFED7E;
            color: #442D00;
        }

        .button-container a.active .button:hover {
            background-color: #FFED7E;
        }

        .selected {
            background-color: #FEFFC2;
        }

        .image-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .image-container p {
            font-size: 10px;
        }

        .image-item {
            margin-bottom: 20px;
            text-align: center;
            background: white;
            box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.16);
            border-radius: 6px
        }

        .image-item img {
            width: 100%;
            max-width: 200px;
        }

        @media (max-width: 768px) {
            .image-container {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .image-item {
                margin-bottom: 20px;
                margin-right: 20px;
                width: calc(50% - 20px);
            }

            .image-item img {
                width: 40%;
            }
        }

        iframe {
            width: 100%;
            height: auto;
            border: 1px solid #ccc;
        }
    </style>
    {{-- <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-4">
                    <div class="col-lg-8 col-sm-12">
                    </div><!--//col-->
                    <div class="col-lg-4 col-sm-12">
                        <div style="width: 100%; height: auto; background: #FFFFF4; border-radius: 20px;">
                            <h6 class="p-4"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;&nbsp;&nbsp;&nbsp;Search</h6>
                        </div>
                    </div>
                </div><!--//row-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div> --}}
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="d-flex">
                            <a href="{{ route('counselling') }}"><i class="fa-solid fa-arrow-left fa-2x"
                                    style="color: #1F1F1F"></i></a>&nbsp;&nbsp;
                            <p
                                style="font-family: Love Ya Like A Sister, cursive; font-size:30px;line-height:45px; color:#1F1F1F;">
                                Completed Sessions </p>
                        </div>
                        <div style="width:50px; border-top: 4px solid yellow;margin-top:-30px;margin-left:230px;">
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12" style="background:#fff">
                                <div class="container">
                                    {{--  @foreach ($completeSession as $value)  --}}
                                    <div class="row mt-4" style="background:#fff;">
                                        <div class="col-lg-2 position-relative">
                                            <div class="circle bg-danger-custom">
                                                <div class="text-love-ya text-center">
                                                    {{ \Carbon\Carbon::parse($completeSession->date)->format('d') }}
                                                </div>
                                                <div class="text-love-ya text-center"
                                                    style="margin-top: -18px;font-size: 26px;">
                                                    {{ \Carbon\Carbon::parse($completeSession->date)->format('F') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-10 d-flex justify-content-between align-items-center">
                                            <div>
                                                <p>Time : &nbsp;<span
                                                        style="font-size: 20px;font-weight:500;">{{ $completeSession->time }}</span>
                                                </p>
                                                <p>Expert: &nbsp;<span
                                                        style="font-size: 20px;font-weight:500;">{{ $completeSession->expert_name }}</span>
                                                </p>
                                                <p>Mode: &nbsp;<span
                                                        style="font-size: 20px;font-weight:500;">{{ $completeSession->mode }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-10 offset-lg-2">
                                            @if ($completeSession->stud_file != null)
                                                <iframe id="file-frame"
                                                    src="{{ asset('takeaway_file/' . $completeSession->stud_file) }}"
                                                    style="width: 100%; height: 700px;">
                                                </iframe>
                                            @else
                                                <p>{!! $completeSession->takeaway !!}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    {{--  @endforeach  --}}
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
