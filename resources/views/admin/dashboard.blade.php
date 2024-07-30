@extends('admin.master.master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        @if (session('success'))
            <div class="alert text-center alert-success w-50 mx-auto" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger w-50 mx-auto" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">

            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">User</h5>
                        <p class="card-text text-center">
                            5
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">User</h5>
                        <p class="card-text text-center">
                            5
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Extension</h5>
                        <p class="card-text text-center">05</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Users</h5>
                        <p class="card-text text-center">
                            5
                        </p>
                    </div>
                </div>
            </div>
        </div>



        {{-- visa table --}}
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>User List</h3>
                </div>


            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">

                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-buttons" class="table  table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>User name</th>
                                                    <th>User email</th>
                                                    <th>Status</th>
                                                    <th>Is Verified</th>
                                                    <th>Join Date</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Rupjyoti sarma</td>
                                                    <td>rup.sarma23@gmail.com</td>
                                                    <td>active</td>
                                                    <td>verified</td>
                                                    <td>18-04-2024</td>
                                                    <td><a href="">Edit</a></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
