@extends('user.layout.master')
@section('container')

<div class="page-wrapper">
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Contact</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
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
            <div class="container mt-5">
            <form method="post" action="{{route('storecontact')}}">
                @csrf
            <div class="mb-3" >
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name">
                {{-- <textarea class="form-control" id="summernote" name="name"></textarea> --}}
                  </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="text" class="form-control" id="mobile" name="mobile">
                  </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
                  </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <label for="desc" class="form-label">Description</label>
            <div class="mb-3" id="summernote">
                <input type="hidden" name="desc">
                {{-- <textarea name="desc"></textarea> --}}
                {{-- <input type="text" class="form-control" id="summernote" name="desc"> --}}
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form></div>
        </div>

@endsection
