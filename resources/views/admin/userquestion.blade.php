@extends('admin.layout.master')
@section('container')
<div class="page-wrapper">
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title"> User Question</h4>
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
            <div class="card ">
                <div class="table-responsive container mt-5">
                  <table class="table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">User-Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Question</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody class="customtable">
                        @foreach ($help as $list )
                      <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->cID}}</td>
                            <td>{{$list->userData->name}}</td>
                            <td>{{$list->userData->email}}</td>
                            <td>{{$list->userData->mobile}}</td>
                            <td>{{$list->question}}</td>
                            <td>
                                <a href="" class="btn btn-danger" id="pendingButton">Pending</a>
                                <a href="" class="btn btn-success" id="processButton">In Process</a>
                                <a href="" class="btn btn-info" id="solveButton">Solved</a>
                            </td>
                              <script>
                                    document.getElementById('pendingButton').addEventListener('click', function() {
                                        alert('Pending request');
                                    });
                              </script>
                              <script>
                                 document.getElementById('processButton').addEventListener('click', function() {
                                        alert('Request In Progress');
                                    });
                              </script>
                              <script>
                                 document.getElementById('solveButton').addEventListener('click', function() {
                                        alert('Solved Successfully');
                                    });
                              </script>
                            {{-- <td><a href="">Status</a></td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
</div>
@endsection
