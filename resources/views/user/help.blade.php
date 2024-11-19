@extends('user.layout.master')
@section('container')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Help</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Library
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="text-right">
                        {{-- <div class="">
                                <h1>How can we help you ?</h1>
                            </div> --}}
                        <div class="accordion accordion-flush container mt-5" id="accordionFlushExample">
                            @foreach ($help as $index => $list)
                                <div class="accordion-item">
                                    <h1 class="accordion-header" id="flush-heading{{ $index }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapse{{ $index }}" aria-expanded="false"
                                            aria-controls="flush-collapse{{ $index }}">
                                            {{ $list->question }}
                                        </button>
                                    </h1>
                                    <div id="flush-collapse{{ $index }}" class="accordion-collapse collapse"
                                        aria-labelledby="flush-heading{{ $index }}"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <form action="{{ route('help.store') }}" method="post"
                                                style="text-align: left">
                                                @csrf
                                                {{-- @dd($list->question) --}}
                                                <input type="hidden" name="cID" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="question" value="{{ $list->question }}">
                                                <input type="hidden" name="desc" value="{{ $list->desc }}">
                                                <div>{{ $list->desc }}</div><br>
                                                {{-- <a href="" class="btn btn-info" name="chatwithus">Chat With us</a>
                                                <a href="" class="btn btn-info" name="contact">Contact</a>
                                                <a href="" class="btn btn-info" name="mail">Mail</a> --}}
                                                {{--  <input type="submit" name="contact" value="Contact" class="btn btn-info" >  --}}
                                                <input type="submit" name="call" value="Call" class="btn btn-info">
                                                <input type="submit" name="message" value="Message" class="btn btn-info">
                                                <input type="submit" name="mail" value="Mail" class="btn btn-info">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
