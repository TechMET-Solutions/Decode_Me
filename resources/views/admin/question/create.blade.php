@extends('admin.layout.master')
@section('container')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Add</h4>
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
            <form class="form-horizontal" method="post" action="{{ route('admin.question.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label" name="question">
                            Query Question : -</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fname" placeholder="Query Question Here"
                                name="question" required />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="desc" class="col-sm-3 text-end control-label col-form-label" name="desc">
                            Description : -</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="desc" placeholder="Description Here"
                                name="desc" required />
                        </div>
                    </div>

                    <div class="form-check form-group" style="margin-left: 20%">
                        {{--  <input type="checkbox" id="status" name="status" value="1">
                        <label for="status">Status</label>  --}}
                        <input type="checkbox" id="status" name="status" value="1" <label
                            for="status">Status</label>


                    </div>

                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                        <a href="{{ route('admin.question') }}" class="
                    btn btn-primary">Back</a>
                    </div>
                </div>
        </div>

        </form>
    </div>
@endsection
